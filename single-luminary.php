<? 
	get_template_part("consts");
	get_header();
?>
<body>
	<? get_template_part("nav"); ?>
	<div class="div wrap" id="wrapper">
		<div class="container single" id="main">
			<?
				if(have_posts()): while(have_posts()): the_post();

				$cats = array();

				$terms = wp_get_post_terms(get_the_ID(), "primary_category");
				for( $i=0; $i < count($terms); $i++){
					array_push($cats, $terms[$i]);
				}

				$postID = $post->ID;

				$country = wp_get_post_terms($postID, "country");
				$city = wp_get_post_terms($postID, "city");

			?>
			<ol class="breadcrumb">
				<li><a href="/">GLOBAL HOME</a></li>
				<? if($country) :?>
				<li><a href="<? echo get_term_link($country[0]->slug, "country"); ?>"><? echo $country[0]->name; ?></a></li>
				<? 
					endif;
					if($city) :
				?>
				<li><a href="<? echo get_term_link($city[0]->slug, "city"); ?>"><? echo $city[0]->name; ?></a></li>
				<? 
					endif; 
					if($cats) :
				?>
				<li><a href="<? echo get_term_link($cats[0]); ?>"><? echo $cats[0]->name ?></a></li>
				<? endif; ?>
				<!-- <li><a href="#"><? the_title(); ?></a></li> -->
			</ol>
			<div class="single luminary">
				<? if( $galleries = get_post_galleries($post) ) :?>
				<? 
					$ids = get_post_meta($postID, meta . "slider_ids", true);
					$images = make_slider_image_array(explode(",", $ids));
					echo make_slider_markup($images);
				?>
				<? elseif( ( $videoID = get_post_meta($postID, meta . "video_id", true) ) && $useVideo = get_post_meta($postID, meta . "video_as_feature", true) ) : ?>
				<? echo make_video_player($videoID, get_post_meta($postID, meta . "video_type", true), 720, 480) ?>
				<? else: ?>
				<? 
					if( has_post_thumbnail() ) :
						$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured');
				?>
				<img class="hero" src="<? echo $img[0]; ?>" alt="">
					<? else :?>
				<img class="hero" src="" alt="">
				<? 
					endif;
					endif;
				?>
				<h2 class="title"><? the_title(); ?></h2>
				<h6 class="author"><strong>By:</strong> <? the_author(); ?></h6>
				<div class="luminaryContent">
					<div class="content pull-left"><? the_content(); ?></div>
					<div class="data pull-right">
						<h6>SPOTLIGHT</h6>
						<p id="lname">Name: <? echo get_post_meta(get_the_ID(), meta . "luminary_name", true) ?></p>
						<p id="fame">Known for: <? echo get_post_meta(get_the_ID(), meta . "luminary_fame", true) ?></p>
						<p id="location">Based: <? echo get_post_meta(get_the_ID(), meta . "luminary_location", true) ?></p>
						<p id="web"><a href="<? echo get_post_meta(get_the_ID(), meta . "luminary_url", true) ?>">Website</a></p>
						<ul>
							<? if(get_post_meta(get_the_ID(), meta . "luminary_twitter", true)) : ?>
							<li><a href="<? echo get_post_meta(get_the_ID(), meta . "luminary_twitter", true); ?>"><img src="<? echo theme_uri; ?>/assets/images/twitter-g.png" alt=""></a></li>
							<? endif; ?>
							<? if(get_post_meta(get_the_ID(), meta . "luminary_fb", true)) : ?>
							<li><a href="<? echo get_post_meta(get_the_ID(), meta . "luminary_fb", true); ?>"><img src="<? echo theme_uri; ?>/assets/images/fb-g.png" alt=""></a></li>
							<? endif; ?>
							<? if(get_post_meta(get_the_ID(), meta . "luminary_ig", true)) : ?>
							<li><a href="<? echo get_post_meta(get_the_ID(), meta . "luminary_ig", true); ?>"><img src="<? echo theme_uri; ?>/assets/images/ig-g.png" alt=""></a></li>
							<? endif; ?>
						</ul>
					</div>
				</div>
				<?
					$tags = get_the_tags();
					$newTags = array();
					if( $tags ){
						foreach($tags as $tag){
							$newTags[] = "<a href='" . get_tag_link($tag->term_id) . "' rel='tag'>" . ucwords($tag->name) . "</a>";
						}
					}
				?>
				<div class="tags"><strong>Tags:</strong> <? echo join(", ", $newTags) ?></div>
			</div>
			<?
				endwhile;
				endif;
			?>

			<div class="comments-area">
			<? comments_template("", true); ?>
			</div>

			<div class="morePosts">
				<h5 id="titlebar">More Luminaries</h5>
				<div class="container" id="singlemain">
					<?
						$paged = get_query_var("paged") ? get_query_var("paged") : 1;

						$args = array(
							"post_type" => "luminary",
							"posts_per_page" => 10,
							"paged" => $paged
						);

						// print_r($args);
						rewind_posts();
						$query = new WP_Query($args);
						// print_r($query);
						
						if($query->have_posts()) :
							while($query->have_posts()): $query->the_post();

							$cats = array();

							$terms2 = wp_get_post_terms(get_the_ID(), "primary_category");

							for( $i=0; $i < count($terms2); $i++){
								array_push($cats, $terms2[$i]);
							}
					?>
					<div class="media article">
						<a href="<? the_permalink(); ?>" class="pull-left">
							<? 
								if( has_post_thumbnail() ) :
									$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb');
							?>
								<img src="<? echo $img[0]; ?>" class="media-object" />
							<? else :?>
							<img src="" alt="">
							<? endif; ?>
						</a>
						<div class="media-body">
							<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
							<p><?  echo kreate_excerpt($post->post_excerpt); ?> <a class="readmore" href="<? the_permalink(); ?>">Read More</a></p>
						</div>
					</div>
						<? endwhile; ?>
						<? if( $paged + 1 <= $query->max_num_pages): ?>
					<div class="nextPostLink"><a href="<? echo get_post_type_archive_link("luminary") ?>page/<? echo $paged + 1; ?>"></a></div>
						<? endif; ?>

					<? endif; ?>

					<div class="loader row"><img src="<? echo theme_uri; ?>/assets/images/loader.gif" alt=""></div>
				</div>
			</div>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>