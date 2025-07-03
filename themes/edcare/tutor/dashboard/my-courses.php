<?php
/**
 * My Courses Page
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

use TUTOR\Input;
use Tutor\Models\CourseModel;

// Get the user ID and active tab.
$current_user_id                     = get_current_user_id();
! isset( $active_tab ) ? $active_tab = 'my-courses' : 0;

// Map required course status according to page.
$status_map = array(
	'my-courses'                 => CourseModel::STATUS_PUBLISH,
	'my-courses/draft-courses'   => CourseModel::STATUS_DRAFT,
	'my-courses/pending-courses' => CourseModel::STATUS_PENDING,
);

// Set currently required course status fo rcurrent tab.
$status = isset( $status_map[ $active_tab ] ) ? $status_map[ $active_tab ] : CourseModel::STATUS_PUBLISH;

// Get counts for course tabs.
$count_map = array(
	'publish' => CourseModel::get_courses_by_instructor( $current_user_id, CourseModel::STATUS_PUBLISH, 0, 0, true ),
	'pending' => CourseModel::get_courses_by_instructor( $current_user_id, CourseModel::STATUS_PENDING, 0, 0, true ),
	'draft'   => CourseModel::get_courses_by_instructor( $current_user_id, CourseModel::STATUS_DRAFT, 0, 0, true ),
);

$course_archive_arg = isset( $GLOBALS['tutor_course_archive_arg'] ) ? $GLOBALS['tutor_course_archive_arg']['column_per_row'] : null;
$courseCols         = null === $course_archive_arg ? tutor_utils()->get_option( 'courses_col_per_row', 4 ) : $course_archive_arg;
$per_page           = tutor_utils()->get_option( 'courses_per_page', 10 );
$paged              = Input::get( 'current_page', 1, Input::TYPE_INT );
$offset             = $per_page * ( $paged - 1 );

$results = CourseModel::get_courses_by_instructor( $current_user_id, $status, $offset, $per_page );
?>

<div class="dashboader-area mb-30">
	<div class="tp-dashboard-tab">
		<h2 class="tp-dashboard-tab-title"><?php esc_html_e( 'My Courses', 'edcare' ); ?></h2>
		<div class="tp-dashboard-tab-list">
			<ul>
				<li>
					<a class="<?php echo esc_attr( 'my-courses' === $active_tab ? ' is-active' : '' ); ?>" href="<?php echo esc_url( tutor_utils()->get_tutor_dashboard_page_permalink( 'my-courses' ) ); ?>">
						<?php esc_html_e( 'Publish', 'edcare' ); ?>
						<span><?php echo esc_html( '(' . $count_map['publish'] . ')' ); ?></span>
					</a>
				</li>
				<li>
					<a class="<?php echo esc_attr( 'my-courses/pending-courses' === $active_tab ? ' is-active' : '' ); ?>" href="<?php echo esc_url( tutor_utils()->get_tutor_dashboard_page_permalink( 'my-courses/pending-courses' ) ); ?>">
						<?php esc_html_e( 'Pending', 'edcare' ); ?> 
						<span><?php echo esc_html( '(' . $count_map['pending'] . ')' ); ?></span>
					</a>
				</li>
				<li>
					<a class="<?php echo esc_attr( 'my-courses/draft-courses' === $active_tab ? ' is-active' : '' ); ?>" href="<?php echo esc_url( tutor_utils()->get_tutor_dashboard_page_permalink( 'my-courses/draft-courses' ) ); ?>">
						<?php esc_html_e( 'Draft', 'edcare' ); ?> 
						<span><?php echo esc_html( '(' . $count_map['draft'] . ')' ); ?></span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>



<?php if(! is_array( $results ) || ( ! count( $results ) && 1 == $paged )) : 
	tutor_utils()->tutor_empty_state( tutor_utils()->not_found_text() );	
?>

<?php else: ?>
<div class="course-area">
	<div class="row">
		<?php
			global $post;
			$tutor_nonce_value = wp_create_nonce( tutor()->nonce_action );
			foreach ( $results as $post ) :
			setup_postdata( $post );

			$avg_rating         = tutor_utils()->get_course_rating()->rating_avg;
			$tutor_course_img   = get_tutor_course_thumbnail_src();
			$id_string_delete   = 'tutor_my_courses_delete_' . $post->ID;
			$row_id             = 'tutor-dashboard-my-course-' . $post->ID;
			$course_duration    = get_tutor_course_duration_context( $post->ID, true );
			$course_students    = tutor_utils()->count_enrolled_users_by_course();
			$is_main_instructor = CourseModel::is_main_instructor( $post->ID );
		?>
		<div class="col-xl-4 col-md-6">
			<div class="tp-dashboard-course tp-dashboard-course-2 mb-25 tutor-mycourse-<?php the_ID(); ?>" id="<?php echo esc_attr( $row_id ); ?>" >

				<div class="tp-dashboard-course-thumb">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						<img src="<?php echo empty( $tutor_course_img ) ? esc_url( $placeholder_img ) : esc_url( $tutor_course_img ); ?>" alt="<?php the_title(); ?>">
					</a>
				</div>

				<div class="tp-dashboard-course-content">
					<?php if ( false === $is_main_instructor ) : ?>
					<div class="tutor-course-co-author-badge"><?php esc_html_e( 'Co-author', 'edcare' ); ?></div>
					<?php endif; ?>

					<div class="tp-dashboard-course-create-date mb-1">
						<span>
							<?php echo esc_html( get_the_date() ); ?> <?php echo esc_html( get_the_time() ); ?>
						</span>
					</div>
				
					
					<h4 class="tp-dashboard-course-title">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
					</h4>

					<?php if ( ! empty( $course_duration ) || ! empty( $course_students ) ) : ?>
					<div class="tp-dashboard-course-meta">
						<?php if ( ! empty( $course_duration ) ) : ?>
						<span>
							<span>
								<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</span>
							<?php echo edcare_kses($course_duration); ?>
						</span>
						<?php endif; ?>
						
						<span>
							<span>
								<svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</span>
							<?php echo edcare_kses($course_students); ?> <?php echo esc_html__(' Students', 'edcare') ?>
						</span>
					</div>
					<?php endif; ?>

					<div class="tp-dashboard-btn d-flex align-items-center justify-content-between">
						<div class="tp-course-pricing text-start">
							<div class="price">
							<?php
									$price = tutor_utils()->get_course_price();
								if ( null === $price ) : ?>
									<span class="lms-free"><?php esc_html_e( 'Free', 'edcare' ); ?></span>
									
								<?php else: 
									echo wp_kses_post( tutor_utils()->get_course_price() );
								endif;
								?>

							</div>
						</div>

						<div class="tp-course-action d-flex align-items-center">
							<div class="tpd-action-inexact-btn">
								<a href="<?php echo esc_url( tutor_utils()->course_edit_link( $post->ID ) ); ?>" class=" tutor-my-course-edit">
									<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.74422 2.63127C9.19134 2.14685 9.41489 1.90464 9.65245 1.76336C10.2256 1.42246 10.9315 1.41185 11.5142 1.73539C11.7557 1.86948 11.9862 2.10487 12.447 2.57566C12.9079 3.04644 13.1383 3.28183 13.2696 3.52856C13.5863 4.12387 13.5759 4.84487 13.2422 5.43042C13.1039 5.67309 12.8668 5.90146 12.3926 6.35821L6.75038 11.7926C5.85173 12.6581 5.4024 13.0909 4.84084 13.3102C4.27927 13.5296 3.66192 13.5134 2.42722 13.4811L2.25923 13.4768C1.88334 13.4669 1.6954 13.462 1.58615 13.338C1.4769 13.214 1.49182 13.0226 1.52165 12.6397L1.53785 12.4318C1.6218 11.3541 1.66378 10.8153 1.87422 10.3309C2.08466 9.84657 2.44766 9.45328 3.17366 8.6667L8.74422 2.63127Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
										<path d="M8.09375 2.69922L12.2938 6.89922" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
										<path d="M8.69531 13.5L13.4953 13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
									</svg>
								</a>
							</div>
							<div class="tpd-action-inexact-btn">
								<button class="click">
									<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 10.5C15.8284 10.5 16.5 9.82843 16.5 9C16.5 8.17157 15.8284 7.5 15 7.5C14.1716 7.5 13.5 8.17157 13.5 9C13.5 9.82843 14.1716 10.5 15 10.5Z" fill="currentColor"></path><path d="M15 16.5C15.8284 16.5 16.5 15.8284 16.5 15C16.5 14.1716 15.8284 13.5 15 13.5C14.1716 13.5 13.5 14.1716 13.5 15C13.5 15.8284 14.1716 16.5 15 16.5Z" fill="currentColor"></path><path d="M15 22.5C15.8284 22.5 16.5 21.8284 16.5 21C16.5 20.1716 15.8284 19.5 15 19.5C14.1716 19.5 13.5 20.1716 13.5 21C13.5 21.8284 14.1716 22.5 15 22.5Z" fill="currentColor"></path>
									</svg>
								</button>
								<div class="tpd-action-click-tooltip">

									<!-- Submit Action -->
									<?php if ( tutor()->has_pro && in_array( $post->post_status, array( CourseModel::STATUS_DRAFT ) ) ) : ?>
										<?php
										$params = http_build_query(
											array(
												'tutor_action' => 'update_course_status',
												'status' => CourseModel::STATUS_PENDING,
												'course_id' => $post->ID,
												tutor()->nonce => $tutor_nonce_value,
											)
										);
										?>
									<a class="tutor-dropdown-item" href="?<?php echo esc_attr( $params ); ?>">
										<i class="tutor-icon-share tutor-mr-8" area-hidden="true"></i>
										<span>
											<?php
											$can_publish_course = current_user_can( 'administrator' ) || (bool) tutor_utils()->get_option( 'instructor_can_publish_course' );
											if ( $can_publish_course ) {
												esc_html_e( 'Publish', 'edcare' );
											} else {
												esc_html_e( 'Submit', 'edcare' );
											}
											?>
										</span>
									</a>
									<?php endif; ?>
									<!-- # Submit Action -->

									<!-- Duplicate Action -->
									<?php if ( tutor()->has_pro && in_array( $post->post_status, array( CourseModel::STATUS_PUBLISH, CourseModel::STATUS_PENDING, CourseModel::STATUS_DRAFT ) ) ) : ?>
										<?php
										$params = http_build_query(
											array(
												'tutor_action' => 'duplicate_course',
												'course_id' => $post->ID,
											)
										);
										?>
									<a class="tutor-dropdown-item" href="?<?php echo esc_attr( $params ); ?>">
										<i class="tutor-icon-copy-text tutor-mr-8" area-hidden="true"></i>
										<span><?php esc_html_e( 'Duplicate', 'edcare' ); ?></span>
									</a>
									<?php endif; ?>
									<!-- # Duplicate Action -->
									
									<!-- Move to Draf Action -->
									<?php if ( tutor()->has_pro && in_array( $post->post_status, array( CourseModel::STATUS_PUBLISH ) ) ) : ?>
										<?php
										$params = http_build_query(
											array(
												'tutor_action' => 'update_course_status',
												'status' => CourseModel::STATUS_DRAFT,
												'course_id' => $post->ID,
												tutor()->nonce => $tutor_nonce_value,
											)
										);
										?>
									<a class="tutor-dropdown-item" href="?<?php echo esc_attr( $params ); ?>">
										<i class="tutor-icon-archive tutor-mr-8" area-hidden="true"></i>
										<span><?php esc_html_e( 'Move to Draft', 'edcare' ); ?></span>
									</a>
									<?php endif; ?>
									<!-- # Move to Draft Action -->
									
									<!-- Cancel Submission -->
									<?php if ( tutor()->has_pro && in_array( $post->post_status, array( CourseModel::STATUS_PENDING ) ) ) : ?>
										<?php
										$params = http_build_query(
											array(
												'tutor_action' => 'update_course_status',
												'status' => CourseModel::STATUS_DRAFT,
												'course_id' => $post->ID,
												tutor()->nonce => $tutor_nonce_value,
											)
										);
										?>
									<a href="?<?php echo esc_attr( $params ); ?>" class="tutor-dropdown-item">
										<i class="tutor-icon-times tutor-mr-8" area-hidden="true"></i>
										<span><?php esc_html_e( 'Cancel Submission', 'edcare' ); ?></span>
									</a>
									<?php endif; ?>
									<!-- # Cancel Submission -->
									
									<!-- Delete Action -->
									<?php if ( $is_main_instructor && in_array( $post->post_status, array( CourseModel::STATUS_PUBLISH, CourseModel::STATUS_DRAFT ) ) ) : ?>
									<a href="#" data-tutor-modal-target="<?php echo esc_attr( $id_string_delete ); ?>" class="tutor-dropdown-item tutor-admin-course-delete">
										<i class="tutor-icon-trash-can-bold tutor-mr-8" area-hidden="true"></i>
										<span><?php esc_html_e( 'Delete', 'edcare' ); ?></span>
									</a>
									<?php endif; ?>
									<!-- # Delete Action -->
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Delete prompt modal -->
				<div id="<?php echo esc_attr( $id_string_delete ); ?>" class="tutor-modal">
					<div class="tutor-modal-overlay"></div>
					<div class="tutor-modal-window">
						<div class="tutor-modal-content tutor-modal-content-white">
							<button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
								<span class="tutor-icon-times" area-hidden="true"></span>
							</button>

							<div class="tutor-modal-body tutor-text-center">
								<div class="tutor-mt-48">
									<img class="tutor-d-inline-block" src="<?php echo esc_attr( tutor()->url ); ?>assets/images/icon-trash.svg" />
								</div>

								<div class="tutor-fs-3 tutor-fw-medium tutor-color-black tutor-mb-12"><?php esc_html_e( 'Delete This Course?', 'edcare' ); ?></div>
								<div class="tutor-fs-6 tutor-color-muted"><?php esc_html_e( 'Are you sure you want to delete this course permanently from the site? Please confirm your choice.', 'edcare' ); ?></div>

								<div class="tutor-d-flex tutor-justify-center tutor-my-48">
									<button data-tutor-modal-close class="tutor-btn tutor-btn-outline-primary">
										<?php esc_html_e( 'Cancel', 'edcare' ); ?>
									</button>
									<button class="tutor-btn tutor-btn-primary tutor-list-ajax-action tutor-ml-20" data-request_data='{"course_id":<?php echo esc_attr( $post->ID ); ?>,"action":"tutor_delete_dashboard_course","redirect_to":"<?php echo esc_url( tutor_utils()->get_current_url() ); ?>"}' data-delete_element_id="<?php echo esc_attr( $row_id ); ?>">
										<?php esc_html_e( 'Yes, Delete This', 'edcare' ); ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php
	if ( $count_map[ $status ] > $per_page ) {
		$pagination_data = array(
			'total_items' => $count_map[ $status ],
			'per_page'    => $per_page,
			'paged'       => $paged,
		);

		tutor_load_template_from_custom_path(
			tutor()->path . 'templates/dashboard/elements/pagination.php',
			$pagination_data
		);
	}
	?>
<?php endif; ?>