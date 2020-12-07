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
    
    foreach ($cars as $car)
    {
        
        //echo  $car['details']['vehicle']['classification']['make']['formatted'] . ' ' .$car['details']['vehicle']['classification']['model']['formatted'];
        //echo "<br><br>";
        //echo  $car['id'];
        //var_dump($car['details']['vehicle']);
        //echo "<br><br>";
        
        $caridtemp = $car['id'];
        array_push($caridarray,$caridtemp);
        
        
        
    }


    var_dump($caridarray);
    //echo("<hr>");

    
    

    $allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );
    $wpuniqidarray = array();
    foreach ($allposts as $post) {

        
        
        







            $currentid = get_post_meta( $post->ID, '_car_uniq_key', true );
            array_push($wpuniqidarray,$currentid);
            $synctrue = get_post_meta( $post->ID, '_car_sync_key', true ); 
        
       
            if(in_array($currentid,$caridarray) && $synctrue == 'YES'){
                //echo(get_the_title($post->ID).' gevonden<br>');
            }
            else{
                if($synctrue !== 'YES'){
                    //echo(get_the_title($post->ID).' <b>false <- IGNORING WP POST: </b>'.$post->ID.'<br>');
                }
                else{
                    //echo(get_the_title($post->ID).' <b>false <- DELETING WP POST: </b>'.$post->ID.'<br>');
                }
                
            }


    }
   // echo("<hr>");
    //var_dump($wpuniqidarray);

  // echo("<hr>");

 //  echo("Verschil is: <br>");

   $diffr = array_diff($caridarray,$wpuniqidarray);

   // var_dump($diffr);
    if(!empty($array_verschil)){
        foreach($array_verschil as $car){
           // echo($car);
        }
    }
}

?>
