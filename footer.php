<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_copyright       = wp_kses_post( $polite_news_theme_options['polite-news-footer-copyright'] );
$polite_news_footer_col      = polite_news_footer_widget_count();
$polite_news_curated_bottom  = absint( $polite_news_theme_options['polite_news_enable_curated_bottom'] );
$polite_news_footer_layout   = esc_attr( $polite_news_theme_options['polite_news_footer_layout'] );
$polite_news_enable_catcols  = absint( $polite_news_theme_options['polite_news_enable_catcols'] );

if ( ! array_key_exists( $polite_news_footer_layout, polite_news_footer_layout_array() ) ) {
	$polite_news_footer_layout = 'footer-one';
}
?>

	<?php if ( 1 === $polite_news_curated_bottom && ( is_home() || is_front_page() ) && ! is_paged() ) : ?>
		<section class="ts-curated-wrap" aria-label="<?php esc_attr_e( 'More stories', 'polite-news' ); ?>">
			<div class="ts-container">
				<?php
				/**
				 * Curated posts below the blog hook.
				 *
				 * @hooked polite_news_add_curated_bottom - 10
				 */
				do_action( 'polite_news_action_curated_bottom' );
				?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( 1 === $polite_news_enable_catcols && ( is_home() || is_front_page() ) && ! is_paged() ) : ?>
		<section class="ts-catcols-wrap" aria-label="<?php esc_attr_e( 'Stories by category', 'polite-news' ); ?>">
			<div class="ts-container">
				<?php
				/**
				 * Category columns hook.
				 *
				 * @hooked polite_news_add_catcols - 10
				 */
				do_action( 'polite_news_action_catcols' );
				?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $polite_news_footer_col > 0 ) : ?>
		<aside class="ts-footer-widgets ts-<?php echo esc_attr( $polite_news_footer_layout ); ?>" aria-label="<?php esc_attr_e( 'Footer widgets', 'polite-news' ); ?>">
			<div class="ts-container">

				<?php if ( 'footer-two' === $polite_news_footer_layout ) : ?>
					<?php
					/**
					 * The centred layout opens with a masthead instead of centring the
					 * widget columns. Centred text reads badly beside a thumbnail or a
					 * row of chips, so only this band is centred and the columns below
					 * keep their normal alignment.
					 */
					$polite_news_footer_tagline = get_bloginfo( 'description', 'display' );
					?>
					<div class="ts-footer-masthead">
						<div class="ts-footer-masthead-brand">
							<?php
							if ( has_custom_logo() ) {
								the_custom_logo();
							} else {
								?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								<?php
							}
							?>
						</div>

						<?php if ( $polite_news_footer_tagline ) : ?>
							<p class="ts-footer-masthead-tagline"><?php echo esc_html( $polite_news_footer_tagline ); ?></p>
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav class="ts-social-icons ts-footer-masthead-social" aria-label="<?php esc_attr_e( 'Footer brand social links', 'polite-news' ); ?>">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'social',
										'menu_id'        => '',
										'container'      => false,
										'menu_class'     => '',
										'depth'          => 1,
										'link_before'    => '<span>',
										'link_after'     => '</span>',
									)
								);
								?>
							</nav>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="ts-footer-columns ts-footer-cols-<?php echo absint( $polite_news_footer_col ); ?>">

					<?php
					/**
					 * The branding column. It is a grid item like any widget
					 * column, so the widths stay in the stylesheet with the
					 * rest of the grid rather than being computed here.
					 */
					if ( 'footer-four' === $polite_news_footer_layout ) :
						?>
						<div class="ts-footer-brand">

							<div class="ts-footer-brand-mark">
								<?php
								if ( has_custom_logo() ) {
									the_custom_logo();
								} else {
									?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									<?php
								}
								?>
							</div>

							<?php
							$polite_news_brand_tagline = get_bloginfo( 'description', 'display' );

							if ( $polite_news_brand_tagline ) :
								?>
								<p class="ts-footer-brand-text"><?php echo esc_html( $polite_news_brand_tagline ); ?></p>
								<?php
							endif;
							?>

							<?php if ( has_nav_menu( 'social' ) ) : ?>
								<nav class="ts-social-icons ts-footer-brand-social" aria-label="<?php esc_attr_e( 'Footer column social links', 'polite-news' ); ?>">
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'social',
											'menu_id'        => '',
											'container'      => false,
											'menu_class'     => '',
											'depth'          => 1,
											'link_before'    => '<span>',
											'link_after'     => '</span>',
										)
									);
									?>
								</nav>
							<?php endif; ?>

						</div>
					<?php endif; ?>

					<?php
					for ( $polite_news_i = 1; $polite_news_i <= 4; $polite_news_i++ ) {
						if ( is_active_sidebar( 'footer-' . $polite_news_i ) ) {
							?>
							<div class="ts-footer-col">
								<?php dynamic_sidebar( 'footer-' . $polite_news_i ); ?>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</aside>
	<?php endif; ?>

	<footer class="site-footer ts-<?php echo esc_attr( $polite_news_footer_layout ); ?>">
		<div class="ts-container">

			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="ts-footer-nav" aria-label="<?php esc_attr_e( 'Footer menu', 'polite-news' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_id'        => '',
							'container'      => false,
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
						)
					);
					?>
				</nav>
			<?php endif; ?>

			<div class="ts-footer-inner">

				<div class="ts-footer-brand">
					<?php
					/* The logo when there is one, the site name otherwise. */
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<?php
					}
					?>
				</div>

				<div class="ts-footer-left">
					<div class="copyright">
						<?php echo $polite_news_copyright; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'polite-news' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'polite-news' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
						<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'polite-news' ), 'Polite News', '<a href="https://www.templatesell.com/">Template Sell</a>' );
						?>
					</div>
				</div>

				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="ts-social-icons ts-footer-social" aria-label="<?php esc_attr_e( 'Footer social links', 'polite-news' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'menu_id'        => '',
								'container'      => false,
								'menu_class'     => '',
								'depth'          => 1,
								'link_before'    => '<span>',
								'link_after'     => '</span>',
							)
						);
						?>
					</nav>
				<?php else : ?>
					<div class="ts-footer-social" aria-hidden="true"></div>
				<?php endif; ?>

			</div>
		</div>
	</footer>

	<?php do_action( 'polite_news_go_to_top_hook' ); ?>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
