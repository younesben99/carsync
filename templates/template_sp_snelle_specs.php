<style>
    .sp_snelle_specs_wrap {
    width: 100%;
}
.specs_row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    border: 1px solid #f7f7f7;
    padding-top: 15px;
    border-radius: 5px;
}
.spec_box {
    display: flex;
    flex-wrap: nowrap;
    width: 33%;
    min-width:160px;
    display: flex;
    justify-content: space-evenly;
    flex-wrap: nowrap;
    margin-bottom: 10px;
}
.spec_icon img {
    width: 23px;
    height: 23px;
}
.spec_icon{
    margin-top: 3px;
}
.spec_val {
    font-weight: 600;
}
.spec_label{
    font-weight: 400;
    color:grey;
}
.spec_label_val_wrap {
    width: 115px;
}
@media only screen and (max-width: 770px) {
    .carpass_traxio_garantie_check{
        display:none;
    }
    .sp_sticky_status{
        width: 100%;
    }
    .bekijk_alle_specs {
    display: block !important;
    color: black !important;
    text-align: center;
    padding: 5px 0;
    margin-top: 20px;
    border-radius: 5px;
    width: 100%;
    max-width: 300px;
    background: #f9f9f9;
}

    .specs_row{
        padding: 20px;
    }
}
</style>


<?php

$snelle_specs = array(

    0 => array(
        "icon_url" => "https://digiflowroot.be/static/images/icons/road-solid-svgrepo-com.svg",
        "label" => "Kilometerstand",
        "value" => $sp_kilometerstand. " km"
    ),
    1 => array(
        "icon_url" => "https://digiflowroot.be/static/images/icons/transmissie.svg",
        "label" => "Transmissie",
        "value" => $sp_transmissie
    )
    ,
    2 => array(
        "icon_url" => "https://digiflowroot.be/static/images/icons/calendar-empty-page-outline-svgrepo-com.svg",
        "label" => "Bouwjaar",
        "value" => $sp_bouwjaar
    )
    

);

?>
<div class="sp_snelle_specs_wrap">

<div class="specs_row">


    <?php
foreach ($snelle_specs as $value) {
?>
<div class="spec_box"> 
    <div class="spec_icon"><img src='<?php echo($value["icon_url"]); ?>' /></div>
    <div class="spec_label_val_wrap">
    <div class="spec_label"><?php echo($value["label"]); ?></div>
    <div class="spec_val"><?php echo($value["value"]); ?></div>
    </div>
    </div>


<?php
}

?>
<div class="spec_box snelle_spec_vermogen" style="display:none;"> 
    <div class="spec_icon"><img src='https://digiflowroot.be/static/images/icons/milage.svg' /></div>
    <div class="spec_label_val_wrap">
    <div class="spec_label">Vermogen</div>
    <div class="spec_val"><?php echo($sp_pk); ?> pk</div>
    </div>
</div>
<a  class="bekijk_alle_specs" href="#specificaties" style="display:none;">Bekijk alle specificaties</a>

</div>


</div>