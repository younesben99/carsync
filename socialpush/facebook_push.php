<?php

if(isset($_POST['postidname'])){
    include($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

    $AS_API_OPT = get_option("dds_settings_option_name");
    $FB_API = $AS_API_OPT['zapier_facebook_key_2'];
    
    $z_id = get_post($_POST['postidname']);

    $fb_title = get_post_meta($z_id->ID,"_car_wagentitel_key",true);

    $fb_img = get_post_meta($z_id->ID,"_car_syncimages_key", true);

    $fb_img_link = $fb_img[0];

    $fb_webhook = json_encode(array( "Title"=>$fb_title, "Image"=>$fb_img_link));

     //DISABLE DE KNOP NA EEN PUSH 
     update_post_meta($z_id->ID,"fb_push_key","1");


     $curl = curl_init();
     $url = $FB_API;

     if(!empty($url)){
      curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS  => $fb_webhook,
        CURLOPT_HTTPHEADER  => array('Content-Type: application/json','Content-Length: ' . strlen($fb_webhook)),
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0
    ]);
    
    $response = curl_exec($curl);
    
    if ($error = curl_error($curl)) {
      throw new Exception($error);
    }
    
    curl_close($curl);
    $response = json_decode($response, true);
    var_dump($response);

     }
     
}
?>