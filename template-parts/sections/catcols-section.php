<?php
/**
 * The category columns section
 *
 * Three side by side category blocks, each with a lead story and a compact
 * list below it. Columns without a chosen category or without posts stay
 * out of the row.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_catcols = array();

for ( $polite_news_col = 1; $polite_news_col <= 3; $polite_news_col++ ) {

	$polite_news_col_cat = absint( $polite_news_theme_options[ 'polite-news-catcols-' . $polite_news_col ] );

	if ( $polite_news_col_cat > 0 ) {
		$polite_news_catcols[] = $polite_news_col_cat;
	}
}

if ( empty( $polite_news_catcols ) ) {
	return;
}
?>
<div class="ts-catcols">

	<?php
	foreach ( $polite_news_catcols as $polite_news_col_cat ) :

		$polite_news_col_query = polite_news_section_query( $polite_news_col_cat, 4 );

		if ( ! $polite_news_col_query->have_posts() ) {
			wp_reset_postdata();
			continue;
		}

		$polite_news_col_term  = get_category( $polite_news_col_cat );
		$polite_news_col_index = 0;
		?>
		<div class="ts-catcol">

			<?php if ( $polite_news_col_term && ! is_wp_error( $polite_news_col_term ) ) : ?>
				<h2 class="ts-catcol-title">
					<a href="<?php echo esc_url( get_category_link( $polite_news_col_cat ) ); ?>"><?php echo esc_html( $polite_news_col_term->name ); ?></a>
				</h2>
			<?php endif; ?>

			<?php
			while ( $polite_news_col_query->have_posts() ) :
				$polite_news_col_query->the_post();

				if ( 0 === $polite_news_col_index ) :
					?>
					<article class="ts-catcol-lead">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="ts-catcol-media">
								<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
									<?php the_post_thumbnail( 'polite-news-grid' ); ?>
								</a>
								<?php polite_news_entry_category( true ); ?>
							</div>
						<?php endif; ?>
						<?php the_title( '<h3 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
						<span class="ts-box-date"><?php echo esc_html( get_the_date() ); ?></span>
					</article>

					<div class="ts-catcol-list">
					<?php
				else :
					?>
					<article class="ts-catcol-item">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="ts-catcol-thumb">
								<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
									<?php the_post_thumbnail( 'polite-news-widget' ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="ts-catcol-content">
							<?php the_title( '<h4 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
							<span class="ts-box-date"><?php echo esc_html( get_the_date() ); ?></span>
						</div>
					</article>
					<?php
				endif;

				$polite_news_col_index++;
			endwhile;

			wp_reset_postdata();
			?>
			</div><!-- .ts-catcol-list -->

		</div><!-- .ts-catcol -->
	<?php endforeach; ?>

</div><!-- .ts-catcols -->
