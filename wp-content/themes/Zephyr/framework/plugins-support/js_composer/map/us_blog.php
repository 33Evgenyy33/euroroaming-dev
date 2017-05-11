<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_blog
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
$us_post_categories = array();
$us_post_categories_raw = get_categories( "hierarchical=0" );
foreach ( $us_post_categories_raw as $post_category_raw ) {
	$us_post_categories[$post_category_raw->name] = $post_category_raw->slug;
}
vc_map(
	array(
		'base' => 'us_blog',
		'name' => __( 'Blog', 'us' ),
		'category' => us_translate( 'Content', 'js_composer' ),
		'weight' => 240,
		'params' => array(
			array(
				'param_name' => 'type',
				'heading' => __( 'Display Posts as', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Grid', 'us' ) => 'grid',
					__( 'Masonry', 'us' ) => 'masonry',
					__( 'Carousel', 'us' ) => 'carousel',
				),
				'std' => $config['atts']['type'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'param_name' => 'columns',
				'heading' => us_translate( 'Columns' ),
				'type' => 'dropdown',
				'value' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
				'std' => $config['atts']['columns'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'param_name' => 'orderby',
				'heading' => _x( 'Order', 'sequence of items', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'By date (newer first)', 'us' ) => 'date',
					__( 'By date (older first)', 'us' ) => 'date_asc',
					__( 'Alphabetically', 'us' ) => 'alpha',
					__( 'Random', 'us' ) => 'rand',
				),
				'std' => $config['atts']['orderby'],
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'param_name' => 'items',
				'heading' => __( 'Posts Quantity', 'us' ),
				'type' => 'textfield',
				'std' => $config['atts']['items'],
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'param_name' => 'pagination',
				'heading' => __( 'Pagination', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'No pagination', 'us' ) => 'none',
					__( 'Regular pagination', 'us' ) => 'regular',
					__( 'Load More Button', 'us' ) => 'ajax',
					__( 'Infinite Scroll', 'us' ) => 'infinite',
				),
				'std' => $config['atts']['pagination'],
				'dependency' => array( 'element' => 'type', 'value' => array( 'grid', 'masonry' ) ),
			),
			array(
				'param_name' => 'categories',
				'heading' => __( 'Display Posts of selected categories', 'us' ),
				'type' => 'checkbox',
				'value' => $us_post_categories,
				'std' => $config['atts']['categories'],
			),
			array(
				'param_name' => 'layout',
				'heading' => __( 'Layout', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Classic', 'us' ) => 'classic',
					__( 'Flat', 'us' ) => 'flat',
					__( 'Tiles', 'us' ) => 'tiles',
					__( 'Cards', 'us' ) => 'cards',
					__( 'Small Circle Image', 'us' ) => 'smallcircle',
					__( 'Small Square Image', 'us' ) => 'smallsquare',
					__( 'Latest Posts', 'us' ) => 'latest',
					__( 'Compact', 'us' ) => 'compact',
				),
				'std' => $config['atts']['layout'],
				'admin_label' => TRUE,
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'title_size',
				'heading' => __( 'Posts Titles Size', 'us' ),
				'description' => sprintf( __( 'Add custom value to change default font-size of posts titles. Examples: %s', 'us' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['title_size'],
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'show_date',
				'heading' => __( 'Posts Elements', 'us' ),
				'type' => 'checkbox',
				'value' => array( us_translate( 'Date' ) => TRUE ),
				( ( $config['atts']['show_date'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_date'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'show_author',
				'heading' => '&nbsp;',
				'type' => 'checkbox',
				'value' => array( us_translate( 'Author' ) => TRUE ),
				( ( $config['atts']['show_author'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_author'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'show_categories',
				'type' => 'checkbox',
				'value' => array( us_translate( 'Categories' ) => TRUE ),
				( ( $config['atts']['show_categories'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_categories'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'show_tags',
				'type' => 'checkbox',
				'value' => array( us_translate( 'Tags' ) => TRUE ),
				( ( $config['atts']['show_tags'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_tags'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'show_comments',
				'type' => 'checkbox',
				'value' => array( us_translate( 'Comments' ) => TRUE ),
				( ( $config['atts']['show_comments'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_comments'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'show_read_more',
				'type' => 'checkbox',
				'value' => array( __( 'Read More button', 'us' ) => TRUE ),
				( ( $config['atts']['show_read_more'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_read_more'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'content_type',
				'heading' => __( 'Posts Content', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					us_translate( 'Excerpt' ) => 'excerpt',
					__( 'Full Content', 'us' ) => 'content',
					us_translate( 'None' ) => 'none',
				),
				'std' => $config['atts']['content_type'],
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'el_class',
				'heading' => us_translate( 'Extra class name', 'js_composer' ),
				'type' => 'textfield',
				'std' => $config['atts']['el_class'],
				'group' => us_translate( 'Appearance' ),
			),
			array(
				'param_name' => 'carousel_arrows',
				'type' => 'checkbox',
				'value' => array( __( 'Show Navigation Arrows', 'us' ) => TRUE ),
				( ( $config['atts']['carousel_arrows'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['carousel_arrows'],
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'group' => __( 'Carousel Settings', 'us' ),
			),
			array(
				'param_name' => 'carousel_dots',
				'type' => 'checkbox',
				'value' => array( __( 'Show Navigation Dots', 'us' ) => TRUE ),
				( ( $config['atts']['carousel_dots'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['carousel_dots'],
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'group' => __( 'Carousel Settings', 'us' ),
			),
			array(
				'param_name' => 'carousel_center',
				'type' => 'checkbox',
				'value' => array( __( 'Enable first item centering', 'us' ) => TRUE ),
				( ( $config['atts']['carousel_center'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['carousel_center'],
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'group' => __( 'Carousel Settings', 'us' ),
			),
			array(
				'param_name' => 'carousel_slideby',
				'type' => 'checkbox',
				'value' => array( __( 'Slide by several items instead of one', 'us' ) => TRUE ),
				( ( $config['atts']['carousel_slideby'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['carousel_slideby'],
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'group' => __( 'Carousel Settings', 'us' ),
			),
			array(
				'param_name' => 'carousel_autoplay',
				'type' => 'checkbox',
				'value' => array( __( 'Enable Auto Rotation', 'us' ) => TRUE ),
				( ( $config['atts']['carousel_autoplay'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['carousel_autoplay'],
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'group' => __( 'Carousel Settings', 'us' ),
			),
			array(
				'param_name' => 'carousel_interval',
				'heading' => __( 'Auto Rotation Interval (in seconds)', 'us' ),
				'type' => 'textfield',
				'std' => $config['atts']['carousel_interval'],
				'dependency' => array( 'element' => 'carousel_autoplay', 'not_empty' => TRUE ),
				'group' => __( 'Carousel Settings', 'us' ),
			),
			array(
				'param_name' => 'filter',
				'type' => 'checkbox',
				'value' => array( __( 'Enable filtering by category', 'us' ) => 'category' ),
				( ( $config['atts']['filter'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['filter'],
				'group' => __( 'Filtering', 'us' ),
				'dependency' => array( 'element' => 'type', 'value' => array( 'grid', 'masonry' ) ),
			),
			array(
				'param_name' => 'filter_style',
				'heading' => __( 'Filter Bar Style', 'us' ),
				'type' => 'dropdown',
				'value' => array(
					sprintf( __( 'Style %d', 'us' ), 1 ) => 'style_1',
					sprintf( __( 'Style %d', 'us' ), 2 ) => 'style_2',
					sprintf( __( 'Style %d', 'us' ), 3 ) => 'style_3',
				),
				'std' => $config['atts']['filter_style'],
				'group' => __( 'Filtering', 'us' ),
				'dependency' => array( 'element' => 'filter', 'not_empty' => TRUE ),
			),
		),
	)
);
