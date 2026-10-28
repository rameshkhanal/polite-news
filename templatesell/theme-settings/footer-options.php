<?php
/**
 * Footer Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_footer_section',
	array(
		'priority'       => 50,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Footer Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Footer layout */
$wp_customize->add_setting(
	'polite_news_options[polite_news_footer_layout]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_footer_layout'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite_news_footer_layout]',
		array(
			'choices'     => polite_news_footer_layout_array(),
			'label'       => __( 'Footer Layout', 'polite-news' ),
			'description' => __( 'Classic keeps the copyright left and the menu right. Centered stacks everything in the middle. Dark paints the whole footer in the dark palette.', 'polite-news' ),
			'section'     => 'polite_news_footer_section',
			'settings'    => 'polite_news_options[polite_news_footer_layout]',
			'priority'    => 5,
		)
	)
);

/* Copyright text */
$wp_customize->add_setting(
	'polite_news_options[polite-news-footer-copyright]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-footer-copyright'],
		'sanitize_callback' => 'wp_kses_post',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-footer-copyright]',
	array(
		'label'       => __( 'Copyright Text', 'polite-news' ),
		'description' => __( 'The text shown at the bottom of every page.', 'polite-news' ),
		'section'     => 'polite_news_footer_section',
		'settings'    => 'polite_news_options[polite-news-footer-copyright]',
		'type'        => 'textarea',
		'priority'    => 10,
	)
);

/* Go to top */
$wp_customize->add_setting(
	'polite_news_options[polite-news-enable-go-to-top]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-enable-go-to-top'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-enable-go-to-top]',
	array(
		'label'       => __( 'Enable Go To Top Button', 'polite-news' ),
		'description' => __( 'Show a scroll to top button in the bottom corner.', 'polite-news' ),
		'section'     => 'polite_news_footer_section',
		'settings'    => 'polite_news_options[polite-news-enable-go-to-top]',
		'type'        => 'checkbox',
		'priority'    => 15,
	)
);
