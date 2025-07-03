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
class EdCare_Search extends Widget_Base {

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
		return 'edcare_search';
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
		return __( 'Search', 'edcare-core' );
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
            '_content_design_layout',
            [
                'label' => esc_html__( 'Image', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => esc_html__('Select Layout', 'edcare-core'),
                'type' => Controls_Manager::HIDDEN,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'edcare-core'),
                    'layout-2' => esc_html__('Layout 2', 'edcare-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'search_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'What do you want to learn today?', 'text-domain' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'search_button_text',
            [
                'label' => esc_html__( 'Button Text', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Search Now', 'text-domain' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'search_button_icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
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
            'search_button_icon_spacing',
            [
                'label'     => esc_html__( 'Icon Spacing', 'text-domain' ),
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
                    '{{WRAPPER}} .edcare-el-button i'  => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'search_button_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'text-domain' ),
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
            '_style_design_layout',
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
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_search',
            [
                'label' => esc_html__( 'Search',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            '_heading_style_search_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'search_placeholder_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-search-form-1.hero-form .form-control::placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .custom-search-form-1.hero-form .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_placeholder_typography',
                'selector' => '{{WRAPPER}} .custom-search-form-1.hero-form .form-control',
            ]
        );
        
        $this->add_control(
            '_heading_style_search_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'search_layout_width',
            [
                'label' => esc_html__( 'Width', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'default' => [
					'unit' => 'px',
					'size' => 600,
				],
                'selectors' => [
                    '{{WRAPPER}} .custom-search-form-1.hero-form' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .custom-search-form-1.hero-form .form-control' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_layout_height',
            [
                'label' => esc_html__( 'Height', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-search-form-1.hero-form' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .custom-search-form-1.hero-form .form-control' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'search_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-search-form-1.hero-form .form-control' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'search_layout_border',
                'selector' => '{{WRAPPER}} .custom-search-form-1.hero-form .form-control',
            ]
        );

        $this->add_responsive_control(
            'search_layout_padding',
            [
                'label' => esc_html__( 'Padding', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-search-form-1.hero-form .form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_layout_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-search-form-1.hero-form .form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'search_layout_box_shadow',
                'selector' => '{{WRAPPER}} .custom-search-form-1.hero-form .form-control',
            ]
        );
        
        $this->add_control(
            '_heading_style_search_button',
            [
                'label' => esc_html__( 'Button', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->start_controls_tabs( 'tabs_style_search_button' );
        
        $this->start_controls_tab(
            'search_button_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'search_button_color',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'search_button_background',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'search_button_border',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'search_button_box_shadow',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'search_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'search_button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'search_button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button:after, .edcare-el-button:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'search_button_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'search_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .edcare-el-button:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_control(
            'search_button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'text-domain' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-button' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .edcare-el-button:before' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'text-domain' ),
                'name'     => 'search_button_typography',
                'selector' => '{{WRAPPER}} .edcare-el-button',
            ]
        );
        
        $this->add_control(
            'search_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'search_button_margin',
            [
                'label'      => esc_html__( 'Margin', 'text-domain' ),
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

        if ( !empty($settings['section_image']['url']) ) {
            $section_image = !empty($settings['section_image']['id']) ? wp_get_attachment_image_url( $settings['section_image']['id'], 'full') : $settings['section_image']['url'];
            $section_image_alt = get_post_meta($settings["section_image"]["id"], "_wp_attachment_image_alt", true);
        }

		?>

        <?php if ( $settings['design_style']  == 'layout-1' ) : ?>

            <div class="custom-search-form-1 hero-form edcare-el-section">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" id="search" name="s" class="form-control" placeholder="<?php print esc_attr( $settings['search_placeholder'] ); ?>" value="<?php echo get_search_query(); ?>">
                    <button type="submit" class="edcare-el-button ed-primary-btn">
                        <?php print edcare_kses($settings['search_button_text']); ?> <?php edcare_render_icon($settings, 'search_button_icon' ); ?>
                    </button>
                </form>
                <div class="icon"><i class="fa-regular fa-magnifying-glass"></i></div>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

            

        <?php endif;
	}
}

$widgets_manager->register( new EdCare_Search() );