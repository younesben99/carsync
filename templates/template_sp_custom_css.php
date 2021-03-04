<style>
    .opties svg.feather.feather-check {
        color: <?php echo($sp_color);
        ?>;
    }

    .rel_bekijk {
        color:<?php echo($sp_color); ?> !important;
        text-decoration:none;
        margin-left: 18px;
    }
    .sp_sticky_beschikbaarheid {
        background: <?php echo $sp_color;
        ?>;
        background: linear-gradient(30deg, <?php echo $sp_color; ?>, <?php echo $sp_hover_color; ?>);
    }
    .splide__pagination__page.is-active{
        background: <?php echo $sp_color;
        ?> !important;
}
.sp_sticky_telefoneren {
    border: 2px solid <?php echo $sp_color; ?> !important;
    color: <?php echo $sp_color; ?> !important;
}
.rel_bekijkstock{
    background-color: <?php echo $sp_color; ?>;
    
}
.rel_bekijkstock:hover{
    background-color: <?php echo($sp_hover_color);?>;
    transition:all 0.4s ease;
    
}
.smv_wrap {
    color: <?php echo $sp_color; ?>;
    border: 2px solid <?php echo $sp_color; ?>;
}
.sp_smv_mail,button#sp_contact_versturen,button#sp_testrit_versturen {
    background: <?php echo $sp_color; ?> !important;
    color: white;
    cursor:pointer;
    outline:0;
}
.sp_smv_mail:hover,button#sp_contact_versturen:hover,button#sp_testrit_versturen:hover {
    background: <?php echo($sp_hover_color);?>  !important;
    transition:all 0.4s ease;
}
.sp_sticky_telefoneren:hover{
    color: <?php echo($sp_hover_color);?> !important;
}

.sp_smv_call{
    text-decoration: none !important;
    color: <?php echo $sp_color; ?> !important;
}
.sp_contact_loading:before,.sp_testrit_loading:before {
    background: url(<?php echo(get_site_url()); ?>/wp-content/plugins/carsync/assets/img/loading.gif);
    background-size: cover;
}
.sp_sticky_testrit:hover,.sp_sticky_vergelijken:hover {
    color: <?php echo $sp_color; ?> !important;
    cursor: pointer;
}
</style>