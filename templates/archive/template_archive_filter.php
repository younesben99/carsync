

<style>


.filterwrap {
    background: #ffffff;
    width: 330px;
    padding: 60px 20px;
    border-right: 1px solid whitesmoke;
}
.filter_h3{
    font-size:18px;
    font-weight:500;
}
.facet_title{
    cursor:pointer;
    padding: 10px 0;
    font-weight: 500;
    border-bottom: 1px solid #f3f3f3;
    font-variant: all-small-caps;
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}
.facet_item {
    display: flex;
    align-items: center;
    padding: 7px 0;
    justify-content: flex-start;
    flex-wrap: nowrap;
    cursor:pointer;
}
.facet_item label{
    cursor:pointer;
}
.facet_item input {
    margin: 2px 10px 0 0;
}
.facet_list {
    margin-top: 10px;
}
.rotate180{
    transform: rotate(180deg);
}
.ch_facet_item {
    border-radius: 100px;
    font-weight: 600;
    padding: 6px 35px 6px 16px;
    background: transparent;
    margin-top: 10px;
    position: relative;
    border: 2px solid;
    border-color: #e6e6e6;
    font-size: 13px;
    cursor: pointer;
    margin-right: 10px;
    color: #5b5b5b;
    text-transform: capitalize;
    display: flex;
    justify-content: center;
    align-items: center;
}
.ch_facet_item:hover {
    color:#d57c7c !important;
    background: transparent;
    border-color: #d57c7c;
}
.ch_facet_item:hover::after{
    color:#d57c7c;
}

.ch_facet_item:after {
    content:"\2715";
    position:absolute;
    width:15px;
    height:15px;
    right: 7px;
    top: 7px;
    color:#c2c2c2;
}

.chosen_facets {
    display: flex;
    flex-wrap: wrap;
}
.chosen_wrap {
    width: 100%;
    margin-bottom: 30px;
   
   
    display:none;
}
    </style>
<script>

jQuery(document).ready(function($) {        
  
$(".facet_title").on("click",function(){

    $(this).next(".facet_inner").toggle();
    $(this).find("svg").toggleClass('rotate180');
});

});
</script>

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


    array_push($grid_cars,[$_car_id,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,"model"=>$_car_modelcf_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,"carrosserievorm"=>$_car_carrosserievorm_key,"kilometerstand"=>$_car_kilometerstand_key,"euro"=>$_car_emissieklasse_key]);



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





<div class="filterwrap">
<h3 class="filter_h3">Gevonden wagens</h3>



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