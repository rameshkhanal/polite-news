<?php
/**
 * Call to action widget.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Displays a short pitch with a button, for a newsletter or any other page.
 */
class Polite_News_CTA_Widget extends WP_Widget {

	/**
	 * Register the widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'polite_news_cta_widget',
			esc_html__( 'Polite News: Call To Action', 'polite-news' ),
			array(
				'classname'   => 'ts-cta-widget',
				'description' => esc_html__( 'A short pitch with a button. Point it at a newsletter, a contact page or anything else.', 'polite-news' ),
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

		$title  = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$text   = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$label  = ! empty( $instance['label'] ) ? $instance['label'] : '';
		$url    = ! empty( $instance['url'] ) ? $instance['url'] : '';
		$newtab = ! empty( $instance['newtab'] ) ? 1 : 0;

		if ( ! $text && ! $label ) {
			return;
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
		<div class="ts-cta-box">
			<?php if ( $text ) : ?>
				<p class="ts-cta-text"><?php echo esc_html( $text ); ?></p>
			<?php endif; ?>

			<?php if ( $label && $url ) : ?>
				<a class="ts-cta-button" href="<?php echo esc_url( $url ); ?>"<?php echo $newtab ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $label ); ?></a>
			<?php endif; ?>
		</div>
		<?php

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Back end widget form.
	 *
	 * @param array $instance Previously saved values from the database.
	 */
	public function form( $instance ) {

		$title  = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$text   = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$label  = ! empty( $instance['label'] ) ? $instance['label'] : '';
		$url    = ! empty( $instance['url'] ) ? $instance['url'] : '';
		$newtab = ! empty( $instance['newtab'] ) ? 1 : 0;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Text:', 'polite-news' ); ?></label>
			<textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>"><?php esc_html_e( 'Button Label:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'Button Link:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="url" value="<?php echo esc_attr( $url ); ?>">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $newtab, 1 ); ?> id="<?php echo esc_attr( $this->get_field_id( 'newtab' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'newtab' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'newtab' ) ); ?>"><?php esc_html_e( 'Open in a new tab', 'polite-news' ); ?></label>
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
		$instance['text']   = ! empty( $new_instance['text'] ) ? sanitize_textarea_field( $new_instance['text'] ) : '';
		$instance['label']  = ! empty( $new_instance['label'] ) ? sanitize_text_field( $new_instance['label'] ) : '';
		$instance['url']    = ! empty( $new_instance['url'] ) ? esc_url_raw( $new_instance['url'] ) : '';
		$instance['newtab'] = ! empty( $new_instance['newtab'] ) ? 1 : 0;

		return $instance;
	}
}
