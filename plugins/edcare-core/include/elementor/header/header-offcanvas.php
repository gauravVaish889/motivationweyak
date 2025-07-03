<?php

namespace EdCareCore\Widgets;


if (!empty($settings['edcare_offcanvas_logo']['url'])) {
   $edcare_offcanvas_logo = !empty($settings['edcare_offcanvas_logo']['id']) ? wp_get_attachment_image_url($settings['edcare_offcanvas_logo']['id'], $offcanvas_image_size, true) : $settings['edcare_offcanvas_logo']['url'];
   $edcare_offcanvas_logo_alt = get_post_meta($settings["edcare_offcanvas_logo"]["id"], "_wp_attachment_image_alt", true);
}
if (!empty($settings['edcare_offcanvas_logo_white']['url'])) {
   $edcare_offcanvas_logo_white = !empty($settings['edcare_offcanvas_logo_white']['id']) ? wp_get_attachment_image_url($settings['edcare_offcanvas_logo_white']['id'], $offcanvas_image_size, true) : $settings['edcare_offcanvas_logo_white']['url'];
   $edcare_offcanvas_logo_white_alt = get_post_meta($settings["edcare_offcanvas_logo_white"]["id"], "_wp_attachment_image_alt", true);
}

?>

<div class="mobile-side-menu">
   <div class="side-menu-content">
         <div class="side-menu-head">
            <a href="<?php print esc_url(home_url('/')); ?>">
               <img src="<?php echo esc_url($edcare_offcanvas_logo); ?>" alt="<?php echo esc_attr($edcare_offcanvas_logo_alt); ?>">
            </a>
            <button class="mobile-side-menu-close">
               <i class="fa-regular fa-xmark"></i>
            </button>
         </div>
         <div class="side-menu-wrap"></div>
         <ul class="side-menu-list">
            <?php if ( !empty( $settings['edcare_offcanvas_address'] ) ) : ?>
               <li>
                  <i class="fa-light fa-location-dot"></i><?php print edcare_kses($settings['edcare_offcanvas_address_label']); ?>
                  <span><?php print edcare_kses($settings['edcare_offcanvas_address']); ?></span>
               </li>
            <?php endif; ?>
            <?php if ( !empty( $settings['edcare_offcanvas_phone'] ) ) : ?>
               <li>
                  <i class="fa-light fa-phone"></i><?php print edcare_kses($settings['edcare_offcanvas_phone_label']); ?>
                  <a href="tel:<?php print esc_attr($settings['edcare_offcanvas_phone_link']); ?>">
                     <?php print edcare_kses($settings['edcare_offcanvas_phone']); ?>
                  </a>
               </li>
            <?php endif; ?>
            <?php if ( !empty( $settings['edcare_offcanvas_email'] ) ) : ?>
               <li>
                  <i class="fa-light fa-envelope"></i>
                  <?php print edcare_kses($settings['edcare_offcanvas_email_label']); ?>
                  <a href="mailto:<?php print esc_attr($settings['edcare_offcanvas_email']); ?>">
                     <?php print edcare_kses($settings['edcare_offcanvas_email']); ?>
                  </a>
               </li>
            <?php endif; ?>
         </ul>
   </div>
</div>
<!-- /.mobile-side-menu -->
<div class="mobile-side-menu-overlay"></div>