<?php
/**
 * Social Profile Template
 *
 * @package Tutor\Templates
 * @subpackage Dashboard\Settings
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.0.0
 */

$user = wp_get_current_user();
?>

<div class="tp-dashboard-tab mb-25">
	<h2 class="tp-dashboard-tab-title"><?php esc_html_e( 'Settings', 'edcare' ); ?></h2>
	<div class="tp-dashboard-tab-list">
		<?php tutor_load_template( 'dashboard.settings.nav-bar', array( 'active_setting_nav' => 'social-profile' ) ); ?>
	</div>
</div>


<div class="tpd-setting-box">
	<h3 class="tpd-setting-social-title"><?php esc_html_e( 'Social Profile Link', 'edcare' ); ?></h3>

	<div class="tutor-dashboard-setting-social tpd-setting-social-content">
	
	
		<form id="user_social_form" action="" method="post" enctype="multipart/form-data">
			<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
			<input type="hidden" value="tutor_social_profile" name="tutor_action" />
			<?php
				do_action( 'tutor_profile_edit_before_social_media', $user );
				$tutor_user_social_icons = tutor_utils()->tutor_user_social_icons();
			foreach ( $tutor_user_social_icons as $key => $social_icon ) :
				?>
				<div class="tutor-row tutor-align-center tutor-mb-32 tutor-social-field">
					<div class="tutor-col-12 tutor-col-sm-4 tutor-col-md-12 tutor-col-lg-3">
						<i class="<?php echo esc_html( $social_icon['icon_classes'] ); ?>"></i>
					<?php echo esc_html( $social_icon['label'] ); ?>
					</div>
					<div class="tutor-col-12 tutor-col-sm-8 tutor-col-md-12 tutor-col-lg-6">
						<input class="tutor-form-control" type="url" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_url( get_user_meta( $user->ID, $key, true ) ); ?>" placeholder="<?php echo esc_html( $social_icon['placeholder'] ); ?>">
					</div>
				</div>
			<?php endforeach; ?>
	
			<div class="tutor-row">
				<div class="tutor-col-12">
					<div class="tpd-setting-btn">
						<button type="submit" class="">
							<?php esc_html_e( 'Update Profile', 'edcare' ); ?>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

