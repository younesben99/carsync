<?php
include(__DIR__."/../../../../wp-load.php");
//vin als uid gebruiken

$merken = merken_ophalen();
$modellen = modellen_ophalen();

$merken = json_decode($merken,true);
$modellen = json_decode($modellen,true);
var_dump($modellen);
?>

<select class="car-merk">
<?php
foreach($merken as $merk){
  echo("<option value='".$merk["merkid"]."'>".$merk["merk"]."</option>");
}
?>
</select>

<select class="car-model">
<?php
foreach($modellen as $model){
  
  echo("<option value='".$model["merkid"]."'>".$model["model"]."</option>");
}
?>
</select>