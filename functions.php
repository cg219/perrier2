<?php

//wp_enqueue_script( "datepicker", get_bloginfo( 'template_url' ) . "/javascripts/jquery.datePicker.js");
//wp_enqueue_script( "datejs", get_bloginfo( 'template_url' ) . "/javascripts/admin-date.js", array("datepicker"));

DEFINE('MC_API',      'c341865560b3e73e809cf2a0529badf1-us2');
DEFINE('MC_LIST_ID',  '35e2bf0c63');
DEFINE('MC_MIX_ID',   '17e6b0866d');

require("functions/MCAPI.class.php");

require("functions/functions-user-image.php");
require("functions/functions-user-custom-fields.php");

// -----------------------------------------------------------------------------
// CUSTOM FIELDS ---------------------------------------------------------------
// -----------------------------------------------------------------------------
// require("functions/functions-custom-fields.php");

// -----------------------------------------------------------------------------
// POST TYPES ------------------------------------------------------------------
// -----------------------------------------------------------------------------
require("functions/functions-post-types.php");


// -----------------------------------------------------------------------------
// SHORT CODES -----------------------------------------------------------------
// -----------------------------------------------------------------------------
require("functions/functions-short-codes.php");

// -----------------------------------------------------------------------------
// TAXONOMIES ------------------------------------------------------------------
// -----------------------------------------------------------------------------
require("functions/functions-taxonomies.php");

// -----------------------------------------------------------------------------
// IMKREATIVE FUNCTIONS --------------------------------------------------------
// -----------------------------------------------------------------------------
require("kreate/custom-types.php");
require("kreate/custom-fields.php");
require("kreate/custom-admin.php");
require("kreate/custom-functions.php");

// -----------------------------------------------------------------------------
// CUSTOM BUILD FUNCTIONS ------------------------------------------------------
// -----------------------------------------------------------------------------
require("functions/functions-section-calls.php");

if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );

  set_post_thumbnail_size( 226, 170 );
  add_image_size( 'post-large', 598, 335, TRUE );
  add_image_size( 'post-listing', 226, 170, TRUE );
  add_image_size( 'post-sidebar', 226, 115, TRUE );
  add_image_size( 'post-related', 102, 78,  TRUE );
  add_image_size( 'staff-large', 350, 196, TRUE );
  add_image_size( 'post-gallery', 102, 102,  TRUE );
  add_image_size( 'post-large-vertical', 598, 9999); //new image size for single gallery image pages, unlimited height no hard cropping.
  add_image_size( 'gallery-large', 598, 400, TRUE );
  //MJG new 3x2s
  add_image_size( 'featured-720x360', 720, 360, TRUE);
  add_image_size( 'thumb-48x48', 48, 48, TRUE);
  add_image_size( 'listing-226x151', 226, 151, TRUE);
  add_image_size( 'sidebar-180x120', 180, 120, TRUE);
  add_image_size( 'post-600x400', 600, 400, TRUE);

  add_theme_support( 'menus' );
  register_nav_menu( "location-menu", "Locations Menu");
}

add_action( 'wp_ajax_nopriv_ajax_newsletter_main_subscribe', 'ajax_newsletter_main_subscribe' );
add_action( 'wp_ajax_ajax_newsletter_main_subscribe', 'ajax_newsletter_main_subscribe' );

add_action( 'wp_ajax_nopriv_ajax_newsletter_main_subscribe', 'ajax_newsletter_mix_subscribe' );
add_action( 'wp_ajax_ajax_newsletter_main_subscribe', 'ajax_newsletter_mix_subscribe' );

add_action( 'wp_ajax_nopriv_ajax_calendar', 'ajax_calendar' );
add_action( 'wp_ajax_ajax_calendar', 'ajax_calendar' );

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

//function ajax_newsletter_mix_subscribe()
//{
//  $listId = MC_MIX_ID;
//  $api = new MCAPI(MC_API);
//
//  $full_name      = isset($_POST['full_name'])      ? $_POST['full_name'] : NULL;
//  $email_address  = isset($_POST['email_address'])  ? $_POST['email_address'] : NULL;
//  $age            = isset($_POST['age'])            ? $_POST['age'] : NULL;
//  $city           = isset($_POST['full_name'])      ? $_POST['city'] : NULL;
//  $state          = isset($_POST['state'])          ? $_POST['state'] : NULL;
//  $country        = isset($_POST['country'])        ? $_POST['country'] : NULL;
//  //$language       = isset($_POST['language'])       ? $_POST['language'] : NULL;
//  //                      'LANGUAGE' => $language,
//
//  if ($full_name != NULL && $email_address != null && $city != null && $state != null && $country != null) {
//    $merge_vars = array('FULLNAME'=> $full_name,
//                        'AGE' => $age,
//                        'CITY' => $city,
//                        'STATE' => $state,
//                        'COUNTRY' => $country,
//                        );
//
//    $retval = $api->listSubscribe( $listId, $email_address, $merge_vars );
//
//    if ($api->errorCode){
//      echo "Unable to load listSubscribe()!\n";
//      echo "\tCode=".$api->errorCode."\n";
//      echo "\tMsg=".$api->errorMessage."\n";
//    } else {
//        echo "Subscribed - look for the confirmation email!\n";
//    }
//  } else {
//    echo "Data missing!";
//  }
//
//  exit();
//}

