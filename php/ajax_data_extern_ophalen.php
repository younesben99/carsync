<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");


include(__DIR__."/../../../../wp-load.php");

if (!empty($_POST['data_tp'])) {

    $url = $_POST['data_tp'];

    $response = file_get_contents($url);
    //$response = new SimpleXMLElement($response);
    echo($response);
    
}

$url = "http://api.inmotiv.be/rest/lookup/1.6/1fe6395c-8831-4d16-864c-a4357a919953/WAUZZZ4G5HN009507/BXERSTPCAVF/7705/15060259";



$response = file_get_contents($url);


$plainXML = mungXML( trim($response) );

$res_array = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
$block = array();
echo(json_encode($res_array));

//echo($res_array["Block"][0]["@attributes"]["id"]);




?>