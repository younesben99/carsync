<?php


if(file_exists(WP_PLUGIN_DIR . '/carsync/sync/data/input_query.json')) {
    $Vdata = file_get_contents(WP_PLUGIN_DIR . '/carsync/sync/data/input_query.json');
}
else{
    $Vdata = 0;
}


$array = json_decode($Vdata, true);
$cars = $array['data']['search']['listings']['listings'];
if(!empty($cars)){
    foreach ($cars as $car)
    {
        
        echo  $car['details']['vehicle']['classification']['make']['formatted'] . ' ' .$car['details']['vehicle']['classification']['model']['formatted'];
        echo "<br><br>";
        echo  $car['id'];
        //var_dump($car['details']['vehicle']);
        echo "<br><br>";
        //SET VARS
    
        $car_uniqid = $car['id'];
        $car_merk = $car['details']['vehicle']['classification']['make']['formatted'];
        $car_model = $car['details']['vehicle']['classification']['model']['formatted'];
        
    }
    echo("<hr>");
    
    var_dump($cars); 
}




?>
