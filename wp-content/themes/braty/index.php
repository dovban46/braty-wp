<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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