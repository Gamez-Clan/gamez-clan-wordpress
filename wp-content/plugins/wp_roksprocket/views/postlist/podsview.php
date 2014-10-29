<?php
/**
 * @version   $Id: podsview.php 22593 2014-08-08 14:46:31Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Views_Postlist_Podsview implements RokSprocket_Views_IView
{
    /**
     * @var mixed|string
     */
    protected $id;

    /**
     * @var mixed|string
     */
    protected $provider;

    /**
     * @var mixed|string
     */
    protected $search;

    /**
     * @var mixed|string
     */
    protected $paged;

    /**
     * @var mixed|string
     */
    protected $orderby;

    /**
     * @var mixed|string
     */
    protected $order;
    /**
     * @var
     */
    protected $category;

    /**
     * @var
     */
    protected $post_type;

    /**
     * @var
     */
    protected $post_status;


    /**
     * @var string
     */
    protected $context;

    /**
     * @var string
     */
    protected $pod_type;

    /**
     * @var
     */
    protected $nonce;

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }
        return null;
    }


    /**
     * @param null $instance
     *
     * @return \RokSprocket_Views_Postlist_View
     */
    public function __construct($instance = null)
    {
        global $wpdb;

        foreach ($instance as $key => $val) {
            $this->$key = $val;
        }

        $this->pod_types = $wpdb->get_results('SELECT id, name FROM ' . $wpdb->prefix . 'pod_types', ARRAY_A);
        $this->images_path = ROKSPROCKET_PLUGIN_URL . '/admin/assets/images/';
        $this->nonce = wp_create_nonce('roksprocket-ajax-nonce');
        $this->iframe_link = '&TB_iframe=true&height=425&width=555&modal=true';
        $this->base_link = site_url() . '/wp-admin/admin-ajax.php?action=roksprocket_postlist&provider=' . $this->provider . '&nonce=' . $this->nonce;

        $search_args = array();
        if ($this->orderby)
            $search_args['orderby'] = $this->orderby;
        if ($this->order)
            $search_args['order'] = $this->order;
        if ($this->post_type)
            $search_args['pod_type'] = $this->post_type;

        //build the base_url
        $this->search_link = RokCommon_URL::updateParams($this->base_link, $search_args);

        $link_args = array();
        if ($this->search)
            $link_args['search'] = $this->search;
        if ($this->orderby)
            $link_args['orderby'] = $this->orderby;
        if ($this->order)
            $link_args['order'] = $this->order;
        if ($this->post_type)
            $link_args['pod_type'] = $this->post_type;

        //build the base_url
        $this->link = RokCommon_URL::updateParams($this->base_link, $link_args);

        //build original query to get all
        $query = 'SELECT p.id as post_id, p.tbl_row_id, p.datatype, p.name AS post_title, p.created AS post_date, p.author_id';
        $query .= ', pt.name AS pod_type, pt.id AS pod_type_id';
        $query .= ', CONCAT_WS(",", pf.name) AS data_field_names, CONCAT_WS(",", pf.id) AS data_field_ids';
        $query .= ', u.user_nicename';
        $query .= ' FROM ' . $wpdb->prefix . 'pod as p';
        $query .= ' LEFT JOIN ' . $wpdb->prefix . 'pod_types pt ON pt.id = p.datatype';
        $query .= ' LEFT JOIN ' . $wpdb->prefix . 'pod_fields pf ON pf.datatype = p.datatype';
        //join over users
        $query .= ' LEFT JOIN ' . $wpdb->users . ' as u ON u.ID = p.author_id';

        //set up where statement
        if ($this->search) {
            $wheres[] = 'p.name LIKE "%' . $this->search . '%"';
        }
        if ($this->pod_type) {
            $wheres[] = 'pt.id = "' . $this->pod_type . '"';
        }
        if (count($wheres)) {
            $query .= ' WHERE ' . (implode(' AND ', $wheres));
        }

        //group by id
        $query .= ' GROUP BY p.ID';

        //order by
        if ($this->orderby) {
            $orderby = ($this->orderby == 'pod_type') ? 'pt.name' : (($this->orderby == 'title') ? 'p.name' : $this->orderby);
            $query .= ' ORDER BY ' . $orderby;
        }
        //order
        if ($this->order) {
            $query .= ' ' . $this->order;
        }

        $this->total_posts = count($wpdb->get_results($query, ARRAY_A));
        $this->total_pages = ceil($this->total_posts / 20);
        $this->offset = ($this->paged - 1) * 20;
        $this->limit = 20;

        $query .= ' LIMIT ' . $this->offset . ', ' . $this->limit;

        //retrieve page data
        $this->posts = $wpdb->get_results($query, OBJECT_K);


        $this->inline_js = "
    window.addEvent('domready', function() {
        $$('#pod_type').addEvent('change', function(){
            var rel = document.id(this.options[this.selectedIndex]).get('rel');
            window.location.href = rel;
        });

        document.id('search-button').addEvent('click', function(){
            var val = document.id('search-input').value;
            var href = document.id('search-button').get('href');
            document.id('search-button').set('href', href + '&search=' + val);
        });

        document.id('search-input').addEvent('keydown', function(event) {
	        if (event.key == 'enter') {
	            var val = document.id('search-input').value;
	            var href = document.id('search-button').get('href');
	            window.location.href = href + '&search=' + val;
	        }
	    });
    });
    ";


        $typelist = '<select class="pod_type" id="pod_type" name="pod_type">';
        $typelist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("pod_type" => '')) . '" value=""' . rs_selected('', $this->post_type, false) . '>' . 'Filter by Pod Type' . '</option>';
        foreach ($this->pod_types as $type) {
            $typelist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("pod_type" => $type['id'])) . '" value="' . $type['id'] . '"' . rs_selected($type['id'], $this->post_type, false) . '>' . $type['name'] . '</option>';
        }
        $typelist .= '</select>';

        $this->typelist = $typelist;

        $searchbox = '<input type="text" id="search-input" class="search-input alignleft" size="25" name="search" value="' . $this->search . '" />';
        $searchbox .= '<a href="' . $this->search_link . '" id="search-button" class="button ok alignleft action">Search by Name</a>';
        $searchbox .= '<a href="' . $this->base_link . '" id="clear-button" class="button cancel alignleft action">Clear Filters</a>';

        $this->searchbox = $searchbox;

        $this->context = 'rs_templates.postlist';
    }

    public function initialize()
   	{
   		// TODO: Implement initialize() method.
   	}


    /**
     *
     */
    public function renderHeader()
    {
        //add thickbox
        wp_enqueue_script('jquery');
        wp_enqueue_style('thickbox');
        add_thickbox();
        //add adminstuff
        wp_enqueue_style('wp-admin');
        wp_enqueue_style('colors');

        RokCommon_Header::addStyle(RokCommon_Composite::get('rs_admin_assets.styles')->getURL('admin.css'));

        if ($this->inline_js) {
            RokCommon_Header::addInlineScript($this->inline_js);
        }
        if ($this->inline_css) {
            RokCommon_Header::addInlineStyle($this->inline_css);
        }
    }


	public function renderInlines()
	{
	}


    /**
     *
     */
    public function render()
    {
        ob_start();
        echo RokCommon_Composite::get($this->context)->load('podslist.php', array('that' => $this));
        $content = ob_get_contents();
        ob_end_clean();

        ob_start();
        echo RokCommon_Composite::get($this->context)->load('window.php', array('content' => $content));
        echo ob_get_clean();
    }
}
