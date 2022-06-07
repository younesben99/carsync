<?php


function dds_car($postid){

    $meta = get_post_meta($postid);



    foreach($meta as $key => $val){

        $meta[$key] = $val[0];

    }



    return $meta;

}


?>
