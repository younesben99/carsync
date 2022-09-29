<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include(__DIR__."/../../../../wp-load.php");


$offerte_url = $_POST['offerte_url'];
$offerte_id = $_POST['offerte_id'];
$offerte_vin = $_POST['vin'];

var_dump($_POST);

$allposts = get_posts( array('post_type'=>'autos','numberposts'=>-1) );
if(!empty($allposts)){

foreach ($allposts as $car)
{
    $vin = get_post_meta($car->ID,"_car_vin_key",true);
    
    if($vin == $offerte_vin){
        update_post_meta($car->ID, '_offerte_url', $offerte_url);   
        update_post_meta($car->ID, '_offerte_id', $offerte_id);   
    }
}

}



?>

