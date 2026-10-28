<?php
/**
 * Blog Page Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_blog_page_section',
	array(
		'priority'       => 35,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Blog Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Home page style */
$wp_customize->add_setting(
	'polite_news_options[polite_news_home_style]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_home_style'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite_news_home_style]',
		array(
			'choices'     => polite_news_home_style_array(),
			'label'       => __( 'Home Page Style', 'polite-news' ),
			'description' => __( 'Styles the latest posts on the home page: Classic, Grid, List, Magazine, Large Thumbnail and three Masonry arrangements. Archive pages use the layout options further down.', 'polite-news' ),
			'section'     => 'polite_news_blog_page_section',
			'settings'    => 'polite_news_options[polite_news_home_style]',
			'priority'    => 5,
		)
	)
);

/* Blog page sidebar layout */
$wp_customize->add_setting(
	'polite_news_options[polite-news-sidebar-blog-page]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-sidebar-blog-page'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite-news-sidebar-blog-page]',
		array(
			'choices'     => polite_news_blog_sidebar_position_array(),
			'label'       => __( 'Blog and Archive Sidebar', 'polite-news' ),
			'description' => __( 'This sidebar will work on the blog and archive pages.', 'polite-news' ),
			'section'     => 'polite_news_blog_page_section',
			'settings'    => 'polite_news_options[polite-news-sidebar-blog-page]',
			'priority'    => 10,
		)
	)
);

/* Blog page column number */
/* Sticky sidebar */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_sticky_sidebar]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_sticky_sidebar'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_sticky_sidebar]',
	array(
		'label'       => __( 'Enable Sticky Sidebar', 'polite-news' ),
		'description' => __( 'Hold the sidebar in view while the article scrolls. A sidebar taller than the screen scrolls first and settles once its last widget is visible.', 'polite-news' ),
		'section'     => 'polite_news_blog_page_section',
		'settings'    => 'polite_news_options[polite_news_enable_sticky_sidebar]',
		'type'        => 'checkbox',
		'priority'    => 12,
	)
);

$wp_customize->add_setting(
	'polite_news_options[polite-news-column-blog-page]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-column-blog-page'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite-news-column-blog-page]',
		array(
			'choices'     => polite_news_archive_style_array(),
			'label'       => __( 'Blog and Archive Layout', 'polite-news' ),
			'description' => __( 'The arrangement used on the blog page, category, tag, author and date archives: List, Two or Three Column Grid, Classic, Large Thumbnail, Magazine and three Masonry styles.', 'polite-news' ),
			'section'     => 'polite_news_blog_page_section',
			'settings'    => 'polite_news_options[polite-news-column-blog-page]',
			'priority'    => 15,
		)
	)
);

/* Image layout options for blog page */
$wp_customize->add_setting(
	'polite_news_options[polite-news-blog-image-layout]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-blog-image-layout'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-blog-image-layout]',
	array(
		'choices'     => array(
			'full-image' => __( 'Full Width Image', 'polite-news' ),
			'list-image' => __( 'Image Beside Text', 'polite-news' ),
		),
		'label'       => __( 'Blog Image Position', 'polite-news' ),
		'description' => __( 'This will work only on the List layout option.', 'polite-news' ),
		'section'     => 'polite_news_blog_page_section',
		'settings'    => 'polite_news_options[polite-news-blog-image-layout]',
		'type'        => 'select',
		'priority'    => 20,
	)
);

/* Blog page show content from */
$wp_customize->add_setting(
	'polite_news_options[polite-news-content-show-from]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-content-show-from'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-content-show-from]',
	array(
		'choices'     => array(
			'excerpt' => __( 'Show from Excerpt', 'polite-news' ),
			'content' => __( 'Show from Content', 'polite-news' ),
		),
		'label'       => __( 'Select Content Display From', 'polite-news' ),
		'description' => __( 'You can enable excerpt from Screen Options inside the post section of the dashboard.', 'polite-news' ),
		'section'     => 'polite_news_blog_page_section',
		'settings'    => 'polite_news_options[polite-news-content-show-from]',
		'type'        => 'select',
		'priority'    => 25,
	)
);

