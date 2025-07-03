<?php
/**
 * My Own reviews
 *
 * @package Tutor\Templates
 * @subpackage Dashboard\Reviews
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.1.2
 */

use TUTOR\Input;

// Pagination Variable.
$per_page = tutor_utils()->get_option('pagination_per_page', 20);
$current_page = max(1, Input::get('current_page', 0, Input::TYPE_INT));
$offset = ($current_page - 1) * $per_page;


$all_reviews = tutor_utils()->get_reviews_by_user(0, $offset, $per_page, true);
$review_count = $all_reviews->count;
$reviews = $all_reviews->results;
$received_count = tutor_utils()->get_reviews_by_instructor(0, 0, 0)->count;
$edcare_review_count = $review_count;
$acaida_received_count = $received_count;
?>

<div class="tp-dashboard-tab mb-30">
	<h2 class="tp-dashboard-tab-title"><?php esc_html_e('Reviews', 'edcare'); ?></h2>
	<?php if (current_user_can(tutor()->instructor_role)): ?>
		<div class="tp-dashboard-tab-list">
			<ul>
				<li>
					<a href="<?php echo esc_url(tutor_utils()->get_tutor_dashboard_page_permalink('reviews')); ?>">
						<?php esc_html_e('Received (', 'edcare'); ?> 	<?php echo esc_html($acaida_received_count); ?>
						<?php esc_html_e(')', 'edcare'); ?>
					</a>
				</li>

				<li>
					<a class="is-active"
						href="<?php echo esc_url(tutor_utils()->get_tutor_dashboard_page_permalink('reviews/given-reviews')); ?>">
						<?php esc_html_e('Given (', 'edcare'); ?> 	<?php echo esc_html($edcare_review_count); ?>
						<?php esc_html_e(')', 'edcare'); ?>
					</a>
				</li>
			</ul>
		</div>
	<?php endif; ?>
</div>

<?php if (!is_array($reviews) || !count($reviews)): ?>
	<div class="tutor-dashboard-content-inner">
		<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
	</div>
<?php endif; ?>

