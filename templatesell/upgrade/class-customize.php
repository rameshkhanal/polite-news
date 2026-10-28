<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @package Polite_News
 *
 * @since  1.0.0
 * @access public
 */
final class Polite_News_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param object $manager Customizer manager.
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once trailingslashit( get_template_directory() ) . 'templatesell/upgrade/section-pro.php';

		// Register custom section types.
		$manager->register_section_type( 'Polite_News_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Polite_News_Customize_Section_Pro(
				$manager,
				'polite_news_pro',
				array(
					'pro_text2' => esc_html__( 'Unlock More Features', 'polite-news' ),
					'pro_url2'  => 'https://templatesell.com/downloads/polite-news-pro-magazine-wordpress-theme/',
					'pro_text'  => esc_html__( 'Get Support', 'polite-news' ),
					'pro_url'   => 'https://www.templatesell.com/support/',
					'priority'  => 1,
				)
			)
		);
	}

	/**
	 * Loads customizer JavaScript.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'polite-news-customize-controls', trailingslashit( get_template_directory_uri() ) . 'templatesell/upgrade/customize-controls.js', array( 'customize-controls' ), POLITE_NEWS_VERSION, true );
	}
}

// Doing it wrong, kicking it off.
Polite_News_Customize::get_instance();
