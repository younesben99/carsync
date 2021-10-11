<?php

include(__DIR__."/../../../../../wp-load.php");
require(__DIR__ . '/../../vendor/autoload.php');

use Dompdf\Dompdf;




if(is_user_logged_in() && isset($_GET)){

    $post_id = $_GET["pid"];

    $custom_fields = get_post_custom($post_id);

    $merk = get_post_meta($post_id,'_car_merkcf_key',true);
    $model = get_post_meta($post_id,'_car_modelcf_key',true);

    if(empty($merk) && empty($model)){
        $merk = get_post_meta($post_id,'_car_wagentitel_key',true);
        $model = "";
    }
    $vin = get_post_meta($post_id,'_car_vin_key',true);

    $blocks = array();

foreach($custom_fields as $topkey => $fieldarr){

    if(mb_substr($topkey,0,5) == "Block"){
        $blockkey = mb_substr($topkey,0,6);
        $blockkey_last = mb_substr($topkey,7);
        
        foreach($fieldarr as $key => $fields){
            $blocks[$blockkey][$blockkey_last] = $fields;
        }
    }

    
    
}

$ctr = 0;

$dds_settings_options = get_option( 'dds_settings_option_name' );


$base64img = $dds_settings_options['pdf_logo_base64'];

$html .= "<html>
<head>
  <style>
  body {  
    font-family: 'Helvetica' !important;
}
    @page { margin:75px 50px 50px; }
    #header { position: fixed; left: 0px; top: -60px; right: 0px; height: 70px; text-align: left; }
    #footer {width:100%; display:block;font-style:italic;color:grey;position: fixed; left: 0px; bottom: -25px; right: 0px; height: 50px; }
    #footer .page:after { content: counter(page); }
    .page{
        position:absolute;
        left:25px;
        bottom:10px;
    }
    .pow{
        position:absolute;
        right:50px;
        bottom:10px;
    }.page_break { page-break-before: always; }

  </style>
<body>
<div id='header'>
    <h1><img height='30' width='120' src='data:image/png;base64, ".$base64img." alt='Red dot' /></h1>
  </div>
  <div id='footer'>
    <div class='page'>Pagina </div>
    <div class='pow'>Powered by Digiflow</div>
  </div>
  <div class='content'>
";
foreach($blocks as $topkey => $fieldarr){
   

    $html .= '
    <h4>'.$fieldarr["@attributes_name"].'</h4>
    <table cellpadding="10" style="width:100%;">';
    foreach($fieldarr as $key => $field){

        if($key !== "@attributes_name" && $key !== "@attributes_id")
        {
        
        
        if($ctr % 2){
            $html .= '<tr style="background-color:#F4F4F4;">';
        }
        else{
            $html .= '<tr> ';
        }
        $html .= '<td style="width:40%;">'. $key .'</td>';
        $html .= '<td style="width:60%;">'. $field .'</td>';
        $html .= '</tr>';
        $ctr++;
    }
    }
    $html .= '</table><hr>';

   
}

$html .= "</div></body>
</html>";


$slugpre = $merk."_".$model."_".$vin;
$slug = strtoupper(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $slugpre)));




$dompdf = new Dompdf(array('enable_remote' => true));
$dompdf->loadHtml($html);




$dompdf->render();

$dompdf->stream($slug.".pdf", array("Attachment" => false));

exit(0);


}
else{
    echo("?");
    exit;
}

?>