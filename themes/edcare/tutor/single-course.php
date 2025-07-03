<?php
/**
 * Template for displaying single course
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

$course_id = get_the_ID();
$course_rating = tutor_utils()->get_course_rating($course_id);
$is_enrolled = tutor_utils()->is_enrolled($course_id, get_current_user_id());

// Prepare the nav items.
$course_nav_item = apply_filters('tutor_course/single/nav_items', tutor_utils()->course_nav_items(), $course_id);
$is_public = \TUTOR\Course_List::is_public($course_id);
$is_mobile = wp_is_mobile();

$enrollment_box_position = tutor_utils()->get_option('enrollment_box_position_in_mobile', 'bottom');
if ('-1' === $enrollment_box_position) {
	$enrollment_box_position = 'bottom';
}
$student_must_login_to_view_course = tutor_utils()->get_option('student_must_login_to_view_course');

tutor_utils()->tutor_custom_header();

if (!is_user_logged_in() && !$is_public && $student_must_login_to_view_course) {
	tutor_load_template('login');
	tutor_utils()->tutor_custom_footer();
	return;
}

$course_categories = get_the_terms($course_id, 'course-category');

$courses_instructor = tutor_utils()->get_instructors_by_course($course_id);
$last_update_check = get_the_modified_date(get_option('date_format'), get_the_ID());
$expiry = get_tutor_course_settings($course_id, 'enrollment_expiry');

$tutor_social_share_icons = tutor_utils()->tutor_social_share_icons();
if (!tutor_utils()->count($tutor_social_share_icons)) {
	return;
}

$share_config = array(
	'title' => get_the_title(),
	'text' => get_the_excerpt(),
	'image' => get_tutor_course_thumbnail('post-thumbnail', true),
);


$blog_single_layout_from_customizer = get_theme_mod('edcare_lms_single_layout', 'course_single_standard');
$single_layout_from_page = function_exists('tpmeta_field') ? tpmeta_field('edcare_course_single_layout') : NULL;


$single_layout = ($single_layout_from_page == 'default' || $single_layout_from_page == '') ? $blog_single_layout_from_customizer : $single_layout_from_page;


$tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());

$disable_course_duration = get_tutor_option('disable_course_duration');
$disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
$disable_update_date = get_tutor_option('disable_course_update_date');
$course_duration = get_tutor_course_duration_context();
$disable_course_level = get_tutor_option('disable_course_level');
$disable_course_share = get_tutor_option('disable_course_share');
$level = get_tutor_course_level();
$has_cerfificate = function_exists('tpmeta_field') ? tpmeta_field('edcare_course_certificate') : NULL;
$deadline = function_exists('tpmeta_field') ? tpmeta_field('edcare_course_deadline') : NULL;
$language = function_exists('tpmeta_field') ? tpmeta_field('edcare_course_lang') : NULL;
$enrolled_students = tutor_utils()->count_enrolled_users_by_course();
$certificate_available = ($has_cerfificate == 'on') ? 'Yes' : 'No';

$rel_args = array(
	'post__not_in' => array(get_the_ID()),
	'post_type' => 'courses',
	'tax_query' => array(
		array(
			'taxonomy' => 'course-category',
			'field' => 'term_id',
			'terms' => wp_get_post_terms(get_the_ID(), 'course-category', array('fields' => 'ids')),
		),
	),
);


$related_courses = new WP_Query($rel_args);


$related_title = get_theme_mod('edcare_lms_related_course_title', esc_html__('Related Courses', 'edcare'));
$related_desc = get_theme_mod('edcare_lms_related_course_desc', esc_html__('10,000+ unique online course list designs', 'edcare'));

$related_courses_count = count($related_courses->posts);


?>

<?php do_action('tutor_course/single/before/wrap'); ?>

<?php if ($single_layout == 'course_single_classic'): ?>
	<!-- course details breadcrumb start -->
	<section class="tp-breadcrumb__area pt-110 pb-90 p-relative z-index-1">
		<div class="tp-breadcrumb__bg details3"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="tp-breadcrumb__content">
						<div class="tp-breadcrumb__list inner-after">
							<span class="white">
								<a href="<?php echo get_home_url(); ?>">
									<svg width="17" height="14" viewBox="0 0 17 14" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd"
											d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z"
											fill="currentColor"></path>
									</svg>
								</a>
							</span>
							<span class="white">
								<a href="<?php echo esc_url(get_post_type_archive_link('courses')); ?>">
									<?php esc_html_e('  Courses / ', 'edcare'); ?>
								</a>
								<?php if (!empty($course_categories[0]->term_id)): ?>
									<a href="<?php echo esc_url(get_term_link($course_categories[0]->term_id)); ?>">
										<?php echo esc_html($course_categories[0]->name); ?>
									</a>
								<?php endif; ?>
								<?php esc_html_e(' / ', 'edcare'); ?>
								<?php the_title(); ?>
							</span>
						</div>

						<div class="tp-course-details2-header">
							<h3 class="tp-course-details3-title"><?php the_title(); ?></h3>
							<div class="tp-course-details3-meta-wrapper d-flex align-items-center flex-wrap">

								<div class="tp-course-details2-meta ">
									<?php foreach ($courses_instructor as $key => $instructor): ?>
										<div class="tp-course-details2-author d-flex align-items-center">
											<div class="tp-course-details2-author-avater">
												<?php
												echo wp_kses(
													tutor_utils()->get_tutor_avatar($instructor, 'md'),
													tutor_utils()->allowed_avatar_tags()
												);
												?>
											</div>
											<div class="tp-course-details2-author-content">
												<span
													class="tp-course-details2-author-designation"><?php esc_html_e('Teacher', 'edcare'); ?></span>
												<h3 class="tp-course-details2-meta-title">
													<a
														href="<?php echo esc_url(tutor_utils()->profile_url($instructor->ID, true)); ?>"><?php echo esc_html($instructor->display_name); ?></a>
												</h3>
											</div>
										</div>
									<?php endforeach; ?>
								</div>

								<?php if (!empty($course_categories[0]->term_id)): ?>
									<div class="tp-course-details2-meta">
										<span
											class="tp-course-details2-meta-subtitle"><?php esc_html_e('Category', 'edcare'); ?></span>
										<h3 class="tp-course-details2-meta-title">
											<a
												href="<?php echo esc_url(get_term_link($course_categories[0]->term_id)); ?>"><?php echo esc_html($course_categories[0]->name); ?></a>
										</h3>
									</div>
								<?php endif; ?>

								<div class="tp-course-details2-meta">
									<span
										class="tp-course-details2-meta-subtitle"><?php esc_html_e('Last updated', 'edcare'); ?></span>
									<h3 class="tp-course-details2-meta-title"><?php echo esc_html($last_update_check) ?>
									</h3>
								</div>

								<div class="tp-course-details2-meta text-end">
									<div class="tp-course-details2-meta-rating-wrapper">
										<div class="tp-course-rating-icon">
											<?php tutor_utils()->star_rating_generator_course($course_rating->rating_avg); ?>
										</div>
										<span class="tp-course-details2-meta-subtitle has-rating">
											<?php printf("%s /<span>%s</span>", apply_filters('tutor_course_rating_average', $course_rating->rating_avg), $course_rating->rating_count); ?>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-5">
					<div class="tp-course-details3-widget">
						<?php if (tutor_utils()->has_video_in_single() || get_tutor_course_thumbnail()): ?>
							<div class="tp-course-details2-widget-thumb p-relative">
								<?php tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
							</div>
						<?php endif; ?>

						<div class="tp-course-details3-widget-content">

							<div class="edcare-course-entry-box style-2">
								<?php if (($is_mobile && 'bottom' === $enrollment_box_position) || !$is_mobile): ?>
									<?php tutor_load_template('single.course.course-entry-box'); ?>
								<?php endif ?>
							</div>

							<div class="tp-course-details2-instructor-social text-center">
								<div class="tutor-social-share-wrap"
									data-social-share-config="<?php echo esc_attr(wp_json_encode($share_config)); ?>">
									<?php foreach ($tutor_social_share_icons as $icon): ?>
										<button class="tutor_share <?php echo esc_attr($icon['share_class']); ?>">
											<?php echo wp_kses($icon['icon_html'], tutor_utils()->allowed_icon_tags()); ?>
										</button>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-7">

					<div class="tp-course-details3-list">

						<?php if (!empty($tutor_lesson_count)): ?>
							<div class="tp-course-details3-list-item d-flex align-items-center justify-content-between">
								<span><?php esc_html_e('Lectures', 'edcare'); ?></span>
								<span class="width">
									<?php echo esc_html($tutor_lesson_count); ?>
								</span>
							</div>
						<?php endif; ?>

						<?php if (!empty(get_tutor_course_duration_context(get_the_ID(), true))): ?>
							<div class="tp-course-details3-list-item d-flex align-items-center justify-content-between">
								<span><?php esc_html_e('Hours of classes', 'edcare'); ?></span>
								<span class="width"><?php echo get_tutor_course_duration_context(get_the_ID(), true); ?></span>
							</div>
						<?php endif; ?>

						<?php if (!empty($level)): ?>
							<div class="tp-course-details3-list-item d-flex align-items-center justify-content-between">
								<span><?php esc_html_e('Level', 'edcare'); ?></span>
								<span class="width"><?php echo esc_html($level); ?></span>
							</div>
						<?php endif; ?>


						<?php if (!empty($certificate_available)): ?>
							<div class="tp-course-details3-list-item d-flex align-items-center justify-content-between">
								<span><?php esc_html_e('Certificate after completing', 'edcare'); ?></span>

								<span class="width">
									<?php if ($certificate_available == 'Yes'): ?>
										<svg width="14" height="11" viewBox="0 0 14 11" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M13 1L4.75 9.25L1 5.5" stroke="white" stroke-width="2" stroke-linecap="round"
												stroke-linejoin="round" />
										</svg>
									<?php else: ?>
										<?php esc_html_e('No', 'edcare'); ?>
									<?php endif; ?>
								</span>
							</div>
						<?php endif; ?>

						<?php if (!empty($language)): ?>
							<div class="tp-course-details3-list-item d-flex align-items-center justify-content-between">
								<span><?php esc_html_e('Language', 'edcare'); ?></span>
								<span><?php echo esc_html($language); ?></span>
							</div>
						<?php endif; ?>

						<?php if (!empty($deadline)): ?>
							<div class="tp-course-details3-list-item d-flex align-items-center justify-content-between">
								<span><?php esc_html_e('Deadline', 'edcare'); ?></span>
								<span class="width"><?php echo esc_html($deadline); ?></span>
							</div>
						<?php endif; ?>
					</div>

					<div class="tp-course-details3-main">

						<?php if (is_array($course_nav_item) && count($course_nav_item) > 1): ?>
							<div class="tp-course-details2-nav d-flex align-items-center">
								<?php tutor_load_template('single.course.enrolled.nav', array('course_nav_item' => $course_nav_item)); ?>
							</div>
						<?php endif; ?>

						<div class="tp-course-details2-content">

							<?php foreach ($course_nav_item as $key => $subpage): ?>

								<div id="<?php echo esc_attr($subpage['method']); ?>">
									<?php

									do_action('tutor_course/single/tab/' . $key . '/before');

									$method = $subpage['method'];
									if (is_string($method)) {
										$method();
									} else {
										$_object = $method[0];
										$_method = $method[1];
										$_object->$_method(get_the_ID());
									}

									do_action('tutor_course/single/tab/' . $key . '/after');
									?>
								</div>
							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- course details breadcrumb end -->

	<?php if ($related_courses_count > 0): ?>
		<section class="tp-course-details2-related-area pb-80">
			<div class="container">
				<div class="tp-course-details2-related-border"></div>
				<?php if (!empty($related_title) || !empty($related_desc)): ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="tp-course-details2-related-heading pt-80">
								<?php if (!empty($related_title)): ?>
									<h3 class="tp-course-details2-related-title"><?php echo edcare_kses($related_title); ?></h3>
								<?php endif; ?>

								<?php if (!empty($related_desc)): ?>
									<p><?php echo edcare_kses($related_desc); ?></p>
								<?php endif; ?>

							</div>
						</div>
					</div>

				<?php endif; ?>

				<?php if ($related_courses_count < 3): ?>
					<div class="row">

						<?php

						if ($related_courses->have_posts()):
							while ($related_courses->have_posts()):
								$related_courses->the_post();
								?>
								<div class="col-lg-4 col-md-6">
									<?php

									do_action('tutor_course/archive/before_loop_course');

									tutor_load_template('loop.course');
									do_action('tutor_course/archive/after_loop_course');

									?>
								</div>
							<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>

					</div>
				<?php else: ?>

					<div class="row">
						<div class="col-xl-12">
							<div class="edcare-course-related">
								<div class="edcare-course-related-active swiper">
									<div class="swiper-wrapper">
										<?php
										if ($related_courses->have_posts()):
											while ($related_courses->have_posts()):
												$related_courses->the_post();
												?>
												<div class="swiper-slide">
													<?php
													do_action('tutor_course/archive/before_loop_course');
													tutor_load_template('loop.course');
													do_action('tutor_course/archive/after_loop_course');
													?>
												</div>
											<?php
											endwhile;
											wp_reset_postdata();
										endif;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>
<?php else: ?>

	<!-- course details breadcrumb start -->
	<section class="tp-breadcrumb__area pt-25 pb-55 p-relative z-index-1 fix">
		<div class="tp-breadcrumb__bg edcare-lms-single-breadcrumb"></div>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-sm-12">
					<div class="tp-breadcrumb__content">
						<div class="tp-breadcrumb__list course-details mb-70">
							<span>
								<a href="<?php echo get_home_url(); ?>">
									<svg width="17" height="14" viewBox="0 0 17 14" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd"
											d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z"
											fill="currentColor"></path>
									</svg>
								</a>
							</span>
							<span>
								<a href="<?php echo esc_url(get_post_type_archive_link('courses')); ?>">
									<?php esc_html_e('  Courses / ', 'edcare'); ?>
								</a>
								<?php if (!empty($course_categories[0]->term_id)): ?>
									<a href="<?php echo esc_url(get_term_link($course_categories[0]->term_id)); ?>">
										<?php echo esc_html($course_categories[0]->name); ?>
									</a>
									<?php esc_html_e(' / ', 'edcare'); ?>
								<?php endif; ?>

								<?php the_title(); ?>
							</span>
						</div>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-12">
					<div class="tp-course-details2-header">

						<?php if (!empty($course_categories[0]->term_id)): ?>
							<span class="tp-course-details2-category">
								<a href="<?php echo esc_url(get_term_link($course_categories[0]->term_id)); ?>">
									<?php echo esc_html($course_categories[0]->name); ?>
								</a>
							</span>
						<?php endif; ?>

						<h3 class="tp-course-details2-title"><?php the_title(); ?></h3>

						<div class="tp-course-details2-meta-wrapper d-flex align-items-center flex-wrap">
							<div class="tp-course-details2-meta ">
								<?php foreach ($courses_instructor as $key => $instructor): ?>
									<div class="tp-course-details2-author d-flex align-items-center">

										<div class="tp-course-details2-author-avater">
											<?php
											echo wp_kses(
												tutor_utils()->get_tutor_avatar($instructor, 'md'),
												tutor_utils()->allowed_avatar_tags()
											);
											?>
										</div>

										<div class="tp-course-details2-author-content">
											<span
												class="tp-course-details2-author-designation"><?php esc_html_e('Teacher', 'edcare'); ?></span>
											<h3 class="tp-course-details2-meta-title">
												<a
													href="<?php echo esc_url(tutor_utils()->profile_url($instructor->ID, true)); ?>"><?php echo esc_html($instructor->display_name); ?></a>
											</h3>
										</div>
									</div>
								<?php endforeach; ?>
							</div>

							<?php if (!empty($course_categories[0]->term_id)): ?>
								<div class="tp-course-details2-meta">
									<span
										class="tp-course-details2-meta-subtitle"><?php esc_html_e('Category', 'edcare'); ?></span>
									<h3 class="tp-course-details2-meta-title">
										<a
											href="<?php echo esc_url(get_term_link($course_categories[0]->term_id)); ?>"><?php echo esc_html($course_categories[0]->name); ?></a>
									</h3>
								</div>
							<?php endif; ?>

							<div class="tp-course-details2-meta">
								<span
									class="tp-course-details2-meta-subtitle"><?php esc_html_e('Last Updated', 'edcare'); ?></span>
								<h3 class="tp-course-details2-meta-title"><?php echo esc_html($last_update_check) ?></h3>
							</div>

							<div class="tp-course-details2-meta text-end">
								<div class="tp-course-details2-meta-rating-wrapper">
									<div class="tp-course-rating-icon">
										<?php tutor_utils()->star_rating_generator_course($course_rating->rating_avg); ?>
									</div>
									<span class="tp-course-details2-meta-subtitle rating-color">
										<?php printf("%s /<span>%s</span>", apply_filters('tutor_course_rating_average', $course_rating->rating_avg), $course_rating->rating_count) ?>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- course details breadcrumb end -->


	<!-- course details area start -->
	<section class="tp-course-details2-area pt-50 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="tp-course-details2-main-inner pr-70">
						<?php if (is_array($course_nav_item) && count($course_nav_item) > 1): ?>
							<div class="tp-course-details2-nav d-flex align-items-center">
								<?php tutor_load_template('single.course.enrolled.nav', array('course_nav_item' => $course_nav_item)); ?>
							</div>
						<?php endif; ?>

						<div class="tp-course-details2-content">
							<?php foreach ($course_nav_item as $key => $subpage): ?>

								<div id="<?php echo esc_attr($subpage['method']); ?>">
									<?php

									do_action('tutor_course/single/tab/' . $key . '/before');

									$method = $subpage['method'];
									if (is_string($method)) {
										$method();
									} else {
										$_object = $method[0];
										$_method = $method[1];
										$_object->$_method(get_the_ID());
									}

									do_action('tutor_course/single/tab/' . $key . '/after');
									?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<?php $sidebar_attr = apply_filters('tutor_course_details_sidebar_attr', ''); ?>


					<div class="tp-course-details2-widget" <?php echo esc_attr($sidebar_attr); ?>>
						<?php do_action('tutor_course/single/before/sidebar'); ?>
						<?php if (tutor_utils()->has_video_in_single() || get_tutor_course_thumbnail()): ?>
							<div class="tp-course-details2-widget-thumb p-relative">
								<?php tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
							</div>
						<?php endif; ?>

						<div class="tp-course-details2-widget-content">

							<?php if (($is_mobile && 'bottom' === $enrollment_box_position) || !$is_mobile): ?>
								<?php tutor_load_template('single.course.course-entry-box'); ?>
							<?php endif ?>

							<div class="tp-course-details2-widget-list">
								<h5><?php esc_html_e('This course includes:', 'edcare'); ?></h5>

								<div class="tp-course-details2-widget-list-item-wrapper">

									<?php if (!empty($tutor_lesson_count)): ?>
										<div
											class="tp-course-details2-widget-list-item d-flex align-items-center justify-content-between">
											<span>
												<svg width="17" height="17" viewBox="0 0 17 17" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" clip-rule="evenodd"
														d="M8.5 1C12.6415 1 16 4.35775 16 8.5C16 12.6423 12.6415 16 8.5 16C4.35775 16 1 12.6423 1 8.5C1 4.35775 4.35775 1 8.5 1Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path fill-rule="evenodd" clip-rule="evenodd"
														d="M10.8692 8.49618C10.8692 7.85581 7.58703 5.80721 7.2147 6.17556C6.84237 6.54391 6.80657 10.4137 7.2147 10.8168C7.62283 11.2213 10.8692 9.13655 10.8692 8.49618Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
												</svg>
												<?php esc_html_e('Lectures', 'edcare'); ?>
											</span>
											<span><?php echo esc_html($tutor_lesson_count); ?></span>
										</div>
									<?php endif; ?>

									<?php if (!empty(get_tutor_course_duration_context(get_the_ID(), true))): ?>
										<div
											class="tp-course-details2-widget-list-item d-flex align-items-center justify-content-between">
											<span>
												<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path
														d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#4F5158"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												</svg>

												<?php esc_html_e('Duration', 'edcare'); ?>
											</span>
											<span><?php echo get_tutor_course_duration_context(get_the_ID(), true); ?></span>
										</div>
									<?php endif; ?>

									<?php if (!empty($level)): ?>
										<div
											class="tp-course-details2-widget-list-item d-flex align-items-center justify-content-between">
											<span>
												<svg width="11" height="14" viewBox="0 0 11 14" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M5.5 13V5.5" stroke="#4F5158" stroke-width="2"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M10 13V1" stroke="#4F5158" stroke-width="2" stroke-linecap="round"
														stroke-linejoin="round" />
													<path d="M1 13V10" stroke="#4F5158" stroke-width="2" stroke-linecap="round"
														stroke-linejoin="round" />
												</svg>

												<?php esc_html_e('Skill Level', 'edcare'); ?>
											</span>
											<span><?php echo esc_html($level); ?></span>
										</div>
									<?php endif; ?>

									<?php if (!empty($language)): ?>
										<div
											class="tp-course-details2-widget-list-item d-flex align-items-center justify-content-between">
											<span>
												<svg width="16" height="17" viewBox="0 0 16 17" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path
														d="M8 15.5C11.866 15.5 15 12.366 15 8.5C15 4.63401 11.866 1.5 8 1.5C4.13401 1.5 1 4.63401 1 8.5C1 12.366 4.13401 15.5 8 15.5Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path d="M1 8.5H15" stroke="#4F5158" stroke-width="1.5"
														stroke-linecap="round" stroke-linejoin="round" />
													<path
														d="M7.99727 1.5C9.74816 3.41685 10.7432 5.90442 10.7973 8.5C10.7432 11.0956 9.74816 13.5832 7.99727 15.5C6.24637 13.5832 5.25134 11.0956 5.19727 8.5C5.25134 5.90442 6.24637 3.41685 7.99727 1.5Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
												</svg>

												<?php esc_html_e('Language', 'edcare'); ?>
											</span>
											<span><?php echo esc_html($language); ?></span>
										</div>
									<?php endif; ?>

									<?php if (!empty($deadline)): ?>
										<div
											class="tp-course-details2-widget-list-item d-flex align-items-center justify-content-between">
											<span>
												<svg width="15" height="16" viewBox="0 0 15 16" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5"
														stroke-linecap="round" stroke-linejoin="round" />
													<path fill-rule="evenodd" clip-rule="evenodd"
														d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
												</svg>

												<?php esc_html_e('Deadline', 'edcare'); ?>
											</span>
											<span><?php echo esc_html($deadline); ?></span>
										</div>
									<?php endif; ?>

									<?php if (!empty($certificate_available)): ?>
										<div
											class="tp-course-details2-widget-list-item d-flex align-items-center justify-content-between">
											<span>
												<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path
														d="M14.721 6.64274C14.721 7.8116 14.3744 8.88373 13.7779 9.77851C12.9073 11.0683 11.5289 11.9792 9.9247 12.2129C9.65063 12.2613 9.36849 12.2855 9.07829 12.2855C8.78809 12.2855 8.50596 12.2613 8.23188 12.2129C6.62773 11.9792 5.24929 11.0683 4.37869 9.77851C3.78217 8.88373 3.43555 7.8116 3.43555 6.64274C3.43555 3.52311 5.95866 1 9.07829 1C12.1979 1 14.721 3.52311 14.721 6.64274Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path opacity="0.4"
														d="M16.5341 14.2766L15.2041 14.591C14.9058 14.6636 14.672 14.8893 14.6075 15.1875L14.3254 16.3725C14.1722 17.0174 13.35 17.2109 12.9228 16.703L9.07766 12.2856L5.23253 16.7111C4.80529 17.2189 3.98307 17.0255 3.82991 16.3806L3.54777 15.1956C3.47522 14.8973 3.24145 14.6636 2.95125 14.5991L1.62117 14.2847C1.00853 14.1396 0.790885 13.3738 1.23424 12.9304L4.37806 9.78662C5.24865 11.0764 6.6271 11.9873 8.23125 12.2211C8.50532 12.2694 8.78746 12.2936 9.07766 12.2936C9.36786 12.2936 9.64999 12.2694 9.92407 12.2211C11.5282 11.9873 12.9067 11.0764 13.7773 9.78662L16.9211 12.9304C17.3644 13.3657 17.1468 14.1315 16.5341 14.2766Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path opacity="0.4"
														d="M9.54557 4.20822L10.0212 5.15942C10.0857 5.2884 10.2549 5.41738 10.4081 5.44156L11.2706 5.58665C11.8188 5.67533 11.9478 6.07838 11.5528 6.47338L10.8837 7.14243C10.7709 7.25529 10.7064 7.47295 10.7467 7.63417L10.9401 8.46446C11.0933 9.11741 10.7467 9.37535 10.1663 9.02872L9.36017 8.55312C9.21507 8.46445 8.97324 8.46445 8.82814 8.55312L8.02203 9.02872C7.44163 9.36728 7.09501 9.11741 7.24817 8.46446L7.44163 7.63417C7.47388 7.48101 7.41745 7.25529 7.3046 7.14243L6.63553 6.47338C6.24054 6.07838 6.36951 5.68339 6.91766 5.58665L7.7802 5.44156C7.9253 5.41738 8.09458 5.2884 8.15907 5.15942L8.63467 4.20822C8.86844 3.69231 9.28762 3.69231 9.54557 4.20822Z"
														stroke="#4F5158" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
												</svg>

												<?php esc_html_e('Certificate', 'edcare'); ?>
											</span>
											<span><?php echo esc_html($certificate_available) ?></span>
										</div>
									<?php endif; ?>

									<div
										class="tp-course-details2-widget-share d-flex align-items-center justify-content-between">
										<a class="share" href="#" data-tutor-modal-target="tutor-course-share-opener">
											<span>
												<svg width="15" height="16" viewBox="0 0 15 16" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path
														d="M11.5023 5.2C12.6621 5.2 13.6023 4.2598 13.6023 3.1C13.6023 1.9402 12.6621 1 11.5023 1C10.3425 1 9.40234 1.9402 9.40234 3.1C9.40234 4.2598 10.3425 5.2 11.5023 5.2Z"
														stroke="#5169F1" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path
														d="M3.1 10.1001C4.2598 10.1001 5.2 9.15994 5.2 8.00014C5.2 6.84035 4.2598 5.90015 3.1 5.90015C1.9402 5.90015 1 6.84035 1 8.00014C1 9.15994 1.9402 10.1001 3.1 10.1001Z"
														stroke="#5169F1" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path
														d="M11.5023 15C12.6621 15 13.6023 14.0598 13.6023 12.9C13.6023 11.7403 12.6621 10.8 11.5023 10.8C10.3425 10.8 9.40234 11.7403 9.40234 12.9C9.40234 14.0598 10.3425 15 11.5023 15Z"
														stroke="#5169F1" stroke-width="1.5" stroke-linecap="round"
														stroke-linejoin="round" />
													<path d="M4.91406 9.05701L9.69506 11.843" stroke="#5169F1"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M9.68806 4.15723L4.91406 6.94322" stroke="#5169F1"
														stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												</svg>
											</span>
											<?php esc_html_e('Share this course', 'edcare'); ?>
										</a>
									</div>


									<div id="tutor-course-share-opener" class="tutor-modal">
										<span class="tutor-modal-overlay"></span>
										<div class="tutor-modal-window">
											<div class="tutor-modal-content tutor-modal-content-white">
												<button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
													<span class="tutor-icon-times" area-hidden="true"></span>
												</button>
												<div class="tutor-modal-body">
													<div class="tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-16">
														<?php esc_html_e('Share Course', 'edcare'); ?>
													</div>
													<div class="tutor-fs-7 tutor-color-secondary tutor-mb-12">
														<?php esc_html_e('Page Link', 'edcare'); ?>
													</div>
													<div class="tutor-mb-32">
														<input class="tutor-form-control"
															value="<?php echo esc_attr(get_permalink(get_the_ID())); ?>" />
													</div>
													<div>
														<div
															class="tutor-color-black tutor-fs-6 tutor-fw-medium tutor-mb-16">
															<?php esc_html_e('Share On Social Media', 'edcare'); ?>
														</div>
														<div class="tutor-social-share-wrap"
															data-social-share-config="<?php echo esc_attr(wp_json_encode($share_config)); ?>">
															<?php foreach ($tutor_social_share_icons as $icon): ?>
																<button
																	class="tutor_share <?php echo esc_attr($icon['share_class']); ?>"
																	data-bg-color="<?php echo esc_attr($icon['color']); ?>">
																	<?php echo wp_kses($icon['icon_html'], tutor_utils()->allowed_icon_tags()); ?>
																	<span class="">
																		<?php echo esc_html($icon['text']); ?>
																	</span>
																</button>
															<?php endforeach; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php do_action('tutor_course/single/after/sidebar'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- course details area end -->

	<?php if ($related_courses_count > 0): ?>
		<section class="tp-course-details2-related-area pb-80">
			<div class="container">
				<div class="tp-course-details2-related-border"></div>
				<?php if (!empty($related_title) || !empty($related_desc)): ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="tp-course-details2-related-heading pt-80">
								<?php if (!empty($related_title)): ?>
									<h3 class="tp-course-details2-related-title"><?php echo edcare_kses($related_title); ?></h3>
								<?php endif; ?>

								<?php if (!empty($related_desc)): ?>
									<p><?php echo edcare_kses($related_desc); ?></p>
								<?php endif; ?>

							</div>
						</div>
					</div>

				<?php endif; ?>

				<?php if ($related_courses_count < 3): ?>
					<div class="row">

						<?php

						if ($related_courses->have_posts()):
							while ($related_courses->have_posts()):
								$related_courses->the_post();
								?>
								<div class="col-lg-4 col-md-6">
									<?php

									do_action('tutor_course/archive/before_loop_course');

									tutor_load_template('loop.course');
									do_action('tutor_course/archive/after_loop_course');

									?>
								</div>
							<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>

					</div>
				<?php else: ?>

					<div class="row">
						<div class="col-xl-12">
							<div class="edcare-course-related">
								<div class="edcare-course-related-active swiper">
									<div class="swiper-wrapper">
										<?php
										if ($related_courses->have_posts()):
											while ($related_courses->have_posts()):
												$related_courses->the_post();
												?>
												<div class="swiper-slide">
													<?php
													do_action('tutor_course/archive/before_loop_course');
													tutor_load_template('loop.course');
													do_action('tutor_course/archive/after_loop_course');
													?>
												</div>
											<?php
											endwhile;
											wp_reset_postdata();
										endif;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

<?php endif; ?>




<?php do_action('tutor_course/single/after/wrap'); ?>



<?php
tutor_utils()->tutor_custom_footer();
