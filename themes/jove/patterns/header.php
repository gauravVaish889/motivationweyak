<?php
/**
 * Title: Header
 * Slug: jove/header
 * Description: Header with button
 * Categories: header
 * Keywords: header,button
 * Viewport Width: 1440
 * Block Types: core/template-part/header
 * Post Types: wp_template
 * Inserter: true
 */
?>

<!-- wp:group {"tagName":"header","metadata":{"name":"Header"},"align":"full","style":{"spacing":{"padding":{"top":"28px","bottom":"28px","right":"31px","left":"31px"}},"elements":{"link":{"color":{"text":"var:preset|color|main"}}}},"backgroundColor":"base","layout":{"inherit":true,"type":"constrained"}} -->
<header class="wp-block-group alignfull has-base-background-color has-background has-link-color"
    style="padding-top:28px;padding-right:31px;padding-bottom:28px;padding-left:31px">
    <!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:group {"style":{"spacing":{"blockGap":"12px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            <!-- wp:image {"lightbox":{"enabled":false},"id":39719121,"width":"75px","height":"auto","sizeSlug":"full","linkDestination":"custom"} -->
            <figure class="wp-block-image size-full is-resized"><a href="https://www.jove.com"><img
                        src="<?php echo esc_url( JOVE_BUILD_URI ); ?>/media/images/JoVE-Logo-GreyBlue.webp" alt=""
                        class="wp-image-39719121" style="width:75px;height:auto" /></a></figure>
            <!-- /wp:image -->

            <!-- wp:acf/divider {"name":"acf/divider","data":{"height":"40","_height":"field_676cdd011fe20","width":"1","_width":"field_676cdd271fe21"},"mode":"preview","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

            <!-- wp:image {"lightbox":{"enabled":false},"id":39719136,"width":"135px","sizeSlug":"full","linkDestination":"custom"} -->
            <figure class="wp-block-image size-full is-resized"><a href="https://visualize.jove.com/"><img
                        src="<?php echo esc_url( JOVE_BUILD_URI ); ?>/media/images/header-visualize.webp" alt=""
                        class="wp-image-39719136" style="width:135px" /></a></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:group -->

        <!-- wp:buttons -->
        <div class="wp-block-buttons">
            <!-- wp:button -->
            <div class="wp-block-button"><a class="wp-block-button__link wp-element-button"
                    href="https://www.jove.com/about/contact"><?php esc_html_e('Contact Us','jove'); ?></a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:group -->
</header>
<!-- /wp:group -->