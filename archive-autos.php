<?php


//carsync_posts_maken();

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
    $caridarray = array();
    $car_md_array = array();
    foreach ($cars as $car)
    {
        
        //echo  $car['details']['vehicle']['classification']['make']['formatted'] . ' ' .$car['details']['vehicle']['classification']['model']['formatted'];
        //echo "<br><br>";
        //echo  $car['id'];
        //var_dump($car['details']['vehicle']);
        //echo "<br><br>";
        
        $caridtemp = $car['id'];
        array_push($caridarray,$caridtemp);
        $tempmd = $car['details']['publication']['changedTimestamp'];
        array_push( $car_md_array,$tempmd);
        
        
    }
   

  
    

    
    

    $allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );
    $car_md_array_wp = array();
    foreach ($allposts as $post) {
        
       
            $currentmd = get_post_meta( $post->ID, '_car_modifieddate_key', true ); 
            array_push( $car_md_array_wp,$currentmd);
            
            if(in_array($currentid,$caridarray) && $synctrue == 'YES'){
                //modifieddate checken en verwijderen
                //update
                if(in_array($currentmd,$car_md_array)){
                        
                }
                
                
            }

    }
    
    var_dump($car_md_array);
    echo("<hr>");
    var_dump($car_md_array_wp);

    $array_tijd_verschil = array_diff($car_md_array_wp,$car_md_array);
    if(!empty($array_tijd_verschil)){
        foreach($array_tijd_verschil as $verschil){
            echo($verschil);
        }
    }

   
}




?>
