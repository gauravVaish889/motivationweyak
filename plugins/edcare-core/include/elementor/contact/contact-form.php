<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
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
class EdCare_Contact_Form extends Widget_Base {

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
		return 'edcare_contact_form';
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
		return __( 'Contact Form', 'edcare-core' );
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


    public function get_edcare_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $edcare_cfa         = array();
        $edcare_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $edcare_forms       = get_posts( $edcare_cf_args );
        $edcare_cfa         = ['0' => esc_html__( 'Select Form', 'edcare-core' ) ];
        if( $edcare_forms ){
            foreach ( $edcare_forms as $edcare_form ){
                $edcare_cfa[$edcare_form->ID] = $edcare_form->post_title;
            }
        }else{
            $edcare_cfa[ esc_html__( 'No contact form found', 'edcare-core' ) ] = 0;
        }
        return $edcare_cfa;
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
                    // 'layout-3' => esc_html__('Layout 3', 'edcare-core'),
                    // 'layout-4' => esc_html__('Layout 4', 'edcare-core'),
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
            '_content_image',
            [
                'label'       => esc_html__( 'Image', 'edcare-core' ),
                'tab'         => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'request_image',
            [
                'label' => esc_html__( 'Choose Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'request_bg_image',
            [
                'label' => esc_html__( 'Choose BG Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_content_section_title',
            [
                'label'       => esc_html__( 'Title & Content', 'edcare-core' ),
                'tab'         => Controls_Manager::TAB_CONTENT,
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
                'default' => __( 'Course Request', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Leave A Reply', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Fill-up The Form and Message us of your amazing question', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_contact_form',
            [
                'label' => esc_html__('Contact Form', 'edcare-core'),
            ]
        );

        $this->add_control(
            'edcare_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'edcare-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_edcare_contact_form(),
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'_style_design_style',
			[
				'label' => __( 'Design Layout', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'design_style_margin',
            [
                'label' => __( 'Margin', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edcare-el-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_style_padding',
            [
                'label' => __( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edcare-el-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'design_style_border_radius',
            [
                'label' => __( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .edcare-el-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_style_background',
            [
                'label' => __( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .edcare-el-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_style_border',
                'selector' => '{{WRAPPER}} .blog-contact-form, .edcare-el-section',
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
            '_section_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'edcare-core' ),
            ]
        );

        $this->add_responsive_control(
            'section_title_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .title' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .edcare-el-section-title' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edcare-el-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} .blog-contact-form .title, .edcare-el-section-title',
            ]
        );

        $this->add_control(
            '_heading_style_section_description',
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
                    '{{WRAPPER}} .blog-contact-form p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .edcare-el-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_description_color',
            [
                'label' => __( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .edcare-el-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .blog-contact-form p, .edcare-el-desc',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'_style_contact_form',
			[
				'label' => __( 'Contact Form', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'input_bottom_spacing',
            [
                'label'     => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .request-content .request-form-wrapper .form-items' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_style_contact_form_input',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Input', 'edcare-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'input_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'edcare-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control' => 'border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .request-content .request-form-wrapper .form-items .form-item .form-control' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_form_input_tabs' );

        $this->start_controls_tab(
            'form_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control::placeholder' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .icon' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .request-content .request-form-wrapper .form-items .form-item .form-control' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .request-content .request-form-wrapper .form-items .form-item .form-control::placeholder' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

		$this->add_control(
            'input_background',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control' => 'background-color: {{VALUE}}!important;',
                    '{{WRAPPER}} .request-section .request-content .request-form-wrapper .form-items .form-item .form-control: {{VALUE}}!important;',
                ],
            ]
        );

		$this->add_control(
            'input_border_color',
            [
                'label'     => esc_html__( 'Border', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control' => 'border-color: {{VALUE}}!important;',
                    '{{WRAPPER}} .request-content .request-form-wrapper .form-items .form-item .form-control' => 'border-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'form_focus_tab',
            [
                'label' => esc_html__( 'Focus', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'input_color_focus',
            [
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control:focus' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .request-content .request-form-wrapper .form-items .form-item .form-control:focus' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

		$this->add_control(
            'input_background_focus',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control:focus' => 'background-color: {{VALUE}}!important;',
                    '{{WRAPPER}} .request-content .request-form-wrapper .form-items .form-item .form-control:focus' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

		$this->add_control(
            'input_border_color_focus',
            [
                'label'     => esc_html__( 'Border', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .form-item .form-control:focus' => 'border-color: {{VALUE}}!important;',
                    '{{WRAPPER}} .request-content .request-form-wrapper .form-items .form-item .form-control:focus' => 'border-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            '_content_button',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Button', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            'button_normal_tab',
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
                    '{{WRAPPER}} .blog-contact-form .request-form .submit-btn .ed-primary-btn'    => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ed-primary-btn'    => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .submit-btn .ed-primary-btn' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .ed-primary-btn' => 'background-color: {{VALUE}}',
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
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .submit-btn .ed-primary-btn:hover'    => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ed-primary-btn:hover'    => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .submit-btn .ed-primary-btn:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .ed-primary-btn:before' => 'background-color: {{VALUE}}',
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
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-contact-form .request-form .submit-btn .ed-primary-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .blog-contact-form .request-form .submit-btn .ed-primary-btn:before' => 'border-radius: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}} .ed-primary-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ed-primary-btn:before' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .blog-contact-form .request-form .submit-btn .ed-primary-btn, .ed-primary-btn',
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

		if ( !empty($settings['edcare_form_bg_img']['url']) ) {
            $edcare_form_bg_img = !empty($settings['edcare_form_bg_img']['id']) ? wp_get_attachment_image_url( $settings['edcare_form_bg_img']['id'], 'full' ) : $settings['edcare_form_bg_img']['url'];
        }

		?>

		<?php if ( $settings['design_style']  == 'layout-1' ): ?>

            <div class="blog-contact-form contact-form">
                <?php if ( !empty( $settings['section_title'] ) ) : ?>
                    <h2 class="title mb-0">
                        <?php print edcare_kses($settings['section_title']); ?>
                    </h2>
                <?php endif; ?>
                <?php if ( !empty( $settings['section_description'] ) ) : ?>
                    <p class="mb-30 mt-10">
                        <?php print edcare_kses($settings['section_description']); ?>
                    </p>
                <?php endif; ?>
                <?php if( !empty($settings['edcare_select_contact_form']) ) : ?>
                    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['edcare_select_contact_form'].'"]' ); ?>

                <?php else : ?>
                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'edcare-core' ). '</p></div>'; ?>
                <?php endif; ?>
            </div>

		<?php elseif ( $settings['design_style']  == 'layout-2' ):
            // Request Image
            if ( !empty($settings['request_image']['url']) ) {
                $request_image = !empty($settings['request_image']['id']) ? wp_get_attachment_image_url( $settings['request_image']['id'], 'full') : $settings['request_image']['url'];
                $request_image_alt = get_post_meta($settings["request_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // Request BG Image
            if ( !empty($settings['request_bg_image']['url']) ) {
                $request_bg_image = !empty($settings['request_bg_image']['id']) ? wp_get_attachment_image_url( $settings['request_bg_image']['id'], 'full') : $settings['request_bg_image']['url'];
                $request_bg_image_alt = get_post_meta($settings["request_bg_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <section class="request-section edcare-el-section" data-background="<?php print esc_url($request_bg_image); ?>">
                <?php if ( !empty( $request_image ) ) : ?>
                <div class="bg-img" data-background="<?php print esc_url($request_image); ?>"></div>
                <?php endif; ?>

                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                <div class="shape">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/req-shape-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                </div>
                <?php endif; ?>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="request-content white-content pt-120 pb-120">
                                <div class="section-heading white-content mb-20">

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
                                    <h2 class="section-title wow fade-in-bottom edcare-el-section-title" data-wow-delay="400ms"><?php print edcare_kses($settings['section_title']); ?></h2>
                                    <?php endif; ?>
                                </div>

                                <?php if ( !empty( $settings['section_description'] ) ) : ?>
                                <p class="desc mb-20 wow fade-in-bottom edcare-el-desc" data-wow-delay="400ms"><?php print edcare_kses($settings['section_description']); ?></p>
                                <?php endif; ?>

                                <div class="request-form-wrapper wow fade-in-bottom" data-wow-delay="500ms">
                                    <?php if( !empty($settings['edcare_select_contact_form']) ) : ?>
                                        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['edcare_select_contact_form'].'"]' ); ?>

                                    <?php else : ?>
                                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'edcare-core' ). '</p></div>'; ?>
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

$widgets_manager->register( new EdCare_Contact_Form() );