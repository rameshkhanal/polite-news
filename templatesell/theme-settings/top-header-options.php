<?php
/**
 * Top Header Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_top_header_section',
	array(
		'priority'       => 8,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Top Header Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Enable top header */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_top_header]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_top_header'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_top_header]',
	array(
		'label'       => __( 'Enable Top Header Bar', 'polite-news' ),
		'description' => __( 'Show the dark bar above the site logo.', 'polite-news' ),
		'section'     => 'polite_news_top_header_section',
		'settings'    => 'polite_news_options[polite_news_enable_top_header]',
		'type'        => 'checkbox',
		'priority'    => 10,
	)
);

/* Show today date */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_top_date]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_top_date'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_top_date]',
	array(
		'label'       => __( 'Show Today Date', 'polite-news' ),
		'description' => __( 'Display the current date on the left of the top bar.', 'polite-news' ),
		'section'     => 'polite_news_top_header_section',
		'settings'    => 'polite_news_options[polite_news_enable_top_date]',
		'type'        => 'checkbox',
		'priority'    => 15,
	)
);

/* Show top menu */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_top_header_menu]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_top_header_menu'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_top_header_menu]',
	array(
		'label'       => __( 'Show Top Menu', 'polite-news' ),
		'description' => __( 'Display the menu assigned to the Top Menu location.', 'polite-news' ),
		'section'     => 'polite_news_top_header_section',
		'settings'    => 'polite_news_options[polite_news_enable_top_header_menu]',
		'type'        => 'checkbox',
		'priority'    => 20,
	)
);

/* Show social icons */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_top_header_social]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_top_header_social'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_top_header_social]',
	array(
		'label'       => __( 'Show Social Icons', 'polite-news' ),
		'description' => __( 'Display the menu assigned to the Social Icons location.', 'polite-news' ),
		'section'     => 'polite_news_top_header_section',
		'settings'    => 'polite_news_options[polite_news_enable_top_header_social]',
		'type'        => 'checkbox',
		'priority'    => 25,
	)
);
