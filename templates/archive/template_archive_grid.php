
<style>
    .grid_wrap {
    width: 75%;
    margin:0 5%;
    padding-top: 50px;
}
.dds_btn_icon {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    justify-content: space-between;
    width: fit-content;
}
.dds_btn_icon img{
    width: 18px;
    height:18px;
    margin-left:10px;
}
.grid_inner{
    margin-top:30px;
}
.sort_bodh_wrap{
    display:flex;
    flex-wrap:wrap;
    justify-content:space-between;
    align-items:center;

}
.sort_label{
    margin-right:10px;margin-right: 16px;
    color: grey;
}
.sort_select {
    outline:0 !important;
    width: 200px;
    border: 0;
    border-radius: 0;
    border-left: 1px solid lightgrey;
    font-weight:600;
}
.grid_item {
 
   cursor:pointer;
   width: 31.5%;
   max-width:330px;
  
    border-radius: 5px;
    background: #fdfdfd;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
    border: 1px solid whitesmoke;
    margin-bottom:25px;
    transition: box-shadow 0.15s ease-in-out 0s;
    
}
@media only screen and (max-width: 1350px) {
    .grid_item {
 width: 30%;
 max-width:unset;
}
}
@media only screen and (max-width: 1150px) {
    .grid_item {
 width: 280px;
 max-width:unset;
}
}

.grid_item:hover {
 
    box-shadow: rgb(45 45 45 / 16%) 0px 24px 40px 0px, rgb(238 238 238) 0px 0px 0px 1px;


}
.grid_fav svg{
    height:23px;
    width:23px;
}
.grid_bottom_btns {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: absolute;
    bottom: 11px;
    width: 218px;
}
.grid_btn{
    display: flex;
    width: 100%;
    justify-content: flex-start;
    margin-top: 10px;
    color: #3d9cff;
    font-weight:500;

}
.grid_title {
    font-weight: 600;
    text-transform: capitalize;
    margin-bottom: 10px;
}
.grid_desc {
    font-size: 11px;
    color: #7a7a7a;
    height: 16px;
}
.grid_keys{
    font-size: 12px;
    color: #adadad;
    text-transform: capitalize;
    margin-bottom: 10px;
    height: 30px;
}

.grid_price {
    font-weight: 500;
    font-size: 15px;
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-top: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;
}
.grid_image{
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    height: 202px;
    background-size: cover;
    background-position: center;

}
.grid_image img{
    object-fit: cover;
    height: 201px;
    width: 100%;
}
.grid_content{
    padding: 6px 18px 16px;
   

    height: 191px;


}
.bodh_title{
font-weight:500;
font-size:22px;
}
.filtergrid_wrap{
    max-width: 2400px;
    margin: 0px auto 0 0;
    padding:0 0 0 0;
}
.bodh {
    min-width: 100%;
    width: 100% !important;
    border-radius: 0px;
    box-shadow: 0px 0px 0px 0px !important;
    border: 0px solid;
    padding: 50px 0px 50px;
    background: transparent !important;
}

.grid_content {
    padding: 15px 15px 0px 15px;
}
.bodh_btn_filter {
    color: white;
    border: 0;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
   
    display:flex;
    justify-content:space-between;
    align-items:center;
    width:300px;
    height:55px;
   
}
.bodh_btn_filter:hover {
    color: white;
 
    
}
.bodh_btn {
    color: #3d9cff;
  
    
    border: 2px solid #3d9cff;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
    width:100%;
    max-width:280px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px;
    border-radius:7px;
   
}
.bodh_btn:hover,.bodh_btn:focus {
    color: white;
    background: #3d9cff;
    border: 2px solid #3d9cff !important;
    
}
.bodh_btn:hover > .bodh_icon path{
    fill:white;
}
.bodh_btn:focus > .bodh_icon path{
    fill:white;
}
.bodh_icon path{
    fill:#3d9cff;
}
.bodh_btn_filter path{
    fill:#ffffff;
}

