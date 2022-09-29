<?php
include(__DIR__."/../../../../wp-load.php");



$car_fields = get_post_meta(14697);
$zapier_offerte = wp_zapier_billit($car_fields,true);
var_dump($zapier_offerte);
if($zapier_offerte["status"] == "success"){
    echo("YES");
}
else{
   echo("NO");
}

?>