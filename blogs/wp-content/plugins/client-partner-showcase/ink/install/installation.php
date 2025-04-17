<?php 
function nkcps_client_partner_front_script() {
    
    	wp_enqueue_style('nkcps_client_partner_bootstrap', nkcps_client_partner_directory_url.'assets/css/bootstrap.css');
		wp_enqueue_style('nkcps_client_partner-font-awesome-front', nkcps_client_partner_directory_url.'assets/css/font-awesome/css/font-awesome.min.css');
		wp_enqueue_style('nkcps_client_partner-owl-carousel-css', nkcps_client_partner_directory_url .'assets/css/owl.carousel.css');
		wp_enqueue_style('nkcps_client_partner-owl-theme-default-css', nkcps_client_partner_directory_url .'assets/css/owl.theme.default.css');
		wp_enqueue_style('nkcps_client_partner-tipso-min-css', nkcps_client_partner_directory_url .'assets/css/tipso.min.css');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('nkcps_client_partner_popper_js', nkcps_client_partner_directory_url.'assets/js/popper.min.js');

	    wp_enqueue_script('nkcps_client_partner_bootstrap_js', nkcps_client_partner_directory_url.'assets/js/bootstrap.min.js');
		wp_enqueue_script('nkcps_client_partner-owl-carousel-js', nkcps_client_partner_directory_url.'assets/js/owl.carousel.js');
		wp_enqueue_script('nkcps_client_partner-tipso-min-js', nkcps_client_partner_directory_url.'assets/js/tipso.min.js');
}
add_action( 'wp_enqueue_scripts', 'nkcps_client_partner_front_script' );

add_filter( 'widget_text', 'do_shortcode');
add_action('media_buttons_context', 'nkcps_client_partner_editor_popup_content_button');
add_action('admin_footer', 'nkcps_client_partner_editor_popup_content');

function nkcps_client_partner_editor_popup_content_button($context) {
  $img = nkcps_client_partner_directory_url.'assets/images/icon.png';
  $container_id = 'CLI_PARTNER';
  $title = 'Select Client to insert into post';
  $context .= '<style>.wp_client_partner_showcase_ShortCode_button {
				background: #f7f7f7 !important;
				border-color: #ccc !important;
				-webkit-box-shadow: 0 1px 0 #ccc !important;
				box-shadow: 0 1px 0 #f7f7f7 !important;
				color: #000;
				text-decoration: none;font-weight:600;
				text-shadow: 0 -1px 1px #ccc !important;
			    }</style>
			    <a class="button  wp_client_partner_showcase_ShortCode_button thickbox" title="Select Client to insert into post"    href="#TB_inline?width=400&inlineId='.$container_id.'">
					<span class="wp-media-buttons-icon" style="background: url('.$img.'); background-repeat: no-repeat; background-position: left bottom;"></span>
				Client Pro Shortcode
				</a>';
  return $context;
}

function nkcps_client_partner_editor_popup_content() {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#nkcps_client_partner_insert').on('click', function() {
			var id = jQuery('#nkcps_client_partner_insertselect option:selected').val();
			window.send_to_editor('<p>[CLI_PARTNER id=' + id + ']</p>');
			tb_remove();
		})
	});
	</script>
<style>
.wp_client_partner_showcase_ShortCode_button {
    background: #f7f7f7; !important;
    border-color: #ccc !important;
    -webkit-box-shadow: 0 1px 0 #ccc !important;
    box-shadow: 0 1px 0 #f7f7f7 !important;
    color: #000 !important;
	text-decoration: none;font-weight:600;
    text-shadow: 0 -1px 1px #ccc !important;
}
</style>
	<div id="CLI_PARTNER" style="display:none;">
	  <h3>Select Client To Insert Into Post</h3>
	  <?php 
		
		$all_posts = wp_count_posts( 'client_partner')->publish;
		$args = array('post_type' => 'client_partner', 'posts_per_page' =>$all_posts);
		global $All_rcli;
		$All_rcli = new WP_Query( $args );			
		if( $All_rcli->have_posts() ) { ?>	
			<select id="nkcps_client_partner_insertselect" style="width: 100%;margin-bottom: 20px;">
				<?php
				while ( $All_rcli->have_posts() ) : $All_rcli->the_post(); ?>
				<?php $title = get_the_title(); ?>
				<option value="<?php echo get_the_ID(); ?>"><?php if (strlen($title) == 0) echo 'No Title Found'; else echo $title;   ?></option>
				<?php
				endwhile; 
				?>
			</select>
			<button class='button primary wp_client_partner_showcase_ShortCode_button' id='nkcps_client_partner_insert'><?php esc_html_e('Insert Client Shortcode', 'client-partner-showcase'); ?></button>
			<?php
		} else {
			esc_html_e('No Client Found', 'client-partner-showcase');
		}
		?>
	</div>
	<?php
}
?>