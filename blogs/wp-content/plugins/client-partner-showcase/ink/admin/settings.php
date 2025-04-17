<?php 
$De_Settings = unserialize(get_option('client_partner_default_Settings_new'));
 $PostId = $post->ID;
 $Settings = unserialize(get_post_meta( $PostId, 'client_partner_Settings', true));

		$option_names = array(
			
			"section_layout"					=>  $De_Settings['section_layout'],
			"section_padding_top_bottom_size" 	=>  $De_Settings['section_padding_top_bottom_size'],
			"section_padding_left_right_size" 	=>  $De_Settings['section_padding_left_right_size'],
			"disp_logo_url_set" 		    	=>  $De_Settings['disp_logo_url_set']
			);
			foreach($option_names as $option_name => $default_value) {
				if(isset($Settings[$option_name])) 
					${"" . $option_name}  = $Settings[$option_name];
				else
					${"" . $option_name}  = $default_value;
			}
?>
<script>

	
	// Section Padding Top and Bottom
	jQuery(function() {
		jQuery( "#section_padding_top_bottom_size_id" ).slider({
			orientation: "horizontal",
			range: "min",
			max: 200,
			min:10,
			slide: function( event, ui ) {
			jQuery( "#section_padding_top_bottom_size" ).val( ui.value );
		  }
		});
		
		jQuery( "#section_padding_top_bottom_size_id" ).slider("value",<?php if(isset($section_padding_top_bottom_size)){ echo $section_padding_top_bottom_size; } else{ echo 80; }  ?>);
		jQuery( "#section_padding_top_bottom_size" ).val( jQuery( "#section_padding_top_bottom_size_id" ).slider( "value") );
    
	});
	//Section Padding Right and Left
	jQuery(function() {
		jQuery( "#section_padding_left_right_size_id" ).slider({
			orientation: "horizontal",
			range: "min",
			max: 200,
			min:10,
			slide: function( event, ui ) {
			jQuery( "#section_padding_left_right_size" ).val( ui.value );
		  }
		});
		
		jQuery( "#section_padding_left_right_size_id" ).slider("value",<?php if(isset($section_padding_left_right_size)){ echo $section_padding_left_right_size; } else{ echo 70; }  ?>);
		jQuery( "#section_padding_left_right_size" ).val( jQuery( "#section_padding_left_right_size_id" ).slider( "value") );
    
	});
</script>



<Script>
function updte_nkcps_client_partner_default_settings(){
	 jQuery.ajax({
		url: location.href,
		type: "POST",
		data : {
			    'action_cli_partner':'updte_nkcps_client_partner_default_settings',
			     },
                success : function(data){
									alert("Default Settings Updated");
									location.reload(true);
                                   }	
	});
	
}
</script>

<?php
if(isset($_POST['action_cli_partner']) == "updte_nkcps_client_partner_default_settings")
	{
	
		$Settings_Array = serialize( array(
				"section_layout" 		         	=> $section_layout,
				"section_padding_top_bottom_size"   => $section_padding_top_bottom_size,
				"section_padding_left_right_size"   => $section_padding_left_right_size,
				"disp_logo_url_set" 		        => $disp_logo_url_set									
			) );
			update_option('client_partner_default_Settings_new', $Settings_Array);
	}
?>
<input type="hidden" id="client_partner_setting_save_action" name="client_partner_setting_save_action" value="client_partner_setting_save_action">

<div class="nkcps_site_sidebar_widget_title" style="margin-left:-13px;margin-right:-13px;border-radius: 3px;margin-bottom:5px">
	<h4 style="border-top-left-radius: 2px;"><?php esc_html_e('Section Settings ','client-partner-showcase'); ?></h4>
</div>

<!--------------------------------------------------------Section Settings---------------------------------------------------------------------------------------------------------------->
					
<table class="form-table acc_table" id="caroid">
	<tbody>
		<tr class="setting_color box_border_group">
			<th><label><?php esc_html_e('Section Padding Size','client-partner-showcase'); ?></label>
			</th>
			<td>
				
					<div style="margin-left:0px; margin-bottom:20px;">
						<label><b><?php esc_html_e('Left and Right','client-partner-showcase'); ?></b></label>
						<div id="section_padding_left_right_size_id" class="size-slider" ></div>
						<input type="text" class="slider-text" id="section_padding_left_right_size" name="section_padding_left_right_size"  readonly="readonly">
					</div>
		
				<div style="margin-bottom:10px;margin-top:10px;margin-left:0px;">
					<label><b><?php esc_html_e('Top and Bottom','client-partner-showcase'); ?></b></label>
					<div id="section_padding_top_bottom_size_id" class="size-slider" ></div>
					<input type="text" class="slider-text" id="section_padding_top_bottom_size" name="section_padding_top_bottom_size"  readonly="readonly">
				</div>
			 
			</td>
		</tr>
		
	
		<tr class="setting_color box_border_group">
			<th><label><?php esc_html_e('Logo Item Column Layout','client-partner-showcase'); ?></label>
				 
			</th>
			<td>
				<select name="section_layout" id="section_layout" class="standard-dropdown" style="width:100%">
					<option value="12"  <?php if($section_layout == '12' ) { echo "selected"; } ?>>1 column layout</option>
					<option value="6"  <?php if($section_layout == '6' ) { echo "selected"; } ?>>2 column layout</option>
					<option value="4"  <?php if($section_layout == '4' ) { echo "selected"; } ?>>3 column layout</option>
					<option value="3"  <?php if($section_layout == '3' ) { echo "selected"; } ?>>4 column layout</option>
				</select>
			 
			</td>
		</tr>
		

		<tr>
			<th scope="row"><label><span ><?php esc_html_e('Enable link on client logo','client-partner-showcase'); ?></span></label>
				 
			</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="disp_logo_url_set" value="yes" id="enable_disp_logo_url_set" <?php if($disp_logo_url_set == 'yes' ) { echo "checked"; } ?> onchange="hide_link_setting()">
					<label for="enable_disp_logo_url_set" class="switch-label switch-label-off"><?php esc_html_e('Yes','client-partner-showcase'); ?></label>
					<input type="radio" class="switch-input" name="disp_logo_url_set" value="no" id="disable_disp_logo_url_set"  <?php if($disp_logo_url_set == 'no' ) { echo "checked"; } ?> onchange="hide_link_setting()">
					<label for="disable_disp_logo_url_set" class="switch-label switch-label-on"><?php esc_html_e('No','client-partner-showcase'); ?></label>
					<span class="switch-selection"></span>
				</div>
				
			</td>
		</tr>
	</tbody>
</table>