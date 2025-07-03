<?php

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edcare
 */
global $post, $title;

$_id = get_the_ID();

if (is_single() && 'product' == get_post_type()) {
    $_id = $post->ID;
} elseif (function_exists("is_shop") and is_shop()) {
    $_id = wc_get_page_id('shop');
} elseif (is_home() && get_option('page_for_posts')) {
    $_id = get_option('page_for_posts');
}


// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod('footer_widget_number', 4);

for ($num = 1; $num <= $footer_widgets; $num++) {
    $footer_columns++;
}


switch ($footer_columns) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        break;
    case '4':
        $footer_class[1] = 'col-xl-3 col-lg-3 col-md-6 col-sm-6';
        $footer_class[2] = 'col-xl-3 col-lg-3 col-md-6 col-sm-6';
        $footer_class[3] = 'col-xl-3 col-lg-3 col-md-6 col-sm-6';
        $footer_class[4] = 'col-xl-3 col-lg-3 col-md-6 col-sm-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
}

?>


    <footer class="ed-default-footer footer-section">
        <?php if (is_active_sidebar('footer-1') or is_active_sidebar('footer-2') or is_active_sidebar('footer-3') or is_active_sidebar('footer-4')) : ?>
        <div class="footer-top-wrap pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <?php
                        for ($num = 1; $num <= $footer_widgets; $num++) {
                            print '<div class="' . esc_attr($footer_class[$num]) . '">';
                            dynamic_sidebar('footer-' . $num);
                            print '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="copyright-area">
            <div class="container">
                <div class="copyright-content">
                    <p><?php print edcare_copyright_text(); ?></p>
                </div>
            </div>
        </div>
    </footer>