function ajax_calendar()
{

  mbl_calendar();
  exit;

}

function mbl_get_primary_category($post_id, $seperator = ", ")
{
  $return = "";
  $list = get_the_terms( $post_id, 'primary_category', '', ', ', ' ' );
  if ($list) {
    foreach ($list as $category) {
      //rint_r($category);
      $return = $category->name;
    }
  }
  return $return;
}

function mbl_get_post_type($post_id, $seperator = ", ")
{
  $return = "";
  $list = get_the_terms( $post_id, 'type', '', ', ', ' ' );
  if ($list) {
    foreach ($list as $category) {
      //rint_r($category);
      $return = $category->name;
    }
  }
  return $return;
}


function mbl_get_post_type_slug($post_id, $seperator = ", ")
{
  $return = "";
  $list = get_the_terms( $post_id, 'type', '', ', ', ' ' );
  if ($list) {
    foreach ($list as $category) {
      //rint_r($category);
      $return = $category->slug;
    }
  }
  return $return;
}

function get_the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    return $thumbnail_image[0]->post_excerpt;
  }

  return "";
}


function mbl_post_pagination()
{
  global $pages, $numpages;

  if ($numpages > 1) { ?>
  <ul class="paginator">
    <?php if ($page > 1) { ?>
      <li class="prev"><?php print _wp_link_page($page-1) ?>Previous page</a></li>
    <?php } ?>
    <?php for($i=1; $i <= $numpages; $i++) {
        $link = _wp_link_page($i); ?>
      <li class="<?php if ($i == $page) { print "current"; } ?>"><?php print $link ?><?php print $i; ?></a></li>
    <?php } ?>
    <?php if ($page < $numpages) { ?>
      <li class="next"><?php print _wp_link_page($page+1) ?>Next page</a></li>
    <?php } ?>
</ul>
<?php }
}

//MJG Change the search url and fix pagination issue with POSTed search form
function search_url_rewrite_rule() {
  if ( is_search() && !empty($_GET['s'])) {
    wp_redirect(home_url("/search/") . urlencode(get_query_var('s')));
    exit();
  }
}
add_action('template_redirect', 'search_url_rewrite_rule');

function mbl_listing_pagination()
{
  global $query, $paged;
  ?>
  <ul class="paginator">
  <?php
    $query = $GLOBALS['wp_query'];
    $sizer = 2;
    $total_sizer = 5;

    $posts_per_page = intval( $query->get( 'posts_per_page' ) );
    $paged = max( 1, absint( $query->get( 'paged' ) ) );
    $total_pages = max( 1, absint( $query->max_num_pages ) );

    if ($total_pages < $total_sizer) {
      $start = 1;
      $end = $total_pages;
    } else if ($paged <= $total_sizer) {
      $start = 1;
      $end = $total_sizer;
    } else if ($paged > ($total_pages - $total_sizer)) {
      $start = $total_pages - $total_sizer + 1;
      $end = $total_pages;
    } else {
      $start = $paged - $sizer;
      if ($start < 1) {
        $start = 1;
      }

      $end = $paged + $sizer;
      if ($end > $total_pages) {
        $end = $total_pages;
      }
    }

    if ($paged != 1) { ?>
      <li class="prev"><a href="<?php print esc_url( get_pagenum_link( $paged-1) ) ?>/">Previous</a></li>
    <?php } ?>
    <?php if ($start != 1) { ?>
      <li>&hellip;</li>
    <?php
    }
    $loop = $start;
    while ($loop <= $end && $loop <= $total_pages) { ?>
      <li class="<?php if ($loop == $paged) { print "current"; } ?>">
        <?php print "<a href='" . esc_url( get_pagenum_link( $loop ) ) ."' class=''>$loop</a>"; ?>
      </li>
    <?php
      $loop ++;
    }
    if ($end != $total_pages) { ?>
      <li>&hellip;</li>
    <?php }
    if ($paged != $total_pages) { ?>
      <li class="next"><a href="<?php print esc_url( get_pagenum_link( $paged+1) ) ?>">More</a></li>
    <?php
    }
  ?>
</ul>
<?php
}

