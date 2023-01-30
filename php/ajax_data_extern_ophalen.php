<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

ini_set('xdebug.var_display_max_depth', 10000);
ini_set('xdebug.var_display_max_children', 25006);
ini_set('xdebug.var_display_max_data', 1000024);


include(__DIR__."/../../../../wp-load.php");

// $response = file_get_contents("http://api.inmotiv.be/rest/lookup/1.6/1fe6395c-8831-4d16-864c-a4357a919953/VF32KNFUR44535797/BXERSTPCAVF/%207705/15060259");

        
// $xml = json_encode(simplexml_load_string($response));
// $meta_input_im = json_decode($xml,true);
// $vincheck = json_decode($xml,true);

// $meta_input_im = $meta_input_im["Block"];

// $blocks = array();

// if(is_array($meta_input_im)){
//     for ($i=0; $i < count($meta_input_im); $i++) { 

//         $key = $meta_input_im[$i]["@attributes"]["id"];
    
//         $blocks[$key] = $meta_input_im[$i];
    
//     }
// }
// else{
//     if(isset($vincheck["Error"]['ErrorType'])){

//         if($vincheck["Error"]['ErrorType'] == "NOTFOUND"){
//             $vincheck["VIN"] = $_POST['vin'];
//             wp_mail("info@digiflow.be","Error Inmotiv call | Vin bestaat niet",json_encode($vincheck));
//         }

//     else{

//         wp_mail("info@digiflow.be","Error Inmotiv call | Andere",json_encode($vincheck));
//     }

//     }
    
// }




