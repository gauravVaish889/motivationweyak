<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');


?>

<div class="row">
	<div class="col-lg-3">
		<div class="profile__tab mr-40">
			<div class="nav-tabs">
				<ul>
					<?php foreach (wc_get_account_menu_items() as $endpoint => $label) :
					?>
						<li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?> nav-link">
							<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">

								<span>
									<?php if ($endpoint == 'dashboard') : ?>
										<i class="fa-light fa-house"></i>
									<?php elseif ($endpoint == 'orders') : ?>
										<i class="fa-light fa-clipboard-list-check"></i>
									<?php elseif ($endpoint == 'downloads') : ?>
										<i class="fa-light fa-laptop-arrow-down"></i>
									<?php elseif ($endpoint == 'edit-address') : ?>
										<i class="fa-light fa-location-dot"></i>
									<?php elseif ($endpoint == 'compare') : ?>
										<i class="fa-light fa-code-compare"></i>
									<?php elseif ($endpoint == 'wishlist') : ?>
										<i class="fa-light fa-heart"></i>
									<?php elseif ($endpoint == 'edit-account') : ?>
										<i class="fa-light fa-user-gear"></i>
									<?php elseif ($endpoint == 'customer-logout') : ?>
										<i class="fa-light fa-right-from-bracket"></i>
									<?php elseif ($endpoint == 'payment-methods') : ?>
										<i class="fa-light fa-credit-card"></i>
									<?php else : ?>
										<i class="fa-light fa-face-smile"></i>
									<?php endif; ?>
								</span>

								<?php echo esc_html($label); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>


	<?php do_action('woocommerce_after_account_navigation'); ?>