<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

function display_related_portfolios($post_id) {
      // Get the categories of the current post
      $categories = wp_get_post_terms($post_id, 'portfolios-cat', array('fields' => 'ids'));
      
      // Custom query arguments
      $args = array(
          'post_type' => 'tp-portfolios',
          'posts_per_page' => 3, // Number of related posts to display
          'post__not_in' => array($post_id), // Exclude the current post
          'tax_query' => array(
              array(
                  'taxonomy' => 'portfolios-cat',
                  'field'    => 'id',
                  'terms'    => $categories,
              ),
          ),
      );
  
      // Custom query
      $related_posts = new WP_Query($args);
  
      // Check if the custom query has posts
      if ($related_posts->have_posts()) :
          echo '<div class="row">';
          // Loop through the related posts
          while ($related_posts->have_posts()) : $related_posts->the_post();
              // Variables for the current post
              $related_post_id = get_the_ID();
              $title = get_the_title();
              $permalink = get_permalink();
              $thumbnail = get_the_post_thumbnail_url($related_post_id, 'full');
              $category = wp_get_post_terms($related_post_id, 'portfolios-cat', array('fields' => 'names'));
              $category_name = !empty($category) ? $category[0] : '';
  
              echo '<div class="col-lg-4 col-md-6">';
              echo '<div class="tp-project-item p-relative fix mb-30">';
              echo '<div class="tp-project-thumb p-relative fix">';
              echo '<a href="' . esc_url($permalink) . '">';
              echo '<img src="' . esc_url($thumbnail) . '" alt="' . esc_attr($title) . '">';
              echo '</a>';
              echo '</div>';
              echo '<div class="tp-project-item-content p-relative">';
              echo '<span>' . esc_html($category_name) . '</span>';
              echo '<h4 class="tp-project-item-title"><a href="' . esc_url($permalink) . '">' . esc_html($title) . '</a></h4>';
              echo '<div class="tp-project-item-btn">';
              echo '<a href="' . esc_url($permalink) . '">';
              echo '<span>';
              echo '<i class="fa-regular fa-plus"></i>';
              echo '</span>';
              echo '</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
          endwhile;
          echo '</div>';
          wp_reset_postdata();
      else :
          // If no related posts found, display a message or leave empty
          echo '<p>No related projects found.</p>';
      endif;
  }

?>
<section class="tp-portfolio-details-area pt-120 pb-90">
    <div class="container">
        <div class="row">
            <?php
            if( have_posts() ):
            while( have_posts() ): the_post(); 

            global $post;

            $categories = get_the_terms( $post->ID, 'portfolios-cat' );

            ?>
            <div class="col-lg-12">
                  <div class="tp-portfolio-details-wrapper">

                        <?php the_content(); ?>
                        
                        <div class="tp-portfolio-details-wrap-box mt-30">
                              <div class="tp-portfolio-details-share-area d-flex justify-content-between">

                                    <?php if(!empty($categories)) : ?>
                                    <div class="tp-portfolio-details-btn">
                                          <?php
                                          foreach($categories as $cat){
                                                echo '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name.'</a>';
                                          }
                                          ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(function_exists('ishpat_portfolio_social_share')) : ishpat_portfolio_social_share(); endif; ?>
                              </div>

                              <?php
                              $prev_post = get_previous_post();
                              $next_post = get_next_post();
                              ?>

                              <div class="tp-portfolio-details-np-area d-flex justify-content-between">
                                    
                                    <?php if ( get_previous_post_link() ): ?>
                                    <div class="tp-portfolio-details-prev">
                                          <p><a href="<?php echo get_the_permalink($prev_post); ?>"><i class="fa-solid fa-arrow-left"></i> <?php echo esc_html__( 'Previous', 'ishpat' );?></a></p>
                                          <h5 class="tp-portfolio-details-prev-title"><?php echo get_the_title($prev_post);?></h5>
                                    </div>
                                    <?php else : ?>
                                    <div class="tp-portfolio-details-prev">
                                          <h5 class="tp-portfolio-details-prev-title"><?php echo esc_html__( 'No Posts Found', 'ishpat' );?></h5>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ( get_next_post_link() ): ?>
                                    <div class="tp-portfolio-details-prev text-end">
                                          <p><a href="<?php echo get_the_permalink($next_post); ?>"> <?php print esc_html__( 'Next', 'ishpat' );?> <i class="fa-solid fa-arrow-right"></i></a></p>
                                          <h5 class="tp-portfolio-details-prev-title"><?php echo get_the_title($next_post);?></h5>
                                    </div>
                                    <?php else : ?>
                                    <div class="tp-portfolio-details-prev text-end">
                                          <h5 class="tp-portfolio-details-prev-title"><?php echo esc_html__( 'No Posts Found', 'ishpat' );?></h5>
                                    </div>
                                    <?php endif; ?>
                              </div>

                        </div>
                  </div>
            </div>
            <div class="col-lg-12">
                  <div class="tp-portfolio-title-details mb-50">
                        <h3 class="tp-portfolio-details-title-2"><?php print esc_html__( 'Our related projects', 'ishpat' );?></h3>
                  </div>
                  <?php display_related_portfolios(get_the_ID()); ?>
            </div>
            
            <?php
            endwhile; wp_reset_query();
            endif;
            ?>
        </div>
    </div>
</section>




<?php get_footer();  ?>