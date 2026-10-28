<?php
/**
 * The primary navigation
 *
 * Navigation shared by every header layout.
 *
 * @package Polite_News
 */

?>
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'polite-news' ); ?>">
	<button class="menu-toggle" aria-controls="primary-menu-wrapper" aria-expanded="false">
		<i class="fa fa-bars" aria-hidden="true"></i>
		<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'polite-news' ); ?></span>
	</button>
	<div id="primary-menu-wrapper" class="menu-wrapper">

		<div class="ts-menu-head">
			<div class="ts-menu-brand">
				<?php the_custom_logo(); ?>
			</div>
			<button type="button" class="ts-menu-close">
				<i class="fa fa-times" aria-hidden="true"></i>
				<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'polite-news' ); ?></span>
			</button>
		</div>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container'      => false,
			)
		);
		?>
	</div>
</nav><!-- #site-navigation -->
