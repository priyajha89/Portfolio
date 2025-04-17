<?php
	wp_enqueue_style('nkcps_client_partner-bootstrap', nkcps_client_partner_directory_url.'assets/css/bootstrap.css');
	wp_enqueue_style('nkcps_client_partner-panel-style', nkcps_client_partner_directory_url.'assets/css/panel-style.css');
	wp_enqueue_style('nkcps_client_partner-sidebar', nkcps_client_partner_directory_url.'assets/css/sidebar.css');
	wp_enqueue_style('nkcps_client_partner-jquery-ui-css', nkcps_client_partner_directory_url .'assets/css/cli_jquery-ui.css');
	wp_enqueue_style('nkcps_client_partner-font-awesome', nkcps_client_partner_directory_url.'assets/css/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('nkcps_client_partner-settings-css', nkcps_client_partner_directory_url.'assets/css/settings.css');
	wp_enqueue_style('nkcps_client_partner-line-editor-css', nkcps_client_partner_directory_url.'assets/css/jquery-linedtextarea.css');
	wp_enqueue_style( 'wp-color-picker' );
	
	wp_enqueue_media();
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'nkcps_client_partner-color-pic', nkcps_client_partner_directory_url.'assets/js/color-picker.js', array( 'wp-color-picker' ), false, true );
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('nkcps_client_partner-media-upload-script-js', nkcps_client_partner_directory_url.'assets/js/media-upload-script.js');
		wp_enqueue_script('nkcps_client_partner-popper-js', nkcps_client_partner_directory_url.'assets/js/popper.min.js');

	wp_enqueue_script('nkcps_client_partner-bootstrap-js', nkcps_client_partner_directory_url.'assets/js/bootstrap.min.js');
	wp_enqueue_script( 'nkcps_client_partner-line-edit-js', nkcps_client_partner_directory_url.'assets/js/jquery-linedtextarea.js');
	
?>