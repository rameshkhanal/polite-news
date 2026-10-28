<?php
/**
 * Theme fonts
 *
 * The font family choices for the typography settings.
 *
 * @package Polite_News
 * 
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_google_fonts' ) ) :
	/**
	 * The font family choices, family name keyed.
	 *
	 * @return array
	 */
	function polite_news_google_fonts() {

		$polite_news_fonts = array(
			'Poppins' => __( 'Poppins (bundled)', 'polite-news' ),
			'Inter'   => __( 'Inter (bundled)', 'polite-news' ),
			'System'  => __( 'System Sans', 'polite-news' ),
			'Georgia' => __( 'Georgia (serif)', 'polite-news' ),
		);

		return apply_filters( 'polite_news_google_fonts', $polite_news_fonts );
	}
endif;

if ( ! function_exists( 'polite_news_font_choice' ) ) :
	/**
	 * Read and validate a chosen font family.
	 *
	 * @param string $option  Option key.
	 * @param string $default Fallback family.
	 * @return string
	 */
	function polite_news_font_choice( $option, $default ) {

		global $polite_news_theme_options;

		$font  = isset( $polite_news_theme_options[ $option ] ) ? $polite_news_theme_options[ $option ] : $default;
		$fonts = polite_news_google_fonts();

		return isset( $fonts[ $font ] ) ? $font : $default;
	}
endif;

if ( ! function_exists( 'polite_news_font_stack' ) ) :
	/**
	 * The full CSS font stack for a chosen family.
	 *
	 * @param string $family Chosen family.
	 * @return string
	 */
	function polite_news_font_stack( $family ) {

		$stacks = array(
			'Poppins' => "'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif",
			'Inter'   => "'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif",
			'System'  => "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif",
			'Georgia' => "Georgia, 'Times New Roman', serif",
		);

		return isset( $stacks[ $family ] ) ? $stacks[ $family ] : $stacks['Poppins'];
	}
endif;
