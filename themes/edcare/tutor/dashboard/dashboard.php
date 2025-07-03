<?php
/**
 * Frontend Dashboard Template
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

use Tutor\Models\CourseModel;
use Tutor\Models\WithdrawModel;

if (tutor_utils()->get_option('enable_profile_completion')) {
	$profile_completion = tutor_utils()->user_profile_completion();
	$is_instructor = tutor_utils()->is_instructor(null, true);
	$total_count = count($profile_completion);
	$incomplete_count = count(
		array_filter(
			$profile_completion,
			function ($data) {
				return !$data['is_set'];
			}
		)
	);
	$complete_count = $total_count - $incomplete_count;

	if ($is_instructor) {
		if (isset($total_count) && isset($incomplete_count) && $incomplete_count <= $total_count) {
			?>
			<div class="tutor-profile-completion tutor-card tutor-px-32 tutor-py-24 tutor-mb-40">
				<div class="tutor-row tutor-gx-0">
					<div
						class="tutor-col-lg-7 <?php echo tutor_utils()->is_instructor() ? 'tutor-profile-completion-content-admin' : ''; ?>">
						<div class="tutor-fs-5 tutor-fw-medium tutor-color-black">
							<?php esc_html_e('Complete Your Profile', 'edcare'); ?>
						</div>

						<div class="tutor-row tutor-align-center tutor-mt-12">
							<div class="tutor-col">
								<div class="tutor-row tutor-gx-1">
									<?php for ($i = 1; $i <= $total_count; $i++): ?>
										<div class="tutor-col">
											<div class="tutor-progress-bar"
												style="--tutor-progress-value: <?php echo esc_attr($i > $complete_count ? 0 : 100); ?>%; height: 8px;">
												<div class="tutor-progress-value" area-hidden="true"></div>
											</div>
										</div>
									<?php endfor; ?>
								</div>
							</div>

							<div class="tutor-col-auto">
								<span class="tutor-round-box tutor-my-n20">
									<i class="tutor-icon-trophy" area-hidden="true"></i>
								</span>
							</div>
						</div>

						<div class="tutor-fs-6 tutor-mt-20">
							<?php
							$profile_complete_text = __('Please complete profile', 'edcare');
							if ($complete_count > ($total_count / 2) && $complete_count < $total_count) {
								$profile_complete_text = __('You are almost done', 'edcare');
							} elseif ($complete_count === $total_count) {
								$profile_complete_text = __('Thanks for completing your profile', 'edcare');
							}
							$profile_complete_status = $profile_complete_text;
							?>

							<span class="tutor-color-muted"><?php echo esc_html($profile_complete_status); ?>:</span>
							<span><?php echo esc_html($complete_count . '/' . $total_count); ?></span>
						</div>
					</div>

					<div class="tutor-col-lg-1 tutor-text-center tutor-my-24 tutor-my-lg-n24">
						<div class="tutor-vr tutor-d-none tutor-d-lg-inline-flex"></div>
						<div class="tutor-hr tutor-d-flex tutor-d-lg-none"></div>
					</div>

					<div class="tutor-col-lg-4 tutor-d-flex tutor-flex-column tutor-justify-center">
						<?php
						$i = 0;
						$monetize_by = tutils()->get_option('monetize_by');
						foreach ($profile_completion as $key => $data) {
							if ('_tutor_withdraw_method_data' === $key) {
								if ('free' === $monetize_by) {
									continue;
								}
							}
							$is_set = $data['is_set']; // Whether the step is done or not.
							?>
							<div
								class="tutor-d-flex tutor-align-center<?php echo esc_attr($i < (count($profile_completion) - 1) ? ' tutor-mb-8' : ''); ?>">
								<?php if ($is_set): ?>
									<span class="tutor-icon-circle-mark-line tutor-color-success tutor-mr-8"></span>
								<?php else: ?>
									<span class="tutor-icon-circle-times-line tutor-color-warning tutor-mr-8"></span>
								<?php endif; ?>

								<span class="<?php echo esc_attr($is_set ? 'tutor-color-secondary' : 'tutor-color-muted'); ?>">
									<a class="tutor-btn tutor-btn-ghost tutor-has-underline"
										href="<?php echo esc_url($data['url']); ?>">
										<?php echo esc_html($data['text']); ?>
									</a>
								</span>
							</div>
							<?php
							$i++;
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
	} else {
		if (!$profile_completion['_tutor_profile_photo']['is_set']) {
			$alert_message = sprintf(
				'<div class="tutor-alert tutor-primary tutor-mb-20">
					<div class="tutor-alert-text">
						<span class="tutor-alert-icon tutor-fs-4 tutor-icon-circle-info tutor-mr-12"></span>
						<span>
							%s
						</span>
					</div>
					<div class="alert-btn-group">
						<a href="%s" class="tutor-btn tutor-btn-sm">' . __('Click Here', 'edcare') . '</a>
					</div>
				</div>',
				$profile_completion['_tutor_profile_photo']['text'],
				tutor_utils()->tutor_dashboard_url('settings')
			);

			echo edcare_kses($alert_message); //phpcs:ignore
		}
	}
}
?>

<div class="tp-dashboard-title"><?php esc_html_e('Dashboard', 'edcare'); ?></div>
<div class="tutor-dashboard-content-inner">
	<?php
	$user_id = get_current_user_id();
	$enrolled_course = tutor_utils()->get_enrolled_courses_by_user();
	$completed_courses = tutor_utils()->get_completed_courses_ids_by_user();
	$total_students = tutor_utils()->get_total_students_by_instructor($user_id);
	$my_courses = CourseModel::get_courses_by_instructor($user_id, CourseModel::STATUS_PUBLISH);
	$earning_sum = WithdrawModel::get_withdraw_summary($user_id);
	$active_courses = tutor_utils()->get_active_courses_by_user($user_id);

	$enrolled_course_count = $enrolled_course ? $enrolled_course->post_count : 0;
	$completed_course_count = count($completed_courses);
	$active_course_count = is_object($active_courses) && $active_courses->have_posts() ? $active_courses->post_count : 0;

	$status_translations = array(
		'publish' => __('Published', 'edcare'),
		'pending' => __('Pending', 'edcare'),
		'trash' => __('Trash', 'edcare'),
	);

	?>
	<div class="row">

		<div class="col-lg-4">
			<div class="tp-fact-item d-flex align-items-center justify-content-between">
				<div class="tp-fact-content">
					<h4 class="tp-fact-count"><?php echo esc_html($active_course_count); ?></h4>
					<span><?php esc_html_e('Active Courses', 'edcare'); ?></span>
				</div>
				<div class="tp-fact-icon">
					<span>
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/dashboard/icon/fact/teacher.svg"
							alt="<?php echo esc_attr__('fact-icon', 'edcare'); ?>">
					</span>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="tp-fact-item d-flex align-items-center justify-content-between">
				<div class="tp-fact-content">
					<h4 class="tp-fact-count"><?php echo esc_html($enrolled_course_count); ?></h4>
					<span><?php esc_html_e('Enrolled Courses', 'edcare'); ?></span>
				</div>
				<div class="tp-fact-icon">
					<span class="common-pale-yellow">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/dashboard/icon/fact/enroll-icon.svg"
							alt="<?php echo esc_attr__('fact-icon', 'edcare'); ?>">
					</span>
				</div>
			</div>
		</div>


		<div class="col-lg-4">
			<div class="tp-fact-item d-flex align-items-center justify-content-between">
				<div class="tp-fact-content">
					<h4 class="tp-fact-count"><?php echo esc_html($completed_course_count); ?></h4>
					<span><?php esc_html_e('Completed Courses', 'edcare'); ?></span>
				</div>
				<div class="tp-fact-icon">
					<span class="common-pale-pacific">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/dashboard/icon/fact/cup.svg"
							alt="<?php echo esc_attr__('fact-icon', 'edcare'); ?>">
					</span>
				</div>
			</div>
		</div>

		<?php
		if (current_user_can(tutor()->instructor_role)):
			?>

			<div class="col-lg-4">
				<div class="tp-fact-item d-flex align-items-center justify-content-between">
					<div class="tp-fact-content">
						<h4 class="tp-fact-count"><?php echo esc_html($total_students); ?></h4>
						<span><?php esc_html_e('Total Students', 'edcare'); ?></span>
					</div>
					<div class="tp-fact-icon">
						<span class="common-pale-green">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/dashboard/icon/fact/students.svg"
								alt="<?php echo esc_attr__('fact-icon', 'edcare'); ?>">
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="tp-fact-item d-flex align-items-center justify-content-between">
					<div class="tp-fact-content">
						<h4 class="tp-fact-count"><?php echo esc_html(count($my_courses)); ?></h4>
						<span><?php esc_html_e('Total Courses', 'edcare'); ?></span>
					</div>
					<div class="tp-fact-icon">
						<span class="common-pale-blue">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/dashboard/icon/fact/course-total.svg"
								alt="<?php echo esc_attr__('fact-icon', 'edcare'); ?>">
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="tp-fact-item d-flex align-items-center justify-content-between">
					<div class="tp-fact-content">
						<h4 class="tp-fact-count">
							<?php echo edcare_kses(tutor_utils()->tutor_price($earning_sum->total_income)); ?>
						</h4>
						<span><?php esc_html_e('Total Earnings', 'edcare'); ?></span>
					</div>
					<div class="tp-fact-icon">
						<span class="common-pale-purple">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/dashboard/icon/fact/card-pos.svg"
								alt="<?php echo esc_attr__('fact-icon', 'edcare'); ?>">
						</span>
					</div>
				</div>
			</div>

			<?php
		endif;
		?>
	</div>
</div>

<?php
/**
 * Active users in progress courses
 */
