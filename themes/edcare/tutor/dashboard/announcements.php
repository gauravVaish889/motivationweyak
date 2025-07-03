<?php
/**
 * Template for displaying Announcements
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.7.9
 */

use TUTOR\Input;
use Tutor\Models\CourseModel;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$per_page = tutor_utils()->get_option( 'pagination_per_page', 10 );
$paged    = max( 1, Input::get( 'current_page', 1, Input::TYPE_INT ) );

$order_filter  = Input::get( 'order', 'DESC' );
$search_filter = Input::get( 'search', '' );

// Announcement's parent.
$course_id   = Input::get( 'course-id', '' );
$date_filter = Input::get( 'date', '' );

$year  = date( 'Y', strtotime( $date_filter ) );
$month = date( 'm', strtotime( $date_filter ) );
$day   = date( 'd', strtotime( $date_filter ) );

$args = array(
	'post_type'      => 'tutor_announcements',
	'post_status'    => 'publish',
	's'              => sanitize_text_field( $search_filter ),
	'post_parent'    => sanitize_text_field( $course_id ),
	'posts_per_page' => sanitize_text_field( $per_page ),
	'paged'          => sanitize_text_field( $paged ),
	'orderBy'        => 'ID',
	'order'          => sanitize_text_field( $order_filter ),

);
if ( ! empty( $date_filter ) ) {
	$args['date_query'] = array(
		array(
			'year'  => $year,
			'month' => $month,
			'day'   => $day,
		),
	);
}
if ( ! current_user_can( 'administrator' ) ) {
	$args['author'] = get_current_user_id();
}
$the_query = new WP_Query( $args );

// Get courses.
$courses    = ( current_user_can( 'administrator' ) ) ? CourseModel::get_courses() : CourseModel::get_courses_by_instructor();
$image_base = tutor()->url . '/assets/images/';
?>
<div class="tp-dashboard-section">
	<h2 class="tp-dashboard-title"><?php esc_html_e('Announcements', 'edcare'); ?></h2>
</div>

<div class="tpd-announcement tpd-common-shadow d-flex align-items-center justify-content-between mb-70">
	<div class="tpd-announcement-info d-flex align-items-center">
		<div class="tpd-announcement-icon">
			<span>
				<svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19.5619 14.4481L18.2422 12.1865C17.9502 11.6932 17.6933 10.7429 17.6933 10.1654V7.91579C17.6933 3.54887 14.248 0 10.0202 0C5.78079 0.0120301 2.33551 3.54887 2.33551 7.91579V10.1534C2.33551 10.7308 2.07858 11.6812 1.79828 12.1744L0.478569 14.4361C-0.0236228 15.3143 -0.140412 16.3128 0.174918 17.1789C0.490248 18.0571 1.20266 18.7549 2.13697 19.0677C3.39829 19.5007 4.67129 19.8135 5.96765 20.0421C6.09612 20.0662 6.22458 20.0782 6.35305 20.1023C6.51655 20.1263 6.69174 20.1504 6.86692 20.1744C7.17057 20.2226 7.47422 20.2586 7.78955 20.2827C8.52532 20.3549 9.27277 20.391 10.0202 20.391C10.756 20.391 11.4918 20.3549 12.2159 20.2827C12.4845 20.2586 12.7531 20.2346 13.01 20.1985C13.2202 20.1744 13.4305 20.1504 13.6407 20.1143C13.7691 20.1023 13.8976 20.0782 14.0261 20.0541C15.3341 19.8376 16.6305 19.5007 17.8918 19.0677C18.7911 18.7549 19.4801 18.0571 19.8071 17.1669C20.1341 16.2647 20.0407 15.2782 19.5619 14.4481ZM10.8728 9.56391C10.8728 10.0692 10.4757 10.4782 9.98518 10.4782C9.49467 10.4782 9.09759 10.0692 9.09759 9.56391V5.83459C9.09759 5.32932 9.49467 4.9203 9.98518 4.9203C10.4757 4.9203 10.8728 5.32932 10.8728 5.83459V9.56391Z" fill="#07A698"/>
					<path d="M13.2978 21.6063C12.8073 23.0018 11.5109 24.0003 9.99267 24.0003C9.07003 24.0003 8.15908 23.6153 7.51674 22.9296C7.14302 22.5687 6.86272 22.0875 6.69922 21.5942C6.85104 21.6183 7.00287 21.6303 7.16637 21.6544C7.43499 21.6905 7.71528 21.7266 7.99557 21.7506C8.66127 21.8108 9.33865 21.8469 10.016 21.8469C10.6817 21.8469 11.3474 21.8108 12.0014 21.7506C12.2467 21.7266 12.4919 21.7145 12.7255 21.6784C12.9124 21.6544 13.0992 21.6303 13.2978 21.6063Z" fill="#07A698"/>
				</svg>
			</span>
		</div>
		<div class="tpd-announcement-notification">
			<span><?php esc_html_e( 'Create Announcement', 'edcare' ); ?></span>
			<h4 class="tpd-announcement-notification-title"><?php esc_html_e( 'Notify all students of your course', 'edcare' ); ?></h4>
		</div>
	</div>
	<div class="text-lg-end">
		<button class="tpd-border-btn active" type="button" data-tutor-modal-target="tutor_announcement_new"><?php esc_html_e( 'Add New Announcement', 'edcare' ); ?></button>
	</div>
