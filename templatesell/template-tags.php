<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post date and time.
	 */
	function polite_news_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on"><i class="fa fa-calendar-o" aria-hidden="true"></i>' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'polite_news_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 *
	 * @param bool $with_avatar Whether to show the author avatar.
	 */
	function polite_news_posted_by( $with_avatar = true ) {

		$author_id = (int) get_the_author_meta( 'ID' );

		$output = '<span class="byline ts-meta-author">';

		if ( $with_avatar ) {
			$output .= get_avatar( $author_id, 26 );
		}

		$output .= '<a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author() ) . '</a>';
		$output .= '</span>';

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'polite_news_entry_category' ) ) :
	/**
	 * Prints the first category of the post as a pill badge.
	 *
	 * @param bool $solid Whether to render the solid variant.
	 */
	function polite_news_entry_category( $solid = false ) {

		if ( 'post' !== get_post_type() ) {
			return;
		}

		$categories = get_the_category();

		if ( empty( $categories ) ) {
			return;
		}

		$class = $solid ? 'ts-cat-badge ts-cat-badge-solid' : 'ts-cat-badge';

		printf(
			'<a class="%1$s" href="%2$s">%3$s</a>',
			esc_attr( $class ),
			esc_url( get_category_link( $categories[0]->term_id ) ),
			esc_html( $categories[0]->name )
		);
	}
endif;

