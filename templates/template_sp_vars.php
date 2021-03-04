<?php

//PREPARE VARS
$sp_title = get_the_title();
$sp_type = pak_veld('_car_carrosserievorm_key');
$sp_brandstof = pak_veld('_car_brandstof_key');
$sp_transmissie = pak_veld('_car_transmissie_key');
$sp_kilometerstand = pak_veld('_car_kilometerstand_key');
$sp_staat = pak_veld('_car_staat_key');
$sp_bouwjaar = pak_veld('_car_bouwjaar_key');
$sp_zitplaatsen = pak_veld('_car_zitplaatsen_key');
$sp_deuren = pak_veld('_car_aantaldeuren_key');
$sp_description = pak_veld('_car_description_key');
$sp_pk = pak_veld('_car_pk_key');
$sp_kw = pak_veld('_car_kw_key');
$sp_cilinderinhoud = pak_veld('_car_cilinderinhoud_key');
$sp_co = pak_veld('_car_co_key');
$sp_prijs = pak_veld('_car_prijs_key');
$sp_oudeprijs = pak_veld('_car_oudeprijs_key');
$sp_emissie = pak_veld('_car_emissieklasse_key');
$sp_btwafterkbaar = pak_veld('_car_btwaftrekbaar_key');
$sp_merk = pak_veld('_car_merkcf_key');
$sp_model = pak_veld('_car_modelcf_key');
$sp_media = pak_veld('_car_enter_media_key');
$sp_comfort = pak_veld('_car_comfort_key');
$sp_veiligheid = pak_veld('_car_veiligheid_key');
$sp_extra = pak_veld('_car_extra_key');
$sp_kleurinterieur = pak_veld('_car_kleurinterieur_key');
$sp_kleurexterieur = pak_veld('_car_kleurexterieur_key');
$sp_koopstatus = pak_veld('_car_status_key');
$sp_carpass = pak_veld('_car_carpass_key');

//CONFIG
$dds_settings_options = get_option( 'dds_settings_option_name' ); // Array of All Options

$sp_color = $dds_settings_options['primary_color'];
$sp_hover_color = $dds_settings_options['hover_color'];

$sp_shortcode_troeven = $dds_settings_options['troeven_shortcode'];

$sp_locatie = $dds_settings_options['dealer_adres_9'];
$sp_locatie_link = $dds_settings_options['sp_locatie_link'];
$sp_telnr = $dds_settings_options['dealer_tel_1_10'];

$sp_telnr_formatted = str_replace(' ', '', $sp_telnr);

$sp_contactmail = $dds_settings_options['dealer_contact_mail'];
$sp_handelsnaam = $dds_settings_options['dealer_handelsnaam_8'];

$sp_chosen_type = $dds_settings_options['slideshow_type'];

?>