<?php
/**
 * Register Custom Taxonomies
 *
 * @package Jove
 */

namespace Jove\Inc;

use Jove\Inc\Traits\Singleton;

/**
 * Class Register_Taxonomies
 *
 * @package Jove
 */
class Register_Taxonomies {

	use Singleton;

	/**
	 * Class constructor.
	 *
	 * The class constructor is responsible for setting up all the hooks related
	 * to the taxonomies. It is meant to be overridden in the classes which
	 * implement this trait. This is ideal for doing stuff that you only want to
	 * do once, such as hooking into actions and filters, etc.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Set up hooks.
	 *
	 * This method sets up all the hooks related to the taxonomies,
	 * such as registering the type and year taxonomies.
	 *
	 * @since 1.0.0
	 */
	protected function setup_hooks() {
		/**
		 * Register the taxonomy.
		 *
		 * This action registers the taxonomy using the `register_taxonomies`
		 * method.
		 *
		 * @since 1.0.0
		 *
		 * @internal
		 */
		add_action( 'init', [ $this, 'register_taxonomies' ], 0 );

		/**
		 * Allow HTML in taxonomy description when editing.
		 *
		 * This method allows HTML in the taxonomy description when editing
		 * using the `allow_html_in_taxonomy_description` method.
		 *
		 * @since 1.0.0
		 */
		add_action( 'edited_term', [ $this, 'allow_html_in_taxonomy_description' ], 10, 2 );
		add_action( 'create_term', [ $this, 'allow_html_in_taxonomy_description' ], 10, 2 );

		/**
		 * Allow HTML in taxonomy description when displayed.
		 *
		 * This method allows HTML in the taxonomy description when displayed
		 * using the `allow_html_in_displayed_taxonomy_description` method.
		 *
		 * @since 1.0.0
		 */
		remove_filter( 'term_description', 'wp_kses_data' );
		add_filter( 'term_description', [ $this, 'allow_html_in_displayed_taxonomy_description' ] );
	}

	/**
     * Register a taxonomy, post_types_categories for the post types.
     *
     * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
     *
     * @since 1.0.0
     */
    public function register_taxonomies() {

        if ( ! is_blog_installed() ) {
            return;
        }

        // Add new taxonomy, make it hierarchical
        $custom_taxonomy_types = self::taxonomy_args();

        if ( $custom_taxonomy_types ) {

            foreach ( $custom_taxonomy_types as $key =>  $value ) {

                if ( 'category' == $value['hierarchical'] ) {

                    // Add new taxonomy, make it hierarchical (like categories)
                    $labels = array(
                        'name'              => esc_html_x( $value['general_name'], 'taxonomy general name', 'jove' ),
                        'singular_name'     => esc_html_x( $value['singular_name'], 'taxonomy singular name', 'jove' ),
                        'search_items'      => esc_html__( 'Search ' . $value['general_name'], 'jove' ),
                        'all_items'         => esc_html__( 'All ' . $value['general_name'], 'jove' ),
                        'parent_item'       => esc_html__( 'Parent ' . $value['general_name'], 'jove' ),
                        'parent_item_colon' => esc_html__( 'Parent ' . $value['general_name'] .':', 'jove' ),
                        'edit_item'         => esc_html__( 'Edit ' . $value['general_name'] , 'jove' ),
                        'update_item'       => esc_html__( 'Update '  . $value['general_name'] , 'jove' ),
                        'add_new_item'      => esc_html__( 'Add ' . $value['general_name'], 'jove' ),
                        'new_item_name'     => esc_html__( 'New ' . $value['general_name'] .' Name', 'jove' ),
                        'menu_name'         => esc_html__( $value['general_name'], 'jove' ),
                    );

                    $args = array(
                        'hierarchical'      => true,
                        'labels'            => $labels,
                        'show_ui'           => true,
                        'show_in_menu'      => 'jove',
                        'show_admin_column' => true,
                        'show_in_nav_menus' => true,
                        'show_in_rest'      => true,
                        'rewrite'           => array( 'slug' => $value['slug'], 'hierarchical' => true, 'with_front' => false ),
                    );
                    register_taxonomy( $key, $value['post_type'], $args );

                }

                if ( 'tag' == $value['hierarchical'] ) {

                    $labels = array(
                        'name'                       => esc_html_x( $value['general_name'], 'taxonomy general name', 'jove' ),
                        'singular_name'              => esc_html_x( $value['singular_name'], 'taxonomy singular name', 'jove' ),
                        'search_items'               => esc_html__( 'Search ' . $value['general_name'], 'jove' ),
                        'popular_items'              => esc_html__( 'Popular ' .$value['general_name'], 'jove' ),
                        'all_items'                  => esc_html__( 'All ' . $value['general_name'], 'jove' ),
                        'parent_item'                => null,
                        'parent_item_colon'          => null,
                        'edit_item'                  => esc_html__( 'Edit ' .$value['singular_name'], 'jove' ),
                        'update_item'                => esc_html__( 'Update '. $value['singular_name'], 'jove' ),
                        'add_new_item'               => esc_html__( 'Add ' .$value['singular_name'], 'jove' ),
                        'new_item_name'              => esc_html__( 'New ' . $value['singular_name'] . ' Name', 'jove' ),
                        'separate_items_with_commas' => esc_html__( 'Separate ' . strtolower($value['general_name'] ) . ' with commas', 'jove' ),
                        'add_or_remove_items'        => esc_html__( 'Add or remove ' . strtolower($value['general_name'] ), 'jove' ),
                        'choose_from_most_used'      => esc_html__( 'Choose from the most used '. strtolower($value['general_name'] ), 'jove' ),
                        'not_found'                  => esc_html__( 'No ' . strtolower($value['general_name'] ) . ' found.', 'jove' ),
                        'menu_name'                  => esc_html__( $value['general_name'], 'jove' ),
                    );

                    $args = array(
                        'hierarchical'      => false,
                        'labels'            => $labels,
                        'show_ui'           => true,
                        'show_admin_column' => true,
                        'show_in_nav_menus' => true,
                        'show_in_rest'      => true,
                        'rewrite'           => array( 'slug' => $value['slug'], 'hierarchical' => true, 'with_front' => false ),
                    );
                    register_taxonomy( $key, $value['post_type'], $args );

                }

            }

        }
    }

