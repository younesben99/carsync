<?php

$grid_cars = [];
$merk_facet = [];
$brandstof_facet = [];
$euro_facet = [];
$transmissie_facet = [];
$carrosserievorm_facet = [];

$args = array(
    'post_type'        => 'autos',
    'posts_per_page'   => -1,
    'order'            => 'ASC'
);
$cars = get_posts( $args );

$carcount = 0;
foreach ($cars as $key => $value) {

    $_car_id = $value->ID;
    $_car_wagentitel_key = strtolower(get_post_meta($value->ID,"_car_wagentitel_key",true));
    $_car_prijs_key = strtolower(get_post_meta($value->ID,"_car_prijs_key",true));
    $_car_merkcf_key = strtolower(get_post_meta($value->ID,"_car_merkcf_key",true));
    $_car_modelcf_key = strtolower(get_post_meta($value->ID,"_car_modelcf_key",true));
    $_car_transmissie_key = strtolower(get_post_meta($value->ID,"_car_transmissie_key",true));
    $_car_bouwjaar_key = strtolower(get_post_meta($value->ID,"_car_bouwjaar_key",true));
    $_car_brandstof_key = strtolower(get_post_meta($value->ID,"_car_brandstof_key",true));
    $_car_carrosserievorm_key = strtolower(get_post_meta($value->ID,"_car_carrosserievorm_key",true));
    $_car_kilometerstand_key = strtolower(get_post_meta($value->ID,"_car_kilometerstand_key",true));
    $_car_emissieklasse_key = strtolower(get_post_meta($value->ID,"_car_emissieklasse_key",true));
    $bg = dds_thumbnail($_car_id);


    //status check

    $_car_post_status_key = get_post_meta($value->ID,"_car_post_status_key",true);
    $_car_status_key = get_post_meta($value->ID,"_car_status_key",true);


    if($_car_post_status_key == "actief" ){
    array_push($grid_cars,[$_car_id,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,"model"=>$_car_modelcf_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,"carrosserievorm"=>$_car_carrosserievorm_key,"kilometerstand"=>$_car_kilometerstand_key,"euro"=>$_car_emissieklasse_key]);
    $carcount++;
    }
    

}



foreach ($grid_cars as $car) {
    

    array_push($merk_facet,$car["merk"]);
    array_push($euro_facet,$car["euro"]);
    array_push($brandstof_facet,$car["brandstof"]);
    array_push($transmissie_facet,$car["transmissie"]);
    array_push($carrosserievorm_facet,$car["carrosserievorm"]);

    $merk_facet = array_unique($merk_facet);
    $euro_facet = array_unique($euro_facet);
    $brandstof_facet = array_unique($brandstof_facet);
    $transmissie_facet = array_unique($transmissie_facet);
    $carrosserievorm_facet = array_unique($carrosserievorm_facet);

    sort($merk_facet);
    sort($euro_facet);
    sort($brandstof_facet);
    sort($transmissie_facet);
    sort($carrosserievorm_facet);

}


?>






<div class="filter_mobile_close">
    <button class="filter_btn_close">
        
    <img src="https://digiflowroot.be/static/images/icons/eye_1.svg" />
    <span>
    Toon resultaten</span>

   
</button>

<button class="filter_btn_close outline_btn">
        
        <span>&#x2715</span>
        <span>
        Sluiten</span>
    
       
    </button>

</div>


<!-- filter voor desk -->
<div class="filterwrap">
<h3 class="filter_h3">Gevonden wagens (<?php echo($carcount); ?>)</h3>




<div class="filter_inner">


<!-- begin merk facet -->
<div class="facet_wrap">
<div class="facet_title ">Merk<div><svg width="10px" height="10px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14 5L7.5 12L1 5" stroke="black" stroke-linecap="square"/>
</svg>
</div></div>
<div class="facet_inner">
<div class="facet_list checkbox_list" data-filter-group="merk">


