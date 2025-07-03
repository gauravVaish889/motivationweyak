<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package edcare
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 'col-lg-8' : 'col-lg-12';

?>

<div class="tp-blog-area tp-postbox-area postbox__area tp-blog-standard-area p-relative pt-100 pb-120">
	<div class="container">
		<div class="row">
			<div class="<?php print esc_attr($blog_column); ?> blog-post-items">
				<div class="tp-postbox-wrapper postbox__wrapper">
					<?php
					if (have_posts()) :
					?>
						<div class="result-bar page-header d-none">
							<h1 class="page-title"><?php esc_html_e('Search Results For:', 'edcare'); ?> <?php print get_search_query(); ?></h1>
						</div>
						<?php
						while (have_posts()) : the_post();
							get_template_part('template-parts/content', 'search');
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
			<?php if (is_active_sidebar('blog-sidebar')) : ?>
				<div class="col-lg-4">
					<div class="tp-sidebar-wrapper sidebar__wrapper pl-35">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
get_footer();
