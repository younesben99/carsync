<?php


add_filter( 'single_template', 'override_single_template' );

function override_single_template( $single_template ){
   
    $file = dirname(__FILE__) .'/single-autos.php';

    if( file_exists( $file ) ) $single_template = $file;

    return $single_template;
}



?>