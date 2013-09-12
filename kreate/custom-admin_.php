<?php

add_option("plugin_options", "plugin_options" );

add_action('admin_menu', 'create_theme_options_page');
add_action('admin_init', 'register_and_build_fields');

function create_theme_options_page() {
   add_options_page('Perrier 2.0 Options', 'Perrier 2.0 Options', 'administrator', __FILE__, 'options_page_fn');
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

function country_setting_kreate() {
   $val = get_option("plugin_options")["country"] ? get_option("plugin_options")["country"] : "";
   echo '<input class="input-lg" type="text" name="plugin_options[country]" value="' . $val . '" />';
}

function city_setting_kreate() {
   $val = get_option("plugin_options")["city"] ? get_option("plugin_options")["city"] : "";
   echo '<input class="input-lg" type="text" name="plugin_options[city]" value="' . $val . '" />';
}

function twitter_setting_kreate() {
   $val = get_option("plugin_options")["twitter"] ? get_option("plugin_options")["twitter"] : "";
   echo '<input class="input-lg" type="text" name="plugin_options[twitter]" value="' . $val . '" />';
}

function fb_setting_kreate() {
   $val = get_option("plugin_options")["facebook"] ? get_option("plugin_options")["facebook"] : "";
   echo '<input class="input-lg" type="text" name="plugin_options[facebook]" value="' . $val . '" />';
}

function yt_setting_kreate() {
   $val = get_option("plugin_options")["youtube"] ? get_option("plugin_options")["youtube"] : "";
   echo '<input class="input-lg" type="text" name="plugin_options[youtube]" value="' . $val . '" />';
}

function ig_setting_kreate() {
   $val = get_option("plugin_options")["instagram"] ? get_option("plugin_options")["instagram"] : "";
   echo '<input class="input-lg" type="text" name="plugin_options[instagram]" value="' . $val . '" />';
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

function section_cb() {}

// Add stylesheet
add_action('admin_head', 'admin_register_head');

function admin_register_head() {
   $bootstrap = get_bloginfo('template_directory') . '/css/bootstrap.min.css';
   $url = get_bloginfo('template_directory') . '/css/admin-options.css';
   // echo "<link rel='stylesheet' href='$bootstrap' />\n";
   echo "<link rel='stylesheet' href='$url' />\n";
}
?>