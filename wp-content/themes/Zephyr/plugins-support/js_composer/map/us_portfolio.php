<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: us_portfolio
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */

global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/us_portfolio.php';

vc_remove_param( 'us_portfolio', 'filter_style' );
vc_update_shortcode_param(
	'us_portfolio', array(
		'param_name' => 'style',
		'value' => array(
			sprintf( __( 'Style %d', 'us' ), 1 ) => 'style_1',
			sprintf( __( 'Style %d', 'us' ), 2 ) => 'style_2',
			sprintf( __( 'Style %d', 'us' ), 3 ) => 'style_3',
			sprintf( __( 'Style %d', 'us' ), 4 ) => 'style_4',
			sprintf( __( 'Style %d', 'us' ), 5 ) => 'style_5',
		),
	)
);
