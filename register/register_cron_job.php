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

//lege merk en model custom fields nakijken

add_action( 'merk_model_cf_check', 'merk_model_cf_check' ,1);
if ( ! wp_next_scheduled( 'merk_model_cf_check' ) ) {
    wp_schedule_event( time(), '30min', 'merk_model_cf_check' );
}

//interne fotos die niet bestaan nakijken

add_action( 'vdw_gallery_id_nakijken', 'vdw_gallery_id_nakijken' ,1);
if ( ! wp_next_scheduled( 'vdw_gallery_id_nakijken' ) ) {
    wp_schedule_event( time(), '30min', 'vdw_gallery_id_nakijken' );
}

//opschoenen fotos van archief autos voor ruimte, laat eerste over

add_action( 'photo_cleaning_archive_only_leave_first', 'photo_cleaning_archive_only_leave_first' ,1);
if ( ! wp_next_scheduled( 'photo_cleaning_archive_only_leave_first' ) ) {
    wp_schedule_event( time(), '30min', 'photo_cleaning_archive_only_leave_first' );
}

//carfeed aanmaken

if ( ! wp_next_scheduled( 'carfeed_feed_aanmaken_hook' ) ) {
    wp_schedule_event( time(), 'daily', 'carfeed_feed_aanmaken_hook' );
}
add_action( 'carfeed_feed_aanmaken_hook', 'fb_feed_aanmaken' , 10, 1);

//DSA feed 

// Function to schedule the event
function schedule_page_feed_generation() {
    if (!wp_next_scheduled('generate_page_feed_low')) {
        wp_schedule_event(time(), 'every_five_minutes', 'generate_page_feed_low');
    }
}
add_action('wp', 'schedule_page_feed_generation');

// Custom cron schedule for every 5 minutes
function custom_cron_schedule($schedules) {
    $schedules['every_five_minutes'] = array(
        'interval' => 300, // 5 minutes in seconds
        'display'  => __('Every Five Minutes'),
    );
    return $schedules;
}
add_filter('cron_schedules', 'custom_cron_schedule');


?>