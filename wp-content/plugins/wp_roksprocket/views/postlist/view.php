<?php
/**
 * @version   $Id: view.php 22593 2014-08-08 14:46:31Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Views_Postlist_View implements RokSprocket_Views_IView
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
        foreach ($instance as $key => $val) {
            $this->$key = $val;
        }

	    $this->post_types = array();

	    //add custom public post types for wordpress
	    if ($this->provider == 'wordpress') {
		    $post_types = get_post_types( array( 'public' => true ) );
		    foreach ($post_types as $post_type => $name) {
			    $this->post_types[] = $post_type;
		    }
	    }

        //add custom post types for Types
        if ($this->provider == 'types') {
            $db_post_types = get_option('wpcf-custom-types', array());
            $post_types = (is_string($db_post_types)) ? unserialize($db_post_types) : $db_post_types;
            foreach ($post_types as $post_type) {
                $this->post_types[] = $post_type['slug'];
            }
        }

        //add custom post types for CPT
        if ($this->provider == 'cpt') {
            $post_types = get_option('cpt_custom_post_types', array());
            foreach ($post_types as $post_type) {
                $this->post_types[] = $post_type['name'];
            }
        }

        $this->post_statuses = array('publish', 'unpublish');
        $this->images_path = ROKSPROCKET_PLUGIN_URL . '/admin/assets/images/';

        $this->nonce = wp_create_nonce('roksprocket-ajax-nonce');
        $this->iframe_link = '&TB_iframe=true&height=425&width=555&modal=true';
        $this->base_link = site_url() . '/wp-admin/admin-ajax.php?action=roksprocket_postlist&provider=' . $this->provider . '&nonce=' . $this->nonce;

        $search_args = array();
        if ($this->category)
            $search_args['category'] = $this->category;
        if ($this->orderby)
            $search_args['orderby'] = $this->orderby;
        if ($this->order)
            $search_args['order'] = $this->order;
        if ($this->post_type)
            $search_args['post_type'] = $this->post_type;
        if ($this->post_status){
            $search_args['post_status'] = $this->post_status;
        } else {
            $search_args['post_status'] = array("publish", 'pending', 'draft', 'future', "private");
        }

        //build the search_link
        $this->search_link = RokCommon_URL::updateParams($this->base_link, $search_args);

        $link_args = array();
        if ($this->search)
            $link_args['search'] = $this->search;
        if ($this->category)
            $link_args['category'] = $this->category;
        if ($this->orderby)
            $link_args['orderby'] = $this->orderby;
        if ($this->order)
            $link_args['order'] = $this->order;
        if ($this->post_type)
            $link_args['post_type'] = $this->post_type;
        if ($this->post_status){
            $link_args['post_status'] = $this->post_status;
        } else {
            $link_args['post_status'] = array("publish", 'pending', 'draft', 'future', "private");
        }
        //build the base_link
        $this->link = RokCommon_URL::updateParams($this->base_link, $link_args);

        //add additional args to get posts for a single page
        $post_args = array();
        if ($this->search)
            $post_args['s'] = $this->search;
        if ($this->category)
            $post_args['category'] = $this->category;
        if ($this->orderby)
            $post_args['orderby'] = $this->orderby;
        if ($this->order)
            $post_args['order'] = $this->order;
        if ($this->post_type) {
            $post_args['post_type'] = $this->post_type;
        } else {
            $post_args['post_type'] = $this->post_types;
        }
        if ($this->post_status){
            $post_args['post_status'] = $this->post_status;
        } else {
            $post_args['post_status'] = array("publish", 'pending', 'draft', 'future', "private");
        }
        $post_args['numberposts'] = 15;
        $post_args['offset'] = ($this->paged - 1) * 15;

        //retrieve page data
        $this->posts = get_posts($post_args);

	    //modify the post arguments to properly count the number of pages and total posts
	    $count_helper = $post_args;
	    $count_helper['numberposts'] = -1;

        $this->total_posts = count(get_posts($count_helper));
        $this->total_pages = ceil($this->total_posts / 15);

        $this->inline_js = "
        window.addEvent('domready', function() {
            $$('#post_type, #category, #post_status').addEvent('change', function(){
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


        $typelist = '<select class="post_type" id="post_type" name="post_type">';
        $typelist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("post_type" => '')) . '" value=""' . rs_selected('', $this->post_type, false) . '>' . 'Filter by Post Type' . '</option>';
        foreach ($this->post_types as $type) {
            $typelist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("post_type" => $type)) . '" value="' . $type . '"' . rs_selected($type, $this->post_type, false) . '>' . ucwords($type) . '</option>';
        }
        $typelist .= '</select>';

        $this->typelist = $typelist;

        $type_args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => 1,
            'hierarchical' => 1,
            'taxonomy' => 'category',
            'pad_counts' => false);

        $this->categories = get_categories($type_args);

        $catlist = '<select class="category" id="category" name="category">';
        $catlist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("category" => "")) . '" value=""' . rs_selected("", $this->category, false) . '>' . 'Filter by Category' . '</option>';
        foreach ($this->categories as $cat) {
            $catlist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("category" => $cat->cat_ID)) . '" value="' . $cat->cat_ID . '"' . rs_selected($cat->cat_ID, $this->category, false) . '>' . $cat->name . '</option>';
        }
        $catlist .= '</select>';

        $this->catlist = $catlist;

        $publist = '<select class="post_status" id="post_status" name="post_status">';
        $publist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("post_status" => "")) . '" value=""' . rs_selected('', $this->post_status, false) . '>' . 'Filter by Status' . '</option>';
        $publist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("post_status" => "publish")) . '" value="publish"' . rs_selected('publish', $this->post_status, false) . '>' . 'Published' . '</option>';
        $publist .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("post_status" => "unpublish")) . '" value="unpublish"' . rs_selected('unpublish', $this->post_status, false) . '>' . 'Unpublished' . '</option>';
        $publist .= '</select>';

        $this->publist = $publist;

        $searchbox = '<input type="text" id="search-input" class="search-input alignleft" size="25" name="search" value="' . $this->search . '" />';
        $searchbox .= '<a href="' . $this->search_link . '" id="search-button" class="button ok alignleft action">Search</a>';
        $searchbox .= '<a href="' . $this->base_link . '" id="clear-button" class="button cancel alignleft action">Clear Filters</a>';

        $this->searchbox = $searchbox;

        $this->context = 'rs_templates.postlist';
    }

    /**
     *
     */
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
    }

    /**
     *
     */
    public function renderInlines()
	{
	}

    /**
     *
     */
    public function render()
    {
        ob_start();
        echo RokCommon_Composite::get($this->context)->load('postlist.php', array('that' => $this));
        $content = ob_get_contents();
        ob_end_clean();

        ob_start();
        echo RokCommon_Composite::get($this->context)->load('window.php', array('content' => $content, 'inlinescript' => $this->inline_js, 'inlinestyle' => $this->inline_css));
        echo ob_get_clean();
    }
}
