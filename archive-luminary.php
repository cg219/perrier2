<? 
	get_template_part("consts");
	get_header();
?>
<body>
	<? get_template_part("nav"); ?>
	<div class="div wrap" id="wrapper">
		<div class="container" id="main">
			<ol class="breadcrumb">
				<li><a href="/">GLOBAL HOME</a></li>
				<? global $wp_query; if(is_tax()) : ?>
				<li><? echo ucwords($wp_query->get_queried_object()->name); ?></li>
				<? else : ?>
				<li><? echo ucwords(post_type_archive_title()); ?></li>
				<? endif; ?>
			</ol>
			<?
				$paged = get_query_var("paged") ? get_query_var("paged") : 1;

				$args = array(
					"post_type" => "luminary",
					"posts_per_page" => 10,
					"post_status" => "publish",
					"orderby" => "title",
					"order" => "ASC",
					"paged" => $paged
				);

				$query = new WP_Query($args);

				if($query->have_posts()): while($query->have_posts()): $query->the_post();

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
					<? $thisCat = get_term_link($cats[0]); ?>
					<h5><a href="<? echo $thisCat->errors ? "" : $thisCat;?>"><? echo $cats[0]->name; ?></a></h5>
					<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
					<p><?  echo kreate_excerpt($post->post_excerpt); ?> <a class="readmore" href="<? the_permalink(); ?>">Read More</a></p>
				</div>
			</div>
			<? endwhile;
					if( $paged + 1 <= $query->max_num_pages): ?>
			<div class="nextPostLink"><a href="<? echo get_post_type_archive_link("luminary"); ?>page/<? echo $paged + 1; ?>"></a></div>
			<?
					endif;
				endif;
			?>
			
			<div class="loader row"><img src="<? echo theme_uri; ?>/assets/images/loader.gif" alt=""></div>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>