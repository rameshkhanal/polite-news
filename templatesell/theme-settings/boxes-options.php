<?php
/**
 * Editor Picks Boxes Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_boxes_section',
	array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Editor Picks Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Enable boxes */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_boxes]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_boxes'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_boxes]',
	array(
		'label'       => __( 'Enable Editor Picks', 'polite-news' ),
		'description' => __( 'Show the row of highlighted stories under the featured post.', 'polite-news' ),
		'section'     => 'polite_news_boxes_section',
		'settings'    => 'polite_news_options[polite_news_enable_boxes]',
		'type'        => 'checkbox',
		'priority'    => 10,
	)
);

/* Boxes style */
$wp_customize->add_setting(
	'polite_news_options[polite_news_boxes_style]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_boxes_style'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite_news_boxes_style]',
		array(
			'choices'     => polite_news_boxes_style_array(),
			'label'       => __( 'Editor Picks Style', 'polite-news' ),
			'description' => __( 'Overlay lays the title over the image. Card shows the image above the title. Numbered lists the stories as a ranked row.', 'polite-news' ),
			'section'     => 'polite_news_boxes_section',
			'settings'    => 'polite_news_options[polite_news_boxes_style]',
			'priority'    => 12,
		)
	)
);

/* Content source */
$wp_customize->add_setting(
	'polite_news_options[polite-news-boxes-content-type]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-boxes-content-type'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-boxes-content-type]',
	array(
		'label'       => __( 'Content Source', 'polite-news' ),
		'description' => __( 'Pull the stories from a category or pick each post yourself.', 'polite-news' ),
		'section'     => 'polite_news_boxes_section',
		'settings'    => 'polite_news_options[polite-news-boxes-content-type]',
		'type'        => 'select',
		'choices'     => array(
			'category' => __( 'Category', 'polite-news' ),
			'posts'    => __( 'Individual Posts', 'polite-news' ),
		),
		'priority'    => 14,
	)
);

/* Boxes category */
$wp_customize->add_setting(
	'polite_news_options[polite-news-boxes-category]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-boxes-category'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	new Polite_News_Category_Dropdown_Control(
		$wp_customize,
		'polite_news_options[polite-news-boxes-category]',
		array(
			'label'           => __( 'Editor Picks Category', 'polite-news' ),
			'description'     => __( 'Pull the highlighted stories from this category.', 'polite-news' ),
			'section'         => 'polite_news_boxes_section',
			'settings'        => 'polite_news_options[polite-news-boxes-category]',
			'priority'        => 15,
			'active_callback' => 'polite_news_boxes_source_is_category',
		)
	)
);

/* Number of boxes */
$wp_customize->add_setting(
	'polite_news_options[polite-news-boxes-number]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-boxes-number'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-boxes-number]',
	array(
		'label'           => __( 'Number of Editor Picks', 'polite-news' ),
		'description'     => __( 'How many stories appear in the highlight row.', 'polite-news' ),
		'section'         => 'polite_news_boxes_section',
		'settings'        => 'polite_news_options[polite-news-boxes-number]',
		'type'            => 'number',
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		),
		'priority'        => 20,
		'active_callback' => 'polite_news_boxes_source_is_category',
	)
);

/* Individual post pickers */
for ( $polite_news_pick = 1; $polite_news_pick <= 4; $polite_news_pick++ ) {

	$wp_customize->add_setting(
		'polite_news_options[polite-news-boxes-post-' . $polite_news_pick . ']',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => $default[ 'polite-news-boxes-post-' . $polite_news_pick ],
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new Polite_News_Post_Dropdown_Control(
			$wp_customize,
			'polite_news_options[polite-news-boxes-post-' . $polite_news_pick . ']',
			array(
				/* translators: %d: pick number. */
				'label'           => sprintf( __( 'Pick Post %d', 'polite-news' ), $polite_news_pick ),
				'section'         => 'polite_news_boxes_section',
				'settings'        => 'polite_news_options[polite-news-boxes-post-' . $polite_news_pick . ']',
				'priority'        => 20 + $polite_news_pick,
				'active_callback' => 'polite_news_boxes_source_is_posts',
			)
		)
	);
}

if ( ! function_exists( 'polite_news_boxes_source_is_category' ) ) :
	/**
	 * Whether the editor picks pull from a category.
	 *
	 * @param WP_Customize_Control $control The control asking.
	 * @return bool
	 */
	function polite_news_boxes_source_is_category( $control ) {
		return 'posts' !== $control->manager->get_setting( 'polite_news_options[polite-news-boxes-content-type]' )->value();
	}
endif;

if ( ! function_exists( 'polite_news_boxes_source_is_posts' ) ) :
	/**
	 * Whether the editor picks are hand picked posts.
	 *
	 * @param WP_Customize_Control $control The control asking.
	 * @return bool
	 */
	function polite_news_boxes_source_is_posts( $control ) {
		return 'posts' === $control->manager->get_setting( 'polite_news_options[polite-news-boxes-content-type]' )->value();
	}
endif;
