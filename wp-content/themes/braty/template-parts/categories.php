<div class="swiper-container swiper-menu-category ">
  <ul class="swiper-wrapper">
    <?php

    $product_categories = get_terms(array(
      'taxonomy' => 'product_cat',
      'parent' => 0, // Get only the first level categories
      'hide_empty' => false, // Show all categories, including empty ones
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

    // Loop through the filtered categories (excluding Uncategorized)
    foreach ($product_categories as $category) {

      $category_link = get_term_link($category);
      echo '<li class="swiper-slide" data-category-id="' . esc_attr($category->term_id) . '">';
      echo '<a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
      echo '</li>';
    }
    ?>
  </ul>
  <div class="swiper-navigation">
    <div class="swiper-button-prev swiper-menu-prev"></div>
    <div class="swiper-button-next swiper-menu-next"></div>
  </div>
</div>
