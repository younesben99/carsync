<?php

get_header();



//PREPARE VARS

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
$sp_koopstatus = pak_veld('_car_post_status_key');

?>

<script src="https://unpkg.com/feather-icons"></script>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">





<style>
.breadcrumbs{
display:none;
}
.posttitle h1 {
    font-size: 25px;
}
.carpass_traxio_garantie_check li {
    display: inline-block;
    margin-right:10px;
}
.carpass_traxio_garantie_check ul {
    margin:0;
    padding:0;
    margin-bottom:20px;
}
.carpass_traxio_garantie_check a {
    color:black;
    text-decoration:underline;
}
.carpass_traxio_garantie_check svg.feather.feather-check {
    height: 15px;
    width: 15px;
    margin-right: 9px;
    margin-bottom: -2px;
}
</style>


<div class="sp_top_wrap">

<div>
<div class="wagentitel_wrap">
<h1 class="wagentitel_h1" style="font-size:20px;">
<?php

global $post;
$wagentitel = get_post_meta($post->ID,"_car_wagentitel_key",true);
echo $wagentitel;
?>
</h1>

<div style="margin:25px 0;">single car page navbar</div>

<div class="galerij_wrap">
<?php
include(__DIR__."/templates/template_sp_galerij.php");
?>
</div>
</div>

</div>

<div class="sp_mid_wrap">

<div class="sp_mid">


<div class="posttitle">
<h1>
<?php 
//POST TITLE
the_title();
?>
</h1>
</div>

<div class="carpass_traxio_garantie_check">
    <ul>
        <li><a href="#"><i data-feather="check"></i>Carpass</a></li>
        <li><a href="#"><i data-feather="check"></i>Traxio</a></li>
        <li><a href="#"><i data-feather="check"></i>Garantie</a></li>
    </ul>
</div>



<div class="sp_specificaties">
specificaties met icon

<div class="sp_spec_wrap">
    <div class="sp_spec_label">Type</div>
    <div class="sp_spec_info"><?php echo($sp_type); ?></div>
</div>

<div class="sp_spec_wrap">
    <div class="sp_spec_label">Bouwjaar</div>
    <div class="sp_spec_info"><?php echo($sp_bouwjaar); ?></div>
</div>

<div class="sp_spec_wrap">
    <div class="sp_spec_label">Kilometerstand</div>
    <div class="sp_spec_info"><?php echo($sp_kilometerstand); ?></div>
</div>

<div class="sp_spec_wrap">
    <div class="sp_spec_label">Transmissie</div>
    <div class="sp_spec_info"><?php echo($sp_tranmissie); ?></div>
</div>

<div class="sp_spec_wrap">
    <div class="sp_spec_label">Brandstof</div>
    <div class="sp_spec_info"><?php echo($sp_brandstof); ?></div>
</div>

<div class="sp_spec_wrap">
    <div class="sp_spec_label"></div>
    <div class="sp_spec_info"><?php echo($sp_); ?></div>
</div>

</div>


opties

beschrijving met read more

afspraak boeken

recensies

locatie

gerelateerde wagens



</div>

<div  class="sp_sticky_nav">

vergelijken

testrit

beschikbaarheid controleren

troeven

</div>

</div>
</div>



<script>feather.replace();</script>

<?php





get_footer();

?>