<?php
/**
 * Withdraw Page
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @version 1.4.3
 */

use TUTOR\Input;
use Tutor\Models\WithdrawModel;

//phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
$per_page = tutor_utils()->get_option('statement_show_per_page', 20);
$current_page = max(1, Input::get('current_page', 1, Input::TYPE_INT));
$offset = ($current_page - 1) * $per_page;

$min_withdraw = tutor_utils()->get_option('min_withdraw_amount');
$formatted_min_withdraw_amount = tutor_utils()->tutor_price($min_withdraw);

$saved_account = WithdrawModel::get_user_withdraw_method();
$withdraw_method_name = tutor_utils()->avalue_dot('withdraw_method_name', $saved_account);

$user_id = get_current_user_id();
$withdraw_status = array(WithdrawModel::STATUS_PENDING, WithdrawModel::STATUS_APPROVED, WithdrawModel::STATUS_REJECTED);
$all_histories = WithdrawModel::get_withdrawals_history($user_id, array('status' => $withdraw_status), $offset, $per_page);
$image_base = tutor()->url . '/assets/images/';

$method_icons = array(
	'bank_transfer_withdraw' => $image_base . 'icon-bank.svg',
	'echeck_withdraw' => $image_base . 'icon-echeck.svg',
	'paypal_withdraw' => $image_base . 'icon-paypal.svg',
);

$status_message = array(
	'rejected' => __('Please contact the site administrator for more information.', 'edcare'),
	'pending' => __('Withdrawal request is pending for approval, please hold tight.', 'edcare'),
);

$currency_symbol = '';
if (function_exists('get_woocommerce_currency_symbol')) {
	$currency_symbol = get_woocommerce_currency_symbol();
} elseif (function_exists('edd_currency_symbol')) {
	$currency_symbol = edd_currency_symbol();
}

$summary_data = WithdrawModel::get_withdraw_summary($user_id);
$available_for_withdraw = $summary_data->available_for_withdraw - $summary_data->total_pending;
$is_balance_sufficient = $available_for_withdraw >= $min_withdraw;
$available_for_withdraw_formatted = tutor_utils()->tutor_price($available_for_withdraw);
$current_balance_formated = tutor_utils()->tutor_price($summary_data->current_balance);
?>

