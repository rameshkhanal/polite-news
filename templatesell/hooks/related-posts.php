<?php
/**
 * Related posts hook
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_related_posts' ) ) :
	/**
	 * Print related posts from the same category.
	 *
	 * @since 1.0.0
	 */
	function polite_news_related_posts() {

		global $polite_news_theme_options;

		if ( ! is_singular( 'post' ) ) {
			return;
		}

		if ( empty( $polite_news_theme_options['polite-news-single-page-related-posts'] ) ) {
			return;
		}

		$categories = wp_get_post_categories( get_the_ID() );

		if ( empty( $categories ) ) {
			return;
		}

		$related = new WP_Query(
			array(
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'posts_per_page'      => 3,
				'category__in'        => $categories,
				'post__not_in'        => array( get_the_ID() ),
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);

		if ( ! $related->have_posts() ) {
			wp_reset_postdata();
			return;
		}

		$title = isset( $polite_news_theme_options['polite-news-single-page-related-posts-title'] ) ? $polite_news_theme_options['polite-news-single-page-related-posts-title'] : __( 'Related Posts', 'polite-news' );
		?>
		<section class="ts-related-posts">

			<?php if ( ! empty( $title ) ) : ?>
				<h2 class="ts-section-title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>

			<div class="ts-grid ts-grid-3">
				<?php
				while ( $related->have_posts() ) :
					$related->the_post();
					?>
					<article id="related-post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="ts-post-wrap">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="ts-post-media">
									<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
										<?php the_post_thumbnail( 'polite-news-grid' ); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="ts-post-content">
								<div class="entry-meta">
									<?php polite_news_posted_on(); ?>
								</div>
								<?php the_title( '<h3 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
							</div>
						</div>
					</article>
					<?php
				endwhile;
				?>
			</div>
		</section>
		<?php
		wp_reset_postdata();
	}
endif;
add_action( 'polite_news_action_related_posts', 'polite_news_related_posts', 10 );
