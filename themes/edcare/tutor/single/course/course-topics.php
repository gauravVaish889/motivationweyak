<?php
/**
 * Template for displaying single course
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

global $is_enrolled;

$topics = tutor_utils()->get_topics();
$course_id = get_the_ID();
$index = 0;

/**
 * $is_enrolled getting null for Addons plugin like Elementor addons
 *
 * @since 2.1.8
 */
if (is_null($is_enrolled)) {
	$is_enrolled = tutor_utils()->is_enrolled($course_id);
}

do_action('tutor_course/single/before/topics');
?>
<div class="tutor-mt-40">
	<?php if ($topics->have_posts()): ?>

		<h3 class="tp-course-details2-main-title">
			<?php
			echo esc_html(apply_filters('tutor_course_topics_title', __('Course Curriculum', 'edcare')));
			?>
		</h3>

		<div class="tutor-accordion tutor-mt-24">
			<?php while ($topics->have_posts()): ?>
				<?php
				$topics->the_post();
				$topic_summery = get_the_content();
				$index++;
				?>
				<div class="tutor-accordion-item">
					<h4 class="tutor-accordion-item-header<?php echo 1 == $index ? ' is-active' : ''; ?>">
						<?php the_title(); ?>
						<?php if (!empty($topic_summery)): ?>
							<div class="tooltip-wrap tooltip-icon">
								<span class="tooltip-txt tooltip-right"><?php echo esc_html($topic_summery); ?></span>
							</div>
						<?php endif; ?>
					</h4>

					<?php $topic_contents = tutor_utils()->get_course_contents_by_topic(get_the_ID(), -1); ?>
					<?php if ($topic_contents->have_posts()): ?>
						<div class="tutor-accordion-item-body" style="<?php echo 1 != $index ? 'display: none;' : ''; ?>">
							<div class="tutor-accordion-item-body-content">
								<ul class="tutor-course-content-list">
									<?php while ($topic_contents->have_posts()): ?>
										<?php
										$topic_contents->the_post();
										global $post;

										// Get Lesson video information if any.
										$video = tutor_utils()->get_video_info();
										$play_time = $video ? $video->playtime : false;
										$is_preview = get_post_meta($post->ID, '_is_preview', true);

										// Determine topic content icon based on lesson, video, quiz etc.
										$topic_content_icon = $play_time ? 'tutor-icon-brand-youtube-bold' : 'tutor-icon-document-text';
										'tutor_quiz' === $post->post_type ? $topic_content_icon = 'tutor-icon-circle-question-mark' : 0;
										'tutor_assignments' === $post->post_type ? $topic_content_icon = 'tutor-icon-document-text' : 0;
										'tutor_zoom_meeting' === $post->post_type ? $topic_content_icon = 'tutor-icon-brand-zoom' : 0;
										'tutor-google-meet' === $post->post_type ? $topic_content_icon = 'tutor-icon-brand-google-meet' : 0;

										$is_public_course = \TUTOR\Course_List::is_public($course_id);
										$is_locked = !($is_enrolled || $is_preview || $is_public_course);
										?>
										<li class="tutor-course-content-list-item">
											<div class="tutor-d-flex tutor-align-center">
												<span
													class="tutor-course-content-list-item-icon <?php echo esc_attr($topic_content_icon); ?> tutor-mr-12"></span>
												<h5 class="tutor-course-content-list-item-title">
													<?php
													$lesson_title = '';
													$title_tag_allow = array(
														'a' => array(
															'href' => true,
															'class' => true,
														),
														'span' => array('class' => true),
													);

													// Add zoom meeting countdown info.
													$countdown = '';
													if ('tutor_zoom_meeting' === $post->post_type) {
														$zoom_meeting = tutor_zoom_meeting_data($post->ID);
														$countdown = '<div class="tutor-zoom-lesson-countdown tutor-lesson-duration" data-timer="' . $zoom_meeting->countdown_date . '" data-timezone="' . $zoom_meeting->timezone . '"></div>';
													}

													/**
													 * Show clickable content if enrolled.
													 * Or if it is public and not paid, then show content forcefully.
													 */
													if ($is_enrolled || (get_post_meta($course_id, '_tutor_is_public_course', true) == 'yes' && !tutor_utils()->is_course_purchasable($course_id))) {
														$lesson_title .= "<a href='" . get_the_permalink() . "'> " . get_the_title() . ' </a>';

														if ($countdown) {
															if ($zoom_meeting->is_expired) {
																$lesson_title .= '<span class="tutor-zoom-label">' . __('Expired', 'edcare') . '</span>';
															} elseif ($zoom_meeting->is_started) {
																$lesson_title .= '<span class="tutor-zoom-label tutor-zoom-live-label">' . __('Live', 'edcare') . '</span>';
															}
															$lesson_title .= $countdown;
														}

														echo wp_kses(
															$lesson_title,
															$title_tag_allow
														);
													} else {
														$lesson_title .= get_the_title();
														echo wp_kses(apply_filters('tutor_course/contents/lesson/title', $lesson_title, get_the_ID()), $title_tag_allow);
													}
													?>
												</h5>
											</div>

											<div>
												<span class="tutor-course-content-list-item-duration tutor-fs-7 tutor-color-muted">
													<?php echo esc_html($play_time ? tutor_utils()->get_optimized_duration($play_time) : ''); ?>
												</span>
												<span
													class="tutor-course-content-list-item-status <?php echo esc_attr($is_locked ? 'tutor-icon-lock-line' : 'tutor-icon-eye-line'); ?> tutor-color-muted tutor-ml-20"
													area-hidden="true"></span>
											</div>
										</li>
									<?php endwhile; ?>
								</ul>
							</div>
						</div>
						<?php $topic_contents->reset_postdata(); ?>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>

