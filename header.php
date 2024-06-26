<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RachieVee_2024
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<header id="masthead" class="site-header">
		<div class="site-branding desktop-hidden">
			<?php
			the_custom_logo();

			if (is_front_page() && is_home()) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<button class="menu-toggle" id="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<div class="ham-bar top" aria-hidden="true"></div>
			<div class="ham-bar middle" aria-hidden="true"></div>
			<div class="ham-bar bottom" aria-hidden="true"></div>
			<span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'rachievee-2024'); ?></span>
		</button>
		<div class="container off-screen-mobile" id="mobile-menu">
			<div class="site-branding mobile-hidden">
				<?php
				the_custom_logo();

				if (is_front_page() && is_home()) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',	
					)
				);
				?>
			</nav><!-- #site-navigation -->
			<?php rachievee_2024_social_icons_output(); ?>
		</div>
	</header><!-- #masthead -->
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'rachievee-2024'); ?></a>
		<a class="skip-link screen-reader-text" href="#secondary"><?php esc_html_e('Skip to sidebar', 'rachievee-2024'); ?></a>