<?php
function popup_open($popup_name){
?>

<div class="dds_pop_wrap <?php echo $popup_name; ?>">
<div class="dds_pop_inner">
<div class="dds_pop_close"><span>&#x2715</span> <span>Sluiten</span></div>
<div class="dds_pop_content">
<?php
}
function popup_close(){

    ?>
    </div>
    </div>
    </div>
    <?php
}
?>

<?php
function dialog_popup_open($popup_name){
?>

<div class="dds_dialog_pop_wrap <?php echo $popup_name; ?>">
<div class="dds_dialog_pop_inner">

<div class="dds_dialog_pop_content">
<div class="dds_dialog_pop_close"><span>&#x2715</span></div>
<?php
}
