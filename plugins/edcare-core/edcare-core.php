<?php

/**
 * Plugin Name: EdCare Core
 * Description: This is a companion plugin for EdCare Core.
 * Plugin URI:  https://themeforest.net/user/rrdevs/
 * Version:     1.0.3
 * Author:      RRdevs
 * Author URI:  https://themeforest.net/user/rrdevs/
 * Text Domain: edcare-core
 * Elementor tested up to: 3.29.9
 */



if (!defined('ABSPATH'))
	exit; // Exit if accessed directly


/**
 * Define
 */
define('EDCARE_CORE_ADDONS_URL', plugins_url('/', __FILE__));
define('EDCARE_CORE_ADDONS_DIR', dirname(__FILE__));
define('EDCARE_CORE_ADDONS_PATH', plugin_dir_path(__FILE__));
define('EDCARE_CORE_ELEMENTS_PATH', EDCARE_CORE_ADDONS_DIR . '/include/elementor');
define('EDCARE_CORE_ELEMENTS_URL', EDCARE_CORE_ADDONS_URL . '/include/elementor');
define('EDCARE_CORE_WIDGET_PATH', EDCARE_CORE_ADDONS_DIR . '/include/widgets');
define('EDCARE_CORE_INCLUDE_PATH', EDCARE_CORE_ADDONS_DIR . '/include');
define('EDCARE_CORE_THEME_NAME', 'EdCare');
define('EDCARE_CORE_EXT_LOGO_ICON_URL', EDCARE_CORE_ADDONS_URL . 'assets/img/logo.png');
define('EDCARE_CORE_API_URL', 'https://wp.rrdevs.net/edcare/elementor-block/');
define('EDCARE_CORE_EXT_LOGO_URL', EDCARE_CORE_ADDONS_URL . 'include/elementor/templates/img/logo.png');

define('EDCARE_CORE_ADDONS_FILE_', __FILE__);
define('EDCARE_CORE_ADDONS_VERSION_', '1.0.0');



/**
 *
 * Elementor blocks
 */

add_action('init', function () {
	if (defined('ELEMENTOR_VERSION')) {
		include_once(EDCARE_CORE_ADDONS_DIR . '/include/elementor/templates/api.php');
		include_once(EDCARE_CORE_ADDONS_DIR . '/include/elementor/templates/init.php');
		include_once(EDCARE_CORE_ADDONS_DIR . '/include/elementor/templates/import.php');
		include_once(EDCARE_CORE_ADDONS_DIR . '/include/elementor/templates/load.php');


		\EDCARE_CORE_ELEMENTOR\Templates\EDCARE_CORE_Templates::instance()->init();
		\EDCARE_CORE_ELEMENTOR\Templates\EDCARE_CORE_Import::instance()->load();
		\EDCARE_CORE_ELEMENTOR\Templates\EDCARE_CORE_Load::instance()->load();
	}
});

/**
 *
 * Elementor widgets
 */


foreach (edcare_core_include_files() as $key => $file_name) {
	foreach ($file_name as $file) {
		include_once(EDCARE_CORE_ADDONS_DIR . "/include/{$key}/{$file}.php");
	}
}

function edcare_core_include_files()
{
	$files_list = [
		'traits' => [
			'edcare-core-style-trait',
			'edcare-core-query-trait',
			'edcare-core-post-trait',
			'edcare-core-column-trait',
			'edcare-core-animation-trait',
			'edcare-core-icon-trait',
			'edcare-core-menu-trait',
			'edcare-core-offcanvas-trait',

		],
		'custom-post' => [
			'header',
			'footer',
			'portfolio',
			'services',
			'offcanvas',
			'breadcrumb',
		],
		'widgets' => [
			'edcare-core-blog-post-sidebar'
		],
		'common' => [
			'common-functions',
			'allow-svg',
			'class-ocdi-importer',
			'edcare-core-megamenu',
			'lp-related-course',
		],
		'post' => [
			'post-functions',
			'post-query'
		],
		'menu' => [
			'menu'
		],
	];

	return $files_list;
}


