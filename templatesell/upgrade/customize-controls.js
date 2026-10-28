/**
 * Scripts within the customizer controls window.
 *
 * Contains handlers to make the Pro section links work as links.
 */
( function() {

	wp.customize.bind( 'ready', function() {

		// Detect when the pro section is expanded, or closed, so we can adjust
		// the actions accordingly. It is a link, not a section.
		wp.customize.section( 'polite_news_pro', function( section ) {

			section.expanded.bind( function( isExpanding ) {

				if ( isExpanding ) {
					section.collapse();
				}
			} );
		} );
	} );

}() );
