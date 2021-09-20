<?php
/*
CRON JOB CONFIGUREREN
*/
function my_cron_schedules($schedules){
    if(!isset($schedules["30min"])){
        $schedules["30min"] = array(
            'interval' => 1800,
            'display' => __('Once every 30 minuten'));
    }
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
    wp_schedule_event( time(), '30min', 'carsync_car_fotos_downloaden' );
}




?>