<?php
/**
 * Gannet Theme Customizer.
 *
 * @package Gannet
 */

function gannet_upsell( $label ) {
  ob_start(); ?>
    <div class="gannet-upsell">
      <div class="gannet-upsell-title"><?php echo esc_html( $label ); ?></div>
      <a href="<?php echo esc_url( 'http://app.sellwire.net/p/K3' ); ?>" target="_blank" class="gannet-upsell-btn"><?php _e( 'Buy Gannet Premium', 'gannet' ); ?></a>
      <div class="gannet-upsell-desc"><?php echo __( 'See the <a href="' . admin_url( 'themes.php?page=premium_upgrade' ) . '" target="_blank">premium</a> features.', 'gannet' ) ?></div>
    </div>
  <?php
  return ob_get_clean();
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gannet_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  Kirki::add_config( 'gannet_config', array(
    'capability'  => 'edit_theme_options',
    'option_type' => 'theme_mod'
  ) );

  /**
   * Header Panel
   * - Header Image
   * - Header Logo
   */

  Kirki::add_section( 'logos', array(
    'priority'    => 70,
    'title'       => __( 'Logos', 'gannet' )
  ) );

  Kirki::add_field( 'gannet_config', array(
    'settings'    => 'logo',
    'label'       => __( 'Upload Your Logo', 'gannet' ),
    'description' => __( 'We recommend a maximum logo size of 260 x 80 pixels', 'gannet' ),
    'section'     => 'logos',
    'type'        => 'upload'
  ) );

  Kirki::add_field( 'gannet_config', array(
    'settings'    => 'logo_retina',
    'label'       => __( 'Upload Your Retina Logo', 'gannet' ),
    'description' => __( 'The retina logo must be double the main logo resolution, so at our recommendation it would be 520 x 160 pixels', 'gannet' ),
    'section'     => 'logos',
    'type'        => 'upload'
  ) );

  /**
   * Colors Panel
   * - Skin (Premium)
   * - Palettes (premium)
   * - Background Color
   * - Primary Color
   * - Secondary Color
   * - Headings Text Color
   * - Body Text Color
   */

  // Remove Header Text color control
  $wp_customize->remove_control( 'header_textcolor' );

  // Remove Background Color Control
  $wp_customize->remove_control( 'background_color' );

  Kirki::add_field( 'gannet_config', array(
    'type'        => 'custom',
    'label'       => __( 'Skin', 'gannet' ),
    'description' => __( 'Choose between light or dark skins.', 'gannet' ),
    'settings'    => 'skin_upsell',
    'section'     => 'colors',
    'default'     => gannet_upsell( __( 'This feature is only available in the premium version', 'gannet' ) )
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'        => 'custom',
    'label'       => __( 'Palettes', 'gannet' ),
    'description' => __( 'Choose between a set of carefully crafted pallettes.', 'gannet' ),
    'settings'    => 'palettes_upsell',
    'section'     => 'colors',
    'default'     => gannet_upsell( __( 'This feature is only available in the premium version', 'gannet' ) )
  ) );

  /**
   * Background Color
   */
  Kirki::add_field( 'gannet_config', array(
    'type'        => 'color',
    'label'       => __( 'Background Color', 'gannet' ),
    'description' => __( 'Choose a background accent color.', 'gannet' ),
    'settings'    => 'background_color',
    'section'     => 'colors',
    'default'     => '#f9f9f9',
    'transport'   => 'postMessage',
    'js_vars'     => array(
      array(
        'element'  => 'body',
        'function' => 'css',
        'property' => 'background-color'
      )
    )
  ) );

  /**
   * Primary Color
   */
  Kirki::add_field( 'gannet_config', array(
    'type'        => 'color',
    'label'       => __( 'Primary Color', 'gannet' ),
    'description' => __( 'Choose a primary accent color.', 'gannet' ),
    'settings'    => 'primary_color',
    'section'     => 'colors',
    'default'     => '#7bcaf7',
    'transport'   => 'postMessage',
    'js_vars'     => array(
      array(
        'element'  => 'a',
        'function' => 'css',
        'property' => 'color'
      )
    )
  ) );

  /**
   * Secondary Color
   */
  Kirki::add_field( 'gannet_config', array(
    'type'        => 'color',
    'label'       => __( 'Secondary Color', 'gannet' ),
    'description' => __( 'Choose a secondary accent color.', 'gannet' ),
    'settings'    => 'secondary_color',
    'section'     => 'colors',
    'default'     => '#f0b86f',
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'        => 'color',
    'label'       => __( 'Heading Text Color', 'gannet' ),
    'description' => __( 'Choose a heading (h1 - h6) color.', 'gannet' ),
    'settings'    => 'heading_text_color',
    'section'     => 'colors',
    'default'     => '#292929',
    'js_vars'     => array(
      array(
        'element'  => 'h1, h2, h3, h4, h5, h6',
        'function' => 'css',
        'property' => 'color'
      )
    )
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'        => 'color',
    'label'       => __( 'Body Text Color', 'gannet' ),
    'description' => __( 'Choose a body text color.', 'gannet' ),
    'settings'    => 'body_text_color',
    'section'     => 'colors',
    'default'     => '#292929',
    'js_vars'     => array(
      array(
        'element'  => 'body',
        'function' => 'css',
        'property' => 'color'
      )
    )
  ) );

  /**
   * Layout Section
   */

  Kirki::add_section( 'layout', array(
    'priority'    => 90,
    'title'       => __( 'Layout & Design', 'gannet' ),
  ) );

  // Move Background Image control into Layout section & remove Background Image section
  $wp_customize->get_control( 'background_image' )->section = 'layout';
  $wp_customize->get_control( 'background_image' )->priority = 20;
  $wp_customize->remove_section( 'background_image' );

  // Move Header Image control into Layout section & remove Header Image section
  $wp_customize->get_control( 'header_image' )->section = 'layout';
  $wp_customize->get_control( 'header_image' )->priority = 20;
  $wp_customize->remove_section( 'header_image' );

  Kirki::add_field( 'gannet_config', array(
    'type'        => 'custom',
    'label'       => __( 'Site Layout', 'gannet' ),
    'settings'    => 'site_layout_upsell',
    'section'     => 'layout',
    'default'     => gannet_upsell( __( 'This feature is only available in the premium version', 'gannet' ) )
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'        => 'custom',
    'label'       => __( 'Header Layout', 'gannet' ),
    'settings'    => 'header_layout_upsell',
    'section'     => 'layout',
    'default'     => gannet_upsell( __( 'This feature is only available in the premium version', 'gannet' ) )
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'        => 'switch',
    'settings'    => 'show_search',
    'label'       => __( 'Show Search', 'gannet' ),
    'description' => __( 'Enable search functionality', 'gannet' ),
    'help'        => __( 'Displays/removes search icon in navigation and footer.', 'gannet' ),
    'section'     => 'layout',
    'priority'    => 20,
    'default'     => '1',
    'choices'     => array(
      'on'  => __( 'On', 'gannet' ),
      'off' => __( 'Off', 'gannet' ),
    ),
  ) );

  /**
   * Typography
   */

  Kirki::add_panel( 'typography_panel', array(
    'priority'    => 90,
    'title'       => __( 'Typography', 'gannet' ),
  ) );

  /**
   * Heading Type
   */

  Kirki::add_section( 'heading_type', array(
    'title'       => __( 'Headings', 'gannet' ),
    'panel'       => 'typography_panel'
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'     => 'select',
    'settings' => 'heading_type_font_family',
    'label'    => __( 'Font Family', 'gannet' ),
    'section'  => 'heading_type',
    'default'  => 'Open Sans',
    'priority' => 20,
    'choices'  => Kirki_Fonts::get_font_choices(),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'h1, h2, h3, h4, h5, h6',
          'function' => 'css',
          'property' => 'font-family'
      ),
    )
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'     => 'slider',
    'settings' => 'heading_type_font_weight',
    'label'    => __( 'Font Weight', 'gannet' ),
    'section'  => 'heading_type',
    'default'  => 600,
    'priority' => 24,
    'choices'  => array(
      'min'  => 100,
      'max'  => 900,
      'step' => 100,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'h1, h2, h3, h4, h5, h6',
          'function' => 'css',
          'property' => 'font-weight'
      ),
    )
  ) );

  /**
   * H1 Font Size
   */
  Kirki::add_field( 'gannet_config', array(
    'type'      => 'slider',
    'settings'  => 'heading_type_h1_font_size',
    'label'     => __( 'H1 Font Size', 'gannet' ),
    'section'   => 'heading_type',
    'default'   => 40,
    'priority'  => 25,
    'choices'   => array(
      'min'   => 22,
      'max'   => 60,
      'step'  => 1,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'h1',
          'function' => 'css',
          'property' => 'font-size',
          'units'    => 'px'
      ),
    )
  ) );

  /**
   * H2 Font Size
   */
  Kirki::add_field( 'gannet_config', array(
    'type'      => 'slider',
    'settings'  => 'heading_type_h2_font_size',
    'label'     => __( 'H2 Font Size', 'gannet' ),
    'section'   => 'heading_type',
    'default'   => 34,
    'priority'  => 25,
    'choices'   => array(
      'min'   => 20,
      'max'   => 50,
      'step'  => 1,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'h2',
          'function' => 'css',
          'property' => 'font-size',
          'units'    => 'px'
      ),
    )
  ) );

  /**
   * H3 Font Size
   */
  Kirki::add_field( 'gannet_config', array(
    'type'      => 'slider',
    'settings'  => 'heading_type_h3_font_size',
    'label'     => __( 'H3 Font Size', 'gannet' ),
    'section'   => 'heading_type',
    'default'   => 24,
    'priority'  => 25,
    'choices'   => array(
      'min'   => 26,
      'max'   => 48,
      'step'  => 1,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'h3',
          'function' => 'css',
          'property' => 'font-size',
          'units'    => 'px'
      ),
    )
  ) );

  /**
   * H4 Font Size
   */
  Kirki::add_field( 'gannet_config', array(
    'type'      => 'slider',
    'settings'  => 'heading_type_h4_font_size',
    'label'     => __( 'H4 Font Size', 'gannet' ),
    'section'   => 'heading_type',
    'default'   => 22,
    'priority'  => 25,
    'choices'   => array(
      'min'   => 16,
      'max'   => 40,
      'step'  => 1,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'h4',
          'function' => 'css',
          'property' => 'font-size',
          'units'    => 'px'
      ),
    )
  ) );

  /**
   * H5 Font Size
   */
  Kirki::add_field( 'gannet_config', array(
    'type'      => 'slider',
    'settings'  => 'heading_type_h5_font_size',
    'label'     => __( 'H5 Font Size', 'gannet' ),
    'section'   => 'heading_type',
    'default'   => 20,
    'priority'  => 25,
    'choices'   => array(
      'min'   => 14,
      'max'   => 40,
      'step'  => 1,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'h5',
          'function' => 'css',
          'property' => 'font-size',
          'units'    => 'px'
      ),
    )
  ) );

  /**
   * H6 Font Size
   */
  Kirki::add_field( 'gannet_config', array(
    'type'      => 'slider',
    'settings'  => 'heading_type_h6_font_size',
    'label'     => __( 'H6 Font Size', 'gannet' ),
    'section'   => 'heading_type',
    'default'   => 18,
    'priority'  => 25,
    'choices'   => array(
      'min'   => 12,
      'max'   => 30,
      'step'  => 1,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'h6',
          'function' => 'css',
          'property' => 'font-size',
          'units'    => 'px'
      ),
    )
  ) );

  /**
   * Base Typography
   */

  Kirki::add_section( 'base_type', array(
    'title'       => __( 'Base', 'gannet' ),
    'panel'       => 'typography_panel'
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'     => 'select',
    'settings' => 'base_type_font_family',
    'label'    => __( 'Font Family', 'gannet' ),
    'section'  => 'base_type',
    'default'  => 'Open Sans',
    'priority' => 20,
    'choices'  => Kirki_Fonts::get_font_choices(),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'body',
          'function' => 'css',
          'property' => 'font-family'
      ),
    )
  ) );

  Kirki::add_field( 'gannet_config', array(
    'type'     => 'slider',
    'settings' => 'base_type_font_weight',
    'label'    => __( 'Font Weight', 'gannet' ),
    'section'  => 'base_type',
    'default'  => 300,
    'priority' => 24,
    'choices'  => array(
      'min'  => 100,
      'max'  => 900,
      'step' => 100,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'body',
          'function' => 'css',
          'property' => 'font-weight'
      ),
    )
  ) );

  /**
   * Base Font Size
   */
  Kirki::add_field( 'gannet_config', array(
    'type'      => 'slider',
    'settings'  => 'base_type_font_size',
    'label'     => __( 'Base Font Size', 'gannet' ),
    'section'   => 'base_type',
    'default'   => 14,
    'priority'  => 25,
    'choices'   => array(
      'min'   => 12,
      'max'   => 30,
      'step'  => 1,
    ),
    'transport' => 'postMessage',
    'js_vars'   => array(
      array(
          'element'  => 'body',
          'function' => 'css',
          'property' => 'font-size',
          'units'    => 'px'
      ),
    )
  ) );

  // ddd($wp_customize);

}
add_action( 'customize_register', 'gannet_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gannet_customize_preview_js() {
	wp_enqueue_script( 'gannet_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'gannet_customize_preview_js' );

/**
 * Include CSS/JS to customise customizer controls
 */
function gannet_customizer_controls() {
  wp_enqueue_style( 'gannet_customizer', get_template_directory_uri() . '/css/customizer.css', array(), '20150114' );
}
add_action( 'customize_controls_enqueue_scripts', 'gannet_customizer_controls', 100 );

/**
 * Add Customizer Inline Styles
 */
function gannet_inline_styles() {
  // Colors
  $background_color     = get_theme_mod( 'background_color', '#f9f9f9' );
  $primary_color        = get_theme_mod( 'primary_color', '#7bcaf7' );
  $secondary_color      = get_theme_mod( 'secondary_color', '#f0b86f' );
  $heading_text_color   = get_theme_mod( 'heading_text_color', '#292929' );
  $body_text_color      = get_theme_mod( 'body_text_color', '#292929' );

  // Heading Type
  $heading_type_font_family   = get_theme_mod( 'heading_type_font_family', 'Open Sans' );
  $heading_type_font_weight   = get_theme_mod( 'heading_type_font_weight', 600 );
  $heading_type_h1_font_size  = get_theme_mod( 'heading_type_h1_font_size', 40 );
  $heading_type_h2_font_size  = get_theme_mod( 'heading_type_h2_font_size', 34 );
  $heading_type_h3_font_size  = get_theme_mod( 'heading_type_h3_font_size', 24 );
  $heading_type_h4_font_size  = get_theme_mod( 'heading_type_h4_font_size', 22 );
  $heading_type_h5_font_size  = get_theme_mod( 'heading_type_h5_font_size', 20 );
  $heading_type_h6_font_size  = get_theme_mod( 'heading_type_h6_font_size', 18 );

  // Base Type
  $base_type_font_family    = get_theme_mod( 'base_type_font_family', 'Open Sans' );
  $base_type_font_weight    = get_theme_mod( 'base_type_font_weight', 300 );
  $base_type_font_size      = get_theme_mod( 'base_type_font_size', 14 );


  $custom_css = "
    body {
      background-color: {$background_color};
      color: {$body_text_color};
      font-size: {$base_type_font_size};
      font-family: {$base_type_font_family};
      font-weight: {$base_type_font_weight};
      border-top: 4px solid {$primary_color};
    }
    a {
      color: {$primary_color};
    }
    h1, h2, h3, h4, h5, h6 {
      color: {$heading_text_color};
      font-family: {$heading_type_font_family};
      font-weight: {$heading_type_font_weight};
    }
    h1 {
      font-size: {$heading_type_h1_font_size}px;
    }
    h2 {
      font-size: {$heading_type_h2_font_size}px;
    }
    h3 {
      font-size: {$heading_type_h3_font_size}px;
    }
    h4 {
      font-size: {$heading_type_h4_font_size}px;
    }
    h5 {
      font-size: {$heading_type_h5_font_size}px;
    }
    h6 {
      font-size: {$heading_type_h6_font_size}px;
    }
  ";

  wp_add_inline_style( 'gannet-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'gannet_inline_styles', 20 );
