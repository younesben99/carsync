<?php
include(__DIR__."/../../../../../wp-load.php");
require(__DIR__ . '/../../vendor/autoload.php');

use Mpdf\Mpdf;


$mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

$bg_img = file_get_contents('./img/PDF_KADER.png');

$bg_img_base64 = 'data:image/png;charset=utf-8;base64,' . base64_encode($bg_img);
$dds_settings_options = get_option( 'dds_settings_option_name' );
$post_id = $_GET["pid"];

foreach($_GET as $key => $field){
  update_post_meta($post_id,$key,$field);
}

$custom_fields = get_post_custom($post_id);


$blocks = array();

  
foreach($custom_fields as $topkey => $fieldarr){


      
      foreach($fieldarr as $key => $fields){
          $blocks[$topkey] = $fields;
      }
  
  
  
}

    
$klant_FIRMANAAM = $_GET["klantnaam"];
$klant_Adres = str_replace(",",",<br>",$_GET["klantadres"]);




$klant_Tel = $_GET["klanttel"];
$aankoop_boekhoudkundige = !empty($_GET["aankoop_boekhoudkundige"]) ? $_GET["aankoop_boekhoudkundige"] : "_________";
$premie_invoerder = !empty($_GET["premie_invoerder"]) ? $_GET["premie_invoerder"] : "0.00";
$overdracht_korting = !empty($_GET["overdracht_korting"]) ? $_GET["overdracht_korting"] : "0.00";
$reknr = !empty($_GET["reknr"]) ? $_GET["reknr"] : "______________________";

if(!empty($_GET["aankoopdatum"])){
  $aankoopdatum = date("d/m/Y",strtotime($_GET["aankoopdatum"]));
}
else{
  $aankoopdatum =  "______/_______/_______";
}

$dealer_FIRMANAAM = $dds_settings_options['dealer_handelsnaam_8'];
$dealer_Adres = str_replace(",",",<br>",$dds_settings_options['dealer_adres_9']);

$dealer_city = $dds_settings_options['dealer_city_9'];
$dealer_Tel = $dds_settings_options['dealer_tel_1_10'];
$dealer_Tel2 = $dds_settings_options['dealer_tel_2_11'];
$dealer_BTW = $dds_settings_options['dealer_btw'];

$merk =  $blocks['_car_merkcf_key'];
$model = $blocks['_car_modelcf_key'];
$merkmodel = $merk. " ".$model;

if(empty($merk) && empty($model)){
  $merkmodel = $blocks['BlockB_MakeTypeDescr'] ." " .$blocks['BlockB_CommercialName'];
}

$merkmodel = empty($merkmodel) ? "_____________" : $merkmodel; 
$brandstof = empty($blocks['_car_brandstof_key']) ? "_____________" : $blocks['_car_brandstof_key'];

if(empty($blocks['_car_eersteinschrijving_key'])){
  $eersteinsch = $blocks['BlockR_FirstRegistrationDate'];
}else{
  $eersteinsch = $blocks['_car_eersteinschrijving_key'];
  if(empty($eersteinsch)){
    $eersteinsch =  "___________";
  }
}
$vin = empty($blocks['_car_vin_key']) ? "________________________" : $blocks['_car_vin_key'];
$motorisatie = number_format(round((float)$blocks['_car_cilinderinhoud_key'] / 1000,2),1,'.',' ');
if($motorisatie == 0.0){
  $motorisatie = "____";
}
$cylinderinhoud = empty($blocks['_car_cilinderinhoud_key']) ? "_________" : $blocks['_car_cilinderinhoud_key'];
$kw = empty($blocks['_car_kw_key']) ? "____" : $blocks['_car_kw_key'];
$pk = empty($blocks['_car_pk_key']) ? "____" : $blocks['_car_pk_key'];
$kilometers = empty($blocks['_car_kilometerstand_key']) ? "_____________" : $blocks['_car_kilometerstand_key'];
$carrosserievorm = empty($blocks['_car_carrosserievorm_key']) ? "_____________" : $blocks['_car_carrosserievorm_key'];
$staatbanden_voor = empty($blocks['_car_bandenstaat_voor_key']) ? "____" : $blocks['_car_bandenstaat_voor_key'];
$staatbanden_achter = empty($blocks['_car_bandenstaat_achter_key']) ? "____" : $blocks['_car_bandenstaat_achter_key'];


