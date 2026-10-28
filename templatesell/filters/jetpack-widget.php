<?php
/**
 * Jetpack widget filters
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Match the Jetpack widget markup to the theme widget markup.
 *
 * @param array $args Widget arguments.
 * @return array
 */
function polite_news_jetpack_widget_args( $args ) {

	if ( ! is_array( $args ) ) {
		return $args;
	}

	$args['before_title'] = '<h2 class="widget-title">';
	$args['after_title']  = '</h2>';

	return $args;
}
add_filter( 'jetpack_widget_args', 'polite_news_jetpack_widget_args' );
