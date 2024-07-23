<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package braty
 */

get_header();
?>
	<section class="nav-title-page">
		<div class="container">
			<?php do_action('woocommerce_before_main_content'); ?>
		</div>
	</section>
	

	<?php 
        the_acf_loop();
    ?> 

<?php
get_footer();
