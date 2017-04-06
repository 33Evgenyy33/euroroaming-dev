<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_testimonials
 *
 * Dev note: if you want to change some of the default values or acceptable attributes, overload the shortcodes config.
 *
 * @var   $shortcode      string Current shortcode name
 * @var   $shortcode_base string The original called shortcode name (differs if called an alias)
 * @var   $content        string Shortcode's inner content
 * @var   $atts           array Shortcode attributes
 *
 * @param $atts           ['type'] string Type of displayed items: 'carousel' / 'grid'
 * @param $atts           ['arrows'] bool Show navigation arrows?
 * @param $atts           ['dots'] bool Show navigation dots?
 * @param $atts           ['auto_scroll'] bool Enable auto rotation?
 * @param $atts           ['interval'] int Rotation interval
 * @param $atts           ['columns'] int Quantity of displayed items
 * @param $atts           ['orderby'] string Items Order: 'date' / 'date_acs' / 'rand'
 * @param $atts           ['style'] string Items Style: '1' / '2' / '3' ...
 * @param $atts           ['text_size'] string Items Text Size
 * @param $atts           ['items'] int Number of items per page (left empty to display all the items)
 * @param $atts           ['ids'] IDs of wanted testimonials
 * @param $atts           ['el_class'] string Extra class name
 */

$atts = us_shortcode_atts( $atts, 'us_testimonials' );

$classes = '';

if ( $atts['style'] == '' ) {
	$atts['style'] = '1';
}
$classes .= ' style_' . $atts['style'];

if ( $atts['columns'] == '' ) {
	$atts['columns'] = '3';
}
$classes .= ' cols_' . $atts['columns'];

if ( isset( $atts['type'] ) AND in_array( $atts['type'], array( 'grid', 'carousel' ) ) ) {
	$classes .= ' type_' . $atts['type'];
} else {
	$classes .= ' type_grid';
}

if ( isset( $atts['type'] ) AND $atts['type'] == 'carousel' ) {
	// We need owl script for this
	if ( us_get_option( 'ajax_load_js', 0 ) == 0 ) {
		wp_enqueue_script( 'us-owl' );
	}
}

if ( isset( $atts['type'] ) AND $atts['type'] == 'masonry' AND $atts['columns'] != 1 ) {
	// We need isotope script for this
	if ( us_get_option( 'ajax_load_js', 0 ) == 0 ) {
		wp_enqueue_script( 'us-isotope' );
	}
	$classes .= ' layout_masonry';
}

if ( $atts['el_class'] != '' ) {
	$classes .= ' ' . $atts['el_class'];
}

$inner_css = '';

if ( ! empty( $atts['text_size'] ) ) {
	$inner_css .= 'font-size:' . $atts['text_size'] . ';';
}

$output = '<div class="w-testimonials' . $classes . '" style="' . $inner_css . '"';
if ( isset( $atts['type'] ) AND $atts['type'] == 'carousel' ) {
	$output .= ' data-items="' . $atts['columns'] . '"';
	$output .= ' data-autoplay="' . intval( ! ! $atts['auto_scroll'] ) . '"';
	$output .= ' data-timeout="' . intval( $atts['interval'] * 1000 ) . '"';
	$output .= ' data-nav="' . intval( ! ! $atts['arrows'] ) . '"';
	$output .= ' data-dots="' . intval( ! ! $atts['dots'] ) . '"';
	$output .= ' data-autoheight="' . intval( $atts['columns'] == 1 ) . '"';
}
$output .= '>';

us_open_wp_query_context();
$args = array(
	'post_type' => 'us_testimonial',
	'posts_per_page' => '-1',
	'orderby' => ( in_array(
		$atts['orderby'], array(
			'date',
			'rand',
		)
	) ) ? $atts['orderby'] : 'date',
);

if ( $atts['orderby'] == 'date_asc' ) {
	$args['order'] = 'asc';
}

if ( ! empty( $atts['items'] ) ) {
	$args['posts_per_page'] = $atts['items'];
}

if ( ! empty( $atts['ids'] ) ) {
	$ids = explode( ',', $atts['ids'] );
	$args['post__in'] = $ids;
	$args['posts_per_page'] = count($ids);
}

$testimonials = new WP_Query( $args );

while ( $testimonials->have_posts() ) {
	$testimonials->the_post();

	$testimonial_classes = '';

	$image_html = '';
	if ( has_post_thumbnail() ) {
		$image_html = get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
		$testimonial_classes .= ' with_img';
	}

	$author = usof_meta( 'us_testimonial_author' );
	$role = usof_meta( 'us_testimonial_role' );

	$link_arr = json_decode( usof_meta( 'us_testimonial_link' ), TRUE );
	$link = $link_arr['url'];
	$link_start = $link_end = $link_target = '';

	if ( ! empty( $link ) ) {
		if ( $link_arr['target'] == '_blank' ) {
			$link_target .= ' target="_blank"';
		}
		$link_start = '<a href="' . esc_url( $link ) . '"' . $link_target . '>';
		$link_end = '</a>';
	}

	$output .= '<div class="w-testimonial' . $testimonial_classes . '"><blockquote class="w-testimonial-h">';
	$output .= '<div class="w-testimonial-text">' . apply_filters( 'the_content', get_the_content() ) . '</div>';
	if ( ! empty( $image_html ) OR ! empty( $author ) OR ! empty( $role ) ) {
		$output .= $link_start . '<div class="w-testimonial-author">' . $image_html . '<div>';
		if ( ! empty( $author ) ) {
			$output .= '<span class="w-testimonial-author-name"><span>' . $author . '</span></span>';
		}
		if ( ! empty( $role ) ) {
			$output .= '<span class="w-testimonial-author-role">' . $role . '</span>';
		}
		$output .= '</div></div>' . $link_end;
	}
	$output .= '</blockquote></div>';
}

us_close_wp_query_context();

$output .= '</div>';

echo $output;
