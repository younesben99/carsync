<?php
include(__DIR__."/../../../../../wp-load.php");
ob_start();
?>

<html>
<head><title>Loading...</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />


<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_home_url();?>/wp-content/plugins/dds-dashboard/assets/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_home_url();?>/wp-content/plugins/dds-dashboard/assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_home_url();?>/wp-content/plugins/dds-dashboard/assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_home_url();?>/wp-content/plugins/dds-dashboard/assets/img/favicon/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_home_url();?>/wp-content/plugins/dds-dashboard/assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="<?php echo get_home_url();?>/wp-content/plugins/dds-dashboard/assets/img/favicon.ico">
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="msapplication-config" content="<?php echo get_home_url();?>/wp-content/plugins/dds-dashboard/assets/img/favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">


</head>
<body>
    <div style="width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;">
    <img style="" src="<?php echo(get_site_url()); ?>/wp-content/plugins/carsync/assets/img/load.gif" alt="Loading...">
</div>
    <?php
 
 $postid = $_GET["postid"];

 $offerteurl = get_post_meta($postid,"_offerte_url",true);
 
if(!empty( $offerteurl)){
    header("Location: ". $offerteurl);
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



</body>
</html>