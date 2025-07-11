<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package edcare
 */

/**
 *
 * edcare header
 */
function get_header_style($style)
{
    if ($style == 'header_2') {
        get_template_part('template-parts/header/header-2');
    } else {
        get_template_part('template-parts/header/header-1');
    }
}



function edcare_check_header()
{
    $tp_header_tabs = function_exists('tpmeta_field') ? tpmeta_field('edcare_header_tabs') : false;
    $tp_header_style_meta = function_exists('tpmeta_field') ? tpmeta_field('edcare_header_style') : '';
    $elementor_header_template_meta = function_exists('tpmeta_field') ? tpmeta_field('edcare_header_templates') : false;


    $edcare_header_option_switch = get_theme_mod('edcare_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod('header_layout_custom', 'header_1');
    $elementor_header_templates_kirki = get_theme_mod('edcare_header_templates');

    if ($tp_header_tabs == 'default') {
        if ($edcare_header_option_switch) {
            if ($elementor_header_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        } else {
            if ($header_default_style_kirki) {
                get_header_style($header_default_style_kirki);
            } else {
                get_template_part('template-parts/header/header-1');
            }
        }
    } elseif ($tp_header_tabs == 'custom') {
        if ($tp_header_style_meta) {
            get_header_style($tp_header_style_meta);
        } else {
            get_header_style($header_default_style_kirki);
        }
    } elseif ($tp_header_tabs == 'elementor') {
        if ($elementor_header_template_meta) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        } else {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    } else {
        if ($edcare_header_option_switch) {

            if ($elementor_header_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            } else {
                get_template_part('template-parts/header/header-1');
            }
        } else {
            get_header_style($header_default_style_kirki);
        }
    }
}
add_action('edcare_header_style', 'edcare_check_header', 10);


/* edcare offcanvas */

function edcare_check_offcanvas()
{
    $edcare_offcanvas_style = function_exists('tpmeta_field') ? tpmeta_field('edcare_offcanvas_style') : NULL;
    $edcare_default_offcanvas_style = get_theme_mod('choose_default_offcanvas', 'offcanvas-style-1');

    if ($edcare_offcanvas_style == 'offcanvas-style-1') {
        get_template_part('template-parts/offcanvas/offcanvas-1');
    } elseif ($edcare_offcanvas_style == 'offcanvas-style-2') {
        get_template_part('template-parts/offcanvas/offcanvas-2');
    } else {
        if ($edcare_default_offcanvas_style == 'offcanvas-style-2') {
            get_template_part('template-parts/offcanvas/offcanvas-2');
        } else {
            get_template_part('template-parts/offcanvas/offcanvas-1');
        }
    }
}

add_action('edcare_offcanvas_style', 'edcare_check_offcanvas', 10);

// edcare_header_lang_defualt
function edcare_header_lang_defualt()
{
    ?>
    <ul>
        <li>

            <a id="header-bottom__lang-toggle" href="javascript:void(0)">
                <span>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/flag/flag-1.png" alt="">
                    <?php echo esc_html__('English', 'edcare'); ?>
                </span>

                <span>
                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.15067 0.653687C1.33329 0.4674 1.61907 0.450465 1.82045 0.602881L1.87814 0.653687L6 4.85839L10.1219 0.653687C10.3045 0.4674 10.5903 0.450465 10.7916 0.602881L10.8493 0.653687C11.032 0.839974 11.0486 1.13148 10.8991 1.3369L10.8493 1.39575L6.36374 5.97131C6.18111 6.1576 5.89534 6.17454 5.69396 6.02212L5.63626 5.97131L1.15067 1.39575C0.949778 1.19084 0.949778 0.858603 1.15067 0.653687Z"
                            fill="white" stroke="white" stroke-width="0.5"></path>
                    </svg>
                </span>
            </a>
            <?php do_action('edcare_header_language'); ?>
            <?php
}

/**
 * [edcare_language_list description]
 * @return [type] [description]
 */
function _edcare_header_language($mar)
{
    return $mar;
}
function edcare_header_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="header-bottom__lang-submenu">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'edcare') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'edcare') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'edcare') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _edcare_header_language($mar);
}
add_action('edcare_header_language', 'edcare_header_language_list');


// edcare_footer_lang_defualt
function edcare_footer_lang_defualt()
{
    ?>
            <ul>
                <li>

                    <a id="header-bottom__lang-toggle" href="javascript:void(0)">
                        <span><?php echo esc_html__('EN', 'edcare'); ?></span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 1L5 5L9 1" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>

                    <?php do_action('edcare_language'); ?>

                    <?php
}

/**
 * [edcare_language_list description]
 * @return [type] [description]
 */
function _edcare_language($mar)
{
    return $mar;
}
function edcare_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="header-bottom__lang-submenu-2">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'edcare') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'edcare') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'edcare') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _edcare_language($mar);
}
add_action('edcare_language', 'edcare_language_list');


/**
 * [edcare_offcanvas_language description]
 * @return [type] [description]
 */


/**
 * [edcare_header_lang description]
 * @return [type] [description]
 */
function edcare_offcanvas_lang_defualt()
{
    ?>

        <div class="offcanvas__select language">
            <div class="offcanvas__lang d-flex align-items-center justify-content-md-end">
                <div class="offcanvas__lang-img mr-15">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon/language-flag.png"
                        alt="<?php echo esc_attr__('language', 'edcare'); ?>">
                </div>

                <div class="offcanvas__lang-wrapper">
                    <span class="offcanvas__lang-selected-lang tp-lang-toggle"
                        id="tp-offcanvas-lang-toggle"><?php echo esc_html__('English', 'edcare'); ?></span>
                    <?php do_action('edcare_offcanvas_language'); ?>
                </div>
            </div>
        </div>
    <?php
}
function _edcare_offcanvas_language($mar)
{
    return $mar;
}
function edcare_offcanvas_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="offcanvas__lang-list tp-lang-list">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="offcanvas__lang-list tp-lang-list">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'edcare') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'edcare') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'edcare') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _edcare_language($mar);
}
add_action('edcare_offcanvas_language', 'edcare_offcanvas_language_list');



/**
 * [edcare_language_list description]
 * @return [type] [description]
 */
function _edcare_footer_language($mar)
{
    return $mar;
}
function edcare_footer_language_list()
{
    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="footer__lang-list tp-lang-list-2">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="footer__lang-list tp-lang-list-2">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'edcare') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'edcare') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'edcare') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _edcare_footer_language($mar);
}
add_action('edcare_footer_language', 'edcare_footer_language_list');



// header logo
function edcare_header_logo()
{ ?>
    <?php

        $edcare_logo_black_dir = get_template_directory_uri() . '/assets/img/logo/logo-black.png';
        $edcare_logo_white_dir = get_template_directory_uri() . '/assets/img/logo/logo.png';

        // logo from customizer
        $edcare_logo_white = get_theme_mod('header_logo_white', $edcare_logo_white_dir);
        $edcare_logo_black = get_theme_mod('header_logo_black', $edcare_logo_black_dir);


        // logo settings from meta
        $logo_black_from_page = function_exists('tpmeta_field') ? tpmeta_image_field('edcare_logo_black') : NULL;
        $logo_white_from_page = function_exists('tpmeta_field') ? tpmeta_image_field('edcare_logo_white') : NULL;


        $logo_white = !empty($logo_white_from_page) ? $logo_white_from_page['url'] : $edcare_logo_white;
        $logo_black = !empty($logo_black_from_page) ? $logo_black_from_page['url'] : $edcare_logo_black;

        ?>

        <a class="logo-1 edcare-logo-black edcare-site-logo" href="<?php print esc_url(home_url('/')); ?>">
            <img src="<?php print esc_url($logo_black); ?>"
                alt="<?php print esc_attr__('edcare Logo', 'edcare'); ?>">
        </a>
    <?php
}

/**
 * [edcare_header_menu description]
 * @return [type] [description]
 */
function edcare_header_menu()
{
    ?>
    <?php
    wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class' => 'sub-menu',
        'container' => '',
        'fallback_cb' => 'edcare_Navwalker_Class::fallback',
        'walker' => new \EdCareCore\Widgets\edcare_Navwalker_Class,
    ]);
    ?>
    <?php
}

/**
 * [edcare_language_menu description]
 * @return [type] [description]
 */
function edcare_language_menu()
{
    ?>
        <?php
        wp_nav_menu([
            'theme_location' => 'tp-language-menu',
            'menu_class' => '',
            'container' => '',
            'fallback_cb' => 'edcare_Navwalker_Class::fallback',
            'walker' => new \EdCareCore\Widgets\edcare_Navwalker_Class,
        ]);
        ?>
    <?php
}


/**
 *
 * edcare footer
 */
