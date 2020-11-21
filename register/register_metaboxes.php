<?php


    //add metabox

    add_action( 'add_meta_boxes', 'metaboxes_list' );
    function metaboxes_list()
    {
        add_meta_box( 'car_meta_data', 'Car meta data', 'car_meta_cb', 'autos' );
    }
    
    
    
    //render the data
    
    
    function car_meta_cb($post)
    {
        $value_sync = get_post_meta( $post->ID, '_car_sync_key', true );
        $value_uniq = get_post_meta( $post->ID, '_car_uniq_key', true );
        $value_status = get_post_meta( $post->ID, '_car_status_key', true );
        $value_badge = get_post_meta( $post->ID, '_car_badge_key', true );
?>          
            <label for="carsync-input">Car sync</label>
            <input type="text" name="carsync-input" id="carsync-input" value="<?php echo $value_sync ?>" />
            <br>
            <label for="caruniq-input">Car unique id</label>
            <input type="text" name="caruniq-input" id="caruniq-input" value="<?php echo $value_uniq ?>" />
            <br>
            <label for="carstatus-input">Car status</label>
            <input type="text" name="carstatus-input" id="carstatus-input" value="<?php echo $value_status ?>" />
            <br>
            <label for="carbadge-input">Badge</label>
            <input type="text" name="carbadge-input" id="carbadge-input" value="<?php echo $value_badge ?>" />
<?php    
    }


    //saving the data

    function metadata_save(){
 
        global $post;
        if(isset($_POST["carsync-input"]))
        update_post_meta($post->ID, '_car_sync_key', $_POST["carsync-input"]);
        if(isset($_POST["caruniq-input"]))
            update_post_meta($post->ID, '_car_uniq_key', $_POST["caruniq-input"]);
        if(isset($_POST["carstatus-input"]))
            update_post_meta($post->ID, '_car_status_key', $_POST["carstatus-input"]);
        if(isset($_POST["carbadge-input"]))
            update_post_meta($post->ID, '_car_badge_key', $_POST["carbadge-input"]);        
    }
     
    add_action('save_post', 'metadata_save');

   



?>