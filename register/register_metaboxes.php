<?php

    
    
    //add metabox

    add_action( 'add_meta_boxes', 'metaboxes_list' );
    function metaboxes_list()
    {
       
       
        $inmotiv_acties_allow = get_option("dds_settings_option_name");

        $inmotiv_acties_allow = $inmotiv_acties_allow["inmotiv_allow"];

        if (!empty($inmotiv_acties_allow)) {
            add_meta_box( 'car_gegevensx', 'Acties', 'car_meta_ophalen_cb', 'autos' ,'side','high');
        }
        add_meta_box('car_gegevens', 'Wagen gegevens', 'car_gegevens_cb', 'autos');
    }
    
    
    
    //render the data
    

    function car_meta_ophalen_cb($post){
        $fbpushed = get_post_meta($post->ID,"fb_push_key",true);
        $igpushed = get_post_meta($post->ID,"ig_push_key",true);
    
    
        if($fbpushed == "1"){
            $fbpushed = "disabled";
        }
        else{
            $fbpushed = "0";
        }
            
        if($igpushed == "1"){
            $igpushed = " disabled";
        }
        else{
            $igpushed = "0";
        }   
    
        
        $AS_API_OPT = get_option("dds_settings_option_name");
        $fb_key = $AS_API_OPT['zapier_facebook_key_2'];
        $ig_key = $AS_API_OPT['zapier_instagram_key_3'];
    
        if(empty($fb_key)){
            $fb_status = "pushdisable";
        }
        else{
            $fb_status = "fbpush";
        }
        if(empty($ig_key)){
            $ig_status = "pushdisable";
        }
        else{
            $ig_status = "igpush";
        }

        $inmotiv_acties_allow = get_option("dds_settings_option_name");

        $inmotiv_acties_allow = $inmotiv_acties_allow["inmotiv_allow"];

        if(!empty($inmotiv_acties_allow)){

            $value_vin = get_post_meta( $post->ID, '_car_vin_key', true );
            $foldericonpath = get_site_url().'/wp-content/plugins/carsync/assets/img/download.svg';
            $downloaddark = get_site_url().'/wp-content/plugins/carsync/assets/img/files.svg';
            $overeenkomsticon = get_site_url().'/wp-content/plugins/carsync/assets/img/pdf.svg';
            $bestelbonicon = get_site_url().'/wp-content/plugins/carsync/assets/img/pdf.svg';
            $checkiconpath = get_site_url().'/wp-content/plugins/carsync/assets/img/check.svg';
            $carpath = get_site_url().'/wp-content/plugins/carsync/assets/img/car.svg';
            $magpath = get_site_url().'/wp-content/plugins/carsync/assets/img/magnifier-1.svg';
            $pdfpath =get_site_url().'/wp-content/plugins/carsync/assets/img/pdf.svg';
    
            $inmotiv_opgehaald = get_post_meta( $post->ID, 'inmotiv_data_opgehaald', true );
            $disabled_btn = "";
            if($inmotiv_opgehaald == "YES"){
                $inmotiv_ophaal_btn = '<button class="tooninmotivgegevens pop_open" data-popup="auto_gegevens_pop" id="cardatashow"><img src="'.$carpath.'" width="27" style="padding-right:10px;"  /> Auto gegevens</button>';
            }
            else{
                $inmotiv_ophaal_btn = '<button class="autodataophalen" id="cardatacall" data-codes="BXERSTPCAVF"><i class="icon-cloud-download" style="font-size:20px;"></i> Auto gegevens ophalen</button>';
            }
    
            ?>
    
    
            
            <div style="display:flex;flex-direction:column;" class="labeldiv">
                <label for="carvin-input">Chassisnummer</label>
                <div style="display: flex;justify-content: space-between;align-items: flex-start;flex-direction: column;">
                <div class="checkvinwrap"><img style="" width="20" src="<?php echo $checkiconpath; ?>" alt="VIN is correct" /></div>
                <input style="width: 100%;margin-bottom:20px;" type="text" name="carvin-input" id="carvin-input" maxlength="17" value="<?php echo $value_vin ?>" />
                <?php echo $inmotiv_ophaal_btn;?>
                
                <button class="tooninmotivgegevens" id="caraankoopovereenkomst"><img src="<?php echo $overeenkomsticon; ?>" width="27" style="padding-right:20px;"  /> Aankoopborderel</button>
                <button class="tooninmotivgegevens" id="carbestelbon"><img src="<?php echo $bestelbonicon; ?>" width="27" style="padding-right:20px;"  /> Bestelbon</button>
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

    
        $socialecho;
        $socialecho .= "<div class='socialwrap'>";
        $socialecho .= "<div class='pushbutton button ".$fb_status. " " .$fbpushed."' id='".$fb_status."' postid='".$post->ID."' didpush='".$fbpushed."'><span class='dashicons dashicons-facebook'></span> Push naar Facebook</div>";
        $socialecho .= "<div class='pushbutton button ".$ig_status. " " .$igpushed."' id='".$ig_status."' postid='".$post->ID."' didpush='".$igpushed."'><span class='dashicons dashicons-instagram'></span> Push naar Instagram</div>";
        $socialecho .= "</div>";
        echo($socialecho);
        }

  



    }



    function car_gegevens_cb($post)
    {
       
        //data ophalen en in klaarmaken voor parsing
        $allemerken = get_terms( array(
            'taxonomy' => 'merkenmodel',
            'hide_empty' => false,
            'parent' => 0
        ) );
        
        $value_uniq = get_post_meta( $post->ID, '_car_uniq_key', true );
        $value_modifieddate = get_post_meta( $post->ID, '_car_modifieddate_key', true );
        $value_sync_images = get_post_meta( $post->ID, '_car_syncimages_key', true );
        $value_carpass = get_post_meta( $post->ID, '_car_carpass_key', true );

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
        
        $value_merk = $merkophalen;
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
        'Rood',
        'Bruin',
        'Geel',
        'Groen',
        'Paars',
        'Oranje',
        'Blauw',
        'Brons',
    'Andere'];
        
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
        'Rood',
        'Oranje',
        'Blauw',
        'Brons',
    'Andere'];


        $value_prijs = get_post_meta( $post->ID, '_car_prijs_key', true );
        $value_oudeprijs = get_post_meta( $post->ID, '_car_oudeprijs_key', true );
        $value_btwaftrekbaar = get_post_meta( $post->ID, '_car_btwaftrekbaar_key', true );

        $opties_btw = ['Ja','Nee','NVT'];

        $value_emissieklasse = get_post_meta( $post->ID, '_car_emissieklasse_key', true );

        $opties_emissieklasse = ['Euro 1',
        'Euro 2',
        'Euro 3',
        'Euro 4',
        'Euro 5',
        'Euro 6',
        'Euro 6b',
        'Euro 6c',
        'Euro 6d',
        'Euro 6d-TEMP'];

        

        $value_co = get_post_meta( $post->ID, '_car_co_key', true );
        $value_description = get_post_meta( $post->ID, '_car_description_key', true );
        $gallery_data = get_post_meta( $post->ID, 'mgop_mb_galerij', true );

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
        wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
        $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
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
        if (get_post_meta($post->ID, '_car_post_status_key', true) == 'concept'){
            echo "concept";
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
        <optgroup label="--------------"></optgroup>
          <option class="dot concept" data-post-id="<?php echo $post->ID; ?>" value="concept" <?php
        if(get_post_meta($post->ID, '_car_post_status_key', true) == 'concept'){
          echo "selected";
        } ?>>Concept</option>
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

<hr style="margin-bottom:12px;">
<label for="carwagentitel-input">Wagentitel</label>
<input type="text" name="carwagentitel-input" id="carwagentitel-input" value="<?php echo $value_wagentitel ?>" required />

<input type="hidden" name="merkcf-input" id="merkcf-input" value="<?php echo $value_merkcf ?>" />
<input type="hidden" name="modelcf-input" id="modelcf-input" value="<?php echo $value_modelcf ?>" />
<input type="hidden" name="syncimages-input" id="syncimages-input" value="<?php 
if(!empty($value_sync_images)){
    echo("YES");
}
?>" />
<div style="display:flex;flex-direction:column;" class="carinputswrap">
    <div><?php echo($gallery_data);?></div>



    
    <?php
    $merken = merken_ophalen();
    $modellen = modellen_ophalen();
    
    $merken = json_decode($merken,true);
    $modellen = json_decode($modellen,true);

    //merk en model klaarmaken voor jquery 
    ?>

    <div style="display:none" id="merkcfid"><?php echo $value_merk; ?></div>
    <div style="display:none" id="modelcfid"><?php echo $value_model; ?></div>
    <label>Merk</label>
    <select class="car-merk" name='carmerk-input'>
    <option selected disabled>Selecteer Merk</option>
    
    <?php
    foreach($merken as $merk){
    echo("<option value='".$merk["merk"]."' data-merkid='".$merk["merkid"]."'>".$merk["merk"]."</option>");
    }
    ?>
    </select>

    <label>Model</label>
    <select class="car-model" name='carmodel-input'>
    

    <option selected class="selecteermodel">Selecteer Model</option>
  
    <?php
    foreach($modellen as $model){
    
    echo("<option class='modeloption' value='".$model["model"]."' data-merkid='".$model["merkid"]."' data-modelid='".$model["modelid"]."'>".$model["model"]."</option>");
    }
    ?>
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

    <label for="carcarpass-input">Carpass link</label>
    <input type="text" name="carcarpass-input" id="carcarpass-input" value="<?php echo $value_carpass ?>" />

    <label for="caruniq-input" style="display:none;">Car unique id</label>
    <input type="text" name="caruniq-input" id="caruniq-input" value="<?php echo $value_uniq ?>" />

    <label for="carmodifieddate-input" style="display:none;">Car modified date</label>
    <input type="text" name="carmodifieddate-input" id="carmodifieddate-input"
        value="<?php echo $value_modifieddate ?>" />

       
    

</div>
<div>
    <br>
<hr>    
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
<br>
<hr>
<div id="gallery-metabox">

<table class="form-table">
      <tr><td>
        <a class="gallery-add button" href="#" data-uploader-title="Foto's toevoegen" data-uploader-button-text="Foto's toevoegen">Foto's toevoegen</a>

        <ul id="gallery-metabox-list">
        <?php $all_gallery_ids = array(); ?>
        <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
          <?php array_push($all_gallery_ids,$value);?>
          <li>
            <input type="hidden" name="vdw_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
            <div class="image-preview change-image" style='width: 120px;height:90px;background:url("<?php echo $image[0]; ?>");background-size:cover;'></div>
            <div class="gallerycontrols remove-image" style=""></div>
          </li>

        <?php endforeach; endif; ?>
        </ul>
        <input type="hidden" name="all_gallerys_ids" value="<?php foreach($all_gallery_ids as $id){
          echo($id . ",");
        }; ?>"/>
      </td></tr>
    </table>
    </div>

