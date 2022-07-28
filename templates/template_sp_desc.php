
<?php 

if(!empty($sp_description)){
    ?>

    

<div class="sp_description" id="opmerkingen">
    <div class="spechead">
        <h2>Opmerkingen</h2>
    </div>
    <div class="sp_desc_wrap">
        <p>
            <?php

echo($sp_description);

?>
        </p>

    </div>
    <button class="toondesc">Toon meer</button>
</div>
<?php
}
?>