$placeholder_img = tutor()->url . 'assets/images/placeholder.svg';
$courses_in_progress = tutor_utils()->get_active_courses_by_user(get_current_user_id());
?>

<?php if ($courses_in_progress && $courses_in_progress->have_posts()): ?>
	<div class="tp-progress-wrapper">
		<h2 class="tp-dashboard-title">
			<?php esc_html_e('In Progress Courses', 'edcare'); ?>
		</h2>
		<?php
		while ($courses_in_progress->have_posts()):
			$courses_in_progress->the_post();
			$tutor_course_img = get_tutor_course_thumbnail_src();
			$course_rating = tutor_utils()->get_course_rating(get_the_ID());
			$course_progress = tutor_utils()->get_course_completed_percent(get_the_ID(), 0, true);
			$completed_number = 0 === (int) $course_progress['completed_count'] ? 1 : (int) $course_progress['completed_count'];
			?>
			<div class="tp-progress-item d-flex align-items-center p-relative">
				<div class="tp-progress-thumb">
					<img src="<?php echo empty($tutor_course_img) ? esc_url($placeholder_img) : esc_url($tutor_course_img); ?>"
						alt="<?php the_title(); ?>" loading="lazy">
				</div>
				<div class="tp-progress-content">
					<?php if ($course_rating): ?>
						<div class="tp-progress-rate d-flex align-items-center">
							<div class="tp-progress-rating">
								<?php tutor_utils()->star_rating_generator($course_rating->rating_avg); ?>
							</div>
							<span><?php echo esc_html(number_format($course_rating->rating_avg, 2)); ?></span>
						</div>
					<?php endif; ?>
					<h4 class="tp-progress-title"><?php the_title(); ?></h4>

					<p><?php esc_html_e('Completed Lessons:', 'edcare'); ?>
						<span>
							<?php echo esc_html($course_progress['completed_count']); ?>
							<?php esc_html_e('of', 'edcare'); ?>
							<?php echo esc_html($course_progress['total_count']); ?>
							<?php echo esc_html(_n('lesson', 'lessons', $completed_number, 'edcare')); ?>
						</span>
					</p>

					<div class="tp-progress-bar d-flex align-items-center">
						<div class="progress" role="progressbar" aria-label="Basic example"
							aria-valuenow="<?php echo esc_attr($course_progress['completed_percent']); ?>" aria-valuemin="0"
							aria-valuemax="100">
							<div class="progress-bar"
								data-width="<?php echo esc_attr($course_progress['completed_percent']); ?>%"></div>
						</div>
						<span><?php echo esc_html($course_progress['completed_percent']); ?><?php echo esc_html__('% Complete', 'edcare'); ?></span>
					</div>
					<a class="tutor-stretched-link" href="<?php the_permalink(); ?>"></a>
				</div>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php endif; ?>

