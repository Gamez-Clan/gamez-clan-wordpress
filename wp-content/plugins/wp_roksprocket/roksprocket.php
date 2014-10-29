<?php
/**
 * @version   $Id: roksprocket.php 22593 2014-08-08 14:46:31Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
/*
Plugin Name: RokSprocket
Plugin URI: http://www.rockettheme.com
Description: A display widget for multiple WordPress CCKs from RocketTheme.
Author: RocketTheme, LLC
Version: 2.1.2
Author URI: http://www.rockettheme.com
License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

if (!defined('ROKSPROCKET_NEEDED_ROKCOMMON_VERSION')) define('ROKSPROCKET_NEEDED_ROKCOMMON_VERSION', '3.1.11');

//RokSprocket Globals
if (is_multisite()) $plugin = 'wp_roksprocket/roksprocket.php';

//Defines
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
if (!defined('ROKSPROCKET_DEV')) define('ROKSPROCKET_DEV', false);
if (!defined('ROKSPROCKET_VERSION')) define('ROKSPROCKET_VERSION', '2.1.2');
if (!defined('ROKSPROCKET_PLUGIN_FILE')) define('ROKSPROCKET_PLUGIN_FILE', str_replace(WP_PLUGIN_DIR, '', $plugin));
if (!defined('ROKSPROCKET_PLUGIN_REL_PATH')) define('ROKSPROCKET_PLUGIN_REL_PATH', '/' . str_replace(array('/', '\\'), '', dirname(ROKSPROCKET_PLUGIN_FILE)));
if (!defined('ROKSPROCKET_PLUGIN_PATH')) define('ROKSPROCKET_PLUGIN_PATH', WP_PLUGIN_DIR . ROKSPROCKET_PLUGIN_REL_PATH);
if (!defined('ROKSPROCKET_PLUGIN_URL')) define('ROKSPROCKET_PLUGIN_URL', WP_PLUGIN_URL . ROKSPROCKET_PLUGIN_REL_PATH);

//load required files in required order
include_once(ROKSPROCKET_PLUGIN_PATH . '/functions.php');
include_once(ROKSPROCKET_PLUGIN_PATH . '/include.php');
include_once(ROKSPROCKET_PLUGIN_PATH . '/request.php');

if (!preg_match('/project.version/', ROKCOMMON) && version_compare(preg_replace('/-SNAPSHOT/', '', ROKCOMMON), ROKSPROCKET_NEEDED_ROKCOMMON_VERSION, '<')) {
	rs_force_deactivate();
	roksprocket_set_admin_message('error', __('RokSprocket v2.1.2 needs at least RokCommon Version ' . ROKSPROCKET_NEEDED_ROKCOMMON_VERSION . '.  You currently have RokCommon Version ' . ROKCOMMON));
	return;
}

include_once(ROKSPROCKET_PLUGIN_PATH . '/widgets/roksprocket.php');
include_once(ROKSPROCKET_PLUGIN_PATH . '/tinymce/tinymce.php');

// Define Cache Dir
if (!defined('_CACHE')) define('ROKSPROCKET_CACHE', WP_CONTENT_DIR . '/cache');
if (!defined('ROKSPROCKET_BASE_DIR')) define('ROKSPROCKET_BASE_DIR', dirname(__FILE__));
if (!defined('ROKSPROCKET_ASSETS_DIR')) define('ROKSPROCKET_ASSETS_DIR', ROKSPROCKET_BASE_DIR . '/admin/assets');


RokCommon_Composite::addPackagePath('roksprocket_providers', $container['roksprocket.providers.path']);
$platform          = RokCommon_PlatformFactory::getCurrent();
$starting_priority = 19;
foreach ($platform->getLoaderChecks() as $platform_check) {
	$platform_path = $container['roksprocket.providers.platforms_path'] . '/' . $platform_check;
	if (is_dir($platform_path)) {
		RokCommon_Composite::addPackagePath('roksprocket_providers', $platform_path, $starting_priority--);
	}
}
$context        = RokCommon_Composite::get('roksprocket_providers');
$priority_files = $context->getAllSubFiles($container['roksprocket.providers.file']);
ksort($priority_files, true);
foreach ($priority_files as $priority => $files) {
	foreach ($files as $file) {
		RokCommon_Service::addConfigFile($file);
	}
}


if (!class_exists('RokSprocket_Plugin')) {
	/**
	 *
	 */
	class RokSprocket_Plugin
	{
		/**
		 * @return array
		 */
		public static function get_defaults()
		{
			$defaults = array();
			add_option('roksprocket_plugin_settings', $defaults);
			return $defaults;
		}

		/**
		 * initialize roksprocket plugin
		 */
		public static function init()
		{
			if (defined('ROKSPROCKET_ERROR_MISSING_LIBS') && ROKSPROCKET_ERROR_MISSING_LIBS == true) return;
			//if rokcommon isn't installed and/or activated we deactivate roksprocket
			if (!rs_rokcommon_check()) {
				return;
			}

			//register plugin settings
			register_setting('roksprocket_settings_group', 'roksprocket_plugin_settings');

			//load translator
			$container = RokCommon_Service::getContainer();
			if ($container->hasParameter('roksprocket.template.override.path')) {
				rs_load_plugin_textdomain('wp_roksprocket', ROKSPROCKET_PLUGIN_PATH . '/languages');

				/** @var $i18n RokCommon_I18N_Wordpress */
				$i18n = $container->i18n;
				$i18n->addDomain('wp_roksprocket');
				self::cleanupProviders();
			}


		}

		public static function edit_controller()
		{
			$container = RokCommon_Service::getContainer();
			/** @var $view RokSprocket_Views_Edit_View */
			$view = $container->getService('roksprocket-edit.view');
			$id   = (int)RokSprocket_Request::getInt('id', 0);
			if ($id !== 0) {
				if (RokCommon_Session::get('roksprocket.' . $id, false)){
                   RokCommon_Session::clear('roksprocket.' . $id);
                }
				/** @var $model RokSprocket_Model_Edit */
				$model = $container->getService('roksprocket.edit.model');
				$item  = $model->get($id);
				$view->setData($item);
				$articles          = $model->getArticles($id, $item->getParams());
				$view->articles    = $articles;
				$view->perItemForm = $model->getPerItemsForm($item->getParams()->get('layout'));
			} else {
				$provider_service = $container['roksprocket.providers.registered.wordpress.service'];
				$provider         = $container->$provider_service;
				$container->setParameter('roksprocket.current_provider', $provider);
			}
		}

		public static function renderHeader()
		{
			if (defined('ROKSPROCKET_ERROR_MISSING_LIBS') && ROKSPROCKET_ERROR_MISSING_LIBS == true) return;
			//we need these on all roksprocket admin pages
			$page      = $_REQUEST['page'];
			$container = RokCommon_Service::getContainer();
			$container->hasService($page . '.view');
			if (is_admin() && $container->hasService($page . '.view')) {
				/** @var $view RokSprocket_Views_IView */
				$view = $container->getService($page . '.view');
				$view->initialize();
				$view->renderHeader();
			}
		}

		public static function renderInlines()
		{
			if (defined('ROKSPROCKET_ERROR_MISSING_LIBS') && ROKSPROCKET_ERROR_MISSING_LIBS == true) return;
			//we need these on all roksprocket admin pages
			$page      = $_REQUEST['page'];
			$container = RokCommon_Service::getContainer();
			$container->hasService($page . '.view');
			if (is_admin() && $container->hasService($page . '.view')) {
				/** @var $view RokSprocket_Views_IView */
				$view = $container->getService($page . '.view');
				$view->renderInlines();
			}
		}


		/**
		 * add roksprocket admin menu
		 */
		public static function admin_menu()
		{
			global $submenu;

			if (defined('ROKSPROCKET_ERROR_MISSING_LIBS') && ROKSPROCKET_ERROR_MISSING_LIBS == true) return;
			//if rokcommon and rokgallery isn't installed and activated we don't show menu
			if (!rs_rokcommon_check() || !rs_roksprocket_check()) {
				return;
			}

			add_menu_page( 'RokSprocket Administration', 'RokSprocket', 'manage_options', 'roksprocket-list', array( 'RokSprocket_Plugin', 'renderView' ), ROKSPROCKET_PLUGIN_URL . '/admin/assets/images/roksprocket_16x16.png' );

			add_submenu_page( null, 'RokSprocket Edit Widget', 'RokSprocket Edit Widget', 'manage_options', 'roksprocket-edit', array( 'RokSprocket_Plugin', 'renderView' ) );

			add_submenu_page( 'roksprocket-list', 'Add New', 'Add New', 'manage_options', 'roksprocket-edit', array( 'RokSprocket_Plugin', 'renderView' ) );

			$submenu['roksprocket-list'][0][0] = 'All Items';
		}

		/**
		 * render roksprocket plugin default view
		 */
		public static function renderView()
		{
			if (defined('ROKSPROCKET_ERROR_MISSING_LIBS') && ROKSPROCKET_ERROR_MISSING_LIBS == true) return;
			$page      = $_REQUEST['page'];
			$container = RokCommon_Service::getContainer();
			$container->hasService($page . '.view');
			if (is_admin() && $container->hasService($page . '.view')) {
				/** @var $view RokSprocket_Views_IView */
				$view = $container->getService($page . '.view');
				$view->render();
			}
		}

		protected static function cleanupProviders()
		{
			$container   = RokCommon_Service::getContainer();
			$paramsclass = $container['roksprocket.providers.registered'];
			$params      = get_object_vars($paramsclass);
			ksort($params);

			$registered = new stdClass();
			foreach ($params as $provider_id => $provider_info) {
				/** @var $provider RokSprocket_IProvider */
				$provider_class = $container[sprintf('roksprocket.providers.registered.%s.class', $provider_id)];
				$available      = call_user_func(array($provider_class, 'isAvailable'));
				if ($available) {
					$registered->$provider_id = $provider_info;
				}
			}
			$container->setParameter('roksprocket.providers.registered', $registered);
		}

		function roksprocket_admin_bar()
		{
			global $wp_admin_bar;
			if (!is_super_admin() || !is_admin_bar_showing()) return;

			$nonce = wp_create_nonce('roksprocket-ajax-nonce');
			$args  = array(
				'id'     => 'roksprocket-admin',
				'parent' => 'new-content',
				'title'  => __('RokSprocket'),
				'href'   => site_url() . '/wp-admin/admin.php?page=roksprocket-edit&id=0&nonce=' . $nonce,
			);

			/* Add the main siteadmin menu item */
			$wp_admin_bar->add_node($args);
		}
	}
}

