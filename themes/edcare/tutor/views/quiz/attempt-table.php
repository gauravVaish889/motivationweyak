<?php
/**
 * Attempt table
 *
 * @package Tutor\Views
 * @subpackage Tutor\Quiz
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

// Data variable contains $attempt_list, $context.
extract($data); //phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$page_key = 'attempt-table';
$table_columns = include __DIR__ . '/contexts.php';
$enabled_hide_quiz_details = tutor_utils()->get_option('hide_quiz_details');

if ('course-single-previous-attempts' == $context && is_array($attempt_list) && count($attempt_list)) {
	// Provide the attempt data from the first attempt.
	// For now now attempt specific data is shown, that's why no problem if we take meta data from any attempt.
	$attempt_data = $attempt_list[0];
	include __DIR__ . '/header.php';
}
?>

<?php if (is_array($attempt_list) && count($attempt_list)): ?>

	<div class="tpd-table mb-25">
		<ul>
			<li class="tpd-table-head">
				<div class="tpd-table-row">

					<?php foreach ($table_columns as $key => $column): ?>
						<?php
						if ('details' === $key && !is_admin() && !current_user_can('tutor_instructor') && true === $enabled_hide_quiz_details) {
							continue;
						}

						$clm_name = $key == 'quiz_info' ? 'Quiz Info' : $column;


						if (!empty(explode(' ', $column)[0]) && !empty(explode(' ', $column)[1]) && ($key !== 'quiz_info')) {
							$str1 = explode(' ', $column)[0];
							$str2 = explode(' ', $column)[1];
							$clm_name = strtoupper(substr($str1, 0, 1)) . substr($str2, 0, 1);
						}



						?>
						<?php if ($key == 'quiz_info'): ?>
							<div class="tpd-quiz-info-sub">
								<h4 class="tpd-table-title" title="<?php echo esc_attr($column) ?>">
									<?php echo edcare_kses($clm_name); ?></h4>
							</div>

						<?php else: ?>
							<div class="tpd-quiz-ca-sub">
								<h4 class="tpd-table-title" title="<?php echo esc_attr($column) ?>">
									<?php echo edcare_kses($clm_name); ?></h4>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</li>
			<?php
			$attempt_ids = array_column($attempt_list, 'attempt_id');
			$answers_array = \Tutor\Models\QuizModel::get_quiz_answers_by_attempt_id($attempt_ids, true);

			foreach ($attempt_list as $attempt):

				$course_id = is_object($attempt) && property_exists($attempt, 'course_id') ? $attempt->course_id : 0;
				$earned_percentage = ($attempt->earned_marks > 0 && $attempt->total_marks > 0) ? (number_format(($attempt->earned_marks * 100) / $attempt->total_marks)) : 0;
				$answers = isset($answers_array[$attempt->attempt_id]) ? $answers_array[$attempt->attempt_id] : array();
				$attempt_info = @unserialize($attempt->attempt_info);
				$attempt_info = !is_array($attempt_info) ? array() : $attempt_info;
				$passing_grade = isset($attempt_info['passing_grade']) ? (int) $attempt_info['passing_grade'] : 0;
				$ans_array = is_array($answers) ? $answers : array();

				$has_pending = count(
					array_filter(
						$ans_array,
						function ($ans) {
							return null === $ans->is_correct;
						}
					)
				);

				$correct = 0;
				$incorrect = 0;
				$attempt_id = $attempt->attempt_id;

				if (is_array($answers) && count($answers) > 0) {
					foreach ($answers as $answer) {
						if ((bool) $answer->is_correct) {
							$correct++;
						} elseif (!(null === $answer->is_correct)) {
							$incorrect++;
						}
					}
				}
				?>
				<l <div class="tpd-table-row">

					<?php foreach ($table_columns as $key => $column):

						if ('details' === $key && !is_admin() && !current_user_can('tutor_instructor') && true === $enabled_hide_quiz_details) {
							continue;
						}
						?>

						<?php if ('checkbox' == $key): ?>
							<div class="tutor-d-flex">
								<input id="tutor-admin-list-<?php echo esc_attr($attempt->attempt_id); ?>" type="checkbox"
									class="tutor-form-check-input tutor-bulk-checkbox" name="tutor-bulk-checkbox-all"
									value="<?php echo esc_attr($attempt->attempt_id); ?>" />
							</div>
						<?php elseif ('date' == $key): ?>
							<?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($attempt->attempt_ended_at))); ?>
						<?php elseif ('quiz_info' == $key): ?>

							<div class="tpd-quiz-info-sub">
								<span
									class="tpd-common-date d-block"><?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($attempt->attempt_ended_at))); ?></span>

								<?php if (is_admin()): ?>
									<h4 class="tpd-quiz-title"><?php echo esc_html(get_the_title($attempt->quiz_id)); ?></h4>
								<?php else: ?>
									<?php echo esc_html(get_the_title($attempt->quiz_id)); ?>
									<div class="tooltip-wrap tooltip-icon-custom">
										<i class="tutor-icon-circle-info-o tutor-color-muted tutor-ml-4 tutor-fs-7"></i>
										<span class="tooltip-txt tooltip-right">
											<?php echo esc_html(get_the_title($attempt->course_id)); ?>
										</span>
									</div>

								<?php endif; ?>

								<?php
								$attempt_user = get_userdata($attempt->user_id);
								$user_name = $attempt_user ? $attempt_user->display_name : '';
								?>
								<div class="tpd-student-info">
									<p>
										<span><?php esc_html_e('Student:', 'edcare'); ?> </span>
										<?php echo 'backend-dashboard-students-attempts' == $context ? esc_html($user_name) : esc_attr(isset($attempt->display_name) ? $attempt->display_name : $user_name); ?>
									</p>
								</div>
							</div>

						<?php elseif ('course' == $key): ?>
							<div class="tpd-quiz-ca-sub">
								<h4 class="tpd-table-title"><?php echo esc_html(get_the_title($attempt->course_id)); ?></h4>
							</div>
						<?php elseif ('question' == $key): ?>
							<div class="tpd-quiz-ca-sub">
								<h4 class="tpd-table-title"><?php echo esc_html(count($answers)); ?></h4>
							</div>
						<?php elseif ('total_marks' == $key): ?>
							<div class="tpd-quiz-ca-sub">
								<h4 class="tpd-table-title"><?php echo esc_html(round($attempt->total_marks)); ?></h4>
							</div>
						<?php elseif ('correct_answer' == $key): ?>
							<div class="tpd-quiz-ca-sub">
								<h4 class="tpd-table-title"><?php echo esc_html($correct); ?></h4>
							</div>

						<?php elseif ('incorrect_answer' == $key): ?>
							<div class="tpd-quiz-ca-sub">
								<h4 class="tpd-table-title"><?php echo esc_html($incorrect); ?></h4>
							</div>

						<?php elseif ('earned_marks' == $key): ?>
							<div class="tpd-quiz-ca-sub">
								<h4 class="tpd-table-title">
									<?php echo esc_html(round($attempt->earned_marks) . ' (' . $earned_percentage . '%)'); ?></h4>
							</div>

						<?php elseif ('result' == $key): ?>

							<div class="tpd-quiz-ca-sub">
								<div class="tpd-badge-item">
									<?php if ($has_pending): ?>
										<span class="tpd-badge danger"><?php esc_html_e('Pending', 'edcare'); ?></span>

									<?php else: ?>
										<?php if ($earned_percentage >= $passing_grade): ?>
											<span class="tpd-badge success"><?php esc_html_e('Pass', 'edcare'); ?></span>
										<?php else: ?>
											<span class="tpd-badge danger"><?php esc_html_e('Fail', 'edcare'); ?></span>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>


						<?php elseif ('details' == $key): ?>
							<?php
							$url = add_query_arg(array('view_quiz_attempt_id' => $attempt->attempt_id), tutor()->current_url);
							$style = '';
							?>
							<div class="tutor-d-inline-flex tutor-align-center"
								style="<?php echo esc_attr(!is_admin() ? $style : ''); ?>">
								<a href="<?php echo esc_url($url); ?>" class="tpd-border-btn">
									<?php
									if ($has_pending && ('frontend-dashboard-students-attempts' == $context || 'backend-dashboard-students-attempts' == $context)) {
										esc_html_e('Review', 'edcare');
									} else {
										esc_html_e('Details', 'edcare');
									}
									?>
								</a>
								<?php
								$current_page = tutor_utils()->get_current_page_slug();
								if (!is_admin() && $course_id && (tutor_utils()->is_instructor_of_this_course(get_current_user_id(), $course_id) || current_user_can('administrator'))):
									?>
									<!-- Don't show delete option on the spotlight section since JS not support -->
									<?php if ('quiz-attempts' === $current_page || 'tutor_quiz_attempts' === $current_page): ?>
										<a href="#" class="tutor-quiz-attempt-delete tutor-iconic-btn tutor-flex-shrink-0 tutor-ml-4"
											data-quiz-id="<?php echo esc_attr($attempt_id); ?>"
											data-tutor-modal-target="tutor-common-confirmation-modal">
											<i class="tutor-icon-trash-can-line" data-quiz-id="<?php echo esc_attr($attempt_id); ?>"></i>
										</a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
		</div>
		</li>
	<?php endforeach; ?>
	</ul>
	</div>

<?php else: ?>
	<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
<?php endif; ?>

<?php
// Load delete modal.
tutor_load_template_from_custom_path(
	tutor()->path . 'views/elements/common-confirm-popup.php',
	array(
		'message' => __('Would you like to delete Quiz Attempt permanently? We suggest you proceed with caution.', 'edcare'),
	)
);
