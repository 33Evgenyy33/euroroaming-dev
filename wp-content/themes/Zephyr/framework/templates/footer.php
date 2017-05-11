<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

$us_layout = US_Layout::instance();
?>
</div>

<?php
global $us_iframe;
if ( ! isset( $us_iframe ) OR ! $us_iframe ) {
	do_action( 'us_before_footer' );

	$footer_classes = '';
	$footer_layout = us_get_option( 'footer_layout' );
	if ( $footer_layout != NULL ) {
		$footer_classes .= ' layout_' . $footer_layout;
	}
?>
<footer class="l-footer<?php echo $footer_classes; ?>" itemscope="itemscope" itemtype="https://schema.org/WPFooter">

	<?php
	$footer_id = us_get_option( 'footer_id' );
	$hide_footer = FALSE;
	$footer_content = '';
	if ( is_singular() OR ( is_404() AND $page_404 = get_page_by_path( 'error-404' ) ) ) {
		if ( is_singular() ) {
			$postID = get_the_ID();
		} elseif ( is_404() ) {
			$postID = $page_404->ID;
		}
		if ( usof_meta( 'us_footer_remove', array(), $postID ) ) {
			$hide_footer = TRUE;
		}
		if ( usof_meta( 'us_footer_id', array(), $postID ) != '' ) {
			$footer_id = usof_meta( 'us_footer_id', array(), $postID );
		}
	}

	if ( ! $hide_footer AND ! empty( $footer_id ) ) {
		us_open_wp_query_context();
		$footer = get_page_by_path( $footer_id, OBJECT, 'us_footer' );
		if ( $footer ) {
			$translated_footer_id = apply_filters( 'wpml_object_id', $footer->ID, 'us_footer', TRUE );
			if ( $translated_footer_id != $footer->ID ) {
				$footer = get_post( $translated_footer_id );
			}
			global $wp_query, $vc_manager, $us_is_in_footer, $us_footer_id;
			$us_is_in_footer = TRUE;
			$us_footer_id = $translated_footer_id;
			$wp_query = new WP_Query( array(
				'p' => $translated_footer_id,
				'post_type' => 'any'
			) );
			if ( ! empty( $vc_manager ) AND is_object( $vc_manager )) {
				$vc_manager->vc()->addPageCustomCss( $translated_footer_id );
				$vc_manager->vc()->addShortcodesCustomCss( $translated_footer_id );
			}
			$footer_content = $footer->post_content;
		}
		us_close_wp_query_context();
		// Applying filters to footer content and echoing it ouside of us_open_wp_query_context so all WP widgets (like WP Nav Menu) would work as they should
		echo apply_filters( 'us_footer_the_content', $footer_content );

		$us_is_in_footer = FALSE;
	}


	?>

</footer>

<?php
	do_action( 'us_after_footer' );
}?>


<a class="w-header-show" href="javascript:void(0);"></a>
<a class="w-toplink" href="#" title="<?php _e( 'Back to top', 'us' ); ?>"></a>
<script type="text/javascript">
	if (window.$us === undefined) window.$us = {};
	$us.canvasOptions = ($us.canvasOptions || {});
	$us.canvasOptions.disableEffectsWidth = <?php echo intval( us_get_option( 'disable_effects_width', 900 ) ) ?>;
	$us.canvasOptions.responsive = <?php echo us_get_option( 'responsive_layout', TRUE ) ? 'true' : 'false' ?>;

	$us.langOptions = ($us.langOptions || {});
	$us.langOptions.magnificPopup = ($us.langOptions.magnificPopup || {});
	$us.langOptions.magnificPopup.tPrev = '<?php _e( 'Previous (Left arrow key)', 'us' ); ?>'; // Alt text on left arrow
	$us.langOptions.magnificPopup.tNext = '<?php _e( 'Next (Right arrow key)', 'us' ); ?>'; // Alt text on right arrow
	$us.langOptions.magnificPopup.tCounter = '<?php _ex( '%curr% of %total%', 'Example: 3 of 12', 'us' ); ?>'; // Markup for "1 of 7" counter

	$us.navOptions = ($us.navOptions || {});
	$us.navOptions.mobileWidth = <?php echo intval( us_get_option( 'menu_mobile_width', 900 ) ) ?>;
	$us.navOptions.togglable = <?php echo us_get_option( 'menu_togglable_type', TRUE ) ? 'true' : 'false' ?>;
	$us.ajaxLoadJs = <?php echo us_get_option( 'ajax_load_js', 0 ) ? 'true' : 'false' ?>;
	$us.templateDirectoryUri = '<?php global $us_template_directory_uri; echo $us_template_directory_uri; ?>';
</script>
<?php wp_footer(); ?>
</body>
</html>
