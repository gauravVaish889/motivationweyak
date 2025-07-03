<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edcare
 */

$edcare_blog_btn = get_theme_mod('edcare_blog_btn', 'Read More');
$edcare_blog_btn_switch = get_theme_mod('edcare_blog_btn_switch', true);

?>

<?php if (!empty($edcare_blog_btn_switch)) : ?>
<div class="post-bottom">
    <a class="read-more ed-primary-btn" href="<?php the_permalink(); ?>"><?php print esc_html($edcare_blog_btn); ?><i class="fa-regular fa-arrow-right"></i></a>
</div>
<?php endif; ?>