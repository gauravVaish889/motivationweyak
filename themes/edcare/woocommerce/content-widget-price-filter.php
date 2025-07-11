<?php
/**
 * The template for displaying product price filter widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-price-filter.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

?>
<?php do_action( 'woocommerce_widget_price_filter_start', $args ); ?>

<form method="get" action="<?php echo esc_url( $form_action ); ?>">
	<div class="tp-shop-widget-filter tp-woo-widget-price-filter">
		<div class="price_slider" style="display:none;"></div>
		<div class="price_slider_amount" data-step="<?php echo esc_attr( $step ); ?>">
			<label class="screen-reader-text" for="min_price"><?php esc_html_e( 'Min price', 'edcare' ); ?></label>

			<input type="text" id="min_price" name="min_price" value="<?php echo esc_attr( $current_min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>" placeholder="<?php echo esc_attr__( 'Min price', 'edcare' ); ?>" />

			<label class="screen-reader-text" for="max_price"><?php esc_html_e( 'Max price', 'edcare' ); ?></label>

			<input type="text" id="max_price" name="max_price" value="<?php echo esc_attr( $current_max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" placeholder="<?php echo esc_attr__( 'Max price', 'edcare' ); ?>" />

			<?php /* translators: Filter: verb "to filter" */ ?>
			

			

			<?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>

			<div class="clear"></div>

			<div class="tp-shop-widget-filter-info d-flex align-items-center justify-content-between">
				<span class="input-range">
					<?php echo esc_html__( 'Price:', 'edcare' ); ?> <span class="from"></span> &mdash; <span class="to"></span>
				</span>

				<button type="submit" class="tp-shop-widget-filter-btn button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html__( 'Filter', 'edcare' ); ?></button>
			</div>
		</div>
	</div>
</form>

<?php do_action( 'woocommerce_widget_price_filter_end', $args ); ?>