$inschrijvingdocument = empty($blocks['_car_inschrijvingdocument_key']) || $blocks['_car_inschrijvingdocument_key'] == "no" ? "" : "X";
$gelijkvormigheids_attest = empty($blocks['_car_gelijkvormigheids_attest_key']) || $blocks['_car_gelijkvormigheids_attest_key'] == "no"  ? "" : "X";
$keuringsbewijs = empty($blocks['_car_keuringsbewijs_key']) || $blocks['_car_keuringsbewijs_key'] == "no"  ? "" : "X";
$onderhoudsboekje = empty($blocks['_car_onderhoudsboekje_key']) || $blocks['_car_onderhoudsboekje_key'] == "no"  ? "" : "X";
$gebruikershandleiding = empty($blocks['_car_gebruikershandleiding_key']) || $blocks['_car_gebruikershandleiding_key'] == "no"  ? "" : "X";
$aankoopfactuur = empty($blocks['_car_aankoopfactuur_key']) || $blocks['_car_aankoopfactuur_key'] == "no"  ? "" : "X";
$alarm_attest = empty($blocks['_car_alarm_attest_key']) || $blocks['_car_alarm_attest_key'] == "no"  ? "" : "X";
$aantal_sleutels = empty($blocks['_car_2_sleutels_key']) || $blocks['_car_2_sleutels_key'] == "no"  ? "" : "X";




