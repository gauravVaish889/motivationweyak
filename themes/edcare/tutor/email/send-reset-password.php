<?php
/**
 * Send reset password template
 *
 * @package Tutor\Templates
 * @subpackage Email
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

defined( 'ABSPATH' ) || exit;
?>


<p>
	<?php
		/* translators: %s: user login */
		printf( esc_html__( 'Hi %s,', 'edcare' ), esc_html( $user_login ) );
	?>
</p>

<p>
	<?php
		/* translators: %s: site name */
		printf( esc_html__( 'Someone has requested a new password for the following account on %s:', 'edcare' ), esc_html( wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ) ) );
	?>
</p>

<p>
<?php
	/* translators: %s: user login */
	printf( esc_html__( 'Username: %s', 'edcare' ), esc_html( $user_login ) );
?>
</p>
<p>
	<?php esc_html_e( 'If you didn\'t make this request, just ignore this email. If you\'d like to proceed:', 'edcare' ); ?>
</p>
<p>
	<a class="link" href="<?php echo add_query_arg( array( 'reset_key' => $reset_key, 'user_id' => $user_id ), tutor_utils()->tutor_dashboard_url('retrieve-password') ); ?>"><?php // phpcs:ignore ?>
		<?php esc_html_e( 'Click here to reset your password', 'edcare' ); ?>
	</a>
</p>
<p><?php esc_html_e( 'Thanks for reading.', 'edcare' ); ?></p>
