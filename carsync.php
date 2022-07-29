<?php

/*
Plugin Name: Digiflow Carsync
Plugin URI: https://github.com/younesben99/carsync
Description: A plugin that syncs autoscout24 cars with wordpress posts.
Version: 8.6.13
Author: Younes Benkheil
Author URI: https://digiflow.be/
License: GPL2
GitHub Plugin URI: https://github.com/younesben99/carsync
*/

require_once( __DIR__ . '/register/register_cpt.php');
require_once( __DIR__ . '/register/register_metaboxes.php');
require_once(__DIR__ . '/register/register_global_vars.php');
require_once(__DIR__ . '/register/register_popup.php');


include_once( __DIR__ . '/templates/archive/template_card.php');
require_once( __DIR__ . '/register/register_archive.php');


require_once( __DIR__ . '/register/register_single.php');
require_once( __DIR__ . '/sync/carsync_image_handler.php');
require_once( __DIR__ . '/register/register_cron_job.php');
require_once( __DIR__ . '/register/register_zapier.php');
require_once( __DIR__ . '/sync/carsync_data_ophalen.php');
require_once( __DIR__ . '/sync/create_post_by_uniq_id.php');
include_once( __DIR__ . '/register/register_admin_toolbar_links.php');
include_once( __DIR__ . '/register/register_compare.php');
include_once( __DIR__ . '/register/register_single_car_page.php');
include_once( __DIR__ . '/register/register_archive_car_page.php');
include_once( __DIR__ . '/register/register_rel_cars.php');
include(__DIR__."/templates/template_og_tags.php");


//carfeeds
require_once( __DIR__ . '/feed/facebook_feed_aanmaken.php');
require_once( __DIR__ . '/register/register_cron_job.php');
require_once( __DIR__ . '/socialpush/social_metaboxes.php');




function dds_echo($var,$suffix = ""){

  
    if(!empty($var) && !is_array($var)){
        echo($var. " ".$suffix);
    }
    else{
        echo("-");
    }

}

function socialpush_scripts( $hook ) {

    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'autos' === $post->post_type ) {     
            wp_enqueue_style('socialpushcss', plugin_dir_url( __FILE__ ).'/socialpush/css/socialpush.css');
            wp_enqueue_script(  'socialpushjs', plugin_dir_url( __FILE__ ).'/socialpush/js/socialpush.js' );
        }
       
    }
  }
  add_action( 'admin_enqueue_scripts', 'socialpush_scripts', 10, 1 );
  function strip_html_tags( $text )
  {
      $text = preg_replace(
          array(
            // Remove invisible content
              '@<head[^>]*?>.*?</head>@siu',
              '@<style[^>]*?>.*?</style>@siu',
              '@<script[^>]*?.*?</script>@siu',
              '@<object[^>]*?.*?</object>@siu',
              '@<embed[^>]*?.*?</embed>@siu',
              '@<applet[^>]*?.*?</applet>@siu',
              '@<noframes[^>]*?.*?</noframes>@siu',
              '@<noscript[^>]*?.*?</noscript>@siu',
              '@<noembed[^>]*?.*?</noembed>@siu',
            // Add line breaks before and after blocks
              '@</?((address)|(blockquote)|(center)|(del))@iu',
              '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
              '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
              '@</?((table)|(th)|(td)|(caption))@iu',
              '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
              '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
              '@</?((frameset)|(frame)|(iframe))@iu',
          ),
          array(
              ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
              "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
              "\n\$0", "\n\$0",
          ),
          $text );
      return strip_tags( $text );
  }
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
            wp_enqueue_script(  'autos-cpt-js', plugin_dir_url( __FILE__ ).'/js/post-edit-page.js','',uniqid() );
            wp_enqueue_script( 'select2js','https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array(), '1.0' );
            wp_register_style( 'select2css', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css', false, '1.0.0' );
            wp_enqueue_style( 'select2css' );
            wp_enqueue_script(  'autos-data-ophalen-js', plugin_dir_url( __FILE__ ).'/js/external-data-ophalen.js','',uniqid());
        }
       
    }
    
}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );





add_action( 'wp_head', 'single_archive_scripts',1 );