function mbl_ajax_pagination($ajax_page, $items_per_page, $ajax_query_total, $ajax_max_num_pages, $ajax_page_url)
{
  //global $ajax_query_results, $ajax_page, $ajax_query_total, $offset, $items_per_page, $ajax_page, ;
  // echo '$ajax_query_total: '.$ajax_query_total;
  // echo '$offset: '.$offset;
  // echo '$items_per_page: '.$items_per_page;
  // echo '$ajax_page: '.$ajax_page;
  // echo '$ajax_max_num_pages: '.$ajax_max_num_pages;
  ?>
  <?php
    $query = $GLOBALS['wp_query'];
    $sizer = 2;
    $total_sizer = 5;

    $posts_per_page = intval( $items_per_page );
    $paged = max( 1, absint( $ajax_page ) );
    $total_pages = max( 1, absint( $ajax_max_num_pages ) );

    if ($total_pages < $total_sizer) {
      $start = 1;
      $end = $total_pages;
    } else if ($paged <= $total_sizer) {
      $start = 1;
      $end = $total_sizer;
    } else if ($paged > ($total_pages - $total_sizer)) {
      $start = $total_pages - $total_sizer + 1;
      $end = $total_pages;
    } else {
      $start = $paged - $sizer;
      if ($start < 1) {
        $start = 1;
      }

      $end = $paged + $sizer;
      if ($end > $total_pages) {
        $end = $total_pages;
      }
    }?>

    <ul class="paginator" data-total-pages="<?php echo $total_pages; ?>">

    <?php if ($paged != 1) { ?>
      <li class="prev"><a href="<?php echo $ajax_page_url.'page/'.($paged-1).'/'; ?>/">Previous</a></li>
    <?php } ?>
    <?php if ($start != 1) { ?>
      <li>&hellip;</li>
    <?php
    }
    $loop = $start;
    while ($loop <= $end && $loop <= $total_pages) { 
      if($loop == 1){ $class = 'first';}else{ $class = ''; }
      ?>
      <li class="<?php echo $class; ?> <?php if ($loop == $paged) { print "current"; } ?> page-<?php echo $loop; ?> page-number">
        <?php print "<a href='" . $ajax_page_url .'page/'.($loop) ."/' class=''>$loop</a>"; ?>
      </li>
    <?php
      $loop ++;
    }
    if ($end != $total_pages) { ?>
      <li class="ellipses">&hellip;</li>
    <?php }
    if ($paged != $total_pages) { ?>
      <li class="next"><a href="<?php echo $ajax_page_url.'page/'.($paged+1).'/'; ?>">More</a></li>
    <?php
    }
  ?>
</ul>
<?php
}

function mbl_related_posts($post)
{
  $categories = "";
  $post_categories = wp_get_post_categories( $post->ID );
  $cats = array();
  foreach($post_categories as $c){
    $cat = get_category( $c );
    $cats[] = $cat->term_id;
  }
  $query = new WP_Query( array( 'post__not_in' => array($post->ID),'category__in' => $cats, 'posts_per_page' => 5 ) );
  return $query;
}


function mbl_count_events($date)
{
  global $wpdb;

  $querydetails = "
    SELECT count(*)
    FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
    WHERE wposts.ID = wpostmeta.post_id
    AND wpostmeta.meta_key = '_mbl_event_date'
    AND wpostmeta.meta_value != ''
    AND wposts.post_status = 'publish'
    AND wposts.post_type = 'post'
    AND wpostmeta.meta_value = '$date'
    ORDER BY wpostmeta.meta_value ASC, wposts.post_date DESC
  ";

  $count = $wpdb->get_var($wpdb->prepare($querydetails));
  return $count;
}

