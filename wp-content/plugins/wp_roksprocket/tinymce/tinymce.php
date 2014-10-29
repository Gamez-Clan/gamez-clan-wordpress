<?php
/**
 * @version $Id: tinymce.php 20724 2014-04-30 10:25:59Z jakub $
 * @author RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_TinyMCE
{

    /**
     * @var string
     */
    var $pluginname = 'RokSprocket';
    /**
     * @var string
     */
    var $path = '';
    /**
     * @var int
     */
    var $internalVersion = 200;

    /**
     * Class Constructor
     */
    function __construct()
    {
    }

    /**
     * @return mixed
     */
    function addbuttons()
    {
        if (defined('ROKSPROCKET_ERROR_MISSING_LIBS') && ROKSPROCKET_ERROR_MISSING_LIBS==true) return;
        // Don't bother doing this stuff if the current user lacks permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
            return;

        // Add only in Rich Editor mode
        if (get_user_option('rich_editing') == 'true') {
            add_filter("mce_external_plugins", array('RokSprocket_TinyMCE', "add_tinymce_plugin"));
            add_filter('mce_buttons', array('RokSprocket_TinyMCE', 'register_button'));
        }
    }

    /**
     * @param $buttons
     * @return array
     */
    function register_button($buttons)
    {
        array_push($buttons, "separator", "roksprocket");
        return $buttons;
    }

    // Load the TinyMCE plugin : editor_plugin.js (wp2.5)
    /**
     * @param $plugin_array
     * @return array
     */
    function add_tinymce_plugin($plugin_array)
    {
        $plugin_array['roksprocket'] = ROKSPROCKET_PLUGIN_URL . '/tinymce/editor_plugin.js';
        return $plugin_array;
    }

    /**
     * Call TinyMCE window content via admin-ajax
     * there is no iframe handler in WP so we use ajax
     */
    function roksprocket_tinymce_ajax()
    {
        //        $nonce = RokSprocket_Request::getString('nonce');
        //        if (!wp_verify_nonce($nonce, 'roksprocket-ajax-nonce')) {
        //            return;
        //        }

        if(RokSprocket_Request::getString('type', 'tinymce')=='tinymce') {
            RokCommon_Header::addScript(site_url() . '/wp-includes/js/tinymce/tiny_mce_popup.js');
        }

        //render popup content
        RokCommon_Header::addStyle(ROKSPROCKET_PLUGIN_URL . '/admin/assets/styles/roksprocket.css');
        RokCommon_Header::addStyle('colors');


        ob_start();
        echo RokCommon_Composite::get('rs_tinymce')->load('window.php', array());
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
        // IMPORTANT: don't forget to "exit"
        exit;
    }

    /**
     * Adds RokSprocket QuickTag Buttons
     */
    function roksprocket_quicktags() {
        global $wp_version;

        //add thickbox
        wp_enqueue_script('jquery');
        wp_enqueue_script('quicktags');
        add_thickbox();

        ?>
        <script type ="text/javascript" >
            if ( typeof(QTags) == 'function' ) {

                QTags.addButton('roksprocket', 'roksprocket', '', '');

                // the roksprocket button
	            window.addEvent('domready', function() {
                    if($('qt_content_roksprocket')) {
                        $('qt_content_roksprocket').addEvent('mouseover', function () {
                            if ($('roksprocket_link') == null) {
                                var url = ajaxurl + '?action=roksprocket_tinymce&type=qtags&TB_iframe=true&height=100&width=450&modal=false';
                                var newLinknew = Element('a#roksprocket_link').wraps(this);
                                $('roksprocket_link').setProperty('href', url);
                                $('roksprocket_link').setProperty('class', 'thickbox');
                            }
                        })
                    }
                });
            }
        </script>
        <?php
    }
}

add_action('init', array('RokSprocket_TinyMCE', 'addbuttons'));
add_action('wp_ajax_roksprocket_tinymce', array('RokSprocket_TinyMCE', 'roksprocket_tinymce_ajax'));
add_action('wp_ajax_nopriv_roksprocket_tinymce', array('RokSprocket_TinyMCE', 'roksprocket_tinymce_ajax'));
add_action('admin_print_footer_scripts', array('RokSprocket_TinyMCE', 'roksprocket_quicktags'));
