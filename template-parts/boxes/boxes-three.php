<?php
/**
 * Editor picks style three
 *
 * A numbered row of stories with a small thumbnail on the right.
 *
 * @package Polite_News
 */

$polite_news_boxes_query = $args['query'];

$polite_news_boxes_index = 0;
?>
<div class="ts-boxes-grid ts-boxes-<?php echo absint( $args['count'] ); ?> ts-boxes-three">
	<?php
	while ( $polite_news_boxes_query->have_posts() ) :
		$polite_news_boxes_query->the_post();
		$polite_news_boxes_index++;
		?>
		<article class="ts-box ts-box-numbered">
			<span class="ts-box-number"><?php echo esc_html( str_pad( (string) $polite_news_boxes_index, 2, '0', STR_PAD_LEFT ) ); ?></span>
			<div class="ts-box-content">
				<?php polite_news_entry_category( true ); ?>
				<?php the_title( '<h3 class="ts-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
				<span class="ts-box-date"><?php echo esc_html( get_the_date() ); ?></span>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="ts-box-thumb">
					<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php the_post_thumbnail( 'polite-news-widget' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</article>
		<?php
	endwhile;
	?>
</div>
