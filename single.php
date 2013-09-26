<? 
	get_template_part("consts");
	get_header();
	// include_once(theme_uri . "/mc/bitly.php");
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
					$isFeature = $terms[$i]->slug == "features" ? true : $isFeature;
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
			<div class="single">
				<? if( get_post_meta($postID, meta . "slider_as_feature", true) == "on" ) :?>
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
					<? endif; ?>
				<? endif; ?>
				<ul class="metadata">
					<? $thisCat = get_term_link($cats[0]); ?>
					<li class="categories"><a href="<? echo $thisCat->errors ? "" : $thisCat;?>"><? echo $cats[0]->name; ?></a></li>
					<li class="divider"></li>
					<li class="date"><? the_date(); ?></li>
					<li class="comments-meta-link"><? comments_number("","",""); ?></li>
					<li class="addthis">
						<div class="addthis_toolbox addthis_default_style ">
							<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
							<a class="addthis_button_tweet" addthis:url="<? echo shorten(get_permalink()); ?>"></a>
							<a class="addthis_button_pinterest_pinit"></a>
							<!-- <a class="addthis_button_google_plusone_badge" g:plusone:size="small" g:plusone:href="https://plus.google.com/102383601500147943541/"></a>  -->
							<a class="addthis_counter addthis_pill_style"></a>
						</div>
					</li>
				</ul>
				<h2 class="title"><? the_title(); ?></h2>
				<? if(get_post_meta($postID, meta . "subline", true)): ?>
				<h3 class="subtitle"><? echo get_post_meta($postID, meta . "subline", true) ?></h3>
				<? endif; ?>
				<h6 class="author"><strong>By:</strong> <a href="<? echo get_author_posts_url( get_the_author_meta("ID") ); ?>"><? the_author(); ?></a></h6>
				<div class="content"><? the_content(); ?></div>
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
				wp_reset_postdata();
			?>

			<div class="comments-area">
			<? comments_template("", true); ?>
			</div>

			<div class="morePosts">
				<h5 id="titlebar">More <? echo $cats[0]->name; ?></h5>
				<div class="container" id="singlemain">
					<?
						$paged = get_query_var("paged") ? get_query_var("paged") : 1;

						$args = array(
							"post_type" => "post",
							"posts_per_page" => 10,
							"paged" => $paged,
							"tax_query" => array(
								array(
									"taxonomy" => $cats[0]->taxonomy,
									"field" => "slug",
									"terms" => $cats[0]->slug
								)
							)
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
							<p><?  echo kreate_excerpt($post->post_excerpt); ?>  <a class="readmore" href="<? the_permalink(); ?>">Read More</a></p>
						</div>
					</div>
						<? endwhile; ?>
						<? if( $paged + 1 <= $query->max_num_pages): ?>
					<div class="nextPostLink"><a href="<? echo get_term_link($cats[0]) ?>page/<? echo $paged + 1; ?>"></a></div>
						<? endif; ?>

					<? endif; ?>

					<div class="loader row"><img src="<? echo theme_uri; ?>/assets/images/loader.gif" alt=""></div>
				</div>
			</div>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>