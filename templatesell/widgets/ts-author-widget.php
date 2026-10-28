<?php
/**
 * Author information widget.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Displays an author photo, name and short biography.
 */
class Polite_News_Author_Widget extends WP_Widget {

	/**
	 * Register the widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'polite_news_author_widget',
			esc_html__( 'Polite News: Author Info', 'polite-news' ),
			array(
				'classname'   => 'ts-author-widget',
				'description' => esc_html__( 'Show a photo, name and short biography of the site author.', 'polite-news' ),
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

		$title       = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$name        = ! empty( $instance['name'] ) ? $instance['name'] : '';
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
		$image_id    = ! empty( $instance['image_id'] ) ? absint( $instance['image_id'] ) : 0;

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( $image_id ) {
			echo wp_get_attachment_image( $image_id, 'thumbnail', false, array( 'alt' => esc_attr( $name ) ) );
		}

		if ( $name ) {
			echo '<h3 class="ts-author-name">' . esc_html( $name ) . '</h3>';
		}

		if ( $description ) {
			echo '<p>' . esc_html( $description ) . '</p>';
		}

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Back end widget form.
	 *
	 * @param array $instance Previously saved values from the database.
	 */
	public function form( $instance ) {

		$title       = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$name        = ! empty( $instance['name'] ) ? $instance['name'] : '';
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
		$image_id    = ! empty( $instance['image_id'] ) ? absint( $instance['image_id'] ) : 0;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Author Name:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Short Biography:', 'polite-news' ); ?></label>
			<textarea class="widefat" rows="4" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_id' ) ); ?>"><?php esc_html_e( 'Image ID:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_id' ) ); ?>" type="number" min="0" value="<?php echo esc_attr( $image_id ); ?>">
			<small><?php esc_html_e( 'Find the ID in the media library address bar.', 'polite-news' ); ?></small>
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

		$instance['title']       = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['name']        = ! empty( $new_instance['name'] ) ? sanitize_text_field( $new_instance['name'] ) : '';
		$instance['description'] = ! empty( $new_instance['description'] ) ? sanitize_textarea_field( $new_instance['description'] ) : '';
		$instance['image_id']    = ! empty( $new_instance['image_id'] ) ? absint( $new_instance['image_id'] ) : 0;

		return $instance;
	}
}
