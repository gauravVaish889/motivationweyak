<?php
namespace TPCore\Widgets;

use Elementor\Element_Section;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_services extends Widget_Base
{

    use \TPCore\Widgets\TP_Style_Trait;
    use \TPCore\Widgets\TP_Animation_Trait;
    use \TPCore\Widgets\TP_Icon_Trait;

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
        return 'tp-services';
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
        return __(EDCARE_CORE_THEME_NAME . ' :: Services', 'tpcore');
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
        $this->tp_design_layout('Design Layout', 2);

        // Services Sections
        $this->start_controls_section(
            'servicesContentSec',
            [
                'label' => esc_html__('Services Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
            ]
        );
        $this->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG/Text Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icons',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                    ]
                ]
            );
        }

        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
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

        $this->add_control(
            'tp_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is description text here.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
                'label_block' => true,
            ]
        );

        // button
        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__('Show Link', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->tp_single_icon_control('theme_btn', 'tp_btn_button_show', 'yes');

        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // animation
        $this->tp_creative_animation('');

    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_title', 'Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_desc', 'Description', '.tp-el-desc');
        $this->tp_icon_style('', 'services_icon', '.tp-el-icon');
      
        // button icon 

        $this->start_controls_section(
         'tp_services_btn_section',
             [
               'label' => esc_html__( 'Button Icon', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
             ]
        );
        
        // icon 
        $this->start_controls_tabs(
			'tp_services_btn_tabs'
		);

		$this->start_controls_tab(
			'tp_services_btn_tab',
			[
				'label' => esc_html__( 'Icon', 'tpcore' ),
			]
		);

        $this->add_responsive_control(
            'tp_services_btn_icon_color',
            [
                'label' => esc_html__('Icon Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-service-btn span i' => 'color: {{VALUE}}',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'tp_services_btn_icon_font-size',
            [
                'label' => esc_html__('Font Size', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-service-btn span i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

         // image 
		$this->start_controls_tab(
			'tp_services_btn_image_tab',
			[
				'label' => esc_html__( 'Image', 'tpcore' ),
			]
		);

        $this->add_responsive_control(
            'tp_services_btn_image_w',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Image Width', 'tpcore'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-service-btn span img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_services_btn_image_h',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Image Height', 'tpcore'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-service-btn span img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // svg
		$this->start_controls_tab(
			'tp_services_btn_svg_tab',
			[
				'label' => esc_html__( 'SVG', 'tpcore' ),
			]
		);
        $this->add_responsive_control(
            'tp_services_btn_svg_w',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('SVG Width', 'tpcore'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-service-btn span svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

		$this->end_controls_tabs();
        //  end tab 

        $this->add_responsive_control(
            'tp_services_btn_bg',
            [
                'label' => esc_html__('Background Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-service-btn span::before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tp_my_services_btn_normal_border_style',
                'selector' => '{{WRAPPER}} .tp-el-service-btn span::before',
            ]
        );

        $this->add_responsive_control(
            'tp_services_btn_bg_margin',
            [
                'label' => esc_html__('Margin', 'tpcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-service-btn span i, {{WRAPPER}} .tp-el-service-btn span img , {{WRAPPER}} .tp-el-service-btn span svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_services_btn_bg_padding',
            [
                'label' => esc_html__('Padding', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-service-btn span i, {{WRAPPER}} .tp-el-service-btn span img , {{WRAPPER}} .tp-el-service-btn span svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $btn_id = 'theme_btn';
        ?>

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $animation = $this->tp_animation_show($settings);
            $this->add_render_attribute('title_args', 'class', 'tp-service-3-title tp-el-title');
            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
            } else {
                if (!empty($settings['tp_btn_link']['url'])) {
                    $this->add_link_attributes('tp-button-arg', $settings['tp_btn_link']);
                }
            }
            ?>

            <div class="tp-service-3-item mb-30 tp-el-section  <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <div class="tp-service-3-icon tp-el-btn-icon">

                    <?php if (
                        ($settings['tp_box_icon_type'] == 'icon' && (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value']))) ||
                        ($settings['tp_box_icon_type'] == 'image' && !empty($settings['tp_box_icon_image']['url'])) ||
                        ($settings['tp_box_icon_type'] == 'svg' && !empty($settings['tp_box_icon_svg']))
                    ): ?>
                        <span class="tp-service-3-icon-active tp-el-icon">
                            <?php $this->tp_icon_show($settings); ?>
                        </span>
                    <?php endif; ?>

                    <span class="tp-service-3-icon-hover">
                        <?php tp_render_signle_icon_html($settings, 'theme_btn', ''); ?>
                    </span>
                </div>
                <div class="tp-service-3-content">

                    <?php
                    if (!empty($settings['tp_title'])):
                        printf(
                            '<%1$s %2$s><a %4$s>%3$s</a></%1$s>',
                            tag_escape($settings['tp_title_tag']),
                            $this->get_render_attribute_string('title_args'),
                            tp_kses($settings['tp_title']),
                            $this->get_render_attribute_string('tp-button-arg')
                        );
                    endif;
                    ?>

                    <?php if (!empty($settings['tp_description'])): ?>
                        <p class="tp-el-desc">
                            <?php echo tp_kses($settings['tp_description']); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

        <?php else:
            $animation = $this->tp_animation_show($settings);
            $this->add_render_attribute('title_args', 'class', 'tp-service-title tp-el-title');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
            } else {
                if (!empty($settings['tp_btn_link']['url'])) {
                    $this->add_link_attributes('tp-button-arg', $settings['tp_btn_link']);
                }
            }
            ?>

            <div class="tp-service-item tp-align m-0 tp-el-section  <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <div class="tp-service-wrap tp-el-btn-icon tp-el-icon">

                    <?php if (
                        ($settings['tp_box_icon_type'] == 'icon' && (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value']))) ||
                        ($settings['tp_box_icon_type'] == 'image' && !empty($settings['tp_box_icon_image']['url'])) ||
                        ($settings['tp_box_icon_type'] == 'svg' && !empty($settings['tp_box_icon_svg']))
                    ): ?>
                        <div class="tp-service-icon">
                            <?php $this->tp_icon_show($settings); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    if (!empty($settings['tp_title'])):
                        printf(
                            '<%1$s %2$s><a %4$s>%3$s</a></%1$s>',
                            tag_escape($settings['tp_title_tag']),
                            $this->get_render_attribute_string('title_args'),
                            tp_kses($settings['tp_title']),
                            $this->get_render_attribute_string('tp-button-arg')
                        );
                    endif;
                    ?>

                    <div class="tp-service-btn">
                        <a class="tp-el-service-btn tp-el-service-btn" <?php echo $this->get_render_attribute_string('tp-button-arg'); ?>>
                            <?php tp_render_signle_icon_html($settings, 'theme_btn', ''); ?>
                        </a>
                    </div>
                </div>
                <?php if (!empty($settings['tp_description'])): ?>
                    <div class="tp-service-content">
                        <p class="tp-el-desc">
                            <?php echo tp_kses($settings['tp_description']); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

        <?php endif;
    }
}

$widgets_manager->register(new TP_services());