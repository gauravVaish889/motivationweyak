<?php

namespace EdCareCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use EdCareCore\Elementor\Controls\Group_Control_EdCareBGGradient;
use EdCareCore\Elementor\Controls\Group_Control_EdCareGradient;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Offcanvas_Mobile_Menu extends Widget_Base
{

	use \EdCareCore\Widgets\EdCare_Style_Trait;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'edcare-offcanvas-mobile-menu';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __(EDCARE_CORE_THEME_NAME . ' :: Offcanvas Mobile Menu', 'edcare-core');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'edcare-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['edcare-core'];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends()
	{
		return ['edcare-core'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	protected function register_controls()
	{
		$this->register_controls_section();
		$this->style_tab_content();
	}


	protected function register_controls_section()
	{

		// layout Panel
		$this->start_controls_section(
			'edcare_layout',
			[
				'label' => esc_html__('Design Layout', 'edcare-core'),
			]
		);
		$this->add_control(
			'edcare_design_style',
			[
				'label' => esc_html__('Select Layout', 'edcare-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__('Layout 1', 'edcare-core'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'edcare_offcanvas_menu_content_section',
			[
				'label' => esc_html__('Offcanvas Menu Controls', 'edcare-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'edcare_offcanvas_menu_show',
			[
				'label' => esc_html__('Select Device', 'edcare-core'),
				'description' => esc_html__('Menu will hide from selected device', 'edcare-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'xxl' => esc_html__('XXL Device', 'edcare-core'),
					'xl' => esc_html__('XL Device', 'edcare-core'),
					'lg' => esc_html__('LG Device', 'edcare-core'),
					'md' => esc_html__('MD Device', 'edcare-core'),
					'sm' => esc_html__('SM Device', 'edcare-core'),
					'xs' => esc_html__('XS Device', 'edcare-core'),
				],
				'default' => 'xl',
			]
		);

		$this->end_controls_section();
	}

	// style_tab_content
	protected function style_tab_content()
	{
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		?>

		<?php if ($settings['edcare_design_style'] == 'layout-2'): ?>


		<?php else: ?>

			<?php if (\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>


				<div class="tp-main-menu-mobile">
					<nav class="tp-main-menu-content">
						<ul class="tp-nav-menu ">
							<li>
								<a href="<?php print esc_url(home_url('/')); ?>" class="nav-links">Demo Link</a>
							</li>
							<li>
								<a href="<?php print esc_url(home_url('/')); ?>" class="nav-links">Home</a>
							</li>
							<li>
								<a href="<?php print esc_url(home_url('/')); ?>" class="nav-links">About</a>
							</li>
							<li>
								<a href="<?php print esc_url(home_url('/')); ?>" class="nav-links">Portfolio</a>
							</li>
							<li>
								<a href="<?php print esc_url(home_url('/')); ?>" class="nav-links">Contact</a>
							</li>
						</ul>
					</nav>
				</div>

			<?php else: ?>
				<div class="tp-main-menu-mobile d-<?php echo esc_attr($settings['edcare_offcanvas_menu_show']); ?>-none"></div>

			<?php endif; ?>
		<?php endif;
	}
}

$widgets_manager->register(new EdCare_Offcanvas_Mobile_Menu());
