<div class="sp_sticky_nav">

    <div class="sp_sticky">

        <div class="sp_sticky_prijs">
            <div style="font-size: 15px;">Prijs</div>
            <?php echo "€ ".number_format($sp_prijs,0,",",".") . ",-"; ?>
            <?php
            if(!empty($sp_oudeprijs)){
                echo "<div class='sp_sticky_oudeprijs'>€ ".number_format($sp_oudeprijs,0,",",".") . ",-</div>";
            }
        ?>
        </div>
        

        <div class="sp_sticky_vergelijken" style="display:none;"><i data-feather="repeat"></i>Vergelijken</div>
        <div class="sp_sticky_testrit"><i data-feather="calendar"></i>Testrit boeken</div>
        <div class="sp_sticky_contact_wrap">
            <div class="sp_sticky_beschikbaarheid contactpop">Contact opnemen</div>
            <a href="tel:<?php echo($sp_telnr_formatted) ;?>" class="sp_sticky_telefoneren"><?php echo($sp_telnr) ;?></a>
        </div>
        <div class="sp_sticky_troeven">
            <?php

if(!empty($sp_shortcode_troeven)){
    echo do_shortcode($sp_shortcode_troeven);
}

?>
        </div>

    </div>

</div>