<?
	add_action("admin_menu", "kreate_add_cities");
	add_action("admin_menu", "kreate_update_events");

	add_option("plugin_options", "plugin_options" );
	add_action('admin_menu', 'create_theme_options_page');

	add_action('admin_init', 'register_and_build_fields');

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

	/*
		Options Page
	*/

	function create_theme_options_page() {
	   $options_page = add_options_page(
	   		'Perrier 2.0 Options',
	   		'Perrier 2.0 Options',
	   		'administrator',
	   		__FILE__,
	   		'options_page_fn'
	   	);

		add_action('admin_head-' . $options_page , 'options_styles');
	}

	function options_styles() {
	   $bootstrap = get_bloginfo('template_directory') . '/css/bootstrap.min.css';
	   $url = get_bloginfo('template_directory') . '/css/admin-options.css';
	   // echo "<link rel='stylesheet' href='$bootstrap' />\n";
	   echo "<link rel='stylesheet' href='$url' />\n";
	}

	function register_and_build_fields() {
	   register_setting('plugin_options', 'plugin_options', 'validate_setting');

	   add_settings_section('main_section', 'Main Settings', 'section_cb', __FILE__);
	   add_settings_section('social_section', 'Social Settings', 'section_cb', __FILE__);

	   add_settings_field("country", "Default Country:", "country_setting_kreate", __FILE__, "main_section");
	   add_settings_field("city", "Default City:", "city_setting_kreate", __FILE__, "main_section");

	   add_settings_field("twitter", "Twitter:", "twitter_setting_kreate", __FILE__, "social_section");
	   add_settings_field("facebook", "Facebook:", "fb_setting_kreate", __FILE__, "social_section");
	   add_settings_field("youtube", "Youtube:", "yt_setting_kreate", __FILE__, "social_section");
	   add_settings_field("instagram", "Instagram:", "ig_setting_kreate", __FILE__, "social_section");
	}

	function country_setting_kreate() {
	   $val = get_option("plugin_options") ? get_option("plugin_options") : "";
	   $val = $val["country"];
	   echo '<input class="input-lg" type="text" name="plugin_options[country]" value="' . $val . '" />';
	}

	function city_setting_kreate() {
	   $val = get_option("plugin_options") ? get_option("plugin_options") : "";
	   $val = $val["city"];
	   echo '<input class="input-lg" type="text" name="plugin_options[city]" value="' . $val . '" />';
	}

	function twitter_setting_kreate() {
	   $val = get_option("plugin_options")? get_option("plugin_options") : "";
	   $val = $val["twitter"];
	   echo '<input class="input-lg" type="text" name="plugin_options[twitter]" value="' . $val . '" />';
	}

	function fb_setting_kreate() {
	   $val = get_option("plugin_options") ? get_option("plugin_options") : "";
	   $val = $val["facebook"];
	   echo '<input class="input-lg" type="text" name="plugin_options[facebook]" value="' . $val . '" />';
	}

	function yt_setting_kreate() {
	   $val = get_option("plugin_options") ? get_option("plugin_options") : "";
	   $val = $val["youtube"];
	   echo '<input class="input-lg" type="text" name="plugin_options[youtube]" value="' . $val . '" />';
	}

	function ig_setting_kreate() {
	   $val = get_option("plugin_options") ? get_option("plugin_options") : "";
	   $val = $val["instagram"];
	   echo '<input class="input-lg" type="text" name="plugin_options[instagram]" value="' . $val . '" />';
	}

	function section_cb() {}

	function options_page_fn() {
?>
   <div id="theme-options-wrap" class="widefat">
      <div class="icon32" id="icon-tools"></div>

      <h2>Perrier 2.0 Options</h2>

      <form method="post" action="options.php" enctype="multipart/form-data">
         <?php settings_fields('plugin_options'); ?>
         <?php do_settings_sections(__FILE__); ?>
         <p class="submit">
            <input name="Submit" type="submit" class="btn btn-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
         </p>
   </form>
</div>
<?php
}

	function validate_setting($plugin_options) {
	   $keys = array_keys($_FILES);
	   $i = 0;

	   foreach ($_FILES as $image) {
	      // if a files was upload
	      if ($image['size']) {
	         // if it is an image
	         if (preg_match('/(jpg|jpeg|png|gif)$/', $image['type'])) {
	            $override = array('test_form' => false);
	            $file = wp_handle_upload($image, $override);

	            $plugin_options[$keys[$i]] = $file['url'];
	         } else {
	            $options = get_option('plugin_options');
	            $plugin_options[$keys[$i]] = $options[$logo];
	            wp_die('No image was uploaded.');
	         }
	      }

	      // else, retain the image that's already on file.
	      else {
	         $options = get_option('plugin_options');
	         $plugin_options[$keys[$i]] = $options[$keys[$i]];
	      }
	      $i++;
	   }

	   return $plugin_options;
	}

?>