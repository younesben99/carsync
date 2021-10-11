<?php



function carsync_posts_maken(){
    if(file_exists(ABSPATH . 'wp-content/uploads/dds_uploads/carsync/sync/data/input_query.json')) {
        $Vdata = file_get_contents(ABSPATH . 'wp-content/uploads/dds_uploads/carsync/sync/data/input_query.json');
    }
    else{
        $Vdata = 0;
    }
    
    //AS Decode array en klaarmaken voor gebruik
    $array = json_decode($Vdata, true);
    
    $cars = $array['data']['search']['listings']['listings'];
     
    //als het bestand niet leeg is, alleen dan doe iets (validatie)
 
    if(!empty($cars) && $cars !== 0 && $cars !== null){
 
     $caridarray = array();
     $car_md_array = array();
         foreach($cars as $car){
             $tempuniqid = $car['details']['vehicle']['identifier']['vin'];
             array_push($caridarray,$tempuniqid);
             $tempmd = $car['details']['publication']['changedTimestamp'];
             array_push( $car_md_array,$tempmd);
         }
 
        
        $allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );
        if(empty($allposts)){
         //vars setup en posts maken als er GEEN posts zijn. Dit wordt 1 keer gedraaid
        
        foreach ($cars as $car)
        {
            
              create_post_by_uniq_id($car['details']['vehicle']['identifier']['vin']);
        }
 
     }
        else
        {
 
 
 
 
 
         //alle posts nakijken en kijken of de modifieddate is veranderd, als dat het geval is, update die specifieke post
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
                     //archiveren
                     update_post_meta($post->ID, '_car_post_status_key', 'archief');
                     update_post_meta($post->ID, '_car_sync_key', 'NO');
                     update_post_meta($post->ID, '_car_status_key', 'verkocht');
                 }
             }
             }
 
 
             $array_verschil = array_diff($caridarray,$wpuniqidarray);
             //als autoscout ids heeft die niet terug te vinden zijn in wordpress posts dan doe je deze if-statement
                 if(!empty($array_verschil)){
                     foreach($array_verschil as $uniqid){
 
                         //NIEUWE WAGEN DIE BINNEN KOMT
 
 
                         create_post_by_uniq_id($uniqid);
                     }
                 }
 
 
             //check als uniq id terug te vinden is in archief, als het zo is, verander dan de status naar actief, tekoop, sync ja
 
             
 
             $arch_posts = get_posts(array(
                 'numberposts' => -1,
                 'post_type'   => 'autos',
                 'meta_query' => array(
                     array(
                         'key' => '_car_post_status_key',
                         'value' => 'archief',
                         'compare' => 'LIKE'
                     )
             )
             ));
             foreach ($arch_posts as $post) {
                 
                 
                 $poststatus = get_post_meta($post->ID,"_car_post_status_key",true);
                 $verkoopstatus = get_post_meta($post->ID,"_car_status_key",true);
                 $syncstatus = get_post_meta($post->ID,"_car_sync_key",true);
 
                 $arch_uniq_id = get_post_meta($post->ID,"_car_uniq_key",true);
             
             
                 if(in_array($arch_uniq_id,$caridarray)){
             
                     update_post_meta($post->ID, '_car_post_status_key', 'actief');
                     update_post_meta($post->ID, '_car_sync_key', 'YES');
                     update_post_meta($post->ID, '_car_status_key', 'tekoop');
             
                 }
             
             }
 
             
             //TAXONOMY CHECK BUG
 
 
             $posts = get_posts(array(
                 'numberposts' => -1,
                 'post_type'   => 'autos'
             ));
             foreach ($posts as $post) {
         
                 $terms = get_the_terms($post->ID, 'merkenmodel');
                 if(empty($terms)){
                     $merk = get_post_meta($post->ID,"_car_merkcf_key",true);
                     $model = get_post_meta($post->ID,"_car_modelcf_key",true);
                     wp_set_object_terms( $post->ID, array($merk,$model), 'merkenmodel',false);
                 }
                 
             }
             
 
 
        }
     
     }
        

   }



?>