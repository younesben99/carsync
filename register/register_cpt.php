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
        )
    );
}
add_action('init', 'autos_post_type');

?>