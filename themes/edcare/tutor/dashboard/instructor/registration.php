<?php
/**
 * Registration template
 *
 * @package Tutor\Templates
 * @subpackage Dashboard\Instructor
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

?>

<?php if (!get_option('users_can_register', false)): ?>

	<?php
	$args = array(
		'image_path' => tutor()->url . 'assets/images/construction.png',
		'title' => __('Oooh! Access Denied', 'edcare'),
		'description' => __('You do not have access to this area of the application. Please refer to your system  administrator.', 'edcare'),
		'button' => array(
			'text' => __('Go to Home', 'edcare'),
			'url' => get_home_url(),
			'class' => 'tutor-btn',
		),
	);
	tutor_load_template('feature_disabled', $args);
	?>

<?php else: ?>

	<div id="tutor-registration-wrap">

		<?php do_action('tutor_before_instructor_reg_form'); ?>

		<form method="post" enctype="multipart/form-data" id="tutor-registration-form">

			<?php do_action('tutor_instructor_reg_form_start'); ?>

			<?php wp_nonce_field(tutor()->nonce_action, tutor()->nonce); ?>
			<input type="hidden" value="tutor_register_instructor" name="tutor_action" />

			<?php
			$errors = apply_filters('tutor_instructor_register_validation_errors', array());//phpcs:ignore
			if (is_array($errors) && count($errors)) {
				echo '<div class="tutor-alert tutor-warning"><ul class="tutor-required-fields">';
				foreach ($errors as $error_key => $error_value) {
					echo wp_kses("<li>{$error_value}</li>", array('li' => array()));
				}
				echo '</ul></div>';
			}
			?>

			<div class="row">
				<div class="col-md-6">
					<div class="tutor-form-group">
						<label>
							<?php esc_html_e('First Name', 'edcare'); ?>
						</label>

						<input type="text" name="first_name"
							value="<?php echo esc_attr(tutor_utils()->input_old('first_name')); ?>"
							placeholder="<?php esc_attr_e('First Name', 'edcare'); ?>" required autocomplete="given-name">
					</div>
				</div>

				<div class="col-md-6">
					<div class="tutor-form-group">
						<label>
							<?php esc_html_e('Last Name', 'edcare'); ?>
						</label>

						<input type="text" name="last_name"
							value="<?php echo esc_attr(tutor_utils()->input_old('last_name')); ?>"
							placeholder="<?php esc_attr_e('Last Name', 'edcare'); ?>" required autocomplete="family-name">
					</div>
				</div>

			</div>

			<div class="tutor-form-row">

				<div class="tutor-form-col-6">
					<div class="tutor-form-group">
						<label>
							<?php esc_html_e('User Name', 'edcare'); ?>
						</label>

						<input type="text" name="user_login" class="tutor_user_name"
							value="<?php echo esc_attr(tutor_utils()->input_old('user_login')); ?>"
							placeholder="<?php esc_attr_e('User Name', 'edcare'); ?>" required autocomplete="username">
					</div>
				</div>

				<div class="tutor-form-col-6">
					<div class="tutor-form-group">
						<label>
							<?php esc_html_e('E-Mail', 'edcare'); ?>
						</label>

						<input type="text" name="email"
							value="<?php echo esc_attr(tutor_utils()->input_old('email')); ?>"
							placeholder="<?php esc_attr_e('E-Mail', 'edcare'); ?>" required autocomplete="email">
					</div>
				</div>

			</div>

			<div class="tutor-form-row">
				<div class="tutor-form-col-6">
					<div class="tutor-form-group">
						<div class="tutor-password-strength-checker">
							<div class="tutor-password-field">
								<label>
									<?php esc_html_e('Password', 'edcare'); ?>
								</label>

								<input class="password-checker" id="tutor-new-password" type="password" name="password"
									value="<?php echo esc_attr(tutor_utils()->input_old('password')); ?>"
									placeholder="<?php esc_attr_e('Password', 'edcare'); ?>" required
									autocomplete="new-password">
								<span class="show-hide-btn"></span>
							</div>
							<div class="tutor-password-strength-hint">
								<div class="indicator">
									<span class="weak"></span>
									<span class="medium"></span>
									<span class="strong"></span>
								</div>
								<div class="text tutor-fs-7 tutor-color-muted"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="tutor-form-col-6">
					<div class="tutor-form-group">
						<label>
							<?php esc_html_e('Password confirmation', 'edcare'); ?>
						</label>

						<div class="tutor-form-wrap">
							<span
								class="tutor-validation-icon tutor-icon-mark tutor-color-success tutor-form-icon tutor-form-icon-reverse"
								style="display: none;"></span>
							<input type="password" name="password_confirmation"
								value="<?php echo esc_attr(tutor_utils()->input_old('password_confirmation')); ?>"
								placeholder="<?php esc_attr_e('Password Confirmation', 'edcare'); ?>" required
								autocomplete="new-password" style="margin-bottom: 0;">
						</div>
					</div>
				</div>
			</div>

			<div class="tutor-form-row">
				<div class="tutor-form-col-12">
					<div class="tutor-form-group">
						<?php
						// Providing register_form hook.
						do_action('tutor_instructor_reg_form_middle');
						do_action('register_form');
						?>
					</div>
				</div>
			</div>

			<?php do_action('tutor_instructor_reg_form_end'); ?>

			<?php
			$tutor_toc_page_link = tutor_utils()->get_toc_page_link();
			?>

			<?php if (null !== $tutor_toc_page_link): ?>
				<div class="tutor-mb-24">
					<?php esc_html_e('By signing up, I agree with the website\'s', 'edcare'); ?> <a target="_blank"
						href="<?php echo esc_url($tutor_toc_page_link); ?>"
						title="<?php esc_attr_e('Terms and Conditions', 'edcare'); ?>"><?php esc_html_e('Terms and Conditions', 'edcare'); ?></a>
				</div>
			<?php endif; ?>

			<div>
				<button type="submit" name="tutor_register_instructor_btn" value="register"
					class="tutor-btn tutor-btn-primary tutor-btn-block"><?php esc_html_e('Register as instructor', 'edcare'); ?></button>
			</div>
			<?php do_action('tutor_after_register_button'); ?>

		</form>
		<?php do_action('tutor_after_registration_form_wrap'); ?>
	</div>

	<?php do_action('tutor_after_instructor_reg_form'); ?>
<?php endif; ?>