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
		<div class="container">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if (is_front_page() && is_home()) :
				?>
					<div class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></div>
				<?php
				else :
				?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
				endif;
				$rachievee_2024_description = get_bloginfo('description', 'display');
				if ($rachievee_2024_description || is_customize_preview()) :
				?>
					<p class="site-description"><?php echo $rachievee_2024_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
												?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'rachievee-2024'); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
			<nav id="social-navigation" class="social-navigation">
				<ul>
					<li>
						<a href="https://twitter.com/RachelRVasquez" class="dashicons dashicons-twitter">
							<span class="screen-reader-text">Twitter</span>
						</a>
					</li>
					<li>
						<a href="https://www.linkedin.com/in/rachelrvasquez/" class="dashicons dashicons-linkedin">
							<span class="screen-reader-text">LinkedIn</span>
						</a>
					</li>
					<!-- Add Stack Exchange & Github -->
				</ul>
			</nav><!-- social-navigation TODO: Make dynamic, carbon fields bc screw wp menus -->
			</div>
		</header><!-- #masthead -->
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'rachievee-2024'); ?></a>

		