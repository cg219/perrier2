<?php

//wp_enqueue_script( "datepicker", get_bloginfo( 'template_url' ) . "/javascripts/jquery.datePicker.js");
//wp_enqueue_script( "datejs", get_bloginfo( 'template_url' ) . "/javascripts/admin-date.js", array("datepicker"));

// DEFINE('MC_API',      'c341865560b3e73e809cf2a0529badf1-us2');
// DEFINE('MC_LIST_ID',  '35e2bf0c63');
// DEFINE('MC_MIX_ID',   '17e6b0866d');

// require("functions/MCAPI.class.php");

// require("functions/functions-user-image.php");

// -----------------------------------------------------------------------------
// CUSTOM FIELDS ---------------------------------------------------------------
// -----------------------------------------------------------------------------


// -----------------------------------------------------------------------------
// POST TYPES ------------------------------------------------------------------
// -----------------------------------------------------------------------------
// require("functions/functions-post-types.php");


// -----------------------------------------------------------------------------
// SHORT CODES -----------------------------------------------------------------
// -----------------------------------------------------------------------------
require("functions/functions-short-codes.php");

// -----------------------------------------------------------------------------
// TAXONOMIES ------------------------------------------------------------------
// -----------------------------------------------------------------------------
// require("functions/functions-taxonomies.php");

// -----------------------------------------------------------------------------
// IMKREATIVE FUNCTIONS --------------------------------------------------------
// -----------------------------------------------------------------------------
require("kreate/custom-types.php");
require("kreate/custom-fields.php");
require("kreate/custom-admin2.php");
require("kreate/custom-taxes.php");
require("kreate/custom-functions.php");
require("kreate/custom-shortcodes.php");


require("functions/functions-user-custom-fields.php");
require("functions/functions-custom-fields.php");

// -----------------------------------------------------------------------------
// CUSTOM BUILD FUNCTIONS ------------------------------------------------------
// -----------------------------------------------------------------------------
// require("functions/functions-section-calls.php");

if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );

  set_post_thumbnail_size( 225, 150 );
  add_image_size( "thumb", 225, 150, TRUE);
  add_image_size( "featured", 720, 480, TRUE);
  add_image_size( "2-up", 345, 230, TRUE);
  add_image_size( "post-gallery", 720, 480, TRUE);

  add_theme_support( 'menus' );
  register_nav_menu( "location-menu", "Locations Menu");
  register_nav_menu( "interests-menu", "Interests Menu");

  // add_theme_support( 'infinite-scroll', array(
  //     'container'  => 'main',
  //     "render" => "get_new_kreate_posts"
  // ) );
}

if( is_admin() ){
  add_action("admin_head", "add_admin_css");
}

if( !is_admin() ){
  add_action("wp_head", "add_admin_css");
}

function add_admin_css(){
  wp_enqueue_style("admin_style", get_template_directory_uri() . "/css/admin-options.css");
}

function get_new_kreate_posts(){

  get_template_part("loop");
}
