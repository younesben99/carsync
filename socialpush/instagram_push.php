<?php


if(isset($_POST['postidname'])){
    
     include($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

     $AS_API_OPT = get_option("dds_settings_option_name");
     $IG_API = $AS_API_OPT['zapier_instagram_key_3'];

     $z_id = get_post($_POST['postidname']);

     $ig_title = get_post_meta($z_id->ID,"_car_wagentitel_key",true);

     $ig_img = get_post_meta($z_id->ID,"_car_syncimages_key", true);

     $ig_img_link = $ig_img[0];

     $ig_webhook = json_encode(array( "Title"=>$ig_title, "Image"=>$ig_img_link));




     //DISABLE DE KNOP NA EEN PUSH 
     update_post_meta($z_id->ID,"ig_push_key","1");


     $curl = curl_init();
     $url = $IG_API;
     
     if(!empty($url)){
     curl_setopt_array($curl, [
         CURLOPT_URL => $url,
         CURLOPT_HEADER => false,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_CUSTOMREQUEST => 'POST',
         CURLOPT_POST => 1,
         CURLOPT_POSTFIELDS  => $ig_webhook,
         CURLOPT_HTTPHEADER  => array('Content-Type: application/json','Content-Length: ' . strlen($ig_webhook)),
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
