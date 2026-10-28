<?php
/**
 * Header style three
 *
 * Centered branding with the navigation bar below, the menu centered and
 * the actions on the right.
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_sticky_menu = absint( $polite_news_theme_options['polite_news_enable_sticky_menu'] );
?>
<div class="ts-main-header">
	<div class="ts-container">
		<div class="ts-header-inner">

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
