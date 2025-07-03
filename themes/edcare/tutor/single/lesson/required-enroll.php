<?php
/**
 * Required enrollment template
 *
 * @package Tutor\Templates
 * @subpackage Single\Lesson
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

$course_id = tutor_utils()->get_course_id_by( 'lesson', get_the_ID() );

$args = array(
	'headline'    => __( 'Permission Denied', 'edcare' ),
	'message'     => __( 'Please enroll in this course to view course content.', 'edcare' ),
	/* translators: %s: course name */
	'description' => sprintf( __( 'Course name : %s', 'edcare' ), get_the_title( $course_id ) ),
	'button'      => array(
		'url'  => get_permalink( $course_id ),
		'text' => __( 'View Course', 'edcare' ),
	),
);

tutor_load_template( 'permission-denied', $args );

