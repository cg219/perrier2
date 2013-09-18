<?
	get_template_part("consts");

	if( isset($_POST["kreate-tax-name"]) && $_POST["kreate-tax-name"] != "" ):
		
		$term = $_POST["kreate-tax-name"];
		$slug = $_POST["kreate-tax-slug"];
		$tax = $_POST["kreate-tax-type"];
		$method = $_POST["kreate-tax-method"];

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

			if($slug){
				$arr = array(
					"slug" => $slug
				);
			}

			wp_insert_term(
				$term,
				$tax,
				$arr
			);

			$termID = get_term_by("name", $term, $tax);
		}



		foreach($posts as $post) :
			if( $method === "fill" ):
				$hasTerm = wp_get_post_terms($post->ID, $tax);
				$hasTerm = count($hasTerm) > 0 ? true : false;
				if(!$hasTerm) :
					wp_set_post_terms($post->ID, $termID->term_id, $tax);
				endif;
				continue;
			endif;

			wp_set_post_terms($post->ID, $termID->term_id, $tax);

		endforeach; ?>
<div class="alert alert-success"><strong>UPDATED!</strong></div>
<?	endif; ?>
<div class="container">
	<h2>Bulk City / Country Editor</h2>
	<form id="kmt-form" method="post" action="" role="form">
		<div class="row">
			<div class="col-lg-4">
				<input class="form-control" type="text" name="kreate-tax-name" id="kreate-tax-name" placeholder="Tax Name">
			</div>
			<div class="col-lg-4">
				<input class="form-control" type="text" name="kreate-tax-slug" id="kreate-tax-slug" placeholder="Tax Slug">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<h3 class="lead">Choose Taxonomy</h3>
				<div class="radio">
					<label for="">
						<input type="radio" name="kreate-tax-type" id="kreate-tax-method-city" value="city" checked>
						Change City
					</label>
				</div>
				<div class="radio">
					<label for="">
						<input type="radio" name="kreate-tax-type" id="kreate-tax-method-country" value="country">
						Change Country
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<h3 class="lead">Choose Method</h3>
				<div class="radio">
					<label for="">
						<input type="radio" name="kreate-tax-method" id="kreate-tax-add-method" value="add" checked>
						Add New Taxonomy
					</label>
				</div>
				<div class="radio">
					<label for="">
						<input type="radio" name="kreate-tax-method" id="kreate-tax-fill-method" value="fill">
						Fill in New Taxonomy
					</label>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Start</button>
	</form>
</div>