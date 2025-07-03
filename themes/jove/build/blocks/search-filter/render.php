<?php
/**
 * CTA block (parent).
 *
 * @param array  $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id The post ID the block is rendering content against.
 *                     This is either the post ID currently being displayed inside a query loop,
 *                     or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 */

// acf data
$start_year = get_field('start_year') ? get_field('start_year') : 2000;

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

$filters_data = jove_get_filters_data();

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

     <div class="jove-search-filter-block">
         <jove-search class="jove-search">
             <div class="jove-pagination-wrapper">
                 <button class="jove-filters_heading_text jove-filter-open-button">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M10 18H14V16H10V18ZM3 6V8H21V6H3ZM6 13H18V11H6V13Z" fill="#323232" />
                     </svg>
                     <label><?php esc_html_e( 'Filters', 'jove' );?></label>
                 </button>
                 <jove-pagination></jove-pagination>
             </div>
             <div class="jove-search-heading">
                 <div class="jove-search-heading-text">
                     <jove-results-count class="jove-results-count"></jove-results-count>
                 </div>
                 <div class="jove-search-heading-filter">
                     <jove-select-dropdown>
                         <label><?php esc_html_e( 'Sort By Publication Date:', 'jove' );?></label>
                         <select  class="js-example-basic-single" name="sort" data-key="sort">
                             <option value="desc"><?php esc_html_e( 'Latest', 'jove' );?></option>
                             <option value="asc"><?php esc_html_e( 'Oldest', 'jove' );?></option>
                         </select>
                     </jove-select-dropdown>
					
                 </div>
             </div>

             <div class="jove-search__filter-wrapper">
                 <div class="jove-search__filter-left-col">

                     <jove-filters_heading class="jove-filters_heading">
                         <div class="jove-filters_heading_text">
                            <button class="jove-filters_icon_button"> <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path d="M10 18H14V16H10V18ZM3 6V8H21V6H3ZM6 13H18V11H6V13Z" fill="#323232" />
                             </svg> </button>
                             <label><?php esc_html_e( 'Filters', 'jove' );?></label>
                         </div>
						   <div class="jove-search-heading-filter mobile">
                     <jove-select-dropdown>
                         <label><?php esc_html_e( 'Sort By Publication Date:', 'jove' );?></label>
                         <select   class="js-example-basic-single" name="sort" data-key="sort">
                             <option value="desc"><?php esc_html_e( 'Latest', 'jove' );?></option>
                             <option value="asc"><?php esc_html_e( 'Oldest', 'jove' );?></option>
                         </select>
                     </jove-select-dropdown>
					
                 </div>
                         <button class="jove-filters_heading_button"><svg width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <g opacity="0.7">
                                     <path fill-rule="evenodd" clip-rule="evenodd"
                                         d="M18.7504 22.5C18.5515 22.5 18.3607 22.421 18.22 22.2803C18.0794 22.1397 18.0004 21.9489 18.0004 21.75V2.25C18.0004 2.05109 18.0794 1.86032 18.22 1.71967C18.3607 1.57902 18.5515 1.5 18.7504 1.5C18.9493 1.5 19.14 1.57902 19.2807 1.71967C19.4213 1.86032 19.5004 2.05109 19.5004 2.25V21.75C19.5004 21.9489 19.4213 22.1397 19.2807 22.2803C19.14 22.421 18.9493 22.5 18.7504 22.5ZM15.0004 12C15.0004 12.1989 14.9213 12.3897 14.7807 12.5303C14.64 12.671 14.4493 12.75 14.2504 12.75H5.56086L8.78136 15.969C8.8511 16.0387 8.90641 16.1215 8.94415 16.2126C8.98189 16.3037 9.00131 16.4014 9.00131 16.5C9.00131 16.5986 8.98189 16.6963 8.94415 16.7874C8.90641 16.8785 8.8511 16.9613 8.78136 17.031C8.71163 17.1007 8.62885 17.156 8.53774 17.1938C8.44663 17.2315 8.34898 17.2509 8.25036 17.2509C8.15175 17.2509 8.0541 17.2315 7.96299 17.1938C7.87188 17.156 7.7891 17.1007 7.71936 17.031L3.21936 12.531C3.14952 12.4613 3.09411 12.3786 3.0563 12.2874C3.01849 12.1963 2.99902 12.0987 2.99902 12C2.99902 11.9013 3.01849 11.8037 3.0563 11.7125C3.09411 11.6214 3.14952 11.5387 3.21936 11.469L7.71936 6.969C7.86019 6.82817 8.0512 6.74905 8.25036 6.74905C8.44953 6.74905 8.64053 6.82817 8.78136 6.969C8.92219 7.10983 9.00131 7.30084 9.00131 7.5C9.00131 7.69916 8.92219 7.89017 8.78136 8.031L5.56086 11.25H14.2504C14.4493 11.25 14.64 11.329 14.7807 11.4697C14.9213 11.6103 15.0004 11.8011 15.0004 12Z"
                                         fill="#323232" />
                                 </g>
                             </svg>
                         </button>
                     </jove-filters_heading>
                     <jove-filters class="inner-filter">
                        <div class="filter-mobile-popup">
                            <div class="filter-text">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 18H14V16H10V18ZM3 6V8H21V6H3ZM6 13H18V11H6V13Z" fill="#565656"/>
                                </svg> Filters
                            </div>
                            <div class="filter-close-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_3627_3259)">
                                        <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="#565656"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_3627_3259">
                                            <rect width="24" height="24" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                         <jove-clear-all-filters class="clear-all-filters clear-all-filters--top"> <button
                                 class="jove-clear-all-filters__btn"><?php esc_html_e( 'Reset all filters', 'jove' );?></button>
                                 
                         </jove-clear-all-filters>
                         <jove-accordion class="jove-accordion" key="date" label="Date">
                             <div class="jove-accordion__handle" role="button">
                                 <div class="jove-accordion__handle-text">
                                     <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                         <path
                                             d="M5.83333 9.1665H7.5V10.8332H5.83333V9.1665ZM17.5 4.99984V16.6665C17.5 17.5832 16.75 18.3332 15.8333 18.3332H4.16667C3.72464 18.3332 3.30072 18.1576 2.98816 17.845C2.67559 17.5325 2.5 17.1085 2.5 16.6665L2.50833 4.99984C2.50833 4.08317 3.24167 3.33317 4.16667 3.33317H5V1.6665H6.66667V3.33317H13.3333V1.6665H15V3.33317H15.8333C16.75 3.33317 17.5 4.08317 17.5 4.99984ZM4.16667 6.6665H15.8333V4.99984H4.16667V6.6665ZM15.8333 16.6665V8.33317H4.16667V16.6665H15.8333ZM12.5 10.8332H14.1667V9.1665H12.5V10.8332ZM9.16667 10.8332H10.8333V9.1665H9.16667V10.8332Z"
                                             fill="#323232" />
                                     </svg>

                                     <label><?php esc_html_e( 'Results by Years', 'jove' );?></label>
                                 </div>
                                 <span class="jove-accordion__handle-icon"></span>
                             </div>
                             <jove-checkbox-accordion-content class="jove-accordion__content">
                                 <jove-years-slider min="<?php echo esc_attr( $start_year ); ?>" max="<?php echo esc_attr(date( 'Y' )); ?>" step="1">
                                 </jove-years-slider>
								<jove-date-presets></jove-date-presets>


								
                             </jove-checkbox-accordion-content>
                         </jove-accordion>

                         <?php foreach ( $filters_data as $filter_data ) : ?>
                         <jove-accordion class="jove-accordion"
                             key="<?php echo esc_attr( $filter_data['slug'] ?? '' ); ?>"
                             label="<?php echo esc_attr( $filter_data['label'] ?? '' ); ?>">
                             <?php if ( ! empty( $filter_data['label'] ) ) : ?>
                             <div class="jove-accordion__handle" role="button">
                                 <div class="jove-accordion__handle-text">
                                     <?php echo $filter_data['svg'] ?? ''; ?>
                                     <label><?php echo esc_html( $filter_data['label'] ); ?></label>
                                 </div>
                                 <span class="jove-accordion__handle-icon"></span>
                             </div>
                             <?php endif; ?>

                             <jove-checkbox-accordion-content class="jove-accordion__content">
                                 <jove-multi-select-dropdown>
                                     <select class="jove-multiple-select" multiple="multiple"
                                         data-key="<?php echo esc_attr( $filter_data['slug'] ?? '' ); ?>"
                                         data-autocomplete="<?php echo esc_attr( $filter_data['autocomplete'] ?? '' ); ?>">
                                     </select>
                                     <!-- Custom div to display selected options -->
                                     <div class="jove-selected-options"></div>
                                 </jove-multi-select-dropdown>
                             </jove-checkbox-accordion-content>
                         </jove-accordion>
                         <?php endforeach; ?>
                         <jove-clear-all-filters class="clear-all-filters clear-all-filters--bottom"><button
                                 class="jove-clear-all-filters__btn" disabled ><?php esc_html_e( 'Reset all', 'jove' );?></button>
                                 <button id="jove-apply-all-filters__btn" disabled
                                 class="jove-apply-all-filters__btn"><?php esc_html_e( 'Apply Filter', 'jove' );?></button>
                     </jove-filters>
                 </div>
					 <div class="jove-pagination-wrapper mobile">
                 <button class="jove-filters_heading_text jove-filter-open-button">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M10 18H14V16H10V18ZM3 6V8H21V6H3ZM6 13H18V11H6V13Z" fill="#323232" />
                     </svg>
                     <label><?php esc_html_e( 'Filters', 'jove' );?></label>
                 </button>
                 <jove-pagination></jove-pagination>
             </div>
                 <div class="jove-search__filter-right-col">
                     <jove-results class="jove-search__filter-results"></jove-results>
                     <jove-pagination></jove-pagination>
                 </div>
             </div>
         </jove-search>
     </div>

     <?php
if ( ! $is_preview ) { ?>
 </div>


 <?php } ?>