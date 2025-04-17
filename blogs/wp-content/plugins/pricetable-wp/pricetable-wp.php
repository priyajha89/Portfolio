<?php
/*
Plugin Name: Pricetable WP
Plugin URI: https://blogwpthemes.com/
Description: Pricetable plugin manage price tables on any wordpress page and posts. Easily add unlimited feature box with drag and drop builder.
Author: wpdiscover
Version: 1.9
Author URI: https://blogwpthemes.com/
License: GPL
*/

define('PRICETABLE_WP_FEATURED_WEIGHT', 1.175);
define('PRICETABLE_WP_VERSION', '1.7');

/**
 * Activate the pricetable-wp plugin
 */
function siteorigin_pricetable_wp_activate(){
	// Flush rules so we can view price table pages
	flush_rewrite_rules();
	
	delete_option('siteorigin_pricetable_wp_welcome');
}
register_activation_hook(__FILE__, 'siteorigin_pricetable_wp_activate');

/**
 * Deactivate the pricetable-wp plugin
 */
function siteorigin_pricetable_wp_deactivate(){
	delete_option('siteorigin_pricetable_wp_welcome');
}
register_deactivation_hook(__FILE__, 'siteorigin_pricetable_wp_deactivate');

/**
 * Register the price table post type
 */
if ( !function_exists( 'siteorigin_pricetable_wp_register' ) ) :
	function siteorigin_pricetable_wp_register(){
		register_post_type('pricetable-wp',array(
			'labels' => array(
				'name' => __('Price Tables', 'pricetable-wp'),
				'singular_name' => __('Price Table', 'pricetable-wp'),
				'add_new' => __('Add New', 'book', 'pricetable-wp'),
				'add_new_item' => __('Add New Price Table', 'pricetable-wp'),
				'edit_item' => __('Edit Price Table', 'pricetable-wp'),
				'new_item' => __('New Price Table', 'pricetable-wp'),
				'all_items' => __('All Price Tables', 'pricetable-wp'),
				'view_item' => __('View Price Table', 'pricetable-wp'),
				'search_items' => __('Search Price Tables', 'pricetable-wp'),
				'not_found' =>  __('No Price Tables found', 'pricetable-wp'),
			),
			'public'             	=> false,
			'publicly_queryable' 	=> true,
			'show_ui'            	=> true,
			'show_in_menu'       	=> true,
			'query_var'          	=> true,
			'has_archive' 			=> false,			
			'supports' 				=> array( 'title', '', 'revisions', '', '' ),
			'menu_icon' 			=> plugins_url('images/icon.png', __FILE__),
		));
	}
	add_action( 'init', 'siteorigin_pricetable_wp_register');
endif;
/**
 * Check if we need to redirect the user to the welcome page
 */
function siteorigin_pricetable_wp_display_welcome(){
	if(get_option('siteorigin_pricetable_wp_welcome', false) === false && @$_GET['page'] != 'pricetable-wp-welcome' && current_user_can('manage_options')){
		header('location:'.admin_url('edit.php?post_type=pricetable-wp&page=pricetable-wp-welcome'));
		exit();
	}
}
add_action('admin_init', 'siteorigin_pricetable_wp_display_welcome');

/**
 * Add custom columns to pricetable-wp post list in the admin
 * @param $cols
 * @return array
 */

if ( !function_exists( 'pricetable_wp_register_custom_columns' ) ) :
	function pricetable_wp_register_custom_columns($cols){
		unset($cols['title']);
		unset($cols['date']);
		
		$cols['title'] = __('Title', 'pricetable-wp');
		$cols['options'] = __('Options', 'pricetable-wp');
		$cols['features'] = __('Features', 'pricetable-wp');
		$cols['featured'] = __('Featured Option', 'pricetable-wp');
		$cols['date'] = __('Date', 'pricetable-wp');
		return $cols;
	}
	add_filter( 'manage_pricetable_wp_posts_columns', 'pricetable_wp_register_custom_columns');
