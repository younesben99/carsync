<?php

    
    
    //add metabox

    add_action( 'add_meta_boxes', 'metaboxes_list' );
    function metaboxes_list()
    {
        //informatie over de post hiddens
       // add_meta_box( 'car_meta_data_ophalen', 'Wagen identificatie', 'car_meta_ophalen_cb', 'autos' );
        //informatie over de post hiddens
        add_meta_box( 'car_meta_data', 'Car meta data', 'car_meta_cb', 'autos' );
        //instellingen van de post
        add_meta_box( 'car_settings', 'Instellingen', 'car_settings_cb', 'autos' );
        //informatie over de wagen
        add_meta_box( 'car_gegevens', 'Wagen gegevens', 'car_gegevens_cb', 'autos' );
        //wagen opties
        add_meta_box( 'car_options', 'Wagen opties', 'car_options_cb', 'autos' );
        
    }
    
    
    
    //render the data
    

    function car_meta_ophalen_cb($post){

        $value_vin = get_post_meta( $post->ID, '_car_vin_key', true );
        $foldericonpath = get_site_url().'/wp-content/plugins/carsync/assets/img/document.svg';
        $checkiconpath = get_site_url().'/wp-content/plugins/carsync/assets/img/check.svg';
        ?>
       
        <div style="display:flex;flex-direction:column;" class="labeldiv">
            <label for="carvin-input">Chassisnummer</label>
            <div style="display: flex;justify-content: space-between;align-items: flex-start;flex-direction: column;">
            <div class="checkvinwrap"><img style="" width="20" src="<?php echo $checkiconpath; ?>" alt="VIN is correct" /></div>
            <input style="width: 60%;margin-bottom: 20px;" type="text" name="carvin-input" id="carvin-input" maxlength="17" value="<?php echo $value_vin ?>" />
            <div class="autodataophalen" id="cardatacall"><img src="<?php echo $foldericonpath; ?>" width="30" style="margin-right:10px;" /> Auto gegevens ophalen</div>
            
            <div class="showmoreselectief"><span class="dashicons dashicons-arrow-down-alt2 dashchev"></span> Selectief gegevens ophalen</div>
            <div class="secondary_ophaal_options">
            <button class="autodataophalen_sec" id="cardatacallB" data-codes="B">Basis gegevens</button>
            <button class="autodataophalen_sec" id="cardatacallX" data-codes="X">Technische gegevens</button>
            <hr>
            <button class="autodataophalen_sec" id="cardatacallE" data-codes="E">Emissie gegevens</button>
            <button class="autodataophalen_sec" id="cardatacallR" data-codes="R">Registratie gegevens</button>
            <button class="autodataophalen_sec" id="cardatacallA" data-codes="BXERA">Fiscale gegevens</button>
            <button class="autodataophalen_sec" id="cardatacallT" data-codes="T">Keuring gegevens</button>
            <button class="autodataophalen_sec" id="cardatacallC" data-codes="C">Commerciële gegevens</button>
            <hr>
            <button class="autodataophalen_sec" id="cardatacallV" data-codes="CV">Restwaarde berekenen</button>
            <button class="autodataophalen_sec" id="cardatacallF" data-codes="CF">Toekomstige restwaarde</button>
            </div>
            </div>
        </div>

        <?php
    }
           
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

<div class="checkwrap">

    <div class="label checkboxtitle">Comfort en gemak</div>

    <div class="fields">

        <?php foreach ($opt_comfort as $opt) {
               ?>
        <label><input type="checkbox" name="carcomfort[]" value="<?php echo $opt; ?>" <?php foreach($value_comfort as $value){
                   if($value == $opt){
                       echo("checked");
                   }
               } ?> /> <?php echo $opt; ?></label>

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
        <label><input type="checkbox" name="carenter_media[]" value="<?php echo $opt; ?>" <?php foreach($value_enter_media as $value){
                   if($value == $opt){
                       echo("checked");
                   }
               } ?> /> <?php echo $opt; ?></label>

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
        <label><input type="checkbox" name="carveiligheid[]" value="<?php echo $opt; ?>" <?php foreach($value_veiligheid as $value){
                   if($value == $opt){
                       echo("checked");
                   }
               } ?> /> <?php echo $opt; ?></label>

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
        <label style="font-weight:400;"><input type="checkbox" name="carextra[]" value="<?php echo $opt; ?>" <?php foreach($value_extra as $value){
                   if($value == $opt){
                       echo("checked");
                   }
               } ?> /> <?php echo $opt; ?></label>

        <?php
             } 
             ?>



    </div>
