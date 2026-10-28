<?php
/**
 * Hero style two
 *
 * Magazine split: lead story left, three side stories right.
 *
 * @package Polite_News
 */

$polite_news_hero_query = $args['query'];

$polite_news_hero_index = 0;
?>
<div class="ts-hero-mag">

	<?php
	while ( $polite_news_hero_query->have_posts() ) :
		$polite_news_hero_query->the_post();

		if ( 0 === $polite_news_hero_index ) :
			?>
			<article class="ts-hero-main">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="ts-hero-media">
						<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'polite-news-slider', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
						</a>
					</div>
				<?php endif; ?>
				<?php the_title( '<h2 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				<p class="ts-hero-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
				<?php polite_news_hero_meta(); ?>
			</article>

			<div class="ts-hero-side">
			<?php
		else :
			?>
			<article class="ts-hero-side-item">
				<div class="ts-hero-content">
					<?php the_title( '<h3 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
					<p class="ts-hero-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
					<?php polite_news_hero_meta(); ?>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="ts-hero-thumb">
						<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'polite-news-list' ); ?>
						</a>
					</div>
				<?php endif; ?>
			</article>
			<?php
		endif;

		$polite_news_hero_index++;
	endwhile;
	?>
	</div><!-- .ts-hero-side -->

</div><!-- .ts-hero-mag -->
