<?php
add_shortcode( 'gallery', 'gallery_shortcode_handler' );
add_shortcode( 'video', 'video_shortcode_handler' );
add_shortcode( 'audio', 'audio_shortcode_handler' );
//add_shortcode( 'soundcloud', 'soundcloud_shortcode_handler' );

// function soundcloud_shortcode_handler($attr){
//   global $post;

//   return $output;
// }

function video_shortcode_handler($attr) {
  global $post;
  global $wp_embed;

  extract(shortcode_atts(array(
    'url'         => '',
    'image'       => '',
    'caption'     => '',
    'id'          => $post->ID,
    'width'       => '640',
    'height'      => '480',
  ), $attr));
  $id = intval($id);

  $output  = '';

  if (!empty($url)) {

    //if (stripos($url, "youtube.com")) {
    //$video_url = '<iframe width="598" height="335" src="'.$url.'" frameborder="0" allowfullscreen style="display:visible;z-index:100;"></iframe>';
    //}else{
    //$video_url = '<iframe src="'.$url.'" width="598" height="335" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
     $output = apply_filters('the_content', "<br/>[embed width='598']" . $url . "[/embed]");



    //$output .= '<div class="media_video">';
  //$output .= $video_url;
  //$output .= '...';
  //$output .= $wp_embed->run_shortcode('[embed ]'.$url.'[/embed]');
  //$output = $video_url;
    //$output .= '</div>';

  }

  return $output;

}

function audio_shortcode_handler($attr) {
    global $post;

	extract(shortcode_atts(array(
        'url'         => '',
        'title'       => '',
        'artist'      => '',
        'id'          => $post->ID,
        'download'    => FALSE,
    ), $attr));

    $id         = intval($id);
    $download   = (boolean) $download;

    $output  = '';


    if (!empty($url)) :

        $output .= '<div class="media_audio">';
        $output .= '<audio src="'.$url.'" type="audio/mp3" controls="controls"></audio>';

        $output .= '<p><span class="music">Audio:</span>';
//        $output .= ' <em>'.$title.'</em> &mdash; "'.$artist.'"';
        $output .= ' <em>'.$artist.'</em> &mdash; "'.$title.'"';

        if ($download)
            $output .= ' <a href="'.$url.'">Download MP3</a>';

        $output .= '</p>';
        $output .= '</div>';

    endif;

    return $output;

}

function gallery_shortcode_handler($attr) {
  global $post, $wp_locale;

  static $instance = 0;
  $instance++;

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'dl',
    'icontag'    => 'dt',
    'captiontag' => 'dd',
    'columns'    => 3,
    'size'       => 'post-gallery',
    'include'    => '',
    'exclude'    => ''
  ), $attr));

  $id = intval($id);

  if ( !empty($include) ) {
    $include = preg_replace( '/[^0-9,]+/', '', $include );
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( !empty($exclude) ) {
    $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  } else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  }

  if ( empty($attachments) )
    return '';

  $output = "";
  $output .= '<aside class="media_gallery">';
  $output .= '<ul class="media_gallery">';

  foreach ( $attachments as $id => $attachment ) {
    //rint_r($attachment);
    //$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
    //$output .= '<li>'.$link.'</a></li>';
    // $data = wp_get_attachment_image_src($id, 'full');
    //$data = wp_get_attachment_url($id, 'full');
    //$url = $data[0];
    //$url = wp_get_attachment_url($id, 'full');
    //$url = wp_get_attachment_link( $id, 'full', true );
    $url = get_attachment_link( $id );
    $output .= '<li><a title="'.$attachment->post_title.'" href="'.$url.'#">'.wp_get_attachment_image($id, $size).'</a></li>';
  }

  $output .= '</ul>';
  $output .= '</aside>';

  return $output;
}
