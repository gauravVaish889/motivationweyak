<?php

namespace EdCareCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use Elementor\REPEA;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use EdCareCore\Elementor\Controls\Group_Control_EdCareBGGradient;
use EdCareCore\Elementor\Controls\Group_Control_EdCareGradient;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

function edcare_get_img($settings = null, $key = '', $size = 'full', $has_size_settings = true)
{

    $edcare_image = '';
    $edcare_image_alt = '';

    if (!empty($settings[$key]['url'])) {
        $edcare_image = !empty($settings[$key]['id']) ? wp_get_attachment_image_url($settings[$key]['id'], $size) : $settings[$key]['url'];
        $edcare_image_alt = get_post_meta($settings[$key]["id"], "_wp_attachment_image_alt", true);
    }

    return [
        $key => $edcare_image,
        $key . '_alt' => $edcare_image_alt
    ];
}


function edcare_get_img_size($settings = null, $key = '')
{

    if ('custom' !== 'full') {
        $image_size = 'full';
    } else {
        require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';
        $image_dimention = $settings[$key . '_custom_dimension'];
        $image_size = [
            // Defaults sizes.
            0 => null, // Width.
            1 => null, // Height.

            'bfi_thumb' => true,
            'crop' => true,
        ];
        $has_custom_size = false;
        if (!empty($image_dimention['width'])) {
            $has_custom_size = true;
            $image_size[0] = $image_dimention['width'];
        }

        if (!empty($image_dimention['height'])) {
            $has_custom_size = true;
            $image_size[1] = $image_dimention['height'];
        }

        if (!$has_custom_size) {
            $image_size = 'full';
        }
    }

    return $image_size;
}

