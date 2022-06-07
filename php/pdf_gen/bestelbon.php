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

        
    $klant_FIRMANAAM = ucwords($_GET["klantnaam"]);
    update_post_meta($post_id,"klantnaam",$klant_FIRMANAAM);

    $klant_Adres = str_replace(",","<br>",$_GET["klantadres"]);
    update_post_meta($post_id,"klantadres",$klant_Adres);

    $bestelbon_nummer = $_GET["bestelbonnummer"];
    update_post_meta($post_id,"bestelbonnummer",$bestelbon_nummer);

    $klanten_nummer = $_GET["klantennummer"];
    update_post_meta($post_id,"klantennummer",$klanten_nummer);

    $datum_vandaag =  date("d-m-Y", strtotime($_GET["datumbestelbon"]));
    update_post_meta($post_id,"datumbestelbon",$_GET["datumbestelbon"]);

    $datum_dienstprestatie =  date("d-m-Y", strtotime($_GET["datumlevering"]));
    update_post_meta($post_id,"datumlevering",$_GET["datumlevering"]);


    $datum_dienstprestatie_vervaldag = date("d-m-Y", strtotime($_GET["datumvervaldag"]));
    update_post_meta($post_id,"datumvervaldag",$_GET["datumvervaldag"]);

 

    $opmerking = $_GET["bb_opmerkingen"];
    update_post_meta($post_id,"bb_opmerkingen",$opmerking);

    $voorakkoord = $_GET["bb_voorakkoord"];
    update_post_meta($post_id,"bb_voorakkoord",$voorakkoord);

    $btw_percentage = $_GET["btw_percentage"];
    update_post_meta($post_id,"btw_percentage",$btw_percentage);

    if(empty($_GET["btw_percentage"])){
        $btw_percentage = 0;
    }
    if(empty($_GET["aangepasteprijs"])){
        $prijs = empty($blocks['_car_prijs_key']) ? "________" : $blocks['_car_prijs_key'];

        if($prijs !== "________"){
            
            update_post_meta($post_id,"aangepasteprijs",$prijs);
            $prijsexcl = $prijs - ($prijs * ($btw_percentage/100));
            $prijs = "€ ".number_format($prijs,2,",",".");
            
            
        }
    }
    else{
        $prijs = "€ ".number_format($_GET["aangepasteprijs"],2,",",".");
        $pureprice = $_GET["aangepasteprijs"];
        update_post_meta($post_id,"aangepasteprijs",$pureprice);

        $prijsexcl = $pureprice - ($pureprice * ($btw_percentage/100));
    }


    $prijsexcl = "€ ".number_format($prijsexcl,2,",",".");

    

    $klant_Tel = $_GET["klanttel"];
    $aangepasteprijs = !empty($_GET["aangepasteprijs"]) ? $_GET["aangepasteprijs"] : "_________";
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
    $dealer_bank = $dds_settings_options['dealer_bank'];
    $dealer_mail = $dds_settings_options['dealer_contact_mail'];
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

    $car = dds_car($post_id);

    if(empty($_GET["aangepasteprijs"])){
        $prijs = empty($blocks['_car_prijs_key']) ? "________" : $blocks['_car_prijs_key'];

        if($prijs !== "________"){
           
            $prijs = "€ ".number_format($prijs,2,",",".");
            
        }
    }
    else{
        $prijs = "€ ".number_format($_GET["aangepasteprijs"],2,",",".");
    }
    $websitenaam = preg_replace('#^https?://#i', '', get_site_url());
    ob_start();

    ?>

<style>

.checkboxvakje {
    width: 15px;
    height: 17px;
    text-align: center;
}
table {
    border-spacing: 0px;

}
.b_tabel{
    width:100%;
    margin-bottom:15px;
}
.b_tabel td{
    vertical-align: top;
    padding-top:10px;
    text-align:right;

}
.b_intro{
    width:100%;
}
.b_intro td,.b_table_wrap td{
    vertical-align: top;
 
}
.b_table_wrap td:first-child{
   padding-right:30px;
   padding-bottom:30px;
 
}
.b_tabel_head th{
    text-align:left;
    border-bottom: 1px solid grey;
    padding-bottom:10px;
}
.b_table_default{
    border:1px solid grey;
}
.b_table_default td:first-child{
    border-bottom:1px solid lightgrey;
}
.b_table_default td{
    padding:7px;
}

</style>
<div>

<br>

<table  class="b_intro">

<tr><td><div>
<h2>
   <?php
   echo $dealer_FIRMANAAM;
   ?>

<br>Bestelbon</h2>

<div>Nummer: <?php echo $bestelbon_nummer; ?></div>
<div>Klantennummer: <?php echo $klanten_nummer; ?></div>
<br>
<div>Datum: <?php echo $datum_vandaag; ?></div>
<div>Levering / dienstprestatie: <?php echo $datum_dienstprestatie; ?></div>
<div>Vervaldag: <?php echo $datum_dienstprestatie_vervaldag; ?></div>
</div>
</td>
<td style="text-align:right;padding-top:17px;">

<?php echo $klant_FIRMANAAM; ?><br>
<?php echo $klant_Adres; ?><br>
<?php echo $klant_Postcode; ?> <?php echo $klant_Stad; ?>
<?php echo $klant_Land; ?><br>



</td>
</tr>


</table>

<br><br><br>


<table class="b_tabel">


