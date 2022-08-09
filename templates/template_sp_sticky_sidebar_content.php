<div class="sp_title">
<?php 
    ?>
   <?php 
   
   switch ($sp_koopstatus) {
    case 'tekoop':
       ?>
<div class="sp_koopstatus_badge" style="background-color: #00b362;">Te koop</div>
       <?php
        break;
    case 'gereserveerd':
        ?>
<div class="sp_koopstatus_badge" style="background-color: #e77524;">Gereserveerd</div>
        <?php
        break;
    case 'verkocht':
     ?>
<div class="sp_koopstatus_badge" style="background-color: #de2c4a;">Verkocht</div>
        <?php
        break;
    default:
        # code...
        break;
   }
   
   
  ?>
 <?php
     ?>
<h5 style="margin-top:15px !important;font-size: 21px;
    color: #3a3a3a;
    margin: 0;
    font-weight: 500;"><?php echo $sp_title; ?></h5>
    <p style="font-size: 14px;
    margin: 0;
    margin-top: 15px;
    margin-bottom: 15px;
    color: grey;">
    
  
    <?php echo  $wagentitel; ?></p></div>
        <div class="sp_sticky_prijs">
           
           

            
            <?php 
            if(!empty($sp_prijs)){

                echo '<div style="font-size: 15px;">Prijs</div>';
                echo "€ ".number_format($sp_prijs,0,",",".") . ",-";
            }
             ?>
            <?php
            if(!empty($sp_oudeprijs)){
                echo "<div class='sp_sticky_oudeprijs'>€ ".number_format($sp_oudeprijs,0,",",".") . ",-</div>";
            }
        ?>
        </div>
        <?php


            if($sp_koopstatus == "tekoop" ){
?>
<div class="sp_sticky_vergelijken" data-post-id="<?php echo $post->ID; ?>"><i data-feather="repeat"></i>Vergelijken</div>
        <div class="sp_sticky_testrit pop_open" data-popup="testrit_pop"><i data-feather="calendar"></i>Testrit boeken</div>




<?php
            }else{
                ?>
<button  class="bodh_btn_filter pop_open" data-popup="bodh_pop"><span style="padding-right:10px;">Blijf op de hoogte</span><svg  class="bodh_icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
 <g>
   <g>
     <g>
       <path d="m453.9,96.3c-10.5,10.5-27.6,10.5-38.2,0-10.5-10.5-10.5-27.6 0-38.2 10.5-10.5 27.6-10.5 38.2,0 10.5,10.6 10.5,27.7 0,38.2zm-40.2,136.1c-14.2,35.9-44.3,68.9-71.8,96.4-31.5,31.5-42.4,72.4-45.5,104.3l-217.6-217.6c31.9-3.1 72.8-14 104.3-45.5 27.5-27.5 60.5-57.6 96.4-71.8 40.7-16.1 75.2-8 108.7,25.5 33.5,33.5 41.6,68 25.5,108.7zm-288.9,154.8c-21.4-21.4-24.5-54.4-9-79l88.1,88.1c-24.8,15.4-57.7,12.4-79.1-9.1zm356.8-356.8c-25.9-25.9-67.8-25.9-93.6,2.13163e-14-9.2,9.2-15.1,20.5-17.8,32.3-10-4.7-20.3-8-30.8-9.9-23.8-4.3-48.8-1.3-74.3,8.7-42.6,16.8-79.4,50.2-109.8,80.6-45,45-120.8,33.9-121.5,33.7-8.4-1.4-16.8,2.9-20.7,10.5-3.9,7.6-2.4,16.9 3.6,22.9l70.5,70.5c-30.6,40.5-27.5,98.5 9.5,135.4 36.9,36.9 94.9,40.1 135.4,9.5l70.5,70.5c6,6 15.3,7.5 22.9,3.6 7.6-3.9 11.9-12.2 10.5-20.7 0-0.2-2.9-19.4-0.1-44.1 3.7-32.6 15.1-58.7 33.8-77.4 30.4-30.4 63.8-67.2 80.6-109.8 10.1-25.5 13-50.5 8.7-74.3-1.9-10.5-5.2-20.8-9.9-30.8 11.9-2.6 23.1-8.6 32.3-17.8 26.1-25.6 26.1-67.5 0.2-93.4v7.10543e-15z"/>
     </g>
   </g>
 </g>
</svg></button>

<?php
            }
        ?>

        





        <?php do_action( 'after_testrit' ); ?>
        <div class="sp_sticky_contact_wrap">
            <button class="sp_sticky_beschikbaarheid  <?php
            
            if($sp_koopstatus !== "tekoop" ){
                echo "btn_outline";
            }
            ?>  pop_open" data-popup="contact_pop">Contact opnemen</button>
            <?php do_action( 'after_contact_mail' ); ?>
            <?php
            if(!empty($sp_telnr_formatted)){
            ?>
            <button href="tel:<?php echo($sp_telnr_formatted) ;?>" class="sp_sticky_telefoneren"><?php echo($sp_telnr) ;?></button>
            <?php
            }
            ?>
            
            <?php do_action( 'after_telnr' ); ?>
        </div>
        <div class="sp_sticky_troeven">
            <?php

if(!empty($sp_shortcode_troeven)){
    echo do_shortcode($sp_shortcode_troeven);
}

?>
        </div>