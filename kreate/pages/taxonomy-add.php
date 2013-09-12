<?
	if( isset($_POST["kreate-tax-name"]) && $_POST["kreate-tax-name"] != "" ){
		
		$term = $_POST["kreate-tax-name"];
		$tax = $_POST["kreate-tax-method"];

		$args = array(
			'post_type'			=> array( 'post', "hotspot", "luminary", "recipe" ),
			'post_status'		=> 'any',
			'nopaging'			=> true,
			'cache_results'		=> false,
			'no_found_rows'		=> true,
		);

		$posts = get_posts($args);

		$termID = get_term_by("name", $term, $tax);

		if( !$termID ){
			wp_insert_term(
				$term,
				$tax
			);

			$termID = get_term_by("name", $term, $tax);
		}

		foreach($posts as $post) :

			wp_set_post_terms($post->ID, $termID->term_id, $tax);

		endforeach;
	}
?>
<div class="container">
	<h2>KMT Page</h2>
	<form id="kmt-form" method="post" action="" role="form">
		<div class="row">
			<div class="col-lg-4">
				<input class="form-control" type="text" name="kreate-tax-name" id="kreate-tax-name" placeholder="Tax Name">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<h3 class="lead">Choose Method</h3>
				<div class="radio">
					<label for="">
						<input type="radio" name="kreate-tax-method" id="kreate-tax-method-city" value="city" checked>
						Change City
					</label>
				</div>
				<div class="radio">
					<label for="">
						<input type="radio" name="kreate-tax-method" id="kreate-tax-method-country" value="country">
						Change Country
					</label>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Start Mass Change</button>
	</form>
</div>