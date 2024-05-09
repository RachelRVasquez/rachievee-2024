<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RachieVee_2024
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta">
				<?php rachievee_2024_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php echo wp_trim_words(get_the_excerpt(), 50); ?>

		<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" title="" class="read-more">
			<?php esc_html_e('Read More', 'rachievee2024'); ?> <i class="fa-solid fa-angles-right" aria-hidden="true"></i>
		</a>
	</div><!-- .entry-summary -->
</article><!-- #post-<?php the_ID(); ?> -->