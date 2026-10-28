<?php
/**
 * Block editor additions: block styles and block patterns.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Register the theme block styles.
 */
function polite_news_register_block_styles() {

	if ( ! function_exists( 'register_block_style' ) ) {
		return;
	}

	register_block_style(
		'core/button',
		array(
			'name'         => 'polite-news-pill',
			'label'        => __( 'Pill', 'polite-news' ),
			'inline_style' => '.is-style-polite-news-pill .wp-block-button__link{border-radius:9999px;}',
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'         => 'polite-news-rounded',
			'label'        => __( 'Rounded Card', 'polite-news' ),
			'inline_style' => '.is-style-polite-news-rounded img{border-radius:24px;}',
		)
	);

	register_block_style(
		'core/quote',
		array(
			'name'         => 'polite-news-highlight',
			'label'        => __( 'Highlight', 'polite-news' ),
			'inline_style' => '.is-style-polite-news-highlight{border-left:4px solid var(--ts-primary, #4f46e5);border-radius:16px;background-color:var(--ts-bg-soft, #f9fafb);padding:22px 28px;}',
		)
	);
}
add_action( 'init', 'polite_news_register_block_styles' );

/**
 * Register the pattern category used by the files in /patterns.
 *
 * WordPress auto registers the patterns themselves from that folder; only
 * the category has to be declared here.
 */
function polite_news_register_block_patterns() {

	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	register_block_pattern_category(
		'polite-news',
		array( 'label' => __( 'Polite News', 'polite-news' ) )
	);
}
add_action( 'init', 'polite_news_register_block_patterns' );
