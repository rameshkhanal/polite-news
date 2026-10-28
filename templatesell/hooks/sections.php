<?php
/**
 * Custom theme hooks
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_add_main_header' ) ) :
	/**
	 * Add main header.
	 *
	 * @since 1.0.0
	 */
	function polite_news_add_main_header() {
		get_template_part( 'template-parts/sections/header', 'section' );
	}
endif;
add_action( 'polite_news_action_header', 'polite_news_add_main_header', 10 );

if ( ! function_exists( 'polite_news_add_ticker' ) ) :
	/**
	 * Add the breaking news ticker.
	 *
	 * @since 1.0.0
	 */
	function polite_news_add_ticker() {
		get_template_part( 'template-parts/sections/ticker', 'section' );
	}
endif;
add_action( 'polite_news_action_ticker', 'polite_news_add_ticker', 10 );

if ( ! function_exists( 'polite_news_add_main_slider' ) ) :
	/**
	 * Add the featured post section.
	 *
	 * @since 1.0.0
	 */
	function polite_news_add_main_slider() {
		get_template_part( 'template-parts/sections/slider', 'section' );
	}
endif;
add_action( 'polite_news_action_slider', 'polite_news_add_main_slider', 10 );

if ( ! function_exists( 'polite_news_add_curated_top' ) ) :
	/**
	 * Load the curated posts section above the blog.
	 */
	function polite_news_add_curated_top() {
		get_template_part( 'template-parts/sections/curated-section', null, array( 'area' => 'top' ) );
	}
endif;
add_action( 'polite_news_action_curated_top', 'polite_news_add_curated_top', 10 );

if ( ! function_exists( 'polite_news_add_curated_bottom' ) ) :
	/**
	 * Load the curated posts section below the blog.
	 */
	function polite_news_add_curated_bottom() {
		get_template_part( 'template-parts/sections/curated-section', null, array( 'area' => 'bottom' ) );
	}
endif;
add_action( 'polite_news_action_curated_bottom', 'polite_news_add_curated_bottom', 10 );

if ( ! function_exists( 'polite_news_add_catcols' ) ) :
	/**
	 * Load the category columns section.
	 */
	function polite_news_add_catcols() {
		get_template_part( 'template-parts/sections/catcols-section' );
	}
endif;
add_action( 'polite_news_action_catcols', 'polite_news_add_catcols', 10 );

if ( ! function_exists( 'polite_news_boxes_section' ) ) :
	/**
	 * Add the editor picks section.
	 *
	 * @since 1.0.0
	 */
	function polite_news_boxes_section() {
		get_template_part( 'template-parts/sections/boxes', 'section' );
	}
endif;
add_action( 'polite_news_action_boxes', 'polite_news_boxes_section', 10 );

if ( ! function_exists( 'polite_news_header_layout_array' ) ) :
	/**
	 * Header layout choices.
	 *
	 * @return array
	 */
	function polite_news_header_layout_array() {

		$uri = get_template_directory_uri() . '/assets/images/';

		return array(
			'header-one'   => $uri . 'header-one.png',
			'header-two'   => $uri . 'header-two.png',
			'header-three' => $uri . 'header-three.png',
			'header-four'  => $uri . 'header-four.png',
			'header-five'  => $uri . 'header-five.png',
			'header-six'   => $uri . 'header-six.png',
		);
	}
endif;

if ( ! function_exists( 'polite_news_hero_layout_array' ) ) :
	/**
	 * Hero layout choices for the featured section.
	 *
	 * @return array
	 */
	function polite_news_hero_layout_array() {

		$hero_layouts = array(
			'hero-one'   => get_template_directory_uri() . '/assets/images/hero-one.png',
			'hero-two'   => get_template_directory_uri() . '/assets/images/hero-two.png',
			'hero-three' => get_template_directory_uri() . '/assets/images/hero-three.png',
		);

		return $hero_layouts;
	}
endif;

if ( ! function_exists( 'polite_news_boxes_style_array' ) ) :
	/**
	 * Style choices for the editor picks boxes.
	 *
	 * @return array
	 */
	function polite_news_boxes_style_array() {

		$boxes_styles = array(
			'boxes-one'   => get_template_directory_uri() . '/assets/images/boxes-one.png',
			'boxes-two'   => get_template_directory_uri() . '/assets/images/boxes-two.png',
			'boxes-three' => get_template_directory_uri() . '/assets/images/boxes-three.png',
		);

		return $boxes_styles;
	}
endif;

