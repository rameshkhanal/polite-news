<?php
/**
 * Header style four
 *
 * The editorial band: logo on the left, a live search field in the middle of
 * the branding row rather than hidden behind an icon, and the navigation bar
 * below with the menu pushed left and the actions right.
 *
 * A newsroom whose readers arrive looking for a story wants the search box in
 * front of them, so this layout spends the width on it instead of on a banner.
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_sticky_menu = absint( $polite_news_theme_options['polite_news_enable_sticky_menu'] );
?>
<div class="ts-main-header">
	<div class="ts-container">
		<div class="ts-header-inner ts-header-band">

			<div class="site-branding">
				<?php
				the_custom_logo();

				polite_news_site_title();

				if ( display_header_text() ) :

					$polite_news_description = get_bloginfo( 'description', 'display' );

					if ( $polite_news_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $polite_news_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
						<?php
					endif;

				endif;
				?>
			</div><!-- .site-branding -->

			<div class="ts-header-search">
				<?php get_search_form(); ?>
			</div>

		</div>
	</div>
</div>

<div class="ts-nav-wrap<?php echo ( 1 === $polite_news_sticky_menu ) ? ' ts-sticky-nav' : ''; ?>">
	<div class="ts-container">
		<div class="ts-nav-inner">

			<?php get_template_part( 'template-parts/header/parts/navigation' ); ?>

			<?php get_template_part( 'template-parts/header/parts/actions' ); ?>

		</div>
	</div>
</div>
