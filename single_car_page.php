
<?php
if(is_singular("autos")){
        
    get_header();
?>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
<link rel="stylesheet" href="<?php echo get_site_url() . "/wp-content/plugins/carsync/assets/css/sp_single.css?v=". uniqid() ?>">



<?php

    include(__DIR__."/templates/template_sp_vars.php");

    include(__DIR__."/templates/template_sp_custom_css.php");

    include(__DIR__."/templates/template_sp_popups.php");

    include(__DIR__."/templates/template_sp_top_sticky_nav.php");

    include(__DIR__."/templates/template_sp_sticky_mobile_nav.php"); ?>



<div class="sp_top_wrap">
<?php

include(__DIR__."/templates/template_sp_sub_nav.php");
    if ($sp_chosen_type == "grid") {
        include(__DIR__."/templates/template_sp_grid.php");
    } ?>

    <div class="sp_mid_wrap">

        <div class="sp_mid">

            <?php

                if ($sp_chosen_type == "slideshow") {
                    include(__DIR__."/templates/template_sp_slideshow.php");
                } ?>
            
            <?php include(__DIR__."/templates/template_sp_status.php"); ?>

            <br>

            <div class="carpass_traxio_garantie_check">
                <ul>
                    <li><a href="<?php echo $sp_carpass; ?>" target="_blank"><i data-feather="check"></i>Carpass</a></li>
                    <li><a href="https://www.traxio.be/" target="_blank"><i data-feather="check"></i>Traxio Lid</a></li>
                    <li><a href=""><i data-feather="check"></i>12 maanden Garantie</a></li>
                </ul>
            </div>

            

            <?php
            do_action( 'before_template_sp_specs' );  

            include(__DIR__."/templates/template_sp_specs.php");

    include(__DIR__."/templates/template_sp_options.php");

    include(__DIR__."/templates/template_sp_desc.php"); ?>

        </div>

        <?php include(__DIR__."/templates/template_sp_sticky_sidebar.php"); ?>

    </div>



    <?php include(__DIR__."/templates/template_sp_gerelateerde_wagens.php"); ?>


</div>
<input style="display:none !important;" id="sp_merk_hidden" value="<?php echo $sp_merk ?>" />
<input style="display:none !important;" id="sp_model_hidden" value="<?php echo $sp_model ?>" />
<script src="<?php echo get_site_url() . '/wp-content/plugins/carsync/assets/js/sp_single.js?v=5.557'; ?>"></script>
<script src="<?php echo get_site_url() . '/wp-content/plugins/carsync/assets/js/sp_contact.js?v=5.557'; ?>"></script>
<script src="<?php echo get_site_url() . '/wp-content/plugins/carsync/assets/js/sp_testrit.js?v=5.557'; ?>"></script>
<?php get_footer();
}
?>