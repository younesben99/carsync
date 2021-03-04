<style>
    main {
    padding: 0 25px;
}
.compare_wrap{
    display:flex;
    flex-wrap: wrap;
}
.compare_item {
    width: 300px;
    display: flex;
    flex-direction: column;
    margin-right: 25px;
    background: #fdfdfd;
    box-shadow: 0px 1px 5px #d2d2d2;
    border-radius: 5px;
    border: 1px solid #e0e0e0;
}
.compare_item .compare_item_wrap {
    height: 50px;
    border-bottom: 1px solid whitesmoke;
    display: flex;
    align-items: center;
    padding-left: 20px;
}
.compare_item .compare_item_img img,.compare_item .compare_item_img{
border-radius:5px 5px 0 0;
}
</style>
<div class="compare_wrap">
<?php

$compare_ids = json_decode( html_entity_decode( stripslashes ($_COOKIE["vergelijk_ids"] ) ) );

if (!empty($compare_ids)) {
    foreach ($compare_ids as $id) {
        
        $carsync_fotos = pak_veld_id('_car_syncimages_key', $id);
        $manual_fotos = pak_veld_id('vdw_gallery_id', $id);
        $value_sync = pak_veld_id('_car_sync_key', $id);

        $img_links;


        if (!empty($carsync_fotos) && $value_sync == "YES") {
            $img_links = $carsync_fotos[0];
        } else {
            if (!empty($manual_fotos)) {
                $img_links = wp_get_attachment_url($manual_fotos[0]);
            } else {
                $img_links = $carsync_fotos[0];
            }
        }

        $sp_title = get_the_title($id);
        $sp_type = pak_veld_id('_car_carrosserievorm_key', $id);
        $sp_brandstof = pak_veld_id('_car_brandstof_key', $id);
        $sp_transmissie = pak_veld_id('_car_transmissie_key', $id);
        $sp_kilometerstand = pak_veld_id('_car_kilometerstand_key', $id);
        $sp_staat = pak_veld_id('_car_staat_key', $id);
        $sp_bouwjaar = pak_veld_id('_car_bouwjaar_key', $id);
        $sp_zitplaatsen = pak_veld_id('_car_zitplaatsen_key', $id);
        $sp_deuren = pak_veld_id('_car_aantaldeuren_key', $id);
        $sp_description = pak_veld_id('_car_description_key', $id);
        $sp_pk = pak_veld_id('_car_pk_key', $id);
        $sp_kw = pak_veld_id('_car_kw_key', $id);
        $sp_cilinderinhoud = pak_veld_id('_car_cilinderinhoud_key', $id);
        $sp_co = pak_veld_id('_car_co_key', $id);
        $sp_prijs = pak_veld_id('_car_prijs_key', $id);
        $sp_oudeprijs = pak_veld_id('_car_oudeprijs_key', $id);
        $sp_emissie = pak_veld_id('_car_emissieklasse_key', $id);
        $sp_btwafterkbaar = pak_veld_id('_car_btwaftrekbaar_key', $id);
        $sp_merk = pak_veld_id('_car_merkcf_key', $id);
        $sp_model = pak_veld_id('_car_modelcf_key', $id);
        $sp_media = pak_veld_id('_car_enter_media_key', $id);
        $sp_comfort = pak_veld_id('_car_comfort_key', $id);
        $sp_veiligheid = pak_veld_id('_car_veiligheid_key', $id);
        $sp_extra = pak_veld_id('_car_extra_key', $id);
        $sp_kleurinterieur = pak_veld_id('_car_kleurinterieur_key', $id);
        $sp_kleurexterieur = pak_veld_id('_car_kleurexterieur_key', $id);
        $sp_koopstatus = pak_veld_id('_car_status_key', $id);
        $sp_carpass = pak_veld_id('_car_carpass_key', $id); ?>
    
    <div class='compare_item'>

            <div class="compare_item_img"><img src="<?php echo $img_links; ?>" /></div>
            <div class="compare_item_wrap"><b><?php echo $sp_title; ?></b></div>
            <div class="compare_item_wrap">€ <?php echo $sp_prijs; ?>,-</div>
            <div class="compare_item_wrap"><?php echo $sp_merk . " ".  $sp_model; ?></div>
            <div class="compare_item_wrap"><?php echo $sp_bouwjaar; ?></div>
            <div class="compare_item_wrap"><?php echo $sp_transmissie; ?></div>
            <div class="compare_item_wrap"><?php echo $sp_brandstof; ?></div>
            <div class="compare_item_wrap"><?php echo $sp_type; ?></div>
            <div class="compare_item_wrap"><?php echo $sp_cilinderinhoud; ?> cm³</div>
            <div class="compare_item_wrap"><?php echo $sp_pk; ?> Pk</div>
            <div class="compare_item_wrap"><?php echo $sp_kw; ?> Kw</div>
            <div class="compare_item_wrap"><?php echo $sp_co; ?> g CO2/km</div>
            <div class="compare_item_wrap"><?php echo $sp_emissie; ?></div>
            <div class="compare_item_wrap"><?php echo $sp_staat; ?></div>
            <div class="compare_item_wrap"><?php echo $sp_kleurexterieur; ?></div>

    </div>
    
    
    <?php
    }
}
?>
</div>