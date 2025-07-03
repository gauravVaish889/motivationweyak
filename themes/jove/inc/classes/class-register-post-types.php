<?php
/**
 * Register Post Types
 *
 * @package Jove
 */

namespace Jove\Inc;

use Jove\Inc\Traits\Singleton;

/**
 * Register Post Types
 *
 * @package Jove
 */
class Register_Post_Types {

	use Singleton;

	/**
	 * Private class constructor to prevent direct object creation.
	 *
	 * This method sets up all the hooks related to the post type.
	 * It is meant to be overridden in the classes which implement
	 * this trait. This is ideal for doing stuff that you only want to
	 * do once, such as hooking into actions and filters, etc.
	 */
	protected function __construct() {

		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {

		/**
		 * Actions.
		 */
		add_action( 'init', [ $this, 'register_post_types' ], 5 );
	}

	/**
     * Register the custom post type.
     *
     * @link https://developer.wordpress.org/reference/functions/register_post_type/
     */
    public function register_post_types() {

        /**
         * If the post type already exists, or if the blog is not installed yet, return.
         */
        if ( ! is_blog_installed() || post_type_exists( apply_filters('jove_slug', esc_html__('jove', 'jove') ) ) ) {
            return;
        }

        /**
         * Get an array of custom post types.
         */
        $custom_post_types = self::author_post_args();

        /**
         * Loop through the custom post types and register them.
         */
        foreach ($custom_post_types as $key => $value) {

            /**
             * Define the labels for the post type.
             */
            $labels = array(
                'name'                  => esc_html_x($value['general_name'], 'Post Type General Name', 'jove'),
                'singular_name'         => esc_html_x($value['singular_name'], 'Post Type Singular Name', 'jove'),
                'menu_name'             => esc_html__($value['menu_name'], 'jove'),
                'name_admin_bar'        => esc_html__($value['singular_name'], 'jove'),
                'archives'              => esc_html__($value['singular_name'] . ' Archives', 'jove'),
                'attributes'            => esc_html__($value['singular_name'] . ' Attributes', 'jove'),
                'parent_item_colon'     => esc_html__('Parent ' . $value['singular_name'] . ':', 'jove'),
                'all_items'             => esc_html__($value['general_name'], 'jove'),
                'add_new_item'          => esc_html__('Add ' . $value['singular_name'], 'jove'),
				'add_new'          		=> esc_html__('Add ' . $value['singular_name'], 'jove'),
                'new_item'              => esc_html__('New ' . $value['singular_name'], 'jove'),
                'edit_item'             => esc_html__('Edit ' . $value['singular_name'], 'jove'),
                'update_item'           => esc_html__('Update ' . $value['singular_name'], 'jove'),
                'view_item'             => esc_html__('View ' . $value['singular_name'], 'jove'),
                'view_items'            => esc_html__('View ' . $value['general_name'], 'jove'),
                'search_items'          => esc_html__('Search ' . $value['singular_name'], 'jove'),
                'not_found'             => esc_html__('Not found', 'jove'),
                'not_found_in_trash'    => esc_html__('Not found in Trash', 'jove'),
                'featured_image'        => esc_html__('Featured Image', 'jove'),
                'set_featured_image'    => esc_html__('Set featured image', 'jove'),
                'remove_featured_image' => esc_html__('Remove featured image', 'jove'),
                'use_featured_image'    => esc_html__('Use as featured image', 'jove'),
                'insert_into_item'      => esc_html__('Insert into ' . $value['singular_name'], 'jove'),
                'uploaded_to_this_item' => esc_html__('Uploaded to this ' . $value['singular_name'], 'jove'),
                'items_list'            => esc_html__($value['general_name'] . ' list', 'jove'),
                'items_list_navigation' => esc_html__($value['general_name'] . ' list navigation', 'jove'),
                'filter_items_list'     => esc_html__('Filter ' . $value['general_name'] . 'list', 'jove'),
            );

            /**
             * Define the arguments for the post type.
             */
            $args = array(
                'label'                 => esc_html__($value['singular_name'] . '', 'jove'),
                'description'           => esc_html__($value['singular_name'] . ' Post Type', 'jove'),
                'labels'                => $labels,
                'supports'              => $value['supports'],
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => $value['show_in_menu'],
                'show_in_rest'          => true,
                'menu_icon'             => $value['dashicon'],
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => $value['show_in_nav_menus'],
                'can_export'            => true,
                'has_archive'           => $value['has_archive'],
                'exclude_from_search'   => $value['exclude_from_search'],
                'publicly_queryable'    => true,
                'capability_type'       => $value['capability_type'],
                'rewrite'               => $value['rewrite'],
            );

            /**
             * Register the post type.
             */
            register_post_type($key, $args);
            self::flush_rewrite_rules();
        }
    }

    /**
     * Flush rewrite rules to ensure that the permalinks are updated.
     *
     * This function calls the WordPress function `flush_rewrite_rules` to
     * refresh the permalink structure. It should be called after registering
     * custom post types or taxonomies to ensure the changes are recognized.
     *
     * @return void
     */
    public static function flush_rewrite_rules() {
        flush_rewrite_rules();
    }

    /**
     * Get post types arguments
     *
     * Returns an array of default settings for the post types used in the theme.
     *
     * @return array of default settings
     */
    public static function author_post_args() {

        // Array of default settings for the post types used in the theme.
        // The array keys are the post type names.
        return array(
            'video'                    => array(
                'menu_name'             => esc_html__('Videos', 'jove'), // Menu name in the admin menu.
                'singular_name'         => esc_html__('Video', 'jove'), // Singular name of the post type.
                'general_name'          => esc_html__('Videos', 'jove'), // General name of the post type.
                'dashicon'              => 'dashicons-video-alt3', // Dashicon for the post type.
                'has_archive'           => true, // Whether the post type has an archive page.
                'exclude_from_search'   => false, // Whether the post type should be excluded from search.
                'show_in_nav_menus'     => false, // Whether the post type should be shown in the nav menu.
                'show_in_menu'          => true, // Whether the post type should be shown in the menu.
                'capability_type'       => 'post', // Capability type of the post type.
                'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'), // Features supported by the post type.
                'rewrite'               => array('slug' => apply_filters('jove_video_slug', esc_html__('video', 'jove')), 'with_front' => false), // Rewrite rules for the post type.
            ),
        );
    }
}