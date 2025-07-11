<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.3.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="row shoppong-car-wrap tp-edcare-woo-cart">
	<div class="col-lg-9 col-sm-12">
		<form class="tp-woo-cart-table woocommerce-cart-form mb-25 mr-30 "
			action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<?php do_action('woocommerce_before_cart_table'); ?>

			<div class="tp-woo-cart-table-list tp-cart-list">
				<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
					<thead>
						<tr>

							<th class="product-thumbnail"><?php esc_html_e('Thumbnail', 'edcare'); ?></span>
							</th>
							<th class="product-name"><?php esc_html_e('Product', 'edcare'); ?></th>
							<th class="product-price"><?php esc_html_e('Price', 'edcare'); ?></th>
							<th class="product-quantity"><?php esc_html_e('Quantity', 'edcare'); ?></th>
							<th class="product-subtotal"><?php esc_html_e('Subtotal', 'edcare'); ?></th>
							<th class="product-remove"><?php esc_html_e('Remove', 'edcare'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php do_action('woocommerce_before_cart_contents'); ?>

						<?php
						foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
							$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
							$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

							if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
								$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
								?>
								<tr
									class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">


									<td class="product-thumbnail">
										<?php
										$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

										if (empty($_product->get_permalink($cart_item))) {
											echo edcare_kses($thumbnail); // PHPCS: XSS ok.
										} else {
											printf('<a href="%s">%s</a>', esc_url($_product->get_permalink($cart_item)), $thumbnail); // PHPCS: XSS ok.
										}
										?>
									</td>

									<td class="product-name tp-cart-title"
										data-title="<?php esc_attr_e('Product', 'edcare'); ?>">
										<?php


										if (empty($_product->get_permalink($cart_item))) {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
										} else {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($_product->get_permalink($cart_item)), $_product->get_name()), $cart_item, $cart_item_key));
										}

										do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

										// Meta data.
										echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.
								
										// Backorder notification.
										if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'edcare') . '</p>', $product_id));
										}
										?>
									</td>

									<td class="product-price" data-title="<?php esc_attr_e('Price', 'edcare'); ?>">
										<?php
										echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
										?>
									</td>

									<td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'edcare'); ?>">
										<?php
										if ($_product->is_sold_individually()) {
											$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
										} else {
											$product_quantity = woocommerce_quantity_input(
												array(
													'input_name' => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value' => $_product->get_max_purchase_quantity(),
													'min_value' => '0',
													'product_name' => $_product->get_name(),
												),
												$_product,
												false
											);
										}

										echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
										?>
									</td>

									<td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'edcare'); ?>">
										<?php
										echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
										?>
									</td>

									<td class="product-remove">
										<?php
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa-regular fa-xmark"></i> ' . esc_html__('Remove', 'edcare') . ' </a>',
												esc_url(wc_get_cart_remove_url($cart_item_key)),
												esc_html__('Remove this item', 'edcare'),
												esc_attr($product_id),
												esc_attr($_product->get_sku())
											),
											$cart_item_key
										);
										?>
									</td>
								</tr>
								<?php
							}
						}
						?>

						<?php do_action('woocommerce_cart_contents'); ?>

						<?php do_action('woocommerce_after_cart_contents'); ?>
					</tbody>
				</table>
			</div>

			<div class="tp-woo-cart-coupon">
				<?php if (wc_coupons_enabled()): ?>
					<div class="tp-cart-coupon">
						<div class="tp-cart-coupon-input-box coupon">
							<label for="coupon_code"><?php esc_html_e('Coupon:', 'edcare'); ?></label>
							<div class="tp-cart-coupon-input d-flex align-items-center">

								<input type="text" name="coupon_code" class="input-text" id="coupon_code" value=""
									placeholder="<?php esc_attr_e('Enter Coupon Code', 'edcare'); ?>" />
								<button type="submit"
									class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : 'tp-btn'); ?>"
									name="apply_coupon"
									value="<?php esc_attr_e('Apply coupon', 'edcare'); ?>"><?php esc_html_e('Apply', 'edcare'); ?></button>
								<?php do_action('woocommerce_cart_coupon'); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="tp-cart-update text-md-end">
					<button type="submit"
						class="tp-cart-update-btn button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
						name="update_cart"
						value="<?php esc_attr_e('Update cart', 'edcare'); ?>"><?php esc_html_e('Update cart', 'edcare'); ?></button>
				</div>

				<?php do_action('woocommerce_cart_actions'); ?>

				<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
			</div>

			<?php do_action('woocommerce_after_cart_table'); ?>
		</form>
	</div>
	<div class="col-lg-3 col-md-6">
		<?php do_action('woocommerce_before_cart_collaterals'); ?>

		<div class="tp-woo-cart-checkout tp-cart-checkout-wrapper">
			<div class="cart-collaterals">
				<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action('woocommerce_cart_collaterals');
				?>
			</div>
		</div>
	</div>
</div>
<?php do_action('woocommerce_after_cart'); ?>