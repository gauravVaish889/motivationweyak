<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Blog_Post extends Widget_Base {

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
		return 'edcare_blog_post';
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
		return __( 'Blog Post', 'edcare-core' );
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
                    'layout-2'  => esc_html__( 'Layout 2', 'edcare-core' ),
                    'layout-3'  => esc_html__( 'Layout 3', 'edcare-core' ),
                    'layout-4'  => esc_html__( 'Layout 4', 'edcare-core' ),
                    'layout-5'  => esc_html__( 'Layout 5', 'edcare-core' ),
                    'layout-6'  => esc_html__( 'Layout 6', 'edcare-core' ),
                ],
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => esc_html__( 'Show Shape?', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => 'layout-6',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_title',
            [
                'label' => esc_html__( 'Title & Content',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title_switch',
            [
                'label' => esc_html__( 'Show Title?', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
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
                    'section_title_switch' => 'yes',
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
                    'section_title_switch' => 'yes',
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
                    'section_title_switch' => 'yes',
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
                'condition' => [
                    'section_title_switch' => 'yes',
                ],
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
                'condition' => [
                    'section_title_switch' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

		$this->start_controls_section(
            'post_query',
            [
                'label' => esc_html__('Blog Query', 'edcare-core'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

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
            'blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'edcare-core'),
                'description' => esc_html__('Set how many word you want to displa!', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'post_content',
            [
                'label' => __('Content', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'edcare-core'),
                'label_off' => __('Hide', 'edcare-core'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'post_content_limit',
            [
                'label' => __('Content Limit', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'post_content' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'btn_button_show',
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
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'edcare-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Read More', 'edcare-core'),
                'label_block' => true,
                'condition' => [
                    'btn_button_show' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_design_layout',
            [
                'label' => __( 'Design Layout', 'edcare-core' ),
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
                'label' => __( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'design_layout_image_hover',
            [
                'label' => __( 'Image Hover', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news-one__img:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .news-two__img:after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .news-three__img:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title & Content',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'section_title_switch' => 'yes',
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
			'_style_blog',
			[
				'label' => __( 'Blog Query', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            '_heading_style_blog_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'edcare-core' ),
            ]
        );

        $this->add_responsive_control(
            'blog_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .post-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_blog_title' );
        
        $this->start_controls_tab(
            'blog_title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'blog_title_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content .title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'blog_title_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'blog_title_color_hover',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content .title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_title_background_hover',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-content .title a',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_control(
            'blog_title_border_color',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-card-3 .post-content .title' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-6',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_title_typography',
                'selector' => '{{WRAPPER}} .news-one__title, .news-two__title, .news-three__title',
            ]
        );

        $this->add_control(
            '_heading_style_blog_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'edcare-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'blog_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .news-one__text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .news-three__text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'blog_description_color',
            [
                'label' => __( 'Text Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news-one__text' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .news-three__text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_description_typography',
                'selector' => '{{WRAPPER}} .news-one__text, .news-three__text',
            ]
        );

        $this->add_control(
            '_heading_style_blog_date',
            [
                'label' => esc_html__( 'Date', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-3',
                ],
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news-three__date p' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .news-three__date span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'date_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news-three__date' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_blog_category',
            [
                'label' => esc_html__( 'Category', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_category_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post-content .category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'blog_category_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content .category' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            'blog_category_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content .category' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_category_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post-content .category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_category_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post-content .category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_category_typography',
                'selector' => '{{WRAPPER}} .post-content .category',
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_meta',
            [
                'label' => esc_html__( 'Meta', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-meta li i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post-meta li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-card.post-card-1 .post-meta li' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-card-2 .post-content .post-meta li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .post-meta li',
            ]
        );

        $this->add_control(
            '_heading_style_link',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Link', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'link_spacing',
            [
                'label' => __( 'Top Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn' => 'margin-top: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .post-card-3 .post-content .read-more' => 'margin-top: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );

        $this->start_controls_tabs( '_link_style_tabs' );
        
        $this->start_controls_tab(
            'link_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'link_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-card-3 .post-content .read-more' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'link_background',
            [
                'label' => __( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-4' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'link_border',
                'selector' => '{{WRAPPER}} .ed-primary-btn',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-4' ],
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'link_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'link_color_hover',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-card-3 .post-content .read-more:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'link_background_hover',
            [
                'label' => __( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-4' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'link_border_hover',
                'selector' => '{{WRAPPER}} .ed-primary-btn:hover',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-4' ],
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_typography',
                'selector' => '{{WRAPPER}} .ed-primary-btn, .post-card-3 .post-content .read-more',
            ]
        );

        $this->add_responsive_control(
            'link_padding',
            [
                'label' => __( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'link_border_radius',
            [
                'label' => __( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ed-primary-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'design_style' => [ 'layout-2' ],
                ],
            ]
        );

        $this->add_control(
            '_blog_layout_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Layout', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'blog_layout_border',
                'selector' => '{{WRAPPER}} .post-card-2',
                'condition' => [
                    'design_style' => [ 'layout-2', 'layout-3', 'layout-6' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_layout_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-card .post-thumb:before, .post-card-2, .post-card-3',
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
            'post_type' => 'post',
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
                    'taxonomy'	=> 'category',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args);
        
        $this->add_render_attribute('section_title_args', 'class', 'section-title__title');

        if ( !empty($settings['blog_bg_img_1']['url']) ) {
            $blog_bg_img_1 = !empty($settings['blog_bg_img_1']['id']) ? wp_get_attachment_image_url( $settings['blog_bg_img_1']['id'], 'full' ) : $settings['blog_bg_img_1']['url'];
        }

        ?>

            <?php if ( $settings['design_style']  == 'layout-1' ): ?>

                <section class="edcare-el-section blog-section pt-120 pb-120">
                    <div class="container">
                        <?php if ( !empty( $settings['section_title_switch'] ) ) : ?>
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
                        <?php endif; ?>
                        <div class="row gy-md-0 gy-4">
                            <?php if ($query->have_posts()) : 
                                $wow_delay = 100;
                                ?>
                                <?php while ($query->have_posts()) : 
                                    $query->the_post();
                                    global $post;
                                    $categories = get_the_category($post->ID);
                                    $post_tags = get_the_tags();
                                ?>
                                <div class="col-md-6">
                                    <div class="post-card post-card-1 wow fade-in-bottom" data-wow-delay="<?php echo $wow_delay; ?>ms">
                                        <div class="post-thumb">
                                            <?php the_post_thumbnail('full');?>
                                        </div>
                                        <div class="post-content-wrap">
                                            <div class="post-content">
                                                <?php  if ( ! empty( $categories ) ) {
                                                    echo '<span class="category">' . esc_html( $categories[0]->name ) . '</span>';
                                                    }
                                                ?>
                                                <h3 class="title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), $settings['blog_title_word'], ''); ?>
                                                    </a>
                                                </h3>
                                                <ul class="post-meta">
                                                    <li><i class="fa-sharp fa-regular fa-clock"></i><?php the_time( get_option('date_format') ); ?></li>
                                                    <?php if ( !empty( $post_tags ) ) : ?>
                                                        <li><i class="fa-sharp fa-regular fa-folder"></i><?php print esc_html($post_tags[0]->name); ?></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $wow_delay += 100; ?>
                                <?php endwhile; wp_reset_query(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

            <?php elseif ( $settings['design_style']  == 'layout-2' ): ?>

                <section class="edcare-el-section blog-section pt-120 pb-120">
                    <div class="container">
                        <?php if ( !empty( $settings['section_title_switch'] ) ) : ?>
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
                        <?php endif; ?>
                        <div class="row gy-lg-0 gy-4 justify-content-center post-card-2-wrap">
                            <?php if ($query->have_posts()) : 
                                $wow_delay = 200;
                                ?>
                                <?php while ($query->have_posts()) : 
                                    $query->the_post();
                                    global $post;
                                    $categories = get_the_category($post->ID);
                                    $post_tags = get_the_tags();
                                ?>
                                <div class="col-lg-12 col-md-6">
                                    <div class="post-card-2 wow fade-in-bottom" data-wow-delay="<?php echo $wow_delay; ?>ms">
                                        <?php if (!empty( the_post_thumbnail() )): ?>
                                            <div class="post-thumb">
                                                <?php the_post_thumbnail( $post->ID );?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="post-content-wrap">
                                            <div class="post-content">
                                                <ul class="post-meta">
                                                    <li><i class="fa-sharp fa-regular fa-clock"></i><?php the_time( get_option('date_format') ); ?></li>
                                                    <?php if ( !empty( $post_tags ) ) : ?>
                                                        <li><i class="fa-sharp fa-regular fa-folder"></i><?php print esc_html($post_tags[0]->name); ?></li>
                                                    <?php endif; ?>
                                                </ul>
                                                <h3 class="title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), $settings['blog_title_word'], ''); ?>
                                                    </a>
                                                </h3>
                                                <?php if (!empty($settings['post_content'])):
                                                    $post_content_limit = (!empty($settings['post_content_limit'])) ? $settings['post_content_limit'] : '';
                                                    ?>
                                                    <p class="news-two__text">
                                                        <?php print wp_trim_words(get_the_excerpt(get_the_ID()), $post_content_limit, ''); ?>
                                                    </p>
                                                <?php endif; ?>
                                                <?php if (!empty($settings['btn_button_show'])): ?>
                                                    <a href="<?php the_permalink(); ?>" class="ed-primary-btn">
                                                        <?php print esc_html($settings['btn_text']);?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $wow_delay += 100; ?>
                                <?php endwhile; wp_reset_query(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

            <?php elseif ( $settings['design_style']  == 'layout-3' ): ?>

                <section class="edcare-el-section blog-section pt-120 pb-120">
                    <div class="container">
                        <?php if ( !empty( $settings['section_title_switch'] ) ) : ?>
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
                        <?php endif; ?>
                        <div class="row gy-lg-0 gy-4 justify-content-center post-card-2-wrap">
                            <?php if ($query->have_posts()) : 
                                $wow_delay = 300;
                            ?>
                            <?php while ($query->have_posts()) : 
                                $query->the_post();
                                global $post;
                                $categories = get_the_category($post->ID);
                                $post_tags = get_the_tags();
                            ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="post-card-2 post-card-3 wow fade-in-bottom" data-wow-delay="<?php echo $wow_delay; ?>ms">
                                    <?php if (!empty( the_post_thumbnail() )): ?>
                                        <div class="post-thumb">
                                            <?php the_post_thumbnail( $post->ID );?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-content-wrap">
                                        <div class="post-content">
                                            <ul class="post-meta">
                                                <li><i class="fa-sharp fa-regular fa-clock"></i><?php the_time( get_option('date_format') ); ?></li>
                                                <?php if ( !empty( $post_tags ) ) : ?>
                                                    <li><i class="fa-sharp fa-regular fa-folder"></i><?php print esc_html($post_tags[0]->name); ?></li>
                                                <?php endif; ?>
                                            </ul>
                                            <h3 class="title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php echo wp_trim_words(get_the_title(), $settings['blog_title_word'], ''); ?>
                                                </a>
                                            </h3>
                                            <?php if (!empty($settings['btn_button_show'])): ?>
                                                <a href="<?php the_permalink(); ?>" class="read-more">
                                                    <?php print esc_html($settings['btn_text']);?> <i class="fa-regular fa-arrow-right"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $wow_delay += 100; ?>
                                <?php endwhile; wp_reset_query(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

            <?php elseif ( $settings['design_style']  == 'layout-4' ): ?>

                <section class="edcare-el-section blog-section bg-grey pt-120 pb-120">
                    <div class="container">
                        <?php if ( !empty( $settings['section_title_switch'] ) ) : ?>
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
                        <?php endif; ?>
                        <div class="row gy-lg-0 gy-4 justify-content-center post-card-2-wrap">
                            <?php if ($query->have_posts()) : 
                                $wow_delay = 300;
                            ?>
                            <?php while ($query->have_posts()) : 
                                $query->the_post();
                                global $post;
                                $categories = get_the_category($post->ID);
                                $post_tags = get_the_tags();
                            ?>
                            <div class="col-lg-6 col-md-6">
                                <div class="post-card-2 post-card-3 grid-post wow fade-in-bottom" data-wow-delay="<?php print esc_attr($wow_delay); ?>ms">
                                    <?php if (!empty( the_post_thumbnail() )): ?>
                                        <div class="post-thumb">
                                            <?php the_post_thumbnail( $post->ID );?>
                                            <?php  if ( ! empty( $categories ) ) {
                                                echo '<span class="category">' . esc_html( $categories[0]->name ) . '</span>';
                                                }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-content-wrap">
                                        <div class="post-content">
                                            <h3 class="title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php echo wp_trim_words(get_the_title(), $settings['blog_title_word'], ''); ?>
                                                </a>
                                            </h3>
                                            <ul class="post-meta">
                                                <li><i class="fa-sharp fa-regular fa-clock"></i><?php the_time( get_option('date_format') ); ?></li>
                                                <?php if ( !empty( $post_tags ) ) : ?>
                                                    <li><i class="fa-sharp fa-regular fa-folder"></i><?php print esc_html($post_tags[0]->name); ?></li>
                                                <?php endif; ?>
                                            </ul>
                                            <?php if (!empty($settings['btn_button_show'])): ?>
                                                <a href="<?php the_permalink(); ?>" class="ed-primary-btn">
                                                    <?php print esc_html($settings['btn_text']);?> <i class="fa-regular fa-arrow-right"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $wow_delay += 100; ?>
                                <?php endwhile; wp_reset_query(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

            <?php elseif ( $settings['design_style']  == 'layout-5' ): ?>

                <section class="edcare-el-section blog-section pt-120 pb-120">
                    <div class="container">
                        <?php if ( !empty( $settings['section_title_switch'] ) ) : ?>
                            <div class="section-heading text-center">
                                <?php if (!empty($settings['section_subheading'])) : ?>
                                    <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                                        <?php if ($settings['section_subheading_icon_type'] == 'image'): ?>
                                            <span class="heading-icon">
                                                <img class="img-fluid" src="<?php echo esc_url($settings['section_subheading_image_icon']['url']); ?>" alt="<?php echo esc_attr(get_post_meta(attachment_url_to_postid($settings['section_subheading_image_icon']['url']), '_wp_attachment_image_alt', true)); ?>">
                                            </span>
                                        <?php elseif ($settings['section_subheading_icon_type'] == 'icon'): ?>
                                            <span class="heading-icon">
                                                <?php edcare_render_icon($settings, 'section_subheading_icon'); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php echo edcare_kses($settings['section_subheading']); ?>
                                    </h4>
                                <?php endif; ?>

                                <?php if (!empty($settings['section_title'])) : ?>
                                    <h2 class="edcare-el-section-title section-title wow fade-in-bottom" data-wow-delay="400ms">
                                        <?php echo edcare_kses($settings['section_title']); ?>
                                    </h2>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="row gy-lg-0 gy-4 justify-content-center post-card-2-wrap">
                            <?php if ($query->have_posts()) : ?>
                                <?php 
                                $post_count = 0;
                                $max_posts_col2 = 2; // Maximum posts for the second column
                                ?>
                                <div class="col-lg-6 col-md-12">
                                    <?php if ($query->have_posts()): 
                                        $query->the_post(); 
                                        $post_count++; 
                                    ?>
                                    <div class="post-card post-card-1 post-card-5 wow fade-in-bottom" data-wow-delay="200ms">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="post-thumb">
                                                <?php the_post_thumbnail('full'); ?>
                                            </div>
                                        <?php endif; ?> 
                                        <div class="post-content-wrap">
                                            <div class="post-content">
                                                <?php 
                                                $categories = get_the_category(); 
                                                if (!empty($categories)) : 
                                                ?>
                                                    <span class="category"><?php echo esc_html($categories[0]->name); ?></span>
                                                <?php endif; ?>
                                                <h3 class="title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), $settings['blog_title_word'], ''); ?>
                                                    </a>
                                                </h3>
                                                <ul class="post-meta">
                                                    <li><i class="fa-sharp fa-regular fa-clock"></i><?php the_time(get_option('date_format')); ?></li>
                                                    <?php 
                                                    $post_tags = get_the_tags();
                                                    if (!empty($post_tags)) : ?>
                                                        <li><i class="fa-sharp fa-regular fa-folder"></i><?php echo esc_html($post_tags[0]->name); ?></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="post-wrap-card">
                                        <?php while ($query->have_posts() && $post_count < ($max_posts_col2 + 1)) : 
                                            $query->the_post(); 
                                            $post_count++;
                                        ?>
                                        <div class="post-card-2 post-card-3 grid-post">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="post-thumb">
                                                    <?php the_post_thumbnail('full'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="post-content-wrap">
                                                <div class="post-content">
                                                    <h3 class="title">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php echo wp_trim_words(get_the_title(), $settings['blog_title_word'], ''); ?>
                                                        </a>
                                                    </h3>
                                                    <ul class="post-meta">
                                                        <li><i class="fa-sharp fa-regular fa-clock"></i><?php the_time(get_option('date_format')); ?></li>
                                                        <?php 
                                                        $post_tags = get_the_tags();
                                                        if (!empty($post_tags)) : ?>
                                                            <li><i class="fa-sharp fa-regular fa-folder"></i><?php echo esc_html($post_tags[0]->name); ?></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                    <?php if (!empty($settings['btn_button_show'])): ?>
                                                        <a href="<?php the_permalink(); ?>" class="ed-primary-btn">
                                                            <?php echo esc_html($settings['btn_text']);?> <i class="fa-regular fa-arrow-right"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            <?php endif; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </section>

            <?php elseif ( $settings['design_style']  == 'layout-6' ): ?>

                <section class="edcare-el-section blog-section-6 pt-120 pb-120">
                    <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                        <div class="bg-img" data-background="<?php echo esc_url( get_template_directory_uri() . '/assets/img/new-update/shapes/blog-bg-shape.png' ); ?>"></div>
                    <?php endif; ?>
                    <div class="container">
                        <?php if ( !empty( $settings['section_title_switch'] ) ) : ?>
                            <div class="section-heading text-center">
                                <?php if (!empty($settings['section_subheading'])) : ?>
                                    <h4 class="edcare-el-section-subheading sub-heading wow fade-in-bottom" data-wow-delay="200ms">
                                        <?php if ($settings['section_subheading_icon_type'] == 'image'): ?>
                                            <span class="heading-icon">
                                                <img class="img-fluid" src="<?php echo esc_url($settings['section_subheading_image_icon']['url']); ?>" alt="<?php echo esc_attr(get_post_meta(attachment_url_to_postid($settings['section_subheading_image_icon']['url']), '_wp_attachment_image_alt', true)); ?>">
                                            </span>
                                        <?php elseif ($settings['section_subheading_icon_type'] == 'icon'): ?>
                                            <span class="heading-icon">
                                                <?php edcare_render_icon($settings, 'section_subheading_icon'); ?>
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
                        <?php endif; ?>
                        <div class="row gy-lg-0 gy-4 justify-content-center post-card-2-wrap">
                            <?php if ($query->have_posts()) : 
                                $wow_delay = 300;
                            ?>
                            <?php while ($query->have_posts()) : 
                                $query->the_post();
                                global $post;
                                $categories = get_the_category($post->ID);
                                $post_tags = get_the_tags();
                            ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="post-card-2 post-card-3 mb-0 wow fade-in-bottom" data-wow-delay="<?php print esc_attr($wow_delay); ?>ms">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="post-thumb">
                                            <?php the_post_thumbnail('full'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-content-wrap">
                                        <div class="post-content">
                                            <ul class="post-meta">
                                                <li><i class="fa-sharp fa-regular fa-clock"></i><?php the_time( get_option('date_format') ); ?></li>
                                                <?php if ( !empty( $post_tags ) ) : ?>
                                                    <li><i class="fa-sharp fa-regular fa-folder"></i><?php print esc_html($post_tags[0]->name); ?></li>
                                                <?php endif; ?>
                                            </ul>
                                            <h3 class="title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php echo wp_trim_words(get_the_title(), $settings['blog_title_word'], ''); ?>
                                                </a>
                                            </h3>
                                            <?php if (!empty($settings['btn_button_show'])): ?>
                                                <a href="<?php the_permalink(); ?>" class="read-more">
                                                    <?php echo esc_html($settings['btn_text']);?> <i class="fa-regular fa-arrow-right"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $wow_delay += 100; ?>
                                <?php endwhile; wp_reset_query(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
            
       <?php
	}

}

$widgets_manager->register( new EdCare_Blog_Post() );