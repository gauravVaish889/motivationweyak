<?php
/**
 * Enqueue theme assets
 *
 * @package Jove
 */

namespace Jove\Inc;

use Jove\Inc\Traits\Singleton;

class Assets {

	use Singleton;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function __construct() {
		/**
		 * Set up hooks.
		 *
		 * This method sets up all the hooks related to the assets.
		 */
		$this->setup_hooks();
	}

	/**
	 * Set up hooks.
	 *
	 * This method sets up all the hooks related to the assets,
	 * such as styles and scripts.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function setup_hooks() {
		// Hook to register styles
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ], 1 );

		// Hook to register scripts
		add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );

		add_action( 'init', [ $this, 'enqueue_block_styles' ] );

		//add_action( 'wp_footer', array( $this, 'wpwebinfotech_add_footer_script' ) );
		add_action( 'wp_default_scripts', array( $this, 'remove_jquery_Migrate' ) ); 

		// Disable emojis
		add_action('init', array( $this, 'disable_wp_emojicons' ) );
	}

	/**
	 * Register styles.
	 *
	 * This method registers the theme's styles.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_styles() {
		// Register the theme's public stylesheet.
		wp_register_style(
			'select2',
			JOVE_BUILD_URI . '/library/select2.min.css',
			// Dependencies.
			[],
			// Version.
			'4.1.0',
			// Media.
			'all'
		);

		wp_register_style(
			'public-css',
			JOVE_BUILD_URI . '/css/public.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/public.css' ),
			// Media.
			'all'
		);

		// Register the theme's filter stylesheet.
		wp_register_style(
			'filter-css',
			JOVE_BUILD_URI . '/css/filter.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/filter.css' ),
			// Media.
			'all'
		);

		wp_register_style(
			'popup-css',
			JOVE_BUILD_URI . '/css/popup.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/popup.css' ),
			// Media.
			'all'
		);
		wp_register_style(
			'popup-css',
			JOVE_BUILD_URI . '/css/popup.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/popup.css' ),
			// Media.
			'all'
		);
		wp_register_style(
			'breadcrumb-css',
			JOVE_BUILD_URI . '/css/breadcrumb.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/breadcrumb.css' ),
			// Media.
			'all'
		);
		wp_register_style(
			'abstract-css',
			JOVE_BUILD_URI . '/css/abstract.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/abstract.css' ),
			// Media.
			'all'
		);
		wp_register_style(
			'experiment-css',
			JOVE_BUILD_URI . '/css/experiment.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/experiment.css' ),
			// Media.
			'all'
		);
		wp_register_style(
			'concept-css',
			JOVE_BUILD_URI . '/css/concept.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/concept.css' ),
			// Media.
			'all'
		);
		wp_register_style(
			'custom-css',
			JOVE_DIR_URI . '/inc/assets/css/custom.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_DIR_PATH . '/inc/assets/css/custom.css' ),
			// Media.
			'all'
		);


		wp_register_style(
			'jquery-ui',
			JOVE_BUILD_URI . '/css/jquery-ui.css',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/css/jquery-ui.css' ),
			// Media.
			'all'
		);

		if(isset($_GET['s'])){
			wp_enqueue_style('jquery-ui');		
		}
		
		wp_enqueue_style('breadcrumb-css');		
		wp_enqueue_style('abstract-css');
		wp_enqueue_style('experiment-css');
		wp_enqueue_style('concept-css');
		wp_enqueue_style('popup-css');
		// Enqueue the stylesheet.
		wp_enqueue_style('custom-css');
		wp_enqueue_style( 'public-css' );
	
		

		// If search page.
		if ( is_search() ) {
			wp_enqueue_style( 'filter-css' );

			wp_register_style(
				'search-css',
				JOVE_BUILD_URI . '/css/search.css',
				// Dependencies.
				[],
				// Version.
				filemtime( JOVE_BUILD_PATH . '/css/search.css' ),
				// Media.
				'all'
			);
			
			// Enqueue the stylesheet.
			// wp_enqueue_style( 'search-css' );
		}

		/*
		* Load additional block styles.
		*/
		$styled_blocks = ['button','list'];
		foreach ( $styled_blocks as $block_name ) {
			$args = array(
				'handle' => "jove-$block_name",
				'src'    => get_theme_file_uri( "build/css/core/$block_name.css" ),
			);
			wp_enqueue_block_style( "core/$block_name", $args );
		}
		
		if ( is_search() ) {
			wp_dequeue_style('abstract-css');
			wp_dequeue_style('popup-css');
			wp_dequeue_style('breadcrumb-css');
			//wp_dequeue_style('experiment-css');
			wp_dequeue_style('concept-css');

		}	

