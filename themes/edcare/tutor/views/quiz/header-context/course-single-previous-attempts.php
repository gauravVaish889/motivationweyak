<?php
/**
 * Single attempt page
 *
 * @package Tutor\Views
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.0.0
 */

$passing_grade = tutor_utils()->get_quiz_option( get_the_ID(), 'passing_grade', 0 );
?>

 <div class="tp-dashboard-section tpd-quiz-attempts">
	<div class="tpd-course-wrap">
		<?php if ( ! empty( $back_url ) ) : ?>
		<a href="<?php echo esc_url( $back_url ); ?>">
			<span>
				<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M11 6H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					<path d="M6 11L1 6L6 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
			</span> 
			<?php esc_html_e( 'Back', 'edcare' ); ?>
		</a>
		<?php endif; ?>

		<span class="tpd-course-name"><?php esc_html_e( 'Quiz', 'edcare' ); ?></span>
	</div>

	<h2 class="tp-dashboard-title"><?php echo esc_html( $quiz_title ); ?></h2>

	<div class="tpd-quiz-time">
		<ul>
			<li>
				<div class="tpd-quiz-time-item">
					<p>
						<span><?php esc_html_e( 'Questions:', 'edcare' ); ?></span> <?php echo esc_html( $question_count ); ?>
					</p>
				</div>
			</li>
			<li>
				<div class="tpd-quiz-time-item">
					<p>
						<span><?php esc_html_e( 'Total Marks:', 'edcare' ); ?></span> <?php echo esc_html( $quiz_time ); ?>
					</p>
				</div>
			</li>
			<li>
				<div class="tpd-quiz-time-item">
					<p>
						<span><?php esc_html_e( 'Attempt Time:', 'edcare' ); ?></span> <?php echo esc_html( $earned_marks . '/' . $total_marks ); ?>
					</p>
				</div>
			</li>
			<li>
				<div class="tpd-quiz-time-item">
					<p>
						<span><?php esc_html_e( 'Passing Marks:', 'edcare' ); ?></span> 
						<?php
							$pass_marks = ( $total_marks * $passing_grade ) / 100;
							echo esc_html( number_format_i18n( $pass_marks, 2 ) );
						?>
					</p>
				</div>
			</li>
		</ul>
	</div>
</div>