<?php

/*
Plugin Name: Digiflow Carsync
Plugin URI: https://github.com/younesben99/carsync
Description: A plugin that syncs autoscout24 cars with wordpress posts.
Version: 6.8
Author: Younes Benkheil
Author URI: https://digiflow.be/
License: GPL2
GitHub Plugin URI: https://github.com/younesben99/carsync
*/

require_once( __DIR__ . '/register/register_cpt.php');
require_once( __DIR__ . '/register/register_gallery.php');
require_once( __DIR__ . '/register/register_metaboxes.php');
require_once( __DIR__ . '/register/register_archive.php');
require_once( __DIR__ . '/register/register_single.php');
require_once( __DIR__ . '/register/register_cron_job.php');
require_once( __DIR__ . '/register/register_zapier.php');
require_once( __DIR__ . '/sync/carsync_data_ophalen.php');
require_once( __DIR__ . '/sync/create_post_by_uniq_id.php');
include_once( __DIR__ . '/register/register_admin_toolbar_links.php');
include_once( __DIR__ . '/register/register_compare.php');
include_once( __DIR__ . '/register/register_single_car_page.php');
include(__DIR__."/templates/template_og_tags.php");
/* 


date_default_timezone_set("Europe/Brussels");
setlocale(LC_TIME, 'NL_nl'); 
setlocale(LC_ALL, 'nl_NL'); 
*/


function add_admin_scripts( $hook ) {

    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'autos' === $post->post_type ) {     

            //gallery
            wp_enqueue_script('jquery-ui-core');
	        wp_enqueue_script('jquery-ui-widget');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script(  'gallery-cpt-js', plugin_dir_url( __FILE__ ).'/js/autos-gallery.js' , array('jquery', 'jquery-ui-sortable'));
            wp_enqueue_style('gallery-metabox', plugin_dir_url( __FILE__ ).'/css/autos-gallery.css');
            wp_enqueue_style('editorcss', 'https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.23.0/ui/trumbowyg.min.css');
            if ( ! did_action( 'wp_enqueue_media' ) )
	        	wp_enqueue_media();
            //endgallery
            wp_enqueue_script(  'sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@10.12.3/dist/sweetalert2.all.min.js' );
            wp_enqueue_script(  'editorjs', 'https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.23.0/trumbowyg.min.js' );
            wp_enqueue_script(  'autos-cpt-js', plugin_dir_url( __FILE__ ).'/js/post-edit-page.js?v='. uniqid() );
            wp_enqueue_script( 'select2js','https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array(), '1.0' );
            wp_register_style( 'select2css', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css', false, '1.0.0' );
            wp_enqueue_style( 'select2css' );
            wp_enqueue_script(  'autos-data-ophalen-js', plugin_dir_url( __FILE__ ).'/js/external-data-ophalen.js?v='. uniqid() );
        }
       
    }
}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );
// disable gutenberg & comments
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10); 

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

add_filter('comments_array', '__return_empty_array', 10, 2); 

add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
    }
    
   
function pak_veld($key){
    return get_post_meta(get_the_ID(),$key, TRUE);
}
function pak_veld_id($key,$id){
    return get_post_meta($id,$key, TRUE);
}