function edcare_core_enqueue_scripts()
{
	wp_enqueue_style('edcare-core-style', EDCARE_CORE_ADDONS_URL . 'assets/css/edcare-plugin-core.css', array(), '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'edcare_core_enqueue_scripts');

function edcare_core_admin_css_load($screen)
{
	if ('nav-menus.php' != $screen) {
		return;
	}
	wp_enqueue_style('edcare-core-admin-css', plugins_url('assets/css/edcare-core-admin.css', __FILE__), false, '1.0');
}
add_action('admin_enqueue_scripts', 'edcare_core_admin_css_load');


/**
 * Main EdCare Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class EdCare_Core
{

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		// Init Plugin
		add_action('plugins_loaded', array($this, 'init'));
		add_action('init', array($this, 'load_textdomain'));
		add_action('wp_enqueue_scripts', [$this, 'edcare_core_enqueue_scripts']);
		// sidebar archive
		add_action('wp_ajax_ac_learnpress_ajax_course', [$this, 'edcare_core_course_contents']);
		add_action('wp_ajax_nopriv_ac_learnpress_ajax_course', [$this, 'edcare_core_course_contents']);
		// filter archive
		add_action('wp_ajax_ac_learnpress_filter_ajax_course', [$this, 'edcare_core_course_filter_contents']);
		add_action('wp_ajax_nopriv_ac_learnpress_filter_ajax_course', [$this, 'edcare_core_course_filter_contents']);
		// filter open archive
		add_action('wp_ajax_ac_learnpress_filter_open_ajax_course', [$this, 'edcare_core_course_filter_open_contents']);
		add_action('wp_ajax_nopriv_ac_learnpress_filter_open_ajax_course', [$this, 'edcare_core_course_filter_open_contents']);
		// filter open archive
		add_action('wp_ajax_ac_learnpress_tab_ajax_course', [$this, 'edcare_core_course_tab_contents']);
		add_action('wp_ajax_nopriv_ac_learnpress_tab_ajax_course', [$this, 'edcare_core_course_tab_contents']);
	}

	/**
	 * Load course data with ajax
	 */
	public function edcare_core_course_contents(){
		$course_order_by = 'DESC';
		$get_ac_lp_course_per = get_theme_mod( 'ac_lp_course_per', 12 );

		$get_tax_val = isset($_POST['tax_val'])? sanitize_text_field($_POST['tax_val']) : '';
		$get_term_id = isset($_POST['term_id'])? sanitize_text_field($_POST['term_id']) : '';

		if ('cat_yes' == $get_tax_val) {
			$args = array(
				'post_type' => LP_COURSE_CPT,
				'orderby' => 'modified',
				'order' => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
				'tax_query' => array(
					array(
						'taxonomy' => 'course_category',
						'field'    => 'term_id',
						'terms'    => $get_term_id,
					),
				),
			);

		} elseif ('tag_yes' == $get_tax_val) {
			$args = array(
				'post_type' => LP_COURSE_CPT,
				'orderby' => 'modified',
				'order' => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
				'tax_query' => array(
					array(
						'taxonomy' => 'course_tag',
						'field'    => 'term_id',
						'terms'    => $get_term_id,
					),
				),
			);
		} else {
			$args = array(
				'post_type' => LP_COURSE_CPT,
				'orderby' => 'modified',
				'order' => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
			);
		}

		$get_instructors = isset($_POST['instructors'])? array_map('sanitize_text_field', $_POST['instructors']) : array();
		sort($get_instructors);
		$get_categories = isset($_POST['categories'])? array_map('sanitize_text_field', $_POST['categories']) : array();
		$get_skills = isset($_POST['skills'])? array_map('sanitize_text_field', $_POST['skills']) : array();
		$get_sort_by = isset($_POST['sort_by'])? sanitize_text_field($_POST['sort_by']) : '';
		$get_rating = isset($_POST['rating'])? array_map('sanitize_text_field', $_POST['rating']) : '';
		$get_page_num = isset($_POST['paged']) ? absint($_POST['paged']) : 1;
		$get_search_for = isset($_POST['search_for'])? sanitize_text_field($_POST['search_for']) : '';
		$pagination = false;

		if(!empty($get_search_for)){
			$args['s'] = $get_search_for;
		}

		if(!empty($get_instructors)){
			$args['author__in'] =   $get_instructors;
			$pagination = false;
		}

		// var_dump($get_categories);
		if(!empty($get_categories)){
			$args['tax_query'] = array(
				'relation'  => 'OR',
				array(
					'taxonomy'  => 'course_category',
					'field'    => 'slug',
					'terms'     => $get_categories
				)
			);
			$pagination = false;
		}

		if(!empty($get_skills)){
			// $args['meta_key'] = '_lp_level';
			$args['meta_query'] = array(
				array(
					'key'       => '_lp_level',
					'value'     => $get_skills,
					'compare'   => 'IN'
				)
			);
			$pagination = false;
		}
		// var_dump($args);
		if(!empty($get_sort_by)){
			$compare = ($get_sort_by == 'on_free')? '=' : '!=';
			$args['meta_query'] = array(
				array(
					'key'       => '_lp_regular_price',
					'value'     => '',
					'compare'   => $compare
				)
			);
			$pagination = false;
		}

		if(!empty($get_rating)){
			$comment_args = array(
				'meta_query' => array(
					array(
						'key'     => '_lpr_rating',
						'value'   => $get_rating,
						'compare' => 'IN', // Checks if the meta key exists
					),
				),
			);
			$comment_query = new WP_Comment_Query($comment_args);

			// Step 2: Extract unique post IDs from comments
			$post_ids = array(0);
			if (!empty($comment_query->comments)) {
				foreach ($comment_query->comments as $comment) {
					if (!in_array($comment->comment_post_ID, $post_ids)) {
						$post_ids[] = $comment->comment_post_ID;
					}
				}
			}

			$args['post__in'] = $post_ids;
			$pagination = false;
		}

		// page
		if(!empty($get_page_num)){
			$args['paged'] =   $get_page_num;
			$pagination = true;
		}

		$query = new WP_Query($args);

		ob_start();
		if($query->have_posts()){
			while ($query->have_posts()){ $query->the_post();
				get_template_part( 'learnpress/archive-sidebar/content-course', 'grid' );
			}
			wp_reset_postdata();
		}else{
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		}
		$results = ob_get_clean();

		ob_start();
		if($query->have_posts()){
			while ($query->have_posts()){ $query->the_post();
				get_template_part( 'learnpress/archive-sidebar/content-course', 'list' );
			}
			wp_reset_postdata();
		}else{
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		}
		$results_list = ob_get_clean();

		$totals = '<p class="total-courses">'.__('Total courses found: ', 'edcare-core').$query->found_posts.'</p>';

		$totals_posts = $query->found_posts;

		$total_pagi = ceil( $totals_posts/2 );

		$res_args = array('results' => $results, 'results_list' => $results_list, 'totals' => $totals, 'total_pagi' => $total_pagi, 'total_posts' => $totals_posts);

		wp_send_json_success($res_args);
		wp_die();
	}

	/**
	 * filter course ajax
	 */

	public function edcare_core_course_filter_contents() {
		$course_order_by = 'DESC';
		$get_ac_lp_course_per = get_theme_mod( 'ac_lp_course_per', 12 );

		$get_tax_val = isset($_POST['tax_val'])? sanitize_text_field($_POST['tax_val']) : '';
		$get_term_id = isset($_POST['term_id'])? sanitize_text_field($_POST['term_id']) : '';

		if ('cat_yes' == $get_tax_val) {
			$args = array(
				'post_type'      => LP_COURSE_CPT,
				'orderby'        => 'modified',
				'order'          => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
				'tax_query'      => array(
					array(
						'taxonomy' => 'course_category',
						'field'    => 'term_id',
						'terms'    => $get_term_id,
					),
				),
			);

		} elseif ('tag_yes' == $get_tax_val) {
			$args = array(
				'post_type' => LP_COURSE_CPT,
				'orderby' => 'modified',
				'order' => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
				'tax_query' => array(
					array(
						'taxonomy' => 'course_tag',
						'field'    => 'term_id',
						'terms'    => $get_term_id,
					),
				),
			);
		} else {
			$args = array(
				'post_type'      => LP_COURSE_CPT,
				'orderby'        => 'modified',
				'order'          => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
			);
		}

		$get_sort_by       = isset($_POST['sort_by']) ? sanitize_text_field( $_POST['sort_by'] ) : array();
		$get_categories    = isset($_POST['categories']) ? array_map('sanitize_text_field', $_POST['categories']) : array();
		$get_instructors   = isset($_POST['instructors']) ? array_map('sanitize_text_field', $_POST['instructors']) : array();
		$get_sort_by_price = isset($_POST['sort_by_price']) ? array_map('sanitize_text_field', $_POST['sort_by_price']) : array();
		$get_skills        = isset($_POST['skills']) ? array_map('sanitize_text_field', $_POST['skills']) : array();
		$get_search_for    = isset($_POST['search_for'])? sanitize_text_field($_POST['search_for']) : '';
		$get_paged         = isset($_POST['paged']) ? absint( $_POST['paged'] ) : 1;

		$filter_args = array(
			'sort_by'       => $get_sort_by,
			'categories'    => $get_categories,
			'instructors'   => $get_instructors,
			'sort_by_price' => $get_sort_by_price,
			'skills'        => $get_skills,
		);

		// latest
		if( !empty( $get_sort_by ) && 'latest' == $get_sort_by ) {
			$args['orderby'] = 'date';
		}
		// trending
		if( !empty( $get_sort_by ) && 'trending' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_course_is_sale';
		}
		// popular
		if( !empty( $get_sort_by ) && 'popularity' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'lp_course_rating_average';
		}
		// low to high
		if( !empty( $get_sort_by ) && 'low_high' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_price';
			$args['order'] = 'ASC';
		}
		// hight to low
		if( !empty( $get_sort_by ) && 'high_low' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_price';
			$args['order'] = 'DESC';
		}

		// filter by course category
		if( !empty( $get_categories ) ) {
			$args['tax_query'] = array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'course_category',
					'field'    => 'slug',
					'terms'    => $get_categories
				)
			);
		}

		// filter by course instructor
		if( !empty( $get_instructors ) ) {
			$args['author__in'] = $get_instructors;
		}

		// filter by price
		if( !empty( $get_sort_by_price ) && 'on_all' != $get_sort_by_price[0] ) {
			$compare = ( $get_sort_by_price[0] == 'on_free' ) ? '=' : '!=';
			$args['meta_query'] = array(
				array(
					'key'     => '_lp_regular_price',
					'value'   => '',
					'compare' => $compare
				)
			);
		}

		// filter by skill
		if( !empty( $get_skills ) ) {
			$args['meta_query'] = array(
				array(
					'key'     => '_lp_level',
					'value'   => $get_skills,
					'compare' => 'IN'
				)
			);
		}

		$args['paged'] = $get_paged;

		if(!empty($get_search_for)){
			$args['s'] = $get_search_for;
		}

		$query = new WP_Query($args);

		ob_start();
		if($query->have_posts()){
			while ($query->have_posts()){ $query->the_post();
				get_template_part( 'learnpress/archive-filter/content-course', 'grid', $filter_args );
			}
			wp_reset_postdata();
		}else{
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		}
		$results = ob_get_clean();

		ob_start();
		if($query->have_posts()){
			while ($query->have_posts()){ $query->the_post();
				get_template_part( 'learnpress/archive-filter/content-course', 'list', $filter_args );
			}
			wp_reset_postdata();
		}else{
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		}
		$results_list = ob_get_clean();

		// 2 start
		ob_start();
		if($query->have_posts()):
			while ($query->have_posts()) : $query->the_post();
				get_template_part('learnpress/archive-filter-open/content-course','grid', $filter_args);
			endwhile;
			wp_reset_postdata();
		else:
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		endif;
		$results_2 = ob_get_clean();

		ob_start();
		if($query->have_posts()):
			while ($query->have_posts()) : $query->the_post();
				get_template_part('learnpress/archive-filter-open/content-course','list', $filter_args);
			endwhile;
			wp_reset_postdata();
		else:
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		endif;
		$results_list_2 = ob_get_clean();
		// 2 end

		$totals = '<p class="total-courses">'.__('Total courses found: ', 'edcare-core').$query->found_posts.'</p>';

		$totals_posts = $query->found_posts;

		$total_pagi = ceil( $totals_posts/2 );

		$res_args = array('results' => $results, 'results_list' => $results_list, 'results_2' => $results_2, 'results_list_2' => $results_list_2, 'totals' => $totals, 'total_pagi' => $total_pagi, 'total_posts' => $totals_posts, 'args' => $args, 'tax_val' => $get_tax_val, 'term_id' => $get_term_id );

		wp_send_json_success( $res_args );
		wp_die();
	}

	/**
	 * filter open content
	 */
	public function edcare_core_course_filter_open_contents() {
		/**
		 * Prevent loading this file directly
		 */
		defined( 'ABSPATH' ) || exit();
		$course_order_by      = 'DESC';
		$get_ac_lp_course_per = get_theme_mod( 'ac_lp_course_per', 12 );

		$get_tax_val = isset($_POST['tax_val'])? sanitize_text_field($_POST['tax_val']) : '';
		$get_term_id = isset($_POST['term_id'])? sanitize_text_field($_POST['term_id']) : '';

		if ('cat_yes' == $get_tax_val) {
			$args = array(
				'post_type'      => LP_COURSE_CPT,
				'orderby'        => 'modified',
				'order'          => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
				'tax_query'      => array(
					array(
						'taxonomy' => 'course_category',
						'field'    => 'term_id',
						'terms'    => $get_term_id,
					),
				),
			);

		} elseif ('tag_yes' == $get_tax_val) {
			$args = array(
				'post_type'      => LP_COURSE_CPT,
				'orderby'        => 'modified',
				'order'          => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
				'tax_query'      => array(
					array(
						'taxonomy' => 'course_tag',
						'field'    => 'term_id',
						'terms'    => $get_term_id,
					),
				),
			);
		} else {
			$args = array(
				'post_type'      => LP_COURSE_CPT,
				'orderby'        => 'modified',
				'order'          => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per
			);
		}

		$get_sort_by       = isset($_POST['sort_by']) ? sanitize_text_field( $_POST['sort_by'] ) : '';
		$get_categories    = isset($_POST['categories']) ? sanitize_text_field( $_POST['categories'] ) : '';
		$get_instructors   = isset($_POST['instructors']) ? intval($_POST['instructors']) : '';
		$get_sort_by_price = isset($_POST['sort_by_price']) ? sanitize_text_field( $_POST['sort_by_price'] ) : '';
		$get_search_for = isset($_POST['search_for'])? sanitize_text_field($_POST['search_for']) : '';
		$get_paged = isset($_POST['paged']) ? absint($_POST['paged']) : 1;

		if(!empty($get_search_for)){
			$args['s'] = $get_search_for;
		}

		$args['paged'] = $get_paged;

		$filter_args = array(
			'sort_by'       => $get_sort_by,
			'categories'    => $get_categories,
			'instructors'   => $get_instructors,
			'sort_by_price' => $get_sort_by_price,
		);

		// latest
		if( !empty( $get_sort_by ) && 'latest' == $get_sort_by ) {
			$args['orderby'] = 'date';
		}
		// trending
		if( !empty( $get_sort_by ) && 'trending' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_course_is_sale';
		}
		// popular
		if( !empty( $get_sort_by ) && 'popularity' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'lp_course_rating_average';
		}
		// low to high
		if( !empty( $get_sort_by ) && 'low_high' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_price';
			$args['order'] = 'ASC';
		}
		// hight to low
		if( !empty( $get_sort_by ) && 'high_low' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_price';
			$args['order'] = 'DESC';
		}

		// filter by course category
		if( !empty( $get_categories ) ) {
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'course_category',
					'field'    => 'slug',
					'terms'    => $get_categories
				)
			);
		}

		// filter by course instructor
		if( !empty( $get_instructors ) ) {
			$args['author'] = $get_instructors;
		}

		// filter by price
		if( !empty( $get_sort_by_price ) && 'on_all' != $get_sort_by_price && 'on_sale' != $get_sort_by_price ) {
			$compare = ( $get_sort_by_price == 'on_free' ) ? '=' : '!=';
			$args['meta_query'] = array(
				array(
					'key'     => '_lp_regular_price',
					'value'   => '',
					'compare' => $compare
				)
			);
		}

		// filter by price
		if( !empty( $get_sort_by_price ) && 'on_sale' == $get_sort_by_price ) {
			$args['meta_query'] = array(
				array(
					'key'     => '_lp_sale_price',
					'value'   => '',
					'compare' => '!='
				)
			);
		}

		$query = new WP_Query($args);

		ob_start();
		if($query->have_posts()){
			while ($query->have_posts()){ $query->the_post();
				get_template_part('learnpress/archive-filter-open/content-course', 'grid', $filter_args );
			}
			wp_reset_postdata();
		}else{
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		}
		$results = ob_get_clean();

		ob_start();
		if($query->have_posts()){
			while ($query->have_posts()){ $query->the_post();
				get_template_part('learnpress/archive-filter-open/content-course', 'list', $filter_args );
			}
			wp_reset_postdata();
		}else{
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		}
		$results_list = ob_get_clean();

		$totals_posts = $query->found_posts;

		$totals = '<p class="total-courses">'.__('Total courses found: ', 'edcare-core').$totals_posts.'</p>';


		$total_pagi = ceil( $totals_posts/2 );

		$res_args = array('results' => $results, 'results_list' => $results_list, 'totals' => $totals, 'total_pagi' => $total_pagi, 'total_posts' => $totals_posts );

		wp_send_json_success( $res_args );
		wp_die();
	}

	/**
	 * course tab content
	 */
	 public function edcare_core_course_tab_contents() {
		$course_order_by = 'DESC';
		$get_ac_lp_course_per = get_theme_mod( 'ac_lp_course_per', 12 );


		$get_tax_val = isset($_POST['tax_val'])? sanitize_text_field($_POST['tax_val']) : '';
		$get_term_id = isset($_POST['term_id'])? sanitize_text_field($_POST['term_id']) : '';

		if ('cat_yes' == $get_tax_val) {
			$args = array(
				'post_type' => LP_COURSE_CPT,
				'orderby' => 'modified',
				'order' => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
				'tax_query' => array(
					array(
						'taxonomy' => 'course_category',
						'field'    => 'term_id',
						'terms'    => $get_term_id,
					),
				),
			);

		} elseif ('tag_yes' == $get_tax_val) {
			$args = array(
				'post_type' => LP_COURSE_CPT,
				'orderby' => 'modified',
				'order' => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per,
				'tax_query' => array(
					array(
						'taxonomy' => 'course_tag',
						'field'    => 'term_id',
						'terms'    => $get_term_id,
					),
				),
			);
		} else {
			$args = array(
				'post_type'      => LP_COURSE_CPT,
				'orderby'        => 'modified',
				'order'          => $course_order_by,
				'posts_per_page' => $get_ac_lp_course_per
			);
		}

		$get_sort_by    = isset($_POST['sort_by']) ? sanitize_text_field( $_POST['sort_by'] ) : '';
		$get_categories = isset($_POST['categories']) ? sanitize_text_field( $_POST['categories'] ) : '';
		$get_search_for = isset($_POST['search_for'])? sanitize_text_field($_POST['search_for']) : '';
		$get_paged      = isset($_POST['paged']) ? absint( $_POST['paged'] ) : 1;

		if(!empty($get_search_for)){
			$args['s'] = $get_search_for;
		}

		// page
		$args['paged'] =   $get_paged;

		// latest
		if( !empty( $get_sort_by ) && 'latest' == $get_sort_by ) {
			$args['orderby'] = 'date';
		}
		// trending
		if( !empty( $get_sort_by ) && 'trending' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_course_is_sale';
		}
		// popular
		if( !empty( $get_sort_by ) && 'popularity' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'lp_course_rating_average';
		}
		// low to high
		if( !empty( $get_sort_by ) && 'low_high' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_price';
			$args['order'] = 'ASC';
		}
		// hight to low
		if( !empty( $get_sort_by ) && 'high_low' == $get_sort_by ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_lp_price';
			$args['order'] = 'DESC';
		}

		// filter by course category
		if( !empty( $get_categories ) && 'all_courses' != $get_categories ) {
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'course_category',
					'field'    => 'slug',
					'terms'    => $get_categories
				)
			);
		}

		$query = new WP_Query($args);

		ob_start();
		if($query->have_posts()){
			while ($query->have_posts()){ $query->the_post();
				get_template_part( 'learnpress/archive-tab/content-course', 'grid' );
			}
			wp_reset_postdata();
		}else{
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		}
		$results = ob_get_clean();

		ob_start();
		if($query->have_posts()){
			while ($query->have_posts()){ $query->the_post();
				get_template_part( 'learnpress/archive-tab/content-course', 'list' );
			}
			wp_reset_postdata();
		}else{
			echo '<div class="alert alert-danger" role="alert">'.__('No course found!', 'edcare-core').'</div>';
		}
		$results_list = ob_get_clean();

		$totals = '<p class="total-courses">'.__('Total courses found: ', 'edcare-core').$query->found_posts.'</p>';

		$totals_posts = $query->found_posts;

		$total_pagi = ceil( $totals_posts/2 );

		$res_args = array('results' => $results, 'results_list' => $results_list, 'totals' => $totals, 'total_pagi' => $total_pagi, 'total_posts' => $totals_posts);

		wp_send_json_success($res_args);
		wp_die();
	 }


	/**
	 * edcare_core_enqueue_scripts
	 */
	public function edcare_core_enqueue_scripts()
	{

		wp_enqueue_script('ac-learnpress-ajax', plugins_url('/assets/js/learnpress-ajax.js', __FILE__), ['jquery'], false, true);
		wp_enqueue_script('ac-learnpress-ajax-filter', plugins_url('/assets/js/learnpress-ajax-filter.js', __FILE__), ['jquery'], false, true);
		wp_enqueue_script('ac-learnpress-ajax-filter-open', plugins_url('/assets/js/learnpress-ajax-filter-open.js', __FILE__), ['jquery'], false, true);
		wp_enqueue_script('ac-learnpress-ajax-tab', plugins_url('/assets/js/learnpress-ajax-tab.js', __FILE__), ['jquery'], false, true);

		if(is_tax('course_category') || is_tax('course_tag')) {
			$current_term    = get_queried_object();
			$current_term_id = $current_term->term_id;

			if(is_tax('course_category')){
				$course_tax_page = 'cat_yes';
			} elseif (is_tax('course_tag')) {
				$course_tax_page = 'tag_yes';
			}
		} else {
			$course_tax_page = 'no_tax_page';
			$current_term_id = 'no_term_id';
		}

		$nonce = wp_create_nonce('_nonce'); // Generate a nonce

		// Localize script with nonce value
		wp_localize_script('ac-learnpress-ajax', 'wp_vars', array(
			'nonce'           => $nonce,
			'ajaxurl'         => admin_url('admin-ajax.php'),
			'course_tax_page' => $course_tax_page,
			'current_term_id' => $current_term_id
		));

		$nonce_2 = wp_create_nonce('_nonce2'); // Generate a nonce

		// Localize script with nonce value
		wp_localize_script('ac-learnpress-ajax-filter', 'wp_vars_filter', array(
			'nonce'   => $nonce_2,
			'ajaxurl' => admin_url('admin-ajax.php'),
			'course_tax_page' => $course_tax_page,
			'current_term_id' => $current_term_id
		));

		$nonce_3 = wp_create_nonce('_nonce3'); // Generate a nonce

		// Localize script with nonce value
		wp_localize_script('ac-learnpress-ajax-filter-open', 'wp_vars_filter_open', array(
			'nonce'   => $nonce_3,
			'ajaxurl' => admin_url('admin-ajax.php'),
			'course_tax_page' => $course_tax_page,
			'current_term_id' => $current_term_id
		));

		$nonce_4 = wp_create_nonce('_nonce4'); // Generate a nonce

		// Localize script with nonce value
		wp_localize_script('ac-learnpress-ajax-tab', 'wp_vars_tab', array(
			'nonce' => $nonce_4,
			'ajaxurl' => admin_url('admin-ajax.php'),
			'course_tax_page' => $course_tax_page,
			'current_term_id' => $current_term_id
		));
	}

	/**
	 * Load tutor text domain for translation
	 */
	public function load_textdomain()
	{
		load_plugin_textdomain('edcare-core', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}


	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', array($this, 'admin_notice_missing_main_plugin'));
			return;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', array($this, 'admin_notice_minimum_elementor_version'));
			return;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', array($this, 'admin_notice_minimum_php_version'));
			return;
		}


		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once('plugin.php');
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'edcare-core'),
			'<strong>' . esc_html__('EdCare Core', 'edcare-core') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'edcare-core') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'edcare-core'),
			'<strong>' . esc_html__('EdCare Core', 'edcare-core') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'edcare-core') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'edcare-core'),
			'<strong>' . esc_html__('EdCare Core', 'edcare-core') . '</strong>',
			'<strong>' . esc_html__('PHP', 'edcare-core') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
}

// Instantiate EdCare_Core.
new EdCare_Core();
