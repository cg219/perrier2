<? 
	get_template_part("consts");
	get_header();
?>
<body>
	<? get_template_part("nav"); ?>
	<div class="div wrap" id="wrapper">
		<div class="container" id="main">
			<h2>Search Results for "<? echo get_search_query(); ?>"</h2>
			<?
				if(have_posts()): while(have_posts()): the_post();

				$cats = array();

				$terms2 = wp_get_post_terms(get_the_ID(), "primary_category");

				for( $i=0; $i < count($terms2); $i++){
					array_push($cats, $terms2[$i]->name);
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
					<h5><? echo join(", ", $cats); ?></h5>
					<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
					<p><? the_excerpt(); ?><a href="<? the_permalink(); ?>">Read More</a></p>
				</div>
			</div>
			<?
				endwhile;
				else:
			?>
			<h1>NOthing Found</h1>
			<? endif; ?>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>