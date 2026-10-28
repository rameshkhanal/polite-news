<?php
/**
 * Banner widget.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Displays a single image, optionally linked. Meant for adverts and promos.
 */
class Polite_News_Banner_Widget extends WP_Widget {

	/**
	 * Register the widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'polite_news_banner_widget',
			esc_html__( 'Polite News: Banner', 'polite-news' ),
			array(
				'classname'   => 'ts-banner-widget',
				'description' => esc_html__( 'Show an advert or promo image, with an optional link. A tall image suits the sidebar.', 'polite-news' ),
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
		$image  = ! empty( $instance['image'] ) ? absint( $instance['image'] ) : 0;
		$url    = ! empty( $instance['url'] ) ? $instance['url'] : '';
		$newtab = ! empty( $instance['newtab'] ) ? 1 : 0;
		$label  = ! empty( $instance['label'] ) ? $instance['label'] : '';

		if ( ! $image ) {
			return;
		}

		$markup = wp_get_attachment_image(
			$image,
			'full',
			false,
			array(
				'class'    => 'ts-banner-image',
				'decoding' => 'async',
			)
		);

		if ( ! $markup ) {
			return;
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( $url ) {
			printf(
				'<a class="ts-banner-link" href="%1$s"%2$s>%3$s</a>',
				esc_url( $url ),
				$newtab ? ' target="_blank" rel="noopener noreferrer"' : '',
				$markup // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		} else {
			echo $markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( $label ) {
			echo '<span class="ts-banner-label">' . esc_html( $label ) . '</span>';
		}

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Back end widget form.
	 *
	 * @param array $instance Previously saved values from the database.
	 */
	public function form( $instance ) {

		$title  = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$image  = ! empty( $instance['image'] ) ? absint( $instance['image'] ) : 0;
		$url    = ! empty( $instance['url'] ) ? $instance['url'] : '';
		$newtab = ! empty( $instance['newtab'] ) ? 1 : 0;
		$label  = ! empty( $instance['label'] ) ? $instance['label'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image ID:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="number" min="0" value="<?php echo esc_attr( $image ); ?>">
			<small><?php esc_html_e( 'Open the image in Media Library and copy the number at the end of the address.', 'polite-news' ); ?></small>
		</p>
		<?php if ( $image ) : ?>
			<p><?php echo wp_get_attachment_image( $image, 'medium', false, array( 'style' => 'max-width:100%;height:auto;' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<?php endif; ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'Link:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="url" value="<?php echo esc_attr( $url ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>"><?php esc_html_e( 'Caption:', 'polite-news' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>">
			<small><?php esc_html_e( 'Optional. A short line under the image, such as Advertisement.', 'polite-news' ); ?></small>
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
		$instance['image']  = ! empty( $new_instance['image'] ) ? absint( $new_instance['image'] ) : 0;
		$instance['url']    = ! empty( $new_instance['url'] ) ? esc_url_raw( $new_instance['url'] ) : '';
		$instance['label']  = ! empty( $new_instance['label'] ) ? sanitize_text_field( $new_instance['label'] ) : '';
		$instance['newtab'] = ! empty( $new_instance['newtab'] ) ? 1 : 0;

		return $instance;
	}
}
