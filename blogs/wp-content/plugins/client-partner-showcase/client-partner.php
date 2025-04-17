<?php
/**
 * Plugin Name: Client Partner Showcase
 * Version: 1.9
 * Description: Client Partner Showcase Plugin will show your clients and partners on any wordpress page and posts .
 * Author: wpdiscover
 * Author URI: https://blogwpthemes.com/
 * Plugin URI: https://blogwpthemes.com/
 */
 
/* DEFINE PATHS */
define("nkcps_client_partner_directory_url", plugin_dir_url(__FILE__));
define("client-partner-showcase", "client-partner-showcase");

/**
 * PLUGIN Install
 */
require_once("ink/install/installation.php");
function nkcps_clientpartner_default_data() {
		
	$Settings_Array = serialize( array(
			
			"section_layout"					=> "3",
			"section_padding_top_bottom_size" 	=> "80",
			"section_padding_left_right_size" 	=> "70",
			"disp_logo_url_set" 		    	=> "yes"
			
		) );
	add_option('client_partner_default_Settings_new', $Settings_Array);
}
register_activation_hook( __FILE__, 'nkcps_clientpartner_default_data' );

/**
 * CPT Register
 */
require_once("ink/admin/menu.php");
/**
 * SHORTCODE
 */
require_once("template/shortcode.php");
 /**
WIDGET
*/
require_once("ink/widget/widget.php");

if(!function_exists('nkcps_hex2rgb_client_partner')) {
    function nkcps_hex2rgb_client_partner($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));                                                                                          
       }
       $rgb = array($r, $g, $b);
       return $rgb; // returns an array with the rgb values
    }
} 
?>