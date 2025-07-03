<?php

$args = [
    'post_type' => 'post',
    'posts_per_page' => 15,
    'post__not_in' => [get_the_ID()],
    'category__in' => wp_get_post_categories(get_the_ID()),
];

$related = get_posts($args);

$related_title = get_theme_mod('edcare_blog_related_title', esc_html__('Related Posts', 'edcare'));

$post_count = count($related);
$col = $post_count < 3 ? 'col-xl-4 col-lg-6 col-md-6 mb-50' : 'swiper-slide';

if ($related): ?>
    <section class="tp-postbox-details-bottom p-relative pt-90 pb-60">
        <div class="container">

            <div class="row">
                <?php if (!empty($related_title)): ?>
                    <div class="col-xl-12">
                        <div class="blog-details-realated-title-box">
                            <h3 class="tp-postbox-details-bottom-title">
                                <?php echo esc_html($related_title) ?>
                            </h3>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($post_count > 3): ?>
                    <div class="col-xl-12">
                        <div class="edcare-post-related">
                            <div class="edcare-post-related-slider-active swiper">
                                <div class="swiper-wrapper">
                                <?php endif; ?>

                                <?php foreach ($related as $post):
                                    setup_postdata($post);
                                    $categories = get_the_terms($post->ID, 'category');
                                    $custom_avater = get_the_author_meta('edcare_author_avater');
                                    $author_name = get_the_author_meta('display_name');
                                    $author_bio_avatar_size = 180;
                                    ?>
                                    <div class="<?php echo esc_attr($col); ?>">
                                        <div class="tp-blog-stories-item p-relative">
                                            <div class="tp-blog-stories-thumb">
                                                <?php get_template_part('template-parts/blog/blog-media'); ?>
                                            </div>

                                            <div class="tp-blog-stories-content">
                                                <?php get_template_part('template-parts/blog/blog-meta'); ?>

                                                <h4 class="tp-blog-stories-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h4>

                                                <div class="tp-blog-stories-user-box d-flex align-items-center">
                                                    <div class="tp-blog-stories-user-thumb">
                                                        <?php if (!empty($custom_avater)): ?>
                                                            <img src="<?php echo esc_url($custom_avater); ?>"
                                                                alt="<?php echo esc_attr($author_name) ?>">
                                                        <?php else: ?>
                                                            <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <span><?php print esc_html($author_name); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;
                                wp_reset_postdata(); ?>

                                <?php if ($post_count > 3): ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>