
<?php

popup_open("bodh_pop");

$dds_settings_options = get_option( 'dds_settings_option_name' ); 
$bodh_shortcode_field = $dds_settings_options['bodh_shortcode_field'];

if(empty($bodh_shortcode_field)){
    

    echo "<h2>Blijf op de hoogte</h2>
    <span class='dds_pop_title'>We geven je een melding wanneer een auto die overeenkomt met jouw interesses beschikbaar komt.</span>
    <button class='selecteer_filter'>+ Selecteer filter</button>
    <div class='pop_chosenfacets'>
    </div>
    ";

    echo do_shortcode('[dds_form style="classic_big" name="dds_bodh" type="bodh"]

    [dds_input name="naam" ph="Volledige naam"]
    [dds_input name="emailadres" ph="E-mailadres" *]
    [dds_input name="telefoonnummer" ph="Telefoonnummer"]
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

