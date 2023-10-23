<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

function generate_page_feed_low() {
    // Headers for forcing download and preventing caching
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="ad_spend_low.csv"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Write header row
    fputcsv($output, array('Page URL', 'Custom Label'));

    $args = array(
        'post_type'      => 'autos',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'tax_query'      => array(
            array(
                'taxonomy' => 'ad_spend',
                'field'    => 'slug',
                'terms'    => 'low',
            )
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $page_url = get_permalink();
            $id = get_the_ID();
            $_car_status = get_post_meta($id, '_car_status_key', true);
            $_car_post_status_key = get_post_meta($id, '_car_post_status_key', true);

            if ($_car_status == "tekoop" && $_car_post_status_key == "actief") {
                fputcsv($output, array($page_url, 'ActiefLow'));
            } else {
                fputcsv($output, array($page_url, 'Skip'));
            }
        }
    }

    wp_reset_postdata();

    // Close output stream
    fclose($output);
    exit;
}

generate_page_feed_low();

?>
