<?php

namespace EdCareCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Course_Card extends Widget_Base {

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
        return 'edcare_course_card';
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
        return __( 'Course Card', 'edcare-core' );
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
        return ['edcare_core'];
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
        return ['edcare-course'];
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
                    'layout-1' => esc_html__( 'Layout 1', 'edcare-core' ),
                    'layout-2' => esc_html__( 'Layout 2', 'edcare-core' ),
                    'layout-3' => esc_html__( 'Layout 3', 'edcare-core' ),
                    'layout-4' => esc_html__( 'Layout 4', 'edcare-core' ),
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
                    'design_style' => 'layout-4',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_title',
            [
                'label' => esc_html__( 'Title & Content',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-4',
                ],
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
            '_content_course',
            [
                'label'       => esc_html__( 'Course', 'edcare-core' ),
                'tab'         => Controls_Manager::TAB_CONTENT,
            ]
        );

        $post_type = 'courses';
        $taxonomy = 'course-category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'edcare-core'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'edcare-core'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => edcare_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'edcare-core'),
                'description' => esc_html__('Select a category to exclude', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => edcare_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => edcare_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
			    ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'edcare-core' ),
                    'desc' 	=> esc_html__( 'Descending', 'edcare-core' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edcare-core' ),
                'label_off' => esc_html__( 'No', 'edcare-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'post_title_word',
            [
                'label' => esc_html__('Title Word Count', 'edcare-core'),
                'description' => esc_html__('Set how many word you want to displa!', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );
        
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'View Details', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'course_author_switch',
            [
                'label' => esc_html__( 'Show Course Author?', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'course_review_switch',
            [
                'label' => esc_html__( 'Show Course Review?', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'course_price_switch',
            [
                'label' => esc_html__( 'Show Course Price?', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'course_view_switch',
            [
                'label' => esc_html__( 'Show Course View Details?', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_section_button',
            [
                'label' => esc_html__( 'Button', 'edcare-core' ),
                'condition' => [
                    'design_style' => 'layout-4',
                ],
            ]
        );

        $this->add_control(
            'section_button_text',
            [
                'label' => esc_html__( 'Button Text', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button Text', 'edcare-core' ),
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
            'section_button_icon_type',
            [
                'label' => esc_html__( 'Image Type', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__( 'Icon', 'text-domain' ),
                    'image' => esc_html__( 'Image', 'text-domain' ),
                ],
            ]
        );
        
        $this->add_control(
            'section_button_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'section_button_icon_type' => 'image',
                ],
            ]
        );
        
        $this->add_control(
            'section_button_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'section_button_icon_type' => 'icon',
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
                    '{{WRAPPER}} .edcare-el-button i' => 'margin-left: {{SIZE}}{{UNIT}}!important;',
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_section_layout',
            [
                'label' => esc_html__( 'Section Layout',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => 'layout-4',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_layout_margin',
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
            'section_layout_padding',
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
            'section_layout_background',
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
            '_style_design_layout',
            [
                'label' => esc_html__( 'Design Layout', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'design_layout_margin',
            [
                'label' => esc_html__( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .course-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_layout_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_layout_border',
                'selector' => '{{WRAPPER}} .course-item',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title & Content',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => 'layout-4',
                ],
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
			'_style_button',
			[
				'label' => __( 'Button', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => 'layout-4',
                ],
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'button_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background',
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
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover'    => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .category-item a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'button_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'edcare-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'edcare-core' ),
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );

        $this->add_control(
            'button_padding',
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
            'button_margin',
            [
                'label'      => esc_html__( 'Margin', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            '_style_course',
            [
                'label' => esc_html__( 'Course',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            '_heading_style_course_image',
            [
                'label' => esc_html__( 'Image', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'course_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-thumb-wrap .course-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_image_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-thumb-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_course_category',
            [
                'label' => esc_html__( 'Category', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_category_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .offer' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_category_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .offer' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'course_category_border',
                'selector' => '{{WRAPPER}} .course-item .course-content .offer',
            ]
        );

        $this->add_responsive_control(
            'course_category_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_category_margin',
            [
                'label' => esc_html__( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .offer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_category_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .offer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_category_typography',
                'selector' => '{{WRAPPER}} .course-item .course-content .offer',
            ]
        );

        $this->add_control(
            '_heading_style_course_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'course_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'course_title_tabs' );
        
        $this->start_controls_tab(
            'course_title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'course_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'course_title_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'course_title_color_hover',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_title_typography',
                'selector' => '{{WRAPPER}} .course-item .course-content .title',
            ]
        );

        $this->add_control(
            '_heading_style_course_meta',
            [
                'label' => esc_html__( 'Meta', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'course_meta_tabs' );
        
        $this->start_controls_tab(
            'course_meta_icon_tab',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
            ]
        );

        $this->add_responsive_control(
            'course_meta_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .course-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .course-list li i' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'course_meta_text_tab',
            [
                'label' => esc_html__( 'Text', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'course_meta_text_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .course-list li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_meta_text_typography',
                'selector' => '{{WRAPPER}} .course-item .course-content .course-list li',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_style_course_author_name',
            [
                'label' => esc_html__( 'Author Name', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'course_author_name_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .course-author-box .course-author .author-info .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'course_author_name_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .course-author-box .course-author .author-info .name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_author_name_typography',
                'selector' => '{{WRAPPER}} .course-item .course-content .course-author-box .course-author .author-info .name',
            ]
        );

        $this->add_control(
            '_heading_style_course_author_designation',
            [
                'label' => esc_html__( 'Author Designation', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_author_designation_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .course-author-box .course-author .author-info span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_author_designation_typography',
                'selector' => '{{WRAPPER}} .course-item .course-content .course-author-box .course-author .author-info span',
            ]
        );

        $this->add_control(
            '_heading_style_course_rating',
            [
                'label' => esc_html__( 'Rating', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'course_rating_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-review span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'course_rating_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-review span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_rating_text_color',
            [
                'label' => esc_html__( 'Text Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content .course-author-box .course-review li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_rating_text_typography',
                'selector' => '{{WRAPPER}} .course-item .course-content .course-author-box .course-review li',
            ]
        );

        $this->add_control(
            '_heading_style_course_price',
            [
                'label' => esc_html__( 'Price', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_price_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .bottom-content .price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_price_typography',
                'selector' => '{{WRAPPER}} .course-item .bottom-content .price',
            ]
        );

        $this->add_control(
            '_heading_style_course_button',
            [
                'label' => esc_html__( 'Button', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->start_controls_tabs( 'tabs_style_course_button_button' );
        
        $this->start_controls_tab(
            'course_button_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'course_button_color',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .bottom-content .course-btn'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'course_button_background',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .bottom-content .course-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'course_button_border',
                'selector' => '{{WRAPPER}} .course-item .bottom-content .course-btn',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'course_button_box_shadow',
                'selector' => '{{WRAPPER}} .course-item .bottom-content .course-btn',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'course_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'course_button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .bottom-content .course-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'course_button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .bottom-content .course-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'course_button_border_hover',
                'selector' => '{{WRAPPER}} .course-item .bottom-content .course-btn:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'course_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .course-item .bottom-content .course-btn:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_control(
            'course_button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'text-domain' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .course-item .bottom-content .course-btn' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .course-item .bottom-content .course-btn:before' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'text-domain' ),
                'name'     => 'course_button_typography',
                'selector' => '{{WRAPPER}} .course-item .bottom-content .course-btn',
            ]
        );
        
        $this->add_control(
            'course_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .course-item .bottom-content .course-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'course_button_margin',
            [
                'label'      => esc_html__( 'Margin', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .course-item .bottom-content .course-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_course_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'course_layout_border',
                'selector' => '{{WRAPPER}} .course-item .course-content',
            ]
        );

        $this->add_responsive_control(
            'course_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_layout_margin',
            [
                'label' => esc_html__( 'Margin', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-item .course-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'courses',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'	=> 'course-category',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'course-category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'course-category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        $main_query = new \WP_Query($args);

        ?>

            <?php if ( $settings['design_style']  == 'layout-1' ): ?>

                <div class="row gy-4 justify-content-center">
                    <?php if ($main_query->have_posts()): ?>
                    <?php while ($main_query->have_posts()):
                        $main_query->the_post();
                        global $post, $authordata;

                        $tutor_course_img_id = get_post_thumbnail_id();
                        $tutor_course_img = get_tutor_course_thumbnail_src();
                        $tutor_course_img_alt = get_post_meta($tutor_course_img_id, '_wp_attachment_image_alt', true);

                        $course_id = get_the_ID();
                        $profile_url = tutor_utils()->profile_url($authordata->ID, true);
                        $course_categories = get_tutor_course_categories($course_id);

                        $designation = get_the_author_meta('_tutor_profile_job_title', $post->post_author);

                        $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
                        $course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);
                        $course_views = tutor_utils()->get_course_views($course_id);

                        $cat_color = '#17A2B8';
                        if (!empty($course_categories[0])) {
                            $cat_color = get_term_meta($course_categories[0]->term_id, '_acadia_course_cat_color', true);
                            $cat_color = !empty($cat_color) ? $cat_color : '#17A2B8';
                        }

                        $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                        $course_rating = tutor_utils()->get_course_rating();
                        $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

                        // wishlist
                        $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                        $login_url_attr = '';
                        $action_class = '';

                        if (is_user_logged_in()) {
                            $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                        } else {
                            $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                            if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
                                $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
                            }
                        }

                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="course-item">
                            <div class="course-thumb-wrap">
                                <div class="course-thumb">
                                    <img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php echo esc_attr($tutor_course_img_alt); ?>">
                                </div>
                            </div>
                            <div class="course-content">
                                <?php if (!empty($course_categories[0])): ?>
                                    <span class="offer">
                                        <?php echo esc_html($course_categories[0]->name); ?>
                                    </span>
                                <?php endif; ?>
                                <h3 class="title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo wp_trim_words(get_the_title(), $settings['post_title_word'], ''); ?>
                                    </a>
                                </h3>
                                <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || !empty($tutor_lesson_count)): ?>
                                    <ul class="course-list">
                                        <?php if (!empty($tutor_lesson_count)): ?>
                                            <li><i class="fa-light fa-file"></i><?php printf(_n('Lessons %d', 'Lessons %d', $tutor_lesson_count, 'edcare-core'), $tutor_lesson_count); ?></li>
                                        <?php endif; ?>
                                        <?php if (!empty($course_students)): ?>
                                            <li><i class="fa-light fa-user"></i><?php printf(_n('Student %d', 'Students %d', $course_students, 'edcare-core'), $course_students); ?></li>
                                        <?php endif; ?>
                                        <?php if (!empty($course_views)): ?>
                                            <li><i class="fa-light fa-eye"></i><?php printf(_n('Views %d', 'Views %d', $course_views, 'edcare-core'), $course_views); ?></li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="course-author-box">
                                    <?php if ( !empty( $settings['course_author_switch'] ) ) : ?>
                                        <div class="course-author">
                                            <div class="author-img">
                                                <?php
                                                    echo wp_kses(
                                                        tutor_utils()->get_tutor_avatar($post->post_author),
                                                        tutor_utils()->allowed_avatar_tags()
                                                    );
                                                ?>
                                            </div>
                                            <div class="author-info">
                                                <h4 class="name"><?php echo esc_html(get_the_author()); ?></h4>
                                                <?php if (!empty($designation)): ?>
                                                    <span>
                                                        <?php echo edcare_kses($designation); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($show_course_ratings && !empty($settings['course_review_switch'])): ?>
                                        <ul class="course-review">
                                            <?php
                                                $course_rating = tutor_utils()->get_course_rating();
                                                tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                            ?>
                                            <li class="point">
                                                (<?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>)
                                            </li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="bottom-content">
                                <?php if ( !empty( $settings['course_price_switch'] ) ) : ?>
                                    <span class="price">
                                        <?php echo edcare_kses($price); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( !empty( $settings['course_view_switch'] ) ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="course-btn">
                                        <?php echo esc_html($settings['button_text']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;
                        wp_reset_query();
                    endif; ?>
                </div>
            
            <?php elseif ( $settings['design_style']  == 'layout-2' ): ?>
            
                <div class="row gy-4">
                    <?php if ($main_query->have_posts()): ?>
                        <?php while ($main_query->have_posts()):
                            $main_query->the_post();
                            global $post, $authordata;

                            $tutor_course_img_id = get_post_thumbnail_id();
                            $tutor_course_img = get_tutor_course_thumbnail_src();
                            $tutor_course_img_alt = get_post_meta($tutor_course_img_id, '_wp_attachment_image_alt', true);

                            $course_id = get_the_ID();
                            $profile_url = tutor_utils()->profile_url($authordata->ID, true);
                            $course_categories = get_tutor_course_categories($course_id);

                            $designation = get_the_author_meta('_tutor_profile_job_title', $post->post_author);

                            $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
                            $course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);
                            $course_views = tutor_utils()->get_course_views($course_id);

                            $cat_color = '#17A2B8';
                            if (!empty($course_categories[0])) {
                                $cat_color = get_term_meta($course_categories[0]->term_id, '_acadia_course_cat_color', true);
                                $cat_color = !empty($cat_color) ? $cat_color : '#17A2B8';
                            }

                            $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                            $course_rating = tutor_utils()->get_course_rating();
                            $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

                            // wishlist
                            $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                            $login_url_attr = '';
                            $action_class = '';

                            if (is_user_logged_in()) {
                                $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                            } else {
                                $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                                if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
                                    $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
                                }
                            }

                        ?>
                        <div class="col-xl-6 col-lg-12">
                            <div class="course-item course-item-2 wow fade-in-bottom" data-wow-delay="300ms">
                                <div class="course-thumb-wrap">
                                    <div class="course-thumb">
                                        <img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php echo esc_attr($tutor_course_img_alt); ?>">
                                    </div>
                                </div>
                                <div class="course-content-wrap">
                                    <div class="course-content">
                                        <?php if (!empty($course_categories[0])): ?>
                                            <span class="offer">
                                                <?php echo esc_html($course_categories[0]->name); ?>
                                            </span>
                                        <?php endif; ?>
                                        <h3 class="title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo wp_trim_words(get_the_title(), $settings['post_title_word'], ''); ?>
                                            </a>
                                        </h3>
                                        <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || !empty($tutor_lesson_count)): ?>
                                            <ul class="course-list">
                                                <?php if (!empty($tutor_lesson_count)): ?>
                                                    <li><i class="fa-light fa-file"></i><?php printf(_n('Lesson %d', '%d Lessons', $tutor_lesson_count, 'edcare-core'), $tutor_lesson_count); ?></li>
                                                <?php endif; ?>
                                                <?php if (!empty($course_students)): ?>
                                                    <li><i class="fa-light fa-user"></i><?php printf(_n('Student %d', 'Students %d', $course_students, 'edcare-core'), $course_students); ?></li>
                                                <?php endif; ?>
                                                <?php if (!empty($course_views)): ?>
                                                    <li><i class="fa-light fa-eye"></i><?php printf(_n('View %d', 'Views %d', $course_views, 'edcare-core'), $course_views); ?></li>
                                                <?php endif; ?>
                                            </ul>
                                        <?php endif; ?>
                                        <div class="course-author-box">
                                            <?php if ( !empty( $settings['course_author_switch'] ) ) : ?>
                                                <div class="course-author">
                                                    <div class="author-img">
                                                        <?php
                                                            echo wp_kses(
                                                                tutor_utils()->get_tutor_avatar($post->post_author),
                                                                tutor_utils()->allowed_avatar_tags()
                                                            );
                                                        ?>
                                                    </div>
                                                    <div class="author-info">
                                                        <h4 class="name"><?php echo esc_html(get_the_author()); ?></h4>
                                                        <?php if (!empty($designation)): ?>
                                                            <span>
                                                                <?php echo edcare_kses($designation); ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($show_course_ratings && !empty($settings['course_review_switch'])): ?>
                                                <ul class="course-review">
                                                    <?php
                                                        $course_rating = tutor_utils()->get_course_rating();
                                                        tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                                    ?>
                                                    <li class="point">
                                                        (<?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>)
                                                    </li>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <?php if ( !empty( $settings['course_price_switch'] ) ) : ?>
                                            <span class="price">
                                                <?php echo edcare_kses($price); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ( !empty( $settings['course_view_switch'] ) ) : ?>
                                            <a href="<?php the_permalink(); ?>" class="course-btn">
                                                <?php echo esc_html($settings['button_text']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;
                        wp_reset_query();
                        endif; 
                    ?>
                </div>
            
            <?php elseif ( $settings['design_style']  == 'layout-3' ): ?>

                <div class="row gy-4 justify-content-center">
                    <?php if ($main_query->have_posts()): ?>
                        <?php while ($main_query->have_posts()):
                            $main_query->the_post();
                            global $post, $authordata;

                            $tutor_course_img_id = get_post_thumbnail_id();
                            $tutor_course_img = get_tutor_course_thumbnail_src();
                            $tutor_course_img_alt = get_post_meta($tutor_course_img_id, '_wp_attachment_image_alt', true);

                            $course_id = get_the_ID();
                            $profile_url = tutor_utils()->profile_url($authordata->ID, true);
                            $course_categories = get_tutor_course_categories($course_id);

                            $designation = get_the_author_meta('_tutor_profile_job_title', $post->post_author);

                            $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
                            $course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);
                            $course_views = tutor_utils()->get_course_views($course_id);

                            $cat_color = '#17A2B8';
                            if (!empty($course_categories[0])) {
                                $cat_color = get_term_meta($course_categories[0]->term_id, '_acadia_course_cat_color', true);
                                $cat_color = !empty($cat_color) ? $cat_color : '#17A2B8';
                            }

                            $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                            $course_rating = tutor_utils()->get_course_rating();
                            $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

                            // wishlist
                            $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                            $login_url_attr = '';
                            $action_class = '';

                            if (is_user_logged_in()) {
                                $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                            } else {
                                $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                                if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
                                    $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
                                }
                            }

                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="course-item dark-item">
                                <div class="course-thumb-wrap">
                                    <div class="course-thumb">
                                        <img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php echo esc_attr($tutor_course_img_alt); ?>">
                                    </div>
                                </div>
                                <div class="course-content">
                                    <?php if (!empty($course_categories[0])): ?>
                                        <span class="offer">
                                            <?php echo esc_html($course_categories[0]->name); ?>
                                        </span>
                                    <?php endif; ?>
                                    <h3 class="title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo wp_trim_words(get_the_title(), $settings['post_title_word'], ''); ?>
                                        </a>
                                    </h3>
                                    <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || !empty($tutor_lesson_count)): ?>
                                        <ul class="course-list">
                                            <?php if (!empty($tutor_lesson_count)): ?>
                                                <li><i class="fa-light fa-file"></i><?php printf(_n('Lesson %d', '%d Lessons', $tutor_lesson_count, 'edcare-core'), $tutor_lesson_count); ?></li>
                                            <?php endif; ?>
                                            <?php if (!empty($course_students)): ?>
                                                <li><i class="fa-light fa-user"></i><?php printf(_n('Student %d', 'Students %d', $course_students, 'edcare-core'), $course_students); ?></li>
                                            <?php endif; ?>
                                            <?php if (!empty($course_views)): ?>
                                                <li><i class="fa-light fa-eye"></i><?php printf(_n('View %d', 'Views %d', $course_views, 'edcare-core'), $course_views); ?></li>
                                            <?php endif; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <div class="course-author-box">
                                        <?php if ( !empty( $settings['course_author_switch'] ) ) : ?>
                                            <div class="course-author">
                                                <div class="author-img">
                                                    <?php
                                                        echo wp_kses(
                                                            tutor_utils()->get_tutor_avatar($post->post_author),
                                                            tutor_utils()->allowed_avatar_tags()
                                                        );
                                                    ?>
                                                </div>
                                                <div class="author-info">
                                                    <h4 class="name"><?php echo esc_html(get_the_author()); ?></h4>
                                                    <?php if (!empty($designation)): ?>
                                                        <span>
                                                            <?php echo edcare_kses($designation); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($show_course_ratings && !empty($settings['course_review_switch'])): ?>
                                            <ul class="course-review">
                                                <?php
                                                    $course_rating = tutor_utils()->get_course_rating();
                                                    tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                                ?>
                                                <li class="point">
                                                    (<?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>)
                                                </li>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="bottom-content">
                                    <?php if ( !empty( $settings['course_price_switch'] ) ) : ?>
                                        <span class="price">
                                            <?php echo edcare_kses($price); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['course_view_switch'] ) ) : ?>
                                        <a href="<?php the_permalink(); ?>" class="course-btn">
                                            <?php echo esc_html($settings['button_text']); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;
                        wp_reset_query();
                        endif; 
                    ?>
                </div>
            
            <?php elseif ( $settings['design_style']  == 'layout-4' ):
                if ('2' == $settings['section_button_link_type']) {
                    $this->add_render_attribute('edcare-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                    $this->add_render_attribute('edcare-button-arg', 'target', '_self');
                    $this->add_render_attribute('edcare-button-arg', 'rel', 'nofollow');
                    $this->add_render_attribute('edcare-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                } else {
                    if (!empty($settings['section_button_link']['url'])) {
                        $this->add_link_attributes('edcare-button-arg', $settings['section_button_link']);
                        $this->add_render_attribute('edcare-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                    }
                }
                
                ?>

                <section class="edcare-el-section course-section bg-grey pt-120 pb-120">
                    <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                        <div class="shapes">
                            <div class="shape shape-1">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/feature-shape-3.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                            </div>
                            <div class="shape shape-2">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/feature-shape-4.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="container">
                        <?php if ( !empty( $settings['section_heading_switch'] ) ) : ?>
                            <div class="course-top heading-space align-items-end">
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
                                <div class="course-top-right wow fade-in-bottom" data-wow-delay="300ms">
                                    <a <?php echo $this->get_render_attribute_string( 'edcare-button-arg' ); ?>>
                                        <?php print edcare_kses($settings['section_button_text']); ?>
                                        <?php if ( $settings['section_button_icon_type']  == 'image' ): ?>
                                            <span>
                                                <img src="<?php echo $settings['section_button_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['section_button_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                            </span>
                                        <?php elseif ( $settings['section_button_icon_type']  == 'icon' ): ?>
                                            <span>
                                                <?php edcare_render_icon($settings, 'section_button_icon' ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                            
                        <?php endif; ?>
                        
                        <div class="row gy-4">
                            <?php if ($main_query->have_posts()): ?>
                                <?php while ($main_query->have_posts()):
                                    $main_query->the_post();
                                    global $post, $authordata;

                                    $tutor_course_img_id = get_post_thumbnail_id();
                                    $tutor_course_img = get_tutor_course_thumbnail_src();
                                    $tutor_course_img_alt = get_post_meta($tutor_course_img_id, '_wp_attachment_image_alt', true);

                                    $course_id = get_the_ID();
                                    $profile_url = tutor_utils()->profile_url($authordata->ID, true);
                                    $course_categories = get_tutor_course_categories($course_id);

                                    $designation = get_the_author_meta('_tutor_profile_job_title', $post->post_author);

                                    $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
                                    $course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);
                                    $course_views = tutor_utils()->get_course_views($course_id);

                                    $cat_color = '#17A2B8';
                                    if (!empty($course_categories[0])) {
                                        $cat_color = get_term_meta($course_categories[0]->term_id, '_acadia_course_cat_color', true);
                                        $cat_color = !empty($cat_color) ? $cat_color : '#17A2B8';
                                    }

                                    $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                                    $course_rating = tutor_utils()->get_course_rating();
                                    $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

                                    // wishlist
                                    $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                                    $login_url_attr = '';
                                    $action_class = '';

                                    if (is_user_logged_in()) {
                                        $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                                    } else {
                                        $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                                        if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
                                            $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
                                        }
                                    }

                                ?>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="course-item course-item-2 wow fade-in-bottom" data-wow-delay="300ms">
                                        <div class="course-thumb-wrap">
                                            <div class="course-thumb">
                                                <img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php echo esc_attr($tutor_course_img_alt); ?>">
                                            </div>
                                        </div>
                                        <div class="course-content-wrap">
                                            <div class="course-content">
                                                <?php if (!empty($course_categories[0])): ?>
                                                    <span class="offer">
                                                        <?php echo esc_html($course_categories[0]->name); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <h3 class="title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), $settings['post_title_word'], ''); ?>
                                                    </a>
                                                </h3>
                                                <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || !empty($tutor_lesson_count)): ?>
                                                    <ul class="course-list">
                                                        <?php if (!empty($tutor_lesson_count)): ?>
                                                            <li><i class="fa-light fa-file"></i><?php printf(_n('Lesson %d', '%d Lessons', $tutor_lesson_count, 'edcare-core'), $tutor_lesson_count); ?></li>
                                                        <?php endif; ?>
                                                        <?php if (!empty($course_students)): ?>
                                                            <li><i class="fa-light fa-user"></i><?php printf(_n('Student %d', 'Students %d', $course_students, 'edcare-core'), $course_students); ?></li>
                                                        <?php endif; ?>
                                                        <?php if (!empty($course_views)): ?>
                                                            <li><i class="fa-light fa-eye"></i><?php printf(_n('View %d', 'Views %d', $course_views, 'edcare-core'), $course_views); ?></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                <?php endif; ?>
                                                <div class="course-author-box">
                                                    <?php if ( !empty( $settings['course_author_switch'] ) ) : ?>
                                                        <div class="course-author">
                                                            <div class="author-img">
                                                                <?php
                                                                    echo wp_kses(
                                                                        tutor_utils()->get_tutor_avatar($post->post_author),
                                                                        tutor_utils()->allowed_avatar_tags()
                                                                    );
                                                                ?>
                                                            </div>
                                                            <div class="author-info">
                                                                <h4 class="name"><?php echo esc_html(get_the_author()); ?></h4>
                                                                <?php if (!empty($designation)): ?>
                                                                    <span>
                                                                        <?php echo edcare_kses($designation); ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($show_course_ratings && !empty($settings['course_review_switch'])): ?>
                                                        <ul class="course-review">
                                                            <?php
                                                                $course_rating = tutor_utils()->get_course_rating();
                                                                tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                                            ?>
                                                            <li class="point">
                                                                (<?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>)
                                                            </li>
                                                        </ul>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="bottom-content">
                                                <?php if ( !empty( $settings['course_price_switch'] ) ) : ?>
                                                    <span class="price">
                                                        <?php echo edcare_kses($price); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ( !empty( $settings['course_view_switch'] ) ) : ?>
                                                    <a href="<?php the_permalink(); ?>" class="course-btn">
                                                        <?php echo esc_html($settings['button_text']); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile;
                                wp_reset_query();
                                endif; 
                            ?>
                        </div>
                    </div>
                </section>
            
            <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new EdCare_Course_Card() );