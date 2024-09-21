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
    foreach ($posts_arr as $current_post) {
        if ($count < 5) {
            if (!empty($current_post)) {
                $local_gallery = get_post_meta($current_post, "vdw_gallery_id");
                $api_gallery = get_post_meta($current_post, "_car_syncimages_key");
                $imgtoadd = array();
                if (!empty($api_gallery)) {
                    foreach ($api_gallery[0] as $img) {
                        if ($img != "") {
                            $file = array();
                            $file['name'] = $img;
                            $file['tmp_name'] = download_url($img);
    
                            if (is_wp_error($file['tmp_name'])) {
                                // No need to unlink since there's no file
                                var_dump($file['tmp_name']->get_error_messages());
                                array_push($imgtoadd, 1);
                            } else {
                                var_dump($file['tmp_name']);
                                $file['name'] = slugify(strtolower(get_the_title($current_post))) . "_" . uniqid() . ".jpg";
                                var_dump($file['name']);
                                $attachmentId = media_handle_sideload($file, $current_post);
    
                                @unlink($file['tmp_name']); // Clean up temporary file
    
                                if (is_wp_error($attachmentId)) {
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
        } else {
            return;
        }
        $count++;
    }
    

} catch (\Throwable $th) {
    wp_mail("younesbenkheil@gmail.com","Error Cron job",$th);
}

}

function img_array_flatten($array){
    $flatten = array();
    array_walk_recursive($array, function($value) use(&$flatten) {
        $flatten[] = $value;
    });

    return $flatten;
}

function clean_attachment_array( $attachment_ids ) {
    // Make sure the attachment IDs are an array
    if ( ! is_array( $attachment_ids ) ) {
        return array();
    }

    echo("before<hr>");
    //flatten array
    $attachment_ids = img_array_flatten($attachment_ids);
    var_dump($attachment_ids);
    // Loop through the attachment IDs
    foreach ( $attachment_ids as $attachment_id ) {
        // Convert the attachment ID to an integer
        $attachment_id = intval( $attachment_id );

        // Check if the attachment exists
        if ( ! get_post( $attachment_id ) ) {
            // If the attachment does not exist, remove it from the array
            echo $attachment_id . " NOT exists<br>";

            $key = array_search( $attachment_id, $attachment_ids );
            // Remove the value from the array
            unset( $attachment_ids[ $key ] );

        }
        else{
            echo $attachment_id . " exists<br>";
        }
    }
    echo("after<hr>");
    var_dump(array_values($attachment_ids));
    
    // Return the cleaned array of attachment IDs
    return array_values($attachment_ids);
}

function vdw_gallery_id_nakijken(){


try {

    //vdw_gallery_id

    $posts = get_posts([
        'post_type' => 'autos',
        'post_status' => 'publish',
        'numberposts' => -1
      ]);


    $posts_arr = array();

    foreach($posts as $post){
      
        // wp_delete_post( $post->ID, true );
        $local_gallery = get_post_meta( $post->ID,"vdw_gallery_id" );
        if(!empty($local_gallery)){
       

            $cleaned_attachment_ids = clean_attachment_array( $local_gallery );
           
   

            if(empty($cleaned_attachment_ids)){
                delete_post_meta(  $post->ID, "vdw_gallery_id" );
            }
            else{
                update_post_meta( $post->ID, 'vdw_gallery_id',$cleaned_attachment_ids );

            }


        }
        else{
            delete_post_meta(  $post->ID, "vdw_gallery_id" );

        }
    
       

    }

   
} catch (\Throwable $th) {
    wp_mail("younesbenkheil@gmail.com","Error Cron job lege image vervangen",$th);
}

}



function photo_cleaning_archive_only_leave_first(){

    $ids = get_posts( 
        array(
            'post_type'      => 'autos', 
            'post_status'    => 'any', 
            'posts_per_page' => -1,
        ) 
    );
    $images = array();
    // $counter1 = 0;
    
    foreach ( $ids as $id ){
        $post_status = get_post_meta( $id->ID, '_car_post_status_key', true );
        $gal = get_post_meta( $id->ID, 'vdw_gallery_id', true );
    
        if($post_status == "archief"){
            
         
            update_post_meta($id->ID,'vdw_gallery_id', array($gal[0]));
    
            if(is_array($gal)){
                for ($i=1; $i < count($gal); $i++) { 
            
                    $file_path = get_attached_file($gal[$i]);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                    wp_delete_attachment($gal[$i]);
             
                    // $counter1++;
                  
                }
            }
            
         
           
        }
      
     
    
       
    }
    
    // echo("totaal: ".$counter1." verwijderd<br>");
    
    //verwijder van archief autos alle fotos behalve de eerste
}

?>