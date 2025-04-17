<?php $post_type = "client_partner";
	  $AllDATA = array(  'p' => $NKCPS_CLIENT_ID, 'post_type' => $post_type, 'orderby' => 'ASC');
	  $loop = new WP_Query( $AllDATA );
while ( $loop->have_posts() ) : $loop->the_post();
	//get the post id
	$post_id = get_the_ID();
	$De_Settings = unserialize(get_option('client_partner_default_Settings_new'));
	$Settings = unserialize(get_post_meta( $post_id, 'client_partner_Settings', true));
	$option_names = array(
			"section_layout"					=> "3",
			"disp_logo_url_set" 		    	=> "yes",
			"section_padding_top_bottom_size" 	=> "80",
			"section_padding_left_right_size" 	=> "70",			
			
		);
	foreach($option_names as $option_name => $default_value) {
		if(isset($Settings[$option_name])) 
			${"" . $option_name}  = $Settings[$option_name];
		else
			${"" . $option_name}  = $default_value;
		}
		$client_data = unserialize(get_post_meta( $post_id, 'nkcps_client_partner_data', true));
		$TotalCount =  get_post_meta( $post_id, 'nkcps_client_partner_count', true );

		$presetselector = "col-md-".$section_layout." "." col-sm-4 col-sm-6 col-xs-6 logo_item_col_wrapper";							
				if($section_layout=="3")
					{
					 $logo_col_layout = "4";
					}
				 elseif($section_layout=="4")
					{
					  $logo_col_layout = "3";
					}
				 elseif($section_layout=="6")
					{
					  $logo_col_layout = "2";
					}
				  elseif($section_layout=="12")
					{
						$logo_col_layout = "12";
					}
			
?>
		<div class="nkcps_client_partner_row" id="nkcps_client_partner_row_<?php echo $post_id;?>">
		
			<?php 
				if($TotalCount>0) 
				{
					//For Clear Both
					switch($section_layout)
						{	
							
							case(12):
								$row=1;
							break;	
							
							case(6):
								$row=2;
							break;
							
							case(4):
								$row=3;
							break;
							case(3):
								$row=4;
							break;
							
						}
					require("designs/index.php");

				}
				else{echo "<h3> No Section Found </h3>";}
			?>
		</div>
		
<?php			
	endwhile; 
?>