<?
	if(isset($_POST["kreate-start-update"])){
		$args = array(
			"post_type" => "post",
			"tax_query" => array(
				array(
					"taxonomy" => "special-post-type",
					"field" => "slug",
					"terms" => "event"
				)
			),
			"posts_per_page" => -1
		);

		$events = new WP_Query($args);

		if($events->have_posts()){
			while($events->have_posts()){
				$events->the_post();

				global $post;

				$content = $post->post_content;
				$meta = "<p>Event Info<br/>";
				$meta .= get_post_meta(get_the_ID(), "_mbl_event_date", true) . "<br/>";
				$meta .= get_post_meta(get_the_ID(), "_mbl_event_time", true) . "<br/>";
				$meta .= get_post_meta(get_the_ID(), "_mbl_event_address01", true) . "<br/>";
				$meta .= get_post_meta(get_the_ID(), "_mbl_event_address02", true) . "<br/>";
				$meta .= get_post_meta(get_the_ID(), "_mbl_event_city", true) . "<br/>";
				$meta .= get_post_meta(get_the_ID(), "_mbl_event_state", true) . "<br/>";
				$meta .= get_post_meta(get_the_ID(), "_mbl_event_zip", true);
				$meta .= "</p>";

				$content .= $meta;

				$updated_post = array(
					"ID" => $post->ID,
					"post_content" => $content
				);

				delete_post_meta($post->ID, "_mbl_event_date");
				delete_post_meta($post->ID, "_mbl_event_time");
				delete_post_meta($post->ID, "_mbl_event_address01");
				delete_post_meta($post->ID, "_mbl_event_address02");
				delete_post_meta($post->ID, "_mbl_event_city");
				delete_post_meta($post->ID, "_mbl_event_state");
				delete_post_meta($post->ID, "_mbl_event_zip");
			}
		}
	}
?>

<div class="container">
	<h2>Legacy Event Type Updater</h2>
	<form action="" role="form" method="post">
		<button type="submit" class="btn btn-primary">Start Event Update</button>
		<input type="hidden" name="kreate-start-update" value="true" />
	</form>
</div>