add_action('edcare_footer_style', 'edcare_check_footer', 10);

function get_footer_style($style)
{
    if ($style == 'footer_2') {
        get_template_part('template-parts/footer/footer-2');
    } else {
        get_template_part('template-parts/footer/footer-1');
    }
}

function edcare_check_footer()
{
    global $post;

    $_id = get_the_ID() ?? NULL;

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }


    $tp_footer_tabs = function_exists('tpmeta_field') ? tpmeta_field('edcare_footer_tabs', $_id ? $_id : NULL) : false;
    $tp_footer_style_meta = function_exists('tpmeta_field') ? tpmeta_field('edcare_footer_style', $_id ? $_id : NULL) : '';
    $elementor_footer_template_meta = function_exists('tpmeta_field') ? tpmeta_field('edcare_footer_templates', $_id ? $_id : NULL) : false;

    $edcare_footer_option_switch = get_theme_mod('edcare_footer_elementor_switch', false);
    $footer_default_style_kirki = get_theme_mod('footer_layout_custom', 'footer_1');
    $elementor_footer_templates_kirki = get_theme_mod('edcare_footer_templates');

    if ($tp_footer_tabs == 'default') {
        if ($edcare_footer_option_switch) {
            if ($elementor_footer_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            }
        } else {
            if ($footer_default_style_kirki) {
                get_footer_style($footer_default_style_kirki);
            } else {
                get_template_part('template-parts/footer/footer-1');
            }
        }
    } elseif ($tp_footer_tabs == 'custom') {
        if ($tp_footer_style_meta) {
            get_footer_style($tp_footer_style_meta);
        } else {
            get_footer_style($footer_default_style_kirki);
        }
    } elseif ($tp_footer_tabs == 'elementor') {
        if ($elementor_footer_template_meta) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template_meta);
        } else {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        }
    } else {
        if ($edcare_footer_option_switch) {

            if ($elementor_footer_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            } else {
                get_template_part('template-parts/footer/footer-1');
            }
        } else {
            get_footer_style($footer_default_style_kirki);
        }
    }
}

// edcare_copyright_text
function edcare_copyright_text()
{
    print get_theme_mod('edcare_copyright', esc_html__('Copyright © 2025 EdCare. All Rights Reserved.', 'edcare'));
}


/**
 *
 * pagination
 */
if (!function_exists('edcare_pagination')) {

    function _edcare_pagi_callback($pagination)
    {
        return $pagination;
    }

    //page navegation
    function edcare_pagination($prev, $next, $pages, $args)
    {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        $pagination = [
            'base' => add_query_arg('paged', '%#%'),
            'format' => '',
            'total' => $pages,
            'current' => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type' => 'array',
        ];

        //rewrite permalinks
        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = ['s' => get_query_var('s')];
        }

        $pagi = '';
        if (paginate_links($pagination) != '') {
            $paginations = paginate_links($pagination);
            $pagi .= '<ul class="pagination-wrap mt-20 text-left">';
            foreach ($paginations as $key => $pg) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _edcare_pagi_callback($pagi);
    }
}

function edcare_arr_to_string(array $array = [])
{
    $result = "";
    foreach ($array as $key => $value) {
        $result .= $key . ": " . $value . "; ";
    }
    return $result;
}

function edcare_breadcrumb_typography()
{
    $typo_for_desktop = get_theme_mod('breadcrumb_typography_desktop');
    $typo_for_tablet = get_theme_mod('breadcrumb_typography_tablet');
    $typo_for_mobile = get_theme_mod('breadcrumb_typography_mobile');

    wp_enqueue_style('edcare-breadcrumb-typo', EDCARE_THEME_CSS_DIR . 'edcare-custom.css', []);

    if ($typo_for_desktop) {
        $typo = '';
        $typo .= '.breadcrumb__title{' . edcare_arr_to_string($typo_for_desktop) . '}';
        if (array_key_exists('text-align', $typo_for_desktop)) {
            $typo .= '.breadcrumb_content{text-align : ' . $typo_for_desktop['text-align'] . '}';
        }
        wp_add_inline_style('edcare-breadcrumb-typo', $typo);
    }
    if ($typo_for_tablet) {
        $typo = '';
        $typo .= '@media (max-width: 991px){.breadcrumb__title{' . edcare_arr_to_string($typo_for_tablet) . '}}';
        if (array_key_exists('text-align', $typo_for_mobile)) {
            $typo .= '@media (max-width: 991px){.breadcrumb_content{text-align : ' . $typo_for_tablet['text-align'] . '}}';
        }
        wp_add_inline_style('edcare-breadcrumb-typo', $typo);
    }
    if ($typo_for_mobile) {
        $typo = '';
        $typo .= '@media (max-width: 767px){.breadcrumb__title{' . edcare_arr_to_string($typo_for_mobile) . '}}';
        if (array_key_exists('text-align', $typo_for_mobile)) {
            $typo .= '@media (max-width: 767px){.breadcrumb_content{text-align : ' . $typo_for_mobile['text-align'] . '}}';
        }
        wp_add_inline_style('edcare-breadcrumb-typo', $typo);
    }
}
add_action('wp_enqueue_scripts', 'edcare_breadcrumb_typography');


