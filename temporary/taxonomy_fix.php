<?php
    function add_merk_model_fields($id){
        $merk = get_post_meta($id,"_car_merkcf_key",true);
        $model = get_post_meta($id,"_car_modelcf_key",true);
        wp_set_object_terms( $id, array($merk,$model), 'merkenmodel',false);
    }
    function merkenmodelcron(){
        $posts = get_posts(array(
            'numberposts' => -1,
            'post_type'   => 'autos'
        ));
        foreach ($posts as $post) {
    
            $terms = get_the_terms($post->ID, 'merkenmodel');
            if(empty($terms)){
                add_merk_model_fields($post->ID);
            }
            $field = get_post_meta($post->ID,"_car_merkcf_key",true);
            $field = get_post_meta($post->ID,"_car_modelcf_key",true);
        }
    }
?>