<div class="tutor-dashboard-content-inner tutor-frontend-dashboard-withdrawal tutor-color-black">
	<div class="tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-24">
		<?php esc_html_e('Withdrawals', 'edcare'); ?></div>

	<div class="tutor-card tutor-p-24">
		<div class="tutor-row tutor-align-lg-center">
			<div class="tutor-col-lg-auto tutor-mb-16 tutor-mb-lg-0">
				<div class="tutor-round-box tutor-p-8">
					<i class="tutor-icon-wallet" area-hidden="true"></i>
				</div>
			</div>

			<?php //phpcs:disable WordPress.WP.I18n.MissingTranslatorsComment ?>
			<div class="tutor-col tutor-mb-16 tutor-mb-lg-0">
				<div class="tutor-fs-6 tutor-color-muted tutor-mb-4">
					<?php
					/* translators: %s: current balance */
					echo wp_kses_post(sprintf(esc_html__('Current Balance is %s', 'edcare'), $current_balance_formated));
					?>
				</div>
				<div class="tutor-fs-5 tutor-color-black">
					<?php
					if ($is_balance_sufficient) {
						/* translators: %s: available balance */
						echo wp_kses_post(sprintf(__('You have %s ready to withdraw now', 'edcare'), "<strong class='available_balance'>" . $available_for_withdraw_formatted . '</strong>'));
					} else {
						/* translators: %s: available balance */
						echo wp_kses_post(sprintf(__('You have %s and this is insufficient balance to withdraw', 'edcare'), "<strong class='available_balance'>" . $available_for_withdraw_formatted . '</strong>'));
					}
					?>
				</div>
				<?php if ($summary_data->total_pending > 0): ?>
					<div class="tutor-badge-label label-warning	 tutor-mt-4" style="display: inline-flex; gap: 3px">
						<?php
						/* translators: %s: total pending withdrawal */
						echo wp_kses_post(sprintf(esc_html__('Total Pending Withdrawal %s', 'edcare'), tutor_utils()->tutor_price($summary_data->total_pending)));
						?>
					</div>
				<?php endif; ?>
			</div>

			<?php
			if ($is_balance_sufficient && $withdraw_method_name) {
				?>
				<div class="tutor-col-lg-auto">
					<button class="tutor-btn tutor-btn-primary" data-tutor-modal-target="tutor-earning-withdraw-modal">
						<?php esc_html_e('Withdrawal Request', 'edcare'); ?>
					</button>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<div class="tpd-withdraw-notification mt-2">
		<p>
			<span>
				<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
					<path
						d="M8.5 16C12.6421 16 16 12.6421 16 8.5C16 4.35786 12.6421 1 8.5 1C4.35786 1 1 4.35786 1 8.5C1 12.6421 4.35786 16 8.5 16Z"
						stroke="#757C8E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					<path d="M8.5 5.5V8.5" stroke="#757C8E" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round"></path>
					<path d="M8.5 11.5H8.507" stroke="#757C8E" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round"></path>
				</svg>
			</span>
			<?php
			$my_profile_url = tutor_utils()->get_tutor_dashboard_page_permalink('settings/withdraw-settings');

			echo esc_html($withdraw_method_name ? sprintf(__('The preferred payment method is selected as %s. ', 'edcare'), $withdraw_method_name) : '');
			echo wp_kses(

				sprintf(__('You can change your %1$s Withdraw Preference %2$s', 'edcare'), "<a href='{$my_profile_url}'>", '</a>'),
				array(
					'a' => array('href' => true),
				)
			);
			?>
		</p>
	</div>

	<?php
	if ($is_balance_sufficient && $withdraw_method_name) {
		?>
		<div id="tutor-earning-withdraw-modal" class="tutor-modal">
			<div class="tutor-modal-overlay"></div>
			<div class="tutor-modal-window">
				<div class="tutor-modal-content tutor-modal-content-white">
					<button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
						<span class="tutor-icon-times" area-hidden="true"></span>
					</button>

					<div class="tutor-modal-body">
						<div class="tutor-py-20 tutor-px-24">
							<div class="tutor-round-box tutor-round-box-lg tutor-mb-16">
								<span class="tutor-icon-wallet" area-hidden="true"></span>
							</div>

							<div class="tutor-fs-4 tutor-fw-medium tutor-color-black tutor-mb-24">
								<?php esc_html_e('Withdrawal Request', 'edcare'); ?></div>
							<div class="tutor-fs-6 tutor-color-muted">
								<?php esc_html_e('Please check your transaction notification on your connected withdrawal method', 'edcare'); ?>
							</div>

							<div class="tutor-row tutor-mt-32">
								<div class="tutor-col">
									<div class="tutor-fs-6 tutor-color-secondary tutor-mb-4">
										<?php esc_html_e('Withdrawable Balance', 'edcare'); ?></div>
									<div class="tutor-fs-6 tutor-fw-bold tutor-color-black">
										<?php echo wp_kses_post($available_for_withdraw_formatted); ?></div>
								</div>

								<div class="tutor-col">
									<div class="tutor-fs-6 tutor-color-secondary tutor-mb-4">
										<?php esc_html_e('Selected Payment Method', 'edcare'); ?></div>
									<div class="tutor-fs-6 tutor-fw-bold tutor-color-black">
										<?php echo esc_html($withdraw_method_name); ?></div>
								</div>
							</div>
						</div>

						<div class="tutor-mx-n32 tutor-my-32">
							<div class="tutor-hr" area-hidden="true"></div>
						</div>

						<form id="tutor-earning-withdraw-form" method="post">
							<div class="tutor-py-20 tutor-px-24">
								<div>
									<?php wp_nonce_field(tutor()->nonce_action, tutor()->nonce); ?>
									<input type="hidden" value="tutor_make_an_withdraw" name="action" />
									<?php do_action('tutor_withdraw_form_before'); ?>

									<label class="tutor-form-label"
										for="tutor_withdraw_amount"><?php esc_html_e('Amount', 'edcare'); ?></label>
									<div class="tutor-form-wrap tutor-mb-16">
										<span class="tutor-form-icon"><?php echo esc_html($currency_symbol); ?></span>
										<input type="number" class="tutor-form-control"
											min="<?php echo esc_attr($min_withdraw); ?>" name="tutor_withdraw_amount"
											id="tutor_withdraw_amount" step=".01" required />
									</div>

									<div class="tutor-form-help tutor-d-flex tutor-align-center">
										<span class="tutor-icon-circle-question-mark tutor-mr-8" area-hidden="true"></span>
										<span><?php echo wp_kses(__('Minimum withdraw amount is', 'edcare') . ' ' . $formatted_min_withdraw_amount, array()); ?></span>
									</div>

									<div class="tutor-withdraw-form-response"></div>

									<?php do_action('tutor_withdraw_form_after'); ?>
								</div>

								<div class="tutor-d-flex tutor-mt-48">
									<div>
										<button class="tutor-btn tutor-btn-outline-primary" data-tutor-modal-close>
											<?php esc_html_e('Cancel', 'edcare'); ?>
										</button>
									</div>

									<div class="tutor-ml-auto">
										<button type="submit" name="withdraw-form-submit" id="tutor-earning-withdraw-btn"
											class="tutor-btn tutor-btn-primary tutor-modal-btn-edit tutor-ml-16">
											<?php esc_html_e('Submit Request', 'edcare'); ?>
										</button>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	}

	if (is_array($all_histories->results) && count($all_histories->results)) {
		?>
	<div class="withdraw-history-table-wrap tutor-tooltip-inside tutor-mt-40">
		<div class="withdraw-history-table-title">
			<div class="tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-24">
				<?php esc_html_e('Withdrawal History', 'edcare'); ?>
			</div>
		</div>

		<div class="tutor-table-responsive">
			<table class="tutor-table">
				<thead>
					<tr>
						<th width="40%">
							<?php esc_html_e('Withdrawal Method', 'edcare'); ?>
						</th>
						<th width="28%">
							<?php esc_html_e('Requested On', 'edcare'); ?>
						</th>
						<th width="13%">
							<?php esc_html_e('Amount', 'edcare'); ?>
						</th>
						<th width="13%">
							<?php esc_html_e('Status', 'edcare'); ?>
						</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($all_histories->results as $withdraw_history): ?>
						<tr>
							<td>
								<?php
								$method_data = maybe_unserialize($withdraw_history->method_data);
								$method_key = $method_data['withdraw_method_key'];
								$method_title = '';

								switch ($method_key) {
									case 'bank_transfer_withdraw':
										$method_title = $method_data['account_number']['value'];
										$method_title = substr_replace($method_title, '****', 2, strlen($method_title) - 4);
										break;
									case 'paypal_withdraw':
										$method_title = $method_data['paypal_email']['value'];
										$email_base = substr($method_title, 0, strpos($method_title, '@'));
										$method_title = substr_replace($email_base, '****', 2, strlen($email_base) - 3) . substr($method_title, strpos($method_title, '@'));
										break;
								}
								?>
								<div class="tutor-withdrawals-method">
									<div class="tutor-withdrawals-method-icon">
										<img
											src="<?php echo esc_url(isset($method_icons[$method_key]) ? $method_icons[$method_key] : ''); ?>" />
									</div>
									<div class="tutor-withdrawals-method-name">
										<div class="withdraw-method-name tutor-fs-6 tutor-fw-medium tutor-color-black">
											<?php echo esc_html(tutor_utils()->avalue_dot('withdraw_method_name', $method_data)); ?>
										</div>
										<div class="tutor-fs-7 tutor-color-muted">
											<?php echo esc_html($method_title); ?>
										</div>
									</div>
								</div>
							</td>
							<td>
								<?php echo esc_attr(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($withdraw_history->created_at))); ?>
							</td>
							<td>
								<?php echo wp_kses_post(tutor_utils()->tutor_price($withdraw_history->amount)); ?>
							</td>
							<td>
								<span class="inline-image-text is-inline-block">
									<span class="tutor-badge-label
										<?php
										if ('approved' === $withdraw_history->status) {
											echo esc_html__('label-success', 'edcare');
										}
										?>
										<?php
										if ('pending' === $withdraw_history->status) {
											echo esc_html__('label-warning', 'edcare');
										}
										?>
										<?php
										if ('rejected' === $withdraw_history->status) {
											echo esc_html__('label-danger', 'edcare');
										}
										?>
										">
										<?php echo esc_html($withdraw_history->status); //phpcs:ignore ?>
									</span>
								</span>
							</td>
							<td>
								<?php if ('approved' !== $withdraw_history->status && isset($status_message[$withdraw_history->status])): ?>
									<span class="tool-tip-container">
										<div class="tooltip-wrap tooltip-icon tutor-mt-12">
											<span class="tooltip-txt tooltip-left">
												<?php echo esc_html($status_message[$withdraw_history->status]); ?>
											</span>
										</div>
									</span>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
	} else {
		tutor_utils()->tutor_empty_state(tutor_utils()->not_found_text());
	}
	?>
</div>

<?php
if ($all_histories->count >= $per_page) {
	$pagination_data = array(
		'total_items' => $all_histories->count,
		'per_page' => $per_page,
		'paged' => $current_page,
	);

	tutor_load_template_from_custom_path(
		tutor()->path . 'templates/dashboard/elements/pagination.php',
		$pagination_data
	);
}
//phpcs:enable WordPress.WP.I18n.MissingTranslatorsComment
?>