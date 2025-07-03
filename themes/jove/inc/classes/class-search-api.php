<?php
/**
 * Search API
 *
 * @package Jove
 */

namespace Jove\Inc;

use Jove\Inc\Traits\Singleton;
use WP_REST_Server;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;
use WP_Query;
use WP_Post;
use stdClass;

/**
 * Class Search_Api
 *
 * Handles the custom REST API search endpoint.
 */
class Search_Api {

	use Singleton;

	/**
	 * Protected class constructor to prevent direct object creation.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Sets up hooks.
	 *
	 * @since 1.0.0
	 */
	protected function setup_hooks() {
		add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	/**
	 * Registers the routes for the REST API controller.
	 *
	 * This method registers a single route for the search API, which is used
	 * to fetch a list of posts based on the specified query parameters.
	 *
	 * @link https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
	 */
	public function register_routes(): void {
		register_rest_route(
			'jove/v2',
			'/search',
			[
				/**
				 * HTTP method to use for the request.
				 *
				 * @var string
				 */
				'methods'             => WP_REST_Server::READABLE,

				/**
				 * Callback function to call when the request is received.
				 *
				 * @var callable
				 */
				'callback'            => [ $this, 'get_items' ],

				/**
				 * Permission callback function to call before the request is processed.
				 *
				 * @var callable
				 */
				'permission_callback' => '__return_true',

				/**
				 * List of query arguments supported by the endpoint.
				 *
				 * @var array
				 */
				'query_args'                => [
					/**
					 * Search query.
					 *
					 * @var array
					 */
					's' => [
						'required'          => false,
						'type'              => 'string',
						'description'       => esc_html__( 'Search query', 'jove' ),
						'sanitize_callback' => 'sanitize_text_field',
					],

					/**
					 * Sort order.
					 *
					 * @var array
					 */
					'sort' => [
						'required'          => false,
						'type'              => 'string',
						'description'       => esc_html__( 'Filter posts by sort order', 'jove' ),
						'sanitize_callback' => 'sanitize_text_field',
					],

					/**
					 * Comma-separated author IDs.
					 *
					 * @var array
					 */
					'author' => [
						'required'          => false,
						'type'              => 'string',
						'description'       => esc_html__( 'Comma-separated author IDs', 'jove' ),
						'sanitize_callback' => 'sanitize_text_field',
					],

					/**
					 * Comma-separated institution IDs.
					 *
					 * @var array
					 */
					'institution' => [
						'required'          => false,
						'type'              => 'string',
						'description'       => esc_html__( 'Comma-separated institution IDs', 'jove' ),
						'sanitize_callback' => 'sanitize_text_field',
					],

					/**
					 * Comma-separated journal IDs.
					 *
					 * @var array
					 */
					'journal' => [
						'required'          => false,
						'type'              => 'string',
						'description'       => esc_html__( 'Comma-separated journal IDs', 'jove' ),
						'sanitize_callback' => 'sanitize_text_field',
					],

					/**
					 * Filter posts published before this date (YYYY-MM-DD).
					 *
					 * @var array
					 */
					'before' => [
						'required'          => false,
						'type'              => 'string',
						'description'       => esc_html__( 'Filter posts published before this date (YYYY-MM-DD)', 'jove' ),
						'sanitize_callback' => 'sanitize_text_field',
					],

					/**
					 * Filter posts published after this date (YYYY-MM-DD).
					 *
					 * @var array
					 */
					'after' => [
						'required'          => false,
						'type'              => 'string',
						'description'       => esc_html__( 'Filter posts published after this date (YYYY-MM-DD)', 'jove' ),
						'sanitize_callback' => 'sanitize_text_field',
					],

					/**
					 * Page number.
					 *
					 * @var array
					 */
					'page_no' => [
						'required'          => false,
						'type'              => 'integer',
						'description'       => esc_html__( 'Page number', 'jove' ),
						'default'           => 1,
					],

					/**
					 * Number of posts per page.
					 *
					 * @var array
					 */
					'posts_per_page' => [
						'required'          => false,
						'type'              => 'integer',
						'description'       => esc_html__( 'Number of posts per page', 'jove' ),
						'default'           => 10,
					],
				],
			]
		);
	}

	/**
	 * Handles the search API request.
	 *
	 * @param WP_REST_Request $request The request object.
	 * @return WP_REST_Response The response object.
	 */
	public function get_items( WP_REST_Request $request ): WP_REST_Response {
		// Extract query parameters from the request
		$search_term     = $request->get_param( 's' );
		$sort            = $request->get_param( 'sort' );
		$author_ids      = $request->get_param( 'author' );
		$institution_ids = $request->get_param( 'institution' );
		$journal_ids     = $request->get_param( 'journal' );
		$before_date     = $request->get_param( 'before' );
		$after_date      = $request->get_param( 'after' );
		$page_no         = (int) $request->get_param( 'page_no' );
		$posts_per_page  = (int) $request->get_param( 'posts_per_page' );

		// Initialize query arguments
		$query_args = [
			'post_status'            => 'publish',
			'posts_per_page'         => $posts_per_page,
			'paged'                  => $page_no,
			'post_type'              => ['video'],
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		];

		// Add search term to query if provided
		if ( ! empty( $search_term ) ) {
			$query_args['s'] = $search_term;
		}

		// Determine sort order based on parameter
		if ( ! empty( $sort ) ) {
			switch ($sort) {
				case 'latest':
					$query_args['orderby'] = 'date';
					$query_args['order'] = 'DESC';
					break;
				case 'oldest':
					$query_args['orderby'] = 'date';
					$query_args['order'] = 'ASC';
					break;
				case 'random':
					$query_args['orderby'] = 'rand';
					break;
				case 'a_z':
					$query_args['orderby'] = 'title';
					$query_args['order'] = 'ASC';
					break;
				case 'z_a':
					$query_args['orderby'] = 'title';
					$query_args['order'] = 'DESC';
					break;
				default:
					$query_args['orderby'] = 'date';
					$query_args['order'] = 'DESC';
			}
		} else {
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
		}

		// Initialize tax query if necessary
		if ( ! empty( $author_ids ) || ! empty( $institution_ids ) || ! empty( $journal_ids ) ) {
			$query_args['tax_query'] = [];
		}

		// Add author IDs to tax query if provided
		if ( ! empty( $author_ids ) ) {
			$query_args['tax_query'][] = [
				'taxonomy' => 'author',
				'field'    => 'slug',
				'terms'    => array_map( 'sanitize_text_field', explode( ',', $author_ids ) ),
				'operator' => 'IN',
			];
		}

		// Add institution IDs to tax query if provided
		if ( ! empty( $institution_ids ) ) {
			$query_args['tax_query'][] = [
				'taxonomy' => 'institution',
				'field'    => 'slug',
				'terms'    => array_map( 'sanitize_text_field', explode( ',', $institution_ids ) ),
				'operator' => 'IN',
			];
		}

		// Add journal IDs to tax query if provided
		if ( ! empty( $journal_ids ) ) {
			$query_args['tax_query'][] = [
				'taxonomy' => 'journal',
				'field'    => 'slug',
				'terms'    => array_map( 'sanitize_text_field', explode( ',', $journal_ids ) ),
				'operator' => 'IN',
			];
		}

		// Add date query if before or after date is provided
		if ( ! empty( $before_date ) || ! empty( $after_date ) ) {
			$query_args['date_query'] = [];

			if ( ! empty( $after_date ) ) {
				$query_args['date_query'][] = [
					'after'     => $after_date,
					'inclusive' => true,
				];
			}

			if ( ! empty( $before_date ) ) {
				$query_args['date_query'][] = [
					'before'    => $before_date,
					'inclusive' => true,
				];
			}
		}

		// Execute the query with the constructed arguments
		$results = new WP_Query( $query_args );

		// Return the response with formatted results
		return rest_ensure_response( $this->build_response( $results ) );
	}

	/**
	 * Builds the response data from the query results.
	 *
	 * @param WP_Query $results The query results containing the posts.
	 * @return array The formatted response data including post details and pagination info.
	 */
	private function build_response( WP_Query $results ): array {
		$posts = [];

		// Iterate over each post in the query results
		foreach ( $results->posts as $post ) {
			if ( $post instanceof WP_Post ) {
				$authorOutput = '';
				// Retrieve author affiliations for the current post
				$items = get_field('author_affiliation', $post->ID);
				if ( ! empty( $items ) ) {
					$affiliations = []; // To store unique affiliations

					// Loop through affiliation entries and collect unique names
					foreach ($items as $entry) {
						if (!empty($entry['affiliation']) && is_array($entry['affiliation'])) {
							foreach ($entry['affiliation'] as $affiliation) {
								if (is_a($affiliation, 'WP_Term') && !in_array($affiliation->name, $affiliations)) {
									$affiliations[] = $affiliation->name;
								}
							}
						}
					}

					$authorsData = []; // To store author names
					$authorOutput .= '<ul class="jove-abstract-block__authors">';
					
					// Construct author data with affiliation indices
					foreach ( $items as $data ) {
						$sub = [];
						if(!empty($data['affiliation'])) {
							foreach ($data['affiliation'] as $affiliation) {
								if (is_a($affiliation, 'WP_Term') && in_array($affiliation->name, $affiliations)) {
									$sub[] = 1 + array_search($affiliation->name, $affiliations);
								}
							}
						}
						$authorsData[] = $data['author']->name;
					}
					
					$authorOutput .= '<li>'.implode(', ', $authorsData).'</li>';
					$authorOutput .= '</ul>';
				}

				// Collect post details into response array
				$posts[] = [
					'id'        => $post->ID,
					'title'     => get_the_title( $post->ID ),
					'content'   => wp_trim_words( wp_strip_all_tags( $post->post_content ), 40 ),
					'authors'   => $authorOutput,
					'date'      => get_the_date( 'F j, Y', $post->ID ),
					'permalink' => get_permalink( $post->ID ),
					'journal'   => get_the_term_list( $post->ID, 'journal', '', ', ', '' ),
				];
			}
		}

		// Return the formatted response data with pagination details
		return [
			'posts'          => $posts,
			'total_posts'    => $results->found_posts,
			'posts_per_page' => $results->query_vars['posts_per_page'],
			'total_pages'    => $results->max_num_pages,
		];
	}
}