</div>
<div class="dds_popup_wrap aankoopborderel_popup_wrap">
 <div class="dds_popup aankoopborderel_popup">
 <div id="aankoopborderel_pop_close" class="pop_close">&#x2715</div>
 <h2 style="padding: 0;">Aankoopborderel PDF aanmaken</h2>
    <h4>Initiele velden</h4>

     <label>Klant / Firma naam</label>
     <input type="text" id="klantnaam" name="klantnaam">
     <label>Klant adres</label>
     <input type="text" id="klantadres" name="klantadres">
     <label>Klant telefoonnummer</label>
     <input type="text" id="klanttel" name="klanttel">
     <hr>
     <label>Afgesproken prijs</label>
     <input type="text" id="aankoop_boekhoudkundige" name="aankoop_boekhoudkundige">
    <div class="toonhiddenfields">Toon meer</div>
     <div class="hidefields">
     <label>Premie invoerder</label>
     <input type="text" id="premie_invoerder" name="premie_invoerder">
     <label>Overdracht korting</label>
     <input type="text" id="overdracht_korting" name="overdracht_korting">
     </div>
     <label>Rekeningnummer</label>
     <input type="text" id="reknr" name="reknr">
     <label>Datum aankoop</label><br>
     <input style="width:100%;" type="date" id="aankoopdatum" name="aankoopdatum" pattern="\d{4}-\d{2}-\d{2}">