<div class="tpd-table mb-25">
	<ul>
		<li class="tpd-table-head">
			<div class="tpd-table-row">
				<div class="tpd-reviews-course">
					<h4 class="tpd-table-title"><?php esc_html_e('Course Title: ', 'edcare'); ?></h4>
				</div>
				<div class="tpd-reviews-feedback-2">
					<h4 class="tpd-table-title"><?php esc_html_e('Feedback: ', 'edcare'); ?></h4>
				</div>
				<div class="tpd-reviews-edit"><?php esc_html_e('Action: ', 'edcare'); ?></div>
			</div>
		</li>
		<?php
		foreach ($reviews as $review):
			$profile_url = tutor_utils()->profile_url($review->user_id, false);
			$update_id = 'tutor_review_update_' . $review->comment_ID;
			$delete_id = 'tutor_review_delete_' . $review->comment_ID;
			$row_id = 'tutor_review_row_' . $review->comment_ID;
			?>
			<li id="<?php echo esc_html($row_id); ?>"
				class="tutor-dashboard-single-review tutor-review-<?php echo esc_html($review->comment_ID); ?>">
				<div class="tpd-table-row">
					<div class="tpd-reviews-course">
						<div class="tpd-course-wrap">
							<span class="tpd-course-title"
								data-href="<?php echo esc_url(get_the_permalink($review->comment_post_ID)); ?>">
								<?php echo esc_html(get_the_title($review->comment_post_ID)); ?>
							</span>
						</div>
					</div>
					<div class="tpd-reviews-feedback-2">
						<div class="tp-instructor-rating">
							<?php tutor_utils()->star_rating_generator_v2($review->rating, null, true); ?>
						</div>
						<p class="tpd-reviews-comment">
							<?php echo edcare_kses(htmlspecialchars(stripslashes($review->comment_content))); ?>
						</p>
					</div>
					<div class="tpd-reviews-edit">
						<div class="tpd-reviews-edit-warp d-flex align-items-center justify-content-end">
							<div class="tpd-action-btn">
								<button type="button" data-tutor-modal-target="<?php echo esc_html($update_id); ?>">
									<svg width="15" height="15" viewBox="0 0 15 15" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M8.74422 2.63127C9.19134 2.14685 9.41489 1.90464 9.65245 1.76336C10.2256 1.42246 10.9315 1.41185 11.5142 1.73539C11.7557 1.86948 11.9862 2.10487 12.447 2.57566C12.9079 3.04644 13.1383 3.28183 13.2696 3.52856C13.5863 4.12387 13.5759 4.84487 13.2422 5.43042C13.1039 5.67309 12.8668 5.90146 12.3926 6.35821L6.75038 11.7926C5.85173 12.6581 5.4024 13.0909 4.84084 13.3102C4.27927 13.5296 3.66192 13.5134 2.42722 13.4811L2.25923 13.4768C1.88334 13.4669 1.6954 13.462 1.58615 13.338C1.4769 13.214 1.49182 13.0226 1.52165 12.6397L1.53785 12.4318C1.6218 11.3541 1.66378 10.8153 1.87422 10.3309C2.08466 9.84657 2.44766 9.45328 3.17366 8.6667L8.74422 2.63127Z"
											stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
										<path d="M8.09375 2.69922L12.2938 6.89922" stroke="currentColor" stroke-width="1.5"
											stroke-linejoin="round"></path>
										<path d="M8.69531 13.5L13.4953 13.5" stroke="currentColor" stroke-width="1.5"
											stroke-linecap="round" stroke-linejoin="round"></path>
									</svg>
									<span class="tpd-action-tooltip"><?php esc_html_e('Edit', 'edcare'); ?></span>
								</button>
							</div>
							<div class="tpd-action-btn ml-10">
								<button type="button" data-tutor-modal-target="<?php echo esc_html($delete_id); ?>">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"
										fill="none">
										<path
											d="M12.9154 3.27502L12.4678 9.79134C12.3534 11.4562 12.2963 12.2887 11.8326 12.8871C11.6033 13.183 11.3082 13.4328 10.9659 13.6204C10.2736 14 9.34686 14 7.49346 14C5.63762 14 4.7097 14 4.0169 13.6197C3.67439 13.4317 3.37914 13.1816 3.14997 12.8852C2.68644 12.2857 2.63053 11.4521 2.51869 9.78488L2.08203 3.27502"
											stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
										<path d="M14 3.27502H1" stroke="currentColor" stroke-width="1.5"
											stroke-linecap="round"></path>
										<path
											d="M10.4282 3.275L9.9352 2.35962C9.60769 1.75157 9.44393 1.44754 9.16146 1.25792C9.0988 1.21586 9.03245 1.17845 8.96307 1.14606C8.65027 1 8.27486 1 7.52404 1C6.75437 1 6.36954 1 6.05154 1.15218C5.98107 1.18591 5.91382 1.22483 5.85048 1.26856C5.56473 1.46586 5.40511 1.78101 5.08588 2.41132L4.64844 3.275"
											stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
										<path d="M5.69336 10.425L5.69336 6.52505" stroke="currentColor" stroke-width="1.5"
											stroke-linecap="round"></path>
										<path d="M9.30469 10.425L9.30469 6.52502" stroke="currentColor" stroke-width="1.5"
											stroke-linecap="round"></path>
									</svg>
									<span class="tpd-action-tooltip"><?php esc_html_e('Delete', 'edcare'); ?></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Edit Review Modal -->
				<form class="tutor-modal" id="<?php echo esc_html($update_id); ?>">
					<div class="tutor-modal-overlay"></div>
					<div class="tutor-modal-window">
						<div class="tutor-modal-content tutor-modal-content-white">
							<button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
								<span class="tutor-icon-times" area-hidden="true"></span>
							</button>

							<div class="tutor-modal-body tutor-text-center">
								<div class="tutor-fs-3 tutor-fw-medium tutor-color-black tutor-mt-48 tutor-mb-12">
									<?php esc_html_e('How would you rate this course?', 'edcare'); ?>
								</div>
								<div class="tutor-fs-6 tutor-color-muted"><?php esc_html_e('Select Rating', 'edcare'); ?>
								</div>

								<input type="hidden" name="course_id"
									value="<?php echo esc_html($review->comment_post_ID); ?>" />
								<input type="hidden" name="review_id"
									value="<?php echo esc_html($review->comment_ID); ?>" />
								<input type="hidden" name="action" value="tutor_place_rating" />

								<div class="tutor-ratings tutor-ratings-xl tutor-ratings-selectable tutor-justify-center tutor-mt-16"
									tutor-ratings-selectable>
									<?php
									tutor_utils()->star_rating_generator(tutor_utils()->get_rating_value($review->rating));
									?>
								</div>

								<textarea class="tutor-form-control tutor-mt-28" name="review"
									placeholder="<?php esc_attr_e('write a review', 'edcare'); ?>"><?php echo esc_html(stripslashes($review->comment_content)); ?></textarea>

								<div class="tutor-d-flex tutor-justify-center tutor-my-48">
									<button type="button" class="tutor-btn tutor-btn-outline-primary" data-tutor-modal-close
										data-action="back">
										<?php esc_html_e('Cancel', 'edcare'); ?>
									</button>
									<button type="submit"
										class="tutor_submit_review_btn tutor-btn tutor-btn-primary tutor-ml-20"
										data-action="next">
										<?php esc_html_e('Update Review', 'edcare'); ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>

				<!-- Delete Modal -->
				<?php
				tutor_load_template(
					'modal.confirm',
					array(
						'id' => $delete_id,
						'image' => 'icon-trash.svg',
						'title' => __('Do You Want to Delete This Review?', 'edcare'),
						'content' => __('Are you sure you want to delete this review permanently from the site? Please confirm your choice.', 'edcare'),
						'yes' => array(
							'text' => __('Yes, Delete This', 'edcare'),
							'class' => 'tutor-list-ajax-action',
							'attr' => array('data-request_data=\'{"action":"delete_tutor_review", "review_id":"' . $review->comment_ID . '"}\'', 'data-delete_element_id="' . $row_id . '"'),
						),
					)
				);
				?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>


