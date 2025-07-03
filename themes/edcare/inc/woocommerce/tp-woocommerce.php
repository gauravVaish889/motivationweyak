<?php

// shop page hooks
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// content-product hooks--
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);




// breadcrumb hooks
add_action('woocommerce_archive_description', 'woocommerce_breadcrumb', 20);



/*************************************************
## Free shipping progress bar.
 *************************************************/
function edcare_shipping_progress_bar()
{

    $package = WC()->cart->get_shipping_packages()[0];
    $zone = \WC_Shipping_Zones::get_zone_matching_package($package);
    $methods = $zone->get_shipping_methods(true, 'values');


    $initial_message = get_theme_mod('shipping_progress_bar_message_success', 'Your order qualifies for free shipping!');

    if (!empty($methods)) {
        foreach ($methods as $method) {
            if ($method->id == 'free_shipping') {
                $min_amount = str_replace(',', '', $method->instance_settings['min_amount']);
                $cart_total = str_replace(',', '', WC()->cart->get_cart_contents_total());
                $cart_amount = ($cart_total > $min_amount) ? $min_amount : $cart_total;

                $percent = ($cart_amount / $min_amount) * 100;


                $remainder_message = str_replace('[remainder]', wc_price($min_amount - $cart_total), get_theme_mod('shipping_progress_bar_message_initial', 'Add [remainder] to cart and get free shipping!'));
                $success_message = get_theme_mod('shipping_progress_bar_message_success', 'Your order qualifies for free shipping!');

                ?>
                <div class="cartmini__shipping home-2">
                    <?php if ($cart_amount >= $min_amount): ?>
                        <p class="msg-success"><?php echo edcare_kses($success_message); ?></p>
                    <?php else: ?>
                        <p><?php echo edcare_kses($remainder_message); ?> </p>
                    <?php endif; ?>
                    <div class="progress">
                        <div id="shipping-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" style="width: <?php echo esc_attr(intval($percent)); ?>%"
                            aria-valuenow="<?php echo esc_attr(intval($percent)); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <?php
            }
        }
    }
}

if (get_theme_mod('enable_free_shipping_bar') === true) {
    if (get_theme_mod('shipping_progress_bar_location_card_page', false) == true) {
        add_action('woocommerce_before_cart_table', 'edcare_shipping_progress_bar');
    }

    if (get_theme_mod('shipping_progress_bar_location_mini_cart', false) == true) {
        add_action('woocommerce_before_mini_cart_contents', 'edcare_shipping_progress_bar');
    }

    if (get_theme_mod('shipping_progress_bar_location_checkout', false) == true) {
        add_action('woocommerce_checkout_before_customer_details', 'edcare_shipping_progress_bar');
    }
}




/*************************************************
## sale percentage
 *************************************************/

function edcare_sale_percentage()
{
    global $product;
    $output = '';
    $icon = esc_html__("-", 'edcare');

    if ($product->is_on_sale() && $product->is_type('variable')) {
        $percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price('min')) * 100);
        $output .= '<div class="product-percentage-badges"><span class="tp-shop-details-offer">' . $icon . $percentage . '% OFF</span></div>';
    } elseif ($product->is_on_sale() && $product->get_regular_price() && !$product->is_type('grouped')) {
        $percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
        $output .= '<div class="product-percentage-badges">';
        $output .= '<span class="tp-shop-details-offer">' . $icon . $percentage . '%</span>';
        $output .= '</div>';
    }
    return $output;
}


