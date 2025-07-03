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
class EdCare_Why_Choose_Us extends Widget_Base {

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
		return 'edcare_why_choose_us';
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
		return __( 'Why Choose Us', 'edcare-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_title',
            [
                'label'       => esc_html__( 'Title & Content', 'edcare-core' ),
                'tab'         => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
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
            ]
        );

        $this->add_control(
            'section_subheading',
            [
                'label' => esc_html__('Subheading', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('Why Choose Us', 'edcare-core'),
                'label_block' => true,
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
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Explore Yourself All Over The World', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'This includes offering personalized feedback, fostering a sense of community through discussion forums and group projects, and providing continuous support to address challenges and improve.', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_image',
            [
                'label' => esc_html__( 'Image',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-2',
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
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_info_list',
            [
                'label' => esc_html__( 'Info List', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ]
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'why_choose_us_image',
            [
                'label' => esc_html__( 'Choose Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
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

        $repeater->add_control(
            'why_choose_us_icon',
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

        $repeater->add_control(
            'why_choose_us_image_icon',
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

        $repeater->add_control(
            'info_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'info_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'wow_delay',
            [
                'label' => esc_html__( 'Animation Delay', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '100' => esc_html__( '100', 'text-domain' ),
                    '200' => esc_html__( '200', 'text-domain' ),
                    '300' => esc_html__( '300', 'text-domain' ),
                    '400' => esc_html__( '400', 'text-domain' ),
                    '500' => esc_html__( '500', 'text-domain' ),
                    '600' => esc_html__( '600', 'text-domain' ),
                    '700' => esc_html__( '700', 'text-domain' ),
                    '800' => esc_html__( '800', 'text-domain' ),
                    '900' => esc_html__( '900', 'text-domain' ),
                ],
            ]
        );

        $this->add_control(
            'edcare_info_list',
            [
                'label' => esc_html__( 'Info - List', 'edcare-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'info_title' => __( 'Book Free Consultation', 'edcare-core' ),
                        'info_description' => __( 'Standards in leadership skills synergize <br> optimal expertise rather than innovative <br> leadership skills.', 'edcare-core' ),
                        'wow_delay' => '200',
                    ],
                    [
                        'info_title' => __( 'Make Easy Payment', 'edcare-core' ),
                        'info_description' => __( 'Standards in leadership skills synergize <br> optimal expertise rather than innovative <br> leadership skills.', 'edcare-core' ),
                        'wow_delay' => '400',
                    ],
                    [
                        'info_title' => __( 'Schedule First Lesson', 'edcare-core' ),
                        'info_description' => __( 'Standards in leadership skills synergize <br> optimal expertise rather than innovative <br> leadership skills.', 'edcare-core' ),
                        'wow_delay' => '500',
                    ],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_info_list_two',
            [
                'label' => esc_html__( 'Info List', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
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

        $repeater->add_control(
            'why_choose_us_icon',
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

        $repeater->add_control(
            'why_choose_us_image_icon',
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

        $repeater->add_control(
            'info_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'info_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'wow_delay',
            [
                'label' => esc_html__( 'Animation Delay', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '100' => esc_html__( '100', 'text-domain' ),
                    '200' => esc_html__( '200', 'text-domain' ),
                    '300' => esc_html__( '300', 'text-domain' ),
                    '400' => esc_html__( '400', 'text-domain' ),
                    '500' => esc_html__( '500', 'text-domain' ),
                    '600' => esc_html__( '600', 'text-domain' ),
                    '700' => esc_html__( '700', 'text-domain' ),
                    '800' => esc_html__( '800', 'text-domain' ),
                    '900' => esc_html__( '900', 'text-domain' ),
                ],
            ]
        );

        $this->add_control(
            'edcare_info_list_two',
            [
                'label' => esc_html__( 'Info - List', 'edcare-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'info_title' => __( 'Book Free Consultation', 'edcare-core' ),
                        'info_description' => __( 'Standards in leadership skills synergize <br> optimal expertise rather than innovative <br> leadership skills.', 'edcare-core' ),
                        'wow_delay' => '600',
                    ],
                    [
                        'info_title' => __( 'Make Easy Payment', 'edcare-core' ),
                        'info_description' => __( 'Standards in leadership skills synergize <br> optimal expertise rather than innovative <br> leadership skills.', 'edcare-core' ),
                        'wow_delay' => '700',
                    ],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_column',
            [
                'label' => esc_html__( 'Column',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );
        
        $this->add_control(
            'column_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'edcare-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                    1 => esc_html__( '12 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => 4,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'column_laptop',
            [
                'label' => esc_html__( 'Columns for Large', 'edcare-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                    1 => esc_html__( '12 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => 4,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'column_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'edcare-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                    1 => esc_html__( '12 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => 6,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'column_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'edcare-core' ),
                'description' => esc_html__( 'Screen width less than 767px', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                    1 => esc_html__( '12 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => 12,
                'style_transfer' => true,
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_design_layout',
            [
                'label' => __( 'Design Layout', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
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
                'label' => esc_html__( 'Title & Content', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
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
                    '{{WRAPPER}} .edcare-el-section-subheading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'section_subheading_border',
                'selector' => '{{WRAPPER}} .edcare-el-section-subheading',
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
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_subheading_typography',
                'selector' => '{{WRAPPER}} .edcare-el-section-subheading',
            ]
        );

        $this->add_control(
            '_heading_style_section_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'edcare-core' ),
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
                'label' => esc_html__( 'Color', 'edcare-core' ),
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
            '_heading_style_section_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_description_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'section_description_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .edcare-el-section-description',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->end_controls_section();
    
        // TAB_STYLE
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
                    '{{WRAPPER}} .promo-item .promo-thumb .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .content-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .choose-use-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ] 
        );

        $this->start_controls_tabs( 'info_list_icon_tabs' );
        
        $this->start_controls_tab(
            'info_list_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'info_list_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item .promo-thumb .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content-item .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'info_list_icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item .promo-thumb .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .content-item .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_list_icon_border',
                'selector' => '{{WRAPPER}} .promo-item .promo-thumb .icon, .content-item .icon, .choose-use-item .icon',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'info_list_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'info_list_icon_color_hover',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item:hover .promo-thumb .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content-item:hover .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item:hover .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'info_list_icon_background_hover',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item:hover .promo-thumb .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .content-item:hover .icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item:hover .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_list_icon_border_hover',
                'selector' => '{{WRAPPER}} .promo-item:hover .promo-thumb .icon, .content-item:hover .icon, .choose-use-item:hover .icon',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'info_list_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .promo-item .promo-thumb .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .content-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .choose-use-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .promo-item .promo-thumb .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .content-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .choose-use-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .promo-item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .content-item .content h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .choose-use-item .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'info_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content-item .content h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item .content .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'info_title_color_hover',
            [
                'label' => esc_html__( 'Color (Hover)', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-item:hover .content h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item:hover .content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_title_typography',
                'selector' => '{{WRAPPER}} .promo-item .title, .content-item .content h4, .choose-use-item .content .title',
            ]
        );

        $this->add_control(
            '_heading_style_info_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
                    '{{WRAPPER}} .choose-use-item .content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .choose-use-item .content p' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .choose-use-item:hover .content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_description_typography',
                'selector' => '{{WRAPPER}} .promo-item p, .content-item .content p, .choose-use-item:hover .content p',
            ]
        );

        $this->add_control(
            '_heading_style_info_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'info_layout_border_color_two',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .promo-item' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->start_controls_tabs( 'info_layout_tabs' );
        
        $this->start_controls_tab(
            'info_layout_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
                'condition' => [
                    'design_style' =>  [ 'layout-2', 'layout-3' ],
                ],
            ]
        );
        
        $this->add_control(
            'info_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-item' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_layout_border',
                'selector' => '{{WRAPPER}} .content-item',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'info_layout_box_shadow',
                'selector' => '{{WRAPPER}} .content-item',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'info_layout_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
                'condition' => [
                    'design_style' =>  [ 'layout-2', 'layout-3' ],
                ],
            ]
        );
        
        $this->add_control(
            'info_layout_background_hover',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-item:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_layout_border_hover',
                'selector' => '{{WRAPPER}} .content-item:hover',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'info_layout_box_shadow_hover',
                'selector' => '{{WRAPPER}} .content-item:hover',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'info_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .content-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_layout_margin',
            [
                'label' => esc_html__( 'Margin', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .content-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .content-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_line',
            [
                'label' => esc_html__( 'Line', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'info_line_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .choose-us-wrap .line',
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'info_line_background_two',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .choose-use-item .line-shape',
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_control(
            'info_line_border_color',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choose-use-item .line-shape .top-round' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item:hover .line-shape .bottom-round' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .choose-use-item .line-shape .bottom-round:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-3',
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
		$settings = $this->get_settings_for_display(); ?>

        <?php if ( $settings['design_style']  == 'layout-1' ) : ?>

            <section class="promo-section pt-120 pb-120 overflow-hidden">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="bg-item">
                        <div class="bg-shape-1"></div>
                        <div class="bg-shape-2"></div>
                    </div>
                    <div class="shapes">
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/promo-shape-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/promo-shape-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="section-heading promo-heading text-center white-content">
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
                                <?php echo edcare_kses($settings['section_subheading']); ?>
                            </h4>
                        <?php endif; ?>
                        <?php if ( !empty( $settings['section_title'] ) ) : ?>
                            <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                <?php echo edcare_kses($settings['section_title']); ?>
                            </h2>
                        <?php endif; ?>
                    </div>
                    <div class="row gy-lg-0 gy-4 justify-content-center promo-wrap">
                        <?php foreach ($settings['edcare_info_list'] as $key => $item) : 
                            $key_class = 'item-' . ( $key + 1 );
                            if ( !empty($item['why_choose_us_image']['url']) ) {
                                $why_choose_us_image = !empty($item['why_choose_us_image']['id']) ? wp_get_attachment_image_url( $item['why_choose_us_image']['id'], 'full') : $item['why_choose_us_image']['url'];
                                $why_choose_us_image_alt = get_post_meta($item["why_choose_us_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            if ( !empty($item['why_choose_us_image_icon']['url']) ) {
                                $why_choose_us_image_icon = !empty($item['why_choose_us_image_icon']['id']) ? wp_get_attachment_image_url( $item['why_choose_us_image_icon']['id'], 'full') : $item['why_choose_us_image_icon']['url'];
                                $why_choose_us_image_icon_alt = get_post_meta($item["why_choose_us_image_icon"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                        <div class="col-xl-<?php print esc_attr($settings['column_desktop']); ?> col-lg-<?php print esc_attr($settings['column_laptop']); ?> col-md-<?php print esc_attr($settings['column_tablet']); ?> col-sm-<?php print esc_attr($settings['column_mobile']); ?>">
                            <div class="promo-item <?php print esc_attr($key_class); ?> white-content wow fade-in-bottom" data-wow-delay="<?php print esc_attr($item['wow_delay']); ?>">
                                <div class="promo-thumb">
                                    <?php if ( !empty( $why_choose_us_image ) ) : ?>
                                        <img class="main-img" src="<?php print esc_url($why_choose_us_image); ?>" alt="<?php print esc_attr($why_choose_us_image_alt); ?>">
                                    <?php endif; ?>
                                    <?php if ( 'icon' === $item['icon_type'] ) : ?>
                                        <div class="icon">
                                            <?php edcare_render_icon($item, 'why_choose_us_icon'); ?>
                                        </div>
                                    <?php elseif ( 'image' === $item['icon_type'] ) : ?>
                                        <div class="icon">
                                            <img src="<?php echo esc_url( $why_choose_us_image_icon ); ?>" alt="<?php echo esc_attr( $why_choose_us_image_icon_alt ); ?>">
                                        </div>
                                    <?php endif;?>
                                </div>
                                <?php if ( !empty( $item['info_title'] ) ) : ?>
                                    <h3 class="title">
                                        <?php print edcare_kses($item['info_title']); ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if ( !empty( $item['info_description'] ) ) : ?>
                                    <p><?php print edcare_kses($item['info_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : 
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

            <section class="edcare-el-section content-section pt-120 pb-120 overflow-hidden">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="content-img-wrap wow fade-in-left" data-wow-delay="400ms">
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
                        </div>
                        <div class="col-lg-6">
                            <div class="content-info">
                                <div class="section-heading mb-20">
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
                                            <?php echo edcare_kses($settings['section_subheading']); ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['section_title'] ) ) : ?>
                                        <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                            <?php echo edcare_kses($settings['section_title']); ?>
                                        </h2>
                                    <?php endif; ?>
                                </div>
                                <?php if ( !empty( $settings['section_description'] ) ) : ?>
                                    <p class="edcare-el-section-description mb-30 wow fade-in-bottom" data-wow-delay="500ms">
                                        <?php echo edcare_kses($settings['section_description']); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <?php
                                    $total_items = count($settings['edcare_info_list_two']);
                                    foreach ($settings['edcare_info_list_two'] as $key => $item) : 
                                    $margin_class = ($key === $total_items - 1) ? 'mb-0' : 'mb-30';
                                    if ( !empty($item['why_choose_us_image']['url']) ) {
                                        $why_choose_us_image = !empty($item['why_choose_us_image']['id']) ? wp_get_attachment_image_url( $item['why_choose_us_image']['id'], 'full') : $item['why_choose_us_image']['url'];
                                        $why_choose_us_image_alt = get_post_meta($item["why_choose_us_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    if ( !empty($item['why_choose_us_image_icon']['url']) ) {
                                        $why_choose_us_image_icon = !empty($item['why_choose_us_image_icon']['id']) ? wp_get_attachment_image_url( $item['why_choose_us_image_icon']['id'], 'full') : $item['why_choose_us_image_icon']['url'];
                                        $why_choose_us_image_icon_alt = get_post_meta($item["why_choose_us_image_icon"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                <div class="content-item <?php print esc_attr($margin_class); ?> wow fade-in-bottom" data-wow-delay="<?php print esc_attr($item['wow_delay']); ?>">
                                    <?php if ( 'icon' === $item['icon_type'] ) : ?>
                                        <div class="icon">
                                            <?php edcare_render_icon($item, 'why_choose_us_icon'); ?>
                                        </div>
                                    <?php elseif ( 'image' === $item['icon_type'] ) : ?>
                                        <div class="icon">
                                            <img src="<?php echo esc_url( $why_choose_us_image_icon ); ?>" alt="<?php echo esc_attr( $why_choose_us_image_icon_alt ); ?>">
                                        </div>
                                    <?php endif;?>
                                    <div class="content">
                                        <?php if ( !empty( $item['info_title'] ) ) : ?>
                                            <h4 class="title">
                                                <?php print edcare_kses($item['info_title']); ?>
                                            </h4>
                                        <?php endif; ?>
                                        <?php if ( !empty( $item['info_description'] ) ) : ?>
                                            <p><?php print edcare_kses($item['info_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-3' ) : 
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

                <div class="row choose-us-wrap gy-lg-0 gy-4 justify-content-center">
                    <div class="line"></div>
                    <?php foreach ($settings['edcare_info_list'] as $key => $item) : 
                        $key_class = 'item-' . ( $key + 1 );
                        if ( !empty($item['why_choose_us_image']['url']) ) {
                            $why_choose_us_image = !empty($item['why_choose_us_image']['id']) ? wp_get_attachment_image_url( $item['why_choose_us_image']['id'], 'full') : $item['why_choose_us_image']['url'];
                            $why_choose_us_image_alt = get_post_meta($item["why_choose_us_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        if ( !empty($item['why_choose_us_image_icon']['url']) ) {
                            $why_choose_us_image_icon = !empty($item['why_choose_us_image_icon']['id']) ? wp_get_attachment_image_url( $item['why_choose_us_image_icon']['id'], 'full') : $item['why_choose_us_image_icon']['url'];
                            $why_choose_us_image_icon_alt = get_post_meta($item["why_choose_us_image_icon"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="choose-use-item <?php print esc_attr($key_class); ?>">
                            <div class="line-shape">
                                <span class="top-round"></span>
                                <span class="bottom-round"></span>
                            </div>
                            <?php if ( 'icon' === $item['icon_type'] ) : ?>
                                <div class="icon">
                                    <?php edcare_render_icon($item, 'why_choose_us_icon'); ?>
                                </div>
                            <?php elseif ( 'image' === $item['icon_type'] ) : ?>
                                <div class="icon">
                                    <img src="<?php echo esc_url( $why_choose_us_image_icon ); ?>" alt="<?php echo esc_attr( $why_choose_us_image_icon_alt ); ?>">
                                </div>
                            <?php endif;?>
                            <div class="content">
                                <?php if ( !empty( $item['info_title'] ) ) : ?>
                                    <h4 class="title">
                                        <?php print edcare_kses($item['info_title']); ?>
                                    </h4>
                                <?php endif; ?>
                                <?php if ( !empty( $item['info_description'] ) ) : ?>
                                    <p><?php print edcare_kses($item['info_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>

        <?php endif;
	}

}

$widgets_manager->register( new EdCare_Why_Choose_Us() );