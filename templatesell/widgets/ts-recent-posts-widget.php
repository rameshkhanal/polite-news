<?php
/**
 * Recent posts widget with thumbnails.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Displays recent posts with a small thumbnail and the date.
 */
class Polite_News_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Register the widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'polite_news_recent_posts_widget',
			esc_html__( 'Polite News: Recent Posts', 'polite-news' ),
			array(
				'classname'   => 'ts-recent-posts-widget',
				'description' => esc_html__( 'Show recent posts with a thumbnail and the date.', 'polite-news' ),
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

		$title    = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recent Posts', 'polite-news' );
		$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		$category = ! empty( $instance['category'] ) ? absint( $instance['category'] ) : 0;

		$query_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $number,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		if ( $category ) {
			$query_args['cat'] = $category;
		}

		$recent = new WP_Query( $query_args );

		if ( ! $recent->have_posts() ) {
			wp_reset_postdata();
			return;
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		while ( $recent->have_posts() ) :
			$recent->the_post();
			?>
			<div class="ts-widget-post">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="ts-widget-thumb">
						<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'polite-news-widget' ); ?>
						</a>
					</div>
				<?php endif; ?>
				<div class="ts-widget-content">
					<h3 class="ts-widget-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<span class="ts-widget-date"><?php echo esc_html( get_the_date() ); ?></span>
				</div>
			</div>
			<?php
		endwhile;

		wp_reset_postdata();

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Back end widget form.
	 *
	 * @param array $instance Previously saved values from the database.
	 */
	public function form( $instance ) {

		$title    = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recent Posts', 'polite-news' );
		$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		$category = ! empty( $instance['category'] ) ? absint( $instance['category'] ) : 0;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of Posts:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" min="1" max="10" value="<?php echo esc_attr( $number ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category:', 'polite-news' ); ?></label>
			<?php
			wp_dropdown_categories(
				array(
					'name'              => $this->get_field_name( 'category' ),
					'id'                => $this->get_field_id( 'category' ),
					'class'             => 'widefat',
					'show_option_none'  => esc_html__( 'All Categories', 'polite-news' ),
					'option_none_value' => '0',
					'selected'          => $category,
					'hide_empty'        => 0,
				)
			);
			?>
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
		$instance['number']   = ! empty( $new_instance['number'] ) ? absint( $new_instance['number'] ) : 4;
		$instance['category'] = ! empty( $new_instance['category'] ) ? absint( $new_instance['category'] ) : 0;

		return $instance;
	}
}
