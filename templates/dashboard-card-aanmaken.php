<?php


function display_admin_card($post_id){
    $carsync_images = get_post_meta($post_id->ID, '_car_syncimages_key', true);
    $manual_images = get_post_meta($post_id->ID, 'vdw_gallery_id', true);
    if($manual_images == null){
        $selected_img = $carsync_images[0];
    }
    else{
        $selected_img = wp_get_attachment_image_src($manual_images[0]);
    }
    ?>

<div class="card" style="width: 18rem;">
    
  <img src="<?php echo $selected_img;?>" class="card-img-top" alt="<?php echo get_the_title($post_id);?>">
  <div class="card-body">
    <h5 class="card-title"><?php echo get_the_title($post_id);?></h5>
    <hr>    
    <a href="http://cmpluginzone.local/wp-admin/post.php?post=<?php echo($post_id->ID); ?>&amp;action=edit" class="btn btn-primary">Beheer deze wagen</a>
    
  </div>
</div>

    <?php
}

?>