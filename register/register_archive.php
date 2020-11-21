<?php


add_filter( 'archive_template', 'override_archive_template' );

function override_archive_template( $archive_template ){
   
    $file = plugin_dir_path( __FILE__ ) .'../archive-autos.php';
  
    if( file_exists( $file ) ) $archive_template = $file;

    return $archive_template;
}



?>