<?php
/**
 * Header style six
 *
 * One compact row: the menu button and the logo on the left, the actions on
 * the right. The primary menu never appears inline here; it lives in the
 * slide-in panel at every screen width, which is what the ts-header-drawer
 * class on the row tells the stylesheet.
 *
 * Useful for a site with a long menu, or one that would rather give the width
 * to the story than to a row of section names.
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_sticky_menu = absint( $polite_news_theme_options['polite_news_enable_sticky_menu'] );
?>
<div class="ts-main-header ts-header-inline<?php echo ( 1 === $polite_news_sticky_menu ) ? ' ts-sticky-nav' : ''; ?>">
	<div class="ts-container">
		<div class="ts-header-inner ts-header-drawer">

			<?php get_template_part( 'template-parts/header/parts/navigation' ); ?>

			<div class="site-branding">
				<?php
				the_custom_logo();

				polite_news_site_title();
				?>
			</div><!-- .site-branding -->

			<?php get_template_part( 'template-parts/header/parts/actions' ); ?>

		</div>
	</div>
</div>
