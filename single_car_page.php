
<?php
if(is_singular("autos")){
        
    get_header();
?>




<?php

    include(__DIR__."/templates/template_sp_vars.php");

    



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
            <?php include(__DIR__."/templates/template_sp_snelle_specs.php"); ?>
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


            include(__DIR__."/templates/template_sticky_mobile.php");

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

<?php get_footer();
}
?>