<?php
/**
 * Title: Post List
 * Slug: polite-news/posts-list
 * Categories: polite-news
 * Description: Home style two - posts in a row layout with the thumbnail beside the text.
 *
 * @package Polite_News
 */

?>
<!-- wp:query {"queryId":0,"query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"26px"}},"layout":{"type":"default"}} -->
<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"20px"},"padding":{"bottom":"22px"}},"border":{"bottom":{"color":"#e5e7eb","width":"1px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center" style="border-bottom-color:#e5e7eb;border-bottom-width:1px;padding-bottom:22px"><!-- wp:column {"verticalAlignment":"center","width":"34%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:34%"><!-- wp:post-featured-image {"isLink":true,"height":"150px","style":{"border":{"radius":"14px"}}} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"66%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66%"><!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.06em","fontWeight":"600"},"color":{"text":"#4f46e5"}}} /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"19px","lineHeight":"1.4"},"spacing":{"margin":{"top":"8px","bottom":"8px"}}}} /-->

<!-- wp:post-date {"style":{"typography":{"fontSize":"11.5px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
