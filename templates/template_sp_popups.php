<div class="sp_contact_pop_wrap">
<div class="sp_contact_inner">
<div class="sluiten contactsluiten"><i data-feather="x"></i><span>Sluiten</span></div>
<div class="sp_contact_pop">


<?php

$dds_settings_options = get_option( 'dds_settings_option_name' ); 

$contact_shortcode_field = $dds_settings_options['sp_contact_shortcode'];
if(empty($contact_shortcode_field)){
    

    echo "<h2>Contacteer ons voor de ".$sp_title."</h2>
    <span class='sp_pop_wagentitel'>Vul uw gegevens in. We nemen snel contact met u op.
    </span>";

    echo do_shortcode('[dds_form style="modern" name="scpbeschikbaarheid" type="beschikbaarheid"]
    [dds_input name="Volledige naam" lb="Volledige naam"]
    [dds_input name="emailadres" lb="E-mailadres"]
    [dds_input name="telefoonnummer" lb="Telefoonnummer"]
    [dds_input ty="textarea" len="1000" name="bericht" ph="" lb="Bericht (optioneel)"]
    [dds_submit]
    [close_dds_form]');
}
else{
    
    echo do_shortcode($contact_shortcode_field);
}
?>


</div>
</div>
</div>

<div class="sp_testrit_pop_wrap">
<div class="sp_testrit_inner">
<div class="sluiten testritsluiten"><i data-feather="x"></i><span>Sluiten</span></div>
<div class="sp_testrit_pop">
<?php



$testrit_shortcode_field = $dds_settings_options['sp_testrit_shortcode'];
if(empty($testrit_shortcode_field)){

    echo "<h2>Boek een testrit voor de " . $sp_title . "</h2>
    <span class='sp_pop_wagentitel'>Kies een tijd en datum voor de testrit.
    </span>";

    echo do_shortcode('[dds_form style="modern" name="scptestrit" type="afspraak"]
    [dds_select name="datum" ph="Selecteer datum" lb="Datum"]
    [dds_select name="tijd" ph="Selecteer tijd" lb="Tijd"]
    [dds_input name="Volledige naam" lb="Volledige naam"]
    [dds_input name="emailadres" lb="E-mailadres"]
    [dds_input name="telefoonnummer" lb="Telefoonnummer"]
    [dds_input ty="textarea" len="1000" name="bericht" ph="" lb="Bericht (optioneel)"]
    [dds_submit] [close_dds_form]');
    
}
else{
    echo do_shortcode($testrit_shortcode_field);
}
?>

</div>
</div>
</div>


<?php

popup_open("bodh_pop");

$dds_settings_options = get_option( 'dds_settings_option_name' ); 
$bodh_shortcode_field = $dds_settings_options['bodh_shortcode_field'];

if(empty($bodh_shortcode_field)){
    

    echo "<h2>Blijf op de hoogte voor een ".$sp_merk. " ".$sp_model."</h2>
    <span class='dds_pop_title'>We geven je een melding wanneer een ".$sp_merk. " ".$sp_model." beschikbaar komt.</span>
    <div class='pop_chosenfacets'>
    </div>
    ";

    echo do_shortcode('[dds_form style="classic_big" name="dds_bodh" type="bodh"]
    
    [dds_input name="naam" ph="Volledige naam"]
    [dds_input name="emailadres" ph="E-mailadres" *]
    [dds_input name="telefoonnummer" ph="Telefoonnummer"]
    [dds_input name="merk" ph="Merk" value="Volkswagen" hide]
    [dds_input name="model" ph="Model" value="Polo" hide]
    <div class="submit_close_wrap">
    [dds_submit ph="Blijf op de hoogte" icon="bel" width="50%"]
    <button class="pop_close">Sluiten</button>
    </div>
    [close_dds_form]');
}
else{
    
    echo do_shortcode($bodh_shortcode_field);
}

popup_close();

?>