<?php require('style.php');?>
<div id="client_container_<?php echo $post_id;?>" >
	<div class="logo_client_partner_section" id="logo_client_partner_section">
		<div class="nkcps_client_section_overlay">
			<div class="text-center">
				<h2 class="logo_client_partner_section_title text-center"><?php the_title(); ?></h2>
			</div>
			<div class="row text-center" id="">
				<?php 
				$i=1;
				foreach($client_data as $single_data)
				{
					$sb_grid_clear_both="";
					$img_url = $single_data['img_url'];
					$photo = $single_data['photo'];
					$link_newtab = $single_data['link_newtab'];
					$sb_grid_clear_both= "<div style='clear:both'></div>";
					?> 							
						
							<div class="<?php echo $presetselector;?>">
								<div class="logo-item_<?php echo $post_id;?>">
									<?php if($disp_logo_url_set=="yes")
											{
									?>
										<a  href="<?php echo $img_url;?>" target="<?php if($link_newtab=="yes"){ echo "_blank";}else{ echo "";}?>">
												<img class="img-responsive img_grayscale" src="<?php echo $photo;?>"  alt="brand images">
										</a>
									<?php
											}
									else
									{
									?>
										<img class="img-responsive img_grayscale" src="<?php echo $photo;?>"  alt="brand images">
									<?php
									}
									?>		
								</div>
							</div>
						<?php 
						//if($i%$row==0)  //for grid
						echo $sb_grid_clear_both;
				$i++;
				}
				?> 
				<div></div>
			</div>
		</div>
	</div>
</div>