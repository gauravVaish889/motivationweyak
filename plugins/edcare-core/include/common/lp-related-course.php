<?php

function get_related_courses( $post_id, $limit = 3 ) {
    $terms = wp_get_post_terms( $post_id, 'course_category' );
    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return;
    }

    $term_ids = wp_list_pluck( $terms, 'term_id' );

    $related_args = array(
        'post_type' => 'lp_course',
        'posts_per_page' => $limit,
        'post__not_in' => array( $post_id ), // Exclude current post
        'tax_query' => array(
            array(
                'taxonomy' => 'course_category',
                'field'    => 'term_id',
                'terms'    => $term_ids,
            ),
        ),
    );

    $related_courses = new WP_Query( $related_args );

    if ( $related_courses->have_posts() ) : ?>
        <div class="row">
            <?php 
            while ( $related_courses->have_posts() ) : $related_courses->the_post(); 
            $course          = LP_Global::course();
            $instructor      = $course->get_instructor();
            $instructor_link = $course->get_instructor_html();
            $instructor_id   = $course->get_id();
            $categories = get_the_terms($course->get_id(), 'course_category');

            $dir = learn_press_user_profile_picture_upload_dir();
            $user = get_user_by( 'id', $instructor->get_id());
            $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
            $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
            $profile_link =  $base_url.'/'.$pro_link;

            if(!empty($course->get_origin_price())) {
                $old_price = $course->get_origin_price();
            }
            if(!empty($course->get_price())) {
                $new_price = $course->get_price();
            }

            if( !empty( $course->get_origin_price() && $course->get_price() ) && true != $course->is_free() ) {
                $discount_percentage = (($old_price - $new_price) / $old_price) * 100;
                $discount_percentage = round($discount_percentage, 2);
            }
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="tp-course-item p-relative fix mb-30">
                    <?php if($pro_link !='') : ?>
                    <div class="tp-course-teacher mb-15">
                        <span><img src="<?php echo esc_url($profile_link); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                        <?php echo wp_kses_post($instructor_link) ?></span>
                        <?php if( !empty( $discount_percentage ) ) : ?>
                        <span class="discount">-<?php echo esc_html( $discount_percentage . '%' ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php else : ?>
                    <div class="tp-course-teacher mb-15">
                        <span><img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                        <?php echo wp_kses_post($instructor_link) ?></span>
                        <?php if( !empty( $discount_percentage ) && $course->is_free() != 'free' ) : ?>
                        <span class="discount">-<?php echo esc_html( $discount_percentage . '%' ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if( has_post_thumbnail() ) : ?>
                    <div class="tp-course-thumb sidebar">
                        <a href="<?php the_permalink()?>"><img class="course-pink" src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php echo esc_attr__( 'course-thumb', 'acadia' );  ?>"></a>
                    </div>
                    <?php endif; ?>
                    <div class="tp-course-content">
                        <?php if( !empty( $categories[0]->name ) ) : ?>
                        <div class="tp-course-tag mb-10">
                            <span><?php echo esc_html( $categories[0]->name ); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tp-course-meta">
                            <span>
                                <span>
                                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z"
                                            stroke="#94928E" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.46118 2.81787V12.4506" stroke="#94928E"
                                            stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <?php   
                                    $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0; 
                                    echo esc_html($lessons). esc_html__(' lessons','epora'); 
                                ?>
                            </span>
                            <span>
                                <span>
                                    <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z"
                                            stroke="#94928E" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14"
                                            stroke="#94928E" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <?php 
                                $student = _n('%s  Student', '%s Students', $course->get_users_enrolled(), 'epora');
                                echo sprintf($student, $course->get_users_enrolled());
                                ?> 
                            </span>
                        </div>
                        <h4 class="tp-course-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        <div class="tp-course-rating d-flex align-items-end justify-content-between">

                            <?php 
                            if( function_exists( 'learn_press_get_course_rate' ) ) {
                            $course_rate_res = learn_press_get_course_rate( get_the_ID(), false );
                            $rated = $course_rate_res['rated'] ?? 0;
                            ?>
                            <div class="tp-course-rating-star">
                                <p><?php echo esc_html( $rated ); ?><span><?php echo esc_html__( '/5', 'acadia' ); ?></span></p>
                                <?php
                                LP_Addon_Course_Review_Preload::$addon->get_template(
                                    'rating-stars.php',
                                    array( 'rated' => $course_rate_res['rated'] )
                                );
                                ?>
                            </div>
                            <?php } ?>
                            
                            <div class="tp-course-pricing">
                                <?php if($course->is_free()): ?>
                                <span><?php echo esc_html__('Free','epora'); ?></span>
                                <?php else: ?>
                                <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                                <span class='d-block'><del><?php echo esc_html($course->get_origin_price_html()); ?></del></span>
                                <?php endif; ?>
                                <span><?php echo esc_html($course->get_price_html()); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tp-course-btn">
                        <a href="<?php the_permalink()?>"><?php echo esc_html__( 'Preview this course', 'acadia' ); ?></a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php
        wp_reset_postdata();
    else:
        echo '<div class="alert alert-danger" role="alert">No Course Found!</div>';
    endif;
}
