<?php
/**
 * Tag and category chips widget.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Displays tags or categories as chips, either filled or outlined.
 */
class Polite_News_Chips_Widget extends WP_Widget {

	/**
	 * Register the widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'polite_news_chips_widget',
			esc_html__( 'Polite News: Tags & Categories', 'polite-news' ),
			array(
				'classname'   => 'ts-chips-widget',
				'description' => esc_html__( 'Show the busiest tags or categories as chips, filled or outlined.', 'polite-news' ),
			)
		);
	}

	/**
	 * Front end display of the widget.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from the database.
	 */
	public function widget( $args, $instance ) {

		$title    = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Popular Tags', 'polite-news' );
		$taxonomy = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : 'post_tag';
		$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 12;
		$style    = ! empty( $instance['style'] ) ? $instance['style'] : 'outline';
		$count    = ! empty( $instance['count'] ) ? 1 : 0;

		if ( ! in_array( $taxonomy, array( 'post_tag', 'category' ), true ) ) {
			$taxonomy = 'post_tag';
		}

		if ( ! in_array( $style, array( 'outline', 'filled' ), true ) ) {
			$style = 'outline';
		}

		$terms = get_terms(
			array(
				'taxonomy'   => $taxonomy,
				'orderby'    => 'count',
				'order'      => 'DESC',
				'number'     => $number,
				'hide_empty' => true,
			)
		);

		if ( is_wp_error( $terms ) || empty( $terms ) ) {
			return;
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
		<ul class="ts-chip-list ts-chip-<?php echo esc_attr( $style ); ?>">
			<?php foreach ( $terms as $term ) : ?>
				<li>
					<a class="ts-chip" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
						<?php echo esc_html( $term->name ); ?>
						<?php if ( $count ) : ?>
							<span class="ts-chip-count"><?php echo esc_html( number_format_i18n( $term->count ) ); ?></span>
						<?php endif; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Back end widget form.
	 *
	 * @param array $instance Previously saved values from the database.
	 */
	public function form( $instance ) {

		$title    = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Popular Tags', 'polite-news' );
		$taxonomy = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : 'post_tag';
		$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 12;
		$style    = ! empty( $instance['style'] ) ? $instance['style'] : 'outline';
		$count    = ! empty( $instance['count'] ) ? 1 : 0;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>"><?php esc_html_e( 'Show:', 'polite-news' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>">
				<option value="post_tag" <?php selected( $taxonomy, 'post_tag' ); ?>><?php esc_html_e( 'Tags', 'polite-news' ); ?></option>
				<option value="category" <?php selected( $taxonomy, 'category' ); ?>><?php esc_html_e( 'Categories', 'polite-news' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Chip Style:', 'polite-news' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
				<option value="outline" <?php selected( $style, 'outline' ); ?>><?php esc_html_e( 'Outlined box', 'polite-news' ); ?></option>
				<option value="filled" <?php selected( $style, 'filled' ); ?>><?php esc_html_e( 'Filled pill', 'polite-news' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'How Many:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" min="1" max="30" value="<?php echo esc_attr( $number ); ?>">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $count, 1 ); ?> id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Show post counts', 'polite-news' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from the database.
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title']    = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['taxonomy'] = ( ! empty( $new_instance['taxonomy'] ) && 'category' === $new_instance['taxonomy'] ) ? 'category' : 'post_tag';
		$instance['style']    = ( ! empty( $new_instance['style'] ) && 'filled' === $new_instance['style'] ) ? 'filled' : 'outline';
		$instance['number']   = ! empty( $new_instance['number'] ) ? absint( $new_instance['number'] ) : 12;
		$instance['count']    = ! empty( $new_instance['count'] ) ? 1 : 0;

		return $instance;
	}
}
