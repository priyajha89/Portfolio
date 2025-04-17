<script>
	var j = 1000;
	function add_new_section(){
	var output = 	
		'<li class="nkcps_ac-panel single_acc_box" >'+
					'<img style="margin-bottom:15px;" class="client-img-responsive" src="<?php echo nkcps_client_partner_directory_url.'assets/images/design/logo.png'; ?>"/>'+
					'<input style="margin-bottom:15px" type="button" id="upload-background" name="upload-background" value="Upload Photo" class="button-primary rcsp_media_upload btn-block"  onclick="nkcps_media_upload(this)"/>'+
					'<input style="display:block;width:100%" type="hidden"  name="photo[]" class="nkcps_ac_label_text"  value="<?php echo nkcps_client_partner_directory_url.'assets/images/design/logo.png'; ?>" readonly="readonly" placeholder="No Media Selected"/>'+
							''+
							''+
					'<div class="clientpro_logo_link_class" <?php if($disp_logo_url_set=="no"){ ?>style="display:none;" <?php } ?>>'+		
							'<span class="ac_label" style="margin-top:20px;"><?php esc_html_e("Image Url",'client-partner-showcase'); ?></span>'+
							'<input type="text" id="img_url[]" name="img_url[]" value="#" placeholder="Enter Image url with http://" class="nkcps_ac_label_text">'+
							'<span class="ac_label" style="margin-top:20px;"><?php esc_html_e('Open link in new tab','client-partner-showcase'); ?></span>'+
							'<select name="link_newtab[]" id="link_newtab[]" class="standard-dropdown" style="width:100%">'+
								'<option value="yes">Yes</option>'+
								'<option value="no">No</option>'+
							'</select>'+
					'</div>'+		
					'<a class="remove_button" href="#delete" id="remove_bt"><i class="fa fa-trash-o" style="color:#000;"></i></a>'+
		'</li>';
	jQuery(output).hide().appendTo("#grid_panel").slideDown("slow");
	j++;
	}
	jQuery(document).ready(function(){
	  jQuery('#grid_panel').sortable({
		revert: true,
	  });
	});
</script>

<script>
	jQuery(function(jQuery)
		{
			var section = 
			{
				section_ul: '',
				init: function() 
				{
					this.section_ul = jQuery('#grid_panel');
					this.section_ul.on('click', '.remove_button', function() {
					if (confirm('Are you sure you want to delete this?')) {
						jQuery(this).parent().slideUp(600, function() {
							jQuery(this).remove();
						});
					}
					return false;
					});
					 jQuery('#delete_all_acc').on('click', function() {
						if (confirm('Are you sure you want to delete all the Grids?')) {
							jQuery(".single_acc_box").slideUp(600, function() {
								jQuery(".single_acc_box").remove();
							});
							jQuery('html, body').animate({ scrollTop: 0 }, 'fast');
						}
						return false;
					});
			   }
			};
		section.init();
	});
</script>