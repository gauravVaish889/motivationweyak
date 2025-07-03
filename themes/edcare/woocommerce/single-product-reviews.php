<?php

/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined('ABSPATH') || exit;

global $product;

if (!comments_open()) {
	return;
}

function get_wc_rating_counts($product_id)
{
	global $wpdb;

	$ratings_counts = $wpdb->get_results($wpdb->prepare("
        SELECT meta_value AS rating, COUNT(meta_value) AS count
        FROM {$wpdb->prefix}commentmeta AS cm
        INNER JOIN {$wpdb->prefix}comments AS c ON cm.comment_id = c.comment_ID
        WHERE meta_key = 'rating'
        AND c.comment_post_ID = %d
        GROUP BY meta_value
    ", $product_id));

	$rating_counts = array(
		'1' => 0,
		'2' => 0,
		'3' => 0,
		'4' => 0,
		'5' => 0,
	);

	foreach ($ratings_counts as $rating_count) {
		$rating_counts[$rating_count->rating] = $rating_count->count;
	}

	return $rating_counts;
}

$product_id = get_the_ID();
$counts = get_wc_rating_counts($product_id);

$rating_count = $product->get_rating_count();

$percentage_star = [];

if ($rating_count == 0) {
	foreach ($counts as $key => $value) {
		$percentage_star[$key] = 0;
	}
} else {
	foreach ($counts as $key => $value) {
		$percentage_star[$key] = ($value / $rating_count) * 100;
	}
}

$rating_average = number_format($product->get_average_rating(), 1);

?>

<div id="reviews" class="woocommerce-Reviews">
	<div class="row">
		<div class="col-lg-6">
			<div class="tp-product-details-review-statics">


				<!-- number -->
				<div class="tp-product-details-review-number d-inline-block mb-50">
					<h3 class="tp-product-details-review-number-title"> <?php echo esc_html__('Customer reviews', 'edcare'); ?></h3>

					<div class="tp-product-details-review-summery d-flex align-items-center">
						<div class="tp-product-details-review-summery-value">
							<span><?php echo esc_html($rating_average); ?></span>
						</div>
						<div class="tp-product-details-review-summery-rating d-flex align-items-center">
							<span><i class="fa-solid fa-star"></i></span>
							<span><i class="fa-solid fa-star"></i></span>
							<span><i class="fa-solid fa-star"></i></span>
							<span><i class="fa-solid fa-star"></i></span>
							<span><i class="fa-solid fa-star"></i></span>
							<p><?php printf('( %d %s)', $rating_count, $rating_count > 1 ? 'Reviews' : 'Review') ?></p>
						</div>
					</div>

					<div class="tp-product-details-review-rating-list">

						<?php for ($i = 5; $i > 0; $i--) : ?>
							<div class="tp-product-details-review-rating-item d-flex align-items-center">
								<span><?php printf('%d Star', $i); ?></span>
								<div class="tp-product-details-review-rating-bar">
									<span class="tp-product-details-review-rating-bar-inner" data-width="<?php echo esc_attr($percentage_star[$i]) ?>%"></span>
								</div>
								<div class="tp-product-details-review-rating-percent">
									<span><?php printf('%d%s', $percentage_star[$i], esc_html__('%', 'edcare')); ?></span>
								</div>
							</div> <!-- end single item -->
						<?php endfor; ?>


					</div>
				</div>

				<!-- reviews -->
				<div id="comments" class="tp-product-details-review-list pr-110">
					<h3 class="tp-product-details-review-title">
						<?php
						$count = $product->get_review_count();
						if ($count && wc_review_ratings_enabled()) {
							/* translators: 1: reviews count 2: product name */
							$reviews_title = sprintf(esc_html(_n('%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'edcare')), esc_html($count), '<span>' . get_the_title() . '</span>');
							echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product);
						} else {
							esc_html_e('Reviews', 'edcare');
						}
						?>
					</h3>




					<?php if (have_comments()) : ?>
						<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
						<?php
						$arrLeft = '<i class="fa-regular fa-arrow-left icon"></i>';
						$arrRight = '<i class="fa-regular fa-arrow-right icon"></i>';

						if (get_comment_pages_count() > 1 && get_option('page_comments')) :
							echo '<div class="basic-pagination  mt-30"><nav class="woocommerce-pagination tp-pagination shop">';
							paginate_comments_links(
								apply_filters(
									'woocommerce_comment_pagination_args',
									array(
										'prev_text' => is_rtl() ? ' ' . $arrRight . ' ' : '' . $arrLeft . '',
										'next_text' => is_rtl() ? ' ' . $arrLeft . ' ' : ' ' . $arrRight . ' ',
										'type'      => 'list',
									)


								)
							);
							echo '</nav></div>';
						endif;
						?>
					<?php else : ?>
						<p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'edcare'); ?></p>
					<?php endif; ?>

				</div>
			</div>
		</div> <!-- end col -->
		<div class="col-lg-6">
			<div class="tp-product-details-review-form">

				<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
					<div id="review_form_wrapper">
						<div id="review_form">
							<?php
							$logged_in_user_class = is_user_logged_in() ? ' user-logged-in' : '';
							$commenter    = wp_get_current_commenter();
							$comment_form = array(
								/* translators: %s is product title */
								'title_reply'         => have_comments() ? esc_html__('Review this product', 'edcare') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'edcare'), get_the_title()),
								/* translators: %s is product title */
								'title_reply_to'      => esc_html__('Leave a Reply to %s', 'edcare'),
								'title_reply_before'  => '<h3 id="reply-title" class="tp-product-details-review-form-title comment-reply-title ' . esc_attr($logged_in_user_class) . '">',
								'title_reply_after'   => '</h3>',
								'comment_notes_after' => '',
								'label_submit'        => esc_html__('Submit Review', 'edcare'),
								'logged_in_as'        => '',
								'comment_field'       => '',
								'class_submit'        => 'tp-product-details-review-btn tp-btn-submit',
							);

							$name_email_required = (bool) get_option('require_name_email', 1);
							$fields              = array(
								'author' => array(
									'label'    => __('Name', 'edcare'),
									'type'     => 'text',
									'value'    => $commenter['comment_author'],
									'required' => $name_email_required,
								),
								'email'  => array(
									'label'    => __('Email', 'edcare'),
									'type'     => 'email',
									'value'    => $commenter['comment_author_email'],
									'required' => $name_email_required,
								),
							);

							$comment_form['fields'] = array();

							foreach ($fields as $key => $field) {
								$field_html  = '<p class="comment-form-' . esc_attr($key) . '">';
								$field_html .= '<label for="' . esc_attr($key) . '">' . esc_html($field['label']);

								if ($field['required']) {
									$field_html .= '&nbsp;<span class="required">*</span>';
								}

								$field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' /></p>';

								$comment_form['fields'][$key] = $field_html;
							}

							$account_page_url = wc_get_page_permalink('myaccount');
							if ($account_page_url) {
								/* translators: %s opening and closing link tags respectively */
								$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'edcare'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
							}




							if (wc_review_ratings_enabled()) {
								$comment_form['comment_field'] = '<div class="comment-form-rating ' . esc_attr($logged_in_user_class) . '">
								<label for="rating">' . esc_html__('Your rating', 'edcare') . (wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '') . '</label>
									<select name="rating" id="rating" required>
										<option value="">' . esc_html__('Rate&hellip;', 'edcare') . '</option>
										<option value="5">' . esc_html__('Perfect', 'edcare') . '</option>
										<option value="4">' . esc_html__('Good', 'edcare') . '</option>
										<option value="3">' . esc_html__('Average', 'edcare') . '</option>
										<option value="2">' . esc_html__('Not that bad', 'edcare') . '</option>
										<option value="1">' . esc_html__('Very poor', 'edcare') . '</option>
									</select>
								</div>';
							}

							$comment_form['comment_field'] .= '<p class="comment-form-comment">
																<label for="comment">' . esc_html__('Your review', 'edcare') . '&nbsp;<span class="required">*</span></label>
																<textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
															</p>';

							comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
							?>
						</div>
					</div>
				<?php else : ?>
					<p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'edcare'); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>

</div>