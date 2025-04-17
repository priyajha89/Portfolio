<?php
/**
 * Adds  widget.
 */
class nkcps_client_partner_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'nkcps_client_partner_widget', // Base ID
            'Client Partner Widget', // Name
            array( 'description' => __( 'Display Your Client in widget area.', 'client-partner-showcase' ), ) // Args
        );
	}

    /**
     * Front-end display of widget.
     */
    public function widget( $args, $instance ) {
        $Title    	=   apply_filters( 'nkcps_client_partner_widget_title', $instance['Title'] );
		echo $args['before_widget'];
		
		 $nkcps_client_partner	=   apply_filters( 'nkcps_client_partner_widget_shortcode', $instance['Shortcode'] ); 

		if(is_numeric($nkcps_client_partner)) {
			if ( ! empty( $instance['Title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['Title'] ). $args['after_title'];
			}
			echo do_shortcode( '[CLI_PARTNER id='.$nkcps_client_partner.']' );
		} else {
			echo "<p>Sorry! No Client Shortcode Found.</p>";
		}
		echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        if ( isset( $instance[ 'Title' ] ) ) {
            $Title = $instance[ 'Title' ];
        } else {
            $Title = "Client Partner Shortcode";
        }

        if ( isset( $instance[ 'Shortcode' ] ) ) {
            $Shortcode = $instance[ 'Shortcode' ];
        } else {
            $Shortcode = "Select Any Client";
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php esc_html_e( 'Widget Title' , 'client-partner-showcase'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'Title' ); ?>" name="<?php echo $this->get_field_name( 'Title' ); ?>" type="text" value="<?php echo esc_attr( $Title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'Shortcode' ); ?>"><?php esc_html_e( 'Select Client' , 'client-partner-showcase'); ?> (Required)</label>
			<?php
			/**
			 * Get All Client Shortcode Custom Post Type
			 */
			$nkcps_client_cpt = "client_partner";
			global $All_nkcps_Clish;
			$All_nkcps_Clish = array('post_type' => $nkcps_client_cpt, 'orderby' => 'ASC', 'post_status' => 'publish');
			$All_nkcps_Clish = new WP_Query( $All_nkcps_Clish );		
			?>
			<select id="<?php echo $this->get_field_id( 'Shortcode' ); ?>" name="<?php echo $this->get_field_name( 'Shortcode' ); ?>" style="width: 100%;">
				<option value="Select Any Client" <?php if($Shortcode == "Select Any Client") echo 'selected="selected"'; ?>>Select Any Client</option>
				<?php
				if( $All_nkcps_Clish->have_posts() ) {	 ?>	
				<?php while ( $All_nkcps_Clish->have_posts() ) : $All_nkcps_Clish->the_post();	
					$PostId = get_the_ID(); 
					$PostTitle = get_the_title($PostId);
				?>
				<option value="<?php echo $PostId; ?>" <?php if($Shortcode == $PostId) echo 'selected="selected"'; ?>><?php if($PostTitle) echo $PostTitle; else esc_html_e("No Title", 'client-partner-showcase'); ?></option>
				<?php endwhile; ?>
				<?php
			}  else  { 
				echo "<option> esc_html_e('Sorry! No Client Shortcode Found.', 'client-partner-showcase'); </option>";
			}
			?>
			</select>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['Title'] = ( ! empty( $new_instance['Title'] ) ) ? strip_tags( $new_instance['Title'] ) : '';
        $instance['Shortcode'] = ( ! empty( $new_instance['Shortcode'] ) ) ? strip_tags( $new_instance['Shortcode'] ) : 'Select Any Client';
        
        return $instance;
    }
} // end of  Widget Class

// Register Widget
function nkcps_client_partner_Widget() {
    register_widget( 'nkcps_client_partner_Widget' );
}
add_action( 'widgets_init', 'nkcps_client_partner_Widget' );
?>