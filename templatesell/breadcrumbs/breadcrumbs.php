<?php
/**
 * Breadcrumb trail generator.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_breadcrumbs' ) ) :
	/**
	 * Print a simple accessible breadcrumb trail.
	 */
	function polite_news_breadcrumbs() {

		$separator = '<span class="separator">/</span>';

		echo '<nav class="ts-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'polite-news' ) . '">';

		echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'polite-news' ) . '</a>';

		if ( is_category() ) {

			echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<span>' . esc_html( single_cat_title( '', false ) ) . '</span>';

		} elseif ( is_tag() ) {

			echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<span>' . esc_html( single_tag_title( '', false ) ) . '</span>';

		} elseif ( is_author() ) {

			echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<span>' . esc_html( get_the_author() ) . '</span>';

		} elseif ( is_search() ) {

			echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			/* translators: %s: search query. */
			echo '<span>' . esc_html( sprintf( __( 'Search results for %s', 'polite-news' ), get_search_query() ) ) . '</span>';

		} elseif ( is_404() ) {

			echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<span>' . esc_html__( 'Page not found', 'polite-news' ) . '</span>';

		} elseif ( is_archive() ) {

			echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<span>' . esc_html( get_the_archive_title() ) . '</span>';

		} elseif ( is_singular( 'post' ) ) {

			$categories = get_the_category();

			if ( ! empty( $categories ) ) {
				echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
			}

			echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<span>' . esc_html( get_the_title() ) . '</span>';

		} elseif ( is_singular() ) {

			$parent_id = wp_get_post_parent_id( get_the_ID() );

			if ( $parent_id ) {
				echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '<a href="' . esc_url( get_permalink( $parent_id ) ) . '">' . esc_html( get_the_title( $parent_id ) ) . '</a>';
			}

			echo $separator; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<span>' . esc_html( get_the_title() ) . '</span>';
		}

		echo '</nav>';
	}
endif;