function mbl_calendar()
{

  global $current_blog;
  $path = $current_blog->path;

  $show_month = isset($show_month) ? $show_month : true;
  $show_tout  = isset($show_tout)  ? $show_tout  : true;

  $days = array('S', 'M', 'T', 'W', 'T', 'F', 'S');

  $year  = isset($_GET['year'])  ? intval($_GET['year'])  : null;
  $month = isset($_GET['month']) ? intval($_GET['month']) : null;
  $date  = isset($_GET['date']) ? intval($_GET['date']) : null;

  if ($year == null || $month == null) {
    $year = date("Y");
    $month = date("m");
    $date = date("d");
  }

  $today = mktime(1, 0, 0, date("m"), date("d"), date("Y"));

  $next = mktime(1, 0, 0, $month + 1, 1, $year);
  $prev = mktime(1, 0, 0, $month - 1, 1, $year);

  $prev = "/wp-admin/admin-ajax.php?action=ajax_calendar&month=".date("m", $prev)."&year=".date("Y", $prev);
  $next = "/wp-admin/admin-ajax.php?action=ajax_calendar&month=".date("m", $next)."&year=".date("Y", $next);

  ?>
            <p class="calendarMonthHeading"><?php echo __(date("F", mktime(1, 0, 0, $month, 1, $year))) ?></p>
            <ul>
              <li class="next"><a href="<?php print $next; ?>">Next month</a></li>
              <li class="prev"><a href="<?php print $prev; ?>">Previous month</a></li>
            </ul>

          <table cellspacing="0" cellpadding="0">
            <thead>
              <tr>
              <?php foreach ($days as $day): ?>
              <th><?php echo $day ?></th>
              <?php endforeach ?>
              </tr>
              <tr>
            </thead>
            <tbody>
              <?php foreach (mbl_weeks($month, $year) as $week) { ?>
                <?php foreach ($week as $day) {

                list ($number, $current, $data) = $day;

                if (is_array($data))
                {
                  $classes = array();
                  $output = empty($data['output']) ? '' : '<ul class="output"><li>'.implode('</li><li>', $data['output']).'</li></ul>';
                }
                else
                {
                  $classes = array();
                  $output = '';
                }

                if ($current) {
                  $cdate = mktime(1, 0, 0, $month, $day[0], $year);

                  if ($cdate == $today) {
                    $classes[] = "today";
                  }

                  ?>
                  <td class="<?php echo implode(' ', $classes) ?>">
                    <?php
                    $calEventsCounts = mbl_count_events(date('Y-m-d', $cdate));

                    if ($calEventsCounts == 0) { ?>
                      <span><?php echo $day[0] ?></span>
                    <?php } else { ?>
                      <a href="<?php print $path ?>events?sp_year=<?php echo date("Y", $cdate); ?>&sp_month=<?php echo date("m", $cdate); ?>&sp_date=<?php echo date("d", $cdate); ?>"><?php echo $day[0] ?>
                      </a>
                    <?php } ?>
                  </td>

                <?php } else { ?>
                  <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                </tr>
              <?php } ?>

            </tbody>
          </table>
<?php

}


 function mbl_weeks($m, $y)
  {
    $week_start = 0;
    // First day of the month as a timestamp
    $first = mktime(1, 0, 0, $m, 1, $y);

    // Total number of days in this month
    $total = (int) date('t', $first);

    // Last day of the month as a timestamp
    $last  = mktime(1, 0, 0, $m, $total, $y);

    // Make the month and week empty arrays
    $month = $week = array();

    // Number of days added. When this reaches 7, start a new week
    $days = 0;
    $week_number = 1;

    if (($w = (int) date('w', $first) - $week_start) < 0)
    {
      $w = 6;
    }

    if ($w > 0)
    {
      // Number of days in the previous month
      $d = mktime(1, 0, 0, $m- 1, 1, $y);
      $n = (int) date('t', $d);

      // i = number of day, t = number of days to pad
      for ($i = $n - $w + 1, $t = $w; $t > 0; $t--, $i++)
      {
        // Notify the listeners
        //$this->notify(array($this->month - 1, $i, $this->year, $week_number, FALSE));

        // Add previous month padding days
        $week[] = array($i, FALSE, array());
        $days++;
      }
    }

    // i = number of day
    for ($i = 1; $i <= $total; $i++)
    {
      if ($days % 7 === 0)
      {
        // Start a new week
        $month[] = $week;
        $week = array();

        $week_number++;
      }

      // Notify the listeners
      //$this->notify(array($this->month, $i, $this->year, $week_number, TRUE));

      // Add days to this month
      $week[] = array($i, TRUE, array());
      $days++;
    }

    if (($w = (int) date('w', $last) - $week_start) < 0)
    {
      $w = 6;
    }

    if ($w >= 0)
    {
      // i = number of day, t = number of days to pad
      for ($i = 1, $t = 6 - $w; $t > 0; $t--, $i++)
      {
        // Notify the listeners
        //$this->notify(array($this->month + 1, $i, $this->year, $week_number, FALSE));

        // Add next month padding days
        $week[] = array($i, FALSE, array());
      }
    }

    if ( ! empty($week))
    {
      // Append the remaining days
      $month[] = $week;
    }

    return $month;
  }


function get_fbupdates() {

  global $current_blog;
  $path = $current_blog->path;

  $fb_userid = "societeperrierus";
  if ($path == "/") {
    $fb_userid = "societeperrierus";
  } else if ($path == "/london/") {
    $fb_userid = "SocietePerrierLDN";
  } else if ($path == "/mexico-city/") {
    $fb_userid = "spmexico";
  } else if ($path == "/toronto/" || $path == "/montreal/") {
    $fb_userid = "societeperriercanada";
  } else if ($path == "/moscow/") {
    $fb_userid = "RefreshingMOMENT";
  } else if ($path == "/milan/") {
    $fb_userid = "societeperrierMilan";
  } else if ($path == "/dubai/") {
    $fb_userid = "societeperrierdubai";
  } else if ($path == "/sao-paulo/") {
    $fb_userid = "spbrasil";
  } else if ($path == "/beirut/") {
    $fb_userid = "societeperrierBEY";
  } else if ($path == "/tokyo/") {
    $fb_userid = "societeperrierTokyo";
  } else {
  }

  $key = $path.$fb_userid."-sidebar-fbupdates";
  //delete_transient($key);
  //$url = "http://www.facebook.com/feeds/page.php?id=".$fb_userid."&format=rss20";
  $url = "https://graph.facebook.com/".$fb_userid."/feed?access_token=109270115831931|7751a003e85c549820991065.1-791229004|NEBlcSrkOLqRzpwGEdk4pKokk3s&expires_in=0";
  $data = NULL;

  $page = get_transient($key);
  if (false === $page) {
    $c = curl_init();

    //set options and make it up to look like firefox
    $userAgent = "Firefox (WindowsXP) – Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6";
    curl_setopt($c, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($c, CURLOPT_URL,$url);
    curl_setopt($c, CURLOPT_FAILONERROR, true);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_AUTOREFERER, true);
    curl_setopt($c, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($c, CURLOPT_VERBOSE, true);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

    //get data from facebook and decode XML
    $page = curl_exec($c);
    set_transient( $key, $page, 60 * 60);
    $data = json_decode($page);
  } else {
    $data = json_decode($page);
  }
  return $data;
}

function get_fblink() {

  global $current_blog;
  $path = $current_blog->path;

  $fb_userid = "societeperrierus";
  if ($path == "/") {
    $fb_userid = "societeperrierus";
  } else if ($path == "/london/") {
    $fb_userid = "SocietePerrierLDN";
  } else if ($path == "/mexico-city/") {
    $fb_userid = "spmexico";
  } else if ($path == "/toronto/" || $path == "/montreal/") {
    $fb_userid = "societeperriercanada";
  } else if ($path == "/moscow/") {
    $fb_userid = "RefreshingMOMENT";
  } else if ($path == "/milan/") {
    $fb_userid = "societeperrierMilan";
  } else if ($path == "/dubai/") {
    $fb_userid = "societeperrierdubai";
  } else if ($path == "/sao-paulo/") {
    $fb_userid = "spbrasil";
  } else if ($path == "/beirut/") {
    $fb_userid = "societeperrierBEY";
  } else if ($path == "/tokyo/") {
    $fb_userid = "societeperrierTokyo";
  } else {
  }

  return "http://www.facebook.com/".$fb_userid;
}

function get_twitter_username() {

  global $current_blog;
  $path = $current_blog->path;

  $userid = "sperrier_usa";
  if ($path == "/") {
    $userid = "sperrier_usa";
  } else if ($path == "/los-angeles/" || $path == "/miami/" || $path == "/new-york/") {
    $userid = "sperrier_usa";
  } else if ($path == "/london/") {
    $userid = "sperrier_ldn";
  } else if ($path == "/mexico-city/") {
    $userid = "societe_mx";
  } else if ($path == "/toronto/" || $path == "/montreal/") {
    $userid = "sperrier_ca";
  } else if ($path == "/moscow/") {
    $userid = "sperrier_mos";
} else if ($path == "/milan/") {
    $userid = "Societe_ITA";
  } else if ($path == "/dubai/") {
    $userid = "Societe_dxb";
  } else if ($path == "/sao-paulo/") {
    $userid = "Societeperrierb";
  } else if ($path == "/beirut/") {
    $userid = "SPerrier_BEY";
  } else if ($path == "/tokyo/") {
    $userid = "sperrier_tyo";
  } else {
  }

  return $userid;
}

function mbl_truncate($string, $length=72, $suffix="&hellip;")
{
  $return = "";

  $getlength = strlen($string);
  $return = mb_substr($string, 0, $length);
  if ($getlength > $length) {
    $return .= $suffix;

  }

  return $return;
}


function mbl_search_filter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

//create bit.ly url
function bitly()
{
  //login information
  $url = get_permalink();  //generates wordpress' permalink
  $login = 'societeperrier';  //your bit.ly login
  $apikey = 'R_c6536855684545b8ed8c161a78b2e771'; //bit.ly apikey
  $format = 'json'; //choose between json or xml
  $version = '2.0.1';

  //create the URL
  $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$apikey.'&format='.$format;

  //get the url
  //could also use cURL here
  $response = file_get_contents($bitly);

  //parse depending on desired format
  if(strtolower($format) == 'json')
  {
    $json = @json_decode($response,true);
    echo $json['results'][$url]['shortUrl'];
  }
  else //xml
  {
    $xml = simplexml_load_string($response);
    echo 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
  }
}


// Make custom SP login screen with logo
function MJG_custom_login_screen() {
  echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/stylesheets/custom-login.css" />';
}

add_action('login_head', 'MJG_custom_login_screen');


// Variable & intelligent excerpt length.
function MJG_print_excerpt($length) { // Max excerpt length. Length is set in characters
  global $post;
  $text = $post->post_excerpt;
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
  }
  $text = strip_shortcodes($text); // optional, recommended
  $text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

  $text = substr($text,0,$length);
  $excerpt = MJG_reverse_strrchr($text, '.', 1);
  $excerpt = str_replace('"', "", $excerpt);
  if( $excerpt ) {
    //echo apply_filters('the_excerpt',$excerpt);
    return $excerpt;
  } else {
    //echo apply_filters('the_excerpt',$text);
    //echo 'test 2';
    return $text;
  }
}


// Returns the portion of haystack which goes until the last occurrence of needle
function MJG_reverse_strrchr($haystack, $needle, $trail) {
    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}


function MJG_feed_title_filter($title) {
  global $blog_id;
  $post_id = get_the_ID();

  $title = $title;

  if (is_object_in_term($post_id, 'type', 'event')) {

    if ($blog_id == 7){
        $prefix = '[NYC] ';
    }elseif($blog_id == 5){
        $prefix = '[LA] ';
    }elseif($blog_id == 9){
        $prefix = '[MIA] ';
    }else{
        $prefix = '';
    }

    if($prefix){
      $title = $prefix.$title;
    }else{
      $title = $title;
    }

  }
  return $title;
}


function MJG_feed_content_filter($content){

  $thumbId = get_post_thumbnail_id();

  if($thumbId){

    $img = wp_get_attachment_image_src($thumbId, 'post-gallery' );

    $image = '<img align="left" src="'. $img[0] .'" alt="" width="'. $img[1] .'" height="'. $img[2] .'" class="center" />';
    echo $image;

  }

  return $content;
}


//MJG This changes the RSS feed permalink should the post have a custom post type "_mbl_url", so essentially if it's a feature
function MJG_rss_permalink($permalink) {
  $post_id = get_the_ID();
  //$permalink = get_permalink();
  //MJG don't run this script for events, because they will have an _mbl_url value but it's not for redirection
  if (!is_object_in_term($post_id, 'type', 'event')) {
    $url_meta = get_post_meta($post_id, '_mbl_url', true);
    if ($url_meta <> '') {
      $permalink = $url_meta;
    }else{
      $permalink = get_permalink();
    }
  }
  return $permalink;
}


//MJG
function MJG_feed_filter($query) {
  if ($query->is_feed) {
    add_filter('the_content', 'MJG_feed_content_filter');
    add_filter('the_permalink_rss', 'MJG_rss_permalink');
    add_filter('the_title_rss', 'MJG_feed_title_filter');
  }

  return $query;
}

add_filter('pre_get_posts','MJG_feed_filter');


//MJG remove pings to self
function MJG_no_self_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}

add_action( 'pre_ping', 'MJG_no_self_ping' );


//MJG
register_sidebar(array(
  'name'            => __( 'Front Page Right Sidebar' ),
  'id'              => 'front-page-right-sidebar',
  'description'     => __( 'Widgets in this area will be shown on the right-hand side of the front page.' ),
  'before_title'    => '<h3>',
  'after_title'     => '</h3>'
));




function MJG_generate_social_buttons(){
  //MJG switch/case to serve a relative data-via for the native Twitter share buttons
  global $blog_id;
  $twt_user = get_twitter_username() ? 'data-via="'.get_twitter_username().'"' : '';
  ?>
  <li class="fbShare">
    <fb:like href="<?php echo get_permalink();?>" send="false" layout="button_count" show_faces="false" font="arial"></fb:like>
  </li>
  <li class="twShare">
    <a href="http://twitter.com/share?url=<?php echo urlencode( bitly()); ?>&counturl=<?php urlencode(the_permalink()); ?>" class="twitter-share-button" data-count="horizontal" <?php echo $twt_user; ?>>Tweet</a>
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
  </li>

  <?php
}


function MJG_scripts_method() {
    wp_enqueue_script('ajax-filter', get_template_directory_uri() . '/javascripts/ajax-filter.js',    array('jquery'), '0.1', true );
    wp_localize_script( 'ajax-filter', 'AjaxFilter', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'filterNonce' => wp_create_nonce( 'MJG-filter-nonce' ) ) );
}
add_action('wp_enqueue_scripts', 'MJG_scripts_method');