<?php
foreach ($merk_facet as $facet) {
    


    ?>
    
    <div class="facet_item">
    <input type="checkbox" id="<?php echo $facet."_id"; ?>" name="merk_facet" value="<?php echo $facet; ?>" data-filter=".<?php echo  $facet; ?>">
    <label for="<?php echo $facet."_id"; ?>"><?php echo ucfirst($facet); ?></label>
    </div>
    
    
    <?php
    
    
    }

?>
</div>
</div>
</div>
<!-- end facet -->

<!-- begin brandstof facet -->
<div class="facet_wrap">
<div class="facet_title">Brandstof<div><svg width="10px" height="10px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14 5L7.5 12L1 5" stroke="black" stroke-linecap="square"/>
</svg>
</div></div>
<div class="facet_inner">
<div class="facet_list checkbox_list" data-filter-group="brandstof">


<?php
foreach ($brandstof_facet as $facet) {
    


    ?>
    
    <div class="facet_item">
    <input type="checkbox" id="<?php echo $facet."_id"; ?>" name="brandstof_facet" value="<?php echo $facet; ?>" data-filter=".<?php echo  $facet; ?>">
    <label for="<?php echo $facet."_id"; ?>"><?php echo ucfirst($facet); ?></label>
    </div>
    
    
    <?php
    
    
    }

?>
</div>
</div>
</div>
<!-- end facet -->


<!-- begin transmissie facet -->
<div class="facet_wrap">
<div class="facet_title">Transmissie<div><svg width="10px" height="10px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14 5L7.5 12L1 5" stroke="black" stroke-linecap="square"/>
</svg>
</div></div>
<div class="facet_inner">
<div class="facet_list checkbox_list" data-filter-group="transmissie">


<?php
foreach ($transmissie_facet as $facet) {
    


    ?>
    
    <div class="facet_item">
    <input type="checkbox" id="<?php echo $facet."_id"; ?>" name="transmissie_facet" value="<?php echo $facet; ?>" data-filter=".<?php echo  $facet; ?>">
    <label for="<?php echo $facet."_id"; ?>"><?php echo ucfirst($facet); ?></label>
    </div>
    
    
    <?php
    
    
    }

?>
</div>
</div>
</div>
<!-- end facet -->


<!-- begin carrosserievorm facet -->
<div class="facet_wrap">
<div class="facet_title">Type Carrosserie<div><svg width="10px" height="10px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14 5L7.5 12L1 5" stroke="black" stroke-linecap="square"/>
</svg>
</div></div>
<div class="facet_inner">
<div class="facet_list checkbox_list" data-filter-group="carrosserievorm">


<?php
foreach ($carrosserievorm_facet as $facet) {
    


    ?>
    
    <div class="facet_item">
    <input type="checkbox" id="<?php echo $facet."_id"; ?>" name="carrosserievorm_facet" value="<?php echo $facet; ?>" data-filter=".<?php echo $facet; ?>">
    <label for="<?php echo $facet."_id"; ?>"><?php echo ucfirst($facet); ?></label>
    </div>
    
    
    <?php
    
    
    }

?>
</div>
</div>
</div>
<!-- end carrosserievorm -->

<!-- begin Emissieklasse facet -->
<div class="facet_wrap">
<div class="facet_title">Emissieklasse<div><svg width="10px" height="10px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14 5L7.5 12L1 5" stroke="black" stroke-linecap="square"/>
</svg>
</div></div>
<div class="facet_inner">
<div class="facet_list checkbox_list" data-filter-group="emissieklasse">


<?php
foreach ($euro_facet as $facet) {
    


    ?>
    
    <div class="facet_item">
    <input type="checkbox" id="<?php echo $facet."_id"; ?>" name="euro_facet" value="<?php echo $facet; ?>" data-filter=".<?php echo $facet; ?>">
    <label for="<?php echo $facet."_id"; ?>"><?php echo ucfirst($facet); ?></label>
    </div>
    
    
    <?php
    
    
    }

?>
</div>
</div>
</div>
<!-- end carrosserievorm -->

</div>

</div>