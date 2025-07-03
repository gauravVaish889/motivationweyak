<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Instructor extends Widget_Base {

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
		return 'edcare_instructor';
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
		return __( 'Instructor', 'edcare-core' );
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
                    'design_style' => 'layout-5',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'edcare_teams',
            [
                'label' => esc_html__('Members', 'edcare-core'),
            ]
        );

        $this->start_controls_tabs( '_tab_style_member_box_item' );

        $this->start_controls_tab(
            'tab_member_info',
            [
                'label' => __( 'Information', 'edcare-core' ),
            ]
        );                  

        $this->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'edcare-core' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Name', 'edcare-core' ),
                'default' => __( 'Courtney Henry', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Designation', 'edcare-core' ),
                'default' => __( 'Software Tester', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'edcare_link_switcher',
            [
                'label' => esc_html__( 'Show Link', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edcare-core' ),
                'label_off' => esc_html__( 'No', 'edcare-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'edcare_link_type',
            [
                'label' => esc_html__( 'Link Type', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'edcare_link_switcher' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'edcare_link',
            [
                'label' => esc_html__( 'Link', 'edcare-core' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'edcare-core' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'edcare_link_type' => '1',
                    'edcare_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'edcare_page_link',
            [
                'label' => esc_html__( 'Select Link Page', 'edcare-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => edcare_get_all_pages(),
                'condition' => [
                    'edcare_link_type' => '2',
                    'edcare_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'wow_delay',
            [
                'label' => esc_html__( 'Animation Delay', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'default' => '200',
                'options' => [
                    '' => esc_html__( 'No', 'text-domain' ),
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

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'edcare-core' ),
                'label_off' => __( 'No', 'edcare-core' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'edcare-core' ),
                'placeholder' => __( 'Add your profile link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'edcare-core' ),
                'placeholder' => __( 'Add your email link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $this->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'edcare-core' ),
                'placeholder' => __( 'Add your phone link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'edcare-core' ),
                'default' => __( '#', 'edcare-core' ),
                'placeholder' => __( 'Add your facebook link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $this->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'edcare-core' ),
                'default' => __( '#', 'edcare-core' ),
                'placeholder' => __( 'Add your twitter link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'edcare-core' ),
                'default' => __( '#', 'edcare-core' ),
                'placeholder' => __( 'Add your instagram link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $this->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'edcare-core' ),
                'placeholder' => __( 'Add your linkedin link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'edcare-core' ),
                'placeholder' => __( 'Add your youtube link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );    

        $this->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'edcare-core' ),
                'placeholder' => __( 'Add your flickr link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'edcare-core' ),
                'placeholder' => __( 'Add your vimeo link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'edcare-core' ),
                'placeholder' => __( 'Add your hehance link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'edcare-core' ),
                'placeholder' => __( 'Add your dribbble link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'edcare-core' ),
                'default' => '#',
                'placeholder' => __( 'Add your pinterest link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'edcare-core' ),
                'placeholder' => __( 'Add your github link', 'edcare-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
			'design_layout_style',
			[
				'label' => __( 'Design Layout', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'design_layout_margin',
            [
                'label' => __( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-item-3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-item-4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .team-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-item-3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-item-4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_layout_border_radius',
            [
                'label' => __( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-item-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-item-4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_layout_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-3' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-4' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_layout_border',
                'selector' => '{{WRAPPER}} .team-item, .team-item-3, .team-item-4',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'design_layout_image_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .team-item .team-thumb:before, .team-item-4 .team-thumb .overlay',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-4' ],
                ],
            ]
        );

        $this->start_controls_tabs( 'design_layout_tabs' );
        
        $this->start_controls_tab(
            'design_layout_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'name_layout_border',
                'selector' => '{{WRAPPER}} .team-item-3 .team-thumb-wrap, .team-item-4 .team-content .team-social',
                'condition' => [
                    'design_style' => [ 'layout-3', 'layout-4' ],
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            '_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'name_layout_border_hover',
                'selector' => '{{WRAPPER}} .team-item-3:hover .team-thumb-wrap',
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

		$this->end_controls_section();

        $this->start_controls_section(
			'team_member_style',
			[
				'label' => __( 'Members', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            '_heading_icon_wrapper',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Icon Wrapper', 'edcare-core' ),
            ]
        );

        $this->start_controls_tabs( 'tabs_icon_wrapper_style' );

        $this->start_controls_tab(
            'icon_wrapper_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'icon_wrapper_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .expand' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_wrapper_background',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .expand' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_wrapper_border',
                'selector' => '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .expand',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_wrapper_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'icon_wrapper_color_hover',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .expand:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_wrapper_background_hover',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .expand:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_wrapper_border_hover',
                'selector' => '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .expand:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            '_heading_style_social_icon',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Icon', 'edcare-core' ),
            ]
        );

        $this->start_controls_tabs( 'tabs_info_icon_type' );

        $this->start_controls_tab(
            'icon_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-thumb .team-social li a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .social-list li a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-4 .team-content .team-social li a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-3 .social-list li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-thumb .team-social li a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .social-list li a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-3 .social-list li a' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3', 'layout-5' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .team-item .team-thumb .team-social li a, .team-item-2 .team-thumb .team-content .team-social .social-list li a, .team-item-3 .social-list li a',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3', 'layout-5' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-thumb .team-social li a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .social-list li a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-item-4 .team-content .team-social li a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-item-3 .social-list li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background_hover',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-thumb .team-social li a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .team-social .social-list li a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-3 .social-list li a:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3', 'layout-5' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border_hover',
                'selector' => '{{WRAPPER}} .team-item .team-thumb .team-social li a:hover, .team-item-2 .team-thumb .team-content .team-social .social-list li a:hover, .team-item-3 .social-list li a:hover',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3', 'layout-5' ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            '_heading_member_name',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Name', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'member_name_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .instructor-info .title' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .team-item-3 .team-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .team-item-4 .team-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );

		$this->start_controls_tabs( 'member_name_tabs' );
        
        $this->start_controls_tab(
            'member_name_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'member_name_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-content .title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .instructor-info .title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-3 .team-content .title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-4 .team-content .title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'member_name_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );

		$this->add_control(
            'member_name_color_hover',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-content .title a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .instructor-info .title a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-3 .team-content .title a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-4 .team-content .title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'member_name_typography',
                'selector' => '{{WRAPPER}} .team-item .team-content .title, .team-item-2 .team-thumb .team-content .instructor-info .title, .team-item-3 .team-content .title, .team-item-4 .team-content .title',
            ]
        );

        // Name
        $this->add_control(
            '_heading_member_designation',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Designation', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

		$this->add_control(
            'member_designation_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-content span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content .instructor-info span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-4 .team-content span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-3 .team-content span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'member_designation_typography',
                'selector' => '{{WRAPPER}} .team-item .team-content span, .team-item-2 .team-thumb .team-content .instructor-info span, .team-item-4 .team-content span, .team-item-3 .team-content span',
            ]
        );

        $this->add_control(
            '_heading_style_name_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'name_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-content' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'name_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'name_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-item-2 .team-thumb .team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->add_render_attribute('title_args', 'class', 'section-title__title');

        if ( !empty($settings['image']['url']) ) {
            $edcare_team_image_url = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], 'full') : $settings['image']['url'];
            $edcare_team_image_alt = get_post_meta($settings["image"]["id"], "_wp_attachment_image_alt", true);
        }
        
        // Link
        if ('2' == $settings['edcare_link_type']) {
            $link = get_permalink($settings['edcare_page_link']);
            $target = '_self';
            $rel = 'nofollow';
        } else {
            $link = !empty($settings['edcare_link']['url']) ? $settings['edcare_link']['url'] : '';
            $target = !empty($settings['edcare_link']['is_external']) ? '_blank' : '';
            $rel = !empty($settings['edcare_link']['nofollow']) ? 'nofollow' : '';
        }
        

		?>

            <?php if ( $settings['design_style']  == 'layout-1' ): ?>

                <div class="team-item wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                    <div class="team-thumb">
                        <img src="<?php echo esc_url($edcare_team_image_url); ?>" alt="<?php echo esc_attr($edcare_team_image_alt); ?>">
                        <ul class="team-social">
                            <?php if( !empty($settings['facebook_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['facebook_title'] ); ?>">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['twitter_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['twitter_title'] ); ?>">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['pinterest_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['pinterest_title'] ); ?>">
                                        <i class="fa-brands fa-pinterest-p"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['instagram_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['instagram_title'] ); ?>">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['linkedin_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['linkedin_title'] ); ?>">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['youtube_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['youtube_title'] ); ?>">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['flickr_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['flickr_title'] ); ?>">
                                        <i class="fa-brands fa-flickr"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['vimeo_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['vimeo_title'] ); ?>">
                                        <i class="fa-brands fa-vimeo-v"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['behance_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['behance_title'] ); ?>">
                                        <i class="fa-brands fa-behance"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['dribble_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['dribble_title'] ); ?>">
                                        <i class="fa-brands fa-dribbble"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['phone_title'] ) ) : ?>
                                <li>
                                    <a href="tel:<?php echo esc_url( $settings['phone_title'] ); ?>">
                                        <i class="fa-brands fa-phone-alt"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['gitub_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['gitub_title'] ); ?>">
                                        <i class="fa-brands fa-github"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['web_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['web_title'] ); ?>">
                                        <i class="fa-brands fa-globe"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty($settings['email_title'] ) ) : ?>
                                <li>
                                    <a href="mailto:<?php echo esc_url( $settings['email_title'] ); ?>">
                                        <i class="fa-brands fa-envelope"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="team-content">
                        <h3 class="title">
                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                <?php echo edcare_kses( $settings['title'] ); ?>
                            </a>
                        </h3>
                        <?php if( !empty($settings['designation']) ) : ?>
                            <span>
                                <?php echo edcare_kses($settings['designation'] ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

            <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

                <div class="team-item-2 wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                    <div class="team-thumb">
                        <img src="<?php echo esc_url($edcare_team_image_url); ?>" alt="<?php echo esc_attr($edcare_team_image_alt); ?>">
                        <div class="team-content">
                            <div class="instructor-info">
                                <h3 class="title">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                        <?php echo edcare_kses( $settings['title'] ); ?>
                                    </a>
                                </h3>
                                <?php if( !empty($settings['designation']) ) : ?>
                                    <span>
                                        <?php echo edcare_kses( $settings['designation'] ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="team-social">
                                <div class="expand">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </div>
                                <ul class="social-list">
                                    <?php if( !empty($settings['facebook_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['facebook_title'] ); ?>">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['twitter_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['twitter_title'] ); ?>">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['pinterest_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['pinterest_title'] ); ?>">
                                                <i class="fab fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['instagram_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['instagram_title'] ); ?>">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['linkedin_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['linkedin_title'] ); ?>">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['youtube_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['youtube_title'] ); ?>">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['flickr_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['flickr_title'] ); ?>">
                                                <i class="fab fa-flickr"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['vimeo_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['vimeo_title'] ); ?>">
                                                <i class="fab fa-vimeo-v"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['behance_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['behance_title'] ); ?>">
                                                <i class="fa-brands fa-behance"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['dribble_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['dribble_title'] ); ?>">
                                                <i class="fa-brands fa-dribbble"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['phone_title'] ) ) : ?>
                                        <li>
                                            <a href="tel:<?php echo esc_url( $settings['phone_title'] ); ?>">
                                                <i class="fas fa-phone-alt"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>  

                                    <?php if( !empty($settings['gitub_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['gitub_title'] ); ?>">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( !empty($settings['web_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $settings['web_title'] ); ?>">
                                                <i class="fas fa-globe"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>  

                                    <?php if( !empty($settings['email_title'] ) ) : ?>
                                        <li>
                                            <a href="mailto:<?php echo esc_url( $settings['email_title'] ); ?>">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif ( $settings['design_style']  == 'layout-3' ) : ?>

                <div class="team-item-3 wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                    <div class="team-thumb-wrap">
                        <div class="team-thumb">
                            <img src="<?php echo esc_url($edcare_team_image_url); ?>" alt="<?php echo esc_attr($edcare_team_image_alt); ?>">
                        </div>
                    </div>
                    <div class="team-content">
                        <h3 class="title">
                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                <?php echo edcare_kses( $settings['title'] ); ?>
                            </a>
                        </h3>
                        <?php if( !empty($settings['designation']) ) : ?>
                            <span>
                                <?php echo edcare_kses( $settings['designation'] ); ?>
                            </span>
                        <?php endif; ?>
                        <ul class="social-list">
                            <?php if( !empty($settings['facebook_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['facebook_title'] ); ?>">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['twitter_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['twitter_title'] ); ?>">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['pinterest_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['pinterest_title'] ); ?>">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['instagram_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['instagram_title'] ); ?>">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['linkedin_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['linkedin_title'] ); ?>">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['youtube_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['youtube_title'] ); ?>">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['flickr_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['flickr_title'] ); ?>">
                                        <i class="fab fa-flickr"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['vimeo_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['vimeo_title'] ); ?>">
                                        <i class="fab fa-vimeo-v"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['behance_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['behance_title'] ); ?>">
                                        <i class="fa-brands fa-behance"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['dribble_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['dribble_title'] ); ?>">
                                        <i class="fa-brands fa-dribbble"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['phone_title'] ) ) : ?>
                                <li>
                                    <a href="tel:<?php echo esc_url( $settings['phone_title'] ); ?>">
                                        <i class="fas fa-phone-alt"></i>
                                    </a>
                                </li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['gitub_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['gitub_title'] ); ?>">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['web_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['web_title'] ); ?>">
                                        <i class="fas fa-globe"></i>
                                    </a>
                                </li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['email_title'] ) ) : ?>
                                <li>
                                    <a href="mailto:<?php echo esc_url( $settings['email_title'] ); ?>">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            <?php elseif ( $settings['design_style']  == 'layout-4' ) : ?>

                <div class="team-item-4 wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                    <div class="team-thumb">
                        <div class="overlay"></div>
                        <img src="<?php echo esc_url($edcare_team_image_url); ?>" alt="<?php echo esc_attr($edcare_team_image_alt); ?>">
                    </div>
                    <div class="team-content">
                        <h3 class="title">
                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                <?php echo edcare_kses( $settings['title'] ); ?>
                            </a>
                        </h3>
                        <?php if( !empty($settings['designation']) ) : ?>
                            <span>
                                <?php echo edcare_kses( $settings['designation'] ); ?>
                            </span>
                        <?php endif; ?>
                        <ul class="team-social">
                            <?php if( !empty($settings['facebook_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['facebook_title'] ); ?>">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['twitter_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['twitter_title'] ); ?>">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['pinterest_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['pinterest_title'] ); ?>">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['instagram_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['instagram_title'] ); ?>">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['linkedin_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['linkedin_title'] ); ?>">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['youtube_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['youtube_title'] ); ?>">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['flickr_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['flickr_title'] ); ?>">
                                        <i class="fab fa-flickr"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['vimeo_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['vimeo_title'] ); ?>">
                                        <i class="fab fa-vimeo-v"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['behance_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['behance_title'] ); ?>">
                                        <i class="fa-brands fa-behance"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['dribble_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['dribble_title'] ); ?>">
                                        <i class="fa-brands fa-dribbble"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['phone_title'] ) ) : ?>
                                <li>
                                    <a href="tel:<?php echo esc_url( $settings['phone_title'] ); ?>">
                                        <i class="fas fa-phone-alt"></i>
                                    </a>
                                </li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['gitub_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['gitub_title'] ); ?>">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['web_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['web_title'] ); ?>">
                                        <i class="fas fa-globe"></i>
                                    </a>
                                </li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['email_title'] ) ) : ?>
                                <li>
                                    <a href="mailto:<?php echo esc_url( $settings['email_title'] ); ?>">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            <?php elseif ( $settings['design_style']  == 'layout-5' ) : ?>

                <div class="team-item-3 team-item-5 wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>">
                    <div class="team-thumb">
                        <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                            <div class="shape">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/team-shape-3.png' ); ?>" alt="<?php print esc_attr( 'team', 'edcare-core' ); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="team-men">
                            <img src="<?php echo esc_url($edcare_team_image_url); ?>" alt="<?php echo esc_attr($edcare_team_image_alt); ?>">
                        </div>
                    </div>
                    <div class="team-content">
                        <h3 class="title">
                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                <?php echo edcare_kses( $settings['title'] ); ?>
                            </a>
                        </h3>
                        <?php if( !empty($settings['designation']) ) : ?>
                            <span>
                                <?php echo edcare_kses( $settings['designation'] ); ?>
                            </span>
                        <?php endif; ?>
                        <ul class="social-list">
                            <?php if( !empty($settings['facebook_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['facebook_title'] ); ?>">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['twitter_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['twitter_title'] ); ?>">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['pinterest_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['pinterest_title'] ); ?>">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['instagram_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['instagram_title'] ); ?>">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['linkedin_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['linkedin_title'] ); ?>">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['youtube_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['youtube_title'] ); ?>">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['flickr_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['flickr_title'] ); ?>">
                                        <i class="fab fa-flickr"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['vimeo_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['vimeo_title'] ); ?>">
                                        <i class="fab fa-vimeo-v"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['behance_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['behance_title'] ); ?>">
                                        <i class="fa-brands fa-behance"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['dribble_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['dribble_title'] ); ?>">
                                        <i class="fa-brands fa-dribbble"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['phone_title'] ) ) : ?>
                                <li>
                                    <a href="tel:<?php echo esc_url( $settings['phone_title'] ); ?>">
                                        <i class="fas fa-phone-alt"></i>
                                    </a>
                                </li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['gitub_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['gitub_title'] ); ?>">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if( !empty($settings['web_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $settings['web_title'] ); ?>">
                                        <i class="fas fa-globe"></i>
                                    </a>
                                </li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['email_title'] ) ) : ?>
                                <li>
                                    <a href="mailto:<?php echo esc_url( $settings['email_title'] ); ?>">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            <?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new EdCare_Instructor() );