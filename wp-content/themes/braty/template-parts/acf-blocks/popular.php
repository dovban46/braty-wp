<section class="popular">
    <div class="container">
        <h2><?php the_sub_field('title'); ?></h2>
        <?php
        // Query the newest products excluding products from category 'Додатки'
        $args = array(
            'post_type'      => 'product',
            'orderby'        => 'date', // Order by publication date
            'order'          => 'DESC', // Display in descending order (newest first)
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => 'додатки', 
                    'operator' => 'NOT IN',
                ),
            ),
        );

        $newest_products = new WP_Query($args);

        if ($newest_products->have_posts()) : ?>
            <div class="swiper-container swiper-popular">
                <div class="swiper-wrapper">
                    <?php while ($newest_products->have_posts()) : $newest_products->the_post(); ?>
                        <div class="swiper-slide">
                            <?php wc_get_template_part('content', 'product'); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="swiper-navigation-popular">
                <div class="swiper-button-prev swiper-popular-prev"></div>
                <div class="swiper-button-next swiper-popular-next"></div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
        <div class="more-products">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="more-product-button"><?php echo esc_html('▾ Більше товарів'); ?></a>
        </div>
    </div>
</section>
