<?php
/**
 * Contact details widget.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Displays a newsroom address, phone number, email and opening hours.
 */
class Polite_News_Contact_Widget extends WP_Widget {

	/**
	 * Register the widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'polite_news_contact_widget',
			esc_html__( 'Polite News: Contact Details', 'polite-news' ),
			array(
				'classname'   => 'ts-contact-widget',
				'description' => esc_html__( 'Show an address, phone number, email address and opening hours.', 'polite-news' ),
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

		$title   = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$address = ! empty( $instance['address'] ) ? $instance['address'] : '';
		$phone   = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
		$email   = ! empty( $instance['email'] ) ? $instance['email'] : '';
		$hours   = ! empty( $instance['hours'] ) ? $instance['hours'] : '';

		if ( ! $address && ! $phone && ! $email && ! $hours ) {
			return;
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
		<ul class="ts-contact-list">
			<?php if ( $address ) : ?>
				<li>
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					<span><?php echo nl2br( esc_html( $address ) ); ?></span>
				</li>
			<?php endif; ?>

			<?php if ( $phone ) : ?>
				<li>
					<i class="fa fa-phone" aria-hidden="true"></i>
					<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
				</li>
			<?php endif; ?>

			<?php if ( $email && is_email( $email ) ) : ?>
				<li>
					<i class="fa fa-envelope-o" aria-hidden="true"></i>
					<a href="<?php echo esc_url( 'mailto:' . antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a>
				</li>
			<?php endif; ?>

			<?php if ( $hours ) : ?>
				<li>
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					<span><?php echo esc_html( $hours ); ?></span>
				</li>
			<?php endif; ?>
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

		$title   = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Contact', 'polite-news' );
		$address = ! empty( $instance['address'] ) ? $instance['address'] : '';
		$phone   = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
		$email   = ! empty( $instance['email'] ) ? $instance['email'] : '';
		$hours   = ! empty( $instance['hours'] ) ? $instance['hours'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'polite-news' ); ?></label>
			<textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_textarea( $address ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="email" value="<?php echo esc_attr( $email ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>"><?php esc_html_e( 'Opening Hours:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hours' ) ); ?>" type="text" value="<?php echo esc_attr( $hours ); ?>">
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

		$instance['title']   = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['address'] = ! empty( $new_instance['address'] ) ? sanitize_textarea_field( $new_instance['address'] ) : '';
		$instance['phone']   = ! empty( $new_instance['phone'] ) ? sanitize_text_field( $new_instance['phone'] ) : '';
		$instance['email']   = ! empty( $new_instance['email'] ) ? sanitize_email( $new_instance['email'] ) : '';
		$instance['hours']   = ! empty( $new_instance['hours'] ) ? sanitize_text_field( $new_instance['hours'] ) : '';

		return $instance;
	}
}
