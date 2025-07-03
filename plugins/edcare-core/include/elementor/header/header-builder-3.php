<?php

namespace EdCareCore\Widgets;

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
use EdCareCore\Elementor\Controls\Group_Control_EdCareGradient;
use \Elementor\Repeater;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * EdCare Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class EdCare_Header_03 extends Widget_Base
{

    use EdCare_Style_Trait, EdCare_Icon_Trait, EdCare_Column_Trait, EdCare_Query_Trait;

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
        return 'edcare-header-3';
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
        return __(EDCARE_CORE_THEME_NAME . ' :: Header 3', 'edcare-core');
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
        return 'edcare-icon';
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
        return ['edcare_core'];
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
        return ['edcare_core'];
    }


    /**
     * Menu index.
     *
     * @access protected
     * @var $nav_menu_index
     */
    protected $nav_menu_index = 1;

    /**
     * Retrieve the menu index.
     *
     * Used to get index of nav menu.
     *
     * @since 1.3.0
     * @access protected
     *
     * @return string nav index.
     */
    protected function get_nav_menu_index()
    {
        return $this->nav_menu_index++;
    }

    /**
     * Retrieve the list of available menus.
     *
     * Used to get the list of available menus.
     *
     * @since 1.3.0
     * @access private
     *
     * @return array get WordPress menus list.
     */
    private function get_available_menus()
    {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
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

     protected static function get_profile_names()
     {
        return [
            '500px' => esc_html__('500px', 'edcare-core'),
            'apple' => esc_html__('Apple', 'edcare-core'),
            'behance' => esc_html__('Behance', 'edcare-core'),
            'bitbucket' => esc_html__('BitBucket', 'edcare-core'),
            'codepen' => esc_html__('CodePen', 'edcare-core'),
            'delicious' => esc_html__('Delicious', 'edcare-core'),
            'deviantart' => esc_html__('DeviantArt', 'edcare-core'),
            'digg' => esc_html__('Digg', 'edcare-core'),
            'dribbble' => esc_html__('Dribbble', 'edcare-core'),
            'email' => esc_html__('Email', 'edcare-core'),
            'facebook' => esc_html__('Facebook', 'edcare-core'),
            'flickr' => esc_html__('Flicker', 'edcare-core'),
            'foursquare' => esc_html__('FourSquare', 'edcare-core'),
            'github' => esc_html__('Github', 'edcare-core'),
            'houzz' => esc_html__('Houzz', 'edcare-core'),
            'instagram' => esc_html__('Instagram', 'edcare-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'edcare-core'),
            'linkedin' => esc_html__('LinkedIn', 'edcare-core'),
            'medium' => esc_html__('Medium', 'edcare-core'),
            'pinterest' => esc_html__('Pinterest', 'edcare-core'),
            'product-hunt' => esc_html__('Product Hunt', 'edcare-core'),
            'reddit' => esc_html__('Reddit', 'edcare-core'),
            'slideshare' => esc_html__('Slide Share', 'edcare-core'),
            'snapchat' => esc_html__('Snapchat', 'edcare-core'),
            'soundcloud' => esc_html__('SoundCloud', 'edcare-core'),
            'spotify' => esc_html__('Spotify', 'edcare-core'),
            'stack-overflow' => esc_html__('StackOverflow', 'edcare-core'),
            'tripadvisor' => esc_html__('TripAdvisor', 'edcare-core'),
            'tumblr' => esc_html__('Tumblr', 'edcare-core'),
            'twitch' => esc_html__('Twitch', 'edcare-core'),
            'twitter' => esc_html__('Twitter', 'edcare-core'),
            'vimeo' => esc_html__('Vimeo', 'edcare-core'),
            'vk' => esc_html__('VK', 'edcare-core'),
            'website' => esc_html__('Website', 'edcare-core'),
            'whatsapp' => esc_html__('WhatsApp', 'edcare-core'),
            'wordpress' => esc_html__('WordPress', 'edcare-core'),
            'xing' => esc_html__('Xing', 'edcare-core'),
            'yelp' => esc_html__('Yelp', 'edcare-core'),
            'youtube' => esc_html__('YouTube', 'edcare-core'),
            'x-twitter' => esc_html__('X', 'edcare-core'),
            'x-twitter-square' => esc_html__('X Square', 'edcare-core'),
        ];
    }

    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }

    protected function register_controls_section()
    {

        // layout Panel
        $this->start_controls_section(
            'edcare_header_top',
            [
                'label' => esc_html__('Header Info', 'edcare-core'),
            ]
        );

        $this->add_control(
            'edcare_header_sticky',
            [
                'label' => esc_html__('Enable Sticky', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'edcare-core'),
                'label_off' => esc_html__('Hide', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'header_top_switch',
            [
                'label' => esc_html__( 'Header Top On/Off', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'edcare-core'),
                'label_off' => esc_html__('Hide', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'edcare_header_right_switch',
            [
                'label' => esc_html__('Header Right On/Off', 'edcare-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'edcare-core'),
                'label_off' => esc_html__('Hide', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'edcare_cart_switch',
            [
                'label' => esc_html__( 'Header Cart Switch', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'edcare-core'),
                'label_off' => esc_html__('Hide', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'edcare_wishlist_switch',
            [
                'label' => esc_html__( 'Header Wishlist Switch', 'edcare-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'edcare-core'),
                'label_off' => esc_html__('Hide', 'edcare-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_header_top',
            [
                'label' => esc_html__( 'Header Top',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'header_top_phone_label',
            [
                'label' => esc_html__( 'Phone Label', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => '256 214 203 215',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'header_top_phone_number',
            [
                'label' => esc_html__( 'Phone Number', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => '+256214203215',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'header_top_address',
            [
                'label' => esc_html__( 'Address', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '258 Helano Street, New York', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'header_top_time',
            [
                'label' => esc_html__( 'Time', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Mon - Sat: 8:00 - 15:00', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'header_top_login_switch',
            [
                'label' => esc_html__( 'Show Header Login', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'header_top_login',
            [
                'label' => esc_html__( 'Login Label', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Login / Register', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'header_top_login_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'header_top_login_url',
            [
                'label' => esc_html__( 'Login URL', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '#', 'edcare-core' ),
                'label_block' => true,
                'condition' => [
                    'header_top_login_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__( 'Show Social', 'text-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'text-domain' ),
                'label_off' => esc_html__( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'profile_label',
            [
                'label' => esc_html__( 'Social Label', 'edcare-core' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Follow us:', 'edcare-core' ),
                'condition' => [
                    'show_profiles' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'edcare-core'),
                'placeholder' => esc_html__('Add your profile link', 'edcare-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );
        
        $this->end_controls_section();

        // _edcare_image
        $this->start_controls_section(
            '_edcare_image',
            [
                'label' => esc_html__('Site Logo', 'edcare-core'),
            ]
        );

        $this->add_control(
            'edcare_logo_black',
            [
                'label' => esc_html__('Choose Logo Black', 'edcare-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'edcare_logo_width',
            [
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label' => esc_html__('Logo Width', 'edcare-core'),
                'description' => esc_html__('This number will count by "PX" and maximum number is 1000', 'edcare-core'),
                'placeholder' => '0',
                'min' => 10,
                'max' => 1000,
                'step' => 1,
                'default' => 125,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-logo img' => 'width: {{VALUE}}px;',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_menu',
            [
                'label' => __('Menu', 'edcare-core'),
            ]
        );

        $menus = $this->get_available_menus();

        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label' => __('Menu', 'edcare-core'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    /* translators: %s Nav menu URL */
                    'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'edcare-core'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw' => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'edcare-core'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'menu_last_item',
            [
                'label' => __('Last Menu Item', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __('Default', 'edcare-core'),
                    'cta' => __('Button', 'edcare-core'),
                ],
                'default' => 'none',
                'condition' => [
                    'layout!' => 'expandible',
                ],
            ]
        );

        $this->end_controls_section();

        // Header Right
        $this->start_controls_section(
            'edcare_header_button',
            [
                'label' => esc_html__( 'Button', 'edcare-core' ),
            ]
        );

        $this->add_control(
            'edcare_theme_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'edcare-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Start Free Trail', 'edcare-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'edcare_theme_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'edcare-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'edcare_theme_btn_link',
            [
                'label' => esc_html__('Button link', 'edcare-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'edcare-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'edcare_theme_btn_link_type' => '1',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'edcare_theme_btn_page_link',
            [
                'label' => esc_html__('Select Button Link Page', 'edcare-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => edcare_get_all_types_post('page'),
                'condition' => [
                    'edcare_theme_btn_link_type' => '2',
                ]
            ]
        );

        $this->end_controls_section();

        // Offcanvas Controls
        $this->start_controls_section(
            'edcare_offcanvas_section',
            [
                'label' => esc_html__('Offcanvas', 'edcare-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'edcare_offcanvas_logo',
            [
                'label' => esc_html__('Choose Logo', 'edcare-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'edcare_offcanvas_logo_size',
                'label' => __('Image Size', 'edcare-core'),
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'edcare_offcanvas_address_label',
            [
                'label' => esc_html__( 'Address Label', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Address :', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'edcare_offcanvas_address',
            [
                'label' => esc_html__( 'Address', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Amsterdam, 109-74', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'edcare_offcanvas_phone_label',
            [
                'label' => esc_html__( 'Phone Label', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Phone :', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'edcare_offcanvas_phone',
            [
                'label' => esc_html__( 'Phone', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '+01 569 896 654', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'edcare_offcanvas_phone_link',
            [
                'label' => esc_html__( 'Phone Link', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '+01569896654', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'edcare_offcanvas_email_label',
            [
                'label' => esc_html__( 'Phone Label', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Email :', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'edcare_offcanvas_email',
            [
                'label' => esc_html__( 'Phone', 'text-domain' ),
                'description' => edcare_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'info@example.com', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->start_controls_section(
            '_style_header_top',
            [
                'label' => esc_html__( 'Header Top',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_content_header_top_left',
            [
                'label' => esc_html__( 'Left', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_control(
            'header_top_left_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'header_top_left_border_color',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-left .top-bar-list li:not(:last-of-type)' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_top_left_right_spacing',
            [
                'label' => esc_html__( 'Right Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-left .top-bar-list li:not(:last-of-type)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'header_top_left_tabs' );
        
        $this->start_controls_tab(
            'header_top_left_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'header_top_left_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-left .top-bar-list li' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'header_top_left_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'header_top_left_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-left .top-bar-list li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'header_top_left_typography',
                'selector' => '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-left .top-bar-list li',
            ]
        );

        $this->add_control(
            '_heading_content_header_top_right',
            [
                'label' => esc_html__( 'Right', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'header_top_right_border_color',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .register-box' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_top_right_right_spacing',
            [
                'label' => esc_html__( 'Right Spacing', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .register-box' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'header_top_right_tabs' );
        
        $this->start_controls_tab(
            'header_top_right_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'header_top_right_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .register-box .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .register-box a' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'header_top_right_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'header_top_right_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .register-box a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'header_top_right_typography',
                'selector' => '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .register-box .icon, .header .top-bar .top-bar-inner .top-bar-right .register-box a',
            ]
        );

        $this->add_control(
            '_heading_style_social_title',
            [
                'label' => esc_html__( 'Social Title', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'social_title_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .top-social-wrap span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'social_title_typography',
                'selector' => '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .top-social-wrap span',
            ]
        );

        $this->add_control(
            '_heading_style_social_profile',
            [
                'label' => esc_html__( 'Social Profile', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'social_profile_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .top-social-wrap .social-list li a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'social_profile_tabs' );
        
        $this->start_controls_tab(
            'social_profile_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'social_profile_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .top-social-wrap .social-list li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'social_profile_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'social_profile_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .top-bar .top-bar-inner .top-bar-right .top-social-wrap .social-list li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_header_bottom',
            [
                'label' => esc_html__( 'Header Bottom',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'header_bottom_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .header .primary-header-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_header_right',
            [
                'label' => esc_html__( 'Header Right',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_right_woocommerce_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-right .header-right-icon a' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'header_right_woocommerce_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-right .header-right-icon a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'header_right_woocommerce_border',
                'selector' => '{{WRAPPER}} .header .primary-header-inner .header-right .header-right-icon a',
            ]
        );

        $this->add_control(
            '_heading_style_woocommerce_count',
            [
                'label' => esc_html__( 'Count', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'woocommerce_count_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-right .header-right-icon .number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'woocommerce_count_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-right .header-right-icon .number' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        // main Menu style
        $this->start_controls_section(
            'edcare_main_menu_style_section',
            [
                'label' => esc_html__('Main Menu', 'edcare-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'edcare_main_menu_title_typography',
                'label' => esc_html__('Typography', 'edcare-core'),
                'selector' => '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li a',
            ]
        );

        $this->start_controls_tabs(
            'main_style_tabs'
        );

        $this->start_controls_tab(
            'main_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'edcare-core'),
            ]
        );

        $this->add_control(
            'edcare_main_menu_title_color',
            [
                'label' => esc_html__('Menu Color', 'edcare-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'main_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'edcare-core'),
            ]
        );

        $this->add_control(
            'edcare_main_menu_title_hvr_color',
            [
                'label' => esc_html__('Menu Hover Color', 'edcare-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            '_heading_style_main_menu_submenu',
            [
                'label' => esc_html__( 'Submenu', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'main_menu_submenu_tabs' );
        
        $this->start_controls_tab(
            'main_menu_submenu_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'main_menu_submenu_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'main_menu_submenu_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li ul' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'main_menu_submenu_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'main_menu_submenu_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li li:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'main_menu_submenu_background_hover',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li li:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'main_menu_submenu_typography',
                'selector' => '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li li a',
            ]
        );

        $this->add_control(
            'main_menu_submenu_border_color',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu li li:not(:last-of-type)' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'main_menu_arrow_color',
            [
                'label' => esc_html__( 'Arrow Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-menu-wrap .sub-menu .menu-item-has-children:after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_style_header_button',
            [
                'label' => esc_html__( 'Button', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs( 'tabs_style_header_button' );
        
        $this->start_controls_tab(
            'header_button_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'header_button_color',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-btn'    => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'header_button_background',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'header_button_border',
                'selector' => '{{WRAPPER}} .edcare-el-btn',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'header_button_box_shadow',
                'selector' => '{{WRAPPER}} .edcare-el-btn',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'header_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'header_button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'header_button_background_hover',
            [
                'label'     => esc_html__( 'Background', 'text-domain' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-btn:after, .edcare-el-btn:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label'    => esc_html__( 'Border', 'text-domain' ),
                'name'     => 'header_button_border_hover',
                'selector' => '{{WRAPPER}} .edcare-el-btn:hover',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'header_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .edcare-el-btn:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_control(
            'header_button_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'text-domain' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .edcare-el-btn' => 'border-radius: {{SIZE}}px;',
                    '{{WRAPPER}} .edcare-el-btn:before' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'text-domain' ),
                'name'     => 'header_button_typography',
                'selector' => '{{WRAPPER}} .edcare-el-btn',
            ]
        );
        
        $this->add_control(
            'header_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'header_button_margin',
            [
                'label'      => esc_html__( 'Margin', 'text-domain' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .edcare-el-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            '_style_offcanvas',
            [
                'label' => esc_html__( 'Offcanvas',  'text-domain'  ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_style_offcanvas_bar',
            [
                'label' => esc_html__( 'Bar', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'offcanvas_bar_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-right .header-right-item .mobile-side-menu-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'offcanvas_bar_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header .primary-header-inner .header-right .header-right-item .mobile-side-menu-toggle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_offcanvas_menu',
            [
                'label' => esc_html__( 'Menu', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'offcanvas_menu_text_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .mean-bar .mean-nav.mean-nav > ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'offcanvas_menu_border_bottom_color',
            [
                'label' => esc_html__( 'Border Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .mean-bar .mean-nav.mean-nav > ul li:not(:last-of-type)' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'offcanvas_menu_tabs' );
        
        $this->start_controls_tab(
            'offcanvas_menu_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'offcanvas_menu_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .mean-bar .mean-nav.mean-nav > ul li a.mean-expand.mean-clicked' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'offcanvas_menu_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .mean-bar .mean-nav.mean-nav > ul li a.mean-expand.mean-clicked' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'offcanvas_menu_expand_tab',
            [
                'label' => esc_html__( 'Expand', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'offcanvas_menu_expand_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .mean-bar .mean-nav.mean-nav > ul li a.mean-expand' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'offcanvas_menu_expand_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .mean-bar .mean-nav.mean-nav > ul li a.mean-expand' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_style_offcanvas_close_button',
            [
                'label' => esc_html__( 'Close Button', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'offcanvas_close_button_tabs' );
        
        $this->start_controls_tab(
            'offcanvas_close_button_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'offcanvas_close_button_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .side-menu-head .mobile-side-menu-close' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'offcanvas_close_button_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .side-menu-head .mobile-side-menu-close' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'offcanvas_close_button_border',
                'selector' => '{{WRAPPER}} .mobile-side-menu .side-menu-head .mobile-side-menu-close',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'offcanvas_close_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'offcanvas_close_button_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .side-menu-head .mobile-side-menu-close:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'offcanvas_close_button_background_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .side-menu-head .mobile-side-menu-close:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'offcanvas_close_button_border_hover',
                'selector' => '{{WRAPPER}} .mobile-side-menu .side-menu-head .mobile-side-menu-close:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_style_offcanvas_info_icon',
            [
                'label' => esc_html__( 'Info Icon', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'offcanvas_info_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'text-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .side-menu-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'offcanvas_info_icon_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .side-menu-list li i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'offcanvas_info_icon_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .side-menu-list li i' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            '_heading_style_offcanvas_info_text',
            [
                'label' => esc_html__( 'Info Text', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'offcanvas_info_text_tabs' );
        
        $this->start_controls_tab(
            'offcanvas_info_text_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'offcanvas_info_text_color',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .side-menu-list li' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mobile-side-menu .side-menu-list li span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mobile-side-menu .side-menu-list li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'offcanvas_info_text_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'text-domain' ),
            ]
        );
        
        $this->add_control(
            'offcanvas_info_text_color_hover',
            [
                'label' => esc_html__( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu .side-menu-list li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'offcanvas_info_text_typography',
                'selector' => '{{WRAPPER}} .mobile-side-menu .side-menu-list li, .mobile-side-menu .side-menu-list li span, .mobile-side-menu .side-menu-list li a',
            ]
        );
        
        $this->add_control(
            '_heading_style_offcanvas_layout',
            [
                'label' => esc_html__( 'Layout', 'text-domain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'offcanvas_layout_background',
            [
                'label' => esc_html__( 'Background', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mobile-side-menu' => 'background-color: {{VALUE}}',
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

        $thisSettings = $this->get_settings();

        $btn_id = 'theme_btn';


        if (!empty($settings['menu'])):
            $menu = $settings['menu'];
        else:
            $menu = '';
        endif;


        $menus = $this->get_available_menus();
        require_once get_parent_theme_file_path() . '/inc/class-navwalker.php';

        $args = [
            'echo' => false,
            'menu' => $menu,
            'menu_class' => 'edcare-nav-menu sub-menu',
            'menu_id' => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => 'edcare_Navwalker_Class::fallback',
            'container' => '',
            'walker' => new edcare_Navwalker_Class,
        ];

        $menu_html = wp_nav_menu($args);

        $offcanvas_image_size = edcare_get_img_size($settings, 'edcare_offcanvas_logo_size');
        $logo_image_size = edcare_get_img_size($settings, 'edcare_image_size');


        if (!empty($settings['edcare_logo_black']['url'])) {
            $logo_black = !empty($settings['edcare_logo_black']['id']) ? wp_get_attachment_image_url($settings['edcare_logo_black']['id'], $logo_image_size, true) : $settings['edcare_logo_black']['url'];
            $logo_black_alt = get_post_meta($settings["edcare_logo_black"]["id"], "_wp_attachment_image_alt", true);
        }

        $is_sticky = $settings['edcare_header_sticky'] == 'yes' ? 'sticky-active' : 'no-sticky';
        $edit_class = edcare_is_elementor_edit_mode() ? 'edcare-elementor-header-edit-mode' : '';

        $this->edcare_link_attributes_render('theme_btn', 'ed-primary-btn header-btn' . '', $this->get_settings());
        ?>

        <header class="header header-3  <?php echo esc_attr($is_sticky); ?> <?php echo esc_attr($edit_class); ?>">
            <?php if ( !empty( $settings['header_top_switch'] ) ) : ?>
                <div class="top-bar">
                    <div class="container">
                        <div class="top-bar-inner">
                            <div class="top-bar-left">
                                <ul class="top-bar-list">
                                    <?php if ( !empty( $settings['header_top_phone_label'] ) ) : ?>
                                        <li>
                                            <i class="fa-regular fa-phone"></i>
                                            <a href="tel:<?php print esc_attr($settings['header_top_phone_number']); ?>">
                                                <?php print edcare_kses($settings['header_top_phone_label']); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['header_top_address'] ) ) : ?>
                                        <li>
                                            <i class="fa-regular fa-location-dot"></i>
                                            <span><?php print edcare_kses($settings['header_top_address']); ?></span>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['header_top_time'] ) ) : ?>
                                        <li>
                                            <i class="fa-regular fa-clock"></i>
                                            <span><?php print edcare_kses($settings['header_top_time']); ?></span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="top-bar-right">
                                <?php if ( !empty( $settings['header_top_login_switch'] ) ) : ?>
                                    <div class="register-box">
                                        <div class="icon"><i class="fa-regular fa-user"></i></div>
                                        <a href="<?php print esc_url($settings['header_top_login_url']); ?>">
                                            <?php print edcare_kses($settings['header_top_login']); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                                    <div class="top-social-wrap">
                                        <span><?php echo edcare_kses( $settings['profile_label'] ); ?></span>
                                        <ul class="social-list">
                                            <?php foreach ($settings['profiles'] as $profile) :
                                                $icon = $profile['name'];
                                                $url = esc_url($profile['link']['url']);

                                                printf('<li><a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a></li>',
                                                    $url,
                                                    esc_attr($profile['_id']),
                                                    esc_attr($icon)
                                                );
                                            endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="primary-header">
                <div class="container">
                    <div class="primary-header-inner">
                        <div class="header-logo d-lg-block">
                            <a href="<?php print esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>">
                            </a>
                        </div>
                        <div class="header-menu-wrap">
                            <div class="mobile-menu-items">
                                <?php echo $menu_html; ?>
                            </div>
                        </div>
                        <!-- /.header-menu-wrap -->
                        <div class="header-right-wrap">
                            <?php if (!empty($settings['edcare_header_right_switch'])): ?>
                                <div class="header-right">
                                    <?php if ( class_exists( 'WPCleverWoosw' ) && !empty( $settings['edcare_wishlist_switch'] ) ):
                                        $wishlist_data = new \WPCleverWoosw();
                                        $key = $wishlist_data::get_key();
                                        $products = $wishlist_data::get_ids( $key );
                                        $count = count( $products );
                                        ?>
                                        <div class="header-right-icon d-xl-block d-lg-none">
                                            <a href="<?php echo esc_url( $wishlist_data::get_url( $key, true ) ); ?>">
                                                <i class="fa-sharp fa-regular fa-heart"></i>
                                            </a>
                                            <span class="number">
                                                <?php echo esc_html( $count ); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( !empty( $settings['edcare_cart_switch'] ) && class_exists( 'WooCommerce' ) ): ?>
                                        <div class="header-right-icon shop-btn">
                                            <a href="<?php echo wc_get_cart_url(); ?>">
                                                <i class="fa-regular fa-cart-shopping"></i>
                                            </a>
                                            <span class="number">
                                            <?php echo esc_html( WC()->cart->cart_contents_count ); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['edcare_theme_btn_text'])): ?>
                                        <a <?php echo $this->get_render_attribute_string('edcare-button-arg' . $btn_id . ''); ?>>
                                            <?php echo edcare_kses($settings['edcare_theme_btn_text']); ?>
                                        </a>
                                    <?php endif; ?>
                                    <div class="header-logo d-none d-lg-none">
                                        <a href="<?php print esc_url(home_url('/')); ?>">
                                            <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>">
                                        </a>
                                    </div>
                                    <div class="header-right-item d-lg-none d-md-block">
                                        <button class="mobile-side-menu-toggle">
                                            <i class="fa-sharp fa-solid fa-bars"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /.primary-header-inner -->
                </div>
            </div>
        </header>

        <?php include(EDCARE_CORE_ELEMENTS_PATH . '/header/header-offcanvas.php'); ?>

        <?php

    }
}

$widgets_manager->register(new EdCare_Header_03());
