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
				if($theFirstFeature == $post->ID) continue; 
				if($isFeature) :
			?>
			<div class="featured article">
				<a href="<? the_permalink(); ?>">
					<? 
						if( has_post_thumbnail() ) :
							$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured');
					?>
						<img class="media-object" src="<? echo $img[0]; ?>" />
					<? else :?>
					<img class="media-object" src="" alt="">
					<? endif; ?>
				</a>
				<? $thisCat = get_term_link($cats[0]); ?>
				<h5><a href="<? echo $thisCat->errors ? "" : $thisCat;?>"><? echo $cats[0]->name; ?></a></h5>
				<h2><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
				<p><?  echo $post->post_excerpt; ?> <a href="<? the_permalink(); ?>">Read More</a></p>
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
					<a href="<? echo get_permalink($thisPost->ID); ?>">
						<? 
							if( has_post_thumbnail() ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id(), '2-up');
						?>
							<img src="<? echo $img[0]; ?>" class="media-object" />
						<? else :?>
						<img src="" alt="">
						<? endif; ?>
					</a>
					<div class="media-body">
						<h3><a href="<? echo get_permalink($thisPost->ID); ?>"><? echo $thisPost->post_title; ?></a></h3>
						<p><? echo $thisPost->post_excerpt; ?> <a href="<? echo get_permalink($thisPost->ID); ?>">Read More</a></p>
					</div>
				</div>
				<div class="media two-up article">
					<a href="<? echo get_permalink($nextPost->ID); ?>">
						<? 
							if( has_post_thumbnail() ) :
								$img = wp_get_attachment_image_src( get_post_thumbnail_id(), '2-up');
						?>
							<img src="<? echo $img[0]; ?>" class="media-object" />
						<? else :?>
						<img src="" alt="">
						<? endif; ?>
					</a>
					<div class="media-body">
						<h3><a href="<? echo get_permalink($nextPost->ID); ?>"><? echo $nextPost->post_title; ?></a></h3>
						<p><? echo $nextPost->post_excerpt; ?> <a href="<? echo get_permalink($nextPost->ID); ?>">Read More</a></p>
					</div>
				</div>
			</div>
			
			<? else: ?>
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
					<? $thisCat = get_term_link($cats[0]); ?>
					<h5><a href="<? echo $thisCat->errors ? "" : $thisCat;?>"><? echo $cats[0]->name; ?></a></h5>
					<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
					<p><? echo $post->post_excerpt; ?> <a href="<? the_permalink(); ?>">Read More</a></p>
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