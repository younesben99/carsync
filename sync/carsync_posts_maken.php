<?php



function carsync_posts_maken(){

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
             create_post_by_uniq_id($car['id']);
       }
    }
       else
       {

        $wpuniqidarray = array();
        $car_md_array_wp = array();
        foreach ($allposts as $post) {
   
            $currentid = get_post_meta( $post->ID, '_car_uniq_key', true );
            array_push($wpuniqidarray,$currentid);
            $synctrue = get_post_meta( $post->ID, '_car_sync_key', true ); 
            $currentmd = get_post_meta( $post->ID, '_car_modifieddate_key', true ); 
            array_push( $car_md_array_wp,$currentmd);
             
     
            if(in_array($currentid,$caridarray) && $synctrue == 'YES'){
                //modifieddate checken en verwijderen
                //update
                $array_tijd_verschil = array_diff($car_md_array_wp,$car_md_array);
                if(!empty($array_tijd_verschil)){
                    foreach($array_tijd_verschil as $verschil){
                        wp_delete_post($post->ID, true );
                    }
                    carsync_posts_maken();
                }
                
                
            }
            else{
                if($synctrue == 'YES'){
                    //is gesynct en uniqid is niet terug te vinden in de api
                    //delete
                    wp_delete_post($post->ID, true );
                }

                
            }
            
            }
            $array_verschil = array_diff($caridarray,$wpuniqidarray);
                if(!empty($array_verschil)){
                    foreach($array_verschil as $uniqid){
                        create_post_by_uniq_id($uniqid);
                    }
                }
       }
       


       
           
       }
        /*
       
       
       
       EINDE VARIABLES VOORBEREIDEN


    
       */

       
            
            /*
            
        */
        

   }



?>