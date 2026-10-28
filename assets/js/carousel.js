/**
 * File carousel.js
 *
 * The featured carousel: crossfading slides, arrows, dots and autoplay.
 * No library needed.
 */
( function() {

	'use strict';

	function politeNewsCarousel() {

		var carousel = document.querySelector( '.ts-carousel' );

		if ( ! carousel ) {
			return;
		}

		var slides = carousel.querySelectorAll( '.ts-slide' );
		var dots   = carousel.querySelectorAll( '.ts-carousel-dot' );

		if ( slides.length < 2 ) {
			return;
		}

		var current = 0;
		var timer   = null;
		var speed   = 6000;

		if ( 'undefined' !== typeof polite_news_pro && polite_news_pro.carousel_speed ) {
			speed = parseInt( polite_news_pro.carousel_speed, 10 ) * 1000;
		}

		function goTo( index ) {

			slides[ current ].classList.remove( 'is-active' );

			if ( dots[ current ] ) {
				dots[ current ].classList.remove( 'is-active' );
			}

			current = ( index + slides.length ) % slides.length;

			slides[ current ].classList.add( 'is-active' );

			if ( dots[ current ] ) {
				dots[ current ].classList.add( 'is-active' );
			}
		}

		var reducedMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

		function play() {
			if ( speed > 0 && ! reducedMotion ) {
				timer = setInterval( function() {
					goTo( current + 1 );
				}, speed );
			}
		}

		function restart() {
			if ( timer ) {
				clearInterval( timer );
			}
			play();
		}

		var prev = carousel.querySelector( '.ts-carousel-prev' );
		var next = carousel.querySelector( '.ts-carousel-next' );

		if ( prev ) {
			prev.addEventListener( 'click', function() {
				goTo( current - 1 );
				restart();
			} );
		}

		if ( next ) {
			next.addEventListener( 'click', function() {
				goTo( current + 1 );
				restart();
			} );
		}

		Array.prototype.forEach.call( dots, function( dot ) {
			dot.addEventListener( 'click', function() {
				goTo( parseInt( dot.getAttribute( 'data-slide' ), 10 ) );
				restart();
			} );
		} );

		carousel.addEventListener( 'mouseenter', function() {
			if ( timer ) {
				clearInterval( timer );
				timer = null;
			}
		} );

		carousel.addEventListener( 'mouseleave', restart );

		play();
	}

	document.addEventListener( 'DOMContentLoaded', politeNewsCarousel );

}() );
