<?php
/**
 * Structured data
 *
 * Prints JSON-LD: the site and its search action on the front page, a NewsArticle on single posts.
 *
 * @package Polite_News
 * 
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_seo_plugin_active' ) ) :
	/**
	 * Whether a dedicated SEO plugin handles the structured data already.
	 *
	 * @return bool
	 */
	function polite_news_seo_plugin_active() {
		return defined( 'WPSEO_VERSION' )
			|| class_exists( 'RankMath' )
			|| defined( 'SEOPRESS_VERSION' )
			|| defined( 'AIOSEO_VERSION' )
			|| defined( 'THE_SEO_FRAMEWORK_PRESENT' )
			|| defined( 'SLIM_SEO_VER' );
	}
endif;

if ( ! function_exists( 'polite_news_structured_data' ) ) :
	/**
	 * Print the JSON-LD for the current view.
	 */
	function polite_news_structured_data() {

		if ( polite_news_seo_plugin_active() ) {
			return;
		}

		$schema = array();

		if ( is_front_page() || is_home() ) {

			$website = array(
				'@context'        => 'https://schema.org',
				'@type'           => 'WebSite',
				'name'            => get_bloginfo( 'name' ),
				'url'             => home_url( '/' ),
				'potentialAction' => array(
					'@type'       => 'SearchAction',
					'target'      => array(
						'@type'       => 'EntryPoint',
						'urlTemplate' => home_url( '/?s={search_term_string}' ),
					),
					'query-input' => 'required name=search_term_string',
				),
			);

			$description = get_bloginfo( 'description' );

			if ( $description ) {
				$website['description'] = $description;
			}

			$schema[] = $website;

		} elseif ( is_singular( 'post' ) ) {

			$article = array(
				'@context'         => 'https://schema.org',
				'@type'            => 'NewsArticle',
				'headline'         => get_the_title(),
				'url'              => get_permalink(),
				'mainEntityOfPage' => get_permalink(),
				'datePublished'    => get_the_date( 'c' ),
				'dateModified'     => get_the_modified_date( 'c' ),
				'author'           => array(
					'@type' => 'Person',
					'name'  => get_the_author(),
					'url'   => get_author_posts_url( get_the_author_meta( 'ID' ) ),
				),
				'publisher'        => array(
					'@type' => 'Organization',
					'name'  => get_bloginfo( 'name' ),
					'url'   => home_url( '/' ),
				),
			);

			$excerpt = get_the_excerpt();

			if ( $excerpt ) {
				$article['description'] = wp_strip_all_tags( $excerpt );
			}

			if ( has_post_thumbnail() ) {

				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

				if ( $image ) {
					$article['image'] = array(
						'@type'  => 'ImageObject',
						'url'    => $image[0],
						'width'  => $image[1],
						'height' => $image[2],
					);
				}
			}

			$logo_id = get_theme_mod( 'custom_logo' );

			if ( $logo_id ) {

				$logo = wp_get_attachment_image_src( $logo_id, 'full' );

				if ( $logo ) {
					$article['publisher']['logo'] = array(
						'@type' => 'ImageObject',
						'url'   => $logo[0],
					);
				}
			}

			$schema[] = $article;
		}

		foreach ( $schema as $data ) {
			echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
		}
	}
endif;
add_action( 'wp_head', 'polite_news_structured_data' );
