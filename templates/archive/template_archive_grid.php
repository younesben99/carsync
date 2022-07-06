
<style>
    .grid_wrap {
    width: 75%;
    margin:0 5%;
    padding-top: 50px;
}
.grid_item {
 
   
   width: 260px;
    border-radius: 5px;
    background: #fdfdfd;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
    border: 1px solid whitesmoke;
    margin-bottom:15px;
  
}
.grid_title {
    font-weight: 500;
}
.grid_desc {
    font-size: 11px;
    color: #7a7a7a;
    height: 16px;
}
.grid_price {
    font-weight: 500;
    font-size: 22px;
    color: #0f87ed;
}
.grid_image{
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    height: 202px;
    background-size: cover;
}
.grid_image img{
    object-fit: cover;
    height: 201px;
    width: 100%;
}
.grid_content{
    padding: 6px 18px 16px;
}
.filtergrid_wrap{
    max-width: 2400px;
    margin: 0px auto 0 0;
    padding:0 0 0 0;
}
.seintje {
    width: 100%;
    padding: 20px;
    border-radius: 5px;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
    border: 1px solid whitesmoke;
}
.grid_content {
    padding: 15px;
}
.seintje_btn {
    color: #068b1d;
  
    
    border: 2px solid #068b1d;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
    width:100%;
    max-width:280px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:13px 30px;
    border-radius:7px;
}
.seintje_btn:hover,.seintje_btn:focus {
    color: white;
    border: 0;
    background: #068b1d;
    border: 2px solid #068b1d !important;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
    width:300px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:13px 30px;
    border-radius:7px;
}
.seintje_btn:hover > .seintje_icon path{
    fill:white;
}
.seintje_btn:focus > .seintje_icon path{
    fill:white;
}
.seintje_icon path{
    fill:#068b1d;
}

.seintje_icon{
    width:20px;
    height:20px;
}


.reset_btn {
    color: #d57c7c;
    border: 2px solid #e6e6e6;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    border-radius: 100px;
    width: 50px;
    height: 50px;
    margin-right:15px;
}
.reset_btn:hover,.reset_btn:focus {
    color: white;
    background: #d57c7c;
    border: 2px solid #d57c7c !important;
}

.reset_icon{
    width:20px;
    height:20px;
}
.chosen_flex{
    display: flex;
    justify-content:flex-start;
    flex-wrap: wrap;
    margin-top: 15px;
}
</style>



<?php


$grid_cars = [];


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


    array_push($grid_cars,[$_car_id,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,
    "model"=>$_car_modelcf_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,
    "carrosserievorm"=>$_car_carrosserievorm_key,"kilometerstand"=>$_car_kilometerstand_key,"bouwjaar"=>$_car_bouwjaar_key,"euro"=>$_car_emissieklasse_key]);



}



?>









<div class="grid_wrap">

<div class="chosen_wrap">

<div class="facet_title">Gekozen Filters</div>

<div class="chosen_flex">
<a href="#" class="reset_btn"><svg class="reset_icon" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)"><path d="m4.5 1.5c-2.4138473 1.37729434-4 4.02194088-4 7 0 4.418278 3.581722 8 8 8s8-3.581722 8-8-3.581722-8-8-8"/><path d="m4.5 5.5v-4h-4"/></g></svg></a>
<div class="chosen_facets">

</div>
</div>
</div>
    <div class="grid_inner grid">
        
       
