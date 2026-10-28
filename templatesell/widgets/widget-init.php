<?php
/**
 * Register the theme custom widgets.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Register every custom widget shipped with the theme.
 */
function polite_news_register_widgets() {

	register_widget( 'Polite_News_Author_Widget' );
	register_widget( 'Polite_News_Recent_Posts_Widget' );
	register_widget( 'Polite_News_Social_Widget' );
	register_widget( 'Polite_News_Popular_Posts_Widget' );
	register_widget( 'Polite_News_Chips_Widget' );
	register_widget( 'Polite_News_Contact_Widget' );
	register_widget( 'Polite_News_CTA_Widget' );
	register_widget( 'Polite_News_Banner_Widget' );
}
add_action( 'widgets_init', 'polite_news_register_widgets' );
