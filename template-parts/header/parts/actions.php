<?php
/**
 * The header action buttons
 *
 * The colour switch and the search toggle, in the order every layout wants
 * them. Shared for the same reason the navigation is.
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_enable_search = absint( $polite_news_theme_options['polite_news_enable_search'] );
$polite_news_enable_dark   = absint( $polite_news_theme_options['polite_news_enable_dark_mode'] );

/*
 * The wrapper is printed even when both buttons are off: it is a flex child
 * that balances the row, and dropping it would slide the centred menu off
 * centre on the layouts that rely on it.
 */
?>
<div class="ts-nav-actions">

	<?php if ( 1 === $polite_news_enable_dark ) : ?>
		<button type="button" class="ts-icon-button ts-dark-toggle" aria-pressed="false">
			<i class="fa fa-moon-o ts-icon-moon" aria-hidden="true"></i>
			<i class="fa fa-sun-o ts-icon-sun" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Switch colour mode', 'polite-news' ); ?></span>
		</button>
	<?php endif; ?>

	<?php if ( 1 === $polite_news_enable_search ) : ?>
		<button type="button" class="ts-icon-button ts-search-toggle" aria-expanded="false">
			<i class="fa fa-search" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle search', 'polite-news' ); ?></span>
		</button>
	<?php endif; ?>

</div>