		if (get_query_var('video_post_slug')) {
			wp_dequeue_style('jove-button');
		}
	}

	/**
	 * Register scripts.
	 *
	 * This method registers the theme's scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_scripts() {
		// Register the theme's public script.
		wp_register_script(
			// Handle.
			'select2',
			// Source.
			JOVE_BUILD_URI . '/library/select2.min.js',
			// Dependencies.
			['jquery'],
			// Version.
			'4.1.0',
			// Enqueue in footer.
			true
		);

		wp_register_script(
			// Handle.
			'public-js',
			// Source.
			JOVE_BUILD_URI . '/js/public.js',
			// Dependencies.
			[],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/js/public.js' ),
			// Enqueue in footer.
			true
		);

	

		wp_register_script(
			// Handle.
			'search-js',
			// Source.
			JOVE_BUILD_URI . '/js/search.js',
			// Dependencies.
			['public-js'],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/js/search.js' ),
			// Enqueue in footer.
			true
		);

		wp_register_script(
			// Handle.
			'search-filter-js',
			// Source.
			JOVE_DIR_URI . '/inc/assets/js/search-filter.js',
			// Dependencies.
			['public-js', 'jquery'],
			// Version.
			filemtime( JOVE_DIR_PATH . '/inc/assets/js/search-filter.js' ),
			// Enqueue in footer.
			true
		);

		wp_register_script(
			// Handle.
			'popup-js',
			// Source.
			JOVE_BUILD_URI . '/js/popup.js',
			// Dependencies.
			['jquery'],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/js/popup.js' ),
			// Enqueue in footer.
			true
		);
		wp_register_script(
			// Handle.
			'abstract-js',
			// Source.
			JOVE_BUILD_URI . '/js/abstract.js',
			// Dependencies.
			['jquery'],
			// Version.
			filemtime( JOVE_BUILD_PATH . '/js/abstract.js' ),
			// Enqueue in footer.
			true
		);
		
		// Enqueue the script.
		wp_enqueue_script( 'abstract-js' );
		
		wp_enqueue_script( 'popup-js' );
		wp_enqueue_script( 'public-js' );

		wp_register_script(
			// Handle.
			'jQuery-ui',
			// Source.
			JOVE_BUILD_URI . '/js/jquery-ui.min.js',
			// Dependencies.
			array(),
			// Version.
			filemtime( JOVE_BUILD_PATH . '/js/jquery-ui.min.js' ),
			// Enqueue in footer.
			true
		);
		
		
		if(isset($_GET['s'])){
			
			wp_enqueue_script( 'jQuery-ui' );	
		}

		// If search page.
		if ( is_search() ) {
			// wp_enqueue_script( 'search-js' );
			// wp_localize_script( 'search-js', 'search_settings',
			// 	[
			// 		'search_api' 	=> home_url( '/wp-json/jove/v2/search' ),
			// 		'rest_api' 		=> home_url( 'wp-json/wp/v2/' ),
			// 		'root_url'     	=> home_url('/?s='.sanitize_text_field(get_search_query())),
			// 		'search_text'  	=> sanitize_text_field(get_search_query()),
			// 	]
			// );
			wp_dequeue_script( 'acf-search-filter-script-2' );
			wp_enqueue_script( 'search-filter-js' );
			wp_localize_script( 'search-filter-js', 'search_settings',
				[
					'search_api' 	=> home_url( '/wp-json/jove/v2/search' ),
					'rest_api' 		=> home_url( 'wp-json/wp/v2/' ),
					'home_url'		=> home_url(''),
					'video_list_api_url' => JOVE_VIDEO_API_URL,
					'api_key' => JOVE_VIDEO_API_KEY,
					'video_list_api_url_mock' => JOVE_VIDEO_API_URL_MOCK,
					'root_url'     	=> home_url('/?s='.sanitize_text_field(get_search_query())),
					'search_text'  	=> sanitize_text_field(get_search_query()),
					'is_mobile'	=> wp_is_mobile(),
				]
			);


			wp_dequeue_script( 'jquery-migrate' );
			wp_dequeue_script( 'popup-js' );
			wp_dequeue_script( 'abstract-js' );
			wp_dequeue_script( 'public-js' );
		}

	}

	//Remove jQuery Migrate
	public function remove_jquery_Migrate( $scripts ) {
		
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			if ( $script->deps ) {
				// Check whether the script has any dependencies
				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
		}
	}

	public function disable_wp_emojicons() {
		// Remove emoji script from front-end
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');

		// Remove emoji styles
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');

		// Remove from RSS feeds
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');

		// Remove from emails
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

		// Remove from TinyMCE editor
		add_filter('tiny_mce_plugins', function($plugins) {
			return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : [];
		});

		// Remove DNS prefetch for emoji CDN
		add_filter('emoji_svg_url', '__return_false');
	}

	/**
	 * Register styles.
	 *
	 * This method registers the theme's styles.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_block_styles() {

		/*
		* Load additional block styles.
		*/
		$styled_blocks = ['button','list'];
		foreach ( $styled_blocks as $block_name ) {
			$args = array(
				'handle' => "jove-$block_name",
				'src'    => get_theme_file_uri( "build/css/core/$block_name.css" ),
			);
			wp_enqueue_block_style( "core/$block_name", $args );
		}
	}

	/**
	 * Enqueues an individual block stylesheet based on a given block
	 * namespace and slug.
	 *
	 * @since 1.0.0
	 */
	private function enqueueStyle(string $namespace, string $slug): void
	{
		// Build a relative path and URL string.
		$relative = "public/css/{$namespace}/{$slug}";

		// Bail if the asset file doesn't exist.
		if (! file_exists(get_parent_theme_file_path("{$relative}.asset.php"))) {
			return;
		}

		// Get the asset file.
		$asset = include get_parent_theme_file_path("{$relative}.asset.php");

		// Register the block style.
		wp_enqueue_block_style("{$namespace}/{$slug}", [
			'handle' => "jove-{$namespace}-{$slug}",
			'src'    => get_parent_theme_file_uri("{$relative}.css"),
			'path'   => get_parent_theme_file_path("{$relative}.css"),
			'deps'   => $asset['dependencies'],
			'ver'    => $asset['version']
		]);
	}
}