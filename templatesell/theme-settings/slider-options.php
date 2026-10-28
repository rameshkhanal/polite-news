<?php
/**
 * Featured Slider Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_slider_section',
	array(
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Featured Post Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Enable slider */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_slider]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_slider'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_slider]',
	array(
		'label'       => __( 'Enable Featured Post', 'polite-news' ),
		'description' => __( 'Show the large featured story on the front page.', 'polite-news' ),
		'section'     => 'polite_news_slider_section',
		'settings'    => 'polite_news_options[polite_news_enable_slider]',
		'type'        => 'checkbox',
		'priority'    => 10,
	)
);

/* Hero layout */
$wp_customize->add_setting(
	'polite_news_options[polite_news_hero_layout]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_hero_layout'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite_news_hero_layout]',
		array(
			'choices'     => polite_news_hero_layout_array(),
			'label'       => __( 'Hero Layout', 'polite-news' ),
			'description' => __( 'Overlay shows one big story. Magazine pairs a lead story with three side stories. Panel floats the latest headlines over the image.', 'polite-news' ),
			'section'     => 'polite_news_slider_section',
			'settings'    => 'polite_news_options[polite_news_hero_layout]',
			'priority'    => 12,
		)
	)
);

/* Slider category */
$wp_customize->add_setting(
	'polite_news_options[polite-news-slider-category]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-slider-category'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	new Polite_News_Category_Dropdown_Control(
		$wp_customize,
		'polite_news_options[polite-news-slider-category]',
		array(
			'label'       => __( 'Featured Post Category', 'polite-news' ),
			'description' => __( 'Pull the featured story from this category.', 'polite-news' ),
			'section'     => 'polite_news_slider_section',
			'settings'    => 'polite_news_options[polite-news-slider-category]',
			'priority'    => 15,
		)
	)
);

/* Number of featured posts */
$wp_customize->add_setting(
	'polite_news_options[polite-news-slider-number]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-slider-number'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-slider-number]',
	array(
		'label'       => __( 'Number of Featured Posts', 'polite-news' ),
		'description' => __( 'Show up to six stories in the featured slider. Works on the Overlay hero layout.', 'polite-news' ),
		'section'     => 'polite_news_slider_section',
		'settings'    => 'polite_news_options[polite-news-slider-number]',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 6,
			'step' => 1,
		),
		'priority'    => 20,
	)
);
