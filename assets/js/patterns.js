/**
 * Patterns
 *
 * Handles interactions for the Alcatraz Pattern Library.
 */
window.AlcatrazPattern = {};

( function( window, $, app ) {

	// Constructor.
	app.init = function() {
		app.cache();

		if ( app.meetsRequirements() ) {
			app.bindEvents();
		}
	};

	// Cache elements.
	app.cache = function() {
		app.$c = {
			window: $( window ),
			patternDocToggle: $( '.pattern-doc__toggle' ),
			patternDocInfo: $( '.pattern-doc__info' ),
		};
	};

	// Combine all events.
	app.bindEvents = function() {

		// When we click the doc toggle, open the doc info panel.
		app.$c.patternDocToggle.on( 'click', app.openPatternDocInfo );
	};

	// Do we meet the requirements?
	app.meetsRequirements = function() {
		return app.$c.patternDocToggle.length;
	};

	// Do foo function.
	app.openPatternDocInfo = function() {

		// Toggle a class onto the button.
		$( this ).toggleClass( 'is-toggled' );

		// Open that Doc info panel!
		$( this ).parent().siblings( '.pattern-doc__info' ).slideToggle( 350 );
	};

	// Engage!
	$( app.init );

})( window, jQuery, window.AlcatrazPattern );
