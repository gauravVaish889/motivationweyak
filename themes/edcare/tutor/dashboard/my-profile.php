<?php
/**
 * My Profile Page
 *
 * @package Tutor\Templates
 * @subpackage Dashboard
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.4.3
 */

$uid  = get_current_user_id();
$user = get_userdata( $uid );

$profile_settings_link = tutor_utils()->get_tutor_dashboard_page_permalink( 'settings' );

$rdate = $user->user_registered;
$fname = $user->first_name;
$lname = $user->last_name;
$uname = $user->user_login;
$email = $user->user_email;

$phone = get_user_meta( $uid, 'phone_number', true );
$job   = nl2br( wp_strip_all_tags( get_user_meta( $uid, '_tutor_profile_job_title', true ) ) );
$bio   = get_user_meta( $uid, '_tutor_profile_bio', true );

$profile_data = array(
	array( __( 'Registration Date', 'edcare' ), ( $rdate ? tutor_i18n_get_formated_date( tutor_utils()->get_local_time_from_unix( $rdate ) ) : '' ) ),
	array( __( 'First Name', 'edcare' ), ( $fname ? $fname : esc_html( '-' ) ) ),
	array( __( 'Last Name', 'edcare' ), ( $lname ? $lname : esc_html( '-' ) ) ),
	array( __( 'Username', 'edcare' ), $uname ),
	array( __( 'Email', 'edcare' ), $email ),
	array( __( 'Phone Number', 'edcare' ), ( $phone ? $phone : '-' ) ),
	array( __( 'Skill/Occupation', 'edcare' ), ( $job ? $job : '-' ) ),
	array( __( 'Biography', 'edcare' ), $bio ? $bio : '-' ),
);
?>


<div class="row">
	<div class="col-lg-6">
		<div class="tp-dashboard-section">
			<h2 class="tp-dashboard-title"><?php esc_html_e( 'My Profile', 'edcare' ); ?></h2>
		</div>
	</div>
</div>

<div class="tp-profile-box">
	<div class="tp-profile-wrap">
		<ul>
			<?php foreach ( $profile_data as $key => $data ) : ?>
			<li>
				<div class="tp-profile-info d-flex">
					<div class="tp-profile-info-tag">
						<span><?php echo esc_html( $data[0] ); ?></span>
					</div>
					<div class="tp-profile-info-details">
						<span><?php echo edcare_kses( $data[1] ) ?></span>
					</div>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
