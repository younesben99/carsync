

<?php



function dds_rel_cars(){
    $grid_cars = [];


    $args = array(
        'post_type'        => 'autos',
        'posts_per_page'   => 6
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
    $_car_oudeprijs_key = get_post_meta($value->ID,"_car_oudeprijs_key",true);
    $_car_badge_key = get_post_meta($value->ID,"_car_badge_key",true);
   
    $_car_prijs_range_key = 0;



    $_car_kilometerstand_key = strtolower(get_post_meta($value->ID,"_car_kilometerstand_key",true));
    $_car_emissieklasse_key = strtolower(get_post_meta($value->ID,"_car_emissieklasse_key",true));

    
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
        array_push($grid_cars,["id" =>$_car_id,"link"=> $car_link,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,
    "model"=>$_car_modelcf_key,"prijsrange"=>$_car_prijs_range_key,"badge"=>$_car_badge_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,
    "carrosserievorm"=>$_car_carrosserievorm_key,"kilometerstand"=>$_car_kilometerstand_key,"oudeprijs"=>$_car_oudeprijs_key,"bouwjaar"=>$_car_bouwjaar_key,"euro"=>$_car_emissieklasse_key]);
    }

    


    $carcount++;
}


?> 

<div class="carousel_wrap splide">
    <div class="splide__track">
    <div class="splide__list">

    <?php
    foreach ($grid_cars as $car) {

       ?>
         
       <?php

            stock_card($car);
    
            ?>
      
        <?php
    }
    ?>
    </div> 
</div>
</div> <?php

}



add_shortcode('dds_rel_cars', 'dds_rel_cars');
?>
