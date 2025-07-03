<?php
/**
 * Display loop thumbnail
 *
 * @package Tutor\Templates
 * @subpackage CourseLoopPart
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

global $post, $authordata;
$tutor_course_img = get_tutor_course_thumbnail_src();

$profile_url       = tutor_utils()->profile_url( $authordata->ID, true );
$course_categories = get_tutor_course_categories();

$course_id      = get_the_ID();
$is_wish_listed = tutor_utils()->is_wishlisted( $course_id );

$login_url_attr = '';
$action_class   = '';

if ( is_user_logged_in() ) {
	$action_class = apply_filters( 'tutor_wishlist_btn_class', 'tutor-course-wishlist-btn' );
} else {
	$action_class = apply_filters( 'tutor_popup_login_class', 'tutor-open-login-modal' );

	if ( ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ) {
		$login_url_attr = 'data-login_url="' . esc_url( wp_login_url() ) . '"';
	}
}

?>
<div class="tp-course-teacher mb-15">
	<span>
		<a href="<?php echo esc_url( $profile_url ); ?>" class="d-flex align-items-center gap-2">
			<?php
				echo wp_kses(
					tutor_utils()->get_tutor_avatar( $post->post_author ),
					tutor_utils()->allowed_avatar_tags()
				);
			?>

		<?php echo esc_html( get_the_author() );?></a>
	</span>

	<div class="edcare-course-card-header-right d-flex align-items-center gap-2">
		<?php if(class_exists( 'WooCommerce' )) : if(!empty(edcare_lms_sale_percentage())) : ?>
		<span class="discount"><?php echo edcare_kses(edcare_lms_sale_percentage()); ?></span>
		<?php endif; endif; ?>

		<a href="javascript:void(0);" <?php if(!empty($login_url_attr)){echo esc_attr($login_url_attr);}; ?> class="save-bookmark-btn edcare-save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary <?php echo esc_attr($action_class); ?>" data-course-id="<?php echo esc_attr( $course_id ); ?>">

		<?php if($is_wish_listed) : ?>
			<i class="tutor-icon-bookmark-bold"></i>
		<?php else : ?>
			<i class="tutor-icon-bookmark-line"></i>
		<?php endif; ?>
		</a>
	</div>

</div>

<div class="tp-course-thumb sidebar">
	<a href="<?php the_permalink(); ?>">
		<img class="course-lightblue" src="<?php echo esc_url( $tutor_course_img ); ?>" alt="<?php the_title(); ?>" loading="lazy">
	</a>
	<?php do_action( 'tutor_after_course_loop_thumbnail_link', get_the_ID() ); ?>
</div>