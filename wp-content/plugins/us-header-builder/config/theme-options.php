<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Header Builder Theme Options changes.
 *
 * @var $config array Framework- and theme-defined theme options config
 *
 * @return array Changed config
 */

global $ushb_uri;
$config = us_array_merge_insert( $config, array(
	'headerbuilder' => array(
		'title' => __( 'Header Builder', 'us' ),
		'icon' => $ushb_uri . '/admin/img/hbuilder.png',
		'new' => TRUE,
		'fields' => array(
			'header' => array(
				'type' => 'header_builder',
				'std' => '',
				'classes' => 'desc_0', // Reset desc position of global HB field
			),
		),
	),
), 'after', 'styling' );

// Hiding the sections that are overloaded by header builder
$config['headeroptions']['place_if'] = FALSE;
$config['logooptions']['place_if'] = FALSE;
$config['menuoptions']['place_if'] = FALSE;

return $config;
