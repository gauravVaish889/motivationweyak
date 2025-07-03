<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package edcare
 */

get_header();

$edcare_404_thumb = get_theme_mod('edcare_error_thumb', get_template_directory_uri() . '/assets/img/images/error-img.png');
$edcare_error_title = get_theme_mod('edcare_error_title', __('404 - Page Not Found', 'edcare'));
$edcare_error_desc = get_theme_mod('edcare_error_desc', __('The page you are looking for does not exist', 'edcare'));
$edcare_error_link_text = get_theme_mod('edcare_error_link_text', __('Back To Home', 'edcare'));
?>

   <section class="error-section pt-120 pb-120">
      <div class="container">
         <div class="error-content text-center">
            <?php if (!empty($edcare_404_thumb)) : ?>
               <img src="<?php echo esc_url($edcare_404_thumb); ?>" alt="<?php print esc_attr__('Error 404', 'edcare'); ?>">
            <?php endif; ?>

            <?php if (!empty($edcare_error_title)) : ?>
            <h2 class="text"><?php print esc_html($edcare_error_title); ?></h2>
            <?php endif; ?>

            <p class="mb-20 mt-20">The page you are looking for does not exist</p>

            <?php if (!empty($edcare_error_desc)) : ?>
               <p class="mb-20 mt-20"><?php print esc_html($edcare_error_desc); ?></p>
            <?php endif; ?>

            <?php if (!empty($edcare_error_link_text)) : ?>
               <a href="<?php print esc_url(home_url('/')); ?>" class="ed-primary-btn"><?php print esc_html($edcare_error_link_text); ?></a>
            <?php endif; ?>
         </div>
      </div>
   </section>

<?php
get_footer();
