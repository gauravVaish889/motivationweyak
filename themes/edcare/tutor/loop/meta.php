<?php
/**
 * Course meta template
 *
 * Meta template contains author avatar & categories
 *
 * @package Tutor\Templates
 * @subpackage CourseLoopPart
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.5.8
 */

global $post, $authordata;
$course_id         = $post->ID;
$profile_url       = tutor_utils()->profile_url( $authordata->ID, true );
$course_categories = get_tutor_course_categories( $course_id );

$tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
$course_students   = apply_filters( 'tutor_course_students', tutor_utils()->count_enrolled_users_by_course( $course_id ), $course_id );
$cat_color = '#17A2B8';
if(!empty($course_categories[0])){
	$cat_color = get_term_meta( $course_categories[0]->term_id, '_edcare_course_cat_color', true );
	$cat_color = ! empty( $cat_color ) ? $cat_color : '#17A2B8';
}

$total_enrolled   = (int) tutor_utils()->count_enrolled_users_by_course( $course_id );
$maximum_students = (int) tutor_utils()->get_course_settings( $course_id, 'maximum_students' );


?>
<?php if(!empty($course_categories[0])): ?>
	<div class="edcare-course-card-meta d-flex align-items-center gap-3">
		<div class="tp-course-tag mb-10">
			<span data-cat-color="<?php echo esc_attr($cat_color); ?>"><a href="<?php echo get_term_link($course_categories[0]); ?>"><?php echo esc_html($course_categories[0]->name); ?></a></span>
		</div>
		
		<?php if(0 !== $maximum_students && $total_enrolled !== $maximum_students) : 
			$total_booked     = 100 / $maximum_students * $total_enrolled;
			$b_total          = ceil( $total_booked );	
		?>
		<div class="tutor-course-booking-progress tutor-d-flex tutor-align-center mb-10">
			<div class="tutor-mr-8">
				<div class="tutor-progress-circle" style="--pro:<?php echo esc_attr($b_total); ?>%;" area-hidden="true"></div>
			</div>
			<div class="tutor-fs-7 tutor-fw-medium tutor-color-black">
				
				<?php printf("%d%%\n  Booked", $b_total); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>

<?php endif; ?>

<?php if ( tutor_utils()->get_option( 'enable_course_total_enrolled' ) || ! empty( $tutor_lesson_count ) ) : ?>

<div class="tp-course-meta">
	<?php if ( ! empty( $tutor_lesson_count ) ) : ?>
	<span>
		<span>
			<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
				<path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
			</svg>
		</span>
		<?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'edcare'), $tutor_lesson_count) ; ?>
	</span>
	<?php endif; ?>

	<?php if ( tutor_utils()->get_option( 'enable_course_total_enrolled' ) ) : ?>
	<span>
		<span>
			<svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
				<path d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
			</svg>
		</span>
		
		<?php printf(_n('%d Student', '%d Students', $course_students, 'edcare'), $course_students) ; ?>
	</span>
	<?php endif; ?>
</div>

<?php endif; ?>