<?php
/**
 * Footer hooks
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_go_to_top' ) ) :
	/**
	 * Print the scroll to top button.
	 *
	 * @since 1.0.0
	 */
	function polite_news_go_to_top() {

		global $polite_news_theme_options;

		if ( empty( $polite_news_theme_options['polite-news-enable-go-to-top'] ) ) {
			return;
		}
		?>
		<button type="button" id="toTop">
			<i class="fa fa-angle-up" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Go to top', 'polite-news' ); ?></span>
		</button>
		<?php
	}
endif;
add_action( 'polite_news_go_to_top_hook', 'polite_news_go_to_top', 10 );
