<?php

//wp_enqueue_script( "datepicker", get_bloginfo( 'template_url' ) . "/javascripts/jquery.datePicker.js");
//wp_enqueue_script( "datejs", get_bloginfo( 'template_url' ) . "/javascripts/admin-date.js", array("datepicker"));

// DEFINE('MC_API',      'c341865560b3e73e809cf2a0529badf1-us2');
// DEFINE('MC_LIST_ID',  '35e2bf0c63');
// DEFINE('MC_MIX_ID',   '17e6b0866d');

// require("functions/MCAPI.class.php");

// require("functions/functions-user-image.php");
require("functions/functions-user-custom-fields.php");

// -----------------------------------------------------------------------------
// CUSTOM FIELDS ---------------------------------------------------------------
// -----------------------------------------------------------------------------
require("functions/functions-custom-fields.php");

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

  // add_theme_support( 'infinite-scroll', array(
  //     'container'  => 'main',
  //     "render" => "get_new_kreate_posts"
  // ) );
}

function get_new_kreate_posts(){

  get_template_part("loop");
}

function ajax_newsletter_main_subscribe()
{
  $listId = MC_LIST_ID;
  $listId_mix = MC_MIX_ID;
  $api = new MCAPI(MC_API);

  $full_name      = isset($_POST['full_name'])      ? $_POST['full_name'] : NULL;
  $email_address  = isset($_POST['email_address'])  ? $_POST['email_address'] : NULL;
  $age            = isset($_POST['age'])            ? $_POST['age'] : NULL;
  $city           = isset($_POST['full_name'])      ? $_POST['city'] : NULL;
  $state          = isset($_POST['state'])          ? $_POST['state'] : NULL;
  $country        = isset($_POST['country'])        ? $_POST['country'] : NULL;
  //$language       = isset($_POST['language'])       ? $_POST['language'] : NULL;
  //                      'LANGUAGE' => $language,

  if ($full_name != NULL && $email_address != null && $city != null && $state != null && $country != null) {
    $merge_vars = array('FULLNAME'=> $full_name,
                        'AGE' => $age,
                        'CITY' => $city,
                        'STATE' => $state,
                        'COUNTRY' => $country,
                        );
  if($_POST['list_main']){
    $retval = $api->listSubscribe( $listId, $email_address, $merge_vars );
  }
  if($_POST['list_mix']){
    $retval = $api->listSubscribe( $listId_mix, $email_address, $merge_vars );
  }
    if ($api->errorCode){
      echo "Unable to load listSubscribe()!\n";
      echo "\tCode=".$api->errorCode."\n";
      echo "\tMsg=".$api->errorMessage."\n";
    } else {
        echo "Subscribed - look for the confirmation email!\n";
    }
  } else {
    echo "Data missing!";
  }

  exit();
}
