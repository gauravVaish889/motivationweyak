<?php
defined('ABSPATH') || exit;

global $post;
use \Etn\Utils\Helper;
$single_event_id = get_the_id();
$categories = get_the_terms($single_event_id, 'etn_category');
$etn_terms = get_the_terms($single_event_id, 'etn_tags');
$event_options = get_option("etn_event_options");
$data = Helper::single_template_options($single_event_id);

$etn_schedule = get_post_meta(get_the_ID(), 'etn_event_schedule', true);

$location = '';
$loc_arr = $data['etn_event_location'];
if (!empty(is_array($loc_arr) || is_object($loc_arr))):
    foreach ($loc_arr as $key => $loc) {
        if ($key == 'address') {
            $location .= $loc;
        } elseif ($key == 'custom_url') {
            $location .= $loc;
        }
    }
endif;

if ((ETN_DEMO_SITE === false) || (ETN_DEMO_SITE == true && ETN_EVENT_TEMPLATE_TWO_ID != get_the_ID() && ETN_EVENT_TEMPLATE_THREE_ID != get_the_ID())) {
    ?>
    <?php do_action("etn_before_single_event_details", $single_event_id); ?>

    <?php do_action('edcare_etn_breadcrumb'); ?>

    <?php // dump($data); ?>

    <section class="tp-event-details-area pt-80 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tp-event-details-wrapper">
                        <?php the_content(); ?>
                        <?php if( !empty( $etn_schedule ) ) : ?>
                        <div class="tp-event-schedule-wrap mt-50">
                            <?php do_action( 'edcare_event_single_schedule' ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tp-event-details-box">
                        <div class="tp-event-details-details">
                            <?php if (!empty($data['event_start_date'])): ?>
                                <h4 class="tp-event-details-box-title"><?php echo esc_html__('Event Details', 'edcare'); ?></h4>
                                <div class="tp-event-details-list d-flex align-items-center justify-content-between">
                                    <h5><i class="fa-light fa-calendar-days"></i> <?php echo esc_html__('Start Date', 'edcare'); ?></h5>
                                    <span><?php echo esc_html($data['event_start_date']); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['event_start_time'])): ?>
                                <div class="tp-event-details-list d-flex align-items-center justify-content-between">
                                    <h5><i class="fa-regular fa-clock"></i> <?php echo esc_html__('Start Time', 'edcare'); ?></h5>
                                    <span><?php echo esc_html(strtoupper($data['event_start_time'])); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['event_end_date'])): ?>
                                <div class="tp-event-details-list d-flex align-items-center justify-content-between">
                                    <h5><i class="fa-light fa-calendar-days"></i> <?php echo esc_html__('End Date', 'edcare'); ?></h5>
                                    <span><?php echo esc_html($data['event_end_date']); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['event_end_time'])): ?>
                                <div class="tp-event-details-list d-flex align-items-center justify-content-between">
                                    <h5><i class="fa-regular fa-clock"></i> <?php echo esc_html__('End Time', 'edcare'); ?></h5>
                                    <span><?php echo esc_html(strtoupper($data['event_end_time'])); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($location)): ?>
                                <div class="tp-event-details-list d-flex align-items-center justify-content-between">
                                    <h5><i class="fa-regular fa-location-dot"></i> <?php echo esc_html__('Location', 'edcare'); ?></h5>
                                    <span><?php echo esc_html($location); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="tp-event-details-ticket">
                            <?php do_action("etn_after_single_event_meta", $single_event_id); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php do_action("etn_after_single_event_details", $single_event_id); ?>

<?php } ?>