<?php




//do_action('carsync_data_ophalen_hook');
if(file_exists(WP_PLUGIN_DIR . '/carsync/sync/data/input_query.json')) {
    $Vdata = file_get_contents(WP_PLUGIN_DIR . '/carsync/sync/data/input_query.json');
}
else{
    $Vdata = 0;
}


$array = json_decode($Vdata, true);
$cars = $array['data']['search']['listings']['listings'];
if(!empty($cars) && $cars !== 0 && $cars !== null){
    foreach ($cars as $car)
    {
        
        echo  $car['details']['vehicle']['classification']['make']['formatted'] . ' ' .$car['details']['vehicle']['classification']['model']['formatted'];
        echo "<br><br>";
        echo  $car['id'];
        //var_dump($car['details']['vehicle']);
        echo "<br><br>";
    
        
    }
    echo("<hr>");
    
    var_dump($cars); 
}




?>
