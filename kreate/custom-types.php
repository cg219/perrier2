<?php

add_action( 'init', 'register_hotspots_kreate' );
function register_hotspots_kreate() {

    $labels = array( 
        'name' => _x( 'Hotspots', 'hotspots' ),
        'singular_name' => _x( 'hotspot', 'hotspot' ),
        'add_new' => _x( 'Add New', 'hotspot' ),
        'add_new_item' => _x( 'Add New Hotspot', 'hotspot' ),
        'edit_item' => _x( 'Edit Hotspot', 'hotspot' ),
        'new_item' => _x( 'New hotspot', 'hotspot' ),
        'view_item' => _x( 'View Hotspot', 'hotspot' ),
        'search_items' => _x( 'Search Hotspot', 'hotspot' ),
        'not_found' => _x( 'No hotspots found', 'hotspot' ),
        'not_found_in_trash' => _x( 'No hotspots found in Trash', 'hotspot' ),
        'parent_item_colon' => _x( 'Parent hotspot:', 'hotspot' ),
        'menu_name' => _x( 'Hotspots', 'hotspots' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Hotspots',
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug'=> 'hotspots', 'with_front' => FALSE),
        'capability_type' => 'post'
        );

    register_post_type( 'hotspot', $args );
}

add_action( 'init', 'register_recipes_kreate' );
function register_recipes_kreate() {

    $labels = array( 
        'name' => _x( 'Recipes', 'recipes' ),
        'singular_name' => _x( 'recipe', 'recipe' ),
        'add_new' => _x( 'Add New', 'recipe' ),
        'add_new_item' => _x( 'Add New Recipe', 'recipe' ),
        'edit_item' => _x( 'Edit Recipe', 'recipe' ),
        'new_item' => _x( 'New Recipe', 'recipe' ),
        'view_item' => _x( 'View Recipe', 'recipe' ),
        'search_items' => _x( 'Search Recipe', 'recipe' ),
        'not_found' => _x( 'No recipes found', 'recipe' ),
        'not_found_in_trash' => _x( 'No recipes found in Trash', 'recipe' ),
        'parent_item_colon' => _x( 'Parent recipe:', 'recipe' ),
        'menu_name' => _x( 'Recipes', 'recipes' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Recipe',
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug'=> 'recipes', 'with_front' => FALSE),
        'capability_type' => 'post'
        );

    register_post_type( 'recipe', $args );
}

add_action( 'init', 'register_luminaries_kreate' );
function register_luminaries_kreate() {

    $labels = array( 
        'name' => _x( 'Luminary', 'luminaries' ),
        'singular_name' => _x( 'luminary', 'luminary' ),
        'add_new' => _x( 'Add New', 'luminary' ),
        'add_new_item' => _x( 'Add New Luminary', 'luminary' ),
        'edit_item' => _x( 'Edit Luminary', 'luminary' ),
        'new_item' => _x( 'New Luminary', 'luminary' ),
        'view_item' => _x( 'View Luminary', 'luminary' ),
        'search_items' => _x( 'Search Luminary', 'luminary' ),
        'not_found' => _x( 'No luminaries found', 'luminary' ),
        'not_found_in_trash' => _x( 'No luminaries found in Trash', 'luminary' ),
        'parent_item_colon' => _x( 'Parent luminary:', 'luminary' ),
        'menu_name' => _x( 'Luminaries', 'luminaries' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Luminary',
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug'=> 'luminaries', 'with_front' => FALSE),
        'capability_type' => 'post'
        );

    register_post_type( 'luminary', $args );
}
?>