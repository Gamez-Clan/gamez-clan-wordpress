<?php
/**
 * @version   $Id: view.php 22593 2014-08-08 14:46:31Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Views_Userlist_View implements RokSprocket_Views_IView
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
     * @var
     */
    protected $total_posts;

    /**
     * @var string
     */
    protected $context;

    /**
     * @var
     */
    protected $nonce;

    /**
     * @var
     */
    protected $role;

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
     * @return \RokSprocket_Views_Userlist_View
     */
    public function __construct($instance = null)
    {
        global $wp_roles;

        foreach ($instance as $key => $val) {
            $this->$key = $val;
        }

        $this->images_path = ROKSPROCKET_PLUGIN_URL . '/admin/assets/images/';
        $this->nonce = wp_create_nonce('roksprocket-ajax-nonce');
        $this->iframe_link = '&TB_iframe=true&height=425&width=555&modal=true';
        $this->base_link = site_url() . '/wp-admin/admin-ajax.php?action=roksprocket_userlist&nonce=' . $this->nonce;

        $search_args = array();
        if ($this->orderby)
            $search_args['orderby'] = $this->orderby;
        if ($this->order)
            $search_args['order'] = $this->order;
	    if ($this->role)
		    $search_args['role'] = $this->role;

        //build the base_url
        $this->search_link = RokCommon_URL::updateParams($this->base_link, $search_args);

        $link_args = array();
        if ($this->search)
            $link_args['search'] = '%' . $this->search . '%';
        if ($this->orderby)
            $link_args['orderby'] = $this->orderby;
        if ($this->order)
            $link_args['order'] = $this->order;
	    if ($this->role)
		    $link_args['role'] = $this->role;

        //build the base_url
        $this->link = RokCommon_URL::updateParams($this->base_link, $link_args);

        //add additional args to get posts for a single page
        $user_args = array();
        $user_args['blog_id'] = $GLOBALS['blog_id'];
        if ($this->search)
            $user_args['search'] = $this->search;
        if ($this->role)
            $user_args['role'] = $this->role;
        if ($this->orderby)
            $user_args['orderby'] = $this->orderby;
        if ($this->order)
            $user_args['order'] = $this->order;

        $user_args['number'] = 15;
        $user_args['offset'] = ($this->paged - 1) * 15;

        //retrieve page data
        $users = get_users($user_args);
        //get other data needed for template
        foreach ($users as $user) {
            $current_user = new WP_User($user->ID);
            if (is_array($current_user->roles) && !empty($current_user->roles)) {
                $user->role = implode(', ', $current_user->roles);
            } elseif (is_string($current_user->roles) && !empty($current_user->roles)) {
                $user->role = $current_user->roles;
            } else {
                $user->role = 'No User Roles Assigned';
            }
            $user->postcount = count_user_posts($user->ID);
        }

        $this->users = $users;

        //retrieve total posts
        $count_args = array();
        $count_args['blog_id'] = $GLOBALS['blog_id'];
        if ($this->search)
            $count_args['search'] = '%' . $this->search . '%';
        if ($this->role)
            $count_args['role'] = $this->role;
        if ($this->orderby)
            $count_args['orderby'] = $this->orderby;
        if ($this->order)
            $count_args['order'] = $this->order;

        $count_args['number'] = 9999;
        $count_args['offset'] = 0;

        $this->total_users = count(get_users($count_args));
        $this->total_pages = ceil($this->total_users / 15);

        $this->inline_js = "
            window.addEvent('domready', function() {
                $$('#role').addEvent('change', function(){
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

        $roles = $wp_roles->role_names;
        $roleselect = '<select class="role" id="role" name="role">';
        $roleselect .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("role" => "")) . '" value=""' . rs_selected('', $this->role, false) . '>' . 'Filter by Role' . '</option>';
        foreach ($roles as $key => $value) {
            $roleselect .= '<option rel="' . RokCommon_URL::updateParams($this->link, array("role" => $key)) . '" value="' . $key . '"' . rs_selected('false', $this->role, false) . '>' . $value . '</option>';
        }
        $roleselect .= '</select>';

        $this->roleselect = $roleselect;

        $searchbox = '<input type="text" id="search-input" class="search-input alignleft" size="25" name="search" value="' . $this->search . '" />';
        $searchbox .= '<a href="' . $this->search_link . '" id="search-button" class="button ok alignleft action">Search by Username</a>';
        $searchbox .= '<a href="' . $this->base_link . '" id="clear-button" class="button cancel alignleft action">Clear Filters</a>';

        $this->searchbox = $searchbox;

        $this->context = 'rs_templates.userlist';
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
        echo RokCommon_Composite::get($this->context)->load('userlist.php', array('that' => $this));
        $content = ob_get_contents();
        ob_end_clean();

        ob_start();
        echo RokCommon_Composite::get($this->context)->load('window.php', array('content' => $content,'inlinescript' => $this->inline_js, 'inlinestyle' => $this->inline_css));
        echo ob_get_clean();
    }
}
