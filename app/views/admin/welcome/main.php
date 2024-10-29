<style type="text/css">
	.nav-tab-wrapper {
		border-bottom: 1px solid #ccc;
	}
	table.theme-page-main {
		width: 100%;
		margin-top: 10px;
	}
	.table-content {
		width: 70%;
		padding-top: 10px;
	}
	.table-sidebar {
		width: 30%;
		padding-top: 10px;
	}
	.pro-box-inner{
		background: #fff;
		padding: 10px;
		box-shadow : 2px 2px 2px 0 rgba(46,46,46,.1);
	}
	.pro-box-inner ul li{
		width: 50%;
		float: left;
	}
	.pro-button {
		vertical-align: baseline;
    	background: #ef0e0e !important;
    	color: #fff  !important;
    	width: 100%;
    	font-weight: bold;
    	padding: 10px;
    	display: block;
    	height: auto  !important;
	}
	table.theme-page-main .notice{
		margin-top: 0;
		padding: 20px;
	}
	.page-footer .button i{
		position: relative;
		top:4px;
		left: -2px;
	}
	.theme-info-links a{
		background: #fff;
		padding: 75px;
		display: inline-block;
		text-align: center;
		text-decoration: none;
		border:1px solid #e4e4e4;
		margin-right: 10px;
		width: 15%;
		transition: all .2s linear;
		margin-bottom: 15px;
	}
	.theme-info-links a:hover{
		background: #f9f9f9;
	}
	.theme-info-links i {
		font-size: 28px;
	}	
</style>
<?php 
	$page = atp_welcome_page_current_tab().'.php';
?>
<div class="wrap">
	<?php include 'nav.php'; ?>
	<table class="theme-page-main">
		<tbody>
			<tr>
				<td class="table-content" valign="top"> <?php include $page; ?> </td>
				<td class="table-sidebar" valign="top"> <?php include 'sidebar.php'; ?> </td>
			</tr>
		</tbody>
	</table>	

	<div class="page-footer">
		<a class="button button-primary" href="<?php echo add_query_arg( array( 'page' => urlencode( 'apple-theme-pack-welcome-screen' ), 'tab' => urlencode( 'demo-content' ) ), esc_url_raw( admin_url() .'plugins.php' ) ); ?>">
			<i class="dashicons dashicons-admin-page"></i><?php _e( 'Demo Content', 'apple-theme-pack' ); ?>
		</a>
		<a class="button button-primary" href="customize.php"><i class="dashicons dashicons-art"></i><?php _e( 'Customize Theme', 'apple-theme-pack' ); ?>
		</a>
		<a target="_blank" class="button button-primary" href="http://thememantra.com/documentation/apple-theme/"><i class="dashicons dashicons-info"></i><?php _e( 'Read Documentation', 'apple-theme-pack' ); ?>
		</a>
		<a target="_blank" class="button button-primary" href="http://thememantra.com/support/"><i class="dashicons dashicons-admin-tools"></i><?php _e( 'Support', 'apple-theme-pack' ); ?>
		</a>
	</div>
</div>
