<?php
/**
 * @version   $Id: window.php 20639 2014-04-27 10:44:47Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

if (!defined('ABSPATH'))
    die('You are not allowed to call this page directly.');

global $wpdb;
//rs_load_class('RokSprocket_Forms_Fields_Widgetpicker');

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	    <title>Choose RokSprocket Item</title>
	    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>"/>
	    <?php wp_head();?>
	    <script type ="text/javascript" >
	        window.addEvent('domready', function () {
	            document.id('rs_shorttag_insert').addEvent('click', function (e) {
	                e.preventDefault();
	                var roksprocket_id = document.id('rs_shorttag_select').getSelected().get('value');
	                if(roksprocket_id=='') {
	                    alert("None Selected! Please Select a RokSprocket Item to Insert!");
	                } else {
	                    var shorttag = '[roksprocket id="' + roksprocket_id + '"]';
	                    var wpActiveEditor = 'content';
	                    if (window.tinyMCE) {
	                        window.tinyMCE.execCommand('mceInsertContent', false, shorttag);
	                    } else if (window.parent.QTags) {
	                        window.parent.QTags.insertContent(shorttag);
	                    }

	                    window.parent.tb_remove();
	                }
	            })
	        });
	    </script>
	    <base target="_self" />
	</head>
	<body id="rs_tinymce_window">
	    <div class="wrap wp-core-ui">
	        <div class="icon32 alignleft" id="icon-roksprocket"></div>
	        <div class="alignleft actions rs_items_dropdown">
	            <?php
	            $instances = RokSprocket_Model_Widgets::getAvailableInstances();
	            $instancesselect = '<select id="rs_shorttag_select">';
	            foreach ($instances as $instance) {
	                $instancesselect .= '<option value="' . $instance['id'] . '">' . ucwords($instance['title']) . '</option>';
	            }
	            $instancesselect .= '</select>';
	            echo $instancesselect;
	            ?>
	        </div>
	        <div  class="actions">
	            <a href="#" id="rs_shorttag_insert" class="button">
	                Insert
	            </a>
	        </div>
		</div>
	</body>
</html>
