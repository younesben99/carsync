<?php

$Vdata = file_get_contents(WP_PLUGIN_DIR . '/carsync/sync/data/input_query.json');


$array = json_decode($Vdata, true);
$cars = $array['data']['search']['listings']['listings'];

var_dump($cars); 

echo("<hr>");

print_r($cars); 

?>
