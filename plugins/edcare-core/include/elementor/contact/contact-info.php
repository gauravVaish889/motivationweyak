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
class EdCare_Contact_Info extends Widget_Base {

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
		return 'edcare_contact_info';
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
		return __( 'Contact Info', 'edcare-core' );
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
            '_content_section_title',
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
                'default' => __( 'Office Information', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Completely recapitalize 24/7 communities via standards compliant metrics whereas.', 'edcare-core' ),
                'label_block' => true,
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_contact_info',
            [
                'label' => esc_html__('Contact Info', 'edcare-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        if (edcare_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'contact_info_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-map-marker',
                ]
            );
        } else {
            $repeater->add_control(
                'contact_info_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fa fa-map-marker',
                        'library' => 'solid',
                    ],
                ]
            );
        };

        $repeater->add_control(
            'contact_info_title', 
            [
                'label' => esc_html__('Title', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Our Location', 'edcare-core' ),
            ]
        );

        $repeater->add_control(
            'info_type',
            [
                'label' => esc_html__('Info Type', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'address' => esc_html__( 'Address', 'edcare-core' ),
                    'phone' => esc_html__( 'Phone', 'edcare-core' ),
                    'office-time' => esc_html__( 'Office Time', 'edcare-core' ),
                ],
                'default' => 'address',
            ]
        );

        $repeater->add_control(
            'contact_info_address', [
                'label' => esc_html__('Address', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => [
                    'info_type' => [ 'address' ],
                ],
            ]
        );

        $repeater->add_control(
            'contact_info_phone', [
                'label' => esc_html__('Phone', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => [
                    'info_type' => [ 'phone' ],
                ],
            ]
        );

        $repeater->add_control(
            'contact_info_phone_url', [
                'label' => esc_html__('Phone URL', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => [
                    'info_type' => [ 'email' ],
                ],
            ]
        );

        $repeater->add_control(
            'contact_info_email', [
                'label' => esc_html__('Email', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => [
                    'info_type' => [ 'phone' ],
                ],
            ]
        );

        $repeater->add_control(
            'contact_info_office_time_one', [
                'label' => esc_html__('Office Time One', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'info_type' => [ 'office-time' ],
                ],
            ]
        );

        $repeater->add_control(
            'contact_info_office_time_two', [
                'label' => esc_html__('Office Time Two', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'info_type' => [ 'office-time' ],
                ],
            ]
        );
     
        $this->add_control(
            'contact_info_list',
            [
                'label' => esc_html__('Info List', 'edcare-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'contact_info_title' => __( 'Phone Number & Email', 'edcare-core' ),
                        'contact_info_phone' => __( '(+65) - 48596 - 5789', 'edcare-core' ),
                        'contact_info_phone_url' => '+65485965789',
                        'contact_info_email' => 'hello@edcare.com',
                        'info_type' => 'phone',
                    ],
                    [
                        'contact_info_title' => __( 'Our Office Address', 'edcare-core' ),
                        'contact_info_address' => __( '2690 Hilton Street Victoria Road, New York, Canada', 'edcare-core' ),
                        'info_type' => 'address',
                    ],
                    [
                        'contact_info_title' => __( 'Official Work Time', 'edcare-core' ),
                        'contact_info_office_time_one' => __( 'Monday - Friday: 09:00 - 20:00', 'edcare-core' ),
                        'contact_info_office_time_two' => __( 'Sunday & Saturday: 10:30 - 22:00', 'edcare-core' ),
                        'info_type' => 'office-time',
                    ],
                ],
                'title_field' => '{{{ contact_info_title }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_contact_info_style',
            [
                'label' => __( 'Design Layout', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'design_layout_margin',
            [
                'label'      => esc_html__( 'Margin', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .contact-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .contact-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_layout_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .contact-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'design_layout_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'design_layout_list_border_bottom',
            [
                'label' => esc_html__( 'List Border Bottom', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item:not(:last-of-type)' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_title',
            [
                'label' => esc_html__( 'Title & Content',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            '_heading_style_section_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'edcare-core' ),
            ]
        );

        $this->add_responsive_control(
            'section_title_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-top .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-top .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} .contact-content .contact-top .title',
            ]
        );

        $this->add_control(
            '_heading_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'edcare-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'section_description_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-top p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_description_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-top p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .contact-content .contact-top p',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_info_list',
            [
                'label' => esc_html__( 'Info List',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_icon',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Icon', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edcare-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_tabs' );
        
        $this->start_controls_tab(
            'icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .contact-content .contact-list .list-item .icon',
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
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item:hover .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_background_hover',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item:hover .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border_hover',
                'selector' => '{{WRAPPER}} .contact-content .contact-list .list-item:hover .icon',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_style_title',
            [
                'label' => __( 'Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .contact-content .contact-list .list-item .content .title',
            ]
        );

        $this->add_control(
            '_heading_info',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Info', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'info_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'info_tabs' );
        
        $this->start_controls_tab(
            'info_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'info_color',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content span' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'info_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'info_color_hover',
            [
                'label' => __( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-content .contact-list .list-item .content a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .contact-content .contact-list .list-item .content p, .contact-content .contact-list .list-item .content a, .contact-content .contact-list .list-item .content span',
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

            <div class="contact-content">
                <div class="contact-top">
                    <?php if ( !empty( $settings['section_title'] ) ) : ?>
                        <h3 class="title">
                            <?php print edcare_kses($settings['section_title']); ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ( !empty( $settings['section_description'] ) ) : ?>
                        <p><?php print edcare_kses($settings['section_description']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="contact-list">
                    <?php foreach ($settings['contact_info_list'] as $item) : ?>
                        <div class="list-item">
                            <?php if (!empty($item['contact_info_icon']) || !empty($item['contact_info_selected_icon']['value'])) : ?>
                                <div class="icon">
                                    <?php edcare_render_icon($item, 'contact_info_icon', 'contact_info_selected_icon'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h4 class="title"><?php print $item['contact_info_title'] ?></h4>
                                <?php if ( $item['info_type']  == 'address' ): ?>
                                    <p><?php echo edcare_kses($item['contact_info_address' ]); ?></p>
                                <?php elseif ( $item['info_type']  == 'phone' ): ?>
                                    <span>
                                        <a href="tel:<?php echo esc_attr($item['contact_info_phone_url' ]); ?>">
                                            <?php echo edcare_kses($item['contact_info_phone' ]); ?>
                                        </a>
                                    </span>
                                    <span>
                                        <a href="mailto:<?php echo esc_attr($item['contact_info_email' ]); ?>">
                                            <?php echo edcare_kses($item['contact_info_email' ]); ?>
                                        </a>
                                    </span>
                                <?php elseif ( $item['info_type']  == 'office-time' ): ?>
                                    <span><?php print $item['contact_info_office_time_one'] ?></span>
                                    <span><?php print $item['contact_info_office_time_two'] ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php 
	}
}

$widgets_manager->register( new EdCare_Contact_Info() );