if (!function_exists('roksprocket_activate')) {
	/**
	 * function runs on plugin initial activation
	 */
	function roksprocket_activate()
	{
		if (!rs_rokcommon_check()) {
			return;
		}

		$include_file   = ROKSPROCKET_PLUGIN_PATH . '/lib/requirements.php';
		$included_files = get_included_files();
		if (!in_array($include_file, $included_files) && ($loaderrors = include($include_file)) !== true) {
			roksprocket_set_admin_message('error', __('<strong>Your server doesn\'t meet RokSprocket requirements :</strong><br/><br/>') . implode("<br/>", $loaderrors));
		}

		$file = ROKSPROCKET_PLUGIN_PATH . '/install/install.mysql.utf8.sql';

		$result = roksprocket_run_sql($file);

		if ($result['complete']) {
			roksprocket_set_admin_message('updated', __('RokSprocket database installation <strong>Successful!</strong>'));
		}
		if (!empty($result['errors'])) {
			roksprocket_set_admin_message('error', __('RokSprocket database installation encountered errors:<br/>' . implode("<br/>", $result['errors'])));
		}

		$container_configs = get_site_option('rokcommon_configs', array());
		if (!array_key_exists('roksprocket_container', $container_configs) || !array_key_exists('roksprocket_library', $container_configs)) {
			$container_config                           = array();
			$container_config['file']                   = 'wp-content/plugins' . ROKSPROCKET_PLUGIN_REL_PATH . '/container.xml';
			$container_config['extension']              = 'roksprocket';
			$container_config['priority']               = 10;
			$container_config['type']                   = 'container';
			$container_configs['roksprocket_container'] = $container_config;

			$library_config                           = array();
			$library_config['file']                   = 'wp-content/plugins' . ROKSPROCKET_PLUGIN_REL_PATH . '/lib';
			$library_config['extension']              = 'roksprocket';
			$library_config['priority']               = 10;
			$library_config['type']                   = 'library';
			$container_configs['roksprocket_library'] = $library_config;
			update_site_option('rokcommon_configs', $container_configs);
		}

		//RokSprocket_Widgets_RokSprocket::get_defaults(); //set widget defaults in db
	}
}

