<?php
/**
 * Polite News Theme Customizer
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_default_theme_options_values' ) ) :
	/**
	 * Default values for every theme option.
	 *
	 * @return array
	 */
	function polite_news_default_theme_options_values() {

		$default_theme_options = array(

			/* Logo Options */
			'polite_news_logo_width_option'            => '600',
			'polite_news_dark_logo'                    => '',

			/* Top Header */
			'polite_news_enable_top_header'            => 1,
			'polite_news_enable_top_date'              => 1,
			'polite_news_enable_top_header_social'     => 1,
			'polite_news_enable_top_header_menu'       => 1,

			/* Header Options */
			'polite_news_header_layout'                => 'header-one',
			'polite_news_enable_search'                => 1,
			'polite_news_enable_sticky_menu'           => 0,
			'polite_news_enable_dark_mode'             => 1,
			'polite_news_enable_header_banner'         => 0,
			'polite_news_header_banner_image'          => '',
			'polite_news_header_banner_link'           => '',
			'polite_news_header_banner_new_tab'        => 0,

			/* Breaking News Ticker */
			'polite_news_enable_ticker'                => 1,
			'polite_news_ticker_style'                 => 'ticker-one',
			'polite_news_ticker_label'                 => esc_html__( 'Breaking', 'polite-news' ),
			'polite-news-ticker-category'              => 0,
			'polite-news-ticker-number'                => 5,

			/* Colors Options */
			'polite_news_primary_color'                => '#4f46e5',

			/* Typography */
			'polite-news-heading-font'                 => 'Poppins',
			'polite-news-body-font'                    => 'Inter',
			'polite-news-paragraph-font-size'          => 16,

			/* Slider Options */
			'polite_news_enable_slider'                => 1,
			'polite_news_hero_layout'                  => 'hero-one',
			'polite-news-slider-category'              => 0,
			'polite-news-slider-number'                => 1,

			/* Editor Picks Boxes */
			'polite_news_enable_boxes'                 => 1,
			'polite_news_boxes_style'                  => 'boxes-one',
			'polite-news-boxes-content-type'           => 'category',
			'polite-news-boxes-category'               => 0,
			'polite-news-boxes-post-1'                 => 0,
			'polite-news-boxes-post-2'                 => 0,
			'polite-news-boxes-post-3'                 => 0,
			'polite-news-boxes-post-4'                 => 0,
			'polite-news-boxes-number'                 => 3,

			/* Curated Posts */
			'polite_news_enable_curated_top'           => 0,
			'polite-news-curated-top-kicker'           => __( 'Top Weekly', 'polite-news' ),
			'polite-news-curated-top-title'            => __( 'Curated Posts', 'polite-news' ),
			'polite-news-curated-top-category'         => 0,
			'polite-news-curated-top-number'           => 4,
			'polite_news_enable_curated_bottom'        => 0,
			'polite-news-curated-bottom-kicker'        => __( 'Do Not Miss', 'polite-news' ),
			'polite-news-curated-bottom-title'         => __( 'More Stories', 'polite-news' ),
			'polite-news-curated-bottom-category'      => 0,
			'polite-news-curated-bottom-number'        => 4,

			/* Category Columns */
			'polite_news_enable_catcols'               => 0,
			'polite-news-catcols-1'                    => 0,
			'polite-news-catcols-2'                    => 0,
			'polite-news-catcols-3'                    => 0,

			/* Blog Page */
			'polite_news_home_style'                   => 'home-one',
			'polite-news-sidebar-blog-page'            => 'right-sidebar',
			'polite-news-column-blog-page'             => 'grid-two',
			'polite-news-blog-image-layout'            => 'full-image',
			'polite-news-content-show-from'            => 'excerpt',
			'polite-news-excerpt-length'               => 25,
			'polite-news-pagination-options'           => 'numeric',
			'polite-news-blog-exclude-category'        => '',
			'polite-news-read-more-text'               => esc_html__( 'Read More', 'polite-news' ),
			'polite-news-show-hide-share'              => 0,
			'polite-news-show-hide-category'           => 1,
			'polite-news-show-hide-date'               => 1,
			'polite-news-show-hide-author'             => 1,

			/* Single Page */
			'polite-news-single-page-featured-image'   => 1,
			'polite-news-single-page-related-posts'    => 1,
			'polite-news-single-page-related-posts-title' => esc_html__( 'Related Posts', 'polite-news' ),
			'polite-news-sidebar-single-page'          => 'single-right-sidebar',
			'polite-news-single-social-share'          => 1,
			'polite-news-single-author-box'            => 1,
			'polite-news-single-post-navigation'       => 1,

			/* General */
			'polite-news-page-layout'                  => 'full',
			'polite-news-page-width'                   => 1320,
			'polite_news_enable_sticky_sidebar'        => 1,

			/* Footer Section */
			'polite_news_footer_layout'                => 'footer-one',
			'polite-news-footer-copyright'             => esc_html__( 'Copyright All Rights Reserved 2026', 'polite-news' ),
			'polite-news-enable-go-to-top'             => 1,

			/* Breadcrumb Options */
			'polite-news-extra-breadcrumb'             => 1,
			'polite-news-breadcrumb-selection-option'  => 'theme',
		);

		return apply_filters( 'polite_news_default_theme_options_values', $default_theme_options );
	}
endif;

/**
 * Polite News Theme Options and Settings
 *
 * @since Polite News 1.0.0
 *
 * @return array polite_news_get_options_value
 */
if ( ! function_exists( 'polite_news_get_options_value' ) ) :
	function polite_news_get_options_value() {

		$polite_news_default_theme_options_values = polite_news_default_theme_options_values();

		$polite_news_get_options_value = get_theme_mod( 'polite_news_options' );

		if ( is_array( $polite_news_get_options_value ) ) {
			return array_merge( $polite_news_default_theme_options_values, $polite_news_get_options_value );
		}

		return $polite_news_default_theme_options_values;
	}
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function polite_news_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'polite_news_customize_partial_blogname',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'polite_news_customize_partial_blogdescription',
			)
		);
	}

	$default = polite_news_default_theme_options_values();

	require get_template_directory() . '/templatesell/theme-settings/theme-settings.php';
}
add_action( 'customize_register', 'polite_news_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function polite_news_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function polite_news_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function polite_news_customize_preview_js() {
	wp_enqueue_script( 'polite-news-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), POLITE_NEWS_VERSION, true );
}
add_action( 'customize_preview_init', 'polite_news_customize_preview_js' );

/**
 * Customizer control styles.
 */
function polite_news_panels_css() {
	wp_enqueue_style( 'polite-news-customizer-css', get_template_directory_uri() . '/css/customizer-style.css', array(), POLITE_NEWS_VERSION );
	wp_enqueue_script( 'polite-news-customizer-controls', get_template_directory_uri() . '/js/customizer-controls.js', array( 'customize-controls' ), POLITE_NEWS_VERSION, true );

	$polite_news_defaults = polite_news_default_theme_options_values();
	$polite_news_reset    = array();

	foreach ( $polite_news_defaults as $polite_news_key => $polite_news_value ) {
		$polite_news_reset[ 'polite_news_options[' . $polite_news_key . ']' ] = $polite_news_value;
	}

	wp_localize_script(
		'polite-news-customizer-controls',
		'politeNewsControls',
		array(
			'resetLabel' => __( 'Reset to default', 'polite-news' ),
			'defaults'   => $polite_news_reset,
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'polite_news_panels_css' );
