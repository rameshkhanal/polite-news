<?php
/**
 * Single Page Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_single_page_section',
	array(
		'priority'       => 40,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Single Post Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Single page sidebar layout */
$wp_customize->add_setting(
	'polite_news_options[polite-news-sidebar-single-page]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-sidebar-single-page'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite-news-sidebar-single-page]',
		array(
			'choices'     => polite_news_sidebar_position_array(),
			'label'       => __( 'Single Post Sidebar', 'polite-news' ),
			'description' => __( 'This sidebar will work on single posts and pages.', 'polite-news' ),
			'section'     => 'polite_news_single_page_section',
			'settings'    => 'polite_news_options[polite-news-sidebar-single-page]',
			'priority'    => 10,
		)
	)
);

/* Toggles */
$polite_news_single_toggles = array(
	'polite-news-single-page-featured-image' => array(
		'label'       => __( 'Show Featured Image', 'polite-news' ),
		'description' => __( 'Display the featured image at the top of a single post.', 'polite-news' ),
		'priority'    => 15,
	),
	'polite-news-single-social-share'        => array(
		'label'       => __( 'Show Social Share', 'polite-news' ),
		'description' => __( 'Display the sharing buttons under the post content.', 'polite-news' ),
		'priority'    => 20,
	),
	'polite-news-single-author-box'          => array(
		'label'       => __( 'Show Author Box', 'polite-news' ),
		'description' => __( 'Display the author biography under the post content.', 'polite-news' ),
		'priority'    => 25,
	),
	'polite-news-single-post-navigation'     => array(
		'label'       => __( 'Show Post Navigation', 'polite-news' ),
		'description' => __( 'Display the previous and next post links.', 'polite-news' ),
		'priority'    => 30,
	),
	'polite-news-single-page-related-posts'  => array(
		'label'       => __( 'Show Related Posts', 'polite-news' ),
		'description' => __( 'Display related posts from the same category.', 'polite-news' ),
		'priority'    => 35,
	),
);

foreach ( $polite_news_single_toggles as $polite_news_toggle_id => $polite_news_toggle ) {

	$wp_customize->add_setting(
		'polite_news_options[' . $polite_news_toggle_id . ']',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => $default[ $polite_news_toggle_id ],
			'sanitize_callback' => 'polite_news_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'polite_news_options[' . $polite_news_toggle_id . ']',
		array(
			'label'       => $polite_news_toggle['label'],
			'description' => $polite_news_toggle['description'],
			'section'     => 'polite_news_single_page_section',
			'settings'    => 'polite_news_options[' . $polite_news_toggle_id . ']',
			'type'        => 'checkbox',
			'priority'    => $polite_news_toggle['priority'],
		)
	);
}

/* Related posts title */
$wp_customize->add_setting(
	'polite_news_options[polite-news-single-page-related-posts-title]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-single-page-related-posts-title'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-single-page-related-posts-title]',
	array(
		'label'       => __( 'Related Posts Title', 'polite-news' ),
		'description' => __( 'The heading shown above the related posts.', 'polite-news' ),
		'section'     => 'polite_news_single_page_section',
		'settings'    => 'polite_news_options[polite-news-single-page-related-posts-title]',
		'type'        => 'text',
		'priority'    => 40,
	)
);
