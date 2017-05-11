<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Generates and outputs theme options' generated styleshets
 *
 * @action Before the template: us_before_template:templates/theme-options.css
 * @action After the template: us_after_template:templates/theme-options.css
 */

$prefixes = array( 'heading', 'body', 'menu' );
$font_families = array();
$default_font_weights = array_fill_keys( $prefixes, 400 );
foreach ( $prefixes as $prefix ) {
	$font = explode( '|', us_get_option( $prefix . '_font_family', 'none' ), 2 );
	if ( $font[0] == 'none' ) {
		// Use the default font
		$font_families[ $prefix ] = '';
	} elseif ( strpos( $font[0], ',' ) === FALSE ) {
		// Use some specific font from Google Fonts
		if ( ! isset( $font[1] ) OR empty( $font[1] ) ) {
			// Fault tolerance for missing font-variants
			$font[1] = '400,700';
		}
		// The first active font-weight will be used for "normal" weight
		$default_font_weights[ $prefix ] = intval( $font[1] );
		$fallback_font_family = us_config( 'google-fonts.' . $font[0] . '.fallback', 'sans-serif' );
		$font_families[ $prefix ] = 'font-family: "' . $font[0] . '", ' . $fallback_font_family . ";\n";
	} else {
		// Web-safe font combination
		$font_families[ $prefix ] = 'font-family: ' . $font[0] . ";\n";
	}
}

?>

<?php if ( FALSE ): ?><style>/* Setting IDE context */<?php endif; ?>


/* Typography
   ========================================================================== */

html {
	<?php echo $font_families['body'] ?>
	font-size: <?php echo us_get_option( 'body_fontsize' ) ?>px;
	line-height: <?php echo us_get_option( 'body_lineheight' ) ?>px;
	font-weight: <?php echo $default_font_weights['body'] ?>;
	}
	
.w-text.font_main_menu,
.w-nav-item {
	<?php echo $font_families['menu'] ?>
	font-weight: <?php echo $default_font_weights['menu'] ?>;
	}

h1, h2, h3, h4, h5, h6,
.w-text.font_heading,
.w-blog-post.format-quote blockquote,
.w-counter-number,
.w-pricing-item-price,
.w-tabs-item-title,
.ult_price_figure,
.ult_countdown-amount,
.ultb3-box .ultb3-title,
.stats-block .stats-desc .stats-number {
	<?php echo $font_families['heading'] ?>
	font-weight: <?php echo $default_font_weights['heading'] ?>;
	}
h1 {
	font-size: <?php echo us_get_option( 'h1_fontsize' ) ?>px;
	letter-spacing: <?php echo us_get_option( 'h1_letterspacing' ) ?>px;
	<?php $h1_transform = us_get_option( 'h1_transform' ); if ( ! empty( $h1_transform[0] ) ) echo 'text-transform: ' .  $h1_transform[0] . ';'; ?>
	}
h2 {
	font-size: <?php echo us_get_option( 'h2_fontsize' ) ?>px;
	letter-spacing: <?php echo us_get_option( 'h2_letterspacing' ) ?>px;
	<?php $h2_transform = us_get_option( 'h2_transform' ); if ( ! empty( $h2_transform[0] ) ) echo 'text-transform: ' .  $h2_transform[0] . ';'; ?>
	}
h3 {
	font-size: <?php echo us_get_option( 'h3_fontsize' ) ?>px;
	letter-spacing: <?php echo us_get_option( 'h3_letterspacing' ) ?>px;
	<?php $h3_transform = us_get_option( 'h3_transform' ); if ( ! empty( $h3_transform[0] ) ) echo 'text-transform: ' .  $h3_transform[0] . ';'; ?>
	}
h4,
.widgettitle,
.comment-reply-title,
.woocommerce #reviews h2,
.woocommerce .related > h2,
.woocommerce .upsells > h2,
.woocommerce .cross-sells > h2 {
	font-size: <?php echo us_get_option( 'h4_fontsize' ) ?>px;
	letter-spacing: <?php echo us_get_option( 'h4_letterspacing' ) ?>px;
	<?php $h4_transform = us_get_option( 'h4_transform' ); if ( ! empty( $h4_transform[0] ) ) echo 'text-transform: ' .  $h4_transform[0] . ';'; ?>
	}
h5 {
	font-size: <?php echo us_get_option( 'h5_fontsize' ) ?>px;
	letter-spacing: <?php echo us_get_option( 'h5_letterspacing' ) ?>px;
	<?php $h5_transform = us_get_option( 'h5_transform' ); if ( ! empty( $h5_transform[0] ) ) echo 'text-transform: ' .  $h5_transform[0] . ';'; ?>
	}
h6 {
	font-size: <?php echo us_get_option( 'h6_fontsize' ) ?>px;
	letter-spacing: <?php echo us_get_option( 'h6_letterspacing' ) ?>px;
	<?php $h6_transform = us_get_option( 'h6_transform' ); if ( ! empty( $h6_transform[0] ) ) echo 'text-transform: ' .  $h6_transform[0] . ';'; ?>
	}
@media (max-width: 767px) {
html {
	font-size: <?php echo us_get_option( 'body_fontsize_mobile' ) ?>px;
	line-height: <?php echo us_get_option( 'body_lineheight_mobile' ) ?>px;
	}
h1 {
	font-size: <?php echo us_get_option( 'h1_fontsize_mobile' ) ?>px;
	}
h1.vc_custom_heading {
	font-size: <?php echo us_get_option( 'h1_fontsize_mobile' ) ?>px !important;
	}
h2 {
	font-size: <?php echo us_get_option( 'h2_fontsize_mobile' ) ?>px;
	}
h2.vc_custom_heading {
	font-size: <?php echo us_get_option( 'h2_fontsize_mobile' ) ?>px !important;
	}
h3 {
	font-size: <?php echo us_get_option( 'h3_fontsize_mobile' ) ?>px;
	}
h3.vc_custom_heading {
	font-size: <?php echo us_get_option( 'h3_fontsize_mobile' ) ?>px !important;
	}
h4,
.widgettitle,
.comment-reply-title,
.woocommerce #reviews h2,
.woocommerce .related > h2,
.woocommerce .upsells > h2,
.woocommerce .cross-sells > h2 {
	font-size: <?php echo us_get_option( 'h4_fontsize_mobile' ) ?>px;
	}
h4.vc_custom_heading {
	font-size: <?php echo us_get_option( 'h4_fontsize_mobile' ) ?>px !important;
	}
h5 {
	font-size: <?php echo us_get_option( 'h5_fontsize_mobile' ) ?>px;
	}
h5.vc_custom_heading {
	font-size: <?php echo us_get_option( 'h5_fontsize_mobile' ) ?>px !important;
	}
h6 {
	font-size: <?php echo us_get_option( 'h6_fontsize_mobile' ) ?>px;
	}
h6.vc_custom_heading {
	font-size: <?php echo us_get_option( 'h6_fontsize_mobile' ) ?>px !important;
	}
}

/* Layout Options
   ========================================================================== */

body,
.header_hor .l-header.pos_fixed {
	min-width: <?php echo us_get_option( 'site_canvas_width' ) ?>px;
	}
.l-canvas.type_boxed,
.l-canvas.type_boxed .l-subheader,
.l-canvas.type_boxed .l-section.type_sticky,
.l-canvas.type_boxed ~ .l-footer {
	max-width: <?php echo us_get_option( 'site_canvas_width' ) ?>px;
	}
.header_hor .l-subheader-h,
.l-titlebar-h,
.l-main-h,
.l-section-h,
.w-tabs-section-content-h,
.w-blog-post-body {
	max-width: <?php echo us_get_option( 'site_content_width' ) ?>px;
	}
	
/* Hide carousel arrows before they cut by screen edges */
@media (max-width: <?php echo us_get_option( 'site_content_width' ) + 150 ?>px) {
.l-section:not(.width_full) .owl-nav {
	display: none;
	}
}
@media (max-width: <?php echo us_get_option( 'site_content_width' ) + 200 ?>px) {
.l-section:not(.width_full) .w-blog .owl-nav {
	display: none;
	}
}

.l-sidebar {
	width: <?php echo us_get_option( 'sidebar_width' ) ?>%;
	}
