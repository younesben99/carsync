

<?php
include(__DIR__."/../../../../../wp-load.php");
?>
<html>

<head><title>Loading...</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <div style="width:100%;height:100%;display:flex;justify-content:center;align-items:center;background-image:url(<?php echo(get_site_url()); ?>/wp-content/plugins/carsync/assets/img/load.gif);    background-size: 40%;
    background-repeat: no-repeat;
    background-position: center;">

    <?php
 
 $postid = $_GET["postid"];

 $offerteurl = get_post_meta($postid,"_offerte_url",true);
 var_dump($offerteurl);
 if(!empty( $offerteurl)){
    header("Location: ". $offerteurl);
    die();
}
 
//check of offerte url is aangekomen ja of nee
?>



<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>


    jQuery( document ).ready(function() {
        window.setTimeout( function() {
  window.location.reload();
}, 2000);
});
</script>


</div>
</body>
</html>