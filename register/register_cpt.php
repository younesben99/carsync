<?php

function autos_post_type() {
    register_post_type('autos',
        array(
            'labels'      => array(
                'name'          => __('Auto\'s', 'textdomain'),
                'singular_name' => __('Auto', 'textdomain'),
                'all_items' => 'Alle wagens',
                'menu_name' => "Wagens",
                'edit_item' => 'Bewerk wagen',
                'add_new' => 'Wagen toevoegen'


            ),
                'public'      => true,
                'has_archive' => true,
                'supports' => array('title', ),
                'menu_icon' => 'dashicons-car'
        )
    );
}

     
add_action('init', 'autos_post_type');

function ad_spend_auto_types_taxonomy() {
    $labels = array(
        'name' => 'Ad Spend',
        'singular_name' => 'Ad Spend Category',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'autos/ad_spend')

    );

    register_taxonomy('ad_spend', 'autos', $args);

    // Add the three terms (Low, Mid, High)
    wp_insert_term('Low', 'ad_spend');
    wp_insert_term('Mid', 'ad_spend');
    wp_insert_term('High', 'ad_spend');


    add_filter('template_include', 'custom_taxonomy_template');

    function custom_taxonomy_template($template) {
        if (is_tax('ad_spend')) {
            $new_template = locate_template(array('adspend-taxonomy-template.php'));
            if (file_exists($new_template)) {
                return $new_template;
            }
        }
        return $template;
    }
    
    
    
}
add_action('init', 'ad_spend_auto_types_taxonomy',0);

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





// Add the custom columns to the autos post type:
add_filter( 'manage_autos_posts_columns', 'set_custom_edit_autos_columns' );
function set_custom_edit_autos_columns($columns) {
    unset( $columns['author'] );
    $columns['uitgelichtefoto'] = 'Uitgelichte foto';
    $columns['wagenstatus'] = 'Wagen status';
    $columns['fotosgedownload'] = 'fotosgedownload';
    return $columns;
}

add_filter('manage_autos_posts_columns', 'column_order');
function column_order($columns) {
  $n_columns = array();
  $move = 'uitgelichtefoto';
  $before = 'title';
  foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
}
//add data to column
add_action( 'manage_autos_posts_custom_column' , 'custom_autos_column', 10, 2 );
function custom_autos_column( $column, $post_id ) {
    switch ( $column ) {

        case 'uitgelichtefoto' :
            $carsync_fotos = get_post_meta( $post_id , '_car_syncimages_key', true );
            $manual_fotos = get_post_meta( $post_id , 'vdw_gallery_id', true );
            $value_sync = get_post_meta( $post_id, '_car_sync_key', true );

            if(!empty($manual_fotos)){
                if($manual_fotos[0] == 1){
                    echo "<img src='https://digiflowroot.be/static/images/camera_image.jpg' style='max-width:150px;border-radius:5px;' />";
                }
                else{
                    echo "<img src='".wp_get_attachment_url($manual_fotos[0])."' style='max-width:150px;border-radius:5px;' />";
                }
                
            }else{
                echo "<img src='".$carsync_fotos[0]."' style='max-width:150px;border-radius:5px;' />";
            }
            
            break;
        case 'wagenstatus' :
            $value_wagen_status = get_post_meta( $post_id, '_car_post_status_key', true );
            echo $value_wagen_status;
            break;
        case 'fotosgedownload' :
            $value_wagen_fotos_gedownload = get_post_meta( $post_id, '_car_api_images_downloaded', true );
            echo $value_wagen_fotos_gedownload;
            break;

    }
}

add_action('admin_head', 'admin_width');

function admin_width() {
    ?>
    
    <style type="text/css">
    
    th#uitgelichtefoto {width:17%;}
    @media only screen and (max-width: 1050px) {
        .row-actions .edit a{    border: 1Px solid #c5c5d6;
    text-align: center;
    height: 29px;    min-width: 159px;

    width:50%;
    margin-right: 26px;
    border-radius: 8px;
    padding: 0px !important;
    display: flex;
    justify-content: center;
    align-items: center;}
        .post-type-autos .posts tr{
        display: flex;
    flex-direction: column;
    width: 100%;
    }
    .post-type-autos .posts  th{display:none;}
    .post-type-autos .posts  td {
        width: 100%;
}
        th#uitgelichtefoto {
    width: 30%;
}.wp-list-table tr:not(.inline-edit-row):not(.no-items) td:not(.column-primary)::before {
    display: none;
}
    }
    
    </style>
    <script>
        jQuery(document).ready(function(){
        
            jQuery(".wagenstatus").each(function(){

            if(jQuery(this).text() == "archief"){
                jQuery(this).closest("tr").css("opacity",'0.9');
                jQuery(this).closest("tr").css("background",'#ffebd0');
            }
            if(jQuery(this).text() == "trash"){
                jQuery(this).closest("tr").css("opacity",'0.9');
                jQuery(this).closest("tr").css("background",'#ffe4db');
            }

            });

        });
    </script>
    <?php
   
}
?>