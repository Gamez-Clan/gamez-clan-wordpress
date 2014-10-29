<?php
 /**
 * @version   $Id: include.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */


if (!defined('DS')) { define('DS', DIRECTORY_SEPARATOR); }

if (!defined('WORDPRESS_ROKSPROCKET_LIB')) {
	/**
	 * @param RokCommon_Service_Container $container
	 */
	function roksprocket_loadProviders(RokCommon_Service_Container &$container)
	{
		RokCommon_Composite::addPackagePath('roksprocket_providers', $container['roksprocket.providers.path']);
		$context        = RokCommon_Composite::get('roksprocket_providers');
		$priority_files = $context->getAllSubFiles($container['roksprocket.providers.file']);
		foreach ($priority_files as $priority => $files) {
			foreach ($files as $file) {
				RokCommon_Service::addConfigFile($file);
			}
		}
	}

	/**
	 * @param RokCommon_Service_Container $container
	 */
	function roksprocket_loadLayouts(RokCommon_Service_Container &$container)
	{
		/** @var $platforminfo RokCommon_IPlatformInfo */
		$platforminfo = $container->platforminfo;

		RokCommon_Composite::addPackagePath('roksprocket_layouts', ROKSPROCKET_PLUGIN_PATH . '/layouts', 10);
		RokCommon_Composite::addPackagePath('roksprocket_layouts', $container['roksprocket.template.override.path'] . '/layouts', 20);

		$context        = RokCommon_Composite::get('roksprocket_layouts');
		$priority_files = $context->getAllSubFiles('meta.xml');
		ksort($priority_files, true);
		foreach ($priority_files as $priority => $files) {
			foreach ($files as $file) {
				RokCommon_Service::addConfigFile($file);
			}
		}
	}

	function roksprocket_loadAddons(RokCommon_Service_Container &$container)
	{
		foreach ($container['roksprocket.addons'] as $service) {
			$instance = $container->$service;
		}
	}


    /**
     * load rokcommon and roksprocket library
     */
    define('WORDPRESS_ROKSPROCKET_LIB', 'WORDPRESS_ROKSPROCKET_LIB');
    if (!defined('ROKCOMMON_LIB_PATH')){
        define('ROKCOMMON_LIB_PATH', ROKCOMMON_LIB_PATH);
    }

    define('ROKSPROCKET', '2.1.2');

    $include_file = @realpath(realpath(ROKSPROCKET_PLUGIN_PATH . '/lib/include.php'));
    $included_files = get_included_files();
    if (!in_array($include_file, $included_files) && ($loaderrors = require_once($include_file)) !== 'ROKSPROCKET_LIB_INCLUDED') {
        return $loaderrors;
    }

    //if rokcommon isn't installed and/or activated we deactivate roksprocket if roksprocket isn't installed w/ its db we don't allow rokcommon to be called
    if (file_exists(ROKCOMMON_LIB_PATH) && rs_rokcommon_check() && rs_roksprocket_check()) {

        $container = RokCommon_Service::getContainer();
        /** @var $platforminfo RokCommon_PlatformInfo */
        $platforminfo = $container->platforminfo;
	    roksprocket_loadLayouts($container);
	    roksprocket_loadAddons($container);
	    roksprocket_loadProviders($container);
        RokCommon_Composite::addPackagePath('rs_context_path', ROKSPROCKET_PLUGIN_PATH);
        RokCommon_Composite::addPackagePath('rs_views', ROKSPROCKET_PLUGIN_PATH . '/views');
		RokCommon_Composite::addPackagePath('rs_templates', ROKSPROCKET_PLUGIN_PATH . '/templates');
	    RokCommon_Composite::addPackagePath('rs_assets', ROKSPROCKET_PLUGIN_PATH . '/assets');
        RokCommon_Composite::addPackagePath('rs_admin_assets', ROKSPROCKET_PLUGIN_PATH . '/admin/assets');
        RokCommon_Composite::addPackagePath('rs_forms', ROKSPROCKET_PLUGIN_PATH . '/forms');
        RokCommon_Composite::addPackagePath('rs_tinymce', ROKSPROCKET_PLUGIN_PATH . '/tinymce');
    }
}
return 'WORDPRESS_ROKSPROCKET_LIB_INCLUDED';