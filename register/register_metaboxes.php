<?php



    //add metabox

    add_action( 'add_meta_boxes', 'metaboxes_list' );
    function metaboxes_list()
    {
        //informatie over de post
        add_meta_box( 'car_meta_data', 'Car meta data', 'car_meta_cb', 'autos' );
        //informatie over de wagen
        add_meta_box( 'car_gegevens', 'Wagen gegevens', 'car_gegevens_cb', 'autos' );
        //wagen opties
        add_meta_box( 'car_options', 'Wagen opties', 'car_options_cb', 'autos' );
    }
    
    
    
    //render the data
    
           
    function car_options_cb($post)
    {
        $opt_comfort = array("Achterbank 1/3 - 2/3", "Airconditioning", "Armsteun", "Automatische klimaatregeling", "Cruise Control", "Electrische ruiten", "Electrische zetelverstelling", "Elektrisch verstelbare buitenspiegels", "Elektrische achterklep", "Getinte ramen", "Hill-Hold Control", "Lederen stuurwiel", "Lendensteun", "Lichtsensor", "Massagestoelen", "Multifunctioneel stuur", "Navigatiesysteem", "Open dak", "Parkeerhulp", "Parkeerhulp achter", "Parkeerhulp voor", "Regensensor", "Start/Stop systeem", "Zetelverwarming");
        $opt_enter_media = array("Bluetooth", "Boordcomputer", "CD", "Digitale radio-ontvangst", "Handsfree", "MP3", "Radio", "Sound system", "USB");
        $opt_extra = array("Aanraakscherm", "Bagagerek", "Lichtmetalen velgen", "Schakelpaddles", "Schuifdeur", "Skiluik", "Sneeuwbanden", "Sportzetels", "Spraakbediening", "Trekhaak");
        $opt_veiligheid = array("ABS", "Achter airbag", "Airbag bestuurder", "Airbag passagier", "Alarm", "Automatische Tractie Controle", "Bandenspanningscontrolesysteem", "Centrale deurvergrendeling met afstandsbediening", "Centrale vergrendeling", "Dagrijlichten", "Dodehoekdetectie", "Electronic Stability Program", "Hoofd airbag", "Isofix", "LED verlichting", "Mistlampen", "Startonderbreker", "Stuurbekrachtiging", "Xenon Lichten", "Zij-airbags");

        $value_enter_media = get_post_meta( $post->ID, '_car_enter_media_key', true );
        if(empty($value_enter_media)){
            $value_enter_media = array();
        }
        $value_comfort = get_post_meta( $post->ID, '_car_comfort_key', true );
        if(empty($value_comfort)){
            $value_comfort = array();
        }
        $value_extra = get_post_meta( $post->ID, '_car_extra_key', true );
        if(empty($value_extra)){
            $value_extra = array();
        }
        $value_veiligheid = get_post_meta( $post->ID, '_car_veiligheid_key', true );
        if(empty($value_veiligheid)){
            $value_veiligheid = array();
        }
    ?>          
            <style>.select2{    width: 100% !important;}#car_gegevens label{padding:18px 0 5px;font-weight:600}.checkwrap,.fields{display:flex;flex-direction:column}.checkboxtitle{font-size:15px;font-weight:600;margin-top:10px;margin-bottom:10px}.fields label{margin-bottom:5px}.select2-selection__rendered{line-height:39px!important}.select2-container .select2-selection--single{height:42px!important}.select2-selection__arrow{height:42px!important}</style>
            
            <div class="checkwrap">

            <div class="label checkboxtitle">Comfort en gemak</div>
            
            <div class="fields">
            
            <?php foreach ($opt_comfort as $opt) {
               ?>
               <label><input type="checkbox" name="carcomfort[]" value="<?php echo $opt; ?>"
               <?php foreach($value_comfort as $value){
                   if($value == $opt){
                       echo("checked");
                   }
               } ?>
               /> <?php echo $opt; ?></label>
               
               <?php
             } 
             ?>
                
             </div>
             </div> 
             <div class="checkwrap">

            <div class="label checkboxtitle">Entertainment en media</div>
            
            <div class="fields">
            
            <?php foreach ($opt_enter_media as $opt) {
               ?>
               <label><input type="checkbox" name="carenter_media[]" value="<?php echo $opt; ?>"
               <?php foreach($value_enter_media as $value){
                   if($value == $opt){
                       echo("checked");
                   }
               } ?>
               /> <?php echo $opt; ?></label>
              
               <?php
             } 
             ?>
                
             </div>           

            </div>
             
            <div class="checkwrap">

            <div class="label checkboxtitle">Veiligheid</div>
            
            <div class="fields">
            
            <?php foreach ($opt_veiligheid as $opt) {
               ?>
               <label><input type="checkbox" name="carveiligheid[]" value="<?php echo $opt; ?>"
               <?php foreach($value_veiligheid as $value){
                   if($value == $opt){
                       echo("checked");
                   }
               } ?>
               /> <?php echo $opt; ?></label>
             
               <?php
             } 
             ?>
                
             </div>           

            </div>


            <div class="checkwrap">

            <div class="label checkboxtitle">Extra</div>
            
            <div class="fields">
            
            <?php foreach ($opt_extra as $opt) {
               ?>
               <label style="font-weight:400;"><input type="checkbox" name="carextra[]" value="<?php echo $opt; ?>"
               <?php foreach($value_extra as $value){
                   if($value == $opt){
                       echo("checked");
                   }
               } ?>
               /> <?php echo $opt; ?></label>
             
               <?php
             } 
             ?>
                
                       

            </div>
    <?php    
    }


    
    function car_meta_cb($post)
    {
        //data ophalen en in klaarmaken voor parsing

        $value_sync = get_post_meta( $post->ID, '_car_sync_key', true );
        $value_uniq = get_post_meta( $post->ID, '_car_uniq_key', true );
        $value_status = get_post_meta( $post->ID, '_car_status_key', true );
        $value_modifieddate = get_post_meta( $post->ID, '_car_modifieddate_key', true );
?>          
            <style>.car_gegevens label {padding: 18px 0 5px;font-weight: 600;}</style>

            <div style="display:flex;flex-direction:column;">

            <label for="caruniq-input">Car unique id</label>
            <input type="text" name="caruniq-input" id="caruniq-input" value="<?php echo $value_uniq ?>" />
            
            <label for="carsync-input">Car sync</label>
            <input type="text" name="carsync-input" id="carsync-input" value="<?php echo $value_sync ?>" />

            <label for="carmodifieddate-input">Car modified date</label>
            <input type="text" name="carmodifieddate-input" id="carmodifieddate-input" value="<?php echo $value_modifieddate ?>" />
            
            <label for="carstatus-input">Car status</label>
            <input type="text" name="carstatus-input" id="carstatus-input" value="<?php echo $value_status ?>" />

            </div>
<?php    
    }



    function car_gegevens_cb($post)
    {
       
        //data ophalen en in klaarmaken voor parsing
        $allemerken = get_terms( array(
            'taxonomy' => 'merkenmodel',
            'hide_empty' => false,
            'parent' => 0
        ) );
        
        
        $term_list_merk = wp_get_post_terms( $post->ID, 'merkenmodel', array( 'fields' => 'names','parent' => 0 ));
        $term_list_merk_ids = wp_get_post_terms( $post->ID, 'merkenmodel', array( 'fields' => 'ids','parent' => 0 ));	
        $merkophalen;
        $modelophalen;
        foreach($term_list_merk_ids as $term_id){
            $termid=$term_id;
        }	
        $term_list_model = wp_get_post_terms( $post->ID, 'merkenmodel', array( 'fields' => 'names','parent' => $termid ));
        
        foreach($term_list_merk as $term){
            $merkophalen = $term;
            
        }
        
        foreach($term_list_model as $term){
            $modelophalen = $term;
            
        }
        
        $value_merk = $merkophalen ;
        $value_model = $modelophalen;
        $value_badge = get_post_meta( $post->ID, '_car_badge_key', true );
        $value_wagentitel = get_post_meta( $post->ID, '_car_wagentitel_key', true );
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
        $gallery_data = get_post_meta( $post->ID, 'mgop_media_value', true );
?>          
            

            <div style="display:flex;flex-direction:column;">
            <div><?php print_r($gallery_data);?></div>
            <label for="carmerk-input">Merk</label> 
            <select name="carmerk-input" id="carmerk-input">
            <option selected><?php echo($value_merk); ?></option>
            </select>
            <label for="carmodel-input">Model</label> 
            <select name="carmodel-input" id="carmodel-input" >
            <option selected><?php echo($value_model); ?></option> 
            </select>
            
            <label for="carwagentitel-input">Car wagentitel</label>
            <input type="text" name="carwagentitel-input" id="carwagentitel-input" value="<?php echo $value_wagentitel ?>" />
            
            <label for="carbadge-input">Badge</label>
            <input type="text" name="carbadge-input" id="carbadge-input" value="<?php echo $value_badge ?>" />

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
        if(isset($_POST["carenter_media"])){
            update_post_meta($post->ID, '_car_enter_media_key', $_POST["carenter_media"]); 
        }
        else{
            $_POST["carenter_media"] = array();
            update_post_meta($post->ID, '_car_enter_media_key', $_POST["carenter_media"]); 
        }
        if(isset($_POST["carcomfort"])){
            update_post_meta($post->ID, '_car_comfort_key', $_POST["carcomfort"]); 
        }
        else{
            $_POST["carcomfort"] = array();
            update_post_meta($post->ID, '_car_comfort_key', $_POST["carcomfort"]); 
        }
        if(isset($_POST["carveiligheid"])){
            update_post_meta($post->ID, '_car_veiligheid_key', $_POST["carveiligheid"]); 
        }
        else{
            $_POST["carveiligheid"] = array();
            update_post_meta($post->ID, '_car_veiligheid_key', $_POST["carveiligheid"]); 
        }
        if(isset($_POST["carextra"])){
            update_post_meta($post->ID, '_car_extra_key', $_POST["carextra"]); 
        }
        else{
            $_POST["carextra"] = array();
            update_post_meta($post->ID, '_car_extra_key', $_POST["carextra"]); 
        }
        if(isset($_POST["carmerk-input"])){
            $merkwaarde = $_POST["carmerk-input"];
            $modelwaarde = $_POST["carmodel-input"];
            wp_insert_term($merkwaarde,  'merkenmodel' );
            $merkpush = get_term_by('name', $merkwaarde, 'merkenmodel');
            wp_insert_term($modelwaarde,  'merkenmodel',array('parent' => $merkpush->term_id) );
            wp_set_object_terms( $post->ID, array($merkwaarde,$modelwaarde), 'merkenmodel' );

        }
        
        
    }
     
    add_action('save_post', 'metadata_save');

   



?>