/**
 * File custom.js
 *
 * Front end behaviour for Polite News: dark mode, breaking news ticker,
 * search toggle, social icons and the back to top button.
 */
( function() {

	'use strict';

	var STORAGE_KEY = 'polite-news-color-scheme';

	/**
	 * Dark mode.
	 */
	function politeNewsDarkMode() {

		var toggle = document.querySelector( '.ts-dark-toggle' );

		function apply( isDark ) {
			document.body.classList.toggle( 'ts-dark-mode', isDark );

			if ( toggle ) {
				toggle.setAttribute( 'aria-pressed', isDark ? 'true' : 'false' );
			}
		}

		var stored = null;

		try {
			stored = window.localStorage.getItem( STORAGE_KEY );
		} catch ( e ) {
			stored = null;
		}

		if ( 'dark' === stored ) {
			apply( true );
		} else if ( 'light' === stored ) {
			apply( false );
		} else if ( window.matchMedia && window.matchMedia( '(prefers-color-scheme: dark)' ).matches ) {
			apply( true );
		}

		if ( ! toggle ) {
			return;
		}

		toggle.addEventListener( 'click', function( event ) {
			event.preventDefault();

			var isDark = ! document.body.classList.contains( 'ts-dark-mode' );

			apply( isDark );

			try {
				window.localStorage.setItem( STORAGE_KEY, isDark ? 'dark' : 'light' );
			} catch ( e ) {
				// Storage unavailable, the choice simply is not remembered.
			}
		} );
	}

	/**
	 * Breaking news ticker.
	 *
	 * Rotates through the ticker items one at a time.
	 */
	function politeNewsTicker() {

		var wrap = document.querySelector( '.ts-ticker-items' );

		if ( ! wrap ) {
			return;
		}

		var items = wrap.querySelectorAll( '.ts-ticker-item' );

		if ( items.length < 2 ) {
			return;
		}

		if ( window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
			return;
		}

		var current = 0;

		setInterval( function() {
			items[ current ].classList.remove( 'is-active' );
			current = ( current + 1 ) % items.length;
			items[ current ].classList.add( 'is-active' );
		}, 4000 );
	}

	/**
	 * Header search toggle.
	 */
	function politeNewsSearchToggle() {

		var toggle = document.querySelector( '.ts-search-toggle' );
		var box    = document.querySelector( '.ts-search-box' );

		if ( ! toggle || ! box ) {
			return;
		}

		toggle.addEventListener( 'click', function( event ) {
			event.preventDefault();

			var isOpen = box.classList.toggle( 'is-open' );

			toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );

			if ( isOpen ) {
				var field = box.querySelector( 'input[type="search"]' );

				if ( field ) {
					field.focus();
				}
			}
		} );
	}

	/**
	 * Back to top button.
	 */
	function politeNewsBackToTop() {

		var button = document.getElementById( 'toTop' );

		if ( ! button ) {
			return;
		}

		window.addEventListener( 'scroll', function() {
			if ( window.pageYOffset > 400 ) {
				button.classList.add( 'is-visible' );
			} else {
				button.classList.remove( 'is-visible' );
			}
		} );

		button.addEventListener( 'click', function( event ) {
			event.preventDefault();
			window.scrollTo( { top: 0, behavior: 'smooth' } );
		} );
	}

	/**
	 * Give social menu links an icon based on the host name of the link.
	 */
	function politeNewsSocialIcons() {

		var links = document.querySelectorAll( '.ts-social-icons a, .ts-social-widget a' );

		var hosts = {
			'facebook': 'fa-facebook',
			'twitter': 'fa-twitter',
			'x.com': 'fa-twitter',
			'instagram': 'fa-instagram',
			'linkedin': 'fa-linkedin',
			'youtube': 'fa-youtube-play',
			'pinterest': 'fa-pinterest',
			'tiktok': 'fa-music',
			'github': 'fa-github',
			'telegram': 'fa-paper-plane',
			'whatsapp': 'fa-whatsapp',
			'feed': 'fa-rss'
		};

		Array.prototype.forEach.call( links, function( link ) {

			if ( link.querySelector( 'i' ) ) {
				return;
			}

			var href  = link.getAttribute( 'href' ) || '';
			var found = 'fa-link';

			for ( var key in hosts ) {
				if ( hosts.hasOwnProperty( key ) && href.indexOf( key ) !== -1 ) {
					found = hosts[ key ];
					break;
				}
			}

			var icon = document.createElement( 'i' );
			icon.className = 'fa ' + found;
			icon.setAttribute( 'aria-hidden', 'true' );
			link.insertBefore( icon, link.firstChild );
		} );
	}

	/**
	 * Keep the navigation fixed to the top once the page scrolls past it.
	 */
	function politeNewsStickyNav() {

		var nav = document.querySelector( '.ts-sticky-nav' );

		if ( ! nav ) {
			return;
		}

		var placeholder = document.createElement( 'div' );
		placeholder.className = 'ts-sticky-placeholder';
		nav.parentNode.insertBefore( placeholder, nav.nextSibling );

		var stickyPoint = 0;

		function toggle() {
			if ( window.pageYOffset > stickyPoint ) {
				if ( ! nav.classList.contains( 'is-stuck' ) ) {
					placeholder.style.height = nav.offsetHeight + 'px';
					nav.classList.add( 'is-stuck' );
				}
			} else {
				nav.classList.remove( 'is-stuck' );
				placeholder.style.height = '0';
			}
		}

		function measure() {
			var wasStuck = nav.classList.contains( 'is-stuck' );

			nav.classList.remove( 'is-stuck' );
			placeholder.style.height = '0';
			stickyPoint = nav.getBoundingClientRect().top + window.pageYOffset;

			if ( wasStuck ) {
				toggle();
			}
		}

		window.addEventListener( 'scroll', toggle, { passive: true } );
		window.addEventListener( 'resize', measure );
		measure();
	}

	/**
	 * Fade the cards up as they scroll into view.
	 */
	function politeNewsReveal() {

		if ( ! ( 'IntersectionObserver' in window ) ) {
			return;
		}

		if ( window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
			return;
		}

		var cards = document.querySelectorAll( '.ts-box, .ts-curated-card, .ts-posts-wrap article, .ts-hero-side-item' );

		if ( ! cards.length ) {
			return;
		}

		var observer = new IntersectionObserver( function( entries ) {
			entries.forEach( function( entry ) {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-revealed' );
					observer.unobserve( entry.target );
				}
			} );
		}, { rootMargin: '0px 0px -8% 0px' } );

		Array.prototype.forEach.call( cards, function( card, index ) {
			card.classList.add( 'ts-reveal' );
			card.style.transitionDelay = ( ( index % 4 ) * 60 ) + 'ms';
			observer.observe( card );
		} );
	}

	/**
	 * Collapsible submenus for the mobile menu.
	 */
	function politeNewsMobileSubmenus() {

		var parents = document.querySelectorAll( '.main-navigation .menu-item-has-children' );

		if ( ! parents.length ) {
			return;
		}

		Array.prototype.forEach.call( parents, function( item ) {

			var submenu = item.querySelector( 'ul' ),
				link    = item.querySelector( 'a' ),
				button;

			if ( ! submenu || item.querySelector( '.ts-submenu-toggle' ) ) {
				return;
			}

			button = document.createElement( 'button' );
			button.type = 'button';
			button.className = 'ts-submenu-toggle';
			button.setAttribute( 'aria-expanded', 'false' );
			button.innerHTML = '<i class="fa fa-angle-down" aria-hidden="true"></i>';
			button.setAttribute( 'aria-label', link ? link.textContent.trim() : '' );

			button.addEventListener( 'click', function( event ) {
				event.preventDefault();
				event.stopPropagation();

				var open = item.classList.toggle( 'is-open' );
				button.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			} );

			item.insertBefore( button, submenu );
		} );
	}
	/**
	 * Full screen mobile menu.
	 */
	function politeNewsMobileMenu() {

		var nav    = document.getElementById( 'site-navigation' ),
			toggle = nav ? nav.querySelector( '.menu-toggle' ) : null,
			wrap   = nav ? nav.querySelector( '.menu-wrapper' ) : null,
			close  = nav ? nav.querySelector( '.ts-menu-close' ) : null;

		if ( ! nav || ! toggle || ! wrap ) {
			return;
		}

		function isOpen() {
			return -1 !== nav.className.indexOf( 'toggled' );
		}

		/* Only the panel is on screen, so only its controls can be reached. */
		function focusable() {
			return Array.prototype.filter.call(
				wrap.querySelectorAll( 'a[href], button:not([disabled])' ),
				function( el ) {
					return null !== el.offsetParent;
				}
			);
		}

		function closeMenu() {
			if ( isOpen() ) {
				toggle.click();
				toggle.focus();
			}
		}

		function sync() {
			var open = isOpen(),
				items;

			document.body.classList.toggle( 'ts-menu-open', open );

			if ( open && close ) {
				close.focus();
			}

			items = wrap.querySelectorAll( '.ts-submenu-toggle' );

			/* Collapse every section again so the panel reopens tidy. */
			if ( ! open ) {
				Array.prototype.forEach.call( items, function( button ) {
					button.setAttribute( 'aria-expanded', 'false' );
					button.parentNode.classList.remove( 'is-open' );
				} );
			}
		}

		/* navigation.js owns the toggled class, so read it rather than fight it. */
		toggle.addEventListener( 'click', function() {
			window.setTimeout( sync, 0 );
		} );

		if ( close ) {
			close.addEventListener( 'click', closeMenu );
		}

		document.addEventListener( 'keydown', function( event ) {

			if ( ! document.body.classList.contains( 'ts-menu-open' ) ) {
				return;
			}

			if ( 'Escape' === event.key ) {
				closeMenu();
				return;
			}

			if ( 'Tab' !== event.key ) {
				return;
			}

			var items = focusable(),
				first = items[0],
				last  = items[ items.length - 1 ];

			if ( ! items.length ) {
				return;
			}

			if ( event.shiftKey && document.activeElement === first ) {
				event.preventDefault();
				last.focus();
			} else if ( ! event.shiftKey && document.activeElement === last ) {
				event.preventDefault();
				first.focus();
			}
		} );
	}

	/**
	 * Hold the sidebar in view as the article scrolls.
	 */
	function politeNewsStickySidebar() {

		var sidebar = document.querySelector( '.ts-sticky-sidebar #secondary' );

		if ( ! sidebar ) {
			return;
		}

		var container = sidebar.parentElement,
			gap = 20,
			offset = 0,
			ticking = false;

		function furniture() {

			var nav = document.querySelector( '.ts-sticky-nav.is-stuck' ),
				admin = document.getElementById( 'wpadminbar' ),
				top = gap;

			if ( nav ) {
				top += nav.offsetHeight;
			}

			if ( admin ) {
				top += admin.offsetHeight;
			}

			return top;
		}

		function position() {

			ticking = false;

			// Below the breakpoint the sidebar is a normal stacked block.
			if ( window.innerWidth < 992 ) {
				sidebar.style.transform = '';
				offset = 0;
				return;
			}

			var box = container.getBoundingClientRect(),
				height = sidebar.offsetHeight,
				view = window.innerHeight,
				topLine = furniture(),
				bottomLine = view - gap - height,
				room = box.height - height,
				wanted = box.top + offset;

			if ( room <= 0 ) {
				sidebar.style.transform = '';
				offset = 0;
				return;
			}

			if ( height + topLine + gap <= view ) {
				// It fits, so there is only one sensible resting place.
				wanted = topLine;
			} else {
				if ( wanted > topLine ) {
					wanted = topLine;
				}

				if ( wanted < bottomLine ) {
					wanted = bottomLine;
				}
			}

			offset = Math.min( Math.max( wanted - box.top, 0 ), room );
			sidebar.style.transform = offset ? 'translateY(' + Math.round( offset ) + 'px)' : '';
		}

		function schedule() {

			if ( ticking ) {
				return;
			}

			ticking = true;
			window.requestAnimationFrame( position );
		}

		position();
		window.addEventListener( 'scroll', schedule, { passive: true } );
		window.addEventListener( 'resize', schedule );
		window.addEventListener( 'load', schedule );
	}

	document.addEventListener( 'DOMContentLoaded', function() {
		politeNewsDarkMode();
		politeNewsTicker();
		politeNewsSearchToggle();
		politeNewsBackToTop();
		politeNewsSocialIcons();
		politeNewsStickyNav();
		politeNewsMobileSubmenus();
		politeNewsMobileMenu();
		politeNewsStickySidebar();
		politeNewsReveal();
	} );

}() );
