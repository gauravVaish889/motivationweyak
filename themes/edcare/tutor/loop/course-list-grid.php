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
$course_id         = $post->ID;
$profile_url       = tutor_utils()->profile_url( $authordata->ID, true );
$course_categories = get_tutor_course_categories( $course_id );

$tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
$course_students   = apply_filters( 'tutor_course_students', tutor_utils()->count_enrolled_users_by_course( $course_id ), $course_id );

$cat_color = '#17A2B8';
if(!empty($course_categories[0])){
	$cat_color = get_term_meta( $course_categories[0]->term_id, '_edcare_course_cat_color', true );
	$cat_color = ! empty( $cat_color ) ? $cat_color : '#17A2B8';
}

$show_course_ratings = apply_filters( 'tutor_show_course_ratings', true, get_the_ID() );
$course_rating = tutor_utils()->get_course_rating();
$price 	= !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

$word_count = get_theme_mod( 'edcare_lms_course_title_word_count', 3 );



$is_wish_listed = tutor_utils()->is_wishlisted( $course_id );
$login_url_attr = '';
$action_class   = '';

if ( is_user_logged_in() ) {
	$action_class = apply_filters( 'tutor_wishlist_btn_class', 'tutor-course-wishlist-btn' );
} else {
	$action_class = apply_filters( 'tutor_popup_login_class', 'tutor-open-login-modal' );

	if ( ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ) {
		$login_url_attr = 'data-login_url="' . esc_url( wp_login_url() ) . '"';
	}
}
?>

<div class="col">
    <div class="tp-course-grid-item d-flex mb-30 flex-wrap">
        <div class="tp-course-grid-thumb">
            <a href="<?php the_permalink(); ?>">
                <img class="course-lightblue" src="<?php echo esc_url( $tutor_course_img ); ?>" alt="<?php the_title(); ?>" loading="lazy">
            </a>

            <a href="javascript:void(0);" <?php if(!empty($login_url_attr)){echo esc_attr($login_url_attr);}; ?> class="save-bookmark-btn edcare-save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary <?php echo esc_attr($action_class); ?>" data-course-id="<?php echo esc_attr( $course_id ); ?>">
                <?php if($is_wish_listed) : ?>
                    <i class="tutor-icon-bookmark-bold"></i>
                <?php else : ?>
                    <i class="tutor-icon-bookmark-line"></i>
                <?php endif; ?>
            </a>
        </div>
        
        <div class="tp-course-grid-content">
            <div class="tp-course-filter-tag mb-10 d-flex align-items-center gap-2">
                <?php if(!empty($course_categories[0])): ?>
                <span class="tag-span" data-cat-color="<?php echo esc_attr($cat_color); ?>">
                    <a href="<?php echo get_term_link($course_categories[0]); ?>">
                        <?php echo esc_html($course_categories[0]->name); ?>
                    </a>
                </span>
                <?php endif; ?>
    
                <?php if(class_exists( 'WooCommerce' )) : if(!empty(edcare_lms_sale_percentage())) : ?>
                <span class="discount"><?php echo edcare_kses(edcare_lms_sale_percentage()); ?></span>
                <?php endif; endif; ?>
            </div>
            <?php if ( tutor_utils()->get_option( 'enable_course_total_enrolled' ) || ! empty( $tutor_lesson_count ) ) : ?>
            <div class="tp-course-meta">
    
                <?php if ( ! empty( $tutor_lesson_count ) ) : ?>
                <span>
                    <span>
                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'edcare'), $tutor_lesson_count) ; ?>
                </span>
                <?php endif; ?>
    
                <?php if ( ! empty( $course_students ) ) : ?>
                <span>
                    <span>
                        <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <?php printf(_n('%d Student', '%d Students', $course_students, 'edcare'), $course_students) ; ?>
                </span>
                <?php endif; ?>
    
            </div>
            <?php endif; ?>
            <h4 class="tp-course-grid-title">
                <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words(get_the_title(), $word_count, ''); ?></a>
            </h4>
            <div class="tp-course-teacher tp-course-grid-teacher">
                <span>
                    <a href="<?php echo esc_url( $profile_url ); ?>" class="d-flex align-items-center gap-2">
                        <?php 
                            echo wp_kses(
                                tutor_utils()->get_tutor_avatar( $post->post_author ),
                                tutor_utils()->allowed_avatar_tags()
                            );
                        ?>
                    
                    <?php echo esc_html( get_the_author() );?>
                    </a>
                </span>
            </div>
            <div class="tp-course-rating d-flex align-items-end justify-content-between">
                <div class="tp-course-rating-star">
                    <p>
                        <?php echo esc_html( apply_filters( 'tutor_course_rating_average', $course_rating->rating_avg ) ); ?>
                        <span>/<?php echo esc_html( $course_rating->rating_count > 0 ? $course_rating->rating_count : 0 ); ?></span>
                    </p>
                    <div class="tp-course-rating-icon">
                        <?php
                            $course_rating = tutor_utils()->get_course_rating();
                            tutor_utils()->star_rating_generator_course( $course_rating->rating_avg );
                        ?>
                    </div>
                </div>
                <div class="tp-course-pricing">
                    <?php echo edcare_kses($price); ?>
                </div>
            </div>
        </div>
    </div>
</div>
