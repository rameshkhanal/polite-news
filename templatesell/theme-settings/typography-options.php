<?php
/**
 * Typography Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/* Heading font */
$wp_customize->add_setting(
	'polite_news_options[polite-news-heading-font]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-heading-font'],
		'sanitize_callback' => 'polite_news_sanitize_font',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-heading-font]',
	array(
		'choices'     => polite_news_google_fonts(),
		'label'       => __( 'Heading Font', 'polite-news' ),
		'description' => __( 'Font used for headings and post titles. Every choice loads from the theme or the device, nothing is fetched from outside.', 'polite-news' ),
		'section'     => 'polite_news_general_section',
		'settings'    => 'polite_news_options[polite-news-heading-font]',
		'type'        => 'select',
		'priority'    => 35,
	)
);

/* Body font */
$wp_customize->add_setting(
	'polite_news_options[polite-news-body-font]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-body-font'],
		'sanitize_callback' => 'polite_news_sanitize_font',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-body-font]',
	array(
		'choices'     => polite_news_google_fonts(),
		'label'       => __( 'Body Font', 'polite-news' ),
		'description' => __( 'Font used for paragraphs and interface text.', 'polite-news' ),
		'section'     => 'polite_news_general_section',
		'settings'    => 'polite_news_options[polite-news-body-font]',
		'type'        => 'select',
		'priority'    => 40,
	)
);

/* Paragraph font size */
$wp_customize->add_setting(
	'polite_news_options[polite-news-paragraph-font-size]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-paragraph-font-size'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-paragraph-font-size]',
	array(
		'label'       => __( 'Paragraph Font Size', 'polite-news' ),
		'description' => __( 'Applies to paragraphs, not headings.', 'polite-news' ),
		'section'     => 'polite_news_general_section',
		'settings'    => 'polite_news_options[polite-news-paragraph-font-size]',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 13,
			'max'  => 20,
			'step' => 1,
		),
		'priority'    => 45,
	)
);
