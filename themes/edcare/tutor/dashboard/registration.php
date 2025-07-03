<?php
/**
 * Tutor registration template
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
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

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="tp-login-input-form edcare-form-wrapper">
					<?php do_action('tutor_before_student_reg_form'); ?>

					<form method="post" enctype="multipart/form-data" id="tutor-registration-form">
						<input type="hidden" name="tutor_course_enroll_attempt"
							value="<?php echo isset($_GET['enrol_course_id']) ? (int) $_GET['enrol_course_id'] : ''; ?>">
						<?php do_action('tutor_student_reg_form_start'); ?>

						<?php wp_nonce_field(tutor()->nonce_action, tutor()->nonce); ?>
						<input type="hidden" value="tutor_register_student" name="tutor_action" />

						<?php
						$validation_errors = apply_filters('tutor_student_register_validation_errors', array());
						if (is_array($validation_errors) && count($validation_errors)):
							?>
							<div class="tutor-alert tutor-warning tutor-mb-12">
								<ul class="tutor-required-fields">
									<?php foreach ($validation_errors as $validation_error): ?>
										<li>
											<?php echo esc_html($validation_error); ?>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>

						<div class="row">
							<div class="col-md-6">
								<div class="tp-login-input p-relative">
									<label><?php esc_html_e('First Name', 'edcare'); ?></label>
									<input type="text" name="first_name"
										value="<?php echo esc_attr(tutor_utils()->input_old('first_name')); ?>"
										placeholder="<?php esc_attr_e('First Name', 'edcare'); ?>" required
										autocomplete="given-name">
								</div>
							</div>

							<div class="col-md-6">
								<div class="tp-login-input p-relative">
									<label><?php esc_html_e('Last Name', 'edcare'); ?></label>
									<input type="text" name="last_name"
										value="<?php echo esc_attr(tutor_utils()->input_old('last_name')); ?>"
										placeholder="<?php esc_attr_e('Last Name', 'edcare'); ?>" required
										autocomplete="family-name">
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="tp-login-input p-relative">
									<label><?php esc_html_e('User Name', 'edcare'); ?></label>
									<input type="text" name="user_login" class="tutor_user_name"
										value="<?php echo esc_attr(tutor_utils()->input_old('user_login')); ?>"
										placeholder="<?php esc_attr_e('User Name', 'edcare'); ?>" required
										autocomplete="username">
								</div>
							</div>

							<div class="col-md-6">
								<div class="tp-login-input p-relative">
									<label><?php esc_html_e('E-Mail', 'edcare'); ?></label>
									<input type="text" name="email"
										value="<?php echo esc_attr(tutor_utils()->input_old('email')); ?>"
										placeholder="<?php esc_attr_e('E-Mail', 'edcare'); ?>" required
										autocomplete="email">
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="tp-login-input p-relative">
									<div class="tutor-password-strength-checker">
										<div class="tutor-password-field">
											<label><?php esc_html_e('Password', 'edcare'); ?></label>
											<input class="password-checker" id="tutor-new-password" type="password"
												name="password"
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

							<div class="col-md-12">
								<div class="tp-login-input p-relative">
									<label><?php esc_html_e('Password confirmation', 'edcare'); ?></label>
									<input type="password" name="password_confirmation"
										value="<?php echo esc_attr(tutor_utils()->input_old('password_confirmation')); ?>"
										placeholder="<?php esc_attr_e('Password Confirmation', 'edcare'); ?>" required
										autocomplete="new-password">
									<span
										class="tutor-validation-icon tutor-icon-mark tutor-color-success tutor-form-icon tutor-form-icon-reverse display-none"></span>
								</div>
							</div>
						</div>


						<div class="tutor-form-row">
							<div class="tutor-form-col-12">
								<div class="tutor-form-group m-0">
									<?php
									// providing register_form hook.
									do_action('tutor_student_reg_form_middle');
									do_action('register_form');
									?>
								</div>
							</div>
						</div>

						<?php do_action('tutor_student_reg_form_end'); ?>

						<?php
						$tutor_toc_page_link = tutor_utils()->get_toc_page_link();
						?>
						<?php if (null !== $tutor_toc_page_link): ?>
							<div class="tutor-mb-24">
								<?php esc_html_e('By signing up, I agree with the website\'s', 'edcare'); ?>
								<a target="_blank" href="<?php echo esc_url($tutor_toc_page_link); ?>"
									title="<?php esc_attr_e('Terms and Conditions', 'edcare'); ?>">
									<?php esc_html_e('Terms and Conditions', 'edcare'); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="tp-login-from-btn mt-15">
							<button type="submit" name="tutor_register_student_btn" value="register"
								class="tp-btn-inner w-100"><?php esc_html_e('Register', 'edcare'); ?></button>
						</div>
						<?php do_action('tutor_after_register_button'); ?>

					</form>
					<?php do_action('tutor_after_registration_form_wrap'); ?>
				</div>
			</div>
		</div>


	</div>
	<?php do_action('tutor_after_student_reg_form'); ?>
<?php endif; ?>