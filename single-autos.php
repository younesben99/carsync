
<?php

get_header();

// TODO'S!

// vergelijken

// testrit

// beschikbaarheid controleren

// troeven

?>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
<link rel="stylesheet" href="<?php echo get_site_url() . "/wp-content/plugins/carsync/assets/css/sp_single.css" ?>">



<?php

include(__DIR__."/templates/template_sp_vars.php");

include(__DIR__."/templates/template_sp_custom_css.php");

include(__DIR__."/templates/template_sp_popups.php");

include(__DIR__."/templates/template_sp_top_sticky_nav.php");

include(__DIR__."/templates/template_sp_sticky_mobile_nav.php");

include(__DIR__."/templates/template_sp_sticky_mobile_nav.php");
?>



<div class="sp_top_wrap">
<?php 

include(__DIR__."/templates/template_sp_sub_nav.php"); 
if($sp_chosen_type == "grid"){
    include(__DIR__."/templates/template_sp_grid.php");
}


?>

    <div class="sp_mid_wrap">

        <div class="sp_mid">

            <?php

                if($sp_chosen_type == "slideshow"){
                    include(__DIR__."/templates/template_sp_slideshow.php");
                }

            ?>
            
            <?php include(__DIR__."/templates/template_sp_status.php"); ?>

            
            <div class="posttitle">
                <h1><?php the_title(); ?></h1>
            </div>

            <div class="carpass_traxio_garantie_check">
                <ul>
                    <li><a href="<?php echo $sp_carpass;?>" target="_blank"><i data-feather="check"></i>Carpass</a></li>
                    <li><a href="https://www.traxio.be/" target="_blank"><i data-feather="check"></i>Traxio Lid</a></li>
                    <li><a href=""><i data-feather="check"></i>12 maanden Garantie</a></li>
                </ul>
            </div>


            <?php

            include(__DIR__."/templates/template_sp_specs.php");

            include(__DIR__."/templates/template_sp_options.php");

            include(__DIR__."/templates/template_sp_desc.php");

            ?>

        </div>

        <?php include(__DIR__."/templates/template_sp_sticky_sidebar.php"); ?>

    </div>



    <?php include(__DIR__."/templates/template_sp_gerelateerde_wagens.php"); ?>


</div>



<script src="<?php echo get_site_url() . '/wp-content/plugins/carsync/assets/js/sp_single.js';?>"></script>
<script src="<?php echo get_site_url() . '/wp-content/plugins/carsync/assets/js/sp_contact.js';?>"></script>
<script src="<?php echo get_site_url() . '/wp-content/plugins/carsync/assets/js/sp_testrit.js';?>"></script>
<?php get_footer(); ?>