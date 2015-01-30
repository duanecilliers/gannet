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
	wp_enqueue_script( 'gannet_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'gannet_customize_preview_js' );

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
