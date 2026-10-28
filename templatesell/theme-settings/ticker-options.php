<?php
/**
 * Breaking News Ticker Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_ticker_section',
	array(
		'priority'       => 15,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Breaking News Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Enable ticker */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_ticker]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_ticker'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_ticker]',
	array(
		'label'       => __( 'Enable Breaking News', 'polite-news' ),
		'description' => __( 'Show the rotating headline bar under the main menu on the front page.', 'polite-news' ),
		'section'     => 'polite_news_ticker_section',
		'settings'    => 'polite_news_options[polite_news_enable_ticker]',
		'type'        => 'checkbox',
		'priority'    => 10,
	)
);

/* Ticker style */
$wp_customize->add_setting(
	'polite_news_options[polite_news_ticker_style]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_ticker_style'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite_news_ticker_style]',
		array(
			'choices'     => polite_news_ticker_style_array(),
			'label'       => __( 'Ticker Style', 'polite-news' ),
			'description' => __( 'Pill keeps the rounded soft bar. Solid paints the bar in the primary colour. Minimal is a plain line with a live dot.', 'polite-news' ),
			'section'     => 'polite_news_ticker_section',
			'settings'    => 'polite_news_options[polite_news_ticker_style]',
			'priority'    => 12,
		)
	)
);

/* Ticker label */
$wp_customize->add_setting(
	'polite_news_options[polite_news_ticker_label]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_ticker_label'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_ticker_label]',
	array(
		'label'       => __( 'Breaking News Label', 'polite-news' ),
		'description' => __( 'The text shown inside the coloured badge.', 'polite-news' ),
		'section'     => 'polite_news_ticker_section',
		'settings'    => 'polite_news_options[polite_news_ticker_label]',
		'type'        => 'text',
		'priority'    => 15,
	)
);

/* Ticker category */
$wp_customize->add_setting(
	'polite_news_options[polite-news-ticker-category]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-ticker-category'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	new Polite_News_Category_Dropdown_Control(
		$wp_customize,
		'polite_news_options[polite-news-ticker-category]',
		array(
			'label'       => __( 'Breaking News Category', 'polite-news' ),
			'description' => __( 'Pull the headlines from this category.', 'polite-news' ),
			'section'     => 'polite_news_ticker_section',
			'settings'    => 'polite_news_options[polite-news-ticker-category]',
			'priority'    => 20,
		)
	)
);

/* Number of headlines */
$wp_customize->add_setting(
	'polite_news_options[polite-news-ticker-number]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-ticker-number'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-ticker-number]',
	array(
		'label'       => __( 'Number of Headlines', 'polite-news' ),
		'description' => __( 'How many posts rotate through the breaking news bar.', 'polite-news' ),
		'section'     => 'polite_news_ticker_section',
		'settings'    => 'polite_news_options[polite-news-ticker-number]',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 15,
			'step' => 1,
		),
		'priority'    => 25,
	)
);
