
<?php
if(is_singular("autos")){
        
    get_header();
?>


<?php
function enqueue_simple_line_icons() {
   
}
add_action( 'wp_enqueue_scripts', 'enqueue_simple_line_icons' );

if ( is_singular( 'autos' ) ) { ?>

<style>
    /* .edit-post {
        color: #20aee3;
    background: #f0f5f7;
    text-decoration: none;
    font-size: 13px;
    padding: 10px;
    font-weight: 500;
    border-radius: 7px;
    text-align: center;
    margin-top: 10px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    width: 25%;
    min-width: 110px;
    max-width: 130px;
} */




</style>
<!-- <div class="edit-post"> -->
        <?php 
            // $post_id = get_the_ID();
            // $dashboard_url = site_url('/dashboard/edit/?id=' . $post_id);
         //   printf( '<i class="icon-pencil"></i><a href="%s">%s</a>', esc_url( $dashboard_url ), __( 'Auto Bewerken', 'textdomain' ) ); 
        ?>
    <!-- </div> -->


<?php } ?>

<?php

    include(__DIR__."/templates/template_sp_vars.php");

    



    include(__DIR__."/templates/template_sp_top_sticky_nav.php");

    include(__DIR__."/templates/template_sp_sticky_mobile_nav.php"); 

    $sp_margin = get_option( 'dds_settings_option_name' );
        
    $sp_margin = $sp_margin['sp_margin'];


    if(!empty($sp_margin)){
?>

<style>
    .sp_top_wrap{
        margin-top:<?php echo $sp_margin; ?>px !important;
    }
</style>

<?php
    }

    ?>

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
            <?php do_action('checklist_scp', $sp_carpass); ?>

            

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