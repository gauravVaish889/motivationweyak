<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Button extends Widget_Base {

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
		return 'edcare_button';
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
		return __( 'Button', 'edcare-core' );
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
                'label' => esc_html__( 'Design Layout',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'design_style',
            [
                'label' => esc_html__( 'Select Layout', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__( 'Layout 1', 'text-domain' ),
                    'layout-2' => esc_html__( 'Layout 2', 'text-domain' ),
                ],
                'default' => 'layout-1',
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
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button Text', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_link_type',
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
            'button_link',
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
                    'button_link_type' => '1',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_page_link',
            [
                'label' => esc_html__('Select Button Page', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => edcare_get_all_pages(),
                'condition' => [
                    'button_link_type' => '2',
                ]
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label' => esc_html__('Alignment', 'edcare-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'edcare-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'edcare-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'edcare-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'button_icon_type',
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
        
        $this->add_control(
            'button_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'button_icon_type' => 'image',
                ],
            ]
        );
        
        $this->add_control(
            'button_icon',
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
                    'button_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'button_icon_spacing',
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
                    '{{WRAPPER}} .edcare-el-button i' => 'margin-left: {{SIZE}}{{UNIT}}!important;',
                ],
                'condition' => [
                    'button_icon[value]!' 	=> '',
                ],
            ]
        );

        $this->add_control(
            'button_icon_size',
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
                    'button_icon[value]!' 	=> '',
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
                'label'     => esc_html__( 'Color', 'edcare-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'color: {{VALUE}}',
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
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
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
                    '{{WRAPPER}} .edcare-el-button:hover'    => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .category-item a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'edcare-core' ),
                'name'     => 'button_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow_hover',
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
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'border-radius: {{SIZE}}{{UNIT}};',
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

        ?>

        <?php if ( $settings['design_style']  == 'layout-1' ) : 
            
            if ('2' == $settings['button_link_type']) {
                $this->add_render_attribute('edcare-button-arg', 'href', get_permalink($settings['button_page_link']));
                $this->add_render_attribute('edcare-button-arg', 'target', '_self');
                $this->add_render_attribute('edcare-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('edcare-button-arg', 'class', 'edcare-el-button ed-primary-btn');
            } else {
                if (!empty($settings['button_link']['url'])) {
                    $this->add_link_attributes('edcare-button-arg', $settings['button_link']);
                    $this->add_render_attribute('edcare-button-arg', 'class', 'edcare-el-button ed-primary-btn');
                }
            }
            
            ?>

            <a <?php echo $this->get_render_attribute_string( 'edcare-button-arg' ); ?>>
                <?php print edcare_kses($settings['button_text']); ?>
                <?php if ( $settings['button_icon_type']  == 'image' ): ?>
                    <span>
                        <img src="<?php echo $settings['button_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['button_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                    </span>
                <?php elseif ( $settings['button_icon_type']  == 'icon' ): ?>
                    <span>
                        <?php edcare_render_icon($settings, 'button_icon' ); ?>
                    </span>
                <?php endif; ?>
            </a>
        
        <?php elseif ( $settings['design_style']  == 'layout-2' ) : 
        
            if ('2' == $settings['button_link_type']) {
                $this->add_render_attribute('edcare-button-arg', 'href', get_permalink($settings['button_page_link']));
                $this->add_render_attribute('edcare-button-arg', 'target', '_self');
                $this->add_render_attribute('edcare-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('edcare-button-arg', 'class', 'edcare-el-button');
            } else {
                if (!empty($settings['button_link']['url'])) {
                    $this->add_link_attributes('edcare-button-arg', $settings['button_link']);
                    $this->add_render_attribute('edcare-button-arg', 'class', 'edcare-el-button');
                }
            }

            ?>

            <div class="category-item">
                <a <?php echo $this->get_render_attribute_string( 'edcare-button-arg' ); ?>>
                    <?php if ( $settings['button_icon_type']  == 'image' ): ?>
                        <span>
                            <img src="<?php echo $settings['button_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['button_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                        </span>
                    <?php elseif ( $settings['button_icon_type']  == 'icon' ): ?>
                        <?php if ( !empty( $settings['button_icon'] ) ) : ?>
                            <span>
                                <?php edcare_render_icon($settings, 'button_icon' ); ?>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php print edcare_kses($settings['button_text']); ?>
                </a>
            </div>

        <?php endif; ?>
        
        <?php
	}
}

$widgets_manager->register( new EdCare_Button() );