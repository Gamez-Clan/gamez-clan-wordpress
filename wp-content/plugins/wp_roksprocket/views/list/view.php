<?php
/**
 * @version   $Id: view.php 22593 2014-08-08 14:46:31Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Views_List_View implements RokSprocket_Views_IView
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
     * @return \RokSprocket_Views_Default_View
     */
    public function __construct($instance=null)
    {

        global $wpdb;

        $paging_limit = 20;

        $this->provider = RokSprocket_Request::getString('provider', '');
        $this->search = RokSprocket_Request::getString('search', '');
        $this->paged = RokSprocket_Request::getInt('paged', 1);
        $this->orderby = RokSprocket_Request::getString('orderby', 'title');
        $this->order = RokSprocket_Request::getString('order', 'ASC');

        $this->images_path = ROKSPROCKET_PLUGIN_URL . '/admin/assets/images/';

        $this->nonce = wp_create_nonce('roksprocket-ajax-nonce');
        $this->base_url = site_url() . '/wp-admin/admin.php?page=roksprocket-list&nonce=' . $this->nonce;
        $this->edit_url = site_url() . '/wp-admin/admin.php?page=roksprocket-edit&nonce=' . $this->nonce;


        $link_args = array();
        if ($this->orderby)
            $link_args['orderby'] = $this->orderby;
        if ($this->order)
            $link_args['order'] = $this->order;
        if ($this->provider)
            $link_args['provider'] = $this->provider;
        if ($this->paged)
            $link_args['paged'] = $this->paged;

        //build the base_url
        $this->search_link = RokCommon_URL::updateParams($this->base_url, $link_args);

        if ($this->search)
            $link_args['search'] = $this->search;

        //build the base_url
        $this->link = RokCommon_URL::updateParams($this->base_url, $link_args);
        $this->edit_url = RokCommon_URL::updateParams($this->edit_url, $link_args);

        //build base query
        $query = 'SELECT * FROM ' . $wpdb->prefix . 'roksprocket';
        $where = array();
        if ($this->search) {
            $where[] = 'title LIKE "%' . strtolower($this->search) . '%"';
        }
        $query_where = '';
        if (count($where)) {
            $query_where = ' WHERE (' . implode(' AND ', $where) . ')';
        }

        $query_order = '';
        if ($this->orderby && $this->orderby!='provider') {
            $query_order .= ' ORDER BY ' . $this->orderby;
            if ($this->order) {
                $query_order .= ' ' . $this->order;
            }
        }

        //retrieve total posts
        $all_results = $wpdb->get_results($query . $query_where . $query_order, ARRAY_A);
        $this->total_results = count($all_results);
        $this->total_pages = ceil($this->total_results / $paging_limit);

        //retrieve single page data
        $query_limit = ' LIMIT ' . (($this->paged - 1) * $paging_limit) . ', ' . $paging_limit;
        $results = $wpdb->get_results($query . $query_where . $query_order . $query_limit, OBJECT_K);

        $list = array();

        //get providers
        $container   = RokCommon_Service::getContainer();
        $paramsclass = $container['roksprocket.providers.registered'];
        $providers   = get_object_vars($paramsclass);
        ksort($providers);


        //get display labels
        foreach ($providers as $provider_id => $provider_info) {
            /** @var $provider RokSprocket_IProvider */
            if($provider_id==$this->provider){
                $displayname = $provider_info->displayname;
            }
        }


        foreach($results as $result){
            $item = new stdClass();
            $params = json_decode($result->params);
            //filter for providers
            if (!$this->provider|| ($this->provider && $this->provider==$params->provider)) {
                $item->id = $result->id;
                $item->title = $result->title;
                $item->modified = $result->modified;
                $item->provider = $params->provider;
                //get display labels
                foreach ($providers as $provider_id => $provider_info) {
                    /** @var $provider RokSprocket_IProvider */
                    if($provider_id==$params->provider){
                        $item->displayname = $provider_info->displayname;
                    }
                }
                $item->layout = $params->layout;
                $list[] = $item;
            }
        }
        $this->results = $list;

        //get layouts
        $css = '';
        foreach ($container['roksprocket.layouts'] as $type => $layoutinfo) {
            $css .= 'i.layout.'.$type.' {background-image: url('.site_url() . '/wp-content/plugins/wp_roksprocket/layouts/'.$type.'/icon.png);background-position: 0 0;}';
        }
        $this->inline_css = $css;

	    $inline_js = "
			window.addEvent('domready', function() {
				document.id('search-input').addEvent('keydown', function(event) {
			        if (event.key == 'enter') {
			            var val = document.id('search-input').value;
			            var href = document.id('search-button').get('href');
			            window.location.href = href + '&search=' + val;
			        }
			    });
			});
		";

	    $this->inline_js = $inline_js;

        $providerselect = '<select class="provider" id="provider" name="provider">';
        $providerselect .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("provider" => "")) . '" value=""' . rs_selected('', $this->provider, false) . '>' . 'Filter by Provider' . '</option>';
        foreach ($providers as $provider_id => $provider_info) {
            $providerselect .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("provider" => $provider_id)) . '" value="' . $provider_id . '"' . rs_selected($provider_id, $this->provider, false) . '>' . $provider_info->displayname . '</option>';
        }
        $providerselect .= '</select>';
        $this->provider = $providerselect;

        $searchbox = '<input type="text" id="search-input" class="search-input" size="25" style="float:left;clear:none;" name="search" value="' . $this->search . '" />';
        $searchbox .= '<a href="' . $this->search_link . '" id="search-button" class="button ok"  style="float:left;clear:none;">Search by Name</a>';
        $this->searchbox = $searchbox;

        $bulkselect = '<select class="bulk" id="bulk" name="bulk">';
        $bulkselect .= '<option value="-1">' . 'Bulk Actions' . '</option>';
        $bulkselect .= '<option value="delete">' . 'Delete' . '</option>';
        $bulkselect .= '</select>';
        $this->bulkselect = $bulkselect;

        $this->bulkbutton = '<a href="#" id="apply-button" class="button apply" style="float:left;clear:none;">Apply</a>';
        $this->clearbutton = '<a href="' . $this->base_url . '" id="clear-button" class="button cancel" style="float:left;clear:none;">Clear Filters</a>';


        $this->context = 'rs_templates.list';
        $this->container = RokCommon_Service::getContainer();
    }

    /**
     *
     */
    public function renderHeader()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        //add thickbox
        wp_enqueue_style('common');
        wp_enqueue_style('thickbox');
        wp_enqueue_style('wp-admin');
        add_thickbox();


        RokCommon_Header::addScript(RokCommon_Composite::get('rs_admin_assets.js')->getURL('moofx.js'));
        RokCommon_Header::addScript(RokCommon_Composite::get('rs_admin_assets.js')->getURL('toolbar.js'));
        RokCommon_Header::addScript(RokCommon_Composite::get('rs_admin_assets.js')->getURL('modal-response.js'));
        //RokCommon_Header::addScript(RokCommon_Composite::get('rs_admin_assets.application')->getURL('Modal.js'));
        //RokCommon_Header::addScript(RokCommon_Composite::get('rs_admin_assets.application')->getURL('Response.js'));
        RokCommon_Header::addStyle(RokCommon_Composite::get('rs_admin_assets.styles')->getURL('roksprocket.css'));
        RokCommon_Header::addStyle(RokCommon_Composite::get('rc_context_path')->getURL('RokCommon/Form/Fields/assets/filter/css/datepicker.css'));
    }

    /**
     *
     */
    public function initialize()
	{

	}

    /**
     *
     */
    public function renderInlines()
	{
        $platforminfo     = $this->container->getService('platforminfo');

        RokCommon_Header::addInlineScript("RokSprocket = {URL: '" . $platforminfo->getRootUrl() . "/wp-admin/admin-ajax.php?action=roksprocket&nonce=" . $this->nonce . "', SiteURL: '" . $platforminfo->getRootUrl() . "'};");
        RokCommon_Header::addInlineScript($this->inline_js);
        RokCommon_Header::addInlineStyle($this->inline_css);
	}

    /**
     *
     */
    public function render()
    {
        ob_start();
        echo RokCommon_Composite::get($this->context)->load('list.php', array('that' => $this));
        echo ob_get_clean();
    }
}
