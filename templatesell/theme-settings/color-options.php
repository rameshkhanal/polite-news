<?php
/**
 * Color Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/* Primary color */
$wp_customize->add_setting(
	'polite_news_options[polite_news_primary_color]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_primary_color'],
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'polite_news_options[polite_news_primary_color]',
		array(
			'label'       => __( 'Primary Color', 'polite-news' ),
			'description' => __( 'Change the accent colour used across the whole site.', 'polite-news' ),
			'section'     => 'polite_news_general_section',
			'settings'    => 'polite_news_options[polite_news_primary_color]',
			'priority'    => 25,
		)
	)
);
