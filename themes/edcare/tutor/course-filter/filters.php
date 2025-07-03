<?php
/**
 * Template for course filter
 *
 * @package Tutor\Templates
 * @subpackage Course_Filter
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

$filter_object = new \TUTOR\Course_Filter();

$filter_prices = array(
	'free' => __('Free', 'edcare'),
	'paid' => __('Paid', 'edcare'),
);

$course_levels = tutor_utils()->course_levels();
$supported_filters = tutor_utils()->get_option('supported_course_filters', true);
$supported_filters = is_array($supported_filters) ? array_keys($supported_filters) : [];
$reset_link = remove_query_arg($supported_filters, get_pagenum_link());
$instructor_list = tutor_utils()->get_instructors();


?>

<form class="tutor-course-filter-form tutor-form">
	<div class="tutor-mb-16 tutor-d-block tutor-d-lg-none tutor-text-right">
		<a href="#" class="tutor-iconic-btn tutor-mr-n8" tutor-hide-course-filter><span class="tutor-icon-times"
				area-hidden="true"></span></a>
	</div>

	<?php do_action('tutor_course_filter/before'); ?>

	<?php if (in_array('search', $supported_filters)): ?>
		<div class="tp-course-grid-sidebar-search p-relative mb-40">
			<input type="search" name="keyword" placeholder="<?php esc_attr_e('Search Courses...', 'edcare'); ?>">
			<button class="tp-sidebar-search-btn" type="button">
				<span>
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M11.8496 11.85L14.9996 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
						<path
							d="M13.6 7.29998C13.6 3.8206 10.7794 1 7.29998 1C3.8206 1 1 3.8206 1 7.29998C1 10.7794 3.8206 13.6 7.29998 13.6C10.7794 13.6 13.6 10.7794 13.6 7.29998Z"
							stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
					</svg>
				</span>
			</button>
		</div>
	<?php endif; ?>

	<?php
	/**
	 * Add action before category filter.
	 *
	 * @since 2.2.0
	 */
	do_action('tutor_before_course_category_filter');
	?>
	<div class="tp-grid-widget-box">

		<?php if (in_array('category', $supported_filters)): ?>
			<div class="tp-grid-widget-item tutor-widget-course-categories">
				<h3 class="tp-grid-widget-title">
					<?php esc_html_e('Category', 'edcare'); ?>
				</h3>

				<div class="tp-grid-widget-content">
					<div class="tp-grid-widget-checkbox">
						<ul class="tutor-list">
							<?php $filter_object->render_terms('category'); ?>
						</ul>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if (in_array('tag', $supported_filters)): ?>
			<div class="tp-grid-widget-item tutor-widget-course-tags ">
				<h3 class="tp-grid-widget-title">
					<?php esc_html_e('Tag', 'edcare'); ?>
				</h3>

				<div class="tp-grid-widget-content">
					<div class="tp-grid-widget-checkbox">
						<ul class="tutor-list">
							<?php $filter_object->render_terms('tag'); ?>
						</ul>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if (in_array('difficulty_level', $supported_filters)): ?>
			<div class="tp-grid-widget-item tutor-widget-course-levels ">
				<h3 class="tp-grid-widget-title">
					<?php esc_html_e('Level', 'edcare'); ?>
				</h3>

				<div class="tp-grid-widget-content">
					<div class="tp-grid-widget-checkbox">
						<ul class="tutor-list">
							<?php
							$key = '';
							foreach ($course_levels as $value => $course_title):
								if ('all_levels' == $key) {
									continue;
								}
								?>
								<li class="tutor-list-item">
									<label>
										<input type="checkbox" class="tutor-form-check-input"
											id="<?php echo esc_html($value); ?>" name="tutor-course-filter-level"
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

		<?php
		$is_membership = get_tutor_option('monetize_by') == 'pmpro' && tutor_utils()->has_pmpro();
		if (!$is_membership && in_array('price_type', $supported_filters)):
			?>


			<?php
			/**
			 * Add action before price filter.
			 *
			 * @since 2.2.0
			 */
			do_action('tutor_before_course_price_filter');
			?>

			<div class="tp-grid-widget-item tutor-widget-course-price ">
				<h3 class="tp-grid-widget-title">
					<?php esc_html_e('Price', 'edcare'); ?>
				</h3>

				<div class="tp-grid-widget-content">
					<div class="tp-grid-widget-checkbox">
						<ul class="tutor-list">
							<?php foreach ($filter_prices as $value => $course_title): ?>
								<li class="tutor-list-item">
									<label>
										<input type="checkbox" class="tutor-form-check-input"
											id="<?php echo esc_html($value); ?>" name="tutor-course-filter-price"
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

		<div class="tp-grid-widget-item tutor-widget-course-price ">
			<h3 class="tp-grid-widget-title">
				<?php esc_html_e('Instructor', 'edcare'); ?>
			</h3>

			<div class="tp-grid-widget-content">
				<div class="tp-grid-widget-checkbox">
					<ul class="tutor-list">
						<?php foreach ($instructor_list as $value => $instructor): ?>
							<li class="tutor-list-item">
								<label>
									<input type="checkbox" class="tutor-form-check-input"
										id="<?php echo esc_html($instructor->ID); ?>" name="tutor-course-filter-instructor"
										value="<?php echo esc_html($instructor->ID); ?>" />
									<?php echo edcare_kses($instructor->display_name); ?>
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

	</div><!-- inner box end -->


	<div class="tp-grid-widget-btn tutor-widget-course-filter mt-15">
		<a href="javascript:void(0);" data-course-filter-reset="<?php echo esc_url($reset_link); ?>"
			action-tutor-clear-filter>
			<span>
				<svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M9 1L1 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
					<path d="M1 1L9 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>
			</span>
			<?php esc_html_e('Clear All Filters', 'edcare') ?>
		</a>
	</div>

	<?php do_action('tutor_course_filter/after'); ?>
</form>