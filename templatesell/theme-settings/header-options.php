<?php
/**
 * Header Options
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
	'polite_news_header_section',
	array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Header Settings', 'polite-news' ),
		'panel'          => 'polite_news_panel',
	)
);

/* Header layout */
$wp_customize->add_setting(
	'polite_news_options[polite_news_header_layout]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_header_layout'],
		'sanitize_callback' => 'polite_news_sanitize_select',
	)
);

$wp_customize->add_control(
	new Polite_News_Radio_Image_Control(
		$wp_customize,
		'polite_news_options[polite_news_header_layout]',
		array(
			'choices'     => polite_news_header_layout_array(),
			'label'       => __( 'Header Layout', 'polite-news' ),
			'description' => __( 'Classic keeps the branding row above the menu bar. Inline puts the logo, search and menu on one row. Centered stacks the logo above a centered menu.', 'polite-news' ),
			'section'     => 'polite_news_header_section',
			'settings'    => 'polite_news_options[polite_news_header_layout]',
			'priority'    => 5,
		)
	)
);

/* Enable search */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_search]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_search'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_search]',
	array(
		'label'       => __( 'Enable Header Search', 'polite-news' ),
		'description' => __( 'Show a search icon at the end of the main menu.', 'polite-news' ),
		'section'     => 'polite_news_header_section',
		'settings'    => 'polite_news_options[polite_news_enable_search]',
		'type'        => 'checkbox',
		'priority'    => 10,
	)
);

/* Dark mode */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_dark_mode]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_dark_mode'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_dark_mode]',
	array(
		'label'       => __( 'Enable Dark Mode Switch', 'polite-news' ),
		'description' => __( 'Show a light and dark mode switch in the main menu. Visitors who have not chosen yet see the mode their device prefers.', 'polite-news' ),
		'section'     => 'polite_news_header_section',
		'settings'    => 'polite_news_options[polite_news_enable_dark_mode]',
		'type'        => 'checkbox',
		'priority'    => 12,
	)
);

/* Sticky menu */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_sticky_menu]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_sticky_menu'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_sticky_menu]',
	array(
		'label'       => __( 'Enable Sticky Menu', 'polite-news' ),
		'description' => __( 'Keep the main navigation visible while the visitor scrolls.', 'polite-news' ),
		'section'     => 'polite_news_header_section',
		'settings'    => 'polite_news_options[polite_news_enable_sticky_menu]',
		'type'        => 'checkbox',
		'priority'    => 15,
	)
);

/* Header banner */
$wp_customize->add_setting(
	'polite_news_options[polite_news_enable_header_banner]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_enable_header_banner'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_enable_header_banner]',
	array(
		'label'       => __( 'Enable Header Banner', 'polite-news' ),
		'description' => __( 'Show an image beside the logo on the classic header. A wide banner around 728 by 90 pixels fits best.', 'polite-news' ),
		'section'     => 'polite_news_header_section',
		'settings'    => 'polite_news_options[polite_news_enable_header_banner]',
		'type'        => 'checkbox',
		'priority'    => 18,
		'active_callback' => 'polite_news_is_classic_header',
	)
);

$wp_customize->add_setting(
	'polite_news_options[polite_news_header_banner_image]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_header_banner_image'],
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control(
	new WP_Customize_Media_Control(
		$wp_customize,
		'polite_news_options[polite_news_header_banner_image]',
		array(
			'label'           => __( 'Header Banner Image', 'polite-news' ),
			'description'     => __( 'The banner shown beside the logo. Leave empty to use the Header Widget area instead.', 'polite-news' ),
			'section'         => 'polite_news_header_section',
			'settings'        => 'polite_news_options[polite_news_header_banner_image]',
			'mime_type'       => 'image',
			'priority'        => 20,
			'active_callback' => 'polite_news_is_header_banner_on',
		)
	)
);

$wp_customize->add_setting(
	'polite_news_options[polite_news_header_banner_link]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_header_banner_link'],
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_header_banner_link]',
	array(
		'label'           => __( 'Header Banner Link', 'polite-news' ),
		'description'     => __( 'Optional. Where the banner sends the visitor.', 'polite-news' ),
		'section'         => 'polite_news_header_section',
		'settings'        => 'polite_news_options[polite_news_header_banner_link]',
		'type'            => 'url',
		'priority'        => 22,
		'active_callback' => 'polite_news_is_header_banner_on',
	)
);

$wp_customize->add_setting(
	'polite_news_options[polite_news_header_banner_new_tab]',
	array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => $default['polite_news_header_banner_new_tab'],
		'sanitize_callback' => 'polite_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	'polite_news_options[polite_news_header_banner_new_tab]',
	array(
		'label'           => __( 'Open Banner Link In A New Tab', 'polite-news' ),
		'section'         => 'polite_news_header_section',
		'settings'        => 'polite_news_options[polite_news_header_banner_new_tab]',
		'type'            => 'checkbox',
		'priority'        => 24,
		'active_callback' => 'polite_news_is_header_banner_on',
	)
);

if ( ! function_exists( 'polite_news_is_classic_header' ) ) :
	/**
	 * Whether the classic header layout is in use.
	 *
	 * Only that layout has room beside the branding, so the banner controls
	 * stay out of the way on the other two.
	 *
	 * @param WP_Customize_Control $control The control asking.
	 * @return bool
	 */
	function polite_news_is_classic_header( $control ) {
		return 'header-one' === $control->manager->get_setting( 'polite_news_options[polite_news_header_layout]' )->value();
	}
endif;

if ( ! function_exists( 'polite_news_is_header_banner_on' ) ) :
	/**
	 * Whether the header banner is switched on for the classic header.
	 *
	 * @param WP_Customize_Control $control The control asking.
	 * @return bool
	 */
	function polite_news_is_header_banner_on( $control ) {
		if ( ! polite_news_is_classic_header( $control ) ) {
			return false;
		}

		return (bool) $control->manager->get_setting( 'polite_news_options[polite_news_enable_header_banner]' )->value();
	}
endif;