<?php do_action('tutor_course/single/after/topics', $course_id); ?>

<?php

$instructors = tutor_utils()->get_instructors_by_course();
$enrolled_students = tutor_utils()->count_enrolled_users_by_course($course_id);
?>

<div class="pt-100 mb-60">
	<h4 class="tp-course-details2-main-title"><?php esc_html_e('Your Instructors', 'edcare'); ?></h4>
	<?php foreach ($instructors as $instructor):

		$name = $instructor->display_name;
		$job_title = $instructor->tutor_profile_job_title;
		$rating = tutor_utils()->get_instructor_ratings($instructor->ID);
		$instructor_course = tutor_utils()->get_courses_by_instructor($instructor->ID);
		$bio = $instructor->tutor_profile_bio;

		$tutor_user_social_icons = tutor_utils()->tutor_user_social_icons();

		foreach ($tutor_user_social_icons as $key => $social_icon) {
			$url = get_user_meta($instructor->ID, $key, true);
			$tutor_user_social_icons[$key]['url'] = $url;
		}

		?>

		<div class="tp-course-details2-instructor d-flex">

			<div class="tp-course-details2-instructor-thumb mr-40">
				<?php
				echo wp_kses(tutor_utils()->get_tutor_avatar($instructor->ID, 'xl'), tutor_utils()->allowed_avatar_tags());
				?>
			</div>

			<div class="tp-course-details2-instructor-content">

				<h5><?php echo edcare_kses($name); ?></h5>

				<?php if (!empty($job_title)): ?>
					<span class="pre"><?php echo edcare_kses($job_title); ?></span>
				<?php endif; ?>

				<div class="tp-course-details2-instructor-sub d-flex">

					<span>
						<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M11.9376 8.84884C11.7434 9.03675 11.6541 9.3085 11.6984 9.57502L12.365 13.2583C12.4213 13.5705 12.2893 13.8864 12.0276 14.0668C11.7711 14.254 11.4299 14.2764 11.1502 14.1267L7.82888 12.3974C7.7134 12.336 7.58517 12.303 7.45393 12.2993H7.25071C7.18022 12.3098 7.11123 12.3322 7.04824 12.3667L3.72617 14.1042C3.56194 14.1866 3.37597 14.2158 3.19374 14.1866C2.7498 14.1027 2.45359 13.6805 2.52633 13.2351L3.19374 9.55181C3.23798 9.28305 3.14875 9.0098 2.95452 8.8189L0.246625 6.19868C0.0201542 5.97933 -0.0585855 5.64993 0.044901 5.35273C0.145388 5.05627 0.401854 4.83991 0.711564 4.79125L4.43858 4.25149C4.72204 4.22229 4.97101 4.0501 5.09849 3.79557L6.74078 0.434207C6.77977 0.359344 6.83001 0.29047 6.89076 0.232076L6.95825 0.179672C6.99349 0.140743 7.03399 0.108552 7.07898 0.0823496L7.16072 0.0524043L7.2882 0H7.60391C7.88588 0.0291967 8.13409 0.197639 8.26383 0.44918L9.92786 3.79557C10.0478 4.04037 10.2811 4.21031 10.5503 4.25149L14.2773 4.79125C14.5922 4.83617 14.8555 5.05327 14.9597 5.35273C15.0579 5.65293 14.9732 5.98233 14.7422 6.19868L11.9376 8.84884Z"
								fill="#FFB21D" />
						</svg>
						<?php printf('%s Rating', $rating->rating_avg); ?>
					</span>

					<span>
						<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M5.61133 7.50075V6.53875C5.61133 5.29725 6.48883 4.79675 7.56133 5.41425L8.39333 5.89525L9.22533 6.37625C10.2978 6.99375 10.2978 8.00775 9.22533 8.62525L8.39333 9.10625L7.56133 9.58725C6.48883 10.2048 5.61133 9.69775 5.61133 8.46275V7.50075Z"
								stroke="#6C7275" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
								stroke-linejoin="round" />
							<path
								d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z"
								stroke="#6C7275" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						<?php printf("%d %s", count($instructor_course), _n('Course', 'Courses', count($instructor_course), 'edcare')); ?>
					</span>


					<span>
						<svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M6.5711 7.5C8.36215 7.5 9.81407 6.04493 9.81407 4.25C9.81407 2.45507 8.36215 1 6.5711 1C4.78005 1 3.32812 2.45507 3.32812 4.25C3.32812 6.04493 4.78005 7.5 6.5711 7.5Z"
								stroke="#6C7275" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
							<path
								d="M12.1429 14C12.1429 11.4845 9.64577 9.44999 6.57143 9.44999C3.49709 9.44999 1 11.4845 1 14"
								stroke="#6C7275" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						<?php printf("%d %s", $enrolled_students, _n('Student', 'Students', $enrolled_students, 'edcare')); ?>
					</span>

				</div>
				<?php if (!empty($bio)): ?>
					<div class="tp-course-details2-instructor-text">
						<?php echo edcare_kses($bio); ?>
					</div>
				<?php endif; ?>
				<div class="tp-course-details2-instructor-social">
					<?php
					foreach ($tutor_user_social_icons as $key => $social_icon) {
						$url = $social_icon['url'];
						!empty($url) ? printf('<a href="%s" class="%s" title="%s" target="_blank" rel="noopener noreferrer nofollow"></a>', esc_url($url), esc_attr($social_icon['icon_classes']), esc_attr($social_icon['label'])) : '';
					}
					?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>