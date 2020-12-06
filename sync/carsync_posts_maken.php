<?php

function carsync_posts_maken(){
    $allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );
foreach ($allposts as $eachpost) {
  wp_delete_post( $eachpost->ID, true );
}

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
        //SET VARS
    
        $uniqid = $car['id'];
        $merk = $car['details']['vehicle']['classification']['make']['formatted'];
        $model = $car['details']['vehicle']['classification']['model']['formatted'];
        $merkenmodel = esc_html($merk) . " ". esc_html($model);
        $eerste_insch = $car['details']['vehicle']['classification']['model']['formatted'];

        
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
        
        $comfortengemak = $car['details']['vehicle']['equipment']['as24'];
        $entertainmentenmedia = $car['details']['vehicle']['equipment']['as24'];
        $extraopties = $car['details']['vehicle']['equipment']['as24'];
        $veiligheid = $car['details']['vehicle']['equipment']['as24'];

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
                '_car_bouwjaar_key' => $bouwjaar,
                '_car_kw_key' => $vermogenkw,
                '_car_pk_key' => $vermogenpk,
                '_car_cilinderinhoud_key' => $cilinderinhoud,
                '_car_kleurinterieur_key' => $kleurinterieur,
                '_car_kleurexterieur_key' => $kleurexterieur,
                '_car_prijs_key' => $price,
                '_car_oudeprijs_key' => $oudeprijs,
                '_car_btwaftrekbaar_key' => $btwaftrekbaar,
                '_car_emissieklasse_key' => $emissieklasse,
                '_car_co_key' => $co,
                '_car_enter_media_key' => $entertainmentenmedia,
                '_car_comfort_key' => $comfortengemak,
                '_car_veiligheid_key' => $veiligheid,
                '_car_extra_key' => $extraopties,
                '_car_sync_key' => 'YES'
            ),
        );
        wp_insert_post($post_arr);
    }
}

}

?>