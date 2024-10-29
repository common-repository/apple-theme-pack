<?php
  
  if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
  }

  $appdir = $classes_dir.'/app/';

  $custom_classes = array(

    'AppleThemePack\App\DatabaseInit'   	  => $appdir.'DatabaseInit.php',
    'AppleThemePack\App\IconPicker'		   	  => $appdir.'IconPicker.php',
  );
?>