<hr>
<?php



$aankoopbd_add_fields = [
    "_car_inschrijvingdocument_key" => get_post_meta($post->ID,"_car_inschrijvingdocument_key",true),
    "_car_gelijkvormigheids_attest_key" => get_post_meta($post->ID,"_car_gelijkvormigheids_attest_key",true),
    "_car_keuringsbewijs_key" => get_post_meta($post->ID,"_car_keuringsbewijs_key",true),
    "_car_onderhoudsboekje_key" => get_post_meta($post->ID,"_car_onderhoudsboekje_key",true),
    "_car_gebruikershandleiding_key" => get_post_meta($post->ID,"_car_gebruikershandleiding_key",true),
    "_car_aankoopfactuur_key" => get_post_meta($post->ID,"_car_aankoopfactuur_key",true),
    "_car_alarm_attest_key" => get_post_meta($post->ID,"_car_alarm_attest_key",true),
    "_car_2_sleutels_key" => get_post_meta($post->ID,"_car_2_sleutels_key",true)
];
$bandendiepte_voor = get_post_meta($post->ID,"_car_bandenstaat_voor_key",true);
$bandendiepte_achter = get_post_meta($post->ID,"_car_bandenstaat_achter_key",true);

foreach($aankoopbd_add_fields as $key => $field){
    $labelformatted = mb_substr($key, 5);
    $labelformatted = mb_substr($labelformatted, 0, -4);
    $labelformatted = ucwords($labelformatted);
    $labelformatted = str_replace("_"," ",$labelformatted);
?>
<div class="ab_cb_group">
    <label for="<?php echo $key; ?>"><?php echo $labelformatted; ?></label>
    <input type="checkbox" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo $field; ?>" <?php
            if($field == "yes"){ echo(" checked"); }        
    ?>>
    </div>


<?php
}




