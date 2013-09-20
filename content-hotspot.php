<div class="media article hotspot">
	<a href="<? the_permalink(); ?>" class="pull-left">
		<? 
			if( has_post_thumbnail() ) :
				$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumb');
		?>
		<img src="<? echo $img[0]; ?>" class="media-object" />
		<? else :?>
		<img src="" alt="">
		<? 
			endif;
			if(get_post_meta($post->ID, "_perrier2_hotspot_preferred", true) == "on") :
		?>
		<img class="preferred" src="<? echo theme_uri; ?>/assets/images/hotspot.png" />
		<? endif; ?>
	</a>
	<div class="media-body">
		<h5><? echo $cities; ?></h5>
		<h3><a href="<? the_permalink(); ?>"><? echo $post->post_title; ?></a></h3>
		<p><?  echo substr($post->post_excerpt, 0, 200) . "..."; ?>  <a class="readmore" href="<? echo get_permalink($post->ID); ?>">Read More</a></p>
	</div>
</div>