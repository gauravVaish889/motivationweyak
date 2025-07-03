<?php
defined( 'ABSPATH' ) || exit;
use Etn\Utils\Helper as helper;

//include the template functions
\Etn\Utils\Helper::etn_template_include();
?>

<?php do_action( 'etn_before_event_archive_container' ); ?>

<div class="tp-event-inner-area tp-event-inner-p pt-100 pb-100">

    <div class="etn-advanced-search-form d-none">
        <div class="etn-container">
            <?php helper::get_event_search_form(); ?>
            <div class="etn-loader"></div>
        </div>
    </div>


    <div class="etn-event-archive-wrap etn_search_item_container " data-json='<?php echo json_encode([
            "error_content" => [
                "title" => esc_html__('Nothing found!', 'edcare'),
                "exerpt" => esc_html__('It looks like nothing was found here. Maybe try a search?','edcare')
            ]
        ]); ?>'>
        <div class="container">
            <div class="row etn-event-wrapper ">

                <?php do_action( 'etn_before_event_archive_item' ); ?>
                <?php

                if ( is_search( ) || is_main_query( ) ) {

                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();


                        // Set up custom query parameters
                        $paged      = get_query_var('paged') ? get_query_var('paged') : 1;
                        $per_page   = intval( etn_get_option('events_per_page') );
                        $per_page   = !empty( $per_page ) ?  $per_page : 10;
                        $args = array(
                            'post_type'      => 'etn',
                            'posts_per_page' => $per_page,
                            'paged'          => $paged,
                        );

                        $etn_event_location = get_post_meta(get_the_ID(), 'etn_event_location', true);
                        $location = \Etn\Core\Event\Helper::instance()->display_event_location(get_the_ID());
                        $etn_schedule = get_post_meta(get_the_ID(), 'etn_event_schedule', true);
                        $etn_start_date = get_post_meta(get_the_ID(), 'etn_start_date', true);

                        $etn_start_time = get_post_meta(get_the_ID(), 'etn_start_time', true);
                        $etn_end_time = get_post_meta(get_the_ID(), 'etn_end_time', true);

                        $etn_schedule_arr = [];

                        $title_count = get_theme_mod('edcare_event_title_count', '3');
                        $title_count = intval($title_count);

                        $edcare_event_description_switch = get_theme_mod('edcare_event_description_switch', false);

                        foreach ($etn_schedule as $key => $single_schedule) {

                            $etn_schedule_arr[] = $single_schedule;

                        }

                        $etn_speakers_arr = [];

                        foreach ($etn_schedule_arr as $key => $etn_speaker) {
                            $etn_schedule_topics = get_post_meta($etn_speaker, 'etn_schedule_topics', true);

                            $etn_schedule_speakers = $etn_schedule_topics[0]['speakers'];


                            foreach ($etn_schedule_speakers as $speaker) {
                                $etn_speakers_arr[] = $speaker;
                            }

                        }
                        $etn_speakers_arr = array_unique($etn_speakers_arr);

                        ?>
                        <div class="etn-col-md-6 etn-col-lg-<?php echo esc_attr( apply_filters( 'etn_event_archive_column', '4' ) ); ?>">

                            <div class="event-item wow fade-in-bottom mb-30" data-wow-delay="400ms">
                                <?php do_action( 'etn_before_event_archive_content', get_the_ID(  ) ); ?>

                                <!-- content start-->
                                <div class="event-content">

                                    <span class="time">
                                        <i class="fa-regular fa-clock"></i>
                                        <?php echo $etn_start_time ; ?> - <?php echo $etn_end_time ; ?>
                                    </span>

                                    <h3 class="title">
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                            <?php
                                            $title = get_the_title(get_the_ID());
                                            echo esc_html(wp_trim_words($title, $title_count, ''));
                                            ?>
                                        </a>
                                    </h3>

                                    <?php if ($edcare_event_description_switch): ?>
                                        <p class="mb-15">
                                            <?php echo apply_filters('etn_event_archive_content', wp_trim_words(get_the_excerpt(), 15, '')); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($location)): ?>
                                    <div class="location">
                                        <span>
                                            <i class="fa-regular fa-location-dot"></i>
                                            <?php echo esc_html($location); ?>
                                        </span>
                                    </div>
                                    <?php endif; ?>

                                    <a href="<?php echo esc_url(get_the_permalink(get_the_ID())); ?>" class="ed-primary-btn">
                                        <?php echo esc_html__('View Details', "edcare") ?>
                                    </a>
                                </div>
                                 <!-- content End-->

                                <?php do_action( 'etn_after_event_archive_content', get_the_ID(  ) ); ?>
                            </div>
                            <!-- etn event item end-->
                        </div>
                    <?php
                    }

                } else {
                    status_header( 404 );
                    include_once  ETN_PLUGIN_TEMPLATE_DIR . 'etn-404.php';
                    ?>
                        <p><?php echo esc_html__('No Event found!', 'edcare'); ?></p>
                    <?php
                }
                wp_reset_postdata();
            }else if( is_archive() ) {

                $query = new WP_Query( $args );
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $etn_event_location = get_post_meta(get_the_ID(), 'etn_event_location', true);
                        $location = \Etn\Core\Event\Helper::instance()->display_event_location(get_the_ID());
                        $etn_schedule = get_post_meta(get_the_ID(), 'etn_event_schedule', true);
                        $etn_start_date = get_post_meta(get_the_ID(), 'etn_start_date', true);

                        $etn_start_time = get_post_meta(get_the_ID(), 'etn_start_time', true);
                        $etn_end_time = get_post_meta(get_the_ID(), 'etn_end_time', true);

                        $etn_schedule_arr = [];

                        $title_count = get_theme_mod('edcare_event_title_count', '3');
                        // Ensure it's an integer
                        $title_count = intval($title_count);

                        $edcare_event_description_switch = get_theme_mod('edcare_event_description_switch', false);

                        foreach ($etn_schedule as $key => $single_schedule) {

                            $etn_schedule_arr[] = $single_schedule;

                        }

                        $etn_speakers_arr = [];

                        foreach ($etn_schedule_arr as $key => $etn_speaker) {
                            $etn_schedule_topics = get_post_meta($etn_speaker, 'etn_schedule_topics', true);

                            $etn_schedule_speakers = $etn_schedule_topics[0]['speakers'];

                            foreach ($etn_schedule_speakers as $speaker) {
                                $etn_speakers_arr[] = $speaker;
                            }

                        }
                        $etn_speakers_arr = array_unique($etn_speakers_arr);

                        ?>
                        <div class="etn-col-md-6 etn-col-lg-<?php echo esc_attr( apply_filters( 'etn_event_archive_column', '4' ) ); ?>">

                            <div class="event-item wow fade-in-bottom mb-30" data-wow-delay="400ms">

                                <?php do_action( 'etn_before_event_archive_content', get_the_ID(  ) ); ?>

                                <!-- content start-->
                                <div class="event-content">

                                    <span class="time">
                                        <i class="fa-regular fa-clock"></i>
                                        <?php echo $etn_start_time ; ?> - <?php echo $etn_end_time ; ?>
                                    </span>

                                    <h3 class="title">
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                            <?php
                                            $title = get_the_title(get_the_ID());
                                            echo esc_html(wp_trim_words($title, $title_count, ''));
                                            ?>
                                        </a>
                                    </h3>

                                    <?php if ($edcare_event_description_switch): ?>
                                        <p class="mb-15">
                                            <?php echo apply_filters('etn_event_archive_content', wp_trim_words(get_the_excerpt(), 15, '')); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($location)): ?>
                                    <div class="location">
                                        <span>
                                            <i class="fa-regular fa-location-dot"></i>
                                            <?php echo esc_html($location); ?>
                                        </span>
                                    </div>
                                    <?php endif; ?>

                                    <a href="<?php echo esc_url(get_the_permalink(get_the_ID())); ?>" class="ed-primary-btn">
                                        <?php echo esc_html__('View Details', "edcare") ?>
                                    </a>
                                </div>
                                 <!-- content End-->

                                <?php do_action( 'etn_after_event_archive_content', get_the_ID(  ) ); ?>

                            </div>
                            <!-- etn event item end-->
                        </div>
                    <?php

                    }
                } else {
                    status_header( 404 );
                    include_once  ETN_PLUGIN_TEMPLATE_DIR . 'etn-404.php';
                }
                // Restore original Post Data
                wp_reset_postdata();
            }
                ?>
                <?php do_action( 'etn_after_event_archive_item' ); ?>

            </div>

            <?php
            if( isset( $query ) && !empty( $query )  ) {
                do_action( 'etn_event_archive_pagination', $query );
            }else{
                do_action( 'etn_event_archive_pagination' );
            }
            ?>

        </div>
    </div>

</div>
    <?php do_action( 'etn_after_event_archive_container' ); ?>
