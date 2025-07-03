<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edcare
 */

$categories = get_the_terms($post->ID, 'category');

$edcare_blog_date = get_theme_mod('edcare_blog_date', true);
$edcare_blog_comments = get_theme_mod('edcare_blog_comments', true);
$edcare_blog_author = get_theme_mod('edcare_blog_author', true);
$edcare_blog_cat = get_theme_mod('edcare_blog_cat', true);
$edcare_blog_tags = get_theme_mod('edcare_blog_tags', true);

?>

<ul class="post-meta">
    <?php if (!empty($edcare_blog_cat)) : ?>
        <?php if (!empty($categories[0]->name)) :
             $color =  get_term_meta($categories[0]->term_id, '_edcare_post_cat_color', true)
            ?>
            <li><a data-bg-color="<?php echo esc_attr($color); ?>" href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><i class="fa-sharp fa-regular fa-folder"></i><?php echo esc_html($categories[0]->name); ?></a></li>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($edcare_blog_date)) : ?>
    <li>
        <i class="fa-sharp fa-regular fa-clock"></i>
        <?php the_time(get_option('date_format')); ?>
    </li>
    <?php endif; ?>

    <?php if (!empty($edcare_blog_comments)) : ?>
    <li>
        <a href="<?php comments_link(); ?>"><i class="fa-light fa-message"></i><?php comments_number(); ?></a>
    </li>
    <?php endif; ?>
</ul>