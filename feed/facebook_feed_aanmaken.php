
<?php
 fb_feed_aanmaken();
function fb_feed_aanmaken(){

    

    $fb_xml_pt1 = '<?xml version="1.0" encoding="UTF-8"?>
    <listings>
        <title>Vehicles Feed</title>
        <link rel="self" href="http://www.example.com"/>';
    $fb_xml_pt3 = '</listings>';
    $fb_xml_loop;

    $allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );
    if(!empty($allposts)){
    foreach ($allposts as $car)
    {
        $fb_xml_loop .= '<listing>';
        
        $fb_xml_loop .=  '<vehicle_id>'.$car->ID.'</vehicle_id>';

        
        if ( ! empty ( get_post_meta($car->ID, '_car_wagentitel_key', true) ) ){
            $fb_xml_loop .= '<title>'.get_post_meta($car->ID, '_car_wagentitel_key', true).'</title>';
        }
        if ( ! empty ( get_post_meta($car->ID, '_car_wagentitel_key', true) ) ){
            $fb_xml_loop .= '<title>'.get_post_meta($car->ID, '_car_wagentitel_key', true).'</title>';
        }     
        $fb_xml_loop .= '</listing>';
    }
    }
    else{
        $fb_xml_loop .= '<listing></listing>';
    }
    
    $fb_xml = $fb_xml_pt1 . $fb_xml_loop . $fb_xml_pt3;
    $fileLocation = ABSPATH . "/carfeed.xml";
    $file = fopen($fileLocation,"w");
    $content = $fb_xml;
    fwrite($file,$content);
    fclose($file);
}

if(!file_exists(ABSPATH . "/carfeed.xml")){

    fb_feed_aanmaken();

}



?>