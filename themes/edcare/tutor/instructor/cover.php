<?php
/**
 * Instructor List Item
 *
 * @package Tutor\Templates
 * @subpackage Instructor
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.0.2
 */

$instructor = isset( $instructor ) ? $instructor : array();
?>
<div class="tutor-instructor-list-item tutor-instructor-layout-cover tutor-card">
	<div class="tutor-instructor-cover tutor-ratio tutor-ratio-16x9">
		<img class="tutor-instructor-cover-photo" src="<?php echo esc_url( tutor_utils()->get_cover_photo_url( $instructor->ID ) ); ?>" alt="<?php esc_attr_e( 'Instructor Cover Photo', 'edcare' ); ?>" loading="lazy">
	</div>

	<div class="tutor-card-body">
		<?php
		echo wp_kses(
			tutor_utils()->get_tutor_avatar( $instructor->ID, 'xl' ),
			tutor_utils()->allowed_avatar_tags()
		);
		?>
		
		<div class="tutor-ratings tutor-ratings-lg tutor-mt-20">
			<?php tutor_utils()->star_rating_generator( $instructor->ratings->rating_avg ); ?>
			<span class="tutor-ratings-average"><?php echo esc_html( $instructor->ratings->rating_avg ); ?></span>
			<span class="tutor-ratings-count">(<?php echo esc_html( $instructor->ratings->rating_count ); ?>)</span>
		</div>

		<h4 class="tutor-instructor-title tutor-fs-4 tutor-fw-medium tutor-color-black tutor-mt-12 tutor-mb-8">
			<?php echo esc_html( $instructor->display_name ); ?>
		</h4>

		<div class="tutor-instructor-courses">
			<span class="tutor-fw-medium tutor-color-black"><?php echo esc_html( $instructor->course_count ); ?></span>
			<span class="tutor-color-muted"><?php $instructor->course_count > 1 ? esc_html_e( 'Courses', 'edcare' ) : esc_html_e( 'Course', 'edcare' ); ?></span>
		</div>

		<a href="<?php echo esc_url( tutor_utils()->profile_url( $instructor->ID, true ) ); ?>" class="tutor-stretched-link">
			<span class="tutor-d-none"><?php esc_html_e( 'Details', 'edcare' ); ?></span>
		</a>
	</div>
</div>
