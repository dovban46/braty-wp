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

$current_cat_id = get_queried_object_id();

// Get the current category object
$current_cat = get_term($current_cat_id, 'product_cat');

// Check if the current category is a first-level category
$is_first_level_category = $current_cat->parent == 0;

if ($is_first_level_category) {
	get_header( 'shop' );
    ?>
    <div class="nav-title-page">
        <div class="container">
            <?php do_action( 'woocommerce_before_main_content' ); ?>
        </div>
    </div>
    

<?php
// Get the current category title
$category_title = single_cat_title('', false);
?>

<section class="taxonomy-product-cart">
    <div class="container">
        <div class="section__header section-header">
            <h2 class="particle__title"><?php echo esc_html($category_title); ?></h2>
        </div>




        <?php
// Get the category ID
$category = get_queried_object();
$category_id = $category->term_id;

// Query for child categories
$child_categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'parent' => $category_id,
));

if (!empty($child_categories)) : ?>
    <h2 class="subcategory-title"><?php echo esc_html('Підкатегорії'); ?></h2>
    <div class="container-subcategory-swiper">
        <div class="swiper-container swiper-caterogy-page">
            <div class="swiper-wrapper">
                <?php
                // Loop through child categories
                foreach ($child_categories as $child_category) :
                    $thumbnail_id = get_term_meta($child_category->term_id, 'thumbnail_id', true);
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    ?>
                    <div class="swiper-slide particle__item">
                        <a href="<?php echo esc_url(get_term_link($child_category)); ?>">
                            <div class="particle__item-image"><img src="<?php echo esc_url($image_url); ?>" alt="" class="rounded"></div>
                        </a>
                        <div class="subcategory-info">
                            <div class="particle__item-title"><?php echo esc_html($child_category->name) . '  ('. esc_html($child_category->count) . ')' ?></div>
                            <div class="button-subcategory">
                                <a href="<?php echo esc_url(get_term_link($child_category)); ?>" class="particle__item-button"><?php echo esc_html('Перейти') . '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.7071 7.57085C17.0976 7.96137 17.0976 8.59454 16.7071 8.98506L10.3431 15.349C9.95262 15.7395 9.31946 15.7395 8.92893 15.349C8.53841 14.9585 8.53841 14.3253 8.92893 13.9348L14.5858 8.27795L8.92893 2.6211C8.53841 2.23058 8.53841 1.59741 8.92893 1.20689C9.31946 0.816362 9.95262 0.816362 10.3431 1.20689L16.7071 7.57085ZM0 7.27795L16 7.27795V9.27795L0 9.27795L0 7.27795Z" fill="#B5B5B5"/>
                                </svg>
                                '?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="swiper-navigation">
            <div class="swiper-button-prev swiper-category-page-prev"></div>
            <div class="swiper-button-next swiper-category-page-next"></div>
        </div>
    </div>
<?php endif; ?>



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

                        <div class="mobile-version swiper-container swiper-category-mobile-page">
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
                                <div class="swiper-button-prev swiper-category-product-prev"></div>
                                <div class="swiper-button-next swiper-category-product-next"></div>
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
	get_footer( 'shop' );
} else {
	include(get_template_directory() . '/woocommerce/archive-product.php' );
}
?>
