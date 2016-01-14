<?php
/**
 * Gannet Theme Customizer.
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

  // Kint::dump($GLOBALS, $_SERVER); // pass any number of parameters
  // ddd($wp_customize);

  Kirki::add_config( 'gannet_config', array(
    'capability'  => 'edit_theme_options',
    'option_type' => 'theme_mod'
  ) );

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

  /**
   * Customise "Header Image" section
   */
  $wp_customize->get_section( 'header_image' )->panel = 'header_panel';

  Kirki::add_field( 'gannet_config', array(
    'settings'    => 'logo',
    'label'       => __( 'Upload Your Logo', 'gannet' ),
    'section'     => 'logo',
    'type'        => 'upload'
  ) );

}
add_action( 'customize_register', 'gannet_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gannet_customize_preview_js() {
	wp_enqueue_script( 'gannet_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'gannet_customize_preview_js' );