</div>



<div class="tutor-row tutor-mb-32 tutor-mt-44" style="width: calc(100% + 30px);">
	<div class="tutor-col-12 tutor-col-lg-6 tutor-mt-12 tutor-mt-lg-0">
		<label class="tutor-d-block tutor-mb-12 tutor-form-label">
			<?php esc_html_e( 'Courses', 'edcare' ); ?>
		</label>
		<select class="tutor-form-select tutor-announcement-course-sorting">
			<option value=""><?php esc_html_e( 'All', 'edcare' ); ?></option>
			<?php if ( $courses ) : ?>
				<?php foreach ( $courses as $course ) : ?>
					<option value="<?php echo esc_attr( $course->ID ); ?>" <?php selected( $course_id, $course->ID, 'selected' ); ?>>
						<?php echo esc_html( $course->post_title ); ?>
					</option>
				<?php endforeach; ?>
			<?php else : ?>
				<option value=""><?php esc_html_e( 'No course found', 'edcare' ); ?></option>
			<?php endif; ?>
		</select>
	</div>

	<div class="tutor-col-6 tutor-col-lg-3 tutor-mt-12 tutor-mt-lg-0">
		<label class="tutor-d-block tutor-mb-12 tutor-form-label"><?php esc_html_e( 'Sort By', 'edcare' ); ?></label>
		<select class="tutor-form-select tutor-announcement-order-sorting tutor-form-control-sm" data-search="no">
			<option <?php selected( $order_filter, 'ASC' ); ?>><?php esc_html_e( 'ASC', 'edcare' ); ?></option>
			<option <?php selected( $order_filter, 'DESC' ); ?>><?php esc_html_e( 'DESC', 'edcare' ); ?></option>
		</select>
	</div>

	<div class="tutor-col-6 tutor-col-lg-3 tutor-mt-12 tutor-mt-lg-0">
		<label class="tutor-form-label tutor-d-block tutor-mb-12"><?php esc_html_e( 'Date', 'edcare' ); ?></label>
		<div class="tutor-v2-date-picker"></div>
	</div>
</div>

<?php
$announcements = $the_query->have_posts() ? $the_query->posts : array();

tutor_load_template_from_custom_path(
	get_template_directory(). '/tutor/views/fragments/announcement-list.php',
	array(
		'announcements' => is_array( $announcements ) ? $announcements : array(),
		'the_query'     => $the_query,
		'paged'         => $paged,
	)
);
?>