.l-content {
	width: <?php echo us_get_option( 'content_width' ) ?>%;
	}
@media (max-width: <?php echo us_get_option( 'columns_stacking_width' ) ?>px) {
.g-cols > div:not([class*=" vc_col-"]) {
	float: none;
	width: 100%;
	margin: 0 0 2rem;
	}
.g-cols.type_boxes > div,
.g-cols > div:last-child,
.g-cols > div.has-fill {
	margin-bottom: 0;
	}
.vc_wp_custommenu.layout_hor,
.align_center_xs,
.align_center_xs .w-socials {
	text-align: center;
	}
}

/* Portfolio Grid Responsive Behavior */
@media screen and (max-width: <?php echo us_get_option( 'portfolio_breakpoint_1_width' ) ?>px) {
.w-portfolio[class*="cols_"] .w-portfolio-item {
	width: <?php echo 100 / us_get_option( 'portfolio_breakpoint_1_cols' ) ?>%;
	}
<?php if ( us_get_option( 'portfolio_breakpoint_1_cols' ) != 100 ): ?>
.w-portfolio[class*="cols_"] .w-portfolio-item.size_2x1,
.w-portfolio[class*="cols_"] .w-portfolio-item.size_2x2 {
	width: <?php echo 200 / us_get_option( 'portfolio_breakpoint_1_cols' ) ?>%;
	}
<?php endif; ?>
}
@media screen and (max-width: <?php echo us_get_option( 'portfolio_breakpoint_2_width' ) ?>px) {
.w-portfolio[class*="cols_"] .w-portfolio-item {
	width: <?php echo 100 / us_get_option( 'portfolio_breakpoint_2_cols' ) ?>%;
	}
<?php if ( us_get_option( 'portfolio_breakpoint_2_cols' ) != 100 ): ?>
.w-portfolio[class*="cols_"] .w-portfolio-item.size_2x1,
.w-portfolio[class*="cols_"] .w-portfolio-item.size_2x2 {
	width: <?php echo 200 / us_get_option( 'portfolio_breakpoint_2_cols' ) ?>%;
	}
<?php endif; ?>
}
@media screen and (max-width: <?php echo us_get_option( 'portfolio_breakpoint_3_width' ) ?>px) {
.w-portfolio[class*="cols_"] .w-portfolio-item {
	width: <?php echo 100 / us_get_option( 'portfolio_breakpoint_3_cols' ) ?>%;
	}
<?php if ( us_get_option( 'portfolio_breakpoint_3_cols' ) != 100 ): ?>
.w-portfolio[class*="cols_"] .w-portfolio-item.size_2x1,
.w-portfolio[class*="cols_"] .w-portfolio-item.size_2x2 {
	width: <?php echo 200 / us_get_option( 'portfolio_breakpoint_3_cols' ) ?>%;
	}
<?php endif; ?>
}

/* Blog Responsive Behavior */
@media screen and (max-width: <?php echo us_get_option( 'blog_breakpoint_1_width' ) ?>px) {
.w-blog[class*="cols_"] .w-blog-post {
	width: <?php echo 100 / us_get_option( 'blog_breakpoint_1_cols' ) ?>%;
	}
}
@media screen and (max-width: <?php echo us_get_option( 'blog_breakpoint_2_width' ) ?>px) {
.w-blog[class*="cols_"] .w-blog-post {
	width: <?php echo 100 / us_get_option( 'blog_breakpoint_2_cols' ) ?>%;
	}
}
@media screen and (max-width: <?php echo us_get_option( 'blog_breakpoint_3_width' ) ?>px) {
.w-blog[class*="cols_"] .w-blog-post {
	width: <?php echo 100 / us_get_option( 'blog_breakpoint_3_cols' ) ?>%;
	}
}

/* Header Settings
   ========================================================================== */

