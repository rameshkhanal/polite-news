<?php
/**
 * Header style two
 *
 * A single inline row: logo left, centered menu, the dark switch and the
 * search toggle on the right.
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_sticky_menu = absint( $polite_news_theme_options['polite_news_enable_sticky_menu'] );
?>
<div class="ts-main-header ts-header-inline<?php echo ( 1 === $polite_news_sticky_menu ) ? ' ts-sticky-nav' : ''; ?>">
	<div class="ts-container">
		<div class="ts-header-inner">

			<div class="site-branding">
				<?php
				the_custom_logo();

				polite_news_site_title();
				?>
			</div><!-- .site-branding -->

			<?php get_template_part( 'template-parts/header/parts/navigation' ); ?>

			<?php get_template_part( 'template-parts/header/parts/actions' ); ?>

		</div>
	</div>
</div>
