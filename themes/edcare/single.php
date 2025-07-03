<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package edcare
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 'col-lg-8' : 'col-xl-12 col-lg-12';


$edcare_blog_single_related = get_theme_mod('edcare_blog_single_related', false);
$blog_single_layout_from_customizer = get_theme_mod('edcare_blog_single_layout', 'blog_single_default');
$blog_single_layout_from_page = function_exists('tpmeta_field') ? tpmeta_field('edcare_post_single_layout') : '';

$blog_single_layout = !empty($blog_single_layout_from_page) ? ($blog_single_layout_from_page == 'default' ? $blog_single_layout_from_customizer : $blog_single_layout_from_page) : $blog_single_layout_from_customizer;
$edcare_blog_date = get_theme_mod('edcare_blog_date', true);
$edcare_blog_comments = get_theme_mod('edcare_blog_comments', true);
$edcare_blog_author = get_theme_mod('edcare_blog_author', true);
$edcare_blog_cat = get_theme_mod('edcare_blog_cat', false);

$edcare_blog_single_social = get_theme_mod('edcare_blog_single_social', false);
$post_url = get_the_permalink();

$sidebar_sytem = get_theme_mod('edcare_blog_sidebar_system', 'right');

$blog_column_alignment = $sidebar_sytem == 'left' ? 'flex-row-reverse' : '';
$sidebar_off = $sidebar_sytem == 'no_sidebar' ? false : true;

$edcare_blog_full_width_overlay_bg = get_template_directory_uri() . '/assets/img/blog/blog-stories/blog-stories-bg.png';

?>

<?php if ($blog_single_layout == 'blog_single_full_width'): ?>

	<div class="tp-postbox-details-area tp-blog-area"> </div>

	<?php if ($edcare_blog_single_related) {
		get_template_part('template-parts/blog/blog-single-related');
	} ?>

<?php elseif ($blog_single_layout == 'blog_single_classic'): ?>


	<?php while (have_posts()):
		the_post(); ?>

		<!-- blog full width banner area start -->
		<section class="tp-blog-full-width-area tp-blog-full-width-pl fix p-relative pt-180 edcare-blog-single-height">
			<div class="tp-blog-stories-bg" data-background="<?php print esc_url($edcare_blog_full_width_overlay_bg); ?>"></div>
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="tp-breadcrumb__content text-center">
							<div class="row justify-content-center">
								<div class="col-xl-8">
									<h3 class="tp-blog-full-width-title">
										<?php the_title(); ?>
									</h3>
								</div>
							</div>

							<div class="tp-blog-full-width-box d-flex justify-content-between">

								<div class="tp-blog-full-width-back">
									<a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>">
										<span>
											<i class="fa-sharp fa-regular fa-arrow-left"></i>
										</span>
										<?php echo esc_html__('Back to main blog', 'edcare'); ?>
									</a>
								</div>

								<div class="tp-blog-details-user">
									<?php get_template_part('template-parts/blog/blog-details-meta'); ?>
								</div>

								<div class=" tp-blog-details-user-social order-2 order-lg-3">
									<div class="tp-postbox-details-social text-end">
										<?php if ($edcare_blog_single_social): ?>
											<a href="http://facebook.com/pin/create/button/?url=<?php echo esc_url($post_url); ?>"
												target="_blank">
												<i class="fa-brands fa-facebook-f"></i>
											</a>

											<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url); ?>"
												target="_blank">
												<i class="fa-brands fa-linkedin-in"></i>
											</a>

											<a href="https://twitter.com/share?url=<?php echo esc_url($post_url); ?>"
												target="_blank">
												<i class="fa-brands fa-twitter"></i>
											</a>
										<?php endif; ?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div class="tp-blog-full-width-img">
			<div class="container-fluid p-0 ">
				<div class="row g-0">
					<div class="col-lg-12">
						<?php if (has_post_thumbnail()): ?>
							<div class="tp-blog-full-width-thumb">
								<?php get_template_part('template-parts/blog/blog-media'); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- blog full width banner area end -->


	<?php endwhile;  // End of the loop.
	?>

	<!-- postbox area start -->
	<section class="postbox__area tp-blog-sidebar-sticky-area pt-120 pb-120">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="tp-postbox-details-main-wrapper postbox__wrapper blog-details-left-content">
						<div class="tp-postbox-details-content postbox__text">
							<div class="row justify-content-center">
								<div class="col-xl-8">
									<?php while (have_posts()):
										the_post(); ?>

										<?php

										get_template_part('template-parts/content', get_post_format());
										get_template_part('template-parts/biography', get_post_format());
										get_template_part('template-parts/blog/blog-single-navigation');


										if (comments_open() || get_comments_number()):
											comments_template();
										endif;

									endwhile; // End of the loop.
									?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- postbox area end -->

	<?php if ($edcare_blog_single_related) {
		get_template_part('template-parts/blog/blog-single-related');
	} ?>

<?php else: ?>

	<section class="tp-postbox-details-area tp-blog-area tp-blog-details-p p-relative pt-80 pb-120">
		<div class="container">
			<div class="row <?php echo esc_attr($blog_column_alignment); ?> justify-content-center">
				<div class="<?php echo esc_attr($blog_column); ?>">

					<div class="tp-postbox-details-main-wrapper postbox__wrapper blog-details-left-content">
						<div class="tp-postbox-details-content postbox__text">

							<?php if (has_post_thumbnail()): ?>
								<div class="postbox__details-thumbnail tp-blog-details-thumb mb-30">
									<?php get_template_part('template-parts/blog/blog-media'); ?>
								</div>
							<?php endif; ?>

							<?php get_template_part('template-parts/blog/blog-meta'); ?>

							<?php while (have_posts()):
								the_post(); ?>

								<?php
								get_template_part('template-parts/content', get_post_format());
								get_template_part('template-parts/biography', get_post_format());
								get_template_part('template-parts/blog/blog-single-navigation');

								if (comments_open() || get_comments_number()):
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>
						</div>
					</div>

				</div>

				<?php if (is_active_sidebar('blog-sidebar') && $sidebar_off): ?>
					<div class="col-lg-4">
						<div
							class="tp-sidebar-wrapper sidebar__wrapper pl-35 edcare-sidebar-<?php echo esc_attr($sidebar_sytem); ?>">
							<?php get_sidebar(); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php if ($edcare_blog_single_related) {
		get_template_part('template-parts/blog/blog-single-related');
	} ?>

<?php endif; ?>

<?php
get_footer();
