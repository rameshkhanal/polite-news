<?php
/**
 * Radio Image Custom Control
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * A class to create a set of selectable images in the customizer.
 */
if ( ! class_exists( 'Polite_News_Radio_Image_Control' ) ) {

	class Polite_News_Radio_Image_Control extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @var string
		 */
		public $type = 'radio-image';

		/**
		 * Render the control content.
		 *
		 * @return void
		 */
		public function render_content() {

			if ( empty( $this->choices ) ) {
				return;
			}

			$name = '_customize-radio-' . $this->id;
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
			<div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<label for="<?php echo esc_attr( $this->id . $value ); ?>">
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $this->id . $value ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?>>
						<img src="<?php echo esc_url( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" />
					</label>
				<?php endforeach; ?>
			</div>
			<?php
		}
	}
}
