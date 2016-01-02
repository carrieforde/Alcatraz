/**
 * AlcatrazUtilities JS object.
 *
 * This object contains a number of useful public methods. The methods can be accessed anywhere
 * on the front end using `Alcatraz.Utilities.methodName()`.
 *
 * @since  1.0.0
 */

var AlcatrazUtilities = ( function( $ ) {

	var htmlEntityMap = {
		"&": "&amp;",
		"<": "&lt;",
		">": "&gt;",
		'"': '&quot;',
		"'": '&#39;',
		"/": '&#x2F;'
	};

	/**
	 * Escape the HTML entities in a string by replacing them with their character codes.
	 *
	 * @param   {string}  string  The string to escape.
	 * @return  {string}          The escaped string.
	 *
	 * @since  1.0.0
	 */
	function escapeHtml( string ) {

		return String( string ).replace( /[&<>"'\/]/g, function ( s ) {
			return htmlEntityMap[s];
		});
	}

	/**
	 * Expose public methods.
	 */
	return {
		escapeHtml : escapeHtml,
	};

})( jQuery );