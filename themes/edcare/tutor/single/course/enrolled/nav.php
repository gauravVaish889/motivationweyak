<?php
/**
 * Template for displaying enrolled course view nav menu
 *
 * @package Tutor\Templates
 * @subpackage Single\Course\Enrolled
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'tutor_course/single/enrolled/nav/before' );

?>
<nav class="tutor-nav" tutor-priority-nav >
	<ul id="course_details2_nav">
		<?php
			foreach ( $course_nav_item as $nav_key => $nav_item ) : 
			$default_active_key = apply_filters( 'tutor_default_topics_active_tab', 'info' );

		?>
		<li class=" <?php echo esc_attr($nav_key == $default_active_key ? ' current' : ''); ?>">
			<a href="#<?php echo esc_attr($nav_item['method']); ?>"><?php echo esc_html( $nav_item['title'] ); ?></a>
		</li>
		<?php endforeach; ?>
	
		<li class="tutor-nav-item tutor-nav-more tutor-d-none">
			<a class="tutor-nav-link tutor-nav-more-item" href="#"><span class="tutor-mr-4"><?php esc_html_e( 'More', 'edcare' ); ?></span> <span class="tutor-nav-more-icon tutor-icon-times"></span></a>
			<ul class="tutor-nav-more-list tutor-dropdown"></ul>
		</li>
	</ul>
</nav>

<?php do_action( 'tutor_course/single/enrolled/nav/after' ); ?>
