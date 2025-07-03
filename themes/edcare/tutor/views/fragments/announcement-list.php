<?php
/**
 * Announcement fragment view
 *
 * @package Tutor\Views
 * @subpackage Tutor\Fragments
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.0.0
 */

use Tutor\Models\CourseModel;

/**
 * Announcement modal
 *
 * @since 2.0.0
 *
 * @param string $id modal id.
 * @param string $title modal title.
 * @param array $courses courses.
 * @param object|null $announcement announcement.
 *
 * @return void
 */
function tutor_announcement_modal($id, $title, $courses, $announcement = null)
{
	$course_id = $announcement ? $announcement->post_parent : null;
	$announcment_id = $announcement ? $announcement->ID : null;
	$announcment_title = $announcement ? $announcement->post_title : '';
	$summary = $announcement ? $announcement->post_content : '';
	// Assign fallback course id.
	(!$course_id && count($courses)) ? $course_id = $courses[0]->ID : 0;
	?>
	<form class="tutor-modal tutor-modal-scrollable tutor-announcements-form" id="<?php echo esc_attr($id); ?>">
		<div class="tutor-modal-overlay"></div>
		<div class="tutor-modal-window">
			<div class="tutor-modal-content">
				<div class="tutor-modal-header">
					<div class="tutor-modal-title">
						<?php echo esc_html($title); ?>
					</div>
					<button class="tutor-modal-close tutor-iconic-btn" data-tutor-modal-close role="button">
						<span class="tutor-icon-times" area-hidden="true"></span>
					</button>
				</div>

				<div class="tutor-modal-body">
					<?php tutor_nonce_field(); ?>
					<input type="hidden" name="announcement_id" value="<?php echo esc_attr($announcment_id); ?>">
					<input type="hidden" name="action" value="tutor_announcement_create" />
					<input type="hidden" name="action_type"
						value="<?php echo esc_attr($announcement ? 'update' : 'create'); ?>" />
					<div class="tutor-mb-32">
						<label class="tutor-form-label">
							<?php esc_html_e('Select Course', 'edcare'); ?>
						</label>
						<select class="tutor-form-select" name="tutor_announcement_course" required>
							<?php if ($courses): ?>
								<?php foreach ($courses as $course): ?>
									<option value="<?php echo esc_attr($course->ID); ?>" <?php selected($course_id, $course->ID); ?>>
										<?php echo esc_html($course->post_title); ?>
									</option>
								<?php endforeach; ?>
							<?php else: ?>
								<option value=""><?php esc_html_e('No course found', 'edcare'); ?></option>
							<?php endif; ?>
						</select>
					</div>

					<div class="tutor-mb-32">
						<label class="tutor-form-label">
							<?php esc_html_e('Announcement Title', 'edcare'); ?>
						</label>
						<input class="tutor-form-control" type="text" name="tutor_announcement_title"
							value="<?php echo esc_attr($announcment_title); ?>"
							placeholder="<?php esc_attr_e('Announcement title', 'edcare'); ?>" maxlength="255" required>
					</div>

					<div class="tutor-mb-32">
						<label class="tutor-form-label" for="tutor_announcement_course">
							<?php esc_html_e('Summary', 'edcare'); ?>
						</label>
						<textarea style="resize: unset;" class="tutor-form-control" rows="6" type="text"
							name="tutor_announcement_summary" placeholder="<?php esc_attr_e('Summary...', 'edcare'); ?>"
							required><?php echo esc_textarea($summary); ?></textarea>
					</div>

					<?php do_action('tutor_announcement_editor/after'); ?>
				</div>

				<div class="tutor-modal-footer">
					<button data-tutor-modal-close type="button" data-action="back"
						class="tutor-btn tutor-btn-outline-primary">
						<?php esc_html_e('Cancel', 'edcare'); ?>
					</button>
					<button type="submit" data-action="next" class="tutor-btn tutor-btn-primary">
						<?php esc_html_e('Publish', 'edcare'); ?>
					</button>
				</div>
			</div>
		</div>
	</form>
	<?php
}

/**
 * Announcement modal
 *
 * @since 2.0.0
 *
 * @param string $id modal id.
 * @param string $update_modal_id update modal id.
 * @param string $delete_modal_id delete_modal_id.
 * @param object $announcement announcement.
 * @param string $course_title course title.
 * @param string $publish_date announcement publish date.
 * @param string $publish_time announcement publish time.
 *
 * @return void
 */
