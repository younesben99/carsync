<?php
function slugify($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}


function dds_car_fotos_downloaden(){


    //vdw_gallery_id

    $posts = get_posts([
        'post_type' => 'autos',
        'post_status' => 'publish',
        'numberposts' => -1
      ]);


    $posts_arr = array();

    foreach($posts as $post){
      

        $local_gallery = get_post_meta( $post->ID,"vdw_gallery_id" );

        if(empty($local_gallery) or $local_gallery[0] == null){
            array_push($posts_arr,$post->ID);
        }
        //update_post_meta($post->ID, 'vdw_gallery_id', null);

    }

    // we werken aan 1 post per keer dat een cron job draait zodat we server load laag houden
    //we nemen in dit geval de eerste post in de array

    $current_post = $posts_arr[0];

    if(!empty($current_post)){
        //echo "id: " . $current_post;
        
        $local_gallery = get_post_meta( $current_post,"vdw_gallery_id" );
        var_dump($local_gallery);
        
        $api_gallery = get_post_meta( $current_post,"_car_syncimages_key" );
        var_dump($api_gallery);
        $imgtoadd = array();

        if(!empty($api_gallery)){
            foreach($api_gallery[0] as $img){
                $image = "";
                if($img != "") {
                
                    $file = array();
                    $file['name'] = $img;
                    $file['tmp_name'] = download_url($img);
            
                    if (is_wp_error($file['tmp_name'])) {
                        @unlink($file['tmp_name']);
                        var_dump( $file['tmp_name']->get_error_messages( ) );
                        array_push($imgtoadd,1);

                    } else {
                        var_dump($file['tmp_name']);
                        
                        $file['name'] = slugify(strtolower(get_the_title($current_post))) . "_" .uniqid().".jpg";
                        var_dump($file['name']);
                        $attachmentId = media_handle_sideload($file, $post_id);
                        
                        if ( is_wp_error($attachmentId) ) {
                            @unlink($file['tmp_name']);
                            var_dump( $attachmentId->get_error_messages( ) );
                            array_push($imgtoadd,1);
                        } else {                
                            $image = wp_get_attachment_url( $attachmentId );
                            array_push($imgtoadd,$attachmentId);
                        }
                    }
                }
            }
            update_post_meta($current_post, '_car_api_images_downloaded', "YES");
        }

        if(!empty($imgtoadd)){
            update_post_meta($current_post, 'vdw_gallery_id', $imgtoadd);
        }

        

        // echo($current_post);
        // echo("<br>");
        // echo get_the_title($current_post);

    }



}



?>