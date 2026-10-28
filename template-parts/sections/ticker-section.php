<?php
/**
 * The breaking news ticker section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_ticker_label    = esc_html( $polite_news_theme_options['polite_news_ticker_label'] );
$polite_news_ticker_style    = esc_attr( $polite_news_theme_options['polite_news_ticker_style'] );

if ( ! in_array( $polite_news_ticker_style, array( 'ticker-one', 'ticker-two', 'ticker-three' ), true ) ) {
	$polite_news_ticker_style = 'ticker-one';
}
$polite_news_ticker_category = absint( $polite_news_theme_options['polite-news-ticker-category'] );
$polite_news_ticker_number   = absint( $polite_news_theme_options['polite-news-ticker-number'] );

$polite_news_ticker_query = polite_news_section_query( $polite_news_ticker_category, $polite_news_ticker_number );

if ( ! $polite_news_ticker_query->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>
<div class="ts-ticker ts-<?php echo esc_attr( $polite_news_ticker_style ); ?>">

	<?php if ( ! empty( $polite_news_ticker_label ) ) : ?>
		<span class="ts-ticker-label"><?php echo esc_html( $polite_news_ticker_label ); ?></span>
	<?php endif; ?>

	<div class="ts-ticker-items">
		<?php
		$polite_news_ticker_index = 0;

		while ( $polite_news_ticker_query->have_posts() ) :
			$polite_news_ticker_query->the_post();
			?>
			<div class="ts-ticker-item<?php echo ( 0 === $polite_news_ticker_index ) ? ' is-active' : ''; ?>">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			<?php
			$polite_news_ticker_index++;
		endwhile;

		wp_reset_postdata();
		?>
	</div>

</div>
