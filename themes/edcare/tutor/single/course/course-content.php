<?php
/**
 * Template for displaying course content
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

global $post;

do_action('tutor_course/single/before/content');

if (tutor_utils()->get_option('enable_course_about', true, true)) {
	$string = apply_filters('tutor_course_about_content', get_the_content());
	$content_summary = (bool) get_tutor_option('course_content_summary', true);
	$post_size_in_words = sizeof(explode(' ', $string));
	$word_limit = 100;
	$has_show_more = false;

	if ($content_summary && ($post_size_in_words > $word_limit)) {
		$has_show_more = true;
	}
	?>
	<?php if (!empty($string)):

		$content_class = $has_show_more ? ' tutor-toggle-more-content tutor-toggle-more-collapsed ' : '';

		?>


		<div class="tutor-course-details-content <?php echo esc_attr($content_class) ?>" <?php if ($has_show_more) { ?>
				data-tutor-toggle-more-content data-toggle-height="200" style="height: 250px;" <?php } ?>>
			<h2 class="tp-course-details2-main-title">
				<?php echo esc_html(apply_filters('tutor_course_about_title', __('About Course', 'edcare'))); ?>
			</h2>

			<div class="tp-course-details2-text mb-60">
				<?php echo apply_filters('the_content', $string); ?>
			</div>
		</div>


		<?php if ($has_show_more): ?>
			<a href="#" class="tutor-btn-show-more edcare-course-sinlge-show-more-btn"
				data-tutor-toggle-more=".tutor-toggle-more-content">
				<span class="tutor-toggle-btn-icon edcare-course-sinlge-icon">
					<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 1V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M1 6H11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</span>
				<span class="tutor-toggle-btn-text"><?php esc_html_e('Show More', 'edcare'); ?></span>
			</a>
		<?php endif; ?>



	<?php endif; ?>
<?php
}

do_action('tutor_course/single/after/content'); ?>