/* Blog page excerpt length */
$wp_customize->add_setting(
	'polite_news_options[polite-news-excerpt-length]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-excerpt-length'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-excerpt-length]',
	array(
		'label'       => __( 'Excerpt Length', 'polite-news' ),
		'description' => __( 'Enter the number of words to show in the blog page content.', 'polite-news' ),
		'section'     => 'polite_news_blog_page_section',
		'settings'    => 'polite_news_options[polite-news-excerpt-length]',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 5,
			'max'  => 200,
			'step' => 1,
		),
		'priority'    => 30,
	)
);

/* Exclude category in blog page */
$wp_customize->add_setting(
	'polite_news_options[polite-news-blog-exclude-category]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-blog-exclude-category'],
		'sanitize_callback' => 'polite_news_sanitize_category_list',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-blog-exclude-category]',
	array(
		'label'       => __( 'Exclude Categories in Blog Listing', 'polite-news' ),
		'description' => __( 'Enter category ids comma separated eg: 2,7,14,47.', 'polite-news' ),
		'section'     => 'polite_news_blog_page_section',
		'settings'    => 'polite_news_options[polite-news-blog-exclude-category]',
		'type'        => 'text',
		'priority'    => 35,
	)
);

/* Blog page pagination options */
$wp_customize->add_setting(
	'polite_news_options[polite-news-pagination-options]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-pagination-options'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-pagination-options]',
	array(
		'choices'     => array(
			'numeric' => __( 'Numeric Pagination', 'polite-news' ),
			'ajax'    => __( 'Ajax Load More', 'polite-news' ),
		),
		'label'       => __( 'Pagination Types', 'polite-news' ),
		'description' => __( 'Choose the required pagination type.', 'polite-news' ),
		'section'     => 'polite_news_blog_page_section',
		'settings'    => 'polite_news_options[polite-news-pagination-options]',
		'type'        => 'select',
		'priority'    => 40,
	)
);

/* Blog page read more text */
$wp_customize->add_setting(
	'polite_news_options[polite-news-read-more-text]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite-news-read-more-text'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite-news-read-more-text]',
	array(
		'label'       => __( 'Read More Text', 'polite-news' ),
		'description' => __( 'Read more text for the blog and archive pages. Leave empty to hide it.', 'polite-news' ),
		'section'     => 'polite_news_blog_page_section',
		'settings'    => 'polite_news_options[polite-news-read-more-text]',
		'type'        => 'text',
		'priority'    => 45,
	)
);

/* Meta toggles */
$polite_news_blog_toggles = array(
	'polite-news-show-hide-category' => array(
		'label'       => __( 'Show Category', 'polite-news' ),
		'description' => __( 'Option to show the category badge on the blog page.', 'polite-news' ),
		'priority'    => 50,
	),
	'polite-news-show-hide-date'     => array(
		'label'       => __( 'Show Date', 'polite-news' ),
		'description' => __( 'Option to show the date on the blog page.', 'polite-news' ),
		'priority'    => 55,
	),
	'polite-news-show-hide-author'   => array(
		'label'       => __( 'Show Author', 'polite-news' ),
		'description' => __( 'Option to show the author on the blog page.', 'polite-news' ),
		'priority'    => 60,
	),
	'polite-news-show-hide-share'    => array(
		'label'       => __( 'Show Social Share', 'polite-news' ),
		'description' => __( 'Option to enable social share on the blog and archive pages.', 'polite-news' ),
		'priority'    => 65,
	),
);

foreach ( $polite_news_blog_toggles as $polite_news_toggle_id => $polite_news_toggle ) {

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
			'section'     => 'polite_news_blog_page_section',
			'settings'    => 'polite_news_options[' . $polite_news_toggle_id . ']',
			'type'        => 'checkbox',
			'priority'    => $polite_news_toggle['priority'],
		)
	);
}
