<?php
/**
 * Document meta tags
 *
 * Canonical link, meta description and sharing card tags.
 *
 * @package Polite_News
 * 
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_document_meta_enabled' ) ) :
	/**
	 * Whether the theme should print description, canonical and card tags.
	 *
	 * @return bool
	 */
	function polite_news_document_meta_enabled() {

		if ( function_exists( 'polite_news_seo_plugin_active' ) && polite_news_seo_plugin_active() ) {
			return false;
		}

		/**
		 * Filters whether the theme prints its own document meta tags.
		 *
		 * @since 1.0.0
		 * 
		 * @param bool $enabled Whether to print the tags.
		 */
		return (bool) apply_filters( 'polite_news_document_meta', true );
	}
endif;

if ( ! function_exists( 'polite_news_document_description' ) ) :
	/**
	 * Build the description for the current view.
	 *
	 * @return string
	 */
	function polite_news_document_description() {

		$polite_news_description = '';

		if ( is_front_page() ) {

			$polite_news_description = get_bloginfo( 'description', 'display' );

		} elseif ( is_home() ) {

			$polite_news_posts_page = get_option( 'page_for_posts' );

			if ( $polite_news_posts_page ) {
				$polite_news_description = get_the_excerpt( $polite_news_posts_page );
			}

			if ( ! $polite_news_description ) {
				$polite_news_description = get_bloginfo( 'description', 'display' );
			}
		} elseif ( is_singular() ) {

			$polite_news_post = get_queried_object();

			if ( $polite_news_post instanceof WP_Post ) {
				if ( has_excerpt( $polite_news_post ) ) {
					$polite_news_description = get_the_excerpt( $polite_news_post );
				} elseif ( ! post_password_required( $polite_news_post ) ) {
					$polite_news_description = strip_shortcodes( $polite_news_post->post_content );
				}
			}
		} elseif ( is_category() || is_tag() || is_tax() ) {

			$polite_news_description = term_description();

		} elseif ( is_author() ) {

			$polite_news_description = get_the_author_meta( 'description', (int) get_queried_object_id() );
		}

		$polite_news_description = wp_strip_all_tags( (string) $polite_news_description, true );
		$polite_news_description = trim( preg_replace( '/\s+/u', ' ', $polite_news_description ) );

		if ( $polite_news_description ) {

			/* Search engines show around 155 characters. */
			$polite_news_trimmed = wp_html_excerpt( $polite_news_description, 155, '' );

			if ( $polite_news_trimmed !== $polite_news_description ) {
				/* Drop the part word the cut left behind rather than ending on a stump. */
				$polite_news_trimmed     = preg_replace( '/\s+\S*$/u', '', $polite_news_trimmed );
				$polite_news_description = rtrim( $polite_news_trimmed, " \t\n\r,;:-" ) . '&hellip;';
			}
		}

		/**
		 * Filters the meta description the theme prints.
		 *
		 * @since 1.0.0
		 *
		 * @param string $polite_news_description The description, possibly empty.
		 */
		return (string) apply_filters( 'polite_news_meta_description', $polite_news_description );
	}
endif;

if ( ! function_exists( 'polite_news_document_canonical' ) ) :
	/**
	 * The canonical URL for the current view.
	 *
	 * @return string
	 */
	function polite_news_document_canonical() {

		if ( is_singular() || is_404() || is_search() ) {
			return '';
		}

		$polite_news_canonical = '';

		if ( is_front_page() ) {

			$polite_news_canonical = home_url( '/' );

		} elseif ( is_home() ) {

			$polite_news_posts_page = get_option( 'page_for_posts' );
			$polite_news_canonical  = $polite_news_posts_page ? get_permalink( $polite_news_posts_page ) : home_url( '/' );

		} elseif ( is_category() || is_tag() || is_tax() ) {

			$polite_news_term = get_queried_object();

			if ( $polite_news_term instanceof WP_Term ) {
				$polite_news_canonical = get_term_link( $polite_news_term );
			}
		} elseif ( is_author() ) {

			$polite_news_canonical = get_author_posts_url( (int) get_queried_object_id() );

		} elseif ( is_post_type_archive() ) {

			$polite_news_canonical = get_post_type_archive_link( get_post_type() );

		} elseif ( is_day() ) {

			$polite_news_canonical = get_day_link( get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) );

		} elseif ( is_month() ) {

			$polite_news_canonical = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );

		} elseif ( is_year() ) {

			$polite_news_canonical = get_year_link( get_query_var( 'year' ) );
		}

		if ( ! $polite_news_canonical || is_wp_error( $polite_news_canonical ) ) {
			return '';
		}

		/* Page two of an archive is its own page, not a duplicate of page one. */
		$polite_news_paged = (int) get_query_var( 'paged' );

		if ( $polite_news_paged > 1 ) {
			$polite_news_canonical = get_pagenum_link( $polite_news_paged );
		}

		return (string) $polite_news_canonical;
	}
endif;

if ( ! function_exists( 'polite_news_document_share_image' ) ) :
	/**
	 * The image used for the sharing card.
	 *
	 * @return string
	 */
	function polite_news_document_share_image() {

		$polite_news_image_id = 0;

		if ( is_singular() && has_post_thumbnail() ) {
			$polite_news_image_id = (int) get_post_thumbnail_id();
		} elseif ( has_custom_logo() ) {
			$polite_news_image_id = (int) get_theme_mod( 'custom_logo' );
		} elseif ( get_site_icon_url() ) {
			return get_site_icon_url( 512 );
		}

		if ( ! $polite_news_image_id ) {
			return '';
		}

		$polite_news_image = wp_get_attachment_image_src( $polite_news_image_id, 'full' );

		return $polite_news_image ? $polite_news_image[0] : '';
	}
endif;

if ( ! function_exists( 'polite_news_document_meta' ) ) :
	/**
	 * Print the description, the canonical link and the sharing card.
	 */
	function polite_news_document_meta() {

		if ( ! polite_news_document_meta_enabled() ) {
			return;
		}

		/* Nothing on a 404 is worth describing or sharing. */
		if ( is_404() ) {
			return;
		}

		$polite_news_description = polite_news_document_description();
		$polite_news_canonical   = polite_news_document_canonical();
		$polite_news_share_image = polite_news_document_share_image();

		if ( $polite_news_description ) {
			echo '<meta name="description" content="' . esc_attr( $polite_news_description ) . '" />' . "\n";
		}

		if ( $polite_news_canonical ) {
			echo '<link rel="canonical" href="' . esc_url( $polite_news_canonical ) . '" />' . "\n";
		}

		/* Open Graph, with the handful of properties readers actually use. */
		echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
		echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '" />' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '" />' . "\n";

		if ( $polite_news_description ) {
			echo '<meta property="og:description" content="' . esc_attr( $polite_news_description ) . '" />' . "\n";
		}

		$polite_news_share_url = $polite_news_canonical;

		if ( ! $polite_news_share_url && is_singular() ) {
			$polite_news_share_url = get_permalink();
		}

		if ( $polite_news_share_url ) {
			echo '<meta property="og:url" content="' . esc_url( $polite_news_share_url ) . '" />' . "\n";
		}

		if ( $polite_news_share_image ) {
			echo '<meta property="og:image" content="' . esc_url( $polite_news_share_image ) . '" />' . "\n";
			echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
		} else {
			echo '<meta name="twitter:card" content="summary" />' . "\n";
		}
	}
endif;
add_action( 'wp_head', 'polite_news_document_meta', 2 );
