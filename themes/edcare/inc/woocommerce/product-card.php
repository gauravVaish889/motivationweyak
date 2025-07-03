<?php

// product-content archive
if (!function_exists('edcare_content_product_grid')) {
    function edcare_content_product_grid()
    {
        edcare_product_grid();
    }
}

add_action('woocommerce_before_shop_loop_item', 'edcare_content_product_grid', 10);

function edcare_product_grid()
{

    global $product;
    global $post;
    global $woocommerce;
    $rating = wc_get_rating_html($product->get_average_rating());
    $terms = get_the_terms(get_the_ID(), 'product_cat');

    if (!$product->is_purchasable()) {
        return;
    }

    ?>

    <div class="tp-shop-product-item text-center mb-30">

        <?php if (has_post_thumbnail()): ?>
            <div class="tp-shop-product-thumb p-relative">
                <?php the_post_thumbnail('full', ['class' => 'w-100']); ?>

                <div class="tp-shop-product-thumb-btn">
                    <?php do_action('woocommerce_before_add_to_cart_button'); ?>

                    <?php $view_details_text = __('View Details', 'edcare'); ?>
                    <a href="<?php the_permalink(); ?>" class="button">
                        <?php echo esc_html($view_details_text); ?>
                    </a>
                </div>

                <div class="tp-shop-product-thumb-tag">
                    <?php echo edcare_sale_percentage(); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="tp-shop-product-content">
            <div class="tp-shop-product-tag">
                <?php foreach ($terms as $key => $term):
                    $count = count($terms) - 1;

                    $name = ($count > $key) ? $term->name . ', ' : $term->name
                        ?>
                    <span>
                        <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
                    </span>

                <?php endforeach; ?>
            </div>

            <h4 class="tp-shop-product-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>

            <div class="tp-shop-product-price">
                <span><?php echo woocommerce_template_loop_price(); ?></span>
            </div>
        </div>
    </div>
    <?php
}
