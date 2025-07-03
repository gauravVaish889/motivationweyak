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

global $post, $authordata;
$tutor_course_img = get_tutor_course_thumbnail_src();
$course_id = $post->ID;
$profile_url = tutor_utils()->profile_url($authordata->ID, true);
$course_categories = get_tutor_course_categories($course_id);

$tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
$course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);

$cat_color = '#17A2B8';
if (!empty($course_categories[0])) {
    $cat_color = get_term_meta($course_categories[0]->term_id, '_edcare_course_cat_color', true);
    $cat_color = !empty($cat_color) ? $cat_color : '#17A2B8';
}

$show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
$course_rating = tutor_utils()->get_course_rating();
$price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

$word_count = get_theme_mod('edcare_lms_course_title_word_count', 3);

$is_wish_listed = tutor_utils()->is_wishlisted($course_id);
$login_url_attr = '';
$action_class = '';

if (is_user_logged_in()) {
    $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
} else {
    $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

    if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
        $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
    }
}
?>

<div class="col">
    <div class="tp-course-4-item d-flex edcare-card-school mb-30">

        <div class="tp-course-4-thumb">
            <img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title(); ?>" loading="lazy">
        </div>

        <div class="tp-course-4-content flex-grow-1">
            <div class="tp-course-4-rating">
                <?php
                $course_rating = tutor_utils()->get_course_rating();
                tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                ?>
                <span><?php echo esc_html__('( ', 'edcare'); ?><?php echo esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0); ?>
                    <?php echo esc_html__(' reviews)', 'edcare'); ?></span>
            </div>

            <h4 class="tp-course-4-title">
                <a
                    href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo wp_trim_words(get_the_title(), $word_count, ''); ?></a>
            </h4>

            <?php if ($tutor_lesson_count || !empty($tutor_lesson_count)): ?>
                <div class="tp-course-4-info d-flex align-items-center">

                    <?php if (!empty($tutor_lesson_count)): ?>
                        <div class="tp-course-4-info-item">
                            <span>
                                <span>
                                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.9231 10.0426V2.29411C13.9231 1.51825 13.2951 0.953997 12.5254 1.01445H12.4849C11.1278 1.12529 9.07187 1.82055 7.9173 2.53596L7.80591 2.6065C7.62361 2.71733 7.30959 2.71733 7.11717 2.6065L6.95515 2.50573C5.81071 1.79033 3.75477 1.1152 2.39764 1.00437C1.62793 0.943911 1 1.51827 1 2.28405V10.0426C1 10.6573 1.50637 11.2417 2.12417 11.3122L2.30646 11.3425C3.7041 11.5238 5.8715 12.2392 7.10709 12.9143L7.13744 12.9244C7.30961 13.0252 7.59318 13.0252 7.75522 12.9244C8.99081 12.2393 11.1683 11.5339 12.5761 11.3425L12.7888 11.3122C13.4167 11.2417 13.9231 10.6674 13.9231 10.0426Z"
                                            stroke="#6D6C68" stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7.46143 2.81787V12.4506" stroke="#6D6C68" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'edcare'), $tutor_lesson_count); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($course_students)): ?>
                        <div class="tp-course-4-info-item">
                            <span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15"
                                        fill="none">
                                        <path
                                            d="M6.57159 7.5C8.36263 7.5 9.81456 6.04493 9.81456 4.25C9.81456 2.45507 8.36263 1 6.57159 1C4.78054 1 3.32861 2.45507 3.32861 4.25C3.32861 6.04493 4.78054 7.5 6.57159 7.5Z"
                                            stroke="#6D6C68" stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12.1429 14C12.1429 11.4845 9.64577 9.44995 6.57143 9.44995C3.49709 9.44995 1 11.4845 1 14"
                                            stroke="#6D6C68" stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <?php printf(_n('%d Student', '%d Students', $course_students, 'edcare'), $course_students); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; // meta if close ?>

            <p>
                <?php echo get_the_excerpt(); ?>
            </p>

            <div class="tp-course-4-avatar d-flex align-items-center justify-content-between">

                <div class="tp-course-4-avatar-info d-flex align-items-center">
                    <div class="tp-course-4-avatar-thumb">
                        <?php
                        echo wp_kses(
                            tutor_utils()->get_tutor_avatar($post->post_author),
                            tutor_utils()->allowed_avatar_tags()
                        );
                        ?>
                    </div>
                    <div class="tp-course-4-avatar-text">
                        <span><?php echo esc_html__('By', 'edcare'); ?></span>
                        <a href="<?php echo esc_url($profile_url); ?>"> <?php echo esc_html(get_the_author()); ?></a>
                    </div>
                </div>
                <div class="tp-course-4-ammount">
                    <span>
                        <?php echo edcare_kses($price); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>