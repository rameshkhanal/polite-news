<?php
/**
 * Title: Curated Story Card
 * Slug: polite-news/curated-card
 * Categories: polite-news
 * Description: A horizontal story card on a soft rounded panel, like the curated posts row.
 *
 * @package Polite_News
 */

?>
<!-- wp:group {"style":{"border":{"radius":"16px"},"color":{"background":"#f9fafb"},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:16px;background-color:#f9fafb;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"35%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:35%"><!-- wp:group {"style":{"border":{"radius":"16px"},"color":{"background":"#d1d5db"},"dimensions":{"minHeight":"170px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:16px;background-color:#d1d5db;min-height:170px"></div>
<!-- /wp:group --></div>
<!-- /wp:column --><!-- wp:column {"verticalAlignment":"center","width":"65%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:65%"><!-- wp:paragraph {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.05em","fontWeight":"600"},"color":{"text":"#4f46e5"}}} -->
<p class="has-text-color" style="color:#4f46e5;font-size:11px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase"><?php esc_html_e( 'Technology', 'polite-news' ); ?></p>
<!-- /wp:paragraph --><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"19px"}}} -->
<h3 class="wp-block-heading" style="font-size:19px"><?php esc_html_e( 'A story headline beside its rounded image', 'polite-news' ); ?></h3>
<!-- /wp:heading --><!-- wp:paragraph {"style":{"typography":{"fontSize":"11.5px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} -->
<p class="has-text-color" style="color:#6b7280;font-size:11.5px;letter-spacing:0.06em;text-transform:uppercase"><?php esc_html_e( 'By The Editor — August 18, 2026', 'polite-news' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