// product add to cart button
function woocommerce_template_loop_add_to_cart($args = array())
{
    global $product;

    if ($product) {
        $defaults = array(
            'quantity' => 1,
            'class' => implode(
                ' ',
                array_filter(
                    array(
                        'cart-button icon-btn button',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                    )
                )
            ),
            'attributes' => array(
                'data-product_id' => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label' => $product->add_to_cart_description(),
                'rel' => 'nofollow',
            ),
        );

        $args = wp_parse_args($args, $defaults);

        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }
    }


    // check product type
    if ($product->is_type('simple')) {
        $btntext = esc_html__("Add to Cart", 'edcare');
    } elseif ($product->is_type('variable')) {
        $btntext = esc_html__("Select Options", 'edcare');
    } elseif ($product->is_type('external')) {
        $btntext = esc_html__("Buy Now", 'edcare');
    } elseif ($product->is_type('grouped')) {
        $btntext = esc_html__("View Products", 'edcare');
    } else {
        $btntext = esc_html__("Add to Cart", 'edcare');
    }


    echo sprintf(
        '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        esc_url($product->add_to_cart_url()),
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr(isset($args['class']) ? $args['class'] : 'tp-product-action-btn-2 tp-product-add-cart-btn cart-button icon-btn button'),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        '
            <span class="loading-icon">
                <svg class="cart_load_spinning" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1V4.2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 13.8V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.34424 3.34399L5.60824 5.60799" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.3921 12.392L14.6561 14.656" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1 9H4.2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.8003 9H17.0003" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.34424 14.656L5.60824 12.392" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.3921 5.60799L14.6561 3.34399" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>

            <svg class="cart-icon" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.34706 4.53799L3.85961 10.6239C3.89701 11.0923 4.28036 11.4436 4.74871 11.4436H4.75212H14.0265H14.0282C14.4711 11.4436 14.8493 11.1144 14.9122 10.6774L15.7197 5.11162C15.7384 4.97924 15.7053 4.84687 15.6245 4.73995C15.5446 4.63218 15.4273 4.5626 15.2947 4.54393C15.1171 4.55072 7.74498 4.54054 3.34706 4.53799ZM4.74722 12.7162C3.62777 12.7162 2.68001 11.8438 2.58906 10.728L1.81046 1.4837L0.529505 1.26308C0.181854 1.20198 -0.0501969 0.873587 0.00930333 0.526523C0.0705036 0.17946 0.406255 -0.0462578 0.746256 0.00805037L2.51426 0.313534C2.79901 0.363599 3.01576 0.5995 3.04042 0.888012L3.24017 3.26484C15.3748 3.26993 15.4139 3.27587 15.4726 3.28266C15.946 3.3514 16.3625 3.59833 16.6464 3.97849C16.9303 4.35779 17.0493 4.82535 16.9813 5.29376L16.1747 10.8586C16.0225 11.9177 15.1011 12.7162 14.0301 12.7162H14.0259H4.75402H4.74722Z" fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6629 7.67446H10.3067C9.95394 7.67446 9.66919 7.38934 9.66919 7.03804C9.66919 6.68673 9.95394 6.40161 10.3067 6.40161H12.6629C13.0148 6.40161 13.3004 6.68673 13.3004 7.03804C13.3004 7.38934 13.0148 7.67446 12.6629 7.67446Z" fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38171 15.0212C4.63756 15.0212 4.84411 15.2278 4.84411 15.4836C4.84411 15.7395 4.63756 15.9469 4.38171 15.9469C4.12501 15.9469 3.91846 15.7395 3.91846 15.4836C3.91846 15.2278 4.12501 15.0212 4.38171 15.0212Z" fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38082 15.3091C4.28477 15.3091 4.20657 15.3873 4.20657 15.4833C4.20657 15.6763 4.55592 15.6763 4.55592 15.4833C4.55592 15.3873 4.47687 15.3091 4.38082 15.3091ZM4.38067 16.5815C3.77376 16.5815 3.28076 16.0884 3.28076 15.4826C3.28076 14.8767 3.77376 14.3845 4.38067 14.3845C4.98757 14.3845 5.48142 14.8767 5.48142 15.4826C5.48142 16.0884 4.98757 16.5815 4.38067 16.5815Z" fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9701 15.0212C14.2259 15.0212 14.4333 15.2278 14.4333 15.4836C14.4333 15.7395 14.2259 15.9469 13.9701 15.9469C13.7134 15.9469 13.5068 15.7395 13.5068 15.4836C13.5068 15.2278 13.7134 15.0212 13.9701 15.0212Z" fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9692 15.3092C13.874 15.3092 13.7958 15.3874 13.7958 15.4835C13.7966 15.6781 14.1451 15.6764 14.1443 15.4835C14.1443 15.3874 14.0652 15.3092 13.9692 15.3092ZM13.969 16.5815C13.3621 16.5815 12.8691 16.0884 12.8691 15.4826C12.8691 14.8767 13.3621 14.3845 13.969 14.3845C14.5768 14.3845 15.0706 14.8767 15.0706 15.4826C15.0706 16.0884 14.5768 16.5815 13.969 16.5815Z" fill="currentColor"></path>
            </svg>
        '
    );
}

// product-content
if (!function_exists('edcare_content_product_list')) {
    function edcare_content_product_list()
    {
        global $product;
        global $post;
        global $woocommerce;
        $rating = wc_get_rating_html($product->get_average_rating());
        $ratingcount = $product->get_review_count();
        $terms = get_the_terms(get_the_ID(), 'product_cat');

        $enable_trending_badge = get_theme_mod('enable_trending_badge', false);
        $enable_hot_badge = get_theme_mod('enable_hot_badge', false);

        $is_product_on_trending = function_exists('tpmeta_field') ? tpmeta_field('edcare_product_on_trending') : '';
        $is_product_on_hot = function_exists('tpmeta_field') ? tpmeta_field('edcare_product_on_hot') : '';

        ?>

        <div class="tp-shop-list-product-item d-flex mb-10">

            <?php if (has_post_thumbnail()): ?>
                <div class="tp-shop-list-product-thumb p-relative">

                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div>
            <?php endif; ?>
            <div class="tp-shop-list-product-content p-relative">

                <div class="tp-shop-product-thumb-tag">
                    <?php echo edcare_sale_percentage(); ?>
                </div>

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
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h4>

                <?php the_excerpt(); ?>

                <div class="tp-shop-product-price">
                    <span><?php echo woocommerce_template_loop_price(); ?></span>
                </div>

                <div class="tp-shop-list-product-btn">
                    <?php $view_details_text = __('View Details', 'edcare'); ?>
                    <a href="<?php the_permalink(); ?>" class="button">
                        <?php echo esc_html($view_details_text); ?>
                    </a>
                </div>

            </div>
        </div>
        <?php
    }
}
add_action('woocommerce_before_shop_loop_item_list', 'edcare_content_product_list', 10);

