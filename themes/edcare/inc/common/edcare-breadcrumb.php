<?php

/**
 * Breadcrumbs for EdCare theme.
 *
 * @package     EdCare
 * @author      RRDevs
 * @copyright   Copyright (c) 2025, RRDevs
 * @link        https://rrdevs.net/
 * @since       edcare 1.0.0
 */

function edcare_breadcrumb_func()
{
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    global $wp;

    $current_slug = add_query_arg(array(), $wp->request);


    if (is_front_page() && is_home()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'edcare'));
        $breadcrumb_class = 'home_front_page';
    } elseif (is_front_page()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'edcare'));
        $breadcrumb_show = 0;
    } elseif (is_home()) {
        if (get_option('page_for_posts')) {
            $title = get_the_title(get_option('page_for_posts'));
        }
    } elseif (is_single() && 'post' == get_post_type()) {
        $title = get_the_title();
    } elseif ('courses' == get_post_type()) {
        $title = esc_html__('All Courses', 'edcare');
    } elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
        $title = get_theme_mod( 'breadcrumb_shop', __( 'Shop', 'edcare' ) );
    }
     elseif (is_single() && 'product' == get_post_type()) {
        $title = get_theme_mod('breadcrumb_product_details', __('Shop', 'edcare'));
    } elseif (is_single() && 'courses' == get_post_type()) {
        $title = esc_html__('Course Details', 'edcare');
    } elseif (is_search()) {
        $title = esc_html__('Search Results for : ', 'edcare') . get_search_query();
    } elseif (is_404()) {
        $title = esc_html__('Page not Found', 'edcare');
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_dashboard_title($current_slug);
    }




    $_id = get_the_ID() ?? NULL;

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }




    // hide breadcrumb on single post
    $hide_breadcrumb_on_single_from_customizer = get_theme_mod('breadcrumb_on_single', false);

    // hide breadcrumb on single course
    $hide_breadcrumb_on_single_courses = get_theme_mod('breadcrumb_on_single_courses', false);

    // hide breadcrumb on product single from customizer
    $hide_breadcrumb_on_product_single_from_customizer = get_theme_mod('edcare_shop_single_details_breadcrumb_hide', false);
    // product single style
    $product_single_style = get_theme_mod('edcare_shop_single_details_style', 'style_default');


    // hide breadcrumb on single course page
    if ((is_single() && 'courses' == get_post_type()) && ($hide_breadcrumb_on_single_courses == false)) {
        return;
    }

    // hide breadcrumb on product single
    if (is_single() && 'product' == get_post_type() && $hide_breadcrumb_on_product_single_from_customizer == false && $product_single_style == 'style_grid') {
        return;
    }


    // hide breadcrumb from page
    $check_breadcrumb_from_page = function_exists('tpmeta_field') ? tpmeta_field('edcare_is_breadcrumb_on', $_id ? $_id : NULL) : '';

    // hide breadcrumb from customizer globally
    $check_breadcrumb_from_customizer = get_theme_mod('breadcrumb_switch', true);

    // hide breadcrumb shape from Customizer
    $breadcrumb_shape_switch = get_theme_mod('breadcrumb_shape_switch', false);


    // hide breadcrumb based on condition
    if ($check_breadcrumb_from_page == 'off' || $check_breadcrumb_from_customizer == false) {
        return;
    }


    if ($breadcrumb_show == 1) {
        $breadcrumb_attrs = array(
            'class' => 'page-header edcare-breadcrumb-padding ' . $breadcrumb_class,
        );

        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

        $filter_styles = ['style_1', 'style_2', 'style_3'];


        if ('courses' == get_post_type() && in_array($filter, $filter_styles)) {

            if ($filter == 'style_1') {
                $breadcrumb_space = " pt-150 pb-270 ";

            } elseif ($filter == 'style_2') {
                $breadcrumb_space = " pt-150 pb-450 ";

            } elseif ($filter == 'style_3') {
                $breadcrumb_space = " pt-150 pb-430 ";

            } else {
                $breadcrumb_space = " tp-course-filter-space ";
            }

            $breadcrumb_attrs_custom = $breadcrumb_space . $breadcrumb_class;


            ?>
            <section class="tp-course-filter-area tp-course-filter-bg p-relative <?php echo esc_attr($breadcrumb_attrs_custom) ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tp-breadcrumb__content-filter mb-50">
                                <div class="tp-breadcrumb__list">
                                    <span>
                                        <a href="<?php echo esc_url(home_url('/')); ?>">
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </a>
                                    </span>
                                    <span class="color"><?php esc_html_e('All Courses', 'edcare'); ?></span>
                                </div>
                                <h3 class="tp-breadcrumb__title"><?php esc_html_e('All Courses', 'edcare'); ?></h3>
                                <p><?php esc_html_e('We have the largest collection of', 'edcare'); ?>
                                    <span><?php esc_html_e('4650', 'edcare'); ?></span> <?php esc_html_e('courses', 'edcare'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            return;
        }// end course if

        // get tutor archive page id -> "this code is from tutor plugin" (tutor->classes->Option_V2.php)
        $page_args = array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'title' => 'Courses',
        );

        $page_posts = get_posts($page_args);
        $tutor_archive = (is_array($page_posts) && count($page_posts)) ? $page_posts[0] : null;


        // from page meta
        if ('courses' == get_post_type()) {
            $tp_breadcrumb_tabs = function_exists('tpmeta_field') ? tpmeta_field('edcare_breadcrumb_meta_tabs', $tutor_archive ? ($tutor_archive->ID ? $tutor_archive->ID : NULL) : NULL) : false;
            $elementor_breadcrumb_template_meta = function_exists('tpmeta_field') ? tpmeta_field('edcare_breadcrumb_meta_templates', $tutor_archive ? ($tutor_archive->ID ? $tutor_archive->ID : NULL) : false) : false;
        } else {
            $tp_breadcrumb_tabs = function_exists('tpmeta_field') ? tpmeta_field('edcare_breadcrumb_meta_tabs', $_id ? $_id : NULL) : false;
            $elementor_breadcrumb_template_meta = function_exists('tpmeta_field') ? tpmeta_field('edcare_breadcrumb_meta_templates', $_id ? $_id : NULL) : false;
        }


        // from customizer
        $edcare_breadcrumb_option_switch = get_theme_mod('edcare_breadcrumb_elementor_switch', false);
        $elementor_breadcrumb_templates_kirki = get_theme_mod('edcare_breadcrumb_templates_kirki');



        // breadcrumb bg  from page start
        $bg_img_from_page = function_exists('tpmeta_image_field') ? tpmeta_image_field('edcare_breadcrumb_bg') : '';
        $hide_bg_img = function_exists('tpmeta_image_field') ? tpmeta_image_field('edcare_check_bredcrumb_img') : 'on';

        $bg_img = get_theme_mod('breadcrumb_background_setting' , get_template_directory_uri() . '/assets/img/bg-img/page-header-bg.png');

        if ($hide_bg_img == 'off') {
            $bg_main_img = '';
        } else {
            $bg_main_img = !empty($bg_img_from_page) ? $bg_img_from_page['url'] : $bg_img;
        }

        //breadcrumb bg  from page end


        if (($tp_breadcrumb_tabs == 'elementor' || $edcare_breadcrumb_option_switch) && !($tp_breadcrumb_tabs == 'custom')) {
            if ($elementor_breadcrumb_template_meta) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_breadcrumb_template_meta);
            } else {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_breadcrumb_templates_kirki);
            }
        } else {

            ?>


        <section <?php edcare_html_attrs($breadcrumb_attrs) ?>>
            <div class="bg-item">

                <div class="bg-img" data-background="<?php print esc_attr(is_array($bg_main_img) && array_key_exists('background-image', $bg_main_img) ? $bg_main_img['background-image'] : $bg_main_img); ?>"></div>

                <div class="overlay"></div>

                <?php if(!empty($breadcrumb_shape_switch)) : ?>
                <div class="shapes">
                    <div class="shape shape-1">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/page-header-shape-1.png' ); ?>" alt="<?php echo esc_attr__('shape', 'edcare'); ?>" >
                    </div>

                    <div class="shape shape-2">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/page-header-shape-2.png' ); ?>" alt="<?php echo esc_attr__('shape', 'edcare'); ?>" >
                    </div>

                    <div class="shape shape-3">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/page-header-shape-3.png' ); ?>" alt="<?php echo esc_attr__('shape', 'edcare'); ?>" >
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="container">
                <div class="page-header-content">

                    <h1 class="title rr_edcare_breadcrumb__title"><?php echo edcare_kses($title); ?></h1>

                    <h4 class="sub-title">
                        <a class="home" href="<?php print esc_url(home_url('/')); ?>">Home</a>
                        <span class="icon">/</span>
                        <a class="inner-page" href="<?php the_permalink(); ?>"> <?php echo edcare_kses($title); ?></a>
                    </h4>

                </div>
            </div>
        </section>



            <?php
        }
    }
}
add_action('edcare_before_main_content', 'edcare_breadcrumb_func');