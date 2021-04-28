<?php

function dds_compare() {
    
    include(__DIR__ . "/../templates/template_compare.php");
}

add_shortcode('vergelijken', 'dds_compare');


?>