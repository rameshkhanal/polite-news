<?php
/**
 * Polite News functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Polite_News
 */

if ( ! defined( 'POLITE_NEWS_VERSION' ) ) {
	define( 'POLITE_NEWS_VERSION', '1.0.0' );
}

if ( ! function_exists( 'polite_news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function polite_news_setup() {

		// Customizer setting default value set.
		$GLOBALS['polite_news_theme_options'] = polite_news_get_options_value();

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'polite-news', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Four menu locations: the primary bar, the top strip, the footer and the social row.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'polite-news' ),
				'top'    => esc_html__( 'Top Menu', 'polite-news' ),
				'footer' => esc_html__( 'Footer Menu', 'polite-news' ),
				'social' => esc_html__( 'Social Icons', 'polite-news' ),
			)
		);

		/*
		 * Polite News default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Make the editor match the front end typography and colours.
		add_editor_style( array( 'assets/css/fonts.css', 'css/editor-styles.css' ) );

		// Add support for custom background.
		add_theme_support(
			'custom-background',
			apply_filters(
				'polite_news_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add support for Yoast SEO Breadcrumbs.
		add_theme_support( 'yoast-seo-breadcrumbs' );

		/**
		 * Register theme support for Rank Math breadcrumbs.
		 */
		add_theme_support( 'rank-math-breadcrumbs' );

		/*
		 * Add support custom font sizes.
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'polite-news' ),
					'shortName' => __( 'S', 'polite-news' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Medium', 'polite-news' ),
					'shortName' => __( 'M', 'polite-news' ),
					'size'      => 20,
					'slug'      => 'medium',
				),
				array(
					'name'      => __( 'Large', 'polite-news' ),
					'shortName' => __( 'L', 'polite-news' ),
					'size'      => 25,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Larger', 'polite-news' ),
					'shortName' => __( 'XL', 'polite-news' ),
					'size'      => 35,
					'slug'      => 'larger',
				),
			)
		);

		/**
		 * Add theme support for new image sizes.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_image_size/
		 */
		add_image_size( 'polite-news-slider', 1140, 640, true );
		add_image_size( 'polite-news-box', 420, 280, true );
		add_image_size( 'polite-news-grid', 600, 400, true );
		add_image_size( 'polite-news-list', 300, 220, true );
		add_image_size( 'polite-news-widget', 85, 85, true );
	}
endif;
add_action( 'after_setup_theme', 'polite_news_setup' );

/**
 * Refresh the options global right before the template renders.
 *
 * The customizer preview applies its values after after_setup_theme, so the
 * global captured in polite_news_setup() would be stale inside the preview
 * and the sidebar or layout choices would not show until publish.
 */
function polite_news_refresh_options() {
	$GLOBALS['polite_news_theme_options'] = polite_news_get_options_value();
}
add_action( 'wp', 'polite_news_refresh_options', 1 );

/**
 * Set the content width in pixels, based on the theme design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function polite_news_content_width() {
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'polite_news_content_width', 800 );
}
add_action( 'after_setup_theme', 'polite_news_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function polite_news_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'polite-news' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in the main sidebar.', 'polite-news' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Widget', 'polite-news' ),
			'id'            => 'header-widget',
			'description'   => esc_html__( 'Add a widget here to appear beside the site logo. An advert banner works well.', 'polite-news' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	$footer_areas = array(
		'footer-1' => esc_html__( 'Footer One', 'polite-news' ),
		'footer-2' => esc_html__( 'Footer Two', 'polite-news' ),
		'footer-3' => esc_html__( 'Footer Three', 'polite-news' ),
		'footer-4' => esc_html__( 'Footer Four', 'polite-news' ),
	);

	foreach ( $footer_areas as $footer_id => $footer_name ) {
		register_sidebar(
			array(
				'name'          => $footer_name,
				'id'            => $footer_id,
				'description'   => esc_html__( 'Add widgets here.', 'polite-news' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'polite_news_widgets_init' );

/**
 * Load TS Core Files
 */
require get_template_directory() . '/templatesell/ts-core-files.php';
