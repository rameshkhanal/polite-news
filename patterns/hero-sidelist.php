<?php
/**
 * Title: Hero Side List
 * Slug: polite-news/hero-sidelist
 * Categories: polite-news
 * Description: Hero style three - a large lead story with a stacked list of smaller stories beside it.
 *
 * @package Polite_News
 */

?>
<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"26px"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"64%"} -->
<div class="wp-block-column" style="flex-basis:64%"><!-- wp:cover {"dimRatio":60,"overlayColor":"black","minHeight":420,"isDark":true,"style":{"border":{"radius":"24px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-dark" style="border-radius:24px;min-height:420px"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.05em","fontWeight":"600"},"color":{"background":"#4f46e5","text":"#ffffff"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"12px","right":"12px"}},"border":{"radius":"9999px"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" style="border-radius:9999px;color:#ffffff;background-color:#4f46e5;padding-top:4px;padding-right:12px;padding-bottom:4px;padding-left:12px;font-size:11px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase"><?php esc_html_e( 'Politics', 'polite-news' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --><!-- wp:heading {"style":{"typography":{"fontSize":"30px"}},"textColor":"white"} -->
<h2 class="wp-block-heading has-white-color has-text-color" style="font-size:30px"><?php esc_html_e( 'The lead story of the day sits here', 'polite-news' ); ?></h2>
<!-- /wp:heading --><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","textTransform":"uppercase","letterSpacing":"0.06em"}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="font-size:12px;letter-spacing:0.06em;text-transform:uppercase"><?php esc_html_e( 'By The Editor — August 18, 2026', 'polite-news' ); ?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"36%"} -->
<div class="wp-block-column" style="flex-basis:36%"><!-- wp:group {"style":{"spacing":{"padding":{"bottom":"16px"},"blockGap":"6px"},"border":{"bottom":{"color":"#e5e7eb","width":"1px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-bottom-color:#e5e7eb;border-bottom-width:1px;padding-bottom:16px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"color":{"text":"#4f46e5"}}} -->
<p class="has-text-color" style="color:#4f46e5;font-size:11px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( 'Business', 'polite-news' ); ?></p>
<!-- /wp:paragraph --><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"17px","lineHeight":"1.4"}}} -->
<h3 class="wp-block-heading" style="font-size:17px;line-height:1.4"><?php esc_html_e( 'A second story headline for the side column', 'polite-news' ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"16px","bottom":"16px"},"blockGap":"6px"},"border":{"bottom":{"color":"#e5e7eb","width":"1px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-bottom-color:#e5e7eb;border-bottom-width:1px;padding-top:16px;padding-bottom:16px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"color":{"text":"#4f46e5"}}} -->
<p class="has-text-color" style="color:#4f46e5;font-size:11px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( 'Culture', 'polite-news' ); ?></p>
<!-- /wp:paragraph --><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"17px","lineHeight":"1.4"}}} -->
<h3 class="wp-block-heading" style="font-size:17px;line-height:1.4"><?php esc_html_e( 'A third headline keeps the column balanced', 'polite-news' ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"16px"},"blockGap":"6px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:16px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"color":{"text":"#4f46e5"}}} -->
<p class="has-text-color" style="color:#4f46e5;font-size:11px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( 'World', 'polite-news' ); ?></p>
<!-- /wp:paragraph --><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"17px","lineHeight":"1.4"}}} -->
<h3 class="wp-block-heading" style="font-size:17px;line-height:1.4"><?php esc_html_e( 'And a fourth story closes the list', 'polite-news' ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
