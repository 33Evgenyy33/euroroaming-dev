<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_logos
 *
 * Dev note: if you want to change some of the default values or acceptable attributes, overload the shortcodes config.
 *
 * @var   $shortcode      string Current shortcode name
 * @var   $shortcode_base string The original called shortcode name (differs if called an alias)
 * @var   $content        string Shortcode's inner content
 * @var   $atts           array Shortcode attributes
 *
 * @param $atts           ['items'] array of Logos
 * @param $atts           ['type'] string Type of displayed logos: 'carousel' / 'grid'
 * @param $atts           ['columns'] int Quantity of displayed logos
 * @param $atts           ['with_indents'] bool Add indents between items?
 * @param $atts           ['style'] string Hover style: '1' / '2'
 * @param $atts           ['arrows'] bool Show navigation arrows?
 * @param $atts           ['dots'] bool Show navigation dots?
 * @param $atts           ['auto_scroll'] bool Enable auto rotation?
 * @param $atts           ['interval'] int Rotation interval
 * @param $atts           ['orderby'] string Items order: '' / 'rand'
 * @param $atts           ['el_class'] string Extra class name
 */

$atts = us_shortcode_atts( $atts, 'us_logos' );

$classes = '';

$atts['columns'] = intval( $atts['columns'] );
if ( $atts['columns'] < 1 OR $atts['columns'] > 8 ) {
	$atts['columns'] = 5;
}

$classes .= ' style_' . $atts['style'];

if ( $atts['with_indents'] ) {
	$classes .= ' with_indents';
}

if ( isset( $atts['type'] ) AND in_array( $atts['type'], array( 'grid', 'carousel' ) ) ) {
	$classes .= ' type_' . $atts['type'];
} else {
	$classes .= ' type_carousel';
}

if ( isset( $atts['columns'] ) ) {
	$classes .= ' cols_' . $atts['columns'];
}

if ( $atts['el_class'] != '' ) {
	$classes .= ' ' . $atts['el_class'];
}

// We need owl script for this
if ( us_get_option( 'ajax_load_js', 0 ) == 0 ) {
	wp_enqueue_script( 'us-owl' );
}

$output = '<div class="w-logos' . $classes . '"';
if ( isset( $atts['type'] ) AND $atts['type'] == 'carousel' ) {
	$output .= ' data-items="' . $atts['columns'] . '"';
	$output .= ' data-autoplay="' . intval( ! ! $atts['auto_scroll'] ) . '"';
	$output .= ' data-timeout="' . intval( $atts['interval'] * 1000 ) . '"';
	$output .= ' data-nav="' . intval( ! ! $atts['arrows'] ) . '"';
	$output .= ' data-dots="' . intval( ! ! $atts['dots'] ) . '"';
}
$output .= '>';

if ( empty( $atts['items'] ) ) {
	$atts['items'] = array();
} else {
	$atts['items'] = json_decode( urldecode( $atts['items'] ), TRUE );
	if ( ! is_array( $atts['items'] ) ) {
		$atts['items'] = array();
	}
}
if ( $atts['orderby'] == 'rand' ) {
	shuffle( $atts['items'] );
}

foreach ( $atts['items'] as $index => $item ) {
	$item['image'] = ( isset( $item['image'] ) ) ? $item['image'] : '';
	$item['link'] = ( isset( $item['link'] ) ) ? $item['link'] : '';

	$img_id = intval( $item['image'] );

	if ( $img_id AND ( $image_html = wp_get_attachment_image( $img_id, 'medium' ) ) ) {
		// We got image
	} else {
		// In case of any image issue using placeholder so admin could understand it quickly
		// TODO Move placeholder URL to some config
		global $us_template_directory_uri;
		$placeholder_url = $us_template_directory_uri . '/framework/img/us-placeholder-square.jpg';
		$image_html = '<img src="' . $placeholder_url . '" width="500" height="500" alt="">';
	}

	if ( $item['link'] != '' ) {
		$link = us_vc_build_link( $item['link'] );
		$link_target = ( $link['target'] == '_blank' ) ? ' target="_blank"' : '';
		$link_rel = ( $link['rel'] == 'nofollow' ) ? ' rel="nofollow"' : '';
		$link_title = empty( $link['title'] ) ? '' : ( ' title="' . esc_attr( $link['title'] ) . '"' );
		$output .= '<a class="w-logos-item' . $classes . '" href="' . esc_url( $link['url'] ) . '"' . $link_target . $link_rel . $link_title . '>';
		$output .= $image_html . '</a>';
	} else {
		$output .= '<div class="w-logos-item">' . $image_html . '</div>';
	}
}

$output .= '</div>';

echo $output;
