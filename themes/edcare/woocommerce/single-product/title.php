<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

echo wc_get_stock_html( $product ); // WPCS: XSS ok.
$terms = get_the_terms(get_the_ID(), 'product_cat');
?>
<div class="tp-woo-single-category">
	<?php foreach ($terms as $key => $term) : 
		$count = count($terms) - 1;
		$name = ($count > $key) ? $term->name . ', ' : $term->name
	?>

	<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name ); ?></a>

	<?php endforeach; ?>
</div>

<?php 
the_title( '<h3 class="tp-product-details-title">', '</h3>' );
