<?php
/**
 * A single course loop rating
 *
 * @package Tutor\Templates
 * @subpackage CourseLoopPart
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

if (!defined('ABSPATH')) {
	exit;
}

$class = isset($class) ? ' ' . $class : ' tutor-mb-8';
$show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
$course_rating = tutor_utils()->get_course_rating();
$price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";
?>

<div class="tp-course-rating d-flex align-items-end justify-content-between">
	<?php if ($show_course_ratings): ?>
		<div class="tp-course-rating-star">
			<p>
				<?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>
				<span>
					/<?php echo esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0); ?></span>
			</p>
			<div class="tp-course-rating-icon">
				<?php
				$course_rating = tutor_utils()->get_course_rating();
				tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
				?>
			</div>
		</div>
	<?php endif; ?>
	<div class="tp-course-pricing">
		<?php echo edcare_kses($price); ?>
	</div>
</div>
<?php do_action('tutor_after_course_loop_rating', get_the_ID()); ?>