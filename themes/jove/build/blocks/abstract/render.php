 <?php
/**
 * Abstract block (parent).
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

$post_id = get_the_ID(); // Replace with a specific post ID if needed.

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

   <div class="alignwide wp-block-acf-abstract">
     <div class="jove-abstract-block__entry-header">
       <h1 class="jove-abstract-block__heading"><?php the_title(); ?></h1>
	   </div>
	 <div class="jove-abstract-block">
       <div class="jove-abstract-block__authors-affiliations">
         <?php
				$items = get_field('author_affiliation', $post_id);
				if ( ! empty( $items ) ) {
					// Initialize an empty array to store unique affiliations.
					$affiliations = [];
					// Loop through the main data array.
					foreach ($items as $entry) {
						if (!empty($entry['affiliation']) && is_array($entry['affiliation'])) {
							foreach ($entry['affiliation'] as $affiliation) {
								// Ensure the affiliation is a WP_Term object and not already added.
								if (is_a($affiliation, 'WP_Term') && !in_array($affiliation->name, $affiliations)) {
									$affiliations[] = $affiliation->name;
								}
							}
						}
					}

					// Output the unique affiliations.
					$authorsData 	= [];
					echo '<ul class="jove-abstract-block__authors">';
						foreach ( $items as $key => $data ) {
							$sub = [];
							if(!empty($data['affiliation'])) {
								foreach ($data['affiliation'] as $affiliation) {
									// Ensure the affiliation is a WP_Term object and not already added.
									if (is_a($affiliation, 'WP_Term') ) {
										if (in_array($affiliation->name, $affiliations)) {
											$sub[] = 1 + array_search($affiliation->name, $affiliations);
										}
									}
								}
								
							}
							$authorsData[] = '<a href="'.esc_url(site_url('/?s=&author='.$data['author']->slug)).'">'.$data['author']->name . '</a><sup>'.implode(', ', $sub).'</sup>';

						}
						echo '<li>'.implode(', ', $authorsData).'</li>';
					echo '</ul>';
					$affiliationData = [];
					if ( ! empty( $affiliations ) ) {
						echo '<jove-affiliations-accordion>';
						echo '<div class="jove-affiliations-accordion__buttton">';
						echo esc_html__('Affiliations','jove');
						echo '<button>&#43; expand</button>';
						echo '</div>';
						echo '<div class="jove-affiliations-accordion__content">';
						echo '<ul class="jove-abstract-block__affiliations">';
							foreach ( $affiliations as $key => $value ) { $key++;
								echo '<li><sup>'.$key.'</sup>'.$value.'</li>';
							}
						echo '</ul>';
						echo '</div>';
						echo '</jove-affiliations-accordion>';
					}
				}
				?>
       </div>
		 <div class="artical-metapost-data">
		 <div class="artical-meta-inner">
       <div class="jove-abstract-block__journal">
         <?php
				$custom_taxonomy_list = get_the_term_list( $post_id, 'journal', '', ', ', '' );
				if ( $custom_taxonomy_list ) {
					echo $custom_taxonomy_list;
				}
				?>
       </div>

       <?php
			 $date = get_the_date('F j, Y');
			 if ( '01-Jan-1970' != $date ) { ?>
       <div class="jove-abstract-block__date">
         <p class="jove-abstract-block__date_lable"><?php esc_html_e( '|', 'jove' );?></p>
         <div class="jove-abstract-block__date_line"><?php echo esc_html($date); ?></div>
       </div>
       <?php } ?>
			 </div> 	 
		 

       <div class="jove-abstract-block__social-share">
         <ul>
           <li><a href="#popup-info" class="open-popup"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round" class="feather feather-share-2">
                 <circle cx="18" cy="5" r="3"></circle>
                 <circle cx="6" cy="12" r="3"></circle>
                 <circle cx="18" cy="19" r="3"></circle>
                 <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                 <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
               </svg></a>
           </li>
           <!-- <li><a href="https://app.jove.com/auth/signin"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                                 <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                             </svg></a>
                     </li> -->
         </ul>
         <div id="popup-info" class="mfp-hide" style="text-align:center; background:white; padding:20px; margin:auto;">
           <div class="popup-content">
             <div class="jove-social-share-header">
               <h3><?php esc_html_e( 'Share', 'jove' );?></h3>
               <button class="mfp-close-custom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                   stroke-linejoin="round" class="feather feather-x">
                   <line x1="18" y1="6" x2="6" y2="18"></line>
                   <line x1="6" y1="6" x2="18" y2="18"></line>
                 </svg></button>
             </div>
             <ul class="jove-social-share-list">
               <?php
							$socials = [
								'facebook' => [
									'name' => esc_html__('Facebook','jove'),
									'link' => 'https://www.facebook.com/sharer/sharer.php?u={url}',
									'icon' => '<svg
										width="20px"
										height="20px"
										viewBox="0 0 20 20"
										aria-hidden="true">
											<path d="M20,10.1c0-5.5-4.5-10-10-10S0,4.5,0,10.1c0,5,3.7,9.1,8.4,9.9v-7H5.9v-2.9h2.5V7.9C8.4,5.4,9.9,4,12.2,4c1.1,0,2.2,0.2,2.2,0.2v2.5h-1.3c-1.2,0-1.6,0.8-1.6,1.6v1.9h2.8L13.9,13h-2.3v7C16.3,19.2,20,15.1,20,10.1z"/>
										</svg>'
								],
								'twitter' => [
									'name' => esc_html__('X (Twitter)','jove'),
									'link' => 'https://twitter.com/intent/tweet?url={url}&text={text}',
									'icon' => '
										<svg
										width="20px"
										height="20px"
										viewBox="0 0 20 20"
										aria-hidden="true">
											<path d="M2.9 0C1.3 0 0 1.3 0 2.9v14.3C0 18.7 1.3 20 2.9 20h14.3c1.6 0 2.9-1.3 2.9-2.9V2.9C20 1.3 18.7 0 17.1 0H2.9zm13.2 3.8L11.5 9l5.5 7.2h-4.3l-3.3-4.4-3.8 4.4H3.4l5-5.7-5.3-6.7h4.4l3 4 3.5-4h2.1zM14.4 15 6.8 5H5.6l7.7 10h1.1z"/>
										</svg>
									'
								],
								'linkedin' => [
									'name' => esc_html__('LinkedIn','jove'),
									'link' => 'https://www.linkedin.com/shareArticle?url={url}&title={text}',
									'icon' => '
										<svg
										width="20px"
										height="20px"
										viewBox="0 0 20 20"
										aria-hidden="true">
											<path d="M18.6,0H1.4C0.6,0,0,0.6,0,1.4v17.1C0,19.4,0.6,20,1.4,20h17.1c0.8,0,1.4-0.6,1.4-1.4V1.4C20,0.6,19.4,0,18.6,0z M6,17.1h-3V7.6h3L6,17.1L6,17.1zM4.6,6.3c-1,0-1.7-0.8-1.7-1.7s0.8-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7C6.3,5.5,5.5,6.3,4.6,6.3z M17.2,17.1h-3v-4.6c0-1.1,0-2.5-1.5-2.5c-1.5,0-1.8,1.2-1.8,2.5v4.7h-3V7.6h2.8v1.3h0c0.4-0.8,1.4-1.5,2.8-1.5c3,0,3.6,2,3.6,4.5V17.1z"/>
										</svg>
									'
								],
							];
							foreach ( $socials as $key => $value ) {

								$url = str_replace(
									'{url}',
									Utils::urldecode( get_the_permalink() ),
									str_replace(
										'{text}',
										Utils::urldecode( get_the_title() ),
										$value['link']
									)
								);
								echo '<li><a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" title="' . esc_attr( $value['name'] ) . '">' . $value['icon'] . '</a></li>';
							}
							?>
             </ul>
             <div class="jove-abstract-block__share__link">
               <textarea id="copytext" class="jove-abstract-block__share__link-url"><?php the_permalink(); ?></textarea>
               <button id="copytextbtn" type="button"
                 class="jove-abstract-block__share__link-copy"><?php esc_html_e( 'Copy link', 'jove' ); ?></button>
             </div>
           </div>
         </div>
       </div>
			 </div>
    
	    <?php


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
$notice 	= get_field('notice') ?? __( '<p>These videos have been matched automatically. <a href="https://www.jove.com/about/contact">Contact us</a> if they are not relevant.</p>', 'jove' );
$button 	= get_field('button_text') ?? esc_html__('See all related videos','jove');
$btn_url 	= 'https://app.jove.com/search?content_type=journal_content&page=1&query=' . Utils::urldecode(get_the_title());
$data       = Utils::fetch_visualize_data(get_the_ID());
$data       = ( !empty( $data['data']['experimentResponse'] ) ) ? $data : Utils::get_api_data(get_the_title(), 'experimentResponse');
$notice 	= get_field('notice') ?? __( '<p>These videos have been matched automatically. <a href="https://www.jove.com/about/contact">Contact Us</a> if you have any questions.</p>', 'jove' );
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
         <h2 class="jove-experiment-video-block__heading"> 
		   <div class="title"><?php echo esc_html( $heading ); ?></div>
		   <div class="jove-info-wrapper">
		        <button class="jove-info-toggle" aria-label="More Info" >
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
		    </div>
		 </h2>
    <div class="jove-experiment-video-block__container">
        <?php if ( !empty( $data['data']['experimentResponse'] ) ) : ?>
            <div class="jove-experiment-video-block__toggle-wrapper" style="display: none;">
                <div class="jove-experiment-video-block__notice">
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
                </div>
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
     <?php
if ( ! $is_preview ) { ?>
 </div>
 <?php } ?>
     <div class="jove-abstract-block__entry-content">
       <h2 class="jove-abstract-block__description__heading">
         <?php esc_html_e( 'Abstract', 'jove' ); ?>
       </h2>
       <div class="jove-abstract-block__description__text">
         <?php the_content(); ?>
       </div>
       <div class="jove-abstract-block__keywords">
         <?php
				$terms = get_the_terms( $post_id, 'keyword' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					echo '<h2 class="jove-abstract-block__keywords__label">'.esc_html__('Keywords:','jove').'</h2> ';
					foreach ( $terms as $term ) {
						//$custom_url = 'https://app.jove.com/search?content_type=journal_content&query='.sanitize_title($term->name).'&content_type=&page=1&originalQuery='.Utils::urldecode($term->name);
						$custom_url = 'https://app.jove.com/search?content_type=journal_content&originalQuery='.Utils::urldecode($term->name).'&page=1&query='.sanitize_title($term->name);
						// Create a clickable link for each term.
						echo '<a href="' . esc_url( $custom_url ) . '" rel="tag">' . esc_html( $term->name ) . '</a>';
					}
				}
				?>
       </div>
		  </div>
     </div>
   </div>
   <?php if ( ! $is_preview ) { ?>
 </div>

 <?php } ?>