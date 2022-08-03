<div class="sp_sticky_mobile_nav">
    <button class="sp_smv_mail smv_wrap pop_open" data-popup="contact_pop"><i data-feather="mail"></i> <div class="smv_text">Mailen</div></button>
    <button href="tel:<?php echo($sp_telnr_formatted) ;?>" class="sp_smv_call smv_wrap"><i data-feather="phone"></i> <div class="smv_text">Bellen</div></button>
    <button class="sp_smv_testrit smv_wrap pop_open" data-popup="testrit_pop"><i data-feather="calendar"></i> <div class="smv_text"><?php 
    $testritct = apply_filters('custom_testrit_text', 'Testrit');
    echo($testritct); ?></div></button>
</div>