<tr class="b_tabel_head">
    <th>Omschrijving</th>
    <th>Prijs excl</th>
    <th>#</th>
    <th>Totaal exclusief</th>
    <th>BTW</th>
    <th>Totaal inclusief</th>
</tr>
<tr>
<td style="text-align:left;">
VOERTUIGOMSCHRIJVING: <?php echo $merkmodel; ?><br>
Chassis nr.: <?php echo $vin; ?><br>
Reg.Datum:  <?php echo date("d-m-Y", strtotime($eersteinsch));  ?><br>
Kilometerstand: <?php echo $kilometers;  ?> km <br>
Brandstof: <?php echo $brandstof; ?><br>
Kw: <?php echo $kw; ?><br>
Kleur: <?php echo $car["_car_kleurexterieur_key"]; ?>

</td>

<td><?php echo $prijs; ?></td>
<td>1</td>
<td><?php echo $prijs; ?></td>
<td><?php echo $btw_percentage; ?> %</td>
<td style="background-color:lightgrey;height:240px;"><?php echo $prijs; ?></td>
</tr>

</table>


<table class="b_table_wrap" style="width:100%;">

<tr><td>

<table class="b_table_default" style="width:100%;">

<tr>
    <td>Opmerkingen:</td>

</tr>
<tr>
    <td><?php echo $opmerking; ?></td>
    
</tr>
</table>

</td><td style="width:30%;">
<table class="b_table_default" style="width:100%;">

<tr>
    <td style="border-bottom:0">Excl BTW:</td>
    <td style="text-align:right;"><?php echo $prijsexcl; ?></td>
</tr>
<tr>
    <td>BTW:</td>
    <td  style="text-align:right;border-bottom:1px solid grey;"><?php echo $btw_percentage; ?> %</td>
    
</tr>

<tr>
    <td><b>Totaal:</b></td>
    <td style="text-align:right;"><b><?php echo $prijs; ?></b></td>
</tr>
</table>

</td></tr>
<tr>

<td style="padding-right:30px;">
<table class="b_table_default" style="width:100%;">

<tr>
    <td>Voor akkoord:</td>

</tr>
<tr>
    <td><?php echo $voorakkoord; ?></td>
    
</tr>
</table>

</td>
</tr>

</table>

<p style="font-size:10px;">
In geval van betwisting zijn enkel de rechtbanken van het gerechtelijk arrondissement <?php echo $dealer_city; ?> bevoegd.De koper (of de
opdrachtgever) verklaart kennis genomen te hebben van de factuurvoorwaarden vermeld op keerzijde en bevestigt deze te
aanvaarden
De wettelijke garantie van 1 jaar is van toepassing
</p>
<br>
<center>
<b><?php echo $dealer_FIRMANAAM; ?></b><br>
<?php echo $dealer_Adres; ?> - Website: <?php echo $websitenaam; ?><br>
E-mail: <?php echo $dealer_mail; ?> - Tel: <?php echo $dealer_Tel; ?> -Ondernemingsnummer <?php echo $dealer_BTW; ?> - <?php echo $dealer_bank; ?><br> - Rekeninghouder: <?php echo $dealer_FIRMANAAM; ?>
</center>



</div>


<div class="page_break"></div><br><br><br>
<p>
ALGEMENE FACTUUR VOORWAARDEN. Onze facturen zijn contant betaalbaar te <?php echo $dealer_city; ?>, zonder korting behoudens
andersluidende overeenkomst bij bestelling. 2. Bij niet-betaling op de vervaldag is van rechtswege en zonder voorafgaande
ingebrekestelling een intrest verschuldigd aan 1% per maand 3. Daarenboven zal bij gehele of gedeeltelijke niet-betaling van
de schuld op de vervaldag van rechtswege en zonder ingebrekestelling een forfaitaire vergoeding verschuldigd zijn van 10%
op het factuurbedrag, met een minimum van 50 EURper factuur. Bij nietnaleving van één van de verplichtingen door de
verkoper/dienstverlener, is deze schadevergoeding t.o.v. de klant op dezelfde wijze verschuldigd (*) 4. Elk bezwaar moet
geschieden binnen de acht dagen na levering of na factuurdatum.Het dient te gebeuren per aangetekende brief en moet
gemotiveerd zijn. Bij gebrek aan bezwaar binnen de gestelde termijn wordt de factuur geacht te zijn aanvaard. 5.DeGarantie
kan alleen uitgevoerd worden als het voertuig om de 10.000 km onderhouden is in een erkende garage. Bij niet naleven van
deze voorwaarden vervalt de garantie. 6. Volgende gebreken/kosten en oorzaken vallen niet onder garantie: depannage,
elektrische onderdelen, schade door persoonlijke fouten, Excessief, professioneel of sportief gebruik, olie-ofwaterdichtingen,
koppeling vliegwiel, klep/roetfilter en onderdelen onderhevig aan slijtage niet inbegrepen. 7. Voor alle geschillen zijn enkel de
rechtbanken van het arrondissement van <?php echo $dealer_city; ?> bevoegd. 8. De Garantie is niet overdraagbaar naar een nieuwe eigenaar
dan vermeldt op deze factuur.
</p>




    <?php
    $innerhtml = ob_get_clean();


$base64img = $dds_settings_options['pdf_logo_base64'];

$html .= "<html>
<head>
  <style>
  body {  
    font-family: 'Helvetica' !important;
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