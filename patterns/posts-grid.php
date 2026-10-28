<?php
/**
 * Title: Post Grid
 * Slug: polite-news/posts-grid
 * Categories: polite-news
 * Description: Home style one - a two column grid of posts pulled live from the site.
 *
 * @package Polite_News
 */

?>
<!-- wp:query {"queryId":0,"query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
<!-- wp:post-featured-image {"isLink":true,"height":"220px","style":{"border":{"radius":"16px"}}} /-->

<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.06em","fontWeight":"600"},"color":{"text":"#4f46e5"},"spacing":{"margin":{"top":"12px"}}}} /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"18px","lineHeight":"1.4"},"spacing":{"margin":{"top":"8px","bottom":"8px"}}}} /-->

<!-- wp:post-date {"style":{"typography":{"fontSize":"11.5px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