<div class="tutor-dashboard-content-inner">
	<div class="tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-24"><?php esc_html_e('Reviews', 'edcare'); ?>
	</div>
	<?php if (current_user_can(tutor()->instructor_role)): ?>
		<div class="tutor-mb-32">
			<ul class="tutor-nav">
				<li class="tutor-nav-item">
					<a class="tutor-nav-link"
						href="<?php echo esc_url(tutor_utils()->get_tutor_dashboard_page_permalink('reviews')); ?>">
						<?php esc_html_e('Received', 'edcare'); ?> (<?php echo esc_html($acaida_received_count); ?>)</a>
				</li>
				<li class="tutor-nav-item">
					<a class="tutor-nav-link is-active"
						href="<?php echo esc_url(tutor_utils()->get_tutor_dashboard_page_permalink('reviews/given-reviews')); ?>">
						<?php esc_html_e('Given', 'edcare'); ?> (<?php echo esc_html($edcare_review_count); ?>)</a>
				</li>
			</ul>
		</div>
	<?php endif; ?>

	<div class="tutor-dashboard-reviews-wrap">
		<?php if (!is_array($reviews) || !count($reviews)): ?>
			<div class="tutor-dashboard-content-inner">
				<?php tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text()); ?>
			</div>
		<?php endif; ?>

		<div class="tutor-dashboard-reviews">
			<?php
			foreach ($reviews as $review):
				$profile_url = tutor_utils()->profile_url($review->user_id, false);
				$update_id = 'tutor_review_update_' . $review->comment_ID;
				$delete_id = 'tutor_review_delete_' . $review->comment_ID;
				$row_id = 'tutor_review_row_' . $review->comment_ID;
				?>
				<div id="<?php echo esc_html($row_id); ?>"
					class="tutor-card tutor-dashboard-single-review tutor-review-<?php echo esc_html($review->comment_ID); ?> tutor-mb-32">
					<div class="tutor-card-header">
						<h4 class="tutor-card-title">
							<?php esc_html_e('Course: ', 'edcare'); ?>
							<span class="tutor-fs-6 tutor-fw-medium"
								data-href="<?php echo esc_url(get_the_permalink($review->comment_post_ID)); ?>">
								<?php echo esc_html(get_the_title($review->comment_post_ID)); ?>
							</span>
						</h4>
					</div>

					<div class="tutor-card-body">
						<div class="tutor-row tutor-align-center tutor-mb-24">
							<div class="tutor-col">
								<?php tutor_utils()->star_rating_generator_v2($review->rating, null, true); ?>
							</div>

							<div class="tutor-col-auto">
								<div class="tutor-given-review-actions tutor-d-flex">
									<span class="tutor-btn tutor-btn-ghost"
										data-tutor-modal-target="<?php echo esc_html($update_id); ?>" role="button">
										<i class="tutor-icon-edit tutor-mr-8" area-hidden="true"></i>
										<span><?php esc_html_e('Edit', 'edcare'); ?></span>
									</span>

									<span class="tutor-btn tutor-btn-ghost tutor-ml-16"
										data-tutor-modal-target="<?php echo esc_html($delete_id); ?>" role="button">
										<i class="tutor-icon-trash-can-line tutor-mr-8" area-hidden="true"></i>
										<span><?php esc_html_e('Delete', 'edcare'); ?></span>
									</span>
								</div>
							</div>
						</div>

						<div class="tutor-fs-6 tutor-color-muted">
							<?php echo esc_textarea(htmlspecialchars(stripslashes($review->comment_content))); ?>
						</div>
					</div>

					<!-- Edit Review Modal -->
					<form class="tutor-modal" id="<?php echo esc_html($update_id); ?>">
						<div class="tutor-modal-overlay"></div>
						<div class="tutor-modal-window">
							<div class="tutor-modal-content tutor-modal-content-white">
								<button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
									<span class="tutor-icon-times" area-hidden="true"></span>
								</button>

								<div class="tutor-modal-body tutor-text-center">
									<div class="tutor-fs-3 tutor-fw-medium tutor-color-black tutor-mt-48 tutor-mb-12">
										<?php esc_html_e('How would you rate this course?', 'edcare'); ?>
									</div>
									<div class="tutor-fs-6 tutor-color-muted">
										<?php esc_html_e('Select Rating', 'edcare'); ?>
									</div>

									<input type="hidden" name="course_id"
										value="<?php echo esc_html($review->comment_post_ID); ?>" />
									<input type="hidden" name="review_id"
										value="<?php echo esc_html($review->comment_ID); ?>" />
									<input type="hidden" name="action" value="tutor_place_rating" />

									<div class="tutor-ratings tutor-ratings-xl tutor-ratings-selectable tutor-justify-center tutor-mt-16"
										tutor-ratings-selectable>
										<?php
										tutor_utils()->star_rating_generator(tutor_utils()->get_rating_value($review->rating));
										?>
									</div>

									<textarea class="tutor-form-control tutor-mt-28" name="review"
										placeholder="<?php esc_attr_e('write a review', 'edcare'); ?>"><?php echo esc_html(stripslashes($review->comment_content)); ?></textarea>

									<div class="tutor-d-flex tutor-justify-center tutor-my-48">
										<button type="button" class="tutor-btn tutor-btn-outline-primary"
											data-tutor-modal-close data-action="back">
											<?php esc_html_e('Cancel', 'edcare'); ?>
										</button>
										<button type="submit"
											class="tutor_submit_review_btn tutor-btn tutor-btn-primary tutor-ml-20"
											data-action="next">
											<?php esc_html_e('Update Review', 'edcare'); ?>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>

					<!-- Delete Modal -->
					<?php
					tutor_load_template(
						'modal.confirm',
						array(
							'id' => $delete_id,
							'image' => 'icon-trash.svg',
							'title' => __('Do You Want to Delete This Review?', 'edcare'),
							'content' => __('Are you sure you want to delete this review permanently from the site? Please confirm your choice.', 'edcare'),
							'yes' => array(
								'text' => __('Yes, Delete This', 'edcare'),
								'class' => 'tutor-list-ajax-action',
								'attr' => array('data-request_data=\'{"action":"delete_tutor_review", "review_id":"' . $review->comment_ID . '"}\'', 'data-delete_element_id="' . $row_id . '"'),
							),
						)
					);
					?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php
if ($all_reviews->count > $per_page) {
	$pagination_data = array(
		'total_items' => $all_reviews->count,
		'per_page' => $per_page,
		'paged' => $current_page,
	);
	$pagination_template_frontend = tutor()->path . 'templates/dashboard/elements/pagination.php';
	tutor_load_template_from_custom_path($pagination_template_frontend, $pagination_data);
}
?>