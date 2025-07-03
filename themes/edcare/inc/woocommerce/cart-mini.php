<?php


// woocommerce mini cart content
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
?>
    <div class="mini_shopping_cart_box">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.mini_shopping_cart_box'] = ob_get_clean();
    return $fragments;
});

// woocommerce mini cart count icon
if (!function_exists('edcare_header_add_to_cart_fragment')) {
    function edcare_header_add_to_cart_fragment($fragments)
    {
        ob_start();
    ?>
        <span class="cart__count tp-header-action-badge" id="tp-cart-item">
            <?php echo esc_html(WC()->cart->cart_contents_count); ?>
        </span>
    <?php
        $fragments['#tp-cart-item'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'edcare_header_add_to_cart_fragment');


// edcare_shopping_cart
function edcare_shopping_cart()
{
    if (is_null(WC()->cart)) {
        return;
    }
    ob_start();
    ?>
    <!-- cart mini area start -->
    <div class="cartmini__area">
        <div class="cartmini__wrapper d-flex justify-content-between flex-column">
            <div class="cartmini__top-wrapper">
                <div class="cartmini__top p-relative">
                    <div class="cartmini__top-title">
                        <h4><?php print esc_html__('Shopping cart', 'edcare'); ?></h4>
                    </div>
                    <div class="cartmini__close">
                        <button type="button" class="cartmini__close-btn cartmini-close-btn"><i class="fal fa-times"></i></button>
                    </div>
                </div>

                <div class="mini_shopping_cart_box">
                    <?php woocommerce_mini_cart(); ?>
                </div>

            </div>

        </div>
        <div class="header-mini-cart"></div>
    </div>
    <!-- cart mini area end -->

<?php
    return ob_get_clean();
}