if (is_user_logged_in() && isset($_GET)) {
    // Your existing logic here

    ob_start();
    ?>
   <style>
   
@page :first  { 
        /* background-image: url(<?php echo $bg_img_base64 ?>); */
        /* background-image-resize: 6; */
    }

h2,h3,h4,h5,h6,p,ul,li,ol{  font-family:arial;}
        table {
            width: 100%;
            border-collapse: collapse;
            font-family:arial;
        }

        table, th, td {
            border: 0px solid black;
        }

        th, td {
            padding: 2px;
            text-align: left;
        }
    </style>
<div>
    <h2 style="color:#CC6701;">AANKOOPBORDEREL VERVOERMIDDEL (PARTICULIER AAN
BELASTINGPLICHTIGE)</h2>


<table>
    <tr>
        <th>Verkoper</th>
        <th>Koper</th>
    </tr>
    <tr>
        <td>Naam: <?= $klant_FIRMANAAM ?></td>
        <td>Naam: <?= $dealer_FIRMANAAM ?></td>
    </tr>
    <tr>
        <td>Adres: <?= $klant_Adres ?></td>
        <td>Adres: <?= $dealer_Adres ?></td>
    </tr>
    <tr>
        <td></td>
        <td>Btw-nummer: <?= $dealer_BTW ?></td>
    </tr>
    <tr>
        <td>Datum aankoop: <?= $aankoopdatum ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Nummer inkoopregister: </td>
        <td></td>
    </tr>
    <tr>
        <td>Nummer inkoopdagboek:</td>
        <td></td>
    </tr>
</table>

<h3>Voor de levering en aankoop van het volgende vervoermiddel:</h3>

<table style="width:70%;">
    <tr>
        <td>Aard:</td>
        <td>Merk: <?= $merk ?></td>
    </tr>
    <tr>
        <td>Model: <?= $model ?></td>
        <td>Type: <?= $carrosserievorm ?></td>
    </tr>
  
    <tr>
        <td>Chassisnummer: <?= $vin ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Bouwjaar: <?= $eersteinsch ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Datum van eerste inschrijving: <?= $eersteinsch ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Aantal kilometers: <?= $kilometers ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Cilinderinhoud: <?= $cylinderinhoud ?> CC</td>
        <td>Motorvermogen: <?= $kw ?> kW</td>
    </tr>
    <tr>
        <td>Overeengekomen aankoopprijs:</td>
        <td>€ <?= $aankoop_boekhoudkundige ?></td>
    </tr>
    <tr>
        <td>Betaalwijze:</td>
        <td>Contant<br>Overschrijving<br>Cheque</td>
    </tr>
</table>

<h4>Opgemaakt te <?= $dealer_city ?>, in twee exemplaren, waarvan één</h4>
<h4>exemplaar overhandigd aan de verkoper op het tijdstip van de levering</h4>
<h4>en waarvan het andere exemplaar bestemd is voor de boekhouding van</h4>
<h4>de koper.</h4>

<table>
    <tr>
        <td>Voor waar en echt verklaard</td>
        <td>Voor waar en echt verklaard</td>
    </tr>
    <tr>
        <td>Verkoper</td>
        <td>Aankoper</td>
    </tr>
    <tr>
        <td>Hoedanigheid</td>
        <td>Hoedanigheid</td>
    </tr>
    <tr>
        <td>Handtekening</td>
        <td>Handtekening</td>
    </tr>
</table>

<h2>In bijlage van deze aankoopborderel:</h2>
<ul>
    <li>een verklaring omtrent de hoedanigheid van de verkoper</li>
    <li>inschrijvingsbewijs en gelijkvormigheidattest</li>
</ul>

<p><?= $dealer_city ?></p>

<p><?= $dealer_FIRMANAAM ?></p>
<p>Zaakvoerder</p>

<h2>ATTEST</h2>

<p>Ik, ondergetekende, naam : ................ voornaam : ........ .. .. .. .. .. .,</p>
<p>handelend als ...................................(particulier; niet-belastingplichtige rechtspersoon; belastingplichtige artikel 44, BTW-Wetboek; belastingplichtige artikel 56, § 2, BTW-Wetboek;) bij de verkoop van mijn</p>
<p>hierna omschreven vervoermiddel :</p>
<table>
    <tr>
        <td>MERK: <b><?= $merk ?></b></td>
        <td></td>
    </tr>
    <tr>
        <td>MODEL: <b><?= $model ?></b></td>
        <td></td>
    </tr>
    <tr>
        <td>CILINDERINHOUD: <b><?= $cylinderinhoud ?> CC</b></td>
        <td></td>
    </tr>
    <tr>
        <td>MOTORSTERKTE: <b><?= $kw ?> kW</b></td>
        <td></td>
    </tr>
    <tr>
        <td>CHASSISNUMMER: <b><?= $vin ?></b></td>
        <td></td>
    </tr>
    <tr>
        <td>BOUWJAAR: <b><?= $eersteinsch ?></b></td>
        <td></td>
    </tr>
    <tr>
        <td>KILOMETERSTAND: <b><?= $kilometers ?></b></td>
        <td></td>
    </tr>
    <tr>
        <td>DATUM WAAROP HET VERVOERMIDDEL</td>
        <td>VOOR HET EERST IN HET VERKEER</td>
    </tr>
    <tr>
        <td>WERD GEBRACHT: <b><?= $eersteinsch ?></b></td>
        <td></td>
    </tr>
</table>
<p>verklaar geen enkel recht op aftrek (of teruggave) van de BTW geheven</p>
<p>bij de aankoop, bij de intracommunautaire verwerving of bij de invoer</p>
<p>van dit vervoermiddel te hebben kunnen uitoefenen, noch recht te</p>
<p>hebben gehad op een vrijstelling van de BTW.</p>

<p>Gedaan te ............., ........... 20..</p>

<p>Handtekening</p>



</div>

    <?php
    $innerhtml = ob_get_clean();

   
    $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
    $mpdf->WriteHTML($innerhtml);


    $slugpre = "aankoop_overeenkomst_".$merkmodel."_".$vin;
    $slug = strtoupper(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $slugpre)));
    $mpdf->Output($slug . '.pdf', 'I');
    exit(0);
} else {
    echo("?");
    exit;
}
?>
