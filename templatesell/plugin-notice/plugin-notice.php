<?php
/**
 * Dismissible recommended plugins notice.
 *
 * @package Polite_News
 * 
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_recommended_plugins' ) ) :
	/**
	 * The plugins worth suggesting, in the order they are shown.
	 *
	 * @return array[] Each entry has a slug, the main file and a display name.
	 */
	function polite_news_recommended_plugins() {

		return array(
			array(
				'slug' => 'one-click-demo-import',
				'file' => 'one-click-demo-import/one-click-demo-import.php',
				'name' => __( 'One Click Demo Import', 'polite-news' ),
			),
			array(
				'slug' => 'template-sell-demo-importer',
				'file' => 'template-sell-demo-importer/templatesell-demo-importer.php',
				'name' => __( 'Template Sell Demo Importer', 'polite-news' ),
			),
			array(
				'slug' => 'templatesell-gated-downloads',
				'file' => 'templatesell-gated-downloads/templatesell-gated-downloads.php',
				'name' => __( 'Gated Downloads', 'polite-news' ),
			),
			array(
				'slug' => 'templatesell-captchaflow',
				'file' => 'templatesell-captchaflow/captchaflow.php',
				'name' => __( 'CaptchaFlow', 'polite-news' ),
			),
		);
	}
endif;

/**
 * List the recommended plugins that are not active yet.
 *
 * @return array[] Subset of polite_news_recommended_plugins().
 */
function polite_news_missing_recommended_plugins() {

	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$missing = array();

	foreach ( polite_news_recommended_plugins() as $plugin ) {
		if ( ! is_plugin_active( $plugin['file'] ) ) {
			$missing[] = $plugin;
		}
	}

	return $missing;
}

/**
 * Show the recommendation until it is dismissed or everything is active.
 */
function polite_news_plugin_notice() {

	if ( ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	if ( get_user_meta( get_current_user_id(), 'polite_news_plugin_notice_dismissed', true ) ) {
		return;
	}

	$missing = polite_news_missing_recommended_plugins();

	if ( empty( $missing ) ) {
		return;
	}

	$names = array();

	foreach ( $missing as $plugin ) {
		$names[] = '<em>' . esc_html( $plugin['name'] ) . '</em>';
	}

	$dismiss_url = wp_nonce_url(
		add_query_arg( 'polite_news_dismiss_plugins', '1' ),
		'polite_news_dismiss_plugins',
		'polite_news_plugins_nonce'
	);
	?>
	<div class="notice notice-info polite-news-plugin-notice is-dismissible">
		<p>
			<?php
			printf(
				/* translators: %s: comma separated list of plugin names. */
				esc_html__( 'Polite News recommends these free plugins: %s.', 'polite-news' ),
				wp_kses( implode( ', ', $names ), array( 'em' => array() ) )
			);
			?>
			<?php esc_html_e( 'None of them are required.', 'polite-news' ); ?>
		</p>
		<p>
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=polite-news-about' ) ); ?>"><?php esc_html_e( 'Begin installing plugins', 'polite-news' ); ?></a>
			<span aria-hidden="true">|</span>
			<a href="<?php echo esc_url( $dismiss_url ); ?>"><?php esc_html_e( 'Dismiss this notice', 'polite-news' ); ?></a>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'polite_news_plugin_notice' );

/**
 * Store the dismissal.
 */
function polite_news_plugin_notice_dismiss() {

	if ( ! isset( $_GET['polite_news_dismiss_plugins'] ) ) {
		return;
	}

	if ( ! isset( $_GET['polite_news_plugins_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_GET['polite_news_plugins_nonce'] ), 'polite_news_dismiss_plugins' ) ) {
		return;
	}

	update_user_meta( get_current_user_id(), 'polite_news_plugin_notice_dismissed', 1 );
}
add_action( 'admin_init', 'polite_news_plugin_notice_dismiss' );
