<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');


$product_column = is_active_sidebar('product-sidebar') ? 'col-lg-9 order-1 order-lg-1' : 'col-xl-12 col-lg-12';

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

do_action('woocommerce_before_main_content');


$product_col = wc_get_loop_prop('columns');


$list_layout = !empty($_GET['tab']) ? $_GET['tab'] : '';

if (!empty($_GET['tab']) && (($_GET['tab'] == 'grid') || ($_GET['tab'] == 'list'))) {
	$tab_active = '';
	$nav_active = '';
} else {
	$tab_active = 'show active';
	$nav_active = 'active';
}

$grid_active = ('grid' === $list_layout) ? 'show active' : '';
$list_active = ('list' === $list_layout) ? 'show active' : '';

$grid_nav_active = ('grid' === $list_layout) ? 'active' : '';
$list_nav_active = ('list' === $list_layout) ? 'active' : '';

?>

<div class="row">
	<div class="col-lg-12 ">
		<?php if (woocommerce_product_loop()): ?>
			<div class="container">
				<div class="row">

					<?php if (is_active_sidebar('product-sidebar')): ?>
						<div class="col-lg-3 order-2 order-lg-0">
							<div class="tp-shop-sidebar mr-10">
								<?php dynamic_sidebar('product-sidebar'); ?>
							</div>
						</div>
						<!-- shop sidebar area end -->
					<?php endif; ?>

					<!-- shop main area start -->
					<div class=" <?php echo esc_attr($product_column); ?>">
						<div class="tp-shop-sidebar-wrap">
							<div class="tp-shop-top mb-45">
								<div class="row align-items-center">
									<div class="col-xl-8 col-lg-7">

										<div class="tp-shop-grid-sidebar-left d-flex align-items-center mb-20">
											<div class="tp-course-grid-sidebar-tab tp-tab">
												<ul class="nav nav-tabs" id="productTab" role="tablist">
													<li class="nav-item" role="presentation">
														<button class="nav-link <?php echo esc_attr($nav_active);
														echo esc_attr($grid_nav_active); ?>" id="grid-tab" data-bs-toggle="tab"
															data-bs-target="#grid-tab-pane" type="button" role="tab"
															aria-controls="grid-tab-pane" aria-selected="true">
															<svg width="14" height="14" viewBox="0 0 14 14" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<path d="M5.66667 1H1V5.66667H5.66667V1Z"
																	stroke="currentColor" stroke-linecap="round"
																	stroke-linejoin="round"></path>
																<path d="M12.9997 1H8.33301V5.66667H12.9997V1Z"
																	stroke="currentColor" stroke-linecap="round"
																	stroke-linejoin="round"></path>
																<path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z"
																	stroke="currentColor" stroke-linecap="round"
																	stroke-linejoin="round"></path>
																<path d="M5.66667 8.33337H1V13H5.66667V8.33337Z"
																	stroke="currentColor" stroke-linecap="round"
																	stroke-linejoin="round"></path>
															</svg>
														</button>
													</li>
													<li class="nav-item" role="presentation">
														<button class="nav-link <?php echo esc_attr($list_nav_active); ?>"
															id="list-tab" data-bs-toggle="tab"
															data-bs-target="#list-tab-pane" type="button" role="tab"
															aria-controls="list-tab-pane" aria-selected="false">
															<svg width="14" height="14" viewBox="0 0 16 15" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<path d="M15 7.11108H1" stroke="currentColor"
																	stroke-width="1" stroke-linecap="round"
																	stroke-linejoin="round"></path>
																<path d="M15 1H1" stroke="currentColor" stroke-width="1"
																	stroke-linecap="round" stroke-linejoin="round"></path>
																<path d="M15 13.2222H1" stroke="currentColor"
																	stroke-width="1" stroke-linecap="round"
																	stroke-linejoin="round"></path>
															</svg>
														</button>
													</li>
												</ul>
											</div>

											<div class="tp-shop-top-result">
												<?php
												/**
												 * Hook: woocommerce_before_shop_loop.
												 *
												 * @hooked woocommerce_output_all_notices - 10
												 * @hooked woocommerce_result_count - 20
												 * @hooked woocommerce_catalog_ordering - 30
												 */
												do_action('woocommerce_before_shop_loop');
												?>
											</div>
										</div>

									</div>
									<div class="col-xl-4 col-lg-5">
										<div
											class="tp-shop-grid-sidebar-right d-flex justify-content-start justify-content-lg-end mb-20">
											<div class="tp-course-grid-select tp-course-grid-sidebar-select">
												<?php woocommerce_catalog_ordering(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="tp-shop-items-wrapper tp-shop-item-primary">
								<div class="tab-content" id="productTabContent">
									<div class="tab-pane fade <?php echo esc_attr($tab_active);
									echo esc_attr($grid_active); ?>" id="grid-tab-pane" role="tabpanel" aria-labelledby="grid-tab"
										tabindex="0">
										<?php
										print '<div class="row row-cols-xl-' . esc_attr($product_col) . ' row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1">';
										woocommerce_product_loop_start();
										if (wc_get_loop_prop('total')) {
											while (have_posts()) {
												the_post(); ?>

												<?php

												print '<div class="tp-product-grid-item-wrapper">';

												/**
												 * Hook: woocommerce_shop_loop.
												 */
												do_action('woocommerce_shop_loop');

												wc_get_template_part('content', 'product');
												print '</div>';
											}
										}
										woocommerce_product_loop_end();
										print '</div>';
										?>
									</div>

									<div class="tab-pane fade <?php echo esc_attr($list_active); ?>" id="list-tab-pane"
										role="tabpanel" aria-labelledby="list-tab" tabindex="0">
										<div class="tp-shop-list-wrapper tp-shop-item-primary mb-70">
											<div class="row">
												<?php
												if (wc_get_loop_prop('total')) {
													while (have_posts()) {
														the_post(); ?>

														<?php

														print '<div class="col-lg-12">';

														/**
														 * Hook: woocommerce_shop_loop.
														 */
														do_action('woocommerce_shop_loop');

														wc_get_template_part('content', 'product-list');
														print '</div>';
													}
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="tp-event-inner-pagination">
									<?php do_action('woocommerce_after_shop_loop'); ?>
								</div>
							</div>

						</div>
					</div>
					<!-- shop main area end -->
				</div>
			</div>

		<?php else: ?>

			<div class="edcare-no-product-found mt-20">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 text-center">
							<div class="edcare-woo-alert error">
								<?php do_action('woocommerce_no_products_found'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>
	</div>


	<?php
	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action('woocommerce_after_main_content');

	/**
	 * Hook: woocommerce_sidebar.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	do_action('woocommerce_sidebar');
	?>
</div>


<?php

get_footer('shop');
