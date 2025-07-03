<?php
/**
 * Template for course archive filter
 *
 * @package Tutor\Templates
 * @subpackage Course_Filter
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

use TUTOR\Input;

if (!tutor_utils()->get_option('course_archive_filter_sorting', true, true, true)) {
	return;
}


$sort_by = Input::get('course_order', '');

// get total pushlised course
$published_course = wp_count_posts('courses')->publish;
$course_found_desc = get_theme_mod('edcare_lms_course_found_desc', 'We found [course_number] courses available for you');

$course_number = $published_course > 9 ? $published_course : '0' . $published_course;
if (!empty($course_found_desc)) {
	$course_found_text = str_replace('[course_number]', '<span class="text-black fw-medium">' . $course_number . ' </span>', $course_found_desc);
} else {
	$course_found_text = '';
}



// option from GET for demo show
$view_switcher_demo = isset($_GET['view_switcher']) && !empty($_GET['view_switcher']) ? true : false;


if ($view_switcher_demo) {
	$view_switcher_demo_value = $_GET['view_switcher'] == 'false' ? false : true;
	$view_switcher = $view_switcher_demo_value;
} else {
	$view_switcher = get_theme_mod('edcare_lms_view_style_switch', true); // code from customizer
}

$view_style = isset($_GET['view_style']) && !empty($_GET['view_style']) ? $_GET['view_style'] : get_theme_mod('edcare_lms_view_style', 'grid');


$grid_tab_active = ($view_style == 'grid' || $view_style == 'grid_list') ? ' active ' : '';
$list_tab_active = $view_style == 'list' ? ' active ' : '';


// option from GET for demo show
$filter_style_demo = isset($_GET['filter']) && !empty($_GET['filter']) ? $_GET['filter'] : false;

if ($filter_style_demo) {
	$filter_style = $filter_style_demo;
} else {
	$filter_style = get_theme_mod('edcare_lms_filter_style', 'sidebar'); // code from customizer
}


$filter_object = new \TUTOR\Course_Filter();
$filter_prices = array(
	'free' => __('Free', 'edcare'),
	'paid' => __('Paid', 'edcare'),
);

$course_levels = tutor_utils()->course_levels();
$course_categories = get_terms([
	'taxonomy' => 'course-category',
	'hide_empty' => true,
]);
$supported_filters = tutor_utils()->get_option('supported_course_filters', true);
$supported_filters = is_array($supported_filters) ? array_keys($supported_filters) : [];
$reset_link = remove_query_arg($supported_filters, get_pagenum_link());
$instructor_list = tutor_utils()->get_instructors();
?>


<?php if ($filter_style == 'style_1'): ?>
	<div class="w-100" tutor-course-filter>
		<form>
			<div class="tp-course-filter-wrap p-relative">
				<div class="row">
					<div class="col-lg-6">
						<div class="tp-course-filter-top-left d-flex align-items-center">
							<?php if ($view_switcher): ?>
								<div class="tp-course-filter-top-tab tp-tab">
									<ul class="nav nav-tabs flex-nowrap" id="filterTab" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link <?php echo esc_attr($grid_tab_active); ?>"
												id="courseGrid-tab" data-bs-toggle="tab" data-bs-target="#courseGrid"
												type="button" role="tab" aria-controls="courseGrid" aria-selected="true">
												<svg width="14" height="14" viewBox="0 0 14 14" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M5.66667 1H1V5.66667H5.66667V1Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M12.9997 1H8.33301V5.66667H12.9997V1Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M5.66667 8.33337H1V13H5.66667V8.33337Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
												</svg>
												<?php esc_html_e('Grid', 'edcare'); ?>
											</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link <?php echo esc_attr($list_tab_active); ?>"
												id="courseList-tab" data-bs-toggle="tab" data-bs-target="#courseList"
												type="button" role="tab" aria-controls="courseList" aria-selected="false">
												<svg width="14" height="14" viewBox="0 0 16 15" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M15 7.11108H1" stroke="#031F42" stroke-width="1"
														stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M15 1H1" stroke="#031F42" stroke-width="1" stroke-linecap="round"
														stroke-linejoin="round"></path>
													<path d="M15 13.2222H1" stroke="#031F42" stroke-width="1"
														stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<?php esc_html_e('List', 'edcare'); ?>
											</button>
										</li>
									</ul>
								</div>
							<?php endif; ?>

							<?php if (!empty($course_found_text)): ?>
								<div class="tp-course-filter-top-result">
									<p><?php echo edcare_kses($course_found_text); ?></p>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-6">

						<div
							class="tp-course-filter-top-right d-flex align-items-center justify-content-start justify-content-lg-end">
							<div class="tp-course-filter-top-right-search d-none d-lg-block">
								<input type="search" name="keyword"
									placeholder="<?php esc_attr_e('Search Courses...', 'edcare'); ?>">
								<button class="tp-course-filter-top-right-search-btn" type="button">
									<span>
										<svg width="17" height="17" viewBox="0 0 17 17" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M12.625 12.625L16 16" stroke="#8B8B8B" stroke-width="1.5"
												stroke-linecap="round" stroke-linejoin="round"></path>
											<path
												d="M14.5 7.75C14.5 4.02208 11.4779 1 7.75 1C4.02208 1 1 4.02208 1 7.75C1 11.4779 4.02208 14.5 7.75 14.5C11.4779 14.5 14.5 11.4779 14.5 7.75Z"
												stroke="#8B8B8B" stroke-width="1.5" stroke-linejoin="round"></path>
										</svg>
									</span>
								</button>
							</div>
							<div class="tp-course-filter-btn">
								<button type="button" class="tp-filter-btn filter-open-dropdown-btn">
									<span>
										<svg width="16" height="15" viewBox="0 0 16 15" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M14.9998 3.44995H10.7998" stroke="#5169F1" stroke-width="1.5"
												stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M3.8 3.44995H1" stroke="#5169F1" stroke-width="1.5"
												stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
											<path
												d="M6.60039 5.9C7.95349 5.9 9.05039 4.8031 9.05039 3.45C9.05039 2.0969 7.95349 1 6.60039 1C5.24729 1 4.15039 2.0969 4.15039 3.45C4.15039 4.8031 5.24729 5.9 6.60039 5.9Z"
												stroke="#5169F1" stroke-width="1.5" stroke-miterlimit="10"
												stroke-linecap="round" stroke-linejoin="round" />
											<path d="M15.0002 11.15H12.2002" stroke="#5169F1" stroke-width="1.5"
												stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M5.2 11.15H1" stroke="#5169F1" stroke-width="1.5"
												stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
											<path
												d="M9.4002 13.6C10.7533 13.6 11.8502 12.503 11.8502 11.15C11.8502 9.79685 10.7533 8.69995 9.4002 8.69995C8.0471 8.69995 6.9502 9.79685 6.9502 11.15C6.9502 12.503 8.0471 13.6 9.4002 13.6Z"
												stroke="#5169F1" stroke-width="1.5" stroke-miterlimit="10"
												stroke-linecap="round" stroke-linejoin="round" />
										</svg>
									</span>
									<?php esc_html_e('Filter', 'edcare'); ?>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="tp-filter-dropdown-area tp-filter-dropdown-wrapper">
					<div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1">
						<div class="col">
							<h4 class="tp-filter-widget-title"><?php esc_html_e('Sort by', 'edcare'); ?></h4>
							<div class="tp-filter-widget-content">
								<div class="tp-filter-widget-radio">
									<ul>
										<li>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="course_order"
													id="newest_first" value="newest_first" <?php checked('newest_first', $sort_by); ?>>
												<label class="form-check-label"
													for="newest_first"><?php esc_html_e('Latest', 'edcare'); ?></label>
											</div>
										</li>
										<li>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="course_order"
													id="oldest_first" value="oldest_first" <?php checked('oldest_first', $sort_by); ?>>
												<label class="form-check-label"
													for="oldest_first"><?php esc_html_e('Oldest', 'edcare'); ?></label>
											</div>
										</li>
										<li>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="course_order"
													id="course_title_az" value="course_title_az" <?php checked('course_title_az', $sort_by); ?>>
												<label class="form-check-label"
													for="course_title_az"><?php esc_html_e('Course Title (a-z)', 'edcare'); ?></label>
											</div>
										</li>
										<li>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="course_order"
													id="course_title_za" value="course_title_za" <?php checked('course_title_za', $sort_by); ?>>
												<label class="form-check-label"
													for="course_title_za"><?php esc_html_e('Course Title (z-a)', 'edcare'); ?></label>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<?php if (in_array('category', $supported_filters)): ?>
							<div class="col">
								<h4 class="tp-filter-widget-title"><?php esc_html_e('All Categories', 'edcare'); ?></h4>
								<div class="tp-filter-widget-content">
									<div class="tp-filter-widget-checkbox">
										<ul>
											<?php $filter_object->render_terms('category'); ?>
										</ul>
									</div>
								</div>
							</div>
						<?php endif; ?>


						<div class="col">
							<h4 class="tp-filter-widget-title"><?php esc_html_e('Instructors', 'edcare'); ?></h4>
							<div class="tp-filter-widget-content">
								<div class="tp-filter-widget-checkbox">
									<ul>
										<?php foreach ($instructor_list as $value => $instructor): ?>
											<li class="tutor-list-item">
												<label>
													<input type="checkbox" class=""
														id="<?php echo esc_html($instructor->ID); ?>"
														name="tutor-course-filter-instructor"
														value="<?php echo esc_html($instructor->ID); ?>" />
													<?php echo edcare_kses($instructor->display_name); ?>
												</label>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>


						<div class="col">
							<h4 class="tp-filter-widget-title"><?php esc_html_e('Price', 'edcare'); ?></h4>
							<div class="tp-filter-widget-content">
								<div class="tp-filter-widget-checkbox">
									<ul>
										<?php foreach ($filter_prices as $value => $course_title): ?>
											<li class="tutor-list-item">
												<label>
													<input type="checkbox" class="" id="<?php echo esc_html($value); ?>"
														name="tutor-course-filter-price"
														value="<?php echo esc_html($value); ?>" />
													<?php echo esc_html($course_title); ?>
												</label>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>

						<?php if (in_array('difficulty_level', $supported_filters)): ?>
							<div class="col">
								<h4 class="tp-filter-widget-title"><?php esc_html_e('Level', 'edcare'); ?></h4>
								<div class="tp-filter-widget-content">
									<div class="tp-filter-widget-checkbox">
										<ul>
											<?php
											$key = '';
											foreach ($course_levels as $value => $course_title):
												if ('all_levels' == $key) {
													continue;
												}
												?>
												<li class="tutor-list-item">
													<label>
														<input type="checkbox" class="" id="<?php echo esc_html($value); ?>"
															name="tutor-course-filter-level"
															value="<?php echo esc_html($value); ?>" />
														<?php echo esc_html($course_title); ?>
													</label>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</form>
	</div>

<?php elseif ($filter_style == 'style_2'): ?>

	<div class="edcare-course-filter-style-2" tutor-course-filter>
		<form>
			<div class="tp-course-grid-wrap p-relative mb-45">
				<div class="row">
					<div class="col-lg-6">
						<div class="tp-course-filter-top-left d-flex align-items-center">
							<?php if ($view_switcher): ?>
								<div class="tp-course-filter-top-tab tp-tab">
									<ul class="nav nav-tabs" id="filterTab" role="tablist">
										<li class="nav-item " role="presentation">
											<button class="nav-link <?php echo esc_attr($grid_tab_active); ?>"
												id="courseGrid-tab" data-bs-toggle="tab" data-bs-target="#courseGrid"
												type="button" role="tab" aria-controls="courseGrid" aria-selected="true">
												<svg width="14" height="14" viewBox="0 0 14 14" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M5.66667 1H1V5.66667H5.66667V1Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M12.9997 1H8.33301V5.66667H12.9997V1Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M5.66667 8.33337H1V13H5.66667V8.33337Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
												</svg>
												<?php esc_html_e('Grid', 'edcare'); ?>
											</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link <?php echo esc_attr($list_tab_active); ?>"
												id="courseList-tab" data-bs-toggle="tab" data-bs-target="#courseList"
												type="button" role="tab" aria-controls="courseList" aria-selected="false">
												<svg width="14" height="14" viewBox="0 0 16 15" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M15 7.11108H1" stroke="#031F42" stroke-width="1"
														stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M15 1H1" stroke="#031F42" stroke-width="1" stroke-linecap="round"
														stroke-linejoin="round"></path>
													<path d="M15 13.2222H1" stroke="#031F42" stroke-width="1"
														stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<?php esc_html_e('List', 'edcare'); ?>
											</button>
										</li>
									</ul>
								</div>
							<?php endif; ?>

							<?php if (!empty($course_found_text)): ?>
								<div class="tp-course-filter-top-result">
									<p><?php echo edcare_kses($course_found_text); ?></p>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div
							class="tp-course-filter-top-right d-flex align-items-center justify-content-start justify-content-lg-end">
							<div class="tp-course-filter-top-right-search d-none d-lg-block">
								<input type="search" name="keyword"
									placeholder="<?php esc_attr_e('Search Courses...', 'edcare'); ?>">
								<button class="tp-course-filter-top-right-search-btn" type="button">
									<span>
										<svg width="17" height="17" viewBox="0 0 17 17" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M12.625 12.625L16 16" stroke="#8B8B8B" stroke-width="1.5"
												stroke-linecap="round" stroke-linejoin="round"></path>
											<path
												d="M14.5 7.75C14.5 4.02208 11.4779 1 7.75 1C4.02208 1 1 4.02208 1 7.75C1 11.4779 4.02208 14.5 7.75 14.5C11.4779 14.5 14.5 11.4779 14.5 7.75Z"
												stroke="#8B8B8B" stroke-width="1.5" stroke-linejoin="round"></path>
										</svg>
									</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="edcare-course-filter-select">
				<div class="tp-course-grid-categories d-flex">
					<div class="tp-course-grid-select">
						<p><?php esc_html_e('SHORT BY', 'edcare'); ?></p>
						<select class="wide" name="course_order">
							<option value="newest_first" <?php selected('newest_first', $sort_by); ?>>
								<?php esc_html_e('Latest', 'edcare'); ?>
							</option>
							<option value="oldest_first" <?php selected('oldest_first', $sort_by); ?>>
								<?php esc_html_e('Oldest', 'edcare'); ?>
							</option>
							<option value="course_title_az" <?php selected('course_title_az', $sort_by); ?>>
								<?php esc_html_e('Course Title (a-z)', 'edcare'); ?>
							</option>
							<option value="course_title_za" <?php selected('course_title_za', $sort_by); ?>>
								<?php esc_html_e('Course Title (z-a)', 'edcare'); ?>
							</option>
						</select>
					</div>

					<?php if (in_array('category', $supported_filters)): ?>
						<div class="tp-course-grid-select">
							<p><?php esc_html_e('SHORT BY CATEGORY', 'edcare'); ?></p>
							<select class="wide" name="tutor-course-filter-category">
								<option disabled selected><?php esc_html_e('Select Category', 'edcare'); ?></option>
								<?php foreach ($course_categories as $value => $term):
									$match_key = isset($_GET['tutor-course-filter-category']) ? $_GET['tutor-course-filter-category'] : '';
									?>
									<option value="<?php echo esc_attr($term->term_id); ?>" <?php selected($match_key, $term->term_id); ?>><?php echo esc_html($term->name); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>


					<div class="tp-course-grid-select">

						<p><?php esc_html_e('SHORT BY AUTHOR', 'edcare'); ?></p>
						<select class="wide" name="tutor-course-filter-instructor">
							<option disabled selected><?php esc_html_e('Select Author', 'edcare'); ?></option>
							<?php foreach ($instructor_list as $value => $instructor):
								$match_key = isset($_GET['tutor-course-filter-instructor']) ? $_GET['tutor-course-filter-instructor'] : '';
								?>
								<option value="<?php echo esc_attr($instructor->ID); ?>" <?php selected($match_key, $instructor->ID); ?>><?php echo esc_html($instructor->display_name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="tp-course-grid-select">
						<p><?php esc_html_e('SHORT BY PRICE', 'edcare'); ?></p>
						<select class="wide" name="tutor-course-filter-price">
							<option disabled selected><?php esc_html_e('Select Price', 'edcare'); ?></option>
							<?php foreach ($filter_prices as $value => $price_title):
								$match_key = isset($_GET['tutor-course-filter-price']) ? $_GET['tutor-course-filter-price'] : '';
								?>
								<option value="<?php echo esc_attr($value); ?>" <?php selected($match_key, $value); ?>>
									<?php echo esc_html($price_title); ?>
								</option>
							<?php endforeach; ?>

						</select>
					</div>
				</div>
			</div>
		</form>
	</div>

<?php elseif ($filter_style == 'style_3'): ?>


	<div class="edcare-filter-style-3 mb-70" tutor-course-filter>
		<form>
			<div class="tp-course-grid-wrap p-relative mb-45">
				<div class="row">
					<div class="col-xl-6 col-12">
						<div class="tp-course-filter-top-left d-flex align-items-center mb-15">
							<?php if ($view_switcher): ?>
								<div class="tp-course-filter-top-tab tp-tab">
									<ul class="nav nav-tabs" id="filterTab" role="tablist">
										<li class="nav-item " role="presentation">
											<button class="nav-link <?php echo esc_attr($grid_tab_active); ?>"
												id="courseGrid-tab" data-bs-toggle="tab" data-bs-target="#courseGrid"
												type="button" role="tab" aria-controls="courseGrid" aria-selected="true">
												<svg width="14" height="14" viewBox="0 0 14 14" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M5.66667 1H1V5.66667H5.66667V1Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M12.9997 1H8.33301V5.66667H12.9997V1Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
													<path d="M5.66667 8.33337H1V13H5.66667V8.33337Z" stroke="#031F42"
														stroke-linecap="round" stroke-linejoin="round" />
												</svg>
												<?php esc_html_e('Grid', 'edcare'); ?>
											</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link <?php echo esc_attr($list_tab_active); ?>"
												id="courseList-tab" data-bs-toggle="tab" data-bs-target="#courseList"
												type="button" role="tab" aria-controls="courseList" aria-selected="false">
												<svg width="14" height="14" viewBox="0 0 16 15" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M15 7.11108H1" stroke="#031F42" stroke-width="1"
														stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M15 1H1" stroke="#031F42" stroke-width="1" stroke-linecap="round"
														stroke-linejoin="round"></path>
													<path d="M15 13.2222H1" stroke="#031F42" stroke-width="1"
														stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<?php esc_html_e('List', 'edcare'); ?>
											</button>
										</li>
									</ul>
								</div>
							<?php endif; ?>

							<?php if (!empty($course_found_text)): ?>
								<div class="tp-course-filter-top-result">
									<p><?php echo edcare_kses($course_found_text); ?></p>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-xl-6 col-12">
						<div
							class="tp-course-filter-top-right d-flex align-items-center justify-content-start justify-content-xl-end mb-15">
							<div class="tp-course-filter-top-right-search d-none d-lg-block">
								<input type="search" name="keyword"
									placeholder="<?php esc_attr_e('Search Courses...', 'edcare'); ?>">
								<button class="tp-course-filter-top-right-search-btn" type="button">
									<span>
										<svg width="17" height="17" viewBox="0 0 17 17" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M12.625 12.625L16 16" stroke="#8B8B8B" stroke-width="1.5"
												stroke-linecap="round" stroke-linejoin="round"></path>
											<path
												d="M14.5 7.75C14.5 4.02208 11.4779 1 7.75 1C4.02208 1 1 4.02208 1 7.75C1 11.4779 4.02208 14.5 7.75 14.5C11.4779 14.5 14.5 11.4779 14.5 7.75Z"
												stroke="#8B8B8B" stroke-width="1.5" stroke-linejoin="round"></path>
										</svg>
									</span>
								</button>
							</div>
							<div class="tp-course-filter-select">
								<select class="wide" name="course_order">
									<option value="newest_first" <?php selected('newest_first', $sort_by); ?>>
										<?php esc_html_e('Shor by: Latest', 'edcare'); ?>
									</option>
									<option value="oldest_first" <?php selected('oldest_first', $sort_by); ?>>
										<?php esc_html_e('Shor by: Oldest', 'edcare'); ?>
									</option>
									<option value="course_title_az" <?php selected('course_title_az', $sort_by); ?>>
										<?php esc_html_e('Course Title (a-z)', 'edcare'); ?>
									</option>
									<option value="course_title_za" <?php selected('course_title_za', $sort_by); ?>>
										<?php esc_html_e('Course Title (z-a)', 'edcare'); ?>
									</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php if (in_array('category', $supported_filters)): ?>
				<div class="edcare-filter-with-cat-btn">
					<form>
						<ul class="d-flex flex-wrap">
							<?php $filter_object->render_terms('category'); ?>
						</ul>
					</form>
				</div>
			<?php endif; ?>
		</form>
	</div>


<?php else: ?>
	<div class="d-md-flex align-items-center">
		<?php if ($view_switcher): ?>
			<div class="tp-course-grid-sidebar-tab tp-tab me-2">
				<ul class="nav nav-tabs flex-nowrap flex-xl-wrap" id="filterTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link  <?php echo esc_attr($grid_tab_active); ?>" id="courseGrid-tab"
							data-bs-toggle="tab" data-bs-target="#courseGrid" type="button" role="tab"
							aria-controls="courseGrid" aria-selected="true">
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5.66667 1H1V5.66667H5.66667V1Z" stroke="currentColor" stroke-linecap="round"
									stroke-linejoin="round" />
								<path d="M12.9997 1H8.33301V5.66667H12.9997V1Z" stroke="currentColor" stroke-linecap="round"
									stroke-linejoin="round" />
								<path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z" stroke="currentColor"
									stroke-linecap="round" stroke-linejoin="round" />
								<path d="M5.66667 8.33337H1V13H5.66667V8.33337Z" stroke="currentColor" stroke-linecap="round"
									stroke-linejoin="round" />
							</svg>
						</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link <?php echo esc_attr($list_tab_active); ?>" id="courseList-tab"
							data-bs-toggle="tab" data-bs-target="#courseList" type="button" role="tab"
							aria-controls="courseList" aria-selected="false">
							<svg width="14" height="14" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M15 7.11108H1" stroke="currentColor" stroke-width="1" stroke-linecap="round"
									stroke-linejoin="round"></path>
								<path d="M15 1H1" stroke="currentColor" stroke-width="1" stroke-linecap="round"
									stroke-linejoin="round"></path>
								<path d="M15 13.2222H1" stroke="currentColor" stroke-width="1" stroke-linecap="round"
									stroke-linejoin="round"></path>
							</svg>
						</button>
					</li>
				</ul>
			</div>
		<?php endif; ?>
		<?php if (!empty($course_found_text)): ?>
			<p class="m-0 d-inline-block"><?php echo edcare_kses($course_found_text); ?></p>
		<?php endif; ?>
	</div>


	<div class="tp-course-grid-sidebar-right d-none d-lg-flex justify-content-start justify-content-lg-end"
		tutor-course-filter>
		<div class="tp-course-grid-select tp-course-grid-sidebar-select">
			<form>
				<select class="wide" name="course_order">
					<option value="newest_first" <?php selected('newest_first', $sort_by); ?>>
						<?php esc_html_e('Shor by: Latest', 'edcare'); ?>
					</option>
					<option value="oldest_first" <?php selected('oldest_first', $sort_by); ?>>
						<?php esc_html_e('Shor by: Oldest', 'edcare'); ?>
					</option>
					<option value="course_title_az" <?php selected('course_title_az', $sort_by); ?>>
						<?php esc_html_e('Course Title (a-z)', 'edcare'); ?>
					</option>
					<option value="course_title_za" <?php selected('course_title_za', $sort_by); ?>>
						<?php esc_html_e('Course Title (z-a)', 'edcare'); ?>
					</option>
				</select>
			</form>
		</div>
	</div>


	<a href="javascript:void(0);" class="d-lg-none edcare-archive-filter-btn" tutor-toggle-course-filter>
		<span>
			<svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M14.9998 3.44995H10.7998" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
					stroke-linecap="round" stroke-linejoin="round"></path>
				<path d="M3.8 3.44995H1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
					stroke-linecap="round" stroke-linejoin="round"></path>
				<path
					d="M6.60039 5.9C7.95349 5.9 9.05039 4.8031 9.05039 3.45C9.05039 2.0969 7.95349 1 6.60039 1C5.24729 1 4.15039 2.0969 4.15039 3.45C4.15039 4.8031 5.24729 5.9 6.60039 5.9Z"
					stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
					stroke-linejoin="round"></path>
				<path d="M15.0002 11.15H12.2002" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
					stroke-linecap="round" stroke-linejoin="round"></path>
				<path d="M5.2 11.15H1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
					stroke-linecap="round" stroke-linejoin="round"></path>
				<path
					d="M9.4002 13.6C10.7533 13.6 11.8502 12.503 11.8502 11.15C11.8502 9.79685 10.7533 8.69995 9.4002 8.69995C8.0471 8.69995 6.9502 9.79685 6.9502 11.15C6.9502 12.503 8.0471 13.6 9.4002 13.6Z"
					stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
					stroke-linejoin="round"></path>
			</svg>
		</span>
		<?php esc_html_e('Filter', 'edcare'); ?>
	</a>
<?php endif; ?>