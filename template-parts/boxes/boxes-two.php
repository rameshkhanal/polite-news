<?php
/**
 * Editor picks style two
 *
 * Clean cards: the image on top, the category badge, title and date below.
 *
 * @package Polite_News
 */

$polite_news_boxes_query = $args['query'];
?>
<div class="ts-boxes-grid ts-boxes-<?php echo absint( $args['count'] ); ?> ts-boxes-two">
	<?php
	while ( $polite_news_boxes_query->have_posts() ) :
		$polite_news_boxes_query->the_post();
		?>
		<article class="ts-box ts-box-card">
			<div class="ts-box-media">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'polite-news-box' );
				}
				?>
			</div>
			<div class="ts-box-content">
				<?php polite_news_entry_category( true ); ?>
				<?php the_title( '<h3 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
				<span class="ts-box-date"><?php echo esc_html( get_the_date() ); ?></span>
			</div>
		</article>
		<?php
	endwhile;
	?>
</div>
