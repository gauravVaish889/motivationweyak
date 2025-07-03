<?php
/**
 * Display single login
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ) {
	// Redirect to wp native login page.
	header( 'Location: ' . wp_login_url( tutor_utils()->get_current_url() ) );
	exit;
}

tutor_utils()->tutor_custom_header();
$login_url = tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ? '' : wp_login_url( tutor()->current_url );
?>

<?php
//phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
do_action( 'tutor/template/login/before/wrap' );
?>
<div <?php tutor_post_class( 'tutor-page-wrap' ); ?>>
	<div class="tutor-template-segment tutor-login-wrap">

		<div class="tutor-login-form-wrapper">

			<div class="tp-login-from-heading text-center mb-30">
				<h4 class="tp-login-from-title"><?php esc_html_e( 'Hi, Welcome back!', 'edcare' ); ?></h4>
				<?php if ( get_option( 'users_can_register', false ) ) : ?>
				<?php
					$url_arg = array(
						'redirect_to' => tutor()->current_url,
					);
					if ( is_single_course() ) {
						$url_arg['enrol_course_id'] = get_the_ID();
					}
				?>
				<p><?php esc_html_e( 'Don\'t have an account?', 'edcare' ); ?> <a href="<?php echo esc_url( add_query_arg( $url_arg, tutor_utils()->student_register_url() ) ); ?>"> <?php esc_html_e( 'Register Now', 'edcare' ); ?></a></p>
				<?php endif; ?>

			</div>
			<?php
				// load form template.
				
				tutor_load_template_from_custom_path( get_template_directory(). '/tutor/login-form.php', false );
				?>
		</div>
		<?php do_action( 'tutor_after_login_form_wrapper' ); ?>
	</div>
</div>
<?php
	//phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
	do_action( 'tutor/template/login/after/wrap' );
	tutor_utils()->tutor_custom_footer();
?>
