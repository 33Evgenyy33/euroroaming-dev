<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_testimonials
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 * @param $config    ['content'] string Shortcode's default content
 */
vc_map(
	array(
		'base' => 'us_testimonials',
		'name' => __( 'Testimonials', 'us' ),
		'category' => us_translate( 'Content', 'js_composer' ),
		'weight' => 270,
		'params' => array(
			array(
				'param_name' => 'type',
				'heading' => __( 'Display items as', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Grid', 'us' ) => 'grid',
					__( 'Masonry', 'us' ) => 'masonry',
					__( 'Carousel', 'us' ) => 'carousel',
				),
				'std' => $config['atts']['type'],
				'admin_label' => TRUE,
				'weight' => 100,
			),
			array(
				'param_name' => 'arrows',
				'type' => 'checkbox',
				'value' => array( __( 'Show Navigation Arrows', 'us' ) => TRUE ),
				( ( $config['atts']['arrows'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['arrows'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'weight' => 90,
			),
			array(
				'param_name' => 'dots',
				'type' => 'checkbox',
				'value' => array( __( 'Show Navigation Dots', 'us' ) => TRUE ),
				( ( $config['atts']['dots'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['dots'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'weight' => 90,
			),
			array(
				'param_name' => 'auto_scroll',
				'type' => 'checkbox',
				'value' => array( __( 'Enable Auto Rotation', 'us' ) => TRUE ),
				( ( $config['atts']['auto_scroll'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['auto_scroll'],
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'weight' => 80,
			),
			array(
				'param_name' => 'interval',
				'heading' => __( 'Auto Rotation Interval (in seconds)', 'us' ),
				'type' => 'textfield',
				'std' => $config['atts']['interval'],
				'dependency' => array( 'element' => 'auto_scroll', 'not_empty' => TRUE ),
				'weight' => 70,
			),
			array(
				'param_name' => 'columns',
				'heading' => __( 'Columns', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'std' => $config['atts']['columns'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 60,
			),
			array(
				'param_name' => 'orderby',
				'heading' => _x( 'Order', 'sequence of items', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'By date (newer first)', 'us' ) => 'date',
					__( 'By date (older first)', 'us' ) => 'date_asc',
					__( 'Random', 'us' ) => 'rand',
				),
				'std' => $config['atts']['orderby'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
			),
			array(
				'param_name' => 'style',
				'heading' => __( 'Items Style', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					sprintf( __( 'Style %d', 'us' ), 1 ) => '1',
					sprintf( __( 'Style %d', 'us' ), 2 ) => '2',
					sprintf( __( 'Style %d', 'us' ), 3 ) => '3',
					sprintf( __( 'Style %d', 'us' ), 4 ) => '4',
					sprintf( __( 'Style %d', 'us' ), 5 ) => '5',
					sprintf( __( 'Style %d', 'us' ), 6 ) => '6',
				),
				'std' => $config['atts']['style'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 40,
			),
			array(
				'param_name' => 'text_size',
				'heading' => __( 'Items Text Size', 'us' ),
				'description' => sprintf( __( 'Examples: %s', 'us' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['text_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 30,
			),
			array(
				'param_name' => 'items',
				'heading' => __( 'Items Quantity', 'us' ),
				'description' => __( 'If left blank, will output all the items', 'us' ),
				'type' => 'textfield',
				'std' => $config['atts']['items'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 20,
			),
			array(
				'param_name' => 'ids',
				'heading' => __( 'Items for display', 'us' ),
				'description' => __( 'Select specific items which will be shown', 'us' ),
				'type' => 'autocomplete',
				'settings' => array(
					'multiple' => TRUE,
					'sortable' => FALSE,
					'unique_values' => TRUE,
				),
				'save_always' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 15,
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
