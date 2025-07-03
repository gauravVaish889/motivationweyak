<?php

use \Etn\Utils\Helper;

function edcare_etn_breadcrumb_callback()
{
    global $post;
    $single_event_id = get_the_id();
    $categories = get_the_terms($single_event_id, 'etn_category');
    $etn_terms = get_the_terms($single_event_id, 'etn_tags');
    $event_options = get_option("etn_event_options");
    $data = Helper::single_template_options($single_event_id);

    $start_time = $data['event_start_time'];
    $start_time = DateTime::createFromFormat('g:i A', $start_time);
    $start_time = $start_time->format('H:i:s');

    $edcare_start_date = $data['event_start_date'];
    $edcare_start_date = DateTime::createFromFormat('F j, Y', $edcare_start_date);
    $current_date = $current_date = date('F j, Y');
    $current_date = DateTime::createFromFormat('F j, Y', $current_date);

    $categories = get_the_terms(get_the_ID(), 'etn_category');
    $start_date = $data['event_start_date'];

    if ($start_date) {
        $start_date = DateTime::createFromFormat('F j, Y', $start_date);
        $start_date = $start_date ? $start_date->format('F d Y ' . $start_time) : '';
    }
    ?>
    <section class="tp-event-details-breadcrumb-area pt-110 pb-110 p-relative z-index-1 fix edcare-bg-blue"
        data-background="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-7">

                    <div class="tp-event-details-breadcrumb-content">
                        <?php if (!empty($categories[0]->name)): ?>
                            <span
                                class="tp-event-details-breadcrumb-subtitle"><?php echo esc_html($categories[0]->name); ?></span>
                        <?php endif; ?>
                        <h4 class="tp-event-details-breadcrumb-title"><?php echo get_the_title(); ?></h4>
                        <?php if ($edcare_start_date < $current_date): ?>
                            <span class="alert alert-danger"
                                role="alert"><?php echo esc_html__('Event Expired', 'edcare'); ?></span>
                        <?php else: ?>
                            <div class="tp-event-details-countdown" data-date="<?php echo esc_attr($start_date); ?>">
                                <div class="tp-event-details-countdown-inner">
                                    <div id="countdown">
                                        <ul>
                                            <li><span id="days"></span><?php echo esc_html__('Days', 'edcare'); ?></li>
                                            <li><span id="hours"></span><?php echo esc_html__('Hours', 'edcare'); ?></li>
                                            <li><span id="minutes"></span><?php echo esc_html__('Minutes', 'edcare'); ?></li>
                                            <li><span id="seconds"></span><?php echo esc_html__('Seconds', 'edcare'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

add_action('edcare_etn_breadcrumb', 'edcare_etn_breadcrumb_callback');