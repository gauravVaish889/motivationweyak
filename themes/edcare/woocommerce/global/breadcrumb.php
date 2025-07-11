<?php

/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!empty($breadcrumb)) {

?>

	<section class="breadcrumb__area include-bg pb-90">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-6">
					<div class="breadcrumb__content p-relative text-center z-index-1">
						<h3 class="breadcrumb__title edcare-shop-breadcrumb-title"><?php echo esc_html__('Shop Grid', 'edcare'); ?></h3>
						<div class="breadcrumb__list edcare-shop-breadcrumb-list">
							<?php
							echo edcare_kses($wrap_before);

							foreach ($breadcrumb as $key => $crumb) :
								echo edcare_kses($before);

								if (!empty($crumb[1]) && sizeof($breadcrumb) !== $key + 1) {
									echo '<span><a href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a></span>';
								} else {
									echo '<span>' . esc_html($crumb[0]) . '</span>';
								}

								echo edcare_kses($after);

								if (sizeof($breadcrumb) !== $key + 1) {
									echo edcare_kses($delimiter);
								}

							endforeach;

							echo edcare_kses($wrap_after);

							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php

}
