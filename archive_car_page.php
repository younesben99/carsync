<?php
    get_header();
    ?>


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