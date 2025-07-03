 <?php
/**
 * Author Info block (parent).
 *
 * @param array  $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id The post ID the block is rendering content against.
 *                     This is either the post ID currently being displayed inside a query loop,
 *                     or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 */

// Support custom id values.
$block_id = wp_unique_prefixed_id( 'jove-block-id-' );
if ( ! empty( $block['anchor'] ) ) {
	$block_id = esc_attr( $block['anchor'] );
}

// Create class attribute allowing for custom "className".
$block_classes = '';
if ( ! empty( $block['className'] ) ) {
	$block_classes .= ' ' . $block['className'];
}
// Grab our alignment class.
$block_classes = '';
if ( '' !== $block['align'] ) {
	$block_classes = 'align' . $block['align'];
}

/**
 * A template string of blocks.
 * Need help converting block HTML markup to an array?
 * 👉 https://happyprime.github.io/wphtml-converter/
 *
 * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-templates/
 */
$inner_blocks_template = array(
	array(
		'core/columns',
		array(
			'verticalAlignment' => 'center',
			'style'             => array(
				'spacing' => array(
					'padding' => array(
						'top'    => 'var:preset|spacing|0',
						'right'  => 'var:preset|spacing|0',
						'bottom' => 'var:preset|spacing|0',
						'left'   => 'var:preset|spacing|0',
					),
				),
			),
		),
		array(
			array(
				'core/column',
				array(
					'verticalAlignment' => 'center',
					'width'             => '',
				),
				array(
					array(
						'core/heading',
						array(
							'level' => 2,
							'content'  => esc_html__('Visualize the world of science','jove'),
						),
						array(),
					),
					array(
						'core/paragraph',
						array(
							'content'  => esc_html__('Discover video protocols for 37 million+ research papers','jove'),
						),
						array(),
					),
                    array(
						'core/search',
						array(
                            'buttonText' => esc_html__('Search','jove'),
                            'placeholder' => __('| Search from 37,123,123 articles in science research','jove'),
						),
						array(),
					),
				),
			),
		),
	),
);

// acf data
$image 	= get_field('image') ? get_field('image') : JOVE_BUILD_URI . '/media/images/Banner.webp';
$style 	= $image ? 'style="background-image: url(' . esc_url($image) . ')"' : '';
?>

 <?php if ( ! $is_preview ) { ?>
 <div <?php
		echo wp_kses_data(
			get_block_wrapper_attributes(
				array(
					'id'    => $block_id,
					'class' => esc_attr( $block_classes ),
				)
			)
		);
		?>>
     <?php } ?>

     <div class="jove-hero-search-block">
     	<div class="jove-hero-search-right-img"  <?php echo $style; ?>></div>
         <InnerBlocks class="jove-hero-search-block__innerblocks" orientation="horizontal"
             template="<?php echo esc_attr( wp_json_encode( $inner_blocks_template ) ); ?>"/>

     </div>
     <?php if ( ! $is_preview ) { ?>
 </div>
 <?php } ?>