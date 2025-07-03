<?php
namespace EdCareCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Advanced_Pricing_Tab extends Widget_Base {

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
        return 'edcare_advanced_pricing_tab';
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
        return __( 'Advanced Pricing Tab', 'edcare-core' );
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   
    protected function register_controls_section() {

        $this->start_controls_section(
            '_content_pricing_tab',
            [
                'label' => esc_html__( 'Pricing Tab', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'design_style',
            [
                'label' => esc_html__( 'Select Layout', 'edcare-core' ),
                'type' => Controls_Manager::HIDDEN,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'edcare-core'),
                    'layout-2' => esc_html__('Layout 2', 'edcare-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_active',
            [
                'label' => esc_html__( 'Active This', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edcare-core' ),
                'label_off' => esc_html__( 'No', 'edcare-core' ),
                'return_value' => 'active',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'tab_title', [
                'label' => esc_html__('Tab Title', 'edcare-core'),
                'description' => edcare_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('Tab 1', 'edcare-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __( 'Section Template', 'seoq-core' ),
                'placeholder' => __( 'Select a section template for as tab content', 'seoq-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tab_list',
            [
                'label' => esc_html__('Advanced Tab - List', 'edcare-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_active' => 'active',
                        'tab_title' => esc_html__( 'Billed Monthly', 'edcare-core' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Billed Yearly', 'edcare-core' ),
                    ]
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );
        
        $this->end_controls_section();  
    }

    protected function style_tab_content(){

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
                'size_units' => [ 'px' ],
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
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_pricing_tab',
            [
                'label' => esc_html__( 'Pricing Tab',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs( 'pricing_tabs' );
        
        $this->start_controls_tab(
            'pricing_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'pricing_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'pricing_active_tab',
            [
                'label' => esc_html__( 'Active', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'pricing_color_active',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_typography',
                'selector' => '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'_style_toggle',
			[
				'label' => esc_html__( 'Toggle', 'edcare-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            '_heading_style_tab_toggle',
            [
                'label' => esc_html__( 'Toggle', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'tab_toggle_background_active',
            [
                'label' => esc_html__('Background', 'edcare-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link::before' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_width_active',
            [
                'label' => esc_html__( 'Width', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link::before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_height_active',
            [
                'label' => esc_html__( 'Height', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_border_radius_active',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_tab_toggle_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tab_toggle_background',
            [
                'label' => esc_html__('Background', 'edcare-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_width',
            [
                'label' => esc_html__( 'Width', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 54,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_height',
            [
                'label' => esc_html__( 'Height', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 22,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_toggle_background_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav .nav-item .nav-link::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        
            <section class="edcare-el-section pricing-section pt-120 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="pricing__tab mb-40">
                                <ul class="nav nav-tabs justify-content-center" id="priceTab" role="tablist">
                                    <?php foreach($settings['tab_list'] as $key => $item) : 
                                        $active = $item['tab_active'] ? 'active' : NULL ;    
                                        $aria = $item['tab_active'] ? 'false' : 'true' ;    
                                    ?>
                                    <li class="nav-item" role="presentation">
                                        <button 
                                            class="nav-link <?php echo esc_attr($active); ?>"
                                            id="monthly-<?php echo esc_attr($key+1); ?>-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#monthly-<?php echo esc_attr($key+1); ?>"
                                            type="button"
                                            role="tab"
                                            aria-controls="monthly-<?php echo esc_attr($key+1); ?>"
                                            aria-selected="<?php echo esc_attr($aria); ?>">
                                            <?php echo edcare_kses($item['tab_title']); ?>
                                        </button>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-content wow fadeInUp" id="priceTabContent" data-wow-delay=".5s">
                        <?php foreach($settings['tab_list'] as $key => $item) : 
                            $active_show = $item['tab_active'] ? 'active show' : NULL ;  
                        ?>
                        <div class="tab-pane fade show <?php echo esc_attr($active_show); ?>"
                            id="monthly-<?php echo esc_attr($key+1);  ?>"
                            role="tabpanel"
                            aria-labelledby="monthly-<?php echo esc_attr($key+1); ?>-tab">
                            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        
        <?php elseif ( $settings['design_style']  == 'layout-2' ): ?>
        
        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new EdCare_Advanced_Pricing_Tab() ); 