function tutor_announcement_modal_details($id, $update_modal_id, $delete_modal_id, $announcement, $course_title, $publish_date, $publish_time)
{
	?>
	<div id="<?php echo esc_attr($id); ?>" class="tutor-modal tpd-modal">
		<div class="tutor-modal-overlay"></div>

		<div class="tutor-modal-window">
			<div class="tutor-modal-content tutor-modal-content-white">
				<div class="modal-content">
					<div class="modal-header">
						<div class="tpd-modal-icon">
							<span>
								<svg width="20" height="24" viewBox="0 0 20 24" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M19.5619 14.4481L18.2422 12.1865C17.9502 11.6932 17.6933 10.7429 17.6933 10.1654V7.91579C17.6933 3.54887 14.248 0 10.0202 0C5.78079 0.0120301 2.33551 3.54887 2.33551 7.91579V10.1534C2.33551 10.7308 2.07858 11.6812 1.79828 12.1744L0.478569 14.4361C-0.0236228 15.3143 -0.140412 16.3128 0.174918 17.1789C0.490248 18.0571 1.20266 18.7549 2.13697 19.0677C3.39829 19.5007 4.67129 19.8135 5.96765 20.0421C6.09612 20.0662 6.22458 20.0782 6.35305 20.1023C6.51655 20.1263 6.69174 20.1504 6.86692 20.1744C7.17057 20.2226 7.47422 20.2586 7.78955 20.2827C8.52532 20.3549 9.27277 20.391 10.0202 20.391C10.756 20.391 11.4918 20.3549 12.2159 20.2827C12.4845 20.2586 12.7531 20.2346 13.01 20.1985C13.2202 20.1744 13.4305 20.1504 13.6407 20.1143C13.7691 20.1023 13.8976 20.0782 14.0261 20.0541C15.3341 19.8376 16.6305 19.5007 17.8918 19.0677C18.7911 18.7549 19.4801 18.0571 19.8071 17.1669C20.1341 16.2647 20.0407 15.2782 19.5619 14.4481ZM10.8728 9.56391C10.8728 10.0692 10.4757 10.4782 9.98518 10.4782C9.49467 10.4782 9.09759 10.0692 9.09759 9.56391V5.83459C9.09759 5.32932 9.49467 4.9203 9.98518 4.9203C10.4757 4.9203 10.8728 5.32932 10.8728 5.83459V9.56391Z"
										fill="#3C66F9" />
									<path
										d="M13.2978 21.6063C12.8073 23.0018 11.5109 24.0003 9.99267 24.0003C9.07003 24.0003 8.15908 23.6153 7.51674 22.9296C7.14302 22.5687 6.86272 22.0875 6.69922 21.5942C6.85104 21.6183 7.00287 21.6303 7.16637 21.6544C7.43499 21.6905 7.71528 21.7266 7.99557 21.7506C8.66127 21.8108 9.33865 21.8469 10.016 21.8469C10.6817 21.8469 11.3474 21.8108 12.0014 21.7506C12.2467 21.7266 12.4919 21.7145 12.7255 21.6784C12.9124 21.6544 13.0992 21.6303 13.2978 21.6063Z"
										fill="#3C66F9" />
								</svg>
							</span>
						</div>
						<h4 class="tpd-modal-title"><?php echo esc_html($announcement->post_title); ?></h4>
						<p><?php echo wp_kses_post($announcement->post_content); ?></p>

						<button type="button" class="tpd-modal-btn-close" data-tutor-modal-close>
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
									fill="none">
									<path d="M13 1L1 13" stroke="#757C8E" stroke-width="1.5" stroke-linecap="round"
										stroke-linejoin="round"></path>
									<path d="M1 1L13 13" stroke="#757C8E" stroke-width="1.5" stroke-linecap="round"
										stroke-linejoin="round"></path>
								</svg>
							</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="tpd-modal-content">
							<div class="row">
								<div class="col-md-8">
									<div class="tpd-modal-course">
										<span><?php esc_html_e('Course', 'edcare'); ?></span>
										<h4 class="tpd-modal-course-title">
											<?php echo esc_html($course_title); ?>
										</h4>
									</div>
								</div>
								<div class="col-md-4">
									<div class="tpd-modal-info ms-0">
										<span><?php esc_html_e('Published Date', 'edcare'); ?></span>
										<h4 class="tpd-modal-date"><?php echo esc_html($publish_date); ?></h4>
										<h4 class="tpd-modal-time"><?php echo esc_html($publish_time); ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="tpd-modal-btn">
							<button type="button" class="tpd-btn-cancel" data-tutor-modal-close>
								<?php esc_html_e('Cancel', 'edcare'); ?>
							</button>
						</div>
						<div class="tpd-modal-btn-wrap">
							<button type="button" class="tpd-btn-delete tutor-modal-btn-delete"
								data-tutor-modal-target="<?php echo esc_attr($delete_modal_id); ?>">
								<?php esc_html_e('Delete', 'edcare'); ?>
							</button>
							<button type="button" class="tpd-btn-edit ml-10 tutor-modal-btn-edit"
								data-tutor-modal-target="<?php echo esc_attr($update_modal_id); ?>">
								<?php esc_html_e('Edit', 'edcare'); ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Announcement delete modal
 *
 * @since 2.0.0
 *
 * @param int $id id.
 * @param int $announcment_id announcement id.
 * @param int $row_id row id.
 *
 * @return void
 */
function tutor_announcement_modal_delete($id, $announcment_id, $row_id)
{
	?>
	<div id="<?php echo esc_attr($id); ?>" class="tutor-modal">
		<div class="tutor-modal-overlay"></div>
		<div class="tutor-modal-window">
			<div class="tutor-modal-content tutor-modal-content-white">
				<button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
					<span class="tutor-icon-times" area-hidden="true"></span>
				</button>

				<div class="tutor-modal-body tutor-text-center">
					<div class="tutor-mt-48">
						<img class="tutor-d-inline-block"
							src="<?php echo esc_url(tutor()->url); ?>assets/images/icon-trash.svg" />
					</div>

					<div class="tutor-fs-3 tutor-fw-medium tutor-color-black tutor-mb-12">
						<?php esc_html_e('Delete This Announcement?', 'edcare'); ?></div>
					<div class="tutor-fs-6 tutor-color-muted">
						<?php esc_html_e('Are you sure you want to delete this Announcement permanently from the site? Please confirm your choice.', 'edcare'); ?>
					</div>
					<div class="tutor-d-flex tutor-justify-center tutor-my-48">
						<button class="tutor-btn tutor-btn-outline-primary" data-tutor-modal-close>
							<?php esc_html_e('Cancel', 'edcare'); ?>
						</button>
						<button class="tutor-btn tutor-btn-primary tutor-list-ajax-action tutor-ml-20"
							data-request_data='{"announcement_id":<?php echo esc_attr($announcment_id); ?>, "action":"tutor_announcement_delete"}'
							data-delete_element_id="<?php echo esc_attr($row_id); ?>">
							<?php esc_html_e('Yes, Delete This', 'edcare'); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}

extract($data);
$courses = (current_user_can('administrator')) ? CourseModel::get_courses() : CourseModel::get_courses_by_instructor();
?>


<div class="tpd-table tpd-announcement-table mb-45">
	<ul>
		<li class="tpd-table-head">
			<div class="tpd-table-row">
				<div class="tpd-announcement-date">
					<h4 class="tpd-table-title"><?php esc_html_e('Date', 'edcare'); ?></h4>
				</div>
				<div class="tpd-announcement-announcement">
					<h4 class="tpd-table-title"><?php esc_html_e('Announcements', 'edcare'); ?></h4>
				</div>
				<div class="tpd-announcement-btn"></div>
				<div class="tpd-announcement-action"></div>
			</div>
		</li>
		<?php if (is_array($announcements) && count($announcements)): ?>
			<?php foreach ($announcements as $announcement):

				$course = get_post($announcement->post_parent);
				$date_format = tutor_get_formated_date(get_option('date_format'), $announcement->post_date);
				$time_format = tutor_get_formated_date(get_option('time_format'), $announcement->post_date);

				$update_modal_id = 'tutor_announcement_' . $announcement->ID;
				$details_modal_id = $update_modal_id . '_details';
				$delete_modal_id = $update_modal_id . '_delete';
				$row_id = 'tutor-announcement-tr-' . $announcement->ID;
				?>
				<li id="<?php echo esc_attr($row_id); ?>">
					<div class="tpd-table-row">

						<?php if (is_admin()): ?>
							<div class="d-flex">
								<div class="v-align-top">
									<div class="tutor-form-check">
										<input id="tutor-admin-list-<?php echo esc_attr($announcement->ID); ?>" type="checkbox"
											class="tutor-form-check-input tutor-bulk-checkbox" name="tutor-bulk-checkbox-all"
											value="<?php echo esc_attr($announcement->ID); ?>" />
									</div>
								</div>
								<div class="tpd-announcement-date">
									<h4 class="tpd-common-text"><?php echo esc_html($date_format); ?></h4>
									<span class="tpd-announcement-time"><?php echo esc_html($time_format); ?></span>
								</div>
							</div>
						<?php else: ?>

							<div class="tpd-announcement-date">
								<h4 class="tpd-common-text"><?php echo esc_html($date_format); ?></h4>
								<span class="tpd-announcement-time"><?php echo esc_html($time_format); ?></span>
							</div>
						<?php endif; ?>


						<div class="tpd-announcement-announcement">
							<h4 class="tpd-common-text"><?php echo esc_html($announcement->post_title); ?></h4>
							<div class="tpd-course-wrap">
								<span class="tpd-course-name"><?php esc_html_e('Course:', 'edcare'); ?> </span>
								<span
									class="tpd-course-title"><?php echo esc_html($course ? $course->post_title : ''); ?></span>
							</div>
						</div>

						<div class="tpd-announcement-btn">
							<button class="tpd-btn-details tutor-announcement-details"
								data-tutor-modal-target="<?php echo esc_attr($details_modal_id); ?>">
								<?php esc_html_e('Details', 'edcare'); ?>
							</button>
						</div>
						<div class="tpd-announcement-action">


							<div class="tutor-dropdown-parent">
								<button type="button" class="tutor-iconic-btn" action-tutor-dropdown="toggle">
									<span class="tutor-icon-kebab-menu" area-hidden="true"></span>
								</button>
								<ul class="tutor-dropdown tutor-dropdown-dark">
									<li>
										<a href="#" class="tutor-dropdown-item"
											data-tutor-modal-target="<?php echo esc_attr($update_modal_id); ?>">
											<i class="tutor-icon-edit tutor-mr-8" area-hidden="true"></i>
											<span><?php esc_html_e('Edit', 'edcare'); ?></span>
										</a>
									</li>
									<li>
										<a href="#" class="tutor-dropdown-item"
											data-tutor-modal-target="<?php echo esc_attr($delete_modal_id); ?>">
											<i class="tutor-icon-trash-can-bold tutor-mr-8" area-hidden="true"></i>
											<span><?php esc_html_e('Delete', 'edcare'); ?></span>
										</a>
									</li>
								</ul>
							</div>
							<?php
							$course_title = isset($course->post_title) ? $course->post_title : '';
							tutor_announcement_modal($update_modal_id, esc_html('Edit Announcement'), $courses, $announcement);
							tutor_announcement_modal_details($details_modal_id, $update_modal_id, $delete_modal_id, $announcement, $course_title, $date_format, $time_format);
							tutor_announcement_modal_delete($delete_modal_id, $announcement->ID, $row_id);
							?>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		<?php else: ?>
			<li>
				<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
			</li>
		<?php endif; ?>
	</ul>
</div>

<?php
$limit = tutor_utils()->get_option('pagination_per_page');
if ($the_query->found_posts > $limit) {
	$pagination_data = array(
		'total_items' => $the_query->found_posts,
		'per_page' => $limit,
		'paged' => $paged,
	);

	if (is_admin()) {
		tutor_load_template_from_custom_path(get_template_directory() . '/tutor/views/elements/pagination.php', $pagination_data);
	} else {

		tutor_load_template_from_custom_path(get_template_directory() . '/tutor/dashboard/elements/pagination.php', $pagination_data);
	}
}
?>

<?php
tutor_announcement_modal('tutor_announcement_new', esc_html('Create Announcement'), $courses);
?>