<?php
/**
 * The template for displaying archive pages
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

						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->

						<div class="<?php echo esc_attr( polite_news_grid_class() ); ?>">
							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

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
