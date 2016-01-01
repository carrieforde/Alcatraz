/**
 * Initialization JS.
 *
 * This file initializes all theme functionality including all things that need to fire when
 * the DOM is ready or when the page is fully loaded.
 *
 * @since  1.0.0
 */

( function( $ ) {

	/**
	 * Initialize all the things.
	 *
	 * @since  1.0.0
	 */
	function alcatrazInit() {
		Alcatraz.Nav.initSiteNavigation();
	}

	// When the DOM is ready, initialize all the things.
	$( document ).ready( alcatrazInit );

	// Reset the primary nav when a Customizer partial refresh happens.
	$( document ).on( 'customize-preview-menu-refreshed', function() {
		Alcatraz.Nav.initPrimaryNavigation();
	});

})( jQuery );
