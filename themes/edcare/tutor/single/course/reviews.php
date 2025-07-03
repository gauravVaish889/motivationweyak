<?php
/**
 * Template for displaying course reviews
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

use TUTOR\Input;

$disable = !get_tutor_option('enable_course_review');
if ($disable) {
	return;
}

global $is_enrolled, $course_rating;

$per_page = tutor_utils()->get_option('pagination_per_page', 10);
$current_page = max(1, Input::post('current_page', 0, Input::TYPE_INT));
$offset = ($current_page - 1) * $per_page;

$current_user_id = get_current_user_id();
$course_id = Input::post('course_id', get_the_ID(), Input::TYPE_INT);
$reviews = tutor_utils()->get_course_reviews($course_id, $offset, $per_page, false, array('approved'), $current_user_id);
$reviews_total = tutor_utils()->get_course_reviews($course_id, null, null, true, array('approved'), $current_user_id);
$my_rating = tutor_utils()->get_reviews_by_user(0, 0, 150, false, $course_id, array('approved', 'hold'));

if (Input::has('course_id')) {
	// It's load more.
	tutor_load_template('single.course.reviews-loop', array('reviews' => $reviews));
	return;
}

/**
 * Global $is_enrolled, $course_rating get null for third party
 * who only include this file without single-course.php file.
 * 
 * @since 2.1.9
 */
if (is_null($is_enrolled)) {
	$is_enrolled = tutor_utils()->is_enrolled($course_id, $current_user_id);
}

if (is_null($course_rating)) {
	$course_rating = tutor_utils()->get_course_rating($course_id);
}

do_action('tutor_course/single/enrolled/before/reviews');
?>

<div class="tutor-pagination-wrapper-replaceable">
	<h3 class="tp-course-details2-main-title">
		<?php
		$review_title = apply_filters('tutor_course_reviews_section_title', __('Ratings & Reviews', 'edcare'));
		echo esc_html($review_title);
		?>
	</h3>

	<?php if (!is_array($reviews) || !count($reviews)): ?>
		<?php tutor_utils()->tutor_empty_state(__('No Review Yet', 'edcare')); ?>
	<?php else: ?>
		<div class="">
			<div class="tp-course-details2-review-rating">
				<div class="row gx-2">
					<div class="col-md-4">
						<div class="tp-course-details2-review-rating-info text-center">
							<h5><?php echo esc_html(number_format($course_rating->rating_avg, 1)); ?></h5>
							<div class="rating-icons mb-5">
								<?php tutor_utils()->star_rating_generator_v2($course_rating->rating_avg, null, false, '', 'lg'); ?>
							</div>
							<p>
								<?php esc_html_e('Total ', 'edcare'); ?>
								<?php echo esc_html($reviews_total); ?>
								<?php echo esc_html(_n(' Rating', ' Ratings', count($reviews), 'edcare')); ?>
							</p>
						</div>
					</div>
					<div class="col-md-8">
						<div class="tp-course-details2-review-details">
							<div class="tp-course-details2-review-content">
								<?php foreach ($course_rating->count_by_value as $key => $value):
									$rating_count_percent = ($value > 0) ? ($value * 100) / $course_rating->rating_count : 0;
									?>

									<div
										class="tp-course-details2-review-item d-flex align-items-center justify-content-between">
										<div class="tp-course-details2-review-text">
											<span><?php printf("%d %s", $key, esc_html__('star', 'edcare')); ?> </span>
										</div>
										<div class="tp-course-details2-review-progress">
											<div class="single-progress"
												data-width="<?php echo esc_attr($rating_count_percent); ?>%"></div>
										</div>
										<div class="tp-course-details2-review-percent">
											<h5><?php printf("%d %%\n", $rating_count_percent); ?></h5>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>



			<h4 class="tp-course-details2-main-title"><?php esc_html_e('Featured Review', 'edcare'); ?></h4>

			<div class="tp-course-details2-review-reply-wrap tutor-pagination-content-appendable">
				<?php tutor_load_template('single.course.reviews-loop', array('reviews' => $reviews)); ?>
			</div>
		</div>





	<?php endif; ?>

	<div class="tutor-row tutor-mt-40 tutor-mb-20">
		<div class="tutor-col">
			<?php if ($is_enrolled): ?>
				<button class="edcare-course-btn write-course-review-link-btn">
					<i class="tutor-icon-star-line"></i>
					<?php
					$is_new = !$my_rating || empty($my_rating->rating) || empty($my_rating->comment_content);
					$is_new ? esc_html_e('Write a review', 'edcare') : esc_html_e('Edit review', 'edcare');
					?>
				</button>
			<?php endif; ?>
		</div>

		<div class="tutor-col-auto">
			<?php
			$pagination_data = array(
				'total_items' => $reviews_total,
				'per_page' => $per_page,
				'paged' => $current_page,
				'layout' => array(
					'type' => 'load_more',
					'load_more_text' => __('Load More', 'edcare'),
				),
				'ajax' => array(
					'action' => 'tutor_single_course_reviews_load_more',
					'course_id' => $course_id,
				),
			);
			$pagination_template_frontend = tutor()->path . 'templates/dashboard/elements/pagination.php';
			tutor_load_template_from_custom_path($pagination_template_frontend, $pagination_data);
			?>
		</div>
	</div>
</div>

<?php if ($is_enrolled): ?>
	<div class="tutor-course-enrolled-review-wrap tutor-pt-16">

		<div class="tutor-write-review-form display-none">
			<h4 class="tp-course-details2-main-title"><?php esc_html_e('Write a Review', 'edcare'); ?></h4>
			<span class="d-block mb-2"><?php esc_html_e('What is it like to Course?', 'edcare'); ?></span>
			<form method="post">
				<div class="tutor-star-rating-container mb-50">
					<input type="hidden" name="course_id" value="<?php echo esc_attr($course_id); ?>" />
					<input type="hidden" name="review_id"
						value="<?php echo esc_attr($my_rating ? $my_rating->comment_ID : ''); ?>" />
					<input type="hidden" name="action" value="tutor_place_rating" />
					<div class="tutor-form-group">
						<div class="tutor-ratings edcare-course-review-stars tutor-ratings-sm tutor-ratings-selectable"
							tutor-ratings-selectable>
							<?php
							tutor_utils()->star_rating_generator(tutor_utils()->get_rating_value($my_rating ? $my_rating->rating : 0));
							?>
						</div>
					</div>
					<div class="tp-contact-input-form p-relative mb-15">
						<label><?php esc_html_e('Review Content', 'edcare'); ?></label>
						<textarea name="review"
							placeholder="<?php esc_attr_e('Write a review', 'edcare'); ?>"><?php echo esc_html(stripslashes($my_rating ? $my_rating->comment_content : '')); ?></textarea>
					</div>
					<div class="tp-contact-btn">
						<button type="submit" class="tutor_submit_review_btn edcare-course-btn">
							<?php esc_html_e('Submit Review', 'edcare'); ?>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>

<?php do_action('tutor_course/single/enrolled/after/reviews'); ?>