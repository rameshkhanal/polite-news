<?php
/**
 * Title: Magazine Split
 * Slug: polite-news/hero-magazine
 * Categories: polite-news
 * Description: A lead story on the left and a short headline list on the right, like the magazine hero.
 *
 * @package Polite_News
 */

?>
<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"40px"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:cover {"dimRatio":40,"overlayColor":"black","minHeight":320,"isDark":true,"style":{"border":{"radius":"24px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-dark" style="border-radius:24px;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-40 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":3,"textColor":"white"} -->
<h3 class="wp-block-heading has-white-color has-text-color"><?php esc_html_e( 'The lead story sits on a large rounded image', 'polite-news' ); ?></h3>
<!-- /wp:heading --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --><!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"17px"}}} -->
<h4 class="wp-block-heading" style="font-size:17px"><?php esc_html_e( 'A second headline continues over here', 'polite-news' ); ?></h4>
<!-- /wp:heading --><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} -->
<p class="has-text-color" style="color:#6b7280;font-size:12px;letter-spacing:0.06em;text-transform:uppercase">August 17, 2026</p>
<!-- /wp:paragraph --><!-- wp:separator {"style":{"color":{"background":"#e5e7eb"}}} -->
<hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background" style="background-color:#e5e7eb;color:#e5e7eb"/>
<!-- /wp:separator --><!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"17px"}}} -->
<h4 class="wp-block-heading" style="font-size:17px"><?php esc_html_e( 'A third headline rounds out the list', 'polite-news' ); ?></h4>
<!-- /wp:heading --><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} -->
<p class="has-text-color" style="color:#6b7280;font-size:12px;letter-spacing:0.06em;text-transform:uppercase">August 16, 2026</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
