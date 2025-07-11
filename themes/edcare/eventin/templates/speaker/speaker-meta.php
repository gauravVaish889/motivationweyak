<?php
defined('ABSPATH') || exit;

$etn_speaker_website_link = get_post_meta(get_the_id(), 'etn_speaker_url', true);
$etn_speaker_website_email = get_post_meta(get_the_id(), 'etn_speaker_website_email', true);
?>
<ul class="etn-speaker-details-meta">
    <?php
    if (!empty($etn_speaker_website_link)) {
        ?>
        <li>
            <a href="<?php echo esc_url($etn_speaker_website_link); ?>" target="_blank" rel="noopener">
                <i class="etn-icon etn-link"></i>
                <?php echo esc_html($etn_speaker_website_link); ?>
            </a>
        </li>
    <?php
    }
    ?>

    <?php if (!empty($etn_speaker_website_email)) { ?>
        <li>
            <a href="mailto:<?php echo esc_attr($etn_speaker_website_email); ?>">
                <i class="etn-icon etn-envelope"></i>
                <?php echo esc_html($etn_speaker_website_email); ?>
            </a>
        </li>
    <?php } ?>
</ul>