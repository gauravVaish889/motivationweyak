<?php
/**
 * Reviews received
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

if (!tutor_utils()->is_instructor(0, true)) {
	include __DIR__ . '/reviews/given-reviews.php';
	return;
}

use TUTOR\Input;

// Pagination Variable.
$per_page = tutor_utils()->get_option('pagination_per_page', 20);
$current_page = max(1, Input::get('current_page', 1, Input::TYPE_INT));
$offset = ($current_page - 1) * $per_page;

$reviews = tutor_utils()->get_reviews_by_instructor(get_current_user_id(), $offset, $per_page);
$given_count = tutor_utils()->get_reviews_by_user(get_current_user_id(), 0, 0, true)->count;

$edcare_review_count = $reviews->count;
?>

<div class="tp-dashboard-tab mb-30">
	<h2 class="tp-dashboard-tab-title"><?php esc_html_e('Reviews', 'edcare'); ?></h2>
	<?php if (current_user_can(tutor()->instructor_role)): ?>
		<div class="tp-dashboard-tab-list">
			<ul>
				<li>
					<a class="is-active"
						href="<?php echo esc_url(tutor_utils()->get_tutor_dashboard_page_permalink('reviews')); ?>">
						<?php esc_html_e('Received (', 'edcare'); ?> 	<?php echo esc_html($edcare_review_count); ?>
						<?php esc_html_e(')', 'edcare'); ?>
					</a>
				</li>
				<?php if ($given_count): ?>
					<li>
						<a
							href="<?php echo esc_url(tutor_utils()->get_tutor_dashboard_page_permalink('reviews/given-reviews')); ?>">
							<?php esc_html_e('Given (', 'edcare'); ?>		<?php echo esc_html($given_count); ?>
							<?php esc_html_e(')', 'edcare'); ?>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>

<?php if ($edcare_review_count): ?>
	<div class="tpd-table mb-25">
		<ul>
			<li class="tpd-table-head">
				<div class="tpd-table-row">
					<div class="tpd-reviews-student">
						<h4 class="tpd-table-title"><?php esc_html_e('Student', 'edcare'); ?></h4>
					</div>
					<div class="tpd-reviews-date">
						<h4 class="tpd-table-title"><?php esc_html_e('Date', 'edcare'); ?></h4>
					</div>
					<div class="tpd-reviews-feedback">
						<h4 class="tpd-table-title"><?php esc_html_e('Feedback', 'edcare'); ?></h4>
					</div>
				</div>
			</li>
			<?php foreach ($reviews->results as $review): ?>
				<?php
				$user_data = get_userdata($review->user_id);
				$student_name = $user_data->display_name;
				?>
				<li>
					<div class="tpd-table-row">
						<div class="tpd-reviews-student">
							<div class="tpd-reviews-profile d-flex align-items-center">
								<div class="tpd-reviews-thumb">
									<?php echo wp_kses(tutor_utils()->get_tutor_avatar($review->user_id), tutor_utils()->allowed_avatar_tags()); ?>
								</div>
								<h4 class="tpd-reviews-thumb-title"><?php echo esc_html($student_name); ?></h4>
							</div>
						</div>
						<div class="tpd-reviews-date">
							<span><?php echo esc_html(tutor_i18n_get_formated_date($review->comment_date, 'F j, Y')); ?></span>
							<p><?php echo esc_html(tutor_i18n_get_formated_date($review->comment_date, 'H:s A')); ?></p>
						</div>
						<div class="tpd-reviews-feedback">
							<div class="tp-instructor-rating mb-1">
								<?php tutor_utils()->star_rating_generator_v2($review->rating, null, true); ?>
							</div>
							<p><?php echo wp_kses_post(htmlspecialchars(stripslashes($review->comment_content))); ?></p>
							<div class="tpd-course-wrap">
								<span class="tpd-course-name d-block"><?php esc_html_e('Course Title:', 'edcare'); ?></span>
								<span
									class="tpd-course-title"><?php echo esc_html(get_the_title($review->comment_post_ID)); ?></span>
							</div>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php else: ?>
	<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
<?php endif; ?>

<?php
if ($edcare_review_count > $per_page) {
	$pagination_data = array(
		'total_items' => $edcare_review_count,
		'per_page' => $per_page,
		'paged' => $current_page,
	);

	tutor_load_template_from_custom_path(get_template_directory() . '/tutor/dashboard/elements/pagination.php', $pagination_data);
}
?>