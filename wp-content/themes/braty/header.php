<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package braty
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header">
    <div class="container">
      
		<div class="header-top">
			<img src="<?php the_field('header_logo', 'option'); ?>" alt="img" class="header-logo">
			<div class="nav-block-header">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'Main-menu',
					'container' => 'nav',
					'container_class' => 'main-menu--header',
					'menu_class' => 'nav-menu-header',
				));
				?>
			</div>
			<div class="contacts-block-header">
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
			<div class="icons-block">
				<div class="search-block-top">
					<?php echo get_search_form(); ?>
				</div>
				<?php my_custom_account_icon(); ?>
				<?php my_custom_cart_icon(); ?>
			</div>
		</div>
	</div>

		<div class="header-bottom">
			<div class="container">
				<div class="menu-header-category">
					<?php include(get_template_directory() . '/template-parts/categories.php');  ?>
				</div>
				<div class="search-block">
					<?php echo get_search_form(); ?>
				</div>
			</div>
		</div>

  </div>
</header>
<!-- Add this at the end of your HTML body -->
<!-- Add this at the end of your HTML body -->
<button id="scrollToTopBtn" title="Back to top">
    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#51A65F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
</button>

