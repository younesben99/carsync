<div class="spechead" id="opties">
<h2>Opties</h2>
</div>

<div class="optionwrap opties">

<div class="media optcontrol">
<h3>Media</h2>
<?php

if(count($sp_media) > 4){
    for ($i=0; $i < 4; $i++) {
        echo("<div class='optie'><i data-feather='check'></i>".$sp_media[$i]."</div>");
    }
}
else{
    for ($i=0; $i < count($sp_media); $i++) {
        echo("<div class='optie'><i data-feather='check'></i>".$sp_media[$i]."</div>");
    }
}

if(count($sp_media) > 3){
    echo("<div class='hiddenoption'>");
    for ($i=4; $i < count($sp_media); $i++) { 
        echo("<div class='optie'><i data-feather='check'></i>".$sp_media[$i]."</div>");
    }
    echo("</div>");
?>

<?php
if(count($sp_media) > 4){
?>
<div class="toonmeer">Toon meer</div>
<?php
}
?>



<?php

}
?>

</div>

<div class="comfort optcontrol">
<h3>Comfort</h2>
<?php

if(count($sp_comfort) > 4){
    for ($i=0; $i < 4; $i++) {
        echo("<div class='optie'><i data-feather='check'></i>".$sp_comfort[$i]."</div>");
    }
}
else{
    for ($i=0; $i < count($sp_comfort); $i++) {
        echo("<div class='optie'><i data-feather='check'></i>".$sp_comfort[$i]."</div>");
    }
}

if(count($sp_comfort) > 3){
    echo("<div class='hiddenoption'>");
    for ($i=4; $i < count($sp_comfort); $i++) { 
        echo("<div class='optie'><i data-feather='check'></i>".$sp_comfort[$i]."</div>");
    }
    echo("</div>");
?>

<?php
if(count($sp_comfort) > 4){
?>
<div class="toonmeer">Toon meer</div>
<?php
}
?>



<?php

}
?>

</div>

<div class="veiligheid optcontrol">
<h3>Veiligheid</h2>
<?php


if(count($sp_veiligheid) > 4){
    for ($i=0; $i < 4; $i++) {
        echo("<div class='optie'><i data-feather='check'></i>".$sp_veiligheid[$i]."</div>");
    }
}
else{
    for ($i=0; $i < count($sp_veiligheid); $i++) {
        echo("<div class='optie'><i data-feather='check'></i>".$sp_veiligheid[$i]."</div>");
    }
}


if(count($sp_veiligheid) > 3){
    echo("<div class='hiddenoption'>");
    for ($i=4; $i < count($sp_veiligheid); $i++) { 
        echo("<div class='optie'><i data-feather='check'></i>".$sp_veiligheid[$i]."</div>");
    }
    echo("</div>");
?>


<?php
if(count($sp_veiligheid) > 4){
?>
<div class="toonmeer">Toon meer</div>
<?php
}
?>



<?php

}
?>

</div>

<div class="extra optcontrol">
<h3>Extra</h2>
<?php

if(count($sp_extra) > 4){
    for ($i=0; $i < 4; $i++) {
        echo("<div class='optie'><i data-feather='check'></i>".$sp_extra[$i]."</div>");
    }
}
else{
    for ($i=0; $i < count($sp_extra); $i++) {
        echo("<div class='optie'><i data-feather='check'></i>".$sp_extra[$i]."</div>");
    }
}


if(count($sp_extra) > 3){
    echo("<div class='hiddenoption'>");
    for ($i=4; $i < count($sp_extra); $i++) { 
        echo("<div class='optie'><i data-feather='check'></i>".$sp_extra[$i]."</div>");
    }
    echo("</div>");
?>

<?php
if(count($sp_extra) > 4){
?>
<div class="toonmeer">Toon meer</div>
<?php
}
?>


<?php

}
?>

</div>


</div>