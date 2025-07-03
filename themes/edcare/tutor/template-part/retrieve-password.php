<?php
/**
 * Password retrieve template
 *
 * @package Tutor\Templates
 * @subpackage Template_Part
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

defined( 'ABSPATH' ) || exit;

use TUTOR\Input;

if ( Input::get( 'reset_key' ) && Input::get( 'user_id' ) ) {
	tutor_load_template( 'template-part.form-retrieve-password' );
} else {
	do_action( 'tutor_before_retrieve_password_form' );
	?>

	<div class="tp-login-input-form">
		<form method="post" class="tutor-forgot-password-form tutor-login-wrap tutor-ResetPassword lost_reset_password">
			<div class="px-4">
				<?php
					tutor_alert( null, 'any' );
					tutor_nonce_field();
				?>
		
				<input type="hidden" name="tutor_action" value="tutor_retrieve_password">
				<p><?php echo apply_filters( 'tutor_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'edcare' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
		
		
				<div class="tp-login-input p-relative">
					<label><?php esc_html_e( 'Username or email', 'edcare' ); ?></label>
					<input type="text" name="user_login" id="user_login" autocomplete="username">
				</div>
		
				<div class="clear"></div>
		
				<?php do_action( 'tutor_lostpassword_form' ); ?>
		
				<div class="tutor-form-row">
					<div class="tutor-form-col-12">
						<div class="tutor-form-group">
							<button type="submit" class="tp-btn-inner " value="<?php esc_attr_e( 'Reset password', 'edcare' ); ?>">
								<?php esc_html_e( 'Reset password', 'edcare' ); ?>
							</button>
						</div>
					</div>
				</div>
			</div>
	
		</form>
	</div>

	<?php
	do_action( 'tutor_after_retrieve_password_form' );
}
