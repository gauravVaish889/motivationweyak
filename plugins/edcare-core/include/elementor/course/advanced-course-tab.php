<?php
namespace EdCareCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Advanced_Course_Tab extends Widget_Base {

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
        return 'edcare_advanced_course_tab';
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
        return __( 'Advanced Course Tab', 'edcare-core' );
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   
    protected function register_controls_section() {

        $this->start_controls_section(
            '_content_design_layout',
            [
                'label' => esc_html__( 'Design Layout',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'design_style',
            [
                'label' => esc_html__( 'Select Layout', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'edcare-core'),
                    'layout-2' => esc_html__('Layout 2', 'edcare-core'),
                    'layout-3' => esc_html__('Layout 3', 'edcare-core'),
                    'layout-4' => esc_html__('Layout 4', 'edcare-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => esc_html__( 'Shape ON/OFF', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
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
                'default' => __( 'Top Class Courses', 'edcare-core' ),
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
                'default' => __( 'Explore Featured Courses', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'section_heading_switch' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_course_tab',
            [
                'label' => esc_html__( 'Course Tab', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_active',
            [
                'label' => esc_html__( 'Active This', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edcare-core' ),
                'label_off' => esc_html__( 'No', 'edcare-core' ),
                'return_value' => 'active',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'tab_title', [
                'label' => esc_html__('Tab Title', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('Tab 1', 'edcare-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __( 'Section Template', 'seoq-core' ),
                'placeholder' => __( 'Select a section template for as tab content', 'seoq-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tab_list',
            [
                'label' => esc_html__('Advanced Tab - List', 'edcare-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_active' => 'active',
                        'tab_title' => esc_html__( 'All Categories', 'edcare-core' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Business', 'edcare-core' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Development', 'edcare-core' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Marketing', 'edcare-core' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Finance', 'edcare-core' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Gaming', 'edcare-core' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Design', 'edcare-core' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Data Science', 'edcare-core' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );
        
        $this->end_controls_section();  
    }

    protected function style_tab_content(){

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
            '_style_course_tab',
            [
                'label' => esc_html__( 'Course Tab',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'course_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-nav' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_typography',
                'selector' => '{{WRAPPER}} .course-nav .nav-item .nav-link',
            ]
        );

        $this->add_responsive_control(
            'course_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-nav .nav-item .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'course_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-nav .nav-item .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->start_controls_tabs( 'course_tabs' );
        
        $this->start_controls_tab(
            'course_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'course_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-nav .nav-item .nav-link' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-nav .nav-item .nav-link' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'course_border',
                'selector' => '{{WRAPPER}} .course-nav .nav-item .nav-link',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'course_active_tab',
            [
                'label' => esc_html__( 'Active', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'course_color_active',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-nav .nav-item .nav-link.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_background_active',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-nav .nav-item .nav-link.active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'course_border_active',
                'selector' => '{{WRAPPER}} .course-nav .nav-item .nav-link.active',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        $this->start_controls_section(
			'_style_toggle',
			[
				'label' => esc_html__( 'Toggle', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
			]
		);

        $this->add_control(
            '_heading_style_tab_toggle',
            [
                'label' => esc_html__( 'Toggle', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'tab_toggle_background_active',
            [
                'label' => esc_html__('Background', 'edcare-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course__tab .nav .nav-item .nav-link::before' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_width_active',
            [
                'label' => esc_html__( 'Width', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .course__tab .nav .nav-item .nav-link::before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_height_active',
            [
                'label' => esc_html__( 'Height', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .course__tab .nav .nav-item .nav-link::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_border_radius_active',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course__tab .nav .nav-item .nav-link::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_tab_toggle_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tab_toggle_background',
            [
                'label' => esc_html__('Background', 'edcare-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course__tab .nav .nav-item .nav-link::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_width',
            [
                'label' => esc_html__( 'Width', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 54,
                ],
                'selectors' => [
                    '{{WRAPPER}} .course__tab .nav .nav-item .nav-link::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_height',
            [
                'label' => esc_html__( 'Height', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 22,
                ],
                'selectors' => [
                    '{{WRAPPER}} .course__tab .nav .nav-item .nav-link::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course__tab .nav .nav-item .nav-link::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        ?>

        <?php if ( $settings['design_style']  == 'layout-1' ): ?>

            <section class="edcare-el-section feature-course pt-120 pb-120">
                <div class="container">
                    <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                        <div class="edcare-el-section-subheading section-heading text-center">
                            <h4 class="sub-heading wow fade-in-bottom" data-wow-delay="200ms">
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
                    <ul class="course-nav nav nav-tabs mb-40" id="myTab" role="tablist">
                        <?php foreach($settings['tab_list'] as $key => $item) : 
                            $active = $item['tab_active'] ? 'active' : NULL ;    
                            $aria = $item['tab_active'] ? 'false' : 'true' ;    
                        ?>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link <?php echo esc_attr($active); ?>"
                                id="home-<?php echo esc_attr($key+1); ?>-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#home-<?php echo esc_attr($key+1); ?>"
                                type="button"
                                role="tab"
                                aria-controls="home-<?php echo esc_attr($key+1); ?>"
                                aria-selected="<?php echo esc_attr($aria); ?>">
                                <?php echo edcare_kses($item['tab_title']); ?>
                            </button>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="course-tab-content tab-content" id="myTabContent">
                        <?php foreach($settings['tab_list'] as $key => $item) : 
                            $active_show = $item['tab_active'] ? 'active show' : NULL ;  
                        ?>
                        <div 
                            class="tab-pane fade show <?php echo esc_attr($active_show); ?>"
                            id="home-<?php echo esc_attr($key+1);  ?>"
                            role="tabpanel"
                            aria-labelledby="home-<?php echo esc_attr($key+1);  ?>-tab">
                            <div class="row gy-4 justify-content-center">
                                <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        
        <?php elseif ( $settings['design_style']  == 'layout-2' ): ?>

            <section class="edcare-el-section feature-course feature-course-2 pt-120 pb-120">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/feature-shape-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/feature-shape-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                        <div class="section-heading text-center white-content">
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
                    <ul class="course-nav nav nav-tabs mb-40" id="myTab" role="tablist">
                        <?php foreach($settings['tab_list'] as $key => $item) : 
                                $active = $item['tab_active'] ? 'active' : NULL ;    
                                $aria = $item['tab_active'] ? 'false' : 'true' ;    
                            ?>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link <?php echo esc_attr($active); ?>"
                                    id="home-<?php echo esc_attr($key+1); ?>-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#home-<?php echo esc_attr($key+1); ?>"
                                    type="button"
                                    role="tab"
                                    aria-controls="home-<?php echo esc_attr($key+1); ?>"
                                    aria-selected="<?php echo esc_attr($aria); ?>">
                                    <?php echo edcare_kses($item['tab_title']); ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="course-tab-content tab-content" id="myTabContent">
                        <?php foreach($settings['tab_list'] as $key => $item) : 
                                $active_show = $item['tab_active'] ? 'active show' : NULL ;  
                            ?>
                            <div 
                                class="tab-pane fade show <?php echo esc_attr($active_show); ?>"
                                id="home-<?php echo esc_attr($key+1);  ?>"
                                role="tabpanel"
                                aria-labelledby="home-<?php echo esc_attr($key+1);  ?>-tab">
                                <div class="row gy-4 justify-content-center">
                                    <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        
        <?php elseif ( $settings['design_style']  == 'layout-3' ): ?>

            <section class="edcare-el-section feature-course pt-120 pb-120">
                <div class="container">
                    <div class="course-top heading-space align-items-end">
                        <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                            <div class="section-heading mb-0">
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
                        <ul class="course-nav nav nav-tabs mb-0" id="myTab" role="tablist">
                            <?php foreach($settings['tab_list'] as $key => $item) : 
                                    $active = $item['tab_active'] ? 'active' : NULL ;    
                                    $aria = $item['tab_active'] ? 'false' : 'true' ;    
                                ?>
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link <?php echo esc_attr($active); ?>"
                                        id="home-<?php echo esc_attr($key+1); ?>-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#home-<?php echo esc_attr($key+1); ?>"
                                        type="button"
                                        role="tab"
                                        aria-controls="home-<?php echo esc_attr($key+1); ?>"
                                        aria-selected="<?php echo esc_attr($aria); ?>">
                                        <?php echo edcare_kses($item['tab_title']); ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                            
                        </ul>
                    </div>
                    <div class="course-tab-content tab-content" id="myTabContent">
                        <?php foreach($settings['tab_list'] as $key => $item) : 
                                $active_show = $item['tab_active'] ? 'active show' : NULL ;  
                            ?>
                            <div 
                                class="tab-pane fade show <?php echo esc_attr($active_show); ?>"
                                id="home-<?php echo esc_attr($key+1);  ?>"
                                role="tabpanel"
                                aria-labelledby="home-<?php echo esc_attr($key+1);  ?>-tab">
                                <div class="row gy-4 justify-content-center">
                                    <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        
        <?php elseif ( $settings['design_style']  == 'layout-4' ): ?>

            <section class="edcare-el-section feature-course pt-120 pb-120">
                <div class="container">
                    <div class="feature-course-top heading-space">
                        <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                            <div class="section-heading mb-0">
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
                        <ul class="course-nav nav nav-tabs mb-40" id="myTab-2" role="tablist">
                            <?php foreach($settings['tab_list'] as $key => $item) : 
                                $active = $item['tab_active'] ? 'active' : NULL ;    
                                $aria = $item['tab_active'] ? 'false' : 'true' ;    
                            ?>
                            <li class="nav-item" role="presentation">
                                <button 
                                    class="nav-link <?php echo esc_attr($active); ?>"
                                    id="home-<?php echo esc_attr($key+1); ?>-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#home-<?php echo esc_attr($key+1); ?>"
                                    type="button"
                                    role="tab"
                                    aria-controls="home-<?php echo esc_attr($key+1); ?>"
                                    aria-selected="<?php echo esc_attr($aria); ?>">
                                    <?php echo edcare_kses($item['tab_title']); ?>
                                </button>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="course-tab-content tab-content" id="myTabContent-2">
                        <?php foreach($settings['tab_list'] as $key => $item) : 
                            $active_show = $item['tab_active'] ? 'active show' : NULL ;  
                        ?>
                        <div 
                            class="tab-pane fade <?php echo esc_attr($active_show); ?>"
                            id="home-<?php echo esc_attr($key+1); ?>"
                            role="tabpanel"
                            aria-labelledby="home-<?php echo esc_attr($key+1); ?>-tab">
                            <div class="row gy-4 justify-content-center">
                                <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        
        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new EdCare_Advanced_Course_Tab() ); 