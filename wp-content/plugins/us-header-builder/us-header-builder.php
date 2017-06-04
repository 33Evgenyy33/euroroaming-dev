<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Plugin Name: UpSolution Header Builder
 * Plugin URI: https://us-themes.com/
 * Description: UpSolution Themes addon that allows to modify website header using a special visual builder.
 * Author: UpSolution
 * Author URI: https://us-themes.com/
 * Version: 1.0.3
 **/

// Global variables for plugin usage
$ushb_file = __FILE__;
$ushb_dir = plugin_dir_path( __FILE__ );
$ushb_uri = plugins_url( '', __FILE__ );
$ushb_version = preg_match( '~Version\: ([^\n]+)~', file_get_contents( __FILE__, NULL, NULL, 82, 150 ), $ushb_matches ) ? $ushb_matches[1] : FALSE;
unset( $ushb_matches );

// Adding special plugin-related paths for admin area only (for performance reasons)
add_filter( 'us_files_search_paths', 'ushb_files_search_paths' );
function ushb_files_search_paths( $paths ) {
	global $ushb_dir;
	array_splice( $paths, 1, 0, $ushb_dir );

	return $paths;
}

// Ajax requests
if ( is_admin() AND isset( $_POST['action'] ) AND substr( $_POST['action'], 0, 5 ) == 'ushb_' ) {
	require $ushb_dir . 'functions/ajax.php';
}

add_action( 'usof_print_styles', 'ushb_print_styles' );
function ushb_print_styles() {
	global $ushb_uri, $us_template_directory_uri, $ushb_version;

	$protocol = is_ssl() ? 'https' : 'http';
	
	wp_enqueue_style( 'us-header-builder', $ushb_uri . '/admin/css/header-builder.css', array(), $ushb_version );
	wp_enqueue_style( 'material-icons', $protocol . '://fonts.googleapis.com/icon?family=Material+Icons' );
}

add_action( 'usof_print_scripts', 'ushb_print_scripts' );
function ushb_print_scripts() {
	global $ushb_uri, $ushb_version;
	wp_enqueue_script( 'us-header-builder', $ushb_uri . '/admin/js/header-builder.js', array( 'usof-scripts' ), $ushb_version, TRUE );
}

add_filter( 'usof_container_classes', 'ushb_usof_container_classes' );
function ushb_usof_container_classes( $classes ) {
	return $classes . ' with_ushb';
}

register_activation_hook( $ushb_file, 'ushb_activate' );
function ushb_activate() {

	global $usof_options, $us_header_settings;
	usof_load_options_once();

	if ( isset( $usof_options['header'] ) AND is_array( $usof_options['header'] ) ) {
		// Keeping the previous header builder value.
		// To overwrite it remove the plugin, it will remove the value
		return;
	}

	remove_filter( 'us_load_header_settings', 'ushb_load_header_settings', 9 );
	us_load_header_settings_once();

	$updated_options = $usof_options;
	$updated_options['header'] = $us_header_settings;

	// Filling cells with missing keys
	foreach ( array( 'default', 'tablets', 'mobiles' ) AS $state ) {
		$updated_options['header'][ $state ]['layout'] = us_get_header_layout( $state );
	}

	usof_save_options( $updated_options );
}

register_uninstall_hook( $ushb_file, 'ushb_uninstall' );
function ushb_uninstall() {
	global $usof_options;
	usof_load_options_once();

	if ( isset( $usof_options['header'] ) ) {
		// Removing header builder setting
		$updated_options = $usof_options;
		unset( $updated_options['header'] );
		usof_save_options( $updated_options );
	}
}

add_filter( 'us_load_header_settings', 'ushb_load_header_settings', 9 );
function ushb_load_header_settings( $header_settings ) {
	remove_filter( 'us_load_header_settings', 'us_load_usof_header_settings' );
	global $usof_options;
	usof_load_options_once();
	$header_settings = isset( $usof_options['header'] ) ? $usof_options['header'] : $header_settings;

	return $header_settings;
}

