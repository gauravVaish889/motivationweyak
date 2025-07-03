<?php
/**
 * Frontend Settings Page
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @version 1.4.3
 */

?>

<div class="tp-dashboard-tab mb-25">
	<h2 class="tp-dashboard-tab-title"><?php esc_html_e( 'Settings', 'edcare' ); ?></h2>
	<div class="tp-dashboard-tab-list">
		<?php tutor_load_template( 'dashboard.settings.nav-bar', array( 'active_setting_nav' => 'profile' ) ); ?>
	</div>
</div>

<?php
if ( isset( $GLOBALS['tutor_setting_nav']['profile'] ) ) {
	tutor_load_template( 'dashboard.settings.profile' );
} else {
	foreach ( $GLOBALS['tutor_setting_nav'] as $page ) {
		echo '<script>window.location.replace("', esc_url( $page['url'] ), '");</script>';
		break;
	}
}
?>
