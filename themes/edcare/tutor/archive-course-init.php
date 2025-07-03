<?php
/**
 * Template for course archive init
 *
 * @package Tutor\Templates
 * @subpackage CourseArchive
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

use TUTOR\Input;

!isset($course_filter) ? $course_filter = false : 0;
!isset($supported_filters) ? $supported_filters = tutor_utils()->get_option('supported_course_filters', array()) : 0;
!isset($loop_content_only) ? $loop_content_only = false : 0;
!isset($column_per_row) ? $column_per_row = tutor_utils()->get_option('courses_col_per_row', 3) : 0;
!isset($course_per_page) ? $course_per_page = tutor_utils()->get_option('courses_per_page', 12) : 0;
!isset($show_pagination) ? $show_pagination = true : 0;
!isset($current_page) ? $current_page = 1 : 0;

// Hide pagination is there is no page after first one.
$pages_count = 0;
if (isset($the_query)) {
	$pages_count = $the_query->max_num_pages;
} else {
	global $wp_query;
	$pages_count = $wp_query->max_num_pages;
}
$pages_count < 2 ? $show_pagination = false : 0;

// Set in global variable to avoid too many stack to pass to other templates.
$GLOBALS['tutor_course_archive_arg'] = compact(
	'course_filter',
	'supported_filters',
	'loop_content_only',
	'column_per_row',
	'course_per_page',
	'show_pagination'
);

$course_archive_arg = isset($GLOBALS['tutor_course_archive_arg']) ? $GLOBALS['tutor_course_archive_arg']['column_per_row'] : null;
$columns_from_tutor = $course_archive_arg === null ? tutor_utils()->get_option('courses_col_per_row', 3) : $course_archive_arg;


// options from for demo showcase
$filter_style_demo = isset($_GET['filter']) && !empty($_GET['filter']) ? $_GET['filter'] : false;

if ($filter_style_demo) {
	$filter_style = $filter_style_demo;
} else {
	$filter_style = get_theme_mod('edcare_lms_filter_style', 'sidebar'); // code from customizer
}


// course loop

$course_archive_arg = isset($GLOBALS['tutor_course_archive_arg']) ? $GLOBALS['tutor_course_archive_arg']['column_per_row'] : null;
$columns_from_tutor = $course_archive_arg === null ? tutor_utils()->get_option('courses_col_per_row', 3) : $course_archive_arg;

// codes from customizer

// option from GET for demo show
$column_switcher_demo = isset($_GET['column']) ? true : false;


$column_switcher = $column_switcher_demo ?? get_theme_mod('edcare_lms_col_switch', false);


$col_xl = isset($_GET['col_xl']) && !empty($_GET['col_xl']) && $column_switcher ? $_GET['col_xl'] : get_theme_mod('edcare_lms_column_xl', 3);
$col_lg = isset($_GET['col_lg']) && !empty($_GET['col_lg']) && $column_switcher ? $_GET['col_lg'] : get_theme_mod('edcare_lms_column_lg', 3);
$col_md = isset($_GET['col_md']) && !empty($_GET['col_md']) && $column_switcher ? $_GET['col_md'] : get_theme_mod('edcare_lms_column_md', 2);
$col_sm = isset($_GET['col_sm']) && !empty($_GET['col_sm']) && $column_switcher ? $_GET['col_sm'] : get_theme_mod('edcare_lms_column_sm', 1);
$col_xs = isset($_GET['col_xs']) && !empty($_GET['col_xs']) && $column_switcher ? $_GET['col_xs'] : get_theme_mod('edcare_lms_column_xs', 1);



$columns = $column_switcher ? " row-cols-xl-$col_xl row-cols-lg-$col_lg row-cols-md-$col_md row-cols-sm-$col_sm row-cols-$col_xs" : " row-cols-xl-$columns_from_tutor";


// option from GET for demo show
$view_switcher_demo = isset($_GET['view_switcher']) && !empty($_GET['view_switcher']) ? true : false;

if ($view_switcher_demo) {
	$view_switcher_demo_value = $_GET['view_switcher'] == 'false' ? false : true;
	$view_switcher = $view_switcher_demo_value;
} else {
	$view_switcher = get_theme_mod('edcare_lms_view_style_switch', true);
}

$view_style = isset($_GET['view_style']) && !empty($_GET['view_style']) ? $_GET['view_style'] : get_theme_mod('edcare_lms_view_style', 'grid');
$view_style_grid = isset($_GET['grid_view']) && !empty($_GET['grid_view']) ? $_GET['grid_view'] : get_theme_mod('edcare_lms_grid_view_style', 'grid_default');


$grid_tab_active = ($view_style == 'grid' || $view_style == 'grid_list') ? ' show active ' : '';
$list_tab_active = ($view_style == 'list') ? ' show active ' : '';

$archive_grid = isset($_GET['archive_layout']) && !empty($_GET['archive_layout']) ? $_GET['archive_layout'] : get_theme_mod('edcare_lms_archive_style', 'archive_grid');


$lms_card_style = $view_style_grid;

$have_posts = (isset($the_query) && $the_query->have_posts()) || have_posts();

ob_start();
do_action('tutor_course/archive/before_loop'); ?>

<?php if ($view_switcher): ?>
	<div class="tab-pane fade <?php echo esc_attr($grid_tab_active); ?>" id="courseGrid" role="tabpanel"
		aria-labelledby="courseGrid-tab">
		<div class="tp-grid-sidebar-right">

			<?php if ($view_style_grid == 'grid_default' || $view_style_grid == 'grid_gym' || $view_style_grid == 'grid_school'): ?>

				<?php if ($have_posts): ?>
					<div class="row <?php echo esc_attr($columns); ?>">

						<?php
						if ($lms_card_style == 'grid_gym') {
							edcare_lms_layout('loop.course-card-gym');
						} elseif ($lms_card_style == 'grid_school') {
							edcare_lms_layout('loop.course-card-school');
						} else {
							edcare_lms_layout('loop.course');
						}
						?>
					</div>
				<?php else: ?>
					<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
				<?php endif; // end query ?>

			<?php else: ?>

				<?php if ($have_posts): ?>
					<div class="row row-cols-1 row-cols-lg-2">
						<?php edcare_lms_layout('loop.course-list-grid'); ?>
					</div>
				<?php else: ?>
					<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
				<?php endif; // end query ?>

			<?php endif; // grid style endif ?>
		</div>
	</div>

	<div class="tab-pane fade <?php echo esc_attr($list_tab_active); ?>" id="courseList" role="tabpanel"
		aria-labelledby="courseList-tab">
		<div class="tp-list-sidebar-right">
			<div class="edcare-course-list-card-wrapper">


				<?php if ($have_posts): ?>
					<?php edcare_lms_layout('loop.course-list'); ?>
				<?php else: ?>
					<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
				<?php endif; // end query ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php

function edcare_get_archive_lms_layout($layout)
{

	if ($layout == 'archive_list_grid') {
		return edcare_lms_layout('loop.course-list-grid');
	} elseif ($layout == 'archive_list') {
		return edcare_lms_layout('loop.course-list');
	} elseif ($layout == 'archive_gym') {
		edcare_lms_layout('loop.course-card-gym');
	} elseif ($layout == 'archive_school') {
		edcare_lms_layout('loop.course-card-school');
	} else {
		return edcare_lms_layout('loop.course');
	}

}

?>

<?php if ($view_switcher == false): ?>

	<?php
	if ($have_posts): ?>

		<div class="row <?php echo esc_attr($columns); ?>">
			<?php edcare_get_archive_lms_layout($archive_grid); ?>
		</div>

		<?php
	else:
		tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text());
	endif;

	?>

<?php endif; // view switcher end ?>

<?php
do_action('tutor_course/archive/after_loop');


if ($show_pagination) {
	global $wp_query;

	$current_url = wp_doing_ajax() ? sanitize_text_field(wp_get_raw_referer()) : tutor()->current_url;

	$push_link = add_query_arg(array_merge($_POST, $GLOBALS['tutor_course_archive_arg']), $current_url);

	$data = wp_doing_ajax() ? Input::sanitize_array($_POST) : Input::sanitize_array($_GET);
	$pagination_data = array(
		'total_page' => isset($the_query) ? $the_query->max_num_pages : $wp_query->max_num_pages,
		'per_page' => $course_per_page,
		'paged' => $current_page,
		'data_set' => array('push_state_link' => $push_link),
		'ajax' => array_merge(
			$data,
			array(
				'loading_container' => '.tutor-course-filter-loop-container',
				'action' => 'tutor_course_filter_ajax',
				'course_per_page' => $course_per_page,
				'column_per_row' => $column_per_row,
			)
		),
	);

	tutor_load_template_from_custom_path(get_template_directory() . '/tutor/dashboard/elements/pagination.php', $pagination_data);
}

$course_loop = ob_get_clean();

if (isset($loop_content_only) && true == $loop_content_only) {
	echo edcare_kses($course_loop); //phpcs:ignore --$course_loop contain sanitized data
	return;
}


$course_archive_arg = isset($GLOBALS['tutor_course_archive_arg']) ? $GLOBALS['tutor_course_archive_arg']['column_per_row'] : null;
$columns = null === $course_archive_arg ? tutor_utils()->get_option('courses_col_per_row', 3) : $course_archive_arg;
$has_course_filters = $course_filter && count($supported_filters);

$supported_filters_keys = array_keys($supported_filters);

$wrapper_class = ' tutor-wrap tutor-wrap-parent tutor-courses-wrap course-archive-page container pb-90 p-relative ';

if ($filter_style == 'style_1') {
	$wrapper_class .= ' filter-style-space-1 filter-demo';
} elseif ($filter_style == 'style_2') {
	$wrapper_class .= ' filter-style-space-2 filter-demo';
} elseif ($filter_style == 'style_3') {
	$wrapper_class .= '  filter-style-space-3 filter-demo';
} else {
	$wrapper_class .= ' pt-120 pb-120 ';
}


$course_archive_top_class = ($filter_style == 'style_2' || $filter_style == 'style_3') ? '' : ' d-flex align-items-center justify-content-between flex-wrap gap-4';
?>

<div class="<?php echo esc_attr($wrapper_class); ?>"
	data-tutor_courses_meta="<?php echo esc_attr(json_encode($GLOBALS['tutor_course_archive_arg'])); ?>">
	<div class="container">
		<?php if ($has_course_filters && $filter_style == 'sidebar'): ?>
			<div class="row">
				<div class="col-lg-3">
					<div class="tutor-course-filter-container">
						<div class="tutor-course-filter" tutor-course-filter>
							<?php tutor_load_template('course-filter.filters'); ?>
						</div>
					</div>
				</div>


				<div class="col-lg-9">
					<div class="tp-course-archive-top d-flex align-items-center justify-content-between mb-40">
						<?php tutor_load_template('course-filter.course-archive-filter-bar'); ?>
					</div>

					<div class="tutor-pagination-wrapper-replaceable tab-content" tutor-course-list-container>
						<?php echo edcare_kses($course_loop); ?>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="row-col-12">
				<div class="tp-course-archive-top mb-55 <?php echo esc_attr($course_archive_top_class); ?>">
					<div class="tutor-course-filter-container d-lg-none">
						<div class="tutor-course-filter" tutor-course-filter>
							<?php tutor_load_template('course-filter.filters'); ?>
						</div>
					</div>
					<?php tutor_load_template('course-filter.course-archive-filter-bar'); ?>
				</div>
				<div class="tutor-pagination-wrapper-replaceable tab-content" tutor-course-list-container>
					<?php echo edcare_kses($course_loop); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>

</div>

<?php
if (!is_user_logged_in()) {
	tutor_load_template_from_custom_path(tutor()->path . '/views/modal/login.php');
}
?>