<?php
/**
 * Category dropdown custom control.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * A class to create a category dropdown in the customizer.
 */
if ( ! class_exists( 'Polite_News_Category_Dropdown_Control' ) ) {

	class Polite_News_Category_Dropdown_Control extends WP_Customize_Control {

		/**
		 * Control type.
		 *
		 * @var string
		 */
		public $type = 'dropdown-categories';

		/**
		 * Render the control content.
		 *
		 * @return void
		 */
		public function render_content() {

			$dropdown = wp_dropdown_categories(
				array(
					'name'             => '_customize-dropdown-categories-' . $this->id,
					'echo'             => 0,
					'show_option_none' => esc_html__( 'All Categories', 'polite-news' ),
					'option_none_value' => '0',
					'selected'         => $this->value(),
					'hide_empty'       => 0,
				)
			);

			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
				<?php
				echo wp_kses(
					$dropdown,
					array(
						'select' => array(
							'name'          => array(),
							'id'            => array(),
							'class'         => array(),
							'data-customize-setting-link' => array(),
						),
						'option' => array(
							'value'    => array(),
							'selected' => array(),
							'class'    => array(),
						),
					)
				);
				?>
			</label>
			<?php
		}
	}
}

/**
 * Get a list of categories as an id keyed array, used by select controls.
 *
 * @since Polite News 1.0.0
 *
 * @return array
 */
if ( ! function_exists( 'polite_news_get_categories_list' ) ) :
	function polite_news_get_categories_list() {

		$list = array( 0 => esc_html__( 'All Categories', 'polite-news' ) );

		$categories = get_categories(
			array(
				'hide_empty' => 0,
			)
		);

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$list[ $category->term_id ] = $category->name;
			}
		}

		return $list;
	}
endif;
