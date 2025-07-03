<?php
namespace EdCareCore\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
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
class EdCare_Brand_Slider extends Widget_Base {

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
		return 'edcare_brand_slider';
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
		return __( 'Brand Slider', 'edcare-core' );
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
                'label' => esc_html__('Design Layout', 'edcare-core'),
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
            'shape_switch',
            [
                'label' => esc_html__( 'Show Shape', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            '_content_brand_slider',
            [
                'label' => __( 'Brand Slider', 'edcare-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'brand_slider_image',
            [
                'label' => esc_html__('Upload Bg Image', 'edcare-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        
        $repeater->add_control(
            'brand_button_link_type',
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
            'brand_button_link',
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
                    'brand_button_link_type' => '1',
                ],
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'brand_button_page_link',
            [
                'label' => esc_html__( 'Select Button Page', 'text-domain' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => edcare_get_all_pages(),
                'condition' => [
                    'brand_button_link_type' => '2',
                ]
            ]
        );

        $this->add_control(
            'brand_slider_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'edcare-core' ),
                'default' => [
                    [
                        'brand_slider_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'brand_slider_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
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
                'size_units' => [ 'px' ],
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
            '_style_brand_slider',
            [
                'label' => esc_html__( 'Brand Slider',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'brand_slider_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sponsor-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'brand_slider_border',
                'selector' => '{{WRAPPER}} .sponsor-item',
            ]
        );

        $this->add_responsive_control(
            'brand_slider_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sponsor-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        <?php if ( $settings['design_style']  == 'layout-1' ) : ?>

            <div class="edcare-el-section sponsor-section pb-120 bg-grey">
                <?php if ( !empty( $settings['shape_switch'] ) ) : ?>
                    <div class="shapes">
                        <div class="bg-shape">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/sponsor-shape.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-1">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/sponsor-1.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                        <div class="shape shape-2">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/shapes/sponsor-2.png' ); ?>" alt="<?php print esc_attr( 'shape', 'edcare-core' ); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="sponsor-carousel swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['brand_slider_list'] as $item) :
                                if ( !empty($item['brand_slider_image']['url']) ) {
                                    $brand_slider_image_url = !empty($item['brand_slider_image']['id']) ? wp_get_attachment_image_url( $item['brand_slider_image']['id'], 'full') : $item['brand_slider_image']['url'];
                                    $brand_slider_image_alt = get_post_meta($item["brand_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                                if ('2' == $item['brand_button_link_type']) {
                                    $link = get_permalink($item['brand_button_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['brand_button_link']['url']) ? $item['brand_button_link']['url'] : '';
                                    $target = !empty($item['brand_button_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['brand_button_link']['nofollow']) ? 'nofollow' : '';
                                }
                            ?>
                            <div class="swiper-slide">
                                <div class="sponsor-item">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                        <img src="<?php echo esc_url($brand_slider_image_url); ?>" alt="<?php echo esc_attr($brand_slider_image_alt); ?>">
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ( $settings['design_style']  == 'layout-2' ) : ?>

        <?php endif;
	}
}
$widgets_manager->register( new EdCare_Brand_Slider() );  