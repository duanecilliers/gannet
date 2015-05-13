<?php
/**
 * Gannet Theme Customizer
 *
 * @package Gannet
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gannet_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'gannet_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gannet_customize_preview_js() {
  wp_enqueue_script( 'gannet-customizer-js', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140513', true );
  wp_enqueue_style( 'gannet-customizer-css', get_template_directory_uri() . '/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'gannet_customize_preview_js' );

function gannet_customize_options() {

  // Theme defaults
  $primary_color = '#5bc08c';
  $secondary_color = '#666';

  // Stores all the controls that will be added
  $options = array();

  // Stores all the sections to be added
  $sections = array();

  // Stores all the panels to be added
  $panels = array();

  // Adds the sections to the $options array
  $options['sections'] = $sections;

  /**
   * Favicon
   */
  $section = 'gannet-favicon';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Favicon', 'gannet' ),
    'priority'    => '10',
    'description' => __( 'Add a favicon to your website', 'gannet' )
  );

  $options['favicon'] = array(
    'id'          => 'gannet-favicon',
    'label'       => __( 'Favicon', 'gannet' ),
    'section'     => $section,
    'type'        => 'image',
    'default'     => '',
  );

  /**
   * Logo
   */
  $section = 'gannet-logo';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Logo', 'gannet' ),
    'priority'    => '30',
    'description' => __( 'Add a logo to your website -- size recommendation --', 'gannet' )
  );

  $options['gannet-logo'] = array(
    'id'          => 'gannet-logo',
    'label'       => __( 'Logo', 'gannet' ),
    'section'     => $section,
    'type'        => 'image',
    'default'     => '',
  );

  /**
   * Layout
   */
  $section = 'gannet-layout';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Layout Options', 'gannet' ),
    'priority'    => '35'
  );

  $options['gannet-upsell-one'] = array(
    'id'          => 'gannet-upsell-one',
    'label'       => __( 'Site Layout', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  $options['gannet-upsell-two'] = array(
    'id'          => 'gannet-upsell-two',
    'label'       => __( 'Header Layout', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  $options['gannet-header-search'] = array(
    'id'          => 'gannet-header-search',
    'label'       => __( 'Show Search', 'gannet' ),
    'section'     => $section,
    'type'        => 'checkbox',
    'default'     => 1,
  );

  $options['gannet-sticky-header'] = array(
    'id'          => 'gannet-sticky-header',
    'label'       => __( 'Sticky Header', 'gannet' ),
    'section'     => $section,
    'type'        => 'checkbox',
    'description' => __( 'Make the main navigation stick to the top of the browser window', 'gannet' ),
    'default'     => 0,
  );

  $options['gannet-show-header-top-bar'] = array(
    'id'          => 'gannet-show-header-top-bar',
    'label'       => __( 'Show Top Bar', 'gannet' ),
    'section'     => $section,
    'type'        => 'checkbox',
    'description' => __( 'Show/hide the top bar in the header', 'gannet' ),
    'default'     => 1,
  );

  /**
   * Slider
   */
  $section = 'gannet-slider';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Slider Options', 'gannet' ),
    'priority'    => '35'
  );

  $choices = array(
    'gannet-slider-default' => 'Default Slider',
    'gannet-meta-slider'    => 'Meta Slider',
    'gannet-no-slider'      => 'None'
  );

  $options['gannet-slider-type'] = array(
    'id'          => 'gannet-slider-type',
    'label'       => __( 'Choose a Slider', 'gannet' ),
    'section'     => $section,
    'type'        => 'select',
    'choices'     => $choices,
    'default'     => 'gannet-slider-default'
  );

  $options['gannet-slider-cats'] = array(
    'id'          => 'gannet-slider-cats',
    'label'       => __( 'Slider Categories', 'gannet' ),
    'section'     => $section,
    'type'        => 'text',
    'description' => __( 'Enter the ID\'s of the post categories you want to display in the slider. Eg: "13,17,19" (no spaces and only comma\'s)', 'gannet' )
  );

  $options['gannet-meta-slider-shortcode'] = array(
    'id'          => 'gannet-meta-slider-shortcode',
    'label'       => __( 'Slider Shortcode', 'gannet' ),
    'section'     => $section,
    'type'        => 'text',
    'description' => __( 'Enter the shortcode provided by meta slider.', 'gannet' )
  );

  /**
   * Typography
   */
  $section = 'typography';
  $font_choices = customizer_library_get_font_choices();

  $sections[] = array(
    'id' => $section,
    'title' => __( 'Typography', 'gannet' ),
    'priority' => '80'
  );

  $options['primary-font'] = array(
    'id' => 'primary-font',
    'label'   => __( 'Primary Font', 'gannet' ),
    'section' => $section,
    'type'    => 'select',
    'choices' => $font_choices,
    'default' => 'Quattrocento'
  );
  $options['secondary-font'] = array(
    'id' => 'secondary-font',
    'label'   => __( 'Secondary Font', 'gannet' ),
    'section' => $section,
    'type'    => 'select',
    'choices' => $font_choices,
    'default' => 'Fanwood Text'
  );

  // Adds the sections to the $options array
  $options['sections'] = $sections;

  // Adds the panels to the $options array
  $options['panels'] = $panels;

  $customizer_library = Customizer_Library::Instance();
  $customizer_library->add_options( $options );
}
add_action( 'init', 'gannet_customize_options' );
