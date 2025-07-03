<?php

namespace EdCareCore;

use EdCareCore\PageSettings\Page_Settings;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class EdCare_Core_Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var EdCare_Core_Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return EdCare_Core_Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

	public function edcare_core_elementor_category($manager)
	{
		$manager->add_category(
			'edcare_core',
			array(
				'title' => esc_html__('Edcare Addons', 'edcare-core'),
				'icon' => 'eicon-banner',
			)
		);
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts()
	{
		wp_register_script('edcare_core', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts()
	{
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'edcare_core-editor',
			plugins_url('/assets/js/editor/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * edcare_core_enqueue_editor_scripts
	 */
	function edcare_core_enqueue_editor_scripts()
	{
		wp_enqueue_style('edcare-core-element-addons-editor', EDCARE_CORE_ADDONS_URL . 'assets/css/editor.css', [], '1.0');
		// wp_enqueue_script('ac-learnpress-ajax', plugins_url('/assets/js/learnpress-ajax.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * edcare_core_enqueue_scripts
	 */
	function edcare_core_enqueue_scripts()
	{
		wp_enqueue_script('ac-learnpress-ajax', plugins_url('/assets/js/learnpress-ajax.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle)
	{
		if ('edcare-core-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param  \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{

		foreach ($this->edcare_core_widget_list() as $key => $widgets) {
			foreach ($widgets as $widget) {
				$widget_file = EDCARE_CORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
				if (file_exists($widget_file)) {
					require_once $widget_file;
				}
			}
		}


		// for woocommerce plugin
		// if (class_exists('woocommerce')) {
		// 	foreach ($this->edcare_core_widget_list_woo() as $key => $widgets) {
		// 		foreach ($widgets as $widget) {
		// 			$widget_file = EDCARE_CORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
		// 			if (file_exists($widget_file)) {
		// 				require_once $widget_file;
		// 			}
		// 		}
		// 	}
		// }

		// for event plugin
		// if (class_exists('Wpeventin')) {
		// 	foreach ($this->edcare_core_widget_list_event() as $key => $widgets) {
		// 		foreach ($widgets as $widget) {
		// 			$widget_file = EDCARE_CORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
		// 			if (file_exists($widget_file)) {
		// 				require_once $widget_file;
		// 			}
		// 		}
		// 	}
		// }

		// for tutor lms plugin
		// if (function_exists('tutor')) {
		// 	foreach ($this->edcare_core_widget_list_tutor_lms() as $key => $widgets) {
		// 		foreach ($widgets as $widget) {
		// 			$widget_file = EDCARE_CORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
		// 			if (file_exists($widget_file)) {
		// 				require_once $widget_file;
		// 			}
		// 		}
		// 	}
		// }

		// // for tutor lms plugin
		// if ( class_exists( 'LearnPress' ) ) {
		// 	foreach ($this->edcare_core_widget_list_lp_lms() as $key => $widgets) {
		// 		foreach ($widgets as $widget) {
		// 			$widget_file = EDCARE_CORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
		// 			if (file_exists($widget_file)) {
		// 				require_once $widget_file;
		// 			}
		// 		}
		// 	}
		// }
	}

	// edcare_core_widget_list
	public function edcare_core_widget_list()
	{
		return [


			//all header widgest
			'header' => [
				'header-builder',
				'header-builder-2',
				'header-builder-3',
				'header-builder-4',
			],

			// all blog widgets
			'blog' => [
				'blog-post',
			],

			// all offcanvas widgets
			'offcanvas' => [
				'offcanvas-mobile-menu',
			],

			'about' => [
				'about',
			],

			'common' => [
				'cta',
				'fun-fact',
				'features-slider',
				'why-choose-us',
				'info-box',
				'subscriber-form',
				'instagram',
				'image',
				'search',
				'counter',
			],

			'instructor' => [
				'instructor',
			],

			'price' => [
				'advanced-pricing-tab',
				'pricing',
			],

			'course' => [
				'course-card',
				'course-category',
				'advanced-course-tab',
				'course-slider',
			],

			'heading' => [
				'heading',
			],

			'brand' => [
				'brand-slider',
			],

			'buttons' => [
				'button',
			],

			'contact' => [
				'contact-form',
				'contact-info',
			],

			'video' => [
				'video',
			],

			'faq' => [
				'faq',
			],

			'event' => [
				'events',
			],

			// all testimonial widgets
			'testimonial' => [
				'testimonial-slider',
			],

			// all hero widgets
			'hero' => [
				'hero-banner',
			],
		];
	}

	// edcare_core_widget_list_woo
	// public function edcare_core_widget_list_woo()
	// {
	// 	return [
	// 		'woocommerce' => [
	// 			'product-card',
	// 		],
	// 	];
	// }

	// // edcare_core_widget_list_event
	// public function edcare_core_widget_list_event()
	// {
	// 	return [
	// 		'event' => [
	// 			'events',
	// 		],
	// 	];
	// }

	// // edcare_core_widget_list_tutor_lms
	// public function edcare_core_widget_list_tutor_lms()
	// {
	// 	return [
	// 		'course' => [
	// 			'course-tab',
	// 			'course-card',
	// 			'course-instructor',
	// 			'course-search',
	// 		],
	// 	];
	// }

	// edcare_core_widget_list_lp_lms
	// public function edcare_core_widget_list_lp_lms()
	// {
	// 	return [
	// 		'learnpress' => [
	// 			'lp-course-card',
	// 			'lp-course-tab',
	// 		],
	// 	];
	// }

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	// private function add_page_settings_controls() {
	// 	require_once( __DIR__ . '/page-settings/manager.php' );
	// 	new Page_Settings();
	// }


	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

	public function register_controls(Controls_Manager $controls_Manager)
	{
		include_once(EDCARE_CORE_ADDONS_DIR . '/controls/edcaregradient.php');
		$edcaregradient = 'EdCareCore\Elementor\Controls\Group_Control_EdCareGradient';
		$controls_Manager->add_group_control($edcaregradient::get_type(), new $edcaregradient());

		include_once(EDCARE_CORE_ADDONS_DIR . '/controls/edcarebggradient.php');
		$edcarebggradient = 'EdCareCore\Elementor\Controls\Group_Control_EdCareBGGradient';
		$controls_Manager->add_group_control($edcarebggradient::get_type(), new $edcarebggradient());
	}




	public function edcare_core_add_custom_icons_tab($tabs = array())
	{
		$fontawesome_icons = array(
			'angle-up',
			'check',
			'times',
			'calendar',
			'language',
			'shopping-cart',
			'bars',
			'search',
			'map-marker',
			'arrow-right',
			'arrow-left',
			'arrow-up',
			'arrow-down',
			'angle-right',
			'angle-left',
			'angle-up',
			'angle-down',
			'phone',
			'users',
			'user',
			'map-marked-alt',
			'trophy-alt',
			'envelope',
			'marker',
			'globe',
			'broom',
			'home',
			'bed',
			'chair',
			'bath',
			'tree',
			'laptop-code',
			'cube',
			'cog',
			'play',
			'trophy-alt',
			'heart',
			'truck',
			'user-circle',
			'map-marker-alt',
			'comments',
			'award',
			'bell',
			'book-alt',
			'book-open',
			'book-reader',
			'graduation-cap',
			'laptop-code',
			'music',
			'ruler-triangle',
			'user-graduate',
			'microscope',
			'glasses-alt',
			'theater-masks',
			'atom'
		);

		$tabs['edcare-core-fontawesome-icons'] = array(
			'name' => 'edcare-core-fontawesome-icons',
			'label' => esc_html__('EdCare - Fontawesome Pro Light', 'edcare-core'),
			'labelIcon' => 'edcare-core-icon',
			'prefix' => 'fa-',
			'displayPrefix' => 'fal',
			'url' => EDCARE_CORE_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
			'icons' => $fontawesome_icons,
			'ver' => '1.0.0',
		);

		return $tabs;
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);

		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

		add_action('elementor/elements/categories_registered', [$this, 'edcare_core_elementor_category']);

		// Register custom controls
		add_action('elementor/controls/controls_registered', [$this, 'register_controls']);
		add_action('elementor/controls/register_style_controls', [$this, 'register_style_rols']);

		add_filter('elementor/icons_manager/additional_tabs', [$this, 'edcare_core_add_custom_icons_tab']);

		// $this->edcare_core_add_custom_icons_tab();

		add_action('elementor/editor/after_enqueue_scripts', [$this, 'edcare_core_enqueue_editor_scripts']);
		// add_action('wp_enqueue_scripts', [$this, 'edcare_core_enqueue_scripts']);

		// $this->add_page_settings_controls();

	}
}

// Instantiate Plugin Class
EdCare_Core_Plugin::instance();