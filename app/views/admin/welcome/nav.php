<?php 
	$active_tab = atp_welcome_page_current_tab();
?>
<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
	
	<a class="nav-tab <?php echo esc_attr( ( atp_is_active_tab( 'required-actions', $active_tab ) ) ? 'nav-tab-active' : '' ); ?>" href="<?php echo add_query_arg( array( 'page' => urlencode( 'apple-theme-pack-welcome-screen' ), 'tab' => urlencode( 'required-actions' ) ), esc_url_raw( admin_url() .'plugins.php' ) );?>"> <?php _e( 'Required Actions', 'tm-apple' ); ?></a>

	<a class="nav-tab <?php echo esc_attr( ( atp_is_active_tab( 'demo-content', $active_tab ) ) ? 'nav-tab-active' : '' ); ?>" href="<?php echo add_query_arg( array( 'page' => urlencode( 'apple-theme-pack-welcome-screen' ), 'tab' => urlencode( 'demo-content' ) ), esc_url_raw( admin_url() .'plugins.php' ) );?>"> <?php _e( 'Demo Content', 'tm-apple' ); ?></a>

</nav>