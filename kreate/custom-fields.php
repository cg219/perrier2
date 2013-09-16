<?
	function recipe_metaboxes_kreate( array $boxes ){
		$prefix = "_perrier2_";

		$boxes[] = array(
			"id" => "recipe_metabox",
			"title" => "Recipe Information",
			"pages" => array("recipe"),
			"context" => "normal",
			"priority" => "high",
			"show_names" => true,
			"fields" => array(
				array(
					"name" => "Recipe Name",
					"desc" => "The name of the recipe",
					"id" => $prefix . "recipe_name",
					"type" => "text"
				),
				array(
					"name" => "Created By:",
					"desc" => "The creator",
					"id" => $prefix . "recipe_creator",
					"type" => "text"
				),
				array(
					"name" => "Ingredients:",
					"desc" => "The ingredients",
					"id" => $prefix . "recipe_ingredients",
					"type" => "wysiwyg"
				),
				array(
					"name" => "Process:",
					"desc" => "The directions",
					"id" => $prefix . "recipe_process",
					"type" => "textarea"
				)
			)
		);

		return $boxes;
	}
	
	function hotspot_metaboxes_kreate( array $boxes ){
		$prefix = "_perrier2_";

		$boxes[] = array(
			"id" => "hotspot_metabox",
			"title" => "Hotspot Information",
			"pages" => array("hotspot"),
			"context" => "normal",
			"priority" => "high",
			"show_names" => true,
			"fields" => array(
				array(
					"name" => "Hotspot Name:",
					"desc" => "The name of the hotspot",
					"id" => $prefix . "hotspot_name",
					"type" => "text"
				),
				array(
					"name" => "Address Line 1:",
					"desc" => "The address 1",
					"id" => $prefix . "hotspot_address1",
					"type" => "text"
				),
				array(
					"name" => "Address Line 2:",
					"desc" => "The address 2",
					"id" => $prefix . "hotspot_address2",
					"type" => "text"
				),
				array(
					"name" => "Country:",
					"desc" => "The country",
					"id" => $prefix . "hotspot_country",
					"type" => "text"
				),
				array(
					"name" => "Phone Number:",
					"id" => $prefix . "hotspot_phone",
					"type" => "text"
				),
				array(
					"name" => "Website:",
					"id" => $prefix . "hotspot_url",
					"type" => "text"
				),
				array(
					"name" => "Facebook:",
					"id" => $prefix . "hotspot_fb",
					"type" => "text"
				),
				array(
					"name" => "Twitter:",
					"id" => $prefix . "hotspot_twitter",
					"type" => "text"
				),
				array(
					"name" => "Instagram:",
					"id" => $prefix . "hotspot_ig",
					"type" => "text"
				),
				array(
					"name" => "Preferred Hotspot",
					"id" => $prefix . "hotspot_preferred",
					"type" => "checkbox"
				)
			)
		);

		return $boxes;
	}
	
	function luminary_metaboxes_kreate( array $boxes ){
		$prefix = "_perrier2_";

		$boxes[] = array(
			"id" => "luminary_metabox",
			"title" => "Luminary Information",
			"pages" => array("luminary"),
			"context" => "normal",
			"priority" => "high",
			"show_names" => true,
			"fields" => array(
				array(
					"name" => "Luminary Name:",
					"id" => $prefix . "luminary_name",
					"type" => "text"
				),
				array(
					"name" => "Known For:",
					"id" => $prefix . "luminary_fame",
					"type" => "text"
				),
				array(
					"name" => "Location:",
					"id" => $prefix . "luminary_location",
					"type" => "text"
				),
				array(
					"name" => "Website:",
					"id" => $prefix . "luminary_url",
					"type" => "text"
				),
				array(
					"name" => "Facebook:",
					"id" => $prefix . "luminary_fb",
					"type" => "text"
				),
				array(
					"name" => "Twitter:",
					"id" => $prefix . "luminary_twitter",
					"type" => "text"
				),
				array(
					"name" => "Instagram:",
					"id" => $prefix . "luminary_ig",
					"type" => "text"
				)
			)
		);

		return $boxes;
	}

	function video_metabox_kreate( array $boxes ){
		$prefix = "_perrier2_";

		$boxes[] = array(
			"id" => "video_metabox",
			"title" => "Video Settings",
			"pages" => array("post", "luminary", "hotspot"),
			"context" => "normal",
			"priority" => "high",
			"show_names" => true,
			"fields" => array(
				array(
					"name" => "Video ID",
					"desc" => "Enter the Video ID. This is the string after the '?v='.<br/>Youtube Example: http://www.youtube.com/watch?v=-mzW9T2okSE - ID = '-mzW9T2okSE'.<br/>Vimeo Example: http://vimeo.com/73564884 - ID = '73564884'",
					"id" => $prefix . "video_id",
					"type" => "text"
				),
				array(
					"name" => "Type",
					"desc" => "Choose wheter this is a Vimeo or Youtube video.",
					"id" => $prefix . "video_type",
					"type" => "radio_inline",
					"options" => array(
						array( "name" => "Youtube", "value" => "youtube" ),
						array( "name" => "Vimeo", "value" => "vimeo" )
					)
				),
				array(
					"name" => "Use Video as Feature",
					"id" => $prefix . "video_as_feature",
					"type" => "checkbox"
				)
			)
		);

		return $boxes;
	}

	function slider_metabox_kreate( array $boxes ){
		$prefix = "_perrier2_";

		$boxes[] = array(
			"id" => "slider_metabox",
			"title" => "Slider Settings",
			"pages" => array("post", "luminary", "hotspot"),
			"context" => "normal",
			"priority" => "high",
			"show_names" => true,
			"fields" => array(
				array(
					"name" => "Image IDs",
					"desc" => "List Image ID's seperated by commas.",
					"id" => $prefix . "slider_ids",
					"type" => "text"
				),
				array(
					"name" => "Use Slider as Feature",
					"id" => $prefix . "slider_as_feature",
					"type" => "checkbox"
				)
			)
		);

		return $boxes;
	}

	function metabox_kreate( array $boxes ){
		$prefix = "_perrier2_";

		$boxes[] = array(
			"id" => "reg_metabox",
			"title" => "Extra Fields",
			"pages" => array("post", "recipe", "luminary", "hotspot"),
			"context" => "normal",
			"priority" => "high",
			"show_names" => true,
			"fields" => array(
				array(
					"name" => "Sub Header",
					"desc" => "Second Headline",
					"id" => $prefix . "subline",
					"type" => "text"
				)
			)
		);

		return $boxes;
	}

	function init_metaboxes(){
		if( !class_exists("cmb_Meta_Box") ){
			require_once(__DIR__ . "/../metas/init.php");
		}
	}

	add_filter( "cmb_meta_boxes", "metabox_kreate");
	add_filter( "cmb_meta_boxes", "recipe_metaboxes_kreate");
	add_filter( "cmb_meta_boxes", "hotspot_metaboxes_kreate");
	add_filter( "cmb_meta_boxes", "luminary_metaboxes_kreate");
	add_filter( "cmb_meta_boxes", "video_metabox_kreate");
	add_filter( "cmb_meta_boxes", "slider_metabox_kreate");
	add_action( "init", "init_metaboxes", 9999);
?>