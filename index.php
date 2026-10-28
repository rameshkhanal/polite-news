<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

					<?php if ( have_posts() ) : ?>

						<?php if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php endif; ?>

						<div class="<?php echo esc_attr( polite_news_grid_class() ); ?>">
							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content/content', get_post_format() );

							endwhile;
							?>
						</div>

						<?php polite_news_pagination(); ?>

					<?php else : ?>

						<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

					<?php endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</div><!-- #content -->

<?php
get_footer();