/* Default state */
@media (min-width: 901px) {
	
	<?php if ( ! us_get_header_option( 'top_show' ) ): ?>
	.l-subheader.at_top { display: none; }
	<?php endif; ?>
	
	.header_hor .l-subheader.at_top {
		line-height: <?php echo us_get_header_option( 'top_height' ) ?>px;
		height: <?php echo us_get_header_option( 'top_height' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_top {
		line-height: <?php echo us_get_header_option( 'top_sticky_height' ) ?>px;
		height: <?php echo us_get_header_option( 'top_sticky_height' ) ?>px;
		<?php if ( us_get_header_option( 'top_sticky_height' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	.header_hor .l-subheader.at_middle {
		line-height: <?php echo us_get_header_option( 'middle_height' ) ?>px;
		height: <?php echo us_get_header_option( 'middle_height' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_middle {
		line-height: <?php echo us_get_header_option( 'middle_sticky_height' ) ?>px;
		height: <?php echo us_get_header_option( 'middle_sticky_height' ) ?>px;
		<?php if ( us_get_header_option( 'middle_sticky_height' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	<?php if ( ! us_get_header_option( 'bottom_show' ) ): ?>
	.l-subheader.at_bottom { display: none; }
	<?php endif; ?>
	
	.header_hor .l-subheader.at_bottom {
		line-height: <?php echo us_get_header_option( 'bottom_height' ) ?>px;
		height: <?php echo us_get_header_option( 'bottom_height' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_bottom {
		line-height: <?php echo us_get_header_option( 'bottom_sticky_height' ) ?>px;
		height: <?php echo us_get_header_option( 'bottom_sticky_height' ) ?>px;
		<?php if ( us_get_header_option( 'bottom_sticky_height' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	/* Calculate top padding for content overlapped by sticky header */
	.header_hor .l-header.pos_fixed ~ .l-titlebar,
	.header_hor .titlebar_none.sidebar_left .l-header.pos_fixed ~ .l-main,
	.header_hor .titlebar_none.sidebar_right .l-header.pos_fixed ~ .l-main,
	.header_hor .titlebar_none.sidebar_none .l-header.pos_fixed ~ .l-main .l-section:first-child,
	.header_hor.header_inpos_below .l-header.pos_fixed ~ .l-main .l-section:nth-child(2),
	.header_hor .l-header.pos_static.bg_transparent ~ .l-titlebar,
	.header_hor .titlebar_none.sidebar_left .l-header.pos_static.bg_transparent ~ .l-main,
	.header_hor .titlebar_none.sidebar_right .l-header.pos_static.bg_transparent ~ .l-main,
	.header_hor .titlebar_none.sidebar_none .l-header.pos_static.bg_transparent ~ .l-main .l-section:first-child {
		<?php
		$header_height = us_get_header_option( 'top_show' ) ? intval( us_get_header_option( 'top_height' ) ) : 0;
		$header_height += intval( us_get_header_option( 'middle_height' ) );
		$header_height += us_get_header_option( 'bottom_show' ) ? intval( us_get_header_option( 'bottom_height' ) ) : 0;
		?>
		padding-top: <?php echo $header_height ?>px;
		}
	.header_hor .l-header.pos_static.bg_solid + .l-main .l-section.preview_trendy .w-blog-post-preview {
		top: -<?php echo $header_height ?>px;
		}
	.header_hor.header_inpos_bottom .l-header.pos_fixed ~ .l-main .l-section:first-child {
		padding-bottom: <?php echo $header_height ?>px;
		}
		
	/* Fix vertical centering of first section when header is transparent */
	.header_hor .l-header.bg_transparent ~ .l-main .l-section.valign_center:first-child > .l-section-h {
		top: -<?php echo $header_height/2 ?>px;
		}
	.header_hor.header_inpos_bottom .l-header.pos_fixed.bg_transparent ~ .l-main .l-section.valign_center:first-child > .l-section-h {
		top: <?php echo $header_height/2 ?>px;
		}
	
	/* Calculate height of "Full Screen" rows */
	.header_hor .l-header.pos_fixed ~ .l-main .l-section.height_full:not(:first-child) {
		<?php
		$header_sticky_height = us_get_header_option( 'top_show' ) ? intval( us_get_header_option( 'top_sticky_height' ) ) : 0;
		$header_sticky_height += intval( us_get_header_option( 'middle_sticky_height' ) );
		$header_sticky_height += us_get_header_option( 'bottom_show' ) ? intval( us_get_header_option( 'bottom_sticky_height' ) ) : 0;
		?>
		min-height: calc(100vh - <?php echo $header_sticky_height ?>px);
		}
	.admin-bar.header_hor .l-header.pos_fixed ~ .l-main .l-section.height_full:not(:first-child) {
		min-height: calc(100vh - <?php echo $header_sticky_height + 32 ?>px);
		}
		
	/* Calculate position of "Sticky" rows */
	.header_hor .l-header.pos_fixed ~ .l-main .l-section.sticky {
		top: <?php echo $header_sticky_height ?>px;
		}
	.admin-bar.header_hor .l-header.pos_fixed ~ .l-main .l-section.sticky {
		top: <?php echo $header_sticky_height + 32 ?>px;
		}
	.header_hor .titlebar_none.sidebar_none .l-header.pos_fixed.sticky ~ .l-main .l-section.type_sticky:first-child {
		padding-top: <?php echo $header_sticky_height ?>px;
		}
		
	<?php if ( us_get_header_option( 'bg_img' ) AND $bg_image = usof_get_image_src( us_get_header_option( 'bg_img' ) ) ): ?>
	.l-subheader.at_middle {
		background-image: url(<?php echo $bg_image[0] ?>);
		background-attachment: <?php echo us_get_header_option( 'bg_img_attachment' ) ?>;
		background-position: <?php echo us_get_header_option( 'bg_img_position' ) ?>;
		background-repeat: <?php echo us_get_header_option( 'bg_img_repeat' ) ?>;
		background-size: <?php echo us_get_header_option( 'bg_img_size' ) ?>;
	}
	<?php endif; ?>
	
	/* Calculate layout of vertical header */
	.header_ver {
		padding-left: <?php echo us_get_header_option( 'width' ) ?>px;
		position: relative;
		}
	.rtl.header_ver {
		padding-left: 0;
		padding-right: <?php echo us_get_header_option( 'width' ) ?>px;
		}
	.header_ver .l-header,
	.header_ver .l-header .w-cart-notification {
		width: <?php echo us_get_header_option( 'width' ) ?>px;
		}
	.header_ver .l-navigation-item.to_next {
		left: calc(<?php echo us_get_header_option( 'width' ) ?>px - 13.5rem);
		}
	.no-touch .header_ver .l-navigation-item.to_next:hover {
		left: <?php echo us_get_header_option( 'width' ) ?>px;
		}
	.rtl.header_ver .l-navigation-item.to_next {
		right: calc(<?php echo us_get_header_option( 'width' ) ?>px - 13.5rem);
		}
	.no-touch .rtl.header_ver .l-navigation-item.to_next:hover {
		right: <?php echo us_get_header_option( 'width' ) ?>px;
		}
	.header_ver .w-nav.type_desktop [class*="columns"] .w-nav-list.level_2 {
		width: calc(100vw - <?php echo us_get_header_option( 'width' ) ?>px);
		max-width: 980px;
		}
}

/* Tablets state */
@media (min-width: 601px) and (max-width: 900px) {
	
	<?php if ( ! us_get_header_option( 'top_show', 'tablets' ) ): ?>
	.l-subheader.at_top { display: none; }
	<?php endif; ?>
	
	.header_hor .l-subheader.at_top {
		line-height: <?php echo us_get_header_option( 'top_height', 'tablets' ) ?>px;
		height: <?php echo us_get_header_option( 'top_height', 'tablets' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_top {
		line-height: <?php echo us_get_header_option( 'top_sticky_height', 'tablets' ) ?>px;
		height: <?php echo us_get_header_option( 'top_sticky_height', 'tablets' ) ?>px;
		<?php if ( us_get_header_option( 'top_sticky_height', 'tablets' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	.header_hor .l-subheader.at_middle {
		line-height: <?php echo us_get_header_option( 'middle_height', 'tablets' ) ?>px;
		height: <?php echo us_get_header_option( 'middle_height', 'tablets' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_middle {
		line-height: <?php echo us_get_header_option( 'middle_sticky_height', 'tablets' ) ?>px;
		height: <?php echo us_get_header_option( 'middle_sticky_height', 'tablets' ) ?>px;
		<?php if ( us_get_header_option( 'middle_sticky_height', 'tablets' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	<?php if ( ! us_get_header_option( 'bottom_show', 'tablets' ) ): ?>
	.l-subheader.at_bottom { display: none; }
	<?php endif; ?>
	
	.header_hor .l-subheader.at_bottom {
		line-height: <?php echo us_get_header_option( 'bottom_height', 'tablets' ) ?>px;
		height: <?php echo us_get_header_option( 'bottom_height', 'tablets' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_bottom {
		line-height: <?php echo us_get_header_option( 'bottom_sticky_height', 'tablets' ) ?>px;
		height: <?php echo us_get_header_option( 'bottom_sticky_height', 'tablets' ) ?>px;
		<?php if ( us_get_header_option( 'bottom_sticky_height', 'tablets' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	/* Calculate top padding for content overlapped by sticky header */
	.header_hor .l-header.pos_fixed ~ .l-titlebar,
	.header_hor .titlebar_none.sidebar_left .l-header.pos_fixed ~ .l-main,
	.header_hor .titlebar_none.sidebar_right .l-header.pos_fixed ~ .l-main,
	.header_hor .titlebar_none.sidebar_none .l-header.pos_fixed ~ .l-main .l-section:first-child,
	.header_hor .l-header.pos_static.bg_transparent ~ .l-titlebar,
	.header_hor .titlebar_none.sidebar_left .l-header.pos_static.bg_transparent ~ .l-main,
	.header_hor .titlebar_none.sidebar_right .l-header.pos_static.bg_transparent ~ .l-main,
	.header_hor .titlebar_none.sidebar_none .l-header.pos_static.bg_transparent ~ .l-main .l-section:first-child {
		<?php
		$header_height = us_get_header_option( 'top_show', 'tablets' ) ? intval( us_get_header_option( 'top_height', 'tablets' ) ) : 0;
		$header_height += intval( us_get_header_option( 'middle_height', 'tablets' ) );
		$header_height += us_get_header_option( 'bottom_show', 'tablets' ) ? intval( us_get_header_option( 'bottom_height', 'tablets' ) ) : 0;
		?>
		padding-top: <?php echo $header_height ?>px;
		}
	.header_hor .l-header.pos_static.bg_solid + .l-main .l-section.preview_trendy .w-blog-post-preview {
		top: -<?php echo $header_height ?>px;
		}
		
	/* Calculate position of "Sticky" rows */
	.header_hor .l-header.pos_fixed ~ .l-main .l-section.sticky {
		<?php
		$header_sticky_height = us_get_header_option( 'top_show', 'tablets' ) ? intval( us_get_header_option( 'top_sticky_height', 'tablets' ) ) : 0;
		$header_sticky_height += intval( us_get_header_option( 'middle_sticky_height', 'tablets' ) );
		$header_sticky_height += us_get_header_option( 'bottom_show', 'tablets' ) ? intval( us_get_header_option( 'bottom_sticky_height', 'tablets' ) ) : 0;
		?>
		top: <?php echo $header_sticky_height ?>px;
		}
	.admin-bar.header_hor .l-header.pos_fixed ~ .l-main .l-section.sticky {
		top: <?php echo $header_sticky_height + 46 ?>px;
		}
	.header_hor .titlebar_none.sidebar_none .l-header.pos_fixed.sticky ~ .l-main .l-section.type_sticky:first-child {
		padding-top: <?php echo $header_sticky_height ?>px;
		}
		
	<?php if ( us_get_header_option( 'bg_img', 'tablets' ) AND $bg_image = usof_get_image_src( us_get_header_option( 'bg_img', 'tablets' ) ) ): ?>
	.l-subheader.at_middle {
		background-image: url(<?php echo $bg_image[0] ?>);
		background-attachment: <?php echo us_get_header_option( 'bg_img_attachment', 'tablets' ) ?>;
		background-position: <?php echo us_get_header_option( 'bg_img_position', 'tablets' ) ?>;
		background-repeat: <?php echo us_get_header_option( 'bg_img_repeat', 'tablets' ) ?>;
		background-size: <?php echo us_get_header_option( 'bg_img_size', 'tablets' ) ?>;
	}
	<?php endif; ?>
	
	.header_ver .l-header {
		width: <?php echo us_get_header_option( 'width', 'tablets' ) ?>px;
		}
}

/* Mobiles state */
@media (max-width: 600px) {
	
	<?php if ( ! us_get_header_option( 'top_show', 'mobiles' ) ): ?>
	.l-subheader.at_top { display: none; }
	<?php endif; ?>
	
	.header_hor .l-subheader.at_top {
		line-height: <?php echo us_get_header_option( 'top_height', 'mobiles' ) ?>px;
		height: <?php echo us_get_header_option( 'top_height', 'mobiles' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_top {
		line-height: <?php echo us_get_header_option( 'top_sticky_height', 'mobiles' ) ?>px;
		height: <?php echo us_get_header_option( 'top_sticky_height', 'mobiles' ) ?>px;
		<?php if ( us_get_header_option( 'top_sticky_height', 'mobiles' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	.header_hor .l-subheader.at_middle {
		line-height: <?php echo us_get_header_option( 'middle_height', 'mobiles' ) ?>px;
		height: <?php echo us_get_header_option( 'middle_height', 'mobiles' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_middle {
		line-height: <?php echo us_get_header_option( 'middle_sticky_height', 'mobiles' ) ?>px;
		height: <?php echo us_get_header_option( 'middle_sticky_height', 'mobiles' ) ?>px;
		<?php if ( us_get_header_option( 'middle_sticky_height', 'mobiles' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	<?php if ( ! us_get_header_option( 'bottom_show', 'mobiles' ) ): ?>
	.l-subheader.at_bottom { display: none; }
	<?php endif; ?>
	
	.header_hor .l-subheader.at_bottom {
		line-height: <?php echo us_get_header_option( 'bottom_height', 'mobiles' ) ?>px;
		height: <?php echo us_get_header_option( 'bottom_height', 'mobiles' ) ?>px;
		}
	.header_hor .l-header.sticky .l-subheader.at_bottom {
		line-height: <?php echo us_get_header_option( 'bottom_sticky_height', 'mobiles' ) ?>px;
		height: <?php echo us_get_header_option( 'bottom_sticky_height', 'mobiles' ) ?>px;
		<?php if ( us_get_header_option( 'bottom_sticky_height', 'mobiles' ) == 0 ): ?>
		overflow: hidden;
		<?php endif; ?>
		}
		
	/* Calculate top padding for content overlapped by sticky header */
	.header_hor .l-header.pos_fixed ~ .l-titlebar,
	.header_hor .titlebar_none.sidebar_left .l-header.pos_fixed ~ .l-main,
	.header_hor .titlebar_none.sidebar_right .l-header.pos_fixed ~ .l-main,
	.header_hor .titlebar_none.sidebar_none .l-header.pos_fixed ~ .l-main .l-section:first-child,
	.header_hor .l-header.pos_static.bg_transparent ~ .l-titlebar,
	.header_hor .titlebar_none.sidebar_left .l-header.pos_static.bg_transparent ~ .l-main,
	.header_hor .titlebar_none.sidebar_right .l-header.pos_static.bg_transparent ~ .l-main,
	.header_hor .titlebar_none.sidebar_none .l-header.pos_static.bg_transparent ~ .l-main .l-section:first-child {
		<?php
		$header_height = us_get_header_option( 'top_show', 'mobiles' ) ? intval( us_get_header_option( 'top_height', 'mobiles' ) ) : 0;
		$header_height += intval( us_get_header_option( 'middle_height', 'mobiles' ) );
		$header_height += us_get_header_option( 'bottom_show', 'mobiles' ) ? intval( us_get_header_option( 'bottom_height', 'mobiles' ) ) : 0;
		?>
		padding-top: <?php echo $header_height ?>px;
		}
	.header_hor .l-header.pos_static.bg_solid + .l-main .l-section.preview_trendy .w-blog-post-preview {
		top: -<?php echo $header_height ?>px;
		}
		
	/* Calculate position of "Sticky" rows */
	.header_hor .l-header.pos_fixed ~ .l-main .l-section.sticky {
		<?php
		$header_sticky_height = us_get_header_option( 'top_show', 'mobiles' ) ? intval( us_get_header_option( 'top_sticky_height', 'mobiles' ) ) : 0;
		$header_sticky_height += intval( us_get_header_option( 'middle_sticky_height', 'mobiles' ) );
		$header_sticky_height += us_get_header_option( 'bottom_show', 'mobiles' ) ? intval( us_get_header_option( 'bottom_sticky_height', 'mobiles' ) ) : 0;
		?>
		top: <?php echo $header_sticky_height ?>px;
		}
	.header_hor .titlebar_none.sidebar_none .l-header.pos_fixed.sticky ~ .l-main .l-section.type_sticky:first-child {
		padding-top: <?php echo $header_sticky_height ?>px;
		}
		
	<?php if ( us_get_header_option( 'bg_img', 'mobiles' ) AND $bg_image = usof_get_image_src( us_get_header_option( 'bg_img', 'mobiles' ) ) ): ?>
	.l-subheader.at_middle {
		background-image: url(<?php echo $bg_image[0] ?>);
		background-attachment: <?php echo us_get_header_option( 'bg_img_attachment', 'mobiles' ) ?>;
		background-position: <?php echo us_get_header_option( 'bg_img_position', 'mobiles' ) ?>;
		background-repeat: <?php echo us_get_header_option( 'bg_img_repeat', 'mobiles' ) ?>;
		background-size: <?php echo us_get_header_option( 'bg_img_size', 'mobiles' ) ?>;
	}
	<?php endif; ?>
	
}

/* Header Elements Settings
   ========================================================================== */

/* Image */
<?php foreach ( us_get_header_elms_of_a_type( 'image' ) as $class => $param ): ?>
@media (min-width: 901px) {
	.<?php echo $class ?> { height: <?php echo $param['height'] ?>px; }
	.l-header.sticky .<?php echo $class ?> { height: <?php echo $param['height_sticky'] ?>px; }
}
@media (min-width: 601px) and (max-width: 900px) {
	.<?php echo $class ?> { height: <?php echo $param['height_tablets'] ?>px; }
	.l-header.sticky .<?php echo $class ?> { height: <?php echo $param['height_sticky_tablets'] ?>px; }
}
@media (max-width: 600px) {
	.<?php echo $class ?> { height: <?php echo $param['height_mobiles'] ?>px; }
	.l-header.sticky .<?php echo $class ?> { height: <?php echo $param['height_sticky_mobiles'] ?>px; }
}
<?php endforeach; ?>

/* Text */
<?php foreach ( us_get_header_elms_of_a_type( 'text' ) as $class => $param ): ?>
.<?php echo $class ?> .w-text-value { color: <?php echo $param['color'] ?>; }
@media (min-width: 901px) {
	.<?php echo $class ?> { font-size: <?php echo $param['size'] ?>px; }
}
@media (min-width: 601px) and (max-width: 900px) {
	.<?php echo $class ?> { font-size: <?php echo $param['size_tablets'] ?>px; }
}
@media (max-width: 600px) {
	.<?php echo $class ?> { font-size: <?php echo $param['size_mobiles'] ?>px; }
}

<?php if ( ! $param['wrap'] ): ?>
.<?php echo $class ?> { white-space: nowrap; }
<?php endif; ?>

<?php endforeach; ?>

/* Button */
<?php foreach ( us_get_header_elms_of_a_type( 'btn' ) as $class => $param ): ?>
@media (min-width: 901px) {
	.<?php echo $class ?> .w-btn { font-size: <?php echo $param['size'] ?>px; }
}
@media (min-width: 601px) and (max-width: 900px) {
	.<?php echo $class ?> .w-btn { font-size: <?php echo $param['size_tablets'] ?>px; }
}
@media (max-width: 600px) {
	.<?php echo $class ?> .w-btn { font-size: <?php echo $param['size_mobiles'] ?>px; }
}
.l-header .<?php echo $class ?> .w-btn.style_solid {
	background-color: <?php echo $param['color_bg'] ?>;
	color: <?php echo $param['color_text'] ?>;
	}
.l-header .<?php echo $class ?> .w-btn.style_outlined {
	box-shadow: 0 0 0 2px <?php echo $param['color_bg'] ?> inset;
	color: <?php echo $param['color_text'] ?>;
	}
.no-touch .l-header .<?php echo $class ?> .w-btn:hover {
	background-color: <?php echo $param['color_hover_bg'] ?>;
	color: <?php echo $param['color_hover_text'] ?> !important;
	}
<?php endforeach; ?>

/* Main Menu */
<?php foreach ( us_get_header_elms_of_a_type( 'menu' ) as $class => $param ): ?>
.header_hor .<?php echo $class ?>.type_desktop .w-nav-list.level_1 > .menu-item > a {
	padding: 0 <?php echo $param['indents']/2 ?>px;
	}
.header_ver .<?php echo $class ?>.type_desktop {
	line-height: <?php echo $param['indents'] ?>px;
	}
.<?php echo $class ?>.type_desktop .btn.w-nav-item.level_1 > .w-nav-anchor {
	margin: <?php echo $param['indents']/4 ?>px;
	}
.<?php echo $class ?>.type_desktop .w-nav-list.level_1 > .menu-item > a,
.<?php echo $class ?>.type_desktop [class*="columns"] .menu-item-has-children .w-nav-anchor.level_2 {
	font-size: <?php echo $param['font_size'] ?>px;
	}
.<?php echo $class ?>.type_desktop .w-nav-anchor:not(.level_1) {
	font-size: <?php echo $param['dropdown_font_size'] ?>px;
	}
.<?php echo $class ?>.type_mobile .w-nav-anchor.level_1 {
	font-size: <?php echo $param['mobile_font_size'] ?>px;
	}
.<?php echo $class ?>.type_mobile .w-nav-anchor:not(.level_1) {
	font-size: <?php echo $param['mobile_dropdown_font_size'] ?>px;
	}
<?php endforeach; ?>

/* Additional Menu */
<?php foreach ( us_get_header_elms_of_a_type( 'additional_menu' ) as $class => $param ): ?>
@media (min-width: 901px) {
.<?php echo $class ?> {
	font-size: <?php echo $param['size'] ?>px;
	}
.header_hor .<?php echo $class ?> .w-menu-list {
	margin: 0 -<?php echo $param['indents']/2 ?>px;
	}
.header_hor .<?php echo $class ?> .w-menu-item {
	padding: 0 <?php echo $param['indents']/2 ?>px;
	}
.header_ver .<?php echo $class ?> .w-menu-list {
	line-height: <?php echo $param['indents'] ?>px;
	}
}
@media (min-width: 601px) and (max-width: 900px) {
.<?php echo $class ?> {
	font-size: <?php echo $param['size_tablets'] ?>px;
	}
.header_hor .<?php echo $class ?> .w-menu-list {
	margin: 0 -<?php echo $param['indents_tablets']/2 ?>px;
	}
.header_hor .<?php echo $class ?> .w-menu-item {
	padding: 0 <?php echo $param['indents_tablets']/2 ?>px;
	}
.header_ver .<?php echo $class ?> .w-menu-list {
	line-height: <?php echo $param['indents_tablets'] ?>px;
	}
}
@media (max-width: 600px) {
.<?php echo $class ?> {
	font-size: <?php echo $param['size_mobiles'] ?>px;
	}
.header_hor .<?php echo $class ?> .w-menu-list {
	margin: 0 -<?php echo $param['indents_mobiles']/2 ?>px;
	}
.header_hor .<?php echo $class ?> .w-menu-item {
	padding: 0 <?php echo $param['indents_mobiles']/2 ?>px;
	}
.header_ver .<?php echo $class ?> .w-menu-list {
	line-height: <?php echo $param['indents_mobiles'] ?>px;
	}
}
<?php endforeach; ?>

/* Search */
<?php foreach ( us_get_header_elms_of_a_type( 'search' ) as $class => $param ): ?>
@media (min-width: 901px) {
.<?php echo $class ?>.layout_simple {
	max-width: <?php echo $param['width'] ?>px;
	}
.<?php echo $class ?>.layout_modern.active {
	width: <?php echo $param['width'] ?>px;
	}
}
@media (min-width: 601px) and (max-width: 900px) {
.<?php echo $class ?>.layout_simple {
	max-width: <?php echo $param['width_tablets'] ?>px;
	}
.<?php echo $class ?>.layout_modern.active {
	width: <?php echo $param['width_tablets'] ?>px;
	}
}
<?php endforeach; ?>

/* Socials */
<?php foreach ( us_get_header_elms_of_a_type( 'socials' ) as $class => $param ): ?>
@media (min-width: 901px) {
.<?php echo $class ?> {
	font-size: <?php echo $param['size'] ?>px;
	}
}
@media (min-width: 601px) and (max-width: 900px) {
.<?php echo $class ?> {
	font-size: <?php echo $param['size_tablets'] ?>px;
	}
}
@media (max-width: 600px) {
.<?php echo $class ?> {
	font-size: <?php echo $param['size_mobiles'] ?>px;
	}
}
.<?php echo $class ?> .custom .w-socials-item-link-hover {
	background-color: <?php echo $param['custom_color'] ?>;
	}
.<?php echo $class ?>.color_brand .custom .w-socials-item-link {
	color: <?php echo $param['custom_color'] ?>;
	}
<?php endforeach; ?>

/* Dropdown */
<?php foreach ( us_get_header_elms_of_a_type( 'dropdown' ) as $class => $param ): ?>
@media (min-width: 901px) {
.<?php echo $class ?> .w-dropdown-h {
	font-size: <?php echo $param['size'] ?>px;
	}
}
@media (min-width: 601px) and (max-width: 900px) {
.<?php echo $class ?> .w-dropdown-h {
	font-size: <?php echo $param['size_tablets'] ?>px;
	}
}
@media (max-width: 600px) {
.<?php echo $class ?> .w-dropdown-h {
	font-size: <?php echo $param['size_mobiles'] ?>px;
	}
}
<?php endforeach; ?>

/* Cart */
<?php foreach ( us_get_header_elms_of_a_type( 'cart' ) as $class => $param ): ?>
@media (min-width: 901px) {
.<?php echo $class ?> .w-cart-link {
	font-size: <?php echo $param['size'] ?>px;
	}
}
@media (min-width: 601px) and (max-width: 900px) {
.<?php echo $class ?> .w-cart-link {
	font-size: <?php echo $param['size_tablets'] ?>px;
	}
}
@media (max-width: 600px) {
.<?php echo $class ?> .w-cart-link {
	font-size: <?php echo $param['size_mobiles'] ?>px;
	}
}
<?php endforeach; ?>

/* Design Options */
<?php echo us_get_header_design_options_css() ?>

/* Color Styles
   ========================================================================== */

body {
	background-color: <?php echo us_get_option( 'color_body_bg' ) ?>;
	}

/*************************** HEADER ***************************/

/* Top Header Colors */
.l-subheader.at_top,
.l-subheader.at_top .w-dropdown-list,
.header_hor .l-subheader.at_top .type_mobile .w-nav-list.level_1 {
	background-color: <?php echo us_get_option( 'color_header_top_bg' ) ?>;
	}
.l-subheader.at_top,
.l-subheader.at_top .w-dropdown.active,
.header_hor .l-subheader.at_top .type_mobile .w-nav-list.level_1 {
	color: <?php echo us_get_option( 'color_header_top_text' ) ?>;
	}
.no-touch .l-subheader.at_top a:hover,
.no-touch .l-subheader.at_top .w-cart-quantity,
.no-touch .l-header.bg_transparent .l-subheader.at_top .w-dropdown.active a:hover {
	color: <?php echo us_get_option( 'color_header_top_text_hover' ) ?>;
	}

/* Middle Header Colors */
.header_ver .l-header,
.header_hor .l-subheader.at_middle,
.l-subheader.at_middle .w-dropdown-list,
.header_hor .l-subheader.at_middle .type_mobile .w-nav-list.level_1 {
	background-color: <?php echo us_get_option( 'color_header_middle_bg' ) ?>;
	}
.l-subheader.at_middle,
.l-subheader.at_middle .w-dropdown.active,
.header_hor .l-subheader.at_middle .type_mobile .w-nav-list.level_1 {
	color: <?php echo us_get_option( 'color_header_middle_text' ) ?>;
	}
.no-touch .l-subheader.at_middle a:hover,
.no-touch .l-subheader.at_middle .w-cart-quantity,
.no-touch .l-header.bg_transparent .l-subheader.at_middle .w-dropdown.active a:hover {
	color: <?php echo us_get_option( 'color_header_middle_text_hover' ) ?>;
	}

/* Bottom Header Colors */
.l-subheader.at_bottom,
.l-subheader.at_bottom .w-dropdown-list,
.header_hor .l-subheader.at_bottom .type_mobile .w-nav-list.level_1 {
	background-color: <?php echo us_get_option( 'color_header_bottom_bg' ) ?>;
	}
.l-subheader.at_bottom,
.l-subheader.at_bottom .w-dropdown.active,
.header_hor .l-subheader.at_bottom .type_mobile .w-nav-list.level_1 {
	color: <?php echo us_get_option( 'color_header_bottom_text' ) ?>;
	}
.no-touch .l-subheader.at_bottom a:hover,
.no-touch .l-subheader.at_bottom .w-cart-quantity,
.no-touch .l-header.bg_transparent .l-subheader.at_bottom .w-dropdown.active a:hover {
	color: <?php echo us_get_option( 'color_header_bottom_text_hover' ) ?>;
	}

/* Transparent Header Colors */
.l-header.bg_transparent:not(.sticky) .l-subheader {
	color: <?php echo us_get_option( 'color_header_transparent_text' ) ?>;
	}
.no-touch .l-header.bg_transparent:not(.sticky) a:not(.w-nav-anchor):hover,
.no-touch .l-header.bg_transparent:not(.sticky) .type_desktop .w-nav-item.level_1:hover > .w-nav-anchor {
	color: <?php echo us_get_option( 'color_header_transparent_text_hover' ) ?>;
	}
.l-header.bg_transparent:not(.sticky) .w-nav-title:after {
	background-color: <?php echo us_get_option( 'color_header_transparent_text_hover' ) ?>;
	}
	
/* Search Colors */
.w-search-form {
	background-color: <?php echo us_get_option( 'color_header_search_bg' ) ?>;
	color: <?php echo us_get_option( 'color_header_search_text' ) ?>;
	}
.w-search.layout_fullscreen .w-search-background {
	background-color: <?php echo us_get_option( 'color_header_search_bg' ) ?>;
	}
.w-search.layout_fullscreen input:focus + .w-form-row-field-bar:before,
.w-search.layout_fullscreen input:focus + .w-form-row-field-bar:after {
	background-color: <?php echo us_get_option( 'color_header_search_text' ) ?>;
	}

/*************************** MAIN MENU ***************************/

/* Menu Hover Colors */
.no-touch .w-nav-item.level_1:hover > .w-nav-anchor {
	background-color: <?php echo us_get_option( 'color_menu_hover_bg' ) ?>;
	color: <?php echo us_get_option( 'color_menu_hover_text' ) ?>;
	}
.w-nav-title:after {
	background-color: <?php echo us_get_option( 'color_menu_hover_text' ) ?>;
	}

/* Menu Active Colors */
.w-nav-item.level_1.current-menu-item > .w-nav-anchor,
.w-nav-item.level_1.current-menu-parent > .w-nav-anchor,
.w-nav-item.level_1.current-menu-ancestor > .w-nav-anchor {
	background-color: <?php echo us_get_option( 'color_menu_active_bg' ) ?>;
	color: <?php echo us_get_option( 'color_menu_active_text' ) ?>;
	}

/* Transparent Menu Active Text Color */
.l-header.bg_transparent:not(.sticky) .type_desktop .w-nav-item.level_1.current-menu-item > .w-nav-anchor,
.l-header.bg_transparent:not(.sticky) .type_desktop .w-nav-item.level_1.current-menu-ancestor > .w-nav-anchor {
	color: <?php echo us_get_option( 'color_menu_transparent_active_text' ) ?>;
	}

/* Dropdown Colors */
.w-nav-list:not(.level_1) {
	background-color: <?php echo us_get_option( 'color_drop_bg' ) ?>;
	color: <?php echo us_get_option( 'color_drop_text' ) ?>;
	}
.w-nav-anchor:not(.level_1) .ripple {
	background-color: <?php echo us_get_option( 'color_drop_text' ) ?>;
	}

/* Dropdown Hover Colors */
.no-touch .w-nav-item:not(.level_1):hover > .w-nav-anchor {
	background-color: <?php echo us_get_option( 'color_drop_hover_bg' ) ?>;
	color: <?php echo us_get_option( 'color_drop_hover_text' ) ?>;
	}

/* Dropdown Active Colors */
.w-nav-item:not(.level_1).current-menu-item > .w-nav-anchor,
.w-nav-item:not(.level_1).current-menu-parent > .w-nav-anchor,
.w-nav-item:not(.level_1).current-menu-ancestor > .w-nav-anchor {
	background-color: <?php echo us_get_option( 'color_drop_active_bg' ) ?>;
	color: <?php echo us_get_option( 'color_drop_active_text' ) ?>;
	}

/* Header Button */
.btn.w-menu-item,
.btn.menu-item.level_1 > a,
.l-footer .vc_wp_custommenu.layout_hor .btn > a {
	background-color: <?php echo us_get_option( 'color_menu_button_bg' ) ?> !important;
	color: <?php echo us_get_option( 'color_menu_button_text' ) ?> !important;
	}
.no-touch .btn.w-menu-item:hover,
.no-touch .btn.menu-item.level_1 > a:hover,
.no-touch .l-footer .vc_wp_custommenu.layout_hor .btn > a:hover {
	background-color: <?php echo us_get_option( 'color_menu_button_hover_bg' ) ?> !important;
	color: <?php echo us_get_option( 'color_menu_button_hover_text' ) ?> !important;
	}

/*************************** MAIN CONTENT ***************************/

/* Background Color */
body.us_iframe,
.l-preloader,
.l-canvas,
.l-footer,
.l-popup-box-content,
.w-blog.layout_flat .w-blog-post-h,
.w-cart-dropdown,
.w-pricing.style_1 .w-pricing-item-h,
.w-person.layout_card,
.woocommerce .form-row .chosen-drop,
.us-woo-shop_modern .product-h,
.no-touch .us-woo-shop_modern .product-meta,
.woocommerce #payment .payment_box,
.widget_layered_nav ul li.chosen,
.wpcf7-form-control-wrap.type_select:after {
	background-color: <?php echo us_get_option( 'color_content_bg' ) ?>;
	}
.woocommerce #payment .payment_methods li > input:checked + label,
.woocommerce .blockUI.blockOverlay {
	background-color: <?php echo us_get_option( 'color_content_bg' ) ?> !important;
	}
button.w-btn.color_contrast.style_raised,
a.w-btn.color_contrast.style_raised,
.w-iconbox.style_circle.color_contrast .w-iconbox-icon {
	color: <?php echo us_get_option( 'color_content_bg' ) ?>;
	}

/* Alternate Background Color */
.l-section.color_alternate,
.l-titlebar.color_alternate,
.no-touch .l-titlebar .g-nav-item:hover,
.l-section.for_blogpost .w-blog-post-preview,
.l-section.for_related .l-section-h,
.l-canvas.sidebar_none .l-section.for_comments,
.w-actionbox.color_light,
.w-author,
.w-blog.layout_latest .w-blog-post-meta-date,
.no-touch .w-btn.style_flat:hover,
.no-touch .pagination a.page-numbers:hover,
.g-filters-item .ripple,
.w-form.for_protected,
.w-iconbox.style_circle.color_light .w-iconbox-icon,
.g-loadmore-btn,
.no-touch .owl-prev:hover,
.no-touch .owl-next:hover,
.w-profile,
.w-pricing.style_1 .w-pricing-item-header,
.w-pricing.style_2 .w-pricing-item-h,
.w-progbar-bar,
.w-progbar.style_3 .w-progbar-bar:before,
.w-progbar.style_3 .w-progbar-bar-count,
.l-main .w-socials-item-link,
.w-tabs-item .ripple,
.w-tabs.layout_timeline .w-tabs-item,
.w-testimonials.style_1 .w-testimonial-h,
.widget_calendar #calendar_wrap,
.no-touch .l-main .widget_nav_menu a:hover,
.woocommerce .login,
.woocommerce .track_order,
.woocommerce .checkout_coupon,
.woocommerce .lost_reset_password,
.woocommerce .register,
.no-touch .us-woo-shop_modern .product-h .button:hover,
.woocommerce .variations_form,
.woocommerce .variations_form .variations td.value:after,
.woocommerce .comment-respond,
.woocommerce .stars span a:after,
.woocommerce .cart_totals,
.no-touch .woocommerce .product-remove a:hover,
.woocommerce .checkout #order_review,
.woocommerce ul.order_details,
.widget_shopping_cart,
.widget_layered_nav ul,
.smile-icon-timeline-wrap .timeline-wrapper .timeline-block,
.smile-icon-timeline-wrap .timeline-feature-item.feat-item {
	background-color: <?php echo us_get_option( 'color_content_bg_alt' ) ?>;
	}
.timeline-wrapper .timeline-post-right .ult-timeline-arrow l,
.timeline-wrapper .timeline-post-left .ult-timeline-arrow l,
.timeline-feature-item.feat-item .ult-timeline-arrow l {
	border-color: <?php echo us_get_option( 'color_content_bg_alt' ) ?>;
	}

/* Border Color */
hr,
td,
th,
input,
textarea,
select,
.l-section,
.vc_column_container,
.vc_column-inner,
.w-form-row-field input:focus,
.w-form-row-field textarea:focus,
.widget_search input[type="text"]:focus,
.w-separator,
.w-sharing-item,
.w-tabs-list,
.w-tabs-section,
.w-tabs-section-header:before,
.l-main .widget_nav_menu .menu,
.l-main .widget_nav_menu .menu-item a,
.wpml-ls-legacy-dropdown a,
.wpml-ls-legacy-dropdown-click a,
.woocommerce .quantity.buttons_added input.qty,
.woocommerce .quantity.buttons_added .plus,
.woocommerce .quantity.buttons_added .minus,
.woocommerce-tabs .tabs,
.woocommerce .related,
.woocommerce .upsells,
.woocommerce .cross-sells,
.woocommerce ul.order_details li,
.select2-container a.select2-choice,
.smile-icon-timeline-wrap .timeline-line {
	border-color: <?php echo us_get_option( 'color_content_border' ) ?>;
	}
.w-iconbox.style_default.color_light .w-iconbox-icon,
.w-separator,
.pagination .page-numbers,
.woocommerce .star-rating:before {
	color: <?php echo us_get_option( 'color_content_border' ) ?>;
	}
.no-touch .l-titlebar.color_alternate .g-nav-item:hover,
button.w-btn.color_light.style_raised,
a.w-btn.color_light.style_raised,
.no-touch .color_alternate .w-btn.style_flat:hover,
.no-touch .g-loadmore-btn:hover,
.color_alternate .g-filters-item .ripple,
.color_alternate .w-tabs-item .ripple,
.no-touch .color_alternate .owl-prev:hover,
.no-touch .color_alternate .owl-next:hover,
.no-touch .color_alternate .pagination a.page-numbers:hover,
.no-touch .woocommerce #payment .payment_methods li > label:hover,
.widget_price_filter .ui-slider:before {
	background-color: <?php echo us_get_option( 'color_content_border' ) ?>;
	}

/* Heading Color */
h1, h2, h3, h4, h5, h6,
.w-counter-number {
	color: <?php echo us_get_option( 'color_content_heading' ) ?>;
	}
.w-progbar.color_heading .w-progbar-bar-h {
	background-color: <?php echo us_get_option( 'color_content_heading' ) ?>;
	}

/* Text Color */
.l-canvas,
.l-footer,
.l-popup-box-content,
button.w-btn.color_light.style_raised,
a.w-btn.color_light.style_raised,
.w-blog.layout_flat .w-blog-post-h,
.w-cart-dropdown,
.w-iconbox.style_circle.color_light .w-iconbox-icon,
.w-pricing-item-h,
.w-person.layout_card,
.w-tabs.layout_timeline .w-tabs-item,
.w-testimonials.style_1 .w-testimonial-h,
.woocommerce .form-row .chosen-drop,
.us-woo-shop_modern .product-h {
	color: <?php echo us_get_option( 'color_content_text' ) ?>;
	}
button.w-btn.color_contrast.style_raised,
a.w-btn.color_contrast.style_raised,
.w-iconbox.style_circle.color_contrast .w-iconbox-icon,
.w-progbar.color_text .w-progbar-bar-h,
.w-scroller-dot span {
	background-color: <?php echo us_get_option( 'color_content_text' ) ?>;
	}
.w-scroller-dot span {
	box-shadow: 0 0 0 2px <?php echo us_get_option( 'color_content_text' ) ?>;
	}
	
/* Link Color */
a {
	color: <?php echo us_get_option( 'color_content_link' ) ?>;
	}

/* Link Hover Color */
.no-touch a:hover,
.no-touch a:hover + .w-blog-post-body .w-blog-post-title a,
.no-touch .w-blog-post-title a:hover {
	color: <?php echo us_get_option( 'color_content_link_hover' ) ?>;
	}
.no-touch .w-cart-dropdown a:not(.button):hover {
	color: <?php echo us_get_option( 'color_content_link_hover' ) ?> !important;
	}

/* Primary Color */
.highlight_primary,
.l-preloader,
button.w-btn.color_primary.style_flat,
a.w-btn.color_primary.style_flat,
.w-counter.color_primary .w-counter-number,
.w-iconbox.style_default.color_primary .w-iconbox-icon,
.g-filters-item.active,
.w-form-row.focused:before,
.w-form-row.focused > i,
.no-touch .w-sharing.type_simple.color_primary .w-sharing-item:hover .w-sharing-icon,
.w-separator.color_primary,
.w-tabs-item.active,
.w-tabs-section.active .w-tabs-section-header,
.l-main .widget_nav_menu .menu-item.current-menu-item > a,
.no-touch .us-woo-shop_modern .product-h a.button,
.woocommerce-tabs .tabs li.active,
.woocommerce #payment .payment_methods li > input:checked + label,
input[type="radio"]:checked + .wpcf7-list-item-label:before,
input[type="checkbox"]:checked + .wpcf7-list-item-label:before {
	color: <?php echo us_get_option( 'color_content_primary' ) ?>;
	}
.l-section.color_primary,
.l-titlebar.color_primary,
.no-touch .l-navigation-item:hover .l-navigation-item-arrow,
.highlight_primary_bg,
.w-actionbox.color_primary,
.w-blog-post-preview-icon,
button,
input[type="submit"],
a.w-btn.color_primary.style_raised,
.pagination .page-numbers.current,
.w-form-row.focused .w-form-row-field-bar:before,
.w-form-row.focused .w-form-row-field-bar:after,
.w-iconbox.style_circle.color_primary .w-iconbox-icon,
.w-pricing.style_1 .type_featured .w-pricing-item-header,
.w-pricing.style_2 .type_featured .w-pricing-item-h,
.w-progbar.color_primary .w-progbar-bar-h,
.w-sharing.type_solid.color_primary .w-sharing-item,
.w-sharing.type_fixed.color_primary .w-sharing-item,
.w-tabs-list-bar,
.w-tabs.layout_timeline .w-tabs-item.active,
.no-touch .w-tabs.layout_timeline .w-tabs-item:hover,
.w-tabs.layout_timeline .w-tabs-section.active .w-tabs-section-header-h,
.rsDefault .rsThumb.rsNavSelected,
.woocommerce .button.alt,
.woocommerce .button.checkout,
.widget_price_filter .ui-slider-range,
.widget_price_filter .ui-slider-handle,
.smile-icon-timeline-wrap .timeline-separator-text .sep-text,
.smile-icon-timeline-wrap .timeline-wrapper .timeline-dot,
.smile-icon-timeline-wrap .timeline-feature-item .timeline-dot,
.l-body .cl-btn {
	background-color: <?php echo us_get_option( 'color_content_primary' ) ?>;
	}
.l-content blockquote,
.g-filters-item.active,
input:focus,
textarea:focus,
.w-separator.color_primary,
.owl-dot.active span,
.rsBullet.rsNavSelected span,
.woocommerce .quantity.buttons_added input.qty:focus,
.validate-required.woocommerce-validated input:focus,
.validate-required.woocommerce-invalid input:focus,
.woocommerce .button.loading:before,
.woocommerce .button.loading:after,
.woocommerce .form-row .chosen-search input[type="text"]:focus,
.woocommerce-tabs .tabs li.active,
.select2-dropdown-open.select2-drop-above a.select2-choice {
	border-color: <?php echo us_get_option( 'color_content_primary' ) ?>;
	}
input:focus,
textarea:focus,
.select2-dropdown-open a.select2-choice {
	box-shadow: 0 -1px 0 0 <?php echo us_get_option( 'color_content_primary' ) ?> inset;
	}

/* Secondary Color */
.highlight_secondary,
.no-touch .w-blognav-prev:hover .w-blognav-title,
.no-touch .w-blognav-next:hover .w-blognav-title,
button.w-btn.color_secondary.style_flat,
a.w-btn.color_secondary.style_flat,
.w-counter.color_secondary .w-counter-number,
.w-iconbox.style_default.color_secondary .w-iconbox-icon,
.w-iconbox.style_default .w-iconbox-link:active .w-iconbox-icon,
.no-touch .w-iconbox.style_default .w-iconbox-link:hover .w-iconbox-icon,
.w-iconbox-link:active .w-iconbox-title,
.no-touch .w-iconbox-link:hover .w-iconbox-title,
.no-touch .w-sharing.type_simple.color_secondary .w-sharing-item:hover .w-sharing-icon,
.w-separator.color_secondary,
.woocommerce .star-rating span:before,
.woocommerce .stars span a:after {
	color: <?php echo us_get_option( 'color_content_secondary' ) ?>;
	}
.l-section.color_secondary,
.l-titlebar.color_secondary,
.highlight_secondary_bg,
.no-touch .w-blog.layout_tiles .w-blog-post-meta-category a:hover,
.no-touch .l-section.preview_trendy .w-blog-post-meta-category a:hover,
button.w-btn.color_secondary.style_raised,
a.w-btn.color_secondary.style_raised,
.w-actionbox.color_secondary,
.w-iconbox.style_circle.color_secondary .w-iconbox-icon,
.w-progbar.color_secondary .w-progbar-bar-h,
.w-sharing.type_solid.color_secondary .w-sharing-item,
.w-sharing.type_fixed.color_secondary .w-sharing-item,
.no-touch .w-toplink.active:hover,
.no-touch .tp-leftarrow.tparrows.custom:hover,
.no-touch .tp-rightarrow.tparrows.custom:hover,
p.demo_store,
.woocommerce .onsale,
.woocommerce .form-row .chosen-results li.highlighted {
	background-color: <?php echo us_get_option( 'color_content_secondary' ) ?>;
	}
.w-separator.color_secondary {
	border-color: <?php echo us_get_option( 'color_content_secondary' ) ?>;
	}

/* Fade Elements Color */
.highlight_faded,
button.w-btn.color_light.style_flat,
a.w-btn.color_light.style_flat,
.w-author-url,
.w-blog-post-meta > *,
.w-comments-item-date,
.w-comments-item-answer a,
.w-profile-link.for_logout,
.l-main .w-socials.color_desaturated .w-socials-item-link,
.g-tags,
.w-testimonial-author-role,
.l-main .widget_tag_cloud,
.l-main .widget_product_tag_cloud,
.woocommerce .stars span:after {
	color: <?php echo us_get_option( 'color_content_faded' ) ?>;
	}
.w-btn.style_flat .ripple,
.w-btn.color_light.style_raised .ripple,
.w-iconbox.style_circle.color_light .ripple,
.l-main .w-socials.color_desaturated_inv .w-socials-item-link {
	background-color: <?php echo us_get_option( 'color_content_faded' ) ?>;
	}

/*************************** TOP FOOTER ***************************/

/* Background Color */
.color_footer-top,
.color_footer-top .wpcf7-form-control-wrap.type_select:after {
	background-color: <?php echo us_get_option( 'color_subfooter_bg' ) ?>;
	}

/* Alternate Background Color */
.color_footer-top .w-socials-item-link,
.color_footer-top .widget_shopping_cart {
	background-color: <?php echo us_get_option( 'color_subfooter_bg_alt' ) ?>;
	}

/* Border Color */
.color_footer-top,
.color_footer-top *,
.color_footer-top .w-form-row input:focus,
.color_footer-top .w-form-row textarea:focus {
	border-color: <?php echo us_get_option( 'color_subfooter_border' ) ?>;
	}
.color_footer-top .w-separator {
	color: <?php echo us_get_option( 'color_subfooter_border' ) ?>;
	}

/* Text Color */
.color_footer-top {
	color: <?php echo us_get_option( 'color_subfooter_text' ) ?>;
	}

/* Link Color */
.color_footer-top a {
	color: <?php echo us_get_option( 'color_subfooter_link' ) ?>;
	}

/* Link Hover Color */
.no-touch .color_footer-top a:hover,
.color_footer-top .w-form-row.focused:before,
.color_footer-top .w-form-row.focused > i {
	color: <?php echo us_get_option( 'color_subfooter_link_hover' ) ?>;
	}
.color_footer-top .w-form-row.focused .w-form-row-field-bar:before,
.color_footer-top .w-form-row.focused .w-form-row-field-bar:after {
	background-color: <?php echo us_get_option( 'color_subfooter_link_hover' ) ?>;
	}
.color_footer-top input:focus,
.color_footer-top textarea:focus {
	border-color: <?php echo us_get_option( 'color_subfooter_link_hover' ) ?>;
	box-shadow: 0 -1px 0 0 <?php echo us_get_option( 'color_subfooter_link_hover' ) ?> inset;
	}

/*************************** BOTTOM FOOTER ***************************/

/* Background Color */
.color_footer-bottom,
.color_footer-bottom .wpcf7-form-control-wrap.type_select:after {
	background-color: <?php echo us_get_option( 'color_footer_bg' ) ?>;
	}
	
/* Alternate Background Color */
.color_footer-bottom .w-socials-item-link,
.color_footer-bottom .widget_shopping_cart {
	background-color: <?php echo us_get_option( 'color_footer_bg_alt' ) ?>;
	}

/* Border Color */
.color_footer-bottom,
.color_footer-bottom,
.color_footer-bottom .w-form-row input:focus,
.color_footer-bottom .w-form-row textarea:focus {
	border-color: <?php echo us_get_option( 'color_footer_border' ) ?>;
	}
.color_footer-bottom .w-separator {
	color: <?php echo us_get_option( 'color_footer_border' ) ?>;
	}

/* Text Color */
.color_footer-bottom {
	color: <?php echo us_get_option( 'color_footer_text' ) ?>;
	}

/* Link Color */
.color_footer-bottom a {
	color: <?php echo us_get_option( 'color_footer_link' ) ?>;
	}

/* Link Hover Color */
.no-touch .color_footer-bottom a:hover,
.color_footer-bottom .w-form-row.focused:before,
.color_footer-bottom .w-form-row.focused > i {
	color: <?php echo us_get_option( 'color_footer_link_hover' ) ?>;
	}
.color_footer-bottom .w-form-row.focused .w-form-row-field-bar:before,
.color_footer-bottom .w-form-row.focused .w-form-row-field-bar:after {
	background-color: <?php echo us_get_option( 'color_footer_link_hover' ) ?>;
	}
.color_footer-bottom input:focus,
.color_footer-bottom textarea:focus {
	border-color: <?php echo us_get_option( 'color_footer_link_hover' ) ?>;
	box-shadow: 0 -1px 0 0 <?php echo us_get_option( 'color_footer_link_hover' ) ?> inset;
	}

<?php if ($bg_img = us_get_header_option('bg_img')){
	$bg_image = usof_get_image_src( us_get_header_option('bg_img') );
}

if ( isset($bg_image) AND $bg_image): ?>
.l-subheader.at_middle {
	background-image: url(<?php echo $bg_image[0] ?>);
	background-attachment: <?php echo us_get_header_option( 'bg_img_attachment' ) ?>;
	background-position: <?php echo us_get_header_option( 'bg_img_position' ) ?>;
	background-repeat: <?php echo us_get_header_option( 'bg_img_repeat' ) ?>;
	background-size: <?php echo us_get_header_option( 'bg_img_size' ) ?>;
}
<?php endif; ?>

<?php echo us_get_option( 'custom_css', '' ) ?>

<?php if ( FALSE ): ?>/* Setting IDE context */</style><?php endif; ?>
