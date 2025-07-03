<?php

/**
 * edcare functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package edcare
 */

if (!function_exists('edcare_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function edcare_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on edcare, use a find and replace
         * to change 'edcare' to the name of your theme in all the template files.
         */
        load_theme_textdomain('edcare', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'main-menu' => esc_html__('Main Menu', 'edcare'),
            'tp-language-menu' => esc_html__('Language Menu', 'edcare'),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('edcare_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ]));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        //Enable custom header
        add_theme_support('custom-header');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', [
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ]);

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ]);

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        remove_theme_support('widgets-block-editor');

        // Add support for woocommerce.
        add_theme_support('woocommerce');

        // Remove woocommerce defauly styles
        add_filter('woocommerce_enqueue_styles', '__return_false');

        //add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support('wc-product-gallery-slider');

        add_theme_support('woocommerce', array(
            'thumbnail_image_width' => 200,
            'gallery_thumbnail_image_width' => 200,
        ));

        if (function_exists('register_block_style')) {
            register_block_style(
                'core/quote',
                array(
                    'name' => 'blue-quote',
                    'label' => __('Blue Quote', 'edcare'),
                    'is_default' => true,
                    'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
                )
            );
        }



    }
endif;
add_action('after_setup_theme', 'edcare_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function edcare_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('edcare_content_width', 640);
}
add_action('after_setup_theme', 'edcare_content_width', 0);



/**
 * Enqueue scripts and styles.
 */

define('EDCARE_THEME_DIR', get_template_directory());
define('EDCARE_THEME_URI', get_template_directory_uri());
define('EDCARE_THEME_CSS_DIR', EDCARE_THEME_URI . '/assets/css/');
define('EDCARE_THEME_JS_DIR', EDCARE_THEME_URI . '/assets/js/');
define('EDCARE_THEME_INC', EDCARE_THEME_DIR . '/inc/');



// wp_body_open
if (!function_exists('wp_body_open')) {
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
}

/**
 * Implement the Custom Header feature.
 */
require EDCARE_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require EDCARE_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require EDCARE_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */

add_action('init', function(){
    if (class_exists('Kirki')) {
        include_once EDCARE_THEME_INC . 'kirki-customizer.php';
    }
    include_once EDCARE_THEME_INC . 'class-edcare-kirki.php';
});


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require EDCARE_THEME_INC . 'jetpack.php';
}


/**
 * include edcare functions file
 */
require_once EDCARE_THEME_INC . 'class-navwalker.php';
require_once EDCARE_THEME_INC . 'class-tgm-plugin-activation.php';
require_once EDCARE_THEME_INC . 'add_plugin.php';
require_once EDCARE_THEME_INC . '/common/edcare-breadcrumb.php';
require_once EDCARE_THEME_INC . '/common/edcare-etn-breadcrumb.php';
require_once EDCARE_THEME_INC . '/common/edcare-scripts.php';
require_once EDCARE_THEME_INC . '/common/edcare-widgets.php';
require_once EDCARE_THEME_INC . '/common/comments-form-list.php';

/**
 * License
 */
// require_once EDCARE_THEME_INC . 'register/register.php';


if (class_exists('WooCommerce')) {
    require_once EDCARE_THEME_INC . '/woocommerce/tp-woocommerce.php';
    require_once EDCARE_THEME_INC . '/woocommerce/cart-mini.php';
    require_once EDCARE_THEME_INC . '/woocommerce/product-action.php';
    require_once EDCARE_THEME_INC . '/woocommerce/product-card.php';
    require_once EDCARE_THEME_INC . '/woocommerce/single/product-single.php';
    require_once EDCARE_THEME_INC . '/woocommerce/single/product-review-avater.php';
}


if (class_exists('Wpeventin')) {
require_once EDCARE_THEME_INC . '/etn/hook-helper.php';
}

if (function_exists('tpmeta_kick')) {
    require_once EDCARE_THEME_INC . 'tp-metabox.php';
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function edcare_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'edcare_pingback_header');



/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter('the_content', 'edcare_shortcode_extra_content_remove');
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function edcare_shortcode_extra_content_remove($content)
{

    $array = [
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']',
    ];
    return strtr($content, $array);
}

// edcare_search_filter_form
if (!function_exists('edcare_search_filter_form')) {
    function edcare_search_filter_form($form)
    {

        $form = sprintf(
            '<div class="sidebar__widget-px">
                <div class="search-px tp-sidebar-search p-relative">
                    <form class="sidebar__search p-relative" action="%s" method="get">
                        <div class="tp-sidebar-search-input">
                            <input type="text" value="%s" required name="s" placeholder="%s">
                            <button class="tp-sidebar-search-btn" type="submit">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M13.3994 13.4004L16.9995 17.0005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.3999 8.20019C15.3999 4.22363 12.1763 1 8.1997 1C4.22314 1 0.999512 4.22363 0.999512 8.20019C0.999512 12.1767 4.22314 15.4004 8.1997 15.4004C12.1763 15.4004 15.3999 12.1767 15.3999 8.20019Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>',
            esc_url(home_url('/')),
            esc_attr(get_search_query()),
            esc_html__('Search', 'edcare')
        );

        return $form;
    }
    add_filter('get_search_form', 'edcare_search_filter_form');
}

add_action('admin_enqueue_scripts', 'edcare_admin_custom_scripts');

function edcare_admin_custom_scripts()
{
    wp_enqueue_media();
    wp_enqueue_style('customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css', array());
    wp_register_script('edcare-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', ['jquery'], '', true);
    wp_enqueue_script('edcare-admin-custom');
}



add_filter('intermediate_image_sizes_advanced', 'stop_thumbs');
function stop_thumbs($sizes)
{
    return array();
}


if (!function_exists('edcare_implode_html_attributes')) {
    function edcare_implode_html_attributes($raw_attributes)
    {
        $attributes = array();
        foreach ($raw_attributes as $name => $value) {
            $attributes[] = esc_attr($name) . '="' . esc_attr($value) . '"';
        }
        return implode(' ', $attributes);
    }
}
;
// remove_etn_add_to_calendar
$edcare_event_calendar_switcher = get_theme_mod('edcare_event_calendar_switcher', false);

if ($edcare_event_calendar_switcher == "on") {
    function remove_etn_add_to_calendar()
    {
        remove_action("etn_after_single_event_meta", "etn_after_single_event_meta_add_to_calendar", 11);
    }
    add_action('init', 'remove_etn_add_to_calendar');
}

add_filter( 'learn-press/override-templates', function(){ return true; } );

remove_action( 'learn-press/list-courses/layout', '__return_false' );
add_action( 'learn-press/list-courses/layout', function(){

} );