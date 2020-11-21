<?php


    //add metabox

    add_action( 'add_meta_boxes', 'metaboxes_list' );
    function metaboxes_list()
    {
        //informatie over de post
        add_meta_box( 'car_meta_data', 'Car meta data', 'car_meta_cb', 'autos' );
        //informatie over de wagen
        add_meta_box( 'car_gegevens', 'Wagen gegevens', 'car_gegevens_cb', 'autos' );
    }
    
    
    
    //render the data
    
    
    function car_meta_cb($post)
    {
        //data ophalen en in klaarmaken voor parsing

        $value_sync = get_post_meta( $post->ID, '_car_sync_key', true );
        $value_uniq = get_post_meta( $post->ID, '_car_uniq_key', true );
        $value_status = get_post_meta( $post->ID, '_car_status_key', true );
        $value_badge = get_post_meta( $post->ID, '_car_badge_key', true );
        $value_wagentitel = get_post_meta( $post->ID, '_car_wagentitel_key', true );
        $value_modifieddate = get_post_meta( $post->ID, '_car_modifieddate_key', true );
?>          
            <style>.inside label {padding: 18px 0 5px;font-weight: 600;}</style>

            <div style="display:flex;flex-direction:column;">

            <label for="caruniq-input">Car unique id</label>
            <input type="text" name="caruniq-input" id="caruniq-input" value="<?php echo $value_uniq ?>" />
            
            <label for="carsync-input">Car sync</label>
            <input type="text" name="carsync-input" id="carsync-input" value="<?php echo $value_sync ?>" />

            <label for="carmodifieddate-input">Car modified date</label>
            <input type="text" name="carmodifieddate-input" id="carmodifieddate-input" value="<?php echo $value_modifieddate ?>" />
            
            <label for="carstatus-input">Car status</label>
            <input type="text" name="carstatus-input" id="carstatus-input" value="<?php echo $value_status ?>" />
            
            <label for="carwagentitel-input">Car wagentitel</label>
            <input type="text" name="carwagentitel-input" id="carwagentitel-input" value="<?php echo $value_wagentitel ?>" />
            
            <label for="carbadge-input">Badge</label>
            <input type="text" name="carbadge-input" id="carbadge-input" value="<?php echo $value_badge ?>" />

            </div>
<?php    
    }

    function car_gegevens_cb($post)
    {
        //data ophalen en in klaarmaken voor parsing
        
        $value_eersteinschrijving = get_post_meta( $post->ID, '_car_eersteinschrijving_key', true );
        $value_carrosserievorm = get_post_meta( $post->ID, '_car_carrosserievorm_key', true );
        $value_zitplaatsen = get_post_meta( $post->ID, '_car_zitplaatsen_key', true );
        $value_brandstof = get_post_meta( $post->ID, '_car_brandstof_key', true );
        $value_aantaldeuren = get_post_meta( $post->ID, '_car_aantaldeuren_key', true );
        $value_staat = get_post_meta( $post->ID, '_car_staat_key', true );
        $value_kilometerstand = get_post_meta( $post->ID, '_car_kilometerstand_key', true );
        $value_transmissie = get_post_meta( $post->ID, '_car_transmissie_key', true );
        $value_bouwjaar = get_post_meta( $post->ID, '_car_bouwjaar_key', true );
        $value_kw = get_post_meta( $post->ID, '_car_kw_key', true );
        $value_pk = get_post_meta( $post->ID, '_car_pk_key', true );
        $value_cilinderinhoud = get_post_meta( $post->ID, '_car_cilinderinhoud_key', true );
        $value_kleurinterieur = get_post_meta( $post->ID, '_car_kleurinterieur_key', true );
        $value_kleurexterieur = get_post_meta( $post->ID, '_car_kleurexterieur_key', true );
        $value_prijs = get_post_meta( $post->ID, '_car_prijs_key', true );
        $value_oudeprijs = get_post_meta( $post->ID, '_car_oudeprijs_key', true );
        $value_btwaftrekbaar = get_post_meta( $post->ID, '_car_btwaftrekbaar_key', true );
        $value_emissieklasse = get_post_meta( $post->ID, '_car_emissieklasse_key', true );
        $value_co = get_post_meta( $post->ID, '_car_co_key', true );

?>          
            <style>.inside label {padding: 18px 0 5px;font-weight: 600;}</style>

            <div style="display:flex;flex-direction:column;">
            


            <label for="careersteinschrijving-input">Eersteinschrijving</label>
            <input type="text" name="careersteinschrijving-input" id="careersteinschrijving-input" value="<?php echo $value_eersteinschrijving ?>" />
            
            <label for="carcarrosserievorm-input">Carrosserievorm</label>
            <input type="text" name="carcarrosserievorm-input" id="carcarrosserievorm-input" value="<?php echo $value_carrosserievorm ?>" />
            
            <label for="carzitplaatsen-input">Zitplaatsen</label>
            <input type="text" name="carzitplaatsen-input" id="carzitplaatsen-input" value="<?php echo $value_zitplaatsen ?>" />
            
            <label for="carbrandstof-input">Brandstof</label>
            <input type="text" name="carbrandstof-input" id="carbrandstof-input" value="<?php echo $value_brandstof ?>" />
            
            <label for="caraantaldeuren-input">Aantaldeuren</label>
            <input type="text" name="caraantaldeuren-input" id="caraantaldeuren-input" value="<?php echo $value_aantaldeuren ?>" />
            
            <label for="carstaat-input">staat</label>
            <input type="text" name="carstaat-input" id="carstaat-input" value="<?php echo $value_staat ?>" />
            
            <label for="carkilometerstand-input">Kilometerstand</label>
            <input type="text" name="carkilometerstand-input" id="carkilometerstand-input" value="<?php echo $value_kilometerstand ?>" />
            
            <label for="cartransmissie-input">Transmissie</label>
            <input type="text" name="cartransmissie-input" id="cartransmissie-input" value="<?php echo $value_transmissie ?>" />

            <label for="carbouwjaar-input">Bouwjaar</label>
            <input type="text" name="carbouwjaar-input" id="carbouwjaar-input" value="<?php echo $value_bouwjaar ?>" />
           
            <label for="carkw-input">Kw</label>
            <input type="text" name="carkw-input" id="carkw-input" value="<?php echo $value_kw ?>" />

            <label for="carpk-input">Pk</label>
            <input type="text" name="carpk-input" id="carpk-input" value="<?php echo $value_pk ?>" />

            <label for="carcilinderinhoud-input">Cilinderinhoud</label>
            <input type="text" name="carcilinderinhoud-input" id="carcilinderinhoud-input" value="<?php echo $value_cilinderinhoud ?>" />
            
            <label for="carkleurinterieur-input">Kleur interieur</label>
            <input type="text" name="carkleurinterieur-input" id="carkleurinterieur-input" value="<?php echo $value_kleurinterieur ?>" />
            
            <label for="carkleurexterieur-input">Kleur exterieur</label>
            <input type="text" name="carkleurexterieur-input" id="carkleurexterieur-input" value="<?php echo $value_kleurexterieur ?>" />

            <label for="caremissieklasse-input">Emissieklasse</label>
            <input type="text" name="caremissieklasse-input" id="caremissieklasse-input" value="<?php echo $value_emissieklasse ?>" />

            <label for="carco-input">Co</label>
            <input type="text" name="carco-input" id="carco-input" value="<?php echo $value_co ?>" />

            <label for="carprijs-input">Prijs</label>
            <input type="text" name="carprijs-input" id="carprijs-input" value="<?php echo $value_prijs ?>" />

            <label for="caroudeprijs-input">Oudeprijs</label>
            <input type="text" name="caroudeprijs-input" id="caroudeprijs-input" value="<?php echo $value_oudeprijs ?>" />

            <label for="carbtwaftrekbaar-input">BTW aftrekbaar</label>
            <input type="text" name="carbtwaftrekbaar-input" id="carbtwaftrekbaar-input" value="<?php echo $value_btwaftrekbaar ?>" />

            </div>
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
        if(isset($_POST["carwagentitel-input"]))
            update_post_meta($post->ID, '_car_wagentitel_key', $_POST["carwagentitel-input"]);        
        if(isset($_POST["carmodifieddate-input"]))
            update_post_meta($post->ID, '_car_modifieddate_key', $_POST["carmodifieddate-input"]);
        if(isset($_POST["careersteinschrijving-input"]))
            update_post_meta($post->ID, '_car_eersteinschrijving_key', $_POST["careersteinschrijving-input"]);
        if(isset($_POST["carcarrosserievorm-input"]))
            update_post_meta($post->ID, '_car_carrosserievorm_key', $_POST["carcarrosserievorm-input"]);
        if(isset($_POST["carzitplaatsen-input"]))
            update_post_meta($post->ID, '_car_zitplaatsen_key', $_POST["carzitplaatsen-input"]);
        if(isset($_POST["carbrandstof-input"]))
            update_post_meta($post->ID, '_car_brandstof_key', $_POST["carbrandstof-input"]);
        if(isset($_POST["caraantaldeuren-input"]))
            update_post_meta($post->ID, '_car_aantaldeuren_key', $_POST["caraantaldeuren-input"]);
        if(isset($_POST["carstaat-input"]))
            update_post_meta($post->ID, '_car_staat_key', $_POST["carstaat-input"]);
        if(isset($_POST["carkilometerstand-input"]))
            update_post_meta($post->ID, '_car_kilometerstand_key', $_POST["carkilometerstand-input"]);
        if(isset($_POST["cartransmissie-input"]))
            update_post_meta($post->ID, '_car_transmissie_key', $_POST["cartransmissie-input"]);
        if(isset($_POST["carbouwjaar-input"]))
            update_post_meta($post->ID, '_car_bouwjaar_key', $_POST["carbouwjaar-input"]);
        if(isset($_POST["carkw-input"]))
            update_post_meta($post->ID, '_car_kw_key', $_POST["carkw-input"]);
        if(isset($_POST["carpk-input"]))
            update_post_meta($post->ID, '_car_pk_key', $_POST["carpk-input"]);     
        if(isset($_POST["carcilinderinhoud-input"]))
            update_post_meta($post->ID, '_car_cilinderinhoud_key', $_POST["carcilinderinhoud-input"]); 
        if(isset($_POST["carkleurinterieur-input"]))
            update_post_meta($post->ID, '_car_kleurinterieur_key', $_POST["carkleurinterieur-input"]);  
        if(isset($_POST["carkleurexterieur-input"]))
            update_post_meta($post->ID, '_car_kleurexterieur_key', $_POST["carkleurexterieur-input"]); 
        if(isset($_POST["carprijs-input"]))
            update_post_meta($post->ID, '_car_prijs_key', $_POST["carprijs-input"]);     
        if(isset($_POST["caroudeprijs-input"]))
            update_post_meta($post->ID, '_car_oudeprijs_key', $_POST["caroudeprijs-input"]); 
        if(isset($_POST["carbtwaftrekbaar-input"]))
            update_post_meta($post->ID, '_car_btwaftrekbaar_key', $_POST["carbtwaftrekbaar-input"]); 
        if(isset($_POST["caremissieklasse-input"]))
            update_post_meta($post->ID, '_car_emissieklasse_key', $_POST["caremissieklasse-input"]);        
        if(isset($_POST["carco-input"]))
            update_post_meta($post->ID, '_car_co_key', $_POST["carco-input"]);               
    }
     
    add_action('save_post', 'metadata_save');

   



?>