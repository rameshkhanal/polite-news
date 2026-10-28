<?php
/**
 * Body class filters
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Add the sidebar layout class to the body.
 *
 * The option values are stored unprefixed, the class that reaches the markup
 * carries the ts brand prefix so it cannot clash with a plugin.
 *
 * @param array $classes Body classes.
 * @return array
 */
function polite_news_body_class( $classes ) {

	global $polite_news_theme_options;

	if ( is_singular() ) {

		$sidebar = isset( $polite_news_theme_options['polite-news-sidebar-single-page'] ) ? $polite_news_theme_options['polite-news-sidebar-single-page'] : 'single-right-sidebar';

		$allowed = array( 'single-no-sidebar', 'single-left-sidebar', 'single-middle-column', 'single-right-sidebar' );

		$classes[] = 'ts-' . ( in_array( $sidebar, $allowed, true ) ? $sidebar : 'single-right-sidebar' );

	} else {

		$sidebar = isset( $polite_news_theme_options['polite-news-sidebar-blog-page'] ) ? $polite_news_theme_options['polite-news-sidebar-blog-page'] : 'right-sidebar';

		$allowed = array( 'no-sidebar', 'left-sidebar', 'middle-column', 'right-sidebar' );

		$classes[] = 'ts-' . ( in_array( $sidebar, $allowed, true ) ? $sidebar : 'right-sidebar' );
	}

	if ( ! polite_news_has_sidebar() ) {
		$classes[] = 'ts-sidebar-inactive';
	}

	return $classes;
}
add_filter( 'body_class', 'polite_news_body_class' );

/**
 * Add the blog layout class to the body.
 *
 * @param array $classes Body classes.
 * @return array
 */
function polite_news_layout_body_class( $classes ) {

	global $polite_news_theme_options;

	$layout = isset( $polite_news_theme_options['polite-news-column-blog-page'] ) ? $polite_news_theme_options['polite-news-column-blog-page'] : 'grid-two';

	$allowed = array_keys( polite_news_archive_style_array() );

	$classes[] = 'ts-' . ( in_array( $layout, $allowed, true ) ? $layout : 'grid-two' );

	return $classes;
}
add_filter( 'body_class', 'polite_news_layout_body_class' );

/**
 * Add the page layout classes to the body.
 *
 * Boxed, framed and custom width all hold the site to a container, so they all
 * carry ts-boxed and then add whatever makes them different. That way the one
 * set of container rules is written once and the variants only say how they
 * depart from it.
 *
 * @param array $classes Body classes.
 * @return array
 */
function polite_news_page_layout_body_class( $classes ) {

	global $polite_news_theme_options;

	$layout = isset( $polite_news_theme_options['polite-news-page-layout'] ) ? $polite_news_theme_options['polite-news-page-layout'] : 'full';

	$contained = array( 'boxed', 'framed', 'custom' );

	if ( in_array( $layout, $contained, true ) ) {
		$classes[] = 'ts-boxed';
		$classes[] = 'ts-layout-' . $layout;
	}

	return $classes;
}
add_filter( 'body_class', 'polite_news_page_layout_body_class' );

/**
 * Flag a sticky sidebar on the body.
 *
 * The class only says the option is on. Whether the column can actually hold
 * still is decided in the browser, where the sidebar height is known.
 *
 * @param array $classes Body classes.
 * @return array
 */
function polite_news_sticky_sidebar_body_class( $classes ) {

	global $polite_news_theme_options;

	$sticky = isset( $polite_news_theme_options['polite_news_enable_sticky_sidebar'] ) ? absint( $polite_news_theme_options['polite_news_enable_sticky_sidebar'] ) : 0;

	if ( 1 === $sticky && polite_news_has_sidebar() ) {
		$classes[] = 'ts-sticky-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'polite_news_sticky_sidebar_body_class' );

/**
 * Show only the term name on category, tag and author archives.
 *
 * @param string $title Archive title.
 * @return string
 */
function polite_news_archive_title( $title ) {

	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'polite_news_archive_title' );
