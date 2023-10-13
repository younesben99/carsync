<?php
    get_header();
    ?>


<?php

    include(plugin_dir_path(__FILE__) ."/archive/template_banner.php");



    //filter voor mobile
    include(plugin_dir_path(__FILE__) ."/archive/template_archive_filter_mobile.php");
   

    $archive_margin = get_option( 'dds_settings_option_name' );
        
    $archive_margin = $archive_margin['archive_margin'];


    if(!empty($archive_margin)){
?>

<style>
    .archive_banner{
        margin-top:<?php echo $archive_margin; ?>px !important;
    }
</style>

<?php
    }

    ?>






<div class="filtergrid_wrap">

    <?php
   $current_term = get_queried_object(); // Get current term object
    include(plugin_dir_path(__FILE__) ."/archive/template_ad_spend_archive_filter.php");
    include(plugin_dir_path(__FILE__) ."/archive/template_ad_spend_archive_grid.php");
    include(plugin_dir_path(__FILE__) ."/archive/template_archive_pop.php");

    ?>

</div>

<?php


 ?>

<?php

 get_footer();

?>