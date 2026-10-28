<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Polite_News
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="ts-post-wrap">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="ts-post-media">
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( 'polite-news-grid', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
				</a>
			</div>
		<?php endif; ?>

		<div class="ts-post-content">

			<div class="entry-meta">
				<?php
				if ( 'post' === get_post_type() ) {
					polite_news_posted_on();
					polite_news_posted_by( false );
				}
				?>
			</div><!-- .entry-meta -->

			<?php the_title( sprintf( '<h2 class="ts-post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<div class="ts-post-excerpt entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