endif; 

/**
 * Render the contents of the admin columns
 * @param $column_name
 */
 
function siteorigin_pricetable_wp_custom_column($column_name){
	global $post;
	switch($column_name){
	case 'options' :
		$table = get_post_meta($post->ID, 'nk_price_table', true);
		print count($table);
		break;
	case 'features' :
	case 'featured' :
		$table = get_post_meta($post->ID, 'nk_price_table', true);
		foreach($table as $col){
		if(!empty($col['featured']) && $col['featured'] == 'true'){
			if($column_name == 'featured') print $col['title'];
			else print count($col['features']);
			break;
		}
		}
		break;
	}
}
add_action( 'manage_pricetable_wp_posts_custom_column', 'siteorigin_pricetable_wp_custom_column');

/**
 * @return string The URL of the CSS file to use
 */
 
function pricetable_wp_css_url() {
	// Find the best price table file to use
	if(file_exists(get_stylesheet_directory().'/pricetable-wp/pricetable-wp.css')) return get_stylesheet_directory_uri().'/pricetable-wp/pricetable-wp.css';
	elseif(file_exists(get_template_directory().'/pricetable-wp/pricetable-wp.css')) return get_template_directory_uri().'/pricetable-wp/pricetable-wp.css';
	else return plugins_url( 'css/pricetable-wp.css', __FILE__);

}

function pricetable_wp_boot_url(){
	// Find the best price table file to use
	if(file_exists(get_stylesheet_directory().'/pricetable-wp/bootstrap.min.css')) return get_stylesheet_directory_uri().'/pricetable-wp/bootstrap.min.css';
	elseif(file_exists(get_template_directory().'/pricetable-wp/bootstrap.min.css')) return get_template_directory_uri().'/pricetable-wp/bootstrap.min.css';
	else return plugins_url( 'css/bootstrap.min.css', __FILE__);

}

function pricetable_wp_js_url(){
	// Find the best price table file to use
	if(file_exists(get_stylesheet_directory().'/pricetable-wp/bootstrap.min.js')) return get_stylesheet_directory_uri().'/pricetable-wp/bootstrap.min.js';
	elseif(file_exists(get_template_directory().'/pricetable-wp/bootstrap.min.js')) return get_template_directory_uri().'/pricetable-wp/bootstrap.min.js';
	else return plugins_url( 'js/bootstrap.min.js', __FILE__);

}

function pricetable_wp_icon_url(){
	// Find the best price table file to use
	// if(file_exists(get_stylesheet_directory().'/pricetable-wp/font-awesome.min.css')) return get_stylesheet_directory_uri().'/pricetable-wp/font-awesome.min.css';
	// elseif(file_exists(get_template_directory().'/pricetable-wp/font-awesome.min.css')) return get_template_directory_uri().'/pricetable-wp/font-awesome.min.css';
	// else return plugins_url( 'css/font-awesome/css/font-awesome.min.css', __FILE__);

}

/**
 * Enqueue the pricetable-wp scripts
 */
function pricetable_wp_scripts(){
	global $post, $pricetable_wp_queued, $pricetable_wp_displayed;
	if(is_singular() && (($post->post_type == 'pricetable-wp') || ($post->post_type != 'pricetable-wp' && preg_match( '#\[ *nk_price_table([^\]])*\]#i', $post->post_content ))) || !empty($pricetable_wp_displayed)){
        wp_enqueue_script('jquery');
		wp_enqueue_style('pricetable-wp',  pricetable_wp_css_url(), null, PRICETABLE_WP_VERSION);
		wp_enqueue_style('nk-font-awesome',  plugins_url( 'css/font-awesome/css/font-awesome.min.css', __FILE__) , null, PRICETABLE_WP_VERSION);
		$pricetable_wp_queued = true;
		wp_enqueue_style('pricetable-wps',  pricetable_wp_boot_url(), null, PRICETABLE_WP_VERSION);
		$pricetable_wp_queued = true;
		wp_enqueue_script('pricetable-wps',  pricetable_wp_js_url(), null, PRICETABLE_WP_VERSION);
		$pricetable_wp_queued = true;
		wp_enqueue_script('pricetable-wp-icon',  pricetable_wp_icon_url(), null, PRICETABLE_WP_VERSION);
		$pricetable_wp_queued = true;
	}
}
add_action('wp_enqueue_scripts', 'pricetable_wp_scripts');

