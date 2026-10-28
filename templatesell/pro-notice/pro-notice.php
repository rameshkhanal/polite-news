<?php
/**
 * Dismissible upgrade notice.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Show the upgrade notice a week after activation, until it is dismissed.
 */
function polite_news_pro_notice() {

	// Respect the dismissal.
	if ( get_user_meta( get_current_user_id(), 'polite_news_pro_notice_dismissed', true ) ) {
		return;
	}

	// Only for people who can act on it.
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$activated = get_option( 'polite_news_activation_time' );

	if ( ! $activated ) {
		update_option( 'polite_news_activation_time', time() );
		return;
	}

	// Wait a week before asking.
	if ( ( time() - absint( $activated ) ) < WEEK_IN_SECONDS ) {
		return;
	}

	$dismiss_url = wp_nonce_url(
		add_query_arg( 'polite_news_dismiss_notice', '1' ),
		'polite_news_dismiss_notice',
		'polite_news_notice_nonce'
	);
	?>
	<div class="notice polite-news-pro-notice">
		<h2 class="polite-news-notice-title"><?php esc_html_e( 'Enjoying Polite News?', 'polite-news' ); ?></h2>
		<p><?php esc_html_e( 'Unlock the featured carousel, extra layouts, typography options, demo import and premium support with Polite News Pro.', 'polite-news' ); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( 'https://templatesell.com/downloads/polite-news-pro-magazine-wordpress-theme/' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Upgrade to Pro', 'polite-news' ); ?></a>
		<a class="button" href="<?php echo esc_url( $dismiss_url ); ?>"><?php esc_html_e( 'Dismiss', 'polite-news' ); ?></a>
	</div>
	<?php
}
add_action( 'admin_notices', 'polite_news_pro_notice' );

/**
 * Store the dismissal.
 */
function polite_news_pro_notice_dismiss() {

	if ( ! isset( $_GET['polite_news_dismiss_notice'] ) ) {
		return;
	}

	if ( ! isset( $_GET['polite_news_notice_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_GET['polite_news_notice_nonce'] ), 'polite_news_dismiss_notice' ) ) {
		return;
	}

	update_user_meta( get_current_user_id(), 'polite_news_pro_notice_dismissed', 1 );
}
add_action( 'admin_init', 'polite_news_pro_notice_dismiss' );
