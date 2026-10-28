<?php
/**
 * Title: Breaking Bar Soft
 * Slug: polite-news/ticker-soft
 * Categories: polite-news
 * Description: Ticker style one - a soft rounded bar with a solid label and one headline.
 *
 * @package Polite_News
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"12px","right":"16px","bottom":"12px","left":"16px"},"blockGap":"16px"},"border":{"radius":"9999px"},"color":{"background":"#f9fafb"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-background" style="border-radius:9999px;background-color:#f9fafb;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.06em","fontWeight":"700"},"color":{"background":"#4f46e5","text":"#ffffff"},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"16px","right":"16px"}},"border":{"radius":"9999px"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" style="border-radius:9999px;color:#ffffff;background-color:#4f46e5;padding-top:6px;padding-right:16px;padding-bottom:6px;padding-left:16px;font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase"><?php esc_html_e( 'Breaking', 'polite-news' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --><!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","fontWeight":"600"}}} -->
<p style="font-size:15px;font-weight:600"><?php esc_html_e( 'The latest headline scrolls along this bar', 'polite-news' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
