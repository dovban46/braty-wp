<?php
/*
 * Template Name: Checkout Page
 * Description: A template to display the checkout page.
 */

get_header();
?>
<div class="nav-title-page">
    <div class="container">
        <?php do_action( 'woocommerce_before_main_content' ); ?>
    </div>
</div>

<div class="container">
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        // Start the loop
        while (have_posts()) : the_post();

            // Display the content of the page
            the_content();

        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->
</div>

<?php
get_footer();
