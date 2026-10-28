<?php
/**
 * Heading Custom Control
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * A plain group heading, used to separate related controls inside one section.
 */
if ( ! class_exists( 'Polite_News_Heading_Control' ) ) {

	class Polite_News_Heading_Control extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @var string
		 */
		public $type = 'polite-news-heading';

		/**
		 * Render the heading.
		 */
		public function render_content() {

			if ( ! empty( $this->label ) ) {
				?>
				<span class="customize-control-title ts-group-heading"><?php echo esc_html( $this->label ); ?></span>
				<?php
			}

			if ( ! empty( $this->description ) ) {
				?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php
			}
		}
	}
}
