<?php
/**
 * Theme about page.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Register the about page under Appearance.
 */
function polite_news_about_page_menu() {

	add_theme_page(
		esc_html__( 'About Polite News', 'polite-news' ),
		esc_html__( 'About Polite News', 'polite-news' ),
		'edit_theme_options',
		'polite-news-about',
		'polite_news_about_page_render'
	);
}
add_action( 'admin_menu', 'polite_news_about_page_menu' );

/**
 * Build the install, activate or active button for a recommended plugin.
 *
 * @param string $slug Plugin slug on WordPress.org.
 * @param string $file Plugin main file, relative to the plugins directory.
 * @param string $name Plugin name shown on the button.
 */
function polite_news_recommended_plugin_button( $slug, $file, $name ) {

	if ( is_plugin_active( $file ) ) {
		?>
		<span class="button button-disabled"><?php echo esc_html( $name ); ?> &mdash; <?php esc_html_e( 'Active', 'polite-news' ); ?></span>
		<?php
		return;
	}

	if ( file_exists( WP_PLUGIN_DIR . '/' . $file ) ) {

		$activate_url = wp_nonce_url(
			self_admin_url( 'plugins.php?action=activate&plugin=' . rawurlencode( $file ) ),
			'activate-plugin_' . $file
		);
		?>
		<a class="button button-primary" href="<?php echo esc_url( $activate_url ); ?>"><?php esc_html_e( 'Activate', 'polite-news' ); ?> <?php echo esc_html( $name ); ?></a>
		<?php
		return;
	}

	$install_url = wp_nonce_url(
		self_admin_url( 'update.php?action=install-plugin&plugin=' . rawurlencode( $slug ) ),
		'install-plugin_' . $slug
	);
	?>
	<a class="button button-primary" href="<?php echo esc_url( $install_url ); ?>"><?php esc_html_e( 'Install', 'polite-news' ); ?> <?php echo esc_html( $name ); ?></a>
	<?php
}

/**
 * Render the about page.
 */
function polite_news_about_page_render() {

	$theme = wp_get_theme( get_template() );
	?>
	<div class="wrap polite-news-about-wrap">

		<div class="polite-news-about-header">
			<h1>
				<?php
				/* translators: %s: theme version number. */
				printf( esc_html__( 'Welcome to Polite News %s', 'polite-news' ), esc_html( $theme->get( 'Version' ) ) );
				?>
			</h1>
			<p><?php esc_html_e( 'Polite News is a fast, clean and fully responsive news and magazine theme with a modern card based design and a built in dark mode. Thank you for choosing it.', 'polite-news' ); ?></p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Start Customizing', 'polite-news' ); ?></a>
			<a class="button" href="<?php echo esc_url( 'https://www.templatesell.com/docs/' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Documentation', 'polite-news' ); ?></a>
		</div>

		<div class="polite-news-about-columns">

			<div class="polite-news-about-box">
				<h2><?php esc_html_e( 'Getting Started', 'polite-news' ); ?></h2>
				<ul>
					<li><?php esc_html_e( 'Set your logo and site identity in the customizer.', 'polite-news' ); ?></li>
					<li><?php esc_html_e( 'Assign a Primary menu and a Social Icons menu.', 'polite-news' ); ?></li>
					<li><?php esc_html_e( 'Pick the categories for the featured post, editor picks and breaking news sections.', 'polite-news' ); ?></li>
					<li><?php esc_html_e( 'Add widgets to the sidebar and the four footer areas.', 'polite-news' ); ?></li>
				</ul>
			</div>

			<div class="polite-news-about-box">
				<h2><?php esc_html_e( 'Demo Import', 'polite-news' ); ?></h2>
				<p><?php esc_html_e( 'Start from the demo site in one click. Install and activate the two recommended plugins, then head to Appearance > Import Demo Data.', 'polite-news' ); ?></p>
				<p><?php polite_news_recommended_plugin_button( 'one-click-demo-import', 'one-click-demo-import/one-click-demo-import.php', esc_html__( 'One Click Demo Import', 'polite-news' ) ); ?></p>
				<p class="polite-news-plugin-note"><?php esc_html_e( 'The importer itself. It supplies the Import Demo Data screen.', 'polite-news' ); ?></p>
				<p><?php polite_news_recommended_plugin_button( 'template-sell-demo-importer', 'template-sell-demo-importer/templatesell-demo-importer.php', esc_html__( 'Template Sell Demo Importer', 'polite-news' ) ); ?></p>
				<p class="polite-news-plugin-note"><?php esc_html_e( 'Adds the Polite News demo to that screen. It needs the plugin above and does nothing on its own.', 'polite-news' ); ?></p>
			</div>

			<div class="polite-news-about-box">
				<h2><?php esc_html_e( 'More From TemplateSell', 'polite-news' ); ?></h2>
				<p><?php esc_html_e( 'Free plugins from the same team, hosted on WordPress.org. Neither is required by the theme.', 'polite-news' ); ?></p>
				<p><?php polite_news_recommended_plugin_button( 'templatesell-gated-downloads', 'templatesell-gated-downloads/templatesell-gated-downloads.php', esc_html__( 'Gated Downloads', 'polite-news' ) ); ?></p>
				<p class="polite-news-plugin-note"><?php esc_html_e( 'Trade a download for an email address, and lock any part of a post behind a form.', 'polite-news' ); ?></p>
				<p><?php polite_news_recommended_plugin_button( 'templatesell-captchaflow', 'templatesell-captchaflow/captchaflow.php', esc_html__( 'CaptchaFlow', 'polite-news' ) ); ?></p>
				<p class="polite-news-plugin-note"><?php esc_html_e( 'Adds a challenge to the comment form, the login and registration pages and any form plugin you run. No template editing.', 'polite-news' ); ?></p>
			</div>

			<div class="polite-news-about-box">
				<h2><?php esc_html_e( 'Support', 'polite-news' ); ?></h2>
				<p><?php esc_html_e( 'Stuck with something? Our team is happy to help.', 'polite-news' ); ?></p>
				<a class="button" href="<?php echo esc_url( 'https://www.templatesell.com/support/' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get Support', 'polite-news' ); ?></a>
			</div>

			<div class="polite-news-about-box">
				<h2><?php esc_html_e( 'Polite News Pro', 'polite-news' ); ?></h2>
				<ul>
					<li><?php esc_html_e( 'Multi slide featured carousel.', 'polite-news' ); ?></li>
					<li><?php esc_html_e( 'More header, blog and single post layouts.', 'polite-news' ); ?></li>
					<li><?php esc_html_e( 'Typography and full colour options.', 'polite-news' ); ?></li>
					<li><?php esc_html_e( 'One click demo import and premium support.', 'polite-news' ); ?></li>
				</ul>
				<a class="button button-primary" href="<?php echo esc_url( 'https://templatesell.com/downloads/polite-news-pro-magazine-wordpress-theme/' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Upgrade to Pro', 'polite-news' ); ?></a>
			</div>

		</div>
	</div>
	<?php
}