if(isset($_POST)){

    if ($_POST['typeofpost'] == "new" && isset($_POST['data_tp'])) {

        try {
         
       
        $url = $_POST['data_tp'];

        $response = file_get_contents($url);
        
        $xml = json_encode(simplexml_load_string($response));
        $meta_input_im = json_decode($xml, true);
        $meta_input_im = $meta_input_im["Block"];
        $vincheck = json_decode($xml,true);
        $blocks = array();

        
        if(is_array($meta_input_im)){
            for ($i=0; $i < count($meta_input_im); $i++) { 

                $key = $meta_input_im[$i]["@attributes"]["id"];
            
                $blocks[$key] = $meta_input_im[$i];
            
            }


        $dds_fields = [
            '_car_bouwjaar_key' => date('Y', strtotime($blocks["BlockR"]['FirstRegistrationDate'])),
            '_car_brandstof_key' => $blocks['BlockB']['FuelType'],
            '_car_carrosserievorm_key' => $blocks['BlockX']['Kind'],
            '_car_cilinderinhoud_key' => $blocks['BlockX']['TotalCylinderCapacity'],
            '_car_co_key' => $blocks['BlockE']['Co2Combined'],
            '_car_eersteinschrijving_key' => $blocks['BlockR']['FirstRegistrationDate'],
            '_car_emissieklasse_key' => $blocks['BlockE']['ExhaustEmissionLevelEuro'],
            '_car_kleurexterieur_key' => $blocks['BlockB']['Colour'],
            '_car_kw_key' => $blocks['BlockX']['MaxNetPower'],
            '_car_merkcf_key' => $blocks['BlockB']['MakeTypeDescr'],
            '_car_modelcf_key' => $blocks['BlockB']['CommercialName'],
            '_car_pk_key' => round(intval($blocks['BlockX']['MaxNetPower']) * 1.36),
            '_car_vin_key' => $_POST['vin'],
            '_car_wagentitel_key' => $blocks['BlockB']['MakeTypeDescr']. " " .$blocks['BlockB']['CommercialName'],
            '_car_zitplaatsen_key' => $blocks['BlockX']['NumberOfSeats'],
            '_car_status_key' => 'tekoop',
            '_car_post_status_key' => 'actief',
            '_car_uniq_key' => $_POST['vin'],
            'inmotiv_data_opgehaald' => 'YES'
            
        ];
        $merk = ucwords(strtolower($blocks['BlockB']['MakeTypeDescr']));
        $model = ucwords(strtolower($blocks['BlockB']['CommercialName']));
        
        $blocks = array_flatten($blocks);
        $blocks = array_merge($blocks, $dds_fields);

        global $user_ID;

       
        wp_insert_term($merk, 'merkenmodel');
        $merkpush = get_term_by('name', $merk, 'merkenmodel');
        wp_insert_term($model, 'merkenmodel', array('parent' => $merkpush->term_id));
        $modelpush = get_term_by('name', $model, 'merkenmodel');
        $new_post = array(
        'post_title' => $merk . " " . $model,
        'post_status' => 'publish',
        'post_date' => date('Y-m-d H:i:s'),
        'post_author' => $user_ID,
        'post_type' => 'autos',
        'meta_input' => $blocks,
        'tax_input'    => array(
            "merkenmodel" => array(
                $merkpush->term_id,
                $modelpush->term_id
            )
        ),
        );
        $post_id = wp_insert_post($new_post);

        $res = ['new',$post_id];
        echo(json_encode($res));
        }
        else{
            if(isset($vincheck["Error"]['ErrorType'])){

                if($vincheck["Error"]['ErrorType'] == "NOTFOUND"){
                    $vincheck["VIN"] = $_POST['vin'];
                    wp_mail("info@digiflow.be","Error Inmotiv call | Vin bestaat niet",json_encode($vincheck));
                    $res = ['error',"Chassisnr. is incorrect."];
                    echo(json_encode($res));
                }


            else{

                wp_mail("info@digiflow.be","Error Inmotiv call | Andere",json_encode($vincheck));
                $res = ['error',"Error, er is een onbekende fout opgetreden."];
                echo(json_encode($res));
            }

            }
            
        }
    }
     catch (\Throwable $th) {
        wp_mail("info@digiflow.be","Error Inmotiv call",$th);
}

    }

    if($_POST['typeofpost'] == "notnew" && isset($_POST['data_tp'])){

   try {
        $post_id = $_POST["post_id"];
        $url = $_POST['data_tp'];

        $response = file_get_contents($url);
        
        
        $xml = json_encode(simplexml_load_string($response));
        $meta_input_im = json_decode($xml,true);
        $meta_input_im = $meta_input_im["Block"];
        $vincheck = json_decode($xml,true);

        $blocks = array();

                
        if(is_array($meta_input_im)){
            for ($i=0; $i < count($meta_input_im); $i++) { 

                $key = $meta_input_im[$i]["@attributes"]["id"];
            
                $blocks[$key] = $meta_input_im[$i];
            
            }

        $car_sync_key =  get_post_meta($post_id, '_car_sync_key', true );

        if($car_sync_key !== "YES"){
            $dds_fields = [
                '_car_bouwjaar_key' => date('Y',strtotime($blocks["BlockR"]['FirstRegistrationDate'])),
                '_car_brandstof_key' => $blocks['BlockB']['FuelType'],
                '_car_carrosserievorm_key' => $blocks['BlockX']['Kind'],
                '_car_cilinderinhoud_key' => $blocks['BlockX']['TotalCylinderCapacity'],
                '_car_co_key' => $blocks['BlockE']['Co2Combined'],
                '_car_eersteinschrijving_key' => $blocks['BlockR']['FirstRegistrationDate'],
                '_car_emissieklasse_key' => $blocks['BlockE']['ExhaustEmissionLevelEuro'],
                '_car_kleurexterieur_key' => $blocks['BlockB']['Colour'],
                '_car_kw_key' => $blocks['BlockX']['MaxNetPower'],
                '_car_merkcf_key' => $blocks['BlockB']['MakeTypeDescr'],
                '_car_modelcf_key' => $blocks['BlockB']['CommercialName'],
                '_car_pk_key' => round(intval($blocks['BlockX']['MaxNetPower']) * 1.36),
                '_car_vin_key' => $_POST['vin'],
                '_car_wagentitel_key' => $blocks['BlockB']['MakeTypeDescr']. " " .$blocks['BlockB']['CommercialName'],
                '_car_zitplaatsen_key' => $blocks['BlockX']['NumberOfSeats'],
                '_car_status_key' => 'tekoop',
                '_car_post_status_key' => 'actief',
                '_car_uniq_key' => $_POST['vin'],
                'inmotiv_data_opgehaald' => 'YES'
                
            ];
           
            $merk = ucwords(strtolower($blocks['BlockB']['MakeTypeDescr']));
            $model = ucwords(strtolower($blocks['BlockB']['CommercialName']));
            $blocks = array_merge($blocks,$dds_fields);
            $blocks = array_flatten($blocks);
        }
        else{
            
            update_post_meta( $post_id, "inmotiv_data_opgehaald", "YES" );
            $merk = ucwords(strtolower($blocks['BlockB']['MakeTypeDescr']));
            $model = ucwords(strtolower($blocks['BlockB']['CommercialName']));
            $blocks = array_flatten($blocks);
          
        }
        

        

       foreach($blocks as $key => $meta){

        update_post_meta( $post_id, $key, $meta );

       }
        wp_insert_term($merk,  'merkenmodel' );
        $merkpush = get_term_by('name', $merk, 'merkenmodel');
        wp_insert_term($model,  'merkenmodel',array('parent' => $merkpush->term_id) );
        $modelpush = get_term_by('name', $model, 'merkenmodel');

        wp_set_object_terms( $post_id, array($merk,$model), 'merkenmodel',false);

        $updateTitle = array(   
            'ID' => $post_id, 
            'post_title'    => $merk . " " . $model, 
            'post_content'  => ""
        );
    
        wp_update_post( $updateTitle );

        $res = ['notnew',$post_id];
        echo(json_encode($res));
        }
        else{
            if(isset($vincheck["Error"]['ErrorType'])){

                if($vincheck["Error"]['ErrorType'] == "NOTFOUND"){
                    $vincheck["VIN"] = $_POST['vin'];
                    wp_mail("info@digiflow.be","Error Inmotiv call | Vin bestaat niet",json_encode($vincheck));
                    $res = ['error',"Chassisnr. is incorrect."];
                    echo(json_encode($res));
                }

            else{

                wp_mail("info@digiflow.be","Error Inmotiv call | Andere",json_encode($vincheck));
                $res = ['error',"Error, er is een onbekende fout opgetreden."];
                echo(json_encode($res));
            }

            }
            
        }

    }
    catch (\Throwable $th) {
       wp_mail("info@digiflow.be","Error Inmotiv call",$th);
}
    }

}






?>