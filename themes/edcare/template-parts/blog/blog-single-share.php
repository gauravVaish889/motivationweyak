<?php
$edcare_blog_single_social = get_theme_mod('edcare_blog_single_social', false);
$blog_tag_col = $edcare_blog_single_social ? 'col-xl-8  col-md-6' : 'col-xl-12 col-md-12';
$edcare_blog_tags = get_theme_mod('edcare_blog_tags', true);
$share_column = $edcare_blog_tags ? 'col-xl-4 col-md-6' : 'col-xl-12 col-md-12';
$share_class = $edcare_blog_tags ? 'text-md-end' : '';
$post_url = get_the_permalink();

if (has_tag() or $edcare_blog_single_social):

    ?>

    <div class="blog-details-share-wrap tp-postbox-details-share mb-50">
        <div class="row align-items-center">

            <?php if ($edcare_blog_tags): ?>
                <div class="<?php echo esc_attr($blog_tag_col); ?>">
                    <div class="tagcloud tp-postbox-details-tag">
                        <?php print edcare_get_tag(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($edcare_blog_single_social): ?>
                <div class="<?php echo esc_attr($share_column); ?>">
                    <div class="tp-postbox-details-social <?php echo esc_attr($share_class); ?> text-start">
                        <a href="http://facebook.com/pin/create/button/?url=<?php echo esc_url($post_url); ?>" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url); ?>"
                            target="_blank">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>

                        <a href="https://twitter.com/share?url=<?php echo esc_url($post_url); ?>" target="_blank">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>