<?php
/**
 * Dynamic css
 *
 * The theme is built on CSS custom properties, so a colour change only needs
 * to rewrite the few tokens rather than a long list of selectors.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_adjust_brightness' ) ) :
	/**
	 * Lighten or darken a hex colour by a percentage.
	 *
	 * @param string $hex     Hex colour, with or without the leading hash.
	 * @param int    $percent Positive to lighten, negative to darken.
	 * @return string Hex colour including the leading hash.
	 */
	function polite_news_adjust_brightness( $hex, $percent ) {

		$hex = ltrim( $hex, '#' );

		if ( 3 === strlen( $hex ) ) {
			$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
		}

		if ( 6 !== strlen( $hex ) ) {
			return '#' . $hex;
		}

		$output = '#';

		for ( $i = 0; $i < 3; $i++ ) {

			$channel = hexdec( substr( $hex, $i * 2, 2 ) );

			if ( $percent >= 0 ) {
				$channel = $channel + ( ( 255 - $channel ) * ( $percent / 100 ) );
			} else {
				$channel = $channel * ( ( 100 + $percent ) / 100 );
			}

			$channel = max( 0, min( 255, (int) round( $channel ) ) );

			$output .= str_pad( dechex( $channel ), 2, '0', STR_PAD_LEFT );
		}

		return $output;
	}
endif;

if ( ! function_exists( 'polite_news_hex_to_rgb' ) ) :
	/**
	 * Convert a hex colour into a comma separated rgb triplet.
	 *
	 * @param string $hex Hex colour.
	 * @return string Comma separated red, green and blue values.
	 */
	function polite_news_hex_to_rgb( $hex ) {

		$hex = ltrim( $hex, '#' );

		if ( 3 === strlen( $hex ) ) {
			$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
		}

		if ( 6 !== strlen( $hex ) ) {
			return '79, 70, 229';
		}

		return hexdec( substr( $hex, 0, 2 ) ) . ', ' . hexdec( substr( $hex, 2, 2 ) ) . ', ' . hexdec( substr( $hex, 4, 2 ) );
	}
endif;

if ( ! function_exists( 'polite_news_dynamic_css' ) ) :
	/**
	 * Build and attach the dynamic stylesheet.
	 */
	function polite_news_dynamic_css() {

		global $polite_news_theme_options;

		$primary    = ! empty( $polite_news_theme_options['polite_news_primary_color'] ) ? sanitize_hex_color( $polite_news_theme_options['polite_news_primary_color'] ) : '#4f46e5';
		$logo_width = absint( $polite_news_theme_options['polite_news_logo_width_option'] );

		if ( empty( $primary ) ) {
			$primary = '#4f46e5';
		}

		$custom_css = '';

		/* Primary colour tokens. */
		$custom_css .= ':root{';
		$custom_css .= '--ts-primary:' . $primary . ';';
		$custom_css .= '--ts-primary-hover:' . polite_news_adjust_brightness( $primary, -12 ) . ';';
		$custom_css .= '--ts-primary-soft:rgba(' . polite_news_hex_to_rgb( $primary ) . ', 0.1);';
		$custom_css .= '}';

		$custom_css .= 'body.ts-dark-mode{';
		$custom_css .= '--ts-primary-soft:rgba(' . polite_news_hex_to_rgb( $primary ) . ', 0.18);';
		$custom_css .= '}';

		/*
		 * Custom container width. The stylesheet holds every contained layout to
		 * 1320px, so only a different number needs writing, and the fixed sticky
		 * bar has to be told separately because it is out of the flow.
		 */
		$page_layout = isset( $polite_news_theme_options['polite-news-page-layout'] ) ? $polite_news_theme_options['polite-news-page-layout'] : 'full';
		$page_width  = isset( $polite_news_theme_options['polite-news-page-width'] ) ? absint( $polite_news_theme_options['polite-news-page-width'] ) : 0;

		if ( 'custom' === $page_layout && $page_width && 1320 !== $page_width ) {
			$custom_css .= 'body.ts-layout-custom #page,body.ts-layout-custom .ts-sticky-nav.is-stuck{max-width:' . $page_width . 'px;}';
		}

		/* Logo width. */
		if ( $logo_width ) {
			/* min() keeps a wide logo inside its container on small screens. */
			$custom_css .= '.custom-logo-link img{max-width:min(' . $logo_width . 'px,100%);height:auto;}';
		}

		/* Typography tokens. */
		$heading_font = polite_news_font_choice( 'polite-news-heading-font', 'Poppins' );
		$body_font    = polite_news_font_choice( 'polite-news-body-font', 'Inter' );
		$paragraph    = absint( $polite_news_theme_options['polite-news-paragraph-font-size'] );

		$font_css = '';

		if ( 'Poppins' !== $heading_font ) {
			$font_css .= '--ts-font-heading:' . polite_news_font_stack( $heading_font ) . ';';
		}

		if ( 'Inter' !== $body_font ) {
			$font_css .= '--ts-font-body:' . polite_news_font_stack( $body_font ) . ';';
		}

		if ( $font_css ) {
			$custom_css .= ':root{' . $font_css . '}';
		}

		if ( $paragraph && 16 !== $paragraph ) {
			$custom_css .= 'body{font-size:' . $paragraph . 'px;}';
		}

		if ( ! empty( $custom_css ) ) {
			wp_add_inline_style( 'polite-news-style', $custom_css );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'polite_news_dynamic_css', 20 );
