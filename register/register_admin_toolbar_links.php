<?php

add_action('admin_bar_menu', 'wagens_ophalen_toolbar', 100);
function wagens_ophalen_toolbar($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'toolbar_wagens_ophalen',
        'title' => 'Wagens ophalen +',
        'href'  => '#',
        'meta'  => array(
            'title' => __('Wagens ophalen +'),            
        ),
    ));
}

add_action( 'admin_footer', 'wagens_ophalen_toolbar_js' ); // Write our JS below here

function wagens_ophalen_toolbar_js() { ?>
	<script type="text/javascript" >
    
	jQuery(document).ready(function($) {
        
        var reqtime = 0;
        jQuery("#wp-admin-bar-toolbar_wagens_ophalen").on("click",function(){
        if(reqtime < 1){
            
        var data = {
			'action': 'ajax_wagens_fetch',
			'wagensladen': true
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
            console.log('Got this from the server: ' + response);
            alert("Finished");
		});
            }
            else{
                alert("Wagens zijn al opgehaald...");
            }
            reqtime++;
        
        });
		
	});
	</script> <?php
}
add_action('wp_ajax_ajax_wagens_fetch', 'ajax_wagens_fetch_callback');

function ajax_wagens_fetch_callback() {
    
    if(isset($_POST["wagensladen"])){
        carsync_data_ophalen();
    }

    die(); 
}
?>