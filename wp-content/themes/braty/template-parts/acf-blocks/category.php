<section class="category-columns">
    <div class="container">
        <h2><?php the_sub_field('title'); ?></h2>

            <?php

            $product_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => 0, // Get only the first level categories
                'hide_empty' => true, // Show all categories, including empty ones
            ));

            $excluded_categories = array('Uncategorized', 'Додатки'); // Replace with the names of the categories you want to exclude

            $product_categories = array_filter($product_categories, function($category) use ($excluded_categories) {
                $category_name = strtolower($category->name);
                foreach ($excluded_categories as $excluded_category) {
                    if (strtolower($excluded_category) === $category_name) {
                        return false;
                    }
                }
                return true;
            });
            ?>
            <div class="pc-category">
            <?php
            // Loop through the filtered categories (excluding Uncategorized)
            foreach ($product_categories as $category) {
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $category_link = get_term_link($category);
                $image = wp_get_attachment_url($thumbnail_id);

                echo '<div class="category" data-category-id="' . esc_attr($category->term_id) . '">';
                echo '<a class="link-category" href="' . esc_url($category_link) . '">';
                echo '<img class="image-category" src="' . esc_url($image) . '" alt="' . esc_attr($category->name) . '">';
                echo '</a>';
                echo '<div class="category-info">';
                echo '<a class="title-caterogy" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '  (' . esc_html($category->count) . ')' . '</p>' . '</a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            </div>


        <div class="mobile-category swiper-container swiper-category">
            <div class="swiper-wrapper">
                <?php
                foreach ($product_categories as $category) {
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $category_link = get_term_link($category);
                    $image = wp_get_attachment_url($thumbnail_id);
                    echo '<div class="swiper-slide category" data-category-id="' . esc_attr($category->term_id) . '">';
                    echo '<img class="image-category" src="' . esc_url($image) . '" alt="' . esc_attr($category->name) . '">';
                    echo '<div class="category-info">';
                    echo '<a class="title-caterogy" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '  ('. esc_html($category->count) . ')'  . '</a>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="swiper-navigation">
            <div class="swiper-button-prev swiper-category-prev"></div>
            <div class="swiper-button-next swiper-category-next"></div>
        </div>

    </div>  
</section>