// edcare_breadcrumb_bg_settings
function edcare_breadcrumb_bg_settings()
{
    global $post;
    $_id = get_the_ID();
    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $bg_color = function_exists('tpmeta_field') ? tpmeta_field('edcare_breadcrumb_bg_color', $_id ? $_id : NULL) : '';
    $bg_img = function_exists('tpmeta_image_field') ? tpmeta_image_field('edcare_breadcrumb_bg', $_id ? $_id : NULL) : '';
    wp_enqueue_style('edcare-breadcrumb-bg-settings', EDCARE_THEME_CSS_DIR . 'edcare-custom.css', []);

    if ($bg_color != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb__area.edcare-breadcrumb-padding { background-color: " . $bg_color . " ; background-image: url(" . $bg_img['url'] . ")}";

        wp_add_inline_style('edcare-breadcrumb-bg-settings', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edcare_breadcrumb_bg_settings');


// edcare_footer_bg_settings
function edcare_footer_bg_settings()
{
    global $post;
    $_id = get_the_ID();
    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $bg_color = function_exists('tpmeta_field') ? tpmeta_field('edcare_footer_bg_color', $_id ? $_id : NULL) : '';
    $bg_img = function_exists('tpmeta_image_field') ? tpmeta_image_field('edcare_footer_bg', $_id ? $_id : NULL) : '';
    $bg_img = !empty($bg_img['url']) ? $bg_img['url'] : '';
    wp_enqueue_style('edcare-footer-bg-settings', EDCARE_THEME_CSS_DIR . 'edcare-custom.css', []);

    if ($bg_color != '') {
        $custom_css = '';
        $custom_css .= "div.edcare-footer-settings { background-color: " . $bg_color . " ; background-image: url(" . $bg_img . "); background-size: cover; background-position: center; background-repeat: no-repeat;}";

        wp_add_inline_style('edcare-footer-bg-settings', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edcare_footer_bg_settings');


// theme color
function edcare_custom_color()
{
    $edcare_theme_color_1 = get_theme_mod('edcare_theme_color_1', '#07A698');
    $edcare_theme_color_2 = get_theme_mod('edcare_theme_color_2', '#162726');
    $edcare_theme_color_3 = get_theme_mod('edcare_theme_color_3', '#F2F4F7');
    $edcare_theme_color_4 = get_theme_mod('edcare_theme_color_4', '#6C706F');
    $edcare_theme_color_5 = get_theme_mod('edcare_theme_color_5', '#ffffff');
    $edcare_theme_color_6 = get_theme_mod('edcare_theme_color_6', '#000000');
    $edcare_theme_color_7 = get_theme_mod('edcare_theme_color_7', '#0E121D');
    $edcare_theme_color_8 = get_theme_mod('edcare_theme_color_8', '#191A1F');
    $edcare_theme_color_9 = get_theme_mod('edcare_theme_color_9', '#E0E5EB');

    wp_enqueue_style('edcare-custom', EDCARE_THEME_CSS_DIR . 'edcare-custom.css', []);

    if (!empty($edcare_theme_color_1 || $edcare_theme_color_2 || $edcare_theme_color_3 || $edcare_theme_color_4 || $edcare_theme_color_5 || $edcare_theme_color_6 || $edcare_theme_color_7 || $edcare_theme_color_8 || $edcare_theme_color_9 )) {
        $custom_css = '';
        $custom_css .= "html:root{
            --ed-color-theme-primary: " . $edcare_theme_color_1 . ";
            --ed-color-heading-primary: " . $edcare_theme_color_2 . ";
            --ed-color-grey-1: " . $edcare_theme_color_3 . ";
            --ed-color-text-body: " . $edcare_theme_color_4 . ";
            --ed-color-common-white: " . $edcare_theme_color_5 . ";
            --ed-color-common-black: " . $edcare_theme_color_6 . ";
            --ed-color-bg-1: " . $edcare_theme_color_7 . ";
            --ed-color-bg-2: " . $edcare_theme_color_8 . ";
            --ed-color-border-1: " . $edcare_theme_color_9 . ";
        }";

        wp_add_inline_style('edcare-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edcare_custom_color');


// edcare_kses_intermediate
function edcare_kses_intermediate($string = '')
{
    return wp_kses($string, edcare_get_allowed_html_tags('intermediate'));
}

function edcare_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
        'a' => [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function edcare_kses($raw)
{

    $allowed_tags = array(
        'a' => array(
            'class' => array(),
            'href' => array(),
            'rel' => array(),
            'title' => array(),
            'target' => array(),
            'aria-label' => array(),
            'data-course-id' => array(),
            'data-*' => array(),
            'data-quantity' => array(),
            'data-product_sku' => array(),
        ),
        'abbr' => array(
            'title' => array(),
        ),
        'b' => array(),
        'blockquote' => array(
            'cite' => array(),
        ),
        'cite' => array(
            'title' => array(),
        ),
        'code' => array(),
        'del' => array(
            'datetime' => array(),
            'title' => array(),
        ),
        'dd' => array(),
        'div' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
            'id' => array(),
            'aria-labelledby' => array(),
            'aria-hidden' => array(),
            'data-*' => array(),
            'role' => array(),
        ),
        'dl' => array(),
        'dt' => array(),
        'em' => array(),
        'h1' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h2' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h3' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h4' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h5' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h6' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'i' => array(
            'class' => array(),
        ),
        'img' => array(
            'alt' => array(),
            'class' => array(),
            'height' => array(),
            'src' => array(),
            'width' => array(),
            'loading' => array(),
        ),
        'li' => array(
            'class' => array(),
        ),
        'ol' => array(
            'class' => array(),
        ),
        'p' => array(
            'class' => array(),
        ),
        'q' => array(
            'cite' => array(),
            'title' => array(),
        ),
        'span' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
            'data-cat-color' => array(),
            'data-rating-value' => array(),
            'area-current' => array(),
        ),
        'iframe' => array(
            'width' => array(),
            'height' => array(),
            'scrolling' => array(),
            'frameborder' => array(),
            'allow' => array(),
            'src' => array(),
        ),
        'strike' => array(),
        'br' => array(),
        'strong' => array(),
        'data-wow-duration' => array(),
        'data-wow-delay' => array(),
        'data-wallpaper-options' => array(),
        'data-stellar-background-ratio' => array(),
        'ul' => array(
            'class' => array(),
        ),
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'opacity' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'fill' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g' => array('fill' => true),
        'title' => array('title' => true),
        'path' => array(
            'd' => true,
            'fill' => true,
            'opacity' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,

        ),
        'nav' => array(
            'class' => array(),
            'id' => array(),
            'data-tutor_pagination_ajax' => array(),
            'data-push_state_link' => array(),
        ),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter('get_archives_link', 'edcare_archive_count_span');
function edcare_archive_count_span($links)
{
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'edcare_cat_count_span');
function edcare_cat_count_span($links)
{
    $links = str_replace('</a> (', '<span> (', $links);
    $links = str_replace(')', ')</span></a>', $links);
    return $links;
}


function edcare_html_attrs(array $raw_attributes)
{
    $attributes = array();
    foreach ($raw_attributes as $name => $value) {
        $attributes[] = esc_attr($name) . '="' . esc_attr($value) . '"';
    }

    printf(' %s', implode(' ', $attributes));
}


if (function_exists('tutor')) {
    // add color field to course taxonomy

    function add_edcare_course_color_category($term = null)
    {
        ?>
            <?php if (!is_object($term)): ?>
                <div class="form-field term-color-wrap">
                    <label><?php echo esc_html__('Add Color Code', 'edcare'); ?></label>
                    <div>
                        <input type="text" name="_edcare_course_cat_color">
                    </div>
                </div>
            <?php else: ?>

                <tr class="form-field term-thumbnail-wrap">
                    <th scope="tutor-row" valign="top"><label><?php echo esc_html__('Color', 'edcare'); ?></label></th>
                    <td>
                        <div class="form-field term-color-wrap">
                            <div>
                                <input type="text" name="_edcare_course_cat_color"
                                    value="<?php echo esc_html(get_term_meta($term->term_id, '_edcare_course_cat_color', true)); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        <?php
    }

    add_action('course-category_add_form_fields', 'add_edcare_course_color_category');
    add_action('course-category_edit_form_fields', 'add_edcare_course_color_category', 10, 1);

    function save_edcare_course_color_value($term_id)
    {


        if (isset($_POST['_edcare_course_cat_color']) && !empty($_POST['_edcare_course_cat_color'])) {
            update_term_meta($term_id, '_edcare_course_cat_color', $_POST['_edcare_course_cat_color']);
        }
    }

    add_action('create_course-category', 'save_edcare_course_color_value', 10, 1);
    add_action('edited_course-category', 'save_edcare_course_color_value', 10, 1);


    function add_edcare_course_color_column($columns)
    {
        $new_columns = $columns;
        $new_columns['edcare_course_color'] = __('Color', 'edcare');

        return $new_columns;
    }

    add_filter('manage_edit-course-category_columns', 'add_edcare_course_color_column', 10, 1);


    function display_edcare_course_color_column_value($row, $column_name, $term_id)
    {
        if ($column_name == 'edcare_course_color') {
            $row .= get_term_meta($term_id, '_edcare_course_cat_color', true);
        }

        return $row;
    }

    add_filter('manage_course-category_custom_column', 'display_edcare_course_color_column_value', 10, 3);

    function edcare_course_listing_filter($args)
    {
        if (isset($_POST['tutor-course-filter-instructor'])) {
            $args['author'] = is_array($_POST['tutor-course-filter-instructor']) ? implode(',', $_POST['tutor-course-filter-instructor']) : sanitize_text_field($_POST['tutor-course-filter-instructor']);
        }
        return $args;
    }
    add_filter('tutor_course_filter_args', 'edcare_course_listing_filter');
}


if (function_exists('tutor') && class_exists('WooCommerce')) {

    function edcare_lms_sale_percentage()
    {
        $course_id = get_the_ID();
        $product_id = tutor_utils()->get_course_product_id($course_id);
        $product = wc_get_product($product_id);
        $output = '';
        $icon = esc_html__("-", 'edcare');

        if ($product) {

            if ($product->is_on_sale() && $product->is_type('variable')) {
                $percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price('min')) * 100);
                $output .= '<span>' . $icon . $percentage . '%</span>';
            } elseif ($product->is_on_sale() && $product->get_regular_price() && !$product->is_type('grouped')) {
                $percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
                $output .= '<span>' . $icon . $percentage . '%</span>';
            }
            return $output;
        }
        return $output;
    }
}

if (function_exists('tutor')) {

    function edcare_lms_layout($layout_path)
    {
        if ((isset($the_query) && $the_query->have_posts()) || have_posts()) {

            tutor_course_loop_start();
            while (isset($the_query) ? $the_query->have_posts() : have_posts()) {
                isset($the_query) ? $the_query->the_post() : the_post();

                do_action('tutor_course/archive/before_loop_course');

                tutor_load_template($layout_path);
                do_action('tutor_course/archive/after_loop_course');
            }
            tutor_course_loop_end();
        } else {
            tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text());
        }
    }


    function edcare_lms_social_icons($icons)
    {
        $new_icons = $icons;

        $new_icons['_tutor_profile_instagram'] = array(
            'label' => __('Instagram', 'edcare'),
            'placeholder' => 'https://instagram.com/username',
            'icon_classes' => 'tutor-icon-brand-instagram',
        );

        $new_icons['_tutor_profile_youtube'] = array(
            'label' => __('Youtube', 'edcare'),
            'placeholder' => 'https://youtube.com/username',
            'icon_classes' => 'fa-brands fa-youtube',
        );

        return $new_icons;
    }
    add_filter('tutor_user_social_icons', 'edcare_lms_social_icons', 10, 1);

    function get_lsm_dashboard_menu_icon($dashboard_key)
    {
        $dashboard_svg = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M16.0041 5.216V1.584C16.0041 0.456 15.4921 0 14.2201 0H10.9881C9.7161 0 9.2041 0.456 9.2041 1.584V5.208C9.2041 6.344 9.7161 6.792 10.9881 6.792H14.2201C15.4921 6.8 16.0041 6.344 16.0041 5.216Z" fill="currentColor"></path>
                    <path d="M16.0041 14.216V10.984C16.0041 9.71195 15.4921 9.19995 14.2201 9.19995H10.9881C9.7161 9.19995 9.2041 9.71195 9.2041 10.984V14.216C9.2041 15.488 9.7161 16 10.9881 16H14.2201C15.4921 16 16.0041 15.488 16.0041 14.216Z" fill="currentColor"></path>
                    <path d="M6.8 5.216V1.584C6.8 0.456 6.288 0 5.016 0H1.784C0.512 0 0 0.456 0 1.584V5.208C0 6.344 0.512 6.792 1.784 6.792H5.016C6.288 6.8 6.8 6.344 6.8 5.216Z" fill="currentColor"></path>
                    <path opacity="0.4" d="M6.8 14.216V10.984C6.8 9.71195 6.288 9.19995 5.016 9.19995H1.784C0.512 9.19995 0 9.71195 0 10.984V14.216C0 15.488 0.512 16 1.784 16H5.016C6.288 16 6.8 15.488 6.8 14.216Z" fill="currentColor"></path>
                </svg>';

        $my_profile_svg = '<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M7.98015 8.78062C10.4049 8.78062 12.3705 6.81501 12.3705 4.39031C12.3705 1.96561 10.4049 0 7.98015 0C5.55545 0 3.58984 1.96561 3.58984 4.39031C3.58984 6.81501 5.55545 8.78062 7.98015 8.78062Z" fill="currentColor"></path><path d="M7.98158 10.9755C3.58249 10.9755 0 13.9258 0 17.5609C0 17.8068 0.193174 18 0.439031 18H15.5241C15.77 18 15.9632 17.8068 15.9632 17.5609C15.9632 13.9258 12.3807 10.9755 7.98158 10.9755Z" fill="currentColor"></path>
                    </svg>';
        $enrolled_coruses_svg = '<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.4" d="M13.4349 9.71387V13.9033C13.4349 14.9826 12.593 16.1383 11.581 16.4782L8.86831 17.379C8.3921 17.5404 7.61825 17.5404 7.15054 17.379L4.43782 16.4782C3.41736 16.1383 2.58398 14.9826 2.58398 13.9033L2.59249 9.71387L6.35118 12.1613C7.26959 12.7646 8.78328 12.7646 9.70169 12.1613L13.4349 9.71387Z" fill="currentColor"></path><path d="M14.7945 4.29218L9.70074 0.952512C8.78233 0.349163 7.26865 0.349163 6.35023 0.952512L1.23093 4.29218C-0.41031 5.35441 -0.41031 7.75931 1.23093 8.83004L2.59154 9.71382L6.35023 12.1612C7.26865 12.7646 8.78233 12.7646 9.70074 12.1612L13.4339 9.71382L14.5989 8.94901V11.5494C14.5989 11.8978 14.8881 12.1867 15.2367 12.1867C15.5854 12.1867 15.8745 11.8978 15.8745 11.5494V7.36841C16.2147 6.27218 15.866 4.9975 14.7945 4.29218Z" fill="currentColor"></path>
            </svg>';

        $wishlist_svg = '<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.4" d="M11.9733 0.5H3.78189C1.97198 0.5 0.501953 1.97852 0.501953 3.77994V15.7526C0.501953 17.2821 1.5981 17.9279 2.94067 17.1886L7.08733 14.8859C7.52919 14.6394 8.24295 14.6394 8.67632 14.8859L12.823 17.1886C14.1655 17.9364 15.2617 17.2906 15.2617 15.7526V3.77994C15.2532 1.97852 13.7832 0.5 11.9733 0.5Z" fill="currentColor"></path><path d="M10.0031 8.48736H5.75448C5.40609 8.48736 5.11719 8.19845 5.11719 7.85006C5.11719 7.50168 5.40609 7.21277 5.75448 7.21277H10.0031C10.3515 7.21277 10.6404 7.50168 10.6404 7.85006C10.6404 8.19845 10.3515 8.48736 10.0031 8.48736Z" fill="currentColor"></path>
         </svg>';

        $review_svg = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M9.2432 0.516728L11.1181 4.28454C11.2563 4.55752 11.5199 4.74709 11.824 4.78922L16.0354 5.40258C16.2813 5.43712 16.5045 5.56687 16.6553 5.76487C16.8044 5.96034 16.8684 6.20804 16.8322 6.45153C16.8027 6.65374 16.7075 6.84079 16.5618 6.98402L13.5102 9.94215C13.287 10.1486 13.1859 10.4544 13.2398 10.7535L13.9912 14.9123C14.0712 15.4144 13.7385 15.8879 13.2398 15.9831C13.0343 16.016 12.8238 15.9814 12.6385 15.8871L8.88186 13.9299C8.60306 13.7892 8.27373 13.7892 7.99493 13.9299L4.23834 15.8871C3.77676 16.1322 3.20485 15.9654 2.94796 15.5105C2.85278 15.3293 2.81909 15.1229 2.85025 14.9215L3.60157 10.7619C3.65548 10.4637 3.55356 10.1562 3.3312 9.94973L0.279593 6.99328C-0.0834322 6.64279 -0.094382 6.06565 0.255167 5.70252C0.262747 5.69494 0.27117 5.68651 0.279593 5.67809C0.424466 5.53065 0.614823 5.43712 0.820341 5.41269L5.03177 4.79848C5.33499 4.75551 5.59863 4.56763 5.73761 4.29296L7.54515 0.516728C7.70603 0.193195 8.03957 -0.00817085 8.40176 0.000254489H8.51462C8.8288 0.0381685 9.10254 0.232794 9.2432 0.516728Z" fill="currentColor"></path><path d="M8.41433 13.8249C8.25121 13.83 8.0923 13.8738 7.94936 13.9522L4.21113 15.905C3.75373 16.1232 3.20637 15.9538 2.94992 15.5164C2.85491 15.3378 2.82044 15.133 2.85239 14.9324L3.59903 10.7816C3.64947 10.4799 3.54858 10.1731 3.32913 9.96072L0.276158 7.00503C-0.08623 6.65022 -0.0929565 6.06784 0.261864 5.7046C0.266909 5.69954 0.271113 5.69533 0.276158 5.69111C0.420776 5.54784 0.607436 5.45344 0.808388 5.42395L5.02335 4.80365C5.32857 4.76488 5.59342 4.57441 5.72795 4.29797L7.56007 0.474205C7.73411 0.165741 8.06791 -0.0179882 8.42105 0.0013961C8.41433 0.251707 8.41433 13.6547 8.41433 13.8249Z" fill="currentColor"></path>
         </svg>';

        $my_quiz_svg = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M15.6046 14.1807H10.543C10.0491 14.1807 9.64746 14.5887 9.64746 15.0903C9.64746 15.5929 10.0491 16 10.543 16H15.6046C16.0984 16 16.5001 15.5929 16.5001 15.0903C16.5001 14.5887 16.0984 14.1807 15.6046 14.1807Z" fill="currentColor"></path>
            <path d="M6.99695 3.47017L11.7933 7.34584C11.909 7.43852 11.9288 7.60861 11.8385 7.7271L6.15226 15.1363C5.79481 15.594 5.26805 15.853 4.70366 15.8625L1.59953 15.9008C1.43397 15.9027 1.28911 15.788 1.25149 15.6237L0.546005 12.5564C0.423721 11.9926 0.546005 11.4097 0.90345 10.9606L6.61788 3.51604C6.71006 3.3966 6.88031 3.37557 6.99695 3.47017Z" fill="currentColor"></path>
            <path opacity="0.4" d="M13.9408 5.03598L13.0162 6.19027C12.9231 6.3078 12.7556 6.32691 12.6399 6.23327C11.5159 5.3236 8.63749 2.98922 7.83888 2.34232C7.72224 2.24676 7.70625 2.07668 7.80031 1.95819L8.69204 0.850724C9.501 -0.190813 10.912 -0.286367 12.0501 0.621394L13.3576 1.66293C13.8938 2.08337 14.2513 2.63758 14.3735 3.22046C14.5146 3.86162 14.3641 4.49132 13.9408 5.03598Z" fill="currentColor"></path>
         </svg>';

        $purchase_history_svg = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M14.2903 2.86564H13.9703L11.2667 0.16198C11.0507 -0.0539932 10.6987 -0.0539932 10.4748 0.16198C10.2588 0.377953 10.2588 0.729909 10.4748 0.953881L12.3865 2.86564H4.61149L6.52325 0.953881C6.73922 0.737908 6.73922 0.385952 6.52325 0.16198C6.30727 -0.0539932 5.95532 -0.0539932 5.73135 0.16198L3.03568 2.86564H2.71572C1.99581 2.86564 0.5 2.86564 0.5 4.91339C0.5 5.68929 0.65998 6.20122 0.995938 6.53718C1.18791 6.73716 1.41989 6.84114 1.66785 6.89714C1.89982 6.95313 2.14779 6.96113 2.38776 6.96113H14.6102C14.8582 6.96113 15.0902 6.94513 15.3141 6.89714C15.9861 6.73716 16.498 6.25722 16.498 4.91339C16.498 2.86564 15.0022 2.86564 14.2903 2.86564Z" fill="currentColor"></path>
            <path d="M14.6193 6.96103H2.38886C2.15688 6.96103 1.90092 6.95303 1.66895 6.88904L2.67682 13.0403C2.90079 14.4161 3.50072 15.9999 6.16438 15.9999H10.6518C13.3475 15.9999 13.8274 14.6481 14.1154 13.1363L15.3232 6.88904C15.0993 6.94503 14.8593 6.96103 14.6193 6.96103ZM8.50009 13.2002C6.62833 13.2002 5.10052 11.6724 5.10052 9.80067C5.10052 9.47272 5.37248 9.20075 5.70044 9.20075C6.0284 9.20075 6.30037 9.47272 6.30037 9.80067C6.30037 11.0165 7.28424 12.0004 8.50009 12.0004C9.71594 12.0004 10.6998 11.0165 10.6998 9.80067C10.6998 9.47272 10.9718 9.20075 11.2997 9.20075C11.6277 9.20075 11.8997 9.47272 11.8997 9.80067C11.8997 11.6724 10.3719 13.2002 8.50009 13.2002Z" fill="currentColor"></path>
         </svg>';

        $question_ans_svg = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M8.5 16C12.9183 16 16.5 12.4183 16.5 8C16.5 3.58172 12.9183 0 8.5 0C4.08172 0 0.5 3.58172 0.5 8C0.5 12.4183 4.08172 16 8.5 16Z" fill="currentColor"></path>
            <path d="M8.5 4.80005V8.00005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M8.5 11.2H8.507" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>';

        $my_course_svg = '<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M14.1 4V10.4H2.78C1.524 10.4 0.5 11.424 0.5 12.68V4C0.5 0.8 1.3 0 4.5 0H10.1C13.3 0 14.1 0.8 14.1 4Z" fill="currentColor"></path>
            <path d="M14.1 10.4V13.2C14.1 14.744 12.844 16 11.3 16H3.3C1.756 16 0.5 14.744 0.5 13.2V12.68C0.5 11.424 1.524 10.4 2.78 10.4H14.1Z" fill="currentColor"></path>
            <path d="M10.5 4.60002H4.1C3.772 4.60002 3.5 4.32802 3.5 4.00002C3.5 3.67202 3.772 3.40002 4.1 3.40002H10.5C10.828 3.40002 11.1 3.67202 11.1 4.00002C11.1 4.32802 10.828 4.60002 10.5 4.60002Z" fill="currentColor"></path>
            <path d="M8.1 7.39995H4.1C3.772 7.39995 3.5 7.12795 3.5 6.79995C3.5 6.47195 3.772 6.19995 4.1 6.19995H8.1C8.428 6.19995 8.7 6.47195 8.7 6.79995C8.7 7.12795 8.428 7.39995 8.1 7.39995Z" fill="currentColor"></path>
            </svg>';

        $announcement_svg = '<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.49152 11.8954H7.80626C9.53774 11.8954 11.0068 10.7865 11.5238 9.24874C11.5988 9.02488 11.427 8.79414 11.189 8.79414H10.2195C9.91089 8.79414 9.66154 8.54789 9.66154 8.24397C9.66154 7.93918 9.91089 7.69207 10.2195 7.69207H11.1594C11.4706 7.69207 11.7226 7.44325 11.7226 7.13587C11.7226 6.8285 11.4706 6.57968 11.1594 6.57968H10.2195C9.91089 6.57968 9.66154 6.33257 9.66154 6.02864C9.66154 5.72385 9.91089 5.47675 10.2195 5.47675H11.1594C11.4706 5.47675 11.7226 5.22792 11.7226 4.92055C11.7226 4.61318 11.4706 4.36435 11.1594 4.36435H10.2195C9.91089 4.36435 9.66154 4.11725 9.66154 3.81246C9.66154 3.50853 9.91089 3.26142 10.2195 3.26142H11.2387C11.4724 3.26142 11.6398 3.04101 11.577 2.81802C11.114 1.19161 9.60138 0 7.80626 0H7.49152C5.32847 0 3.5752 1.73059 3.5752 3.86756V8.02786C3.5752 10.164 5.32847 11.8954 7.49152 11.8954Z" fill="currentColor"></path>
            <path opacity="0.4" d="M14.4282 7.04333C13.9469 7.04333 13.5563 7.4282 13.5563 7.90432C13.5563 11.1201 10.9068 13.7367 7.65044 13.7367C4.39322 13.7367 1.74369 11.1201 1.74369 7.90432C1.74369 7.4282 1.3531 7.04333 0.871845 7.04333C0.390586 7.04333 0 7.4282 0 7.90432C0 11.7788 2.9695 14.9773 6.77859 15.407V17.1393C6.77859 17.6146 7.16831 18.0003 7.65044 18.0003C8.13169 18.0003 8.52228 17.6146 8.52228 17.1393V15.407C12.3305 14.9773 15.3 11.7788 15.3 7.90432C15.3 7.4282 14.9094 7.04333 14.4282 7.04333Z" fill="currentColor"></path>
            </svg>';

        $withdraw_svg = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.6812 15.9998H0.878433C0.550371 15.9998 0.27832 15.7277 0.27832 15.3997C0.27832 15.0716 0.550371 14.7996 0.878433 14.7996H15.6812C16.0093 14.7996 16.2813 15.0716 16.2813 15.3997C16.2813 15.7277 16.0093 15.9998 15.6812 15.9998Z" fill="currentColor"></path>
            <path opacity="0.4" d="M15.1526 9.3587L9.36749 15.1438C8.23128 16.28 6.39893 16.28 5.27072 15.1518L1.58203 11.4631L11.4719 1.57324L15.1606 5.26193C16.2888 6.39014 16.2888 8.22249 15.1526 9.3587Z" fill="currentColor"></path>
            <path d="M11.4712 1.5733L1.5733 11.4631L0.845161 10.735C-0.28305 9.6068 -0.28305 7.77446 0.853162 6.63825L6.63825 0.853162C7.77446 -0.28305 9.6068 -0.28305 10.735 0.845161L11.4712 1.5733Z" fill="currentColor"></path>
            <path d="M8.99193 12.4796L7.91173 13.5598C7.68769 13.7838 7.32762 13.7838 7.10358 13.5598C6.87954 13.3358 6.87954 12.9757 7.10358 12.7517L8.18378 11.6714C8.40782 11.4474 8.76789 11.4474 8.99193 11.6714C9.21597 11.8955 9.21597 12.2556 8.99193 12.4796Z" fill="currentColor"></path>
            <path d="M12.4958 8.97447L10.3434 11.1269C10.1193 11.3509 9.75926 11.3509 9.53522 11.1269C9.31118 10.9028 9.31118 10.5428 9.53522 10.3187L11.6876 8.16632C11.9117 7.94228 12.2717 7.94228 12.4958 8.16632C12.7118 8.39036 12.7118 8.75043 12.4958 8.97447Z" fill="currentColor"></path>
            </svg>';

        $my_quiz_attempt_svg = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M16.7348 6.68487L15.9012 10.2048C15.1867 13.2447 13.7747 14.4741 11.1208 14.2215C10.6955 14.1878 10.2362 14.112 9.74286 13.9941L8.31386 13.6573C4.76687 12.8236 3.6696 11.0889 4.50318 7.56906L5.33677 4.04075C5.50689 3.32498 5.71103 2.70184 5.96621 2.18818C6.96141 0.150347 8.6541 -0.397003 11.4951 0.268238L12.9156 0.596649C16.4796 1.42189 17.5684 3.16499 16.7348 6.68487Z" fill="currentColor"></path>
            <path d="M11.1207 14.221C10.5933 14.5747 9.92988 14.8694 9.12181 15.1305L7.77787 15.5684C4.401 16.6462 2.62325 15.7452 1.52598 12.4022L0.437218 9.07594C-0.651546 5.73289 0.250086 3.96453 3.62696 2.88667L4.9709 2.44879C5.31964 2.33932 5.65138 2.24669 5.9661 2.18774C5.71092 2.70141 5.50678 3.32455 5.33666 4.04032L4.50307 7.56862C3.66949 11.0885 4.76676 12.8232 8.31375 13.6568L9.74275 13.9937C10.2361 14.1116 10.6954 14.1874 11.1207 14.221Z" fill="currentColor"></path>
            <path d="M13.1875 6.74387C13.1365 6.74387 13.0854 6.73545 13.0259 6.72703L8.90048 5.69127C8.56024 5.60707 8.3561 5.26181 8.44116 4.92498C8.52622 4.58815 8.87496 4.38605 9.2152 4.47026L13.3406 5.50602C13.6808 5.59022 13.885 5.93548 13.7999 6.27231C13.7319 6.55019 13.4682 6.74387 13.1875 6.74387Z" fill="currentColor"></path>
            <path d="M10.6936 9.59029C10.6425 9.59029 10.5915 9.58186 10.532 9.57344L8.05673 8.95031C7.71649 8.8661 7.51235 8.52085 7.59741 8.18402C7.68247 7.84718 8.03121 7.64509 8.37145 7.72929L10.8467 8.35243C11.1869 8.43664 11.3911 8.78189 11.306 9.11872C11.238 9.40503 10.9828 9.59029 10.6936 9.59029Z" fill="currentColor"></path>
            </svg>';

        $settings_svg = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.60509 10.2644C6.32151 10.2644 5.2832 9.26439 5.2832 8.00839C5.2832 6.75239 6.32151 5.74438 7.60509 5.74438C8.88867 5.74438 9.90245 6.75239 9.90245 8.00839C9.90245 9.26439 8.88867 10.2644 7.60509 10.2644Z" fill="currentColor"></path>
            <path opacity="0.4" d="M14.9841 9.896C14.8288 9.656 14.608 9.416 14.3219 9.264C14.093 9.152 13.9458 8.968 13.815 8.752C13.398 8.064 13.6433 7.16 14.3382 6.752C15.1558 6.296 15.4174 5.28 14.9432 4.488L14.3955 3.544C13.9294 2.752 12.9075 2.472 12.0981 2.936C11.3786 3.32 10.4548 3.064 10.0378 2.384C9.90702 2.16 9.83344 1.92 9.84979 1.68C9.87432 1.368 9.77621 1.072 9.62905 0.832C9.32655 0.336 8.77878 0 8.17378 0H7.02101C6.42419 0.016 5.87642 0.336 5.57392 0.832C5.41858 1.072 5.32865 1.368 5.345 1.68C5.36135 1.92 5.28777 2.16 5.15696 2.384C4.74 3.064 3.81615 3.32 3.10487 2.936C2.28731 2.472 1.27352 2.752 0.799336 3.544L0.251567 4.488C-0.214445 5.28 0.0471757 6.296 0.856566 6.752C1.5515 7.16 1.79677 8.064 1.38798 8.752C1.249 8.968 1.10184 9.152 0.872917 9.264C0.594945 9.416 0.349675 9.656 0.218865 9.896C-0.0836348 10.392 -0.0672835 11.016 0.235216 11.536L0.799336 12.496C1.10184 13.008 1.66596 13.328 2.2546 13.328C2.53258 13.328 2.8596 13.248 3.12122 13.088C3.32561 12.952 3.57088 12.904 3.84068 12.904C4.65007 12.904 5.32865 13.568 5.345 14.36C5.345 15.28 6.09716 16 7.04554 16H8.15743C9.09763 16 9.84979 15.28 9.84979 14.36C9.87432 13.568 10.5529 12.904 11.3623 12.904C11.6239 12.904 11.8692 12.952 12.0817 13.088C12.3434 13.248 12.6622 13.328 12.9484 13.328C13.5288 13.328 14.093 13.008 14.3955 12.496L14.9678 11.536C15.2621 11 15.2866 10.392 14.9841 9.896Z" fill="currentColor"></path>
            </svg>';

        $logout_svg = '<svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M9.94863 0C10.3714 0 10.7222 0.341829 10.7222 0.773613V17.2264C10.7222 17.6492 10.3804 18 9.94863 18C4.65028 18 0.953125 14.3028 0.953125 9.0045C0.953125 3.70615 4.65927 0 9.94863 0Z" fill="currentColor"></path>
            <path d="M16.5143 8.58188L13.9596 6.01816C13.6987 5.75729 13.2669 5.75729 13.006 6.01816C12.7452 6.27903 12.7452 6.71082 13.006 6.97169L14.4093 8.37498H5.80064C5.43182 8.37498 5.12598 8.68083 5.12598 9.04965C5.12598 9.41846 5.43182 9.72431 5.80064 9.72431H14.4093L13.006 11.1276C12.7452 11.3885 12.7452 11.8203 13.006 12.0811C13.141 12.2161 13.3119 12.279 13.4828 12.279C13.6537 12.279 13.8246 12.2161 13.9596 12.0811L16.5143 9.51741C16.7752 9.26554 16.7752 8.84275 16.5143 8.58188Z" fill="currentColor"></path>
            </svg>';

        $calender_svg = '<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M10.4404 12.8721C10.0768 12.8641 9.78441 12.5601 9.78441 12.1921C9.77651 11.8241 10.0689 11.5209 10.4325 11.5129H10.4404C10.8119 11.5129 11.1122 11.8169 11.1122 12.1921C11.1122 12.5681 10.8119 12.8721 10.4404 12.8721ZM7.21581 9.92806C6.85225 9.94486 6.55192 9.65606 6.53612 9.28886C6.53612 8.92086 6.82064 8.61686 7.18419 8.60006C7.53985 8.60006 7.83227 8.88086 7.84018 9.24006C7.85598 9.60886 7.57146 9.91286 7.21581 9.92806ZM7.21581 12.8321C6.85225 12.8489 6.55192 12.5601 6.53612 12.1921C6.53612 11.8241 6.82064 11.5209 7.18419 11.5041C7.53985 11.5041 7.83227 11.7849 7.84018 12.1449C7.85598 12.5129 7.57146 12.8169 7.21581 12.8321ZM3.96751 9.92806C3.60395 9.94486 3.30362 9.65606 3.28782 9.28886C3.28782 8.92086 3.57234 8.61686 3.9359 8.60006C4.29155 8.60006 4.58397 8.88086 4.59188 9.24006C4.60768 9.60886 4.32316 9.91286 3.96751 9.92806ZM3.9596 12.8321C3.59605 12.8489 3.29572 12.5601 3.27991 12.1921C3.27991 11.8241 3.56444 11.5209 3.92799 11.5041C4.28364 11.5041 4.57607 11.7849 4.58397 12.1449C4.59978 12.5129 4.31526 12.8169 3.9596 12.8321ZM9.79232 9.28086C9.79232 8.91286 10.0768 8.61686 10.4404 8.60886C10.796 8.60886 11.0806 8.89606 11.0964 9.24886C11.1043 9.61686 10.8198 9.92086 10.4641 9.92806C10.1005 9.93606 9.80022 9.65606 9.79232 9.28886V9.28086ZM0 5.80566V11.8961C0 14.4241 1.59649 16.0001 4.10187 16.0001H10.2902C12.8193 16.0001 14.4 14.4561 14.4 11.9449V5.80566H0Z" fill="currentColor"></path><path d="M0.00390625 5.80476C0.0141807 5.33516 0.0536977 4.40316 0.12799 4.10316C0.507353 2.41596 1.79561 1.34396 3.6371 1.19116H10.766C12.5917 1.35196 13.8957 2.43116 14.2751 4.10316C14.3486 4.39516 14.3881 5.33436 14.3984 5.80476H0.00390625Z" fill="currentColor"></path><path d="M4.2443 3.672C4.59205 3.672 4.85287 3.4088 4.85287 3.056V0.6168C4.85287 0.264 4.59205 0 4.2443 0C3.89655 0 3.63574 0.264 3.63574 0.6168V3.056C3.63574 3.4088 3.89655 3.672 4.2443 3.672Z" fill="currentColor"></path><path d="M10.1525 3.672C10.4924 3.672 10.7611 3.4088 10.7611 3.056V0.6168C10.7611 0.264 10.4924 0 10.1525 0C9.80476 0 9.54395 0.264 9.54395 0.6168V3.056C9.54395 3.4088 9.80476 3.672 10.1525 3.672Z" fill="currentColor"></path>
            </svg>';

        $my_bundles_svg = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.636 2.31542L8.94919 0.227943C8.26136 -0.075981 7.22162 -0.075981 6.53379 0.227943L1.84696 2.31542C0.663261 2.84329 0.487305 3.56311 0.487305 3.94701C0.487305 4.33092 0.663261 5.05074 1.84696 5.57861L6.53379 7.66608C6.87771 7.81805 7.3096 7.89803 7.74149 7.89803C8.17338 7.89803 8.60528 7.81805 8.94919 7.66608L13.636 5.57861C14.8197 5.05074 14.9957 4.33092 14.9957 3.94701C14.9957 3.56311 14.8277 2.84329 13.636 2.31542Z" fill="currentColor"></path>
            <path opacity="0.4" d="M7.74207 12.0329C7.43814 12.0329 7.13422 11.969 6.85429 11.849L1.46363 9.44958C0.63984 9.08168 0 8.09792 0 7.19415C0 6.86623 0.263934 6.60229 0.591852 6.60229C0.91977 6.60229 1.1837 6.86623 1.1837 7.19415C1.1837 7.62604 1.54361 8.1859 1.94351 8.36185L7.33417 10.7613C7.5901 10.8732 7.88603 10.8732 8.14196 10.7613L13.5326 8.36185C13.9325 8.1859 14.2924 7.63404 14.2924 7.19415C14.2924 6.86623 14.5564 6.60229 14.8843 6.60229C15.2122 6.60229 15.4761 6.86623 15.4761 7.19415C15.4761 8.08992 14.8363 9.08168 14.0125 9.44958L8.62185 11.849C8.34991 11.969 8.04599 12.0329 7.74207 12.0329Z" fill="currentColor"></path>
            <path opacity="0.4" d="M7.74207 15.9999C7.43814 15.9999 7.13422 15.9359 6.85429 15.8159L1.46363 13.4165C0.575856 13.0246 0 12.1368 0 11.1611C0 10.8331 0.263934 10.5692 0.591852 10.5692C0.91977 10.5692 1.1837 10.8331 1.1837 11.1611C1.1837 11.6649 1.47963 12.1208 1.94351 12.3288L7.33417 14.7282C7.5901 14.8401 7.88603 14.8401 8.14196 14.7282L13.5326 12.3288C13.9885 12.1288 14.2924 11.6649 14.2924 11.1611C14.2924 10.8331 14.5564 10.5692 14.8843 10.5692C15.2122 10.5692 15.4761 10.8331 15.4761 11.1611C15.4761 12.1368 14.9003 13.0166 14.0125 13.4165L8.62185 15.8159C8.34991 15.9359 8.04599 15.9999 7.74207 15.9999Z" fill="currentColor"></path>
            </svg>';
        $assignment_svg = '<svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M1.96289 0.60791V10.3088C1.96289 11.103 2.33569 11.8567 2.97593 12.3349L7.19829 15.4956C8.09787 16.1682 9.33784 16.1682 10.2374 15.4956L14.4598 12.3349C15.1 11.8567 15.4728 11.103 15.4728 10.3088V0.60791H1.96289Z" fill="currentColor"></path>
            <path d="M16.8165 1.21565H0.607826C0.275548 1.21565 0 0.940104 0 0.607826C0 0.275548 0.275548 0 0.607826 0H16.8165C17.1488 0 17.4243 0.275548 17.4243 0.607826C17.4243 0.940104 17.1488 1.21565 16.8165 1.21565Z" fill="currentColor"></path>
            <path d="M11.9536 5.67293H5.47013C5.13785 5.67293 4.8623 5.39738 4.8623 5.0651C4.8623 4.73282 5.13785 4.45728 5.47013 4.45728H11.9536C12.2859 4.45728 12.5614 4.73282 12.5614 5.0651C12.5614 5.39738 12.2859 5.67293 11.9536 5.67293Z" fill="currentColor"></path>
            <path d="M11.9536 9.72493H5.47013C5.13785 9.72493 4.8623 9.44938 4.8623 9.1171C4.8623 8.78483 5.13785 8.50928 5.47013 8.50928H11.9536C12.2859 8.50928 12.5614 8.78483 12.5614 9.1171C12.5614 9.44938 12.2859 9.72493 11.9536 9.72493Z" fill="currentColor"></path>
            </svg>';

        $certificate_svg = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M13.7191 5.64274C13.7191 6.8116 13.3725 7.88373 12.7759 8.77851C11.9053 10.0683 10.5269 10.9792 8.92275 11.2129C8.64867 11.2613 8.36654 11.2855 8.07634 11.2855C7.78614 11.2855 7.504 11.2613 7.22993 11.2129C5.62577 10.9792 4.24733 10.0683 3.37674 8.77851C2.78022 7.88373 2.43359 6.8116 2.43359 5.64274C2.43359 2.52311 4.95671 0 8.07634 0C11.196 0 13.7191 2.52311 13.7191 5.64274Z" fill="currentColor"></path>
            <path d="M15.5341 13.2764L14.2041 13.5908C13.9058 13.6633 13.672 13.889 13.6075 14.1873L13.3254 15.3723C13.1722 16.0172 12.35 16.2106 11.9228 15.7028L8.07766 11.2853L4.23253 15.7108C3.80529 16.2187 2.98307 16.0252 2.82991 15.3803L2.54777 14.1953C2.47522 13.8971 2.24145 13.6633 1.95125 13.5988L0.621175 13.2845C0.00853384 13.1394 -0.209115 12.3735 0.234244 11.9302L3.37806 8.78638C4.24865 10.0761 5.6271 10.9871 7.23125 11.2208C7.50532 11.2692 7.78746 11.2934 8.07766 11.2934C8.36786 11.2934 8.64999 11.2692 8.92407 11.2208C10.5282 10.9871 11.9067 10.0761 12.7773 8.78638L15.9211 11.9302C16.3644 12.3655 16.1468 13.1313 15.5341 13.2764Z" fill="currentColor"></path>
            <path d="M8.54362 3.20822L9.01922 4.15942C9.08371 4.2884 9.25299 4.41738 9.40615 4.44156L10.2687 4.58665C10.8168 4.67533 10.9458 5.07838 10.5508 5.47338L9.88175 6.14243C9.7689 6.25529 9.70441 6.47295 9.74472 6.63417L9.93818 7.46446C10.0913 8.11741 9.74472 8.37535 9.16432 8.02872L8.35821 7.55312C8.21311 7.46445 7.97128 7.46445 7.82618 7.55312L7.02008 8.02872C6.43968 8.36728 6.09305 8.11741 6.24621 7.46446L6.43968 6.63417C6.47193 6.48101 6.4155 6.25529 6.30264 6.14243L5.63357 5.47338C5.23858 5.07838 5.36756 4.68339 5.91571 4.58665L6.77825 4.44156C6.92334 4.41738 7.09263 4.2884 7.15711 4.15942L7.63272 3.20822C7.86649 2.69231 8.28566 2.69231 8.54362 3.20822Z" fill="currentColor"></path>
            </svg>';

        $analytics_svg = '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.62376 2.84423C6.66451 2.92716 6.69142 3.01597 6.70347 3.10727L6.92622 6.41921L7.03679 8.08387C7.03793 8.25505 7.06479 8.42514 7.1165 8.58863C7.25004 8.90585 7.57129 9.10746 7.9208 9.0934L13.2466 8.74504C13.4772 8.74124 13.7 8.82749 13.8658 8.98483C14.0039 9.11594 14.0931 9.28746 14.1212 9.47193L14.1306 9.58395C13.9103 12.6357 11.6689 15.1811 8.62345 15.8382C5.57801 16.4953 2.45505 15.1072 0.95013 12.4277C0.516272 11.6493 0.245283 10.7936 0.153068 9.91099C0.114545 9.6497 0.0975829 9.3858 0.102346 9.12184C0.0975897 5.84999 2.42754 3.02137 5.68903 2.33946C6.08157 2.27834 6.46638 2.48614 6.62376 2.84423Z" fill="currentColor"></path>
            <path opacity="0.4" d="M8.79645 0.000655349C12.4444 0.0934612 15.5103 2.71663 16.1004 6.24983L16.0948 6.2759L16.0787 6.31382L16.0809 6.41789C16.0726 6.55577 16.0194 6.68843 15.9276 6.79559C15.8321 6.90721 15.7015 6.98322 15.5577 7.01273L15.47 7.02476L9.32541 7.42289C9.12102 7.44304 8.91752 7.37714 8.76552 7.24156C8.63886 7.12858 8.55788 6.97607 8.535 6.81174L8.12257 0.67605C8.11539 0.655303 8.11539 0.632812 8.12257 0.612065C8.12821 0.442938 8.20265 0.283072 8.32928 0.168184C8.45591 0.0532958 8.62416 -0.0070403 8.79645 0.000655349Z" fill="currentColor"></path>
         </svg>';

        $icon_map = [
            'index' => $dashboard_svg,
            'my-profile' => $my_profile_svg,
            'enrolled-courses' => $enrolled_coruses_svg,
            'wishlist' => $wishlist_svg,
            'reviews' => $review_svg,
            'my-quiz-attempts' => $my_quiz_svg,
            'purchase_history' => $purchase_history_svg,
            'question-answer' => $question_ans_svg,
            'my-courses' => $my_course_svg,
            'announcements' => $announcement_svg,
            'withdraw' => $withdraw_svg,
            'quiz-attempts' => $my_quiz_attempt_svg,
            'settings' => $settings_svg,
            'logout' => $logout_svg,
            'calendar' => $calender_svg,
            'my-bundles' => $my_bundles_svg,
            'assignments' => $assignment_svg,
            'certificate-builder' => $certificate_svg,
            'analytics' => $calender_svg,
        ];

        $menu_icon = isset($icon_map[$dashboard_key]) ? $icon_map[$dashboard_key] : '';

        return $menu_icon;
    }

    function get_lsm_dashboard_menu_keys()
    {
        $menu_keys = [
            'index',
            'my-profile',
            'enrolled-courses',
            'wishlist',
            'reviews',
            'my-quiz-attempts',
            'purchase_history',
            'question-answer',
            'my-courses',
            'announcements',
            'withdraw',
            'quiz-attempts',
            'settings',
            'logout',
            'calendar',
            'my-bundles',
            'assignments',
            'certificate-builder',
            'analytics',
        ];

        return $menu_keys;
    }
}


function add_edcare_post_color_category($term = null)
{


    ?>
                    <?php if (!is_object($term)): ?>
                        <div class="form-field term-color-wrap">
                            <label><?php echo esc_html__('Add Color Code', 'edcare'); ?></label>
                            <div>
                                <input type="text" name="_edcare_post_cat_color">
                            </div>
                        </div>
                    <?php else: ?>

                        <tr class="form-field term-color-wrap">
                            <th scope="row"><label><?php echo esc_html__('Color', 'edcare'); ?></label></th>
                            <td>
                                <div class="form-field term-color-wrap">
                                    <div>
                                        <input type="text" name="_edcare_post_cat_color"
                                            value="<?php echo esc_html(get_term_meta($term->term_id, '_edcare_post_cat_color', true)); ?>">
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?>

                    <?php
}

add_action('category_add_form_fields', 'add_edcare_post_color_category');
add_action('category_edit_form_fields', 'add_edcare_post_color_category', 10, 1);

function save_edcare_post_color_value($term_id)
{
    if (isset($_POST['_edcare_post_cat_color']) && !empty($_POST['_edcare_post_cat_color'])) {
        update_term_meta($term_id, '_edcare_post_cat_color', $_POST['_edcare_post_cat_color']);
    }
}

add_action('create_category', 'save_edcare_post_color_value', 10, 1);
add_action('edited_category', 'save_edcare_post_color_value', 10, 1);

function add_edcare_post_color_column($columns)
{
    $new_columns = $columns;
    $new_columns['edcare_post_color'] = __('Color', 'edcare');

    return $new_columns;
}

add_filter('manage_edit-category_columns', 'add_edcare_post_color_column', 10, 1);


function display_edcare_post_color_column_value($row, $column_name, $term_id)
{
    if ($column_name == 'edcare_post_color') {
        $row .= "<div style='width: 40px; height: 40px; background-color: " . get_term_meta($term_id, '_edcare_post_cat_color', true) . "'></div>";

    }

    return $row;
}

add_filter('manage_category_custom_column', 'display_edcare_post_color_column_value', 10, 3);

function get_dashboard_title($current_slug)
{
    $titles = [
        'dashboard' => is_user_logged_in() ? esc_html__('Dashboard', 'edcare') : esc_html__('Login', 'edcare'),
        'dashboard/retrieve-password' => esc_html__('Reset Password', 'edcare'),
        'dashboard/my-profile' => esc_html__('My Profile', 'edcare'),
        'dashboard/enrolled-courses' => esc_html__('Enrolled Courses', 'edcare'),
        'dashboard/my-courses' => esc_html__('My Courses', 'edcare'),
        'dashboard/settings' => esc_html__('Settings', 'edcare'),
        'dashboard/wishlist' => esc_html__('Wishlist', 'edcare'),
        'dashboard/reviews' => esc_html__('Reviews', 'edcare'),
        'dashboard/my-quiz-attempts' => esc_html__('My quiz attempts', 'edcare'),
        'dashboard/purchase_history' => esc_html__('Purchase History', 'edcare'),
        'dashboard/question-answer' => esc_html__('Question & Answer', 'edcare'),
        'dashboard/announcements' => esc_html__('Announcements', 'edcare'),
        'dashboard/withdraw' => esc_html__('Withdraw', 'edcare'),
        'dashboard/quiz-attempts' => esc_html__('Quiz attempts', 'edcare'),
        'dashboard/settings/reset-password' => esc_html__('Reset password', 'edcare'),
        'dashboard/settings/withdraw-settings' => esc_html__('Withdraw Settings', 'edcare')
    ];


    $current_slug = rtrim($current_slug, '/');

    return $titles[$current_slug] ?? get_the_title();
}


add_filter('woosc_bar_bg_color_default', 'edcare_change_woosc_bar_bg_color');

function edcare_change_woosc_bar_bg_color($default_color)
{
    return 'transparent';
}

function edcare_learnpress_course_breadcrumb()
{
    // Start the breadcrumb
    echo '<nav class="lp-breadcrumb"><span><ul>';

    // Home link
    echo '<li><a href="' . esc_url(home_url('/')) . '"><svg width="17" height="14" viewBox="0 0 17 14" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z"
            fill="currentColor"></path>
    </svg></a></li>';

    // Link to the Courses archive page
    $course_archive_link = get_post_type_archive_link('lp_course');
    if ($course_archive_link) {
        echo '<li> | <a href="' . esc_url($course_archive_link) . '">Courses</a></li>';
    }

    // Course categories
    $terms = get_the_terms(get_the_ID(), 'course_category');
    if (!empty($terms) && !is_wp_error($terms)) {
        // Display the first course category (or adapt to show more)
        $term = array_shift($terms); // Get the first category
        echo '<li> / <a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
    }

    // Current course title
    echo '<li> / ' . esc_html(get_the_title()) . '</li>';

    echo '</ul></span></nav>';
}


/**
 * [edcare header social]
 * @return [type] [description]
 */
function edcare_header_social_profiles() {
    $edcare_header_fb_url = get_theme_mod( 'edcare_header_fb_url', __( '#', 'edcare' ) );
    $edcare_header_twitter_url = get_theme_mod( 'edcare_header_twitter_url', __( '#', 'edcare' ) );
    $edcare_header_linkedin_url = get_theme_mod( 'edcare_header_linkedin_url', __( '#', 'edcare' ) );
    $edcare_header_instagram_url = get_theme_mod( 'edcare_header_instagram_url', __( '#', 'edcare' ) );
    $edcare_header_pinterest_url = get_theme_mod( 'edcare_header_pinterest_url', __( '#', 'edcare' ) );
    $edcare_header_youtube_url = get_theme_mod( 'edcare_header_youtube_url', __( '#', 'edcare' ) );
    $edcare_header_skype_url = get_theme_mod( 'edcare_header_skype_url', __( '#', 'edcare' ) );
    $edcare_header_behance_url = get_theme_mod( 'edcare_header_behance_url', __( '#', 'edcare' ) );
    $edcare_header_dribble_url = get_theme_mod( 'edcare_header_dribble_url', __( '#', 'edcare' ) );
    ?>
        <ul class="social-list">
            <?php if ( !empty( $edcare_header_fb_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_fb_url );?>"><i class="fab fa-facebook-f"></i></a></li>
            <?php endif; ?>

            <?php if ( !empty( $edcare_header_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_twitter_url );?>"><i class="fa-brands fa-twitter"></i></a></li>
            <?php endif; ?>

            <?php if ( !empty( $edcare_header_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_linkedin_url );?>"><i class="fab fa-linkedin"></i></a></li>
            <?php endif;?>

            <?php if ( !empty( $edcare_header_instagram_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_instagram_url );?>"><i class="fab fa-instagram"></i></a></li>
            <?php endif;?>

            <?php if ( !empty( $edcare_header_pinterest_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_pinterest_url );?>"><i class="fab fa-pinterest-p"></i></a></li>
            <?php endif;?>

            <?php if ( !empty( $edcare_header_youtube_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_youtube_url );?>"><i class="fab fa-youtube"></i></a></li>
            <?php endif;?>

            <?php if ( !empty( $edcare_header_skype_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_skype_url );?>"><i class="fab fa-skype"></i></a></li>
            <?php endif;?>

            <?php if ( !empty( $edcare_header_behance_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_behance_url );?>"><i class="fab fa-behance"></i></a></li>
            <?php endif;?>

            <?php if ( !empty( $edcare_header_dribble_url ) ): ?>
            <li><a href="<?php print esc_url( $edcare_header_dribble_url );?>"><i class="fa-brands fa-dribbble"></i></a></li>
            <?php endif;?>
        </ul>
    <?php
}