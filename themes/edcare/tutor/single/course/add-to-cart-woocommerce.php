<?php
/**
 * Tutor add to cart for WC product that will be visible on the course details page
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

$product_id = tutor_utils()->get_course_product_id();
$product    = wc_get_product( $product_id );

$is_logged_in             = is_user_logged_in();
$enable_guest_course_cart = tutor_utils()->get_option( 'enable_guest_course_cart' );
$required_loggedin_class  = '';
if ( ! $is_logged_in && ! $enable_guest_course_cart ) {
	$required_loggedin_class = apply_filters( 'tutor_enroll_required_login_class', 'tutor-open-login-modal' );
}

if ( $product ) {
	if ( tutor_utils()->is_course_added_to_cart( $product_id, true ) ) {
		?>
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="edcare-course-btn w-100 tutor-woocommerce-view-cart">
				<?php esc_html_e( 'View Cart', 'edcare' ); ?>
			</a>
		<?php
	} else {
		$regular_price = wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) );
		$sale_price    = wc_get_price_to_display( $product, array( 'price' => $product->get_sale_price() ) );
		$tax_display   = get_option( 'woocommerce_tax_display_shop' );
		?>
		<div>
			<div class="tp-course-details2-widget-price">
					<?php ob_start(); ?>
					<div class="d-inline-block">
						<span class="">
							<?php echo wc_price( $sale_price ? $sale_price : $regular_price ); //phpcs:ignore?>
						</span>
						<?php if ( $regular_price && $sale_price && $sale_price !== $regular_price ) : ?>
							<del class="">
							<?php echo wc_price( $regular_price ); //phpcs:ignore?>
							</del>
						<?php endif; ?>
					</div>

					<?php if(class_exists( 'WooCommerce' )) : if(!empty(edcare_lms_sale_percentage())) : ?>
					<span class="edcare-course-single-widget-discount"><?php echo edcare_kses(edcare_lms_sale_percentage()); ?></span>
					<?php endif; endif; ?>


			</div>
			<div class="tutor-color-muted">
				<?php
				if ( 'incl' === $tax_display ) {
					echo wp_kses(
						$product->get_price_suffix(),
						array( 'small' => array( 'class' => true ) )
					);
				}
				?>
			</div>
			<?php
				/**
				 * Added to show info about price.
				 *
				 * @since 2.2.0
				 */
				do_action( 'tutor_after_course_details_wc_cart_price', $product, get_the_ID() );
			?>
            <?php echo apply_filters( 'tutor_course_details_wc_add_to_cart_price', ob_get_clean(), $product ); //phpcs:ignore ?>
		</div>
		<form class="cart" action="<?php echo esc_url( apply_filters( 'tutor_course_add_to_cart_form_action', get_permalink( get_the_ID() ) ) ); ?>" method="post" enctype="multipart/form-data">
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"  class="edcare-course-btn w-100 tutor-add-to-cart-button <?php echo esc_attr( $required_loggedin_class ); ?>">
				<span class="btn-icon tutor-icon-cart-filled"></span>
				<span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
			</button>
		</form>

		<a class="edcare-course-btn edcare-course-btn-outline w-100 mt-5 <?php echo esc_attr( $required_loggedin_class ); ?>" href="<?php echo wc_get_checkout_url() .'?add-to-cart='.$product->get_id(); ?>"><?php esc_html_e('Buy Course', 'edcare'); ?></a>

		<?php
	}
} else {
	?>
	<p class="tutor-alert-warning">
		<?php esc_html_e( 'Please make sure that your product exists and valid for this course', 'edcare' ); ?>
	</p>
	<?php
}
