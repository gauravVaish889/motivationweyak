<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use TPCore\Elementor\Controls\Group_Control_TPGradient;
use \Elementor\Repeater;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Repeater_Box extends Widget_Base
{

    use TP_Style_Trait, TP_Icon_Trait, TP_Offcanvas_Trait, TP_Menu_Trait, TP_Animation_Trait;

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
        return 'tp-repeater-box';
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
        return __(EDCARE_CORE_THEME_NAME . ' :: Repeater Box', 'tpcore');
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
        $this->tp_design_layout('Layout', 1);

        $this->start_controls_section(
            'tp_icon_box_section',
            [
                'label' => esc_html__('Box Contents', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'tpcore'),
                    //'style_2' => __('Style 2', 'tpcore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_course_id',
            [
                'label' => esc_html__('Course ID', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tp Slide Course ID', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_course_title',
            [
                'label' => esc_html__('Course Title', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tp Course Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_course_type',
            [
                'label' => esc_html__('Course Type', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Course Type', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_course_credits',
            [
                'label' => esc_html__('Course Credits', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Course Credits', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_course_color_id',
            [
                'label' => esc_html__('Course Title Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-title' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name',
                'label' => esc_html__('Title Typography', 'tpcore'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-title',
            ]
        );

        $repeater->add_control(
            'tp_course_bg_color_id',
            [
                'label' => esc_html__('Course Title Bg Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-section' => 'background: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'tp_area_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tpcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'name',
                'label' => esc_html__('label', 'tpcore'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-section',
            ]
        );


        $this->add_control(
            'tp_slider_list',
            [
                'label' => esc_html__('Text List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_course_id' => esc_html__('Art Direction', 'tpcore'),
                    ],
                    [
                        'tp_course_id' => esc_html__('Branding', 'tpcore'),
                    ],
                    [
                        'tp_course_id' => esc_html__('Content Production', 'tpcore'),
                    ],
                ],
                'title_field' => '{{{ tp_course_id }}}',
            ]
        );

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .tp-align' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // animation
        $this->tp_creative_animation();

    }

    // style_tab_content
    protected function style_tab_content()
    {
        //$this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
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
        $settings = $this->get_settings_for_display(); ?>

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $animation = $this->tp_animation_show($settings);
            $attrs = [
                'class' => "tp-awards-item tp-hover-reveal-item p-relative " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];

            ?>

            <div class="tp-awards-item-box">
                <?php foreach ($settings['tp_slider_list'] as $key => $item):
                    $this->add_render_attribute('title_args', 'class', 'tp-el-title tp-awards-title');

                    $img = tp_get_img($item, 'tp_slider_image', 'tp_image');

                    // Link                            
                    if ('2' == $item['tp_btn_link_type']) {
                        $this->add_render_attribute('tp-button-arg' . $item['_id'], 'href', get_permalink($item['tp_btn_page_link']));
                        $this->add_render_attribute('tp-button-arg' . $item['_id'], 'target', '_self');
                        $this->add_render_attribute('tp-button-arg' . $item['_id'], 'rel', 'nofollow');
                    } else {
                        if (!empty($item['tp_btn_link']['url'])) {
                            $this->add_link_attributes('tp-button-arg' . $item['_id'], $item['tp_btn_link']);
                        }
                    }
                    ?>
                    <div class="tp-awards-item tp-hover-reveal-item p-relative">
                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $item['_id']); ?>>
                            <div class="tp-awards-item-inner d-flex align-items-center justify-content-between">
                                <div class="tp-awards-item-left d-flex">
                                    <?php if (!empty($item['tp_text_date'])): ?>
                                        <div class="tp-awards-date">
                                            <h4 class="tp-awards-date-title">
                                                <?php echo $item['tp_text_date']; ?>
                                            </h4>
                                        </div>
                                    <?php endif; ?>
                                    <div class="tp-awards-text-wrap">
                                        <?php
                                        if (!empty($item['tp_course_id'])):
                                            printf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($item['tp_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($item['tp_course_id']),
                                                $this->get_render_attribute_string('tp-button-arg' . $item['_id'])
                                            );
                                        endif;
                                        ?>
                                        <?php if (!empty($item['tp_text_desc'])): ?>
                                            <span>
                                                <?php echo $item['tp_text_desc']; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if (!empty($item['tp_btn_button_show'])): ?>
                                    <div class="tp-awards-item-right">
                                        <div class="tp-awards-icon">
                                            <span>
                                                <?php if ($item['tp_button_icon_type'] === 'btn_image' && ($item['btn_image']['url'] || $item['btn_image']['id'])):
                                                    $this->get_render_attribute_string('btn_image');
                                                    $item['hover_animation'] = 'disable-animation';
                                                    ?>
                                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'btn_image'); ?>
                                                <?php elseif (!empty($item['btn_icon'])): ?>
                                                    <?php \Elementor\Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                <?php elseif (!empty($item['btn_svg'])): ?>
                                                    <?php echo $item['btn_svg']; ?>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </a>
                        <?php if (!empty($img['tp_slider_image'])): ?>
                            <div class="tp-hover-reveal-bg" data-background="<?php echo esc_url($img['tp_slider_image']) ?>"></div>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>

            </div>

        <?php else:
            $animation = $this->tp_animation_show($settings);
            $attrs = [
                'class' => "tp-course-details-table " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];

            ?>

            <div <?php echo tp_implode_html_attributes($attrs); ?>>
                <ul>
                    <?php foreach ($settings['tp_slider_list'] as $key => $item): ?>

                        <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                            <li class="tp-course-details-table-head tp-el-section">
                                <div class="tp-course-table-row">
                                    <?php if (!empty($item['tp_course_id'])): ?>
                                        <div class="tp-course-id">
                                            <h4 class="tp-table-title tp-el-title">
                                                <?php echo $item['tp_course_id']; ?>
                                            </h4>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_course_title'])): ?>
                                        <div class="tp-course-sub">
                                            <h4 class="tp-table-title tp-el-title">
                                                <?php echo $item['tp_course_title']; ?>
                                            </h4>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_course_type'])): ?>
                                        <div class="tp-course-type">
                                            <h4 class="tp-table-title tp-el-title">
                                                <?php echo $item['tp_course_type']; ?>
                                            </h4>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_course_credits'])): ?>
                                        <div class="tp-course-credits">
                                            <h4 class="tp-table-title tp-el-title">
                                                <?php echo $item['tp_course_credits']; ?>
                                            </h4>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </div>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new TP_Repeater_Box());