<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif;
		echo '<div style="/*text-align: center;*/margin-bottom: 12px;">';
//		echo '<div class="w-btn-wrapper align_left"><a class="w-btn style_raised color_secondary icon_none" href="https://euroroaming.ru/shop/aktivatsiya-sim-karty-orange-vizovye-tsentry/" style="line-height:1.3;padding:7px 17px 7px 17px;background-color:#fafafa;color:#175cac"><span class="w-btn-label">АКТИВАЦИЯ ORANGE<br> (ВИЗОВЫЕ ЦЕНТРЫ)</span><span class="ripple-container"></span></a></div>';
		echo '<div class="w-btn-wrapper align_left"><a class="w-btn style_raised color_custom icon_atleft" href="https://euroroaming.ru/replenish-the-balance/" style="line-height:1.3;padding:7px 17px 7px 17px;background-color:#fafafa;color:#175cac"><span class="w-btn-label">ПОПОЛНИТЬ<br> БАЛАНС</span><span class="ripple-container"></span></a></div>';
		echo '<div class="w-btn-wrapper align_left"><a class="w-btn style_raised color_custom icon_atleft" href="https://euroroaming.ru/shop/podklyuchenie-vodafone-internet-passport/" style="line-height:1.3;padding:7px 17px 7px 17px;background-color:#fafafa;color:#175cac"><span class="w-btn-label">Подключить<br> Internet Passport</span><span class="ripple-container"></span></a></div>';
		echo '<div class="w-btn-wrapper align_left"><a class="w-btn style_raised color_custom icon_atleft" href="https://euroroaming.ru/shop/vosstanovlenie-vodafone-italiya/" style="line-height:1.3;padding:7px 17px 7px 17px;background-color:#fafafa;color:#175cac"><span class="w-btn-label">Восстановление<br> Vodafone Италия</span><span class="ripple-container"></span></a></div>';
		echo '<div class="w-btn-wrapper align_left"><a class="w-btn style_raised color_custom icon_atleft" href="https://euroroaming.ru/points-of-shipment/" style="line-height:1.3;padding:7px 17px 7px 17px;background-color:#fafafa;color:#175cac"><span class="w-btn-label">Офисы<br> самовывоза</span><span class="ripple-container"></span></a></div>';
		echo '<div class="w-btn-wrapper align_left"><a class="w-btn style_raised color_custom icon_atleft" href="https://euroroaming.ru/wp-content/uploads/2016/05/DOGOVOR-OFERTY-OOO-EVROROUMING-zashhishhennyj.pdf" style="line-height:1.3;padding:7px 17px 7px 17px;background-color:#fafafa;color:#175cac"><span class="w-btn-label">Договор<br> оферты</span><span class="ripple-container"></span></a></div>';
		echo '<div class="w-btn-wrapper align_left"><a class="w-btn style_raised color_custom icon_atleft" href="https://euroroaming.ru/obrabotka-personalnyh-dannyh/" style="line-height:1.3;padding:7px 17px 7px 17px;background-color:#fafafa;color:#175cac"><span class="w-btn-label">Обработка<br> персональных данных</span><span class="ripple-container"></span></a></div>';
		echo '</div>';
		echo '<style>.w-btn{padding: 3px 1.5em;}</style>';
		?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
