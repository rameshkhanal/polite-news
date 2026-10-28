<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Jetpack setup function.
 */
function polite_news_jetpack_setup() {

	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'polite_news_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details' => array(
				'stylesheet' => 'polite-news-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
			),
			'featured-images' => array(
				'archive' => true,
				'post'    => true,
				'page'    => true,
			),
		)
	);
}
add_action( 'after_setup_theme', 'polite_news_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function polite_news_infinite_scroll_render() {

	while ( have_posts() ) {
		the_post();

		if ( is_search() ) {
			get_template_part( 'template-parts/content/content', 'search' );
		} else {
			get_template_part( 'template-parts/content/content', get_post_format() );
		}
	}
}
