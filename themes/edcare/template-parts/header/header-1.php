<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edcare
 */


// main header settings
$edcare_header_hamburger   = get_theme_mod('edcare_header_hamburger', true);
$header_right_switch     = get_theme_mod('header_right_switch', false);
$header_topbar_switch     = get_theme_mod('header_topbar_switch', false);
$edcare_menu_col           = $header_right_switch ? 'col-xl-8 d-none d-xl-block text-center' : 'col-xl-10 col-lg-10 d-none d-xl-block text-end';
$edcare_header_sticky      = get_theme_mod('edcare_header_sticky', false);

// header Button Control
$edcare_header_btn_text = get_theme_mod( 'edcare_header_btn_text', __( 'Start Free Trial', 'edcare' ) );
$edcare_header_btn_url = get_theme_mod( 'edcare_header_btn_url', __( '#', 'edcare' ) );

// Header Topbar info
$edcare_header_topbar_phone_number = get_theme_mod( 'edcare_header_topbar_phone_number', __( '256 214 203 215', 'edcare' ) );
$edcare_header_topbar_phone_number_url = get_theme_mod( 'edcare_header_topbar_phone_number_url', __( '#', 'edcare' ) );

$edcare_header_topbar_address = get_theme_mod( 'edcare_header_topbar_address', __( '258 Helano Street, New York', 'edcare' ) );
$edcare_header_topbar_time = get_theme_mod( 'edcare_header_topbar_time', __( 'Mon - Sat: 8:00 - 15:00', 'edcare' ) );

// Header social label
$edcare_header_social_label_text = get_theme_mod( 'edcare_header_social_label_text', __( 'Follow Us', 'edcare' ) );

// woocommerce controls
$edcare_header_cart     = get_theme_mod('edcare_header_cart', true);
$edcare_header_wishlist     = get_theme_mod('edcare_header_wishlist', true);

$has_menu = has_nav_menu('main-menu') ? '' : ' main-menu-assigned';

$sticky_class = $edcare_header_sticky ? 'sticky-active' : '';
?>

   <header class="ed-default-header header header-3 <?php echo $sticky_class ;?>">
      <?php if(!empty($header_topbar_switch)) : ?>
      <div class="top-bar">
         <div class="container">
            <div class="top-bar-inner">

               <div class="top-bar-left">
                  <ul class="top-bar-list">
                     <?php if(!empty($edcare_header_topbar_phone_number)) : ?>
                     <li>
                        <i class="fa-regular fa-phone"></i>
                        <a href="<?php echo esc_url( $edcare_header_topbar_phone_number_url ); ?>"><?php echo esc_html( $edcare_header_topbar_phone_number ); ?></a>
                     </li>
                     <?php endif; ?>

                     <?php if(!empty($edcare_header_topbar_address)) : ?>
                     <li>
                        <i class="fa-regular fa-location-dot"></i>
                        <span><?php echo esc_html( $edcare_header_topbar_address ); ?></span>
                     </li>
                     <?php endif; ?>

                     <?php if(!empty($edcare_header_topbar_time)) : ?>
                     <li>
                        <i class="fa-regular fa-clock"></i>
                        <span><?php echo esc_html( $edcare_header_topbar_time ); ?></span>
                     </li>
                     <?php endif; ?>
                  </ul>
               </div>

               <div class="top-bar-right">
                  <div class="top-social-wrap">
                     <?php if(!empty($edcare_header_social_label_text)) : ?>
                        <span><?php echo esc_html( $edcare_header_social_label_text ); ?></span>
                     <?php endif; ?>

                     <?php edcare_header_social_profiles() ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php endif; ?>

      <div class="primary-header">
         <div class="container">
            <div class="primary-header-inner">
               <div class="header-logo d-lg-block">
                  <?php edcare_header_logo(); ?>
               </div>
               <div class="header-menu-wrap">
                     <div class="mobile-menu-items">
                        <?php edcare_header_menu(); ?>
                     </div>
               </div>
               <!-- /.header-menu-wrap -->
               <?php if ($header_right_switch) : ?>
               <div class="header-right-wrap">
                     <div class="header-right">
                        <?php if ( class_exists( 'WPCleverWoosw' ) && !empty( $edcare_header_wishlist ) ):
                           $wishlist_data = new WPCleverWoosw();
                           $key = $wishlist_data::get_key();
                           $products = $wishlist_data::get_ids( $key );
                           $count = count( $products );
                        ?>
                        <div class="header-right-icon d-xl-block d-lg-none">
                           <a href="<?php echo esc_url( $wishlist_data::get_url( $key, true ) ); ?>"><i class="fa-sharp fa-regular fa-heart"></i></a>
                           <span class="number"><?php echo esc_html( $count ); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($edcare_header_cart && class_exists('WooCommerce')) : ?>
                        <div class="header-right-icon shop-btn">
                           <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><i class="fa-regular fa-cart-shopping"></i></a>
                           <?php
                              $cart_count = !is_null(WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;
                           ?>
                           <span class="number"><?php echo esc_html($cart_count); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($edcare_header_btn_text)) : ?>
                        <a href="<?php echo esc_url( $edcare_header_btn_url ); ?>" class="ed-primary-btn header-btn"><?php echo esc_html( $edcare_header_btn_text ); ?></a>
                        <?php endif; ?>
                     </div>
                     <!-- /.header-right -->
               </div>
               <?php endif; ?>

               <?php if (!empty($edcare_header_hamburger)) : ?>
               <div class="header-right-item d-lg-none d-md-block">
                  <a href="javascript:void(0)" class="mobile-side-menu-toggle"
                        ><i class="fa-sharp fa-solid fa-bars"></i
                  ></a>
               </div>
               <?php endif; ?>
            </div>
            <!-- /.primary-header-inner -->
         </div>
      </div>
   </header>


<?php if (class_exists('WooCommerce')) : ?>
   <?php // print edcare_shopping_cart(); ?>
<?php endif; ?>


<?php do_action('edcare_offcanvas_style'); ?>