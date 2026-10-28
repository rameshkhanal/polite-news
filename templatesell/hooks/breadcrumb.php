<?php
/**
 * Breadcrumb hook
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_add_breadcrumb' ) ) :
	/**
	 * Render the breadcrumb trail chosen in the customizer.
	 *
	 * @since 1.0.0
	 */
	function polite_news_add_breadcrumb() {

		global $polite_news_theme_options;

		if ( is_front_page() ) {
			return;
		}

		if ( empty( $polite_news_theme_options['polite-news-extra-breadcrumb'] ) ) {
			return;
		}

		$source = isset( $polite_news_theme_options['polite-news-breadcrumb-selection-option'] ) ? esc_attr( $polite_news_theme_options['polite-news-breadcrumb-selection-option'] ) : 'theme';
		?>
		<div class="ts-breadcrumb-wrap">
			<div class="ts-container">
				<?php
				if ( 'yoast' === $source && function_exists( 'yoast_breadcrumb' ) ) {

					yoast_breadcrumb( '<nav class="ts-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'polite-news' ) . '">', '</nav>' );

				} elseif ( 'rankmath' === $source && function_exists( 'rank_math_the_breadcrumbs' ) ) {

					rank_math_the_breadcrumbs();

				} else {

					polite_news_breadcrumbs();
				}
				?>
			</div>
		</div>
		<?php
	}
endif;
add_action( 'polite_news_action_breadcrumb', 'polite_news_add_breadcrumb', 10 );

/**
 * Load the breadcrumb trail generator.
 */
require get_template_directory() . '/templatesell/breadcrumbs/breadcrumbs.php';
