<?php
/**
 * Title: Section Header
 * Slug: polite-news/section-header
 * Categories: polite-news
 * Description: A small uppercase label and a heading with the accent spine, like the curated sections.
 *
 * @package Polite_News
 */

?>
<!-- wp:group {"style":{"border":{"left":{"color":"#4f46e5","width":"4px"}},"spacing":{"padding":{"left":"18px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-left-color:#4f46e5;border-left-width:4px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"500"},"color":{"text":"#6b7280"},"spacing":{"margin":{"bottom":"4px"}}}} -->
<p class="has-text-color" style="color:#6b7280;margin-bottom:4px;font-size:12px;font-weight:500;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( 'Top Weekly', 'polite-news' ); ?></p>
<!-- /wp:paragraph --><!-- wp:heading {"style":{"typography":{"fontSize":"22px"},"spacing":{"margin":{"top":"0px"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0px;font-size:22px"><?php esc_html_e( 'Curated Posts', 'polite-news' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->
