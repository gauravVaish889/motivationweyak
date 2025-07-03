<?php

// review comment action
remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);
remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10);
remove_action('woocommerce_review_meta', 'woocommerce_review_display_meta', 10);
remove_action('woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10);

add_action( 'woocommerce_review_before', 'custom_modify_review_before', 10, 1 );
add_action( 'woocommerce_review_before_comment_meta', 'edcare_product_single_rating', 10, 1 );
add_action( 'woocommerce_review_meta', 'edcare_product_single_meta', 10, 1 );
add_action( 'woocommerce_review_comment_text', 'edcare_product_single_review_text', 10, 1 );


function custom_modify_review_before( $comment ) {
    $custom_avater = get_the_author_meta( 'edcare_author_avater' );
    $author_name = get_the_author_meta( 'display_name' );
    ?>
    <div class="tp-product-details-review-avater-thumb">
        <?php if(!empty($custom_avater)) : ?>
            <img src="<?php echo esc_url($custom_avater); ?>" alt="<?php echo esc_attr($author_name) ?>">
        <?php else: ?>
            <?php print get_avatar( $comment, 90,);?>  
        <?php endif; ?>
    </div>
    <?php
}


function edcare_product_single_rating( $comment ) {
    $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

    if ( $rating && wc_review_ratings_enabled() ) : ?>
        <div class="tp-product-details-review-avater-rating">
            <?php echo wc_get_rating_html( $rating ); ?>
        </div>
    <?php endif;
}

function edcare_product_single_meta( $comment ) {
    ?>
    <div class="tp-product-details-review-user">
        <h4 class="tp-product-details-review-avater-title"><?php echo get_comment_author(); ?></h4>
        <span class="tp-product-details-review-avater-meta"><?php echo get_comment_date(); ?></span>
    </div>
    <?php
}

function edcare_product_single_review_text( $comment ) {
    ?>
    <div class="tp-product-details-review-avater-comment">
        <?php comment_text(); ?>
    </div>
    <?php
}