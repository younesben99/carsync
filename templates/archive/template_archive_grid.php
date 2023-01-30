

<?php



$grid_cars = [];





$args = array(
    'post_type'        => 'autos',
    'posts_per_page'   => -1,
    'orderby' => 'date',
            'order' => 'DESC'
);
$cars = get_posts( $args );



$prijs_ranges = array(
    2500,
    5000,
    7500
    ,10000
    ,12500
    ,15000
    ,17500
    ,20000
    ,22500
    ,25000
    ,27500,
    30000
);

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
    $_car_oudeprijs_key = get_post_meta($value->ID,"_car_oudeprijs_key",true);
    $_car_badge_key = get_post_meta($value->ID,"_car_badge_key",true);
    $cartitle = get_the_title($value);
    $_car_prijs_range_key = 0;

    


    if(!empty($_car_prijs_key)){
        $_car_prijs_range_key = getClosest($_car_prijs_key,$prijs_ranges,2500);
    }


    $_car_kilometerstand_key = strtolower(get_post_meta($value->ID,"_car_kilometerstand_key",true));
    
    if(is_string(get_post_meta($value->ID,"_car_emissieklasse_key",true))){
        $_car_emissieklasse_key = strtolower(get_post_meta($value->ID,"_car_emissieklasse_key",true));
    }
   
    
    //euronormen 6 gelijk maken

    if(!empty($_car_emissieklasse_key)){
        if($_car_emissieklasse_key == "euro 6d" || $_car_emissieklasse_key == "euro 6b" || $_car_emissieklasse_key == "euro 6c" || $_car_emissieklasse_key == "euro 6d-temp" || $_car_emissieklasse_key == "euro 6dtemp"){
            $_car_emissieklasse_key = "euro 6";
        }
    }
   


    $bg = dds_thumbnail($_car_id);
    $car_link = get_permalink($value->ID);



    //status check

    $_car_post_status_key = get_post_meta($value->ID,"_car_post_status_key",true);
    $_car_status_key = get_post_meta($value->ID,"_car_status_key",true);


    if($_car_post_status_key == "actief" ){
        array_push($grid_cars,["id" =>$_car_id,"title"=>$cartitle,"carstatus"=>$_car_status_key,"link"=> $car_link,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,
    "model"=>$_car_modelcf_key,"prijsrange"=>$_car_prijs_range_key,"badge"=>$_car_badge_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,
    "carrosserievorm"=>$_car_carrosserievorm_key,"kilometerstand"=>$_car_kilometerstand_key,"oudeprijs"=>$_car_oudeprijs_key,"bouwjaar"=>$_car_bouwjaar_key,"euro"=>$_car_emissieklasse_key]);
    }

    


    $carcount++;
}



?>









<div class="grid_wrap">

<div class="sort_bodh_wrap">


<button class="dds_btn_icon top_grid_bodh pop_open" data-popup="bodh_pop">Blijf op de hoogte <img src="https://digiflowroot.be/static/images/icons/bel.svg" /></button>
<div style="display:flex;align-items:center;" class="sort_wrap dds_form_classic">
<div class="sort_label">Sorteren:</div>
<select class="sort_select">
    <option value="default">Standaard resultaten</option>
    <option value="prijs_o">Prijs oplopend</option>
    <option value="prijs_a">Prijs aflopend</option>
    <option value="nieuwste">Nieuwste eerst</option>
    <option value="km_o">Kilometerstand oplopend</option>
    <option value="km_a">Kilometerstand aflopend</option>
</select>
</div>
</div>

<div class="chosen_wrap">

<div class="facet_title" style="margin-top:0px;">Gekozen Filters</div>




<div class="chosen_flex">
<a href="#" class="reset_btn"><svg class="reset_icon" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)"><path d="m4.5 1.5c-2.4138473 1.37729434-4 4.02194088-4 7 0 4.418278 3.581722 8 8 8s8-3.581722 8-8-3.581722-8-8-8"/><path d="m4.5 5.5v-4h-4"/></g></svg></a>
<div class="chosen_facets">
<div class='ch_facet_item filter_open'>Selecteer filter</div>

</div>
</div>



</div>
    <div class="grid_inner grid">
        
       
<?php

    foreach ($grid_cars as $car) {

  
        stock_card($car);
      

    }
        
   
    ?>
   
        
    </div>
    <?php

bodh_card();

?>
    
</div>