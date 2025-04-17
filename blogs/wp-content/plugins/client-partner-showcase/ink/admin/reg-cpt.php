
<?php
			$labels = array(
				'name'                => _x( 'Client Partner Showcase', 'Client Partner Showcase', 'client-partner-showcase' ),
				'singular_name'       => _x( 'Client Partner Showcase', 'Client Partner Showcase', 'client-partner-showcase' ),
				'menu_name'           => __( 'Client Partner Showcase', 'client-partner-showcase' ),
				'parent_item_colon'   => __( 'Parent Item:', 'client-partner-showcase' ),
				'all_items'           => __( 'All Client', 'client-partner-showcase' ),
				'view_item'           => __( 'View Client', 'client-partner-showcase' ),
				'add_new_item'        => __( 'Add New Client', 'client-partner-showcase' ),
				'add_new'             => __( 'Add New Client', 'client-partner-showcase' ),
				'edit_item'           => __( 'Edit Client', 'client-partner-showcase' ),
				'update_item'         => __( 'Update Client', 'client-partner-showcase' ),
				'search_items'        => __( 'Search Client', 'client-partner-showcase' ),
				'not_found'           => __( 'No Client Found', 'client-partner-showcase' ),
				'not_found_in_trash'  => __( 'No Client found in Trash', 'client-partner-showcase'),
			);
			$args = array(
				'label'               => __( 'Client Partner Showcase', 'client-partner-showcase' ),
				'description'         => __( 'Client Partner Showcase', 'client-partner-showcase' ),
				'labels'              => $labels,
				'supports'            => array( 'title', '', '', '', '', '', '', '', '', '', '', ),
				//'taxonomies'          => array( 'category', 'post_tag' ),
				'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => false,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-screenoptions',//dashicons-image-flip-horizontal//dashicons-slides//dashicons-screenoptions
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => false,
				'capability_type'     => 'page',
			);
			register_post_type( 'client_partner', $args );
?>