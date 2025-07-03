<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Features_Slider extends Widget_Base {

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
		return 'edcare_features_slider';
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
		return __( 'Features Slider', 'edcare-core' );
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
            '_content_title',
            [
                'label' => esc_html__( 'Title & Content',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => esc_html__( 'Style', 'edcare-core' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'layout-1',
                'options' => [
                    'layout-1' => esc_html__( 'Layout 1', 'edcare-core' ),
                    'layout-2'  => esc_html__( 'Layout 2', 'edcare-core' ),
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
                'label' => esc_html__( 'Subheading', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Latest Blog', 'text-domain' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Learn about our latest <br> news from blog.', 'text-domain' ),
                'label_block' => true,
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_features',
            [
                'label' => esc_html__( 'Features', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'features_image',
            [
                'label' => esc_html__( 'Choose Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'features_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'features_description',
            [
                'label' => esc_html__( 'Description', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'features_link_type',
            [
                'label' => esc_html__( 'Button Link Type', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'features_link',
            [
                'label' => esc_html__( 'Button link', 'text-domain' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'text-domain'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'features_link_type' => '1',
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'features_page_link',
            [
                'label' => esc_html__( 'Select Button Page', 'text-domain' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => edcare_get_all_pages(),
                'condition' => [
                    'features_link_type' => '2',
                ]
            ]
        );
        
        $this->add_control(
            'features_list',
            [
                'label' => esc_html__( 'Features List', 'text-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'features_title' => __( 'Web Development', 'text-domain' ),
                        'features_description' => __( '189 Course', 'text-domain' ),
                    ],
                    [
                        'features_title' => __( 'Business Growth', 'text-domain' ),
                        'features_description' => __( '122 Course', 'text-domain' ),
                    ],
                    [
                        'features_title' => __( 'Self Improvements', 'text-domain' ),
                        'features_description' => __( '530 Course', 'text-domain' ),
                    ],
                    [
                        'features_title' => __( 'Special Child Care', 'text-domain' ),
                        'features_description' => __( '199 Course', 'text-domain' ),
                    ],
                ],
                'title_field' => '{{{ features_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_design_layout',
            [
                'label' => esc_html__( 'Design Layout',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'design_layout_margin',
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
            'design_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_layout_image_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-feature-item .course-feature-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_navigation',
            [
                'label' => esc_html__( 'Navigation', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'navigation_tabs' );
        
        $this->start_controls_tab(
            'navigation_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'navigation_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-top .swiper-arrow .swiper-nav' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'navigation_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-top .swiper-arrow .swiper-nav' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_border',
                'selector' => '{{WRAPPER}} .course-top .swiper-arrow .swiper-nav',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'navigation_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'navigation_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-top .swiper-arrow .swiper-nav:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'navigation_background_hover',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-top .swiper-arrow .swiper-nav:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_border_hover',
                'selector' => '{{WRAPPER}} .course-top .swiper-arrow .swiper-nav:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
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
            '_style_features',
            [
                'label' => esc_html__( 'Features',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_features_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'features_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-feature-item .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'features_title_tabs' );
        
        $this->start_controls_tab(
            'features_title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'features_title_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER} .course-feature-item .content .title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'features_title_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'features_title_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER} .course-feature-item .content .title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'selector' => '{{WRAPPER}} .course-feature-item .content .title',
            ]
        );

        $this->add_control(
            '_heading_style_features_description',
            [
                'label' => esc_html__( 'Description', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'features_description_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-feature-item .content span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_description_typography',
                'selector' => '{{WRAPPER}} .course-feature-item .content span',
            ]
        );
        
        $this->add_control(
            '_heading_style_features_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .course-feature-item .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-feature-item .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-feature-item .content' => 'background-color: {{VALUE}}',
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

            <section class="edcare-el-section course-feature pt-120 pb-120">
                <div class="container">
                    <div class="course-top heading-space">
                        <div class="section-heading mb-0">
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
                        <div class="swiper-arrow">
                            <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-left"></i></div>
                            <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-right"></i></div>
                        </div>
                    </div>
                    <div class="course-feature-carosuel swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['features_list'] as $item) : 
                                if ( !empty($item['features_image']['url']) ) {
                                    $features_image = !empty($item['features_image']['id']) ? wp_get_attachment_image_url( $item['features_image']['id'], 'full') : $item['features_image']['url'];
                                    $features_image_alt = get_post_meta($item["features_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                                if ('2' == $item['features_link_type']) {
                                    $link = get_permalink($item['features_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['features_link']['url']) ? $item['features_link']['url'] : '';
                                    $target = !empty($item['features_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['features_link']['nofollow']) ? 'nofollow' : '';
                                }
                                ?>
                                <div class="swiper-slide">
                                    <div class="course-feature-item">
                                        <?php if ( !empty( $features_image ) ) : ?>
                                            <div class="course-feature-img">
                                                <img src="<?php print esc_url($features_image); ?>" alt="<?php print esc_attr($features_image_alt); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="content text-center">
                                            <h3 class="title">
                                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                                    <?php print edcare_kses($item['features_title']); ?>
                                                </a>
                                            </h3>
                                            <?php if ( !empty( $item['features_description'] ) ) : ?>
                                                <span>
                                                    <?php print edcare_kses($item['features_description']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            
        <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new EdCare_Features_Slider() );