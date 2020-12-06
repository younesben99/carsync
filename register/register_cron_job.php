<?php
/*

CRON JOB CONFIGUREREN
*/
function my_cron_schedules($schedules){
    if(!isset($schedules["15min"])){
        $schedules["15min"] = array(
            'interval' => 1000*60,
            'display' => __('Once every 15 minuten'));
    }
    return $schedules;
}
add_filter('cron_schedules','my_cron_schedules');


if ( ! wp_next_scheduled( 'carsync_posts_maken_hook' ) ) {
    wp_schedule_event( time(), '15min', 'carsync_posts_maken_hook' );
}


add_action( 'carsync_posts_maken_hook', 'carsync_posts_maken' , 10, 0);

?>