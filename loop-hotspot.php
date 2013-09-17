<?

	$paged = get_query_var("paged") ? get_query_var("paged") : 1;
	$blogs = kreate_get_blogs();

	if($queryCities){
		$hotspotTaxes = array();

		foreach($queryCities as $qc){
			$hotspotTaxes[] = $qc;
		}

		$hotspotArgs = array(
			"post_type" => "hotspot",
			"posts_per_page" => 10,
			"tax_query" => array(
				array(
					"taxonomy" => "city",
					"field" => "slug",
					"terms" => $hotspotTaxes
				)
			),
			"paged" => $paged
		);

		// print_r($hotspotArgs);
	}
	else{
		$hotspotArgs = array(
			"post_type" => "hotspot",
			"posts_per_page" => 10,
			"paged" => $paged
		);
	}

	// foreach( $blogs as $blog ):
	// 	switch_to_blog($blog->blog_id);
		$query = new WP_Query($hotspotArgs);
		// print_r($query);
		if($query->have_posts()) :
		while($query->have_posts()): $query->the_post();

		$cities = array();

		$terms = wp_get_post_terms($post->ID, "city");
		for( $i=0; $i < count($terms); $i++){
			array_push($cities, $terms[$i]->name);
		}
?>
<div class="media article hotspot">
	<a href="<? the_permalink(); ?>" class="pull-left">
		<? 
			if( has_post_thumbnail() ) :
				$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb');
		?>
		<img src="<? echo $img[0]; ?>" class="media-object" />
		<? else :?>
		<img src="" alt="">
		<? 
			endif;
			if(get_post_meta(get_the_ID(), "_perrier2_hotspot_preferred", true) == "on") :
		?>
		<img class="preferred" src="<? echo theme_uri; ?>/assets/images/hotspot.png" />
		<? endif; ?>
	</a>
	<div class="media-body">
		<h5><? echo join(", ", $cities); ?></h5>
		<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
		<p><? the_excerpt(); ?><a class="readmore" href="<? the_permalink(); ?>">Read More</a></p>
	</div>
</div>
<? endwhile; ?>

	<div class="nextPostLink"><? next_posts_link("", $query->max_num_pages); ?></div>
<? endif; ?>