function nlDate($datum){ 

    $datum = str_replace("january",     "januari",         $datum); 
     $datum = str_replace("february",     "februari",     $datum); 
    $datum = str_replace("march",         "maart",         $datum); 
     $datum = str_replace("april",         "april",         $datum); 
     $datum = str_replace("may",         "mei",             $datum); 
     $datum = str_replace("june",         "juni",         $datum); 
    $datum = str_replace("july",         "juli",         $datum); 
    $datum = str_replace("august",         "augustus",     $datum); 
     $datum = str_replace("september",     "september",     $datum); 
     $datum = str_replace("october",     "oktober",         $datum); 
     $datum = str_replace("november",     "november",     $datum); 
    $datum = str_replace("december",     "december",     $datum); 

    // Vervang de maand, hoofdletters 
   $datum = str_replace("January",     "Januari",         $datum); 
     $datum = str_replace("February",     "Februari",     $datum); 
    $datum = str_replace("March",         "Maart",         $datum); 
     $datum = str_replace("April",         "April",         $datum); 
     $datum = str_replace("May",         "Mei",             $datum); 
     $datum = str_replace("June",         "Juni",         $datum); 
    $datum = str_replace("July",         "Juli",         $datum); 
    $datum = str_replace("August",         "Augustus",     $datum); 
     $datum = str_replace("September",     "September",     $datum); 
     $datum = str_replace("October",     "Oktober",         $datum); 
     $datum = str_replace("November",     "November",     $datum); 
    $datum = str_replace("December",     "December",     $datum); 

   
     $datum = str_replace("Jan",         "Jan",             $datum); 
     $datum = str_replace("Feb",         "Feb",             $datum); 
     $datum = str_replace("Mar",         "Maa",             $datum); 
     $datum = str_replace("Apr",         "Apr",             $datum); 
     $datum = str_replace("May",         "Mei",             $datum); 
     $datum = str_replace("Jun",         "Jun",             $datum); 
     $datum = str_replace("Jul",         "Jul",             $datum); 
     $datum = str_replace("Aug",         "Aug",             $datum); 
     $datum = str_replace("Sep",         "Sep",             $datum); 
     $datum = str_replace("Oct",         "Ok",             $datum); 
   $datum = str_replace("Nov",         "Nov",             $datum); 
     $datum = str_replace("Dec",         "Dec",             $datum); 

  
   $datum = str_replace("monday",         "maandag",         $datum); 
     $datum = str_replace("tuesday",     "dinsdag",         $datum); 
     $datum = str_replace("wednesday",     "woensdag",     $datum); 
   $datum = str_replace("thursday",     "donderdag",     $datum); 
   $datum = str_replace("friday",         "vrijdag",         $datum); 
     $datum = str_replace("saturday",     "zaterdag",     $datum); 
    $datum = str_replace("sunday",         "zondag",         $datum); 


     $datum = str_replace("Monday",         "Maandag",         $datum); 
     $datum = str_replace("Tuesday",     "Dinsdag",         $datum); 
     $datum = str_replace("Wednesday",     "Woensdag",     $datum); 
   $datum = str_replace("Thursday",     "Donderdag",     $datum); 
   $datum = str_replace("Friday",         "Vrijdag",         $datum); 
     $datum = str_replace("Saturday",     "Zaterdag",     $datum); 
    $datum = str_replace("Sunday",         "Zondag",         $datum); 

     $datum = str_replace("Mon",            "Maa",             $datum); 
     $datum = str_replace("Tue",         "Din",             $datum); 
     $datum = str_replace("Wed",         "Woe",             $datum); 
     $datum = str_replace("Thu",         "Don",             $datum); 
     $datum = str_replace("Fri",         "Vri",             $datum); 
     $datum = str_replace("Sat",         "Zat",             $datum); 
     $datum = str_replace("Sun",         "Zon",             $datum); 

    return $datum; 
}


function vergelijk_pagina_maken()
{
    if (get_page_by_title("Vergelijken") == null) {
        $exists = false;
    
        global $user_ID;
    
        $new_post = array(
              'post_title' => 'Vergelijken',
              'post_content' => '[vergelijken]',
              'post_status' => 'publish',
              'post_author' => $user_ID,
              'post_type' => 'page'
        );
        $post_id = wp_insert_post($new_post);
    }
}
add_action('init','vergelijk_pagina_maken'); 


function mungXML($xml)
{
    $obj = SimpleXML_Load_String($xml);
    if ($obj === FALSE) return $xml;

    // GET NAMESPACES, IF ANY
    $nss = $obj->getNamespaces(TRUE);
    if (empty($nss)) return $xml;

    // CHANGE ns: INTO ns_
    $nsm = array_keys($nss);
    foreach ($nsm as $key)
    {
        // A REGULAR EXPRESSION TO MUNG THE XML
        $rgx
        = '#'               // REGEX DELIMITER
        . '('               // GROUP PATTERN 1
        . '\<'              // LOCATE A LEFT WICKET
        . '/?'              // MAYBE FOLLOWED BY A SLASH
        . preg_quote($key)  // THE NAMESPACE
        . ')'               // END GROUP PATTERN
        . '('               // GROUP PATTERN 2
        . ':{1}'            // A COLON (EXACTLY ONE)
        . ')'               // END GROUP PATTERN
        . '#'               // REGEX DELIMITER
        ;
        // INSERT THE UNDERSCORE INTO THE TAG NAME
        $rep
        = '$1'          // BACKREFERENCE TO GROUP 1
        . '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
        ;
        // PERFORM THE REPLACEMENT
        $xml =  preg_replace($rgx, $rep, $xml);
    }

    return $xml;

} 

?>