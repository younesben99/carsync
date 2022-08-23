<?php

include(__DIR__."/../../../../../wp-load.php");

$post_id = $_GET["pid"];






$custom_fields = get_post_custom($post_id);

$merk = get_post_meta($post_id,'_car_merkcf_key',true);
$model = get_post_meta($post_id,'_car_modelcf_key',true);

if(empty($merk) && empty($model)){
    $merk = get_post_meta($post_id,'_car_wagentitel_key',true);
    $model = "";
}
$vin = get_post_meta($post_id,'_car_vin_key',true);

$blocks = array();

foreach($custom_fields as $topkey => $fieldarr){

if(mb_substr($topkey,0,5) == "Block"){
    $blockkey = mb_substr($topkey,0,6);
    $blockkey_last = mb_substr($topkey,7);
    
    foreach($fieldarr as $key => $fields){
        $blocks[$blockkey][$blockkey_last] = $fields;
    }
}

}

$csv_array = array();
foreach($blocks as $topkey => $fieldarr){
   
    foreach($fieldarr as $key => $field){
   
        array_push($csv_array,[$key,$field]);

        
    }
   
}

$list = array(array_flatten($blocks));
$fp = fopen(__DIR__.'/list.csv', 'w');


foreach ($csv_array as $line) {
    fputcsv($fp, $line);
}

  
fclose($fp);






header( 'Content-Type: application/csv' );
header( 'Content-Disposition: attachment; filename="'.$merk.'_'.$model.'_'.$vin."_Gegevens.csv" );
readfile(__DIR__.'/list.csv');