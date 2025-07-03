<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edcare
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 8 : 12;

$sidebar_sytem = get_theme_mod('edcare_blog_sidebar_system', 'right');

$blog_column_alignment = $sidebar_sytem == 'left' ? 'flex-row-reverse' : '';
$sidebar_off = $sidebar_sytem == 'no_sidebar' ? false : true;


?>

<!-- search result item area start -->
<section class="tp-blog-area tp-postbox-area postbox__area tp-blog-standard-area p-relative pt-100 pb-120">
	<div class="container">
		<div class="row <?php echo esc_attr($blog_column_alignment); ?> justify-content-center">
			<div class="col-lg-<?php print esc_attr($blog_column); ?>">
				<div class="tp-postbox-wrapper postbox__wrapper">
					<?php
					if (have_posts()) :
						if (is_home() && !is_front_page()) :
					?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php
						endif; ?>
						<?php
						/* Start the Loop */
						while (have_posts()) : the_post(); ?>
							<?php
							/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
							get_template_part('template-parts/content'); ?>
						<?php
						endwhile;
						?>
						<div class="basic-pagination tp-pagination">
							<?php edcare_pagination('<i class="fa-regular fa-arrow-left icon"></i>', '<i class="fa-regular fa-arrow-right icon"></i>', '', ['class' => '']); ?>
						</div>
					<?php
					else :
						get_template_part('template-parts/content', 'none');
					endif;
					?>

				</div>
			</div>

			<?php if (is_active_sidebar('blog-sidebar') && $sidebar_off) : ?>
				<div class="col-lg-4">
					<div class="tp-sidebar-wrapper sidebar__wrapper pl-35">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- search result item area end -->
<?php
get_footer();
