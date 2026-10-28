<?php
/**
 * Hero style three
 *
 * Overlay story with a floating headline panel on the right.
 *
 * @package Polite_News
 */

$polite_news_hero_query = $args['query'];

$polite_news_hero_index = 0;
?>
<div class="ts-hero-overlay">

	<?php
	while ( $polite_news_hero_query->have_posts() ) :
		$polite_news_hero_query->the_post();

		if ( 0 === $polite_news_hero_index ) :
			?>
			<article class="ts-slide">
				<div class="ts-slide-media">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'polite-news-slider', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) );
					}
					?>
					<div class="ts-slide-overlay"></div>
				</div>
				<div class="ts-slide-content">
					<?php polite_news_entry_category( true ); ?>
					<?php the_title( '<h2 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
					<p class="ts-hero-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
					<?php polite_news_hero_meta(); ?>
				</div>
			</article>

			<div class="ts-hero-panel">
			<?php
		else :
			?>
			<article class="ts-hero-panel-item">
				<?php the_title( '<h3 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
				<?php polite_news_hero_meta(); ?>
			</article>
			<?php
		endif;

		$polite_news_hero_index++;
	endwhile;
	?>
	</div><!-- .ts-hero-panel -->

</div><!-- .ts-hero-overlay -->
