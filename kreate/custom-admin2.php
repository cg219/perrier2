<?
	add_action("admin_menu", "kreate_add_cities");
	add_action("admin_menu", "kreate_update_events");

	function add_externals(){
		wp_enqueue_style("taxonomy-add-styles", get_template_directory_uri() . "/css/bootstrap.min.css");
		wp_enqueue_script("bootstrap", get_template_directory_uri() . "/js/bootstrap.min.js", array("jquery"), false, true);
	}

	/*
		Add Country/City Admin
	*/

	function kreate_add_cities(){
		$cities_admin_page = add_management_page(
			"Kreate Cities/Countries",
			"Kreate Cities/Countries",
			"manage_options",
			"-kreate_add_cities",
			"display_add_cities_page"
		);

		add_action("admin_head-" . $cities_admin_page, "add_externals");
	}

	function display_add_cities_page(){
		include("pages/taxonomy-add.php");
	}

	/*
		Update Events Admin
	*/

	function kreate_update_events(){
		$events_admin_page = add_management_page(
			"Kreate Update Events",
			"Kreate Update Events",
			"manage_options",
			"-kreate_update_events",
			"display_update_events_page"
		);

		add_action("admin_head-" . $events_admin_page, "add_externals");
	}

	function display_update_events_page(){
		include("pages/events-update.php");
	}
?>