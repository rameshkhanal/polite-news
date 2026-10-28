<?php
/**
 * Title: Breaking Bar Solid
 * Slug: polite-news/ticker-solid
 * Categories: polite-news
 * Description: Ticker style two - a solid indigo bar with a white label and headline.
 *
 * @package Polite_News
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"12px","right":"18px","bottom":"12px","left":"18px"},"blockGap":"16px"},"border":{"radius":"12px"},"color":{"background":"#4f46e5","text":"#ffffff"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-text-color has-background" style="border-radius:12px;color:#ffffff;background-color:#4f46e5;padding-top:12px;padding-right:18px;padding-bottom:12px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"700"},"color":{"text":"#c7d2fe"}}} -->
<p class="has-text-color" style="color:#c7d2fe;font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( 'Breaking', 'polite-news' ); ?></p>
<!-- /wp:paragraph --><!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","fontWeight":"600"},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;font-size:15px;font-weight:600"><?php esc_html_e( 'The latest headline runs across the solid bar', 'polite-news' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
