<?php
class nkcps_client_partner {
	private static $instance;
    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
	private function __construct() {
		
		add_action('admin_enqueue_scripts', array(&$this, 'nkcps_client_partner_admin_scripts'));
        if (is_admin()) {
			add_action('init', array(&$this, 'client_partner_reg_cpt'), 1);
			add_action('add_meta_boxes', array(&$this, 'nkcps_client_partner_meta_boxes_group'));
			add_action('admin_init', array(&$this, 'nkcps_client_partner_meta_boxes_group'), 1);
			add_action('save_post', array(&$this, 'add_client_partner_meta_box_save'), 9, 1);
			
			add_action('save_post', array(&$this, 'client_partner_settings_meta_box_save'), 9, 1);
			
		}
    }
	// admin scripts
	public function nkcps_client_partner_admin_scripts(){
		if(get_post_type()=="client_partner"){
			require_once('admin-script.php');
		}
	}
	public function client_partner_reg_cpt(){
		require_once('reg-cpt.php');
		add_filter( 'manage_edit-client_partner_columns', array(&$this, 'client_partner_columns' )) ;
		add_action( 'manage_client_partner_posts_custom_column', array(&$this, 'client_partner_manage_columns' ), 10, 2 );
		
	}
	function client_partner_columns( $columns ){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Client' ),
            'shortcode' => __( 'Client Pro Shortcode' ),
            'date' => __( 'Date' )
        );
        return $columns;
    }
    function client_partner_manage_columns( $column, $post_id ){
        global $post;
        switch( $column ) {
          case 'shortcode' :
            echo '<input type="text" value="[CLI_PARTNER id='.$post_id.']" readonly="readonly" />';
            break;
          default :
            break;
        }
    }
	public function nkcps_client_partner_meta_boxes_group(){
	
		add_meta_box('client_partner_add', __('Add Box', 'client-partner-showcase'), array(&$this, 'nkcps_add_client_partner_meta_box_function'), 'client_partner', 'normal', 'low' );
		add_meta_box ('client_shortcode_styles', __('Client Shortcode', 'client-partner-showcase'), array(&$this, 'nkcps_client_partner_showcase_ShortCode_function'), 'client_partner', 'normal', 'low');
		add_meta_box('client_partner_setting', __('Client Partner Showcase Settings', 'client-partner-showcase'), array(&$this, 'nkcps_add_client_partner_setting_meta_box_function'), 'client_partner', 'side', 'low');
	}

	
	public function nkcps_add_client_partner_meta_box_function(){
		require_once('add-cli.php');
	}
	public function nkcps_client_partner_showcase_ShortCode_function(){
		require_once('get-shortcode-plus-css.php');
	}
	
	public function nkcps_add_client_partner_setting_meta_box_function($post){
		require_once('settings.php');
	}
	
	public function add_client_partner_meta_box_save($PostID){
		require('data-save/client-data-save.php');
	}
	
	public function client_partner_settings_meta_box_save($PostID){
		require('data-save/setting-save.php');
	}
}	
global $nkcps_client_partner;
$nkcps_client_partner = nkcps_client_partner::forge();
?>