			<?
				if(have_posts()): while(have_posts()): the_post();

				$cats = array();

				$isFeature = false;
				$is2Up = false;
				$terms = wp_get_post_terms(get_the_ID(), "type");
				$terms2 = wp_get_post_terms(get_the_ID(), "primary_category");
				for( $i=0; $i < count($terms); $i++){
					$isFeature = $terms[$i]->slug == "featured" ? true : $isFeature;
					$is2Up = $terms[$i]->slug == "2-up" ? true : $is2Up;
				}
				for( $i=0; $i < count($terms2); $i++){
					array_push($cats, $terms2[$i]);
				}
				
				$isGlobalFeature = get_post_meta(get_the_ID(), meta . "add_to_global", true) == "feature" ? true : false;
				$isGlobal2Up = get_post_meta(get_the_ID(), meta . "add_to_global", true) == "two-up" ? true : false;
				$isGlobal = get_post_meta(get_the_ID(), meta . "add_to_global", true) == "regular" ? true : false;
				$isGlobalEnabled = get_post_meta(get_the_ID(), meta . "enable_add_to_global", true) == "on" ? true : false;
				
				if($theFirstFeature == $post->ID) continue; 
				if($isFeature) :
			?>
			<div class="featured article">
				<? 
					if($isGlobal && $isGlobalFeature) :

						$gbs = get_site_transient("global_posts");
						$blog_id = $gbs[get_the_ID() . "_blog_id"];
						$original_id = $gbs[get_the_ID() . "_id"];
						$perm = get_blog_permalink($blog_id, $original_id);
					else :
						$perm = get_permalink();
					endif;
				?>
				<a href="<? echo $perm; ?>">
					<? 
						if( $isGlobal && $isGlobalFeature ) :
							switch_to_blog($blog_id);
							if( has_post_thumbnail($original_id) ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id($original_id), 'featured');
							endif;
							restore_current_blog();
						else:
							if( has_post_thumbnail() ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured');
							endif;
						endif;

						if( $img[0] ) :
					?>
						<img class="media-object" src="<? echo $img[0]; ?>" />
					<? else :?>
					<img class="media-object" src="" alt="">
					<? endif; ?>
				</a>
				<? $thisCat = get_term_link($cats[0]); ?>
				<h5><a href="<? echo $thisCat->errors ? "" : $thisCat;?>"><? echo $cats[0]->name; ?></a></h5>
				<h2><a href="<? echo $perm; ?>"><? the_title(); ?></a></h2>
				<p><?  echo $post->post_excerpt; ?> <a class="readmore" href="<? echo $perm; ?>">Read More</a></p>
			</div>
			<? 
				elseif($is2Up) :
					$thisPost = $post;
					$nextPost = get_next_post();

					$nextPostTerms = wp_get_post_terms($nextPost->ID, "type");
					$nextPostIsCorrect = false;

					for( $i=0; $i < count($nextPostTerms); $i++){
						if( $nextPostTerms[$i]->slug == "2-up" ){
							$nextPostIsCorrect = true;
							break;
						}
					}

					if( !$nextPostIsCorrect ) continue;

			?>
			<div class="article two-up-pair">
				<div class="media two-up article">
					<? 
						if($isGlobal && $isGlobal2Up) :

							$gbs = get_site_transient("global_posts");
							$blog_id = $gbs[get_the_ID() . "_blog_id"];
							$original_id = $gbs[get_the_ID() . "_id"];
							$perm = get_blog_permalink($blog_id, $original_id);
						else :
							$perm = get_permalink($thisPost->ID);
						endif;
					?>
					<a href="<? echo $perm; ?>">
						<? 
							if( $isGlobal && $isGlobal2Up ) :
								switch_to_blog($blog_id);
								if( has_post_thumbnail($original_id) ) :
									$img = wp_get_attachment_image_src( get_post_thumbnail_id($original_id), '2-up');
								endif;
								restore_current_blog();
							else:
								if( has_post_thumbnail() ) :
									$img = wp_get_attachment_image_src( get_post_thumbnail_id($thisPost->ID), '2-up');
								endif;
							endif;

							if( $img[0] ) :
						?>
							<img class="media-object" src="<? echo $img[0]; ?>" />
						<? else :?>
						<img class="media-object" src="" alt="">
						<? endif; ?>
					</a>
					<div class="media-body">
						<h3><a href="<? echo $perm; ?>"><? echo $thisPost->post_title; ?></a></h3>
						<p><? echo $thisPost->post_excerpt; ?> <a class="readmore" href="<? echo $perm ?>">Read More</a></p>
					</div>
				</div>
				<div class="media two-up article">
					<? 
						if($isGlobal && $isGlobal2Up) :

							$gbs = get_site_transient("global_posts");
							$blog_id = $gbs[get_the_ID() . "_blog_id"];
							$original_id = $gbs[get_the_ID() . "_id"];
							$perm = get_blog_permalink($blog_id, $original_id);
						else :
							$perm = get_permalink($thisPost->ID);
						endif;
					?>
					<a href="<? echo $perm; ?>">
						<? 
							if( $isGlobal && $isGlobal2Up ) :
								switch_to_blog($blog_id);
								if( has_post_thumbnail($original_id) ) :
									$img = wp_get_attachment_image_src( get_post_thumbnail_id($original_id), '2-up');
								endif;
								restore_current_blog();
							else:
								if( has_post_thumbnail() ) :
									$img = wp_get_attachment_image_src( get_post_thumbnail_id($nextPost->ID), '2-up');
								endif;
							endif;

							if( $img[0] ) :
						?>
							<img class="media-object" src="<? echo $img[0]; ?>" />
						<? else :?>
						<img class="media-object" src="" alt="">
						<? endif; ?>
					</a>
					<div class="media-body">
						<h3><a href="<? echo $perm; ?>"><? echo $thisPost->post_title; ?></a></h3>
						<p><? echo $thisPost->post_excerpt; ?> <a class="readmore" href="<? echo $perm ?>">Read More</a></p>
					</div>
				</div>
			</div>
			
			<? else: ?>
			<div class="media article">
				<? 
					if($isGlobal && $isGlobalFeature) :

						$gbs = get_site_transient("global_posts");
						$blog_id = $gbs[get_the_ID() . "_blog_id"];
						$original_id = $gbs[get_the_ID() . "_id"];
						$perm = get_blog_permalink($blog_id, $original_id);
					else :
						$perm = get_permalink();
					endif;
				?>
				<a class="pull-left" href="<? echo $perm; ?>">
					<? 
						if( $isGlobal && $isGlobalFeature ) :
							switch_to_blog($blog_id);
							if( has_post_thumbnail($original_id) ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id($original_id), 'thumb');
							endif;
							restore_current_blog();
						else:
							if( has_post_thumbnail() ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb');
							endif;
						endif;

						if( $img[0] ) :
					?>
						<img class="media-object" src="<? echo $img[0]; ?>" />
					<? else :?>
					<img class="media-object" src="" alt="">
					<? endif; ?>
				</a>
				<div class="media-body">
					<? $thisCat = get_term_link($cats[0]); ?>
					<h5><a href="<? echo $thisCat->errors ? "" : $thisCat;?>"><? echo $cats[0]->name; ?></a></h5>
					<h3><a href="<? echo $perm; ?>"><? the_title(); ?></a></h3>
					<p><? echo $post->post_excerpt; ?> <a class="readmore" href="<? echo $perm; ?>">Read More</a></p>
				</div>
			</div>
			<?
				endif;
				endwhile;
			?>
			<div class="nextPostLink"><? next_posts_link(""); ?></div>
			<?
				endif;
			?>