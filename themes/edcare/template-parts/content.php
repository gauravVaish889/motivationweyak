<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edcare
 */

$edcare_audio_url = function_exists('tpmeta_field') ? tpmeta_field('edcare_post_audio') : NULL;
$gallery_images = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('edcare_post_gallery') : '';
$edcare_video_url = function_exists('tpmeta_field') ? tpmeta_field('edcare_post_video') : NULL;

$edcare_blog_single_social = get_theme_mod('edcare_blog_single_social', true);
$blog_tag_col = $edcare_blog_single_social ? 'col-xl-8 col-lg-6' : 'col-xl-12';

$enable_box_social = get_theme_mod('edcare_post_box_social_switch', false);

if (is_single()) : ?>
    <!-- details start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox-details-article mb-50'); ?>>
        <div class="tp-postbox-details-article-inner">
            <!-- content start -->
            <?php the_content(); ?>

            <?php
            wp_link_pages([
                'before'      => '<div class="page-links">' . esc_html__('Pages:', 'edcare'),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ]);
            ?>
            <?php get_template_part('template-parts/blog/blog-single-share'); ?>
        </div>
    </article>
    <!-- details end -->
<?php else :

?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox-item postbox__item tp-postbox-item p-relative mb-40 post-inner-2'); ?>>

        <?php get_template_part('template-parts/blog/blog-media'); ?>

        <div class="tp-postbox-content postbox__content post-content">

            <?php get_template_part('template-parts/blog/blog-meta'); ?>

            <h3 class="tp-postbox-title postbox__title title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            <div class="tp-postbox-text postbox__text">
                <?php the_excerpt(); ?>
            </div>

            <div class="tp-postbox-btn-box d-flex align-items-center justify-content-between">
                <!-- blog btn -->
                <?php get_template_part('template-parts/blog/blog-btn'); ?>

                <?php if ($enable_box_social && function_exists('edcare_blog_post_social')) : ?>
                    <?php echo edcare_blog_post_social(); ?>
                <?php endif; ?>
            </div>

    </article>

<?php endif; ?>