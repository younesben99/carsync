<?php

function generate_page_feed_low() {
    $args = array(
        'post_type'        => 'autos',
    'posts_per_page'   => -1,
    'order'            => 'ASC',
    'tax_query'      => array(
        array(
            'taxonomy' => 'ad_spend', 
            'field'    => 'slug',
            'terms'    => "low", 
        ),
    ),
    'meta_query'       => array(
        array(
            'key'     => '_car_status_key',
            'value'   => 'tekoop',
            'compare' => '=',
        ),
    )
    );
    
    $query = new WP_Query($args);
    
    $feed_data = "Page URL, Custom Label\n";
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $page_url = get_permalink();
            $feed_data .= "$page_url, LowAdSpendCars\n";
        }
    }
    
    wp_reset_postdata();
    
    $file_path = plugin_dir_path(__FILE__) . 'ad_spend_low.csv';
    file_put_contents($file_path, $feed_data);
    
    return $file_path;
}

?>