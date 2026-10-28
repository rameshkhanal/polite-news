<?php
/**
 * Custom header implementation.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses polite_news_header_style()
 */
function polite_news_custom_header_setup() {

	add_theme_support(
		'custom-header',
		apply_filters(
			'polite_news_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '14171c',
				'width'              => 1920,
				'height'             => 500,
				'flex-height'        => true,
				'flex-width'         => true,
				'wp-head-callback'   => 'polite_news_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'polite_news_custom_header_setup' );

if ( ! function_exists( 'polite_news_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see polite_news_custom_header_setup().
	 */
	function polite_news_header_style() {

		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let the stylesheet take care of it.
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
