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
				
				$postID = get_the_ID();
				$isGlobalType = get_post_meta(get_the_ID(), meta . "add_to_global", true);
				$isGlobalEnabled = get_post_meta(get_the_ID(), meta . "enable_add_to_global", true) === "on" ? true : false;
				
				$old_blog_id = get_current_blog_id();
				$blog_id = get_post_meta($postID, "original_blog_id", true);
				$original_id = get_post_meta($postID, "original_post_id", true);

				$img = null;

				if($theFirstFeature == $post->ID) continue; 
				if($isFeature || ($isGlobalEnabled && $isGlobalType === "feature")) :
			?>
			<div class="featured article">
				<? 
					if($isGlobalEnabled) :
						$perm = get_post_meta($postID, meta . "global_link", true);
					else :
						$perm = get_permalink();
					endif;
				?>
				<a href="<? echo $perm; ?>">
					<? 
						if( $isGlobalEnabled) :
							switch_to_blog(get_post_meta($post->ID, "original_blog_id", true));
							if( has_post_thumbnail($original_id) ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id($original_id), 'featured');
							endif;
							switch_to_blog($old_blog_id);
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
				elseif($is2Up || ($isGlobalEnabled && $isGlobalType === "two-up")) :
					$thisPost = $post;
					$nextPost = get_next_post();

					$this_blog_id = get_post_meta($thisPost->ID, "original_blog_id", true);
					$next_blog_id = get_post_meta($nextPost->ID, "original_blog_id", true);
					$this_original_id = get_post_meta($thisPost->ID, "original_post_id", true);
					$next_original_id = get_post_meta($nextPost->ID, "original_post_id", true);

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
						if($isGlobalEnabled) :
							$perm = get_post_meta($thisPost->ID, meta . "global_link", true);
						else :
							$perm = get_permalink($thisPost->ID);
						endif;
					?>
					<a href="<? echo $perm; ?>">
						<? 
							if( $isGlobalEnabled) :
								switch_to_blog(get_post_meta($thisPost->ID, "original_blog_id", true));
								if( has_post_thumbnail($original_id) ) :
									$img = wp_get_attachment_image_src( get_post_thumbnail_id($this_original_id), '2-up');
								endif;
								switch_to_blog($old_blog_id);
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
						$img = null;
						if($isGlobalEnabled) :
							$perm = get_post_meta($nextPost->ID, meta . "global_link", true);
						else :
							$perm = get_permalink($nextPost->ID);
						endif;
					?>
					<a href="<? echo $perm; ?>">
						<? 
							if( $isGlobalEnabled) :
								switch_to_blog(get_post_meta($nextPost->ID, "original_blog_id", true));
								if( has_post_thumbnail($original_id) ) :
									$img = wp_get_attachment_image_src( get_post_thumbnail_id($next_original_id), '2-up');
								endif;
								switch_to_blog($old_blog_id);
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
					if($isGlobalEnabled) :
						$perm = get_post_meta($postID, meta . "global_link", true);
					else :
						$perm = get_permalink();
					endif;
				?>
				<a class="pull-left" href="<? echo $perm; ?>">
					<? 
						if( $isGlobalEnabled) :
							switch_to_blog(get_post_meta($post->ID, "original_blog_id", true));
							if( has_post_thumbnail($original_id) ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id($original_id), 'thumb');
							endif;
							switch_to_blog($old_blog_id);
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