/**
 * Add administration scripts
 * @param $page
 */
function siteorigin_pricetable_wp_admin_scripts($page){
	if($page == 'post-new.php' || $page == 'post.php'){
		global $post;
		
		if(!empty($post) && $post->post_type == 'pricetable-wp'){
			// Scripts for building the pricetable-wp
			wp_enqueue_script('placeholder', 	plugins_url( 'js/placeholder.jquery.js', __FILE__), array('jquery'), '1.1.1', true);
			wp_enqueue_script('elastic', 		plugins_url( 'js/jquery.elastic.js', __FILE__), array('jquery'), '1.6.10', true);

			wp_enqueue_script( 'pricetable-wp-color-pic', plugins_url( 'js/color-picker.js', __FILE__), array('wp-color-picker'), false, true);

			// wp_enqueue_script('jquery-ui');
			wp_enqueue_script('pricetable-wp-admin', plugins_url( 'js/pricetable-wp.build.js', __FILE__), array('jquery'), PRICETABLE_WP_VERSION, true);

			wp_enqueue_script( 'pricetable-wp-font-icon', plugins_url( 'js/fontawesome-iconpicker.js', __FILE__), array('jquery'));
			wp_enqueue_script( 'pricetable-wp-call-icon', plugins_url( 'js/call-icon-picker.js', __FILE__), array('jquery'), false, true);
			
			wp_localize_script('pricetable-wp-admin', 'pt_messages', array(
				'delete_column' => __('Are you sure you want to delete this column?', 'pricetable-wp'),
				'delete_feature' => __('Are you sure you want to delete this feature?', 'pricetable-wp'),
			));
			

			wp_enqueue_style('pricetable-wp-admin',  plugins_url( 'css/pricetable-wp.admin.css', __FILE__), array(), PRICETABLE_WP_VERSION);
			
			wp_enqueue_style('jquery-ui',  plugins_url( 'css/jquery-ui.css', __FILE__), array(), PRICETABLE_WP_VERSION);
			wp_enqueue_style('nk-font-awesome-icon',  plugins_url( 'css/font-awesome/css/font-awesome.min.css', __FILE__), array(), PRICETABLE_WP_VERSION);

			wp_enqueue_style('pricetable-wp-icon',  plugins_url( 'css/pricetable-wp.icon.css', __FILE__), array(), PRICETABLE_WP_VERSION);
			wp_enqueue_style('pricetable-wp-fontawe-icon',  plugins_url( 'css/fontawesome-iconpicker.css', __FILE__), array(), PRICETABLE_WP_VERSION);


			//color-picker css 
			wp_enqueue_style( 'wp-color-picker' );
		}
	}
	
	// The light weight CSS for changing the icon
	if(@$_GET['post_type'] == 'pricetable-wp'){
		wp_enqueue_style('pricetable-wp-icon',  plugins_url( 'css/pricetable-wp.icon.css', __FILE__), array(), PRICETABLE_WP_VERSION);
	}
	
	if($page == 'pricetable_wp_page_pricetable-wp-welcome'){
		// Add the welcome CSS
		wp_enqueue_style('pricetable-wp-admin',  plugins_url( 'css/welcome.css', __FILE__), array(), PRICETABLE_WP_VERSION);
	}
}
add_action('admin_enqueue_scripts', 'siteorigin_pricetable_wp_admin_scripts');