<?php
$instructor_course = tutor_utils()->get_courses_for_instructors(get_current_user_id());

if (count($instructor_course)) {
	$course_badges = array(
		'publish' => 'success',
		'pending' => 'warning',
		'trash' => 'danger',
	);

	?>
	<div class="tp-dashboard-course-wrapper">
		<div class="row">
			<div class="col-6">
				<div class="tp-dashboard-section">
					<h2 class="tp-dashboard-title"><?php esc_html_e('My Courses', 'edcare'); ?></h2>
				</div>
			</div>
			<div class="col-6">
				<div class="tp-dashboard-course-details text-sm-end">
					<a href="<?php echo esc_url(tutor_utils()->tutor_dashboard_url('my-courses')); ?>"><?php esc_html_e('View All', 'edcare'); ?>
						<i class="fa-regular fa-angle-right"></i></a>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-12">
				<div class="tp-dashboard-course-list">
					<ul>
						<li class="active">
							<div class="tp-dashboard-course-item">
								<div class="tp-dashboard-course-name">
									<h5 class="tp-dashboard-course-name-title">
										<?php esc_html_e('Course Name', 'edcare'); ?>
									</h5>
								</div>
								<div class="tp-dashboard-course-enroll">
									<span><?php esc_html_e('Enrolled', 'edcare'); ?></span>
								</div>
								<div class="tp-dashboard-course-rating">
									<span><?php esc_html_e('Rating', 'edcare'); ?></span>
								</div>
							</div>
						</li>

						<?php if (is_array($instructor_course) && count($instructor_course)): ?>

							<?php
							foreach ($instructor_course as $course):
								$enrolled = tutor_utils()->count_enrolled_users_by_course($course->ID);
								$course_status = isset($status_translations[$course->post_status]) ? $status_translations[$course->post_status] : esc_html($course->post_status); //phpcs:ignore
								$course_rating = tutor_utils()->get_course_rating($course->ID);
								$course_badge = isset($course_badges[$course->post_status]) ? $course_badges[$course->post_status] : 'dark';
								?>

								<li>
									<div class="tp-dashboard-course-item">
										<div class="tp-dashboard-course-name">
											<h5 class="tp-dashboard-course-name-title">
												<a href="<?php echo esc_url(get_the_permalink($course->ID)); ?>" target="_blank">
													<?php echo esc_html($course->post_title); ?>
												</a>
											</h5>
										</div>
										<div class="tp-dashboard-course-enroll">
											<span><?php echo esc_html($enrolled); ?></span>
										</div>
										<div class="tp-dashboard-course-rating">
											<?php tutor_utils()->star_rating_generator_v2($course_rating->rating_avg, null, true); ?>
										</div>
									</div>
								</li>
							<?php endforeach; ?>

						<?php else: ?>
							<li>
								<h5 class="tp-dashboard-course-name-title">
									<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
								</h5>
							</li>

						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>


	</div>
	<?php
}
?>