if (!function_exists('roksprocket_uninstall')) {
	/**
	 * function runs on plugin uninstall
	 */
	function roksprocket_uninstall()
	{
		global $wpdb;
		$isNetwork   = (isset($_SERVER['SCRIPT_NAME']) && strpos($_SERVER['SCRIPT_NAME'], 'network') !== false) ? true : false;
		$isUninstall = (isset($_POST['action']) && $_POST['action'] == 'delete-selected') ? true : false;

		$file = ROKSPROCKET_PLUGIN_URL . '/install/uninstall.mysql.utf8.sql';

		$result = roksprocket_run_sql($file);

		if ($result[0]) {
			roksprocket_set_admin_message('updated', __('Removal of RokSprocket database tables was <strong>Successful!</strong>'));
		}

		if ((is_multisite() && $isNetwork && $isUninstall) || (!is_multisite())) {
			delete_site_option('roksprocket_plugin_settings');
			delete_site_option('widget_roksprocket_options');
		}

		$container_configs = get_site_option('rokcommon_configs', array());
		if (array_key_exists('roksprocket_container', $container_configs) || array_key_exists('roksprocket_library', $container_configs)) {
			unset($container_configs['roksprocket_container']);
			unset($container_configs['roksprocket_library']);
			update_site_option('rokcommon_configs', $container_configs);
		}
	}
}

