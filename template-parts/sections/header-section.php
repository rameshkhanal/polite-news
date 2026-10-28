<?php
/**
 * The site header section
 *
 * Renders the top bar and then hands over to one of the header style files in
 * template-parts/header: header-one (classic rows), header-two (single inline
 * row), header-three (centred branding), header-four (branding row with a
 * search field), header-five (centred branding over a filled bar) and
 * header-six (menu in a drawer at every width). The list of names lives in
 * polite_news_header_layout_array(), so the guard below cannot drift from the
 * choices the customizer offers.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Polite_News
 */

$GLOBALS['polite_news_theme_options'] = polite_news_get_options_value();
global $polite_news_theme_options;

$polite_news_layout        = esc_attr( $polite_news_theme_options['polite_news_header_layout'] );
$polite_news_enable_top    = absint( $polite_news_theme_options['polite_news_enable_top_header'] );
$polite_news_enable_date   = absint( $polite_news_theme_options['polite_news_enable_top_date'] );
$polite_news_enable_menu   = absint( $polite_news_theme_options['polite_news_enable_top_header_menu'] );
$polite_news_enable_social = absint( $polite_news_theme_options['polite_news_enable_top_header_social'] );
$polite_news_enable_search = absint( $polite_news_theme_options['polite_news_enable_search'] );

if ( ! array_key_exists( $polite_news_layout, polite_news_header_layout_array() ) ) {
	$polite_news_layout = 'header-one';
}
?>
<header id="masthead" class="site-header ts-<?php echo esc_attr( $polite_news_layout ); ?>">

	<?php if ( 1 === $polite_news_enable_top ) : ?>
		<div class="ts-top-header">
			<div class="ts-container">
				<div class="ts-top-inner">

					<?php if ( 1 === $polite_news_enable_date ) : ?>
						<div class="ts-top-date">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<span><?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( 1 === $polite_news_enable_menu && has_nav_menu( 'top' ) ) : ?>
						<nav class="ts-top-menu" aria-label="<?php esc_attr_e( 'Top menu', 'polite-news' ); ?>">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'top',
									'menu_id'        => '',
									'container'      => false,
									'menu_class'     => '',
									'depth'          => 1,
								)
							);
							?>
						</nav>
					<?php endif; ?>

					<?php if ( 1 === $polite_news_enable_social && has_nav_menu( 'social' ) ) : ?>
						<nav class="ts-social-icons" aria-label="<?php esc_attr_e( 'Social links', 'polite-news' ); ?>">
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
			</div>
		</div>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/header/' . $polite_news_layout ); ?>

	<?php if ( 1 === $polite_news_enable_search ) : ?>
		<div class="ts-search-box">
			<div class="ts-container">
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php endif; ?>

</header><!-- #masthead -->
