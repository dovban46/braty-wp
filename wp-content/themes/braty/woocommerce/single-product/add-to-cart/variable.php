<?php
/**
 * Variable product add to cart
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
    <?php else : ?>
        <table class="variations" cellspacing="0">
            <tbody>
                <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                    <tr>
                        <td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
                        <td class="value">
                            <?php
                                wc_dropdown_variation_attribute_options( array(
                                    'options'   => $options,
                                    'attribute' => $attribute_name,
                                    'product'   => $product,
                                    'selected'  => isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( wp_unslash( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name )
                                ) );
                                echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
        
        <div class="rating-price">
            <div class="price-description">
                <?php
                    do_action('custom_single_product_price');
                    do_action('custom_single_product_excerpt');
                ?>
            </div>
            <?php do_action('custom_single_product_rating'); ?>
        </div>

        <div class="product-allergens">
            <?php
            $allergens = get_field('allergens');

            if (!empty($allergens)) {
                echo '<label class="product-allergens-toggle">' . 
                    '<svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">' . 
                        '<path d="M9.74792 0.563049L4.87396 5.43701L0 0.563049H9.74792Z" fill="#B5B5B5"/>' . 
                    '</svg>' . 
                    esc_html(' Алергени') . 
                '</label>' . 
                '<div class="product-allergens-content" style="display: none;">' . 
                    '<ul>';

                $allergens = explode(',', $allergens);
                foreach ($allergens as $allergen) {
                    $allergen = trim($allergen);
                    echo '<li>' . $allergen . '</li>';
                }

                echo '</ul>' . 
                '</div>';
            } 
            ?>
        </div>

        <div class="single_variation_wrap">
            <?php
                /**
                 * Hook: woocommerce_before_single_variation.
                 */
                do_action( 'woocommerce_before_single_variation' );

                /**
                 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
                 * @since 2.4.0
                 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                 */
                do_action( 'woocommerce_single_variation' );

                /**
                 * Hook: woocommerce_after_single_variation.
                 */
                do_action( 'woocommerce_after_single_variation' );
            ?>
        </div>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    <?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
