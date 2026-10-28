<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Enqueue the front end assets.
 */
function polite_news_scripts() {

	global $polite_news_theme_options;

	/* Locally hosted theme fonts. */
	wp_enqueue_style( 'polite-news-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), POLITE_NEWS_VERSION );


	/* Font Awesome icons. */
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0' );

	/* Grid helpers. */
	wp_enqueue_style( 'polite-news-grid', get_template_directory_uri() . '/css/grid.css', array(), POLITE_NEWS_VERSION );

	/* Main stylesheet. */
	wp_enqueue_style( 'polite-news-style', get_stylesheet_uri(), array(), POLITE_NEWS_VERSION );

	/* RTL support. */
	wp_style_add_data( 'polite-news-style', 'rtl', 'replace' );

	/* Navigation. */
	wp_enqueue_script( 'polite-news-navigation', get_template_directory_uri() . '/js/navigation.js', array(), POLITE_NEWS_VERSION, true );

	/* Skip link focus fix. */
	wp_enqueue_script( 'polite-news-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), POLITE_NEWS_VERSION, true );

	/* Front end behaviour. */
	wp_enqueue_script( 'polite-news-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), POLITE_NEWS_VERSION, true );

	/* Featured slider on the front page. */
	if ( is_front_page() || is_home() ) {
		wp_enqueue_script( 'polite-news-carousel', get_template_directory_uri() . '/assets/js/carousel.js', array(), POLITE_NEWS_VERSION, true );
	}

	/* Ajax pagination. */
	$pagination = isset( $polite_news_theme_options['polite-news-pagination-options'] ) ? esc_attr( $polite_news_theme_options['polite-news-pagination-options'] ) : 'numeric';

	if ( 'ajax' === $pagination && ! is_singular() ) {

		wp_enqueue_script( 'polite-news-custom-pagination', get_template_directory_uri() . '/assets/js/custom-infinite-pagination.js', array( 'jquery' ), POLITE_NEWS_VERSION, true );

		global $wp_query;

		$paged = ( get_query_var( 'paged' ) > 1 ) ? absint( get_query_var( 'paged' ) ) : 1;

		wp_localize_script(
			'polite-news-custom-pagination',
			'polite_news_ajax',
			array(
				'ajaxurl'       => esc_url( admin_url( 'admin-ajax.php' ) ),
				'nonce'         => wp_create_nonce( 'polite_news_load_more' ),
				'paged'         => $paged,
				'max_num_pages' => absint( $wp_query->max_num_pages ),
				'query'         => wp_json_encode( $wp_query->query_vars ),
				'show_more'     => esc_html__( 'View More', 'polite-news' ),
				'loading'       => esc_html__( 'Loading...', 'polite-news' ),
				'no_more_posts' => esc_html__( 'No More Posts', 'polite-news' ),
			)
		);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'polite_news_scripts' );

/**
 * Preload the fonts used above the fold.
 */
function polite_news_preload_fonts() {
	$fonts = array( 'poppins-bold', 'inter-regular' );

	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "
",
			esc_url( get_template_directory_uri() . '/assets/fonts/' . $font . '.woff2' )
		);
	}
}
add_action( 'wp_head', 'polite_news_preload_fonts', 2 );

/**
 * Enqueue the block editor styles.
 */
function polite_news_block_styles() {

	wp_enqueue_style( 'polite-news-editor-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), POLITE_NEWS_VERSION );
	wp_enqueue_style( 'polite-news-editor-styles', get_theme_file_uri( 'css/editor-styles.css' ), array(), POLITE_NEWS_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'polite_news_block_styles' );

/**
 * Enqueue the admin assets for the theme about page and the upgrade notice.
 *
 * @param string $hook Current admin page hook.
 */
function polite_news_admin_scripts( $hook ) {

	wp_enqueue_style( 'polite-news-pro-notice', get_template_directory_uri() . '/templatesell/pro-notice/notice.css', array(), POLITE_NEWS_VERSION );

	if ( 'appearance_page_polite-news-about' === $hook ) {
		wp_enqueue_style( 'polite-news-about', get_template_directory_uri() . '/templatesell/about/about.css', array(), POLITE_NEWS_VERSION );
	}
}
add_action( 'admin_enqueue_scripts', 'polite_news_admin_scripts' );
