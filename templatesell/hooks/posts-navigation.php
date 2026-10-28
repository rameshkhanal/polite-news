<?php
/**
 * Post navigation hook
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_post_navigation' ) ) :
	/**
	 * Print the previous and next post links.
	 *
	 * @since 1.0.0
	 */
	function polite_news_post_navigation() {

		global $polite_news_theme_options;

		if ( ! is_singular( 'post' ) ) {
			return;
		}

		if ( empty( $polite_news_theme_options['polite-news-single-post-navigation'] ) ) {
			return;
		}

		$previous = get_previous_post();
		$next     = get_next_post();

		if ( ! $previous && ! $next ) {
			return;
		}
		?>
		<nav class="ts-post-navigation" aria-label="<?php esc_attr_e( 'Post navigation', 'polite-news' ); ?>">

			<?php if ( $previous ) : ?>
				<div class="nav-previous">
					<span class="ts-nav-label"><?php esc_html_e( 'Previous Post', 'polite-news' ); ?></span>
					<a href="<?php echo esc_url( get_permalink( $previous->ID ) ); ?>"><?php echo esc_html( get_the_title( $previous->ID ) ); ?></a>
				</div>
			<?php endif; ?>

			<?php if ( $next ) : ?>
				<div class="nav-next">
					<span class="ts-nav-label"><?php esc_html_e( 'Next Post', 'polite-news' ); ?></span>
					<a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>"><?php echo esc_html( get_the_title( $next->ID ) ); ?></a>
				</div>
			<?php endif; ?>

		</nav>
		<?php
	}
endif;
add_action( 'polite_news_action_post_navigation', 'polite_news_post_navigation', 10 );
