<?php
/*
Plugin Name: Digiflow Carsync
Plugin URI: https://github.com/younesben99/carsync
Description: A plugin that syncs autoscout24 cars with wordpress posts.
Version: 0.3
Author: Younes Benkheil
Author URI: https://digiflow.be/
License: GPL2
GitHub Plugin URI: https://github.com/younesben99/carsync
*/

require_once( __DIR__ . '/register/register_cpt.php');
require_once( __DIR__ . '/register/register_metaboxes.php');
require_once( __DIR__ . '/register/register_archive.php');
require_once( __DIR__ . '/register/register_single.php');

?>
