<?php

/**
 * edcare_scripts description
 * @return [type] [description]
 */
function edcare_scripts()
{

    /**
     * all css files
     */

    wp_enqueue_style('edcare-fonts', edcare_fonts_url(), array(), time());
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', EDCARE_THEME_CSS_DIR .'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', EDCARE_THEME_CSS_DIR . 'bootstrap.min.css', array() );
    }
    wp_enqueue_style('animate', EDCARE_THEME_CSS_DIR . 'animate.min.css', []);
    wp_enqueue_style('daterangepicker', EDCARE_THEME_CSS_DIR . 'daterangepicker.css', []);
    wp_enqueue_style('fontawesome', EDCARE_THEME_CSS_DIR . 'fontawesome.min.css', []);
    wp_enqueue_style('keyframe-animation', EDCARE_THEME_CSS_DIR . 'keyframe-animation.css', []);
    wp_enqueue_style('nice-select', EDCARE_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('odometer', EDCARE_THEME_CSS_DIR . 'odometer.min.css', []);
    wp_enqueue_style('swiper', EDCARE_THEME_CSS_DIR . 'swiper.min.css', []);
    wp_enqueue_style('venobox', EDCARE_THEME_CSS_DIR . 'venobox.min.css', []);
    wp_enqueue_style('edcare-update', EDCARE_THEME_CSS_DIR . 'edcare-update.css', []);
    wp_enqueue_style('edcare-unit', EDCARE_THEME_CSS_DIR . 'edcare-unit.css', []);
    wp_enqueue_style('edcare-custom', EDCARE_THEME_CSS_DIR . 'edcare-custom.css', []);
    wp_enqueue_style('edcare-core', EDCARE_THEME_CSS_DIR . 'edcare-core.css', []);
    wp_enqueue_style('edcare-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-bundle', EDCARE_THEME_JS_DIR . 'bootstrap-bundle.js', ['jquery'], '', true);
    wp_enqueue_script('countdown', EDCARE_THEME_JS_DIR . 'countdown.js', ['jquery'], '', true);
    wp_enqueue_script('daterangepicker', EDCARE_THEME_JS_DIR . 'daterangepicker.min.js', ['jquery'], '', true);
    wp_enqueue_script('isotope', EDCARE_THEME_JS_DIR . 'jquery.isotope.js', ['imagesloaded'], false, true);
    wp_enqueue_script('meanmenu', EDCARE_THEME_JS_DIR . 'meanmenu.js', ['jquery'], '', true);
    wp_enqueue_script('moment', EDCARE_THEME_JS_DIR . 'moment.min.js', ['jquery'], '', true);
    wp_enqueue_script('nice-select', EDCARE_THEME_JS_DIR . 'nice-select.js', ['jquery'], '', true);
    wp_enqueue_script('odometer', EDCARE_THEME_JS_DIR . 'odometer.min.js', ['jquery'], '', true);
    wp_enqueue_script('smooth-scroll', EDCARE_THEME_JS_DIR . 'smooth-scroll.js', ['jquery'], '', true);
    wp_enqueue_script('swiper', EDCARE_THEME_JS_DIR . 'swiper.min.js', ['jquery'], false, true);
    wp_enqueue_script('venobox', EDCARE_THEME_JS_DIR . 'venobox.min.js', ['jquery'], false, true);
    wp_enqueue_script('waypoints', EDCARE_THEME_JS_DIR . 'waypoints.min.js', ['jquery'], false, true);
    wp_enqueue_script('modernizr', EDCARE_THEME_JS_DIR . 'modernizr.min.js', ['jquery'], false, true);
    wp_enqueue_script('wow', EDCARE_THEME_JS_DIR . 'wow.min.js', ['jquery'], false, true);
    wp_enqueue_script('edcare-main', EDCARE_THEME_JS_DIR . 'main.js', ['jquery'], false, true);
    wp_enqueue_script('edcare-elementor', EDCARE_THEME_JS_DIR . 'edcare-elementor.js', ['jquery'], false, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'edcare_scripts');


/*
Register Fonts
 */
function edcare_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'edcare')) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Outfit:wght@300;400;500;600;700;800;900&display=swap');
    }
    return $font_url;
}