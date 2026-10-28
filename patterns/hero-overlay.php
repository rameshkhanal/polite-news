<?php
/**
 * Title: Hero Overlay Story
 * Slug: polite-news/hero-overlay
 * Categories: polite-news
 * Description: A rounded cover with a category pill, a large title and a meta line, like the featured post section.
 *
 * @package Polite_News
 */

?>
<!-- wp:cover {"dimRatio":60,"overlayColor":"black","minHeight":420,"isDark":true,"style":{"border":{"radius":"24px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-dark" style="border-radius:24px;min-height:420px"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-polite-news-pill","style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.05em","fontWeight":"600"},"color":{"background":"#4f46e5","text":"#ffffff"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"12px","right":"12px"}}}} -->
<div class="wp-block-button is-style-polite-news-pill"><a class="wp-block-button__link has-text-color has-background wp-element-button" style="border-radius:9999px;color:#ffffff;background-color:#4f46e5;padding-top:4px;padding-right:12px;padding-bottom:4px;padding-left:12px;font-size:11px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase"><?php esc_html_e( 'Business', 'polite-news' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --><!-- wp:heading {"style":{"typography":{"fontSize":"30px"}},"textColor":"white"} -->
<h2 class="wp-block-heading has-white-color has-text-color" style="font-size:30px"><?php esc_html_e( 'A big featured story headline goes right here', 'polite-news' ); ?></h2>
<!-- /wp:heading --><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","textTransform":"uppercase","letterSpacing":"0.06em"}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="font-size:12px;letter-spacing:0.06em;text-transform:uppercase"><?php esc_html_e( 'By The Editor — August 18, 2026', 'polite-news' ); ?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->
