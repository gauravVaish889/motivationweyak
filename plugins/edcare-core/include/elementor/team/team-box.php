<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Team extends Widget_Base
{

    use TP_Style_Trait, TP_Column_Trait, TP_Animation_Trait;

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
        return 'tp-team';
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
        return __(EDCARE_CORE_THEME_NAME . ' :: Team', 'tpcore');
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
        $this->tp_design_layout('Select Layout', 2);

        // member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __('Members', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'navigation_arrow_swich',
            [
                'label' => esc_html__('Enable Navigation Arrow ?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'tp_design_style' => ['layout-1']
                ]
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
                    'style_2' => __('Style 2', 'tpcore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __('Information', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'tpcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'tpcore'),
                'default' => __('TP Member Name', 'tpcore'),
                'placeholder' => __('Type title here', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __('Job Title', 'tpcore'),
                'default' => __('TP Officer', 'tpcore'),
                'placeholder' => __('Type designation here', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tp_title_link_type',
            [
                'label' => esc_html__('Title Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
            ]
        );

        $repeater->add_control(
            'tp_title_custome_link',
            [
                'label' => esc_html__('Custome Url', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_title_link_type' => '1',
                ]
            ]
        );
        $repeater->add_control(
            'tp_title_page_link',
            [
                'label' => esc_html__('Internal Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_title_link_type' => '2',
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'single_service_icon_bgcolor',
                'label' => esc_html__('Background Color', 'tpcore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-team-bg-color',
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __('Links', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __('Show Social Links?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tpcore'),
                'label_off' => __('No', 'tpcore'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Website Address', 'tpcore'),
                'placeholder' => __('Add your profile link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Email', 'tpcore'),
                'placeholder' => __('Add your email link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Phone', 'tpcore'),
                'placeholder' => __('Add your phone link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Facebook', 'tpcore'),
                'default' => __('#', 'tpcore'),
                'placeholder' => __('Add your facebook link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Twitter', 'tpcore'),
                'default' => __('#', 'tpcore'),
                'placeholder' => __('Add your twitter link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Instagram', 'tpcore'),
                'default' => __('#', 'tpcore'),
                'placeholder' => __('Add your instagram link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('LinkedIn', 'tpcore'),
                'placeholder' => __('Add your linkedin link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Youtube', 'tpcore'),
                'placeholder' => __('Add your youtube link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Google Plus', 'tpcore'),
                'placeholder' => __('Add your Google Plus link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Flickr', 'tpcore'),
                'placeholder' => __('Add your flickr link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Vimeo', 'tpcore'),
                'placeholder' => __('Add your vimeo link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Behance', 'tpcore'),
                'placeholder' => __('Add your hehance link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Dribbble', 'tpcore'),
                'placeholder' => __('Add your dribbble link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Pinterest', 'tpcore'),
                'placeholder' => __('Add your pinterest link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Github', 'tpcore'),
                'placeholder' => __('Add your github link', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'tp_title_tag',
            [
                'label' => __('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // colum controls
        $this->tp_columns('col', 'layout-10');

        // animation
        $this->tp_creative_animation('');
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('team_item', 'Team Item', '.tp-el-item');
        $this->tp_basic_style_controls('team_name', 'Member Name', '.tp-el-team-name');
        $this->tp_basic_style_controls('team_designation', 'Member Designation', '.tp-el-team-desi');
        $this->tp_link_controls_style('team_social', 'Member Social Icon', '.tp-el-team-social', 'layout-1');


        $this->start_controls_section(
            '_section_style_arrow',
            [
                'label' => __('Arrow Style', 'tpcore'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation_arrow_swich' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_arrow_margin',
            [
                'label' => __('Margin', 'tpcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .el-nav-arrow-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'selector' => '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow',
            ]
        );

        $this->add_control(
            'arrow_width',
            [
                'label' => esc_html__('Width', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_height',
            [
                'label' => esc_html__('Height', 'tpcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __('Border Radius', 'tpcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_arrow');

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __('Normal', 'tpcore'),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_bg_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .slick-arrow::after, {{WRAPPER}} .el-nav-arrow',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Hover', 'tpcore'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Text Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover, {{WRAPPER}} .el-nav-arrow:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_hover_bg_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .slick-arrow:hover::after, {{WRAPPER}} .el-nav-arrow:hover',
            ]
        );

        $this->add_control(
            'arrow_hover_border_color',
            [
                'label' => __('Border Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'arrow_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

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

        <?php if ($settings['tp_design_style'] === 'layout-2'):
            $animation = $this->tp_animation_show($settings);
            $attrs = [
                'class' => "tp-trainer-5-wrap " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];
            ?>

            <div <?php echo tp_implode_html_attributes($attrs); ?>>
                <div class="swiper tp-trainer-5-active">
                    <div class="swiper-wrapper">

                        <?php foreach ($settings['teams'] as $key => $item):

                            $title = tp_kses($item['title']);
                            $key = $key + 1;
                            if (!empty($item['image']['url'])) {
                                $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            $this->add_render_attribute('title_args', 'class', 'tp-trainer-5-title tp-team-title');

                            // text link 
                            if ('2' == $item['tp_title_link_type']) {
                                $link = get_permalink($item['tp_title_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_title_custome_link']['url']) ? $item['tp_title_custome_link']['url'] : '';
                                $target = !empty($item['tp_title_custome_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_title_custome_link']['nofollow']) ? 'nofollow' : '';
                            }
                            ?>

                            <div class="swiper-slide tp-trainer-5-item">

                                <?php if (!empty($tp_team_image_url)): ?>
                                    <div class="tp-trainer-5-thumb">
                                        <img src="<?php echo esc_url($tp_team_image_url); ?>"
                                            alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="tp-trainer-5-box">
                                    <div class="tp-trainer-5-content">
                                        <div class="tp-trainer-5-info">
                                            <?php
                                            if (!empty($link)) {
                                                $t_link = esc_attr($link);
                                                $t_target = esc_attr($target);
                                                $t_rel = esc_attr($rel);
                                                if (!empty($title)):
                                                    printf(
                                                        '<%1$s %4$s %2$s><a class= "tp-el-team-name" href="%4$s" target="%5$s" rel="%6$s">%3$s </a></%1$s>',
                                                        tag_escape($settings['tp_title_tag']),
                                                        $this->get_render_attribute_string('title_args'),
                                                        tp_kses($title),
                                                        $t_link,
                                                        $t_target,
                                                        $t_rel
                                                    );
                                                endif;
                                            } else {
                                                if (!empty($title)):
                                                    printf(
                                                        '<%1$s %2$s>%3$s </%1$s>',
                                                        tag_escape($settings['tp_title_tag']),
                                                        $this->get_render_attribute_string('title_args'),
                                                        tp_kses($title),
                                                    );
                                                endif;
                                            }
                                            ?>
                                            <?php if (!empty($item['designation'])): ?>
                                                <span class="tp-el-team-desi">
                                                    <?php echo tp_kses($item['designation']); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <?php if (!empty($item['show_social'])): ?>
                                            <div class="tp-trainer-5-social">
                                                <?php if (!empty($item['web_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['web_title']); ?>">
                                                        <i class="fas fa-globe"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['phone_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['phone_title']); ?>"><i
                                                            class="fas fa-phone"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['facebook_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['facebook_title']); ?>"><i
                                                            class="fab fa-facebook-f"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['twitter_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['twitter_title']); ?>"><i
                                                            class="fab fa-twitter"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['linkedin_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['linkedin_title']); ?>"><i
                                                            class="fab fa-linkedin"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['instagram_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['instagram_title']); ?>"><i
                                                            class="fab fa-instagram"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['youtube_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['youtube_title']); ?>"><i
                                                            class="fab fa-youtube"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['googleplus_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['googleplus_title']); ?>"><i
                                                            class="fab fa-google-plus-g"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['flickr_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['flickr_title']); ?>"><i
                                                            class="fab fa-flickr"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['vimeo_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['vimeo_title']); ?>"><i
                                                            class="fab fa-vimeo-v"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['behance_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['behance_title']); ?>"><i
                                                            class="fab fa-behance"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['dribble_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['dribble_title']); ?>"><i
                                                            class="fab fa-dribbble"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['pinterest_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['pinterest_title']); ?>"><i
                                                            class="fab fa-pinterest-p"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['gitub_title'])): ?>
                                                    <a class="tp-el-team-social" href="<?php echo esc_url($item['gitub_title']); ?>"><i
                                                            class="fab fa-github"></i></a>
                                                <?php endif; ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        <?php else:
            $animation = $this->tp_animation_show($settings);
            ?>

            <?php if (!empty($settings['navigation_arrow_swich'])): ?>
                <div class="tp-team-2-arrow el-nav-arrow-item d-flex align-items-center justify-content-md-end mb-55">
                    <div class="tp-team-2-prev">
                        <span class="el-nav-arrow">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 11L1 6L6 1" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <div class="tp-team-2-next">
                        <span class="el-nav-arrow">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="swiper tp-team-2-active <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <div class="swiper-wrapper align-items-end">
                    <?php foreach ($settings['teams'] as $key => $item):

                        $title = tp_kses($item['title']);
                        $key = $key + 1;
                        if (!empty($item['image']['url'])) {
                            $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                            $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        $this->add_render_attribute('title_args', 'class', ' tp-team-2-title tp-team-title');

                        // text link 
                        if ('2' == $item['tp_title_link_type']) {
                            $link = get_permalink($item['tp_title_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_title_custome_link']['url']) ? $item['tp_title_custome_link']['url'] : '';
                            $target = !empty($item['tp_title_custome_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_title_custome_link']['nofollow']) ? 'nofollow' : '';
                        }
                        ?>
                        <div class="swiper-slide elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                            <div class="tp-team-2-item">
                                <div class="tp-team-2-bg tp-el-team-bg-color"></div>

                                <?php if (!empty($item['show_social'])): ?>
                                    <div class="tp-team-2-social">
                                        <span class="tp-team-2-social-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </span>
                                        <div class="tp-team-2-social-icon">
                                            <?php if (!empty($item['web_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['web_title']); ?>"><i
                                                        class="fas fa-globe"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['phone_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['phone_title']); ?>"><i
                                                        class="fas fa-phone"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['facebook_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['facebook_title']); ?>"><i
                                                        class="fab fa-facebook-f"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['twitter_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['twitter_title']); ?>"><i
                                                        class="fab fa-twitter"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['linkedin_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['linkedin_title']); ?>"><i
                                                        class="fab fa-linkedin"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['instagram_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['instagram_title']); ?>"><i
                                                        class="fab fa-instagram"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['youtube_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['youtube_title']); ?>"><i
                                                        class="fab fa-youtube"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['googleplus_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['googleplus_title']); ?>"><i
                                                        class="fab fa-google-plus-g"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['flickr_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['flickr_title']); ?>"><i
                                                        class="fab fa-flickr"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['vimeo_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['vimeo_title']); ?>"><i
                                                        class="fab fa-vimeo-v"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['behance_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['behance_title']); ?>"><i
                                                        class="fab fa-behance"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['dribble_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['dribble_title']); ?>"><i
                                                        class="fab fa-dribbble"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['pinterest_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['pinterest_title']); ?>"><i
                                                        class="fab fa-pinterest-p"></i></a>
                                            <?php endif; ?>
                                            <?php if (!empty($item['gitub_title'])): ?>
                                                <a class="tp-el-team-social" href="<?php echo esc_url($item['gitub_title']); ?>"><i
                                                        class="fab fa-github"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($tp_team_image_url)): ?>
                                    <div class="tp-team-2-thumb tp-thumb">
                                        <img class="w-100" src="<?php echo esc_url($tp_team_image_url); ?>"
                                            alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="tp-team-2-content tp-el-item">

                                    <?php
                                    if (!empty($link)) {
                                        $t_link = esc_attr($link);
                                        $t_target = esc_attr($target);
                                        $t_rel = esc_attr($rel);
                                        if (!empty($title)):
                                            printf(
                                                '<%1$s %4$s %2$s><a class= "tp-el-team-name" href="%4$s" target="%5$s" rel="%6$s">%3$s </a></%1$s>',
                                                tag_escape($settings['tp_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($title),
                                                $t_link,
                                                $t_target,
                                                $t_rel
                                            );
                                        endif;
                                    } else {
                                        if (!empty($title)):
                                            printf(
                                                '<%1$s %2$s>%3$s </%1$s>',
                                                tag_escape($settings['tp_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($title),
                                            );
                                        endif;
                                    }
                                    ?>
                                    <?php if (!empty($item['designation'])): ?>
                                        <span class="tp-el-team-desi">
                                            <?php echo tp_kses($item['designation']); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif;
    }
}

$widgets_manager->register(new TP_Team());
