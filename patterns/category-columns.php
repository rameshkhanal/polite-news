<?php
/**
 * Title: Category Columns Row
 * Slug: polite-news/category-columns
 * Categories: polite-news
 * Description: Three category columns side by side, each pulling its own posts live.
 *
 * @package Polite_News
 */

?>
<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"34px"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"18px"},"spacing":{"padding":{"left":"14px"},"margin":{"bottom":"18px"}}},"border":{"left":{"color":"#4f46e5","width":"4px"}}} -->
<h2 class="wp-block-heading" style="border-left-color:#4f46e5;border-left-width:4px;margin-bottom:18px;padding-left:14px;font-size:18px"><?php esc_html_e( 'Politics', 'polite-news' ); ?></h2>
<!-- /wp:heading --><!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"18px"}},"layout":{"type":"default"}} -->
<!-- wp:post-featured-image {"isLink":true,"height":"150px","style":{"border":{"radius":"14px"}}} /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"16px","lineHeight":"1.4"},"spacing":{"margin":{"top":"8px"}}}} /-->

<!-- wp:post-date {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"18px"},"spacing":{"padding":{"left":"14px"},"margin":{"bottom":"18px"}}},"border":{"left":{"color":"#4f46e5","width":"4px"}}} -->
<h2 class="wp-block-heading" style="border-left-color:#4f46e5;border-left-width:4px;margin-bottom:18px;padding-left:14px;font-size:18px"><?php esc_html_e( 'Business', 'polite-news' ); ?></h2>
<!-- /wp:heading --><!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"18px"}},"layout":{"type":"default"}} -->
<!-- wp:post-featured-image {"isLink":true,"height":"150px","style":{"border":{"radius":"14px"}}} /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"16px","lineHeight":"1.4"},"spacing":{"margin":{"top":"8px"}}}} /-->

<!-- wp:post-date {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"18px"},"spacing":{"padding":{"left":"14px"},"margin":{"bottom":"18px"}}},"border":{"left":{"color":"#4f46e5","width":"4px"}}} -->
<h2 class="wp-block-heading" style="border-left-color:#4f46e5;border-left-width:4px;margin-bottom:18px;padding-left:14px;font-size:18px"><?php esc_html_e( 'Culture', 'polite-news' ); ?></h2>
<!-- /wp:heading --><!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"18px"}},"layout":{"type":"default"}} -->
<!-- wp:post-featured-image {"isLink":true,"height":"150px","style":{"border":{"radius":"14px"}}} /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"16px","lineHeight":"1.4"},"spacing":{"margin":{"top":"8px"}}}} /-->

<!-- wp:post-date {"style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
