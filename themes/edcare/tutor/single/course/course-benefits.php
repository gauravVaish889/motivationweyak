<?php
/**
 * Template for displaying course benefits
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

do_action( 'tutor_course/single/before/benefits' );

$course_benefits = tutor_course_benefits();
if ( empty( $course_benefits ) ) {
	return;
}
?>

<?php if ( is_array( $course_benefits ) && count( $course_benefits ) ) : ?>
	<div class="tp-course-details2-list mt-60">
		<h3 class="tp-course-details2-main-title">
			<?php echo esc_html( apply_filters( 'tutor_course_benefit_title', __( 'What Will You Learn?', 'edcare' ) ) ); ?>
		</h3>
		<ul>
			<?php foreach ( $course_benefits as $benefit ) : ?>
				<li>
					<span><?php echo esc_html( $benefit ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<?php do_action( 'tutor_course/single/after/benefits' ); ?>

<?php 
$materials = tutor_course_material_includes();

if ( empty( $materials ) ) {
	return;
}

if ( is_array( $materials ) && count( $materials ) ) {
	?>
	<div class="tp-course-details2-list mt-20">
		<h3 class="tp-course-details2-main-title">
			<?php esc_html_e( 'Material Includes', 'edcare' ); ?>
		</h3>
		<ul class="">
			<?php foreach ( $materials as $material ) : ?>
				<li class="tutor-d-flex tutor-mb-12">
					
					<span><?php echo esc_html( $material ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}
