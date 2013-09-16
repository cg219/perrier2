<? 
	get_template_part("consts");
	get_header();
?>
<body>
	<? get_template_part("nav"); ?>
	<div class="div wrap" id="wrapper">
		<div class="container" id="main">
			<div class="page article">
			<? if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="content"><? the_content(); ?></div>
			<?
				endwhile;
				endif;
			?>
			</div>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>