<?php 
function dds_rel_cars($atts){

    if(!empty($atts["type"])){
        $rel_type = $atts["type"];
    }
    $grid_cars = [];


    $args = array(
        'post_type'        => 'autos',
        'posts_per_page'   => -1
    );
    $cars = get_posts( $args );




    $uitgelichte_opt = get_option("uitgelichtewagens");


    $active_uitgelicht = array();


    if(is_array($uitgelichte_opt)){

        foreach ($uitgelichte_opt as $value) {
           
            if ( get_post_status( $value )  ) {
                array_push($active_uitgelicht,$value);
              }
           
        }

    }


    update_option("uitgelichtewagens",$active_uitgelicht);

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

    $cartitle = get_the_title($value);

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


    if($_car_post_status_key == "actief"){
        array_push($grid_cars,["id" =>$_car_id,"carstatus"=>$_car_status_key,"title"=>$cartitle,"link"=> $car_link,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,
    "model"=>$_car_modelcf_key,"prijsrange"=>$_car_prijs_range_key,"badge"=>$_car_badge_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,
    "carrosserievorm"=>$_car_carrosserievorm_key,"kilometerstand"=>$_car_kilometerstand_key,"oudeprijs"=>$_car_oudeprijs_key,"bouwjaar"=>$_car_bouwjaar_key,"euro"=>$_car_emissieklasse_key]);
    }

    


    $carcount++;
}


?> 

<div class="carousel_wrap rel_splide splide">
    <div class="splide__track">
    <div class="splide__list">

    <?php
  
    if(empty($rel_type)){
        $count = 0;
        foreach ($grid_cars as $car) {

            ?>
              
            <?php
        
            if(in_array($car["id"],$active_uitgelicht)){
     
     
             stock_card($car,true);
                 $count++;
            
           
          
            }
     
               
         
                 ?>
           
             <?php
         }
       
         if($count == 0){
             $count_max_8 = 0;
             foreach ($grid_cars as $car) {
     
             
                 if($count_max_8 <= 7){
                     stock_card($car,true);
                     $count_max_8++;
                    
                 }
                 
     
     
             
                 
              }
         
         }
    }
    else{
        $count_max_16 = 0;
        foreach ($grid_cars as $car) {
        if($car["carrosserievorm"] == strtolower($rel_type)){
            if($count_max_16 <= 15){
            stock_card($car,true);
            $count_max_16++;
        }
        }
       
    }
    }
    
    ?>
    </div> 
</div>
</div> <?php

}



add_shortcode('dds_rel_cars', 'dds_rel_cars');
?>
