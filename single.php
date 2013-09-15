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
		<div class="container single" id="main">
			<?
				if(have_posts()): while(have_posts()): the_post();

				$cats = array();

				$terms = wp_get_post_terms(get_the_ID(), "special-post-type");
				for( $i=0; $i < count($terms); $i++){
					$isFeature = $terms[$i]->slug == "features" ? true : $isFeature;
					array_push($cats, $terms[$i]->name);
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
					if($cats[0]) :
				?>
				<li><a href="<? echo get_term_link($cats[0], "special-post-type"); ?>"><? echo $cats[0] ?></a></li>
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
					<li class="categories"><? echo join(", ", $cats); ?></li>
					<li class="divider"></li>
					<li class="date"><? the_date(); ?></li>
					<li class="comments-meta-link"><? comments_number("","",""); ?></li>
					<li class="addthis">
						<div class="addthis_toolbox addthis_default_style ">
							<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
							<a class="addthis_button_tweet"></a>
							<a class="addthis_button_pinterest_pinit"></a>
							<a class="addthis_counter addthis_pill_style"></a>
						</div>
					</li>
				</ul>
				<h2 class="title"><? the_title(); ?></h2>
				<h6 class="author"><strong>By:</strong> <a href="<? echo get_author_posts_url( get_the_author_meta("ID") ); ?>"><? the_author(); ?></a></h6>
				<div class="content"><? the_content(); ?></div>
				<div class="tags"><? the_tags("<strong>Tags:</strong> "); ?></div>
			</div>
			<?
				endwhile;
				endif;
			?>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>