if (!function_exists('roksprocket_run_sql')) {
	/**
	 * @param string $file
	 *
	 * @return bool
	 */
	function roksprocket_run_sql($file)
	{
		global $wpdb;
		$isNetwork    = (isset($_SERVER['SCRIPT_NAME']) && strpos($_SERVER['SCRIPT_NAME'], 'network') !== false) ? true : false;
		$isActivation = (isset($_GET['action']) && $_GET['action'] == 'activate') ? true : false;

		$complete = true;
		$sql      = file($file);

		$new_sql = '';
		foreach ($sql as $sql_line) {
			if (trim($sql_line) != "" && strpos($sql_line, "--") === false) {
				$new_sql .= $sql_line;
			}
		}
		$queries = explode(';', $new_sql);

		$new_queries = array();
		//multisite queries
		if (is_multisite() && $isNetwork && $isActivation) {
			$old_blog = $wpdb->blogid;
			$blog_ids = $wpdb->get_col('SELECT blog_id FROM ' . $wpdb->blogs);
			foreach ($blog_ids as $blog_id) {

				switch_to_blog($blog_id);
				foreach ($queries as $query) {
					$query = str_replace('#__', $wpdb->prefix, $query); //add wp db prefix + blog id

					if (trim($query) != "" && strpos($query, "--") === false) {
						$new_queries[] = trim($query); //trim again
					}
				}
			}
			//go back to blog we started with
			switch_to_blog($old_blog);

		} else {
			foreach ($queries as $query) {
				//run main query
				$query = str_replace('#__', $wpdb->prefix, $query); //add wp db prefix
				if (trim($query) != "" && strpos($query, "--") === false) {
					$new_queries[] = trim($query); //trim again
				}
			}
		}

		$errors             = array();
		$failed_queries     = array();
		$successful_queries = array();
		foreach ($new_queries as $sql) {
			if ($wpdb->query($sql) === false) {
				$failed_queries[] = $wpdb->last_query;
				$errors[]         = $wpdb->last_error;
				$complete         = false;
			} elseif ($wpdb->query($sql) === 0) {
				$successful_queries[] = $wpdb->last_query;
			} else {
				$successful_queries[] = $wpdb->last_query;
			}
		}

		return array(
			'complete'           => $complete,
			'errors'             => $errors,
			'failed_queries'     => $failed_queries,
			'successful_queries' => $successful_queries
		);
	}
}

