<?php

function merk_model_cf_check(){

    
$args = array(
    'post_type'        => 'autos',
    'posts_per_page'   => -1,
    'order'            => 'ASC'
);
$cars = get_posts( $args );


foreach ($cars as $key => $value) {

    $_car_id = $value->ID;
    $_car_merkcf_key = get_post_meta($value->ID,"_car_merkcf_key",true);
    $_car_modelcf_key = get_post_meta($value->ID,"_car_modelcf_key",true);
  
     $allemerken = get_terms( array(
        'taxonomy' => 'merkenmodel',
        'hide_empty' => false,
        'parent' => 0
    ) );
    


    $term_list_merk = wp_get_post_terms( $value->ID, 'merkenmodel', array( 'fields' => 'names','parent' => 0 ));
    $term_list_merk_ids = wp_get_post_terms( $value->ID, 'merkenmodel', array( 'fields' => 'ids','parent' => 0 ));	
    $merkophalen;
    $modelophalen;
    foreach($term_list_merk_ids as $term_id){
        $termid=$term_id;
    }	
    $term_list_model = wp_get_post_terms( $value->ID, 'merkenmodel', array( 'fields' => 'names','parent' => $termid ));
    
    foreach($term_list_merk as $term){
        $merkophalen = $term;
        
    }
    
    foreach($term_list_model as $term){
        $modelophalen = $term;
        
    }
    update_post_meta( $value->ID,"_car_merkcf_key", $merkophalen );
    update_post_meta( $value->ID,"_car_modelcf_key", $modelophalen );
//     if(empty($_car_merkcf_key)){

// if(!empty($merkophalen)){
//    
// }
// if(!empty($modelophalen)){
//    
// }


//     }
    

}



}




?>