	/**
     * Get taxonomy types arguments
     *
     * This function returns an array of arguments for each taxonomy type.
	 * The keys of the array are the taxonomy names and the values are arrays
	 * with the following keys:
	 * - hierarchical: whether the taxonomy is hierarchical (true) or not (false)
	 * - slug: the slug of the taxonomy
	 * - singular_name: the singular name of the taxonomy
	 * - general_name: the general name of the taxonomy
	 * - post_type: the post type to which the taxonomy is assigned
     *
     * @return array of default settings
     */
    public static function taxonomy_args() {

        return array(
			'author' => array(
                // Whether the taxonomy is hierarchical (true) or not (false)
                'hierarchical'      => 'tag',
                // The slug of the taxonomy
                'slug'              => 'author',
                // The singular name of the taxonomy
                'singular_name'     => esc_html__('Author', 'jove'),
                // The general name of the taxonomy
                'general_name'	    => esc_html__('Authors', 'jove'),
                // The post type to which the taxonomy is assigned
                'post_type'         => array( 'video' ),
            ),
			'institution' => array(
                // Whether the taxonomy is hierarchical (true) or not (false)
                'hierarchical'      => 'tag',
                // The slug of the taxonomy
                'slug'              => 'institution',
                // The singular name of the taxonomy
                'singular_name'     => esc_html__('Institution', 'jove'),
                // The general name of the taxonomy
                'general_name'	    => esc_html__('Institutions', 'jove'),
                // The post type to which the taxonomy is assigned
                'post_type'         => array( 'video' ),
            ),
			'journal' => array(
                // Whether the taxonomy is hierarchical (true) or not (false)
                'hierarchical'      => 'tag',
                // The slug of the taxonomy
                'slug'              => 'journal',
                // The singular name of the taxonomy
                'singular_name'     => esc_html__('Journal', 'jove'),
                // The general name of the taxonomy
                'general_name'	    => esc_html__('Journals', 'jove'),
                // The post type to which the taxonomy is assigned
                'post_type'         => array( 'video' ),
            ),
			'keyword' => array(
                // Whether the taxonomy is hierarchical (true) or not (false)
                'hierarchical'      => 'tag',
                // The slug of the taxonomy
                'slug'              => 'keyword',
                // The singular name of the taxonomy
                'singular_name'     => esc_html__('Keyword', 'jove'),
                // The general name of the taxonomy
                'general_name'	    => esc_html__('Keywords', 'jove'),
                // The post type to which the taxonomy is assigned
                'post_type'         => array( 'video' ),
            ),
        );
    }

	/**
	 * Allow HTML in taxonomy description when editing.
	 *
	 * This function sanitizes the HTML content in the taxonomy description 
	 * field when a term is edited. It updates the term description with 
	 * only the allowed HTML tags and attributes.
	 *
	 * @param int    $term_id  The term ID.
	 * @param string $taxonomy The taxonomy.
	 */
	public function allow_html_in_taxonomy_description( $term_id, $taxonomy ) {
		// Check if the description is set in the POST data.
		if ( isset( $_POST['description'] ) ) {
			// Define allowed HTML tags and their attributes.
			$allowed_html = [
				'a'      => [
					'href'   => [],
					'title'  => [],
					'target' => [],
				],
				'b'      => [],
				'strong' => [],
				'em'     => [],
				'i'      => [],
				'p'      => [],
				'br'     => [],
				'ul'     => [],
				'ol'     => [],
				'li'     => [],
				'span'   => [
					'style' => [],
				],
			];

			// Sanitize the description content using wp_kses.
			$safe_description = wp_kses( $_POST['description'], $allowed_html );

			// Update the term description with the sanitized content.
			wp_update_term( $term_id, $taxonomy, [
				'description' => $safe_description,
			] );
		}
	}

	/**
	 * Allow HTML in taxonomy description when displayed.
	 *
	 * @param string $description  The description of the taxonomy.
	 *
	 * @return string  The description of the taxonomy without additional sanitization.
	 */
	public function allow_html_in_displayed_taxonomy_description( $description ) {
		// Return the description without additional sanitization.
		// This is needed because the description is sanitized twice otherwise.
		// The first sanitization happens when the term is saved.
		// The second sanitization happens when the term is displayed.
		// By returning the description without additional sanitization, we ensure that the description is not sanitized twice.
		// This allows the description to contain HTML tags.
    	return $description;
	}
}