<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;

$enable_wishlist = get_theme_mod('edcare_product_single_wishlist_switch', false);

if (!$product->is_purchasable()) {
	return;
}

if ($product->is_in_stock()) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>
	<form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
		<div class="tp-product-details-action-wrapper">
			<h3 class="tp-product-details-action-title"><?php echo esc_html__('Quantity', 'edcare') ?></h3>

			<?php do_action('woocommerce_before_add_to_cart_button'); ?>
			<div class="tp-product-details-action-item-wrapper d-flex align-items-center">
				<?php
				do_action('woocommerce_before_add_to_cart_quantity');

				woocommerce_quantity_input(
					array(
						'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
						'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
						'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
					)
				);

				do_action('woocommerce_after_add_to_cart_quantity');
				?>
				<div class="tp-shop-details-btn-box d-flex align-items-center tp-product-details-add-to-cart w-100">
					<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="tp-product-details-add-to-cart-btn w-100 alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
						<?php echo esc_html($product->single_add_to_cart_text()); ?>
					</button>
				</div>
			</div>

			<?php do_action('woocommerce_after_add_to_cart_button'); ?>

			<!-- buy now -->
			<?php do_action('woocommerce_after_add_to_cart_form'); ?>
		</div>

	</form>


<?php endif; ?>