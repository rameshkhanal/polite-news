<?php
/**
 * Load Core Files
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Enqueue CSS and JS
 */
require get_template_directory() . '/templatesell/enqueue.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/templatesell/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/templatesell/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/templatesell/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/templatesell/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/templatesell/jetpack.php';
}

/**
 * Load sanitize functions file
 */
require get_template_directory() . '/templatesell/sanitize-functions.php';

/**
 * Load category dropdown functions
 */
require get_template_directory() . '/templatesell/customizer-category-control.php';

/**
 * Load radio image control
 */
require get_template_directory() . '/templatesell/customizer-radio-image-control.php';

/**
 * Custom control: post dropdown.
 */
require get_template_directory() . '/templatesell/customizer-post-control.php';

/**
 * Custom control: group heading.
 */
require get_template_directory() . '/templatesell/customizer-heading-control.php';

/**
 * Google fonts helpers.
 */
require get_template_directory() . '/templatesell/google-fonts.php';

/**
 * Dynamic CSS file load
 */
require get_template_directory() . '/templatesell/dynamic-css.php';

/**
 * Block styles and patterns
 */
require get_template_directory() . '/templatesell/block-editor.php';

/**
 * load custom widgets
 */
require get_template_directory() . '/templatesell/widgets/widget-init.php';
require get_template_directory() . '/templatesell/widgets/ts-author-widget.php';
require get_template_directory() . '/templatesell/widgets/ts-recent-posts-widget.php';
require get_template_directory() . '/templatesell/widgets/ts-social-widget.php';
require get_template_directory() . '/templatesell/widgets/ts-popular-posts-widget.php';
require get_template_directory() . '/templatesell/widgets/ts-chips-widget.php';
require get_template_directory() . '/templatesell/widgets/ts-contact-widget.php';
require get_template_directory() . '/templatesell/widgets/ts-cta-widget.php';
require get_template_directory() . '/templatesell/widgets/ts-banner-widget.php';

/**
 * Load Hooks
 */
require get_template_directory() . '/templatesell/hooks/sections.php';
require get_template_directory() . '/templatesell/hooks/breadcrumb.php';
require get_template_directory() . '/templatesell/hooks/social-sharing.php';
require get_template_directory() . '/templatesell/hooks/related-posts.php';
require get_template_directory() . '/templatesell/hooks/posts-navigation.php';
require get_template_directory() . '/templatesell/hooks/footer.php';
require get_template_directory() . '/templatesell/hooks/structured-data.php';
require get_template_directory() . '/templatesell/hooks/document-meta.php';

/**
 * Load Filters
 */
require get_template_directory() . '/templatesell/filters/excerpt.php';
require get_template_directory() . '/templatesell/filters/body-class.php';
require get_template_directory() . '/templatesell/filters/jetpack-widget.php';
require get_template_directory() . '/templatesell/filters/custom-logo.php';

/**
 * Upgrade to pro
 */
require get_template_directory() . '/templatesell/upgrade/class-customize.php';

/**
 * For Admin Page
 */
if ( is_admin() ) {
	require get_template_directory() . '/templatesell/about/about.php';
	require get_template_directory() . '/templatesell/pro-notice/pro-notice.php';
	require get_template_directory() . '/templatesell/plugin-notice/plugin-notice.php';
}