/**
 * Metaboxes because we're boss
 * 
 * @action add_meta_boxes
 */
function siteorigin_pricetable_wp_meta_boxes(){
	add_meta_box('pricetable-wp', __('Price Table Design Template', 'pricetable-wp'), 'siteorigin_pricetable_wp_render_metabox', 'pricetable-wp', 'normal', 'high');
	add_meta_box('pricetable-wp-shortcode', __('Price Table Shortcode', 'pricetable-wp'), 'siteorigin_pricetable_wp_render_metabox_shortcode', 'pricetable-wp', 'side', 'low');

	add_meta_box('pricetable-wp-sidebar', __('Price Table Sidebar Settings', 'pricetable-wp'), 'siteorigin_pricetable_wp_render_metabox_sidebar', 'pricetable-wp', 'side', 'low');
}
add_action( 'add_meta_boxes', 'siteorigin_pricetable_wp_meta_boxes' );

/**
 * Render the price table building interface
 * 
 * @param $post
 * @param $metabox
 */
function siteorigin_pricetable_wp_render_metabox($post, $metabox){
	wp_nonce_field( plugin_basename( __FILE__ ), 'siteorigin_pricetable_wp_nonce' );
	
	$table = get_post_meta($post->ID, 'nk_price_table', true);
	if(empty($table)) $table = array();
	
	include(dirname(__FILE__).'/template/pricetable-wp.build.phtml');
}

/**
 * Render the shortcode metabox
 * @param $post
 * @param $metabox
 */
function siteorigin_pricetable_wp_render_metabox_shortcode($post, $metabox){
	?>
		<code>[nk_price_table id=<?php print $post->ID ?>]</code> <br>
		<br>
		<small class="description"><?php _e('Use this shortcode on any Page/Post to display Price table.', 'pricetable-wp') ?></small>


	<?php
}

function siteorigin_pricetable_wp_render_metabox_sidebar($post, $metabox){
			
    wp_nonce_field( plugin_basename( __FILE__ ), 'siteorigin_pricetable_wp_sidebar_nonce' );
	
	$table = get_post_meta($post->ID, 'nk_price_table', true);
	if(empty($table)) $table = array();
	
	include(dirname(__FILE__).'/template/pricetable-wp.settings.phtml');
	
}

/**
 * Save the price table
 * @param $post_id
 * @return
 * 
 * @action save_post
 */
if ( !function_exists( 'siteorigin_pricetable_wp_save' ) ) :
	function siteorigin_pricetable_wp_save($post_id) {
		// Authorization, verification this is my vocation 
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( !wp_verify_nonce( @$_POST['siteorigin_pricetable_wp_nonce'], plugin_basename( __FILE__ ) ) ) return;
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
		
		// Create the price table from the post variables
		$table = array();
		foreach($_POST as $name => $val){
			if(substr($name,0,6) == 'price_'){
				$parts = explode('_', $name);
				
				$i = intval($parts[1]);
				if(@$parts[2] == 'feature'){
					// Adding a feature
					$fi = intval($parts[3]);
					$fn = $parts[4];
					
					if(empty($table[$i]['features'])) $table[$i]['features'] = array();
					$table[$i]['features'][$fi][$fn] = $val;
				}
				elseif(isset($parts[2])){
					// Adding a field
					$table[$i][$parts[2]] = $val;
				}
			}
		}
		
		// Clean up the features
		foreach($table as $i => $col){
			if(empty($col['features'])) continue;
			
			foreach($col['features'] as $fi => $feature){
				if(empty($feature['title']) && empty($feature['sub']) && empty($feature['description'])){
					unset($table[$i]['features'][$fi]);
				}
			}
			$table[$i]['features'] = array_values($table[$i]['features']);
		}
		
		if(isset($_POST['price_recommend'])){
			$table[intval($_POST['price_recommend'])]['featured'] = 'true';
		}
		
		$table = array_values($table);
		
		update_post_meta($post_id,'nk_price_table', $table);
	}
	add_action( 'save_post', 'siteorigin_pricetable_wp_save' );
