<?php

// tp metabox 
add_filter('tp_meta_boxes', 'themepure_metabox');

function themepure_metabox($meta_boxes)
{

	$prefix = 'edcare';

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_page_meta_box',
		'title' => esc_html__('TP Page Info', 'edcare'),
		'post_type' => ['page', 'tp-portfolios', 'tp-services', 'product', 'courses', 'post'],
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(

			array(
				'label' => esc_html__('Show Breadcrumb ?', 'edcare'),
				'id' => "{$prefix}_is_breadcrumb_on",
				'type' => 'switch',
				'default' => 'on',
				'conditional' => array()
			),
			array(
				'label' => esc_html__('Breadcrumb', 'edcare'),
				'id' => "{$prefix}_breadcrumb_meta_tabs",
				'desc' => '',
				'type' => 'tabs',
				'choices' => array(
					'default' => esc_html__('Default', 'edcare'),
					'custom' => esc_html__('Custom', 'edcare'),
					'elementor' => esc_html__('Elementor', 'edcare'),
				),
				'default' => 'default',
				'conditional' => array(
					"{$prefix}_is_breadcrumb_on",
					"==",
					"on"
				),
			),
			array(

				'label' => esc_html__('Select Breadcrumb Style', 'edcare'),
				'id' => "{$prefix}_breadcrumb_style",
				'type' => 'select',
				'options' => array(
					'breadcrumb_1' => esc_html__('Breadcrumb 1', 'edcare'),
				),
				'placeholder' => esc_html__('Select a breadcrumb', 'edcare'),
				'conditional' => array(
					"{$prefix}_breadcrumb_meta_tabs",
					"==",
					"custom"
				),
				'default' => 'breadcrumb_1',
				'parent' => "{$prefix}_breadcrumb_meta_tabs"
			),

			array(

				'label' => esc_html__('Select Breadcrumb Template', 'edcare'),
				'id' => "{$prefix}_breadcrumb_meta_templates",
				'type' => 'select_posts',
				'placeholder' => esc_html__('Select a template', 'edcare'),
				'post_type' => 'tp-breadcrumb',
				'conditional' => array(
					"{$prefix}_breadcrumb_meta_tabs",
					"==",
					"elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_breadcrumb_meta_tabs"
			),
			array(

				'label' => esc_html__('Background Image', 'edcare'),
				'id' => "{$prefix}_breadcrumb_bg",
				'type' => 'image',
				'default' => '',
				'conditional' => array(
					"{$prefix}_is_breadcrumb_on",
					"==",
					"on"
				),
			),
			array(
				'label' => esc_html__('Background Color', 'edcare'),
				'id' => "{$prefix}_breadcrumb_bg_color",
				'type' => 'colorpicker',
				'default' => '',
				'conditional' => array(
					"{$prefix}_is_breadcrumb_on",
					"==",
					"on"
				),
			),
		),
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_course_meta_box',
		'title' => esc_html__('EdCare Course Meta', 'edcare'),
		'post_type' => ['courses'],
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(

				'label' => esc_html__('Select Single Layout', 'edcare'),
				'id' => "{$prefix}_course_single_layout",
				'type' => 'select',
				'options' => array(
					'default' => esc_html__('Default', 'edcare'),
					'course_single_standard' => esc_html__('Standard', 'edcare'),
					'course_single_classic' => esc_html__('Classic', 'edcare'),
				),
				'placeholder' => 'Select an item',
				'conditional' => array(),
				'default' => '',
				'multiple' => false,

			),
			array(
				'label' => esc_html__('Language', 'edcare'),
				'id' => "{$prefix}_course_lang",
				'type' => 'text',
				'placeholder' => '',
				'default' => '',
			),
			array(
				'label' => esc_html__('Has Certificate?', 'edcare'),
				'id' => "{$prefix}_course_certificate",
				'type' => 'switch',
				'placeholder' => '',
				'default' => 'on',
			),
			array(
				'label' => esc_html__('Course Deadline', 'edcare'),
				'id' => "{$prefix}_course_deadline",
				'type' => 'datepicker', // specify the type field
				'default' => '',
				'conditional' => array()
			),
		),
	);

	//for header and footer
	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_page_header_footer_meta_box',
		'title' => esc_html__('Header & Footer', 'edcare'),
		'post_type' => ['page', 'tp-portfolios', 'tp-services', 'product'],
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(


			// logo
			array(
				'label' => esc_html__('Logo Black', 'edcare'),
				'id' => "{$prefix}_logo_black",
				'type' => 'image', // specify the type field
				'default' => '',
				'conditional' => array()
			),
			array(
				'label' => esc_html__('Logo White', 'edcare'),
				'id' => "{$prefix}_logo_white",
				'type' => 'image', // specify the type field
				'default' => '',
				'conditional' => array()
			),
			array(
				'label' => esc_html__('Header', 'edcare'),
				'id' => "{$prefix}_header_tabs",
				'desc' => '',
				'type' => 'tabs',
				'choices' => array(
					'default' => esc_html__('Default', 'edcare'),
					'custom' => esc_html__('Custom', 'edcare'),
					'elementor' => esc_html__('Elementor', 'edcare'),
				),
				'default' => 'default',
				'conditional' => array()
			),

			// select field dropdown
			array(

				'label' => esc_html__('Select Header Style', 'edcare'),
				'id' => "{$prefix}_header_style",
				'type' => 'select',
				'options' => array(
					'header_1' => esc_html__('Header 1', 'edcare'),
				),
				'placeholder' => esc_html__('Select a header', 'edcare'),
				'conditional' => array(
					"{$prefix}_header_tabs",
					"==",
					"custom"
				),
				'default' => 'header_1',
				'parent' => "{$prefix}_header_tabs"
			),

			// select field dropdown
			array(

				'label' => esc_html__('Select Header Template', 'edcare'),
				'id' => "{$prefix}_header_templates",
				'type' => 'select_posts',
				'placeholder' => esc_html__('Select a template', 'edcare'),
				'post_type' => 'edcare-header',
				'conditional' => array(
					"{$prefix}_header_tabs",
					"==",
					"elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_header_tabs"
			),

			array(
				'label' => esc_html__('Footer', 'edcare'),
				'id' => "{$prefix}_footer_tabs",
				'desc' => '',
				'type' => 'tabs',
				'choices' => array(
					'default' => esc_html__('Default', 'edcare'),
					'custom' => esc_html__('Custom', 'edcare'),
					'elementor' => esc_html__('Elementor', 'edcare'),
				),
				'default' => 'default',
				'conditional' => array()
			),

			// select field dropdown
			array(

				'label' => esc_html__('Select Footer Style', 'edcare'),
				'id' => "{$prefix}_footer_style",
				'type' => 'select',
				'options' => array(
					'footer_1' => esc_html__('Footer 1', 'edcare'),
				),
				'placeholder' => esc_html__('Select a footer', 'edcare'),
				'conditional' => array(
					"{$prefix}_footer_tabs",
					"==",
					"custom"
				),
				'default' => 'footer_1',
				'parent' => "{$prefix}_footer_tabs"
			),

			// select field dropdown
			array(

				'label' => esc_html__('Select Footer Template', 'edcare'),
				'id' => "{$prefix}_footer_templates",
				'type' => 'select_posts',
				'placeholder' => esc_html__('Select a template', 'edcare'),
				'post_type' => 'tp-footer',
				'conditional' => array(
					"{$prefix}_footer_tabs",
					"==",
					"elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_footer_tabs"
			),
		),
	);

	// post single layout
	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_post_single_layout_meta',
		'title' => esc_html__('Post Single Layout', 'edcare'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(

			array(

				'label' => esc_html__('Select Single Layout', 'edcare'),
				'id' => "{$prefix}_post_single_layout",
				'type' => 'select',
				'options' => array(
					'default' => esc_html__('Default', 'edcare'),
					'blog_single_standard' => esc_html__('Standard', 'edcare'),
					'blog_single_classic' => esc_html__('Full Width', 'edcare'),
				),
				'placeholder' => 'Select an item',
				'conditional' => array(),
				'default' => '',
				'multiple' => false,

			)
		),
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_post_gallery_meta',
		'title' => esc_html__('TP Gallery Post', 'edcare'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'label' => esc_html__('Gallery', 'edcare'),
				'id' => "{$prefix}_post_gallery",
				'type' => 'gallery',
				'default' => '',
				'conditional' => array(),
			),
		),
		'post_format' => 'gallery'
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_post_video_meta',
		'title' => esc_html__('TP Video Post', 'edcare'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'label' => esc_html__('Video', 'edcare'),
				'id' => "{$prefix}_post_video",
				'type' => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder' => esc_html__('Place your video url.', 'edcare'),
			),
		),
		'post_format' => 'video'
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_post_audio_meta',
		'title' => esc_html__('TP Audio Post', 'edcare'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'label' => esc_html__('Audio', 'edcare'),
				'id' => "{$prefix}_post_audio",
				'type' => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder' => esc_html__('Place your audio url..', 'edcare'),
			),
		),
		'post_format' => 'audio'
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_product_single_section',
		'title' => esc_html__('Select Single Layout', 'edcare'),
		'post_type' => 'product',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(

				'label' => esc_html__('Select Single Layout', 'edcare'),
				'id' => "{$prefix}_product_single_layout",
				'type' => 'select',
				'options' => array(
					'style_default' => esc_html__('Default', 'edcare'),
					'style_standard' => esc_html__('Standard', 'edcare'),
				),
				'placeholder' => 'Select a layout',
				'conditional' => array(),
				'default' => '',
				'multiple' => false,

			)
		),
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_course_details_section',
		'title' => esc_html__('Additional Info For Course', 'edcare'),
		'post_type' => 'lp_course',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'id' => $prefix.'_course_video_url',
				'label' => 'Video URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Insert Video URL...',
			),
			array(
				'id' => $prefix.'_course_language',
				'label' => 'Corurse Language',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Write Course Language...',
			),
			array(
				'label' => 'Deadline',
				'id'    => $prefix.'_course_deadline',
				'type'  => 'datepicker',
				'placeholder' => '',
				'default'     => '',
				'conditional' => array()
			)
		),
	);

	return $meta_boxes;
}


function add_user_metas()
{
	$meta = array(
		'id' => 'edcare_user_meta_sec',
		'label' => 'User Social Information',
		'fields' => array(
			array(
				'id' => 'edcare_facebook',
				'label' => 'Facebook URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Facebook URL...',
				'show_in_admin_table' => 1
			),
			array(
				'id' => 'edcare_twitter',
				'label' => 'Twitter URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Twitter URL...',
				'show_in_admin_table' => 1
			),
			array(
				'id' => 'edcare_linkedin',
				'label' => 'Linkedin URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Linkedin URL...',
				'show_in_admin_table' => 1
			),
			array(
				'id' => 'edcare_instagram',
				'label' => 'Instagram URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Instagram URL...',
				'show_in_admin_table' => 1
			),
			array(
				'id' => 'edcare_youtube',
				'label' => 'Youtube URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Instagram URL...',
				'show_in_admin_table' => 1
			),
			array(
				'label' => esc_html__('Avater', 'edcare'),
				'id' => "edcare_author_avater",
				'type' => 'image', // specify the type field
				'default' => '',
				'show_in_admin_table' => 1
			)
		)
	);

	return $meta;
}
add_filter('tp_user_meta', 'add_user_metas');
