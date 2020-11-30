<?php
/*
Plugin Name: Digiflow Carsync
Plugin URI: https://github.com/younesben99/carsync
Description: A plugin that syncs autoscout24 cars with wordpress posts.
Version: 0.3.5
Author: Younes Benkheil
Author URI: https://digiflow.be/
License: GPL2
GitHub Plugin URI: https://github.com/younesben99/carsync
*/

require_once( __DIR__ . '/register/register_cpt.php');
require_once( __DIR__ . '/register/register_metaboxes.php');
require_once( __DIR__ . '/register/register_archive.php');
require_once( __DIR__ . '/register/register_single.php');
function add_admin_scripts( $hook ) {

    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'autos' === $post->post_type ) {     
            wp_enqueue_script(  'autos-cpt-js', plugin_dir_url( __FILE__ ).'/js/post-edit-page.js' );
            wp_enqueue_script( 'select2js','https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array(), '1.0' );
            wp_register_style( 'select2css', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css', false, '1.0.0' );
            wp_enqueue_style( 'select2css' );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );
?>
