<?php
/**
 * Title: Category Column
 * Slug: polite-news/category-column
 * Categories: polite-news
 * Description: A section header with the latest posts underneath, like one category column. Duplicate it inside columns for a row.
 *
 * @package Polite_News
 */

?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"fontSize":"18px"},"border":{"left":{"color":"#4f46e5","width":"4px"}},"spacing":{"padding":{"left":"16px"}}}} -->
<h2 class="wp-block-heading" style="border-left-color:#4f46e5;border-left-width:4px;padding-left:16px;font-size:18px"><?php esc_html_e( 'Latest Stories', 'polite-news' ); ?></h2>
<!-- /wp:heading --><!-- wp:query {"queryId":0,"query":{"perPage":4,"postType":"post","order":"desc","orderBy":"date"}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:post-featured-image {"isLink":true,"height":"180px","style":{"border":{"radius":"16px"}}} /-->
<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"16px"}}} /-->
<!-- wp:post-date {"style":{"typography":{"fontSize":"11.5px","textTransform":"uppercase","letterSpacing":"0.06em"},"color":{"text":"#6b7280"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
