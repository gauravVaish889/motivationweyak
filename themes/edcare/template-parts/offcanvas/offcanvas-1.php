<?php

/**
 * Template part for displaying header side information
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edcare
 */

$edcare_offcanvas_logo = get_theme_mod('edcare_offcanvas_logo', get_template_directory_uri() . '/assets/img/logo/logo-black.png');
$edcare_offcanvas_content_switch = get_theme_mod('edcare_offcanvas_content_switch', false);

// Offcanvas Info content
// Address
$edcare_offcanvas_address_label = get_theme_mod('edcare_offcanvas_address_label', esc_html__('Address:', 'edcare'));
$edcare_offcanvas_address_text = get_theme_mod('edcare_offcanvas_address_text', esc_html__('Amsterdam, 109-74', 'edcare'));

// Phone Number
$edcare_offcanvas_phone_number_label = get_theme_mod('edcare_offcanvas_phone_number_label', esc_html__('Phone:', 'edcare'));
$edcare_offcanvas_phone_number = get_theme_mod('edcare_offcanvas_phone_number', esc_html__('+01 569 896 654', 'edcare'));
$edcare_offcanvas_phone_number_url = get_theme_mod( 'edcare_offcanvas_phone_number_url', __( '#', 'edcare' ) );

// Email Number
$edcare_offcanvas_email_number_label = get_theme_mod('edcare_offcanvas_email_number_label', esc_html__('Email:', 'edcare'));
$edcare_offcanvas_email_number = get_theme_mod('edcare_offcanvas_email_number', esc_html__('info@example.com', 'edcare'));
$edcare_offcanvas_email_number_url = get_theme_mod( 'edcare_offcanvas_email_number_url', __( '#', 'edcare' ) );

?>

<div class="mobile-side-menu">
   <div class="side-menu-content">
         <div class="side-menu-head">
            <?php if (!empty($edcare_offcanvas_logo)) : ?>
               <a href="<?php print esc_url(home_url('/')); ?>" class="edcare-offcanvas-logo">
                  <img src="<?php echo esc_url($edcare_offcanvas_logo); ?>" alt="<?php echo esc_attr__('edcare Logo', 'edcare'); ?>">
               </a>
            <?php endif; ?>
            <button class="mobile-side-menu-close"><i class="fa-regular fa-xmark"></i></button>
         </div>

         <div class="side-menu-wrap"></div>

         <?php if ($edcare_offcanvas_content_switch) : ?>
         <ul class="side-menu-list">
            <?php if(!empty($edcare_offcanvas_address_text)) : ?>
            <li>
               <i class="fa-light fa-location-dot"></i>
               <?php echo esc_html( $edcare_offcanvas_address_label ); ?>
               <span><?php echo esc_html( $edcare_offcanvas_address_text ); ?></span>
            </li>
            <?php endif; ?>

            <?php if(!empty($edcare_offcanvas_phone_number)) : ?>
            <li>
               <i class="fa-light fa-phone"></i>
               <?php echo esc_html( $edcare_offcanvas_phone_number_label ); ?>
               <a href="<?php echo esc_url( $edcare_offcanvas_phone_number_url ); ?>"><?php echo esc_html( $edcare_offcanvas_phone_number ); ?></a>
            </li>
            <?php endif; ?>

            <?php if(!empty($edcare_offcanvas_email_number)) : ?>
            <li>
               <i class="fa-light fa-envelope"></i>
               <?php echo esc_html( $edcare_offcanvas_email_number_label ); ?>
               <a href="<?php echo esc_url( $edcare_offcanvas_email_number_url ); ?>"><?php echo esc_html( $edcare_offcanvas_email_number ); ?></a>
            </li>
            <?php endif; ?>
         </ul>
         <?php endif; ?>
   </div>
</div>
<!-- /.mobile-side-menu -->
<div class="mobile-side-menu-overlay"></div>