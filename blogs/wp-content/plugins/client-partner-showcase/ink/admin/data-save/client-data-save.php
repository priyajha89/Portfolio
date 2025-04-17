<?php
if(isset($PostID) && isset($_POST['cli_partner_save_data_action']) ) {
			$TotalCount = count($_POST['img_url']);
			$ClientPartnerArray = array();
			if($TotalCount) {
				for($i=0; $i < $TotalCount; $i++) {
					$img_url = stripslashes(sanitize_text_field($_POST['img_url'][$i]));
					$photo = stripslashes(sanitize_text_field($_POST['photo'][$i]));
					$link_newtab = stripslashes(sanitize_text_field($_POST['link_newtab'][$i]));
					
					$ClientPartnerArray[] = array(
						'img_url' => $img_url,
						'photo' => $photo,
						'link_newtab' => $link_newtab,
										
					);
				}
				update_post_meta($PostID, 'nkcps_client_partner_data', serialize($ClientPartnerArray));
				update_post_meta($PostID, 'nkcps_client_partner_count', $TotalCount);
			} else {
				$TotalCount = -1;
				update_post_meta($PostID, 'nkcps_client_partner_count', $TotalCount);
				$ClientPartnerArray = array();
				update_post_meta($PostID, 'nkcps_client_partner_data', serialize($ClientPartnerArray));
			}
		}
?>