endif;

if ( !function_exists( 'pricetable_wp_meta_options_setting_save' ) ) :
	function pricetable_wp_meta_options_setting_save( $post_id ) {		
		// Authorization, verification this is my vocation 	
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( !wp_verify_nonce( @$_POST['siteorigin_pricetable_wp_sidebar_nonce'], plugin_basename( __FILE__ ) ) ) return;
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
		$table = array();
		if ( !empty( $_POST['box_layout'] ) ) 	{ 	$table['box_layout'] 	= sanitize_text_field( $_POST['box_layout'] ) ; }
		if ( !empty( $_POST['title_clr'] ) ) 	{ 	$table['title_clr'] 	= sanitize_text_field( $_POST['title_clr'] ) ; 	}
		if ( !empty( $_POST['price_clr'] ) ) 	{ 	$table['price_clr'] 	= sanitize_text_field( $_POST['price_clr'] ) ; 	}
		if ( !empty( $_POST['icon_clr'] ) ) 	{ 	$table['icon_clr'] 		= sanitize_text_field( $_POST['icon_clr'] ) ; 	}
		if ( !empty( $_POST['ftr_clr'] ) ) 		{ 	$table['ftr_clr'] 		= sanitize_text_field( $_POST['ftr_clr'] ) ; 	}
		if ( !empty( $_POST['ftr_bgclr'] ) ) 	{ 	$table['ftr_bgclr'] 	= sanitize_text_field( $_POST['ftr_bgclr'] ) ; 	}
		if ( !empty( $_POST['title_size'] ) ) 	{ 	$table['title_size'] 	= sanitize_text_field( $_POST['title_size'] ) ; }
		if ( !empty( $_POST['title_font'] ) ) 	{ 	$table['title_font'] 	= sanitize_text_field( $_POST['title_font'] ) ; }
		if ( !empty( $_POST['price_size'] ) ) 	{ 	$table['price_size'] 	= sanitize_text_field( $_POST['price_size'] ) ; }
		if ( !empty( $_POST['icon_size'] ) ) 	{ 	$table['icon_size'] 	= sanitize_text_field( $_POST['icon_size'] ) ; 	}  
		if ( !empty($_POST[ 'ftr_size'] ) ) 	{ 	$table['ftr_size'] 		= sanitize_text_field( $_POST[ 'ftr_size'] ) ; 	}
		update_post_meta($post_id,'pricetable_wp_setting', $table);		
	}
	add_action( 'save_post', 'pricetable_wp_meta_options_setting_save' );
endif;


/**
 * The price table shortcode.
 * @param array $atts
 * @return string
 * 
 * 
 */
