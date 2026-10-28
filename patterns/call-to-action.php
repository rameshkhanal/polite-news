<?php
/**
 * Title: Newsletter Call to Action
 * Slug: polite-news/call-to-action
 * Categories: polite-news
 * Description: A rounded panel with a heading, a short line and a pill button.
 *
 * @package Polite_News
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"}},"border":{"radius":"24px"},"color":{"background":"#f9fafb"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:24px;background-color:#f9fafb;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Stay in the loop', 'polite-news' ); ?></h3>
<!-- /wp:heading --><!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'The stories that matter, delivered politely to your inbox.', 'polite-news' ); ?></p>
<!-- /wp:paragraph --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-polite-news-pill"} -->
<div class="wp-block-button is-style-polite-news-pill"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Subscribe', 'polite-news' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
