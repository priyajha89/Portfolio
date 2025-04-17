<?php if ( ! defined( 'ABSPATH' ) ) exit;?>
<h3><?php esc_html_e("Client Partner Showcase Shortcode", 'client-partner-showcase');?></h3>
<p><?php esc_html_e("Use below shortcode on any Page/Post to publish your Client/Partner", 'client-partner-showcase');?></p>
<input readonly="readonly" type="text" value="<?php echo "[CLI_PARTNER id=".get_the_ID()."]"; ?>">
<?php
	$PostId = get_the_ID();
	$Settings = unserialize(get_post_meta( $PostId, 'client_partner_Settings', true));
?>