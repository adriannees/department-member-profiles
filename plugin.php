<?php
/*
Plugin Name: 	Department Member Profiles
Plugin URI: 

@author		Adrianne Stone 
@author URI: https://adrianneelayne.com
@version    1.3

Description: Add faculty, student, and staff profiles and directories with ease!

*/
/* Start Adding Functions Below this Line */

//* Add a custom post type 
//* Reference: <http://www.smashingmagazine.com/2012/11/complete-guide-custom-post-types/>  
//* Reference: <http://www.carriedils.com/genesis-2-0-archive-settings-custom-post-types/>
//* Reference: <http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress>

//* Add page templates to plugin
//* Reference: <http://www.wpexplorer.com/wordpress-page-templates-plugin/>

//* Create Custom Post Types
add_action( 'init', 'department_member_post_type' );

function department_member_post_type() {
  // Faculty Biography Pages custom post type
	register_post_type( 'people',
		array(
			'labels' => array(
				'name' 				=> __( 'Dept Members' ),
				'singular_name'		=> __( 'Department Member' ),
				'add_new' 			=> __( 'Add Member' ),
				'add_new_item' 		=> __( 'Add New Department Member' ), 
				'edit_item'			=> __( 'Edit Department Member' ),
				'new_item'           => __( 'New Department Member' ),
				'all_items'          => __( 'All Department Members' ),
				'view_item'          => __( 'View Department Member' ),
				'search_items'       => __( 'Search Department Members' ),
				'not_found'          => __( 'No Department Member Found' ),
				'parent_item_colon'  => '',
			),
			'has_archive' => true,
            'taxonomies' => array( 'category' ), //added categories back to allow for "featured physiologist" widget selection
			'public' => true,
			'show_ui' => true, // defaults to true so don't have to include
			'show_in_menu' => true, // defaults to true so don't have to include
			'menu_position' => 5, 
			'menu_icon' => 'dashicons-businessman',
			'rewrite' => array( 'slug' => 'department-member' ),
			'supports' => array( 'title', 'editor', 'thumbnail'),
		)
	);
}

// Allow to sort Department Members by Research Interest Area 

add_action( 'init', 'create_faculty_research_taxonomy', 0 );

function create_faculty_research_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Research Areas', 'taxonomy general name' ),
    'singular_name' => _x( 'Research Area', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Research Areas' ),
    'all_items' => __( 'All Research Areas' ),
    'edit_item' => __( 'Edit Research Areas' ), 
    'update_item' => __( 'Update Research Area' ),
    'add_new_item' => __( 'Add New Research Area' ),
    'new_item_name' => __( 'New Research Area' ),
    'menu_name' => __( 'Research Areas' ),
    'separate_items_with_commas' => __('Separate areas with commas'),
    'choose_from_most_used' => __('Choose from most common areas'),
    'not_found' => __('No Research Areas Found')
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('research_areas','people',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'research-area' ),
  ));
}


/* Stop Adding Functions Below this Line */
?>