<? 
	get_template_part("consts");
	get_header();
?>
<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container wrap">
			<? get_template_part("nav"); ?>
		</div>
	</div>
	<div class="div wrap" id="wrapper">
		<div class="container" id="main">
			<div class="row" id="hotspot-navbar">
				<h5>Hotspots</h5>
				<div class="dropdown pull-right">
					<a id="hotspot-toggle" href="#" data-toggle="dropdown" class="dropdown-toggle">ALL</a>

					<ul class="dropdown-menu" role="menu">
						<?

							if($cities = $_POST["hotspots"]){
								if($cities != "ALL")
									$queryCities = explode(",", $cities);
							}
						?>
						<li role="presentation"><a href="#">ALL</a></li>
						<?
							$cities = get_terms("city");

							foreach($cities as $city) :
						?>
						<li><a href="#"><? echo $city->name; ?></a></li>
						<? endforeach; ?>
					</ul>
				</div>
				<a href="#" class="goButton">GO</a>
				<form method="post" action="" role="form">
					<input type="hidden" name="hotspots" value="">
				</form>
			</div>
			<?
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
						)
					);

					// print_r($hotspotArgs);
				}
				else{
					$hotspotArgs = array(
						"post_type" => "hotspot",
						"posts_per_page" => 10
					);
				}

				
				$query = new WP_Query($hotspotArgs);

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
					<p><? the_excerpt(); ?><a href="<? the_permalink(); ?>">Read More</a></p>
				</div>
			</div>
			<?
				endwhile;
				// endif;
			?>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>