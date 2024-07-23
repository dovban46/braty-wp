<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
?>
    <div class="nav-title-page">
        <div class="container">
            <?php do_action( 'woocommerce_before_main_content' ); ?>
        </div>
    </div>
<?php
// Get the current category
$current_cat = get_queried_object();
$current_cat_id = get_queried_object_id();

// Check if the current category has children
$child_categories = get_terms( array(
    'taxonomy' => 'product_cat',
    'parent' => $current_cat_id,
	'exclude' => array( get_option( 'default_product_cat' ) )
) );
?>
<section class="subcategory-cat">
    <div class="container">
		<!-- Category title markup -->
		<h2 class="subcategory-title"><?php echo esc_html( $current_cat->name ); ?></h2>

		<div class="product-category">
            <div class="section-title">
                <h2 class="title"><?php echo esc_html('Пропозиції'); ?></h2>
            </div>
            <div class="row mob-rev">
            <div class="col-md-12">
                    <?php 
                    if ( woocommerce_product_loop() ) {

                        /**
                         * Hook: woocommerce_before_shop_loop.
                         *
                         * @hooked woocommerce_output_all_notices - 10
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
                        ?>
                        <div class="filter">
                            <?php
                            echo esc_html('Сортувати:');
                            do_action( 'woocommerce_before_shop_loop' );
                            ?>
                        </div>

                        <div class="pc-version">
                            <?php
                            woocommerce_product_loop_start();
                            if ( wc_get_loop_prop( 'total' ) ) {
                                while ( have_posts() ) {
                                    the_post();

                                    /**
                                     * Hook: woocommerce_shop_loop.
                                     */
                                    do_action( 'woocommerce_shop_loop' );

                                    wc_get_template_part( 'content', 'product' );
                                }
                            }
                            ?>
                        </div>

                        <div class="mobile-version swiper-container swiper-subcategory-mobile-page">
                            <div class="swiper-wrapper">
                                <?php
                                if ( wc_get_loop_prop( 'total' ) ) {
                                    while ( have_posts() ) {
                                        the_post();
                                        echo '<div class="swiper-slide">';
                                        wc_get_template_part( 'content', 'product' );
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="swiper-navigation-mobile">
                                <div class="swiper-button-prev swiper-subcategory-product-prev"></div>
                                <div class="swiper-button-next swiper-subcategory-product-next"></div>
                            </div>
                        </div>

                        <?php

                        woocommerce_product_loop_end();

                        /**
                         * Hook: woocommerce_after_shop_loop.
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                    } else {
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action( 'woocommerce_no_products_found' );
                    }
                    ?>
                </div>
        </div>
    </div>
</section>

<?php 
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
//do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
