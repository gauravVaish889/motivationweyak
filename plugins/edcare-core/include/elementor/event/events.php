<?php
namespace EdCareCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

use \Etn\Utils\Helper as Helper;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Event_New_Post extends Widget_Base
{
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
        return 'edcare_event_post';
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
        return __( EDCARE_CORE_THEME_NAME . ' :: Event Post', 'edcare-core');
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

    public function get_event_category()
    {
        return Helper::get_event_category();
    }

    public function get_event_tag()
    {
        return Helper::get_event_tag();
    }


    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }

    protected function register_controls_section()
    {

        $this->start_controls_section(
            '_content_design_layout',
            [
                'label' => esc_html__( 'Design Layout', 'edcare-core' ),
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
                'label' => esc_html__( 'Show Shape', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edcare-core' ),
                'label_off' => esc_html__( 'Hide', 'edcare-core' ),
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
            '_content_event',
            [
                'label' => esc_html__( 'Event Info', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'etn_event_cat',
            [
                'label' => esc_html__('Event Category', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_event_category(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'etn_event_tag',
            [
                'label' => esc_html__('Event Tag', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_event_tag(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'etn_event_count',
            [
                'label' => esc_html__('Event count', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'etn_desc_show',
            [
                'label' => esc_html__('Show Description', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'edcare-core'),
                'label_off' => esc_html__('No', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => "layout-10"
                ],
            ]
        );

        $this->add_control(
            'etn_desc_limit',
            [
                'label' => esc_html__('Description Limit', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'condition' => [
                    'design_style' => "layout-10",
                    'etn_desc_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_with_status',
            [
                'label' => esc_html__('Event status filter By', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('All', 'edcare-core'),
                    'upcoming' => esc_html__('upcoming Event', 'edcare-core'),
                    'expire' => esc_html__('Expire Event', 'edcare-core'),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order Event By', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'ID' => esc_html__('Id', 'edcare-core'),
                    'title' => esc_html__('Title', 'edcare-core'),
                    'post_date' => esc_html__('Post Date', 'edcare-core'),
                    'etn_start_date' => esc_html__('Event Start Date', 'edcare-core'),
                    'etn_end_date' => esc_html__('Event End Date', 'edcare-core'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Event Order', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__('Ascending', 'edcare-core'),
                    'DESC' => esc_html__('Descending', 'edcare-core'),
                ],
            ]
        );
        $this->add_control(
            'show_event_location',
            [
                'label' => esc_html__('Show Event Location', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'edcare-core'),
                'label_off' => esc_html__('No', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_parent_event',
            [
                'label' => esc_html__('Show Recurring Parent Events', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'edcare-core'),
                'label_off' => esc_html__('No', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_child_event',
            [
                'label' => esc_html__('Show Recurring Child Event', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'edcare-core'),
                'label_off' => esc_html__('No', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_event_time',
            [
                'label' => esc_html__('Show Event Time', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'edcare-core'),
                'label_off' => esc_html__('No', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_event_btn',
            [
                'label' => esc_html__('Show Event Button', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'edcare-core'),
                'label_off' => esc_html__('No', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'event_button_text',
            [
                'label' => esc_html__('Event Button Text', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'View Details', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

    }

    protected function style_tab_content()
    {
        
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

        $this->add_control(
            '_heading_style_dots',
            [
                'label' => esc_html__( 'Dots', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->start_controls_tabs( 'dots_tabs' );
        
        $this->start_controls_tab(
            'dots_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            'dots_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-carousel .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'dots_border_color',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-carousel .swiper-pagination .swiper-pagination-bullet' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'dots_active_tab',
            [
                'label' => esc_html__( 'Active', 'text-domain' ),
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            'dots_background_active',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-carousel .swiper-pagination .swiper-pagination-bullet:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'dots_border_color_active',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-carousel .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title & Content',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_section_subheading_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'section_subheading_icon_font_size',
            [
                'label' => esc_html__( 'Font Size', 'edcare-core' ),
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
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading .heading-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'section_subheading_icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading .heading-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_subheading_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
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
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
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
                'label' => esc_html__( 'Subheading Text', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_responsive_control(
            'section_subheading_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
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
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-heading .sub-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'section_subheading_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
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
                'label' => esc_html__( 'Padding', 'edcare-core' ),
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
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
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
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_responsive_control(
            'section_title_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
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
                'label' => __( 'Color', 'edcare-core' ),
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
            '_style_event',
            [
                'label' => esc_html__( 'Event',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_event_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'event_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .event-card .event-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'event_title_tabs' );
        
        $this->start_controls_tab(
            'event_title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'event_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .event-card .event-content .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'event_title_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'event_title_color_hover',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .title a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .event-card .event-content .title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'event_title_typography',
                'selector' => '{{WRAPPER}} .event-item .event-content .title, .event-card .event-content .title',
            ]
        );

        $this->add_control(
            '_heading_style_event_meta_icon',
            [
                'label' => esc_html__( 'Meta Icon', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'event_meta_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .location span i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .event-card .event-content .event-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'event_meta_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .location span i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .event-card .event-content .event-list li i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_event_meta_text',
            [
                'label' => esc_html__( 'Meta Text', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'event_meta_text_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .location span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .event-card .event-content .event-list li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'event_meta_text_typography',
                'selector' => '{{WRAPPER}} .event-item .event-content .location span, .event-card .event-content .event-list li',
            ]
        );

        $this->add_control(
            '_heading_style_event_date',
            [
                'label' => esc_html__( 'Date', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'event_date_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-thumb .date-wrap .date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'event_date_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-thumb .date-wrap .date' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'event_date_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-thumb .date-wrap .date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'event_date_typography',
                'selector' => '{{WRAPPER}} .event-item .event-thumb .date-wrap .date',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'event_date_month_typography',
                'selector' => '{{WRAPPER}} .event-item .event-thumb .date-wrap .date span',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_event_time',
            [
                'label' => esc_html__( 'Time', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'event_time_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .time' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'event_time_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .time' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'event_time_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'event_time_margin',
            [
                'label' => esc_html__( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'event_time_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content .time' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'event_time_typography',
                'selector' => '{{WRAPPER}} .event-item .event-content .time',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_event_button',
            [
                'label' => esc_html__( 'Button', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->start_controls_tabs( 'tabs_style_event_button' );
        
        $this->start_controls_tab(
            'event_button_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'event_button_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'event_button_background',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'event_button_border',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'event_button_box_shadow',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'event_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'event_button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'event_button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'event_button_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'event_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_control(
            'event_button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'edcare-core' ),
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
                'label'    => esc_html__( 'Typography', 'edcare-core' ),
                'name'     => 'event_button_typography',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->add_control(
            'event_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'event_button_margin',
            [
                'label'      => esc_html__( 'Margin', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            '_heading_style_event_layout',
            [
                'label' => esc_html__( 'Layout', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'event_layout_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .event-card' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'event_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .event-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'event_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .event-item .event-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .event-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $event_cat = $settings["etn_event_cat"];
        $event_tag = $settings["etn_event_tag"];
        $event_count = $settings["etn_event_count"];
        //$etn_event_col = $settings["etn_event_col"];
        $etn_desc_limit = $settings["etn_desc_limit"];
        $order = (isset($settings["order"]) ? $settings["order"] : 'DESC');
        $show_event_location = (isset($settings["show_event_location"]) ? $settings["show_event_location"] : 'yes');
        $show_end_date = (isset($settings["show_end_date"]) ? $settings["show_end_date"] : 'no');
        $etn_desc_show = (isset($settings["etn_desc_show"]) ? $settings["etn_desc_show"] : 'yes');
        $orderby = $settings["orderby"];
        $show_child_event = $settings["show_child_event"];
        $show_parent_event = $settings["show_parent_event"];
        $show_event_time = $settings["show_event_time"];
        $show_event_btn = $settings["show_event_btn"];

        if ($orderby == "etn_start_date" || $orderby == "etn_end_date") {
            $orderby_meta = "meta_value";
        } else {
            $orderby_meta = null;
        }
        $filter_with_status = $settings['filter_with_status'];
        $post_parent = Helper::show_parent_child($show_parent_event, $show_child_event);

        $data = Helper::post_data_query(
            'etn',
            $event_count,
            $order,
            $event_cat,
            'etn_category',
            null,
            null,
            $event_tag,
            $orderby_meta,
            $orderby,
            $filter_with_status,
            $post_parent
        );

        ?>

        <?php if ( $settings['design_style']  == 'layout-1' ): ?>
        
            <section class="edcare-el-section features-event pt-120 pb-120">
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
                    <div class="row gy-4 justify-content-center">
                        <?php if (!empty($data)):
                            foreach ($data as $index => $value):
                                $social = get_post_meta($value->ID, 'etn_event_socials', true);
                                $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);
                                $category = Helper::cate_with_link($value->ID, 'etn_category');
                                $start_date = get_post_meta($value->ID, 'etn_start_date', true);
                                $end_date = get_post_meta($value->ID, 'etn_end_date', true);
                                // $etn_start_date_new = Helper::etn_date_new( $start_date );
                                $etn_start_date = Helper::etn_date($start_date);
                                $etn_end_date = Helper::etn_date($end_date);

                                $start_time = get_post_meta($value->ID, 'etn_start_time', true);
                                $end_time = get_post_meta($value->ID, 'etn_end_time', true);

                                $start_date_digit = date("d", strtotime($start_date));
                                $start_month_digit = date("M", strtotime($start_date));
                                $start_year_digit = date("Y", strtotime($start_date));
                                $start_date_year_month = date("F d, Y", strtotime($start_date));

                                $event_options = get_option("etn_event_options");

                                $data = Helper::single_template_options($value->ID);
                                ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="event-item wow fade-in-bottom" data-wow-delay="400ms">
                                        <div class="event-thumb">
                                            <?php echo get_the_post_thumbnail($value->ID); ?>
                                            <div class="date-wrap">
                                                <h5 class="date">
                                                    <?php echo esc_html($start_date_digit); ?>
                                                    <span>
                                                        <?php echo esc_html($start_month_digit); ?>
                                                    </span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="event-content">
                                            <?php if (!empty($settings['show_event_time'])): ?>
                                                <span class="time">
                                                    <i class="fa-regular fa-clock"></i>
                                                    <?php echo esc_html($start_time); ?>-
                                                    <?php echo esc_html($end_time); ?>
                                                </span>
                                            <?php endif; ?>
                                            <h3 class="title">
                                                <a href="<?php echo get_the_permalink($value->ID); ?>">
                                                    <?php echo get_the_title($value->ID); ?>
                                                </a>
                                            </h3>
                                            <?php if (!empty($settings['show_event_location'])):

                                                $location = '';
                                                $loc_arr = $etn_event_location;

                                                if (!empty(is_array($loc_arr) || is_object($loc_arr))):
                                                    foreach ($loc_arr as $key => $loc) {
                                                        if ($key == 'address') {
                                                            $location .= $loc;
                                                        } elseif ($key == 'custom_url') {
                                                            $location .= $loc;
                                                        }
                                                    }
                                                endif;
                                                if (!empty($location)):
                                                    ?>
                                                    <div class="location">
                                                        <span>
                                                            <i class="fa-regular fa-location-dot"></i>
                                                            <?php echo esc_html($location); ?>
                                                        </span>
                                                    </div>
                                            <?php endif; endif; ?>
                                            <?php if (!empty($settings['show_event_btn'])): ?>
                                                <a href="<?php echo get_the_permalink($value->ID); ?>" class="edcare-el-button ed-primary-btn">
                                                    <?php echo edcare_kses($settings['event_button_text']); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        else: ?>
                            <p class="etn-not-found-post"><?php echo esc_html__('No Event Found', 'edcare-core'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        
        <?php elseif ( $settings['design_style']  == 'layout-2' ): ?>
        
            <section class="edcare-el-section event-section pt-120 pb-120">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/event-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/event-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-3">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/event-3.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-4">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/event-4.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                        <div class="edcare-el-section-subheading section-heading text-center white-content">
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
                    <div class="event-carousel swiper">
                        <div class="swiper-wrapper">
                            <?php if (!empty($data)):
                                foreach ($data as $index => $value):
                                    $social = get_post_meta($value->ID, 'etn_event_socials', true);
                                    $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);
                                    $category = Helper::cate_with_link($value->ID, 'etn_category');
                                    $start_date = get_post_meta($value->ID, 'etn_start_date', true);
                                    $end_date = get_post_meta($value->ID, 'etn_end_date', true);
                                    // $etn_start_date_new = Helper::etn_date_new( $start_date );
                                    $etn_start_date = Helper::etn_date($start_date);
                                    $etn_end_date = Helper::etn_date($end_date);

                                    $start_time = get_post_meta($value->ID, 'etn_start_time', true);
                                    $end_time = get_post_meta($value->ID, 'etn_end_time', true);

                                    $start_date_digit = date("d", strtotime($start_date));
                                    $start_month_digit = date("M", strtotime($start_date));
                                    $start_year_digit = date("Y", strtotime($start_date));
                                    $start_date_year_month = date("F d, Y", strtotime($start_date));

                                    $event_options = get_option("etn_event_options");

                                    $data = Helper::single_template_options($value->ID);
                                ?>
                                <div class="swiper-slide">
                                    <div class="event-card">
                                        <div class="event-thumb">
                                            <?php echo get_the_post_thumbnail($value->ID); ?>
                                        </div>
                                        <div class="event-content">
                                            <h3 class="title">
                                                <a href="<?php echo get_the_permalink($value->ID); ?>">
                                                    <?php echo get_the_title($value->ID); ?>
                                                </a>
                                            </h3>
                                            <ul class="event-list">
                                                <?php if (!empty($settings['show_event_location'])):

                                                    $location = '';
                                                    $loc_arr = $etn_event_location;

                                                    if (!empty(is_array($loc_arr) || is_object($loc_arr))):
                                                        foreach ($loc_arr as $key => $loc) {
                                                            if ($key == 'address') {
                                                                $location .= $loc;
                                                            } elseif ($key == 'custom_url') {
                                                                $location .= $loc;
                                                            }
                                                        }
                                                    endif;
                                                    if (!empty($location)):
                                                        ?>
                                                        <li>
                                                            <i class="fa-regular fa-location-dot"></i>
                                                            <?php echo esc_html($location); ?>
                                                        </li>
                                                <?php endif; endif; ?>
                                                <?php if (!empty($settings['show_event_time'])): ?>
                                                    <li>
                                                        <i class="fa-regular fa-clock"></i>
                                                        <?php echo esc_html($start_time); ?> -
                                                        <?php echo esc_html($end_time); ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                            <?php if (!empty($settings['show_event_btn'])): ?>
                                                <a href="<?php echo get_the_permalink($value->ID); ?>" class="edcare-el-button ed-primary-btn">
                                                    <?php echo edcare_kses($settings['event_button_text']); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                endforeach;
                            else: ?>
                                <p class="etn-not-found-post"><?php echo esc_html__('No Event Found', 'edcare-core'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-3' ): ?>

            <section class="edcare-el-section event-section-2 pt-120 pb-120">
                <div class="container">
                    <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                        <div class="section-heading text-center">
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
                    <div class="row gy-4">
                        <?php if (!empty($data)): 
                            foreach ($data as $index => $value): 
                                
                                // Fetch and unserialize speaker data
                                $speakers_serialized = get_post_meta($value->ID, 'etn_event_speaker', true);
                                $speaker_ids = !empty($speakers_serialized[0]) ? maybe_unserialize($speakers_serialized[0]) : [];

                                $speaker_details = [];
                                if (!empty($speaker_ids) && is_array($speaker_ids)) {
                                    foreach ($speaker_ids as $speaker_id) {
                                        $speaker_name = get_the_title($speaker_id); // Get speaker name
                                        $speaker_image = get_the_post_thumbnail_url($speaker_id, 'thumbnail'); // Get speaker image
                                        $speaker_details[] = [
                                            'name' => $speaker_name,
                                            'image' => $speaker_image,
                                        ];
                                    }
                                }

                                // Other meta fields
                                $social = get_post_meta($value->ID, 'etn_event_socials', true);
                                $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);
                                $category = Helper::cate_with_link($value->ID, 'etn_category');
                                $start_date = get_post_meta($value->ID, 'etn_start_date', true);
                                $end_date = get_post_meta($value->ID, 'etn_end_date', true);
                                $etn_start_date = Helper::etn_date($start_date);
                                $etn_end_date = Helper::etn_date($end_date);
                                $start_time = get_post_meta($value->ID, 'etn_start_time', true);
                                $end_time = get_post_meta($value->ID, 'etn_end_time', true);

                                $event_options = get_option("etn_event_options");
                                $data = Helper::single_template_options($value->ID);
                        ?>
                            <div class="col-lg-6 col-md-12">
                                <div class="event-card event-card-2">
                                    <div class="event-thumb">
                                        <?php echo get_the_post_thumbnail($value->ID); ?>
                                    </div>
                                    <div class="event-content">
                                        <ul class="event-list">
                                            <?php if (!empty($settings['show_event_location'])): 
                                                $location = '';
                                                $loc_arr = $etn_event_location;

                                                if (!empty(is_array($loc_arr) || is_object($loc_arr))):
                                                    foreach ($loc_arr as $key => $loc) {
                                                        if ($key == 'address' || $key == 'custom_url') {
                                                            $location .= $loc;
                                                        }
                                                    }
                                                endif;

                                                if (!empty($location)): ?>
                                                    <li>
                                                        <i class="fa-regular fa-location-dot"></i>
                                                        <?php echo esc_html($location); ?>
                                                    </li>
                                                <?php endif; 
                                            endif; ?>

                                            <?php if (!empty($settings['show_event_time'])): ?>
                                                <li>
                                                    <i class="fa-regular fa-clock"></i>
                                                    <?php echo esc_html($start_time); ?> - <?php echo esc_html($end_time); ?>
                                                </li>
                                            <?php endif; ?>
                                        </ul>

                                        <h3 class="title">
                                            <a href="<?php echo get_the_permalink($value->ID); ?>">
                                                <?php echo get_the_title($value->ID); ?>
                                            </a>
                                        </h3>

                                        <div class="event-bottom">
                                            <?php if (!empty($settings['show_event_btn'])): ?>
                                                <a href="<?php echo get_the_permalink($value->ID); ?>" class="edcare-el-button ed-primary-btn">
                                                    <?php echo edcare_kses($settings['event_button_text']); ?>
                                                </a>
                                            <?php endif; ?>

                                            <!-- Display Speaker Details -->
                                                <?php foreach ($speaker_details as $speaker): ?>
                                                    <div class="event-author">
                                                        <?php if (!empty($speaker['image'])): ?>
                                                            <div class="author-thumb">
                                                                <img src="<?php echo esc_url($speaker['image']); ?>" alt="<?php echo esc_attr($speaker['name']); ?>">
                                                            </div>
                                                        <?php endif; ?>
                                                        <span><?php echo esc_html($speaker['name']); ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        else: ?>
                            <p class="etn-not-found-post"><?php echo esc_html__('No Event Found', 'edcare-core'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        
        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new EdCare_Event_New_Post());