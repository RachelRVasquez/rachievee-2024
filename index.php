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
 * @package RachieVee_2024
 */

get_header();

if ( is_home() ) { ?>

<div class="site-homepage-hero">
	<h2 class="hero-heading"><span>Hello,</span> I'm Rachel!</h2>
	<div class="hero-subtitle">Full-Stack Developer & WordPress Wizard</div>
	<div class="hero-blurb">I write about accessibility, tutorials, and dev life.</div>
</div>

<?php } ?>

<?php /* if (is_home()) {
	$fetch_hero_title = get_option('_homepage_hero_title') ?: '';
	$fetch_hero_subtitle = get_option('_homepage_hero_subtitle') ?: '';
	$fetch_hero_blurb = get_option('_homepage_hero_desc') ?: '';

	if ($fetch_hero_blurb) { ?>
		<div class="site-homepage-hero">
			<div class="site-homepage-hero-inner">
				<h2 class="hero-heading"><?php echo $fetch_hero_title; ?></h2>
				<div class="hero-subtitle"><?php echo $fetch_hero_subtitle; ?></div>
				<div class="hero-blurb"><?php echo wpautop($fetch_hero_blurb); ?></div>
			</div>
		</div>
<?php } 

} */ ?>

<main id="primary" class="site-main">
	<?php
	if (have_posts()) :

		/* Start the Loop */
		while (have_posts()) :
			the_post();

			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			get_template_part('template-parts/content', get_post_type());

		endwhile;

		the_posts_navigation(array(
			'prev_text' => '<i class="fa-solid fa-angles-left" aria-hidden="true"></i> Older Articles',
			'next_text' => 'Newer Articles <i class="fa-solid fa-angles-right" aria-hidden="true"></i>',
		));

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
