<?php

// single product 
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);


// product-content single
if (!function_exists('edcare_content_single_details')) {
    function edcare_content_single_details()
    {
        global $product;
        global $post;
        global $woocommerce;

        $stock = $product->is_in_stock();
        $rating_count = $product->get_rating_count();
        $review_count = $product->get_review_count();
        $average = $product->get_average_rating();

        $terms = get_the_terms(get_the_ID(), 'product_cat');

        $enable_categories = get_theme_mod('edcare_product_single_categories_switch', true);
        $enable_compare = get_theme_mod('edcare_product_single_compare_switch', true);
        $enable_wishlist = get_theme_mod('edcare_product_single_wishlist_switch', true);

        ?>

        <?php if ($enable_categories): ?>
            <div class="tp-product-details-category">
                <?php echo wc_get_product_category_list($product->get_id(), '<span class="comma">,  </span>', '<span class="posted_in">' . _n('Category:  ', 'Categories:', count($product->get_category_ids()), 'edcare') . '</span> '); ?>

            </div>
        <?php endif; ?>

        <h3 class="tp-product-details-title">
            <?php the_title(); ?>
        </h3>

        <div class="tp-product-details-inventory d-flex align-items-center mb-10">
            <div class="tp-product-details-stock-wrapper">
                <!-- stock / in stock  -->
                <?php if ($stock): ?>
                    <div class="tp-product-details-stock mb-10">
                        <span class="in-stock tp-shop-details-stock">
                            <?php echo esc_html__('In Stock', 'edcare'); ?>
                        </span>
                    </div>
                <?php else: ?>
                    <div class="tp-product-details-stock mb-10">
                        <span class="out-stock tp-shop-details-stock">
                            <?php echo esc_html__('Out Of Stock', 'edcare'); ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="tp-product-details-rating-wrapper d-flex align-items-center mb-10">
                <?php if ($rating_count > 0): ?>
                    <div class="tp-shop-details-ratting-wrap d-flex align-items-center">
                        <div class="tp-product-details-rating">
                            <?php echo wc_get_rating_html($average, $rating_count); ?>
                        </div>
                        <div class="tp-product-details-reviews">
                            <span>
                                <?php if (comments_open()): ?>
                                    <a href="#reviews" class="woocommerce-review-link"
                                        rel="nofollow">(<?php printf(_n('%s Review', '%s Reviews', $review_count, 'edcare'), '<span class="count">' . esc_html($review_count) . '</span>'); ?>)</a>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty(woocommerce_template_single_excerpt())): ?>
            <p><?php woocommerce_template_single_excerpt(); ?></p>
        <?php endif; ?>

        <div class="tp-product-details-price-wrapper mb-20 d-flex flex-wrap align-items-center justify-content-between">
            <div class="tp-shop-product-price">
                <?php echo woocommerce_template_single_price(); ?>
            </div>
        </div>

        <div class="tp-product-details-action-wrapper">
            <!-- add to cart -->
            <?php woocommerce_template_single_add_to_cart(); ?>

            <!-- buy now button -->
            <?php echo buy_now_button(); ?>
        </div>

        <?php if ($enable_wishlist || $enable_compare): ?>
            <div class="tp-product-details-action-sm d-flex align-items-center flex-wrap g-15">

                <?php if ($enable_compare && function_exists('woosc_init')): ?>
                    <div class="tp-product-details-action-sm-btn tp-woo-single-action-compare tp-woo-single-action-sm">
                        <?php echo do_shortcode('[woosc]'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($enable_wishlist && function_exists('woosw_init')): ?>
                    <div class="tp-product-details-action-sm-btn tp-woo-single-action-wishlist tp-woo-single-action-sm">
                        <?php echo do_shortcode('[woosw]'); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- actions -->
        <?php woocommerce_template_single_meta(); ?>

        <?php edcare_product_single_features(); ?>


        <?php
    }
}
add_action('woocommerce_single_product_summary', 'edcare_content_single_details', 4);
