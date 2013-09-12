<?php
	add_action( 'init', 'create_post_taxonomies', 0 );

	function create_post_taxonomies() {

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

		$labels = array(
			'name' => _x( 'Country', 'taxonomy general name' ),
			'singular_name' => _x( 'Country', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Countries' ),
			'all_items' => __( 'All Countries' ),
			'parent_item' => __( 'Parent Country' ),
			'parent_item_colon' => __( 'Country:' ),
			'edit_item' => __( 'Edit Country' ),
			'update_item' => __( 'Update Country' ),
			'add_new_item' => __( 'Add New Country' ),
			'new_item_name' => __( 'New Countries' ),
		); 	

		register_taxonomy( 'country', array( 'post', "hotspot", "luminary", "recipe" ), array(
			'hierarchical' => true,
	    	'label' => 'Country',
	    	'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'country', 'with_front' => FALSE ),
		));

		$labels = array(
			'name' => _x( 'City', 'taxonomy general name' ),
			'singular_name' => _x( 'City', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Cities' ),
			'all_items' => __( 'All Cities' ),
			'parent_item' => __( 'Parent City' ),
			'parent_item_colon' => __( 'City:' ),
			'edit_item' => __( 'Edit City' ),
			'update_item' => __( 'Update City' ),
			'add_new_item' => __( 'Add New City' ),
			'new_item_name' => __( 'New Cities' ),
		); 	

		register_taxonomy( 'city', array( 'post', "hotspot", "luminary", "recipe" ), array(
			'hierarchical' => true,
	    	'label' => 'City',
	    	'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'city', 'with_front' => FALSE ),
		));
	}

?>