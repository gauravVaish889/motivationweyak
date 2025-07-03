<?php

defined('ABSPATH') || die();
// $edcare_start_date = get_post_meta(get_the_ID(), 'etn_start_date', true);
// $edcare_start_date = date('j M', strtotime(get_post_meta(get_the_ID(), 'etn_start_date', true)));


$edcare_start_date = get_post_meta(get_the_ID(), 'etn_start_date', true);
$day = date('j', strtotime($edcare_start_date)); // Day without leading zeros
$month = date('M', strtotime($edcare_start_date)); // Three-letter month

$current_date = $current_date = date('F j, Y');
$edcare_start_timestamp = strtotime($edcare_start_date);
$current_timestamp = strtotime($current_date);

if (has_post_thumbnail()) {
    ?>
    <!-- thumbnail -->
    <div class="event-thumb">

        <?php do_action( 'etn_before_event_archive_thumbnail' ); ?>

        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
            <?php if( $edcare_start_timestamp < $current_timestamp ) : ?>
            <span class="edcare_archive_event_expired"><?php echo esc_html__('Expired!', 'edcare'); ?></span>
            <?php endif; ?>
        </a>
        <div class="date-wrap">
            <h5 class="date">
                <?php
                echo  $day ; // Day on the first line
                echo '<span>' . $month . '</span>';    // Month on the second line
                ; ?>
            </h5>
        </div>
        <?php do_action( 'etn_after_event_archive_thumbnail' ); ?>
    </div>
    <?php
}