if (!function_exists('roksprocket_mootools_remove')) {
	/*
	* removes other instances of mootools
	*/
	function roksprocket_mootools_remove()
	{
		global $wp_scripts, $pagenow, $gantry, $wp;
		$page      = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : '';
		$post_type = (isset($wp->query_vars['post_type'])) ? $wp->query_vars['post_type'] : (isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : '');

		//if rokcommon isn't installed and/or activated we deactivate roksprocket
		if (!rs_rokcommon_check()) return;

		//only strip mootools when needed and only in widget page if gantry is not present
		if ((is_admin() && $pagenow == 'widgets.php' && !$gantry) || (is_admin() && $pagenow == 'admin-ajax.php') || (is_admin() && $page == 'roksprocket-list') || (is_admin() && $page == 'roksprocket-edit') || (!is_admin())
		) {
			foreach ($wp_scripts->registered as $script) {
				if ((strpos($script->handle, 'mootools') !== false && strpos($script->handle, 'rok_') === false) || (strpos($script->content_url, 'mootools') !== false && strpos($script->handle, 'rs_') === false)) {
					wp_deregister_script($script->handle);
				}
			}
			foreach ($wp_scripts->queue as $script) {
				if (strpos($script, 'mootools') !== false && strpos($script, 'rok_') === false) {
					wp_dequeue_script($script);
				}
			}
		}
	}
}

if (!function_exists('roksprocket_mootools_init')) {
	/**
	 * adds roksprocket mootools
	 */
	function roksprocket_mootools_init()
	{
		if (defined('ROKSPROCKET_ERROR_MISSING_LIBS') && ROKSPROCKET_ERROR_MISSING_LIBS == true) return;
		global $pagenow, $typenow, $gantry, $wp;
		$page      = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : '';
		$post_type = (isset($wp->query_vars['post_type'])) ? $wp->query_vars['post_type'] : (isset($_REQUEST['post_type']) ? $_REQUEST['post_type'] : '');
		if (empty($typenow) && !empty($_GET['post'])) {
			$post    = get_post($_GET['post']);
			$typenow = $post->post_type;
		}
		//if rokcommon isn't installed and/or activated we deactivate roksprocket
		if (!rs_rokcommon_check()) return;

		//only load mootools when needed and only in widget page if gantry is not present
		if ((is_admin() && $pagenow == 'widgets.php' && !$gantry) || (is_admin() && $pagenow == 'admin-ajax.php') || (is_admin() && $page == 'roksprocket-list') || (is_admin() && $page == 'roksprocket-edit') || (is_admin() && ($pagenow == 'post.php' || $pagenow == 'post-new.php'))) {
			RokCommon_Header::addScript(RokCommon_Composite::get('rs_assets.js')->getURL('mootools.js'));
		} else if (!is_admin()) {
			RokCommon_Header::addScript(RokCommon_Composite::get('rs_assets.js')->getURL('mootools.js'));
		}
	}
}

add_action('admin_init', array('RokSprocket_Plugin', 'init'));
add_action('admin_menu', array('RokSprocket_Plugin', 'admin_menu'));

add_action('admin_init', 'roksprocket_mootools_remove', 9999);
add_action('admin_init', 'roksprocket_mootools_init', -50);
add_action('init', 'roksprocket_mootools_remove', 9999);
add_action('init', 'roksprocket_mootools_init', -50);

register_activation_hook(ROKSPROCKET_PLUGIN_FILE, 'roksprocket_activate');
register_uninstall_hook(ROKSPROCKET_PLUGIN_FILE, 'roksprocket_uninstall');

add_action('admin_enqueue_scripts', 'roksprocket_mootools_remove', 9999);
add_action('admin_enqueue_scripts', array('RokSprocket_Plugin', 'renderHeader'));
add_action('admin_head', array('RokSprocket_Plugin', 'renderInlines'));
add_action('load-admin_page_roksprocket-edit', array('RokSprocket_Plugin', 'edit_controller'));
add_action('admin_bar_menu', array('RokSprocket_Plugin', 'roksprocket_admin_bar'), 1000);
