<?php
/**
 * Social sharing hook
 *
 * @package Polite_News
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'polite_news_social_sharing' ) ) :
	/**
	 * Print the sharing links for a post.
	 *
	 * @param int $post_id Post id to share.
	 */
	function polite_news_social_sharing( $post_id = 0 ) {

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$url   = rawurlencode( get_permalink( $post_id ) );
		$title = rawurlencode( get_the_title( $post_id ) );

		$networks = array(
			'facebook' => array(
				'label' => __( 'Share on Facebook', 'polite-news' ),
				'icon'  => 'fa-facebook',
				'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
			),
			'twitter'  => array(
				'label' => __( 'Share on X', 'polite-news' ),
				'icon'  => 'fa-twitter',
				'url'   => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title,
			),
			'linkedin' => array(
				'label' => __( 'Share on LinkedIn', 'polite-news' ),
				'icon'  => 'fa-linkedin',
				'url'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url,
			),
			'pinterest' => array(
				'label' => __( 'Share on Pinterest', 'polite-news' ),
				'icon'  => 'fa-pinterest',
				'url'   => 'https://pinterest.com/pin/create/button/?url=' . $url . '&description=' . $title,
			),
			'whatsapp' => array(
				'label' => __( 'Share on WhatsApp', 'polite-news' ),
				'icon'  => 'fa-whatsapp',
				'url'   => 'https://api.whatsapp.com/send?text=' . $title . '%20' . $url,
			),
		);
		?>
		<div class="ts-post-share">
			<span class="ts-share-label"><?php esc_html_e( 'Share', 'polite-news' ); ?></span>
			<?php foreach ( $networks as $network_id => $network ) : ?>
				<a class="ts-share-<?php echo esc_attr( $network_id ); ?>" href="<?php echo esc_url( $network['url'] ); ?>" target="_blank" rel="noopener noreferrer">
					<i class="fa <?php echo esc_attr( $network['icon'] ); ?>" aria-hidden="true"></i>
					<span class="screen-reader-text"><?php echo esc_html( $network['label'] ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
		<?php
	}
endif;
add_action( 'polite_news_social_sharing', 'polite_news_social_sharing', 10, 1 );