// function MJG_modify_hotspots_archive_query( $query ) {
//   if ( $query->is_post_type_archive( 'hotspot' ) ) { // Run only on the homepage
//     $query->query_vars['posts_per_page'] = 10; // Show only 5 posts on the homepage only
//   }
// }
// // Hook my above function to the pre_get_posts action
// add_action( 'pre_get_posts', 'MJG_modify_hotspots_archive_query' );


function mb_get_all_sites($sort, $output_value = 'blogname', $show_global = true, $exclude = array()){
  global $wpdb;
  $multisite = array();

  if($sort == 'ASC'){
    $sort_string = 'ORDER BY path ASC';
  }elseif($sort == 'DESC'){
    $sort_string = 'ORDER BY path DESC';
  }else{
    $sort_string = null;
  }
  // Query all blogs from multi-site install
  if($show_global == true){ //if we're not filtering out Global then no worries, let's just run the query without the filter
    $blogs = $wpdb->get_results("SELECT blog_id,domain,path FROM mbl_blogs $sort_string");
    // Get primary blog
    $blogname = $wpdb->get_row("SELECT option_value FROM mbl_options WHERE option_name='blogname' ");
    $multisite[1] = $blogname->option_value;

  }else{ //if we shouldn't show Global, then let's run a filter looking for blog_id 1
    $blogs = $wpdb->get_results("SELECT blog_id,domain,path FROM mbl_blogs WHERE blog_id != 1 $sort_string");
  }
  // For each blog search for blog name in respective options table
  if($output_value == 'blogname'){

    foreach( $blogs as $blog ) {
      if(!in_array($blog->blog_id, $exclude)){
        $blogname = $wpdb->get_results("SELECT option_value FROM mbl_".$blog->blog_id ."_options WHERE option_name='blogname' ");
        foreach( $blogname as $name ) {
          $multisite[$blog->blog_id] = $name->option_value;
        }
      }
    }
    return $multisite;
  }elseif($output_value == 'blog_id'){
    foreach( $blogs as $blog ) {
      $multisite[] = $blog->blog_id;
    }
    return $multisite;
  }
}