<?php
$counter = 0;
    foreach ($grid_cars as $car) {
    

        if($counter == 6 || $counter == 24){
            ?>
 <div class="grid_item element-item seintje">
   
   <div class="grid_content">
   <div class="facet_title">Jouw auto niet gevonden?</div>
   <p style="font-size:14px;margin-top:5px;">Dagelijks worden er nieuwe auto's toegevoegd. We kunnen je een seintje geven wanneer er een auto die overeenkomt met jouw interesses beschikbaar komt.</p>

   <a href="#" class="seintje_btn"><span style="padding-right:10px;">Krijg een seintje</span><svg  class="seintje_icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
 <g>
   <g>
     <g>
       <path d="m453.9,96.3c-10.5,10.5-27.6,10.5-38.2,0-10.5-10.5-10.5-27.6 0-38.2 10.5-10.5 27.6-10.5 38.2,0 10.5,10.6 10.5,27.7 0,38.2zm-40.2,136.1c-14.2,35.9-44.3,68.9-71.8,96.4-31.5,31.5-42.4,72.4-45.5,104.3l-217.6-217.6c31.9-3.1 72.8-14 104.3-45.5 27.5-27.5 60.5-57.6 96.4-71.8 40.7-16.1 75.2-8 108.7,25.5 33.5,33.5 41.6,68 25.5,108.7zm-288.9,154.8c-21.4-21.4-24.5-54.4-9-79l88.1,88.1c-24.8,15.4-57.7,12.4-79.1-9.1zm356.8-356.8c-25.9-25.9-67.8-25.9-93.6,2.13163e-14-9.2,9.2-15.1,20.5-17.8,32.3-10-4.7-20.3-8-30.8-9.9-23.8-4.3-48.8-1.3-74.3,8.7-42.6,16.8-79.4,50.2-109.8,80.6-45,45-120.8,33.9-121.5,33.7-8.4-1.4-16.8,2.9-20.7,10.5-3.9,7.6-2.4,16.9 3.6,22.9l70.5,70.5c-30.6,40.5-27.5,98.5 9.5,135.4 36.9,36.9 94.9,40.1 135.4,9.5l70.5,70.5c6,6 15.3,7.5 22.9,3.6 7.6-3.9 11.9-12.2 10.5-20.7 0-0.2-2.9-19.4-0.1-44.1 3.7-32.6 15.1-58.7 33.8-77.4 30.4-30.4 63.8-67.2 80.6-109.8 10.1-25.5 13-50.5 8.7-74.3-1.9-10.5-5.2-20.8-9.9-30.8 11.9-2.6 23.1-8.6 32.3-17.8 26.1-25.6 26.1-67.5 0.2-93.4v7.10543e-15z"/>
     </g>
   </g>
 </g>
</svg></a>
   </div>
   </div>

<?php
        }

    ?>
    
    <div class="grid_item element-item <?php echo  preg_replace('/[^a-zA-Z0-9]/', '',$car["merk"]) . " " . $car["prijs"] . " " .  preg_replace('/[^a-zA-Z0-9]/', '',$car["brandstof"]) . " " .  preg_replace('/[^a-zA-Z0-9]/', '',$car["transmissie"]) . " " .  preg_replace('/[^a-zA-Z0-9]/', '',$car["carrosserievorm"]) . " " . $car["kilometerstand"] . " " . $car["bouwjaar"] . " " .  preg_replace('/[^a-zA-Z0-9]/', '',$car["euro"]) ?>">
    
    <div class="grid_image" style="background-image:url('<?php echo $car["bg"] ?>');">
        
    </div>
    <div class="grid_content">
    <div class="grid_title"><?php echo $car["merk"] . " " .$car["model"] ?> </div>
    <div class="grid_desc"><?php echo $car["brandstof"] ." ". $car["carrosserievorm"] ?></div>
    <br>
    <div class="grid_price">€ <?php echo $car["prijs"] ?></div>
    </div>
    </div>
    
    
    <?php
    
    $counter++;
    }
        
    ?>
   
        
    </div>
    <div class="grid_item element-item seintje">
   
   <div class="grid_content">
   <div class="facet_title">Jouw auto niet gevonden?</div>
   <p style="font-size:14px;margin-top:5px;">Dagelijks worden er nieuwe auto's toegevoegd. We kunnen je een seintje geven wanneer er een auto die overeenkomt met jouw interesses beschikbaar komt.</p>

   <a href="#" class="seintje_btn"><span style="padding-right:10px;">Krijg een seintje</span><svg  class="seintje_icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
 <g>
   <g>
     <g>
       <path d="m453.9,96.3c-10.5,10.5-27.6,10.5-38.2,0-10.5-10.5-10.5-27.6 0-38.2 10.5-10.5 27.6-10.5 38.2,0 10.5,10.6 10.5,27.7 0,38.2zm-40.2,136.1c-14.2,35.9-44.3,68.9-71.8,96.4-31.5,31.5-42.4,72.4-45.5,104.3l-217.6-217.6c31.9-3.1 72.8-14 104.3-45.5 27.5-27.5 60.5-57.6 96.4-71.8 40.7-16.1 75.2-8 108.7,25.5 33.5,33.5 41.6,68 25.5,108.7zm-288.9,154.8c-21.4-21.4-24.5-54.4-9-79l88.1,88.1c-24.8,15.4-57.7,12.4-79.1-9.1zm356.8-356.8c-25.9-25.9-67.8-25.9-93.6,2.13163e-14-9.2,9.2-15.1,20.5-17.8,32.3-10-4.7-20.3-8-30.8-9.9-23.8-4.3-48.8-1.3-74.3,8.7-42.6,16.8-79.4,50.2-109.8,80.6-45,45-120.8,33.9-121.5,33.7-8.4-1.4-16.8,2.9-20.7,10.5-3.9,7.6-2.4,16.9 3.6,22.9l70.5,70.5c-30.6,40.5-27.5,98.5 9.5,135.4 36.9,36.9 94.9,40.1 135.4,9.5l70.5,70.5c6,6 15.3,7.5 22.9,3.6 7.6-3.9 11.9-12.2 10.5-20.7 0-0.2-2.9-19.4-0.1-44.1 3.7-32.6 15.1-58.7 33.8-77.4 30.4-30.4 63.8-67.2 80.6-109.8 10.1-25.5 13-50.5 8.7-74.3-1.9-10.5-5.2-20.8-9.9-30.8 11.9-2.6 23.1-8.6 32.3-17.8 26.1-25.6 26.1-67.5 0.2-93.4v7.10543e-15z"/>
     </g>
   </g>
 </g>
</svg></a>
   </div>
   </div>
</div>