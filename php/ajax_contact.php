<?php

include(__DIR__."/../../../../wp-load.php");

if(!empty($_POST['sp_contact_name']) && !empty($_POST['sp_contact_mail']) && !empty($_POST['sp_contact_tel']) && !empty($_POST['sp_contact_bericht'])){
    
    $dds_settings_options = get_option( 'dds_settings_option_name' );
    
    $sp_contactmail = $dds_settings_options['dealer_contact_mail'];
    
 
    $name = $_POST['sp_contact_name'];
    $email = $_POST['sp_contact_mail'];
    $tel = $_POST['sp_contact_tel'];
    $message = "Naam: ".$name . "Tel: ".$tel . "Bericht: ".$_POST['sp_contact_bericht'];

    $to = $sp_contactmail;
    $subject = "Contactbericht";
    $headers = 'From: '. $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n";
  

  
    $sent = wp_mail($to, $subject, strip_tags($message), $headers);
        if($sent) {
            echo("verstuurd");
       }
        else  {
            echo("er is een probleem, probeer later opnieuw");
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
?>