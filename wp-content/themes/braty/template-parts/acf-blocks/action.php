<section class="action">
    <div class="container">
        <h2><?php the_sub_field('title'); ?></h2>
        <?php
        // Query products with discount
        $args = array(
            'post_type'      => 'product',
            'orderby'        => 'date', // Order by publication date
            'order'          => 'DESC', // Display in descending order (newest first)
            'meta_query'     => array(
                'relation' => 'OR',
                array( // Products with a regular sale price
                    'key'     => '_sale_price',
                    'value'   => 0,
                    'compare' => '>',
                    'type'    => 'NUMERIC'
                ),
                array( // Variable products with variations on sale
                    'key'     => '_min_variation_sale_price',
                    'value'   => 0,
                    'compare' => '>',
                    'type'    => 'NUMERIC'
                )
            )
        );

        $discounted_products = new WP_Query($args);

        if ($discounted_products->have_posts()) : ?>
            <div class="swiper-container swiper-newest">
                <div class="swiper-wrapper">
                    <?php while ($discounted_products->have_posts()) : $discounted_products->the_post(); ?>
                        <div class="swiper-slide">
                            <?php wc_get_template_part('content', 'product'); ?>
                            
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="swiper-navigation-action">
                <div class="swiper-button-prev swiper-newest-prev"></div>
                <div class="swiper-button-next swiper-newest-next"></div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</section>
