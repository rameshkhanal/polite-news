<?php
/**
 * Custom logo filter
 *
 * Adds the optional dark mode logo next to the main logo.
 *
 * @package Polite_News
 * 
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_dark_logo_markup' ) ) :
	/**
	 * Append the dark mode logo to the custom logo link.
	 *
	 * @param string $html Custom logo markup.
	 * @return string
	 */
	function polite_news_dark_logo_markup( $html ) {

		global $polite_news_theme_options;

		if ( empty( $html ) ) {
			return $html;
		}

		$polite_news_dark_logo = isset( $polite_news_theme_options['polite_news_dark_logo'] ) ? absint( $polite_news_theme_options['polite_news_dark_logo'] ) : 0;

		if ( ! $polite_news_dark_logo ) {
			return $html;
		}

		$polite_news_dark_image = wp_get_attachment_image(
			$polite_news_dark_logo,
			'full',
			false,
			array(
				'class'    => 'ts-dark-logo',
				'alt'      => get_bloginfo( 'name', 'display' ),
				/* Hidden with display:none until dark mode is on. */
				'loading'  => 'lazy',
				'decoding' => 'async',
			)
		);

		if ( ! $polite_news_dark_image ) {
			return $html;
		}

		/* The main logo keeps its own class so CSS can hide whichever is not wanted. */
		return str_replace( '</a>', $polite_news_dark_image . '</a>', $html );
	}
endif;
add_filter( 'get_custom_logo', 'polite_news_dark_logo_markup' );
