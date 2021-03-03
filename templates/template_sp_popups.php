<div class="sp_contact_pop_wrap">
<div class="sp_contact_inner">
<div class="sluiten contactsluiten"><i data-feather="x"></i><span>Sluiten</span></div>
<div class="sp_contact_pop">

<h2>Contacteer ons voor de <?php echo($sp_title); ?></h2>
<span class="sp_pop_wagentitel">Vul uw gegevens in. We nemen snel contact met u op.
</span>
<ul class="warning"></ul>
<div class="sp_contact_succes">Bericht verstuurd. We nemen snel contact met u op.</div>
<form class="sp_contact_form">
<input type="text" name="sp_contact_name" placeholder="Naam" required>
<input type="email" name="sp_contact_mail" placeholder="E-mailadres" required>
<input type="tel" name="sp_contact_tel" placeholder="Telefoonnummer" required>
<textarea name="sp_contact_bericht" placeholder="Bericht" rows="4"  required></textarea>
<button type="submit" class="sp_contact_versturen" id="sp_contact_versturen">Versturen</button>
</form>


</div>
</div>
</div>

<div class="sp_testrit_pop_wrap">
<div class="sp_testrit_inner">
<div class="sluiten testritsluiten"><i data-feather="x"></i><span>Sluiten</span></div>
<div class="sp_testrit_pop">
<h2>Boek een testrit voor de <?php echo($sp_title); ?></h2>
<span class="sp_pop_wagentitel">Kies een tijd en datum voor de testrit.
</span>
<ul class="warning"></ul>
<div class="sp_testrit_succes">Uw afspraak is succesvol gepland. U ontvangt snel een bevestiging van ons.</div>
<form class="sp_testrit_form">
<?php


$datums = array();

$myDate = date("l d F Y");

for ($i=0; $i < 30; $i++) { 
    array_push($datums, strtotime($myDate . '+ '.$i.'days'));
}



?>
<select class="testrit_select" id="testrit_datum" name="sp_testrit_datum" required>

<?php

    foreach($datums as $date){
        echo "<option value=".$date.">".nlDate(date("l d F Y",$date))."</option>";
    }

?>

</select>

<?php

    $tijdstippen = array();

    $timebuffer = mktime(9,0,0);

    for ($i=0; $i < 9 * 4; $i++) { 

        $timebuffer += 900;

        array_push($tijdstippen, date("H:i",$timebuffer));
        
    }


?>


<select class="testrit_select" id="testrit_tijdstip" name="sp_testrit_tijdstip" required>

<?php

    foreach($tijdstippen as $tijd){
        echo "<option value=".$tijd.">".$tijd."</option>";
    }

?>

</select> 
<span class="sp_pop_wagentitel">Hoe kunnen we u bereiken?
</span>
<input type="text" name="sp_testrit_name" placeholder="Naam" required>
<input type="email" name="sp_testrit_mail" placeholder="E-mailadres" required>
<input type="tel" name="sp_testrit_tel" placeholder="Telefoonnummer" required>
<textarea name="sp_testrit_bericht" placeholder="Bericht" rows="4"  required></textarea>
<button type="submit" class="sp_testrit_versturen" id="sp_testrit_versturen">Versturen</button>
</form>


</div>
</div>
</div>