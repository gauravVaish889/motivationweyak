<?php

namespace EdCareCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use Elementor\REPEA;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use EdCareCore\Elementor\Controls\Group_Control_EdCareBGGradient;
use EdCareCore\Elementor\Controls\Group_Control_EdCareGradient;

trait EdCare_Animation_Trait
{

	protected function edcare_creative_animation($condition = null, $control_id = 'ani_demo', $style = 'edcare_design_style', $control_name = 'Creative Animation')
	{

		$section_args = [
			'label' => esc_html__($control_name, 'edcare-care'),
			'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		];

		if ($condition) {
			$section_args['condition'] = [
				$style => $condition
			];
		}
		;

		$this->start_controls_section(
			'creative_animation_sec',
			$section_args
		);

		$this->add_control(
			'edcare_creative_anima_switcher',
			[
				'label' => esc_html__('Active Animation', 'edcare-care'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'edcare-care'),
				'label_off' => esc_html__('No', 'edcare-care'),
				'return_value' => 'yes',
				'default' => '0',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'edcare_anima_type',
			[
				'label' => __('Animation Type', 'edcare-care'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fadeInUp' => __('fadeInUp', 'edcare-care'),
					'fadeInDown' => __('fadeInDown', 'edcare-care'),
					'fadeInLeft' => __('fadeInLeft', 'edcare-care'),
					'fadeInRight' => __('fadeInRight', 'edcare-care'),
					'bounceIn' => __('bounceIn', 'edcare-care'),
				],
				'default' => 'fadeInUp',
				'frontend_available' => true,
				'style_transfer' => true,
				'condition' => [
					'edcare_creative_anima_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'edcare_anima_dura',
			[
				'label' => esc_html__('Animation Duration', 'edcare-care'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('0.3s', 'edcare-care'),
				'condition' => [
					'edcare_creative_anima_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'edcare_anima_delay',
			[
				'label' => esc_html__('Animation Delay', 'edcare-care'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('0.3s', 'edcare-care'),
				'condition' => [
					'edcare_creative_anima_switcher' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	// creative animation value
	protected function edcare_animation_show($data)
	{
		$animation = $data['edcare_creative_anima_switcher'] ? 'wow ' . $data['edcare_anima_type'] : NULL;
		$duration = $data['edcare_anima_dura'] ? 'data-wow-duration="' . $data['edcare_anima_dura'] . '"' : NULL;
		$delay = $data['edcare_anima_delay'] ? 'data-wow-delay="' . $data['edcare_anima_delay'] . '"' : NULL;

		return [
			'animation' => $animation,
			'duration' => $duration,
			'delay' => $delay,
		];
	}

	// Multi creative animation 
	protected function edcare_creative_animation_multi($condition = null, $control_id = 'ani_demo', $style = 'edcare_design_style', $control_name = 'Creative Animation')
	{

		$section_args = [
			'label' => esc_html__($control_name, 'edcare-care'),
			'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		];

		if ($condition) {
			$section_args['condition'] = [
				$style => $condition
			];
		}
		;

		$this->start_controls_section(
			'creative_animation_sec'.$control_id,
			$section_args
		);

		$this->add_control(
			'edcare_creative_anima_switcher'.$control_id,
			[
				'label' => esc_html__('Active Animation', 'edcare-care'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'edcare-care'),
				'label_off' => esc_html__('No', 'edcare-care'),
				'return_value' => 'yes',
				'default' => '0',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'edcare_anima_type'.$control_id,
			[
				'label' => __('Animation Type', 'edcare-care'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fadeInUp' => __('fadeInUp', 'edcare-care'),
					'fadeInDown' => __('fadeInDown', 'edcare-care'),
					'fadeInLeft' => __('fadeInLeft', 'edcare-care'),
					'fadeInRight' => __('fadeInRight', 'edcare-care'),
					'bounceIn' => __('bounceIn', 'edcare-care'),
				],
				'default' => 'fadeInUp',
				'frontend_available' => true,
				'style_transfer' => true,
				'condition' => [
					'edcare_creative_anima_switcher'.$control_id => 'yes',
				],
			]
		);

		$this->add_control(
			'edcare_anima_dura'.$control_id,
			[
				'label' => esc_html__('Animation Duration', 'edcare-care'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('0.3s', 'edcare-care'),
				'condition' => [
					'edcare_creative_anima_switcher'.$control_id => 'yes',
				],
			]
		);

		$this->add_control(
			'edcare_anima_delay'.$control_id,
			[
				'label' => esc_html__('Animation Delay', 'edcare-care'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('0.3s', 'edcare-care'),
				'condition' => [
					'edcare_creative_anima_switcher'.$control_id => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	// creative animation value
	protected function edcare_animation_show_multi($data, $control_id= 'ani_demo')
	{
		$animation = $data['edcare_creative_anima_switcher'.$control_id] ? 'wow ' . $data['edcare_anima_type'.$control_id] : NULL;
		$duration = $data['edcare_anima_dura'.$control_id] ? 'data-wow-duration="' . $data['edcare_anima_dura'.$control_id] . '"' : NULL;
		$delay = $data['edcare_anima_delay'.$control_id] ? 'data-wow-delay="' . $data['edcare_anima_delay'.$control_id] . '"' : NULL;

		return [
			'animation' => $animation,
			'duration' => $duration,
			'delay' => $delay,
		];
	}

}