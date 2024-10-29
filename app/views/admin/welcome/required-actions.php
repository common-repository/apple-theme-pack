<ul class="">
	<?php $theme_is_active = atp_is_apple_theme_active(); 

	if( ! $theme_is_active ) { ?>
		<li> <?php _e( 'Apple Theme is not active yet. Please activate Apple Theme', 'apple-theme-pack' ); ?></li>
	<?php
	}else{ ?>
		<li> <?php printf( __( 'Nothing is required. Install demo content <a href="%s">here</a> if you have not installed it yet.', 'apple-theme-pack' ), add_query_arg( array( 'page' => urlencode( 'apple-theme-pack-welcome-screen' ), 'tab' => urlencode( 'demo-content' ) ), esc_url_raw( admin_url() .'plugins.php' ) ) ); ?>
			
		</li>
		<br/>		
	<?php
	}

	?>
</ul>
<div class="theme-info-links">
	<a href="http://thememantra.com/theme/documentation/getting-started/" target="_blank">
	<p>
		<i class="dashicons dashicons-info"></i>
	</p> 
	<?php _e( 'Getting Started', 'tm-apple' ); ?>
	</a>

	<a href="http://thememantra.com/theme/documentation/requirements/" target="_blank">
	<p>
		<i class="dashicons dashicons-megaphone"></i>
	</p> 
	<?php _e( 'Requirements', 'tm-apple' ); ?>
	</a>

	<a href="<?php echo add_query_arg( array( 'page' => urlencode( 'apple-theme-pack-welcome-screen' ), 'tab' => urlencode( 'demo-content' ) ), esc_url_raw( admin_url() .'plugins.php' ) ); ?>" target="_blank">
	<p>
		<i class="dashicons dashicons-admin-page"></i>
	</p> 
	<?php _e( 'Demo Content', 'tm-apple' ); ?>
	</a>

	<a href="customize.php" target="_blank">
	<p>
		<i class="dashicons dashicons-art"></i>
	</p> 
	<?php _e( 'Customize', 'tm-apple' ); ?>
	</a>

	<a href="http://thememantra.com/documentation/apple-theme/" target="_blank">
	<p>
		<i class="dashicons dashicons-visibility"></i>
	</p> 
	<?php _e( 'Documentation', 'tm-apple' ); ?>
	</a>

	<a href="http://thememantra.com/support/" target="_blank">
	<p>
		<i class="dashicons dashicons-admin-tools"></i>
	</p> 
	<?php _e( 'Support', 'tm-apple' ); ?>
	</a>
</div>