<?php

/* Custom Fields */

if ( ! class_exists( 'mbl_customFields' ) ) {

  class mbl_customFields {

    /* The prefix for storing custom fields in the postmeta table
    ***************************************************************************************/
    // It should begin with an underscore so it won't appear in the normal custom fields meta box, and should remain constant!
    var $prefix = '_mbl_';
    
    /* Initialize the post types array
    ***************************************************************************************/
    // Types are automatically added in the constructor
    var $postTypes = array();
    
    /* Define the meta boxes to contain the custom fields
    ***************************************************************************************/
    // Each entry in the array should have a unique box ID for the key, and the contain the following values
    // title      - string - A title for the box (required)
    // context    - string - normal | advanced | side - Where to place the box (optional; defaults to "advanced")
    // priority   - string - default | high | low (optional; defaults to "default")
    var $boxes = array(
      "post_options"  =>  array("title"   => "Post Options"),
      "address"       =>  array("title"   => "Address"),
      "url"           =>  array("title"   => "Link"),
      "staff"         =>  array("title"   => "Staff"),
      "event"         =>  array("title"   => "Event"),
      "mixology"      =>  array("title"   => "Mixology"),
    );

    /* Define the custom fields available
    ***************************************************************************************/
    /*
    box       - string - The ID of the box this field will be assigned to (required; must correspond to a box defined in $boxes above)
    name        - string - The name of the field (required)
    label       - string - A label for the field (required)
    labelstyle    - string [ block | inline ] - How to display the label (optional; only for select and text field types; defaults to inline)
    description   - string - A description for the field (optional)
    type        - string - text | textarea | textile | wysiwyg | select | radio | checkbox | checkboxes - The type of field (optional; defaults to "text")
    multiple      - boolean - Whether a "select" field type should allow multiple selections or not (optional; defaults to false)
    optionsType   - string - [ static | posts ] - For "select", "radio" and "checkboxes" field types; define your own for custom data (required for these field types)
    optionsQuery  - string - If optionsType isn't "static", this contains query information, e.g. for get_posts() for the "posts" options type (required if optionsType isn't "static")
    options     - array - If optionsType is "static", this contains pre-defined data, e.g. array( "label1" => "value1", "label2" => "value2" )
                    - To create optgroups for selects, put entries in the array like "optgroup label" => "[optgroup]"
    width       - integer - Width in ems of the element; for checkboxes and radio, the width applies to the input plus the label; if set to 0 for checkboxes and radio, each option will occupy a line to itself (optional)
    height      - integer - Height in ems of the element (optional)
    scope       - array - The post types this field will apply to (required)
    capabilities  - array - Capabilities required to manage this field; the user needs any, not all, of these ccapabilities (required)
    charcounter   - boolean - For textarea and textile fields, includes a JavaScript character counter (optional; defaults to false)
    allowtags   - array - For text and textarea fields, allows these HTML tags (optional; defaults to none)
    autop       - boolean - For textarea fields, whether to automatically convert line breaks to paragraph and break tags; this is automatically done for textile and WYSIWYG fields (optional; defaults to false)
    hideLabel   - boolean - Hide the label when there's only one field and the box title will serve this purpose (optional; defaults to false)
    */
    var $customFields = array(
      array(
        "box"       => "post_options",
        "name"      => "hide_listing_image",
        "label"     => "Hide Listing Image in Post",
        "description" => "Do not show the listing image at the top of the post detail page",
        "type"      => "checkbox",
        "scope"     =>  array( "post" ),
        "capabilities"  => array( "edit_posts"),
      ),

      array(
        "box"       => "mixology",
        "name"      => "ingredients",
        "label"     => "Ingredients",
        "description" => "",
        "type"      => "textarea",
        "scope"     =>  array( "post" ),
        "capabilities"  => array( "edit_posts"),
      ),

      array(
        "box"       => "event",
        "name"      => "event_date",
        "label"     => "Event Date",
        "description" => "Format: YYYY-MM-DD",
        "type"      => "text",
        "classes"      => "date-pick",
        "scope"     =>  array( "post" ),
        "capabilities"  => array( "edit_posts"),
      ),

      array(
        "box"       => "event",
        "name"      => "event_time",
        "label"     => "Event Time",
        "description" => "Format: HH:MM",
        "type"      => "text",
        "scope"     =>  array( "post" ),
        "capabilities"  => array( "edit_posts"),
      ),

      array(
        "box"       => "staff",
        "name"      => "job_title",
        "label"     => "Job Title",
        "description" => "",
        "type"      => "text",
        "scope"     =>  array("staff" ),
        "capabilities"  => array( "edit_posts", "edit_features" ),
      ),

      array(
        "box"       => "staff",
        "name"      => "job_location",
        "label"     => "Location",
        "description" => "",
        "type"      => "text",
        "scope"     =>  array("staff" ),
        "capabilities"  => array( "edit_posts", "edit_features" ),
      ),



      array(
        "box"       => "url",
        "name"      => "url",
        "label"     => "URL",
        "description" => "",
        "type"      => "text",
        "scope"     =>  array( "post", "feature", "hotspot", "staff" ),
        "capabilities"  => array( "edit_posts", "edit_features" ),
      ),

      array(
        "box"       => "url",
        "name"      => "url_label",
        "label"     => "URL Label",
        "description" => "",
        "type"      => "text",
        "scope"     =>  array( "post", "hotspot" ),
        "capabilities"  => array( "edit_posts" ),
      ),

      array(
        "box"       => "address",
        "name"      => "address_01",
        "label"     => "Address 1",
        "description" => "",
        "type"      => "text",
        "scope"     =>  array( "post", "hotspot" ),
        "capabilities"  => array( "edit_posts" ),
      ),
      array(
        "box"       => "address",
        "name"      => "address_02",
        "label"     => "Address 2",
        "type"      => "text",
        "scope"     =>  array( "post", "hotspot" ),
        "capabilities"  => array( "edit_posts" ),
      ),
      array(
        "box"       => "address",
        "name"      => "city",
        "label"     => "City",
        "type"      => "text",
        "scope"     =>  array( "post", "hotspot" ),
        "capabilities"  => array( "edit_posts" ),
      ),
      array(
        "box"       => "address",
        "name"      => "state",
        "label"     => "State",
        "type"      => "text",
        "scope"     =>  array( "post", "hotspot" ),
        "capabilities"  => array( "edit_posts" ),
      ),
      array(
        "box"       => "address",
        "name"      => "zip",
        "label"     => "Zip",
        "type"      => "text",
        "scope"     =>  array( "post", "hotspot" ),
        "capabilities"  => array( "edit_posts" ),
      ),
  );

    /* Constructor
    ***************************************************************************************/
    function __construct() {
      // Add post types
      foreach ( get_post_types( '', 'names' ) as $postType )
        $this->postTypes[] = $postType;
      // Gather options data dynamically?
      foreach ( $this->customFields as &$customField ) {
        if ( isset( $customField['optionsType'] ) && $customField['optionsType'] != 'static' ) {
          switch ( $customField['optionsType'] ) {
            case "posts": {
              // Get posts
              $posts = get_posts( $customField['optionsQuery'] );
              $customField['options'] = array();
              foreach ( $posts as $postData )
                  $customField['options'][ $this->abbreviate( $postData->post_title ) ] = $postData->ID;
              break;
            }
          }
        }
      }       
      // Comment this line out if you want to keep default custom fields meta box
      // add_action( 'do_meta_boxes', array( &$this, 'removeDefaultMetaBox' ), 10, 3 );
      // Add meta boxes
      add_action( 'add_meta_boxes', array( &$this, 'addMetaBoxes' ) );
      // Save field values
      add_action( 'save_post', array( &$this, 'saveCustomFields' ), 1, 2 );
    }

    /* Remove the default Custom Fields meta box
    ***************************************************************************************/
    function removeDefaultMetaBox( $type, $context, $post ) {
      remove_meta_box( 'postcustom', $type, $context );
    }

    /* Add the required meta boxes
    ***************************************************************************************/
    function addMetaBoxes() {
      global $post;
      $outputBoxes = array();
      // Initialize current post type
      $postType = "post";
      if ( isset( $post->post_type ) ) {
        $postType = $post->post_type;
      } else if ( isset( $_GET['post_type'] ) ) {
        $postType = $_GET['post_type'];
      }
      // Loop through fields
      foreach ( $this->customFields as &$customField ) {
        $customField['output'] = 0;
        // Check scope
        // The test is by default simply based on post type, but more elaborate custom scopes could be implemented by adding cases to the switch statement
        foreach ( $customField['scope'] as $scopeItem ) {
          switch ( $scopeItem ) {
            default: {
              if ( $postType == $scopeItem )
                $customField['output'] = 1;
              break;
            }
          }
          if ( $customField['output'] )
            break;
        }
        // Check capability
        if ( ! $this->capabilityCheck( $customField['capabilities'], $post->ID ) )
          $customField['output'] = 0;
        // Flag box to be output?
        if ( $customField['output'] && array_key_exists( $customField['box'], $this->boxes ) && ! in_array( $customField['box'], $outputBoxes ) )
          $outputBoxes[] = $customField['box'];
      }
      // Output the necessary boxes
      foreach ( $outputBoxes as $outputBox ) {
        add_meta_box(
          $this->prefix . $outputBox,
          $this->boxes[$outputBox]['title'],
          array( &$this, 'displayCustomFields' ),
          $postType,
          isset( $this->boxes[$outputBox]['context'] ) ? $this->boxes[$outputBox]['context'] : "advanced",
          isset( $this->boxes[$outputBox]['priority'] ) ? $this->boxes[$outputBox]['priority'] : "default",
          array( 'box' => $outputBox )
        );
      }
    }
    
    /* Display the new Custom Fields meta box
    ***************************************************************************************/
    function displayCustomFields( $post, $customData ) {

      // Get the ID of the box we're in from the args
      $box = $customData['args']['box'];

      // Nonce for security
      wp_nonce_field( $this->prefix . $box . '_save', $this->prefix . $box . '_wpnonce', false, true );
        
      // Loop through fields
      foreach ( $this->customFields as $customField ) {

        // Output if the field is flagged and we're in the right box
        if ( $customField['output'] && $customField['box'] == $box ) {

          // Get field value
          $fieldValue = $this->getFieldValue( $customField['name'], $post->ID );
          
          // Reverse autop?
          if ( isset( $customField['autop'] ) && $customField['autop'] )
            $fieldValue = $this->reverseWpautop( $fieldValue );

          // Set defaults for styles and classes
          $labelClasses = array();
          $labelStyles = array( 'font-size:14px' );
          $inputClasses = array();
          $inputStyles = array();
          $legendStyles = array( 'font-weight:bold', 'font-size:14px', 'padding:0 0 7px' );
          if ( in_array( $customField['type'], array( 'checkboxes', 'radio' ) ) ) {
            $multiRadioCheckboxStyles = array();
            if ( ! isset( $customField['width'] ) || $customField['width'] > 0 ) {
              $multiRadioCheckboxStyles[] = 'float:left';
              $multiRadioCheckboxStyles[] = 'margin:0 7px 7px 0';
            }
            if ( isset( $customField['width'] ) )
              $multiRadioCheckboxStyles[] = $customField['width'] > 0 ? 'width:' . $customField['width'] . 'em' : 'margin-bottom: 7px';
          } else if ( isset( $customField['width'] ) ) {
            $inputStyles[] = 'width:' . $customField['width'] . 'em';
          }  else if ( in_array( $customField['type'], array( 'text', 'textarea', 'textile' ) ) ) {
            $inputStyles[] = 'width:97%';
          }
          if ( isset( $customField['height'] ) )
            $inputStyles[] = 'height:' . $customField['height'] . 'em';

          // This will hide the label / legend if there's only one field
          if ( isset( $customField['hideLabel'] ) && $customField['hideLabel'] ) {
            $labelClasses[] = 'screen-reader-text';
            $legendClasses[] = 'screen-reader-text';
          }

          if ( isset( $customField['classes'] ) && $customField['classes'] ) {
            $inputClasses[] = $customField['classes'];
          }
          
          ?>
          <div style="margin:20px 10px">
            <?php

            // Which type of field?
            switch ( $customField['type'] ) {

              case "checkbox": {
                /* Checkbox
                *****************************************************************/
                // Input
                echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
                if ( $fieldValue == "yes" )
                  echo ' checked="checked"';
                echo ' />';
                // Label
                echo ' <label for="' . $this->prefix . $customField['name'] .'" style="' . implode( ';', $labelStyles ) . '" class="' . implode( ' ', $labelClasses ) . '">' . $customField['label'] . '</label>';
                break;
              }

              case "checkboxes": {
                /* Checkboxes
                *****************************************************************/
                echo '<fieldset>';
                if ( count( $this->customFields ) > 1 )
                  echo '<legend style="' . implode( ';', $legendStyles ) . '" class="' . implode( ' ', $legendClasses ) . '">' . $customField['label'] . '</legend>';
                // Loop through options
                foreach ( $customField['options'] as $key => $value ) {
                  echo '<div style="' . implode( ';', $multiRadioCheckboxStyles ) . '">';
                  // Input
                  echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '_' . $value . '" id="' . $this->prefix . $customField['name'] . '_' . $value . '" value="yes"';
                  if ( is_array( $fieldValue ) && in_array( $value, $fieldValue )  )
                    echo ' checked="checked"';
                  echo ' />';
                  // Label
                  echo ' <label for="' . $this->prefix . $customField['name'] .'_' . $value . '">' . $key . '</label>';
                  echo '</div>';
                }
                echo '</fieldset>';
                break;
              }

              case "radio": {
                /* Radio buttons
                *****************************************************************/
                echo '<fieldset>';
                if ( count( $this->customFields ) > 1 )
                  echo '<legend style="' . implode( ';', $legendStyles ) . '" class="' . implode( ' ', $legendClasses ) . '">' . $customField['label'] . '</legend>';
                // Loop through options
                foreach ( $customField['options'] as $key => $value ) {
                  echo '<div style="' . implode( ';', $multiRadioCheckboxStyles ) . '">';
                  // Input
                  echo '<input type="radio" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '_' . $value . '" value="' . $value . '"';
                  if ( $fieldValue == $value )
                    echo ' checked="checked"';
                  echo ' />';
                  // Label
                  echo ' <label for="' . $this->prefix . $customField['name'] .'_' . $value . '">' . $key . '</label>';
                  echo '</div>';
                }
                echo '</fieldset>';
                break;
              }

              case "textarea":
              case "textile":
              case "wysiwyg": {
                /* Text area / textile / WYSIWYG
                *****************************************************************/
                // Label
                $labelStyles[] = 'display:block';
                $labelStyles[] = 'margin-bottom:5px';
                echo '<label for="' . $this->prefix . $customField['name'] .'" style="' . implode( ';', $labelStyles ) . '" class="' . implode( ' ', $labelClasses ) . '"><b>' . $customField['label'] . '</b></label>';
                // Input
                echo '<textarea name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="50" rows="5" style="' . implode( ';', $inputStyles ) . '" class="' . implode( ' ', $inputClasses ) . '"';
                // Character counter JS
                if ( $customField['type'] != "wysiwyg" && isset( $customField['charcounter'] ) && $customField['charcounter'] ) echo ' onkeyup="document.getElementById(\'' . $this->prefix . $customField['name'] . '-charcounter\').value=this.value.length;"';
                // Value
                if ( $customField['type'] == "textile" )
                  $fieldValue = $this->simpleFormatting( $fieldValue, "textile" );
                echo '>' . htmlspecialchars( $fieldValue ) . '</textarea>';
                // Character counter
                if ( $customField['type'] != "wysiwyg" && isset( $customField['charcounter'] ) && $customField['charcounter'] )
                  echo '<p>' . __( "Characters so far", "mbl-custom" ) . ': <input type="text" id="' . $this->prefix . $customField['name'] . '-charcounter" disabled="disabled" style="width:4em;color:#000;" value="' . strlen( $fieldValue ) . '" /></p>';
                // WYSIWYG
                if ( $customField['type'] == 'wysiwyg' ) { ?>
                  <script type="text/javascript">
                    jQuery( document ).ready( function() {
                      jQuery( "<?php echo $this->prefix . $customField['name']; ?>" ).addClass( 'mceEditor' );
                      if ( typeof( tinyMCE ) == 'object' && typeof( tinyMCE.execCommand ) == 'function' ) {
                        tinyMCE.execCommand( 'mceAddControl', false, '<?php echo $this->prefix . $customField["name"]; ?>' );
                      }
                    });
                  </script>
                <?php }
                break;
              }
                
              case "select": {
                /* Select dropdown
                *****************************************************************/
                // Label
                if ( isset( $customField['labelstyle'] ) && $customField['labelstyle'] == 'block' ) {
                  $labelStyles[] = 'display:block';
                  $labelStyles[] = 'margin-bottom:3px';
                } else {
                  $labelStyles[] = 'padding-right:10px';
                }
                echo '<label for="' . $this->prefix . $customField['name'] .'" style="' . implode( ';', $labelStyles ) . '" class="' . implode( ' ', $labelClasses ) . '"><b>' . $customField['label'] . '</b></label>';
                // Input
                if ( isset( $customField['multiple'] ) && $customField['multiple'] )
                  $inputStyles[] = 'height:auto';
                echo '<select name="' . $this->prefix . $customField['name'];
                if ( isset( $customField['multiple'] ) && $customField['multiple'] )
                  echo '[]';
                echo '" id="' . $this->prefix . $customField['name'] . '" style="' . implode( ';', $inputStyles ) . '" class="' . implode( ' ', $inputClasses ) . '"';
                if ( isset( $customField['multiple'] ) && $customField['multiple'] ) {
                  $size = ( count( $customField['options'] ) < 15 ) ? count( $customField['options'] ) : 15;
                  echo ' multiple="multiple" size="' . $size . '"';
                  
                }
                echo '>';
                // Handle option groups
                $optgroups = false;
                // Loop through options
                foreach ( $customField['options'] as $key => $value ) {
                  if ( $value == '[optgroup]' ) {
                    if ( $optgroups )
                      echo '</optgroup>';
                    echo '<optgroup label="' . $key . '">';
                    $optgroups = true;
                  } else {
                    echo '<option value="' . $value . '"';
                    if ( ( is_array( $fieldValue ) && in_array( $value, $fieldValue ) ) || $fieldValue == $value )
                      echo ' selected="selected"';
                    echo '>' . $key . '</option>';
                  }
                }
                if ( $optgroups )
                  echo '</optgroup>';
                echo '</select>';
                break;
              }
                
              default: {
                /* Plain text field
                *****************************************************************/
                // Label
                if ( isset( $customField['labelstyle'] ) && $customField['labelstyle'] == 'block' ) {
                  $labelStyles[] = 'display:block';
                  $labelStyles[] = 'margin-bottom:3px';
                } else {
                  $labelStyles[] = 'padding-right:10px';
                }
                echo '<label for="' . $this->prefix . $customField['name'] .'" style="' . implode( ';', $labelStyles ) . '" class="' . implode( ' ', $labelClasses ) . '"><b>' . $customField['label'] . '</b></label>';
                // Input
                echo '<input type="text" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="' . htmlspecialchars( $fieldValue ) . '" style="' . implode( ';', $inputStyles ) . '" class="' . implode( ' ', $inputClasses ) . '"';
                echo ' />';
                break;
              }
                
            } // End switch
            
            // Formatting hints
            if ( $customField['type'] == 'textile' ) {
              echo '<p>You can apply the following simple formatting codes: <b>**bold**</b></span>&nbsp;&nbsp;<i>__italic__</i>&nbsp;&nbsp;&quot;Link text&quot;:http://domain.com</p>';
            } else if ( isset( $customField['allowtags'] ) && is_array( $customField['allowtags'] ) && count( $customField['allowtags'] ) ) {
              echo '<p>You can use the following HTML tags: ';
              foreach ( $customField['allowtags'] as $tag ) echo '<code>&lt;' . $tag . '&gt;</code> ';
              echo '</p>';
            }
            if ( isset( $customField['autop'] ) && $customField['autop'] )
              echo '<p>Line and paragraph breaks will be maintained.</p>';
            
            // Description
            if ( isset( $customField['description'] ) ) echo '<p><i>' . $customField['description'] . '</i></p>';
              
            ?>

          </div><?php
          
        } // End if test for displaying field
        
      } // End foreach loop through fields
      
    } // End displayCustomFields function
    
    /* Save the new Custom Fields values
    ***************************************************************************************/
    function saveCustomFields( $post_id, $post ) {
    
      // Don't bother with any AJAX requests (e.g. autosave, quick edit)
      if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
        return $post_id;

      // Or with revisions
      if ( $post->post_type == 'revision' )
        return $post_id;
        
      // Initialize checks for each box's nonce
      $boxesNonceCheck = array();
        
      // Loop through fields
      foreach ( $this->customFields as $customField ) {
      
        // If for some reason the field is assigned to a non-existent box, ignore it
        if ( array_key_exists( $customField['box'], $this->boxes ) ) {
      
          // Do we need to check this field's box's nonce?
          if ( ! array_key_exists( $customField['box'], $boxesNonceCheck ) ) {
            // Store nonce check
            $nonce = $_POST[ $this->prefix . $customField['box'] . '_wpnonce' ];
            $boxesNonceCheck[ $customField['box'] ] = ( isset( $nonce ) && wp_verify_nonce( $nonce, $this->prefix . $customField['box'] . '_save' ) );
          }
        
          // Skip this field if the box's nonce failed
          if ( ! $boxesNonceCheck[ $customField['box'] ] )
            continue;

          // Skip this field if user isn't allowed to alter it
          if ( ! $this->capabilityCheck( $customField['capabilities'], $post_id ) )
            continue;
          
          // Multiple checkboxes are dealt with separately - gather values into array
          if ( $customField['type'] == 'checkboxes' ) {

            $value = array();
            foreach ( $customField['options'] as $optKey => $optValue ) {
              if ( isset( $_POST[ $this->prefix . $customField['name'] . '_' . $optValue ] ) )
                $value[] = $optValue;
            }
        
          } else if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) ) {

            $value = $_POST[ $this->prefix . $customField['name'] ];
            if ( is_string( $value ) )
              // Basic trim for strings
              $value = trim( $value );
            if ( isset( $customField['allowtags'] ) && count( $customField['allowtags'] ) ) {
              // Strip all tags except those allowed
              $value = strip_tags( $value, '<' . implode( '><', $customField['allowtags'] ) . '>' );
            } else if ( in_array( $customField['type'], array( 'text', 'textarea' ) ) ) {
              // If no tags are allowed, for text and textarea, strip all HTML
              $value = strip_tags( $value );
            }
            if ( $customField['type'] == 'wysiwyg' || ( isset( $customField['autop'] ) && $customField['autop'] ) ) {
              // Auto-paragraphs for WYSIWYG and other fields with autop set
              $value = wpautop( $value );
            } else if ( $customField['type'] == "textile" ) {
              // Textile formatting
              $value = $this->simpleFormatting( $value, "html" );
            }

          } else {
        
            // Set value to null
            $value = null;
        
          }

          // Save meta entry
          update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $value );
          
        }
        
      }
      
    }

    /* Capability check
    ***************************************************************************************/
    function capabilityCheck( $caps, $post_id ) {
      foreach ( $caps as $cap ) {
        if ( current_user_can( $cap, $post_id ) )
          return true;
      }
      return false;
    }

    /* Simple textile-style formatting codes
    ***************************************************************************************/
    // See http://snipplr.com/view/6108/mini-textile-class/
    function simpleFormatting( $content, $output = "html" ) {
      if ( $output == "html" ) {
        $regexes = array(
          '%\*\*([^\*]+)\*\*%',
          '%\_\_([^\_]+)\_\_%',
          '%(")(.*?)(").*?((?:http|https)(?::\/{2}[\\w]+)(?:[\/|\\.]?)(?:[^\\s"]*))%'
        ); 
        $replacements = array(
          '<strong>$1</strong>',
          '<em>$1</em>',
          '<a href="$4">$2</a>'
        );
        $content = strip_tags( $content );
        $content = preg_replace( $regexes, $replacements, $content );
        $content = wpautop( $content );
      } else {
        $regexes = array(
          '%<(/?)strong>%',
          '%<(/?)em>%',
          '%<a href="([^"]*)">([^<]*)</a>%'
        ); 
        $replacements = array(
          '**',
          '__',
          '"$2":$1'
        );
        $content = preg_replace( $regexes, $replacements, $content );
        $content = strip_tags( $content );
        $content = $this->reverseWpautop( $content );
      }
      return $content;
    }
    
    /* A simple "reverse wpautop"
    ***************************************************************************************/
    function reverseWpautop( $content ) {
      return str_replace( array( '<p>', '</p>', '<br />' ), array( '', "\r\n", "\r" ), $content );
    }
    
    /* A simple "getter" method
    ***************************************************************************************/
    // A typical call: $value = $mbl_customFields->getFieldValue( "key" );
    function getFieldValue( $key, $postID = 0 ) {
      if ( ! $postID ) {
        global $post;
        $postID = $post->ID;
      }
      return get_post_meta( $postID, $this->prefix . $key, true );
    }

    /* Abbreviate a string
    ***************************************************************************************/
    function abbreviate( $string, $maxLength = 50 ) {
      if ( strlen( $string ) > $maxLength )
        $string = substr_replace( $string, "&hellip;", $maxLength );
      return $string;
    }
    
  } // End Class

} // End if class exists statement

/* Instantiate the class
***************************************************************************************/
if ( class_exists( 'mbl_customFields' ) ) {
  $mbl_customFields = new mbl_customFields();
}

?>