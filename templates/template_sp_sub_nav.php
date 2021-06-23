<div class="wagentitel_wrap">
    <h1 class="wagentitel_h1" style="font-size:20px;">
        <?php

global $post;
$wagentitel = get_post_meta($post->ID,"_car_wagentitel_key",true);
echo $wagentitel;
?>
    </h1>
    <div class="sp_sub_nav">
    <?php do_action( 'before_sp_locatie' ); ?>
        <div class="sp_locatie">
        <i data-feather="map-pin"></i>
        <a href="
        <?php
            echo($sp_locatie_link);
        ?>
        " target="_blank">
            <?php
echo($sp_locatie);
?>
</a>
        </div>

        <div>
        <div class="deellijst_wrap">
        <div class="deellijst">
            <div class="deelitem fbshare"><img src="<?php echo get_site_url(). "/wp-content/plugins/carsync/assets/img/fb.png" ?>" height="15" width="15" />Facebook</div>
            <div class="deelitem twittershare"><img src="<?php echo get_site_url(). "/wp-content/plugins/carsync/assets/img/twitter.png" ?>" height="15" width="15" />Twitter</div>
            <div class="deelitem whatsappshare"><img src="<?php echo get_site_url(). "/wp-content/plugins/carsync/assets/img/whatsapp.png" ?>" height="15" width="15" />Whatsapp</div>
            <div class="deelitem mailshare"><img src="<?php echo get_site_url(). "/wp-content/plugins/carsync/assets/img/mail.png" ?>" height="15" width="15" />E-mail</div>
        </div>
        </div>
        
        <div class="sp_delen">
            <i data-feather="share"></i>
            <div>Delen</div>
        </div>
        </div>
    </div>
</div>