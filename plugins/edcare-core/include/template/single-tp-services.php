<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$blog_column = is_active_sidebar( 'services-sidebar' ) ? 'col-lg-8' : 'col-lg-12';

?>

<section class="tp-service-detils-area pt-120 pb-70">
    <div class="container">
        <?php
            if( have_posts() ):
            while( have_posts() ): the_post(); 
         ?>
        <div class="row">
            <?php
            if(is_active_sidebar( 'services-sidebar' )) :
            ?>
            <div class="col-lg-4">
                <div class="tp-service-details-wrapper-left">
                    <?php dynamic_sidebar( 'services-sidebar' ); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr($blog_column); ?>">
                <div class="tp-service-details-wrapper">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <?php
            endwhile; wp_reset_query();
            endif;
         ?>
    </div>
</section>

<?php get_footer();  ?>