<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package edcare
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php if (is_singular() && pings_open(get_queried_object())): ?>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<?php
$get_edcare_lp_archive = get_theme_mod( 'edcare_lp_archive', 'style_1' );
$get_edcare_lp_details = get_theme_mod( 'edcare_lp_details', 'style_1' );
$ac_lp_class = '';
$ac_lp_details_class = '';

if( is_post_type_archive( 'lp_course' ) ) {
    if( $get_edcare_lp_archive == 'style_1' ) {
        $ac_lp_class = 'ac-lp-archive-1';
    } elseif( $get_edcare_lp_archive == 'style_2' ) {
        $ac_lp_class = 'ac-lp-archive-2';
    } elseif( $get_edcare_lp_archive == 'style_3' ) {
        $ac_lp_class = 'ac-lp-archive-3';
    } elseif( $get_edcare_lp_archive == 'style_4' ) {
        $ac_lp_class = 'ac-lp-archive-4';
    } elseif( $get_edcare_lp_archive == 'style_5' ) {
        $ac_lp_class = 'ac-lp-archive-5';
    }
}

if( is_singular( 'lp_course' ) ) {
    if( $get_edcare_lp_details == 'style_1' ) {
        $ac_lp_details_class = 'ac-lp-details-1';
    } elseif( $get_edcare_lp_details == 'style_2' ) {
        $ac_lp_details_class = 'ac-lp-details-2';
    }
}

?>

<body <?php body_class(' tp-magic-cursor ' . $ac_lp_class . ' ' . $ac_lp_details_class ); ?> id="body">

    <?php wp_body_open(); ?>


    <?php
    $edcare_preloader = get_theme_mod('edcare_preloader_switch', false);
    $edcare_mouse_cursor = get_theme_mod('edcare_mouse_cursor_switch', false);
    $edcare_preloader_logo = get_theme_mod('edcare_preloader_logo', get_template_directory_uri() . '/assets/img/favicon.png');

    $edcare_backtotop = get_theme_mod('edcare_backtotop_switch', false);

    ?>

    <?php if ($edcare_preloader): ?>
        <!-- Preloader Start  -->
        <div id="preloader">
            <?php if (!empty($edcare_preloader_logo)): ?>
            <div class="spinner-logo">
                <img src="<?php echo esc_url($edcare_preloader_logo); ?>" alt="<?php echo esc_attr__('edcare preloader Logo', 'edcare'); ?>">
            </div>
            <?php endif; ?>
            <div class="spinner"></div>
        </div>
        <!-- Preloader End  -->
    <?php endif; ?>

    <?php if ($edcare_backtotop): ?>
        <!-- back to top start -->
        <div id="scrollup">
            <button id="scroll-top" class="scroll-to-top"><i class="fa-regular fa-arrow-up-long"></i></button>
        </div>
        <!-- back to top end -->
    <?php endif; ?>

    <?php if ( $edcare_mouse_cursor ) : ?>
        <div class="mt-cursor"></div>
    <?php endif; ?>
    
    <!-- header start -->
    <?php do_action('edcare_header_style'); ?>
    <!-- header end -->

    <?php
    if ( !is_singular('etn') && !is_singular( 'lp_course' ) && !is_post_type_archive( 'lp_course' ) && !is_tax( 'course_category' ) && !is_tax( 'course_tag' ) ) {
        do_action('edcare_before_main_content');
    }
    ?>