<?php
add_shortcode( 'CLI_PARTNER', 'client_partner_showcase_ShortCode' );
function client_partner_showcase_ShortCode( $Id ) {
	ob_start();	
	if(!isset($Id['id'])) 
	 {
		$NKCPS_CLIENT_ID = "";
	 } 
	else 
	{
		$NKCPS_CLIENT_ID = $Id['id'];
	}
	require("content.php"); 
	wp_reset_query();
    return ob_get_clean();
}
?>