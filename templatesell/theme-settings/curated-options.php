<?php
/**
 * Curated Posts Options
 *
 * Two curated post sections on the home page: one above the latest posts
 * and one below them. Each pulls from its own category with its own
 * heading.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$polite_news_curated_areas = array(
	'top'    => array(
		'title'       => __( 'Curated Posts (Above Blog)', 'polite-news' ),
		'description' => __( 'Shows between the editor picks and the latest posts on the home page.', 'polite-news' ),
		'priority'    => 34,
	),
	'bottom' => array(
		'title'       => __( 'Curated Posts (Below Blog)', 'polite-news' ),
		'description' => __( 'Shows under the latest posts on the home page.', 'polite-news' ),
		'priority'    => 36,
	),
);

foreach ( $polite_news_curated_areas as $polite_news_area => $polite_news_area_args ) {

	$wp_customize->add_section(
		'polite_news_curated_' . $polite_news_area . '_section',
		array(
			'priority'       => $polite_news_area_args['priority'],
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => $polite_news_area_args['title'],
			'description'    => $polite_news_area_args['description'],
			'panel'          => 'polite_news_panel',
		)
	);

	/* Enable */
	$wp_customize->add_setting(
		'polite_news_options[polite_news_enable_curated_' . $polite_news_area . ']',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => $default[ 'polite_news_enable_curated_' . $polite_news_area ],
			'sanitize_callback' => 'polite_news_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'polite_news_options[polite_news_enable_curated_' . $polite_news_area . ']',
		array(
			'label'    => __( 'Enable Curated Posts', 'polite-news' ),
			'section'  => 'polite_news_curated_' . $polite_news_area . '_section',
			'settings' => 'polite_news_options[polite_news_enable_curated_' . $polite_news_area . ']',
			'type'     => 'checkbox',
			'priority' => 10,
		)
	);

	/* Small label above the heading */
	$wp_customize->add_setting(
		'polite_news_options[polite-news-curated-' . $polite_news_area . '-kicker]',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => $default[ 'polite-news-curated-' . $polite_news_area . '-kicker' ],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'polite_news_options[polite-news-curated-' . $polite_news_area . '-kicker]',
		array(
			'label'       => __( 'Small Label', 'polite-news' ),
			'description' => __( 'The short uppercase line above the heading.', 'polite-news' ),
			'section'     => 'polite_news_curated_' . $polite_news_area . '_section',
			'settings'    => 'polite_news_options[polite-news-curated-' . $polite_news_area . '-kicker]',
			'type'        => 'text',
			'priority'    => 15,
		)
	);

	/* Heading */
	$wp_customize->add_setting(
		'polite_news_options[polite-news-curated-' . $polite_news_area . '-title]',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => $default[ 'polite-news-curated-' . $polite_news_area . '-title' ],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'polite_news_options[polite-news-curated-' . $polite_news_area . '-title]',
		array(
			'label'    => __( 'Heading', 'polite-news' ),
			'section'  => 'polite_news_curated_' . $polite_news_area . '_section',
			'settings' => 'polite_news_options[polite-news-curated-' . $polite_news_area . '-title]',
			'type'     => 'text',
			'priority' => 20,
		)
	);

	/* Category */
	$wp_customize->add_setting(
		'polite_news_options[polite-news-curated-' . $polite_news_area . '-category]',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => $default[ 'polite-news-curated-' . $polite_news_area . '-category' ],
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Polite_News_Category_Dropdown_Control(
			$wp_customize,
			'polite_news_options[polite-news-curated-' . $polite_news_area . '-category]',
			array(
				'label'       => __( 'Category', 'polite-news' ),
				'description' => __( 'Pull the stories from this category. The View More link opens it.', 'polite-news' ),
				'section'     => 'polite_news_curated_' . $polite_news_area . '_section',
				'settings'    => 'polite_news_options[polite-news-curated-' . $polite_news_area . '-category]',
				'priority'    => 25,
			)
		)
	);

	/* Number of posts */
	$wp_customize->add_setting(
		'polite_news_options[polite-news-curated-' . $polite_news_area . '-number]',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => $default[ 'polite-news-curated-' . $polite_news_area . '-number' ],
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'polite_news_options[polite-news-curated-' . $polite_news_area . '-number]',
		array(
			'label'       => __( 'Number of Posts', 'polite-news' ),
			'section'     => 'polite_news_curated_' . $polite_news_area . '_section',
			'settings'    => 'polite_news_options[polite-news-curated-' . $polite_news_area . '-number]',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 2,
				'max'  => 6,
				'step' => 2,
			),
			'priority'    => 30,
		)
	);
}