// buy_now_button
function buy_now_button()
{
    global $product;
    $buy_now_text = __('Buy Now', 'edcare');
    $checkout_url = wc_get_checkout_url();

    return '<a href="' . esc_url(add_query_arg('add-to-cart', $product->get_id(), $checkout_url)) . '" class="tp-product-details-buy-now-btn w-100">' . $buy_now_text . '</a>';
}

// woocommerce_breadcrumb modilfy
if (!function_exists('woocommerce_breadcrumb')) {

    /**
     * Output the WooCommerce Breadcrumb.
     *
     * @param array $args Arguments.
     */
    function woocommerce_breadcrumb($args = array())
    {
        $args = wp_parse_args(
            $args,
            apply_filters(
                'woocommerce_breadcrumb_defaults',
                array(
                    'delimiter' => '<span class="dvdr"></span>',
                    'wrap_before' => '<nav class="woocommerce-breadcrumb tp-woo-breadcrumb">',
                    'wrap_after' => '</nav>',
                    'before' => '',
                    'after' => '',
                    'home' => _x('Home', 'breadcrumb', 'edcare'),
                )
            )
        );

        $breadcrumbs = new WC_Breadcrumb();

        if (!empty($args['home'])) {
            $breadcrumbs->add_crumb($args['home'], apply_filters('woocommerce_breadcrumb_home_url', home_url()));
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        /**
         * WooCommerce Breadcrumb hook
         *
         * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
         */
        do_action('woocommerce_breadcrumb', $breadcrumbs, $args);

        wc_get_template('global/breadcrumb.php', $args);
    }
}
add_action('woocommerce_after_shop_loop_item', 'add_buy_now_button', 10);

/*** Add buy now button ***/
function add_buy_now_button()
{
    global $product;

    // Ensure we are on a product loop
    if (!$product) {
        return;
    }

    // Change 'Buy Now' text if needed
    $buy_now_text = __('Buy Now', 'edcare');

    // Output the button
    echo '<a href="' . esc_url($product->add_to_cart_url()) . '" class="button alt">' . $buy_now_text . '</a>';
}

/*** Handle for click on buy now ***/
function tp_wc_handle_buy_now()
{
    if (!isset($_REQUEST['tp-wc-buy-now'])) {
        return false;
    }

    $product_id = absint($_REQUEST['tp-wc-buy-now']);
    $quantity = absint($_REQUEST['quantity']) ?? 1;

    if (isset($_REQUEST['variation_id'])) {

        $variation_id = absint($_REQUEST['variation_id']);
        WC()->cart->add_to_cart($product_id, 1, $variation_id);
    } else {
        WC()->cart->add_to_cart($product_id, $quantity);
    }

    wp_safe_redirect(wc_get_checkout_url());
    exit;
}
add_action('wp_loaded', 'tp_wc_handle_buy_now');



/*** product single features ***/
function edcare_product_single_features()
{
    $defaults = [
        [
            'tp_product_message' => esc_html__('30 days easy returns', 'edcare'),
        ],
    ];

    $features_list = get_theme_mod('edcare_product_single_fea_meta', $defaults);

    $payment_switch = get_theme_mod('edcare_product_single_payment_switch', false);
    $payment_text = get_theme_mod('edcare_product_single_payment_text', 'Guaranteed safe & secure checkout');
    $payment_img = get_theme_mod('edcare_product_single_payment_img');


    ?>

    <div class="tp-product-details-msg mb-15">
        <ul>
            <?php foreach ($features_list as $feature): ?>
                <li><?php echo edcare_kses($feature['tp_product_message']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php if ($payment_switch == true): ?>
        <div class="tp-product-details-payment d-flex align-items-center flex-wrap justify-content-between">
            <?php if (!empty($payment_text)): ?>
                <p><?php echo esc_html($payment_text); ?></p>
            <?php endif; ?>

            <?php if (!empty($payment_img)): ?>
                <img src="<?php echo esc_url($payment_img); ?>" alt="<?php echo esc_attr__('payment-img', 'edcare'); ?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php
}