function single_archive_scripts(){
  wp_enqueue_script(  "splide", "https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js" );


  wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css'); 
 
  if(get_post_type( get_the_ID() == "autos")){
    wp_register_style( 'select2css', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css', false, '1.0.0' );
    wp_enqueue_style( 'select2css' );
    wp_enqueue_script( 'select2js','https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array(), '1.0' );   

    if(!is_single()){
      wp_enqueue_script(  'isotope', "https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" );
    wp_enqueue_style('archive_main', plugin_dir_url( __FILE__ ).'/assets/css/archive_main.css',"",uniqid()); 
    wp_enqueue_style('archive_filter', plugin_dir_url( __FILE__ ).'/assets/css/archive_filter.css',"",uniqid());
    wp_enqueue_style('archive_grid', plugin_dir_url( __FILE__ ).'/assets/css/archive_grid.css',"",uniqid());
    wp_enqueue_script(  'archive_grid', plugin_dir_url( __FILE__ ).'/assets/js/archive_grid.js',"",uniqid());
    }
    else{
      wp_enqueue_script(  "jquery", "https://code.jquery.com/jquery-3.5.1.js" );
      wp_enqueue_script(  "feather", "https://unpkg.com/feather-icons" );
      wp_enqueue_script(  "cookies", "https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js" );
      wp_enqueue_style('sp_single',  plugin_dir_url( __FILE__ ).'/assets/css/sp_single.css'."?v=". uniqid()); 
    }
   
    wp_enqueue_script( 'main_dds', plugin_dir_url( __FILE__ ).'/assets/js/dds_main.js',"",uniqid());   
    

  }
  
  
}
function single_archive_scripts_footer(){


  if(get_post_type( get_the_ID() == "autos")){
 
    if(is_single()){
    
      wp_enqueue_script("spsingle",plugin_dir_url( __FILE__ ).'/assets/js/sp_single.js',"",uniqid());
      wp_enqueue_script("spcontact",plugin_dir_url( __FILE__ ).'/assets/js/sp_contact.js',"",uniqid());
      wp_enqueue_script("sptestrit",plugin_dir_url( __FILE__ ).'/assets/js/sp_testrit.js',"",uniqid());

    }

    

  }
  
  
}
add_action('wp_footer', 'single_archive_scripts_footer', 1);



// disable gutenberg & comments
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10); 


//script op elke pagina welkom

wp_enqueue_script(  'dds_popup', plugin_dir_url( __FILE__ ).'/assets/js/dds_popup.js' ,array ( 'jquery' ),uniqid());
wp_enqueue_style('dds_popup', plugin_dir_url( __FILE__ ).'/assets/css/dds_popup.css','',uniqid());



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

if(!function_exists("get_string_between")){
  function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
    }
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


function is_edit_page($new_edit = null){
    global $pagenow;
   
    if (!is_admin()) return false;

    
    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") 
        return in_array( $pagenow, array( 'post-new.php' ) );
    else 
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

function array_flatten($array, $prefix = ''){
    $return = [];
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $return = array_merge($return, array_flatten($value, $prefix . $key . '_'));
        } else {
            $return[$prefix . $key] = $value;
        }
    }
    return $return;
}
function merken_ophalen(){

    try {
      $mysqli = new mysqli("35.214.232.1", "uchrx69hijxdg", "1B%b13($21jn", "dbtpzhh0ozmbi4",3306);
      $mysqli->select_db("dbtpzhh0ozmbi4") or die( "Unable to select database");
      
      // Check connection
      if ($mysqli->connect_error) {
          die("Connection failed: " . $mysqli->connect_error);
      }
      
      
    
      
      
      $sql = "SELECT * FROM Merken";
      $result = $mysqli->query($sql);
    
      $merken_array = [];
      if ($result->num_rows > 0) {
       
        while($row = $result->fetch_assoc()) {
          array_push($merken_array,["merkid" => $row["merkid"],"merk" => $row["merk"]]);
        }
      }
    
      $merken_json = json_encode($merken_array);
      
    
      
      
      
      $mysqli->close();
  
      return($merken_json);
    } catch (\Throwable $th) {
        //throw $th;
    }
    
  }

  function modellen_ophalen(){

    try {
      $mysqli = new mysqli("35.214.232.1", "uchrx69hijxdg", "1B%b13($21jn", "dbtpzhh0ozmbi4",3306);
      $mysqli->select_db("dbtpzhh0ozmbi4") or die( "Unable to select database");
      
      // Check connection
      if ($mysqli->connect_error) {
          die("Connection failed: " . $mysqli->connect_error);
      }
      
      
    
      
      
      $sql = "SELECT * FROM Modellen";
      $result = $mysqli->query($sql);
    
      $modellen_array = [];
      if ($result->num_rows > 0) {
       
        while($row = $result->fetch_assoc()) {
          array_push($modellen_array,["merkid" => $row["merkid"],"model" => $row["model"],"modelid" => $row["modelid"]]);
        }
      }
    
      $modellen_json = json_encode($modellen_array);
      
    
      
      
      
      $mysqli->close();
  
      return($modellen_json);
    } catch (\Throwable $th) {
        //throw $th;
    }
    
  }


  function dds_thumbnail($id){

    
    $carsync_images = get_post_meta($id, '_car_syncimages_key', true);
    $manual_images = get_post_meta($id, 'vdw_gallery_id', true);
    if(empty($manual_images) && empty($carsync_images)){

      $selected_img = "https://digiflowroot.be/static/images/camera_image.jpg";
    } 
    else{
      if($manual_images == null){
        $selected_img = $carsync_images[0];
    }
    else{
      if ($manual_images[0] !== 1) {
          $selected_img_url = wp_get_attachment_image_src($manual_images[0], 'medium');
          $selected_img = $selected_img_url[0];
      }else{
        $selected_img = "https://digiflowroot.be/static/images/camera_image.jpg";
      }
    }
    }
    
    return $selected_img;

  }

  function getClosest($search, $arr,$round) {
    $closest = null;
    $search = $round * ceil($search / $round);

    foreach ($arr as $item) {
       if ($closest === null || abs($search - $closest) > abs($item - $search)) {
          $closest = $item;
       }
    }
    return $closest;
 }

?>