?>
    <hr>
<div  style="width: 400px;">
<label style="width: 183px;
    padding-right: 20px;
    display: inline-block;" for="_car_bandenstaat_voor_key">Voor banden diepte (mm)</label>
<input type="number" id="_car_bandenstaat_voor_key" name="_car_bandenstaat_voor_key" min="0" max="6" value="<?php echo $bandendiepte_voor; ?>">
<br><br>
<label style="width: 183px;
    padding-right: 20px;
    display: inline-block;" for="_car_bandenstaat_achter_key">Achter banden diepte (mm)</label>
<input type="number" id="_car_bandenstaat_achter_key" name="_car_bandenstaat_achter_key" min="0" max="6" value="<?php echo $bandendiepte_achter; ?>">
</div>

     <button id="ab_aanmaken" class="pdfbtn">Borderel aanmaken</button>
     </div>
     
 </div>
<style>
  
  .toonhiddenfields {
    margin-top: 10px;
    }

</style>


 <div class="dds_popup_wrap bestelbon_popup_wrap">
 <div class="dds_popup bestelbon_popup">
 <div id="bestelbon_pop_close" class="pop_close">&#x2715</div>


 <?php
$klantnaam = get_post_meta( $post->ID, 'klantnaam', true );
$klantennummer = get_post_meta( $post->ID, 'klantennummer', true );
$klantadres = get_post_meta( $post->ID, 'klantadres', true );
$klanttel = get_post_meta( $post->ID, 'klanttel', true );
$aangepasteprijs = get_post_meta( $post->ID, 'aangepasteprijs', true );
$btw_percentage = get_post_meta( $post->ID, 'btw_percentage', true );
$bestelbonnummer = get_post_meta( $post->ID, 'bestelbonnummer', true );
$datumbestelbon = get_post_meta( $post->ID, 'datumbestelbon', true );
$datumlevering = get_post_meta( $post->ID, 'datumlevering', true );
$datumvervaldag = get_post_meta( $post->ID, 'datumvervaldag', true );
$bb_opmerkingen = get_post_meta( $post->ID, 'bb_opmerkingen', true );
$bb_voorakkoord = get_post_meta( $post->ID, 'bb_voorakkoord', true );

