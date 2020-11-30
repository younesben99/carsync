<?php

function autos_post_type() {
    register_post_type('autos',
        array(
            'labels'      => array(
                'name'          => __('Auto\'s', 'textdomain'),
                'singular_name' => __('Auto', 'textdomain'),
            ),
                'public'      => true,
                'has_archive' => true,
                'supports' => array('title','author')
        )
    );
}
add_action('init', 'autos_post_type');

function merk_model_taxonomies() {
    register_taxonomy(
        'merkenmodel',
        'autos',
        array(
            'labels' => array(
                'name' => 'Merk & Model',
                'add_new_item' => 'Merk of model toevoegen',
                'new_item_name' => "Merk of model toevoegen"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
add_action( 'init', 'merk_model_taxonomies', 0 );
?>