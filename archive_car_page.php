<?php
    get_header();
    ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?php

    include(__DIR__."/templates/archive/template_banner.php");
    

    ?>

    <style>
        .filtergrid_wrap{
            display: flex;
        }
    </style>

    <script>

jQuery( document ).ready(function($) {
    var $grid = $('.grid').isotope({
        itemSelector: '.element-item',
        percentPosition: true,
        layoutMode: 'fitRows',
fitRows: {
  gutter: 15
}
        });


$('.facet_list').on( 'click', 'input', function() {

 
    var filterValue = $(this).attr('data-filter');

    $grid.isotope({ filter: filterValue });
  
 
});


});

      

        </script>

    <div class="filtergrid_wrap">

    <?php
    include(__DIR__."/templates/archive/template_archive_filter.php");
    include(__DIR__."/templates/archive/template_archive_grid.php");
    ?>

</div>

    <?php


 ?>

 <?php

 //get_footer();

?>