/**
 * Scripts within the customizer controls window.
 *
 * Adds a reset button to every theme control that has a default value, and
 * shows the matching editor picks source controls as soon as the Content
 * Source select changes, without waiting for the preview to refresh.
 */
( function( api, $ ) {

	var settings = ( 'undefined' !== typeof politeNewsControls ) ? politeNewsControls : { defaults: {}, resetLabel: 'Reset to default' };

	/**
	 * Compare a live value against its stored default.
	 *
	 * @param {*} value   Current value.
	 * @param {*} initial Default value.
	 * @return {boolean} True when the value still matches the default.
	 */
	function isDefault( value, initial ) {

		if ( null === value || 'undefined' === typeof value ) {
			return true;
		}

		return String( value ) === String( initial );
	}

	/**
	 * Place a reset button on a control that has a default.
	 *
	 * @param {wp.customize.Control} control Control instance.
	 */
	function addResetButton( control ) {

		var initial = settings.defaults[ control.id ],
			setting = control.setting,
			$title,
			$button;

		if ( 'undefined' === typeof initial || ! setting ) {
			return;
		}

		$title = control.container.find( '.customize-control-title' ).first();

		if ( ! $title.length ) {
			return;
		}

		$button = $( '<button type="button" class="ts-reset-control"><span class="screen-reader-text"></span></button>' );
		$button.attr( 'title', settings.resetLabel );
		$button.find( '.screen-reader-text' ).text( settings.resetLabel );

		// Sits beside the control, never inside its label, so the markup stays valid.
		control.container.addClass( 'ts-has-reset' ).append( $button );

		function refresh() {
			$button.toggleClass( 'is-hidden', isDefault( setting.get(), initial ) );
		}

		$button.on( 'click', function( event ) {
			event.preventDefault();
			setting.set( initial );
		} );

		setting.bind( refresh );
		refresh();
	}

	api.bind( 'ready', function() {

		api.control.each( addResetButton );
		api.control.bind( 'add', addResetButton );

		api( 'polite_news_options[polite-news-boxes-content-type]', function( setting ) {

			function toggleControls( source ) {

				var isPosts = 'posts' === source;

				[
					'polite_news_options[polite-news-boxes-category]',
					'polite_news_options[polite-news-boxes-number]'
				].forEach( function( id ) {
					api.control( id, function( control ) {
						control.active.set( ! isPosts );
					} );
				} );

				[ 1, 2, 3, 4 ].forEach( function( pick ) {
					api.control( 'polite_news_options[polite-news-boxes-post-' + pick + ']', function( control ) {
						control.active.set( isPosts );
					} );
				} );
			}

			toggleControls( setting.get() );
			setting.bind( toggleControls );
		} );
	} );

}( wp.customize, jQuery ) );
