<?php
/**
 * The editor picks section
 *
 * Builds the highlighted stories query and hands over to one of the style
 * files in template-parts/boxes: boxes-one (cards), boxes-two (title over
 * the image) or boxes-three (numbered row). The stories come from a category
 * or from hand picked posts. When the featured post section pulls from the
 * same category the boxes skip the first post so the front page does not
 * repeat itself.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Polite_News
 */

global $polite_news_theme_options;

$polite_news_boxes_style = esc_attr( $polite_news_theme_options['polite_news_boxes_style'] );

if ( ! in_array( $polite_news_boxes_style, array( 'boxes-one', 'boxes-two', 'boxes-three' ), true ) ) {
	$polite_news_boxes_style = 'boxes-one';
}

$polite_news_boxes_source = esc_attr( $polite_news_theme_options['polite-news-boxes-content-type'] );

if ( 'posts' === $polite_news_boxes_source ) {

	/* Hand picked posts, shown in the order they were picked. */
	$polite_news_boxes_ids = array();

	for ( $polite_news_pick = 1; $polite_news_pick <= 4; $polite_news_pick++ ) {

		$polite_news_pick_id = absint( $polite_news_theme_options[ 'polite-news-boxes-post-' . $polite_news_pick ] );

		if ( $polite_news_pick_id > 0 ) {
			$polite_news_boxes_ids[] = $polite_news_pick_id;
		}
	}

	if ( empty( $polite_news_boxes_ids ) ) {
		return;
	}

	$polite_news_boxes_query = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'post__in'            => $polite_news_boxes_ids,
			'orderby'             => 'post__in',
			'posts_per_page'      => count( $polite_news_boxes_ids ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);

	$polite_news_boxes_count = count( $polite_news_boxes_ids );

} else {

	$polite_news_boxes_category = absint( $polite_news_theme_options['polite-news-boxes-category'] );
	$polite_news_boxes_number   = absint( $polite_news_theme_options['polite-news-boxes-number'] );
	$polite_news_enable_slider  = absint( $polite_news_theme_options['polite_news_enable_slider'] );
	$polite_news_slider_cat     = absint( $polite_news_theme_options['polite-news-slider-category'] );

	if ( $polite_news_boxes_number < 1 ) {
		$polite_news_boxes_number = 3;
	}

	/* Skip the story already shown in the featured section. */
	$polite_news_boxes_offset = ( 1 === $polite_news_enable_slider && $polite_news_slider_cat === $polite_news_boxes_category ) ? 1 : 0;

	$polite_news_boxes_query = polite_news_section_query( $polite_news_boxes_category, $polite_news_boxes_number, $polite_news_boxes_offset );

	$polite_news_boxes_count = $polite_news_boxes_number;
}

if ( ! $polite_news_boxes_query->have_posts() ) {
	wp_reset_postdata();
	return;
}

get_template_part(
	'template-parts/boxes/' . $polite_news_boxes_style,
	null,
	array(
		'query' => $polite_news_boxes_query,
		'count' => $polite_news_boxes_count,
		'style' => $polite_news_boxes_style,
	)
);

wp_reset_postdata();
