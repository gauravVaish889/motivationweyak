<?php
namespace EdCareCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
Use \Elementor\Core\Schemes\Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Pricing extends Widget_Base {

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
		return 'edcare_pricing';
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
		return __( 'Pricing', 'edcare-core' );
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
            '_content_pricing',
            [
                'label' => esc_html__( 'Pricing',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'design_style',
            [
                'label' => esc_html__( 'Select Layout', 'text-domain' ),
                'type' => Controls_Manager::HIDDEN,
                'options' => [
                    'layout-1' => esc_html__( 'Layout 1', 'text-domain' ),
                    'layout-2' => esc_html__( 'Layout 2', 'text-domain' ),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'package_name',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Basic Plan', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__('Currency', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'edcare-core'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'edcare-core'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'edcare-core'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'edcare-core'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'edcare-core'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'edcare-core'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'edcare-core'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'edcare-core'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'edcare-core'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'edcare-core'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'edcare-core'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'edcare-core'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'edcare-core'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'edcare-core'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'edcare-core'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'edcare-core'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'edcare-core'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'edcare-core'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'edcare-core'),
                    'custom' => __('Custom', 'edcare-core'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => esc_html__('Custom Symbol', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'package_price',
            [
                'label' => esc_html__('Price', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '29',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );   

        $this->add_control(
            'package_duration',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '/Per month', 'text-domain' ),
                'label_block' => true,
            ]
        );     

        $this->add_control(
            'package_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __( 'Lorem ipsum dolor sit consect adipisicing elit sed. do eilt sed.', 'text-domain' ),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_feature',
            [
                'label' => esc_html__( 'Feature',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'feature_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'feature_active',
            [
                'label' => esc_html__( 'Active?', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'text-domain' ),
                    'no' => esc_html__( 'No', 'text-domain' ),
                ],
            ]
        );

        $repeater->add_control(
            'feature_icon_type',
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
            'feature_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'feature_icon_type' => 'image',
                ],
            ]
        );
        
        $repeater->add_control(
            'feature_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
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
        
        $this->add_control(
            'feature_list',
            [
                'label' => esc_html__( 'Feature List', 'text-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'feature_active' => 'yes',
                        'feature_title' => __( 'Individual Course', 'text-domain' ),
                    ],
                    [
                        'feature_active' => 'yes',
                        'feature_title' => __( 'Course Learning Checks', 'text-domain' ),
                    ],
                    [
                        'feature_active' => 'no',
                        'feature_title' => __( 'Offline Learning', 'text-domain' ),
                    ],
                    [
                        'feature_active' => 'no',
                        'feature_title' => __( 'Course Discussions', 'text-domain' ),
                    ],
                    [
                        'feature_active' => 'no',
                        'feature_title' => __( 'One to One Guidance', 'text-domain' ),
                    ],
                ],
                'title_field' => '{{{ feature_title }}}',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_button',
            [
                'label' => esc_html__( 'Button', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'section_button_text',
            [
                'label' => esc_html__( 'Button Text', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Register Now', 'edcare-core' ),
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
                'label_block' => true,
                'default' => [
                    'value' => 'fa-sharp fa-regular fa-arrow-right',
                    'library' => 'fa-solid',
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
                    '{{WRAPPER}} .edcare-el-button i' => 'padding-left: {{SIZE}}{{UNIT}};',
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
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'edcare_layout_style',
			[
				'label' => esc_html__( 'Design Layout', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'design_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
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
                'label' => esc_html__( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '_style_pricing',
            [
                'label' => esc_html__('Pricing', 'edcare-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_package_name',
            [
                'label' => esc_html__( 'Package Name', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'package_name_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'package_name_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top .title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'edcare-core' ),
                'name'     => 'package_name_typography',
                'selector' => '{{WRAPPER}} .pricing-item .pricing-top .title',
            ]
        );

        $this->add_control(
            '_heading_style_price',
            [
                'label' => esc_html__( 'Price', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'price_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top .price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'price_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top .price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'edcare-core' ),
                'name'     => 'price_typography',
                'selector' => '{{WRAPPER}} .pricing-item .pricing-top .price',
            ]
        );

        $this->add_control(
            '_heading_style_package_duration',
            [
                'label' => esc_html__( 'Duration', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'duration_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top .price span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'duration_typography',
                'selector' => '{{WRAPPER}} .pricing-item .pricing-top .price span',
            ]
        );

        $this->add_control(
            '_heading_style_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'edcare-core' ),
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .pricing-item .pricing-top p',
            ]
        );

        $this->add_control(
            '_heading_style_package_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'package_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'package_layout_border',
                'selector' => '{{WRAPPER}} .pricing-item .pricing-top',
            ]
        );

        $this->add_responsive_control(
            'package_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'package_layout_margin',
            [
                'label' => esc_html__( 'Margin', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'package_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'_style_feature',
			[
				'label' => esc_html__( 'Feature', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
            'feature_icon_right_spacing',
            [
                'label' => esc_html__( 'Right Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-list li i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'feature_icon_tabs' );
        
        $this->start_controls_tab(
            'feature_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'feature_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-list li.cross i' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'feature_icon_active_tab',
            [
                'label' => esc_html__( 'Active', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'feature_icon_color_active',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-list li i' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_style_feature_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'feature_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-list li:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'feature_title_tabs' );
        
        $this->start_controls_tab(
            'feature_title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'feature_title_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-list li.cross' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'feature_title_active_tab',
            [
                'label' => esc_html__( 'Active', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'feature_title_color_active',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-item .pricing-list li' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_title_typography',
                'selector' => '{{WRAPPER}} .pricing-item .pricing-list li',
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
			'_style_button',
			[
				'label' => esc_html__( 'Button', 'edcare-core' ),
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
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button'    => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
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
                    '{{WRAPPER}} .edcare-el-button:hover' => 'color: {{VALUE}}!important;',
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
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border_hover',
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

		$this->end_controls_section();

	}

    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
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

            // Link
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

	        if ($settings['currency'] === 'custom') {
	            $currency = $settings['currency_custom'];
	        } else {
	            $currency = self::get_currency_symbol($settings['currency']);
	        }
		?>

            <?php if ( $settings['design_style']  == 'layout-1' ): ?>
            
                <div class="edcare-el-section pricing-item">
                    <div class="pricing-top">
                        <?php if ( !empty( $settings['package_name'] ) ) : ?>
                            <h4 class="title">
                                <?php print edcare_kses($settings['package_name']); ?>
                            </h4>
                        <?php endif; ?>
                        <h3 class="price">
                            <?php echo esc_html($currency); ?><?php echo edcare_kses($settings['package_price']); ?>
                            <?php if ( !empty( $settings['package_duration'] ) ) : ?>
                                <span><?php echo edcare_kses($settings['package_duration']); ?></span>
                            <?php endif; ?>
                        </h3>
                        <?php if ( !empty( $settings['package_description'] ) ) : ?>
                            <p><?php echo edcare_kses($settings['package_description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <ul class="pricing-list">
                        <?php foreach ($settings['feature_list'] as $item) : ?>
                            <?php if ( $item['feature_active']  == 'yes' ): ?>
                                <li>
                                    <?php if ( $item['feature_icon_type']  == 'image' ): ?>
                                        <img class="img-fluid" src="<?php echo $item['feature_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['feature_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php elseif ( $item['feature_icon_type']  == 'icon' ): ?>
                                        <?php edcare_render_icon($item, 'feature_icon' ); ?>
                                    <?php endif; ?>
                                    <?php print edcare_kses($item['feature_title']); ?>
                                </li>
                            <?php elseif ( $item['feature_active']  == 'no' ): ?>
                                <li class="cross">
                                    <?php if ( $item['feature_icon_type']  == 'image' ): ?>
                                        <img class="img-fluid" src="<?php echo $item['feature_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['feature_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php elseif ( $item['feature_icon_type']  == 'icon' ): ?>
                                        <?php edcare_render_icon($item, 'feature_icon' ); ?>
                                    <?php endif; ?>
                                    <?php print edcare_kses($item['feature_title']); ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ( !empty( $settings['section_button_text'] ) ) : ?>
                        <div class="pricing-btn">
                            <a <?php echo $this->get_render_attribute_string( 'section-button-arg' ); ?>>
                                <?php print edcare_kses($settings['section_button_text']); ?><?php edcare_render_icon($settings, 'section_button_icon' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            
            <?php elseif ( $settings['design_style']  == 'layout-2' ): ?>
            
            <?php endif; ?>

        <?php
	}

}

$widgets_manager->register( new EdCare_Pricing() );