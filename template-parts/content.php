<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RachieVee_2024
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php rachievee_2024_post_thumbnail(); ?>

	<div class="entry-content-wrapper">
		<header class="entry-header">
			<?php 
			if ('post' === get_post_type()) : ?>
				<div class="entry-meta">
					<?php rachievee_2024_posted_on(); ?>

					<?php rachievee_2024_entry_footer(); ?>
				</div><!-- .entry-meta -->
			<?php endif;

			if (is_singular()) :
				the_title('<h2 class="entry-title">', '</h1>');
			else :
				the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">

			<?php if ( is_home() || is_archive() ) {

				$categories = get_the_category();
				if( ! empty( $categories ) ) : ?>
					<div class="category"> 
						<?php foreach ( $categories as $category ) { ?>
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
						<?php } ?>
					</div>
				<?php endif; ?>
				
				<?php echo wp_trim_words( get_the_excerpt(), 50 ); ?>

				<?php $tags = get_the_tags(); ?>
				<?php if( ! empty( $tags ) ) : ?>
					<div class="tags">
					<?php foreach ( $tags as $post_tag ) { ?>
						<a href="<?php echo esc_url( get_category_link( $post_tag->term_id ) ); ?>"><?php echo esc_html( $post_tag->name ); ?></a>
					<?php } ?>
					</div>
				<?php endif; ?>

				 <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title=""
                        class="read-more"><?php esc_html_e( 'Read More', 'rachievee2024' ); ?></a>
				
				
			
			<?php } else {
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__('Read More<span class="screen-reader-text"> "%s"</span>', 'rachievee-2024'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post(get_the_title())
					)
				);
			}
			
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'rachievee-2024'),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->