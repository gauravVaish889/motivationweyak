<?php


new \Kirki\Panel(
    'edcare_panel',
    [
        'priority' => 10,
        'title' => esc_html__('EdCare Customizer', 'edcare'),
        'description' => esc_html__('EdCare Theme Customizer.', 'edcare'),
    ]
);

function edcare_theme_settings()
{

    new \Kirki\Section(
        'edcare_theme_settings_section',
        [
            'title' => esc_html__('Theme Settings', 'edcare'),
            'description' => esc_html__('Theme Controls.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 100,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_header_sticky',
            'label' => esc_html__('Header Sticky Switcher', 'edcare'),
            'description' => esc_html__('Header Sticky On/Off', 'edcare'),
            'section' => 'edcare_theme_settings_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_mouse_cursor_switch',
            'label' => esc_html__('Mouse Cursor Switcher', 'edcare'),
            'description' => esc_html__('Mouse Cursor On/Off', 'edcare'),
            'section' => 'edcare_theme_settings_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_mouse_cursor_color',
            'label' => __('Cursor Color', 'edcare'),
            'description' => esc_html__('You can change cursor color from here.', 'edcare'),
            'section' => 'edcare_theme_settings_section',
            'default' => '#07a698',
            'output' => [
                [
                    'element' => '.mt-cursor:before',
                    'property' => 'background',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_mouse_cursor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
edcare_theme_settings();


function edcare_header_settings()
{

    new \Kirki\Section(
        'header_main_section',
        [
            'title' => esc_html__('Header Main Settings', 'edcare'),
            'description' => esc_html__('Header Main Controls.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 101,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_header_elementor_switch',
            'label' => esc_html__('Header Custom/Elementor Switch', 'edcare'),
            'description' => esc_html__('Header Custom/Elementor On/Off', 'edcare'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'header_layout_custom',
            'label' => esc_html__('Chose Header Style', 'edcare'),
            'section' => 'header_main_section',
            'priority' => 10,
            'choices' => [
                'header_1' => get_template_directory_uri() . '/inc/img/header/header-1.png',
            ],
            'default' => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'edcare_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_buildertype = array(
        'post_type' => 'edcare-header',
        'posts_per_page' => -1,
    );
    $header_buildertype_loop = get_posts($header_buildertype);

    $header_post_obj_arr = array();
    foreach ($header_buildertype_loop as $post) {
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }


    wp_reset_query();


    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_header_templates',
            'label' => esc_html__('Elementor Header Template', 'edcare'),
            'section' => 'header_main_section',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => $header_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'edcare_header_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_topbar_switch',
            'label' => esc_html__('Header Topbar Switch', 'edcare'),
            'description' => esc_html__('Header Topbar On/Off', 'edcare'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_right_switch',
            'label' => esc_html__('Header Right Switch', 'edcare'),
            'description' => esc_html__('Header Right On/Off', 'edcare'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_header_cart',
            'label' => esc_html__('Header Cart Switch', 'edcare'),
            'description' => esc_html__('Header Cart On/Off', 'edcare'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_header_wishlist',
            'label' => esc_html__('Header Wishlist Switch', 'edcare'),
            'description' => esc_html__('Header Wishlist On/Off', 'edcare'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_header_hamburger',
            'label' => esc_html__('Header Hamburger Switch', 'edcare'),
            'description' => esc_html__('Header Hamburger On/Off', 'edcare'),
            'section' => 'header_main_section',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_btn_text',
            'label'    => esc_html__( 'Header Right Button', 'edcare' ),
            'description' => esc_html__('This is Header Right Button Text', 'edcare'),
            'section'  => 'header_main_section',
            'default'  => esc_html__( 'Start Free Trial', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'edcare_header_btn_url',
            'label'    => esc_html__( 'Header Button URL', 'edcare' ),
            'description' => esc_html__('This is Header Right Button URL', 'edcare'),
            'section'  => 'header_main_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );

}
edcare_header_settings();

function edcare_logo_settings()
{
    // header_logo_section section
    new \Kirki\Section(
        'header_logo_section',
        [
            'title' => esc_html__('Header Logo', 'edcare'),
            'description' => esc_html__('Header Logo Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 102,
        ]
    );

    // header_logo_section section
    new \Kirki\Field\Image(
        [
            'settings' => 'header_logo_black',
            'label' => esc_html__('Header Black Logo', 'edcare'),
            'description' => esc_html__('Theme Default/Primary Logo Here', 'edcare'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'header_logo_white',
            'label' => esc_html__('Header White Logo', 'edcare'),
            'description' => esc_html__('Theme White Logo Here', 'edcare'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/logo.png',
        ]
    );

    new \Kirki\Field\Dimension(
        [
            'settings' => 'edcare_header_logo_width',
            'label' => __('Width', 'edcare'),
            'section' => 'header_logo_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'width' => '85px',
                ],
                'tablet' => [
                    'width' => '85px',
                ],
                'mobile' => [
                    'width' => '85px',
                ],
            ],
            'output' => [
                [
                    'element' => '.edcare-site-logo img',
                    'property' => 'width',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );
}
edcare_logo_settings();


function edcare_topbar_settings()
{
    // header_topbar_section section
    new \Kirki\Section(
        'edcare_topbar_settings',
        [
            'title' => esc_html__('Header Topbar', 'edcare'),
            'description' => esc_html__('Header Topbar Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 103,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_topbar_phone_number',
            'label'    => esc_html__( 'Header Topbar Phone Number', 'edcare' ),
            'description' => esc_html__('This is Header Topbar Phone Number Text', 'edcare'),
            'section'  => 'edcare_topbar_settings',
            'default'  => esc_html__( '256 214 203 215', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'edcare_header_topbar_phone_number_url',
            'label'    => esc_html__( 'Header Topbar Phone Number URL', 'edcare' ),
            'description' => esc_html__('This is Header Topbar Phone Number URL', 'edcare'),
            'section'  => 'edcare_topbar_settings',
            'default'  => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_topbar_address',
            'label'    => esc_html__( 'Header Topbar Address', 'edcare' ),
            'description' => esc_html__('This is Header Topbar Address', 'edcare'),
            'section'  => 'edcare_topbar_settings',
            'default'  => esc_html__( '258 Helano Street, New York', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_topbar_time',
            'label'    => esc_html__( 'Header Topbar Available Days', 'edcare' ),
            'description' => esc_html__('This is Header Topbar Available Days', 'edcare'),
            'section'  => 'edcare_topbar_settings',
            'default'  => esc_html__( 'Mon - Sat: 8:00 - 15:00', 'edcare' ),
            'priority' => 10,
        ]
    );

}
edcare_topbar_settings();


function edcare_header_social_settings()
{
    // header_topbar_section section
    new \Kirki\Section(
        'edcare_header_social_settings',
        [
            'title' => esc_html__('Header Social', 'edcare'),
            'description' => esc_html__('Header Social Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 103,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_social_label_text',
            'label'    => esc_html__( 'Header Social Label Text', 'edcare' ),
            'description' => esc_html__('This is Header Social Label Text', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( 'Follow Us', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_fb_url',
            'label'    => esc_html__( 'Facebook URL', 'edcare' ),
            'description' => esc_html__('Facebook URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_twitter_url',
            'label'    => esc_html__( 'Twitter URL', 'edcare' ),
            'description' => esc_html__('Twitter URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_linkedin_url',
            'label'    => esc_html__( 'Linkedin URL', 'edcare' ),
            'description' => esc_html__('Linkedin URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_instagram_url',
            'label'    => esc_html__( 'Instagram URL', 'edcare' ),
            'description' => esc_html__('Instagram URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_pinterest_url',
            'label'    => esc_html__( 'Pinterest URL', 'edcare' ),
            'description' => esc_html__('Pinterest URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_youtube_url',
            'label'    => esc_html__( 'Youtube URL', 'edcare' ),
            'description' => esc_html__('Youtube URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_skype_url',
            'label'    => esc_html__( 'Skype URL', 'edcare' ),
            'description' => esc_html__('Skype URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_behance_url',
            'label'    => esc_html__( 'Behance URL', 'edcare' ),
            'description' => esc_html__('Behance URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_header_dribble_url',
            'label'    => esc_html__( 'Dribble URL', 'edcare' ),
            'description' => esc_html__('Dribble URL', 'edcare'),
            'section'  => 'edcare_header_social_settings',
            'default'  => esc_html__( '#', 'edcare' ),
            'priority' => 10,
        ]
    );
}
edcare_header_social_settings();


function edcare_offcanvas_settings()
{

    new \Kirki\Section(
        'edcare_offcanvas_section',
        [
            'title' => esc_html__('Offcanvas Settings', 'edcare'),
            'description' => esc_html__('Offcanvas Controls.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 104,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'edcare_offcanvas_logo',
            'label' => esc_html__('Offcanvas Logo', 'edcare'),
            'section' => 'edcare_offcanvas_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Dimension(
        [
            'settings' => 'edcare_offcanvas_logo_width',
            'label' => __('Width', 'edcare'),
            'section' => 'edcare_offcanvas_section',
            'responsive' => true,
            'default' => [
                'desktop' => '158px',
                'tablet' => '158px',
                'mobile' => '158px',
            ],
            'output' => [
                [
                    'element' => '.edcare-offcanvas-logo img',
                    'property' => 'width',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_offcanvas_content_switch',
            'label' => esc_html__('Offcanvas Content Switch', 'edcare'),
            'description' => esc_html__('Offcanvas Content On/Off', 'edcare'),
            'section' => 'edcare_offcanvas_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_offcanvas_address_label',
            'label'    => esc_html__( 'Offcanvas Address Label', 'edcare' ),
            'description' => esc_html__('This is Offcanvas Address Label Text', 'edcare'),
            'section'  => 'edcare_offcanvas_section',
            'default'  => esc_html__( 'Address:', 'edcare' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_offcanvas_address_text',
            'label'    => esc_html__( 'Offcanvas Address Text', 'edcare' ),
            'description' => esc_html__('This is Offcanvas Address Text', 'edcare'),
            'section'  => 'edcare_offcanvas_section',
            'default'  => esc_html__( 'Amsterdam, 109-74', 'edcare' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_offcanvas_phone_number_label',
            'label'    => esc_html__( 'Offcanvas Phone Number Label', 'edcare' ),
            'description' => esc_html__('This is Offcanvas Phone Number Label Text', 'edcare'),
            'section'  => 'edcare_offcanvas_section',
            'default'  => esc_html__( 'Phone:', 'edcare' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_offcanvas_phone_number',
            'label'    => esc_html__( 'Offcanvas Phone Number', 'edcare' ),
            'description' => esc_html__('This is Offcanvas Phone Number', 'edcare'),
            'section'  => 'edcare_offcanvas_section',
            'default'  => esc_html__( '+01 569 896 654', 'edcare' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'edcare_offcanvas_phone_number_url',
            'label'    => esc_html__( 'Offcanvas Phone Number URL', 'edcare' ),
            'description' => esc_html__('This is Offcanvas Phone Number URL', 'edcare'),
            'section'  => 'edcare_offcanvas_section',
            'default'  => '#',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_offcanvas_email_number_label',
            'label'    => esc_html__( 'Offcanvas Email Number Label', 'edcare' ),
            'description' => esc_html__('This is Offcanvas Email Number Label Text', 'edcare'),
            'section'  => 'edcare_offcanvas_section',
            'default'  => esc_html__( 'Email', 'edcare' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_offcanvas_email_number',
            'label'    => esc_html__( 'Offcanvas Email Number', 'edcare' ),
            'description' => esc_html__('This is Offcanvas Email Number', 'edcare'),
            'section'  => 'edcare_offcanvas_section',
            'default'  => esc_html__( 'info@example.com', 'edcare' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'edcare_offcanvas_email_number_url',
            'label'    => esc_html__( 'Offcanvas Email Number URL', 'edcare' ),
            'description' => esc_html__('This is Offcanvas Email Number URL', 'edcare'),
            'section'  => 'edcare_offcanvas_section',
            'default'  => '#',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}

edcare_offcanvas_settings();


function edcare_back_to_top_section()
{

    new \Kirki\Section(
        'back_to_top_section',
        [
            'title' => esc_html__('Back To Top Settings', 'edcare'),
            'description' => esc_html__('Back To Top Controls.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 105,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_backtotop_switch',
            'label' => esc_html__('Back To Top Switch', 'edcare'),
            'description' => esc_html__('Back To Top On/Off', 'edcare'),
            'section' => 'back_to_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'back_to_top_bg',
            'label' => __('Back To Top BG Color', 'edcare'),
            'description' => esc_html__('You can change Back To Top bg color from here.', 'edcare'),
            'section' => 'back_to_top_section',
            'default' => '#07A698',
            'output' => [
                [
                    'element' => '.scroll-to-top',
                    'property' => 'background',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_backtotop_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'back_to_top_icon_color',
            'label' => __('Back To Top Icon Color', 'edcare'),
            'description' => esc_html__('You can change Back To Top icon color from here.', 'edcare'),
            'section' => 'back_to_top_section',
            'default' => '#ffffff',
            'output' => [
                [
                    'element' => '.scroll-to-top',
                    'property' => 'color',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_backtotop_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
edcare_back_to_top_section();


function edcare_preloader_settings()
{

    new \Kirki\Section(
        'preloader_section',
        [
            'title' => esc_html__('Preloader Settings', 'edcare'),
            'description' => esc_html__('Preloader Controls.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 106,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_preloader_switch',
            'label' => esc_html__('Preloader Switch', 'edcare'),
            'description' => esc_html__('Preloader On/Off', 'edcare'),
            'section' => 'preloader_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'edcare_preloader_logo',
            'label' => esc_html__('Preloader Logo', 'edcare'),
            'section' => 'preloader_section',
            'default' => get_template_directory_uri() . '/assets/img/favicon.png',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_preloader_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Background(
        [
            'settings' => 'edcare_preloader_loading_bg',
            'label' => __('Background', 'edcare'),
            'description' => esc_html__('Background conrols are pretty complex! (but useful if used properly)', 'edcare'),
            'section' => 'preloader_section',
            'default' => [
                'background-color' => '#fff',
                'background-image' => '',
                'background-repeat' => 'repeat',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport' => 'auto',
            'output' => [
                [
                    'element' => '#preloader',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_preloader_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}

edcare_preloader_settings();

function edcare_breadcrumb_settings()
{

    new \Kirki\Section(
        'edcare_breadcrumb_section',
        [
            'title' => esc_html__('Breadcrumb Settings', 'edcare'),
            'description' => esc_html__('Breadcrumb Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 107,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'breadcrumb_switch',
            'label' => esc_html__('Show Breadcrumb Globally', 'edcare'),
            'description' => esc_html__('Breadcrumb On/Off', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'default' => true,
            'choices' => [
                'on' => esc_html__('Show', 'edcare'),
                'off' => esc_html__('Hide', 'edcare'),
            ],

        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'breadcrumb_shape_switch',
            'label' => esc_html__('Show Breadcrumb Shape', 'edcare'),
            'description' => esc_html__('Breadcrumb Shape On/Off', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'default' => false,
            'choices' => [
                'on' => esc_html__('Show', 'edcare'),
                'off' => esc_html__('Hide', 'edcare'),
            ],

        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'breadcrumb_on_single',
            'label' => esc_html__('Show Breadcrumb On Single Page ?', 'edcare'),
            'description' => esc_html__('Breadcrumb On/Off', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'default' => false,
            'choices' => [
                'on' => esc_html__('Yes', 'edcare'),
                'off' => esc_html__('No', 'edcare'),
            ],

        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'breadcrumb_on_single_courses',
            'label' => esc_html__('Show Breadcrumb On Single Course ?', 'edcare'),
            'description' => esc_html__('Breadcrumb Courses Single On/Off', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'default' => false,
            'choices' => [
                'on' => esc_html__('Yes', 'edcare'),
                'off' => esc_html__('No', 'edcare'),
            ],

        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_breadcrumb_elementor_switch',
            'label' => esc_html__('Breadcrumb Custom/Elementor Switch', 'edcare'),
            'description' => esc_html__('Breadcrumb Custom/Elementor On/Off', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'breadcrumb_layout_custom',
            'label' => esc_html__('Chose Breadcrumb Style', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'priority' => 10,
            'choices' => [
                'breadcrumb_1' => get_template_directory_uri() . '/inc/img/breadcrumb/page-header-bg.png',
            ],
            'default' => 'breadcrumb_1',
            'active_callback' => [
                [
                    'setting' => 'edcare_breadcrumb_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $breadcrumb_buildertype = array(
        'post_type' => 'tp-breadcrumb',
        'posts_per_page' => -1,
    );
    $breadcrumb_buildertype_loop = get_posts($breadcrumb_buildertype);

    $breadcrumb_post_obj_arr = array();
    foreach ($breadcrumb_buildertype_loop as $post) {
        $breadcrumb_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_query();

    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_breadcrumb_templates_edcare',
            'label' => esc_html__('Elementor Breadcrumb Template', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => $breadcrumb_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'edcare_breadcrumb_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );


    new \Kirki\Field\Radio_Buttonset(
        [
            'settings' => 'breadcrumb_typography_responsive_control',
            'label' => esc_html__('Typography Control', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'default' => 'desktop',
            'priority' => 10,
            'choices' => [
                'desktop' => esc_html__('Desktop', 'edcare'),
                'tablet' => esc_html__('Tablet', 'edcare'),
                'mobile' => esc_html__('Mobile', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_desktop',
            'label' => esc_html__('Typography Control', 'edcare'),
            'description' => esc_html__('Set typography for desktop', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#162726',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'desktop'
                ]
            ],
            'output' => [
                [
                    'element' => '.page-header-content .rr_edcare_breadcrumb__title',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_tablet',
            'label' => esc_html__('Typography Control', 'edcare'),
            'description' => esc_html__('Set typography for tablet', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#162726',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'tablet'
                ]
            ],
            'output' => [
                [
                    'element' => '.page-header-content .rr_edcare_breadcrumb__title',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_mobile',
            'label' => esc_html__('Typography Control', 'edcare'),
            'description' => esc_html__('Set typography for mobile', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#162726',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'mobile'
                ]
            ],
            'output' => [
                [
                    'element' => '.page-header-content .rr_edcare_breadcrumb__title',
                ],
            ],
        ]
    );


    new \Kirki\Field\Background(
        [
            'settings' => 'breadcrumb_background_setting',
            'label' => esc_html__('Breadcrumb Background', 'edcare'),
            'description' => esc_html__('Background conrols for breadcrumb', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'default' => [
                'background-color' => '',
                'background-image' => get_template_directory_uri() . '/assets/img/bg-img/page-header-bg.png',
                'background-repeat' => 'no-repeat',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport' => 'auto',
            'output' => [
                [
                    'element' => '.edcare-breadcrumb-padding',
                ],
            ],
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'edcare_breadcrumb_padding',
            'label' => __('Padding', 'edcare'),
            'section' => 'edcare_breadcrumb_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'padding-top' => '120px',
                    'padding-bottom' => '120px',
                ],
                'tablet' => [
                    'padding-top' => '120px',
                    'padding-bottom' => '120px',
                ],
                'mobile' => [
                    'padding-top' => '120px',
                    'padding-bottom' => '120px',
                ],
            ],
            'output' => [
                [
                    'element' => '.edcare-breadcrumb-padding',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );
}
edcare_breadcrumb_settings();

function edcare_blog_settings()
{
    // blog_section section
    new \Kirki\Section(
        'blog_section',
        [
            'title' => esc_html__('Blog Settings', 'edcare'),
            'description' => esc_html__('Blog Section Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 108,
        ]
    );


    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'edcare_blog_single_layout',
            'label' => esc_html__('Chose Single Style', 'edcare'),
            'section' => 'blog_section',
            'priority' => 10,
            'choices' => [
                'blog_single_default' => get_template_directory_uri() . '/inc/img/blog/blog-standard.jpg',
                'blog_single_classic' => get_template_directory_uri() . '/inc/img/blog/blog-classic.jpg',
            ],
            'default' => 'blog_single_default',
        ]
    );

    new \Kirki\Field\Radio_Buttonset(
        [
            'settings' => 'edcare_blog_sidebar_system',
            'label' => esc_html__('Sidebar Controls', 'edcare'),
            'section' => 'blog_section',
            'default' => 'right',
            'priority' => 10,
            'choices' => [
                'right' => esc_html__('Right', 'edcare'),
                'left' => esc_html__('Left', 'edcare'),
                'no_sidebar' => esc_html__('No Sidebar', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Background(
        [
            'settings' => 'edcare_blog_full_width_overlay_bg',
            'label' => __('Select Color/Image', 'edcare'),
            'description' => esc_html__('Background conrols are pretty complex! (but useful if used properly)', 'edcare'),
            'section' => 'blog_section',
            'default' => [
                'background-color' => 'rgba(0,0,0,.36)',
                'background-image' => get_template_directory_uri() . '/assets/img/blog/blog-stories/blog-stories-bg.png',
                'background-repeat' => 'repeat',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport' => 'auto',
            'output' => [
                [
                    'element' => '.blog-details-overlay::after',
                ],
            ],
        ]
    );


    new \Kirki\Field\Dimensions(
        [
            'settings' => 'edcare_blog_full_width_padding',
            'label' => esc_html__('Vertical Padding', 'edcare'),
            'description' => esc_html__('Change Vertical Padding here', 'edcare'),
            'section' => 'blog_section',
            'responsive' => true,
            'default' =>
                [
                    'desktop' => [
                        'padding-top' => '170px',
                        'padding-bottom' => '170px',
                    ],
                    'tablet' => [
                        'padding-top' => '70px',
                        'padding-bottom' => '70px',
                    ],
                    'mobile' => [
                        'padding-top' => '40px',
                        'padding-bottom' => '40px',
                    ],
                ],
            'output' => [
                [
                    'element' => '.edcare-blog-single-height',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_classic'
                ]
            ]
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'edcare_blog_classic_padding',
            'label' => esc_html__('Vertical Padding', 'edcare'),
            'description' => esc_html__('Change Vertical Padding here', 'edcare'),
            'section' => 'blog_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'padding-top' => '170px',
                    'padding-bottom' => '70px',
                ],
                'tablet' => [
                    'padding-top' => '100px',
                    'padding-bottom' => '70px',
                ],
                'mobile' => [
                    'padding-top' => '70px',
                    'padding-bottom' => '40px',
                ],
            ],
            'output' => [
                [
                    'element' => '.blog-details-without-sidebar',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_classic'
                ]
            ]
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'edcare_blog_default_padding',
            'label' => esc_html__('Vertical Padding', 'edcare'),
            'description' => esc_html__('Change Vertical Padding here', 'edcare'),
            'section' => 'blog_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'padding-top' => '100px',
                    'padding-bottom' => '100px',
                ],
                'tablet' => [
                    'padding-top' => '70px',
                    'padding-bottom' => '70px',
                ],
                'mobile' => [
                    'padding-top' => '40px',
                    'padding-bottom' => '40px',
                ],
            ],
            'output' => [
                [
                    'element' => '.edcare-blog-single-padding',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_default'
                ]
            ]
        ]
    );


    new \Kirki\Field\Dimension(
        [
            'settings' => 'edcare_blog_full_width_height_set',
            'label' => esc_html__('Set Height', 'edcare'),
            'description' => esc_html__('Adjust height of hero section.', 'edcare'),
            'section' => 'blog_section',
            'responsive' => true,
            'default' => [
                'desktop' => '800px',
                'tablet' => '600px',
                'mobile' => '450px',
            ],
            'choices' => [
                'accept_unitless' => true,
            ],
            'output' => [
                [
                    'element' => '.edcare-blog-single-height',
                    'property' => 'height',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_full_width'
                ]
            ]
        ]
    );


    // blog_section BTN
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_blog_cat',
            'label' => esc_html__('Blog Category Meta On/Off', 'edcare'),
            'section' => 'blog_section',
            'default' => false,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_blog_author',
            'label' => esc_html__('Blog Author Meta On/Off', 'edcare'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_blog_date',
            'label' => esc_html__('Blog Date Meta On/Off', 'edcare'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_blog_comments',
            'label' => esc_html__('Blog Comments Meta On/Off', 'edcare'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_blog_tags',
            'label' => esc_html__('Blog Tags Meta On/Off', 'edcare'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_post_box_social_switch',
            'label' => esc_html__('Post Box Social On/Off', 'edcare'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_blog_btn_switch',
            'label' => esc_html__('Blog BTN On/Off', 'edcare'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_blog_single_social',
            'label' => esc_html__('Single Blog Social Share', 'edcare'),
            'section' => 'blog_section',
            'default' => false,
            'priority' => 10,
        ]
    );

    // blog_section Blog BTN text
    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_blog_btn',
            'label' => esc_html__('Blog Button Text', 'edcare'),
            'section' => 'blog_section',
            'default' => "Read More",
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_blog_btn_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_blog_single_related',
            'label' => esc_html__('Enable Related Post?', 'edcare'),
            'description' => esc_html__('Related Post For Single On/Off', 'edcare'),
            'section' => 'blog_section',
            'default' => false,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_blog_related_title',
            'label' => esc_html__('Blog Related Title', 'edcare'),
            'section' => 'blog_section',
            'default' => "Related Posts",
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_blog_single_related',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
edcare_blog_settings();
function error_404_section()
{
    // 404_section section
    new \Kirki\Section(
        'error_404_section',
        [
            'title' => esc_html__('404 Page', 'edcare'),
            'description' => esc_html__('404 Page Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 109,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'edcare_error_thumb',
            'label' => esc_html__('Error Image', 'edcare'),
            'description' => esc_html__('rror Image Here', 'edcare'),
            'section' => 'error_404_section',
            'default' => get_template_directory_uri() . '/assets/img/images/error-img.png',
        ]
    );

    // 404_section
    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_error_title',
            'label' => esc_html__('Not Found Title', 'edcare'),
            'section' => 'error_404_section',
            'default' => "404 - Page Not Found",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Textarea(
        [
            'settings' => 'edcare_error_desc',
            'label' => esc_html__('Not Found description', 'edcare'),
            'section' => 'error_404_section',
            'default' => "The page you are looking for does not exist",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_error_link_text',
            'label' => esc_html__('Error Link Text', 'edcare'),
            'section' => 'error_404_section',
            'default' => "Back To Home",
            'priority' => 10,
        ]
    );
}
error_404_section();

function edcare_lms_settings()
{
    new \Kirki\Section(
        'edcare_lms_settings',
        [
            'title' => esc_html__('EdCare LMS', 'edcare'),
            'description' => esc_html__('EdCare LMS Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 110,
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_single_layout',
            'label' => esc_html__('Single Layout', 'edcare'),
            'description' => esc_html__('Choose signle layout', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => 'course_single_standard',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                'course_single_standard' => esc_html__('Standard', 'edcare'),
                'course_single_classic' => esc_html__('Classic', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Background(
        [
            'settings' => 'edcare_lms_single_breadcrumb',
            'label' => esc_html__('Signle Breadcrumb Background', 'edcare'),
            'description' => esc_html__('Background conrols for breadcrumb', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => [
                'background-color' => '',
                'background-image' => get_template_directory_uri() . '/assets/img/breadcrumb/breadcrumb-bg-2.jpg',
                'background-repeat' => 'no-repeat',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport' => 'auto',
            'output' => [
                [
                    'element' => '.edcare-lms-single-breadcrumb',
                ],
            ],
        ]
    );


    new \Kirki\Field\Background(
        [
            'settings' => 'edcare_lms_single_course_bg',
            'label' => esc_html__('Signle Course Background', 'edcare'),
            'description' => esc_html__('Background conrols for lms single page', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => [
                'background-color' => '',
                'background-image' => get_template_directory_uri() . '/assets/img/breadcrumb/breadcrumb-bg-3.jpg',
                'background-repeat' => 'no-repeat',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport' => 'auto',
            'output' => [
                [
                    'element' => '.tp-breadcrumb__bg.details3',
                ],
            ],
        ]
    );


    // textarea
    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_lms_related_course_title',
            'label' => esc_html__('Related Course Title', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => esc_html__('Related Courses', 'edcare'),
            'priority' => 10,
        ]
    );
    // textarea
    new \Kirki\Field\Textarea(
        [
            'settings' => 'edcare_lms_related_course_desc',
            'label' => esc_html__('Related Course Description', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => esc_html__('10,000+ unique online course list designs', 'edcare'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'edcare_lms_course_found_desc',
            'label' => esc_html__('Course Found Title', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => esc_html__('We found [course_number] courses available for you', 'edcare'),
            'priority' => 10,
        ]
    );

    // mumber
    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_lms_course_title_word_count',
            'label' => esc_html__('Course Title Word Count', 'edcare'),
            'description' => esc_html__('Course Title Word Count, for archive page', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => 3,
            'priority' => 10,
        ]
    );


    //switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_lms_view_style_switch',
            'label' => esc_html__('Show View Switcher?', 'edcare'),
            'description' => esc_html__('View Toggle Switch On/Off', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Yes', 'edcare'),
                'off' => esc_html__('No', 'edcare'),
            ],

        ]
    );

    // select column for default layout
    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_view_style',
            'label' => esc_html__('Default View', 'edcare'),
            'description' => esc_html__('Choose view style', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => 'grid',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                'grid' => esc_html__('Grid', 'edcare'),
                'list' => esc_html__('List', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_lms_view_style_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_grid_view_style',
            'label' => esc_html__('Default Grid View', 'edcare'),
            'description' => esc_html__('Choose Grid view style', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => 'grid_default',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                'grid_default' => esc_html__('Default', 'edcare'),
                'grid_gym' => esc_html__('Gym', 'edcare'),
                'grid_school' => esc_html__('School', 'edcare'),
                'grid_list' => esc_html__('Grid List', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_lms_view_style_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    // select column for default layout
    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_archive_style',
            'label' => esc_html__('Select View Style', 'edcare'),
            'description' => esc_html__('Choose Card style here', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => 'archive_grid',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                'archive_grid' => esc_html__('Grid', 'edcare'),
                'archive_list' => esc_html__('List', 'edcare'),
                'archive_gym' => esc_html__('Gym', 'edcare'),
                'archive_school' => esc_html__('School', 'edcare'),
                'archive_list_grid' => esc_html__('List Grid', 'edcare'),

            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_lms_view_style_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );


    // select column for default layout
    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_filter_style',
            'label' => esc_html__('Select Filter Style', 'edcare'),
            'description' => esc_html__('Choose filter style here', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => 'sidebar',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                'sidebar' => esc_html__('Sidebar', 'edcare'),
                'style_1' => esc_html__('Style 1', 'edcare'),
                'style_2' => esc_html__('Style 2', 'edcare'),
                'style_3' => esc_html__('Style 3', 'edcare'),
            ],
        ]
    );

    //switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_lms_col_switch',
            'label' => esc_html__('Enable Custom Column?', 'edcare'),
            'description' => esc_html__('This will disable column system from Tutor LMS', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Yes', 'edcare'),
                'off' => esc_html__('No', 'edcare'),
            ],

        ]
    );

    // select column for default layout
    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_column_xl',
            'label' => esc_html__('Select Column XL', 'edcare'),
            'description' => esc_html__('Column for Extra Large Device, only for grid style', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => '3',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                '1' => esc_html__('1 Column', 'edcare'),
                '2' => esc_html__('2 Column', 'edcare'),
                '3' => esc_html__('3 Column', 'edcare'),
                '4' => esc_html__('4 Column', 'edcare'),
                '5' => esc_html__('5 Column', 'edcare'),
                '6' => esc_html__('6 Column', 'edcare'),
                '7' => esc_html__('7 Column', 'edcare'),
                '8' => esc_html__('8 Column', 'edcare'),
                '9' => esc_html__('9 Column', 'edcare'),
                '10' => esc_html__('10 Column', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_lms_col_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    // select column for default layout lg
    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_column_lg',
            'label' => esc_html__('Select Column LG', 'edcare'),
            'description' => esc_html__('Column for Large Device, only for grid style', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => '3',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                '1' => esc_html__('1 Column', 'edcare'),
                '2' => esc_html__('2 Column', 'edcare'),
                '3' => esc_html__('3 Column', 'edcare'),
                '4' => esc_html__('4 Column', 'edcare'),
                '5' => esc_html__('5 Column', 'edcare'),
                '6' => esc_html__('6 Column', 'edcare'),
                '7' => esc_html__('7 Column', 'edcare'),
                '8' => esc_html__('8 Column', 'edcare'),
                '9' => esc_html__('9 Column', 'edcare'),
                '10' => esc_html__('10 Column', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_lms_col_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_column_md',
            'label' => esc_html__('Select Column MD', 'edcare'),
            'description' => esc_html__('Column for Medium Device, only for grid style', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => '2',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                '1' => esc_html__('1 Column', 'edcare'),
                '2' => esc_html__('2 Column', 'edcare'),
                '3' => esc_html__('3 Column', 'edcare'),
                '4' => esc_html__('4 Column', 'edcare'),
                '5' => esc_html__('5 Column', 'edcare'),
                '6' => esc_html__('6 Column', 'edcare'),
                '7' => esc_html__('7 Column', 'edcare'),
                '8' => esc_html__('8 Column', 'edcare'),
                '9' => esc_html__('9 Column', 'edcare'),
                '10' => esc_html__('10 Column', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_lms_col_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_column_sm',
            'label' => esc_html__('Select Column SM', 'edcare'),
            'description' => esc_html__('Column for Small Device, only for grid style', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => '1',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                '1' => esc_html__('1 Column', 'edcare'),
                '2' => esc_html__('2 Column', 'edcare'),
                '3' => esc_html__('3 Column', 'edcare'),
                '4' => esc_html__('4 Column', 'edcare'),
                '5' => esc_html__('5 Column', 'edcare'),
                '6' => esc_html__('6 Column', 'edcare'),
                '7' => esc_html__('7 Column', 'edcare'),
                '8' => esc_html__('8 Column', 'edcare'),
                '9' => esc_html__('9 Column', 'edcare'),
                '10' => esc_html__('10 Column', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_lms_col_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_lms_column_xs',
            'label' => esc_html__('Select Column XS', 'edcare'),
            'description' => esc_html__('Column for Extra Small Device, only for grid style', 'edcare'),
            'section' => 'edcare_lms_settings',
            'default' => '1',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                '1' => esc_html__('1 Column', 'edcare'),
                '2' => esc_html__('2 Column', 'edcare'),
                '3' => esc_html__('3 Column', 'edcare'),
                '4' => esc_html__('4 Column', 'edcare'),
                '5' => esc_html__('5 Column', 'edcare'),
                '6' => esc_html__('6 Column', 'edcare'),
                '7' => esc_html__('7 Column', 'edcare'),
                '8' => esc_html__('8 Column', 'edcare'),
                '9' => esc_html__('9 Column', 'edcare'),
                '10' => esc_html__('10 Column', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'edcare_lms_col_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
edcare_lms_settings();

function edcare_woocommerce_settings()
{
    new \Kirki\Section(
        'edcare_woocommerce_settings',
        [
            'title' => esc_html__('EdCare Woocommerce', 'edcare'),
            'description' => esc_html__('EdCare Woocommerce Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 111,
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'edcare_shop_single_details_style',
            'label' => esc_html__('Chose Single Layout', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'priority' => 10,
            'choices' => [
                'style_default' => get_template_directory_uri() . '/inc/img/shop/single-default.jpg',
            ],
            'default' => 'style_default',

        ]
    );


    // Category Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_product_single_categories_switch',
            'label' => esc_html__('Show/Hide Product Category ', 'edcare'),
            'description' => esc_html__('Show/Hide Product Category on single page', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Show', 'edcare'),
                'off' => esc_html__('Hide', 'edcare'),
            ],
        ]
    );

    // SKU Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_product_single_sku_switch',
            'label' => esc_html__('Show/Hide Product SKU ', 'edcare'),
            'description' => esc_html__('Show/Hide Product SKU on single page', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Show', 'edcare'),
                'off' => esc_html__('Hide', 'edcare'),
            ],
        ]
    );

    // Tags Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_product_single_tags_switch',
            'label' => esc_html__('Show/Hide Product Tag ', 'edcare'),
            'description' => esc_html__('Show/Hide Product Tag on single page', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Show', 'edcare'),
                'off' => esc_html__('Hide', 'edcare'),
            ],
        ]
    );

    // Wishlist Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_product_single_wishlist_switch',
            'label' => esc_html__('Show/Hide Wishlist', 'edcare'),
            'description' => esc_html__('Show/Hide wishlist on single page', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Show', 'edcare'),
                'off' => esc_html__('Hide', 'edcare'),
            ],
        ]
    );

    // Compare Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_product_single_compare_switch',
            'label' => esc_html__('Product Compare Switch', 'edcare'),
            'description' => esc_html__('Product Compare On/Off', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],

        ]
    );

    // Social Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_product_single_social_switch',
            'label' => esc_html__('Product Social Switch', 'edcare'),
            'description' => esc_html__('Product Social On/Off', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    // Repeater
    new \Kirki\Field\Repeater(
        [
            'settings' => 'edcare_product_single_fea_meta',
            'label' => esc_html__('product Single Repeater Control', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'priority' => 10,
            'default' => [
                [
                    'tp_product_message' => esc_html__('30 days easy returns', 'edcare'),
                ],
            ],
            'fields' => [
                'tp_product_message' => [
                    'type' => 'text',
                    'label' => esc_html__('Product Message', 'edcare'),
                    'default' => '30 days easy returns',
                ],
            ],
        ]
    );

    // Payment Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_product_single_payment_switch',
            'label' => esc_html__('Payment Info Switch', 'edcare'),
            'description' => esc_html__('Payment Info On/Off', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],

        ]
    );

    // product single payment text
    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_product_single_payment_text',
            'label' => esc_html__('Payment Text', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => esc_html__('Guaranteed safe & secure checkout', 'edcare'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edcare_product_single_payment_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    // product single payment
    new \Kirki\Field\Image(
        [
            'settings' => 'edcare_product_single_payment_img',
            'label' => esc_html__('Payment Image', 'edcare'),
            'description' => esc_html__('Payment Image add/remove', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'active_callback' => [
                [
                    'setting' => 'edcare_product_single_payment_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    // cart empty
    new \Kirki\Field\Image(
        [
            'settings' => 'edcare_shop_cartmini_empty_img',
            'label' => esc_html__('Cartmini Empty Thumbnail', 'edcare'),
            'description' => esc_html__('Upload cartmini empty thumbnail here', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => get_template_directory_uri() . '/assets/img/product/empty-cart.png',
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'edcare_shop_cartmini_empty_text',
            'label' => esc_html__('Cartmini Empty Text', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'Your Cart is empty',
            'description' => esc_attr__('Cart empty message', 'edcare'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'edcare_shop_cartmini_empty_button_text',
            'label' => esc_html__('Cartmini Empty Button Text', 'edcare'),
            'section' => 'edcare_woocommerce_settings',
            'default' => 'Go To Shop',
            'description' => esc_attr__('Cart empty message', 'edcare'),
            'priority' => 10,
        ]
    );
}

edcare_woocommerce_settings();

function free_shipping_settings()
{
    new \Kirki\Section(
        'free_shipping_settings',
        [
            'title' => esc_html__('Free Shipping Settings', 'edcare'),
            'description' => esc_html__('Free Shipping Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 112,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'enable_free_shipping_bar',
            'label' => esc_html__('Shipping Bar Switch', 'edcare'),
            'description' => esc_html__('Shipping Bar On/Off', 'edcare'),
            'section' => 'free_shipping_settings',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'shipping_progress_bar_location_mini_cart',
            'label' => esc_html__('Cartmini Switch', 'edcare'),
            'description' => esc_html__('Enable For Cartmini', 'edcare'),
            'section' => 'free_shipping_settings',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'shipping_progress_bar_location_card_page',
            'label' => esc_html__('Cart Page Switch', 'edcare'),
            'description' => esc_html__('Enable For Cart Page', 'edcare'),
            'section' => 'free_shipping_settings',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'shipping_progress_bar_location_checkout',
            'label' => esc_html__('Checkout Page Switch', 'edcare'),
            'description' => esc_html__('Enable For Checkout Page', 'edcare'),
            'section' => 'free_shipping_settings',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'shipping_progress_bar_message_initial',
            'label' => esc_html__('Initial Message', 'edcare'),
            'section' => 'free_shipping_settings',
            'default' => 'Add [remainder] to cart and get free shipping!',
            'description' => esc_attr__('Message to show before reaching the goal. Use shortcode [remainder] to display the amount left to reach the minimum.', 'edcare'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
    new \Kirki\Field\Textarea(
        [
            'settings' => 'shipping_progress_bar_message_success',
            'label' => esc_html__('Success message', 'edcare'),
            'section' => 'free_shipping_settings',
            'default' => 'Your order qualifies for free shipping!',
            'description' => esc_attr__('Message to show after reaching 100%.', 'edcare'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
free_shipping_settings();

function edcare_event_settings()
{
    // event_section section
    new \Kirki\Section(
        'edcare_event_section',
        [
            'title' => esc_html__('Event Settings', 'edcare'),
            'description' => esc_html__('Blog Section Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 113,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_event_title_count',
            'label' => esc_html__('Title Count', 'edcare'),
            'section' => 'edcare_event_section',
            'default' => '3',
            'description' => esc_attr__('Title Count Number', 'edcare'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_event_description_switch',
            'label' => esc_html__('Event Description Switch', 'edcare'),
            'description' => esc_html__('Event Description On/Off', 'edcare'),
            'section' => 'edcare_event_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_event_calendar_switcher',
            'label' => esc_html__('Event Calendar Switch', 'edcare'),
            'description' => esc_html__('Event Calendar On/Off', 'edcare'),
            'section' => 'edcare_event_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );
}
edcare_event_settings();

function full_site_typography()
{
    new \Kirki\Section(
        'full_site_typography',
        [
            'title' => esc_html__('Typography', 'edcare'),
            'description' => esc_html__('Typography Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 114,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h1',
            'label' => esc_html__('H1 Typography Control', 'edcare'),
            'description' => esc_html__('The full set of options.', 'edcare'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h1',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h2',
            'label' => esc_html__('H2 Typography Control', 'edcare'),
            'description' => esc_html__('The full set of options.', 'edcare'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h2',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h3',
            'label' => esc_html__('H3 Typography Control', 'edcare'),
            'description' => esc_html__('The full set of options.', 'edcare'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h3',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h4',
            'label' => esc_html__('H4 Typography Control', 'edcare'),
            'description' => esc_html__('The full set of options.', 'edcare'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h4',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h5',
            'label' => esc_html__('H5 Typography Control', 'edcare'),
            'description' => esc_html__('The full set of options.', 'edcare'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h5',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h6',
            'label' => esc_html__('H6 Typography Control', 'edcare'),
            'description' => esc_html__('The full set of options.', 'edcare'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h6',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_body',
            'label' => esc_html__('Body Typography Control', 'edcare'),
            'description' => esc_html__('The full set of options.', 'edcare'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'body',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_p',
            'label' => esc_html__('Paragraph Typography Control', 'edcare'),
            'description' => esc_html__('The full set of options.', 'edcare'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'p',
                ],
            ],
        ]
    );
}
full_site_typography();
function edcare_footer_settings()
{

    new \Kirki\Section(
        'edcare_footer_section',
        [
            'title' => esc_html__('Footer', 'edcare'),
            'description' => esc_html__('Footer Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 115,
        ]
    );
    // footer_widget_number section
    new \Kirki\Field\Select(
        [
            'settings' => 'footer_widget_number',
            'label' => esc_html__('Footer Widget Number', 'edcare'),
            'section' => 'edcare_footer_section',
            'default' => '4',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => [
                '1' => esc_html__('1', 'edcare'),
                '2' => esc_html__('2', 'edcare'),
                '3' => esc_html__('3', 'edcare'),
                '4' => esc_html__('4', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edcare_footer_elementor_switch',
            'label' => esc_html__('Footer Custom/Elementor Switch', 'edcare'),
            'description' => esc_html__('Footer Custom/Elementor On/Off', 'edcare'),
            'section' => 'edcare_footer_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'edcare'),
                'off' => esc_html__('Disable', 'edcare'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'footer_layout_custom',
            'label' => esc_html__('Footer Layout Control', 'edcare'),
            'section' => 'edcare_footer_section',
            'priority' => 10,
            'choices' => [
                'footer_1' => get_template_directory_uri() . '/inc/img/footer/footer-1.png',

            ],
            'default' => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'edcare_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $footer_buildertype = array(
        'post_type' => 'tp-footer',
        'posts_per_page' => -1,
    );
    $footer_buildertype_loop = get_posts($footer_buildertype);
    $footer_post_obj_arr = array();
    foreach ($footer_buildertype_loop as $post) {
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Select(
        [
            'settings' => 'edcare_footer_templates',
            'label' => esc_html__('Elementor Footer Template', 'edcare'),
            'section' => 'edcare_footer_section',
            'placeholder' => esc_html__('Choose an option', 'edcare'),
            'choices' => $footer_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'edcare_footer_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Pro\Field\Padding(
        [
            'settings'    => 'edcare_footer_padding',
            'label'       => esc_html__( 'Padding Control', 'edcare' ),
            'description' => 'Default Footer Padding',
            'section'     => 'edcare_footer_section',
            'default'     => [
                'top'    => 120,
                'bottom' => 80,
            ],
            'transport'   => 'postMessage',
            'tooltip'     => esc_html__( 'Default Footer Padding', 'edcare' ),
            'choices'     => [
                'unit' => 'px',
            ],
            'output'      => [
                [
                    'element' => '.footer-top-wrap',
                ],
            ],
        ]
    );

    new \Kirki\Field\Background(
        [
            'settings' => 'edcare_footer_bg',
            'label' => __('Background', 'edcare'),
            'description' => esc_html__('Background conrols are pretty complex! (but useful if used properly)', 'edcare'),
            'section' => 'edcare_footer_section',
            'default' => [
                'background-color' => '#133432',
                'background-image' => '',
                'background-repeat' => 'repeat',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport' => 'auto',
            'output' => [
                [
                    'element' => '.ed-default-footer.footer-section',
                ],
            ]
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'edcare_copyright',
            'label' => esc_html__('Footer Copyright', 'edcare'),
            'section' => 'edcare_footer_section',
            'default' => esc_html__('Copyright © 2025 EdCare. All Rights Reserved.', 'edcare'),
            'priority' => 10,
        ]
    );
}
edcare_footer_settings();

function edcare_theme_colors()
{
    new \Kirki\Section(
        'edcare_theme_color_section',
        [
            'title' => esc_html__('Theme Colors', 'edcare'),
            'description' => esc_html__('Theme Color Settings.', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 116,
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_1',
            'label' => __('Theme Color 1', 'edcare'),
            'description' => esc_html__('Choose Your Color 1', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#07A698',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_2',
            'label' => __('Theme Color 2', 'edcare'),
            'description' => esc_html__('Choose Your Color 2', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#162726',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_3',
            'label' => __('Theme Color 3', 'edcare'),
            'description' => esc_html__('Choose Your Color 3', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#F2F4F7',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_4',
            'label' => __('Theme Color 4', 'edcare'),
            'description' => esc_html__('Choose Your Color 4', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#6C706F',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_5',
            'label' => __('Theme Color 5', 'edcare'),
            'description' => esc_html__('Choose Your Color 5', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#ffffff',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_6',
            'label' => __('Theme Color 6', 'edcare'),
            'description' => esc_html__('Choose Your Color 6', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#000000',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_7',
            'label' => __('Theme Color 7', 'edcare'),
            'description' => esc_html__('Choose Your Color 7', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#0E121D',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_8',
            'label' => __('Theme Color 8', 'edcare'),
            'description' => esc_html__('Choose Your Color 8', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#191A1F',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'edcare_theme_color_9',
            'label' => __('Theme Color 9', 'edcare'),
            'description' => esc_html__('Choose Your Color 9', 'edcare'),
            'section' => 'edcare_theme_color_section',
            'default' => '#E0E5EB',
        ]
    );
}

edcare_theme_colors();

// edcare_post_type_slug_section
function edcare_post_type_slug_section()
{
    new \Kirki\Section(
        'edcare_post_type_slug_section',
        [
            'title' => esc_html__('Slug Settings', 'edcare'),
            'panel' => 'edcare_panel',
            'priority' => 117,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'edcare_portfolios_slug',
            'label' => esc_html__('Portfolios Slug', 'edcare'),
            'section' => 'edcare_post_type_slug_section',
            'default' => __('tp-portfolios', 'edcare'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'edcare_services_slug',
            'label' => esc_html__('Services Slug', 'edcare'),
            'section' => 'edcare_post_type_slug_section',
            'default' => __('tp-services', 'edcare'),
            'priority' => 10,
        ]
    );

}
edcare_post_type_slug_section();