</div>
<?php    
    }


    function car_settings_cb($post)
    {
        //data ophalen en in klaarmaken voor parsing

        $value_sync = get_post_meta( $post->ID, '_car_sync_key', true );
        if(empty($value_sync)){
            $value_sync = "NO";
        }
        $value_status = get_post_meta( $post->ID, '_car_status_key', true );
        if(empty($value_status)){
            $value_status = "tekoop";
        }
        $value_post_status = get_post_meta( $post->ID, '_car_post_status_key', true );
        if(empty($value_post_status)){
            $value_post_status = "actief";
        }
       
        
?>

<div class="statusflex">
    

<div class="selectwrapper">
        <div class="dash-status-dot"><span class="<?php 
        if(get_post_meta($post->ID, '_car_sync_key', true) == 'YES' && get_post_meta($post->ID, '_car_post_status_key', true) == 'actief'){
          echo "live";
        }
        if(get_post_meta($post->ID, '_car_sync_key', true) == 'NO' && get_post_meta($post->ID, '_car_post_status_key', true) == 'actief'){
          echo "nglive";
        }
        if(get_post_meta($post->ID, '_car_post_status_key', true) == 'archief'){
          echo "archief";
        }
        if (get_post_meta($post->ID, '_car_post_status_key', true) == ''){
            echo "nglive";
        }  
        ?>"></span></div>
        <select id="dash-status">
          <option class="dot live" data-post-id="<?php echo $post->ID; ?>" value="live" <?php
        if(get_post_meta($post->ID, '_car_sync_key', true) == 'YES' && get_post_meta($post->ID, '_car_post_status_key', true) == 'actief'){
          echo "selected";
        } ?>>Live</option>
          <option class="dot nglive" data-post-id="<?php echo $post->ID; ?>" value="nglive" <?php
        if(get_post_meta($post->ID, '_car_sync_key', true) == 'NO' && get_post_meta($post->ID, '_car_post_status_key', true) == 'actief'){
          echo "selected";
        }
        if(get_post_meta($post->ID, '_car_sync_key', true) == ''){
            echo "selected";
        }
        ?>>Geen sync & live</option>
          <optgroup label="--------------"></optgroup>
          <option class="dot archief" data-post-id="<?php echo $post->ID; ?>" value="archief" <?php
        if(get_post_meta($post->ID, '_car_post_status_key', true) == 'archief'){
          echo "selected";
        } ?>>Archief</option>
        </select>
      </div>
      <div class="selectwrapper-post-status">
        <div class="dash-post-status-dot"><span class="<?php 
        if(get_post_meta($post->ID, '_car_status_key', true) == 'tekoop'){
          echo "tekoop";
        }
        if(get_post_meta($post->ID, '_car_status_key', true) == 'gereserveerd'){
          echo "gereserveerd";
        }
        if(get_post_meta($post->ID, '_car_status_key', true) == 'verkocht'){
          echo "verkocht";
        }
        if (get_post_meta($post->ID, '_car_status_key', true) == ''){
            echo "tekoop";
        }     
        ?>"></span></div>
        <select id="dash-post-status">
          <option class="dot tekoop" data-post-id="<?php echo $post->ID; ?>" value="tekoop" <?php
        if(get_post_meta($post->ID, '_car_status_key', true) == 'tekoop'){
          echo "selected";
        } ?>>Te Koop</option>
          <option class="dot gereserveerd" data-post-id="<?php echo $post->ID; ?>" value="gereserveerd" <?php
        if(get_post_meta($post->ID, '_car_status_key', true) == 'gereserveerd'){
          echo "selected";
        } ?>>Gereserveerd</option>
          <optgroup label="--------------"></optgroup>
          <option class="dot verkocht" data-post-id="<?php echo $post->ID; ?>" value="verkocht" <?php
        if(get_post_meta($post->ID, '_car_status_key', true) == 'verkocht'){
          echo "selected";
        } ?>>Verkocht</option>
        </select>
      </div>


</div>

<input type="text" name="carsync-input" id="carsync-input" style="display:none;" value="<?php echo $value_sync  ?>" />
<input type="text" name="carstatus-input" id="carstatus-input" style="display:none;" value="<?php echo $value_status ?>" />
<input type="text" name="car_post_status" id="car_post_status_id" style="display:none;" value="<?php echo $value_post_status ?>" />

<?php    
    }
    function car_meta_cb($post)
    {
        //data ophalen en in klaarmaken voor parsing

        $value_uniq = get_post_meta( $post->ID, '_car_uniq_key', true );
        $value_modifieddate = get_post_meta( $post->ID, '_car_modifieddate_key', true );
        $value_sync_images = get_post_meta( $post->ID, '_car_syncimages_key', true );
        $value_carpass = get_post_meta( $post->ID, '_car_carpass_key', true );
?>


<div style="display:flex;flex-direction:column;">

    <label for="caruniq-input" style="display:none;">Car unique id</label>
    <input type="text" name="caruniq-input" id="caruniq-input" value="<?php echo $value_uniq ?>" />


    <label for="carcarpass-input">Carpass link</label>
    <input type="text" name="carcarpass-input" id="carcarpass-input" value="<?php echo $value_carpass ?>" />

    <label for="carmodifieddate-input" style="display:none;">Car modified date</label>
    <input type="text" name="carmodifieddate-input" id="carmodifieddate-input"
        value="<?php echo $value_modifieddate ?>" />

        <?php
        if(!empty($value_sync_images)){
            ?>
            <label for="carsyncimages-input">Autoscout afbeeldingen</label>
            <?php
        }
        ?>
    
    <div style="display:flex;flex-wrap:wrap;">
        <?php
            if(!empty($value_sync_images)){
                foreach($value_sync_images as $image){
                echo("<img src='". $image."' width='150px' style='margin:5px;' />");
                } }
            ?>
    </div>

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
        $value_merkcf = get_post_meta( $post->ID, '_car_merkcf_key', true );
        $value_modelcf = get_post_meta( $post->ID, '_car_modelcf_key', true );
        $value_badge = get_post_meta( $post->ID, '_car_badge_key', true );
        $value_wagentitel = get_post_meta( $post->ID, '_car_wagentitel_key', true );
        $value_eersteinschrijving = get_post_meta( $post->ID, '_car_eersteinschrijving_key', true );
        $value_carrosserievorm = get_post_meta( $post->ID, '_car_carrosserievorm_key', true );

        $carrosserie_opties = ['Stadswagen',
        'Cabriolet',
        'Coupé',
        'SUV/4x4/Pick-up',
        'Break',
        'Berline',
        'Monovolume',
        'Bestelwagen',
        'Camper',
        'Andere',
        'Supersport',
        'Sport touring',
        'Chopper/Cruiser',
        'Touring',
        'Streetfighter',
        'Enduro',
        'Motocross',
        'Sidecar',
        'Oldtimer',
        'Trike',
        'Scooter',
        'Bromfiets',
        'Super Moto',
        'Minibike',
        'Naked Bike',
        'Quad',
        'Rally',
        'Trials Bike',
        'Racing',
        'Tourer',
        'Alkhoof',
        'Integraal',
        'Gesloten bestelwagen',
        'Cabine',
        'Afzetunits',
        'Caravan overige',
        'Caravans',
        'Roll-off-kiepwagen',
        'Takelwagen',
        'Kiepwagen',
        'Vrachtwagen met kraan',
        'Autotransporter',
        'Driezijdige kiepwagen',
        'Chassis',
        'Verkeerswerkzaamheden',
        'Koel/geisoleerde',
        'Geldtransport',
        'Drankenopbouw',
        'Glastransport',
        'Hydraulisch werkplatform',
        'Verhoogde bestelwagen',
        'Kipper',
        'Gesloten opbouw',
        'Combi/Van',
        'Veetransport',
        'Open Laadbak',
        'Dekzeil',
        'Koeltransport',
        'Aanhangwagen (auto)',
        'Motoraanhanger',
        'Boottrailer',
        'Platform',
        'Laadbak open',
        'Verkoopaanhanger'];

        $value_zitplaatsen = get_post_meta( $post->ID, '_car_zitplaatsen_key', true );
        $value_brandstof = get_post_meta( $post->ID, '_car_brandstof_key', true );

        $opties_brandstof = ['Benzine',
        'Diesel',
        'Ethanol',
        'Elektrisch',
        'Waterstof',
        'LPG',
        'CNG',
        'Elektrisch/Benzine',
        'Andere',
        'Elektrisch/Diesel',
        'Benzine 2 T'];


        $value_aantaldeuren = get_post_meta( $post->ID, '_car_aantaldeuren_key', true );
        $value_staat = get_post_meta( $post->ID, '_car_staat_key', true );

        $opties_staat = ['Tweedehands','Nieuw'];

        $value_kilometerstand = get_post_meta( $post->ID, '_car_kilometerstand_key', true );
        $value_transmissie = get_post_meta( $post->ID, '_car_transmissie_key', true );


        $opties_transmissie = ['Manueel',
        'Automatisch',
        'Halfautomaat'];
        
        $value_bouwjaar = get_post_meta( $post->ID, '_car_bouwjaar_key', true );
        $value_kw = get_post_meta( $post->ID, '_car_kw_key', true );
        $value_pk = get_post_meta( $post->ID, '_car_pk_key', true );
        $value_cilinderinhoud = get_post_meta( $post->ID, '_car_cilinderinhoud_key', true );
        $value_kleurinterieur = get_post_meta( $post->ID, '_car_kleurinterieur_key', true );

        $opties_kleurinterieur = ['Zwart',
        'Wit',
        'Grijs',
        'Zilver',
        'Beige',
        'Bruin',
        'Geel',
        'Groen',
        'Paars',
        'Oranje',
        'Blauw',
        'Brons'];
        
        $value_kleurexterieur = get_post_meta( $post->ID, '_car_kleurexterieur_key', true );
        $opties_kleurexterieur = ['Zwart',
        'Wit',
        'Grijs',
        'Zilver',
        'Beige',
        'Bruin',
        'Geel',
        'Groen',
        'Paars',
        'Oranje',
        'Blauw',
        'Brons'];


        $value_prijs = get_post_meta( $post->ID, '_car_prijs_key', true );
        $value_oudeprijs = get_post_meta( $post->ID, '_car_oudeprijs_key', true );
        $value_btwaftrekbaar = get_post_meta( $post->ID, '_car_btwaftrekbaar_key', true );

        $opties_btw= ['Ja','Nee','NVT'];

        $value_emissieklasse = get_post_meta( $post->ID, '_car_emissieklasse_key', true );

        $opties_emissieklasse = ['Euro 1',
        'Euro 2',
        'Euro 3',
        'Euro 4',
        'Euro 5',
        'Euro 6',
        'Euro 6c',
        'Euro 6d',
        'Euro 6d-TEMP'];

        

        $value_co = get_post_meta( $post->ID, '_car_co_key', true );
        $value_description = get_post_meta( $post->ID, '_car_description_key', true );
        $gallery_data = get_post_meta( $post->ID, 'mgop_mb_galerij', true );
?>

<label for="carwagentitel-input">Wagentitel</label>
<input type="text" name="carwagentitel-input" id="carwagentitel-input" value="<?php echo $value_wagentitel ?>" />

<input type="hidden" name="merkcf-input" id="merkcf-input" value="<?php echo $value_merkcf ?>" />
<input type="hidden" name="modelcf-input" id="modelcf-input" value="<?php echo $value_modelcf ?>" />
<div style="display:flex;flex-direction:column;">
    <div><?php echo($gallery_data);?></div>
    <label for="carmerk-input">Merk</label>
    <select name="carmerk-input" id="carmerk-input">
        <option selected disabled><?php echo($value_merk); ?></option>
    </select>
    <label for="carmodel-input">Model</label>
    <select name="carmodel-input" id="carmodel-input">
        <option selected disabled><?php echo($value_model); ?></option>
    </select>

    <label for="cardescription-input">Beschrijving</label>
    <textarea type="text" name="cardescription-input" rows="4"
        id="cardescription-input"><?php echo $value_description ?></textarea>

    <label for="carbadge-input">Badge</label>
    <input type="text" name="carbadge-input" id="carbadge-input" value="<?php echo $value_badge ?>" />

    <label for="careersteinschrijving-input">Eersteinschrijving</label>
    <input type="date" min="1900-01-01" max="2030-12-31" name="careersteinschrijving-input" id="careersteinschrijving-input"
        value="<?php echo $value_eersteinschrijving ?>" />

    <label for="carcarrosserievorm-input">Carrosserievorm</label>

    <select name="carcarrosserievorm-input" id="carcarrosserievorm-input">
    <?php

    foreach($carrosserie_opties as $optie){
        if($optie == $value_carrosserievorm){
            echo "<option selected>".$optie."</option>";
        }
        else{
            echo "<option>".$optie."</option>";
        }
        
    }
    
    ?>
    </select>

    <label for="carzitplaatsen-input">Zitplaatsen</label>
    <input type="number" name="carzitplaatsen-input" id="carzitplaatsen-input" value="<?php echo $value_zitplaatsen ?>" />

    <label for="carbrandstof-input">Brandstof</label>

    <select name="carbrandstof-input" id="carbrandstof-input">
    <?php

    foreach($opties_brandstof as $optie){
        if($optie == $value_brandstof){
            echo "<option selected>".$optie."</option>";
        }
        else{
            echo "<option>".$optie."</option>";
        }
        
    }
    
    ?>
    </select>

    <label for="caraantaldeuren-input">Aantaldeuren</label>
    <input type="number" name="caraantaldeuren-input" id="caraantaldeuren-input"
        value="<?php echo $value_aantaldeuren ?>" />

    <label for="carstaat-input">Staat</label>
    <select name="carstaat-input" id="carstaat-input">
    <?php

    foreach($opties_staat as $optie){
        if($optie == $value_staat){
            echo "<option selected>".$optie."</option>";
        }
        else{
            echo "<option>".$optie."</option>";
        }
        
    }
    
    ?>
    </select>
    <label for="carkilometerstand-input">Kilometerstand</label>
    <input type="number" name="carkilometerstand-input" id="carkilometerstand-input"
        value="<?php echo $value_kilometerstand ?>" />

    <label for="cartransmissie-input">Transmissie</label>
    
    <select name="cartransmissie-input" id="cartransmissie-input">
    <?php

    foreach($opties_transmissie as $optie){
        if($optie == $value_transmissie){
            echo "<option selected>".$optie."</option>";
        }
        else{
            echo "<option>".$optie."</option>";
        }
        
    }
    
    ?>
    </select>
    <label for="carbouwjaar-input">Bouwjaar</label>
    <input type="number" name="carbouwjaar-input" id="carbouwjaar-input" value="<?php echo $value_bouwjaar ?>" />

    <label for="carkw-input">Kw</label>
    <input type="number" name="carkw-input" id="carkw-input" value="<?php echo $value_kw ?>" />

    <label for="carpk-input">Pk</label>
    <input type="number" name="carpk-input" id="carpk-input" value="<?php echo $value_pk ?>" />

    <label for="carcilinderinhoud-input">Cilinderinhoud</label>
    <input type="number" name="carcilinderinhoud-input" id="carcilinderinhoud-input"
        value="<?php echo $value_cilinderinhoud ?>" />

    <label for="carkleurinterieur-input">Kleur interieur</label>

        <select name="carkleurinterieur-input" id="carkleurinterieur-input">
    <?php

    foreach($opties_kleurinterieur as $optie){
        if($optie == $value_kleurinterieur){
            echo "<option selected>".$optie."</option>";
        }
        else{
            echo "<option>".$optie."</option>";
        }
        
    }
    
    ?>
    </select>


    <label for="carkleurexterieur-input">Kleur exterieur</label>
    <select name="carkleurexterieur-input" id="carkleurexterieur-input">
    <?php

    foreach($opties_kleurexterieur as $optie){
        if($optie == $value_kleurexterieur){
            echo "<option selected>".$optie."</option>";
        }
        else{
            echo "<option>".$optie."</option>";
        }
        
    }
    
    ?>
    </select>

    <label for="caremissieklasse-input">Emissieklasse</label>
  
    <select name="caremissieklasse-input" id="caremissieklasse-input">
    <?php

    foreach($opties_emissieklasse as $optie){
        if($optie == $value_emissieklasse){
            echo "<option selected>".$optie."</option>";
        }
        else{
            echo "<option>".$optie."</option>";
        }
        
    }
    
    ?>
    </select>
    <label for="carco-input">Co</label>
    <input type="number" name="carco-input" id="carco-input" value="<?php echo $value_co ?>" />

    <label for="carprijs-input">Prijs</label>
    <input type="number" name="carprijs-input" id="carprijs-input" value="<?php echo $value_prijs ?>" />

    <label for="caroudeprijs-input">Oudeprijs</label>
    <input type="number" name="caroudeprijs-input" id="caroudeprijs-input" value="<?php echo $value_oudeprijs ?>" />

    <label for="carbtwaftrekbaar-input">BTW aftrekbaar</label>
    

        <select name="carbtwaftrekbaar-input" id="carbtwaftrekbaar-input">
    <?php

    foreach($opties_btw as $optie){
        if($optie == $value_btwaftrekbaar){
            echo "<option selected>".$optie."</option>";
        }
        else{
            echo "<option>".$optie."</option>";
        }
        
    }
    
    ?>
    </select>



</div>
<?php    
    }
    //saving the data

    function metadata_save(){
        
        global $post;
       
        
        if(isset($_POST['vdw_gallery_id'])) {
            update_post_meta($post->ID, 'vdw_gallery_id', $_POST['vdw_gallery_id']);
        }
        else{
            update_post_meta($post->ID, 'vdw_gallery_id', null);
        }
        if(isset($_POST["carsync-input"])){
            update_post_meta($post->ID, '_car_sync_key', $_POST["carsync-input"]);
            
            $vdw_gallery_id = get_post_meta( $post->ID, 'vdw_gallery_id', true );
            $imgtoadd = array();
            if($_POST["carsync-input"] == 'NO' && empty($vdw_gallery_id)){
                
                $syncimagesarray = get_post_meta( $post->ID, '_car_syncimages_key', true );
    
                foreach($syncimagesarray as $img){
                    // include_once( ABSPATH . 'wp-admin/includes/image.php' );
                    // $imageurl = $img;
                    // $postitle = get_string_between($imageurl,"_",".jpg/");
                    
                    

                    // $imagetype = end(explode('/', getimagesize($imageurl)['mime']));
                    // $uniq_name = date('dmY').''.(int) microtime(true); 
                    // $filename = $uniq_name.'.'.$imagetype;
                
                    // $uploaddir = wp_upload_dir();
                    // $uploadfile = $uploaddir['path'] . '/' . $filename;
                    // $contents= file_get_contents($imageurl);
                    // $savefile = fopen($uploadfile, 'w');
                    // fwrite($savefile, $contents);
                    // fclose($savefile);
                
                    // $wp_filetype = wp_check_filetype(basename($filename), null );
                    // $attachment = array(
                    //     'post_mime_type' => $wp_filetype['type'],
                    //     'post_title' => $postitle,
                    //     'post_content' => '',
                    //     'post_status' => 'inherit'
                    // );
                
                    // $attach_id = wp_insert_attachment( $attachment, $uploadfile );
                    // $imagenew = get_post( $attach_id );
                    // $fullsizepath = get_attached_file( $imagenew->ID );
                    // $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
                    // wp_update_attachment_metadata( $attach_id, $attach_data ); 
                    // array_push($imgtoadd,$attach_id);
                    $image = "";
                    if($img != "") {
                    
                        $file = array();
                        $file['name'] = $img;
                        $file['tmp_name'] = download_url($img);
                
                        if (is_wp_error($file['tmp_name'])) {
                            @unlink($file['tmp_name']);
                            var_dump( $file['tmp_name']->get_error_messages( ) );
                        } else {
                            $attachmentId = media_handle_sideload($file, $post_id);
                            
                            if ( is_wp_error($attachmentId) ) {
                                @unlink($file['tmp_name']);
                                var_dump( $attachmentId->get_error_messages( ) );
                            } else {                
                                $image = wp_get_attachment_url( $attachmentId );
                                array_push($imgtoadd,$attachmentId);
                            }
                        }
                    }
                
                }
            }
        }
       
            
       
        if(isset($_POST["carsyncimages-input"])){
            update_post_meta($post->ID, '_car_syncimages_key', $_POST["carsyncimages-input"]);
        }
        
        if(!empty($imgtoadd)){
            update_post_meta($post->ID, 'vdw_gallery_id', $imgtoadd);
        }
       
        if(isset($_POST["caruniq-input"]))
            update_post_meta($post->ID, '_car_uniq_key', $_POST["caruniq-input"]);
        if(isset($_POST["car_post_status"]))
            update_post_meta($post->ID, '_car_post_status_key', $_POST["car_post_status"]);
        if($_POST["car_post_status"] == "archief"){
            update_post_meta($post->ID, '_car_sync_key', 'NO');
        }
        if(isset($_POST["carstatus-input"]))
            update_post_meta($post->ID, '_car_status_key', $_POST["carstatus-input"]);
        if(isset($_POST["carbadge-input"]))
            update_post_meta($post->ID, '_car_badge_key', $_POST["carbadge-input"]);  
        if(isset($_POST["carwagentitel-input"]))
            update_post_meta($post->ID, '_car_wagentitel_key', $_POST["carwagentitel-input"]);        
        if(isset($_POST["carmodifieddate-input"]))
            update_post_meta($post->ID, '_car_modifieddate_key', $_POST["carmodifieddate-input"]);
        if(isset($_POST["carcarpass-input"]))
            update_post_meta($post->ID, '_car_carpass_key', $_POST["carcarpass-input"]);
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
        if(isset($_POST["cardescription-input"]))
            update_post_meta($post->ID, '_car_description_key', $_POST["cardescription-input"]);
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
        if(isset($_POST["carvin-input"]))
            update_post_meta($post->ID, '_car_vin_key', $_POST["carvin-input"]);
        if(isset($_POST["merkcf-input"]))
            update_post_meta($post->ID, '_car_merkcf_key', $_POST["carmerk-input"]);
        if(isset($_POST["modelcf-input"]))
            update_post_meta($post->ID, '_car_modelcf_key', $_POST["carmodel-input"]);
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
            $posttitle= $merkwaarde . " " .  $modelwaarde;
            
            // Set this variable to false initially.
        static $updated = false;

        // If title has already been set once, bail.
            if ( $updated ) {
                return;
             }
    
        // Since we're updating this post's title, set this
        // variable to true to ensure it doesn't happen again.
            $updated = true;
            // Update the post's title.
            wp_update_post( [
            'ID'         => $post->ID,
            'post_title' =>  $posttitle,
            'post_name'  => sanitize_title( $posttitle),
         ] );
            
        }
       


    }
   
    add_action('save_post', 'metadata_save');

   



?>