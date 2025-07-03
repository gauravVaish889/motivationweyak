<?php
/**
 * Template for displaying frontend dashboard
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

$is_by_short_code = isset($is_shortcode) && true === $is_shortcode;
if (!$is_by_short_code && !defined('OTLMS_VERSION')) {
	tutor_utils()->tutor_custom_header();
}

global $wp_query;

$dashboard_page_slug = '';
$dashboard_page_name = '';
if (isset($wp_query->query_vars['tutor_dashboard_page']) && $wp_query->query_vars['tutor_dashboard_page']) {
	$dashboard_page_slug = $wp_query->query_vars['tutor_dashboard_page'];
	$dashboard_page_name = $wp_query->query_vars['tutor_dashboard_page'];
}
/**
 * Getting dashboard sub pages
 */
if (isset($wp_query->query_vars['tutor_dashboard_sub_page']) && $wp_query->query_vars['tutor_dashboard_sub_page']) {
	$dashboard_page_name = $wp_query->query_vars['tutor_dashboard_sub_page'];
	if ($dashboard_page_slug) {
		$dashboard_page_name = $dashboard_page_slug . '/' . $dashboard_page_name;
	}
}
$dashboard_page_name = apply_filters('tutor_dashboard_sub_page_template', $dashboard_page_name);

$user_id = get_current_user_id();
$user = get_user_by('ID', $user_id);
$enable_profile_completion = tutor_utils()->get_option('enable_profile_completion');
$is_instructor = tutor_utils()->is_instructor();

// URLS
$current_url = tutor()->current_url;
$footer_url_1 = trailingslashit(tutor_utils()->tutor_dashboard_url($is_instructor ? 'my-courses' : ''));
$footer_url_2 = trailingslashit(tutor_utils()->tutor_dashboard_url($is_instructor ? 'question-answer' : 'my-quiz-attempts'));

// Footer links
$footer_links = array(
	array(
		'title' => $is_instructor ? __('My Courses', 'edcare') : __('Dashboard', 'edcare'),
		'url' => $footer_url_1,
		'is_active' => $footer_url_1 == $current_url,
		'icon_class' => 'ttr tutor-icon-dashboard',
	),
	array(
		'title' => $is_instructor ? __('Q&A', 'edcare') : __('Quiz Attempts', 'edcare'),
		'url' => $footer_url_2,
		'is_active' => $footer_url_2 == $current_url,
		'icon_class' => $is_instructor ? 'ttr  tutor-icon-question' : 'ttr tutor-icon-quiz-attempt',
	),
	array(
		'title' => __('Menu', 'edcare'),
		'url' => '#',
		'is_active' => false,
		'icon_class' => 'ttr tutor-icon-hamburger-o tutor-dashboard-menu-toggler',
	),
);

do_action('tutor_dashboard/before/wrap');


$cover_placeholder = tutor()->url . 'assets/images/cover-photo.jpg';
$cover_photo_src = $cover_placeholder;
$cover_photo_id = get_user_meta($user->ID, '_tutor_cover_photo', true);
if ($cover_photo_id) {
	$url = wp_get_attachment_image_url($cover_photo_id, 'full');
	!empty($url) ? $cover_photo_src = $url : 0;
}
$profile_placeholder = apply_filters('tutor_login_default_avatar', tutor()->url . 'assets/images/profile-photo.png');
$profile_photo_src = $profile_placeholder;
$profile_photo_id = get_user_meta($user->ID, '_tutor_profile_photo', true);
if ($profile_photo_id) {
	$url = wp_get_attachment_image_url($profile_photo_id, 'full');
	!empty($url) ? $profile_photo_src = $url : 0;
}


?>

