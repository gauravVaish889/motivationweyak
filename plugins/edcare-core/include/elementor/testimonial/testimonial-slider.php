<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 * @since 1.0.0
 */
class EdCare_Testimonial_Slider extends Widget_Base {

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
		return 'edcare_testimonial_slider';
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
		return __( 'Testimonial Slider', 'edcare-core' );
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
                'label' => esc_html__( 'Design Layout', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => esc_html__( 'Style', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'layout-1',
                'options' => [
                    'layout-1' => esc_html__( 'Layout 1', 'edcare-core' ),
                    'layout-2' => esc_html__( 'Layout 2', 'edcare-core' ),
                    'layout-3' => esc_html__( 'Layout 3', 'edcare-core' ),
                    'layout-4' => esc_html__( 'Layout 4', 'edcare-core' ),
                ],
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => esc_html__( 'Shape ON/OFF', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edcare-core' ),
                'label_off' => esc_html__( 'Hide', 'edcare-core' ),
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
                'label' => esc_html__( 'Title & Content',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
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
                'default' => __( 'Testimonials', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'What our clients <br> says about our <br> best work.', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Empowering businesses with cutting-edge technology, reliable support, and seamless integration.', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_testimonial_list_one',
            [
                'label' => esc_html__( 'Testimonial List', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__( 'Testimonial Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_name', [
                'label' => esc_html__( 'Name', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Rashal Khan' , 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_designation', [
                'label' => esc_html__( 'Position', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Founder' , 'edcare-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'testimonial_description',
            [
                'label' => esc_html__( 'Content', 'edcare-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'Hiring managers are busy people, so you need to make yourout the crowd as quickly as possible. In the first section. This should headline achievements', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'testimonial_list_one',
            [
                'label' => esc_html__( 'Testimonial List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_name' => esc_html__( 'Indigo Violet', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, Thump Coffee', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Morbi consectetur elementum purus mattis cursus purus metus iaculis sagittis. Vestibulum molestie bibendum turpis luctus sem lacinia quis. Quisque amet velit sit amet dui hendrerit ultricies a id ipsum Mauris sit amet lacinia
                        est”', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => esc_html__( 'Michael Thomas', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, Plan4Demand', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec euismod, sapien ac fringilla tincidunt, eros nisl ultricies justo, a tincidunt eros mi ut velit. Mauris semper, massa eu semper
                        mollis, tortor eros tristique erat, id lacinia lectus quam eu arcu.”', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => esc_html__( 'Matthew Martin', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, Hobby Lobby', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Vivamus sit amet risus vitae leo semper semper. Nullam vel ligula et purus egestas semper. Phasellus ac elit eget quam pulvinar gravida. Sed mattis, nisi vel ullamcorper semper, tortor mauris fringilla sem, a gravida eros nulla
                        sed augue. Donec elementum.”', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => esc_html__( 'Julian Walker', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, 7Eleven', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Vestibulum quis magna sed ligula lacinia vehicula. Nunc ac semper dolor. Donec ut quam eget augue semper iaculis. Vivamus egestas quam erat, eu tincidunt eros ultrices et. Donec iaculis, tellus a semper ultricies, enim tortor
                        luctus nunc, et aliquam quam urna eu quam.”', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => esc_html__( 'Henry Baker', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, Puzzle Huddle', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Sed ac sapien eu enim ultricies faucibus. Nulla facilisi. Nunc et orci id sem interdum congue. Sed ac felis sit amet nisi faucibus bibendum. In hac habitasse platea dictumst.”', 'edcare-core' ),
                    ],

                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_testimonial_list_two',
            [
                'label' => esc_html__( 'Testimonial List', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['layout-2', 'layout-4'],
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__( 'Testimonial Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_title_review',
            [
                'label' => esc_html__( 'Testimonail Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Need Personalized Learning', 'edcare-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_name', [
                'label' => esc_html__( 'Name', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Rashal Khan' , 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_designation', [
                'label' => esc_html__( 'Position', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Founder' , 'edcare-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'testimonial_description',
            [
                'label' => esc_html__( 'Content', 'edcare-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'Hiring managers are busy people, so you need to make yourout the crowd as quickly as possible. In the first section. This should headline achievements', 'edcare-core' ),
            ]
        );

        $repeater->add_control(
            'testimonial_rating',
            [
                'label' => esc_html__( 'Rating', 'edcare-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => .1,
                'max' => 5,
                'step' => .1,
                'default' => 5,
            ]
        );

        $this->add_control(
            'testimonial_list_two',
            [
                'label' => esc_html__( 'Testimonial List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_name' => esc_html__( 'Indigo Violet', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, Thump Coffee', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Morbi consectetur elementum purus mattis cursus purus metus iaculis sagittis. Vestibulum molestie bibendum turpis luctus sem lacinia quis. Quisque amet velit sit amet dui hendrerit ultricies a id ipsum Mauris sit amet lacinia
                        est”', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => esc_html__( 'Michael Thomas', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, Plan4Demand', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec euismod, sapien ac fringilla tincidunt, eros nisl ultricies justo, a tincidunt eros mi ut velit. Mauris semper, massa eu semper
                        mollis, tortor eros tristique erat, id lacinia lectus quam eu arcu.”', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => esc_html__( 'Matthew Martin', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, Hobby Lobby', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Vivamus sit amet risus vitae leo semper semper. Nullam vel ligula et purus egestas semper. Phasellus ac elit eget quam pulvinar gravida. Sed mattis, nisi vel ullamcorper semper, tortor mauris fringilla sem, a gravida eros nulla
                        sed augue. Donec elementum.”', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => esc_html__( 'Julian Walker', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, 7Eleven', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Vestibulum quis magna sed ligula lacinia vehicula. Nunc ac semper dolor. Donec ut quam eget augue semper iaculis. Vivamus egestas quam erat, eu tincidunt eros ultrices et. Donec iaculis, tellus a semper ultricies, enim tortor
                        luctus nunc, et aliquam quam urna eu quam.”', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => esc_html__( 'Henry Baker', 'edcare-core' ),
                        'testimonial_designation' => esc_html__( 'Director, Puzzle Huddle', 'edcare-core' ),
                        'testimonial_description' => esc_html__( '“Sed ac sapien eu enim ultricies faucibus. Nulla facilisi. Nunc et orci id sem interdum congue. Sed ac felis sit amet nisi faucibus bibendum. In hac habitasse platea dictumst.”', 'edcare-core' ),
                    ],

                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_testimonial_list_three',
            [
                'label' => esc_html__( 'Testimonial List', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__( 'Testimonial Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_name', [
                'label' => esc_html__( 'Name', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Rashal Khan' , 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_designation', [
                'label' => esc_html__( 'Position', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Founder' , 'edcare-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'testimonial_description',
            [
                'label' => esc_html__( 'Content', 'edcare-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'Hiring managers are busy people, so you need to make yourout the crowd as quickly as possible. In the first section. This should headline achievements', 'edcare-core' ),
            ]
        );

        $repeater->add_control(
            'testimonial_review_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonial_list_three',
            [
                'label' => esc_html__( 'Testimonial List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_name' => __( 'Indigo Violet', 'edcare-core' ),
                        'testimonial_designation' => __( 'Director, Thump Coffee', 'edcare-core' ),
                        'testimonial_description' => __( '“Morbi consectetur elementum purus mattis cursus purus metus iaculis sagittis. Vestibulum molestie bibendum turpis luctus sem lacinia quis. Quisque amet velit sit amet dui hendrerit ultricies a id ipsum Mauris sit amet lacinia
                        est”', 'edcare-core' ),
                        'testimonial_review_title' => __( 'Interactive Learning Experience', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => __( 'Michael Thomas', 'edcare-core' ),
                        'testimonial_designation' => __( 'Director, Plan4Demand', 'edcare-core' ),
                        'testimonial_description' => __( '“Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec euismod, sapien ac fringilla tincidunt, eros nisl ultricies justo, a tincidunt eros mi ut velit. Mauris semper, massa eu semper
                        mollis, tortor eros tristique erat, id lacinia lectus quam eu arcu.”', 'edcare-core' ),
                        'testimonial_review_title' => __( 'Interactive Learning Experience', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => __( 'Matthew Martin', 'edcare-core' ),
                        'testimonial_designation' => __( 'Director, Hobby Lobby', 'edcare-core' ),
                        'testimonial_description' => __( '“Vivamus sit amet risus vitae leo semper semper. Nullam vel ligula et purus egestas semper. Phasellus ac elit eget quam pulvinar gravida. Sed mattis, nisi vel ullamcorper semper, tortor mauris fringilla sem, a gravida eros nulla
                        sed augue. Donec elementum.”', 'edcare-core' ),
                        'testimonial_review_title' => __( 'Interactive Learning Experience', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => __( 'Julian Walker', 'edcare-core' ),
                        'testimonial_designation' => __( 'Director, 7Eleven', 'edcare-core' ),
                        'testimonial_description' => __( '“Vestibulum quis magna sed ligula lacinia vehicula. Nunc ac semper dolor. Donec ut quam eget augue semper iaculis. Vivamus egestas quam erat, eu tincidunt eros ultrices et. Donec iaculis, tellus a semper ultricies, enim tortor
                        luctus nunc, et aliquam quam urna eu quam.”', 'edcare-core' ),
                        'testimonial_review_title' => __( 'Interactive Learning Experience', 'edcare-core' ),
                    ],
                    [
                        'testimonial_name' => __( 'Henry Baker', 'edcare-core' ),
                        'testimonial_designation' => __( 'Director, Puzzle Huddle', 'edcare-core' ),
                        'testimonial_description' => __( '“Sed ac sapien eu enim ultricies faucibus. Nulla facilisi. Nunc et orci id sem interdum congue. Sed ac felis sit amet nisi faucibus bibendum. In hac habitasse platea dictumst.”', 'edcare-core' ),
                        'testimonial_review_title' => __( 'Interactive Learning Experience', 'edcare-core' ),
                    ],

                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->end_controls_section();


        // Design Layout Style
		$this->start_controls_section(
			'_style_design_layout',
			[
				'label' => __( 'Design Layout', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
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

        $this->add_control(
            '_heading_style_slider_navigation',
            [
                'label' => esc_html__( 'Arrow / Dots', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_slider_navigation' );

        $this->start_controls_tab(
            'slider_navigation_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'slider_navigation_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel-wrap-2 .swiper-arrow .swiper-nav' => 'color: {{VALUE}}!important',
                ],
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_control(
            'slider_navigation_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel-wrap-2 .swiper-arrow .swiper-nav' => 'background-color: {{VALUE}}!important',
                ],
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_control(
            'slider_navigation_border_color',
            [
                'label' => esc_html__( 'Border Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel .swiper-pagination .swiper-pagination-bullet' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .testi-carousel-wrap-2 .swiper-arrow .swiper-nav' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'slider_navigation_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'slider_navigation_color_hover',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel-wrap-2 .swiper-arrow .swiper-nav:hover' => 'color: {{VALUE}}!important',
                ],
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_control(
            'slider_navigation_background_hover',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel .swiper-pagination .swiper-pagination-bullet:before' => 'background-color: {{VALUE}}!important',
                    '{{WRAPPER}} .testi-carousel-wrap-2 .swiper-arrow .swiper-nav:hover' => 'background-color: {{VALUE}}!important',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'slider_navigation_border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-carousel .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .testi-carousel-wrap-2 .swiper-arrow .swiper-nav:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();

        // Title & Content
        $this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title & Content',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => ['layout-1', 'layout-2', 'layout-3'],
                ],
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
                    '{{WRAPPER}} .edcare-el-section-subheading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_subheading_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-subheading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'section_subheading_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
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
                'label' => esc_html__( 'Padding', 'edcare-core' ),
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
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
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

        $this->add_control(
            '_heading_style_section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-3',
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
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .edcare-el-section-description',
            ]
        );

        $this->end_controls_section();

        // Testimonial List Style
        $this->start_controls_section(
			'_style_testimonial_list',
			[
				'label' => __( 'Testimonial List', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            '_heading_style_testimonial_name',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Name', 'edcare-core' ),
            ]
        );

        $this->add_responsive_control(
            'testimonial_name_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .testi-item .testi-author .name span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-2 .testi-bottom .author-info .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-3 .testi-author .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-4 .testi-author .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_name_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-item .testi-author .name' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-2 .testi-bottom .author-info .name' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-3 .testi-author .name' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-4 .testi-author .name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_name_typography',
                'selector' => '{{WRAPPER}} .testi-item .testi-author .name, .testi-item-2 .testi-bottom .author-info .name, .testi-item-3 .testi-author .name, .testi-item-4 .testi-author .name',
            ]
        );

        $this->add_control(
            '_heading_testimonial_designation',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Designation', 'edcare-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'testimonial_designation_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-item .testi-author .name span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-2 .testi-bottom .author-info span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-3 .testi-author .name span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-4 .testi-author .name span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_designation_typography',
                'selector' => '.testi-item .testi-author .name span, .testi-item-2 .testi-bottom .author-info span, .testi-item-3 .testi-author .name span, .testi-item-4 .testi-author .name span',
            ]
        );

        $this->add_control(
            '_content_testimonial_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'testimonial_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .testi-item p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-2 .testi-top-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-3 p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-4 p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_description_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-item p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-2 .testi-top-content p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-3 p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-4 p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_description_typography',
                'selector' => '{{WRAPPER}} .testi-item p, .testi-item-2 .testi-top-content p, .testi-item-3 p, .testi-item-4 p',
            ]
        );

        $this->add_control(
            '_heading_style_testimonial_rating',
            [
                'label' => esc_html__( 'Rating', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => ['layout-2', 'layout-4'],
                ],
            ]
        );

        $this->add_control(
            'testimonial_rating_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-item-2 .testi-bottom .testi-review li' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-4 .testi-bottom .testi-review li' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['layout-2', 'layout-4'],
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_rating_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-item-2 .testi-bottom .testi-review li' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-4 .testi-bottom .testi-review li' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => ['layout-2', 'layout-4'],
                ],
            ]
        );

        $this->add_control(
            '_heading_style_testimonial_review_title',
            [
                'label' => esc_html__( 'Review Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => ['layout-3', 'layout-4'],
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_review_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-item-3 .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-4 .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => ['layout-3', 'layout-4'],
                ],
            ]
        );

        $this->add_control(
            'testimonial_review_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-item-3 .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-4 .title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['layout-3', 'layout-4'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_review_title_typography',
                'selector' => '{{WRAPPER}} .testi-item-3 .title, .testi-item-4 .title',
                'condition' => [
                    'design_style' => ['layout-3', 'layout-4'],
                ],
            ]
        );

        $this->add_control(
            '_heading_style_testimonial_list',
            [
                'label' => esc_html__( 'Layout', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'testimonial_list_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-item' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-2' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-3' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-4' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'testimonial_list_border_color',
            [
                'label' => esc_html__( 'Border Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testi-item-2' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-2 .testi-top-content' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .testi-item-4 .testi-bottom' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => ['layout-2', 'layout-4'],
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_list_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_list_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testi-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testi-item-4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

            <section class="edcare-el-section testimonial-section pt-120 pb-120">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/testi-shape-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/testi-shape-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="section-heading white-content text-center">
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
                            <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                <?php print edcare_kses($settings['section_title']); ?>
                            </h2>
                        <?php endif; ?>
                    </div>
                    <div class="testi-carousel-3 swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['testimonial_list_one'] as $index => $item) :
                                if ( !empty($item['testimonial_image']['url']) ) {
                                    $testimonial_image = !empty($item['testimonial_image']['id']) ? wp_get_attachment_image_url( $item['testimonial_image']['id']) : $item['testimonial_image']['url'];
                                    $testimonial_image_alt = get_post_meta($item["testimonial_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                            <div class="swiper-slide">
                                <div class="testi-item">
                                    <?php if ( !empty( $item['testimonial_title'] ) ) : ?>
                                        <h3 class="title">
                                            <?php echo edcare_kses($item['testimonial_title']); ?>
                                        </h3>
                                    <?php endif; ?>
                                    <?php if ( !empty( $item['testimonial_description'] ) ) : ?>
                                        <p><?php echo edcare_kses($item['testimonial_description']); ?></p>
                                    <?php endif; ?>
                                    <div class="testi-author">
                                        <?php if ( !empty( $testimonial_image ) ) : ?>
                                            <div class="author-img">
                                                <img src="<?php echo esc_url($testimonial_image); ?>" alt="<?php echo esc_url($testimonial_image_alt); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <h4 class="name">
                                            <?php echo edcare_kses($item['testimonial_name']); ?>
                                            <?php if ( !empty( $item['testimonial_designation'] ) ) : ?>
                                                <span><?php echo edcare_kses($item['testimonial_designation']); ?></span>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php elseif ( $settings['design_style']  == 'layout-2' ):
                if ( !empty($settings['testimonial_image']['url']) ) {
                    $edcare_testimonial_image = !empty($settings['testimonial_image']['id']) ? wp_get_attachment_image_url( $settings['testimonial_image']['id']) : $settings['testimonial_image']['url'];
                    $edcare_testimonial_image_alt = get_post_meta($settings["testimonial_image"]["id"], "_wp_attachment_image_alt", true);
                }
            ?>

                <section class="edcare-el-section testimonial-section-2">
                    <div class="container">
                        <div class="section-heading text-center">
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
                                <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                    <?php print edcare_kses($settings['section_title']); ?>
                                </h2>
                            <?php endif; ?>
                        </div>
                        <div class="testi-carousel swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['testimonial_list_two'] as $index => $item) :
                                    if ( !empty($item['testimonial_image']['url']) ) {
                                        $testimonial_image = !empty($item['testimonial_image']['id']) ? wp_get_attachment_image_url( $item['testimonial_image']['id']) : $item['testimonial_image']['url'];
                                        $testimonial_image_alt = get_post_meta($item["testimonial_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                <div class="swiper-slide">
                                    <div class="testi-item-2">
                                        <div class="testi-top-content">
                                            <?php if ( !empty( $testimonial_image ) ) : ?>
                                                <div class="testi-thumb">
                                                    <img src="<?php echo esc_url($testimonial_image); ?>" alt="<?php echo esc_attr($testimonial_image_alt); ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php if ( !empty( $item['testimonial_description'] ) ) : ?>
                                                <p><?php echo edcare_kses($item['testimonial_description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="testi-bottom">
                                            <div class="author-info">
                                                <?php if ( !empty( $item['testimonial_name'] ) ) : ?>
                                                    <h4 class="name">
                                                        <?php echo edcare_kses($item['testimonial_name']); ?>
                                                    </h4>
                                                <?php endif; ?>
                                                <?php if ( !empty( $item['testimonial_designation'] ) ) : ?>
                                                    <span><?php echo edcare_kses($item['testimonial_designation']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <ul class="testi-review" data-rate="<?php print esc_attr($item['testimonial_rating']); ?>">
                                                <li class="star-container"><i class="fa-regular fa-star"></i></li>
                                                <li class="star-container"><i class="fa-regular fa-star"></i></li>
                                                <li class="star-container"><i class="fa-regular fa-star"></i></li>
                                                <li class="star-container"><i class="fa-regular fa-star"></i></li>
                                                <li class="star-container"><i class="fa-regular fa-star"></i></li>
                                                <li class="point">(<?php print esc_attr($item['testimonial_rating']); ?>)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </section>

            <?php elseif ( $settings['design_style']  == 'layout-3' ) : ?>

                <section class="edcare-el-section testimonial-section-3 pt-120 pb-120">
                    <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                        <div class="shapes">
                            <div class="shape shape-1">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/testi-shape-3.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                            </div>
                            <div class="shape shape-2">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/testi-shape-4.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="container">
                        <div class="row gy-xl-0 gy-5 align-items-center">
                            <div class="col-xl-5 col-lg-12">
                                <div class="testi-left-content white-content">
                                    <div class="section-heading mb-20 white-content">
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
                                            <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                                <?php print edcare_kses($settings['section_title']); ?>
                                            </h2>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ( !empty( $settings['section_description'] ) ) : ?>
                                        <p class="edcare-el-section-description mb-0 wow fade-in-bottom" data-wow-delay="500ms">
                                            <?php print edcare_kses($settings['section_description']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-12">
                                <div class="testi-carousel-wrap-2">
                                    <div class="testi-carousel-2 swiper">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($settings['testimonial_list_three'] as $index => $item) :
                                                if ( !empty($item['testimonial_image']['url']) ) {
                                                    $testimonial_image = !empty($item['testimonial_image']['id']) ? wp_get_attachment_image_url( $item['testimonial_image']['id']) : $item['testimonial_image']['url'];
                                                    $testimonial_image_alt = get_post_meta($item["testimonial_image"]["id"], "_wp_attachment_image_alt", true);
                                                }
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="testi-item-3">
                                                    <?php if ( !empty( $item['testimonial_review_title'] ) ) : ?>
                                                        <h3 class="title">
                                                            <?php print edcare_kses($item['testimonial_review_title']); ?>
                                                        </h3>
                                                    <?php endif; ?>
                                                    <?php if ( !empty( $item['testimonial_description'] ) ) : ?>
                                                        <p><?php echo edcare_kses($item['testimonial_description']); ?></p>
                                                    <?php endif; ?>
                                                    <div class="testi-author">
                                                        <?php if ( !empty( $testimonial_image ) ) : ?>
                                                            <div class="testi-author-img">
                                                                <img src="<?php echo esc_url($testimonial_image); ?>" alt="<?php echo esc_attr($testimonial_image_alt); ?>">
                                                            </div>
                                                        <?php endif; ?>
                                                        <h4 class="name">
                                                            <?php echo edcare_kses($item['testimonial_name']); ?>
                                                            <?php if ( !empty( $item['testimonial_designation'] ) ) : ?>
                                                                <span>
                                                                    <?php echo edcare_kses($item['testimonial_designation']); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="swiper-arrow">
                                        <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-left"></i></div>
                                        <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif ( $settings['design_style']  == 'layout-4' ) :
                if ( !empty($settings['testimonial_image']['url']) ) {
                    $edcare_testimonial_image = !empty($settings['testimonial_image']['id']) ? wp_get_attachment_image_url( $settings['testimonial_image']['id']) : $settings['testimonial_image']['url'];
                    $edcare_testimonial_image_alt = get_post_meta($settings["testimonial_image"]["id"], "_wp_attachment_image_alt", true);
                }
            ?>

            <section class="testimonial-section-6 edcare-el-section">
                <div class="container">
                    <div class="testi-carousel-4 swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['testimonial_list_two'] as $index => $item) :
                                if ( !empty($item['testimonial_image']['url']) ) {
                                    $testimonial_image = !empty($item['testimonial_image']['id']) ? wp_get_attachment_image_url( $item['testimonial_image']['id']) : $item['testimonial_image']['url'];
                                    $testimonial_image_alt = get_post_meta($item["testimonial_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                            <div class="swiper-slide">
                                <div class="testi-item testi-item-4">
                                    <?php if ( !empty( $item['testimonial_title_review'] ) ) : ?>
                                    <h3 class="title"><?php echo edcare_kses($item['testimonial_title_review']); ?></h3>
                                    <?php endif; ?>

                                    <?php if ( !empty( $item['testimonial_description'] ) ) : ?>
                                        <p><?php echo edcare_kses($item['testimonial_description']); ?></p>
                                    <?php endif; ?>

                                    <div class="testi-bottom">
                                        <div class="testi-author">
                                            <?php if ( !empty( $testimonial_image ) ) : ?>
                                            <div class="author-img">
                                                <img src="<?php echo esc_url($testimonial_image); ?>" alt="<?php echo esc_attr($testimonial_image_alt); ?>">
                                            </div>
                                            <?php endif; ?>

                                            <h4 class="name">
                                                <?php if ( !empty( $item['testimonial_name'] ) ) : ?>
                                                    <?php echo edcare_kses($item['testimonial_name']); ?>
                                                <?php endif; ?>

                                                <?php if ( !empty( $item['testimonial_designation'] ) ) : ?>
                                                <span><?php echo edcare_kses($item['testimonial_designation']); ?></span>
                                                <?php endif; ?>
                                            </h4>
                                        </div>

                                        <ul class="testi-review" data-rate="<?php print esc_attr($item['testimonial_rating']); ?>">
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                            <li class="point"> (<?php print esc_attr($item['testimonial_rating']); ?>)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>

            <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new EdCare_Testimonial_Slider() );