.bodh_icon{
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

    margin-bottom:15px;
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
}button.selecteer_filter {
    border-radius: 100px;
    border: 2px solid #489bf4;
    color: white;
    margin-bottom: 15px;
}
@media only screen and (max-width: 910px) {
  
  .filterwrap {
    
    width: 322px;
}
  .grid_wrap{
    width:100%;
    margin: 0 2%;

  }
  .grid_item{
    width: 30%;
    min-width:250px;
  }
  .archive_banner {
    padding: 0 2%;
}
}@media only screen and (max-width: 770px) {
    .sort_wrap{
        display: flex;
    align-items: center;
    width: 100%;
    justify-content: flex-start;
    }
    .top_grid_bodh {
        display:none;
}
.filter_mobile_wrap{
    display: flex;
}
.chosen_flex{
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 5px;
    width: 100%;
    margin-top:0;
    flex-wrap: nowrap;
    position: fixed;
    z-index: 5;
    top: 70px;
    left: 0;
    background: white;
    padding: 10px 15px 0 15px;
    

}

.chosen_facets {
    overflow-x: scroll;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: center;
}
.chosen_facets:after {
    content: "";
    position: absolute;
    height: 100px;
    width: 70px;
    background: linear-gradient(90deg, #ffffff00 0%, white 54%);
    right: 15px;
    height: 100%;
    top: 0;
    right: 0;
    z-index: 0;
    pointer-events: none;
}
.chosen_facets .ch_facet_item:last-child{
    z-index:1;
}
.reset_btn {
    min-width: 50px !important;
    min-height: 50px;
    margin-right: 15px;
    margin-bottom: 15px;
}.ch_facet_item{

    min-width: max-content;

}
.filterwrap {
    display:none;
    width: 100%;
    position: fixed;
    z-index: 100000;
    height: 100%;
    top: auto;
    bottom:-100vh;
    overflow-y: scroll;
    padding-bottom:100px;
    opacity:0;
}

    .grid_item{
    width:47%;
    min-width:200px;
  }
}@media only screen and (max-width: 590px) {
   
   
.grid_item{
    width:47%;
    min-width:200px;
  }
  .grid_image {
    background-position: center center;
}
  .grid_wrap{
    margin: 0 5%;

  }
  .archive_banner {
    padding: 0 5%;
}
  .grid_title {
    font-size: 12px;
}
}
@media only screen and (max-width: 475px) {
   
    .grid_item{
    width:100%;
  }
  .grid_wrap {
    margin: 0 15%;
}
.archive_banner {
    padding: 0 15%;
}
}
@media only screen and (max-width: 435px) {
  
    .grid_title {
    font-size: 18px;
}
    .grid_image {
    height: 225px;
    background-position: center center;
}
    .grid_item {
    width: 100%;
    margin-bottom:40px;
}.grid_wrap{
    margin: 0 10%;

  }
  .archive_banner {
    padding: 0 10%;
}

}
</style>



<?php

include_once( __DIR__ . '/template_card.php');

$grid_cars = [];


$args = array(
    'post_type'        => 'autos',
    'posts_per_page'   => -1,
    'orderby' => 'meta_value_num',
            'meta_key' => '_car_bouwjaar_key',
            'order' => 'DESC'
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
    $car_link = get_permalink($value->ID);

    array_push($grid_cars,["id" =>$_car_id,"link"=> $car_link,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,
    "model"=>$_car_modelcf_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,
    "carrosserievorm"=>$_car_carrosserievorm_key,"kilometerstand"=>$_car_kilometerstand_key,"bouwjaar"=>$_car_bouwjaar_key,"euro"=>$_car_emissieklasse_key]);


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

</div>
</div>



</div>
    <div class="grid_inner grid">
        
       
<?php
//bodh tijdelijk uit
// $counter = 0;
    foreach ($grid_cars as $car) {
    

        // if($counter == 6 || $counter == 24){
        //     bodh_card();
        // }

        stock_card($car);
    
    // $counter++;
    }
        
   
    ?>
   
        
    </div>
    <?php

bodh_card();

?>
    
</div>