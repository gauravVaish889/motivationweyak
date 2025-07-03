<?php

defined('ABSPATH') || die();

$etn_start_date = get_post_meta(get_the_ID(), 'etn_start_date', true);

?>
<div class="etn-event-footer">

	<?php do_action('etn_before_event_archive_footer_content'); ?>
	<div class="etn-event-date"></div>
	<?php do_action('etn_after_event_archive_footer_content'); ?>
</div>