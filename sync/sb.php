<?php
include(__DIR__."/../../../../wp-load.php");
//vin als uid gebruiken


$posts = get_posts([
    'post_type' => 'autos',
    'post_status' => 'publish',
    'numberposts' => -1
  ]);


foreach($posts as $post){
  
    $vin = get_post_meta( $post->ID,"_car_vin_key" );

    if(!empty($vin[0])){
      update_post_meta($post->ID,"_car_uniq_key",$vin[0]);
    }
    

}


?>