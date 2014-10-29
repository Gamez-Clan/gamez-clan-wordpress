<?php
/**
 * @version   $Id: rokcommon.php 10832 2013-05-29 19:32:17Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
/*
Plugin Name: RokCommon Library
Plugin URI: http://www.rockettheme.com
Description: RokCommon is a support library for various RocketTheme plugins and themes
Author: RocketTheme, LLC
Version: 3.1.12
Author URI: http://www.rockettheme.com
License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/
//error_reporting(E_ALL|E_STRICT);
$plugin = 'wp_rokcommon/rokcommon.php';
$rokcommon_plugin_path = WP_PLUGIN_DIR .'/'. dirname($plugin);

if (!defined('ROKCOMMON_LIB_PATH')) define('ROKCOMMON_LIB_PATH', $rokcommon_plugin_path);

$rokcommon_inlcude_path = @realpath(ROKCOMMON_LIB_PATH . '/include.php');
if (file_exists($rokcommon_inlcude_path)) {
    if (!defined('ROKCOMMON_ERROR_MISSING_LIBS')) define('ROKCOMMON_ERROR_MISSING_LIBS', true);
    $included_files = get_included_files();
    if (!in_array($rokcommon_inlcude_path, $included_files) && ($libret = require_once($rokcommon_inlcude_path)) !== 'ROKCOMMON_LIB_INCLUDED') {
        if (!defined('ROKCOMMON_ERROR_MISSING_LIBS')) define('ROKCOMMON_ERROR_MISSING_LIBS', true);
        $errors = $libret;
    } else {
        $ret = true;
    }
} else {
    $errors[] = 'Unable to find the RokCommon library at ' . ROKCOMMON_LIB_PATH;
}


if (defined('ROKCOMMON')) {
    $container = RokCommon_Service::getContainer();
    $logger    = $container->logger;

    $config_entries = get_site_option('rokcommon_configs', array());

    foreach ($config_entries as $config_entry) {
        if ($config_entry['type'] === 'library') {
            $filepath = ABSPATH . $config_entry['file'];
            if (is_dir($filepath)) {
                $logger->debug(rc__('Registering library path %s for %s', $filepath, $config_entry['extension']));
                RokCommon_ClassLoader::addPath($filepath);
            } else {
                $logger->notice(rc__('Directory %s does not exist.  Unable to add to Class Loader ', $filepath));
            }
        }

    }

    foreach ($config_entries as $config_entry) {
        if ($config_entry['type'] === 'container') {
            $filepath = ABSPATH . $config_entry['file'];
            if (is_file($filepath)) {
                $logger->debug(rc__('Loading container config file for %s from %s', $config_entry['extension'], $filepath));
                RokCommon_Service::addConfigFile($filepath);
            } else {
                $logger->notice(rc__('Unable to find registered container config file %s at %s', $config_entry['extension'], $filepath));
            }
        }
    }
}