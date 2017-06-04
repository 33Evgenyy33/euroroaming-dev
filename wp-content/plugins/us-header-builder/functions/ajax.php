<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Load elements list HTML to choose from
 */
add_action( 'wp_ajax_ushb_get_elist_html', 'ajax_ushb_get_elist_html' );
function ajax_ushb_get_elist_html() {
	us_load_template( 'templates/elist', array() );

	// We don't use JSON to reduce data size
	die;
}

/**
 * Load shortcode builder elements forms
 */
add_action( 'wp_ajax_ushb_get_ebuilder_html', 'ajax_ushb_get_ebuilder_html' );
function ajax_ushb_get_ebuilder_html() {
	$template_vars = array(
		'titles' => array(),
		'body' => '',
	);

	// Loading all the forms HTML
	foreach ( us_config( 'header-settings.elements', array() ) as $type => $elm ) {
		$template_vars['titles'][ $type ] = isset( $elm['title'] ) ? $elm['title'] : $type;
		$template_vars['body'] .= us_get_template( 'templates/eform', array(
			'type' => $type,
			'params' => $elm['params'],
		) );
	}

	us_load_template( 'templates/ebuilder', $template_vars );

	// We don't use JSON to reduce data size
	die;
}

/**
 * Load header template selector forms
 */
add_action( 'wp_ajax_ushb_get_htemplates_html', 'ajax_ushb_get_htemplates_html' );
function ajax_ushb_get_htemplates_html() {

	us_load_template( 'templates/htemplates' );

	// We don't use JSON to reduce data size
	die;
}
