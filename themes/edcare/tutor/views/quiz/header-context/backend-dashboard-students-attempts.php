<?php
/**
 * Student attempt page
 *
 * @package Tutor\Views
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.0.0
 */

if ( empty( $back_url ) ) {
	return;
}
?>

<header class="tutor-wp-dashboard-header tutor-justify-between tutor-align-center tutor-px-32 tutor-py-20 tutor-mb-24 tutor-pt-16 tutor-pb-16">

	<div class="tpd-course-wrap">
		<?php if ( ! empty( $back_url ) ) : ?>
		<a href="<?php echo esc_url( $back_url ); ?>">
			<span>
				<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M11 6H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					<path d="M6 11L1 6L6 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
			</span> 
			<?php esc_html_e( 'Back', 'edcare' ); ?>
		</a>
		<?php endif; ?>

		<span class="tpd-course-name"><?php esc_html_e( 'Course:', 'edcare' ); ?></span>
		<span class="tpd-course-title"><?php echo esc_html( $course_title ); ?></span>   
	</div>

	<h2 class="tp-dashboard-title"><?php echo esc_html( $quiz_title ); ?></h2>
</header>