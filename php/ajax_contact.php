<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");


include(__DIR__."/../../../../wp-load.php");

if($_POST['sp_contact'] == "sp_contact"){

    if(!empty($_POST['sp_contact_name']) && !empty($_POST['sp_contact_mail']) && !empty($_POST['sp_contact_tel']) && !empty($_POST['sp_contact_bericht'])){
    
        $dds_settings_options = get_option( 'dds_settings_option_name' );
        
        $sp_contactmail = $dds_settings_options['dealer_contact_mail'];
     
        $name = $_POST['sp_contact_name'];
        $email = $_POST['sp_contact_mail'];
        $tel = $_POST['sp_contact_tel'];
        $wagen = $_POST['sp_contact_wagen'];

        $message = "<h2>Contactbericht</h2><b>Wagen: ". $wagen ."</b><br>Naam: ".$name . "<br>Telefoonnummer: ".$tel . "<br>Bericht: ".$_POST['sp_contact_bericht'];
    
        $to = $sp_contactmail;
        $subject = "Contactbericht: ".$wagen;
        $headers = 'From: '. $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n";
      
    
      
        $sent = wp_mail($to, $subject, $message, $headers);
            if($sent) {
                echo(json_encode("verstuurd"));
           }
            else  {
                echo(json_encode("er is een probleem, probeer later opnieuw"));
            }
    
        
    
    }
    else{
        $verplichte_velden = array("verplichtevelden",array());
        foreach ($_POST as $key => $value) {
            if(empty($value)){
                array_push($verplichte_velden[1],$key);
            }
        }
        echo(json_encode($verplichte_velden));
        
    }

}


if($_POST['sp_testrit'] == "sp_testrit"){

    if(!empty($_POST['sp_testrit_name']) && !empty($_POST['sp_testrit_mail']) && !empty($_POST['sp_testrit_tel']) && !empty($_POST['sp_testrit_bericht'])){
    
        $dds_settings_options = get_option( 'dds_settings_option_name' );
        
        $sp_testritmail = $dds_settings_options['dealer_testrit_mail'];
     
        $name = $_POST['sp_testrit_name'];
        $email = $_POST['sp_testrit_mail'];
        $tel = $_POST['sp_testrit_tel'];
        $wagen = $_POST['sp_testrit_wagen'];

        $testrit_datum = nlDate(date("l d F Y",$_POST['sp_datum']));
        
        $testrit_tijdstip = $_POST['sp_tijdstip'];

        $message = "<h2>Testrit</h2><b>Wagen: ". $wagen ."</b><br>Naam: ".$name . "<br>Telefoonnummer: ".$tel . "<br>Bericht: ".$_POST['sp_testrit_bericht'];
        
        $message .= "<hr>";

        $message .= "Datum: ". $testrit_datum;
        $message .= "<br>Tijdstip: ".$testrit_tijdstip . " u";

        $to = $sp_testritmail;
        $subject = "Testrit: " . $wagen;
        $headers = 'From: '. $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n";
      
    
      
        $sent = wp_mail($to, $subject, $message, $headers);
            if($sent) {
                echo(json_encode("verstuurd"));
           }
            else  {
                echo(json_encode("er is een probleem, probeer later opnieuw"));
            }
    
        
    
    }
    else{
        $verplichte_velden = array("verplichtevelden",array());
        foreach ($_POST as $key => $value) {
            if(empty($value)){
                array_push($verplichte_velden[1],$key);
            }
        }
        echo(json_encode($verplichte_velden));
        
    }
    
}

?>