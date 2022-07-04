
<style>
    .grid_wrap {
    width: 75%;
    margin:0 5%;
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
    max-width: 1400px;
    margin: 50px auto;
    padding: 0 3%;
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
    $bg = dds_thumbnail($_car_id);


    array_push($grid_cars,[$_car_id,"bg"=>$bg,"wagentitel"=>$_car_wagentitel_key,"prijs"=>$_car_prijs_key,"merk"=>$_car_merkcf_key,"model"=>$_car_modelcf_key,"transmissie"=>$_car_transmissie_key,"bouwjaar"=>$_car_bouwjaar_key,"brandstof"=>$_car_brandstof_key,"carrosserievorm"=>$_car_carrosserievorm_key]);



}



?>










<div class="grid_wrap">
    <div class="grid_inner grid">
        
       
<?php
    foreach ($grid_cars as $car) {
    

    ?>
    
    <div class="grid_item element-item <?php echo $car["merk"] ?>">
    
    <div class="grid_image" style="background-image:url('<?php echo $car["bg"] ?>');">
        
    </div>
    <div class="grid_content">
    <div class="grid_title"><?php echo $car["merk"] . " " .$car["model"] ?> </div>
    <div class="grid_desc"><?php echo $car["wagentitel"] ?>  ?></div>
    <br>
    <div class="grid_price">€ <?php echo $car["prijs"] ?></div>
    </div>
    </div>
    
    
    <?php
    
    
    }
        
    ?>
    
        
    </div>
</div>