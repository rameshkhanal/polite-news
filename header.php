<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_enable_slider = absint( $polite_news_theme_options['polite_news_enable_slider'] );
$polite_news_enable_boxes  = absint( $polite_news_theme_options['polite_news_enable_boxes'] );
$polite_news_enable_ticker  = absint( $polite_news_theme_options['polite_news_enable_ticker'] );
$polite_news_curated_top    = absint( $polite_news_theme_options['polite_news_enable_curated_top'] );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'polite-news' ); ?></a>

	<?php
	/**
	 * Hook - polite_news_action_header.
	 *
	 * @hooked polite_news_add_main_header - 10
	 */
	do_action( 'polite_news_action_header' );
	?>

	<?php if ( 1 === $polite_news_enable_ticker && ( is_home() || is_front_page() ) ) : ?>
		<section class="ts-ticker-wrap" aria-label="<?php esc_attr_e( 'Breaking news', 'polite-news' ); ?>">
			<div class="ts-container">
				<?php
				/**
				 * Breaking news ticker hook.
				 *
				 * @hooked polite_news_add_ticker - 10
				 */
				do_action( 'polite_news_action_ticker' );
				?>
			</div>
		</section>
	<?php endif; ?>

	<?php
	/**
	 * Breadcrumb hook.
	 *
	 * @hooked polite_news_add_breadcrumb - 10
	 */
	do_action( 'polite_news_action_breadcrumb' );
	?>

	<?php if ( 1 === $polite_news_enable_slider && ( is_home() || is_front_page() ) && ! is_paged() ) : ?>
		<section class="ts-slider-wrap" aria-label="<?php esc_attr_e( 'Featured stories', 'polite-news' ); ?>">
			<div class="ts-container">
				<?php
				/**
				 * Featured post hook.
				 *
				 * @hooked polite_news_add_main_slider - 10
				 */
				do_action( 'polite_news_action_slider' );
				?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( 1 === $polite_news_enable_boxes && ( is_home() || is_front_page() ) && ! is_paged() ) : ?>
		<section class="ts-boxes-wrap" aria-label="<?php esc_attr_e( 'Editor picks', 'polite-news' ); ?>">
			<div class="ts-container">
				<?php
				/**
				 * Editor picks hook.
				 *
				 * @hooked polite_news_boxes_section - 10
				 */
				do_action( 'polite_news_action_boxes' );
				?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( 1 === $polite_news_curated_top && ( is_home() || is_front_page() ) && ! is_paged() ) : ?>
		<section class="ts-curated-wrap" aria-label="<?php esc_attr_e( 'Curated stories', 'polite-news' ); ?>">
			<div class="ts-container">
				<?php
				/**
				 * Curated posts above the blog hook.
				 *
				 * @hooked polite_news_add_curated_top - 10
				 */
				do_action( 'polite_news_action_curated_top' );
				?>
			</div>
		</section>
	<?php endif; ?>
