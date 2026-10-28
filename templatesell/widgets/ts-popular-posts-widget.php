<?php
/**
 * Popular posts widget.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Displays the most discussed posts, optionally within a recent window.
 */
class Polite_News_Popular_Posts_Widget extends WP_Widget {

	/**
	 * Register the widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'polite_news_popular_posts_widget',
			esc_html__( 'Polite News: Popular Posts', 'polite-news' ),
			array(
				'classname'   => 'ts-popular-posts-widget',
				'description' => esc_html__( 'Show the most commented posts with a thumbnail, category and byline.', 'polite-news' ),
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

		$title  = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Popular News', 'polite-news' );
		$number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 3;
		$days   = isset( $instance['days'] ) ? absint( $instance['days'] ) : 0;
		$meta   = isset( $instance['meta'] ) ? (bool) $instance['meta'] : true;
		$rank   = ! empty( $instance['rank'] ) ? 1 : 0;

		$query_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => $number,
			'orderby'             => array(
				'comment_count' => 'DESC',
				'date'          => 'DESC',
			),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		// A window stops one old favourite sitting at the top for ever.
		if ( $days ) {
			$query_args['date_query'] = array(
				array(
					'after' => $days . ' days ago',
				),
			);
		}

		$popular = new WP_Query( $query_args );

		if ( ! $popular->have_posts() ) {
			wp_reset_postdata();
			return;
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		$position = 0;

		while ( $popular->have_posts() ) :
			$popular->the_post();
			$position++;

			$categories = get_the_category();
			?>
			<div class="ts-widget-post ts-widget-popular<?php echo $rank ? ' ts-widget-ranked' : ''; ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="ts-widget-thumb">
						<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'polite-news-widget' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<div class="ts-widget-content">
					<?php if ( ! empty( $categories ) ) : ?>
						<a class="ts-widget-cat" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
					<?php endif; ?>

					<h3 class="ts-widget-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<?php if ( $meta ) : ?>
						<div class="ts-widget-byline">
							<span class="ts-widget-author">
								<?php
								printf(
									/* translators: %s: author name. */
									esc_html__( 'By %s', 'polite-news' ),
									'<span>' . esc_html( get_the_author() ) . '</span>'
								);
								?>
							</span>
							<span class="ts-widget-date">
								<i class="fa fa-calendar-o" aria-hidden="true"></i>
								<?php echo esc_html( get_the_date() ); ?>
							</span>
						</div>
					<?php endif; ?>
				</div>

				<?php if ( $rank ) : ?>
					<span class="ts-widget-rank" aria-hidden="true"><?php echo esc_html( number_format_i18n( $position ) ); ?></span>
				<?php endif; ?>
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

		$title  = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Popular News', 'polite-news' );
		$number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 3;
		$days   = isset( $instance['days'] ) ? absint( $instance['days'] ) : 0;
		$meta   = isset( $instance['meta'] ) ? (bool) $instance['meta'] : true;
		$rank   = ! empty( $instance['rank'] ) ? 1 : 0;

		$windows = array(
			0   => esc_html__( 'All time', 'polite-news' ),
			7   => esc_html__( 'Last 7 days', 'polite-news' ),
			30  => esc_html__( 'Last 30 days', 'polite-news' ),
			365 => esc_html__( 'Last year', 'polite-news' ),
		);
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'days' ) ); ?>"><?php esc_html_e( 'Counted From:', 'polite-news' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'days' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'days' ) ); ?>">
				<?php foreach ( $windows as $value => $label ) : ?>
					<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $days, $value ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $meta, true ); ?> id="<?php echo esc_attr( $this->get_field_id( 'meta' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'meta' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'meta' ) ); ?>"><?php esc_html_e( 'Show the author and date', 'polite-news' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $rank, 1 ); ?> id="<?php echo esc_attr( $this->get_field_id( 'rank' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rank' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'rank' ) ); ?>"><?php esc_html_e( 'Number each story', 'polite-news' ); ?></label>
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

		$instance['title']  = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['number'] = ! empty( $new_instance['number'] ) ? absint( $new_instance['number'] ) : 3;
		$instance['days']   = isset( $new_instance['days'] ) ? absint( $new_instance['days'] ) : 0;
		$instance['meta']   = ! empty( $new_instance['meta'] ) ? 1 : 0;
		$instance['rank']   = ! empty( $new_instance['rank'] ) ? 1 : 0;

		return $instance;
	}
}
