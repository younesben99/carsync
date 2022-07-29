<?php

if(!function_exists("slugify")){
    function slugify($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }
}



function dds_car_fotos_downloaden(){
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

try {

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

   

    //$current_post = $posts_arr[0];


    $count = 0;
    foreach($posts_arr as $current_post){

        if ($count < 5) {
            if (!empty($current_post)) {
                $local_gallery = get_post_meta($current_post, "vdw_gallery_id");
                $api_gallery = get_post_meta($current_post, "_car_syncimages_key");
                $imgtoadd = array();
                if (!empty($api_gallery)) {
                    foreach ($api_gallery[0] as $img) {
                        $image = "";
                        if ($img != "") {
                            $file = array();
                            $file['name'] = $img;
                            $file['tmp_name'] = download_url($img);
                
                            if (is_wp_error($file['tmp_name'])) {
                                @unlink($file['tmp_name']);
                                var_dump($file['tmp_name']->get_error_messages());
                                array_push($imgtoadd, 1);
                            } else {
                                var_dump($file['tmp_name']);
                            
                                $file['name'] = slugify(strtolower(get_the_title($current_post))) . "_" .uniqid().".jpg";
                                var_dump($file['name']);
                                $attachmentId = media_handle_sideload($file, $post_id);
                            
                                if (is_wp_error($attachmentId)) {
                                    @unlink($file['tmp_name']);
                                    var_dump($attachmentId->get_error_messages());
                                    array_push($imgtoadd, 1);
                                } else {
                                    $image = wp_get_attachment_url($attachmentId);
                                    array_push($imgtoadd, $attachmentId);
                                }
                            }
                        }
                    }
                    update_post_meta($current_post, '_car_api_images_downloaded', "YES");
                }
    
                if (!empty($imgtoadd)) {
                    update_post_meta($current_post, 'vdw_gallery_id', $imgtoadd);
                }
    
            
            }
        }
        else{
            return;
        }
        $count++;
    }

} catch (\Throwable $th) {
    wp_mail("younesbenkheil@gmail.com","Error Cron job",$th);
}

}



?>