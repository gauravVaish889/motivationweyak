<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

/* check if product has thumbnails */
$product_id = new WC_product($product);
$attachment_ids = $product_id->get_gallery_image_ids();

$product_single_style_from_page =  function_exists('tpmeta_field') ? tpmeta_field('edcare_product_single_layout') : '';
$product_single_style_from_customizer =  get_theme_mod('edcare_shop_single_details_style', 'style_default');

$product_single_style_condition = !empty($product_single_style_from_page) ? ($product_single_style_from_page == 'style_default' ? $product_single_style_from_customizer : $product_single_style_from_page) : $product_single_style_from_customizer;

$edcare_smooth_scroll = get_theme_mod('edcare_theme_smooth_scroll_switch', 'off');

$padding_class = $edcare_smooth_scroll == 'on' ? ' pt-100' : '';

?>
<?php if ($product_single_style_condition == 'style_grid') :  ?>

	<!-- shop Details area start -->
	<div class="tp-shop-details-area tp-shop-details-scroll-height <?php echo esc_attr($padding_class); ?>">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-xxl-8 col-xl-7">
					<div class="tp-shop-details-left-wrap p-relative">
						<?php do_action('woocommerce_before_single_product_summary'); ?>
					</div>
				</div>
				<div class="col-xxl-4 col-xl-5">
					<div class="tp-shop-details-right-wrap">
						<?php do_action('woocommerce_single_product_summary'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- shop Details area start -->

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action('woocommerce_after_single_product_summary');
	?>

<?php else : ?>

	<div class="container">
		<div class="row">
			<div class="col-xl-12">

				<div class="edcare-woocommerce-message">
					<?php
					/**
					 * Hook: woocommerce_before_single_product.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 */
					do_action('woocommerce_before_single_product');
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="tp-product-details-2-style">
		<div class="container">

			<div id="product-<?php the_ID(); ?>" <?php wc_product_class('tp-woo-single-body', $product); ?>>
				<div class="tp-product-details-top">
					<div class="row align-items-start">
						<div class="col-lg-6">
							<div class="tp-product-details-thumb-wrapper tp-tab p-relative tp-woo-single-thumb">
								<?php
								/**
								 * Hook: woocommerce_before_single_product_summary.
								 *
								 * @hooked woocommerce_show_product_sale_flash - 10
								 * @hooked woocommerce_show_product_images - 20
								 */
								do_action('woocommerce_before_single_product_summary');
								?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="tp-shop-details-right-wrap tp-woo-single-wrapper summary entry-summary tp-product-details-wrapper">
								<?php
								/**
								 * Hook: woocommerce_single_product_summary.
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50
								 * @hooked WC_Structured_Data::generate_product_data() - 60
								 */
								do_action('woocommerce_single_product_summary');
								?>
							</div>
						</div>
					</div>
				</div>

				<?php
				/**
				 * Hook: woocommerce_after_single_product_summary.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action('woocommerce_after_single_product_summary');
				?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php do_action('woocommerce_after_single_product'); ?>