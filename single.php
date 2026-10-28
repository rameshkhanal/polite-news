<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Polite_News
 */

get_header();
?>
<div id="content" class="site-content">
	<div class="ts-container">
		<div class="ts-content-wrap">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content/content', 'single' );

						/**
						 * Post navigation hook.
						 *
						 * @hooked polite_news_post_navigation - 10
						 */
						do_action( 'polite_news_action_post_navigation' );

						/**
						 * Related posts hook.
						 *
						 * @hooked polite_news_related_posts - 10
						 */
						do_action( 'polite_news_action_related_posts' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</div><!-- #content -->

<?php
get_footer();
