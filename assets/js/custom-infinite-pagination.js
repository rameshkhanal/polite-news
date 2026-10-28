/**
 * File custom-infinite-pagination.js
 *
 * Loads the next page of posts into the current listing without a page reload.
 */
jQuery( function( $ ) {

	'use strict';

	if ( 'undefined' === typeof polite_news_ajax ) {
		return;
	}

	var paged    = parseInt( polite_news_ajax.paged, 10 );
	var maxPages = parseInt( polite_news_ajax.max_num_pages, 10 );
	var $button  = $( '.ts-load-more-button' );
	var $wrap    = $( '.ts-posts-wrap' );

	if ( ! $button.length || ! $wrap.length ) {
		return;
	}

	if ( paged >= maxPages ) {
		$button.hide();
		return;
	}

	$button.on( 'click', function( event ) {

		event.preventDefault();

		var $self = $( this );

		if ( $self.hasClass( 'is-loading' ) ) {
			return;
		}

		$self.addClass( 'is-loading' ).text( polite_news_ajax.loading );

		$.post(
			polite_news_ajax.ajaxurl,
			{
				action: 'polite_news_load_more',
				nonce: polite_news_ajax.nonce,
				paged: paged + 1,
				query: polite_news_ajax.query
			},
			function( response ) {

				$self.removeClass( 'is-loading' );

				if ( ! response || ! response.success || ! response.data.html ) {
					$self.hide();
					return;
				}

				$wrap.append( response.data.html );

				paged = paged + 1;

				if ( paged >= maxPages ) {
					$self.hide();
				} else {
					$self.text( polite_news_ajax.show_more );
				}
			}
		).fail( function() {
			$self.removeClass( 'is-loading' ).text( polite_news_ajax.no_more_posts );
		} );
	} );
} );
