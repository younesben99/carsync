<?php

include(__DIR__."/../../../../../wp-load.php");
require(__DIR__ . '/../../vendor/autoload.php');

use Dompdf\Dompdf;




if(is_user_logged_in() && isset($_GET)){




    

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


    ob_start();

    ?>

<style>

.checkboxvakje {
    width: 15px;
    height: 17px;
    border: 1px solid black;
    text-align: center;
}

</style>
<!-- <div style="background:blue;width:120%;position:absolute; height:80px;left:-50px;top:-75px;">
  
</div> -->
<div style="text-align:center;">
<h2>Interne aankoopborderel</h2>
</div>

<div style="text-align:left;width:100%;">
<table>
    <tr><td>Naam: <?php echo($klant_FIRMANAAM); ?></td></tr>
    <tr><td>Adres: <?php echo($klant_Adres); ?></td></tr>
    <tr><td>Tel: <?php echo($klant_Tel); ?></td></tr>
</table>
</div>


<div style="width:100%;">
<table style="text-align: right;width: 100%;">
    <tr><td><?php echo($dealer_FIRMANAAM); ?></td></tr>
    <tr><td>Adres: <?php echo($dealer_Adres); ?></td></tr>
    <tr><td>Tel: <?php echo($dealer_Tel); ?></td></tr>
    <tr><td>Tel: <?php echo($dealer_Tel2); ?></td></tr>
    <tr><td>BTW: <?php echo($dealer_BTW); ?></td></tr>
</table>
</div>

<div style="margin-bottom:80px;">
<h4>Offertenummer: <?php echo($offertenr) ?></h4>
De actuele staat van het voertuig is gekend door de koper<br><br>
Merk/model: <?php echo($merkmodel) ?><br>
Datum van de eerste inschrijving: <?php echo($eersteinsch); ?><br>
Chassis n°: <?php echo $vin; ?><br>
Motorisatie: <?php echo $motorisatie ." "; ?>(<?php echo $brandstof; ?>)<br>
Cylinderinhoud: <?php echo $cylinderinhoud; ?> CC<br>
KW / PK: <?php echo $kw; ?> / <?php echo $pk; ?> Ch<br>
Kilometers: <?php echo $kilometers; ?> Km<br>
Staat voorste banden: <?php echo $staatbanden_voor; ?> mm | Staat achterste banden: <?php echo $staatbanden_achter; ?> mm<br>
<br>Datum van aankoop: <?php echo $aankoopdatum; ?><br>
</div>

<div style="width:100%;">
<div style="width:45%;text-align:right;   display: inline-block;float:right;">

Aan de prijs van: <?php echo($aankoop_boekhoudkundige); ?> EUR Alles inb.<br>
Bankoverschrijving (<?php echo $reknr; ?>)
<br>
<br>
<div style="color:#db0000;">
Aankoopprijs boekhoudkundige: <?php echo($aankoop_boekhoudkundige); ?> EUR<br>
Premie invoerder: <?php echo($premie_invoerder); ?> EUR<br>
Overdracht korting: <?php echo($overdracht_korting); ?> EUR
</div>
</div>
<div  style="width:50%;   display: inline-block;">
<h4>Voertuig vrij is van financiële lasten. </h4>


<div style="width:300px;">
    <table style="text-align: left;width: 100%;">
        <tr>
        <td>inschrijvingdocument (2x): </td><td><div class="checkboxvakje"><?php echo $inschrijvingdocument; ?></div></td>
        </tr>
        <tr>
        <td>Gelijkvormigheids attest: </td><td><div class="checkboxvakje"><?php echo $gelijkvormigheids_attest; ?></div></td>
        </tr>
        <tr>
        <td>Keuringsbewijs: </td><td><div class="checkboxvakje"><?php echo $keuringsbewijs; ?></div></td>
        </tr>
        <tr>
        <td>Onderhoudsboekje: </td><td><div class="checkboxvakje"><?php echo $onderhoudsboekje; ?></div></td>
        </tr>
        <tr>
        <td>Gebruikershandleiding: </td><td><div class="checkboxvakje"><?php echo $gebruikershandleiding; ?></div></td>
        </tr>
        <tr>
        <td>Aankoopfactuur: </td><td><div class="checkboxvakje"><?php echo $aankoopfactuur; ?></div></td>
        </tr>
        <tr>
        <td>Alarm attest: </td><td><div class="checkboxvakje"><?php echo $alarm_attest; ?></div></td>
        </tr>
        <tr>
        <td>2 sleutels: </td><td><div class="checkboxvakje"><?php echo $aantal_sleutels; ?></div></td>
        </tr>
    </table>

</div>
    </div>

</div>
<div class="page_break"></div>




<div style="text-align:center;">
<h2>Aankoopborderel</h2>
</div>

<div style="text-align:left;width:100%;">
<table>
    <tr><td><?php echo($klant_FIRMANAAM); ?></td></tr>
    <tr><td><?php echo($klant_Adres); ?></td></tr>
    <tr><td><?php echo($klant_Tel); ?></td></tr>
</table>
</div>


<div style="width:100%;">
<table style="text-align: right;width: 100%;">
    <tr><td><?php echo($dealer_FIRMANAAM); ?></td></tr>
    <tr><td><?php echo($dealer_Adres); ?></td></tr>
    <tr><td>Tel: <?php echo($dealer_Tel); ?></td></tr>
    <tr><td>Tel: <?php echo($dealer_Tel2); ?></td></tr>
    <tr><td>BTW: <?php echo($dealer_BTW); ?></td></tr>
</table>
</div>

<div style="margin-bottom:80px;">
<h4>Offertenummer: <?php echo($offertenr) ?></h4>
De actuele staat van het voertuig is gekend door de koper<br><br>
Merk/model: <?php echo($merkmodel) ?><br>
Datum van de eerste inschrijving: <?php echo($eersteinsch); ?><br>
Chassis n°: <?php echo $vin; ?><br>
Motorisatie: <?php echo $motorisatie ." "; ?>(<?php echo $brandstof; ?>)<br>
Cylinderinhoud: <?php echo $cylinderinhoud; ?> CC<br>
KW / PK: <?php echo $kw; ?> / <?php echo $pk; ?> Ch<br>
Kilometers: <?php echo $kilometers; ?> Km<br>
Staat voorste banden: Goed <?php echo $staatbanden_voor; ?> mm | Staat achterste banden: Goed <?php echo $staatbanden_achter; ?> mm (Geleverd met Zomerset)<br>
<br>Datum van aankoop: <?php echo $aankoopdatum; ?><br>
</div>

<div style="width:100%;">
<div style="width:45%;text-align:right;   display: inline-block;float:right;">

Aan de prijs van: <?php echo($aankoop_boekhoudkundige); ?> EUR Alles inb.<br>
Bankoverschrijving (<?php echo $reknr; ?>)
<br>
<br>
</div>
<div  style="width:50%;   display: inline-block;">
<h4>Voertuig vrij is van financiële lasten. </h4>


<div style="width:300px;">
<table style="text-align: left;width: 100%;">
        <tr>
        <td>inschrijvingdocument (2x): </td><td><div class="checkboxvakje"><?php echo $inschrijvingdocument; ?></div></td>
        </tr>
        <tr>
        <td>Gelijkvormigheids attest: </td><td><div class="checkboxvakje"><?php echo $gelijkvormigheids_attest; ?></div></td>
        </tr>
        <tr>
        <td>Keuringsbewijs: </td><td><div class="checkboxvakje"><?php echo $keuringsbewijs; ?></div></td>
        </tr>
        <tr>
        <td>Onderhoudsboekje: </td><td><div class="checkboxvakje"><?php echo $onderhoudsboekje; ?></div></td>
        </tr>
        <tr>
        <td>Gebruikershandleiding: </td><td><div class="checkboxvakje"><?php echo $gebruikershandleiding; ?></div></td>
        </tr>
        <tr>
        <td>Aankoopfactuur: </td><td><div class="checkboxvakje"><?php echo $aankoopfactuur; ?></div></td>
        </tr>
        <tr>
        <td>Alarm attest: </td><td><div class="checkboxvakje"><?php echo $alarm_attest; ?></div></td>
        </tr>
        <tr>
        <td>2 sleutels: </td><td><div class="checkboxvakje"><?php echo $aantal_sleutels; ?></div></td>
        </tr>
    </table>

</div>
    </div>

  <br>
  <br>
  <p>Voldaan,</p>
</div>
<div class="page_break"></div>



<div style="text-align:center;">
<h2>Bewijs van eigendom</h2>
</div>

<h4>Offertenummer: <?php echo($offertenr) ?></h4><br>
Ik ondergetekende <?php echo $klant_FIRMANAAM; ?><br><br>
Wonende te: test adress - 3500 hasselt<br><br><br>

(1) Indien persoonlijke wagen: eigenaar van het hieronder beschreven voertuig.<br>
(1) Indien voertuig van een maatschappij.<br><br><br>
Werkt als ..................................................................................................<br>
Van de maatschappij: ..................................................................................................<br>
Waarvan de sociale zetel is: ..................................................................................................<br>
Verklaar op eer dat het voertuig:<br><br><br>
Merk/model: <?php echo $merkmodel ?><br><br>
Chassis n°: <?php echo $vin; ?><br><br>
 (1) mijn eigendom is<br>
 (1) de eigendom is van de genoemde maatschappij hier vermeld waarvoor ik mag optreden<br><br><br>
Ik verklaar dat dit voertuig aan geen enkele afbetaling onderworpen is, een eventuele lening gekregen voor het<br>
aankopen en dat herstellingen volledig betaald zijn zonder verdere intresten en onkosten.<br><br>
Ik verklaar dat dit voertuig niet onderworpen is aan bankbeslag en aan niemand in pand is gegeven.<br><br>
Ik herken dat de handtekening van dit document een eerste voorwaarde was voor het in bezit nemen van het voertuig<br>
door de koper en beloof hem te vergoeden indien er schade is en interest eisen in verband met de onjuistheid van de
vorige verklaring.<br><br><br>
Gemaakt te <?php echo($dealer_city) ?> de <?php  echo($aankoopdatum); ?><br><br><br>
Naam + handtekening met vermelding: gelezen en goedgekeurd<br><br>
 (1) Het onnodige wissen<br>

 <div class="page_break"></div>


 <div style="text-align:center;">
<h2>Bewijs van BTW</h2>
</div>

Offertenummer: <?php echo($offertenr) ?><br><br>
Ik ondergetekende <?php echo $klant_FIRMANAAM; ?><br><br>
Werken als (particulier, morale persoon niet onderworpen; onderworpen artikel 44, code BTW, onderworpen 56§2 code
BTW) gedurende de verkoop van mijn wagen. (hierna vermeld):<br><br><br>
Merk/model: <?php echo $merkmodel ?><br><br>
Motorisatie: <?php echo $motorisatie ." "; ?><br><br>
Cylinderinhoud: <?php echo $cylinderinhoud ." "; ?> CC<br><br>
KW / PK: <?php echo $kw ." "; ?> / <?php echo $pk; ?><br><br>
Chassis n°: <?php echo $vin; ?><br><br><br>
Datum waar de wagen voor de eerste keer in circulatie kwam: <?php echo $eersteinsch; ?><br><br><br>
Verklaar geen enkel recht op vermindering (of vergunning) van de BTW te hebben gehad. (Staking koop, in bezit nemen
intra communautair of invoer van dit voertuig, evenals geen vrijstelling van de BTW.<br><br><br>
Gemaakt te <?php echo $dealer_city; ?> de <?php echo($aankoopdatum); ?><br><br><br><br><br>
Handtekening,<br><br><br><br><br><br>
(art.44 = onderworpen vrijgesteld)<br>
(art.56§2 = onderworpen aan franchise)<br>
(C.A:225,000/jaar maxi) 

<div class="page_break"></div>

<div style="text-align:center;">
<h2>Aangifte van echtheid</h2>
</div>

Offertenummer: <?php echo($offertenr) ?><br><br>
Ondertekenende<br><br>
<?php echo($klant_FIRMANAAM); ?><br><br>
verklaart hierbij dit document te ondertekenen dat de wagen met chassis nummer: WDB12303310070136<br><br><br><br>
Geen motortuning heeft ondergaan. Indien wel brengt hij/zij de wagen terug in de staat overeengekomen met de<br><br>
concessiehouder:<br><br>
<?php echo($dealer_FIRMANAAM); ?><br>
<?php echo($dealer_Adres); ?><br><br>
Heeft geen ongeval gehad die één of meerdere beschadigingen heeft veroorzaakt aan volgende onderdelen: chassis,
stuurinrichting, ophanging, remsysteem, of een totaal verlies zal verplicht worden zijn voertuig aan te bieden aan een
erkend controleorganisme van de automobielinspectie voor een controle "na ongeval" voorzien in artikel 23 van het
koninklijk arrest van 15 maart 1968. Ik erken dat ik door de koper op de hoogte ben gesteld dat dit een essentieel
onderdeel van zijn aankoopovereenkomst is.<br><br>
Indien deze verklaring de realiteit tegenspreekt, accepteer ik dat de koper het recht heeft naar keuze de aankoop te
annuleren of een vermindering van de prijs toe te passen, vastgesteld op een minimum van ....% van de verkoopprijs
van de wagen
<br><br><br><br><br><br>
 op gemaakt in 2 exemplaren: <?php echo($dealer_city. " "); ?> <?php echo($aankoopdatum); ?><br><br><br><br>
 De verkoper *** De koper ***<br><br>
*** : Naam + handtekening gevolgd door « gelezen en goedgekeurd ».<br><br>

    <?php
    $innerhtml = ob_get_clean();


$base64img = $dds_settings_options['pdf_logo_base64'];
$bg_img = file_get_contents('./img/PDF_KADER.png');
$bg_img_base64 = 'data:image/png;charset=utf-8;base64,' . base64_encode($bg_img);


$html .= "<html>
<head>
  <style>
  body {  
    font-family: 'Helvetica' !important;
    background-image: url(" . $bg_img_base64 . ");
}
    @page { margin:75px 50px 50px;font-size:14px; }
   
    #header { position: fixed; left: 0px; top: -60px; right: 0px; height: 70px; text-align: left; }
    #footer {width:100%; display:block;font-style:italic;color:grey;position: fixed; left: 0px; bottom: -25px; right: 0px; height: 50px; }
   
    

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
    <h1><img height='30' width='120' src='data:image/png;charset=utf-8;base64, ".$base64img."' alt='' /></h1>
   
  </div>
  <div class='content'>

".$innerhtml."
  </div></body>
</html>";




$slugpre = "aankoop_overeenkomst_".$merkmodel."_".$vin;
$slug = strtoupper(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $slugpre)));



$dompdf = new Dompdf(array('enable_remote' => true));
$dompdf->loadHtml($html);




$dompdf->render();
$canvas = $dompdf->get_canvas();
$cpdf = $canvas->get_cpdf();

$font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");

$firstPageId = $cpdf->getFirstPageId();
$objects = $cpdf->objects;
$pages = array_filter($objects, function($v) {
    return $v['t'] == 'page';
});
$number = 1;
foreach($pages as $pageId => $page) {
    if(($pageId + 1) !== $firstPageId) {
        $canvas->reopen_object($pageId + 1);
        $canvas->text(50, 740, "$number", $font, 10, array(0,0,0));
        $canvas->close_object();
        $number++;
    }
}

$dompdf->stream($slug.".pdf", array("Attachment" => false));

exit(0);


}
else{
    echo("?");
    exit;
}

?>