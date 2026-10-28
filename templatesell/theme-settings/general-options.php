<?php
/**
 * General Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_general_section',
	array(
		'priority'       => 4,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'General Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Page layout */
$wp_customize->add_setting(
	'polite_news_options[polite-news-page-layout]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-page-layout'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-page-layout]',
	array(
		'label'       => __( 'Page Layout', 'polite-news' ),
		'description' => __( 'Full width fills the window. Boxed centres the site in a container, framed adds a gutter around it, and custom width lets you set the container yourself.', 'polite-news' ),
		'section'     => 'polite_news_general_section',
		'settings'    => 'polite_news_options[polite-news-page-layout]',
		'type'        => 'select',
		'choices'     => array(
			'full'   => __( 'Full Width', 'polite-news' ),
			'boxed'  => __( 'Boxed', 'polite-news' ),
			'framed' => __( 'Framed', 'polite-news' ),
			'custom' => __( 'Custom Width', 'polite-news' ),
		),
		'priority'    => 10,
	)
);

/* Container width, for the custom width layout only. */
$wp_customize->add_setting(
	'polite_news_options[polite-news-page-width]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-page-width'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-page-width]',
	array(
		'label'           => __( 'Container Width (px)', 'polite-news' ),
		'description'     => __( 'The width the site is held to. Used by the Custom Width layout.', 'polite-news' ),
		'section'         => 'polite_news_general_section',
		'settings'        => 'polite_news_options[polite-news-page-width]',
		'type'            => 'number',
		'input_attrs'     => array(
			'min'  => 960,
			'max'  => 1920,
			'step' => 10,
		),
		/* Only worth showing once the layout that reads it is chosen. */
		'active_callback' => 'polite_news_is_custom_width_layout',
		'priority'        => 11,
	)
);

/**
 * Group headings.
 *
 * The customizer cannot nest one section inside another, so the colour and
 * typography controls live here and these headings keep the three groups
 * apart. Their priorities sit just above the controls they introduce.
 */
$wp_customize->add_setting(
	'polite_news_colour_heading',
	array(
		'capability'        => 'edit_theme_options',
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	new Polite_News_Heading_Control(
		$wp_customize,
		'polite_news_colour_heading',
		array(
			'label'       => __( 'Colors', 'polite-news' ),
			'description' => __( 'The accent colour used across the whole site.', 'polite-news' ),
			'section'     => 'polite_news_general_section',
			'settings'    => 'polite_news_colour_heading',
			'priority'    => 20,
		)
	)
);

$wp_customize->add_setting(
	'polite_news_typography_heading',
	array(
		'capability'        => 'edit_theme_options',
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	new Polite_News_Heading_Control(
		$wp_customize,
		'polite_news_typography_heading',
		array(
			'label'       => __( 'Typography', 'polite-news' ),
			'description' => __( 'Fonts and reading size.', 'polite-news' ),
			'section'     => 'polite_news_general_section',
			'settings'    => 'polite_news_typography_heading',
			'priority'    => 30,
		)
	)
);

if ( ! function_exists( 'polite_news_is_custom_width_layout' ) ) :
	/**
	 * Whether the layout that reads the container width is chosen.
	 *
	 * @param WP_Customize_Control $control The control asking.
	 * @return bool
	 */
	function polite_news_is_custom_width_layout( $control ) {
		return 'custom' === $control->manager->get_setting( 'polite_news_options[polite-news-page-layout]' )->value();
	}
endif;
