<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( ! function_exists( 'atp_admin_notice_theme_does_not_exist' ) ) :
	function atp_activation_admin_notice() {
    	?>
    	<div class="notice notice-warning is-dismissible">
        	<p><?php _e( 'Apple Theme Pack is supposed to be used with Apple Theme only. Please install and activate Apple Theme.', 'apple-theme-pack' ); ?></p>
    	</div>
    <?php
	}
endif;

if( ! function_exists( 'atp_admin_notice_theme_not_active' ) ) :
	function atp_admin_notice_theme_not_active() {
    	?>
    	<div class="notice notice-warning is-dismissible">
        	<p><?php _e( 'Apple Theme Pack is supposed to be used with Apple Theme only. Please activate Apple Theme.', 'apple-theme-pack' ); ?></p>
    	</div>
    <?php
	}
endif;

if( ! function_exists( 'atp_is_active_tab' ) ) :
	/**
	* Prints theme pages
	*/
	function atp_is_active_tab( $tab, $active_tab ) { 
		return $tab === $active_tab;
	}
endif;

if( ! function_exists( 'atp_welcome_page_current_tab' ) ) :

	function atp_welcome_page_current_tab() { 
		
		if( isset( $_REQUEST[ 'tab' ] )  && $_REQUEST[ 'tab' ] ) {
			$active_tab = $_REQUEST[ 'tab' ];
		} else {
			$active_tab = 'required-actions';
		}
		return $active_tab;
	}
endif;

if( ! function_exists( 'atp_is_apple_theme_active' ) ) :

	function atp_is_apple_theme_active() { 
		if( true === ( $value = wp_get_theme( 'tm-apple' )->exists() ) && 'Tm Apple' == wp_get_theme() ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if( ! function_exists( 'atp_demo_install_success_msg' ) ) :

	function atp_demo_install_success_msg() { ?>

		<div class="notice notice-success dismissable">
			<?php _e( 'Demo content has been successfully installed. !!!', 'apple-theme-pack' ); ?>	
		</div>
	<?php
	}
endif;

if( ! function_exists( 'atp_demo_uninstall_success_msg' ) ) :

	function atp_demo_uninstall_success_msg() { ?>

		<div class="notice notice-success dismissable">
			<?php _e( 'Demo content has been successfully uninstalled. !!!', 'apple-theme-pack' ); ?>	
		</div>

	<?php
	}
endif;

?>
