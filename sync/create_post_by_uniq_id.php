<?php



function create_post_by_uniq_id($passed_id){
    //kijken of de id al bestaat, als die al bestaat, niks doen
    $allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );


    $dds_settings_options = get_option( 'dds_settings_option_name' );
    $zapier_billit_key = $dds_settings_options['zapier_billit_key']; 

    $uniq_wp_wagen = array();

    foreach ($allposts as $wp_post)
    {
        $wp_uniqid = get_post_meta( $wp_post->ID, '_car_uniq_key', true );
        array_push($uniq_wp_wagen,$wp_uniqid);
    }
    //uniq id arg zit niet in 1 van de huidige wp posts
    if(in_array($passed_id,$uniq_wp_wagen) == false){
    if(file_exists(ABSPATH . 'wp-content/uploads/dds_uploads/carsync/sync/data/input_query.json')) {
        $Vdata = file_get_contents(ABSPATH . 'wp-content/uploads/dds_uploads/carsync/sync/data/input_query.json');
    }
    else{
        $Vdata = 0;
    }
    $array = json_decode($Vdata, true);
    $cars = $array['data']['search']['listings']['listings'];
    if(!empty($cars) && $cars !== 0 && $cars !== null){
        
        foreach ($cars as $car)
        {
            if(empty($car['details']['vehicle']['identifier']['vin'])){
                $identifier = $car['id'];
            }
            else{
                $identifier = $car['details']['vehicle']['identifier']['vin'];
            }
            

            if($passed_id == $identifier){
                $uniqid = $identifier;
                
                $merk = $car['details']['vehicle']['classification']['make']['formatted'];
                $model = $car['details']['vehicle']['classification']['model']['formatted'];
                $merkenmodel = esc_html($merk) . " ". esc_html($model);
                $eerste_insch = $car['details']['vehicle']['classification']['model']['formatted'];
        
                $carpass_link = $car['details']['vehicle']['condition']['carpassMileageUrl'];

                $wagentitel = $car['details']['adProduct']['title'];
                $opmerkingen = $car['details']['description'];
               
                $uitvoering = '';
                $eersteinschrijving = $car['details']['vehicle']['condition']['firstRegistrationDate']['raw'];
                $carrosserievorm = $car['details']['vehicle']['bodyType']['formatted'];
                $brandstof = $car['details']['vehicle']['fuels']['fuelCategory']['formatted'];
                $transmissie = $car['details']['vehicle']['engine']['transmissionType']['formatted'];
                $kmstand = $car['details']['vehicle']['condition']['mileageInKm']['raw'];
                $bouwjaar = $car['details']['vehicle']['condition']['firstRegistrationDate']['raw'];
                $staat = $car['details']['vehicle']['legalCategories'][0]['formatted'];
                $aantaldeuren = $car['details']['vehicle']['numberOfDoors'];
                $vin = $car['details']['vehicle']['identifier']['vin'];
                $internnr = $car['details']['identifier']['offerReference'];
                $internnr = strtolower($internnr);
                if (substr($internnr, -1) !== ',') {
                    $internnr.= ",";
                }
                if (strpos($internnr, "badge:") !== false && strpos($internnr, ",") !== false) {
                    $badge = get_string_between($internnr, "badge:", ",");
                } elseif (strpos($internnr, "badge:") !== false) {
                    $needle = 'badge:';
                    $badge = substr($internnr, strpos($internnr, $needle) + strlen($needle));
                } else {
                    $badge = null;
                }
                if (strpos($internnr, "prijs:") !== false && strpos($internnr, ",") !== false) {
                    $oudeprijs = get_string_between($internnr, "prijs:", ",");
                } elseif (strpos($internnr, "prijs:") !== false) {
                    $needle = 'prijs:';
                    $oudeprijs = substr($internnr, strpos($internnr, $needle) + strlen($needle));
                } else {
                    $oudeprijs = null;
                }
                $changedTimestap = $car['details']['publication']['changedTimestamp'];
                $createdTimestamp = $car['details']['publication']['createdTimestamp'];
                $changedTimestapwithOffset = $car['details']['publication']['changedTimestampWithOffset'];
                $createdTimestampWithOffset = $car['details']['publication']['createdTimestampWithOffset'];
                $state = $car['details']['publication']['state'];
                $description = $car['details']['description'];
                $zitplaatsen = $car['details']['vehicle']['interior']['numberOfSeats'];
                $btwaftrekbaar = $car['details']['prices']['pricepublic']['taxDeductible']; 
               
                if ($btwaftrekbaar === false) {
                    $btwaftrekbaar = 'NVT';
                } elseif ((int)$btwaftrekbaar === 0) {
                    $btwaftrekbaar = 'NVT';
                } elseif ($btwaftrekbaar === true) {
                    $btwaftrekbaar = 'Ja';
                } elseif (strtolower((string)$btwaftrekbaar) === 'ja') {
                    $btwaftrekbaar = 'Ja';
                } elseif (strtolower((string)$btwaftrekbaar) === 'yes') {
                    $btwaftrekbaar = 'Ja';
                } elseif ((int)$btwaftrekbaar === 0) {
                    $btwaftrekbaar = 'Nee';
                } elseif (strtolower((string)$btwaftrekbaar) === 'no') {
                    $btwaftrekbaar = 'Nee';
                } elseif (strtolower((string)$btwaftrekbaar) === 'nee') {
                    $btwaftrekbaar = 'Nee';
                } else {
                    $btwaftrekbaar = 'NVT';
                }
        
                $kleurinterieur = $car['details']['vehicle']['interior']['upholsteryColor']['formatted'];
                $kleurexterieur = $car['details']['vehicle']['bodyColor']['formatted'];
                $emissieklasse = $car['details']['vehicle']['environment']['environmentLabels'][0]['label'];
                $emissieklasse = str_ireplace('Euro0', 'Euro', $emissieklasse);
                $emissieklasse = str_ireplace('Euro', 'Euro ', $emissieklasse);
              
                $co = $car['details']['vehicle']['fuels']['primary']['co2emissionInGramPerKm']['raw'];
                $price = $car['details']['prices']['pricepublic']['amountInEUR']['raw'];
               
                $cilinderinhoud = $car['details']['vehicle']['engine']['engineDisplacementInCCM']['raw'];
                $vermogenpk = $car['details']['vehicle']['engine']['power']['hp']['raw'];
                $vermogenkw = $car['details']['vehicle']['engine']['power']['kw']['raw'];
                
                $syncimagesloop = $car['details']['media']['images'];
                $syncimages = array();
                foreach($syncimagesloop as $image){
                    array_push($syncimages, $image['formats']['jpg']['size1280x960']);
                }
        
                $comfortengemakraw = $car['details']['vehicle']['equipment']['as24'];
                $entertainmentenmediaraw = $car['details']['vehicle']['equipment']['as24'];
                $extraoptiesraw = $car['details']['vehicle']['equipment']['as24'];
                $veiligheidraw = $car['details']['vehicle']['equipment']['as24'];
                
               
                    
                $comfortengemak = array();
                foreach($comfortengemakraw as $optie) {
                    if($optie['category']['formatted'] == "Comfort en gemak"){
                    array_push($comfortengemak,$optie['id']['formatted']);
                    }
                }
                $entertainmentenmedia = array();
                foreach($entertainmentenmediaraw as $optie) {
                    if($optie['category']['formatted'] == "Entertainment en Media"){
                    array_push($entertainmentenmedia,$optie['id']['formatted']);
                    }
                }
                $extraopties = array();
                foreach($extraoptiesraw as $optie) {
                    if($optie['category']['formatted'] == "Extra"){
                       
                    array_push($extraopties,$optie['id']['formatted']);
                    }
                }
                $veiligheid = array();
                foreach($veiligheidraw as $optie) {
                    if($optie['category']['formatted'] == "Veiligheid"){
                     array_push($veiligheid,$optie['id']['formatted']);
                    }
                    
                }
                
         
             wp_insert_term($merk,  'merkenmodel' );
             $merkpush = get_term_by('name', $merk, 'merkenmodel');
             wp_insert_term($model,  'merkenmodel',array('parent' => $merkpush->term_id) );
             $modelpush = get_term_by('name', $model, 'merkenmodel');
             $post_arr = array(
             'post_title'   => $merkenmodel,
             'post_status'  => 'publish',
             'post_type'    => 'autos',
             'tax_input'    => array(
                 "merkenmodel" => array(
                     $merkpush->term_id,
                     $modelpush->term_id
                 )
             ),
             'meta_input'   => array(
                 '_car_uniq_key' => $uniqid,
                 '_car_wagentitel_key' => $wagentitel,
                 '_car_modifieddate_key' => $changedTimestap,
                 '_car_eersteinschrijving_key' => $eersteinschrijving,
                 '_car_carrosserievorm_key' => $carrosserievorm,
                 '_car_zitplaatsen_key' => $zitplaatsen,
                 '_car_brandstof_key' => $brandstof,
                 '_car_aantaldeuren_key' => $aantaldeuren,
                 '_car_staat_key' => $staat,
                 '_car_kilometerstand_key' => $kmstand,
                 '_car_transmissie_key' => $transmissie,
                 '_car_bouwjaar_key' => date('Y', strtotime($bouwjaar)),
                 '_car_kw_key' => $vermogenkw,
                 '_car_pk_key' => $vermogenpk,
                 '_car_cilinderinhoud_key' => $cilinderinhoud,
                 '_car_kleurinterieur_key' => $kleurinterieur,
                 '_car_kleurexterieur_key' => $kleurexterieur,
                 '_car_prijs_key' => $price,
                 '_car_oudeprijs_key' => $oudeprijs,
                 '_car_badge_key' => $badge,
                 '_car_btwaftrekbaar_key' => $btwaftrekbaar,
                 '_car_emissieklasse_key' => $emissieklasse,
                 '_car_co_key' => $co,
                 '_car_enter_media_key' => $entertainmentenmedia,
                 '_car_comfort_key' => $comfortengemak,
                 '_car_veiligheid_key' => $veiligheid,
                 '_car_extra_key' => $extraopties,
                 '_car_syncimages_key' => $syncimages,
                 '_car_sync_key' => 'YES',
                 '_car_description_key' => $description,
                 '_car_merkcf_key' => $merk,
                 '_car_modelcf_key' => $model,
                 '_car_vin_key' => $vin,
                 '_car_post_status_key' => 'actief',
                 '_car_status_key' => 'tekoop',
                 '_car_carpass_key' => $carpass_link
                 ),
             );

            //  if(!empty($zapier_billit_key)){
            //     wp_zapier_billit(array(
            //         '_car_uniq_key' => $uniqid,
            //         '_car_wagentitel_key' => $wagentitel,
            //         '_car_modifieddate_key' => $changedTimestap,
            //         '_car_eersteinschrijving_key' => $eersteinschrijving,
            //         '_car_carrosserievorm_key' => $carrosserievorm,
            //         '_car_zitplaatsen_key' => $zitplaatsen,
            //         '_car_brandstof_key' => $brandstof,
            //         '_car_aantaldeuren_key' => $aantaldeuren,
            //         '_car_staat_key' => $staat,
            //         '_car_kilometerstand_key' => $kmstand,
            //         '_car_transmissie_key' => $transmissie,
            //         '_car_bouwjaar_key' => date('Y', strtotime($bouwjaar)),
            //         '_car_kw_key' => $vermogenkw,
            //         '_car_pk_key' => $vermogenpk,
            //         '_car_cilinderinhoud_key' => $cilinderinhoud,
            //         '_car_kleurinterieur_key' => $kleurinterieur,
            //         '_car_kleurexterieur_key' => $kleurexterieur,
            //         '_car_prijs_key' => $price,
            //         '_car_oudeprijs_key' => $oudeprijs,
            //         '_car_badge_key' => $badge,
            //         '_car_btwaftrekbaar_key' => $btwaftrekbaar,
            //         '_car_emissieklasse_key' => $emissieklasse,
            //         '_car_co_key' => $co,
            //         '_car_enter_media_key' => $entertainmentenmedia,
            //         '_car_comfort_key' => $comfortengemak,
            //         '_car_veiligheid_key' => $veiligheid,
            //         '_car_extra_key' => $extraopties,
            //         '_car_syncimages_key' => $syncimages,
            //         '_car_sync_key' => 'YES',
            //         '_car_description_key' => $description,
            //         '_car_merkcf_key' => $merk,
            //         '_car_modelcf_key' => $model,
            //         '_car_vin_key' => $vin,
            //         '_car_post_status_key' => 'actief',
            //         '_car_status_key' => 'tekoop',
            //         '_car_carpass_key' => $carpass_link
            //         ));
            //  }
                
                wp_insert_post($post_arr);
            }
            
            
        }
        
       
    }
    }
    
    
}

?>