if ( ! function_exists( 'polite_news_home_style_array' ) ) :
	/**
	 * Style choices for the home page post list.
	 *
	 * @return array
	 */
	function polite_news_home_style_array() {

		$home_styles = array(
			'home-classic'      => get_template_directory_uri() . '/assets/images/home-classic.png',
			'home-one'          => get_template_directory_uri() . '/assets/images/home-one.png',
			'home-two'          => get_template_directory_uri() . '/assets/images/home-two.png',
			'home-three'        => get_template_directory_uri() . '/assets/images/home-three.png',
			'home-large'        => get_template_directory_uri() . '/assets/images/home-large.png',
			'home-masonry-one'  => get_template_directory_uri() . '/assets/images/home-masonry-one.png',
			'home-masonry-two'  => get_template_directory_uri() . '/assets/images/home-masonry-two.png',
			'home-masonry-three' => get_template_directory_uri() . '/assets/images/home-masonry-three.png',
		);

		return $home_styles;
	}
endif;

if ( ! function_exists( 'polite_news_archive_style_array' ) ) :
	/**
	 * Layout choices for the blog and archive listings.
	 *
	 * The same arrangements the home page offers, so a site does not have to
	 * look like two different publications either side of a category link. The
	 * first three keys are the ones this option shipped with and are kept so a
	 * saved setting still means what it used to.
	 *
	 * @return array
	 */
	function polite_news_archive_style_array() {

		$uri = get_template_directory_uri() . '/assets/images/';

		return array(
			'one-column'    => $uri . 'home-two.png',
			'grid-two'      => $uri . 'home-one.png',
			'grid-three'    => $uri . 'home-grid-three.png',
			'classic'       => $uri . 'home-classic.png',
			'large'         => $uri . 'home-large.png',
			'magazine'      => $uri . 'home-three.png',
			'masonry-one'   => $uri . 'home-masonry-one.png',
			'masonry-two'   => $uri . 'home-masonry-two.png',
			'masonry-three' => $uri . 'home-masonry-three.png',
		);
	}
endif;

if ( ! function_exists( 'polite_news_ticker_style_array' ) ) :
	/**
	 * Style choices for the breaking news ticker.
	 *
	 * @return array
	 */
	function polite_news_ticker_style_array() {

		$ticker_styles = array(
			'ticker-one'   => get_template_directory_uri() . '/assets/images/ticker-one.png',
			'ticker-two'   => get_template_directory_uri() . '/assets/images/ticker-two.png',
			'ticker-three' => get_template_directory_uri() . '/assets/images/ticker-three.png',
		);

		return $ticker_styles;
	}
endif;

if ( ! function_exists( 'polite_news_footer_layout_array' ) ) :
	/**
	 * Layout choices for the footer.
	 *
	 * @return array
	 */
	function polite_news_footer_layout_array() {

		$uri = get_template_directory_uri() . '/assets/images/';

		return array(
			'footer-one'   => $uri . 'footer-one.png',
			'footer-two'   => $uri . 'footer-two.png',
			'footer-three' => $uri . 'footer-three.png',
			'footer-four'  => $uri . 'footer-four.png',
		);
	}
endif;

if ( ! function_exists( 'polite_news_blog_sidebar_position_array' ) ) :
	/**
	 * Sidebar layout choices for the blog and archive pages.
	 *
	 * @return array
	 */
	function polite_news_blog_sidebar_position_array() {

		$sidebar_positions = array(
			'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
			'left-sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
			'no-sidebar'    => get_template_directory_uri() . '/assets/images/no-sidebar.png',
			'middle-column' => get_template_directory_uri() . '/assets/images/middle-content.png',
		);

		return $sidebar_positions;
	}
endif;

if ( ! function_exists( 'polite_news_sidebar_position_array' ) ) :
	/**
	 * Sidebar layout choices for single posts and pages.
	 *
	 * @return array
	 */
	function polite_news_sidebar_position_array() {

		$sidebar_positions = array(
			'single-right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
			'single-left-sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
			'single-no-sidebar'    => get_template_directory_uri() . '/assets/images/no-sidebar.png',
			'single-middle-column' => get_template_directory_uri() . '/assets/images/middle-content.png',
		);

		return $sidebar_positions;
	}
endif;

if ( ! function_exists( 'polite_news_section_query' ) ) :
	/**
	 * Build the query used by the front page sections.
	 *
	 * @param int $category Category id, zero for every category.
	 * @param int $number   Number of posts to fetch.
	 * @param int $offset   Number of posts to skip.
	 * @return WP_Query
	 */
	function polite_news_section_query( $category = 0, $number = 3, $offset = 0 ) {

		$args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => absint( $number ),
			'offset'              => absint( $offset ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		if ( absint( $category ) > 0 ) {
			$args['cat'] = absint( $category );
		}

		return new WP_Query( $args );
	}
endif;
