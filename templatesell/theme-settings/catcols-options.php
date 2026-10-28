<?php
/**
 * Category Columns Options
 *
 * Three side by side category blocks near the end of the home page, each
 * with a lead story and a compact list below it.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_catcols_section',
	array(
		'priority'       => 37,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Category Columns', 'polite-news' ),
		'description'    => __( 'Three category blocks under the latest posts, each with a lead story and a short list.', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Enable */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_catcols]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_catcols'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_catcols]',
	array(
		'label'    => __( 'Enable Category Columns', 'polite-news' ),
		'section'  => 'polite_news_catcols_section',
		'settings' => 'polite_news_options[polite_news_enable_catcols]',
		'type'     => 'checkbox',
		'priority' => 10,
	)
);

/* One category per column */
for ( $polite_news_col = 1; $polite_news_col <= 3; $polite_news_col++ ) {

	$wp_customize->add_setting(
		'polite_news_options[polite-news-catcols-' . $polite_news_col . ']',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => $default[ 'polite-news-catcols-' . $polite_news_col ],
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Polite_News_Category_Dropdown_Control(
			$wp_customize,
			'polite_news_options[polite-news-catcols-' . $polite_news_col . ']',
			array(
				/* translators: %d: column number. */
				'label'           => sprintf( __( 'Column %d Category', 'polite-news' ), $polite_news_col ),
				'section'         => 'polite_news_catcols_section',
				'settings'        => 'polite_news_options[polite-news-catcols-' . $polite_news_col . ']',
				'priority'        => 10 + $polite_news_col,
			)
		)
	);
}
