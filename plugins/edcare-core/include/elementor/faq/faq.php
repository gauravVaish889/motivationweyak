<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Faq extends Widget_Base {

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
		return 'edcare_faq';
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
		return __( 'Faq', 'edcare-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_title',
            [
                'label' => esc_html__( 'Title & Content',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_heading_switch',
            [
                'label' => esc_html__( 'Show Section Heading', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edcare-core' ),
                'label_off' => esc_html__( 'Hide', 'edcare-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
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
                'condition' => [
                    'section_heading_switch' => 'yes',
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
                    'section_heading_switch' => 'yes',
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
                    'section_heading_switch' => 'yes',
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
                'default' => __( 'Most Asked Question', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'section_heading_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Powerful Dashboard And High Performance Framework', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'section_heading_switch' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_image',
            [
                'label' => esc_html__( 'Image',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
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
                    'design_style' => 'layout-2',
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
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_student',
            [
                'label' => esc_html__( 'Student',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'total_student',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Total Students', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'total_student_count',
            [
                'label' => esc_html__( 'Count', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '25+', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'total_student_count_two',
            [
                'label' => esc_html__( 'Count Two', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '<span>200+</span> <br>Instuctor', 'text-domain' ),
                'label_block' => true,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'student_image',
            [
                'label' => esc_html__( 'Choose Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'student_list',
            [
                'label' => esc_html__( 'Student List', 'text-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_faq_list',
            [
                'label' => esc_html__('FAQ List', 'edcare-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'faq_active',
            [
                'label' => esc_html__( 'Open', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edcare-core' ),
                'label_off' => esc_html__( 'Hide', 'edcare-core' ),
                'return_value' => 'show',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'faq_no', [
                'label' => esc_html__( 'No.', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'faq_title', [
                'label' => esc_html__('Title', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'faq_description', [
                'label' => esc_html__('Description', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'wow_delay',
            [
                'label' => esc_html__( 'Animation Delay', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'default' => '400',
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
            ]
        );

        $this->add_control(
            'faq_list',
            [
                'label' => esc_html__( 'Faq List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'faq_active' => 'show',
                        'faq_no' => __( '01.', 'edcare-core' ),
                        'faq_title' => __( 'What courses do you offer?', 'edcare-core' ),
                        'faq_description' => __( 'We offer a wide range of courses in various subjects, including science, technology, engineering, mathematics, humanities, and social sciences. Our courses are designed for different education levels, from primary school to university.', 'edcare-core' ),
                    ],
                    [
                        'faq_no' => __( '02.', 'edcare-core' ),
                        'faq_title' => __( 'How Can Teachers Effectively Manage a Diverse Classroom?', 'edcare-core' ),
                        'faq_description' => __( 'We offer a wide range of courses in various subjects, including science, technology, engineering, mathematics, humanities, and social sciences. Our courses are designed for different education levels, from primary school to university.', 'edcare-core' ),
                    ],
                    [
                        'faq_no' => __( '03.', 'edcare-core' ),
                        'faq_title' => __( 'How Is Special Education Delivered in Inclusive Classrooms?', 'edcare-core' ),
                        'faq_description' => __( 'We offer a wide range of courses in various subjects, including science, technology, engineering, mathematics, humanities, and social sciences. Our courses are designed for different education levels, from primary school to university.', 'edcare-core' ),
                    ],
                ],
                'title_field' => '{{{ faq_title }}}',
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title & Content',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_section_subheading_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
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
            ]
        );
        
        $this->add_control(
            '_heading_style_section_subheading_text',
            [
                'label' => esc_html__( 'Subheading Text', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_responsive_control(
            'section_subheading_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'section_subheading_color',
            [
                'label' => __( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'section_subheading_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'section_subheading_border',
                'selector' => '{{WRAPPER}} .section-heading .sub-heading',
            ]
        );

        $this->add_responsive_control(
            'section_subheading_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .section-heading .sub-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_subheading_typography',
                'selector' => '{{WRAPPER}} .section-heading .sub-heading',
            ]
        );

        $this->add_control(
            '_heading_style_section_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_student',
            [
                'label' => esc_html__( 'Student',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_student_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'student_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'student_title_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'student_title_typography',
                'selector' => '{{WRAPPER}} .faq-img-wrap .faq-text-box h4, .faq-img-wrap-2 .faq-text-box h4',
            ]
        );

        $this->add_control(
            '_heading_style_student_count',
            [
                'label' => esc_html__( 'Count', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'student_count_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box .faq-thumb-list li.number' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li.number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'student_count_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box .faq-thumb-list li.number' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li.number' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'student_count_border',
                'selector' => '{{WRAPPER}} .faq-img-wrap .faq-text-box .faq-thumb-list li, .faq-img-wrap-2 .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'student_count_typography',
                'selector' => '{{WRAPPER}} .faq-img-wrap .faq-text-box .faq-thumb-list li.number, .faq-img-wrap-2 .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li.number',
            ]
        );

        $this->add_control(
            '_heading_style_student_count_two',
            [
                'label' => esc_html__( 'Count Two', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'student_count_two_color',
            [
                'label' => esc_html__( 'Color (Highlight)', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box .faq-thumb-list-wrap p span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'student_count_two_typography',
                'selector' => '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box .faq-thumb-list-wrap p span',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'student_count_two_title_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box .faq-thumb-list-wrap p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'student_count_two_title_typography',
                'selector' => '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box .faq-thumb-list-wrap p',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_student_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'student_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'student_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'student_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .faq-img-wrap-2 .faq-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_faq_list_style',
            [
                'label' => __( 'Faq List', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_faq_no',
            [
                'label' => esc_html__( 'No.', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'faq_no_bottom_spacing',
            [
                'label' => esc_html__( 'Right Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-button span' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'faq_no_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-button span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'faq_no_typography',
                'selector' => '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-button span',
            ]
        );

        $this->add_control(
            '_heading_faq_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'edcare-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'faq_title_typography',
                'selector' => '{{WRAPPER}} .rr__faq .accordion-button, .rr__faq-2 .accordion-button',
            ]
        );

        $this->add_responsive_control(
            'faq_title_padding',
            [
                'label' => __( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rr__faq .accordion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rr__faq-2 .accordion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'faq_title_border_radius',
            [
                'label' => __( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rr__faq .accordion-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rr__faq-2 .accordion-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'faq_list_tabs' );

        $this->start_controls_tab(
            'faq_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'faq_title_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'faq_active_tab',
            [
                'label' => esc_html__( 'Active', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'faq_title_color_active',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-button:not(.collapsed)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'faq_title_border_color',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-button:not(.collapsed)' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            '_heading_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'edcare-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'faq_description_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-body' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'faq_description_background',
            [
                'label' => __( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-body' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'faq_description_typography',
                'selector' => '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-body',
            ]
        );

        $this->add_responsive_control(
            'faq_description_padding',
            [
                'label' => __( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .faq-content .faq-accordion .accordion-item .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

            <section class="edcare-el-section faq-section pt-120 pb-120">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-12">
                            <div class="faq-img-wrap wow fade-in-left" data-wow-delay="400ms">
                                <div class="faq-img">
                                    <img src="<?php print esc_url($section_image); ?>" alt="<?php print esc_attr($section_image_alt); ?>">
                                </div>
                                <div class="faq-text-box">
                                    <?php if ( !empty( $settings['total_student'] ) ) : ?>
                                        <h4 class="student">
                                            <?php print edcare_kses($settings['total_student']); ?>
                                        </h4>
                                    <?php endif; ?>
                                    <ul class="faq-thumb-list">
                                        <?php foreach ($settings['student_list'] as $item) : 
                                            if ( !empty($item['student_image']['url']) ) {
                                                $student_image = !empty($item['student_image']['id']) ? wp_get_attachment_image_url( $item['student_image']['id'], 'full') : $item['student_image']['url'];
                                                $student_image_alt = get_post_meta($item["student_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <li><img src="<?php print esc_url($student_image); ?>" alt="<?php print esc_attr($student_image_alt); ?>"></li>
                                        <?php endforeach; ?>
                                        <?php if ( !empty( $settings['total_student_count'] ) ) : ?>
                                            <li class="number"><?php print edcare_kses($settings['total_student_count']); ?></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="faq-content content-1">
                                <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                                    <div class="section-heading mb-30">
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
                                        <?php if ( !empty( $settings['section_title'] ) ) : ?>
                                            <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                                <?php print edcare_kses($settings['section_title']); ?>
                                            </h2>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="faq-accordion">
                                    <div class="accordion" id="accordionExample">
                                        <?php foreach ($settings['faq_list'] as $id => $item) :
                                            // Active class for the first item
                                            $collapsed_tab = ($id === 0) ? '' : 'collapsed';
                                            $area_expanded = ($id === 0) ? 'true' : 'false';
                                            $active_show_tab = ($id === 0) ? 'show' : '';
                                        ?>
                                        <div class="accordion-item wow fade-in-bottom" data-wow-delay="<?php print esc_attr($item['wow_delay']); ?>">
                                            <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($id); ?>">
                                                <button
                                                    class="accordion-button"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne-<?php echo esc_attr($id); ?>"
                                                    aria-expanded="true"
                                                    aria-controls="collapseOne-<?php echo esc_attr($id); ?>">
                                                    <?php if ( !empty( $item['faq_no'] ) ) : ?>
                                                        <span>
                                                            <?php echo edcare_kses($item['faq_no']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php echo edcare_kses($item['faq_title']); ?>
                                                </button>
                                            </h2>
                                            <div
                                                id="collapseOne-<?php echo esc_attr($id); ?>"
                                                class="accordion-collapse collapse <?php echo esc_attr($item['faq_active']); ?>"
                                                aria-labelledby="headingOne-<?php echo esc_attr($id); ?>"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <?php echo edcare_kses($item['faq_description']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

            <section class="edcare-el-section faq-section pt-120 pb-120 overflow-hidden">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="faq-img-wrap-2 wow fade-in-left" data-wow-delay="400ms">
                                <div class="faq-img-1">
                                    <img src="<?php print esc_url($section_image); ?>" alt="<?php print esc_attr($section_image_alt); ?>">
                                </div>
                                <div class="faq-img-2">
                                    <img src="<?php print esc_url($section_image_two); ?>" alt="<?php print esc_attr($section_image_two_alt); ?>">
                                </div>
                                <div class="faq-img-3">
                                    <img src="<?php print esc_url($section_image_three); ?>" alt="<?php print esc_attr($section_image_three_alt); ?>">
                                </div>
                                <div class="faq-text-box">
                                    <?php if ( !empty( $settings['total_student'] ) ) : ?>
                                        <h4 class="student">
                                            <?php print edcare_kses($settings['total_student']); ?>
                                        </h4>
                                    <?php endif; ?>
                                    <div class="faq-thumb-list-wrap">
                                        <ul class="faq-thumb-list">
                                            <?php foreach ($settings['student_list'] as $item) : 
                                                if ( !empty($item['student_image']['url']) ) {
                                                    $student_image = !empty($item['student_image']['id']) ? wp_get_attachment_image_url( $item['student_image']['id'], 'full') : $item['student_image']['url'];
                                                    $student_image_alt = get_post_meta($item["student_image"]["id"], "_wp_attachment_image_alt", true);
                                                }
                                            ?>
                                                <li><img src="<?php print esc_url($student_image); ?>" alt="<?php print esc_attr($student_image_alt); ?>"></li>
                                            <?php endforeach; ?>
                                            <?php if ( !empty( $settings['total_student_count'] ) ) : ?>
                                                <li class="number"><?php print edcare_kses($settings['total_student_count']); ?></li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php if ( !empty( $settings['total_student_count_two'] ) ) : ?>
                                            <p><?php print edcare_kses($settings['total_student_count_two']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="faq-content">
                                <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                                    <div class="section-heading mb-30">
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
                                        <?php if ( !empty( $settings['section_title'] ) ) : ?>
                                            <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                                <?php print edcare_kses($settings['section_title']); ?>
                                            </h2>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="faq-accordion">
                                    <div class="accordion" id="accordionExample">
                                        <?php foreach ($settings['faq_list'] as $id => $item) :
                                            // Active class for the first item
                                            $collapsed_tab = ($id === 0) ? '' : 'collapsed';
                                            $area_expanded = ($id === 0) ? 'true' : 'false';
                                            $active_show_tab = ($id === 0) ? 'show' : '';

                                        ?>
                                        <div class="accordion-item wow fade-in-bottom" data-wow-delay="<?php print esc_attr($item['wow_delay']); ?>">
                                            <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($id); ?>">
                                                <button
                                                    class="accordion-button"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne-<?php echo esc_attr($id); ?>"
                                                    aria-expanded="true"
                                                    aria-controls="collapseOne-<?php echo esc_attr($id); ?>">
                                                    <?php if ( !empty( $item['faq_no'] ) ) : ?>
                                                        <span>
                                                            <?php echo edcare_kses($item['faq_no']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php echo edcare_kses($item['faq_title']); ?>
                                                </button>
                                            </h2>
                                            <div
                                                id="collapseOne-<?php echo esc_attr($id); ?>"
                                                class="accordion-collapse collapse <?php echo esc_attr($item['faq_active']); ?>"
                                                aria-labelledby="headingOne-<?php echo esc_attr($id); ?>"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <?php echo edcare_kses($item['faq_description']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new EdCare_Faq() );