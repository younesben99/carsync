<?php
function wp_zapier_asana($data){

    $data = json_encode($data);
     $curl = curl_init();
     $url = "https://hooks.zapier.com/hooks/catch/9038548/bomth9l/";

     if(!empty($url)){
      curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS  => $data,
        CURLOPT_HTTPHEADER  => array('Content-Type: application/json','Content-Length: ' . strlen($data)),
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
function wp_zapier_billit($data){

    $data = json_encode($data);
     $curl = curl_init();
     $url = "https://hooks.zapier.com/hooks/catch/9038548/bomo3ib/";

     if(!empty($url)){
      curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS  => $data,
        CURLOPT_HTTPHEADER  => array('Content-Type: application/json','Content-Length: ' . strlen($data)),
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