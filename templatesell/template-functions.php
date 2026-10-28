<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Add a pingback url auto discovery header for single posts, pages, or attachments.
 */
function polite_news_pingback_header() {

	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'polite_news_pingback_header' );

/**
 * Remove the excluded categories from the main blog listing.
 *
 * @param WP_Query $query The query object.
 */
function polite_news_exclude_categories( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( ! $query->is_home() ) {
		return;
	}

	global $polite_news_theme_options;

	$excluded = isset( $polite_news_theme_options['polite-news-blog-exclude-category'] ) ? $polite_news_theme_options['polite-news-blog-exclude-category'] : '';

	if ( empty( $excluded ) ) {
		return;
	}

	$ids = array_filter( array_map( 'absint', explode( ',', $excluded ) ) );

	if ( empty( $ids ) ) {
		return;
	}

	$query->set( 'category__not_in', $ids );
}
add_action( 'pre_get_posts', 'polite_news_exclude_categories' );

/**
 * Handle the ajax load more request.
 */
function polite_news_load_more() {

	check_ajax_referer( 'polite_news_load_more', 'nonce' );

	$paged = isset( $_POST['paged'] ) ? absint( $_POST['paged'] ) : 2;
	$query = isset( $_POST['query'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['query'] ) ), true ) : array();

	if ( ! is_array( $query ) ) {
		$query = array();
	}

	/*
	 * Only the query vars the archive templates actually rely on are carried
	 * over, so a crafted request cannot widen the query.
	 */
	$allowed = array( 'category_name', 'cat', 'tag', 'tag_id', 'author', 'author_name', 'year', 'monthnum', 'day', 's', 'post_type', 'taxonomy', 'term', 'category__not_in' );

	$args = array_intersect_key( $query, array_flip( $allowed ) );

	$args['paged']          = $paged;
	$args['post_status']    = 'publish';
	$args['posts_per_page'] = get_option( 'posts_per_page' );

	$loop = new WP_Query( $args );

	if ( ! $loop->have_posts() ) {
		wp_send_json_error( array( 'html' => '' ) );
	}

	ob_start();

	while ( $loop->have_posts() ) {
		$loop->the_post();
		get_template_part( 'template-parts/content/content', get_post_format() );
	}

	wp_reset_postdata();

	wp_send_json_success( array( 'html' => ob_get_clean() ) );
}
add_action( 'wp_ajax_polite_news_load_more', 'polite_news_load_more' );
add_action( 'wp_ajax_nopriv_polite_news_load_more', 'polite_news_load_more' );

/**
 * Count the active footer widget areas.
 *
 * @return int
 */
function polite_news_footer_widget_count() {

	$count = 0;

	for ( $i = 1; $i <= 4; $i++ ) {
		if ( is_active_sidebar( 'footer-' . $i ) ) {
			$count++;
		}
	}

	return $count;
}

/**
 * Whether the current view should render the sidebar.
 *
 * @return bool
 */
function polite_news_has_sidebar() {

	global $polite_news_theme_options;

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return false;
	}

	if ( is_singular() ) {
		$layout = isset( $polite_news_theme_options['polite-news-sidebar-single-page'] ) ? $polite_news_theme_options['polite-news-sidebar-single-page'] : 'single-right-sidebar';

		return ! in_array( $layout, array( 'single-no-sidebar', 'single-middle-column' ), true );
	}

	$layout = isset( $polite_news_theme_options['polite-news-sidebar-blog-page'] ) ? $polite_news_theme_options['polite-news-sidebar-blog-page'] : 'right-sidebar';

	return ! in_array( $layout, array( 'no-sidebar', 'middle-column' ), true );
}
