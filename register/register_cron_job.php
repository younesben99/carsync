<?php
/*
CRON JOB CONFIGUREREN
*/
function my_cron_schedules($schedules){
    if(!isset($schedules["30min"])){
        $schedules["30min"] = array(
            'interval' => 1800,
            'display' => __('Elke 30 minuten'));
    }
    $schedules['10min'] = array(
        'interval'  => 600,
        'display'   => __( 'Elke 10 minuten', 'textdomain' )
    );
    return $schedules;
}
add_filter('cron_schedules','my_cron_schedules');




//cron job(s)


add_action( 'carsync_data_ophalen_hook', 'carsync_data_ophalen' ,1);
if ( ! wp_next_scheduled( 'carsync_data_ophalen_hook' ) ) {
    wp_schedule_event( time(), '30min', 'carsync_data_ophalen_hook' );
}

//foto's downloaden voor autos en missing links vervangen

add_action( 'carsync_car_fotos_downloaden', 'dds_car_fotos_downloaden' ,1);
if ( ! wp_next_scheduled( 'carsync_car_fotos_downloaden' ) ) {
    wp_schedule_event( time(), '10min', 'carsync_car_fotos_downloaden' );
}

if ( ! wp_next_scheduled( 'carfeed_feed_aanmaken_hook' ) ) {
    wp_schedule_event( time(), 'daily', 'carfeed_feed_aanmaken_hook' );
}
add_action( 'carfeed_feed_aanmaken_hook', 'fb_feed_aanmaken' , 10, 1);


?>