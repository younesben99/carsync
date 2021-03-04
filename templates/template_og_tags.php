<?php

$og_carsync_fotos = pak_veld( '_car_syncimages_key');
$og_manual_fotos = pak_veld( 'vdw_gallery_id');
$og_value_sync = pak_veld('_car_sync_key');

$og_img_link;


if (!empty($og_carsync_fotos) && $og_value_sync == "YES") {
    
    $og_img_link = $og_carsync_fotos[0];


} else {

    if (!empty($og_manual_fotos)) {

        $og_img_link = wp_get_attachment_url($og_manual_fotos[0]);
            
    } else {

        foreach ($og_carsync_fotos as $og_img) {
            
            $og_img_link = $og_carsync_fotos[0];
            
        }

    }

}

?>
<meta property="og:title" content="<?php echo $sp_title; ?>">
<meta property="og:site_name" content="<?php echo $sp_handelsnaam; ?>">
<meta property="og:url" content="<?php echo get_permalink(); ?>">
<meta property="og:description" content="<?php echo strip_tags($sp_description); ?>">
<meta property="og:type" content="product.item">
<meta property="og:image" content="<?php echo $og_img_link; ?>">
<meta property="og:image:secure" content="<?php echo $og_img_link; ?>">
<meta property="og:image:secure_url" content="<?php echo $og_img_link; ?>">