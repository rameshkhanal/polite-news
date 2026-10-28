<?php
/**
 * Theme Options Panel
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_panel(
	'polite_news_panel',
	array(
		'priority'   => 30,
		'capability' => 'edit_theme_options',
		'title'      => __( 'Polite News Theme Options', 'polite-news' ),
	)
);

/* Customizer Options */
require get_template_directory() . '/templatesell/theme-settings/general-options.php';
require get_template_directory() . '/templatesell/theme-settings/logo-options.php';
require get_template_directory() . '/templatesell/theme-settings/top-header-options.php';
require get_template_directory() . '/templatesell/theme-settings/header-options.php';
require get_template_directory() . '/templatesell/theme-settings/ticker-options.php';
require get_template_directory() . '/templatesell/theme-settings/color-options.php';
require get_template_directory() . '/templatesell/theme-settings/typography-options.php';
require get_template_directory() . '/templatesell/theme-settings/slider-options.php';
require get_template_directory() . '/templatesell/theme-settings/boxes-options.php';
require get_template_directory() . '/templatesell/theme-settings/curated-options.php';
require get_template_directory() . '/templatesell/theme-settings/blog-page-options.php';
require get_template_directory() . '/templatesell/theme-settings/catcols-options.php';
require get_template_directory() . '/templatesell/theme-settings/single-page-options.php';
require get_template_directory() . '/templatesell/theme-settings/breadcrumb-options.php';
require get_template_directory() . '/templatesell/theme-settings/footer-options.php';
