<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Cta extends Widget_Base {

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
		return 'edcare_cta';
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
		return __( 'CTA', 'edcare-core' );
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
                'label' => esc_html__('Design Layout', 'edcare-core'),
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
                ],
                'default' => 'layout-1',
            ]
        );  

        $this->add_control(
            'shape_switch',
            [
                'label' => esc_html__( 'Shape ON/OFF', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edcare-core' ),
                'label_off' => esc_html__( 'No', 'edcare-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_title',
            [
                'label' => esc_html__( 'Title & Content',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_image',
            [
                'label' => esc_html__( 'Image One', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'section_subheading_icon_type',
            [
                'label' => esc_html__( 'Image Type', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__( 'Icon', 'edcare-core' ),
                    'image' => esc_html__( 'Image', 'edcare-core' ),
                ],
            ]
        );
        
        $this->add_control(
            'section_subheading_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'section_subheading_icon_type' => 'image',
                ],
            ]
        );
        
        $this->add_control(
            'section_subheading_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'section_subheading_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'section_subheading',
            [
                'label' => esc_html__( 'Subheading', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Study With Us', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Lets discuss how can we help make <br> your Business better', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Description', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem <br> Ipsum has been the industry standard dummy', 'edcare-core'),
                'label_block' => true,
                'condition' => [
                    'design_style' => [ 'layout-1' ],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_button',
            [
                'label' => esc_html__( 'Button', 'text-domain' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_button_text',
            [
                'label' => esc_html__('Button Text', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Become a Student', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_button_link_type',
            [
                'label' => esc_html__('Button Link Type', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_button_link',
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
                    'section_button_link_type' => '1',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'section_button_page_link',
            [
                'label' => esc_html__('Select Button Page', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => edcare_get_all_pages(),
                'condition' => [
                    'section_button_link_type' => '2',
                ]
            ]
        );

        $this->add_control(
            'section_button_icon',
            [
                'label' => esc_html__('Icon', 'edcare-core'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-long-arrow-alt-right',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'section_button_icon_position',
            [
                'label'   => esc_html__( 'Icon Position', 'edcare-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => esc_html__( 'Before', 'edcare-core' ),
                    'after'  => esc_html__( 'After', 'edcare-core' ),
                ],
                'condition' => [
                    'section_button_icon[value]!' 	=> '',
                ],
            ]
        );

        $this->add_control(
            'section_button_icon_spacing',
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
                    'section_button_icon[value]!' 	=> '',
                ],
            ]
        );

        $this->add_control(
            'section_button_icon_size',
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
                    'section_button_icon[value]!' 	=> '',
                ],
            ]
        );

        $this->add_control(
            'section_secondary_button_switch',
            [
                'label' => esc_html__( 'Secondary Button ON/OFF', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            '_heading_content_section_secondary_button',
            [
                'label' => esc_html__( 'Secondary Button', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'section_secondary_button_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'section_secondary_button_text',
            [
                'label' => esc_html__('Button Text', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Become a Student', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'section_secondary_button_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'section_secondary_button_link_type',
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
                    'section_secondary_button_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'section_secondary_button_link',
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
                    'section_secondary_button_link_type' => '1',
                    'section_secondary_button_switch' => 'yes',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'section_secondary_button_page_link',
            [
                'label' => esc_html__('Select Button Page', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => edcare_get_all_pages(),
                'condition' => [
                    'section_secondary_button_link_type' => '2',
                    'section_secondary_button_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'section_secondary_button_icon',
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
                    'section_secondary_button_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'section_secondary_button_icon_position',
            [
                'label'   => esc_html__( 'Icon Position', 'edcare-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => esc_html__( 'Before', 'edcare-core' ),
                    'after'  => esc_html__( 'After', 'edcare-core' ),
                ],
                'condition' => [
                    'section_secondary_button_icon[value]!' 	=> '',
                ],
            ]
        );

        $this->add_control(
            'section_secondary_button_icon_spacing',
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
                    'section_secondary_button_icon[value]!' 	=> '',
                ],
            ]
        );

        $this->add_control(
            'section_secondary_button_icon_size',
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
                    'section_secondary_button_icon[value]!' 	=> '',
                ],
            ]
        );
        
        $this->end_controls_section();

		$this->start_controls_section(
			'_style_design_layout',
			[
				'label' => __( 'Design Layout', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'design_layout_margin',
            [
                'label' => esc_html__( 'Margin', 'text-domain' ),
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
                'label' => esc_html__( 'Padding', 'text-domain' ),
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
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'design_layout_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .cta-section .cta-bg-img:before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_section_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_responsive_control(
            'section_title_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'section_title_color',
            [
                'label' => __( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} .edcare-el-section-title',
            ]
        );

        $this->add_control(
            '_heading_style_section_subheading_icon',
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
            'section_subheading_icon_font_size',
            [
                'label' => esc_html__( 'Font Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading .heading-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'section_subheading_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading .heading-icon' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'section_subheading_icon_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading .heading-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_subheading_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading .heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_subheading_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading .heading-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            '_heading_style_section_subheading_text',
            [
                'label' => esc_html__( 'Subheading Text', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );
        
        $this->add_responsive_control(
            'section_subheading_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-subheading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );
        
        $this->add_control(
            'section_subheading_color',
            [
                'label' => __( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-subheading' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'section_subheading_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-subheading' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'section_subheading_border',
                'selector' => '{{WRAPPER}} .edcare-el-section-subheading',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_subheading_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-subheading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_subheading_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-subheading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_subheading_typography',
                'selector' => '{{WRAPPER}} .edcare-el-section-subheading',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            '_heading_style_section_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'text-domain' ),
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );
        
        $this->add_responsive_control(
            'section_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );
        
        $this->add_control(
            'section_description_color',
            [
                'label' => __( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .edcare-el-section-description',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_button',
            [
                'label' => esc_html__( 'Button', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs( 'tabs_style_section_button' );
        
        $this->start_controls_tab(
            'section_button_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'section_button_color',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'section_button_background',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'section_button_border',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'section_button_box_shadow',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'section_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'section_button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'section_button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:after, .edcare-el-button:before' => 'background-color: {{VALUE}}!important',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'section_button_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'section_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_control(
            'section_button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'text-domain' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .edcare-el-button:before' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'text-domain' ),
                'name'     => 'section_button_typography',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->add_control(
            'section_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'section_button_margin',
            [
                'label'      => esc_html__( 'Margin', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_section_secondary_button',
            [
                'label' => esc_html__( 'Secondary Button', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'tabs_style_section_secondary_button' );
        
        $this->start_controls_tab(
            'section_secondary_button_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'section_secondary_button_color',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'section_secondary_button_background',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'section_secondary_button_border',
                'selector' => '{{WRAPPER}} .edcare-el-button-two',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'section_secondary_button_box_shadow',
                'selector' => '{{WRAPPER}} .edcare-el-button-two',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'section_secondary_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'section_secondary_button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'section_secondary_button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two:after, .edcare-el-button-two:before' => 'background-color: {{VALUE}}!important',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'section_secondary_button_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button-two:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'section_secondary_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button-two:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_control(
            'section_secondary_button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'text-domain' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .edcare-el-button-two:before' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'text-domain' ),
                'name'     => 'section_secondary_button_typography',
                'selector' => '{{WRAPPER}} .edcare-el-button-two',
            ]
        );
        
        $this->add_control(
            'section_secondary_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'section_secondary_button_margin',
            [
                'label'      => esc_html__( 'Margin', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		?>

        <?php if ( $settings['design_style']  == 'layout-1' ) : 
            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn cta-btn');
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn cta-btn');
                }
            }

            if ('2' == $settings['section_secondary_button_link_type']) {
                $this->add_render_attribute('section-secondary-button-arg', 'href', get_permalink($settings['section_secondary_button_page_link']));
                $this->add_render_attribute('section-secondary-button-arg', 'target', '_self');
                $this->add_render_attribute('section-secondary-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-secondary-button-arg', 'class', 'edcare-el-button-two ed-primary-btn cta-btn-2' );
            } else {
                if ( ! empty( $settings['section_secondary_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-secondary-button-arg', $settings['section_secondary_button_link'] );
                    $this->add_render_attribute('section-secondary-button-arg', 'class', 'edcare-el-button-two ed-primary-btn cta-btn-2' );
                }
            }
            
            ?>

            <section class="edcare-el-section cta-section pt-140 pb-140">
                <?php if ( !empty( $section_image ) ) : ?>
                    <div class="cta-bg-img">
                        <img src="<?php print esc_url($section_image); ?>" alt="<?php print esc_attr($section_image_alt); ?>">
                    </div>
                <?php endif; ?>
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/dot-shape.png' ); ?>" alt="<?php print esc_attr( 'cta', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/cta-shape-2.png' ); ?>" alt="<?php print esc_attr( 'cta', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="cta-content">
                        <?php if ( !empty( $settings['section_title'] ) ) : ?>
                            <h2 class="edcare-el-section-title title wow fade-in-bottom" data-wow-delay="200ms">
                                <?php print edcare_kses($settings['section_title']); ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ( !empty( $settings['section_description'] ) ) : ?>
                            <p class="edcare-el-section-description wow fade-in-bottom" data-wow-delay="400ms">
                                <?php print edcare_kses($settings['section_description']); ?>
                            </p>
                        <?php endif; ?>
                        <div class="cta-btn-wrap wow fade-in-bottom" data-wow-delay="500ms">
                            <?php
                                $section_button_icon = !empty($settings['section_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_button_icon']['value']) . '"></i>' : '';
                                $section_button_text = esc_html($settings['section_button_text']);

                                // Start generating the anchor tag correctly
                                $attributes = $this->get_render_attribute_string('section-button-arg');
                                $section_button_class = 'edcare-el-button ' . ($settings['section_button_icon_position'] === 'after' ? 'right' : 'left') . ' rr-btn';

                                echo '<a ' . $attributes . ' class="' . esc_attr($section_button_class) . '">' . $section_button_text . $section_button_icon . '</a>';
                            ?>
                            <?php
                                $section_secondary_button_icon = !empty($settings['section_secondary_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_secondary_button_icon']['value']) . '"></i>' : '';
                                $section_secondary_button_text = esc_html($settings['section_secondary_button_text']);

                                // Start generating the anchor tag correctly
                                $attributes = $this->get_render_attribute_string('section-secondary-button-arg');
                                $section_secondary_button_class = 'edcare-el-button-two ' . ($settings['section_secondary_button_icon_position'] === 'after' ? 'right' : 'left') . ' rr-btn';

                                echo '<a ' . $attributes . ' class="' . esc_attr($section_secondary_button_class) . '">' . $section_secondary_button_text . $section_secondary_button_icon . '</a>';
                            ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : 

            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn cta-btn');
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn cta-btn');
                }
            }

            if ('2' == $settings['section_secondary_button_link_type']) {
                $this->add_render_attribute('section-secondary-button-arg', 'href', get_permalink($settings['section_secondary_button_page_link']));
                $this->add_render_attribute('section-secondary-button-arg', 'target', '_self');
                $this->add_render_attribute('section-secondary-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-secondary-button-arg', 'class', 'edcare-el-button-two ed-primary-btn cta-btn-2' );
            } else {
                if ( ! empty( $settings['section_secondary_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-secondary-button-arg', $settings['section_secondary_button_link'] );
                    $this->add_render_attribute('section-secondary-button-arg', 'class', 'edcare-el-button-two ed-primary-btn cta-btn-2' );
                }
            }
            
            ?>

            <section class="edcare-el-section cta-section-3 pt-120 pb-120" data-background="<?php print esc_url($section_image); ?>">
                <div class="overlay"></div>
                <div class="container">
                    <div class="cta-content cta-content-3 text-center">
                        <div class="section-heading text-center white-content mb-30">
                            <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                                <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                                    <?php if ( $settings['section_subheading_icon_type']  == 'image' ): ?>
                                        <span class="heading-icon">
                                            <img class="img-fluid" src="<?php echo $settings['section_subheading_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['section_subheading_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                        </span>
                                    <?php elseif ( $settings['section_subheading_icon_type']  == 'icon' ): ?>
                                        <span class="heading-icon">
                                            <?php edcare_render_icon($settings, 'section_subheading_icon' ); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php print edcare_kses($settings['section_subheading']); ?>
                                </h4>
                            <?php endif; ?>
                            <?php if ( !empty( $settings['section_title'] ) ) : ?>
                                <h2 class="edcare-el-section-title section-title mt-10 wow fade-in-bottom" data-wow-delay="400ms">
                                    <?php print edcare_kses($settings['section_title']); ?>
                                </h2>
                            <?php endif; ?>
                        </div>
                        <div class="cta-btn-wrap wow fade-in-bottom" data-wow-delay="500ms">
                            <?php
                                $section_button_icon = !empty($settings['section_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_button_icon']['value']) . '"></i>' : '';
                                $section_button_text = esc_html($settings['section_button_text']);

                                // Start generating the anchor tag correctly
                                $attributes = $this->get_render_attribute_string('section-button-arg');
                                $section_button_class = 'edcare-el-button ' . ($settings['section_button_icon_position'] === 'after' ? 'right' : 'left') . ' rr-btn';

                                echo '<a ' . $attributes . ' class="' . esc_attr($section_button_class) . '">' . $section_button_text . $section_button_icon . '</a>';
                            ?>
                            <?php
                                $section_secondary_button_icon = !empty($settings['section_secondary_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_secondary_button_icon']['value']) . '"></i>' : '';
                                $section_secondary_button_text = esc_html($settings['section_secondary_button_text']);

                                // Start generating the anchor tag correctly
                                $attributes = $this->get_render_attribute_string('section-secondary-button-arg');
                                $section_secondary_button_class = 'edcare-el-button-two ' . ($settings['section_secondary_button_icon_position'] === 'after' ? 'right' : 'left') . ' rr-btn';

                                echo '<a ' . $attributes . ' class="' . esc_attr($section_secondary_button_class) . '">' . $section_secondary_button_text . $section_secondary_button_icon . '</a>';
                            ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-3' ) : 

            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn cta-btn');
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn cta-btn');
                }
            }
            
            ?>

            <div class="edcare-el-section popular-item wow fade-in-bottom" data-wow-delay="500ms">
                <div class="men">
                    <img src="<?php print esc_url($section_image); ?>" alt="<?php print esc_attr($section_image_alt); ?>">
                </div>
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/popular-shape-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/popular-shape-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                    <span class="edcare-el-section-subheading">
                        <?php print edcare_kses($settings['section_subheading']); ?>
                    </span>
                <?php endif; ?>
                <?php if ( !empty( $settings['section_title'] ) ) : ?>
                    <h3 class="edcare-el-section-title title">
                        <?php print edcare_kses($settings['section_title']); ?>
                    </h3>
                <?php endif; ?>
                <?php
                    $section_button_icon = !empty($settings['section_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_button_icon']['value']) . '"></i>' : '';
                    $section_button_text = esc_html($settings['section_button_text']);

                    // Start generating the anchor tag correctly
                    $attributes = $this->get_render_attribute_string('section-button-arg');
                    $section_button_class = 'edcare-el-button ' . ($settings['section_button_icon_position'] === 'after' ? 'right' : 'left') . ' ed-primary-btn';

                    echo '<a ' . $attributes . ' class="' . esc_attr($section_button_class) . '">' . $section_button_text . $section_button_icon . '</a>';
                ?>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new EdCare_Cta() );