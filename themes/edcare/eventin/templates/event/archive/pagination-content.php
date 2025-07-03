<?php
defined('ABSPATH') || die();

?>
<div class="etn-row etn-justify-content-center mt-20 etn-pagination-wrapper tp-pagination">
    <?php do_action('etn_before_event_archive_pagination_content'); ?>
    <?php
    edcare_pagination(
        '<i class="fa-regular fa-arrow-left icon"></i>',
        '<i class="fa-regular fa-arrow-right icon"></i>',
        '',
        ['class' => '']
    );
    ?>
    <?php do_action('etn_after_event_archive_pagination_content'); ?>
</div>