<?php
/**
 * Title: Breaking Bar Hairline
 * Slug: polite-news/ticker-hairline
 * Categories: polite-news
 * Description: Ticker style three - a plain hairline bar with a live dot and an uppercase label.
 *
 * @package Polite_News
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"12px","bottom":"12px"},"blockGap":"14px"},"border":{"top":{"color":"#e5e7eb","width":"1px"},"bottom":{"color":"#e5e7eb","width":"1px"},"right":{},"left":{}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-top-color:#e5e7eb;border-top-width:1px;border-bottom-color:#e5e7eb;border-bottom-width:1px;padding-top:12px;padding-bottom:12px"><!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"border":{"radius":"9999px"},"color":{"background":"#dc2626"},"dimensions":{"minHeight":"8px"},"spacing":{"padding":{"right":"4px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:9999px;background-color:#dc2626;min-height:8px;padding-right:4px"></div>
<!-- /wp:group --><!-- wp:paragraph {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.1em","fontWeight":"700"},"color":{"text":"#dc2626"}}} -->
<p class="has-text-color" style="color:#dc2626;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase"><?php esc_html_e( 'Live', 'polite-news' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","fontWeight":"600"}}} -->
<p style="font-size:15px;font-weight:600"><?php esc_html_e( 'A quieter bar for the running headline', 'polite-news' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
