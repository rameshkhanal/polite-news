<?php
/**
 * Sanitize callbacks for the customizer settings.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

/**
 * Checkbox sanitization callback.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function polite_news_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === (bool) $checked ) ? true : false );
}

/**
 * Select sanitization callback.
 *
 * - Sanitization: select
 * - Control: select, radio
 *
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function polite_news_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$control = $setting->manager->get_control( $setting->id );

	if ( ! $control || ! isset( $control->choices ) ) {
		return $setting->default;
	}

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $control->choices ) ? $input : $setting->default );
}

/**
 * Font family sanitization callback.
 *
 * Font family names carry capitals and spaces, so they cannot go through
 * sanitize_key. The value is checked against the font list instead.
 *
 * @param string               $input   Chosen font family.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The chosen family if it exists, the default otherwise.
 */
function polite_news_sanitize_font( $input, $setting ) {

	$fonts = polite_news_google_fonts();

	return array_key_exists( $input, $fonts ) ? $input : $setting->default;
}

/**
 * Number range sanitization callback.
 *
 * - Sanitization: number_range
 * - Control: number, tel
 *
 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
 * `$number` as an absolute integer within a defined min-max range.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string The number, if it falls within the defined range; otherwise, the setting default.
 */
function polite_news_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$control = $setting->manager->get_control( $setting->id );

	if ( ! $control || ! isset( $control->input_attrs ) ) {
		return $number;
	}

	$atts = $control->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

/**
 * Adds sanitization callback function: Number
 *
 * @since Polite News 1.0.0
 *
 * @param mixed $input Value to sanitize.
 * @return int Sanitized number.
 */
if ( ! function_exists( 'polite_news_sanitize_number' ) ) :
	function polite_news_sanitize_number( $input ) {

		if ( isset( $input ) && is_numeric( $input ) ) {
			return $input;
		}

		return 0;
	}
endif;

/**
 * Sanitize a comma separated list of category ids.
 *
 * @since Polite News 1.0.0
 *
 * @param string $input Comma separated ids.
 * @return string Sanitized comma separated ids.
 */
if ( ! function_exists( 'polite_news_sanitize_category_list' ) ) :
	function polite_news_sanitize_category_list( $input ) {

		if ( empty( $input ) ) {
			return '';
		}

		$ids = array_filter( array_map( 'absint', explode( ',', $input ) ) );

		return implode( ',', $ids );
	}
endif;
