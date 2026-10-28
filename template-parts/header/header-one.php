<?php
/**
 * Header style one
 *
 * Classic rows: branding beside the header widget, the navigation on its
 * own bar below.
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_sticky_menu   = absint( $polite_news_theme_options['polite_news_enable_sticky_menu'] );
$polite_news_banner        = absint( $polite_news_theme_options['polite_news_enable_header_banner'] );
$polite_news_banner_id     = absint( $polite_news_theme_options['polite_news_header_banner_image'] );
$polite_news_banner_link   = $polite_news_theme_options['polite_news_header_banner_link'];
$polite_news_banner_tab    = absint( $polite_news_theme_options['polite_news_header_banner_new_tab'] );
?>
<div class="ts-main-header">
	<div class="ts-container">
		<div class="ts-header-inner ts-header-classic">

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

			<?php
			/**
			 * The banner set in the customizer wins.
			 */
			if ( 1 === $polite_news_banner && $polite_news_banner_id ) :
				$polite_news_banner_image = wp_get_attachment_image(
					$polite_news_banner_id,
					'full',
					false,
					array(
						'class'    => 'ts-header-banner-image',
						'loading'  => 'eager',
						'decoding' => 'async',
						/* The slot is capped at 728px on desktop; without this the default sizes claims the full upload width. */
						'sizes'    => '(max-width: 991px) 100vw, 728px',
					)
				);

				if ( $polite_news_banner_image ) :
					?>
					<div class="ts-header-widget">
						<?php
						if ( $polite_news_banner_link ) {
							$polite_news_banner_target = ( 1 === $polite_news_banner_tab ) ? ' target="_blank" rel="noopener noreferrer"' : '';
							echo '<a href="' . esc_url( $polite_news_banner_link ) . '"' . $polite_news_banner_target . '>' . $polite_news_banner_image . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} else {
							echo $polite_news_banner_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</div>
					<?php
				endif;

			elseif ( is_active_sidebar( 'header-widget' ) ) :
				?>
				<div class="ts-header-widget">
					<?php dynamic_sidebar( 'header-widget' ); ?>
				</div>
				<?php
			endif;
			?>

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
