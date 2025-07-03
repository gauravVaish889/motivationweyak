<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use TPCore\Elementor\Controls\Group_Control_TPGradient;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Link_Text extends Widget_Base
{

    use TP_Style_Trait, TP_Animation_Trait, TP_Icon_Trait;

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tp-link-text';
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
    public function get_title()
    {
        return __(EDCARE_CORE_THEME_NAME . ' :: Link Text', 'tpcore');
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
    public function get_icon()
    {
        return 'tp-icon';
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
    public function get_categories()
    {
        return ['tpcore'];
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
    public function get_script_depends()
    {
        return ['tpcore'];
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

    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }

    protected function register_controls_section()
    {

        // layout Panel
        $this->tp_design_layout('Design Layout', 1);

        // title/content
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Title & Description', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_link_text_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Get To Know Me', 'tpcore'),
                'placeholder' => esc_html__('Your Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_link_text_icon_show',
            [
                'label' => esc_html__('Add Icon ?', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $this->tp_single_icon_control('linK_btn', 'tp_link_text_icon_show', 'yes');

        $this->add_control(
            'tp_link_text_icon_position',
            [
                'label' => esc_html__('Choose Icon Position', 'tpcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
                'condition' => [
                    'tp_link_text_icon_show' => 'yes'
                ],
            ]
        );


        tp_render_links_controls($this, 'link_text');


        $this->end_controls_section();

        // animation
        $this->tp_creative_animation();

    }

    protected function style_tab_content()
    {
        $this->start_controls_section(
            'tp_link_text_style_sec',
            [
                'label' => esc_html__('Text Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_link_text_typography',
                'label' => esc_html__('Typhography', 'tpcore'),
                'selector' => '{{WRAPPER}} .tp-el-link-text',
            ]
        );

        $this->add_control(
            'tp_link_text_icon_image_size',
            [
                'label' => esc_html__('Icon Image Size', 'tpcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100000,
                        'step' => 10,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text .link-text-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tp_link_text_icon_show' => 'yes',
                    'tp_link_text_icon_type' => 'image'
                ],
            ]
        );

        $this->add_control(
            'tp_link_text_icon_size',
            [
                'label' => esc_html__('Icon Size', 'tpcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text .link-text-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tp_link_text_icon_show' => 'yes',
                    'tp_link_text_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_control(
            'tp_link_text_icon_svg_size',
            [
                'label' => esc_html__('Icon SVG Size', 'tpcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text .link-text-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tp_link_text_icon_show' => 'yes',
                    'tp_link_text_icon_type' => 'svg'
                ],
            ]
        );


        $this->start_controls_tabs(
            'tp_link_text_state_tabs',
        );

        // button normal state
        $this->start_controls_tab(
            'tp_link_text_normal_tab',
            [
                'label' => esc_html__('Normal', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_link_text_color',
            [
                'label' => esc_html__('Text Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tp_link_text_icon_color',
            [
                'label' => esc_html__('Icon Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text .link-text-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tp_link_text_icon_show' => 'yes',
                    'tp_link_text_icon_type' => 'icon'
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tp_link_text_border',
                'selector' => '{{WRAPPER}} .tp-el-link-text',
            ]
        );

        $this->add_control(
            'tp_link_text_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tpcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_link_text_box_shadow',
                'selector' => '{{WRAPPER}} .tp-el-link-text',
            ]
        );

        $this->end_controls_tab();
        // end normal state

        // button hover state
        $this->start_controls_tab(
            'tp_link_text_hover_tab',
            [
                'label' => esc_html__('Hover', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_link_text_hover_color',
            [
                'label' => esc_html__('Text Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tp_link_text_hover_icon_color',
            [
                'label' => esc_html__('Icon Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text:hover .link-text-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'tp_link_text_icon_show' => 'yes',
                    'tp_link_text_icon_type' => 'icon'
                ],

            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tp_link_text_hover_border',
                'selector' => '{{WRAPPER}} .tp-el-link-text:hover',
            ]
        );

        $this->add_control(
            'tp_link_text_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tpcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_link_text_hover_box_shadow',
                'selector' => '{{WRAPPER}} .tp-el-link-text:hover',
            ]
        );

        $this->end_controls_tab();
        // end hover state


        $this->end_controls_tabs();
        // end button state tabs

        $this->add_control(
            'tp_link_text_margin',
            [
                'label' => esc_html__('Button Margin', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tp_link_text_padding',
            [
                'label' => esc_html__('Button Padding', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'tp_link_text_icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-link-text .link-text-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $animation = $this->tp_animation_show($settings);
            ?>



        <?php else:
            $animation = $this->tp_animation_show($settings);

            $attrs = [];

            $attrs = tp_get_repeater_links_attr($settings, 'link_text');
            extract($attrs);

            $links_attrs = [
                'href' => $link,
                'target' => $target,
                'rel' => $rel,
                'class' => 'tp-el-link-text'
            ];
            ?>

            <div class="tp-campus-activity-list p-0 <?php echo esc_attr($animation['animation']) ?>">
                <ul>
                    <li>
                        <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
                            <?php echo $settings['tp_link_text_title']; ?>
                            <?php if (($settings['tp_link_text_icon_position'] == 'left')): ?>
                                <?php tp_render_signle_icon_html($settings, 'linK_btn', 'link-text-icon on-left'); ?>
                            <?php endif; ?>

                            <?php if (($settings['tp_link_text_icon_position'] == 'right')): ?>
                                <?php tp_render_signle_icon_html($settings, 'linK_btn', 'link-text-icon on-right'); ?>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>

        <?php endif;
    }
}

$widgets_manager->register(new TP_Link_Text());