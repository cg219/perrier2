<? 
	get_template_part("consts");
	get_header();
?>
<body>
	<? get_template_part("nav"); ?>
	<div class="div wrap" id="wrapper">
		<div class="container author" id="main">
			<?
				$author = get_user_by("slug", get_query_var("author_name"));
			?>
			<div id="authorbox">
				<div><? echo get_avatar($author->ID, 225); ?></div>
				<p id="authorDesc"><? echo $author->description; ?></p>
			</div>
			<ol class="breadcrumb">
				<li>Posts By: <? echo $author->first_name . " " . $author->last_name; ?></li>
			</ol>
			<?
				$paged = get_query_var("paged") ? get_query_var("paged") : 1;


				$args = array(
					"author" => $author->ID,
					"paged" => $paged,
					"posts_per_page" => 5
				);

				$query = new WP_Query($args);

				print_r($query->max_num_pages);

				while($query->have_posts()): $query->the_post();

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
				print_r($paged + 1);
				if( $paged + 1 <= $query->max_num_pages): ?>
					<div class="nextPostLink"><a href="<? echo get_author_posts_url( $author->ID ); ?>page/<? echo $paged + 1; ?>"></a></div>
			<?	endif; ?>
			<div class="loader row"><img src="<? echo theme_uri; ?>/assets/images/loader.gif" alt=""></div>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>