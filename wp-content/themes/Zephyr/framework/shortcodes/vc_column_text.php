<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */

$classes = '';
$atts = us_shortcode_atts( $atts, 'vc_column_text' );

if ( function_exists( 'vc_shortcode_custom_css_class' ) AND ! empty( $atts['css'] ) ) {
	$classes .= ' ' . vc_shortcode_custom_css_class( $atts['css'] );
}

if ( ! empty( $atts['el_class'] ) ) {
	$classes .= ' ' . $atts['el_class'];
}

$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );

$output = '
	<div class="wpb_text_column ' . esc_attr( $classes ) . '">
		<div class="wpb_wrapper">
			' . do_shortcode( shortcode_unautop( $content ) ) . '
		</div>
	</div>
';

echo $output;
