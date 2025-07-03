<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.0.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>
		<!-- login area start -->
		<section class="tp-login-area pt-140 pb-140">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-6 col-lg-8">
                     <div class="tp-login-wrapper p-relative">
                        <div class="tp-login-reset-password">
                           <h3 class="tp-login-title tp-login-reset-title"><?php echo esc_html__('Reset your password', 'edcare'); ?></h3>
                           <p><?php echo esc_html__('If you\'ve lost your password, don\'t worry. Simply provide your username or email address below, and we\'ll assist you in creating a new one.', 'edcare'); ?></p>

                        </div>
                        <div class="tp-login-form">
                           <form method="post" class="woocommerce-ResetPassword lost_reset_password">
                              <div class="tp-login-input-box">
                                 <div class="tp-login-input-label">
                                    <label for="user_login" class="tp-form-label"><?php echo esc_html__('Email', 'edcare'); ?></label>
                                 </div>
                                 <div class="tp-login-input">
								            <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
                                 </div>
                              </div>
                          
                              <div class="clear"></div>
                              <?php do_action( 'woocommerce_lostpassword_form' ); ?>

                              <div class="tp-login-btn-wrapper mt-30">
                                 <input type="hidden" name="wc_reset_password" value="true" />
                                 <button type="submit" class="tp-login-btn w-100 woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Reset Password', 'edcare' ); ?>"><?php esc_html_e( 'Reset password', 'edcare' ); ?></button>
                              </div>

                              <div class="tp-login-create-account text-center">
                                 <p><?php echo esc_html__('Remember Password?', 'edcare') ?><a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"> <?php echo esc_html__('Login', 'edcare'); ?></a></p>
                              </div>

                              <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- login area end -->
<?php
do_action( 'woocommerce_after_lost_password_form' );
