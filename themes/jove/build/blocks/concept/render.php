 <?php
/**
 * Concept block (parent).
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
$data       = Utils::fetch_visualize_data(get_the_ID());
$data       = ( !empty( $data['data']['conceptResponse'] ) ) ? $data : Utils::get_api_data(get_the_title(), 'conceptResponse');
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
   <?php if ( !empty( $data['data']['conceptResponse'] ) ) { ?>
   <div class="jove-concept-video-block">
     <h2 class="jove-concept-video-block__heading"><?php echo esc_html( $heading ); ?></h2>
     <div class="jove-concept-video-block__container">

       <div class="jove-concept-video-block__lists">
         <?php foreach ($data['data']['conceptResponse'] as $key => $value) {
                    $thumbnail  = ($value['lengthMinutes'] == '00:00') ? JOVE_BUILD_URI . '/media/images/VideoComingSoonTeaser.webp' : 'https://app.jove.com/_next/image?url='.Utils::urldecode($value['thumbnail']).'&w=828&q=75';
                    $excerpt    = $value['excerpt']??get_the_excerpt();
					$url        = 'https://app.jove.com/v/' . absint( $value['joveArticleId'] ) . '/' . sanitize_title($value['joveTitle']) . '?utm_source=visualize.jove.com&utm_medium=referral';
                    $title      = Utils::remove_html_tags($value['joveTitle']);
					?>
         <a class="jove-concept-video-block__list" href="<?php echo esc_url( $url ); ?>" rel="noopener" target="_blank">
           <figure class="jove-concept-video-block__image">
             <img src="<?php echo esc_url( $thumbnail ); ?>"
               alt="JoVE Research Video for <?php echo esc_attr( $title ); ?>">
             <span
               class="jove-concept-video-block__image__overlay"><?php echo esc_html($value['lengthMinutes']??'3:00'); ?></span>
           </figure>
           <div class="jove-concept-video-block__content">
             <h3 class="jove-concept-video-block__title jove-tooltip" data-tooltip="<?php echo esc_attr( $title ); ?>">
               <label class="jove-truncate"><?php echo esc_html( $title ); ?></label>
             </h3>
             <div class="jove-concept-video-block__views">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-eye">
                 <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                 <circle cx="12" cy="12" r="3"></circle>
               </svg>
               <?php echo esc_html( $value['views'] ); ?>
             </div>
             <p class="jove-concept-video-block__date">
               <?php echo wp_kses_post( $excerpt ); ?>
             </p>
           </div>
         </a>
         <?php
				}?>
       </div>
     </div>
   </div>
   <?php } ?>
   <?php if ( ! $is_preview ) { ?>
 </div>
 <?php } ?>