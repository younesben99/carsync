<?php function stock_card($car,$splide = false){

  
  ?>

    <div data-price="<?php echo preg_replace('/[^0-9]/', '',$car["prijs"]); ?>" data-link="<?php echo $car["link"]; ?>" class="<?php if($splide){ echo "splide__slide "; } ?>grid_item car-item element-item <?php echo preg_replace('/[^a-zA-Z0-9]/', '',$car["merk"]) . " " . slugify($car["model"]) ." pr_" . preg_replace('/[^0-9]/', '',$car["prijs"]) . " " .  preg_replace('/[^a-zA-Z0-9]/', '',$car["brandstof"]) . " " .  preg_replace('/[^a-zA-Z0-9]/', '',$car["transmissie"]) . " " .  preg_replace('/[^a-zA-Z0-9]/', '',$car["carrosserievorm"]) . " " . $car["kilometerstand"] . " " . $car["bouwjaar"] . " " .  preg_replace('/[^a-zA-Z0-9]/', '',$car["euro"]) ?>">
    
    <div class="grid_image" style="background-image:url('<?php echo $car["bg"] ?>');">
        
    </div>
    <div class="grid_content">

    <?php
 if($car["carstatus"] == "tekoop"){

if(!empty($car["badge"])){


?>
   <div class="grid_badge"><?php echo($car["badge"]); ?></div>

<?php
}

 }

?>

<?php
 if(!empty($car["carstatus"])){
?>
   <div class="grid_carstatus" <?php
   switch ($car["carstatus"]) {
    case 'tekoop':
      echo "style='display:none;'";
      break;
    case 'gereserveerd':
      echo "style='background-color:#e77524;'";
      break;
    case 'verkocht':
        echo "style='background-color:#de2c4a;'";
        break;
   }
   ?>><?php echo($car["carstatus"]); ?></div>


<?php
 if($car["carstatus"] == "verkocht"){
 echo '<div class="grid_bodh_badge pop_open" data-popup="bodh_single_pop" data-merk="'.$car["merk"].'" data-model="'.$car["model"].'">Blijf op de hoogte</div>';
}
   ?>


<?php
 }

 $filtered_wt = str_replace("- "," - ",$car["wagentitel"]);
 $filtered_wt = str_replace(" -"," - ", $filtered_wt);
 $filtered_wt = str_replace("("," - ", $filtered_wt);
 $filtered_wt = str_replace(")"," - ", $filtered_wt);
 $filtered_wt = str_replace("**"," - ", $filtered_wt);
 $filtered_wt = str_replace("km"," km", $filtered_wt);
 $stripped_wt = preg_replace('/<img[^>]+>/', ' - ', $filtered_wt);
 $stripped_wt = trim( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', 
 mb_convert_encoding( $stripped_wt, "UTF-8" ) ) );

 $stripped_wt_length = mb_strlen($stripped_wt);

 if($stripped_wt_length > 61){
  $stripped_wt = mb_substr($stripped_wt, 0, 61) . "...";
 }




 if(is_numeric($car["kilometerstand"])){
  $formatted_km ="<span class='sort_km'>". number_format($car["kilometerstand"],0,"",".") . "</span><span class='km_label'> km</span>";
 }


 $grid_keys = array_filter(array($car["brandstof"],$car["emissieklasse"],$car["transmissie"],"<span class='sort_bouwjaar'>". $car["bouwjaar"] ."</span>",$formatted_km));

?>
 
    <div class="grid_title"><?php echo $car["title"]; ?> </div>
    <div class="grid_wagentitel"><?php echo $stripped_wt; ?> </div>
    <div class="grid_keys"><?php echo implode(" | ",$grid_keys); ?></div>
   
 

    <div class="grid_price"><span class="prijs_label">  <?php
    if($car["carstatus"] !== "verkocht"){
      echo "Prijs";
    }
    else{
      echo "Verkocht";
    }
    
    ?></span>  <div>
    
    <?php 
      if(!empty($car["oudeprijs"]) && is_numeric($car["oudeprijs"])){
          ?> 

<span class="oudeprijs">€ <span><?php echo $car["oudeprijs"] ?></span></span>
<?php
      }
    ?>
   <?php