if ( ! function_exists( 'polite_news_entry_meta' ) ) :
	/**
	 * Prints the full list of categories of the post.
	 */
	function polite_news_entry_meta() {

		if ( 'post' !== get_post_type() ) {
			return;
		}

		$categories_list = get_the_category_list( ' ' );

		if ( $categories_list ) {
			echo '<span class="cat-links">' . $categories_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'polite_news_entry_tags' ) ) :
	/**
	 * Prints the tag list of the post.
	 */
	function polite_news_entry_tags() {

		if ( 'post' !== get_post_type() ) {
			return;
		}

		$tags_list = get_the_tag_list( '', ' ' );

		if ( $tags_list ) {
			echo '<div class="ts-tags tags-links">' . $tags_list . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'polite_news_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * @param string $size Image size to render.
	 */
	function polite_news_post_thumbnail( $size = 'polite-news-grid' ) {

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="ts-post-media">
				<?php the_post_thumbnail( 'polite-news-slider' ); ?>
			</div>
			<?php
		else :
			?>
			<div class="ts-post-media">
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
					the_post_thumbnail(
						$size,
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
					?>
				</a>
				<?php polite_news_entry_category( true ); ?>
			</div>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'polite_news_pagination' ) ) :
	/**
	 * Prints the archive pagination, either numeric or an ajax load more button.
	 */
	function polite_news_pagination() {

		global $polite_news_theme_options, $wp_query;

		$type = isset( $polite_news_theme_options['polite-news-pagination-options'] ) ? esc_attr( $polite_news_theme_options['polite-news-pagination-options'] ) : 'numeric';

		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		if ( 'ajax' === $type ) {
			?>
			<div class="ts-load-more">
				<button type="button" class="ts-button ts-load-more-button"><?php esc_html_e( 'View More', 'polite-news' ); ?></button>
			</div>
			<?php
			return;
		}

		the_posts_pagination(
			array(
				'mid_size'           => 2,
				'class'              => 'ts-pagination',
				'prev_text'          => '<i class="fa fa-angle-left" aria-hidden="true"></i><span class="screen-reader-text">' . esc_html__( 'Previous page', 'polite-news' ) . '</span>',
				'next_text'          => '<i class="fa fa-angle-right" aria-hidden="true"></i><span class="screen-reader-text">' . esc_html__( 'Next page', 'polite-news' ) . '</span>',
				'screen_reader_text' => esc_html__( 'Posts navigation', 'polite-news' ),
			)
		);
	}
endif;

if ( ! function_exists( 'polite_news_author_box' ) ) :
	/**
	 * Prints the author biography box.
	 */
	function polite_news_author_box() {

		$description = get_the_author_meta( 'description' );

		if ( empty( $description ) ) {
			return;
		}
		?>
		<div class="ts-author-box">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
			<div class="ts-author-info">
				<h3 class="ts-author-name"><?php echo esc_html( get_the_author() ); ?></h3>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'polite_news_home_style' ) ) :
	/**
	 * Returns the home page style when the home page is showing.
	 *
	 * @return string Empty string outside the home page.
	 */
	function polite_news_home_style() {

		global $polite_news_theme_options;

		if ( ! is_home() && ! is_front_page() ) {
			return '';
		}

		$style = isset( $polite_news_theme_options['polite_news_home_style'] ) ? esc_attr( $polite_news_theme_options['polite_news_home_style'] ) : 'home-one';

		if ( ! in_array( $style, array( 'home-classic', 'home-one', 'home-two', 'home-three', 'home-large', 'home-masonry-one', 'home-masonry-two', 'home-masonry-three' ), true ) ) {
			$style = 'home-one';
		}

		return $style;
	}
endif;

if ( ! function_exists( 'polite_news_grid_class' ) ) :
	/**
	 * Returns the wrapper class for the current blog layout.
	 *
	 * @return string
	 */
	function polite_news_grid_class() {

		global $polite_news_theme_options;

		/* The home page has its own three styles. */
		$home_style = polite_news_home_style();

		if ( 'home-two' === $home_style ) {
			return 'ts-posts-wrap ts-one-column ts-home-list';
		}

		if ( 'home-three' === $home_style ) {
			return 'ts-posts-wrap ts-grid ts-grid-2 ts-home-mag';
		}

		if ( 'home-one' === $home_style ) {
			return 'ts-posts-wrap ts-grid ts-grid-2';
		}

		if ( 'home-classic' === $home_style ) {
			return 'ts-posts-wrap ts-one-column ts-home-classic';
		}

		if ( 'home-large' === $home_style ) {
			return 'ts-posts-wrap ts-one-column ts-home-large';
		}

		if ( 'home-masonry-one' === $home_style ) {
			return 'ts-posts-wrap ts-masonry ts-masonry-2';
		}

		if ( 'home-masonry-two' === $home_style ) {
			return 'ts-posts-wrap ts-masonry ts-masonry-3';
		}

		if ( 'home-masonry-three' === $home_style ) {
			return 'ts-posts-wrap ts-masonry ts-masonry-2 ts-masonry-feature';
		}

		$layout = isset( $polite_news_theme_options['polite-news-column-blog-page'] ) ? esc_attr( $polite_news_theme_options['polite-news-column-blog-page'] ) : 'grid-two';

		/* The archives draw on the same set of arrangements as the home page, so they share its classes. */
		$archive_layouts = array(
			'one-column'    => 'ts-posts-wrap ts-one-column',
			'grid-two'      => 'ts-posts-wrap ts-grid ts-grid-2',
			'grid-three'    => 'ts-posts-wrap ts-grid ts-grid-3',
			'classic'       => 'ts-posts-wrap ts-one-column ts-home-classic',
			'large'         => 'ts-posts-wrap ts-one-column ts-home-large',
			'magazine'      => 'ts-posts-wrap ts-grid ts-grid-2 ts-home-mag',
			'masonry-one'   => 'ts-posts-wrap ts-masonry ts-masonry-2',
			'masonry-two'   => 'ts-posts-wrap ts-masonry ts-masonry-3',
			'masonry-three' => 'ts-posts-wrap ts-masonry ts-masonry-2 ts-masonry-feature',
		);

		if ( isset( $archive_layouts[ $layout ] ) ) {
			return $archive_layouts[ $layout ];
		}

		return $archive_layouts['grid-two'];
	}
endif;

if ( ! function_exists( 'polite_news_site_title' ) ) :
	/**
	 * Print the site name as the branding heading.
	 */
	function polite_news_site_title() {

		/* Only the front page owns the document heading; elsewhere the entry title does. */
		$polite_news_title_tag   = ( is_front_page() && is_home() ) ? 'h1' : 'p';
		$polite_news_title_class = display_header_text() ? 'site-title' : 'site-title screen-reader-text';

		printf(
			'<%1$s class="%2$s"><a href="%3$s" rel="home">%4$s</a></%1$s>',
			$polite_news_title_tag, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- literal h1 or p.
			esc_attr( $polite_news_title_class ),
			esc_url( home_url( '/' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
	}
endif;