function siteorigin_pricetable_wp_shortcode($atts = array()) {
	global $post, $pricetable_wp_displayed;
	
	$pricetable_wp_displayed = true;
	
	extract( shortcode_atts( array(
		'id' => null,
		'width' => 100,
	), $atts ) );
	
	if($id == null) $id = $post->ID;
	
	$table = get_post_meta($id , 'nk_price_table', true);
	if(empty($table)) $table = array();
	
	// Set all the classes
	$featured_index = null;
	foreach($table as $i => $column) {
		$table[$i]['classes'] = array('pricetable-wp-column');
		$table[$i]['classes'][] = (@$table[$i]['featured'] === 'true') ? 'pricetable-wp-featured' : 'pricetable-wp-standard';
		
		if(@$table[$i]['featured'] == 'true') $featured_index = $i;
		if(@$table[$i+1]['featured'] == 'true') $table[$i]['classes'][] = 'pricetable-wp-before-featured';
		if(@$table[$i-1]['featured'] == 'true') $table[$i]['classes'][] = 'pricetable-wp-after-featured';
	}
	$table[0]['classes'][] = 'pricetable-wp-first';
	$table[count($table)-1]['classes'][] = 'pricetable-wp-last';
	
	// Calculate the widths
	$width_total = 0;
	foreach($table as $i => $column){
		if(@$column['featured'] === 'true') $width_total += PRICETABLE_WP_FEATURED_WEIGHT;
		else $width_total++;
	}
	$width_sum = 0;
	foreach($table as $i => $column){
		if(@$column['featured'] === 'true'){
			// The featured column takes any width left over after assigning to the normal columns
			$table[$i]['width'] = 100 - (floor(100/$width_total) * ($width_total-PRICETABLE_WP_FEATURED_WEIGHT));
		}
		else{
			$table[$i]['width'] = floor(100/$width_total);
		}
		$width_sum += $table[$i]['width'];
	}
	
	// Create fillers
	if(!empty($table[0]['features'])){
		for($i = 0; $i < count($table[0]['features']); $i++){
			$has_title = false;
			$has_sub = false;
			
			foreach($table as $column){
				$has_title = ($has_title || !empty($column['features'][$i]['title']));
				$has_sub = ($has_sub || !empty($column['features'][$i]['sub']));
			}
			
			foreach($table as $j => $column){
				if($has_title && empty($table[$j]['features'][$i]['title'])) $table[$j]['features'][$i]['title'] = '';
				if($has_sub && empty($table[$j]['features'][$i]['sub'])) $table[$j]['features'][$i]['sub'] = '';
			}
		}
	}
	
	// Find the best pricetable-wp file to use
	if(file_exists(get_stylesheet_directory().'/pricetable-wp.php')) $template = get_stylesheet_directory().'/pricetable-wp.php';
	elseif(file_exists(get_template_directory().'/pricetable-wp.php')) $template = get_template_directory().'/pricetable-wp.php'; 
	else $template = dirname(__FILE__).'/template/pricetable-wp.phtml';
	
	// Render the pricetable-wp
	ob_start();
	include($template);
	$pricetable_wp = ob_get_clean();
	
	if($width != 100) $pricetable_wp = '<div style="width:'.$width.'%; margin: 0 auto;">'.$pricetable_wp.'</div>';
	
	$post->pricetable_wp_inserted = true;
	
	return $pricetable_wp;
}
add_shortcode( 'nk_price_table', 'siteorigin_pricetable_wp_shortcode' );

/**
 * Add the pricetable-wp to the content.
 * 
 * @param $the_content
 * @return string
 * 
 * @filter the_content
 */
function siteorigin_pricetable_wp_the_content_filter($the_content){
	global $post;
	
	if(is_single() && $post->post_type == 'pricetable-wp' && empty($post->pricetable_wp_inserted)){
		$the_content = siteorigin_pricetable_wp_shortcode().$the_content;
	}
	return $the_content;
}
// Filter the content after WordPress has had a chance to do shortcodes (priority 10)
add_filter('the_content', 'siteorigin_pricetable_wp_the_content_filter',11);


/**
 * Render the welcome screen
 */
function siteorigin_pricetable_wp_render_welcome(){
	add_option('siteorigin_pricetable_wp_welcome', true, null, 'no');
	
	$info = get_plugin_data(__FILE__);
	
	include(dirname(__FILE__).'/template/welcome.phtml');
}

/**
 * Add the welcome page to the admin menu
 */
function siteorigin_pricetable_wp_add_welcome(){
	add_submenu_page(
		'edit.php?post_type=pricetable-wp',
		__('Thanks for Installing Price Table', 'pricetable-wp'),
		__('Welcome', 'pricetable-wp'),
		'manage_options',
		'pricetable-wp-welcome',
		'siteorigin_pricetable_wp_render_welcome'
	);
}
add_action('admin_menu', 'siteorigin_pricetable_wp_add_welcome');