

<style>


.filterwrap{
   
    background: #ffffff;
    width: 330px;
    padding: 20px;
    border-radius: 5px;
    box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 0px;
    border: 1px solid whitesmoke;
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
    $bg = dds_thumbnail($_car_id);


    array_push($grid_cars,[$_car_id,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,"model"=>$_car_modelcf_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,"carrosserievorm"=>$_car_carrosserievorm_key]);



}



foreach ($grid_cars as $car) {
    

    array_push($merk_facet,$car["merk"]);
    $merk_facet = array_unique($merk_facet);
    sort($merk_facet);

}

?>





<div class="filterwrap">
<h3 class="filter_h3">Gevonden wagens</h3>
<div class="filter_inner">


<!-- begin facet -->
<div class="facet_wrap">
<div class="facet_title">Merk<div><svg width="10px" height="10px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14 5L7.5 12L1 5" stroke="black" stroke-linecap="square"/>
</svg>
</div></div>
<div class="facet_inner">
<div class="facet_list">


<?php
foreach ($merk_facet as $facet) {
    


    ?>
    
    <div class="facet_item">
    <input type="radio" id="<?php echo $facet."_id"; ?>" name="merk_facet" value="<?php echo $facet."_val"; ?>" data-filter=".<?php echo $facet; ?>">
    <label for="<?php echo $facet."_id"; ?>"><?php echo ucfirst($facet); ?></label>
    </div>
    
    
    <?php
    
    
    }

?>
</div>
</div>
</div>
<!-- end facet -->


</div>

</div>