function mb_get_random_posts_from_all_sites(){ //can't use $post here, buggy, should change that on the other one too
  global $wpdb;
  $post_type = 'hotspot';

  $get_random_blog_ids = mb_get_all_sites('ASC', 'blog_id', false);
  shuffle($get_random_blog_ids);
  $posts_per_page = 5;
  $post_per_page_count = 0;
  foreach ($get_random_blog_ids as &$get_random_blog_id) {
    if ($get_random_sql_string != '') {
      $uni = ' union ';
    }
    $current_blog_details = get_blog_details( array( 'blog_id' => $get_random_blog_id ) );

    $get_random_sql_string .= $uni . " SELECT *, '". $get_random_blog_id . "' as 'blog_id', '" . $current_blog_details->blogname ."' as 'blog_name', '".$current_blog_details->siteurl."' as 'blog_url' from " . $wpdb->base_prefix . $get_random_blog_id ."_posts  where post_status = 'publish' and post_type = '$post_type' ";
  } ?>
  <ul>
  <?php
  //MJG clear out these arrays.
  unset($get_random_blog_ids);
  unset($_POST);

  $items_per_page = 10;
  $get_random_sql = $wpdb->prepare($get_random_sql_string);

  $get_random_query_results = $wpdb->get_results( $get_random_sql );
  shuffle($get_random_query_results);
  $posts_per_page = 5;
  $post_per_page_count = 0;

  if ($get_random_query_results):
    global $get_random_post;
    foreach ($get_random_query_results as $get_random_post):
      if($post_per_page_count < $posts_per_page){

        setup_postdata($get_random_post); 
        //SUPER IMPORTANT, could have maybe passed this info in with the db result...
        switch_to_blog($get_random_post->blog_id); //MJG this is a total Wordpress bug...you have to switch blogs to use the template tags properly, at least the post metas, ridiculous
        ?>
        <li>
          <a href="<?php print get_permalink($get_random_post->ID); ?>"><?php echo get_the_title($get_random_post->ID); ?></a>
        </li>
      <?php
      }
      $post_per_page_count++;

      restore_current_blog();
    endforeach; ?>
      <li id="moreHotSpots"><a href="<?php print $path; ?>hotspots/" title="More Hot Spots">More Hot Spots</a></li>
  </ul>
  <?php
  endif;
}


