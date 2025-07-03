<?php
/**
 * A single course loop
 *
 * @package Tutor\Templates
 * @subpackage CourseLoopPart
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

?>

<div class="col">
	<div class="tp-course-item p-relative fix mb-30">

    <?php
do_action( 'tutor_course/loop/before_content' );

do_action( 'tutor_course/loop/badge' );


tutor_course_loop_thumbnail();
?>

<div class="tp-course-content">
    <?php
        do_action( 'tutor_course/loop/before_meta' );
        do_action( 'tutor_course/loop/meta' );
        do_action( 'tutor_course/loop/after_meta' );

        do_action( 'tutor_course/loop/before_title' );
        do_action( 'tutor_course/loop/title' );
        do_action( 'tutor_course/loop/after_title' );

        do_action( 'tutor_course/loop/before_rating' );
        do_action( 'tutor_course/loop/rating' );
        do_action( 'tutor_course/loop/after_rating' );
    ?>

</div>
<?php

do_action( 'tutor_course/loop/before_footer' );
do_action( 'tutor_course/loop/footer' );
do_action( 'tutor_course/loop/after_footer' );

do_action( 'tutor_course/loop/after_content' );
?>
	</div>
</div>