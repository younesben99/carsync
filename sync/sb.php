<?php

include(__DIR__."/../../../../wp-load.php");
$posts = get_posts([
    'post_type' => 'autos',
    'post_status' => 'publish',
    'numberposts' => -1
  ]);
  foreach($posts as $post){
    $res = get_post_meta($post->ID, '_car_api_images_downloaded', true);
   
    if($res == "YES"){
        echo get_the_title($post->ID) . " " . $res . "<br>" ;
    }
}

?>