function mb_ajax_listings(){
  global $wpdb;


  $page_set = false; 
  $blog_all = false;
  $data = array();
  $blog_ids = array();

  if($_POST){
    // parse_str($_POST['data'], $data);
    foreach( $_POST as $stuff ) {
      if( is_array( $stuff ) ) {
          // print_r($stuff);
          foreach( $stuff as $thing ) {
              if($thing['name'] == 'ajax_page'){
                $ajax_page = $thing['value'];
                $page_set = true;
                // echo "thing['value']:";
                // echo $thing['value'].'<br>';
              }
              if($thing['name'] == 'ajax_page_url'){
                $ajax_page_url = $thing['value'];
              }
              if($thing['name'] == 'blog_id[]'){
                $blog_ids[] = $thing['value'];
                $blog_holder = $thing['value'];
              }
              if($thing['name'] == 'paginated'){
                $paginated = $thing['value'];
              }
          }
      } else {

      }
    }
    if($blog_holder == 1 && count($blog_ids) == 1 ){
      $blog_all = true;
    }
    $ajax_on = true;

    if(!$paginated){
      $paged = 1; //if you're posting, then you're getting new results, shouldn't inherit pages, they are irrelevant at that point
      $ajax_page = 1; //if you're posting, then you're getting new results, shouldn't inherit pages, they are irrelevant at that point
    }
  }else{

    $ajax_on = false;
    $ajax_page_url = get_bloginfo('url').'/hotspots/';
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
    $ajax_page = $paged;

    if(get_current_blog_id() == 1){ //if this is Global and we are not loading with AJAX
      $blog_all = true;
    }else{
      $blog_ids[] = get_current_blog_id();
    }

    if(!$page_set && !$paged){
      $ajax_page = 1;
    }else{
      $ajax_page = $paged;
    }
  }

  if($_POST['post_type']){
    $post_type = $_POST['post_type'];
  }else{
    $post_type = 'hotspot';
  }
    
  if($blog_all){ // if Global (ALL), get all Hotspots from ALL markets
    $blog_ids = mb_get_all_sites('ASC', 'blog_id', false);
  }

  $uni = '';

  // echo 'blog_all:'.$blog_all;
  // echo 'blog_ids';
  // print_r($blog_ids);
  foreach ($blog_ids as &$blog_id) {
    if ($ajax_sql_string != '') {
      $uni = ' union ';
    }
    $current_blog_details = get_blog_details( array( 'blog_id' => $blog_id ) );

    $ajax_sql_string .= $uni . " SELECT *, '". $blog_id . "' as 'blog_id', '" . $current_blog_details->blogname ."' as 'blog_name', '".$current_blog_details->siteurl."' as 'blog_url' from " . $wpdb->base_prefix . $blog_id ."_posts  where post_status = 'publish' and post_type = '$post_type' ";
  }

  //MJG clear out these arrays.
  unset($blog_ids);
  unset($_POST);

  $items_per_page = 10;
  $ajax_query_sql = $wpdb->prepare($ajax_sql_string);
  // echo $ajax_query_sql;
  $ajax_query_total = $wpdb->get_var( "SELECT COUNT(1) FROM (${ajax_query_sql}) AS combined_table" );
  $offset = ( $ajax_page * $items_per_page ) - $items_per_page;
  $ajax_max_num_pages = ceil($ajax_query_total / $items_per_page); //takes 24.7 and rounds it up to 25
  $ajax_query_results = $wpdb->get_results( $ajax_query_sql . " ORDER BY post_title LIMIT ${offset}, ${items_per_page}", OBJECT);

  // echo 'max_num_pages: '.$ajax_max_num_pages;
  // echo '$ajax_query_total: '.$ajax_query_total;
  // echo '$offset: '.$offset;
  // echo '$items_per_page: '.$items_per_page;
  // echo '$ajax_page: '.$ajax_page;

  if ($ajax_query_results):
    global $ajax_post; ?>

    <ul class="listing-single-row">

    <?php foreach ($ajax_query_results as $ajax_post):
      setup_postdata($ajax_post); 
      //SUPER IMPORTANT, could have maybe passed this info in with the db result...
      switch_to_blog($ajax_post->blog_id); //MJG this is a total Wordpress bug...you have to switch blogs to use the template tags properly, at least the post metas, ridiculous
      ?>

      <li class="clearfix">
        <a href="<?php echo get_permalink($ajax_post->ID); ?>" title="<?php echo get_the_title($ajax_post->ID); ?>" target="_blank" data-tid="<?php echo get_post_meta( $ajax_post->ID, '_thumbnail_id', true ); ?>">
          <?php
          if ( has_post_thumbnail($ajax_post->ID) ) { // check if the post has a Post Thumbnail assigned to it.
            $thumb_id = get_post_thumbnail_id($ajax_post->ID);
            $thumb_url_test = wp_get_attachment_image_src($thumb_id, 'listing-226x151', true);
            if($thumb_url_test){
              $thumb_url_array = $thumb_url_test;
              $thumb_url = $thumb_url_array[0];
            }else{
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'post-listing', true);
              $thumb_url = $thumb_url_array[0];
            } 
            ?>
            <img src="<?php echo $thumb_url; ?>" alt="<?php echo get_the_title($ajax_post->ID); ?>" width="226" height="151" />
          <?php
          }else{ //FALLBACK THUMB ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/sitewide/fallback_226x151.png" alt="<?php echo get_the_title($ajax_post->ID); ?>" width="226" height="151" />
          <?php
          }
          ?>
        </a>
        <a href="<?php echo $ajax_post->blog_url; ?>" title="Visit Societe Perrier <?php echo $ajax_post->blog_name; ?>" class="city-name" target="_blank"><?php echo $ajax_post->blog_name; ?></a>
        <h2><a href="<?php echo get_permalink($ajax_post->ID); ?>" title="<?php echo get_the_title($ajax_post->ID); ?>" target="_blank"><?php echo get_the_title($ajax_post->ID); ?></a></h2>
        <?php if ($ajax_post->blog_name != "Tokyo"){
          if($ajax_post->post_excerpt){
            $read_more = mbl_truncate($ajax_post->post_excerpt, 155);
          }else{
            $read_more = mbl_truncate(strip_tags($ajax_post->post_content), 155);
          }
        }else{
          if($ajax_post->post_excerpt){
            $read_more = mbl_truncate($ajax_post->post_excerpt, 59);
          }else{
            $read_more = mbl_truncate(strip_tags($ajax_post->post_content), 59);
          }
        }
        if($read_more){ ?>
          <div><p><?php print $read_more; ?><a href="<?php echo get_permalink($ajax_post->ID); ?>" title="<?php echo get_the_title($ajax_post->ID); ?>" class="readMore" target="_blank">&nbsp;Read More &raquo;</a></p></div>
        <?php } ?>
      </li>

    <?php 
    restore_current_blog();
    endforeach; ?>

    </ul>
    <?php 
    if(!$paginated){
      mbl_ajax_pagination($ajax_page, $items_per_page, $ajax_query_total, $ajax_max_num_pages, $ajax_page_url); 
    }else{
      // echo 'paginated!';
    }
    ?>
    <?php
  else:
    if($blog_id == 1) {
      echo '<p>Sorry, but there are no Hotspots for this selection. Please select some other cities from the dropdown.</p>';
    }else{
      echo '<p>Sorry, but there are no Hotspots for this market.</p>';
    }
  endif;

  // echo 'ajax_on:'.$ajax_on.'<br>';
  if($ajax_on == true){
    // echo 'die';
    // IMPORTANT: don't forget to "exit" if called through ajax
    die();
  }

}

add_action('wp_ajax_mb_ajax_listings', 'mb_ajax_listings');
add_action('wp_ajax_nopriv_mb_ajax_listings', 'mb_ajax_listings');


// END CUSTOM PERRIER CODE //

add_filter('pre_get_posts','mbl_search_filter');

remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');
remove_filter('comment_text', 'wptexturize');
remove_filter('the_title', 'wptexturize');
