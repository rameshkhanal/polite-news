<?php
/**
 * The curated posts section
 *
 * A labelled two column row of horizontal story cards pulled from a chosen
 * category, shown above or below the latest posts on the home page. The
 * area comes in through $args['area'] as either 'top' or 'bottom'.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_curated_area = isset( $args['area'] ) && 'bottom' === $args['area'] ? 'bottom' : 'top';

$polite_news_curated_kicker   = sanitize_text_field( $polite_news_theme_options[ 'polite-news-curated-' . $polite_news_curated_area . '-kicker' ] );
$polite_news_curated_title    = sanitize_text_field( $polite_news_theme_options[ 'polite-news-curated-' . $polite_news_curated_area . '-title' ] );
$polite_news_curated_category = absint( $polite_news_theme_options[ 'polite-news-curated-' . $polite_news_curated_area . '-category' ] );
$polite_news_curated_number   = absint( $polite_news_theme_options[ 'polite-news-curated-' . $polite_news_curated_area . '-number' ] );

if ( $polite_news_curated_number < 2 ) {
	$polite_news_curated_number = 4;
}

$polite_news_curated_query = polite_news_section_query( $polite_news_curated_category, $polite_news_curated_number );

if ( ! $polite_news_curated_query->have_posts() ) {
	wp_reset_postdata();
	return;
}

$polite_news_curated_more = ( $polite_news_curated_category > 0 ) ? get_category_link( $polite_news_curated_category ) : get_post_type_archive_link( 'post' );
?>
<div class="ts-curated">

	<div class="ts-curated-head">
		<div class="ts-curated-heading">
			<?php if ( $polite_news_curated_kicker ) : ?>
				<span class="ts-curated-kicker"><?php echo esc_html( $polite_news_curated_kicker ); ?></span>
			<?php endif; ?>
			<?php if ( $polite_news_curated_title ) : ?>
				<h2 class="ts-curated-title"><?php echo esc_html( $polite_news_curated_title ); ?></h2>
			<?php endif; ?>
		</div>
		<?php if ( $polite_news_curated_more ) : ?>
			<a class="ts-curated-more" href="<?php echo esc_url( $polite_news_curated_more ); ?>">
				<?php esc_html_e( 'View More', 'polite-news' ); ?>
				<i class="fa fa-angle-right" aria-hidden="true"></i>
			</a>
		<?php endif; ?>
	</div>

	<div class="ts-curated-grid">
		<?php
		while ( $polite_news_curated_query->have_posts() ) :
			$polite_news_curated_query->the_post();
			?>
			<article class="ts-curated-card">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="ts-curated-media">
						<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'polite-news-list' ); ?>
						</a>
					</div>
				<?php endif; ?>
				<div class="ts-curated-content">
					<?php polite_news_entry_category( true ); ?>
					<?php the_title( '<h3 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
					<div class="ts-curated-meta">
						<span class="ts-curated-author">
							<?php
							/* translators: %s: author name. */
							printf( esc_html__( 'By %s', 'polite-news' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>' );
							?>
						</span>
						<span class="ts-curated-date"><?php echo esc_html( get_the_date() ); ?></span>
					</div>
				</div>
			</article>
			<?php
		endwhile;

		wp_reset_postdata();
		?>
	</div>

</div><!-- .ts-curated -->
