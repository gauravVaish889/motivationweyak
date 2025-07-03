<?php

namespace EdCareCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;

trait EdCare_Offcanvas_Trait
{

    protected function edcare_offcanvas_controls($control_id = null, $control_name = null)
    {
        $this->start_controls_section(
            'edcare_offcanvas_section',
            [
                'label' => esc_html__('Offcanvas', 'edcare-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'edcare_offcanvas_logo',
            [
                'label' => esc_html__('Choose Logo', 'edcare-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'edcare_offcanvas_logo_white',
            [
                'label' => esc_html__('Choose Logo White', 'edcare-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'edcare_offcanvas_type' => 'full_width'
                ],
            ]
        );



        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'edcare_offcanvas_logo_size',
                'label'   => __('Image Size', 'edcare-core'),
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'edcare_offcanvas_type',
            [
                'label'   => esc_html__('Select Type', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default'  => esc_html__('Default', 'edcare-core'),
                    'full_width'  => esc_html__('Full Width', 'edcare-core'),
                ],
                'default' => 'default',
            ]
        );

        $offcanvas = array(
            'post_type'      => 'edcare-offcanvas',
            'posts_per_page' => -1,
        );
        $offcanvas_loop = get_posts($offcanvas);

        $offcanvas_obj = array();
        foreach ($offcanvas_loop as $post) {
            $offcanvas_obj[$post->ID] = $post->post_title;
        }

        $this->add_control(
            'edcare_offcanvas_template',
            [
                'label'   => esc_html__('Select Template', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => $offcanvas_obj,
                'default' => 'default',
            ]
        );

        $this->end_controls_section();
    }
}
