<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_scroller
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'us_scroller',
		'name' => __( 'Page Scroller', 'us' ),
		'category' => us_translate( 'Content', 'js_composer' ),
		'weight' => 175,
		'params' => array(
			array(
				'param_name' => 'bar',
				'type' => 'checkbox',
				'value' => array( __( 'Remove scroll bar', 'us' ) => TRUE ),
				( ( $config['atts']['bar'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['bar'],
				'weight' => 70,
			),
			array(
				'param_name' => 'dots',
				'type' => 'checkbox',
				'value' => array( __( 'Show navigation dots on the right side of the screen', 'us' ) => TRUE ),
				( ( $config['atts']['dots'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['dots'],
				'weight' => 40,
			),
			array(
				'param_name' => 'dots_size',
				'heading' => __( 'Dots Size', 'us' ),
				'description' => sprintf( __( 'Examples: %s', 'us' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['dots_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'dots', 'not_empty' => TRUE ),
				'weight' => 30,
			),
			array(
				'param_name' => 'dots_color',
				'heading' => __( 'Dots Color', 'us' ),
				'type' => 'colorpicker',
				'std' => $config['atts']['dots_color'],
				'dependency' => array( 'element' => 'dots', 'not_empty' => TRUE ),
				'weight' => 20,
			),
			array(
				'param_name' => 'el_class',
				'heading' => us_translate( 'Extra class name', 'js_composer' ),
				'type' => 'textfield',
				'std' => $config['atts']['el_class'],
				'weight' => 10,
			),
		),
	)
);

