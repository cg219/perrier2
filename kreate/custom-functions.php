<?
	function make_video_player( $id, $type, $width, $height ){
		$url = $type == "vimeo" ? "//player.vimeo.com/video/" . $id : "//www.youtube.com/embed/" . $id;
		$player = "<iframe src='$url' width='$width' height='$height' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";

		return $player;
	}

	function make_slider_image_array( array $ids ){
		$images = array();

		foreach($ids as $id){
			$attachment = get_post( $id );

			$images[] = array(
				"url" => $attachment->guid,
				"caption" => $attachment->post_excerpt,
				"desc" => $attachment->post_content,
				"id" => $id
			);
		}

		return $images;
	}

        
	function make_slider_markup( array $images ){
		$length = count($images);
		$arrows .= "<button type='button' class='prev'></button><button type='button' class='next'></button>";
		$markup .= "<div class='slider' data-amount='$length'>$arrows<div class='slider_images'>";

		foreach($images as $image){
			$url = $image["url"];
			$crop = wp_get_attachment_image($image["id"], array(720,480));
			$img .= "<div class='slide_image_holder'><img data-image='$url' " . substr($crop, 5, strlen($crop) - 5) . "</div>";
		}
		$markup .= $img . "</div></div>";

		return $markup;
	}
        
        /*
         * To check for the most shared globallly all we need to do is suppply the following URL
         * https://api.addthis.com/analytics/1.0/pub/shares/url.json?pubid=ra-4f79efcc72cb6d9e 
         * and add a user name password
         */
        function get_trending_global() {

    $base_url = 'https://kmarino@mirrorball.com:mirrorball123@api.addthis.com/analytics/1.0/pub/shares/url.json?pubid=ra-4f79efcc72cb6d9e';
     
    $trends = array();
    $url = $base_url;



    $result = file_get_contents($url);
    $resobj = json_decode($result);

    for ($i = 0; $i < 5; $i++) {
        $trends[$resobj[$i]->{'shares'}] = $resobj[$i]->{'url'};
    }


    return $trends;
     }

        
        function get_trending($domain) {


    $base_url = 'http://q.addthis.com/feeds/1.0/trending.json?pubid=ra-4f79efcc72cb6d9e&period=week&domain=';

    $trends = array();
    $url = $base_url . $domain;

    $result = file_get_contents($url);
    $resobj = json_decode($result);

    for ($i = 0; $i < 5; $i++) {
        $trends[$resobj[$i]->{'title'}] = $resobj[$i]->{'url'};
    }


    return $trends;
}

// function get_post_terms(){
		
	// }

	// function addDefaultTerms(){
	// 	$country = get_option("plugin_options")["country"];
	// 	$city = get_option("plugin_options")["city"];

	// 	$countryExists = term_exists($country, "country");

	// 	echo $countryExists;
	// 	if( $countryExists == 0 || $countryExists == null){
	// 		wp_insert_term( $country, "country", array(
	// 			"slug" => strtolower($country),
	// 			"description" => "Country",
	// 			"parent" => 0
	// 		));

	// 		echo "Added";
	// 	}
	// }

	// add_action("after_setup_theme", addDefaultTerms);
?>