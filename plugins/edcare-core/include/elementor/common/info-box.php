<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Info_Box extends Widget_Base {

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
		return 'edcare_info_box';
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
		return __( 'Info Box', 'edcare-core' );
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

        $this->start_controls_section(
            '_content_design_layout',
            [
                'label' => esc_html__( 'Design Layout',  'text-domain'  ),
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
                    'layout-3' => esc_html__('Layout 3', 'edcare-core'),
                    'layout-4' => esc_html__('Layout 4', 'edcare-core'),
                    'layout-5' => esc_html__('Layout 5', 'edcare-core'),
                    'layout-6' => esc_html__('Layout 6', 'edcare-core'),
                    'layout-7' => esc_html__('Layout 7', 'edcare-core'),
                ],
                'default' => 'layout-1',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_info_box',
            [
                'label' => esc_html__( 'Info Box', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'icon' => esc_html__('Icon', 'edcare-core'),
                    'image' => esc_html__('Image', 'edcare-core'),
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
            'info_box_icon',
            [
                'label' => esc_html__('Icon', 'edcare-core'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'info_box_image_icon',
            [
                'label'     => esc_html__( 'Choose Image', 'edcare-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type'   => ['image'],
                ],
            ]
        );

        $this->add_control(
            'info_no',
            [
                'label' => esc_html__( 'No.', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '01', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'info_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'UI/UX <br>Design Service', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'info_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Free & Premium online courses from the world’s Join 17 million learners', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7'],
                ],
            ]
        );

        $this->add_control(
            'wow_delay',
            [
                'label' => esc_html__( 'Animation Delay', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'default' => '100',
                'options' => [
                    '100' => esc_html__( '100ms', 'text-domain' ),
                    '200' => esc_html__( '200ms', 'text-domain' ),
                    '300' => esc_html__( '300ms', 'text-domain' ),
                    '400' => esc_html__( '400ms', 'text-domain' ),
                    '500' => esc_html__( '500ms', 'text-domain' ),
                    '600' => esc_html__( '600ms', 'text-domain' ),
                    '700' => esc_html__( '700ms', 'text-domain' ),
                    '800' => esc_html__( '800ms', 'text-domain' ),
                    '900' => esc_html__( '900ms', 'text-domain' ),
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3', 'layout-4' ],
                ],
            ]
        );
        
        $this->add_control(
            'info_button_text',
            [
                'label' => esc_html__('Button Text', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Learn More', 'edcare-core'),
                'label_block' => true,
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );
        $this->add_control(
            'info_button_link_type',
            [
                'label' => esc_html__('Button Link Type', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'info_button_link',
            [
                'label' => esc_html__('Button link', 'edcare-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'edcare-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'info_button_link_type' => '1',
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'info_button_page_link',
            [
                'label' => esc_html__('Select Button Page', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => edcare_get_all_pages(),
                'condition' => [
                    'info_button_link_type' => '2',
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ]
            ]
        );

        $this->add_control(
            'info_button_icon',
            [
                'label' => esc_html__('Icon', 'edcare-core'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-long-arrow-alt-right',
                    'library' => 'solid',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ]
            ]
        );

        $this->add_control(
            'info_button_icon_position',
            [
                'label'   => esc_html__( 'Icon Position', 'edcare-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => esc_html__( 'Before', 'edcare-core' ),
                    'after'  => esc_html__( 'After', 'edcare-core' ),
                ],
                'condition' => [
                    'info_button_icon[value]!' 	=> '',
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'info_button_icon_spacing',
            [
                'label'     => esc_html__( 'Icon Spacing', 'edcare-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button.left i' => 'margin-right: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .edcare-el-button.right i' => 'margin-left: {{SIZE}}{{UNIT}}!important;',
                ],
                'condition' => [
                    'info_button_icon[value]!' 	=> '',
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'info_button_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'edcare-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'info_button_icon[value]!' 	=> '',
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_design_layout',
            [
                'label' => __( 'Design Layout', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'design_layout_padding',
            [
                'label' => __( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .about-feature-card .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_layout_margin',
            [
                'label' => __( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .about-feature-card .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_layout_border_radius',
            [
                'label' => __( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .about-feature-card .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .about-feature-card .content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'design_layout_background_hover',
            [
                'label' => esc_html__( 'Background (Hover)', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat-item .shape' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-6',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_layout_border',
                'selector' => '{{WRAPPER}} .edcare-el-section, .about-feature-card .content',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_info',
            [
                'label' => __( 'Info List', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_info_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'info_list_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'edcare-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-2 .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .feature-card .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-3 .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .about-feature-card .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cat-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service-promo-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ] 
        );

        $this->add_control(
            'info_list_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-item .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .promo-item-2 .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .feature-card .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .promo-item-3 .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .about-feature-card .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .cat-item .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .service-promo-item .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'info_list_icon_color_hover',
            [
                'label' => esc_html__( 'Color (Hover)', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-feature-card:hover .icon' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-5',
                ],
            ]
        );

        $this->add_control(
            'info_list_icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-item .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .promo-item-2 .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .feature-card .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .promo-item-3 .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .about-feature-card .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .cat-item .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .service-promo-item .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'info_list_icon_background_hover',
            [
                'label' => esc_html__( 'Background (Hover)', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-feature-card:hover .icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-5',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_list_icon_border',
                'selector' => '{{WRAPPER}} .feature-item .icon,
                                            .promo-item-2 .icon,
                                            .feature-card .icon,
                                            .promo-item-3 .icon,
                                            .about-feature-card .icon, 
                                            .cat-item .icon,
                                            .service-promo-item .icon',
            ]
        );

        $this->add_responsive_control(
            'info_list_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-2 .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .feature-card .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-3 .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .about-feature-card .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .cat-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .service-promo-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_list_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-2 .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .feature-card .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-3 .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .about-feature-card .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .cat-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .service-promo-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_info_no',
            [
                'label' => esc_html__( 'No.', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'info_no_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item-2 .number' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'info_no_color_hover',
            [
                'label' => esc_html__( 'Color (Hover)', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item-2:hover .number' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_no_typography',
                'selector' => '{{WRAPPER}} .promo-item-2 .number',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_info_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'info_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-2 .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .feature-card .content h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-3 .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .about-feature-card .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cat-item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service-promo-item .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'info_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-item .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .promo-item-2 .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .feature-card .content h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .promo-item-3 .content .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .about-feature-card .content .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .cat-item .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .service-promo-item .content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_title_typography',
                'selector' => '{{WRAPPER}} .feature-item .title,
                                            .promo-item-2 .title,
                                            .feature-card .content h3,
                                            .promo-item-3 .content .title,
                                            .about-feature-card .content .title,
                                            .cat-item .title,
                                            .service-promo-item .content .title',
            ]
        );

        $this->add_control(
            '_heading_style_info_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'info_description_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .promo-item p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .content-item .content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .promo-item-3 .content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .about-feature-card .content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cat-item span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service-promo-item .content span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7' ],
                ],
            ]
        );

        $this->add_control(
            'info_description_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content-item .content p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .promo-item-3 .content p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .about-feature-card .content p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .cat-item span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .service-promo-item .content span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7' ],
                ],
            ]
        );

        $this->add_control(
            'info_description_color_hover',
            [
                'label' => esc_html__( 'Color (Hover)', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-item:hover .content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_description_typography',
                'selector' => '{{WRAPPER}} .promo-item p,
                                            .content-item .content p,
                                            .promo-item-3 .content p,
                                            .about-feature-card .content p,
                                            .cat-item span,
                                            .service-promo-item .content span',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7' ],
                ],
            ]
        );

        $this->add_control(
            '_heading_style_link',
            [
                'label' => esc_html__( 'Link', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->start_controls_tabs( 'link_tabs' );
        
        $this->start_controls_tab(
            'link_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );
        
        $this->add_control(
            'link_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );
        
        $this->add_control(
            'link_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'link_border',
                'selector' => '{{WRAPPER}} .edcare-el-button',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            '_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );
        
        $this->add_control(
            'link_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );
        
        $this->add_control(
            'link_background_hover',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .feature-item .feature-btn:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .feature-card .content .ed-primary-btn:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'link_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'link_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'link_margin',
            [
                'label' => esc_html__( 'Margin', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
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
        
        if ( !empty($settings['info_box_image_icon']['url']) ) {
            $info_box_image_icon = !empty($settings['info_box_image_icon']['id']) ? wp_get_attachment_image_url( $settings['info_box_image_icon']['id'], 'full') : $settings['info_box_image_icon']['url'];
            $info_box_image_icon_alt = get_post_meta($settings["info_box_image_icon"]["id"], "_wp_attachment_image_alt", true);
        }
        
        ?>

        <?php if ( $settings['design_style']  == 'layout-1' ) : 
            if ('2' == $settings['info_button_link_type']) {
                $this->add_render_attribute('info-button-arg', 'href', get_permalink($settings['info_button_page_link']));
                $this->add_render_attribute('info-button-arg', 'target', '_self');
                $this->add_render_attribute('info-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('info-button-arg', 'class', 'edcare-el-button feature-btn' );
            } else {
                if ( ! empty( $settings['info_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'info-button-arg', $settings['info_button_link'] );
                    $this->add_render_attribute('info-button-arg', 'class', 'edcare-el-button feature-btn' );
                }
            }
            ?>

            <div class="edcare-el-section feature-item text-center wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                <?php if ( 'icon' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <?php edcare_render_icon($settings, 'info_box_icon'); ?>
                    </div>
                <?php elseif ( 'image' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <img src="<?php echo esc_url( $info_box_image_icon ); ?>" alt="<?php echo esc_attr( $info_box_image_icon_alt ); ?>">
                    </div>
                <?php endif;?>
                <?php if ( !empty( $settings['info_title'] ) ) : ?>
                    <h3 class="title">
                        <?php print edcare_kses($settings['info_title']); ?>
                    </h3>
                <?php endif; ?>
                <a <?php echo $this->get_render_attribute_string( 'info-button-arg' ); ?>>
                    <?php edcare_render_icon($settings, 'info_button_icon' ); ?>
                </a>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

            <div class="edcare-el-section promo-item-2 wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                <?php if ( !empty( $settings['info_no'] ) ) : ?>
                    <span class="number">
                        <?php print edcare_kses($settings['info_no']); ?>
                    </span>
                <?php endif; ?>
                <?php if ( 'icon' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <?php edcare_render_icon($settings, 'info_box_icon'); ?>
                    </div>
                <?php elseif ( 'image' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <img src="<?php echo esc_url( $info_box_image_icon ); ?>" alt="<?php echo esc_attr( $info_box_image_icon_alt ); ?>">
                    </div>
                <?php endif;?>
                <?php if ( !empty( $settings['info_title'] ) ) : ?>
                    <h3 class="title">
                        <?php print edcare_kses($settings['info_title']); ?>
                    </h3>
                <?php endif; ?>
                <?php if ( !empty( $settings['info_description'] ) ) : ?>
                    <p>
                        <?php print edcare_kses($settings['info_description']); ?>
                    </p>
                <?php endif; ?>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-3' ) : 
            if ('2' == $settings['info_button_link_type']) {
                $this->add_render_attribute('info-button-arg', 'href', get_permalink($settings['info_button_page_link']));
                $this->add_render_attribute('info-button-arg', 'target', '_self');
                $this->add_render_attribute('info-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('info-button-arg', 'class', 'edcare-el-button ed-primary-btn' );
            } else {
                if ( ! empty( $settings['info_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'info-button-arg', $settings['info_button_link'] );
                    $this->add_render_attribute('info-button-arg', 'class', 'edcare-el-button ed-primary-btn' );
                }
            }
            ?>

            <div class="edcare-el-section feature-card text-center wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                <?php if ( 'icon' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <?php edcare_render_icon($settings, 'info_box_icon'); ?>
                    </div>
                <?php elseif ( 'image' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <img src="<?php echo esc_url( $info_box_image_icon ); ?>" alt="<?php echo esc_attr( $info_box_image_icon_alt ); ?>">
                    </div>
                <?php endif;?>
                <div class="content">
                    <?php if ( !empty( $settings['info_title'] ) ) : ?>
                        <h3 class="title">
                            <?php print edcare_kses($settings['info_title']); ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ( !empty( $settings['info_description'] ) ) : ?>
                        <p>
                            <?php print edcare_kses($settings['info_description']); ?>
                        </p>
                    <?php endif; ?>
                    <?php
                        $info_button_icon = !empty($settings['info_button_icon']['value']) ? '<i class="' . esc_attr($settings['info_button_icon']['value']) . '"></i>' : '';
                        $info_button_text = edcare_kses($settings['info_button_text']);

                        // Start generating the anchor tag correctly
                        $attributes = $this->get_render_attribute_string('info-button-arg');
                        $info_button_class = 'edcare-el-button ' . ($settings['info_button_icon_position'] === 'after' ? 'right' : 'left') . ' feature-btn';

                        echo '<a ' . $attributes . ' class="' . esc_attr($info_button_class) . '">' . $info_button_text . $info_button_icon . '</a>';
                    ?>
                </div>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-4' ) : 
            if ('2' == $settings['info_button_link_type']) {
                $this->add_render_attribute('info-button-arg', 'href', get_permalink($settings['info_button_page_link']));
                $this->add_render_attribute('info-button-arg', 'target', '_self');
                $this->add_render_attribute('info-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('info-button-arg', 'class', 'edcare-el-button ed-primary-btn' );
            } else {
                if ( ! empty( $settings['info_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'info-button-arg', $settings['info_button_link'] );
                    $this->add_render_attribute('info-button-arg', 'class', 'edcare-el-button ed-primary-btn' );
                }
            }
            ?>

            <div class="edcare-el-section promo-item-3 wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                <?php if ( 'icon' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <?php edcare_render_icon($settings, 'info_box_icon'); ?>
                    </div>
                <?php elseif ( 'image' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <img src="<?php echo esc_url( $info_box_image_icon ); ?>" alt="<?php echo esc_attr( $info_box_image_icon_alt ); ?>">
                    </div>
                <?php endif;?>
                <div class="content white-content">
                    <?php if ( !empty( $settings['info_title'] ) ) : ?>
                        <h3 class="title">
                            <?php print edcare_kses($settings['info_title']); ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ( !empty( $settings['info_description'] ) ) : ?>
                        <p>
                            <?php print edcare_kses($settings['info_description']); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-5' ) : ?>

            <div class="about-feature-card">
                <?php if ( 'icon' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <?php edcare_render_icon($settings, 'info_box_icon'); ?>
                    </div>
                <?php elseif ( 'image' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <img src="<?php echo esc_url( $info_box_image_icon ); ?>" alt="<?php echo esc_attr( $info_box_image_icon_alt ); ?>">
                    </div>
                <?php endif;?>
                <div class="content">
                    <?php if ( !empty( $settings['info_title'] ) ) : ?>
                        <h3 class="title">
                            <?php print edcare_kses($settings['info_title']); ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ( !empty( $settings['info_description'] ) ) : ?>
                        <p>
                            <?php print edcare_kses($settings['info_description']); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-6' ) : ?>

            <div class="edcare-el-section cat-item text-center">
                <div class="shape"></div>
                <?php if ( 'icon' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <?php edcare_render_icon($settings, 'info_box_icon'); ?>
                    </div>
                <?php elseif ( 'image' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <img src="<?php echo esc_url( $info_box_image_icon ); ?>" alt="<?php echo esc_attr( $info_box_image_icon_alt ); ?>">
                    </div>
                <?php endif;?>
                <?php if ( !empty( $settings['info_title'] ) ) : ?>
                    <h3 class="title">
                        <?php print edcare_kses($settings['info_title']); ?>
                    </h3>
                <?php endif; ?>
                <?php if ( !empty( $settings['info_description'] ) ) : ?>
                    <span>
                        <?php print edcare_kses($settings['info_description']); ?>
                    </span>
                <?php endif; ?>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-7' ) : ?>

            <div class="edcare-el-section service-promo-item">
                <?php if ( 'icon' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <?php edcare_render_icon($settings, 'info_box_icon'); ?>
                    </div>
                <?php elseif ( 'image' === $settings['icon_type'] ) : ?>
                    <div class="icon">
                        <img src="<?php echo esc_url( $info_box_image_icon ); ?>" alt="<?php echo esc_attr( $info_box_image_icon_alt ); ?>">
                    </div>
                <?php endif;?>
                <div class="content">
                    <?php if ( !empty( $settings['info_title'] ) ) : ?>
                        <h4 class="title">
                            <?php print edcare_kses($settings['info_title']); ?>
                        </h4>
                    <?php endif; ?>
                    <?php if ( !empty( $settings['info_description'] ) ) : ?>
                        <span>
                            <?php print edcare_kses($settings['info_description']); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

        <?php endif;
	}

}

$widgets_manager->register( new EdCare_info_box() );