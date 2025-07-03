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
class EdCare_About extends Widget_Base {

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
		return 'edcare_about';
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
		return __( 'About', 'edcare-core' );
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
            'design_layout',
            [
                'label' => esc_html__('Design Layout', 'edcare-core'),
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => esc_html__( 'Show/Hide Shape', 'edcare-core' ),
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
                'label' => esc_html__('Title & Content', 'edcare-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
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
                'default' => __( 'About Us', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'We are the best agency <br> to improve your deals.', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Duis aute irure dolor in repreh enderit in volup tate velit esse cillum dolore eu fugiat nulla dolor atur with Lorem ipsum is simply free text market web bites eius mod ut labore duis aute irure pari', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'section_description_two',
            [
                'label' => esc_html__( 'Description Two', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer.', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'section_description_three',
            [
                'label' => esc_html__( 'Description Two', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer.', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-4' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_features_one',
            [
                'label' => esc_html__( 'Features List', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'features_icon_type',
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
            'features_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'features_icon_type' => 'image',
                ],
            ]
        );
        
        $repeater->add_control(
            'features_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'condition' => [
                    'features_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'features_title', [
                'label' => esc_html__('Title', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'features_description', [
                'label' => esc_html__('Description', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'features_list_one',
            [
                'label' => esc_html__('Features - List', 'edcare-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'features_icon' => 'fa-solid fa-circle-check',
                        'features_title' => __( 'Competitive Rates', 'edcare-core' ),
                        'features_description' => __( 'Seamlessly envisioneer tactical <br> data through services.', 'edcare-core' ),
                    ],
                    [
                        'features_icon' => 'fa-solid fa-circle-check',
                        'features_title' => __( 'Online Certificates', 'edcare-core' ),
                        'features_description' => __( 'Seamlessly envisioneer tactical <br> data through services.', 'edcare-core' ),
                    ],
                ],
                'title_field' => '{{{ features_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_features_two',
            [
                'label' => esc_html__( 'Features List', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-4',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'features_icon_type',
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
            'features_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'features_icon_type' => 'image',
                ],
            ]
        );
        
        $repeater->add_control(
            'features_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'condition' => [
                    'features_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'features_title', [
                'label' => esc_html__('Title', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'features_list_two',
            [
                'label' => esc_html__('Features - List', 'edcare-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'features_icon' => 'fa-solid fa-circle-check',
                        'features_title' => __( 'Tailor content and courses to meet the individual needs and learning', 'edcare-core' ),
                    ],
                    [
                        'features_icon' => 'fa-solid fa-circle-check',
                        'features_title' => __( 'Engage students through multimedia elements, quizzes, and hands-on activities', 'edcare-core' ),
                    ],
                    [
                        'features_icon' => 'fa-solid fa-circle-check',
                        'features_title' => __( 'Monitor student performance with dashboards that provide insights into learning', 'edcare-core' ),
                    ],
                    [
                        'features_icon' => 'fa-solid fa-circle-check',
                        'features_title' => __( 'Motivate students with badges, leaderboards, and rewards to encourage active', 'edcare-core' ),
                    ],
                ],
                'title_field' => '{{{ features_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_image',
            [
                'label' => esc_html__( 'Image', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'about_image',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'about_image_two',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => [ 'layout-1' ],
                ],
            ]
        );

        $this->add_control(
            'video_url',
            [
                'label' => esc_html__( 'Video URL', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://youtu.be/JwC-Qx1lJso',
                'label_block' => true,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-4' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_student',
            [
                'label' => esc_html__( 'Student',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_control(
            'student_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Total Students', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'student_number',
            [
                'label' => esc_html__( 'Number', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '25+', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'student_image',
            [
                'label' => esc_html__( 'Choose Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'student_list',
            [
                'label' => esc_html__( 'Student List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'student_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'student_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'student_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'student_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_fun_fact',
            [
                'label' => esc_html__( 'Fun Fact', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'fun_fact_icon_type',
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
        
        $repeater->add_control(
            'fun_fact_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'fun_fact_icon_type' => 'image',
                ],
            ]
        );
        
        $repeater->add_control(
            'fun_fact_icon',
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
                    'fun_fact_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'fun_fact_count', [
                'label' => esc_html__( 'Count Number', 'edcare-core' ),
                'default' => '85',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fun_fact_sign', [
                'label' => esc_html__( 'Count Sign', 'edcare-core' ),
                'default' => esc_html__( 'K+', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fun_fact_title', [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'fun_fact_list',
            [
                'label' => esc_html__( 'Fun Fact List', 'edcare-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fun_fact_count' => __( '9.5', 'edcare-core' ),
                        'fun_fact_title' => __( 'Total active students taking <br> gifted courses', 'edcare-core' ),
                    ],
                    [
                        'fun_fact_count' => __( '6.7', 'edcare-core' ),
                        'fun_fact_title' => __( 'Total active students taking <br> gifted courses', 'edcare-core' ),
                    ],
                ],
                'title_field' => '{{{ fun_fact_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_phone',
            [
                'label' => esc_html__( 'Phone', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => [ 'layout-1' ],
                ],
            ]
        );

        $this->add_control(
            'phone_switch',
            [
                'label' => esc_html__( 'Phone ON/OFF', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edcare-core' ),
                'label_off' => esc_html__( 'Hide', 'edcare-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'phone_number_label',
            [
                'label' => esc_html__( 'Label', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Online Support', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'phone_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '+258 152 3659', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'phone_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'phone_number_link',
            [
                'label' => esc_html__( 'Phone Number Link', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '+2581523659', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'phone_switch' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_button',
            [
                'label' => esc_html__('Button', 'edcare-core'),
            ]
        );

        $this->add_control(
            'section_button_text',
            [
                'label' => esc_html__('Button Text', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Contact Us', 'edcare-core' ),
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

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_design_layout',
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
                    '{{WRAPPER}} .experience-one' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .experience-two' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_layout_image_border',
                'selector' => '{{WRAPPER}} .about-img-wrap .about-img-1, .about-img-wrap-3 .about-img',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );

        $this->add_control(
            'design_layout_image_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-img-wrap-2' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-4',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'design_layout_box_shadow',
                'selector' => '{{WRAPPER}} .content-img-wrap-2',
                'condition' => [
                    'design_style' => 'layout-4',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_video',
            [
                'label' => esc_html__( 'Video', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-4' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-img-1 .video-btn a' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'video_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-img-1 .video-btn a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'video_color_hover',
            [
                'label' => esc_html__( 'Color (Hover)', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-img-1 .video-btn a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'video_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-img-1 .video-btn a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-4' ],
                ],
            ]
        );

        $this->add_control(
            'video_background_hover',
            [
                'label' => esc_html__( 'Background (Hover)', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-img-1 .video-btn a:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-img-1 .video-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-4' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'video_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-img-1 .video-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-4' ],
                ],
            ]
        );
        
        $this->end_controls_section();

		$this->start_controls_section(
			'_style_title',
			[
				'label' => __( 'Title & Content', 'edcare-core' ),
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
            '_style_heading_section_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'section_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => __( 'Text Color', 'edcare-core' ),
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
            '_content_section_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'edcare-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'section_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_description_color',
            [
                'label' => __( 'Text Color', 'edcare-core' ),
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

		$this->start_controls_section(
			'_style_features_list',
			[
				'label' => __( 'Features List', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4' ],
                ],
			]
		);

        $this->add_control(
            '_heading_style_features_list_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'features_list_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .content-info-2 .content-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        
        $this->add_control(
            'features_list_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-info-2 .content-list li i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'features_list_icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
			'features_list_title',
			[
				'label' => esc_html__( 'Feature Title', 'edcare-core' ),
				'type' => Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .content-info-2 .content-list li:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_title_color',
            [
                'label' => __( 'Text', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-info-2 .content-list li' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_title_typography',
                'selector' => '{{WRAPPER}} .content-info-2 .content-list li, .about-content-4 .about-items .about-item .content .title',
            ]
        );

        $this->add_control(
            '_heading_style_features_list_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_description_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'features_list_description_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-content-4 .about-items .about-item .content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_description_typography',
                'selector' => '{{WRAPPER}} .about-content-4 .about-items .about-item .content p',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3' ],
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
			'_style_fun_fact',
			[
				'label' => __( 'Fun Fact', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => 'layout-1',
                ],
			]
		);

        $this->add_control(
            '_heading_style_fun_fact_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'fun_fact_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_icon_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fun_fact_icon_border',
                'selector' => '{{WRAPPER}} .about-counter-items .about-counter-item .icon',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fun_fact_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_fun_fact_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_title_color',
            [
                'label' => __( 'Text', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fun_fact_title_typography',
                'selector' => '{{WRAPPER}} .about-counter-items .about-counter-item .content .title',
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
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fun_fact_description_typography',
                'selector' => '{{WRAPPER}} .about-counter-items .about-counter-item .content p',
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            '_style_phone',
            [
                'label' => esc_html__( 'Phone',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_phone_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'phone_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'phone_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact .icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'phone_icon_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'phone_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'phone_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_phone_label',
            [
                'label' => esc_html__( 'Label', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'phone_label_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact .content span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'phone_label_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact .content span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'phone_label_typography',
                'selector' => '{{WRAPPER}} .about-img-wrap .about-contact .content span',
            ]
        );

        $this->add_control(
            '_heading_style_phone_number',
            [
                'label' => esc_html__( 'Number', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'phone_number_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact .content a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'phone_number_typography',
                'selector' => '{{WRAPPER}} .about-img-wrap .about-contact .content a',
            ]
        );

        $this->add_control(
            '_heading_style_phone_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'phone_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'phone_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'phone_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-img-wrap .about-contact' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_student',
            [
                'label' => esc_html__( 'Student',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_student_image',
            [
                'label' => esc_html__( 'Image', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'student_image_border',
                'selector' => '{{WRAPPER}} .faq-img-wrap .faq-text-box .faq-thumb-list li',
            ]
        );

        $this->add_control(
            '_heading_style_student_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'student_title_typography',
                'selector' => '{{WRAPPER}} .faq-img-wrap .faq-text-box h4',
            ]
        );

        $this->add_control(
            '_heading_style_student_number',
            [
                'label' => esc_html__( 'Number', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'student_number_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box .faq-thumb-list li.number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'student_number_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box .faq-thumb-list li.number' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'student_number_typography',
                'selector' => '{{WRAPPER}} .faq-img-wrap .faq-text-box .faq-thumb-list li.number',
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

        $this->add_responsive_control(
            'student_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'student_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'student_layout_box_shadow',
                'selector' => '{{WRAPPER}} .faq-img-wrap .faq-text-box',
            ]
        );

        $this->add_control(
            'student_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-img-wrap .faq-text-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'_style_button',
			[
				'label' => __( 'Button', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
                'label'     => esc_html__( 'Text', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button'    => 'color: {{VALUE}}',
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
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .edcare-el-button'
			]
		);

        $this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'edcare-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .edcare-el-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
                'label'     => esc_html__( 'Text', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .edcare-el-button::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover' => 'border-color: {{VALUE}}',
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

        if ( !empty($settings['about_image']['url']) ) {
            $about_image = !empty($settings['about_image']['id']) ? wp_get_attachment_image_url( $settings['about_image']['id'], 'large') : $settings['about_image']['url'];
            $about_image_alt = get_post_meta($settings["about_image"]["id"], "_wp_attachment_image_alt", true);
        }

        if ( !empty($settings['about_image_two']['url']) ) {
            $about_image_two = !empty($settings['about_image_two']['id']) ? wp_get_attachment_image_url( $settings['about_image_two']['id'], 'large') : $settings['about_image_two']['url'];
            $about_image_two_alt = get_post_meta($settings["about_image_two"]["id"], "_wp_attachment_image_alt", true);
        }

		?>

        <?php if ( $settings['design_style']  == 'layout-1' ) : 
            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                }
            }
            ?>

            <section class="edcare-el-section about-section pt-120 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="about-img-wrap wow fade-in-left" data-wow-delay="400ms">
                                <div class="about-img-1">
                                    <img src="<?php print esc_url($about_image); ?>" alt="<?php print esc_attr($about_image_alt); ?>">
                                    <?php if ( !empty( $settings['video_url'] ) ) : ?>
                                        <div class="video-btn">
                                            <a
                                                class="video-popup venobox"
                                                data-autoplay="true"
                                                data-vbtype="video"
                                                href="<?php print esc_url($settings['video_url']); ?>">
                                                <div class="play-btn">
                                                    <i class="fa-sharp fa-solid fa-play"></i>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="about-img-2">
                                    <img src="<?php print esc_url($about_image_two); ?>" alt="<?php print esc_attr($about_image_two_alt); ?>">
                                </div>
                                <?php if ( !empty( $settings['phone_switch'] ) ) : ?>
                                    <div class="about-contact">
                                        <div class="icon">
                                            <i class="fa-sharp fa-regular fa-phone-volume"></i>
                                        </div>
                                        <div class="content">
                                            <?php if ( !empty( $settings['phone_number_label'] ) ) : ?>
                                                <span><?php print edcare_kses($settings['phone_number_label']); ?></span>
                                            <?php endif; ?>
                                            <a href="tel:<?php print esc_attr($settings['phone_number_link']); ?>">
                                                <?php print edcare_kses($settings['phone_number']); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="about-content">
                                <div class="section-heading mb-40">
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
                                    <?php if ( !empty( $settings['section_description'] ) ) : ?>
                                        <p class="edcare-el-section-description mt-20 wow fade-in-bottom" data-wow-delay="500ms">
                                            <?php print edcare_kses($settings['section_description']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="about-counter-items wow fade-in-bottom" data-wow-delay="600ms">
                                    <?php foreach ($settings['fun_fact_list'] as $item) : ?>
                                        <div class="about-counter-item">
                                            <?php if ( $item['fun_fact_icon_type']  == 'image' ): ?>
                                                <div class="icon">
                                                    <img class="img-fluid" src="<?php echo $item['fun_fact_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['fun_fact_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </div>
                                            <?php elseif ( $item['fun_fact_icon_type']  == 'icon' ): ?>
                                                <div class="icon">
                                                    <?php edcare_render_icon($item, 'fun_fact_icon' ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="content">
                                                <h3 class="title">
                                                    <span class="odometer" data-count="<?php print esc_attr($item['fun_fact_count']); ?>">
                                                        <?php print esc_html( '0', 'edcare-core' ); ?>
                                                    </span>
                                                    <?php if ( !empty( $item['fun_fact_sign'] ) ) : ?>
                                                        <span class="number">
                                                            <?php print esc_html($item['fun_fact_sign']); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </h3>
                                                <?php if ( !empty( $item['fun_fact_title'] ) ) : ?>
                                                    <p><?php print edcare_kses($item['fun_fact_title']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php if ( !empty( $settings['section_button_text'] ) ) : ?>
                                    <div class="about-btn wow fade-in-bottom" data-wow-delay="700ms">
                                        <?php
                                            $section_button_icon = !empty($settings['section_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_button_icon']['value']) . '"></i>' : '';
                                            $section_button_text = edcare_kses($settings['section_button_text']);

                                            // Start generating the anchor tag correctly
                                            $attributes = $this->get_render_attribute_string('section-button-arg');
                                            $section_button_class = 'edcare-el-button ' . ($settings['section_button_icon_position'] === 'after' ? 'right' : 'left') . ' rr-btn';

                                            echo '<a ' . $attributes . ' class="' . esc_attr($section_button_class) . '">' . $section_button_text . $section_button_icon . '</a>';
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : 
            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                }
            }
            ?>

            <section class="edcare-el-section about-section-3 pt-120 pb-120">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/about-shape-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/about-shape-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-3">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/about-shape-3.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <?php if ( !empty( $about_image ) ) : ?>
                                <div class="about-img-wrap-3 wow fade-in-left" data-wow-delay="400ms">
                                    <div class="about-img">
                                        <img class="main-img" src="<?php print esc_url($about_image); ?>" alt="<?php print esc_attr($about_image_alt); ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="about-content-3">
                                <div class="section-heading mb-20">
                                    <?php if ( !empty( $settings['section_subheading'] ) ) : ?>
                                        <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="300ms">
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
                                    <p class="edcare-el-section-description mb-30 wow fade-in-bottom" data-wow-delay="500ms">
                                        <?php print edcare_kses($settings['section_description']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ( !empty( $settings['section_button_text'] ) ) : ?>
                                    <?php
                                        $section_button_icon = !empty($settings['section_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_button_icon']['value']) . '"></i>' : '';
                                        $section_button_text = edcare_kses($settings['section_button_text']);

                                        // Start generating the anchor tag correctly
                                        $attributes = $this->get_render_attribute_string('section-button-arg');
                                        $section_button_class = 'edcare-el-button ' . ($settings['section_button_icon_position'] === 'after' ? 'right' : 'left') . ' rr-btn';

                                        echo '<a ' . $attributes . ' class="' . esc_attr($section_button_class) . '">' . $section_button_text . $section_button_icon . '</a>';
                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        <?php elseif ( $settings['design_style']  == 'layout-3' ) : 

            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute('section-button-arg', 'href', get_permalink($settings['section_button_page_link']));
                $this->add_render_attribute('section-button-arg', 'target', '_self');
                $this->add_render_attribute('section-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute('section-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                }
            }
        ?>

            <section class="edcare-el-section about-section-4 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="faq-img-wrap about-img-wrap-4 wow fade-in-left" data-wow-delay="400ms">
                                <?php if ( !empty( $about_image ) ) : ?>
                                    <div class="faq-img">
                                        <img src="<?php print esc_url($about_image); ?>" alt="<?php print esc_attr($about_image_alt); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="faq-text-box">
                                    <?php if ( !empty( $settings['student_title'] ) ) : ?>
                                        <h4 class="student">
                                            <?php print edcare_kses($settings['student_title']); ?>
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
                                        <?php if ( !empty( $settings['student_number'] ) ) : ?>
                                            <li class="number">
                                                <?php print edcare_kses($settings['student_number']); ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="about-content-4">
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
                                    <p class="edcare-el-section-description mb-30 wow fade-in-bottom" data-wow-delay="400ms">
                                        <?php print edcare_kses($settings['section_description']); ?>
                                    </p>
                                <?php endif; ?>
                                <div class="about-items wow fade-in-bottom" data-wow-delay="500ms">
                                    <?php foreach ($settings['features_list_one'] as $index => $item) : ?>
                                        <div class="about-item">
                                            <?php if ( $item['features_icon_type']  == 'image' ): ?>
                                                <div class="icon">
                                                    <img src="<?php echo $item['features_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['features_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </div>
                                            <?php elseif ( $item['features_icon_type']  == 'icon' ): ?>
                                                <div class="icon">
                                                    <?php edcare_render_icon($item, 'features_icon' ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="content">
                                                <?php if ( !empty( $item['features_title'] ) ) : ?>
                                                    <h4 class="title">
                                                        <?php echo edcare_kses($item['features_title']); ?>
                                                    </h4>
                                                <?php endif; ?>
                                                <?php if ( !empty( $item['features_description'] ) ) : ?>
                                                    <p class="mb-0">
                                                        <?php echo edcare_kses($item['features_description']); ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php if ( !empty( $settings['section_button_text'] ) ) : ?>
                                    <div class="about-btn wow fade-in-bottom" data-wow-delay="600ms">
                                        <?php
                                            $section_button_icon = !empty($settings['section_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_button_icon']['value']) . '"></i>' : '';
                                            $section_button_text = edcare_kses($settings['section_button_text']);

                                            // Start generating the anchor tag correctly
                                            $attributes = $this->get_render_attribute_string('section-button-arg');
                                            $section_button_class = 'edcare-el-button ' . ($settings['section_button_icon_position'] === 'after' ? 'right' : 'left') . ' rr-btn';

                                            echo '<a ' . $attributes . ' class="' . esc_attr($section_button_class) . '">' . $section_button_text . $section_button_icon . '</a>';
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-4' ) :

            if ('2' == $settings['section_button_link_type']) {
                $this->add_render_attribute( 'section-button-arg', 'href', get_permalink($settings['section_button_page_link']) );
                $this->add_render_attribute( 'section-button-arg', 'target', '_self' );
                $this->add_render_attribute( 'section-button-arg', 'rel', 'nofollow' );
                $this->add_render_attribute( 'section-button-arg', 'class', 'edcare-el-button ed-primary-btn' );
            } else {
                if ( ! empty( $settings['section_button_link']['url'] ) ) {
                    $this->add_link_attributes( 'section-button-arg', $settings['section_button_link'] );
                    $this->add_render_attribute( 'section-button-arg', 'class', 'edcare-el-button ed-primary-btn' );
                }
            }

        ?>

            <section class="edcare-el-section content-section-2 pt-120 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="content-img-wrap-2 wow fade-in-left" data-wow-delay="400ms">
                                <?php if ( !empty( $about_image ) ) : ?>
                                    <div class="content-img">
                                        <img src="<?php print esc_url($about_image); ?>" alt="<?php print esc_attr($about_image_alt); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if ( !empty( $settings['video_url'] ) ) : ?>
                                    <div class="video-btn">
                                        <a class="video-popup venobox" data-autoplay="true" data-vbtype="video" href="<?php print esc_url($settings['video_url']); ?>">
                                            <div class="play-btn">
                                                <i class="fa-sharp fa-solid fa-play"></i>
                                            </div>
                                            <div class="ripple"></div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="content-info-2">
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
                                    <p class="edcare-el-section-description wow fade-in-bottom" data-wow-delay="500ms">
                                        <?php print edcare_kses($settings['section_description']); ?>
                                    </p>
                                <?php endif; ?>
                                <ul class="content-list wow fade-in-bottom" data-wow-delay="600ms">
                                    <?php foreach ($settings['features_list_two'] as $index => $item) : ?>
                                        <li>
                                            <?php if ( $item['features_icon_type']  == 'image' ): ?>
                                                <div class="icon">
                                                    <img src="<?php echo $item['features_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['features_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                                </div>
                                            <?php elseif ( $item['features_icon_type']  == 'icon' ): ?>
                                                <div class="icon">
                                                    <?php edcare_render_icon($item, 'features_icon' ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <i class="fa fa-solid fa-check"></i>
                                            <?php echo edcare_kses($item['features_title']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if ( !empty( $settings['section_button_text'] ) ) : ?>
                                    <div class="content-btn wow fade-in-bottom" data-wow-delay="700ms">
                                        <?php
                                            $section_button_icon = !empty($settings['section_button_icon']['value']) ? '<i class="' . esc_attr($settings['section_button_icon']['value']) . '"></i>' : '';
                                            $section_button_text = edcare_kses($settings['section_button_text']);

                                            // Start generating the anchor tag correctly
                                            $attributes = $this->get_render_attribute_string('section-button-arg');
                                            $section_button_class = 'edcare-el-button ' . ($settings['section_button_icon_position'] === 'after' ? 'right' : 'left') . ' rr-btn';

                                            echo '<a ' . $attributes . ' class="' . esc_attr($section_button_class) . '">' . $section_button_text . $section_button_icon . '</a>';
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif;
	}
}

$widgets_manager->register( new EdCare_About() );