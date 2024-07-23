<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<section class="single-product">
    <div class="container">
        <?php
        /**
         * woocommerce_before_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         */
        do_action('woocommerce_before_main_content');
        ?>


        <?php while (have_posts()): the_post(); ?>

            <div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
                <div class="custom-product-summary">
                    <div class="col-md-5">
                        <div id="productMainImage" class="text-center position-relative">
                            <div class="gallery">
                                <?php

                                $main_image_id = $product->get_image_id();
                                $gallery_images_ids = $product->get_gallery_image_ids();

                                // Check if there are gallery images
                                if (!empty($gallery_images_ids)) {
                                    // Display placeholder for main image if not available
                                    if ($main_image_id) {
                                        $main_src = wp_get_attachment_image_src($main_image_id, 'large');
                                        if ($main_src) {
                                            echo "<a class='single-img' data-src='$main_src[0]'>";
                                            echo wp_get_attachment_image($main_image_id, 'full', false, array('class' => 'product-img', 'alt' => ''));
                                            echo '</a>';
                                        }
                                    }

                                    // Loop through gallery images
                                    foreach ($gallery_images_ids as $gallery_image_id) {
                                        $image_src = wp_get_attachment_image_src($gallery_image_id, 'large');
                                        $image_alt = get_post_meta($gallery_image_id, '_wp_attachment_image_alt', true);
                                        echo "<a class='single-img' data-src='$image_src[0]'>";
                                        echo wp_get_attachment_image($gallery_image_id, 'thumbnail', false, array('class' => 'product-img', 'alt' => $image_alt));
                                        echo '</a>';
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            if ($main_image_id) {
                                echo wp_get_attachment_image($main_image_id, 'full', false, array('class' => 'img-fluid product-img--single', 'alt' => 'Main Product Image'));
                            } else {
                                echo '<img src="' . wc_placeholder_img_src() . '" class="img-fluid product-img--single" alt="Main Product Image">';
                            }
                            ?>
                            <div class="swiper-navigation-single-product">
                                <div class="swiper-button-prev swiper-single-product-prev"></div>
                                <div class="swiper-button-next swiper-single-product-next"></div>
                            </div>
                            
                        </div>
                        <div class="single-product-pagination"></div>
                        <div id="productImageSlider" class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                $gallery_images_ids = $product->get_gallery_image_ids();
                                if (!empty($gallery_images_ids)) {
                                    foreach ($gallery_images_ids as $gallery_image_id) {
                                        echo '<div class="swiper-slide">';
                                        echo wp_get_attachment_image($gallery_image_id, 'thumbnail', false, array('class' => 'product-img', 'alt' => 'Product Image'));
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="product-info">
                        <?php do_action('custom_single_product_meta'); ?>
                        <div class="title-product">
                            <?php
                                do_action('custom_single_product_title');
                                do_action('custom_single_product_weight');
                            ?>
                        </div>
                        <?php
                            display_discounted_price_block();
                            do_action('custom_single_product_additional_info');
                        ?>

                        <?php
                        
                        global $product;

                        if ($product && $product->is_type('variable')) {

                        } else {

                        ?>
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
                        <?php
                        }
                        ?>


                        <?php 
                            do_action('custom_single_product_add_to_cart'); 
                            do_action('woocommerce_single_product_summary');
                        ?>
                    </div>
                </div>
                
                <?php
                /**
                 * woocommerce_after_single_product_summary hook.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
                do_action( 'woocommerce_after_single_product_summary' );
                ?>
            </div>

        <?php endwhile; // end of the loop. ?>

    </div>
</section>


<sections class="add-to-order-single">
    <div class="container">
    <?php
    $additional_products = get_additional_products();
    if (!empty($additional_products)) :
    ?>
        <h2><?php echo esc_html('Додати до замовлення:'); ?></h2>
        <div class="additional-products-slider">
            <div class="swiper-container swiper-add-to-order-single">
                <div class="swiper-wrapper">
                    <?php foreach ($additional_products as $additional_product) : ?>
                        <div class="swiper-slide product-item">
                            <div class="product-item-img">
                                <?php echo $additional_product->get_image(); ?>
                            </div>
                            <div class="product-item-info">
                                <div class="title-price">
                                    <p class="product-item-title">
                                        <?php echo $additional_product->get_name(); ?>
                                        <?php if ($additional_product->get_weight()) : ?>
                                            <span><?php echo $additional_product->get_weight() . ' г'; ?></span>
                                        <?php endif; ?>
                                    </p>
                                    <div class="product-item-price">+<?php echo $additional_product->get_price_html(); ?></div>
                                </div>

                                <div class="product-item-add-to-cart">
                                    <?php
                                    $product_id = $additional_product->get_id();
                                    $product_in_cart = false;
                                    $cart = WC()->cart->get_cart();
                                    
                                    foreach( $cart as $cart_item_key => $values ) {
                                        $_product = $values['data'];
                                        if ( $_product->get_id() == $product_id ) {
                                            $product_in_cart = true;
                                            break;
                                        }
                                    }
                                    
                                    if ( $product_in_cart ) {
                                        ?>
                                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="product-item-button view-cart-button">
                                            <?php echo esc_html('Дивитися кошик') . ' <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.7071 7.57085C17.0976 7.96137 17.0976 8.59454 16.7071 8.98506L10.3431 15.349C9.95262 15.7395 9.31946 15.7395 8.92893 15.349C8.53841 14.9585 8.53841 14.3253 8.92893 13.9348L14.5858 8.27795L8.92893 2.6211C8.53841 2.23058 8.53841 1.59741 8.92893 1.20689C9.31946 0.816362 9.95262 0.816362 10.3431 1.20689L16.7071 7.57085ZM0 7.27795L16 7.27795V9.27795L0 9.27795L0 7.27795Z" fill="#B5B5B5"/>
</svg>
'; ?>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="?add-to-cart=<?php echo $product_id; ?>" class="product-item-button add-to-cart-button">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/button-cart.svg" alt="Кошик">
                                            <?php echo esc_html('В Корзину'); ?>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>


                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-navigation">
                <div class="swiper-button-prev swiper-add-to-order-single-prev"></div>
                <div class="swiper-button-next swiper-add-to-order-single-next"></div>
            </div>
        </div>
    <?php endif; ?>

    </div>
</sections>





<section class="reviews-single">
    <div class="container">

    <?php
    // Get product ID
    $product_id = get_the_ID();

    // Query for WooCommerce product reviews
    $args = array(
        'post_id' => $product_id, // Product ID
        'status' => 'approve', // Approved reviews
        'number' => 5, // Number of reviews to display
        // Add any other parameters as needed
    );
    $reviews = get_comments( $args );

    // Check if there are any reviews
    if ( $reviews ) {
        ?>
        <!-- HTML structure for the reviews slider -->
        <div class="client-comments-wrapper swiper-container swiper-comment">
            <h3><?php echo esc_html('Відгуки'); ?></h3>
            <div class="swiper-wrapper">
                <!-- Each review item -->
                <?php foreach ( $reviews as $review ) : ?>
                    <div class="swiper-slide comment-client">
                        <!-- Review content -->
                        <div class="client-info">
                            <div class="buyer-info">
                                <p class="client-name"><?php echo $review->comment_author; ?></p>
                            </div>

                            <div class="rating-date">
                                <p class="date"><?php echo get_comment_date( 'm.d.Y', $review->comment_ID ); ?></p>
                                <?php
                                // Get the rating value
                                $rating = intval(get_comment_meta($review->comment_ID, 'rating', true));

                                // Determine the color of the stars based on the rating value
                                $star_color_class = ($rating > 0) ? 'purple' : 'gray';

                                // Output the stars and the rating value
                                ?>
                                <div class="rating">
                                    <div class="stars">
                                        <?php
                                        // Output purple stars if rating is greater than 0, otherwise output gray stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<span class="comment-star-rating ' . $star_color_class . '">&#9733;</span>'; // Full star
                                            } else {
                                                echo '<span class="comment-star ' . $star_color_class . '">&#9733;</span>'; // Empty star
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if (strlen($review->comment_content) > 150) : ?>
                                <div class="comment-container">
                                    <p class="comment"><?php echo substr($review->comment_content, 0, 150); ?><span class="comment-overflow"><?php echo substr($review->comment_content, 150); ?></span></p>
                                    <button class="show-more-btn"><?php echo esc_html('Детальніше'); ?></button>
                                </div>
                            <?php else : ?>
                                <p class="comment"><?php echo $review->comment_content; ?></p>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- If you need pagination -->
            <div class="reviews-slider__pagination"></div>
        </div>
        <?php
    } 
    ?>

        <div class="show-review-block">
            <a id="show-review-form"><?php echo esc_html('▾ Залишити відгук'); ?></a>
        </div>

        <form id="custom-review-form" method="post">

            <h3><?php echo esc_html('Залишити відгук'); ?></h3>

            <div class="rating">
                <label class="your-rating"><?php echo esc_html("Ваша оцінка"); ?></label>
                <div id="rating-stars">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <span class="star" data-rating="<?php echo $i; ?>">&#9733;</span>
                    <?php } ?>
                </div>
                <input type="hidden" name="rating" id="custom-rating" required>
            </div>

            <div class="one-line">
                <p>
                    <label for="custom-name"><?php echo esc_html("Ім'я"); ?></label>
                    <input type="text" name="custom_name" id="custom-name" placeholder="Введіть ваше ім'я" required>
                </p>

                <p>
                    <label for="custom-phone"><?php echo esc_html('Номер телефону'); ?></label>
                    <input type="tel" name="custom_phone" id="custom-phone" placeholder="+38(0ХХ) ХХХ ХХ ХХ" required>
                </p>
            </div>
                
            <p>
                <label for="custom-comment"><?php echo esc_html('Ваш відгук'); ?></label>
                <textarea name="custom_comment" id="custom-comment" placeholder="Введіть ваш коментар"></textarea>
            </p>

            <input type="hidden" name="product_id" value="<?php echo get_the_ID(); ?>">
            <p class="save-info">
                <input type="radio" name="save_info" id="save-info" value="yes">
                <label for="save-info"><?php echo esc_html("Зберегти мої імʼя та телефон, для подальших коментарів"); ?></label>
            </p>
            <p class="form-submit">
                <input type="submit" name="submit_custom_review" value="<?php echo esc_html('Надіслати відгук'); ?>">
            </p>
        </form>

    </div>
</section>











<section class="similar-section">
    <div class="container">
        <?php
            // Now let's get similar products based on category level
        $categories = wp_get_post_terms(get_the_ID(), 'product_cat');
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 5, // Change the number as needed
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => $category_ids,
                        'operator' => 'IN'
                    )
                )
            );

            $similar_products = new WP_Query($args);

            if ($similar_products->have_posts()) : ?>
                <h3><?php echo 'Cхожі пропозиції';?></h3>
                <div class="swiper-container swiper-similar">
                    <div class="swiper-wrapper">
                        <?php while ($similar_products->have_posts()) : $similar_products->the_post(); ?>
                            <div class="swiper-slide">
                                <?php wc_get_template_part('content', 'product'); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="swiper-navigation-similar">
                    <div class="swiper-button-prev swiper-similar-prev"></div>
                    <div class="swiper-button-next swiper-similar-next"></div>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif;
        }
        ?>
    </div>
</section>



<?php get_footer( 'shop' ); ?>
