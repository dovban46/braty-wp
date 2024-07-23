<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<li <?php wc_product_class( '', $product ); ?>>
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );

    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    do_action( 'woocommerce_before_shop_loop_item_title' );

    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     */
    ?>
    <div class="title-weight">
    <?php
    do_action( 'woocommerce_shop_loop_item_title' );
    // Add weight
    if ( $product->has_weight() ) {
        echo '<div class="product-weight">' . ', ' . esc_html( $product->get_weight() ) . esc_html( 'г' ) . '</div>';
    }
    ?>
    </div>
    <?php
    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    ?>
    <div class="rating-price">
        <?php
        do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
    </div>
    <?php

    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    do_action( 'woocommerce_after_shop_loop_item' );

    if ( $product->get_short_description() ) {
        echo '<div class="product-short-description">' . wp_trim_words( $product->get_short_description(), 10 ) . '</div>';
    }
   
?>
    <?php if (strlen($product->get_description()) > 80) : ?>
        <div class="description-container">
            <p class="description"><?php echo substr($product->get_description(), 0, 80); ?><span class="description-overflow"><?php echo substr($product->get_description(), 80); ?></span></p>
            <button class="show-more-btn-action"><?php echo esc_html('Детальніше'); ?></button>
        </div>
    <?php else : ?>
        <p class="description"><?php echo $product->get_description(); ?></p>
    <?php endif; ?>
</li>
