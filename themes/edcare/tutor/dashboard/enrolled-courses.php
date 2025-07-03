<?php
/**
 * Enrolled Courses Page
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

use TUTOR\Input;

// Pagination.
$per_page = tutor_utils()->get_option('pagination_per_page', 10);
$paged = max(1, Input::get('current_page', 1, Input::TYPE_INT));
$offset = ($per_page * $paged) - $per_page;

$page_tabs = array(
	'enrolled-courses' => __('Enrolled Courses', 'edcare'),
	'enrolled-courses/active-courses' => __('Active Courses', 'edcare'),
	'enrolled-courses/completed-courses' => __('Completed Courses', 'edcare'),
);

// Default tab set.
(!isset($active_tab, $page_tabs[$active_tab])) ? $active_tab = 'enrolled-courses' : 0;

// Get Paginated course list.
$courses_list_array = array(
	'enrolled-courses' => tutor_utils()->get_enrolled_courses_by_user(get_current_user_id(), array('private', 'publish'), $offset, $per_page),
	'enrolled-courses/active-courses' => tutor_utils()->get_active_courses_by_user(null, $offset, $per_page),
	'enrolled-courses/completed-courses' => tutor_utils()->get_courses_by_user(null, $offset, $per_page),
);

// Get Full course list.
$full_courses_list_array = array(
	'enrolled-courses' => tutor_utils()->get_enrolled_courses_by_user(get_current_user_id(), array('private', 'publish')),
	'enrolled-courses/active-courses' => tutor_utils()->get_active_courses_by_user(),
	'enrolled-courses/completed-courses' => tutor_utils()->get_courses_by_user(),
);


// Prepare course list based on page tab.
$courses_list = $courses_list_array[$active_tab];
$paginated_courses_list = $full_courses_list_array[$active_tab];

?>

<div class="dashboader-area mb-30">
	<div class="tp-dashboard-tab">
		<h2 class="tp-dashboard-tab-title"><?php echo esc_html($page_tabs[$active_tab]); ?></h2>
		<div class="tp-dashboard-tab-list">
			<ul class="tutor-nav" tutor-priority-nav>
				<?php foreach ($page_tabs as $slug => $tab): ?>
					<li class="tutor-nav-item">
						<a class="tutor-nav-link<?php echo esc_attr($slug == $active_tab ? ' is-active' : ''); ?>"
							href="<?php echo esc_url(tutor_utils()->get_tutor_dashboard_page_permalink($slug)); ?>">
							<?php
							echo esc_html($tab);

							$course_count = ($full_courses_list_array[$slug] && $full_courses_list_array[$slug]->have_posts()) ? count($full_courses_list_array[$slug]->posts) : 0;
							if ($course_count):
								echo esc_html('&nbsp;(' . $course_count . ')');
							endif;
							?>
						</a>
					</li>
				<?php endforeach; ?>

				<li class="tutor-nav-item tutor-nav-more tutor-d-none">
					<a class="tutor-nav-link tutor-nav-more-item" href="#"><span
							class="tutor-mr-4"><?php esc_html_e('More', 'edcare'); ?></span> <span
							class="tutor-nav-more-icon tutor-icon-times"></span></a>
					<ul class="tutor-nav-more-list tutor-dropdown"></ul>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="course-area">
	<?php if ($courses_list && $courses_list->have_posts()): ?>
		<div class="row">
			<?php
			while ($courses_list->have_posts()):
				$courses_list->the_post();
				$course_id = get_the_ID();
				$tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
				$course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);
				$tutor_course_img = get_tutor_course_thumbnail_src();
				$course_progress = tutor_utils()->get_course_completed_percent($course_id, 0, true);
				?>
				<div class="col-xl-4 col-md-6">
					<div class="tp-dashboard-course mb-25">
						<div class="tp-dashboard-course-thumb">
							<img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title(); ?>">
						</div>
						<div class="tp-dashboard-course-content">

							<div class="tp-dashboard-rating d-flex align-items-center gap-1">
								<div class="rating-icon">
									<?php
									$course_rating = tutor_utils()->get_course_rating();
									tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
									?>

								</div>
								<span>

									<?php printf("(%d Reviews)", esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0)); ?>
								</span>
							</div>

							<h4 class="tp-dashboard-course-title">
								<a href="<?php echo esc_url(get_the_permalink()); ?>">
									<?php the_title(); ?>
								</a>
							</h4>

							<?php if (tutor_utils()->get_option('enable_course_total_enrolled') || !empty($tutor_lesson_count)): ?>
								<div class="tp-dashboard-course-meta">
									<?php if (!empty($tutor_lesson_count)): ?>
										<span>
											<span>
												<svg width="15" height="14" viewBox="0 0 15 14" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path
														d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z"
														stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
														stroke-linejoin="round"></path>
													<path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2"
														stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
											</span>
											<?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'edcare'), $tutor_lesson_count); ?>
										</span>
									<?php endif; ?>

									<?php if (tutor_utils()->get_option('enable_course_total_enrolled')): ?>
										<span>
											<span>
												<svg width="13" height="15" viewBox="0 0 13 15" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path
														d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z"
														stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
														stroke-linejoin="round"></path>
													<path
														d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14"
														stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
														stroke-linejoin="round"></path>
												</svg>
											</span>

											<?php printf(_n('%d Student', '%d Students', $course_students, 'edcare'), $course_students); ?>
										</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>


							<div class="tp-dashboard-progress">

								<div class="tp-dashboard-progress-info d-flex align-items-center justify-content-between">
									<span>
										<?php echo esc_html($course_progress['completed_count']); ?>/<?php echo esc_html($course_progress['total_count']); ?>
									</span>
									<span>
										<?php echo esc_html($course_progress['completed_percent'] . '%'); ?>
										<?php esc_html_e('Complete', 'edcare'); ?>
									</span>
								</div>

								<div class="progress" role="progressbar" aria-label="Example" aria-valuenow="25"
									aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar wow fadeInLeft" data-wow-duration=".9s" data-wow-delay=".3s"
										data-width="<?php echo esc_attr($course_progress['completed_percent']); ?>%"></div>
								</div>

							</div>
							<div class="tp-dashboard-course-btn">
								<?php tutor_course_loop_price(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	<?php else: ?>
		<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
	<?php endif; ?>
</div>