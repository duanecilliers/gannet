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
   * Styling
   */
  $section = 'gannet-styling';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Styling Options', 'gannet' ),
    'priority'    => '45'
  );

  $options['gannet-upsell-three'] = array(
    'id'          => 'gannet-upsell-three',
    'label'       => __( 'Skin', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  $options['gannet-custom-css'] = array(
    'id'          => 'gannet-custom-css',
    'label'       => __( 'Custom CSS', 'gannet' ),
    'section'     => $section,
    'type'        => 'textarea',
    'default'     => __( '', 'gannet'),
    'description' => __( 'Add custom CSS to your theme', 'gannet' )
  );

  /**
   * Colors
   */
  $section = 'colors';

  $options['gannet-primary-color'] = array(
    'id'          => 'gannet-primary-color',
    'label'       => __( 'Primary Color', 'gannet' ),
    'section'     => $section,
    'type'        => 'color'
  );

  $options['gannet-secondary-color'] = array(
    'id'          => 'gannet-secondary-color',
    'label'       => __( 'Secondary Color', 'gannet' ),
    'section'     => $section,
    'type'        => 'color'
  );

  $options['gannet-headings-color'] = array(
    'id'          => 'gannet-headings-color',
    'label'       => __( 'Headings Font Color', 'gannet' ),
    'section'     => $section,
    'type'        => 'color'
  );

  $options['gannet-body-color'] = array(
    'id'          => 'gannet-body-color',
    'label'       => __( 'Body Font Color', 'gannet' ),
    'section'     => $section,
    'type'        => 'color'
  );

  /**
   * Typography
   */
  $section = 'typography';
  $font_choices = customizer_library_get_font_choices();

  $sections[] = array(
    'id' => $section,
    'title' => __( 'Typography', 'gannet' ),
    'priority' => '45'
  );

  $options['gannet-headings-font'] = array(
    'id' => 'gannet-headings-font',
    'label'   => __( 'Headings Font', 'gannet' ),
    'section' => $section,
    'type'    => 'select',
    'choices' => $font_choices,
    'default' => 'Quattrocento'
  );

  $options['gannet-body-font'] = array(
    'id' => 'gannet-body-font',
    'label'   => __( 'Body Font', 'gannet' ),
    'section' => $section,
    'type'    => 'select',
    'choices' => $font_choices,
    'default' => 'Fanwood Text'
  );

  /**
   * Portfolio
   */
  $section = 'gannet-portfolio';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Portfolio Options', 'gannet' ),
    'priority'    => '60'
  );

  $options['gannet-portfolio-title'] = array(
    'id'          => 'gannet-portfolio-title',
    'label'       => __( 'Portfolio Page Title', 'gannet' ),
    'section'     => $section,
    'type'        => 'text',
    'default'     => 'Portfolio'
  );

  $options['gannet-portfolio-cats'] = array(
    'id' => 'gannet-portfolio-cats',
    'label'   => __( 'Exclude Portfolio Categories', 'gannet' ),
    'section' => $section,
    'type'    => 'text',
    'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Portfolio, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.', 'gannet' )
  );

  $options['gannet-upsell-four'] = array(
    'id'          => 'gannet-upsell-four',
    'label'       => __( 'Portfolio Layout', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  $options['gannet-upsell-five'] = array(
    'id'          => 'gannet-upsell-five',
    'label'       => __( 'Enable Infinite Scrolling', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  /**
   * Blog
   */
  $section = 'gannet-blog';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Blog Options', 'gannet' ),
    'priority'    => '60'
  );

  $options['gannet-blog-title'] = array(
    'id'          => 'gannet-blog-title',
    'label'       => __( 'Blog Page Title', 'gannet' ),
    'section'     => $section,
    'type'        => 'text',
    'default'     => 'Blog'
  );

  $options['gannet-blog-cats'] = array(
    'id' => 'gannet-blog-cats',
    'label'   => __( 'Exclude Blog Categories', 'gannet' ),
    'section' => $section,
    'type'    => 'text',
    'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.', 'gannet' )
  );

  $options['gannet-upsell-six'] = array(
    'id'          => 'gannet-upsell-six',
    'label'       => __( 'Blog Layout', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  $options['gannet-upsell-seven'] = array(
    'id'          => 'gannet-upsell-seven',
    'label'       => __( 'Enable Infinite Scrolling', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  /**
   * Website Copy
   */
  $section = 'gannet-copy';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Website Copy', 'gannet' ),
    'priority'    => '80'
  );

  $options['gannet-header-info'] = array(
    'id'          => 'gannet-header-info',
    'label'       => __( 'Header Info Text', 'gannet' ),
    'section'     => $section,
    'type'        => 'text',
    'default'     => 'Blog'
  );

  $options['gannet-upsell-eight'] = array(
    'id'          => 'gannet-upsell-eight',
    'label'       => __( 'Footer Copyright Text', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  $options['gannet-404-heading'] = array(
    'id'          => 'gannet-404-heading',
    'label'       => __( '404 Error Page Heading', 'gannet' ),
    'section'     => $section,
    'type'        => 'text'
  );

  $options['gannet-404-message'] = array(
    'id'          => 'gannet-404-message',
    'label'       => __( '404 Error Page Message', 'gannet' ),
    'section'     => $section,
    'type'        => 'textarea'
  );

  $options['gannet-no-search-results'] = array(
    'id'          => 'gannet-no-search-results',
    'label'       => __( 'No Search Results Message', 'gannet' ),
    'section'     => $section,
    'type'        => 'textarea',
    'default'     => __( 'Enter the default text for when no search results are found', 'gannet' )
  );

  /**
   * Social Settings
   */
  $section = 'gannet-social';

  $sections[] = array(
    'id'          => $section,
    'title'       => __( 'Social Links', 'gannet' ),
    'priority'    => '80'
  );

  // Upsell Button Four
  $options['gannet-upsell-nine'] = array(
    'id'          => 'gannet-upsell-nine',
    'label'       => __( 'Add Social Links', 'gannet' ),
    'section'     => $section,
    'type'        => 'upsell',
  );

  // Adds the sections to the $options array
  $options['sections'] = $sections;

  // Adds the panels to the $options array
  $options['panels'] = $panels;

  $customizer_library = Customizer_Library::Instance();
  $customizer_library->add_options( $options );
}
add_action( 'init', 'gannet_customize_options' );
