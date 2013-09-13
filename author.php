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
		<div class="container author" id="main">
			<?
				$author = get_user_by("slug", get_query_var("author_name"));

			?>
			<div id="authorbox">
				<? echo get_avatar($author->ID, 122); ?>
				<p id="authorDesc"><? echo $author->description; ?></p>
			</div>
			<ol class="breadcrumb">
				<li><a href="/">GLOBAL HOME</a></li>
				<li>Posts By: <? echo $author->first_name . " " . $author->last_name; ?></li>
			</ol>
			<?
				$args = array(
					"author" => $author->ID
				);

				$query = new WP_Query($args);

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
			?>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>