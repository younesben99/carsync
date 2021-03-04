<?php


if(!file_exists(get_template_directory() . "/single-autos.php")){

    $myfile = fopen(get_template_directory()  . "/single-autos.php", "w");
    $content = '<?php
    include(__DIR__."/../../plugins/carsync/single_car_page.php");
    ?>';
    fwrite($myfile, $content);
    fclose($myfile);

}

?>