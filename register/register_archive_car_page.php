<?php
if(!file_exists(get_template_directory() . "/archive-autos.php")){
    $myfile = fopen(get_template_directory()  . "/archive-autos.php", "w");
    $content = '<?php
    include(__DIR__."/../../plugins/carsync/archive_car_page.php");
?>';
    fwrite($myfile, $content);
    fclose($myfile);
}
?>