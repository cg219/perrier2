<?php
add_action( 'init', 'create_post_taxonomies', 0 );

function create_post_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Display Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Display Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Display Categories' ),
		'all_items' => __( 'All Display Categories' ),
		'parent_item' => __( 'Parent Display Category' ),
		'parent_item_colon' => __( 'Display Category:' ),
		'edit_item' => __( 'Edit Display Category' ),
		'update_item' => __( 'Update Display Category' ),
		'add_new_item' => __( 'Add New Display Category' ),
		'new_item_name' => __( 'New Display Category' ),
	); 	

	register_taxonomy( 'primary_category', array( 'post' ), array(
		'hierarchical' => true,
    	'label' => 'Display Category',
    	'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'cats', "with_front" => false ),
	));

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Types', 'taxonomy general name' ),
		'singular_name' => _x( 'Type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Types' ),
		'all_items' => __( 'All Types' ),
		'parent_item' => __( 'Parent Type' ),
		'parent_item_colon' => __( 'Type:' ),
		'edit_item' => __( 'Edit Type' ),
		'update_item' => __( 'Update Type' ),
		'add_new_item' => __( 'Add New Type' ),
		'new_item_name' => __( 'New Types' ),
	); 	

	register_taxonomy( 'type', array( 'post' ), array(
		'hierarchical' => true,
    	'label' => 'Type',
    	'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'types', 'with_front' => FALSE ),
	));

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Special Post Type', 'taxonomy general name' ),
		'singular_name' => _x( 'Special Post Type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Special Post Types' ),
		'all_items' => __( 'All Special Post Types' ),
		'parent_item' => __( 'Parent Special Post Type' ),
		'parent_item_colon' => __( 'Special Post Type:' ),
		'edit_item' => __( 'Edit Special Post Type' ),
		'update_item' => __( 'Update Special Post Type' ),
		'add_new_item' => __( 'Add New Special Post Type' ),
		'new_item_name' => __( 'New Special Post Types' ),
	); 	

	register_taxonomy( 'special-post-type', array( 'post' ), array(
		'hierarchical' => true,
    	'label' => 'Special Post Type',
    	'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'special', 'with_front' => FALSE ),
	));
}

