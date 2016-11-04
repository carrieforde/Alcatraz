/**
 * Patterns
 *
 * Handle Foo things for the foo theme.
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
			patternsTemplate: $( '.patterns-template' ),
			patternDocToggle: $( '.pattern-doc-toggle' ),
			patternDocInfo: $( '.pattern-doc-info' ),
		};
	};

	// Combine all events.
	app.bindEvents = function() {

		// When we click the doc toggle, open the doc info panel.
		app.$c.patternDocToggle.on( 'click', app.openPatternDocInfo );
	};

	// Do we meet the requirements?
	app.meetsRequirements = function() {
		return app.$c.patternsTemplate.length;
	};

	// Do foo function.
	app.openPatternDocInfo = function() {

		// Open that Doc info panel!
		$( this ).parent().siblings( '.pattern-doc-info' ).slideToggle( 'slow' );
	};

	// Engage!
	$( app.init );

})( window, jQuery, window.AlcatrazPattern );