if($car["carstatus"] !== "verkocht"){

if(!empty($car["prijs"]) && is_numeric($car["prijs"])){


   ?>
    <span class="current_prijs">€ <span class="sort_prijs"><?php
    if(is_numeric($car["prijs"])){
      echo number_format($car["prijs"],0,"",".");
    }
     ?></span></span>
    <?php
}else{
  ?>
 <span class="">Prijs op aanvraag</span>

<?php
}

}

?>
    </div>
  </div>


<div class="grid_bottom_btns">
    <a href="<?php echo $car["link"]; ?>" class="grid_btn"><svg style="margin-right: 10px;" width="25px" height="25px" viewBox="0 0 1024 1024" class="icon" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M754.752 480H160a32 32 0 100 64h594.752L521.344 777.344a32 32 0 0045.312 45.312l288-288a32 32 0 000-45.312l-288-288a32 32 0 10-45.312 45.312L754.752 480z"/></svg>
 Bekijk deze <?php echo __("auto"); ?></a></div>
    </div>
    </div>

<?php


}


function bodh_card(){


    ?>

<div class="bodh grid_item element-item ">

   <div>
   <div class="bodh_title">Jouw auto niet gevonden?</div>
   <p style="font-size:14px;margin-top:5px; margin-bottom:20px;">Dagelijks worden er nieuwe auto's toegevoegd. We kunnen je een seintje geven wanneer er een auto die overeenkomt met jouw interesses beschikbaar komt.</p>

   <button  class="bodh_btn_filter pop_open" data-popup="bodh_pop"><span style="padding-right:10px;">Blijf op de hoogte</span><svg  class="bodh_icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
 <g>
   <g>
     <g>
       <path d="m453.9,96.3c-10.5,10.5-27.6,10.5-38.2,0-10.5-10.5-10.5-27.6 0-38.2 10.5-10.5 27.6-10.5 38.2,0 10.5,10.6 10.5,27.7 0,38.2zm-40.2,136.1c-14.2,35.9-44.3,68.9-71.8,96.4-31.5,31.5-42.4,72.4-45.5,104.3l-217.6-217.6c31.9-3.1 72.8-14 104.3-45.5 27.5-27.5 60.5-57.6 96.4-71.8 40.7-16.1 75.2-8 108.7,25.5 33.5,33.5 41.6,68 25.5,108.7zm-288.9,154.8c-21.4-21.4-24.5-54.4-9-79l88.1,88.1c-24.8,15.4-57.7,12.4-79.1-9.1zm356.8-356.8c-25.9-25.9-67.8-25.9-93.6,2.13163e-14-9.2,9.2-15.1,20.5-17.8,32.3-10-4.7-20.3-8-30.8-9.9-23.8-4.3-48.8-1.3-74.3,8.7-42.6,16.8-79.4,50.2-109.8,80.6-45,45-120.8,33.9-121.5,33.7-8.4-1.4-16.8,2.9-20.7,10.5-3.9,7.6-2.4,16.9 3.6,22.9l70.5,70.5c-30.6,40.5-27.5,98.5 9.5,135.4 36.9,36.9 94.9,40.1 135.4,9.5l70.5,70.5c6,6 15.3,7.5 22.9,3.6 7.6-3.9 11.9-12.2 10.5-20.7 0-0.2-2.9-19.4-0.1-44.1 3.7-32.6 15.1-58.7 33.8-77.4 30.4-30.4 63.8-67.2 80.6-109.8 10.1-25.5 13-50.5 8.7-74.3-1.9-10.5-5.2-20.8-9.9-30.8 11.9-2.6 23.1-8.6 32.3-17.8 26.1-25.6 26.1-67.5 0.2-93.4v7.10543e-15z"/>
     </g>
   </g>
 </g>
</svg></button>
   </div>
   </div>

<?php
}
?>