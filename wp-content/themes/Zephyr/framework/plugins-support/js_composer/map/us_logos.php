<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_logos
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'us_logos',
		'name' => __( 'Logos Showcase', 'us' ),
		'category' => us_translate( 'Content', 'js_composer' ),
		'weight' => 230,
		'params' => array(
			array(
				'type' => 'param_group',
				'param_name' => 'items',
				'params' => array(
					array(
						'param_name' => 'image',
						'type' => 'attach_image',
						'std' => $config['items_atts']['image'],
						'edit_field_class' => 'vc_col-sm-6',
						'admin_label' => TRUE,
					),
					array(
						'param_name' => 'link',
						'type' => 'vc_link',
						'std' => $config['items_atts']['link'],
						'edit_field_class' => 'vc_col-sm-6',
					),
				),
				'weight' => 100,
			),
			array(
				'param_name' => 'type',
				'heading' => __( 'Display items as', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Carousel', 'us' ) => 'carousel',
					__( 'Grid', 'us' ) => 'grid',
				),
				'std' => $config['atts']['type'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'More Options', 'us' ),
				'weight' => 90,
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
					'6' => '6',
					'7' => '7',
					'8' => '8',
				),
				'std' => $config['atts']['columns'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'More Options', 'us' ),
				'weight' => 80,
			),
			array(
				'param_name' => 'style',
				'heading' => __( 'Hover Style', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Fade + Outline', 'us' ) => '1',
					__( 'Fade', 'us' ) => '2',
					us_translate( 'None' ) => '3',
				),
				'std' => $config['atts']['style'],
				'group' => __( 'More Options', 'us' ),
				'weight' => 70,
			),
			array(
				'param_name' => 'with_indents',
				'type' => 'checkbox',
				'value' => array( __( 'Add indents between items', 'us' ) => TRUE ),
				( ( $config['atts']['with_indents'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['with_indents'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'More Options', 'us' ),
				'weight' => 60,
			),
			array(
				'param_name' => 'orderby',
				'type' => 'checkbox',
				'value' => array( __( 'Display items in random order', 'us' ) => 'rand' ),
				( ( $config['atts']['orderby'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['orderby'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'More Options', 'us' ),
				'weight' => 50,
			),
			array(
				'param_name' => 'arrows',
				'type' => 'checkbox',
				'value' => array( __( 'Show Navigation Arrows', 'us' ) => TRUE ),
				( ( $config['atts']['arrows'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['arrows'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'group' => __( 'More Options', 'us' ),
				'weight' => 40,
			),
			array(
				'param_name' => 'dots',
				'type' => 'checkbox',
				'value' => array( __( 'Show Navigation Dots', 'us' ) => TRUE ),
				( ( $config['atts']['dots'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['dots'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'group' => __( 'More Options', 'us' ),
				'weight' => 35,
			),
			array(
				'param_name' => 'auto_scroll',
				'type' => 'checkbox',
				'value' => array( __( 'Enable Auto Rotation', 'us' ) => TRUE ),
				( ( $config['atts']['auto_scroll'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['auto_scroll'],
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'group' => __( 'More Options', 'us' ),
				'weight' => 30,
			),
			array(
				'param_name' => 'interval',
				'heading' => __( 'Auto Rotation Interval (in seconds)', 'us' ),
				'type' => 'textfield',
				'std' => $config['atts']['interval'],
				'dependency' => array( 'element' => 'auto_scroll', 'not_empty' => TRUE ),
				'group' => __( 'More Options', 'us' ),
				'weight' => 20,
			),
			array(
				'param_name' => 'el_class',
				'heading' => us_translate( 'Extra class name', 'js_composer' ),
				'type' => 'textfield',
				'std' => $config['atts']['el_class'],
				'group' => __( 'More Options', 'us' ),
				'weight' => 10,
			),
		),
	)
);
vc_remove_element( 'vc_images_carousel' );
