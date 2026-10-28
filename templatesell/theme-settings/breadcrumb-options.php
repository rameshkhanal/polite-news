<?php
/**
 * Breadcrumb Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_breadcrumb_section',
	array(
		'priority'       => 45,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Breadcrumb Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Enable breadcrumb */
$wp_customize->add_setting(
	'polite_news_options[polite-news-extra-breadcrumb]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-extra-breadcrumb'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-extra-breadcrumb]',
	array(
		'label'       => __( 'Enable Breadcrumb', 'polite-news' ),
		'description' => __( 'Show the breadcrumb trail under the main menu.', 'polite-news' ),
		'section'     => 'polite_news_breadcrumb_section',
		'settings'    => 'polite_news_options[polite-news-extra-breadcrumb]',
		'type'        => 'checkbox',
		'priority'    => 10,
	)
);

/* Breadcrumb source */
$wp_customize->add_setting(
	'polite_news_options[polite-news-breadcrumb-selection-option]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-breadcrumb-selection-option'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-breadcrumb-selection-option]',
	array(
		'choices'     => array(
			'theme'    => __( 'Theme Breadcrumb', 'polite-news' ),
			'yoast'    => __( 'Yoast SEO Breadcrumb', 'polite-news' ),
			'rankmath' => __( 'Rank Math Breadcrumb', 'polite-news' ),
		),
		'label'       => __( 'Breadcrumb Source', 'polite-news' ),
		'description' => __( 'Choose which plugin generates the breadcrumb trail.', 'polite-news' ),
		'section'     => 'polite_news_breadcrumb_section',
		'settings'    => 'polite_news_options[polite-news-breadcrumb-selection-option]',
		'type'        => 'select',
		'priority'    => 15,
	)
);
