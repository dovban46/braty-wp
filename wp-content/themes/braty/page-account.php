<?php
/*
 * Template Name: My Account Page
 * Description: A template to display the my account page.
 */

get_header();
?>

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

<?php
get_footer();
