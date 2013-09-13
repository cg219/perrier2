<?

add_shortcode("k_recipe", "recipe_shortcode");

function recipe_shortcode($attributes, $content){
	print_r($attributes);
	extract(shortcode_atts(
		array(
			"recipe" => "recipe-1"
		), $attributes
	));
	return "Hi " . $recipe . " Hi " . $content;

	if($attributes){
		$args = array(
			"post_type" => "recipe",
			"post_status" => "publish",
			"posts_per_page" => 1,
			"name" => $attributes
		);

		$query = new WP_Query($args);

		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();

				return the_title();
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