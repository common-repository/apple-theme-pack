<?php
	require dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/classes/DemoContentSetter.php';

	$d = new AppleThemePack\DemoContentSetter();
	
	if( isset( $_REQUEST[ 'install-demo-content' ] ) ) {
	
		$d->setup();
		atp_demo_install_success_msg();
	
	} elseif( isset( $_REQUEST[ 'uninstall-demo-content' ] ) ) {
	
		$d->uninstall();
		atp_demo_uninstall_success_msg();
	
	} else{

		if( ! is_writable( wp_upload_dir()['path'] ) ){ ?>

			<div class="notice notice-warning">
				<i class="dashicons dashicons-warning"></i> 
				<?php _e( 'Directory "wp-content/uploads" is not writable. The demo installer needs to upload post thumbnails to this directory for custom post types. You can ask your hosting provider to fix this issue for you. You can continue to install demo content without fixing the issue but you may end up missing post thumbnails in frontend. Our advice is to have this issue resolved first.', 'apple-theme-pack' ); ?>	
			</div>
    	        
    	<?php } ?>

    	<div class="notice notice-warning">
			<i class="dashicons dashicons-warning"></i> 
			<?php _e( 'If you experience any server issue during install procedure, please uninstall demo content first and then install demo content again to have a clean demo content install.', 'apple-theme-pack' ); ?>	
		</div>	

		<?php
    } 
    unset( $d );
    ?>

    <form action="#">
    	<input type="hidden" name="page" value="apple-theme-pack-welcome-screen"/>
    	<input type="hidden" name="tab" value="demo-content"/>
    	<input class="button" type="submit" name="install-demo-content" value="<?php _e( 'Install Demo Conent', 'apple-theme-pack' ); ?>"/>
    	<input class="button" type="submit" name="uninstall-demo-content" value="<?php _e( 'Uninstall Demo Conent', 'apple-theme-pack' ); ?>"/>
    </form>