function edcare_render_icon_controls($settings = null, $key = 'icon')
{
    $settings->add_control(
        'edcare_' . $key . '_icon_type',
        [
            'label' => esc_html__('Select Icon Type', 'edcare-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'icon',
            'options' => [
                'image' => esc_html__('Image', 'edcare-core'),
                'icon' => esc_html__('Icon', 'edcare-core'),
                'svg' => esc_html__('SVG', 'edcare-core'),
            ],
        ]
    );
    $settings->add_control(
        'edcare_' . $key . '_icon_svg',
        [
            'show_label' => false,
            'type' => Controls_Manager::TEXTAREA,
            'label_block' => true,
            'placeholder' => esc_html__('SVG Code Here', 'edcare-core'),
            'condition' => [
                'edcare_' . $key . '_icon_type' => 'svg',
            ]
        ]
    );

    $settings->add_control(
        'edcare_' . $key . '_image',
        [
            'label' => esc_html__('Upload Icon Image', 'edcare-core'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                'edcare_' . $key . '_icon_type' => 'image',
            ]
        ]
    );


    $settings->add_control(
        'edcare_' . $key . '_icon',
        [
            'label' => esc_html__('Icon', 'edcare-core'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fab fa-facebook',
                'library' => 'fa-brands',
            ],
            'condition' => [
                'edcare_' . $key . '_icon_type' => 'icon',
            ],
        ]
    );
}

function edcare_render_signle_icon_html($settings = null, $key = 'icon', $class = '')
{

    $common_icon_class = 'edcare-' . $key . '-icon ' . $class;
    $common_image_class = 'edcare-' . $key . '-image-icon ' . $class;
    $common_svg_class = 'edcare-' . $key . '-svg-icon ' . $class;
    ?>
    <?php if ($settings['edcare_' . $key . '_icon_type'] == 'icon'): ?>

        <?php if (!empty($settings['edcare_' . $key . '_icon'])): ?>
            <span class="<?php echo esc_attr($common_icon_class); ?>">
                <?php \Elementor\Icons_Manager::render_icon($settings['edcare_' . $key . '_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php endif; ?>

    <?php elseif ($settings['edcare_' . $key . '_icon_type'] == 'image'): ?>
        <span class="<?php echo esc_attr($common_image_class); ?>">
            <?php if (!empty($settings['edcare_' . $key . '_image']['url'])): ?>
                <img src="<?php echo $settings['edcare_' . $key . '_image']['url']; ?>"
                    alt="<?php echo get_post_meta(attachment_url_to_postid($settings['edcare_' . $key . '_image']['url']), '_wp_attachment_image_alt', true); ?>">
            <?php endif; ?>
        </span>
    <?php else: ?>
        <span class="<?php echo esc_attr($common_svg_class); ?>">
            <?php if (!empty($settings['edcare_' . $key . '_icon_svg'])): ?>
                <?php echo $settings['edcare_' . $key . '_icon_svg']; ?>
            <?php endif; ?>
        </span>
    <?php endif; ?>
<?php
}


function edcare_render_links_controls($settings = null, $control_id = 'link')
{
    $settings->add_control(
        'edcare_' . $control_id . '_link_type',
        [
            'label' => esc_html__(' Link Type', 'edcare-core'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '1' => 'Custom Link',
                '2' => 'Internal Page',
            ],
            'default' => '1',
            'label_block' => true,
        ]
    );
    $settings->add_control(
        'edcare_' . $control_id . '_link',
        [
            'label' => esc_html__('Link', 'edcare-core'),
            'type' => Controls_Manager::URL,
            'dynamic' => [
                'active' => true,
            ],
            'placeholder' => esc_html__('https://your-link.com', 'edcare-core'),
            'show_external' => false,
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
            'condition' => [
                'edcare_' . $control_id . '_link_type' => '1',
            ],
            'label_block' => true,
        ]
    );
    $settings->add_control(
        'edcare_' . $control_id . '_page_link',
        [
            'label' => esc_html__('Select Page', 'edcare-core'),
            'type' => Controls_Manager::SELECT2,
            'label_block' => true,
            'options' => edcare_get_all_types_post('page'),
            'condition' => [
                'edcare_' . $control_id . '_link_type' => '2',
            ]
        ]
    );
}

function edcare_get_repeater_links_attr($item, $control_id = null)
{

    if ('2' == $item['edcare_' . $control_id . '_link_type']) {
        $link = get_permalink($item['edcare_' . $control_id . '_page_link']);
        $target = '_self';
        $rel = 'nofollow';
    } else {
        $link = !empty($item['edcare_' . $control_id . '_link']['url']) ? $item['edcare_' . $control_id . '_link']['url'] : '';
        $target = !empty($item['edcare_' . $control_id . '_link']['is_external']) ? '_blank' : '';
        $rel = !empty($item['edcare_' . $control_id . '_link']['nofollow']) ? 'nofollow' : '';
    }

    return [
        'link' => $link,
        'target' => $target,
        'rel' => $rel
    ];
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

function edcare_is_elementor_edit_mode()
{
    return \Elementor\Plugin::$instance->editor->is_edit_mode();
}

/**
 * Get all Pages
 */
if (!function_exists('edcare_get_all_pages')) {
    function edcare_get_all_pages()
    {

        $page_list = get_posts(
            array(
                'post_type' => 'page',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => 50,
            )
        );

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}

/**
 * Post Settings Parameter
 */
function edcare_get_post_settings($settings)
{
    foreach ($settings as $key => $value) {
        $post_args[$key] = $value;
    }
    $post_args['post_status'] = 'publish';

    return $post_args;
}

/**
 * Post Orderby Options
 */
function edcare_get_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    return $orderby;
}

/**
 * Get all types of post.
 */
function edcare_get_all_types_post($post_type)
{

    $posts_args = get_posts(array(
        'post_type' => $post_type,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => 20,
    ));

    $posts = array();

    if (!empty($posts_args) && !is_wp_error($posts_args)) {
        foreach ($posts_args as $post) {
            $posts[$post->ID] = $post->post_title;
        }
    }

    return $posts;
}

/**
 * Get Post Categories
 */
function edcare_get_categories($taxonomy)
{
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ));
    $options = array();
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
    }
    return $options;
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
if (!function_exists('edcare_render_icon')) {
    function edcare_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
    {
        // Check if its already migrated
        $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
        // Check if its a new widget without previously selected icon using the old Icon control
        $is_new = empty($settings[$old_icon_id]);

        $attributes['aria-hidden'] = 'true';

        if (edcare_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
            \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
        } else {
            if (empty($attributes['class'])) {
                $attributes['class'] = $settings[$old_icon_id];
            } else {
                if (is_array($attributes['class'])) {
                    $attributes['class'][] = $settings[$old_icon_id];
                } else {
                    $attributes['class'] .= ' ' . $settings[$old_icon_id];
                }
            }
            printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
        }
    }
}


/**
 * Get Post Thumbnail Size
 */
function edcare_get_thumbnail_sizes()
{
    $sizes = get_intermediate_image_sizes();
    foreach ($sizes as $s) {
        $ret[$s] = $s;
    }
    return $ret;
}


/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function edcare_get_allowed_html_desc($level = 'basic')
{
    if (!in_array($level, ['basic', 'intermediate', 'advance'])) {
        $level = 'basic';
    }

    $tags_str = '<' . implode('>,<', array_keys(edcare_get_allowed_html_tags($level))) . '>';
    return sprintf(__('This input field has support for the following HTML tags: %1$s', 'edcare-core'), '<code>' . esc_html($tags_str) . '</code>');
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function edcare_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [
            'class' => [],
        ],
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
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];
    }

    if ($level === 'advance') {
        $allowed_html['ul'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['ol'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['li'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
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
        ),
        'abbr' => array(
            'title' => array(),
        ),
        'b' => array(
            'class' => array(),
        ),
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
            'data-background' => array(),
        ),
        'dl' => array(),
        'dt' => array(),
        'em' => array(
            'class' => array(),
        ),
        'h1' => array(
            'class' => array(),
        ),
        'h2' => array(
            'class' => array(),
        ),
        'h3' => array(
            'class' => array(),
        ),
        'h4' => array(
            'class' => array(),
        ),
        'h5' => array(
            'class' => array(),
        ),
        'h6' => array(
            'class' => array(),
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
        ),
        'iframe' => array(
            'width' => array(),
            'height' => array(),
            'scrolling' => array(),
            'frameborder' => array(),
            'allow' => array(),
            'src' => array(),
        ),
        'video' => array(
            'autoplay' => array(),
            'playsinline' => array(),
        ),
        'source' => array(
            'src' => array(),
            'type' => array(),
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
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'fill' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g' => array(
            'fill' => true,
            'filter' => true,
        ),
        'title' => array('title' => true),
        'path' => array(
            'd' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
            'class' => true
        ),
        'defs' => array(),
        'filter' => array(
            'id' => true,
            'x' => true,
            'y' => true,
            'width' => true,
            'height' => true,
            'filterUnits' => true,
            'color-interpolation-filters' => true,
        ),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}

/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
if (!function_exists('edcare_is_elementor_version')) {
    function edcare_is_elementor_version($operator = '<', $version = '2.6.0')
    {
        return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
    }
}


/**
 * Get all types of post.
 *
 * @param string $post_type
 *
 * @return array
 */
function get_post_list($post_type = 'any')
{
    return get_query_post_list($post_type);
}


/**
 * @param string $post_type
 * @param int $limit
 * @param string $search
 * @return array
 */
function get_query_post_list($post_type = 'any', $limit = -1, $search = '')
{
    global $wpdb;
    $where = '';
    $data = [];

    if (-1 == $limit) {
        $limit = '';
    } elseif (0 == $limit) {
        $limit = "limit 0,1";
    } else {
        $limit = $wpdb->prepare(" limit 0,%d", esc_sql($limit));
    }

    if ('any' === $post_type) {
        $in_search_post_types = get_post_types(['exclude_from_search' => false]);
        if (empty($in_search_post_types)) {
            $where .= ' AND 1=0 ';
        } else {
            $where .= " AND {$wpdb->posts}.post_type IN ('" . join(
                "', '",
                array_map('esc_sql', $in_search_post_types)
            ) . "')";
        }
    } elseif (!empty($post_type)) {
        $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_type = %s", esc_sql($post_type));
    }

    if (!empty($search)) {
        $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql($search) . '%');
    }

    $query = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
    $results = $wpdb->get_results($query);
    if (!empty($results)) {
        foreach ($results as $row) {
            $data[$row->ID] = $row->post_title;
        }
    }
    return $data;
}


/**
 * Get all elementor page templates
 *
 * @param null $type
 *
 * @return array
 */
function get_elementor_templates($type = null)
{
    $options = [];

    if ($type) {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];
        $args['tax_query'] = [
            [
                'taxonomy' => 'elementor_library_type',
                'field' => 'slug',
                'terms' => $type,
            ],
        ];

        $page_templates = get_posts($args);

        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }
    } else {
        $options = get_query_post_list('elementor_library');
    }

    return $options;
}



/**
 * Slugify
 */
if (!function_exists('edcare_slugify')) {
    function edcare_slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;

    }
}

// Use the following code to get ride of autop (automatic <p> tag) and line breaking tag (<br> tag).
add_filter('wpcf7_autop_or_not', '__return_false');


