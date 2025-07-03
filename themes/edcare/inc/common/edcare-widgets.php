<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function edcare_widgets_init()
{

    /**
     * blog sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'edcare'),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__('Set Your Blog Widget', 'edcare'),
        'before_widget' => '<div id="%1$s" class="tp-sidebar-widget sidebar-widget mb-50 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-sidebar-widget-title widget-title">',
        'after_title'   => '</h3>',
    ]);

    /**
     * product sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Product Sidebar', 'edcare'),
        'id'            => 'product-sidebar',
        'description'          => esc_html__('Set Your Product Widget', 'edcare'),
        'before_widget' => '<div id="%1$s" class="tp-shop-widget mb-35 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-shop-widget-title">',
        'after_title'   => '</h3>',
    ]);


    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    // footer default
    for ($num = 1; $num <= $footer_widgets; $num++) {
        register_sidebar([
            'name'          => sprintf(esc_html__('Footer %1$s', 'edcare'), $num),
            'id'            => 'footer-' . $num,
            'description'   => sprintf(esc_html__('Footer column %1$s', 'edcare'), $num),
            'before_widget' => '<div id="%1$s" class="footer-widget footer-col-2-' . $num . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-header">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'edcare_widgets_init');
