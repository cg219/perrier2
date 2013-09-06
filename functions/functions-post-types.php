<?

add_action( 'init', 'register_mbl_staff' );
function register_mbl_staff() {

    $labels = array( 
        'name' => _x( 'Staff', 'staff' ),
        'singular_name' => _x( 'staff', 'staff' ),
        'add_new' => _x( 'Add New', 'staff' ),
        'add_new_item' => _x( 'Add New staff', 'staff' ),
        'edit_item' => _x( 'Edit staff', 'staff' ),
        'new_item' => _x( 'New staff', 'staff' ),
        'view_item' => _x( 'View staff', 'staff' ),
        'search_items' => _x( 'Search staff', 'staff' ),
        'not_found' => _x( 'No staff found', 'staff' ),
        'not_found_in_trash' => _x( 'No staff found in Trash', 'staff' ),
        'parent_item_colon' => _x( 'Parent staff:', 'staff' ),
        'menu_name' => _x( 'Staff', 'staff' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Staff',
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies' => array( ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'staff', $args );
}
