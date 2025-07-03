<?php
/**
 * Course loop title
 *
 * @package Tutor\Templates
 * @subpackage CourseLoopPart
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

 $word_count = get_theme_mod( 'edcare_lms_course_title_word_count', 3 );

?>

<h4 class="tp-course-title" title="<?php the_title(); ?>">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words(get_the_title(), $word_count, ''); ?></a>
</h4>