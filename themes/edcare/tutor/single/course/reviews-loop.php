<?php
/**
 * Template for review loop
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

foreach ( $reviews as $review ) : ?>
	<?php $profile_url = tutor_utils()->profile_url( $review->user_id, false ); ?>
	<div class="tp-course-details2-review-item-reply">
		<div class="tp-course-details2-review-top d-flex">
			<div class="tp-course-details2-review-thumb">
				<?php
					echo wp_kses(
						tutor_utils()->get_tutor_avatar( $review->user_id, 'md' ),
						tutor_utils()->allowed_avatar_tags()
					);
				?>
			</div>
			<div class="tp-course-details2-review-content">
				<h4>
					<a href="<?php echo esc_url( $profile_url ); ?>"><?php echo esc_html( $review->display_name ); ?></a>
				</h4>
				<div class="tp-course-details2-review-star d-flex align-items-center">
					<?php tutor_utils()->star_rating_generator_v2( $review->rating, null, true, 'tutor-is-sm', ); ?>
					<span class="span"> <?php echo esc_html( sprintf( __( '%s ago', 'edcare' ), human_time_diff( strtotime( $review->comment_date ) ) ) ); ?></span>
				</div>
			</div>
		</div>
		<p>
		<?php
			echo tutor_utils()->clean_html_content(
				nl2br( stripslashes( $review->comment_content ) ),
				array( 'br' => array() )
			);
		?>
		</p>
		
	</div>
<?php endforeach; ?>
