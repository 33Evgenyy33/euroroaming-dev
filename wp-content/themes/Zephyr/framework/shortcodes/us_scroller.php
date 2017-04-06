<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_scroller
 *
 * Dev note: if you want to change some of the default values or acceptable attributes, overload the shortcodes config.
 *
 * @var   $shortcode      string Current shortcode name
 * @var   $shortcode_base string The original called shortcode name (differs if called an alias)
 * @var   $content        string Shortcode's inner content
 * @var   $atts           array Shortcode attributes
 *
 * @param $atts           ['bar'] bool Remove scroll bar?
 * @param $atts           ['dots'] bool Show navigation dots?
 * @param $atts           ['dots_size'] string Dots Size
 * @param $atts           ['dots_color'] string Dots color value
 * @param $atts           ['el_class'] string Extra class name
 */

$atts = us_shortcode_atts( $atts, 'us_scroller' );

$classes = $dot_inner_css = '';

if ( $atts['dots_size'] != '' ) {
	$dot_inner_css = 'font-size:' . $atts['dots_size'] . ';';
}
if ( $atts['dots_color'] != '' ) {
	$dot_inner_css .= 'background-color:' . $atts['dots_color'] . ';border-color:' . $atts['dots_color'] . ';';
}

if ( ! empty( $atts['el_class'] ) ) {
	$classes .= ' ' . $atts['el_class'];
}

?>
<div class="w-scroller<?php echo $classes ?>">
	<div class="w-scroller-dots">
		<a href="#" class="w-scroller-dot active" style="<?php echo $dot_inner_css ?>"></a>
		<a href="#" class="w-scroller-dot" style="<?php echo $dot_inner_css ?>"></a>
		<a href="#" class="w-scroller-dot" style="<?php echo $dot_inner_css ?>"></a>
		<a href="#" class="w-scroller-dot" style="<?php echo $dot_inner_css ?>"></a>
		<a href="#" class="w-scroller-dot" style="<?php echo $dot_inner_css ?>"></a>
	</div>
</div>
