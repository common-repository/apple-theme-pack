<?php
/**
 * Plugin Name: Apple Theme Pack
 * Plugin URI:http://thememantra.com/
 * Description: A companion plugin for Apple theme
 * Version: 1.0
 * Author: Amit, Saurav
 * Author URI: http://thememantra.com/
 * Requires at least: 4.1
 * Tested up to: 4.6
 *
 * Text Domain: apple-theme-pack
 * Domain Path: /app/languages/
 *
 * @package apple_theme
 * @category Core
 * @author Amit, Saurav
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

require 'vendor/tgmpa/class-tgm-plugin-activation.php';
require 'app/classes/Application.php';
require 'functions.php';

use AppleThemePack\Application as Application;
use AppleThemePack\Bootstrap as Bootstrap;

if ( ! class_exists( 'AppleThemePackApplication' ) ) :

class AppleThemePackApplication
{
  public static function ignite()
  {
    $app = new Application();
    $app->run();
  }
}
endif;

if( ! function_exists( 'apple_theme_pack_ignite_plugin' ) ) :
	/**
	* This function ensures that plugin only runs if current theme is Apple
	* @return void
	*/
	function apple_theme_pack_ignite_plugin() {

		$theme_is_active = atp_is_apple_theme_active();

		if( true === ( $value = wp_get_theme( 'tm-apple' )->exists() ) && ( 'Tm Apple' == wp_get_theme() ) || ( 'Tm Apple Pro' == wp_get_theme() ) || 0 == 0 ) { 
			AppleThemePackApplication::ignite();
		} elseif( true === ( $value = wp_get_theme( 'tm-apple' )->exists() ) ) {
			add_action( 'admin_notices', 'atp_admin_notice_theme_not_active' );
		}  
		else {			
			add_action( 'admin_notices', 'atp_admin_notice_theme_does_not_exist' );
		}
	}
endif;

apple_theme_pack_ignite_plugin();
?>
