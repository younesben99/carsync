<?php
    get_header();
    ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"
    integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php

    include(__DIR__."/templates/archive/template_banner.php");



    //filter voor mobile
    include(__DIR__."/templates/archive/template_archive_filter_mobile.php");
   

    ?>


<div class="filtergrid_wrap">

    <?php
   
    include(__DIR__."/templates/archive/template_archive_filter.php");
    include(__DIR__."/templates/archive/template_archive_grid.php");
    include(__DIR__."/templates/archive/template_archive_pop.php");

    ?>

</div>

<?php


 ?>

<?php

 get_footer();

?>