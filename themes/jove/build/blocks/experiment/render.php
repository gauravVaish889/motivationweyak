 <?php
/**
 * Experiment block (parent).
 *
 * @param array  $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id The post ID the block is rendering content against.
 *                     This is either the post ID currently being displayed inside a query loop,
 *                     or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 */

use Jove\Inc\Utils;

// Support custom id values.
$block_id = wp_unique_prefixed_id( 'jove-block-id-' );
if ( ! empty( $block['anchor'] ) ) {
	$block_id = esc_attr( $block['anchor'] );
}

// Create class attribute allowing for custom "className".
$class_name = '';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// acf data
$heading 	= get_field('heading');
$notice 	= get_field('notice') ?? __( '<p>These videos have been matched automatically. <a href="https://www.jove.com/about/contact">Contact Us</a> if you have any questions.</p>', 'jove' );
$button 	= get_field('button_text') ?? esc_html__('See all related videos','jove');
$btn_url 	= 'https://app.jove.com/search?content_type=journal_content&page=1&query=' . Utils::urldecode(get_the_title());
$data       = Utils::fetch_visualize_data(get_the_ID());
$data       = ( !empty( $data['data']['experimentResponse'] ) ) ? $data : Utils::get_api_data(get_the_title(), 'experimentResponse');
?>

 <?php if ( ! $is_preview ) { ?>
 <div <?php
		echo wp_kses_data(
			get_block_wrapper_attributes(
				array(
					'id'    => $block_id,
					'class' => esc_attr( $class_name ),
				)
			)
		);
		?>>
     <?php } ?>

     <div class="jove-experiment-video-block test">
         <h2 class="jove-experiment-video-block__heading" > 
		  <div class="title"><?php echo esc_html( $heading ); ?></div>
            <button class="jove-info-toggle" aria-label="More Info ">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z"
                        fill="#213CED"></path>
                </svg>
            </button>
            <div class="jove-notice__text">
                <?php echo wp_kses_post( $notice ); ?>
            </div>
		 </h2>
    <div class="jove-experiment-video-block__container">
        <?php if ( !empty( $data['data']['experimentResponse'] ) ) : ?>
            <div class="jove-experiment-video-block__toggle-wrapper" style="display: none;">
                <!-- <div class="jove-experiment-video-block__notice">
                    <div class="jove-notice__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z"
                                fill="#213CED"></path>
                        </svg>
                    </div>
                    <div class="jove-notice__text">
                        <?php echo wp_kses_post( $notice ); ?>
                    </div>
                    <div class="jove-notice__close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg></div>
                </div> -->
            </div>

            <div class="jove-experiment-video-block__lists">
                <?php foreach ($data['data']['experimentResponse'] as $key => $value) :
                    $thumbnail  = ($value['lengthMinutes'] == '00:00') ? JOVE_BUILD_URI . '/media/images/VideoComingSoonTeaser.webp' : 'https://app.jove.com/_next/image?url=' . Utils::urldecode($value['thumbnail']) . '&w=828&q=75';
                    $date       = new DateTime($value['publicationDate']);
                    $date       = $date->format('F j, Y');
                    $url        = 'https://app.jove.com/v/' . absint( $value['joveArticleId'] ) . '/' . sanitize_title($value['joveTitle']) . '?utm_source=visualize.jove.com&utm_medium=referral';
                    $title      = Utils::remove_html_tags($value['joveTitle']);
                ?>
                    <a class="jove-experiment-video-block__list" href="<?php echo esc_url( $url ); ?>" rel="noopener" target="_blank">
                        <figure class="jove-experiment-video-block__image">
                            <img src="<?php echo esc_url( $thumbnail ); ?>" alt="JoVE Research Video for <?php echo esc_attr( $title ); ?>">
                            <span class="jove-experiment-video-block__image__overlay"><?php echo esc_html($value['lengthMinutes'] ?? '3:00'); ?></span>
                        </figure>
                        <div class="jove-experiment-video-block__content">
                            <h3 class="jove-experiment-video-block__title jove-tooltip" data-tooltip="<?php echo esc_attr( $title ); ?>">
                                <label class="jove-truncate"><?php echo esc_html( $title ); ?></label>
                            </h3>
                            <?php if ( '01-Jan-1970' !== $date ) : ?>
                                <p class="jove-experiment-video-block__date">
                                    <?php esc_html_e( 'Published on: ', 'jove' );?>
                                    <?php echo esc_html( $date ); ?>
                                </p>
                            <?php endif; ?>
                            <div class="jove-experiment-video-block__views">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <?php echo esc_html( $value['views'] ); ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else :
            $no_results_heading = get_field('no_results_heading') ?? __('No related Experiment Videos available at the moment', 'jove');
            $no_results_text    = get_field('no_results_text') ?? __("<p>JoVE has <strong>over 10,000 Video Journals</strong> across <strong>Medicine, Neuroscience, Biology</strong> and more<br>
to facilitate <strong>Your Next Breakthrough!</strong></p>", "jove");
            $button             = get_field('no_results_button_text') ?? esc_html__('Explore JoVE Research','jove');
            $btn_url            = get_field('no_results_button_url') ?? 'https://app.jove.com/';
        ?>
            <div class="jove-experiment-video-block__lists jove-experiment-video-block__lists_no_results">
                <div class="jove-experiment-video-block__content">
                    <!-- SVG Illustration -->
					<img src="https://jovevisualidev.wpenginepowered.com/wp-content/uploads/2025/04/Group.png" class="no-result-img-icon">
                    <h3 class="jove-experiment-video-block__no_result_title">
                        <?php echo esc_html( $no_results_heading ); ?>
                    </h3>
                    <div class="jove-experiment-video-block__no_result_text">
                        <?php echo wp_kses_post( $no_results_text ); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="jove-experiment-video-block__button">
            <a href="<?php echo esc_url( $btn_url ); ?>"
                class="wp-block-button__link wp-element-button"><?php echo esc_html( $button ); ?></a>
        </div>
    </div>

     </div>
<style>
	 button.jove-info-toggle {
    border: 0;
    background: none;
    padding: 0;
    margin: 0;
}
</style>
     <?php
if ( ! $is_preview ) { ?>
 </div>
 <?php } ?>