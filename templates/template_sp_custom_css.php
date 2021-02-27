<style>
    .opties svg.feather.feather-check {
        color: <?php echo($sp_color);
        ?>;
    }

    .rel_bekijk {
        background: <?php echo($sp_color); ?>;
        color:white !important;
        text-decoration:none;
    }
    .rel_bekijk:hover {
        background: <?php echo($sp_hover_color);?>;
    transition:all 0.4s ease;
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
    border: 2px solid <?php echo $sp_color; ?>;
    color: <?php echo $sp_color; ?>;
}
.rel_bekijkstock{
    background-color: <?php echo $sp_color; ?>;
    
}
.rel_bekijkstock:hover{
    background-color: <?php echo($sp_hover_color);?>;
    transition:all 0.4s ease;
    
}
</style>