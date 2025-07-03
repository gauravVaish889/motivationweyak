<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
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
class EdCare_Hero_Banner extends Widget_Base {

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
		return 'edcare_hero_banner';
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
		return __( 'Hero Banner', 'edcare-core' );
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
                    'layout-4' => esc_html__('Layout 4', 'edcare-core'),
                    'layout-5' => esc_html__('Layout 5', 'edcare-core'),
                    'layout-6' => esc_html__('Layout 6', 'edcare-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'hero_image',
            [
                'label' => esc_html__( 'Choose Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'hero_image_two',
            [
                'label' => esc_html__( 'Choose Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => 'layout-5',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_shape',
            [
                'label' => esc_html__( 'Shape',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
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
            ]
        );

        $this->add_control(
            'shape_one',
            [
                'label' => esc_html__( 'Shape One', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'shape_switch' => 'yes',
                    'design_style' => 'layout-6',
                ],
            ]
        );

        $this->add_control(
            'shape_two',
            [
                'label' => esc_html__( 'Shape Two', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'shape_switch' => 'yes',
                    'design_style' => 'layout-6',
                ],
            ]
        );

        $this->add_control(
            'shape_three',
            [
                'label' => esc_html__( 'Shape Three', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'shape_switch' => 'yes',
                    'design_style' => 'layout-6',
                ],
            ]
        );

        $this->add_control(
            'shape_four',
            [
                'label' => esc_html__( 'Shape Four', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'shape_switch' => 'yes',
                    'design_style' => 'layout-6',
                ],
            ]
        );

        $this->add_control(
            'shape_five',
            [
                'label' => esc_html__( 'Shape Five', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'shape_switch' => 'yes',
                    'design_style' => 'layout-6',
                ],
            ]
        );

        $this->add_control(
            'shape_six',
            [
                'label' => esc_html__( 'Shape Six', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'shape_switch' => 'yes',
                    'design_style' => 'layout-6',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_hero',
            [
                'label' => esc_html__('Hero Content', 'edcare-core'),
            ]
        );

        $this->add_control(
            'subheading_icon_type',
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
            'subheading_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'subheading_icon_type' => 'image',
                ],
            ]
        );
        
        $this->add_control(
            'subheading_icon',
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
                    'subheading_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'section_subheading',
            [
                'label' => esc_html__( 'Subheading', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Welcome to Online Education', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Strategies for Tomorrow <span>Solutions</span> for Today', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus <br> nec ullamcorper mattis', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5' ],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_video',
            [
                'label' => esc_html__( 'Video',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-6' ],
                ],
            ]
        );

        $this->add_control(
            'video_text',
            [
                'label' => esc_html__( 'Text', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Watch The Video', 'edcare-core' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'video_url',
            [
                'label' => esc_html__( 'Video URL', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://youtu.be/JwC-Qx1lJso',
                'label_block' => true,
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_people',
            [
                'label' => esc_html__( 'People',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-6' ],
                ],
            ]
        );

        $this->add_control(
            'text_one',
            [
                'label' => esc_html__( 'Text One', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '<span>10k</span>Enrolment', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_two',
            [
                'label' => esc_html__( 'Text Two', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Explore <span>1350+</span> Courses within Subject', 'edcare-core' ),
                'label_block' => true,
            ]
        );
        
        $repeater = new Repeater();

        $repeater->add_control(
            'people_image',
            [
                'label' => esc_html__( 'Choose Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'people_list',
            [
                'label' => esc_html__( 'People List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'people_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'people_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'people_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'people_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_form',
            [
                'label' => esc_html__( 'Form',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-5' ],
                ],
            ]
        );

        $this->add_control(
            'form_switch',
            [
                'label' => esc_html__( 'Form ON/OFF', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edcare-core' ),
                'label_off' => esc_html__( 'Hide', 'edcare-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'form_placeholder_text',
            [
                'label' => esc_html__( 'Placeholder Text', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'What do you want to learn today?', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'form_switch' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'form_button_text',
            [
                'label' => esc_html__( 'Button Text', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Search Now', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'form_switch' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'form_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-long-arrow-alt-right',
                    'library' => 'solid',
                ],
                'condition' => [
                    'form_switch' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'form_button_icon_spacing',
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
                    '{{WRAPPER}} .ed-primary-btn i' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'form_switch' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'form_button_icon_size',
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
                    '{{WRAPPER}} .ed-primary-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'form_switch' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_fun_fact',
            [
                'label' => esc_html__( 'Fun Fact',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );

        $this->add_control(
            'fun_fact_icon_type',
            [
                'label' => esc_html__( 'Image Type', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__( 'Icon', 'edcare-core' ),
                    'image' => esc_html__( 'Image', 'edcare-core' ),
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            'fun_fact_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'fun_fact_icon_type' => 'image',
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            'fun_fact_icon',
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
                    'fun_fact_icon_type' => 'icon',
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_count',
            [
                'label' => esc_html__( 'Count', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '256', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fun_fact_count_suffix',
            [
                'label' => esc_html__( 'Suffix', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '+', 'edcare-core' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'fun_fact_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Crashed Courses', 'edcare-core' ),
                'label_block' => true,
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_fun_fact_two',
            [
                'label' => esc_html__( 'Fun Fact',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'fun_fact_two_icon_type',
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
        
        $repeater->add_control(
            'fun_fact_two_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'fun_fact_two_icon_type' => 'image',
                ],
            ]
        );
        
        $repeater->add_control(
            'fun_fact_two_icon',
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
                    'fun_fact_two_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'fun_fact_two_count',
            [
                'label' => esc_html__( 'Count', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fun_fact_two_count_suffix',
            [
                'label' => esc_html__( 'Suffix', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'fun_fact_two_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fun_fact_list_two',
            [
                'label' => esc_html__( ' List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fun_fact_count' => '9.5',
                        'fun_fact_count_suffix' => __( 'K+', 'edcare-core' ),
                        'fun_fact_two_title' => __( 'Total active students taking <br> gifted courses', 'edcare-core' ),
                    ],
                    [
                        'fun_fact_count' => '15.5',
                        'fun_fact_count_suffix' => __( 'K+', 'edcare-core' ),
                        'fun_fact_two_title' => __( 'Total active students taking <br> gifted courses', 'edcare-core' ),
                    ],
                ],
                'title_field' => '{{{ fun_fact_two_title }}}',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_feature',
            [
                'label' => esc_html__( 'Feature',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-6' ],
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'feature_icon_type',
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
        
        $repeater->add_control(
            'feature_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'feature_icon_type' => 'image',
                ],
            ]
        );
        
        $repeater->add_control(
            'feature_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-circle-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'feature_icon_type' => 'icon',
                ],
            ]
        );
        
        $repeater->add_control(
            'feature_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'feature_list',
            [
                'label' => esc_html__( 'Feature List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'feature_title' => __( 'Experts Advisors', 'edcare-core' ),
                    ],
                    [
                        'feature_title' => __( '538+ Courses', 'edcare-core' ),
                    ],
                ],
                'title_field' => '{{{ feature_title }}}',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_button',
            [
                'label' => esc_html__('Button', 'edcare-core'),
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4', 'layout-6' ],
                ],
            ]
        );

        $this->add_control(
            'section_button_show',
            [
                'label' => esc_html__( 'Show Button', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edcare-core' ),
                'label_off' => esc_html__( 'Hide', 'edcare-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'section_button_text',
            [
                'label' => esc_html__( 'Button Text', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Get Started', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'section_button_show' => 'yes'
                ],
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
                'condition' => [
                    'section_button_show' => 'yes'
                ],
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
                    'section_button_show' => 'yes'
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
                    'section_button_show' => 'yes'
                ]
            ]
        );

        // Secondary Button
        $this->add_control(
            'section_secondary_button_show',
            [
                'label' => esc_html__( 'Show Button', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edcare-core' ),
                'label_off' => esc_html__( 'Hide', 'edcare-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'section_secondary_button_text',
            [
                'label' => esc_html__('Button Text', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Contact Us', 'edcare-core'),
                'label_block' => true,
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                    'section_secondary_button_show' => 'yes'
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
                    'design_style' => [ 'layout-3', 'layout-4' ],
                    'section_secondary_button_show' => 'yes',
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
                    'design_style' => [ 'layout-3', 'layout-4' ],
                    'section_secondary_button_link_type' => '1',
                    'section_secondary_button_show' => 'yes',
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
                    'design_style' => [ 'layout-3', 'layout-4' ],
                    'section_secondary_button_link_type' => '2',
                    'section_secondary_button_show' => 'yes',
                ]
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
                'label' => __( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '_heading_style_design_layout_image',
            [
                'label' => esc_html__( 'Image', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-4',
                ],
            ]
        );

        $this->add_control(
            'design_layout_image_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-img-wrap-2' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-4',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_layout_image_border',
                'selector' => '{{WRAPPER}} .hero-img-wrap-2',
                'condition' => [
                    'design_style' => 'layout-4',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title & Content', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
            '_heading_style_section_subheading_highlight_text',
            [
                'label' => esc_html__( 'Subheading Highlight Text', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-5',
                ],
            ]
        );

        $this->add_control(
            'section_subheading_highlight_text_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-5 .bottom-title span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-5',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_subheading_highlight_text_typography',
                'selector' => '{{WRAPPER}} .hero-content-5 .bottom-title span',
                'condition' => [
                    'design_style' => 'layout-5',
                ],
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
            '_heading_style_section_title_highlight',
            [
                'label' => esc_html__( 'Title Highlight', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'section_title_highlight_color',
            [
                'label' => __( 'Highlight Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .section-heading .section-title span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edcare-el-section-title span' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_highlight_typography',
                'selector' => '{{WRAPPER}} .hero-content .section-heading .section-title span, .edcare-el-section-title span',
            ]
        );

        $this->add_control(
            '_heading_style_section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5' ],
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
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5' ],
                ],
            ]
        );
        
        $this->add_control(
            'section_description_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5' ],
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .edcare-el-section-description',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4', 'layout-5' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_video',
            [
                'label' => esc_html__( 'Video',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-6' ],
                ],
            ]
        );

        $this->add_control(
            '_heading_style_video_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'video_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'video_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'video_icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_video_text',
            [
                'label' => esc_html__( 'Text', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'video_text_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'video_text_typography',
                'selector' => '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_people',
            [
                'label' => esc_html__( 'People',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-6' ],
                ],
            ]
        );
        
        $this->add_control(
            '_heading_style_people_text_highlight_one',
            [
                'label' => esc_html__( 'Text One (Highlight)', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'people_text_highlight_one_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-author h5 span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap p span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'people_text_highlight_one_typography',
                'selector' => '{{WRAPPER}} .hero-content .hero-author h5 span, .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap p span',
            ]
        );
        
        $this->add_control(
            '_heading_style_people_text_one',
            [
                'label' => esc_html__( 'Text One', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'people_text_one_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-author h5' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'people_text_one_typography',
                'selector' => '{{WRAPPER}} .hero-content .hero-author h5, .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap p',
            ]
        );
        
        $this->add_control(
            '_heading_style_people_text_highlight_two',
            [
                'label' => esc_html__( 'Text Two (Highlight)', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'people_text_highlight_two_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .bottom-text span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .student span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'people_text_highlight_two_typography',
                'selector' => '{{WRAPPER}} .hero-content .bottom-text span, .hero-section-2 .hero-bg-wrap .faq-text-box .student span',
            ]
        );
        
        $this->add_control(
            '_heading_style_people_text_two',
            [
                'label' => esc_html__( 'Text Two', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'people_text_two_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .bottom-text' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .student' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'people_text_two_typography',
                'selector' => '{{WRAPPER}} .hero-content .bottom-text, .hero-section-2 .hero-bg-wrap .faq-text-box .student',
            ]
        );

        $this->add_control(
            '_heading_style_people_suffix',
            [
                'label' => esc_html__( 'Suffix', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'people_suffix_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li.number' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'people_suffix_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li.number' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'people_suffix_border',
                'selector' => '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li.number',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'people_suffix_typography',
                'selector' => '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li.number',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_people_image',
            [
                'label' => esc_html__( 'Image', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'people_image_border',
                'selector' => '{{WRAPPER}} .hero-content .hero-author ul li, .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li',
            ]
        );

        $this->add_responsive_control(
            'people_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-author ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'people_image_right_spacing',
            [
                'label' => esc_html__( 'Right Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-author ul li:not(:last-of-type)' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box .faq-thumb-list-wrap .faq-thumb-list li:not(:last-of-type)' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_people_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'people_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'people_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'people_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .faq-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_form',
            [
                'label' => esc_html__( 'Form',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-5' ],
                ],
            ]
        );
        
        $this->add_control(
            '_heading_style_form_input_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'form_input_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'form_input_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            '_heading_style_form_input',
            [
                'label' => esc_html__( 'Input', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'form_input_tabs' );
        
        $this->start_controls_tab(
            'form_input_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'form_input_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_input_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_input_border',
                'selector' => '{{WRAPPER}} .hero-content-2 .hero-form .form-control, .hero-content-5 .hero-form .form-control',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'form_input_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'form_input_color_placeholder',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control::placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control::focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control::placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control::focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_input_background_placeholder',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control::placeholder' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control::placeholder' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control::focus' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control::focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_input_border_placeholder',
                'selector' => '{{WRAPPER}} .hero-content-2 .hero-form .form-control::placeholder, .hero-content-2 .hero-form .form-control::focus, .hero-content-5 .hero-form .form-control::placeholder, .hero-content-5 .hero-form .form-control::focus',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'form_input_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_input_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_input_margin',
            [
                'label' => esc_html__( 'Margin', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .hero-form .form-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-content-5 .hero-form .form-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_form_button',
            [
                'label' => esc_html__( 'Button', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->start_controls_tabs( 'tabs_style_form_button' );
        
        $this->start_controls_tab(
            'form_button_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'form_button_color',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'form_button_background',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'form_button_border',
                'selector' => '{{WRAPPER}} .ed-primary-btn',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'form_button_box_shadow',
                'selector' => '{{WRAPPER}} .ed-primary-btn',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'form_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'form_button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'form_button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'form_button_border_hover',
                'selector' => '{{WRAPPER}} .ed-primary-btn:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'form_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .ed-primary-btn:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_control(
            'form_button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'text-domain' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .ed-primary-btn:before' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'text-domain' ),
                'name'     => 'form_button_typography',
                'selector' => '{{WRAPPER}} .ed-primary-btn',
            ]
        );
        
        $this->add_control(
            'form_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ed-primary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'form_button_margin',
            [
                'label'      => esc_html__( 'Margin', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ed-primary-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_fun_fact',
            [
                'label' => esc_html__( 'Fun Fact',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );
        
        $this->add_control(
            '_heading_style_fun_fact_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_responsive_control(
            'fun_fact_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fun_fact_icon_border',
                'selector' => '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .icon',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fun_fact_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_fun_fact_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-img-wrap .hero-text-element .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .content .text-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-img-wrap .hero-text-element .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .content .text-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fun_fact_title_typography',
                'selector' => '{{WRAPPER}} .hero-img-wrap .hero-text-element .title, .hero-section-2 .hero-bg-wrap .hero-text-box .content .text-title',
            ]
        );

        $this->add_control(
            '_heading_style_fun_fact_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fun_fact_description_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-img-wrap .hero-text-element p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box .content span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fun_fact_description_typography',
                'selector' => '{{WRAPPER}} .hero-img-wrap .hero-text-element p, .hero-section-2 .hero-bg-wrap .hero-text-box .content span',
            ]
        );

        $this->add_control(
            '_heading_style_fun_fact_layout',
            [
                'label' => esc_html__( 'Layout', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fun_fact_layout_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-img-wrap .hero-text-element' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fun_fact_layout_border',
                'selector' => '{{WRAPPER}} .hero-img-wrap .hero-text-element, .hero-section-2 .hero-bg-wrap .hero-text-box',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-img-wrap .hero-text-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fun_fact_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-img-wrap .hero-text-element' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-section-2 .hero-bg-wrap .hero-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_fun_fact_two',
            [
                'label' => esc_html__( 'Fun Fact',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            '_heading_style_fun_fact_two_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_responsive_control(
            'fun_fact_two_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_two_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_two_icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fun_fact_two_border',
                'selector' => '{{WRAPPER}} .about-counter-items .about-counter-item .icon',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_two_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fun_fact_two_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_fun_fact_two_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_two_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .about-counter-items .about-counter-item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_two_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-2 .about-counter-items .about-counter-item .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fun_fact_two_title_typography',
                'selector' => '{{WRAPPER}} .hero-content-2 .about-counter-items .about-counter-item .title',
            ]
        );

        $this->add_control(
            '_heading_style_fun_fact_two_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fun_fact_two_description_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fun_fact_two_description_typography',
                'selector' => '{{WRAPPER}} .about-counter-items .about-counter-item .content p',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_feature',
            [
                'label' => esc_html__( 'Feature',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-6' ],
                ],
            ]
        );
        
        $this->add_control(
            '_heading_style_feature_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'feature_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content-3 ul li' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hero-section-8 .hero-items .hero-item i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'feature_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-3 ul li .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-section-8 .hero-items .hero-item i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_feature_text',
            [
                'label' => esc_html__( 'Text', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'feature_text_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-section-8 .hero-items .hero-item' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_text_typography',
                'selector' => '{{WRAPPER}} .hero-section-8 .hero-items .hero-item',
            ]
        );

        $this->add_control(
            '_heading_style_feature_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'feature_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-section-8 .hero-items .hero-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-section-8 .hero-items .hero-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-section-8 .hero-items .hero-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'_style_button',
			[
				'label' => __( 'Button', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4', 'layout-6' ],
                ],
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'button_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button'    => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
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
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .edcare-el-button',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'button_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'edcare-core' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'border-radius: {{SIZE}}px;',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'edcare-core' ),
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .edcare-el-button',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
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
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
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
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            '_heading_button_secondary',
            [
                'label' => esc_html__( 'Button Secondary', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_secondary_style' );

        $this->start_controls_tab(
            'button_secondary_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_secondary_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two'    => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_secondary_background',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'button_secondary_border',
                'selector' => '{{WRAPPER}} .edcare-el-button-two',
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_secondary_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_secondary_color_hover',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_secondary_background_hover',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'button_secondary_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button-two:hover',
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_secondary_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'edcare-core' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button-two' => 'border-radius: {{SIZE}}px;',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'edcare-core' ),
                'name'     => 'button_secondary_typography',
                'selector' => '{{WRAPPER}} .edcare-el-button-two',
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_secondary_padding',
            [
                'label'      => esc_html__( 'Padding', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'button_secondary_margin',
            [
                'label'      => esc_html__( 'Margin', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
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

        if ( !empty($settings['hero_image']['url']) ) {
            $hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url( $settings['hero_image']['id'], 'full') : $settings['hero_image']['url'];
            $hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
        }

        if ( !empty($settings['hero_image_two']['url']) ) {
            $hero_image_two = !empty($settings['hero_image_two']['id']) ? wp_get_attachment_image_url( $settings['hero_image_two']['id'], 'full') : $settings['hero_image_two']['url'];
            $hero_image_two_alt = get_post_meta($settings["hero_image_two"]["id"], "_wp_attachment_image_alt", true);
        }

		?>

		<?php if ( $settings['design_style']  == 'layout-1' ): 
            
            // Link
            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                $this->add_render_attribute('section-button-arg', 'data-wow-delay', '.5s');
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                }
            }
            
            ?>

            <section class="edcare-el-section hero-section overflow-hidden">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-3.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-3">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-4.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-12">
                            <div class="hero-content">
                                <div class="section-heading mb-40">
                                    <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                                        <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                                            <?php if ( $settings['subheading_icon_type']  == 'image' ): ?>
                                                <span class="heading-icon">
                                                    <img class="img-fluid" src="<?php echo $settings['subheading_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['subheading_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </span>
                                            <?php elseif ( $settings['subheading_icon_type']  == 'icon' ): ?>
                                                <span class="heading-icon">
                                                    <?php edcare_render_icon($settings, 'subheading_icon' ); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php print edcare_kses( $settings['section_subheading'] ); ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['section_title' ] ) ) : ?>
                                        <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                            <?php print edcare_kses( $settings['section_title'] ); ?>
                                        </h2>
                                    <?php endif; ?>
                                </div>
                                <div class="hero-btn-wrap">
                                    <?php if (!empty($settings['section_button_show'])) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'section-button-arg' ); ?>>
                                            <?php echo $settings['section_button_text']; ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['video_url'] ) ) : ?>
                                        <div class="hero-video">
                                            <div class="video-btn">
                                                <a
                                                    class="video-popup venobox"
                                                    data-autoplay="true"
                                                    data-vbtype="video"
                                                    href="<?php print esc_url($settings['video_url']); ?>">
                                                    <div class="play-btn">
                                                        <i class="fa-sharp fa-solid fa-play"></i>
                                                    </div>
                                                    <?php print edcare_kses($settings['video_text']); ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="hero-author">
                                    <ul>
                                        <?php foreach ($settings['people_list'] as $item) : 
                                            if ( !empty($item['people_image']['url']) ) {
                                                $people_image = !empty($item['people_image']['id']) ? wp_get_attachment_image_url( $item['people_image']['id'], 'full') : $item['people_image']['url'];
                                                $people_image_alt = get_post_meta($item["people_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                            ?>
                                            <li><img src="<?php print esc_url($people_image); ?>" alt="<?php print esc_attr($people_image_alt); ?>"></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php if ( !empty( $settings['text_one'] ) ) : ?>
                                        <h5>
                                            <?php print edcare_kses($settings['text_one']); ?>
                                        </h5>
                                    <?php endif; ?>
                                </div>
                                <?php if ( !empty( $settings['text_two'] ) ) : ?>
                                    <h4 class="bottom-text">
                                        <?php print edcare_kses($settings['text_two']); ?>
                                    </h4>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="hero-img-wrap">
                                <?php if ( !empty( $hero_image ) ) : ?>
                                    <div class="hero-img">
                                        <img src="<?php print esc_url($hero_image); ?>" alt="<?php print esc_attr($hero_image_alt); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                                    <div class="hero-img-shape">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-1.png' ); ?>" alt="<?php print esc_url( 'shape', 'edcare-core' ); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="hero-text-element">
                                    <h3 class="title">
                                        <span class="odometer" data-count="<?php print esc_attr($settings['fun_fact_count']); ?>">
                                            <?php print esc_html( '0', 'edcare-core' ); ?>
                                        </span>
                                        <?php if ( !empty( $settings['fun_fact_count_suffix'] ) ) : ?>
                                            <span class="number">
                                                <?php print edcare_kses($settings['fun_fact_count_suffix']); ?>
                                            </span>
                                        <?php endif; ?>
                                    </h3>
                                    <?php if ( !empty( $settings['fun_fact_title'] ) ) : ?>
                                        <p><?php print edcare_kses($settings['fun_fact_title']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

            <section class="edcare-el-section hero-section-2 overflow-hidden">
                <div class="hero-bg-wrap">
                    <?php if ( !empty( $hero_image ) ) : ?>
                        <div class="hero-bg">
                            <img src="<?php print esc_url($hero_image); ?>" alt="<?php print esc_attr($hero_image_alt); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="hero-bg-shape">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-bg-shape.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                    </div>
                    <div class="faq-text-box">
                        <?php if ( !empty( $settings['text_one'] ) ) : ?>
                            <h4 class="student">
                                <?php print edcare_kses($settings['text_one']); ?>
                            </h4>
                        <?php endif; ?>
                        <div class="faq-thumb-list-wrap">
                            <ul class="faq-thumb-list">
                                <?php foreach ($settings['people_list'] as $item) : 
                                    if ( !empty($item['people_image']['url']) ) {
                                        $people_image = !empty($item['people_image']['id']) ? wp_get_attachment_image_url( $item['people_image']['id'], 'full') : $item['people_image']['url'];
                                        $people_image_alt = get_post_meta($item["people_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    ?>
                                    <li><img src="<?php print esc_url($people_image); ?>" alt="<?php print esc_attr($people_image_alt); ?>"></li>
                                <?php endforeach; ?>
                                <li class="number">+</li>
                            </ul>
                            <?php if ( !empty( $settings['text_two'] ) ) : ?>
                                <p><?php print edcare_kses($settings['text_two']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="hero-text-box">
                        <?php if ( $settings['fun_fact_icon_type']  == 'image' ): ?>
                            <div class="icon">
                                <img class="img-fluid" src="<?php echo $settings['fun_fact_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fun_fact_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                            </div>
                        <?php elseif ( $settings['fun_fact_icon_type']  == 'icon' ): ?>
                            <div class="icon">
                                <?php edcare_render_icon($settings, 'fun_fact_icon' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="content">
                            <h5 class="text-title">
                                <?php print edcare_kses($settings['fun_fact_count']); ?><?php print edcare_kses($settings['fun_fact_count_suffix']); ?>
                            </h5>
                            <span><?php print edcare_kses($settings['fun_fact_title']); ?></span>
                        </div>
                    </div>
                </div>
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-11.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-12.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-12">
                            <div class="hero-content-2">
                                <div class="section-heading mb-20">
                                    <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                                        <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                                            <?php if ( $settings['subheading_icon_type']  == 'image' ): ?>
                                                <span class="heading-icon">
                                                    <img class="img-fluid" src="<?php echo $settings['subheading_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['subheading_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </span>
                                            <?php elseif ( $settings['subheading_icon_type']  == 'icon' ): ?>
                                                <span class="heading-icon">
                                                    <?php edcare_render_icon($settings, 'subheading_icon' ); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php print edcare_kses( $settings['section_subheading'] ); ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['section_title' ] ) ) : ?>
                                        <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                            <?php print edcare_kses( $settings['section_title'] ); ?>
                                        </h2>
                                    <?php endif; ?>
                                </div>
                                <?php if ( !empty( $settings['section_description'] ) ) : ?>
                                    <p class="edcare-el-section-description desc">
                                        <?php print edcare_kses( $settings['section_description'] ); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ( !empty( $settings['form_switch'] ) ) : ?>
                                    <div class="hero-form">
                                        <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                            <input type="text" id="text" name="s" class="form-control" placeholder="<?php print esc_attr($settings['form_placeholder_text']); ?>" required>
                                            <input type="hidden" name="post_type" value="courses">
                                            <button type="submit" class="ed-primary-btn">
                                                <?php print esc_attr($settings['form_button_text']); ?><?php edcare_render_icon($settings, 'form_icon' ); ?>
                                            </button>
                                        </form>
                                        <div class="icon">
                                            <i class="fa-regular fa-magnifying-glass"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="about-counter-items mb-0 wow fade-in-bottom" data-wow-delay="600ms">
                                    <?php foreach ($settings['fun_fact_list_two'] as $item) : ?>
                                        <div class="about-counter-item">
                                            <?php if ( $item['fun_fact_two_icon_type']  == 'image' ): ?>
                                                <div class="icon">
                                                    <img class="img-fluid" src="<?php echo $item['fun_fact_two_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fun_fact_two_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </div>
                                            <?php elseif ( $item['fun_fact_two_icon_type']  == 'icon' ): ?>
                                                <div class="icon">
                                                    <?php edcare_render_icon($item, 'fun_fact_two_icon' ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="content">
                                                <h3 class="title">
                                                    <span class="odometer" data-count="<?php print esc_attr($item['fun_fact_two_count']); ?>">
                                                        <?php print esc_html( '0', 'edcare-core' ); ?>
                                                    </span>
                                                    <?php if ( !empty( $item['fun_fact_two_count_suffix'] ) ) : ?>
                                                        <span class="number">
                                                            <?php print edcare_kses($item['fun_fact_two_count_suffix']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </h3>
                                                <?php if ( !empty( $item['fun_fact_two_title'] ) ) : ?>
                                                    <p><?php print edcare_kses($item['fun_fact_two_title']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-3' ) :

            if ( !empty($settings['hero_image']['url']) ) {
                $hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url( $settings['hero_image']['id'], 'full') : $settings['hero_image']['url'];
                $hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn' );
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn' );
                }
            }

            // Link
            if ('2' == $settings['section_secondary_button_link_type']) {
                $this->add_render_attribute('section-secondary-button-arg', 'href', get_permalink($settings['section_secondary_button_page_link']));
                $this->add_render_attribute('section-secondary-button-arg', 'target', '_self');
                $this->add_render_attribute('section-secondary-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-secondary-button-arg', 'class', 'edcare-el-button-two ed-primary-btn hero-btn-2' );
                $this->add_render_attribute('section-secondary-button-arg', 'data-wow-delay', '.1s');
            } else {
                if ( ! empty( $settings['section_secondary_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-secondary-button-arg', $settings['section_secondary_button_link'] );
                    $this->add_render_attribute('section-secondary-button-arg', 'class', 'edcare-el-button-two ed-primary-btn hero-btn-2' );
                }
            }
        ?>

            <section class="edcare-el-section hero-section hero-3 overflow-hidden">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="hero-bottom-shape">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-bottom-shape.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                    </div>
                <?php endif; ?>
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="hero-shapes">
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-13.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-14.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-3">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-15.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ( !empty( $hero_image ) ) : ?>
                    <div class="hero-img-wrap-3">
                        <div class="hero-img">
                            <img src="<?php print esc_url($hero_image); ?>" alt="<?php print esc_attr($hero_image_alt); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="hero-content hero-content-3">
                                <div class="section-heading mb-20">
                                    <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                                        <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                                            <?php if ( $settings['subheading_icon_type']  == 'image' ): ?>
                                                <span class="heading-icon">
                                                    <img class="img-fluid" src="<?php echo $settings['subheading_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['subheading_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </span>
                                            <?php elseif ( $settings['subheading_icon_type']  == 'icon' ): ?>
                                                <span class="heading-icon">
                                                    <?php edcare_render_icon($settings, 'subheading_icon' ); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php print edcare_kses( $settings['section_subheading'] ); ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['section_title' ] ) ) : ?>
                                        <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                            <?php print edcare_kses( $settings['section_title'] ); ?>
                                        </h2>
                                    <?php endif; ?>
                                </div>
                                <?php if ( !empty( $settings['section_description'] ) ) : ?>
                                    <p class="edcare-el-section-description">
                                        <?php print edcare_kses( $settings['section_description'] ); ?>
                                    </p>
                                <?php endif; ?>
                                <ul class="hero-list">
                                    <?php foreach ($settings['feature_list'] as $item) : ?>
                                        <?php if ( !empty( $item['feature_title'] ) ) : ?>
                                            <li>
                                                <?php if ( $item['feature_icon_type']  == 'image' ): ?>
                                                    <div class="icon">
                                                        <img class="img-fluid" src="<?php echo $item['feature_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['feature_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    </div>
                                                <?php elseif ( $item['feature_icon_type']  == 'icon' ): ?>
                                                    <div class="icon">
                                                        <?php edcare_render_icon($item, 'feature_icon' ); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php print edcare_kses($item['feature_title']); ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="hero-btn-wrap mb-0">
                                    <?php if ( !empty( $settings['section_button_show'] ) ) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'section-button-arg' ); ?>>
                                            <?php print edcare_kses( $settings['section_button_text'] ); ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['section_secondary_button_show'] ) ) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'section-secondary-button-arg' ); ?>>
                                            <?php print edcare_kses( $settings['section_secondary_button_text'] ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-4' ) :

            if ( !empty($settings['hero_image']['url']) ) {
                $hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url( $settings['hero_image']['id'], 'full') : $settings['hero_image']['url'];
                $hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // Link
            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn active' );
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn active' );
                }
            }

            // Link
            if ('2' == $settings['section_secondary_button_link_type']) {
                $this->add_render_attribute('section-secondary-button-arg', 'href', get_permalink($settings['section_secondary_button_page_link']));
                $this->add_render_attribute('section-secondary-button-arg', 'target', '_self');
                $this->add_render_attribute('section-secondary-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-secondary-button-arg', 'class', 'edcare-el-button-two ed-primary-btn' );
            } else {
                if ( ! empty( $settings['section_secondary_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-secondary-button-arg', $settings['section_secondary_button_link'] );
                    $this->add_render_attribute('section-secondary-button-arg', 'class', 'edcare-el-button-two ed-primary-btn' );
                }
            }
        ?>

            <section class="edcare-el-section hero-section hero-4 overflow-hidden">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-16.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-17.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-3">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-18.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-4">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-19.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="hero-content hero-content-3 hero-content-4">
                                <div class="section-heading mb-20">
                                    <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                                        <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                                            <?php if ( $settings['subheading_icon_type']  == 'image' ): ?>
                                                <span class="heading-icon">
                                                    <img class="img-fluid" src="<?php echo $settings['subheading_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['subheading_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </span>
                                            <?php elseif ( $settings['subheading_icon_type']  == 'icon' ): ?>
                                                <span class="heading-icon">
                                                    <?php edcare_render_icon($settings, 'subheading_icon' ); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php print edcare_kses( $settings['section_subheading'] ); ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['section_title' ] ) ) : ?>
                                        <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                            <?php print edcare_kses( $settings['section_title'] ); ?>
                                        </h2>
                                    <?php endif; ?>
                                </div>
                                <?php if ( !empty( $settings['section_description'] ) ) : ?>
                                    <h4 class="edcare-el-section-description bottom-title">
                                        <?php print edcare_kses( $settings['section_description'] ); ?>
                                    </h4>
                                <?php endif; ?>
                                <div class="hero-btn-wrap">
                                    <?php if ( !empty( $settings['section_button_show'] ) ) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'section-button-arg' ); ?>>
                                            <?php print edcare_kses( $settings['section_button_text'] ); ?><span><i class="fa-solid fa-plus"></i></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['section_secondary_button_show'] ) ) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'section-secondary-button-arg' ); ?>>
                                            <?php print edcare_kses( $settings['section_secondary_button_text'] ); ?><span><i class="fa-solid fa-plus"></i></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="hero-img-wrap-2">
                                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                                    <div class="img-shape">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-img-shape-3.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                                    </div>
                                    <div class="img-shape-2">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-img-shape-4.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if ( !empty( $hero_image ) ) : ?>
                                    <div class="hero-img">
                                        <img src="<?php print esc_url($hero_image); ?>" alt="<?php print esc_attr($hero_image_alt); ?>">
                                    </div>
                                    <ul class="hero-contact-list">
                                        <li><a href="#"><i class="fa-solid fa-ellipsis"></i></a></li>
                                        <li><a href="#"><i class="fa-regular fa-microphone-slash"></i></a></li>
                                        <li><a href="#"><i class="fa-regular fa-phone"></i></a></li>
                                        <li><a href="#"><i class="fa-regular fa-video"></i></a></li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-5' ) : ?>

            <section class="edcare-el-section hero-section-5 overflow-hidden">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="bg-item">
                        <div class="hero-shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-9.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="hero-shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-shape-10.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="hero-shape shape-3">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-img-shape-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="hero-shape shape-4">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/hero-img-shape-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="hero-men-wrap">
                    <?php if ( !empty( $hero_image ) ) : ?>
                        <div class="hero-men men-1">
                            <img src="<?php print esc_url($hero_image); ?>" alt="<?php print esc_attr($hero_image_alt); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $hero_image_two ) ) : ?>
                        <div class="hero-men men-2">
                            <img src="<?php print esc_url($hero_image_two); ?>" alt="<?php print esc_attr($hero_image_two_alt); ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="container">
                    <div class="hero-content hero-content-5 text-center">
                        <?php if ( !empty( $settings['section_title'] ) ) : ?>
                            <h1 class="edcare-el-section-title title">
                                <?php print edcare_kses( $settings['section_title'] ); ?>
                            </h1>
                        <?php endif; ?>
                        <?php if ( !empty( $settings['section_description'] ) ) : ?>
                            <p class="edcare-el-section-description">
                                <?php print edcare_kses( $settings['section_description'] ); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ( !empty( $settings['form_switch'] ) ) : ?>
                            <div class="hero-form">
                                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                    <input type="text" id="text" name="s" class="form-control" placeholder="<?php print esc_attr($settings['form_placeholder_text']); ?>" value="">
                                    <input type="hidden" name="post_type" value="courses">
                                    <button type="submit" class="ed-primary-btn">
                                        <?php print edcare_kses($settings['form_button_text']); ?><?php edcare_render_icon($settings, 'form_icon' ); ?>
                                    </button>
                                </form>
                                <div class="icon"><i class="fa-regular fa-magnifying-glass"></i></div>
                            </div>
                        <?php endif; ?>
                        <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                            <h3 class="edcare-el-section-subheading bottom-title">
                                <?php print edcare_kses( $settings['section_subheading'] ); ?>
                            </h3>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-6' ) : 
            // Link
            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                $this->add_render_attribute('section-button-arg', 'data-wow-delay', '.5s');
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                }
            }

            if ( !empty($settings['shape_one']['url']) ) {
                $shape_one = !empty($settings['shape_one']['id']) ? wp_get_attachment_image_url( $settings['shape_one']['id'], 'full') : $settings['shape_one']['url'];
                $shape_one_alt = get_post_meta($settings["shape_one"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['shape_two']['url']) ) {
                $shape_two = !empty($settings['shape_two']['id']) ? wp_get_attachment_image_url( $settings['shape_two']['id'], 'full') : $settings['shape_two']['url'];
                $shape_two_alt = get_post_meta($settings["shape_two"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['shape_three']['url']) ) {
                $shape_three = !empty($settings['shape_three']['id']) ? wp_get_attachment_image_url( $settings['shape_three']['id'], 'full') : $settings['shape_three']['url'];
                $shape_three_alt = get_post_meta($settings["shape_three"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['shape_four']['url']) ) {
                $shape_four = !empty($settings['shape_four']['id']) ? wp_get_attachment_image_url( $settings['shape_four']['id'], 'full') : $settings['shape_four']['url'];
                $shape_four_alt = get_post_meta($settings["shape_four"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['shape_five']['url']) ) {
                $shape_five = !empty($settings['shape_five']['id']) ? wp_get_attachment_image_url( $settings['shape_five']['id'], 'full') : $settings['shape_five']['url'];
                $shape_five_alt = get_post_meta($settings["shape_five"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['shape_six']['url']) ) {
                $shape_six = !empty($settings['shape_six']['id']) ? wp_get_attachment_image_url( $settings['shape_six']['id'], 'full') : $settings['shape_six']['url'];
                $shape_six_alt = get_post_meta($settings["shape_six"]["id"], "_wp_attachment_image_alt", true);
            }

            ?>

            <section class="edcare-el-section hero-section hero-section-8 overflow-hidden">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="bg-shapes">
                        <div class="bg-shape-1">
                            <img src="<?php print esc_url($shape_one); ?>" alt="<?php print esc_attr($shape_one_alt); ?>">
                        </div>
                        <div class="bg-shape-2">
                            <img src="<?php print esc_url($shape_two); ?>" alt="<?php print esc_attr($shape_two_alt); ?>">
                        </div>
                        <div class="bg-shape-3">
                            <img src="<?php print esc_url($shape_three); ?>" alt="<?php print esc_attr($shape_three_alt); ?>">
                        </div>
                    </div>
                    <div class="shapes">
                        <div class="shape shape-1">
                            <img src="<?php print esc_url($shape_four); ?>" alt="<?php print esc_attr($shape_four_alt); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php print esc_url($shape_five); ?>" alt="<?php print esc_attr($shape_five_alt); ?>">
                        </div>
                        <div class="shape shape-3">
                            <img src="<?php print esc_url($shape_six); ?>" alt="<?php print esc_attr($shape_six_alt); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="hero-img-wrap-8">
                    <img src="<?php print esc_url($hero_image); ?>" alt="<?php print esc_attr($hero_image_alt); ?>">
                </div>
                <div class="hero-items">
                    <?php foreach ($settings['feature_list'] as $item) : ?>
                        <?php if ( !empty( $item['feature_title'] ) ) : ?>
                            <div class="hero-item">
                                <?php if ( $item['feature_icon_type']  == 'image' ): ?>
                                    <img class="img-fluid" src="<?php echo $item['feature_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['feature_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php elseif ( $item['feature_icon_type']  == 'icon' ): ?>
                                    <?php edcare_render_icon($item, 'feature_icon' ); ?>
                                <?php endif; ?>
                                <span><?php print edcare_kses($item['feature_title']); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-12">
                            <div class="hero-content hero-content-8">
                                <div class="section-heading mb-40">
                                    <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                                        <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                                            <?php if ( $settings['subheading_icon_type']  == 'image' ): ?>
                                                <span class="heading-icon">
                                                    <img class="img-fluid" src="<?php echo $settings['subheading_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['subheading_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </span>
                                            <?php elseif ( $settings['subheading_icon_type']  == 'icon' ): ?>
                                                <span class="heading-icon">
                                                    <?php edcare_render_icon($settings, 'subheading_icon' ); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php print edcare_kses( $settings['section_subheading'] ); ?>
                                        </h4>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['section_title' ] ) ) : ?>
                                        <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                            <?php print edcare_kses( $settings['section_title'] ); ?>
                                        </h2>
                                    <?php endif; ?>
                                </div>
                                <div class="hero-btn-wrap">
                                    <?php if (!empty($settings['section_button_show'])) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'section-button-arg' ); ?>>
                                            <?php echo $settings['section_button_text']; ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['video_url'] ) ) : ?>
                                        <div class="hero-video">
                                            <div class="video-btn">
                                                <a
                                                    class="video-popup venobox"
                                                    data-autoplay="true"
                                                    data-vbtype="video"
                                                    href="<?php print esc_url($settings['video_url']); ?>">
                                                    <div class="play-btn">
                                                        <i class="fa-sharp fa-solid fa-play"></i>
                                                    </div>
                                                    <?php print edcare_kses($settings['video_text']); ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="hero-author mb-0">
                                    <ul>
                                        <?php foreach ($settings['people_list'] as $item) : 
                                            if ( !empty($item['people_image']['url']) ) {
                                                $people_image = !empty($item['people_image']['id']) ? wp_get_attachment_image_url( $item['people_image']['id'], 'full') : $item['people_image']['url'];
                                                $people_image_alt = get_post_meta($item["people_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                            ?>
                                            <li><img src="<?php print esc_url($people_image); ?>" alt="<?php print esc_attr($people_image_alt); ?>"></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php if ( !empty( $settings['text_one'] ) ) : ?>
                                        <h5>
                                            <?php print edcare_kses($settings['text_one']); ?>
                                        </h5>
                                    <?php endif; ?>
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

$widgets_manager->register( new EdCare_Hero_Banner() );