?>


 <h2 style="padding: 0;">Bestelbon PDF aanmaken</h2>
    <h4>Initiele velden</h4>

     <label>Klant / Firma naam</label>
     <input type="text" id="klantnaam" name="klantnaam" value="<?php echo($klantnaam); ?>">
     <label>Klanten Nummer</label>
     <input type="number" name="klantennummer" value="<?php echo($klantennummer) ?>">
     <label>Klant adres</label>
     <input type="text" id="klantadres" name="klantadres" value="<?php echo($klantadres) ?>">
     <label>Klant telefoonnummer</label>
     <input type="number" id="klanttel" name="klanttel" value="<?php echo($klanttel) ?>">
     <hr>
     <label>Prijs (optioneel)</label>
     <input type="number" id="aangepasteprijs" name="aangepasteprijs" value="<?php echo($aangepasteprijs) ?>">
     <div class="toonhiddenfields">Toon meer</div>
     <div class="hidefields">
     <label>BTW Percentage</label>
     <input style="width:100%;" type="number" name="btw_percentage" value="0" value="<?php echo($btw_percentage) ?>">
     </div> 
     <label>Bestelbon Nummer</label>
     <input type="text" name="bestelbonnummer" value="<?php echo($bestelbonnummer) ?>">
     <label>Datum Bestelbon</label>
     <input style="width:100%;" type="date" name="datumbestelbon" pattern="\d{4}-\d{2}-\d{2}" value="<?php echo($datumbestelbon) ?>">
     <label>Datum Levering/Dienstprestatie</label>
     <input style="width:100%;" type="date" name="datumlevering" pattern="\d{4}-\d{2}-\d{2}" value="<?php echo($datumlevering) ?>"> 
     <label>Datum Vervaldag</label>
     <input style="width:100%;" type="date" name="datumvervaldag" pattern="\d{4}-\d{2}-\d{2}" value="<?php echo($datumvervaldag) ?>">
     <label>Opmerking</label>
     <input type="text" name="bb_opmerkingen" value="<?php echo($bb_opmerkingen) ?>">
     <label>Voor akkoord</label>
     <input type="text" name="bb_voorakkoord" value="<?php echo($bb_voorakkoord) ?>">
     <button id="bb_aanmaken" class="pdfbtn">Bestelbon aanmaken</button>
     </div>
     
 </div>


<?php   
if (is_edit_page('new')){
    echo("<span class='typeofpage' style='display:none'>new</span>");
 }
 else{
    echo("<div class='typeofpage' style='display:none'>notnew</div>");
 }
 echo("<input type='hidden' class='currentPID' value='".$post->ID."' />");


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
                //var_dump($syncimagesarray);
                if(!empty($syncimagesarray) && is_array($syncimagesarray)){
                    foreach($syncimagesarray as $img){
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

        $aankoopbd_add_fields = [
            "_car_inschrijvingdocument_key",
            "_car_gelijkvormigheids_attest_key",
            "_car_keuringsbewijs_key",
            "_car_onderhoudsboekje_key",
            "_car_gebruikershandleiding_key",
            "_car_aankoopfactuur_key",
            "_car_alarm_attest_key",
            "_car_2_sleutels_key"
        ];
        foreach($aankoopbd_add_fields as $field){
            if(isset($_POST[$field])){
                echo("checked " . $_POST[$field]);
                update_post_meta($post->ID, $field, "yes");     
            }
            else{
                update_post_meta($post->ID, $field, "no");     
            }
        }

        if(isset($_POST["_car_bandenstaat_voor_key"])){
            update_post_meta($post->ID, '_car_bandenstaat_voor_key', $_POST["_car_bandenstaat_voor_key"]);      
        }
        if(isset($_POST["_car_bandenstaat_achter_key"])){
            update_post_meta($post->ID, '_car_bandenstaat_achter_key', $_POST["_car_bandenstaat_achter_key"]);      
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