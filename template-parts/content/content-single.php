<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_featured_image = absint( $polite_news_theme_options['polite-news-single-page-featured-image'] );
$polite_news_social_share   = absint( $polite_news_theme_options['polite-news-single-social-share'] );
$polite_news_author_box     = absint( $polite_news_theme_options['polite-news-single-author-box'] );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="entry-meta">
			<?php
			polite_news_entry_category();
			polite_news_posted_on();
			polite_news_posted_by();
			?>
		</div><!-- .entry-meta -->

		<?php the_title( '<h1 class="ts-post-title entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php
	if ( 1 === $polite_news_featured_image ) {
		polite_news_post_thumbnail();
	}
	?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'polite-news' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="ts-entry-footer entry-footer">
		<?php polite_news_entry_tags(); ?>

		<?php
		if ( 1 === $polite_news_social_share ) {
			do_action( 'polite_news_social_sharing', get_the_ID() );
		}

		if ( 1 === $polite_news_author_box ) {
			polite_news_author_box();
		}
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
