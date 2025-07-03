<?php
namespace EdCareCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Image extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'edcare_image';
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
	public function get_title() {
		return __( 'Image', 'edcare-core' );
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
	public function get_icon() {
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
	public function get_categories() {
		return [ 'edcare_core' ];
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
	public function get_script_depends() {
		return [ 'edcare-core' ];
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
	protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            '_content_design_layout',
            [
                'label' => esc_html__( 'Image', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => esc_html__('Select Layout', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'edcare-core'),
                    'layout-2' => esc_html__('Layout 2', 'edcare-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => esc_html__( 'Show Shape?', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'section_image',
            [
                'label' => esc_html__( 'Choose Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'section_image_two',
            [
                'label' => esc_html__( 'Choose Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'section_image_three',
            [
                'label' => esc_html__( 'Choose Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'social_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-instagram',
                    'library' => 'brands',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'social_link',
            [
                'label' => esc_html__( 'Link', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '#', 'text-domain' ),
                'label_block' => true,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_design_layout',
            [
                'label' => esc_html__( 'Design Layout',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'design_layout_margin',
            [
                'label' => esc_html__( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_layout_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_image',
            [
                'label' => esc_html__( 'Image',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            '_heading_style_image_one',
            [
                'label' => esc_html__( 'Image One', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'image_one_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-insta-item .overlay' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_one_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .content-img-wrap .content-img-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .footer-insta-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_image_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .footer-insta-item .icon a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->start_controls_tabs( 'image_icon_tabs' );
        
        $this->start_controls_tab(
            'image_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            'image_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-insta-item .icon a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'image_icon_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-insta-item .icon a' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'image_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            'image_icon_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-insta-item .icon a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'image_icon_background_hover',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-insta-item .icon a:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'image_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .footer-insta-item .icon a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .footer-insta-item .icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_image_two',
            [
                'label' => esc_html__( 'Image Two', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_two_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .content-img-wrap .content-img-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_image_three',
            [
                'label' => esc_html__( 'Image Three', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_three_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .content-img-wrap .content-img-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_border',
            [
                'label' => esc_html__( 'Border', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_layout_border',
                'selector' => '{{WRAPPER}} .content-img-wrap .border-shape',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .content-img-wrap .border-shape' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );
        
        $this->end_controls_section();

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
	protected function render() {
		$settings = $this->get_settings_for_display();

        if ( !empty($settings['section_image']['url']) ) {
            $section_image = !empty($settings['section_image']['id']) ? wp_get_attachment_image_url( $settings['section_image']['id'], 'full') : $settings['section_image']['url'];
            $section_image_alt = get_post_meta($settings["section_image"]["id"], "_wp_attachment_image_alt", true);
        }

        if ( !empty($settings['section_image_two']['url']) ) {
            $section_image_two = !empty($settings['section_image_two']['id']) ? wp_get_attachment_image_url( $settings['section_image_two']['id'], 'full') : $settings['section_image_two']['url'];
            $section_image_two_alt = get_post_meta($settings["section_image_two"]["id"], "_wp_attachment_image_alt", true);
        }

        if ( !empty($settings['section_image_three']['url']) ) {
            $section_image_three = !empty($settings['section_image_three']['id']) ? wp_get_attachment_image_url( $settings['section_image_three']['id'], 'full') : $settings['section_image_three']['url'];
            $section_image_three_alt = get_post_meta($settings["section_image_three"]["id"], "_wp_attachment_image_alt", true);
        }

		?>

        <?php if ( $settings['design_style']  == 'layout-1' ) : ?>

            <div class="edcare-el-section content-img-wrap wow fade-in-left" data-wow-delay="400ms">
                <?php if ( !empty( $section_image ) ) : ?>
                    <div class="content-img-1">
                        <img src="<?php print esc_url($section_image); ?>" alt="<?php print esc_attr($section_image_alt); ?>">
                    </div>
                <?php endif; ?>
                <?php if ( !empty( $section_image_two ) ) : ?>
                    <div class="content-img-2">
                        <img src="<?php print esc_url($section_image_two); ?>" alt="<?php print esc_attr($section_image_two_alt); ?>">
                    </div>
                <?php endif; ?>
                <?php if ( !empty( $section_image_three ) ) : ?>
                    <div class="content-img-3">
                        <img src="<?php print esc_url($section_image_three); ?>" alt="<?php print esc_attr($section_image_three_alt); ?>">
                    </div>
                <?php endif; ?>
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="border-shape"></div>
                <?php endif; ?>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

            <div class="edcare-el-section footer-insta-item">
                <div class="overlay"></div>
                <div class="insta-img">
                    <img src="<?php print esc_url($section_image); ?>" alt="<?php print esc_attr($section_image_alt); ?>">
                </div>
                <div class="icon">
                    <a href="<?php print esc_url($settings['social_link']); ?>">
                        <?php edcare_render_icon($settings, 'social_icon' ); ?>
                    </a>
                </div>
            </div>

        <?php endif;
	}
}

$widgets_manager->register( new EdCare_Image() );