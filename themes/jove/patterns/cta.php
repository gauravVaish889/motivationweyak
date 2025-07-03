<?php
/**
 * Title: CTA
 * Slug: jove/cta
 * Description:
 * Categories: jove/card, jove/cta
 * Keywords: card, box, link, button, cta, call to action
 * Viewport Width: 1440
 * Block Types:
 * Post Types:
 * Inserter: true
 */
?>

<!-- wp:acf/cta {"name":"acf/cta","data":{"video":"https://player.vimeo.com/video/1061949928","_video":"field_676b60770f71e"},"mode":"preview"} -->
<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|0","bottom":"var:preset|spacing|large","left":"var:preset|spacing|0"},"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"
    style="padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--0);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--0)">
    <!-- wp:column {"verticalAlignment":"center","width":""} -->
    <div class="wp-block-column is-vertically-aligned-center">
        <!-- wp:heading -->
        <h2 class="wp-block-heading"><?php esc_html_e('What is JoVE Visualize?','jove'); ?></h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph -->
        <p><?php esc_html_e('JoVE Visualize aligns the vast landscape of scientific literature with peer-reviewed experiments and methods
            videos.','jove'); ?></p>
        <!-- /wp:paragraph -->

        <!-- wp:paragraph -->
        <p><?php esc_html_e('Designed for researchers, students, and scientists, it enhances the research workflow by showcasing visual
            demonstrations of complex experimental techniques referenced in major research publications, saving valuable
            research time and accelerating discoveries.','jove'); ?></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column {"verticalAlignment":"center","width":""} -->
    <div class="wp-block-column is-vertically-aligned-center">
        <!-- wp:cover {"url":"<?php echo esc_url( JOVE_BUILD_URI ); ?>/media/images/thumbnail.webp","id":39719138,"dimRatio":50,"isUserOverlayColor":true,"style":{"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-cover" style="border-radius:8px"><span aria-hidden="true"
                class="wp-block-cover__background has-background-dim"></span><img
                class="wp-block-cover__image-background wp-image-39719138" alt=""
                src="<?php echo esc_url( JOVE_BUILD_URI ); ?>/media/images/thumbnail.webp" data-object-fit="cover" />
            <div class="wp-block-cover__inner-container">
                <!-- wp:image {"lightbox":{"enabled":false},"linkDestination":"custom","align":"center","className":"jove-popup-video-btn"} -->
                <figure class="wp-block-image aligncenter jove-popup-video-btn"><a
                        href="https://player.vimeo.com/video/1061949928"><img
                            src="<?php echo esc_url( JOVE_BUILD_URI ); ?>/media/svg/play.svg" alt="" /></a></figure>
                <!-- /wp:image -->
            </div>
        </div>
        <!-- /wp:cover -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->
<!-- /wp:acf/cta -->