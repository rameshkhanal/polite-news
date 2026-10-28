<?php
/**
 * The featured hero section
 *
 * Builds the featured stories query and hands over to one of the hero style
 * files in template-parts/slider: hero-one (overlay slider), hero-two
 * (magazine split) or hero-three (overlay story with a floating panel).
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_slider_category = absint( $polite_news_theme_options['polite-news-slider-category'] );
$polite_news_hero_layout     = esc_attr( $polite_news_theme_options['polite_news_hero_layout'] );

if ( ! in_array( $polite_news_hero_layout, array( 'hero-one', 'hero-two', 'hero-three' ), true ) ) {
	$polite_news_hero_layout = 'hero-one';
}

$polite_news_slider_number = absint( $polite_news_theme_options['polite-news-slider-number'] );

if ( $polite_news_slider_number < 1 ) {
	$polite_news_slider_number = 1;
}

/* Each layout needs its own number of stories. */
$polite_news_hero_counts = array(
	'hero-one'   => $polite_news_slider_number,
	'hero-two'   => 4,
	'hero-three' => 5,
);

$polite_news_hero_query = polite_news_section_query( $polite_news_slider_category, $polite_news_hero_counts[ $polite_news_hero_layout ] );

if ( ! $polite_news_hero_query->have_posts() ) {
	wp_reset_postdata();
	return;
}

if ( ! function_exists( 'polite_news_hero_meta' ) ) :
	/**
	 * Prints the avatar, author and date line used in the hero layouts.
	 */
	function polite_news_hero_meta() {
		?>
		<div class="ts-hero-meta">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 26 ); ?>
			<a class="ts-hero-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
			<span class="ts-hero-sep">&middot;</span>
			<span class="ts-hero-date"><?php echo esc_html( get_the_date() ); ?></span>
		</div>
		<?php
	}
endif;

get_template_part(
	'template-parts/slider/' . $polite_news_hero_layout,
	null,
	array(
		'query' => $polite_news_hero_query,
	)
);

wp_reset_postdata();
