<?php
/**
 * Excerpt filters
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Set the excerpt length from the customizer option.
 *
 * @param int $length Default excerpt length.
 * @return int
 */
function polite_news_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	global $polite_news_theme_options;

	$custom = isset( $polite_news_theme_options['polite-news-excerpt-length'] ) ? absint( $polite_news_theme_options['polite-news-excerpt-length'] ) : 25;

	return $custom ? $custom : $length;
}
add_filter( 'excerpt_length', 'polite_news_excerpt_length', 999 );

/**
 * Replace the excerpt ellipsis.
 *
 * @param string $more Default more string.
 * @return string
 */
function polite_news_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	return '&hellip;';
}
add_filter( 'excerpt_more', 'polite_news_excerpt_more' );
