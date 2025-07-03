<?php
namespace EdCareCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Utils;

trait EdCare_Icon_Trait
{

    protected function edcare_single_icon_control($control_id = null, $condition_key = null, $conditions_value = 'layout-1')
    {


        $this->add_control(
            'edcare_' . $control_id . '_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'edcare-core'),
                    'icon' => esc_html__('Icon', 'edcare-core'),
                    'svg' => esc_html__('SVG', 'edcare-core'),
                ],
                'condition' => [
                    $condition_key => $conditions_value
                ]
            ]
        );

        $this->add_control(
            'edcare_' . $control_id . '_image',
            [
                'label' => esc_html__('Upload Icon Image', 'edcare-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'edcare_' . $control_id . '_icon_type' => 'image',
                    $condition_key => $conditions_value
                ]

            ]
        );

        $this->add_control(
            'edcare_' . $control_id . '_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'edcare-core'),
                'condition' => [
                    'edcare_' . $control_id . '_icon_type' => 'svg',
                    $condition_key => $conditions_value
                ]
            ]
        );


        $this->add_control(
            'edcare_' . $control_id . '_icon',
            [
                'label' => esc_html__('Icon', 'edcare-core'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-regular fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
                'condition' => [
                    'edcare_' . $control_id . '_icon_type' => 'icon',
                    $condition_key => $conditions_value
                ],
            ]
        );
    }

    /**
     * Daynamic Icon Trait
     * 
     */
    function edcare_icon_show($data)
    {
        if ($data['edcare_box_icon_type'] == 'icon'): ?>
            <?php if (!empty($data['edcare_box_icon']) || !empty($data['edcare_box_selected_icon']['value'])): ?>
                <?php edcare_render_icon($data, 'edcare_box_icon', 'edcare_box_selected_icon'); ?>
            <?php endif; ?>
        <?php elseif ($data['edcare_box_icon_type'] == 'image'): ?>
            <?php if (!empty($data['edcare_box_icon_image']['url'])): ?>
                <img src="<?php echo $data['edcare_box_icon_image']['url']; ?>"
                    alt="<?php echo get_post_meta(attachment_url_to_postid($data['edcare_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
            <?php endif; ?>
        <?php else: ?>
            <?php if (!empty($data['edcare_box_icon_svg'])): ?>
                <?php echo $data['edcare_box_icon_svg']; ?>
            <?php endif; ?>
        <?php endif;
    }
}