<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.5.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

$product_single_style_from_page =  function_exists( 'tpmeta_field' ) ? tpmeta_field( 'edcare_product_single_layout' ) : '';
$product_single_style_from_customizer =  get_theme_mod('edcare_shop_single_details_style');

$single_style = !empty($product_single_style_from_page) ? $product_single_style_from_page : $product_single_style_from_customizer;



if ( $attachment_ids && $product->get_image_id() ) :
	$item = count($attachment_ids);
?>

	<?php if($item == 1) : ?>
	<div class="tp-product-details-nav-main-thumb tp-woo-single-image">
		<?php
			foreach ( $attachment_ids as $key => $attachment_id ) {
				echo  wc_get_gallery_image_html( $attachment_id );
			}
		?>
	</div>
	<?php elseif($single_style == 'style_grid') : ?>
		<?php foreach($attachment_ids as $key => $attachment_id) : ?>
		<div class="tp-shop-details-left-thumb mb-5">
			<?php echo  wc_get_gallery_image_html( $attachment_id ); ?>
		</div>
		<?php endforeach; ?>

	<?php else :
			foreach ( $attachment_ids as $key => $attachment_id ) {
				echo  wc_get_gallery_image_html( $attachment_id );
			}
		endif;
	endif;
	?>
