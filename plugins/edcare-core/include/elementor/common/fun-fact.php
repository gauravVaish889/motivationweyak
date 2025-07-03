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
class EdCare_Fun_Fact extends Widget_Base {

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
		return 'edcare_fun_fact';
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
		return __( 'Fun Fact', 'edcare-core' );
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
            'section_title',
            [
                'label' => esc_html__('Desigin Layout', 'edcare-core'),
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
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_content_fun_fact',
            [
                'label' => esc_html__('Fun Fact', 'edcare-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'fun_fact_number',
            [
                'label' => esc_html__( 'Number', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'fun_fact_suffix',
            [
                'label' => esc_html__( 'Number', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fun_fact_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '', 'text-domain' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'fun_fact_list',
            [
                'label' => esc_html__( 'Fun Fact List', 'text-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fun_fact_number' => __( '3,192', 'text-domain' ),
                        'fun_fact_suffix' => __( '+', 'text-domain' ),
                        'fun_fact_title' => __( 'Successflly Trained', 'text-domain' ),
                    ],
                    [
                        'fun_fact_number' => __( '15,485', 'text-domain' ),
                        'fun_fact_suffix' => __( '+', 'text-domain' ),
                        'fun_fact_title' => __( 'Classes Completed', 'text-domain' ),
                    ],
                    [
                        'fun_fact_number' => __( '97.55', 'text-domain' ),
                        'fun_fact_suffix' => __( '%', 'text-domain' ),
                        'fun_fact_title' => __( 'Satisfaction Rate', 'text-domain' ),
                    ],
                    [
                        'fun_fact_number' => __( '97.55', 'text-domain' ),
                        'fun_fact_suffix' => __( '%', 'text-domain' ),
                        'fun_fact_title' => __( 'Satisfaction Rate', 'text-domain' ),
                    ],
                ],
                'title_field' => '{{{ fun_fact_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_fun_fact_two',
            [
                'label' => esc_html__('Fun Fact', 'edcare-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->add_control(
            'fun_fact_number',
            [
                'label' => esc_html__( 'Number', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => '19.5',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'fun_fact_suffix',
            [
                'label' => esc_html__( 'Number', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'K',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fun_fact_title',
            [
                'label' => esc_html__( 'Title', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Students Enrolled', 'text-domain' ),
                'label_block' => true,
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
                    '{{WRAPPER}} .counter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .counter-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .counter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .counter-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .counter-card' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'design_layout_border_color_two',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter-item' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'design_style' => 'layout-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'design_layout_border',
                'selector' => '{{WRAPPER}} .counter-card',
                'condition' => [
                    'design_style' => 'layout-2',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_fun_fact',
            [
                'label' => __( 'Fun Fact', 'edcare-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_content_count',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Count', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label' => __( 'Text Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter-item .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .counter-item .title span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .counter-card .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_typography',
                'selector' => '{{WRAPPER}} .counter-item .title, .counter-card .title',
            ]
        );

        $this->add_control(
            '_content_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'edcare-core' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_top_spacing',
            [
                'label' => __( 'Top Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .counter-item p' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .counter-card p' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .counter-item p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .counter-card p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .counter-item p, .counter-card p',
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

            <section class="edcare-el-section counter-section">
                <div class="container">
                    <div class="row counter-wrap gy-lg-0 gy-5">
                        <?php foreach ($settings['fun_fact_list'] as $item) : ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="counter-item item-1 white-content wow fade-in-bottom" data-wow-delay="200ms">
                                    <h3 class="title">
                                        <span class="odometer" data-count="<?php print esc_attr($item['fun_fact_number']); ?>">
                                            <?php print esc_attr( '0', 'edcare-core' ); ?>
                                        </span><?php print edcare_kses($item['fun_fact_suffix']); ?>
                                    </h3>
                                    <?php if ( !empty( $item['fun_fact_title'] ) ) : ?>
                                        <p><?php print edcare_kses($item['fun_fact_title']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

            <div class="counter-card text-center wow fade-in-bottom" data-wow-delay="300ms">
                <h3 class="title">
                    <span class="odometer" data-count="<?php print esc_attr($settings['fun_fact_number']); ?>">
                        <?php print esc_attr( '0', 'edcare-core' ); ?>
                    </span>
                    <?php if ( !empty( $settings['fun_fact_suffix'] ) ) : ?>
                        <span class="number">
                            <?php print edcare_kses($settings['fun_fact_suffix']); ?>
                        </span>
                    <?php endif; ?>
                </h3>
                <?php if ( !empty( $settings['fun_fact_title'] ) ) : ?>
                    <p><?php print edcare_kses($settings['fun_fact_title']); ?></p>
                <?php endif; ?>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new EdCare_Fun_Fact() );