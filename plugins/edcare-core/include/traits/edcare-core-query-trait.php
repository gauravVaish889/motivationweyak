<?php

namespace EdCareCore\Widgets;

use Elementor\Controls_Manager;



trait EdCare_Query_Trait
{
    protected function edcare_query_controls($control_id = null, $control_name = null, $post_type = 'any', $taxonomy = 'category', $default_title_num = 6, $default_content_limit = '10', $posts_per_page = '6', $offset = '0', $orderby = 'date', $order = 'desc', $date_format = false, $has_content = false, $view_pagination = false, $post_read_more = false)
    {

        $this->start_controls_section(
            'edcare' . $control_id . '_query',
            [
                'label' => sprintf(esc_html__('%s Query', 'edcare-core'), $control_name),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'edcare-core'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => $posts_per_page,
            ]
        );
        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'edcare-core'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => edcare_get_categories($taxonomy),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'edcare-core'),
                'description' => esc_html__('Select a category to exclude', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => edcare_get_categories($taxonomy),
                'label_block' => true
            ]
        );
        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => edcare_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__in',
            [
                'label' => esc_html__('Include Item', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => edcare_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );


        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => $offset,
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => edcare_get_orderby_options(),
                'default' => $orderby,

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => esc_html__('Ascending', 'edcare-core'),
                    'desc' => esc_html__('Descending', 'edcare-core')
                ],
                'default' => $order,

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__('Ignore Sticky Posts', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'edcare-core'),
                'label_off' => esc_html__('No', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'edcare_post_title_word',
            [
                'label' => esc_html__('Title Word Count', 'edcare-core'),
                'description' => esc_html__('Set how many word you want to displa!', 'edcare-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => $default_title_num,
            ]
        );

        if ($date_format) {
            $this->add_control(
                'edcare_post_date_format',
                [
                    'label' => esc_html__('Date Format', 'edcare-core'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'default' => esc_html__('Default', 'edcare-core'),
                        'd-m-Y' => esc_html__('d-m-Y', 'edcare-core'),
                        'd/m/Y' => esc_html__('d/m/Y', 'edcare-core'),
                        'm-d-Y' => esc_html__('m-d-Y', 'edcare-core'),
                        'm/d/Y' => esc_html__('m/d/Y', 'edcare-core'),
                        'Y-m-d' => esc_html__('Y-m-d', 'edcare-core'),
                        'custom' => esc_html__('Custom', 'edcare-core'),

                    ],
                    'default' => 'default',
                ]
            );

            $this->add_control(
                'edcare_post_date_custom_format',
                [
                    'label' => esc_html__('Custom Date Format', 'edcare-core'),
                    'description' => esc_html__('Enter your custom date format.', 'edcare-core'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'F j, Y',
                    'condition' => [
                        'edcare_post_date_format' => 'custom',
                    ]
                ]
            );

        }

        if ($post_type == 'post' && $has_content) {
            $this->add_control(
                'edcare_post_content',
                [
                    'label' => __('Content', 'edcare-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'edcare-core'),
                    'label_off' => __('Hide', 'edcare-core'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'edcare_post_content_limit',
                [
                    'label' => __('Content Limit', 'edcare-core'),
                    'type' => Controls_Manager::TEXT,
                    'default' => $default_content_limit,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'edcare_post_content' => 'yes',

                    ]
                ]
            );
        }

        if ($post_read_more) {
            $this->add_control(
                'post_read_more_btn_text',
                [
                    'label' => esc_html__('Read More Button', 'edcare-core'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Read More', 'edcare-core'),
                    'placeholder' => esc_html__('Your Text', 'edcare-core'),
                    'label_block' => true,
                ]
            );
        }

        if ($view_pagination) {
            $this->add_control(
                'edcare_post_pagination',
                [
                    'label' => esc_html__('Pagination On/Off', 'edcare-core'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'edcare-core'),
                    'label_off' => esc_html__('Hide', 'edcare-core'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_responsive_control(
                'edcare_post_pagination_alignment',
                [
                    'label' => esc_html__('Pagination Alignment', 'edcare-core'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
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
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .edcare-el-pagination-alignment' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'edcare_post_pagination' => 'yes',
                    ],
                ]
            );
        }


        $this->end_controls_section();

    }

    protected function edcare_query_meta_controls($control_id = null, $control_name = null, $show_category = true, $show_date = true, $show_author = false, $show_comment = false)
    {
        $this->start_controls_section(
            'edcare' . $control_id . '_meta',
            [
                'label' => sprintf(esc_html__('%s Meta', 'edcare-core'), $control_name),
            ]
        );

        if ($show_category) {
            $this->add_control(
                'edcare_post_category',
                [
                    'label' => esc_html__('Category', 'edcare-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'edcare-core'),
                    'label_off' => esc_html__('Hide', 'edcare-core'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        }

        if ($show_date) {
            $this->add_control(
                'edcare_post_date',
                [
                    'label' => esc_html__('Date', 'edcare-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'edcare-core'),
                    'label_off' => esc_html__('Hide', 'edcare-core'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        }

        if ($show_author) {
            $this->add_control(
                'edcare_post_author',
                [
                    'label' => esc_html__('Author', 'edcare-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'edcare-core'),
                    'label_off' => esc_html__('Hide', 'edcare-core'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        }

        if ($show_comment) {
            $this->add_control(
                'edcare_post_comment',
                [
                    'label' => esc_html__('Comment', 'edcare-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'edcare-core'),
                    'label_off' => esc_html__('Hide', 'edcare-core'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        }

        $this->end_controls_section();

    }
}