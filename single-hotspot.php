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

				$pageviews = get_post_meta($postID, meta . "pageviews", true);
				$transient = get_transient(meta . "pageviews" . get_current_blog_id() . $postID);

				if( $transient === "set" ){
					$pageviews = $pageviews == "" ? 1 : $pageviews + 1;
					update_post_meta($postID, meta . "pageviews", $pageviews);
				}
				else{
					set_transient(meta . "pageviews" . get_current_blog_id() . $postID, "set");
					update_post_meta($postID, meta . "pageviews", 1);
				}

				preg_match("/http:\/\/[a-zA-Z.]+\/([a-zA-Z]+)/", get_permalink(), $matches);

			?>
			<ol class="breadcrumb">
				<li><a href="/">GLOBAL HOME</a></li>
				<? if($country) :?>
				<li><a href="<? echo home_url(); ?>"><? echo $country[0]->name; ?></a></li>
				<? 
					endif;
					if($city) :
				?>
				<li><a href="<? echo get_term_link($city[0]->slug, "city"); ?>"><? echo $city[0]->name; ?></a></li>
				<? 
					endif; 
					if($cats[0]) :
				?>
				<li><a href="<? echo get_term_link($cats[0]); ?>"><? echo $cats[0]->name ?></a></li>
				<? endif; ?>
				<!-- <li><a href="#"><? the_title(); ?></a></li> -->
			</ol>
			<div class="single hotspot">
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
						if(get_post_meta(get_the_ID(), meta . "hotspot_preferred", true) == "on") :
					?>
				<img class="preferred" src="<? echo theme_uri; ?>/assets/images/hotspot.png" />
					<? endif; ?>
				<ul class="metadata">
					<li class="addthis">
						<div class="addthis_toolbox addthis_default_style ">
							<a href="https://twitter.com/share" class="twitter-share-button addthis_button_tweet" data-counturl="<? echo get_permalink(); ?>" data-url="<? echo shorten(get_permalink()); ?>" data-via="<? echo twitterTitle(get_the_title(), $matches[1]); ?>">Tweet</a>
							<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
							<a class="addthis_button_pinterest_pinit"></a>
							<!-- <a class="addthis_button_google_plusone_badge" g:plusone:size="small" g:plusone:href="https://plus.google.com/102383601500147943541/"></a>  -->
							<a class="addthis_counter addthis_pill_style"></a>
						</div>
					</li>
				</ul>
				<h2 class="title"><? the_title(); ?></h2>
				<h6 class="author"><strong>By:</strong> <? the_author(); ?></h6>
				<div class="hotspotContent">
					<div class="content pull-left"><? the_content(); ?></div>
					<div class="data-container pull-right">
						<div class="data pull-right">
							<h6>HOTSPOT DETAILS</h6>
							<p id="address1"><? echo get_post_meta(get_the_ID(), meta . "hotspot_address1", true) ?></p>
							<p id="address2"><? echo get_post_meta(get_the_ID(), meta . "hotspot_address2", true) ?></p>
							<p id="phone"><? echo get_post_meta(get_the_ID(), meta . "hotspot_phone", true) ?></p>
							<p id="web"><a href="<? echo get_post_meta(get_the_ID(), meta . "hotspot_url", true) ?>">Website</a></p>
							<ul>
								<? if(get_post_meta(get_the_ID(), meta . "hotspot_twitter", true)) : ?>
								<li><a href="<? echo get_post_meta(get_the_ID(), meta . "hotspot_twitter", true); ?>"><img src="<? echo theme_uri; ?>/assets/images/twitter-g.png" alt=""></a></li>
								<? endif; ?>
								<? if(get_post_meta(get_the_ID(), meta . "hotspot_fb", true)) : ?>
								<li><a href="<? echo get_post_meta(get_the_ID(), meta . "hotspot_fb", true); ?>"><img src="<? echo theme_uri; ?>/assets/images/fb-g.png" alt=""></a></li>
								<? endif; ?>
								<? if(get_post_meta(get_the_ID(), meta . "hotspot_ig", true)) : ?>
								<li><a href="<? echo get_post_meta(get_the_ID(), meta . "hotspot_ig", true); ?>"><img src="<? echo theme_uri; ?>/assets/images/ig-g.png" alt=""></a></li>
								<? endif; ?>
							</ul>
						</div>
						<img class="pull-right bottom-cap" src="<? echo theme_uri ?>/assets/images/data-border-bottom.png" alt="" />
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
				wp_reset_postdata();
			?>

			<div class="comments-area">
			<? comments_template("", true); ?>
			</div>

			<div class="morePosts">
				<h5 id="titlebar">More Hotspots</h5>
				<div class="container" id="singlemain">
					<? include( locate_template("loop-hotspot.php")); ?>
				</div>
			</div>

			<div class="loader row"><img src="<? echo theme_uri; ?>/assets/images/loader.gif" alt=""></div>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>