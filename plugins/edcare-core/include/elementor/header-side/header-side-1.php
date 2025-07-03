<?php

namespace EdCareCore\Widgets;

$cart_sidebar = get_theme_mod('edcare_cart_sidebar_switch', false);

function edcare_header_search_name()
{
    if (class_exists('SFWD_LMS')) {
        return 's';
    } elseif (class_exists('LearnPress')) {
        return 'search_for';
    } else {
        return 's';
    }
}

?>

<!-- search area start -->
<div class="tp-search-area">
    <div class="tp-search-inner p-relative">
        <div class="tp-search-close">
            <button class="tp-search-close-btn">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="path-1" d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path class="path-2" d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="container">
            <div class="row">
                <div class="tp-search-wrapper">
                    <div class="col-lg-9">
                        <div class="tp-search-content blue">
                            <div class="search p-relative">
                                <form action="<?php print esc_url(home_url('/courses')); ?>">
                                    <input type="text" class="search-input"
                                        placeholder="<?php print esc_attr__('What are you looking for?', 'tpcore'); ?>"
                                        name="<?php echo edcare_header_search_name(); ?>" value="<?php print esc_attr(get_search_query()) ?>">

                                    <button class="tp-search-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 18 18" fill="none">
                                            <path d="M13.3989 13.4001L16.9989 17.0001" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M15.3999 8.2001C15.3999 4.22366 12.1764 1.00012 8.19997 1.00012C4.22354 1.00012 1 4.22366 1 8.2001C1 12.1765 4.22354 15.4001 8.19997 15.4001C12.1764 15.4001 15.3999 12.1765 15.3999 8.2001Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <?php if(function_exists('tutor')) : ?>
                            <div class="tp-search-course-wrap">
                                <h3 class="tp-search-course-title">
                                    <?php print esc_html__('OUR TOP Program', 'tpcore'); ?>
                                </h3>

                                <?php

                                $desktop = "col-xl-" . esc_attr($settings['edcare_course_card_col_for_desktop']);
                                $laptop = "col-lg-" . esc_attr($settings['edcare_course_card_col_for_laptop']);
                                $tablet = "col-md-" . esc_attr($settings['edcare_course_card_col_for_tablet']);
                                $tablet = "col-md-" . esc_attr($settings['edcare_course_card_col_for_tablet']);
                                $mobile = "col-sm-" . esc_attr($settings['edcare_course_card_col_for_mobile']);
                                $xs = "col-" . esc_attr($settings['edcare_course_card_col_for_xs']);

                                $total_col = $desktop . " " . $laptop . " " . $tablet . " " . $mobile . " " . $xs;

                                ?>
                                <div class="row">
                                    <?php

                                    // settings control
                                    $posts_per_page = !empty($settings['posts_per_page']) ? $settings['posts_per_page'] : -1;
                                    $order = !empty($settings['order']) ? $settings['order'] : 'DESC';
                                    $order_by = !empty($settings['order_by']) ? $settings['order_by'] : 'date';

                                    $cat_list = !empty($settings['category']) ? $settings['category'] : [];
                                    $cat_exclude = !empty($settings['exclude_category']) ? $settings['exclude_category'] : [];
                                    $cat_include = !empty($settings['category']) ? $settings['category'] : [];

                                    $post_exclude = !empty($settings['post__not_in']) ? $settings['post__not_in'] : [];
                                    $post_include = !empty($settings['post__in']) ? $settings['post__in'] : [];
                                    $ignore_sticky_posts = (!empty($settings['ignore_sticky_posts']) && 'yes' == $settings['ignore_sticky_posts']) ? true : false;


                                    if (get_query_var('paged')) {
                                        $paged = get_query_var('paged');
                                    } else if (get_query_var('page')) {
                                        $paged = get_query_var('page');
                                    } else {
                                        $paged = 1;
                                    }

                                    $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
                                    $off = (!empty($offset_value)) ? $offset_value : 0;
                                    $offset = $off + (($paged - 1) * $posts_per_page);



                                    $args = array(
                                        'post_type' => 'courses',
                                        'post_status' => 'publish',
                                        'order' => $order,
                                        'offset' => $offset,
                                        'orderby' => $order_by,
                                        'posts_per_page' => $posts_per_page,
                                        'post__not_in' => $post_exclude,
                                        'post__in' => $post_include,
                                        'ignore_sticky_posts' => $ignore_sticky_posts
                                    );


                                    if (!empty($cat_include) && !empty($cat_exclude)) {
                                        $args['tax_query'] = array(
                                            'relation' => 'AND',
                                            array(
                                                'taxonomy' => 'category',
                                                'field' => 'slug',
                                                'terms' => $cat_include,
                                                'operator' => 'IN',
                                            ),
                                            array(
                                                'taxonomy' => 'category',
                                                'field' => 'slug',
                                                'terms' => $cat_exclude,
                                                'operator' => 'NOT IN',
                                            ),
                                        );
                                    } elseif (!empty($cat_list || $cat_exclude)) {
                                        $args['tax_query'] = array(
                                            array(
                                                'taxonomy' => 'category',
                                                'field' => 'slug',
                                                'terms' => !empty($cat_exclude) ? $cat_exclude : $cat_list,
                                                'operator' => !empty($cat_exclude) ? 'NOT IN' : 'IN',
                                            ),
                                        );
                                    }


                                    $main_query = new \WP_Query($args);
                                    ?>
                                    <?php if ($main_query->have_posts()): ?>
                                        <?php while ($main_query->have_posts()):
                                            $main_query->the_post();
                                            global $post, $authordata;

                                            $tutor_course_img = get_tutor_course_thumbnail_src();
                                            $course_id = get_the_ID();
                                            $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span>Free</span></span>";
                                            $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span>Free</span></span>";
                                            $course_rating = tutor_utils()->get_course_rating();
                                            ?>
                                            <div class="<?php echo esc_attr($total_col); ?>">
                                                <div class="tp-search-course-item mb-30">
                                                    <div class="tp-search-course-thumb mb-5">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <img class="course-pink"
                                                                src="<?php echo esc_url($tutor_course_img); ?>"
                                                                alt="<?php the_title(); ?>" loading="lazy">
                                                        </a>
                                                    </div>
                                                    <div class="tp-search-course-content">
                                                        <div class="tp-search-course-star tp-course-rating-icon">
                                                            <?php
                                                            $course_rating = tutor_utils()->get_course_rating();
                                                            tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                                            ?>
                                                        </div>

                                                        <h4 class="tp-search-course-item-title">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php echo wp_trim_words(get_the_title(), $settings['edcare_post_title_word'], ''); ?>
                                                            </a>
                                                        </h4>
                                                        <div class="tp-search-course-price">
                                                            <span><?php echo edcare_kses($price); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_postdata();
                                    endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- search area end -->


<!-- search area end -->

<?php if (!empty($cart_sidebar)): ?>
    <?php include (EDCARE_CORE_ELEMENTS_PATH . '/header-side/header-cart-mini.php'); ?>
<?php endif; ?>