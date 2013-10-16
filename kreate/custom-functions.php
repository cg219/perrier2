<?
	get_template_part("consts");

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
		$markup .= "<div class='slider' data-index='0' data-amount='$length'>$arrows<div class='slider_images'>";

		foreach($images as $image){
			$url = $image["url"];
			$crop = wp_get_attachment_image($image["id"], array(720,480));
			$caption = get_post($image["id"])->post_excerpt;
			$img .= "<div class='slide_image_holder'><p class='caption'>" . $caption . "</p><img data-image='$url' " . substr($crop, 5, strlen($crop) - 5) . "</div>";
		}
		$markup .= $img . "</div></div>";

		return $markup;
	}

	function get_trending_posts($global = false){
		
		if($global):
			$blogs = get_blog_list(0, 'all');
			$trends = array();
			foreach ($blogs as $blog):
                    switch_to_blog($blog['blog_id']);
                	$query = make_trend_query(2);
                	if(count($trends) > 0):
						$trends = array_merge($trends, set_trend($query));
					else:
						$trends = set_trend($query);
					endif;
                	restore_current_blog();
            endforeach;

            uasort($trends, function($a, $b){
                if( $a->time == $b->time ) return 0;

                return ($a->time > $b->time) ? -1 : 1;
            });

            return array_slice($trends, 0, 5);
		else:
			$query = make_trend_query();
			$trends = set_trend($query);
			return $trends;
		endif;
	}

	function make_trend_query($limit = 5){
		$args = array(
			"meta_key" => "_perrier2_pageviews",
			"orderby" => "meta_value_num",
			"posts_per_page" => $limit,
			"meta_query" => array(
				array(
					"key" => "_perrier2_pageviews"
				)
			)
		);

		return $meta_query = new WP_Query($args);
	}

	function set_trend($query){
		$array = array();

		if( $query->have_posts() ):
			while($query->have_posts()) :
				$query->the_post();

				$trend = new stdClass();
				$trend->title = get_the_title();
				$trend->categories = wp_get_post_terms(get_the_ID(), "primary_category");
				$trend->permalink = get_permalink();
				$trend->views = get_post_meta(get_the_ID(), "_perrier2_pageviews", true);
				array_push($array, $trend);
			endwhile;
		endif;

		return $array;
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


	/* Global Hotspot Stuff */

	function kreate_get_blogs(){
		global $wpdb;

		// $blogs = get_site_transient("all_blogs");
		$blogs = false;

		if( $blogs === false ){
			$blogs = $wpdb->get_results( esc_sql( "SELECT * FROM " . $wpdb->base_prefix . "blogs ORDER BY blog_id" ) );
			set_site_transient("all_blogs", $blogs, 604800);
		}

		return $blogs;		
	}

	function kreate_create_hotspot_list(){
		$blogs = kreate_get_blogs();

		$hotspots = array();

		foreach($blogs as $blog){
			switch_to_blog($blog->blog_id);
			$query = new WP_Query( array(
				"post_type" => "hotspot",
				"posts_per_page" => -1
			));

			if($query->have_posts()){
				foreach($query->posts as $post){
					$post->blog_id = $blog->blog_id;
					$post->city = wp_get_post_terms($post->ID, "city");
					$post->city = $post->city[0];
					$hotspots[] = $post;
				}
					
			}
			restore_current_blog();
		}
		// print_r($hotspots);
		set_site_transient("all_hotspots", $hotspots);
		return $hotspots;
	}

	function kreate_get_hotspot_list(){
		$hotspots = get_site_transient("all_hotspots");

		if( !$hotspots ){
			return kreate_create_hotspot_list();
		}

		return $hotspots;
	}

	function kreate_get_cities(){
		return get_terms("city");
	}

	function kreate_get_all_cities(){
		$blogs = kreate_get_blogs();
		// print_r($blogs);
		$cities;

		foreach($blogs as $blog){
			switch_to_blog($blog->blog_id);
			$cities[] = get_terms("city");
			restore_current_blog();
		}

		return $cities;
	}

	function check_if_global($postID){
		if(! wp_is_post_revision( $postID )) :

			$blogs = kreate_get_blogs();
			$options = get_option("plugin_options");
			$globalBlogID = $options["global_blog"] ? $options["global_blog"] : $blogs[1]->blog_id;
			$post = get_post($postID, ARRAY_A);
			$dupe = array();

			if( get_post_meta($postID, meta . "enable_add_to_global", true) === "on" ) :

				remove_action( "save_post", "check_if_global", 100, 1 );

				foreach($post as $key=>$value) :
					if($key !== "ID"):
						$dupe[$key] = $value;
					endif;
				endforeach;

				$currentBlogID = get_current_blog_id();
				switch_to_blog($globalBlogID);
				$dupe["original_blog_id"] = $currentBlogID;
				$dupe["original_post_id"] = $postID;
				$newID = wp_insert_post($dupe);
				add_post_meta($newID, "original_blog_id", $currentBlogID);
				add_post_meta($newID, "original_post_id", $postID);
				restore_current_blog();

				delete_post_meta($postID, meta . "enable_add_to_global");
				delete_post_meta($postID, meta . "add_to_global");
				// wp_update_post($post);
				add_action( "save_post", "check_if_global", 100, 1 );
			endif;
		endif;
	}

	function shorten($url){
		//login information
		$login = 'societeperrier';  //your bit.ly login
		$apikey = 'R_66f1708f86b22fd762c564cbbfb414f3'; //bit.ly apikey
		$format = 'json'; //choose between json or xml
		$version = '2.0.1';

		//create the URL
		$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$apikey.'&format='.$format;

		//get the url
		//could also use cURL here
		$response = file_get_contents($bitly);

		$json = @json_decode($response,true);

		// print_r("parse_url()");
		// print_r(parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
		return $json['results'][$url]['shortUrl'];
	}

	function twitterTitle($title, $country){
		$countries = array(
			"brazil" => "sperrier_bra",
			"canada" => "SPerrier_CA",
			"germany" => "sperrier_ger",
			"israel" => "sperrier_TLV",
			"japan" => "sperrier_TYO",
			"lebanon" => "SPerrier_BEY",
			"mexico" => "Societe_MX",
			"russia" => "sperrier_mos",
			"spain" => "sperrier_es",
			"turkey" => "sperrier_tr",
			"uae" => "societe_dxb",
			"uk" => "sperrier_ldn",
			"us" => "SPerrier_USA",
			"venezuela" => "SocietePerrierV"
		);

		$at = in_array($countries[$country], $countries) ? $countries[$country] : "SPerrier_USA";
		return $at;

	}

	function newgravatar ($avatar_defaults) {
	    $myavatar = get_template_directory_uri() . '/assets/images/gravatar.jpg';
	    $avatar_defaults[$myavatar] = "Own";
	    return $avatar_defaults;
	}

	function kreate_excerpt($excerpt){
		if( count($excerpt) <= 200 ) :
			return $excerpt;
		else :
			return substr($excerpt, 0, 200) . "...";
		endif;
	}
	function unregister_category(){
		global $wp_taxonomies;
		$taxonomy = 'category';
		if ( taxonomy_exists( $taxonomy))
			unset( $wp_taxonomies[$taxonomy]);
	}

	add_action( 'init', 'unregister_category');
	add_filter( 'avatar_defaults', 'newgravatar' );
	add_action( "save_post", "check_if_global", 100, 1 );
?>