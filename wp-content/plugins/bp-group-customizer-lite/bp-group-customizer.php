<?php
/**
 * Plugin Name: BP Group Cutomizer Lite
 * Plugin URI: http://buddydev.com/plugins/bp-group-customizer-lite/
 * Author: Brajesh Singh
 * Author URI: http://buddydev.com/members/sbrajesh/
 * Description: Allows you to customize/change the background of BuddyPress Groups
 * Version:1.0
 * License: GPL
 * Last Updated: September 3, 2012
 * 
 */



class BP_Group_Customizer_Lite_Helper{
    private static $instance;
    

    private function __construct() {
        //print css 
        add_action('wp_print_styles',array($this,'inject_css'));
        add_action('wp_print_scripts',array($this,'inject_js'));
        //modify body class to account for single group,since bp overwrites wp body classes,we need to hook to bp
        add_filter('bp_get_the_body_class',array($this,'get_body_class'));
        //load group extension
        add_action('bp_init',array($this,'load_extension'));
         //load textdomain
        add_action ( 'bp_loaded', array($this,'load_textdomain'), 2 );
        //ajax
        add_action('wp_ajax_bpgclite_del_image',array($this,'ajax_delete_image'));
    }   

    /**
     * Get singleton instance
     * @return self instance
     */
    public static function get_instance(){
        if(!isset (self::$instance))
                self::$instance=new self();
        return self::$instance;
    }
    
    //load grpoup extension
    function load_extension(){
        if(bp_is_active('groups'))
            include_once(plugin_dir_path(__FILE__).'bp-customizer-extension.php');
    }
        //translation
    function load_textdomain(){

        $locale = apply_filters( 'bp_group_customizer_lite_get_locale', get_locale() );

            // if load .mo file
        if ( !empty( $locale ) ) {
                    $mofile_default = sprintf( '%slanguages/%s.mo', plugin_dir_path(__FILE__), $locale );

                    $mofile = apply_filters( 'bp_group_customizer_lite_load_textdomain_mofile', $mofile_default );

                    if ( file_exists( $mofile ) ) {
                        // make sure file exists, and load it
                            load_textdomain( 'group-customizer-lite', $mofile );
                    }
            } 

    }

    //inject css in page header
    function inject_css(){
        $group_id=bp_get_current_group_id();
        if(empty($group_id))
            return;
        $image=bgclite_get_image($group_id);
        
        if(empty($image)||  apply_filters('bp_group_customizer_iwilldo_it_myself',false))
           return;
        ?>
        <style type="text/css">
            body.is-single-group{
                background:url(<?php echo $image;?>) center top fixed no-repeat,url("http://sill-web.de/gzc/wp-content/themes/yoo_master2_wp/css/navy_blue.png") repeat;
            }
        </style>  
        <?php

    }
    //inject js if I am viewing the group/admin/appearances tab
    function inject_js(){
        global $bp;
        if(bp_is_group()&&bp_is_group_admin_page()&& $bp->action_variables[0]=='appearances')
            wp_enqueue_script ('bpgclite-js',plugin_dir_url(__FILE__).'js/group-customizer-lite.js',array('jquery'));
    }
    
    
    //inject custom class on body element for single group pages

    function get_body_class($classes){
        $group=groups_get_current_group();
       
        if(!empty($group))
           $classes[]='is-single-group';

    return $classes;


    }
    /**
     * does this group already has some image attached
     * @param type $group_id
     * @return type 
     */
    function had_background($group_id){
            
            $attachment=groups_get_groupmeta($group_id,'background_attachment');
            if(!empty($attachment))
                return true;
            return false;
            
    }
    /**
     * Delete attachment and clean the files
     * @param type $group_id
     * @return type 
     */ 
    function delete_background($group_id){
            
             $attachment=groups_get_groupmeta($group_id,'background_attachment');
             if(empty($attachment))
                 return false;
             
             wp_delete_attachment( $attachment, true );
            
    }
    /**
     * Delete via ajax
     */
    
    function ajax_delete_image(){
        
    //validate nonce
    if(!wp_verify_nonce($_POST['_wpnonce'],'groups_edit_save_appearances'))
            die('what!');
    $group=bp_get_current_group_id();
    self::delete_background($group);
     $message='<p>'.__('Background image deleted successfully!','group-customizer-lite').'</p>';//feedback but we don't do anything with it yet, should we do something
     echo $message;
             exit(0); 

    }
}//end of class
//
/**
 *
 * @param type $group_id
 * @param type $type
 * @return string, the absolute url of the uploaded image
 */
function bgclite_get_image($group_id=false,$type='full'){
    if(empty($group_id))
        $group_id=bp_get_current_group_id ();
    
        $attachment_id=bgclite_get_attachment_id($group_id);
        $image=wp_get_attachment_image_src($attachment_id,$type);
        if(!empty($image))
            return  $image[0];
        return false;
    
}/**
 *
 * @param type $group_id
 * @return int : the attachment id
 */
function bgclite_get_attachment_id($group_id=false){
    if(empty($group_id))
        $group_id=bp_get_current_group_id ();
    
        $attachment_id=groups_get_groupmeta($group_id, 'background_attachment');
       return $attachment_id;
    
}
//instantiate helper
BP_Group_Customizer_Lite_Helper::get_instance();
/**
 *
 * @return BP_Group_Customizer_Lite_Helper 
 */
function bgclite_get_helper(){
    
    return BP_Group_Customizer_Lite_Helper::get_instance();
}
?>
