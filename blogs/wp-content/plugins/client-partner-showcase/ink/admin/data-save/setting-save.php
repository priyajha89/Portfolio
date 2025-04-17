<?php
if(isset($PostID) && isset($_POST['client_partner_setting_save_action'])) {
			$disp_logo_url_set          		= sanitize_text_field($_POST['disp_logo_url_set']);
			$section_layout          			= sanitize_text_field($_POST['section_layout']);
			$section_padding_top_bottom_size    = sanitize_text_field($_POST['section_padding_top_bottom_size']);
			$section_padding_left_right_size    = sanitize_text_field($_POST['section_padding_left_right_size']);
			
		$Client_Settings_Array = serialize( array(
				
				'section_layout' 	          	   => $section_layout,
				'section_padding_top_bottom_size'  => $section_padding_top_bottom_size,
				'section_padding_left_right_size'  => $section_padding_left_right_size,
				"disp_logo_url_set" 		       => $disp_logo_url_set,
				) );
			update_post_meta($PostID, 'client_partner_Settings', $Client_Settings_Array);
		}
?>