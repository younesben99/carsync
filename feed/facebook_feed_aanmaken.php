<?php
fb_feed_aanmaken();
function fb_feed_aanmaken(){
    $allposts = get_posts( array('post_type'=>'autos','numberposts'=>-1) );
    if(!empty($allposts)){
    $pturl = get_site_url() . "/autos/";
    $fb_xml_pt1 = '"vehicle_id","title","description","url","make","model","year","mileage.value","mileage.unit","image[0].url","image[1].url","image[2].url","image[3].url","image[4].url","image[5].url","image[6].url","image[7].url","image[8].url","image[9].url","image[10].url","image[11].url","image[12].url","image[13].url","image[14].url","transmission","body_style","vin","price","exterior_color","state_of_vehicle","fuel_type","fb_page_id","address"';
    $fb_xml_loop = "";
    foreach ($allposts as $car)
    {
        $isverkocht = get_post_meta($car->ID, '_car_status_key', true);
        $isarchief =  get_post_meta($car->ID, '_car_post_status_key', true);
        if($isverkocht !== 'verkocht' ){
        if( $isarchief !== "archief" ){
        $fb_xml_loop .= "\n";
        $fb_xml_loop .=  '"'.$car->ID.'",';
        if ( ! empty ( get_post_meta($car->ID, '_car_wagentitel_key', true) ) ){
          $fb_xml_loop .= '"'.get_post_meta($car->ID, '_car_wagentitel_key', true).'",';
        }
        else{
            $fb_xml_loop .= '"'.$pturl.$car->post_name.'",';
        }
        if ( ! empty ( get_post_meta($car->ID, '_car_wagentitel_key', true) ) ){
          $fb_xml_loop .= '"'.strip_html_tags(get_post_meta($car->ID, '_car_wagentitel_key', true)).'",';  
        }
        
        $fb_xml_loop .= '"'.$pturl.$car->post_name.'",';
        if ( ! empty ( get_post_meta($car->ID, '_car_merkcf_key', true) ) ){
            $fb_xml_loop .= '"'.get_post_meta($car->ID, '_car_merkcf_key', true).'",';
        }
        if ( ! empty ( get_post_meta($car->ID, '_car_modelcf_key', true) ) ){
            $fb_xml_loop .= '"'.get_post_meta($car->ID, '_car_modelcf_key', true).'",';
        }
        else{
            $fb_xml_loop .= '"Andere",';
        }
        if ( ! empty ( get_post_meta($car->ID, '_car_bouwjaar_key', true) ) ){
            $fb_xml_loop .= '"'.substr(get_post_meta($car->ID, '_car_bouwjaar_key', true), 0, 4).'",';
        }
       
        if ( ! empty ( get_post_meta($car->ID, '_car_kilometerstand_key', true) ) ){
            $fb_xml_loop .= '"'.get_post_meta($car->ID, '_car_kilometerstand_key', true).'",';
        }
        $fb_xml_loop .= '"KM",';  
        
        if(!empty(get_post_meta($car->ID, '_car_syncimages_key', true))){
            $img = get_post_meta($car->ID, '_car_syncimages_key', true);
            for($i = 0; $i <= 14; $i++){
                $fb_xml_loop .= '"'.$img[$i].'",';
            } 
        }
        else{
            $img = get_post_meta($car->ID, 'vdw_gallery_id', true);
            for($i = 0; $i <= 14; $i++){
                $fb_xml_loop .= '"'.wp_get_attachment_url($img[$i]).'",';
            } 
        }
        
        
        if ( ! empty ( get_post_meta($car->ID, '_car_staat_key', true) ) ){
            if(get_post_meta($car->ID, '_car_transmissie_key', true) == "Manueel"){
                $transmission = "Manual";
            }
            else{
                $transmission = "Automatic";
            }
            
            $fb_xml_loop .= '"'.$transmission.'",';
        }
        $carbody = get_post_meta($car->ID, '_car_carrosserievorm_key', true);
        if ( ! empty ( $carbody ) ){
            switch ($carbody) {
                case 'Cabriolet':
                    $carbody = 'CONVERTIBLE';
                    break;
                case 'Coupé':
                    $carbody = 'COUPE';
                    break;
                case 'Break':
                    $carbody = 'HATCHBACK';
                    break;
                case 'Bestelwagen':
                    $carbody = 'MINIVAN';
                    break;
                case 'Stadswagen':
                    $carbody = 'SMALL_CAR';
                    break;
                case 'SUV/4x4/Pick-up':
                    $carbody = 'SUV';
                    break;
                case 'Berline':
                    $carbody = 'SEDAN';
                    break;
                case 'Monovolume':
                    $carbody = 'VAN';
                    break;
                default:
                    $carbody = 'OTHER';
                    break;
            }
            $fb_xml_loop .= '"'.$carbody.'",';
        }
        
        if ( ! empty ( get_post_meta($car->ID, '_car_vin_key', true) ) ){
            $fb_xml_loop .= '"'.get_post_meta($car->ID, '_car_vin_key', true).'",';
        }
        else{
            $fb_xml_loop .= '"'.$car->ID.'",';
        }   
        if ( ! empty ( get_post_meta($car->ID, '_car_prijs_key', true) ) ){
            $fb_xml_loop .= '"'.get_post_meta($car->ID, '_car_prijs_key', true).' EUR",';
        }
        if ( ! empty ( get_post_meta($car->ID, '_car_kleurexterieur_key', true) ) ){
            $fb_xml_loop .= '"'.get_post_meta($car->ID, '_car_kleurexterieur_key', true).'",';
        }

        if ( ! empty ( get_post_meta($car->ID, '_car_staat_key', true) ) ){
            if(get_post_meta($car->ID, '_car_staat_key', true) == "Tweedehands"){
                $state = "Used";
            }
            else{
                $state = "New";
            }
            $fb_xml_loop .= '"'.$state.'",';
        }

        $fuel_type = get_post_meta($car->ID, '_car_brandstof_key', true);
        if ( ! empty ( $fuel_type ) ){
            switch ($fuel_type) {
                case 'Diesel':
                    $fuel_type = 'DIESEL';
                    break;
                case 'Elektrisch':
                    $fuel_type = 'ELECTRIC';
                    break;
                case 'Ethanol':
                    $fuel_type = 'FLEX';
                    break;
                case 'Benzine':
                    $fuel_type = 'GASOLINE';
                    break;
                case 'Hybride':
                    $fuel_type = 'HYBRID';
                    break;
                default:
                    $fuel_type = 'OTHER';
                    break;
              }
            $fb_xml_loop .= '"'.$fuel_type.'",';
        }
        $fb_xml_loop .=  '"2265639753511090",';
        $fb_xml_loop .= '"{""addr1"":""Diestersteenweg 355"",""city"":""Hasselt"",""region"":""Limburg"",""postal_code"":""3510"",""country"":""Belgium""}"';
    }
    }
    }
    }

    $uploadfolder = ABSPATH . "/wp-content/uploads/dds_uploads/feed/";

    if (!file_exists($uploadfolder)) {
        mkdir($uploadfolder, 0777, true);
    }

    $fb_xml = $fb_xml_pt1 . $fb_xml_loop;
    $fileLocation_csv = ABSPATH . "/wp-content/uploads/dds_uploads/feed/fb_carfeed.csv";
    $file_csv = fopen($fileLocation_csv,"w");
    $content_csv = $fb_xml;
    fwrite($file_csv,$content_csv);
    fclose($file_csv);
    $fileLocation_json = ABSPATH . "/wp-content/uploads/dds_uploads/feed/fb_carfeed.json";
    $file_json = fopen($fileLocation_json,"w");
    $json_array = array_map("str_getcsv", explode("\n", $fb_xml));
    $json_data = json_encode($json_array);
    $content_json = $json_data;
    fwrite($file_json,$content_json);
    fclose($file_json);




}
?>