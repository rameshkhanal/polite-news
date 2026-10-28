<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_show_content_from = esc_attr( $polite_news_theme_options['polite-news-content-show-from'] );
$polite_news_read_more         = esc_html( $polite_news_theme_options['polite-news-read-more-text'] );
$polite_news_layout            = esc_attr( $polite_news_theme_options['polite-news-column-blog-page'] );
$polite_news_image_location    = esc_attr( $polite_news_theme_options['polite-news-blog-image-layout'] );
$polite_news_social_share      = absint( $polite_news_theme_options['polite-news-show-hide-share'] );
$polite_news_date              = absint( $polite_news_theme_options['polite-news-show-hide-date'] );
$polite_news_category          = absint( $polite_news_theme_options['polite-news-show-hide-category'] );
$polite_news_author            = absint( $polite_news_theme_options['polite-news-show-hide-author'] );

/* The image beside text arrangement only applies to the list layout. */
$polite_news_wrap_class = ( 'one-column' === $polite_news_layout && 'list-image' === $polite_news_image_location ) ? 'ts-post-wrap ts-list-image' : 'ts-post-wrap';

/* The home styles bring their own arrangement and image size. */
$polite_news_home_style = polite_news_home_style();
$polite_news_thumb_size = 'polite-news-grid';

if ( 'home-two' === $polite_news_home_style ) {
	$polite_news_wrap_class = 'ts-post-wrap ts-list-image';
} elseif ( '' !== $polite_news_home_style ) {
	$polite_news_wrap_class = 'ts-post-wrap';
}

/*
 * The style that decides the image size is the home style on the home page and
 * the archive layout everywhere else. The two vocabularies match apart from the
 * home- prefix, so drop it and ask the question once.
 */
$polite_news_style = ( '' !== $polite_news_home_style ) ? substr( $polite_news_home_style, 5 ) : $polite_news_layout;

if ( 'classic' === $polite_news_style || 'large' === $polite_news_style ) {
	/* The one column styles paint a much wider image. */
	$polite_news_thumb_size = 'polite-news-slider';
} elseif ( 0 === strpos( $polite_news_style, 'masonry' ) ) {
	/* Masonry needs the natural image heights. */
	$polite_news_thumb_size = 'medium_large';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="<?php echo esc_attr( $polite_news_wrap_class ); ?>">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="ts-post-media">
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( $polite_news_thumb_size, array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
				</a>
				<?php
				if ( 1 === $polite_news_category ) {
					polite_news_entry_category( true );
				}
				?>
			</div>
		<?php endif; ?>

		<div class="ts-post-content">

			<div class="entry-meta">
				<?php
				if ( 1 === $polite_news_date ) {
					polite_news_posted_on();
				}
				if ( 1 === $polite_news_author ) {
					polite_news_posted_by();
				}
				?>
			</div><!-- .entry-meta -->

			<?php the_title( '<h2 class="ts-post-title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<div class="ts-post-excerpt entry-content">
				<?php
				if ( 'excerpt' === $polite_news_show_content_from ) {
					the_excerpt();
				} else {
					the_content();
				}

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'polite-news' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->

			<?php if ( ! empty( $polite_news_read_more ) && 'excerpt' === $polite_news_show_content_from ) : ?>
				<a class="more-link" href="<?php the_permalink(); ?>">
					<?php echo esc_html( $polite_news_read_more ); ?>
					<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
				</a>
			<?php endif; ?>

			<?php
			if ( 1 === $polite_news_social_share ) {
				do_action( 'polite_news_social_sharing', get_the_ID() );
			}
			?>

		</div><!-- .ts-post-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
