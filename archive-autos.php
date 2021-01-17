<?php


carsync_posts_maken();
//carsync_data_ophalen();
//do_action('carsync_data_ophalen_hook');
echo get_post_type_archive_link("autos");
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
        foreach($cars as $car){
            $tempuniqid = $car['id'];
            array_push($caridarray,$tempuniqid);
            $tempmd = $car['details']['publication']['changedTimestamp'];
            array_push( $car_md_array,$tempmd);
        }

    //DATA VERWIJDEREN OF MAKEN
       $allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );
       if(empty($allposts)){
        //vars setup en posts maken
       
       foreach ($cars as $car)
       {
           echo("Create ALL CARS: ". $car['id'] . "<br>");
             //create_post_by_uniq_id($car['id']);
       }
    }
       else
       {
        // dit wordt uigevoerd in het geval dat er 1 of meer wordpress posts al aanwezig zijn
        $wpuniqidarray = array();
        
        
        foreach ($allposts as $post) {
            $array_tijd_verschil = array();
            $car_md_array_wp = array();
            $currentid = get_post_meta( $post->ID, '_car_uniq_key', true );
            array_push($wpuniqidarray,$currentid);
            $synctrue = get_post_meta( $post->ID, '_car_sync_key', true ); 
            $currentmd = get_post_meta( $post->ID, '_car_modifieddate_key', true ); 
            array_push( $car_md_array_wp,$currentmd);
             
            if(in_array($currentid,$caridarray) && $synctrue == 'YES'){
                //modifieddate checken en verwijderen
                //update
                $array_tijd_verschil = array_diff($car_md_array_wp,$car_md_array);
                //var_dump($array_tijd_verschil);

                if(!empty($array_tijd_verschil)){
                    foreach($array_tijd_verschil as $verschil){
                        echo('wp_delete_post('.$post->ID.', true );');
                        echo('<br>'.$verschil.'<br>');
                    }
                   
                }
                
                
            }
            else{
                if($synctrue == 'YES'){
                    //is gesynct en uniqid is niet terug te vinden in de api
                    //delete
                    echo('wp_delete_post('.$post->ID.', true );');
                }

                
            }
            
            }
            $array_verschil = array_diff($caridarray,$wpuniqidarray);
            if(!empty($array_verschil)){
                foreach($array_verschil as $uniqid){
                    echo("create_post_by_uniq_id(".$uniqid.");");
                }
            }    
       }
       
        //kijken of de id al bestaat, als die al bestaat, niks doen
    $allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );
    if(!empty($allposts)){
    $uniq_wp_wagen = array();

    foreach ($allposts as $wp_post)
    {
        $wp_uniqid = get_post_meta( $wp_post->ID, '_car_uniq_key', true );
        array_push($uniq_wp_wagen,$wp_uniqid);
    }
    
    if(in_array('55824e02-4f09-46ca-b3ef-06eee039d6ec',$uniq_wp_wagen)){
        echo("zit erin!");
    }
    else {
        echo("zit er niet in");
    }
    }
     
       
           
       }
      
        


?>
