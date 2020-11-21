<?php
/*
Plugin Name: Digiflow Carsync
Plugin URI: https://github.com/younesben99/carsync
Description: A plugin that syncs autoscout24 cars with wordpress posts.
Version: 0.2.2
Author: Younes Benkheil
Author URI: https://digiflow.be/
License: GPL2
GitHub Plugin URI: https://github.com/younesben99/carsync
*/

require_once( __DIR__ . '/register/register_cpt.php');
require_once( __DIR__ . '/register/register_metaboxes.php');
require_once( __DIR__ . '/register/register_archive.php');
require_once( __DIR__ . '/register/register_single.php');

?>
<?php


add_filter( 'single_template', 'override_single_template' );

function override_single_template( $single_template ){
   
    $file = plugin_dir_path( __FILE__ ) .'../single-autos.php';

    if( file_exists( $file ) ) $single_template = $file;

    return $single_template;
}
function wporg_meta_box_scripts() {
   $screen = get_current_screen();
   if ( is_object( $screen ) ) {
       if ( in_array( $screen->post_type, [ 'post', 'wporg_cpt' ], true ) ) {
           wp_enqueue_script( 'wporg_meta_box_script', plugin_dir_url( __FILE__ ) . 'admin/meta-boxes/js/admin.js', [ 'jquery' ], '1.0.0', true );
           wp_localize_script(
               'wporg_meta_box_script',
               'wporg_meta_box_obj',
               [
                   'url' => admin_url( 'admin-ajax.php' ),
               ]
           );
       } 
   }
}
add_action( 'admin_enqueue_scripts', 'wporg_meta_box_scripts' );
add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    if( !current_user_can( 'edit_post' ) ) return;
}

?>
