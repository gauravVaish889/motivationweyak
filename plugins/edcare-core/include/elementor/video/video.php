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
class EdCare_Video extends Widget_Base {

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
		return 'edcare_video';
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
		return __( 'Video', 'edcare-core' );
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

        $this->end_controls_section();


        $this->start_controls_section(
            '_content_title',
            [
                'label' => esc_html__( 'Title & Content',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Career Opportunities in EdCare', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Appropriately recaptiualize cooperative catalysts change through <br> prospective leadership nvisioneer goal-oriented', 'edcare-core' ),
                'label_block' => true,
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
                'default' => 'https://youtu.be/JwC-Qx1lJso?feature=shared',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_image',
            [
                'label' => esc_html__( 'Choose Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'wow_delay',
            [
                'label' => esc_html__( 'Animation Delay', 'edcare-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '400',
                'options' => [
                    '100' => esc_html__( '100ms', 'edcare-core' ),
                    '200' => esc_html__( '200ms', 'edcare-core' ),
                    '300' => esc_html__( '300ms', 'edcare-core' ),
                    '400' => esc_html__( '400ms', 'edcare-core' ),
                    '500' => esc_html__( '500ms', 'edcare-core' ),
                    '600' => esc_html__( '600ms', 'edcare-core' ),
                    '700' => esc_html__( '700ms', 'edcare-core' ),
                    '800' => esc_html__( '800ms', 'edcare-core' ),
                    '900' => esc_html__( '900ms', 'edcare-core' ),
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_contact_info_style',
            [
                'label' => __( 'Design Layout', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            'design_layout_margin',
            [
                'label'      => esc_html__( 'Margin', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .video-feature' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-content.hero-content-6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_layout_padding',
            [
                'label'      => esc_html__( 'Padding', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .video-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-content.hero-content-6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_layout_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-feature' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content.hero-content-6' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .content-img-wrap-2' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_layout_border',
                'selector' => '{{WRAPPER}} .video-feature, .hero-content.hero-content-6, .content-img-wrap-2',
            ]
        );

        $this->add_control(
            'design_layout_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .video-feature' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .hero-content.hero-content-6' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .video-feature, .hero-content.hero-content-6, .content-img-wrap-2',
            ]
        );

        $this->end_controls_section();

        // Title & Content Style
        $this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title & Content',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );

        $this->add_control(
            '_heading_style_section_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'edcare-core' ),
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'section_title_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hero-content.hero-content-6 .hero-btn-wrap .video-btn a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-content .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content.hero-content-6 .hero-btn-wrap .video-btn a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );

        $this->add_control(
            'video_title_color_hover',
            [
                'label' => esc_html__( 'Color (Hover)', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} .video-feature .video-content .title, .hero-content.hero-content-6 .hero-btn-wrap .video-btn a',
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2' ],
                ],
            ]
        );

        $this->add_control(
            '_heading_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'edcare-core' ),
                'separator' => 'before',
                'condition' => [
                    'design_style' => [ 'layout-1' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'section_description_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1' ],
                ],
            ]
        );

        $this->add_control(
            'section_description_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-1' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .video-feature .video-content p',
                'condition' => [
                    'design_style' => [ 'layout-1' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_image',
            [
                'label' => esc_html__( 'Image',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-3' ],
                ],
            ]
        );

        $this->add_control(
            '_heading_style_image',
            [
                'label' => esc_html__( 'Image', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2 .content-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2 .content-img img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'video_bg_image_width',
            [
                'label' => esc_html__('Width', 'pixfix-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => 'px'
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-img-wrap-2 .content-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'video_bg_image_height',
            [
                'label' => esc_html__('Height', 'pixfix-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => 'px'
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-img-wrap-2 .content-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-3' ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_heading_style_video',
            [
                'label' => esc_html__( 'Video',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design_style' => [ 'layout-1', 'layout-2', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-thumb .video-btn a' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .home-8__video a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'video_icon_width',
            [
                'label' => esc_html__('Width', 'pixfix-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => 'px'
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .home-8__video a' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .home-8__video a .ripple' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon_height',
            [
                'label' => esc_html__('Height', 'pixfix-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => 'px'
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 50
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .home-8__video a' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .home-8__video a .ripple' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-4' ],
                ],
            ]
        );

        $this->start_controls_tabs( 'video_tabs' );

        $this->start_controls_tab(
            'video_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'video_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-thumb .video-btn a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .home-8__video a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'video_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-thumb .video-btn a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a i' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .home-8__video a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'video_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'video_color_hover',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-thumb .video-btn a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .home-8__video a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'video_background_hover',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-feature .video-thumb .video-btn a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hero-content .hero-btn-wrap .hero-video a:hover i' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .content-img-wrap-2 .video-btn a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .home-8__video a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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

		?>

            <?php if ( $settings['design_style']  == 'layout-1' ): ?>

                <div class="video-feature text-center wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>ms">
                    <div class="video-thumb">
                        <img src="<?php print esc_url($section_image); ?>" alt="<?php print esc_attr($section_image_alt); ?>">
                        <div class="video-btn">
                            <a class="video-popup venobox" data-autoplay="true" data-vbtype="video" href="<?php print esc_attr($settings['video_url']); ?>">
                                <div class="play-btn">
                                    <i class="fa-sharp fa-solid fa-play"></i>
                                </div>
                                <div class="ripple"></div>
                            </a>
                        </div>
                    </div>
                    <div class="video-content">
                        <?php if ( !empty( $settings['section_title'] ) ) : ?>
                            <h3 class="title">
                                <?php print edcare_kses($settings['section_title']); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( !empty( $settings['section_description'] ) ) : ?>
                            <p><?php print edcare_kses($settings['section_description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

            <?php elseif ( $settings['design_style']  == 'layout-2' ): ?>

                <div class="hero-content hero-content-6 wow fade-in-bottom" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>ms">
                    <div class="hero-btn-wrap">
                        <div class="hero-video">
                            <div class="video-btn">
                                <a
                                    class="video-popup venobox"
                                    data-autoplay="true"
                                    data-vbtype="video"
                                    href="<?php print esc_attr($settings['video_url']); ?>">
                                    <div class="play-btn">
                                        <i class="fa-sharp fa-solid fa-play"></i>
                                    </div>

                                    <?php if ( !empty( $settings['section_title'] ) ) : ?>
                                        <?php print edcare_kses($settings['section_title']); ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif ( $settings['design_style']  == 'layout-3' ): ?>
                <div class="content-img-wrap-2 wow fade-in-left" data-wow-delay="<?php print esc_attr($settings['wow_delay']); ?>ms">
                    <?php if(!empty($section_image)) : ?>
                    <div class="content-img">
                        <img src="<?php print esc_url($section_image); ?>" alt="<?php print esc_attr($section_image_alt); ?>">
                    </div>
                    <?php endif; ?>

                    <?php if(!empty( $settings['video_url'] )) : ?>
                    <div class="video-btn">
                        <a class="video-popup venobox" data-autoplay="true" data-vbtype="video" href="<?php print esc_attr($settings['video_url']); ?>">
                            <div class="play-btn">
                                <i class="fa-sharp fa-solid fa-play"></i>
                            </div>
                            <div class="ripple"></div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

            <?php elseif ( $settings['design_style']  == 'layout-4' ): ?>

                <div class="home-8__video">
                    <a class="video-popup venobox" data-autoplay="true" data-vbtype="video" href="<?php print esc_attr($settings['video_url']); ?>">
                        <div class="play-btn">
                            <i class="fa-sharp fa-solid fa-play"></i>
                        </div>
                        <div class="ripple"></div>
                    </a>
                </div>

            <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new EdCare_Video() );