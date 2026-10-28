<?php
/**
 * Post dropdown custom control.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * A class to create a post dropdown in the customizer.
 */
if ( ! class_exists( 'Polite_News_Post_Dropdown_Control' ) ) {

	class Polite_News_Post_Dropdown_Control extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @var string
		 */
		public $type = 'dropdown-posts';

		/**
		 * Render the control content.
		 *
		 * @return void
		 */
		public function render_content() {

			$posts = get_posts(
				array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
					'orderby'        => 'date',
					'order'          => 'DESC',
				)
			);
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
				<select <?php $this->link(); ?>>
					<option value="0" <?php selected( 0, absint( $this->value() ) ); ?>><?php esc_html_e( '&mdash; Select a post &mdash;', 'polite-news' ); ?></option>
					<?php foreach ( $posts as $post_item ) : ?>
						<option value="<?php echo absint( $post_item->ID ); ?>" <?php selected( $post_item->ID, absint( $this->value() ) ); ?>><?php echo esc_html( wp_trim_words( get_the_title( $post_item ), 8 ) ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<?php
		}
	}
}
