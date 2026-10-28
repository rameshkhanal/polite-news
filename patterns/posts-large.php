<?php
/**
 * Title: Post Large Thumbnail
 * Slug: polite-news/posts-large
 * Categories: polite-news
 * Description: Home style large - one post per row with a full width image above the headline.
 *
 * @package Polite_News
 */

?>
<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"40px"}},"layout":{"type":"default"}} -->
<!-- wp:post-featured-image {"isLink":true,"height":"380px","style":{"border":{"radius":"20px"}}} /-->

<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"0.06em","fontWeight":"600"},"color":{"text":"#4f46e5"},"spacing":{"margin":{"top":"16px"}}}} /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"26px","lineHeight":"1.3"},"spacing":{"margin":{"top":"10px","bottom":"10px"}}}} /-->

<!-- wp:post-excerpt {"excerptLength":28,"style":{"typography":{"fontSize":"15px"}}} /-->

<!-- wp:post-date {"style":{"typography":{"fontSize":"11.5px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
