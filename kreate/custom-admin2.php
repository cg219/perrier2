<?
	add_action("admin_menu", "kreate_add_cities");

	function kreate_add_citied_load_external(){
		wp_register_style("taxonomy-add-styles", get_template_directory_uri() . "/css/bootstrap.min.css");
		wp_register_script("bootstrap", get_template_directory_uri() . "/js/bootstrap.min.js");
	}

	function kreate_add_cities(){
		$cities_admin_page = add_management_page(
			"Kreate Cities/Countries",
			"Kreate Cities/Countries",
			"manage_options",
			__FILE__,
			"display_add_cities_page"
		);

		add_action("admin_head-" . $cities_admin_page, "add_externals");
	}

	function add_externals(){
		wp_enqueue_style("taxonomy-add-styles", get_template_directory_uri() . "/css/bootstrap.min.css");
		wp_enqueue_script("bootstrap", get_template_directory_uri() . "/js/bootstrap.min.js", array("jquery"), false, true);
	}

	function display_add_cities_page(){
		include("pages/taxonomy-add.php");
	}
?>