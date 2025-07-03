<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use TPCore\Elementor\Controls\Group_Control_TPGradient;
use \Elementor\Repeater;


if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Footer_Lets_Contact extends Widget_Base
{

	use TP_Style_Trait, TP_Icon_Trait, TP_Offcanvas_Trait, TP_Menu_Trait;

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
		return 'tp-footer-language';
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
		return __(EDCARE_CORE_THEME_NAME . ' :: Language', 'tpcore');
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
		return 'tp-icon';
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
		return ['tpcore'];
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
		return ['tpcore'];
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
		$this->tp_design_layout('Layout Style', 2);
	}

	// style_tab_content
	protected function style_tab_content()
	{

		$this->tp_basic_style_controls('tp_footer_lets_contact', 'Title', '.tp-el-footer-language');
	}


	protected function render()
	{
		$settings = $this->get_settings_for_display();

		?>
		<?php if ($settings['tp_design_style'] == 'layout-2'): ?>

			<?php if (!empty(has_nav_menu('tp-language-menu'))): ?>
				<div class="tp-acadia-lang-area">
					<?php acadia_language_menu(); ?>
				</div>
			<?php else: ?>
				<div class="header-bottom__lang tp-header-info-item ">
					<ul>
						<li>
							<a id="header-bottom__lang-toggle" href="javascript:void(0)">
								<span>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/flag-1.png" alt="">
									<?php echo esc_html__('English', 'tpcore'); ?>
								</span>

								<span>
									<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M1.15067 0.653687C1.33329 0.4674 1.61907 0.450465 1.82045 0.602881L1.87814 0.653687L6 4.85839L10.1219 0.653687C10.3045 0.4674 10.5903 0.450465 10.7916 0.602881L10.8493 0.653687C11.032 0.839974 11.0486 1.13148 10.8991 1.3369L10.8493 1.39575L6.36374 5.97131C6.18111 6.1576 5.89534 6.17454 5.69396 6.02212L5.63626 5.97131L1.15067 1.39575C0.949778 1.19084 0.949778 0.858603 1.15067 0.653687Z"
											fill="white" stroke="white" stroke-width="0.5"></path>
									</svg>
								</span>
							</a>
							<ul class="header-bottom__lang-submenu">
								<li><a href="#"><?php echo esc_html__('English', 'tpcore') ?></a></li>
								<li><a href="#"><?php echo esc_html__('Spanish', 'tpcore') ?></a></li>
								<li><a href="#"><?php echo esc_html__('French', 'tpcore') ?></a></li>
							</ul>
						</li>
					</ul>
				</div>
			<?php endif; ?>
		<?php else: ?>

			<?php if (!empty(has_nav_menu('tp-language-menu'))): ?>
				<div class="tp-acadia-lang-area header-bottom__lang-2 d-inline-block">
					<?php acadia_language_menu(); ?>
				</div>
			<?php else: ?>
				<div class="header-bottom__lang-2 d-inline-block">
					<ul>
						<li>
							<a id="header-bottom__lang-toggle" href="javascript:void(0)">
								<span>
									<?php echo esc_html__('EN', 'tpcore'); ?>
								</span>

								<span>
									<svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
										<path d="M1 1L5 5L9 1" stroke="black" stroke-width="1.5" stroke-linecap="round"
											stroke-linejoin="round"></path>
									</svg>
								</span>
							</a>
							<ul class="header-bottom__lang-submenu-2">
								<li><a href="#"><?php echo esc_html__('English', 'tpcore') ?></a></li>
								<li><a href="#"><?php echo esc_html__('Spanish', 'tpcore') ?></a></li>
								<li><a href="#"><?php echo esc_html__('French', 'tpcore') ?></a></li>
							</ul>
						</li>
					</ul>
				</div>
			<?php endif; ?>




		<?php endif; ?>
	<?php

	}
}

$widgets_manager->register(new TP_Footer_Lets_Contact());
