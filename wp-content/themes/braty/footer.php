<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package braty
 */

?>

<footer class="footer ">
	<div class="container">
       <div class="footer-top">
			<img src="<?php the_field('footer_logo', 'option'); ?>" alt="img" class="footer-logo">
          
		
			<div class="nav-block">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'Main-footer-menu',
					'container' => 'nav',
					'container_class' => 'main-menu--footer',
					'menu_class' => 'nav-menu',
				));
				?>
			</div>



        	<div class="contacts-block">
				<div class="contacts-items">
					<a href="tel:<?php the_field('phone', 'option'); ?>" class="contact-item--phone item">
						<img src="<?php the_field('phone_logo', 'option'); ?>" alt="img" class="img">
						<p class="phone"><?php the_field('footer_phone', 'option'); ?></p>
					</a>
				</div>  

				<div class="bot-items">
					<a href="<?php the_field('footer_instagram_link', 'option'); ?>" class="item">
						<img src="<?php the_field('footer_instagram_logo', 'option'); ?>" alt="img" class="img">
					</a>
					<a href="<?php the_field('footer_facebook_link', 'option'); ?>" class="item">
						<img src="<?php the_field('footer_facebook_logo', 'option'); ?>" alt="img" class="img">
					</a>
					<a href="<?php the_field('footer_tik_tok_link', 'option'); ?>" class="item">
						<img src="<?php the_field('footer_tik_tok_logo', 'option'); ?>" alt="img" class="img">
					</a>
				</div>

          	</div>
    	</div>
	</div>


	<div class="footer-bottom">
		<div class="container">
			<p><?php the_field('footer_name', 'option'); ?>©
				<span><?php the_field('footer_years', 'option'); ?></span>
			</p>
		</div>
	</div>  
</footer>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
