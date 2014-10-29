<?php
/**
 * @version   $Id: window.php 21622 2014-06-19 11:16:14Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

if (!defined('ABSPATH')) die('You are not allowed to call this page directly.');

global $wpdb, $RokSprocket_plugin_url, $RokSprocket_plugin_path;
@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	    <title>RokSprocket</title>
	    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>"/>
		<?php
		wp_head();
		if ($inlinescript) {
			RokCommon_Header::addInlineScript($inlinescript);
		}
		if ($inlinestyle) {
			RokCommon_Header::addInlineStyle($inlinestyle);
		}
		?>
	    <base target="_self"/>
	</head>
	<body class="rs-content-chooser wp-core-ui">
		<?php echo $content; ?>
		<?php wp_footer(); ?>
	</body>
</html>