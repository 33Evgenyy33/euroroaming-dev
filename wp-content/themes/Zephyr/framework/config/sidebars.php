<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's sidebars
 *
 * @filter us_config_sidebars
 */

return array(
	'default_sidebar' => array(
		'name' => __( 'Basic Sidebar', 'us' ),
		'id' => 'default_sidebar',
		'description' => __( 'Predefined Widget Area', 'us' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	),
);
