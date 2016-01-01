/**
 * Alcatraz JS object.
 *
 * This file contains the main Alcatraz JS object, which serves as a wrapper and namespace under
 * which all of our other component objects can be accessed.
 *
 * Alcatraz.Utilities is an object with utility methods that are useful.
 *
 * Alcatraz.Nav is an object with all methods related to the site navigation.
 *
 * @since  1.0.0
 */

var Alcatraz = ( function( $ ) {

	var Utilities = AlcatrazUtilities || false;
	var Nav = AlcatrazNavigation || false;

	return {
		Utilities : Utilities,
		Nav : Nav,
	};

})( jQuery );