<div class="tp-dashboard-body-bg">
	<div class="tp-dashboard-banner-wrap">
		<div class="tp-dashboard-banner-shape">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/dashboard/bg/dashboard-bg-shape-1.jpg"
				alt="<?php echo esc_attr__('EdCare', 'edcare'); ?>">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="tp-dashboard-banner-bg mt-30"
						data-background="<?php echo esc_url($cover_photo_src); ?>">
						<div class="tp-instructor-wrap d-flex justify-content-between">
							<div class="tp-instructor-info d-flex">
								<div class="tp-instructor-avatar">
									<img src="<?php echo esc_url($profile_photo_src); ?>"
										alt="<?php echo esc_attr($user->display_name); ?>">
								</div>
								<div class="tp-instructor-content">
									<?php
									$instructor_rating = tutor_utils()->get_instructor_ratings($user->ID);
									?>
									<?php if (current_user_can(tutor()->instructor_role)): ?>
										<h4 class="tp-instructor-title"><?php echo esc_html($user->display_name); ?></h4>
										<div class="tp-instructor-rate  d-flex align-items-center">
											<div class="tp-instructor-rating">
												<?php tutor_utils()->star_rating_generator_v2($instructor_rating->rating_avg, $instructor_rating->rating_count, true); ?>
											</div>
										</div>
									<?php else: ?>
										<h4 class="tp-instructor-title"><?php echo esc_html($user->display_name); ?></h4>
									<?php endif; ?>
								</div>
							</div>
							<div class="tp-instructor-course-btn">


								<?php
								do_action('tutor_dashboard/before_header_button');
								$instructor_status = tutor_utils()->instructor_status(0, false);
								$instructor_status = is_string($instructor_status) ? strtolower($instructor_status) : '';
								$rejected_on = get_user_meta($user->ID, '_is_tutor_instructor_rejected', true);

								ob_start();
								if (tutor_utils()->get_option('enable_become_instructor_btn')) {
									?>
									<a id="tutor-become-instructor-button" class="tp-btn-add-course"
										href="<?php echo esc_url(tutor_utils()->instructor_register_url()); ?>">
										<i class="tutor-icon-user-bold"></i> &nbsp;
										<?php esc_html_e('Become an instructor', 'edcare'); ?>
									</a>
									<?php
								}
								$become_button = ob_get_clean();

								if (current_user_can(tutor()->instructor_role)) {
									$course_type = tutor()->course_post_type;
									?>
									<?php
									/**
									 * Render create course button based on free & pro
									 *
									 * @since v2.0.7
									 */
									if (function_exists('tutor_pro')):
										?>
										<a href="#" id="tutor-create-new-course" class="tp-btn-add-course">
											<i class="fa-regular fa-plus"></i>
											<?php esc_html_e('Create a New Course', 'edcare'); ?>
										</a>

									<?php else: ?>
										<a href="<?php echo esc_url(admin_url("post-new.php?post_type=$course_type")); ?>"
											class="tp-btn-add-course">
											<i class="fa-regular fa-plus"></i>
											<?php esc_html_e('Create a New Course', 'edcare'); ?>
										</a>
									<?php endif; ?>
									<?php
								} elseif ('pending' == $instructor_status) {
									$on = get_user_meta($user->ID, '_is_tutor_instructor', true);
									$on = date('d F, Y', $on);

									printf("<p class='text-white'><i class='dashicons dashicons-info tutor-color-warning'></i> %s <b>%s</b></p>", esc_html__('Your Application is pending as of', 'edcare'), esc_html($on));
								} elseif ($rejected_on || $instructor_status !== 'blocked') {
									echo edcare_kses($become_button);
								}
								?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="tpd-main pb-75 tutor-dashboard">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="tpd-user-sidebar">
						<div class="tp-user-wrap">
							<div class="tp-user-menu">
								<nav>
									<ul>
										<li class="tp-user-menu-title"><?php esc_html_e('Welcome', 'edcare'); ?></li>
										<?php
										$dashboard_pages = tutor_utils()->tutor_dashboard_nav_ui_items();
										// get reviews settings value.
										$disable = !get_tutor_option('enable_course_review');
										foreach ($dashboard_pages as $dashboard_key => $dashboard_page) {



											if ($disable && 'reviews' === $dashboard_key) {
												continue;
											}

											$menu_title = $dashboard_page;
											$menu_link = tutor_utils()->get_tutor_dashboard_page_permalink($dashboard_key);
											$separator = false;
											$menu_icon = '';


											if (is_array($dashboard_page)) {
												$menu_title = tutor_utils()->array_get('title', $dashboard_page);
												$menu_icon_name = tutor_utils()->array_get('icon', $dashboard_page, (isset($dashboard_page['icon']) ? $dashboard_page['icon'] : ''));

												if (in_array($dashboard_key, get_lsm_dashboard_menu_keys())) {
													$menu_icon = get_lsm_dashboard_menu_icon($dashboard_key);
												} else {
													if ($menu_icon_name) {
														$menu_icon = "<span class='{$menu_icon_name} tutor-dashboard-menu-item-icon'></span>";
													}
												}

												// Add new menu item property "url" for custom link
												if (isset($dashboard_page['url'])) {
													$menu_link = $dashboard_page['url'];
												}
												if (isset($dashboard_page['type']) && $dashboard_page['type'] == 'separator') {
													$separator = true;
												}
											}
											if ($separator) {

												if ($menu_title) {
													?>
													<li class='tp-user-menu-title space-gap'>
														<?php echo esc_html($menu_title); ?>
													</li>
													<?php
												}
											} else {
												$li_class = "edcare-dashboard-menu-{$dashboard_key}";
												if ('index' === $dashboard_key) {
													$dashboard_key = '';
												}
												$active_class = $dashboard_key == $dashboard_page_slug ? 'active' : '';
												$data_no_instant = 'logout' == $dashboard_key ? 'data-no-instant' : '';
												$menu_link = apply_filters('tutor_dashboard_menu_link', $menu_link, $menu_title);
												?>
												<li
													class='edcare-dashboard-menu-item <?php echo esc_attr($li_class . ' ' . $active_class); ?>'>
													<a <?php echo esc_html($data_no_instant); ?>
														href="<?php echo esc_url($menu_link); ?>">
														<span>
															<?php echo edcare_kses($menu_icon); ?>
														</span>
														<?php echo esc_html($menu_title); ?>
													</a>
												</li>
												<?php
											}
										}
										?>
									</ul>
								</nav>
							</div>


						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="tpd-content-layout">
						<?php
						if ($dashboard_page_name) {
							do_action('tutor_load_dashboard_template_before', $dashboard_page_name);
							$other_location = '';
							$from_other_location = apply_filters('load_dashboard_template_part_from_other_location', $other_location);

							if ('' == $from_other_location) {
								tutor_load_template('dashboard.' . $dashboard_page_name);
							} else {
								include_once $from_other_location;
							}

							do_action('tutor_load_dashboard_template_before', $dashboard_page_name);
						} else {
							tutor_load_template('dashboard.dashboard');
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="tutor-dashboard-footer-mobile">
			<div class="tutor-container">
				<div class="tutor-row">
					<?php foreach ($footer_links as $link): ?>
						<a class="tutor-col-4 <?php echo esc_attr($link['is_active'] ? 'active' : ''); ?>"
							href="<?php echo esc_url($link['url']); ?>">
							<i class="<?php echo esc_attr($link['icon_class']); ?>"></i>
							<span><?php echo esc_html($link['title']); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

</div>

<?php do_action('tutor_dashboard/after/wrap'); ?>

<?php
if (!$is_by_short_code && !defined('OTLMS_VERSION')) {
	tutor_utils()->tutor_custom_footer();
}
