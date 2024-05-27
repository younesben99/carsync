<?php

popup_open("contact_pop");
$dds_settings_options = get_option('dds_settings_option_name'); 

$contact_shortcode_field = isset($dds_settings_options['sp_contact_shortcode']) ? $dds_settings_options['sp_contact_shortcode'] : '';

$car = get_the_ID();

$sp_merk = get_post_meta($car, "_car_merkcf_key", true);
$sp_model = get_post_meta($car, "_car_modelcf_key", true);
if (empty($contact_shortcode_field)) {
    echo "<h2>Contacteer ons voor de " . $sp_merk . " " . $sp_model . "</h2>
    <span class='sp_pop_wagentitel'>Vul uw gegevens in. We nemen snel contact met u op.
    </span>";

    echo do_shortcode('[dds_form style="modern" name="scpbeschikbaarheid" type="beschikbaarheid"]
    [dds_input name="Volledige naam" lb="Volledige naam"]
    [dds_input name="emailadres" lb="E-mailadres"]
    [dds_input name="telefoonnummer" lb="Telefoonnummer"]
    [dds_input ty="textarea" len="1000" name="bericht" ph="" lb="Bericht (optioneel)"]
    <div class="submit_close_wrap">
    [dds_submit] 
    <button class="pop_close">Sluiten</button>
    </div>
    [close_dds_form]');
} else {
    echo do_shortcode($contact_shortcode_field);
}

popup_close();
?>

<?php

popup_open("testrit_pop");

$testrit_shortcode_field = isset($dds_settings_options['sp_testrit_shortcode']) ? $dds_settings_options['sp_testrit_shortcode'] : '';
$car = get_the_ID();

$sp_merk = get_post_meta($car, "_car_merkcf_key", true);
$sp_model = get_post_meta($car, "_car_modelcf_key", true);

if (empty($testrit_shortcode_field)) {
    echo "<h2>Boek een testrit voor de " . $sp_merk . " " . $sp_model . "</h2>
    <span class='sp_pop_wagentitel'>Kies een tijd en datum voor de testrit.
    </span>";

    echo do_shortcode('[dds_form style="modern" name="scptestrit" type="afspraak"]
    [dds_select name="datum" ph="Selecteer datum" lb="Datum"]
    [dds_select name="tijd" ph="Selecteer tijd" lb="Tijd"]
    [dds_input name="Volledige naam" lb="Volledige naam"]
    [dds_input name="emailadres" lb="E-mailadres"]
    [dds_input name="telefoonnummer" lb="Telefoonnummer"]
    [dds_input ty="textarea" len="1000" name="bericht" ph="" lb="Bericht (optioneel)"]
    <div class="submit_close_wrap">
    [dds_submit] 
    <button class="pop_close">Sluiten</button>
    </div>
    [close_dds_form]');
} else {
    echo do_shortcode($testrit_shortcode_field);
}

popup_close();
?>

<?php

popup_open("bodh_pop");

$dds_settings_options = get_option('dds_settings_option_name'); 
$bodh_shortcode_field = isset($dds_settings_options['bodh_shortcode_field']) ? $dds_settings_options['bodh_shortcode_field'] : '';

if (empty($bodh_shortcode_field)) {
    if (get_post_type(get_the_ID()) == "autos") {
        if (is_single()) {
            $car = get_the_ID();
            $sp_merk = get_post_meta($car, "_car_merkcf_key", true);
            $sp_model = get_post_meta($car, "_car_modelcf_key", true);

            echo "<h2>Blijf op de hoogte voor een " . $sp_merk . " " . $sp_model . "</h2>
            <span class='dds_pop_title'>We geven je een melding wanneer een " . $sp_merk . " " . $sp_model . " beschikbaar komt.</span>
            <div class='pop_chosenfacets'></div>";
        } else {
            echo "<h2>Blijf op de hoogte</h2>
            <span class='dds_pop_title'>We geven je een melding wanneer een " . __("auto", "carsync") . " die overeenkomt met jouw interesses beschikbaar komt.</span>
            <button class='selecteer_filter'>+ Selecteer filter</button>
            <div class='pop_chosenfacets'></div>";
        }
    }

    echo do_shortcode('[dds_form style="modern" name="dds_bodh" type="bodh" redirect=""]
    [dds_input name="naam" ph="Volledige naam"]
    [dds_input name="emailadres" ph="E-mailadres" *]
    [dds_input name="telefoonnummer" ph="Telefoonnummer"]
    <div class="submit_close_wrap">
    [dds_submit ph="Blijf op de hoogte" icon="bel" width="50%"]
    <button class="pop_close">Sluiten</button>
    </div>
    [close_dds_form]');
} else {
    echo do_shortcode($bodh_shortcode_field);
}

popup_close();
?>

<?php

popup_open("bodh_single_pop");

$dds_settings_options = get_option('dds_settings_option_name'); 
$bodh_shortcode_field = isset($dds_settings_options['bodh_shortcode_field']) ? $dds_settings_options['bodh_shortcode_field'] : '';

if (empty($bodh_shortcode_field)) {
    echo "<h2>Blijf op de hoogte voor een <span class='bodh_merk'></span> <span class='bodh_model'></span></h2>
    <span class='dds_pop_title'>We geven je een melding wanneer een <span class='bodh_merk'></span> <span class='bodh_model'></span> beschikbaar komt.</span>";

    echo do_shortcode('[dds_form style="modern" name="dds_bodh" type="bodh" redirect=""]
    [dds_input name="naam" ph="Volledige naam"]
    [dds_input name="emailadres" ph="E-mailadres" *]
    [dds_input name="telefoonnummer" ph="Telefoonnummer"]
    <div class="submit_close_wrap">
    [dds_submit ph="Blijf op de hoogte" icon="bel" width="50%"]
    <button class="pop_close">Sluiten</button>
    </div>
    [close_dds_form]');
} else {
    echo do_shortcode($bodh_shortcode_field);
}

popup_close();
?>

<?php

popup_open("sorteer_wagens");

echo ('
<h2>Sorteer Op:</h2><br>
<div class="sort_btn_group">
<ul>
    <li data-sort="original-order" class="active">Standaard</li>
    <li data-sort="prijs_o">Prijs oplopend</li>
    <li data-sort="prijs_a">Prijs aflopend</li>
    <li data-sort="nieuwste">Nieuwste eerst</li>
    <li data-sort="km_o">Kilometerstand oplopend</li>
    <li data-sort="km_a">Kilometerstand aflopend</li>
</ul>
</div>');

popup_close();
?>
