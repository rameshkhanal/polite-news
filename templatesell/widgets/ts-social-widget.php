<?php
/**
 * Social icons widget.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Displays the menu assigned to the Social Icons location as round buttons.
 */
class Polite_News_Social_Widget extends WP_Widget {

	/**
	 * Register the widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'polite_news_social_widget',
			esc_html__( 'Polite News: Social Icons', 'polite-news' ),
			array(
				'classname'   => 'ts-social-widget',
				'description' => esc_html__( 'Show the menu assigned to the Social Icons location as round icon buttons.', 'polite-news' ),
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

		if ( ! has_nav_menu( 'social' ) ) {
			return;
		}

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		wp_nav_menu(
			array(
				'theme_location' => 'social',
				'container'      => false,
				'menu_class'     => 'ts-social-menu',
				'depth'          => 1,
				'link_before'    => '<span>',
				'link_after'     => '</span>',
			)
		);

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Back end widget form.
	 *
	 * @param array $instance Previously saved values from the database.
	 */
	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<?php esc_html_e( 'Assign a menu to the Social Icons location, the icons come from each link address.', 'polite-news' ); ?>
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

		$instance['title'] = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}
}
