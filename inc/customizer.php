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

  Kirki::add_panel( 'header_panel', array(
    'priority'    => 70,
    'title'       => __( 'Header', 'gannet' )
  ) );

  Kirki::add_section( 'logo', array(
    'priority'    => 70,
    'title'       => __( 'Header Logo', 'gannet' ),
    'description' => __( '<p class="customizer-section-intro">While you can crop images to your liking after clicking <strong>Add new image</strong, your theme recommends a maximum logo size of 260 x 80 pixels. The retina version is doulbe that resolution, so 520 x 160 pixels.</p>', 'gannet' ),
    'panel'       => 'header_panel'
  ) );

  // Tweak "Header Image" section
  $wp_customize->get_section( 'header_image' )->panel = 'header_panel';

  Kirki::add_field( 'gannet_config', array(
    'settings'    => 'logo',
    'label'       => __( 'Upload Your Logo', 'gannet' ),
    'section'     => 'logo',
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
    ),
    'output'      => array(
      array(
        'element'  => 'body',
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
    ),
    'output'      => array(
      array(
        'element'  => 'a',
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
    ),
    'output'      => array(
      array(
        'element'  => 'h1, h2, h3, h4, h5, h6',
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
    ),
    'output'      => array(
      array(
        'element'  => 'body',
        'property' => 'color'
      )
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
