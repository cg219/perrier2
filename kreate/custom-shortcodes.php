<?
add_shortcode("k_recipe", "recipe_shortcode");

function recipe_shortcode($attrs, $content){
	$attrs = shortcode_atts(
		array(
			"recipe" => "recipe-1"
		), $attrs
	);

	if($attrs["recipe"]){
		$args = array(
			"post_type" => "recipe",
			"post_status" => "publish",
			"posts_per_page" => 1,
			"name" => $attrs["recipe"]
		);

		$query = new WP_Query($args);

		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();
				$title = get_the_title();
				$author = get_post_meta(get_the_ID(), "_perrier2_recipe_creator", true);
				$ingredients = get_post_meta(get_the_ID(), "_perrier2_recipe_ingredients", true);
				$content = get_post_meta(get_the_ID(), "_perrier2_recipe_process", true);

				$html = "<div class='recipe'><h4>$title <span>By: $author</span></h4><p>$content</p><div class='ingredients'><h5>INGREDIENTS</h5><p>$ingredients</p></div></div>";

				return $html;
			}
		}
		else{
			return "Recipe Doesnt Exist";
		}
	}
	else{
		return "No Recipe Provided";
	}
}
?>