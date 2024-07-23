<?php
get_header();
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        gtag("event", "search");
    });
</script>
<section class="search-section">
    <div class="container">
        <div class="search-products">
            <?php

            $search_query = get_search_query();

            // Set up arguments to query products that match the search query
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => -1,
                's'              => $search_query,
            );

            // Query for products matching the search query
            $query = new WP_Query($args);

            // Check if we have any posts
            if ($query->have_posts()) :
                // Loop through the posts
                while ($query->have_posts()) :
                    $query->the_post();
                    // Log the product title
                    error_log('Product Title: ' . get_the_title());
                    // Include product content
                    wc_get_template_part('content', 'product');
                endwhile;
                ?>
                <?php
            endif;

            // Restore original post data
            wp_reset_postdata();


            // Set up arguments to query all products
            $all_products_args = array(
                'post_type'      => 'product',
                'posts_per_page' => -1,
            );

            // Query for all products
            $all_products_query = new WP_Query($all_products_args);

            // Check if we have any posts
            if ($all_products_query->have_posts()) :
                // Initialize an array to store similar products
                $similar_products = array();
                // Loop through the posts
                while ($all_products_query->have_posts()) :
                    $all_products_query->the_post();
                    $product_name = strtolower(get_the_title());
                    similar_text($search_query, $product_name, $similarity);

                    // Define the similarity threshold
                    $similarityThreshold = 40; // Adjust as needed

                    // Check if similarity meets the threshold
                    if ($similarity >= $similarityThreshold) {
                        // Add the product to the similar products array
                        $similar_products[] = $post;
                    }
                endwhile;

                // Display similar products
                if (!empty($similar_products)) :
                    global $post; // Зберігаємо глобальний пост
                    $original_post = $post; // Зберігаємо оригінальний пост
                
                    // Обмежуємо кількість схожих товарів до 20
                    $similar_products = array_slice($similar_products, 0, 20);
                
                    foreach ($similar_products as $similar_product) :
                        $post = get_post($similar_product->ID); // Отримуємо дані про товар
                        setup_postdata($post); // Встановлюємо пост дані
                
                        // Виводимо товар
                        wc_get_template_part('content', 'product');
                
                    endforeach;
                
                    $post = $original_post; // Відновлюємо оригінальний пост
                    wp_reset_postdata(); // Відновлюємо глобальні змінні посту
                
                endif;
                

                // Restore original post data
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <div class="more-products">
            <button id="show-more-btn"><?php echo esc_html('▾ Дивитись більше');?></button>
        </div>

    </div>
    
</section>
<?php
get_footer();
?>
