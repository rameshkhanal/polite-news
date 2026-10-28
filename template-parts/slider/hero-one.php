<?php
/**
 * Hero style one
 *
 * Overlay slider.
 *
 * @package Polite_News
 */

$polite_news_hero_query = $args['query'];

$polite_news_slide_total = (int) $polite_news_hero_query->post_count;
$polite_news_slide_index = 0;
?>
<div class="ts-carousel" data-count="<?php echo absint( $polite_news_slide_total ); ?>">

	<div class="ts-carousel-track">
		<?php
		while ( $polite_news_hero_query->have_posts() ) :
			$polite_news_hero_query->the_post();
			?>
			<article class="ts-slide<?php echo ( 0 === $polite_news_slide_index ) ? ' is-active' : ''; ?>">
				<div class="ts-slide-media">
					<?php
					if ( has_post_thumbnail() ) {
						/* The first slide paints the largest area, load it early. */
						if ( 0 === $polite_news_slide_index ) {
							the_post_thumbnail( 'polite-news-slider', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) );
						} else {
							/* Every other slide is display:none until its turn, so the browser can hold the fetch back. */
							the_post_thumbnail( 'polite-news-slider', array( 'loading' => 'lazy' ) );
						}
					}
					?>
					<div class="ts-slide-overlay"></div>
				</div>
				<div class="ts-slide-content">
					<?php polite_news_entry_category( true ); ?>
					<?php the_title( '<h2 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
					<div class="entry-meta">
						<?php
						polite_news_posted_on();
						polite_news_posted_by( false );
						?>
					</div>
				</div>
			</article>
			<?php
			$polite_news_slide_index++;
		endwhile;
		?>
	</div>

	<?php if ( $polite_news_slide_total > 1 ) : ?>
		<button type="button" class="ts-carousel-arrow ts-carousel-prev">
			<i class="fa fa-angle-left" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Previous slide', 'polite-news' ); ?></span>
		</button>
		<button type="button" class="ts-carousel-arrow ts-carousel-next">
			<i class="fa fa-angle-right" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Next slide', 'polite-news' ); ?></span>
		</button>
		<div class="ts-carousel-dots">
			<?php for ( $polite_news_dot = 0; $polite_news_dot < $polite_news_slide_total; $polite_news_dot++ ) : ?>
				<button type="button" class="ts-carousel-dot<?php echo ( 0 === $polite_news_dot ) ? ' is-active' : ''; ?>" data-slide="<?php echo absint( $polite_news_dot ); ?>">
					<span class="screen-reader-text">
						<?php
						/* translators: %d: slide number. */
						printf( esc_html__( 'Go to slide %d', 'polite-news' ), absint( $polite_news_dot ) + 1 );
						?>
					</span>
				</button>
			<?php endfor; ?>
		</div>
	<?php endif; ?>

</div><!-- .ts-carousel -->
