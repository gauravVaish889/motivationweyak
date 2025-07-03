<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
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
class EdCare_Counter extends Widget_Base {

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
		return 'edcare_counter';
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
		return __( 'Counter', 'edcare-core' );
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
            '_content_fun_fact',
            [
                'label' => esc_html__( 'Fun Fact',  'edcare-core'  ),
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
            'fun_fact_icon_type',
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
            'fun_fact_image_icon',
            [
                'label' => esc_html__( 'Upload Image', 'edcare-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'fun_fact_icon_type' => 'image',
                ],
            ]
        );
        
        $this->add_control(
            'fun_fact_icon',
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
                    'fun_fact_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_count',
            [
                'label' => esc_html__( 'Count', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( '100', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'fun_fact_count_suffix',
            [
                'label' => esc_html__( 'Suffix', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( '+', 'edcare-core' ),
            ]
        );
        
        $this->add_control(
            'fun_fact_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Award Wining', 'edcare-core' ),
            ]
        );
        
        $this->end_controls_section();

		$this->start_controls_section(
            '_style_design_layout',
            [
                'label' => esc_html__( 'Design Layout', 'edcare-core' ),
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
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_fun_fact',
            [
                'label' => esc_html__( 'Fun Fact',  'edcare-core'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            '_heading_style_fun_fact_icon',
            [
                'label' => esc_html__( 'Icon', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_responsive_control(
            'fun_fact_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_icon_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_icon_background',
            [
                'label' => esc_html__( 'Background', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fun_fact_border',
                'selector' => '{{WRAPPER}} .about-counter-items .about-counter-item .icon',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fun_fact_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edcare-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_fun_fact_title',
            [
                'label' => esc_html__( 'Title', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'fun_fact_title_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'edcare-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fun_fact_title_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fun_fact_title_typography',
                'selector' => '{{WRAPPER}} .about-counter-items .about-counter-item .content .title',
            ]
        );

        $this->add_control(
            '_heading_style_fun_fact_description',
            [
                'label' => esc_html__( 'Description', 'edcare-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fun_fact_description_color',
            [
                'label' => esc_html__( 'Color', 'edcare-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-counter-items .about-counter-item .content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fun_fact_description_typography',
                'selector' => '{{WRAPPER}} .about-counter-items .about-counter-item .content p',
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

        if ( !empty($settings['hero_image']['url']) ) {
            $hero_image = !empty($settings['hero_image']['id']) ? wp_get_attachment_image_url( $settings['hero_image']['id'], 'full') : $settings['hero_image']['url'];
            $hero_image_alt = get_post_meta($settings["hero_image"]["id"], "_wp_attachment_image_alt", true);
        }

		?>

		    <?php if ( $settings['design_style']  == 'layout-1' ) : ?>

                <div class="about-counter-items d-block">
                    <div class="about-counter-item">
                        <div class="icon">
                            <?php if ( $settings['fun_fact_icon_type']  == 'image' ): ?>
                                <div class="icon">
                                    <img class="img-fluid" src="<?php echo $settings['fun_fact_image_icon']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['fun_fact_image_icon']['url']), '_wp_attachment_image_alt', true); ?>">
                                </div>
                            <?php elseif ( $settings['fun_fact_icon_type']  == 'icon' ): ?>
                                <div class="icon">
                                    <?php edcare_render_icon($settings, 'fun_fact_icon' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <h3 class="title">
                                <span class="odometer" data-count="<?php print esc_attr($settings['fun_fact_count']); ?>">
                                    <?php print esc_html( '0', 'edcare-core' ); ?>
                                </span>
                                <span class="number">
                                <?php print edcare_kses($settings['fun_fact_count_suffix']); ?>
                                </span>
                            </h3>
                            <?php if ( !empty( $settings['fun_fact_title'] ) ) : ?>
                                <p><?php print edcare_kses($settings['fun_fact_title']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

        <?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new EdCare_Counter() );