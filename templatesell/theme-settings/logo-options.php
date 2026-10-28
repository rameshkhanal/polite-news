<?php
/**
 * Logo Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/* Logo width */
$wp_customize->add_setting(
	'polite_news_options[polite_news_logo_width_option]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_logo_width_option'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_logo_width_option]',
	array(
		'label'       => __( 'Logo Width', 'polite-news' ),
		'description' => __( 'Set the maximum logo width in pixels.', 'polite-news' ),
		'section'     => 'title_tagline',
		'settings'    => 'polite_news_options[polite_news_logo_width_option]',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 50,
			'max'  => 1000,
			'step' => 10,
		),
		'priority'    => 15,
	)
);

/* Dark mode logo */
$wp_customize->add_setting(
	'polite_news_options[polite_news_dark_logo]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_dark_logo'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	new WP_Customize_Media_Control(
		$wp_customize,
		'polite_news_options[polite_news_dark_logo]',
		array(
			'label'       => __( 'Dark Mode Logo', 'polite-news' ),
			'description' => __( 'Optional. Shown while dark mode is on, where a dark logo would be hard to read. The main logo is used when this is empty.', 'polite-news' ),
			'section'     => 'title_tagline',
			'settings'    => 'polite_news_options[polite_news_dark_logo]',
			'mime_type'   => 'image',
			'priority'    => 16,
		)
	)
);
