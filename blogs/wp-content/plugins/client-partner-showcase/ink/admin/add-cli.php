<input type="hidden" name="cli_partner_save_data_action" value="cli_partner_save_data_action"/>
<div  class="client_partner_admin_wrapper">
	<div class="nkcps_site_sidebar_widget_title">
		<h4><?php esc_html_e('Add Client / Logo partner here','client-partner-showcase');?></h2>
	</div>
	<ul class="clearfix" id="grid_panel">
	<?php
			global $post;
			$De_Settings = unserialize(get_option('client_partner_default_Settings_new'));
			$Settings = unserialize(get_post_meta($post->ID, 'client_partner_Settings', true));
		
			$option_names = array(
				"disp_logo_url_set" 		=> $De_Settings['disp_logo_url_set'],
			);
			foreach($option_names as $option_name => $default_value) {
				if(isset($Settings[$option_name])) 
					${"" . $option_name}  = $Settings[$option_name];
				else
					${"" . $option_name}  = $default_value;
			}
			$i=1;
			global $post;
			$PostID=$post->ID;
			$grid_data = unserialize(get_post_meta( $post->ID, 'nkcps_client_partner_data', true));
			$TotalCount =  get_post_meta( $post->ID, 'nkcps_client_partner_count',true);
			if($TotalCount) 
			{
				if($TotalCount!=-1)
				{
					foreach($grid_data as $client_single_data)
					{
						 $img_url = $client_single_data['img_url'];
						 $photo = $client_single_data['photo'];
						 $link_newtab = $client_single_data['link_newtab'];
						?>
						<li class="nkcps_ac-panel single_acc_box">
							<img style="margin-bottom:15px;" class="client-img-responsive" src="<?php echo $photo;?>"/>
							<input style="margin-bottom:15px" type="button" id="upload-background" name="upload-background" value="Upload Photo" class="button-primary rcsp_media_upload btn-block" onclick="nkcps_media_upload(this)"/>
							<input style="display:block;width:100%" type="hidden"  name="photo[]" class="nkcps_ac_label_text"  value="<?php echo $photo; ?>" readonly="readonly" placeholder="No Media Selected"/>
								
					
					
					<div class="clientpro_logo_link_class" <?php if($disp_logo_url_set=="no"){?>style="display:none;"<?php } ?>>
									
							<span class="ac_label" style="margin-top:20px;"><?php esc_html_e('Image Url','client-partner-showcase'); ?></span>
							<input type="text" id="img_url[]" name="img_url[]" value="<?php echo esc_attr($img_url); ?>" placeholder="Enter Image url with http://" class="nkcps_ac_label_text">

							<span class="ac_label" style="margin-top:20px;"><?php esc_html_e('Open link in new tab','client-partner-showcase'); ?></span>	
							<select name="link_newtab[]" id="link_newtab[]" class="standard-dropdown" style="width:100%" >
								<option value="yes"  <?php if($link_newtab == 'yes' ) { echo "selected"; } ?>><?php esc_html_e('Yes');?></option>
								<option value="no"  <?php if($link_newtab == 'no' ) { echo "selected"; } ?>><?php esc_html_e('No','client-partner-showcase');?></option>
							</select>
					</div>				
							<a class="remove_button" href="#delete" id="remove_bt"><i class="fa fa-trash-o" style="color:#000;"></i></a>
						</li>
						<?php 
						$i++;
					} // end of foreach
				}else{
				echo "<h2><?php esc_html_e('No Section Found','client-partner-showcase');?></h2>";
				}
			}
			else 
			{
				  for($i=1; $i<=4; $i++)
				  {
					  ?>
						 <li class="nkcps_ac-panel single_acc_box" >
														
							<img style="margin-bottom:15px;" class="client-img-responsive" src="<?php echo nkcps_client_partner_directory_url.'assets/images/design/logo.png'; ?>"/>
							<input style="margin-bottom:15px" type="button" id="upload-background" name="upload-background" value="Upload Photo" class="button-primary rcsp_media_upload btn-block"  onclick="nkcps_media_upload(this)"/>
							<input style="display:block;width:100%" type="hidden"  name="photo[]" class="nkcps_ac_label_text"  value="<?php echo nkcps_client_partner_directory_url.'assets/images/design/logo.png'; ?>" readonly="readonly" placeholder="No Media Selected"/>
							
						
						<div class="clientpro_logo_link_class" <?php if($disp_logo_url_set=="no"){ ?>style="display:none;" <?php } ?>>					
							
							
							<span class="ac_label" style="margin-top:20px;"><?php esc_html_e('Image Url','client-partner-showcase'); ?></span>
							<input type="text"  name="img_url[]" value="#" placeholder="Enter Image url with http://" class="nkcps_ac_label_text">
							
							<span class="ac_label" style="margin-top:20px;"><?php esc_html_e('Open link in new tab','client-partner-showcase'); ?></span>
							<select name="link_newtab[]" id="link_newtab[]" class="standard-dropdown" style="width:100%">
								<option value="yes">Yes</option>
								<option value="no"> >No</option>
							</select>
						</div>						
							<a class="remove_button" href="#delete" id="remove_bt"><i class="fa fa-trash-o" style="color:#000;"></i></a>
						
						</li>
					<div>	
					 <?php
				}
			}
			?>
	</ul>
</div>
<div  class="client_partner_admin_wrapper">	
	<a class="nkcps_ac-panel add_nkcps_ac_new" id="add_new_ac" onclick="add_new_section()">
		<?php esc_html_e('Add New Client', 'client-partner-showcase');?>
	</a>
	<a  style="float: left;padding:10px !important;background:#31a3dd;" class=" add_nkcps_ac_new delete_all_acc" id="delete_all_acc">
		<i style="font-size:57px; color:#fff;"class="fa fa-trash-o"></i>
		<span style="display:block"><?php esc_html_e('Delete All','client-partner-showcase');?></span>
	</a>
	<?php require('add-cli-js.php');?>
</div>