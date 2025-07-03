<?php

namespace EdCareCore\Widgets;

use Elementor\Controls_Manager;

trait EdCare_Column_Trait
{

    protected function edcare_columns($control_id = 'columns_options', $condition = null, $control_name = 'Select Columns', $default_for_lg = '4', $default_for_md = '6', $default_for_sm = '6', $default_for_all = '12')
    {

        $section_args = [
            'label' => esc_html__($control_name, 'edcare-core'),
        ];

        if ($condition) {
            $section_args['condition'] = [
                'edcare_design_style' => $condition
            ];
        }
        ;
        $this->start_controls_section(
            'edcare_' . $control_id . 'columns_section',
            $section_args
        );

        $this->add_control(
            'edcare_' . $control_id . '_for_desktop',
            [
                'label' => esc_html__('Columns for Desktop', 'edcare-core'),
                'description' => esc_html__('Screen width equal to or greater than 1200px', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_lg,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'edcare_' . $control_id . '_for_laptop',
            [
                'label' => esc_html__('Columns for Large', 'edcare-core'),
                'description' => esc_html__('Screen width equal to or greater than 992px', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                     12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_md,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'edcare_' . $control_id . '_for_tablet',
            [
                'label' => esc_html__('Columns for Tablet', 'edcare-core'),
                'description' => esc_html__('Screen width equal to or greater than 768px', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                     12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_sm,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'edcare_' . $control_id . '_for_mobile',
            [
                'label' => esc_html__('Columns for Mobile', 'edcare-core'),
                'description' => esc_html__('Screen width less than 767px', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                     12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_all,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'edcare_' . $control_id . '_for_xs',
            [
                'label' => esc_html__('Columns for XS Devices', 'edcare-core'),
                'description' => esc_html__('Screen width less than 767px', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                     12 => esc_html__( '1 Columns', 'edcare-core' ),
                    6 => esc_html__( '2 Columns', 'edcare-core' ),
                    4 => esc_html__( '3 Columns', 'edcare-core' ),
                    3 => esc_html__( '4 Columns', 'edcare-core' ),
                    2 => esc_html__( '6 Columns', 'edcare-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_all,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }


    // colum show
    protected function col_show($data, $key = 'col')
    {
        $desktop = "col-xl-" . esc_attr($data['edcare_'.$key.'_for_desktop']);
        $laptop = "col-lg-" . esc_attr($data['edcare_'.$key.'_for_laptop']);
        $tablet = "col-md-" . esc_attr($data['edcare_'.$key.'_for_tablet']);
        $tablet = "col-md-" . esc_attr($data['edcare_'.$key.'_for_tablet']);
        $mobile = "col-sm-" . esc_attr($data['edcare_'.$key.'_for_mobile']);
        $xs = "col-" . esc_attr($data['edcare_'.$key.'_for_xs']);

        $total_col = $desktop . " " . $laptop . " " . $tablet . " " . $mobile . " " . $xs;

        return $total_col;
    }

    // colum show
    protected function row_cols_show($data, $key = 'col')
    {
        $desktop = "row-cols-xl-" . esc_attr($data['edcare_'.$key.'_for_desktop']);
        $laptop = "row-cols-lg-" . esc_attr($data['edcare_'.$key.'_for_laptop']);
        $tablet = "row-cols-md-" . esc_attr($data['edcare_'.$key.'_for_tablet']);
        $tablet = "row-cols-md-" . esc_attr($data['edcare_'.$key.'_for_tablet']);
        $mobile = "row-cols-sm-" . esc_attr($data['edcare_'.$key.'_for_mobile']);
        $xs = "row-cols-" . esc_attr($data['edcare_'.$key.'_for_xs']);

        $total_col = $desktop . " " . $laptop . " " . $tablet . " " . $mobile . " " . $xs;

        return $total_col;
    }

}