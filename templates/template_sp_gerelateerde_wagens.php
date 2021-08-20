<div class="sp_rel_wrap" id="gerelateerd">
<div class="spechead relhead"><h2>Gerelateerde wagens</h2></div>

<div class="sp_grid_wrap splide">

<div class="splide__track">

<ul class="splide__list">
<?php
$args = array(
    'numberposts' => 5,
    'post_type'   => 'autos',
    'meta_query' => array(
        array(
            'key' => '_car_status_key',
            'value' => 'tekoop',
            'compare' => 'LIKE'
        )
    )
  );
$relatedposts = get_posts($args);


foreach($relatedposts as $wagen){
    $rel_title = get_the_title($wagen);
    $rel_link = get_permalink($wagen);
    
    $rel_price = get_post_meta($wagen->ID, "_car_prijs_key",true);
    $rel_wagentitel = get_post_meta($wagen->ID, "_car_wagentitel_key",true);
    $rel_brandstof = get_post_meta($wagen->ID, "_car_brandstof_key",true);
    $rel_transmissie = get_post_meta($wagen->ID, "_car_transmissie_key",true);
    $rel_bouwjaar = get_post_meta($wagen->ID, "_car_bouwjaar_key",true);

    $carsync_images = get_post_meta($wagen->ID, '_car_syncimages_key', true);
    $manual_images = get_post_meta($wagen->ID, 'vdw_gallery_id', true);
    if($manual_images == null){
        $selected_img = $carsync_images[0];
    }
    else{
        $selected_img_url = wp_get_attachment_image_src($manual_images[0],'medium');
        $selected_img = $selected_img_url[0];
    }
    
    ?>

    <li class="splide__slide" onclick="location.href='<?php echo $rel_link; ?>';">
    <div class="rel_card_wrap">
    <div><img src="<?php echo($selected_img); ?>" alt="<?php echo $rel_title; ?>" style="width:100%" /></div>
    
    <h2><?php echo $rel_title; ?></h2>
    <div class="rel_price"><?php echo "€ ".number_format($rel_price,0,",",".") . ",-"; ?></div>
    <div class="rel_list">
    <div class="rel_brandstof"><?php echo $rel_brandstof; ?></div>
    <div class="rel_transmissie"><?php echo $rel_transmissie; ?></div>
    <div class="rel_bouwjaar"><?php echo  substr($rel_bouwjaar,0,4); ?></div>
    </div>
    <a href="<?php echo $rel_link; ?>" class="rel_bekijk">Bekijk wagen</a>
    </div>
    </li>

    <?php
}

?>

<li class="splide__slide">
    <div class="rel_card_wrap">
    <div><img src="<?php echo(get_site_url()); ?>/wp-content/plugins/carsync/assets/img/bekijkstock.png" alt="<?php echo $rel_title; ?>" style="width:100%" /></div>
    <div>
    <h2>Bekijk onze hele stock</h2>
    <a href="<?php echo get_site_url().'/autos/';?>"class="rel_bekijkstock">Bekijk onze stock</a>
    </div>
    
    </div>
    </li>

</ul>
</div>
</div>


</div>