/*! alcatraz theme JS - This file is built with Grunt and should not be edited directly */

/**
 * skip-link-focus-fix.js
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

/**
* file: navigation.js
*
* Handle navigation interaction.
*/
window.alcatrazNavigation = {};
( function( window, $, app ) {

	app.$var = {
		navHeight: 0,
	}

	// Constructor.
	app.init = function() {
		app.cache();
		if ( app.meetsRequirements() ) {
			app.bindEvents();
		}
	};

	// Cache all the things.
	app.cache = function() {
		app.$c = {
			window: $( window ),
			siteNavigation: $( '#site-navigation' ),
			mobileMenuToggle: $( '.mobile-menu-toggle' ),
			mainNavigationMenu: $( '.main-navigation__menu' ),
			primaryMenu: $( '#primary-menu' )
		};
	};

	// Combine all events.
	app.bindEvents = function() {
		
		app.$c.window.on( 'load', app.loadMenu );
		app.$c.mobileMenuToggle.on( 'click', app.openMenu );
	};

	// Do we meet the requirements?
	app.meetsRequirements = function() {
		return app.$c.primaryMenu.length;
	};

	// Some function.
	app.openMenu = function() {
		
		$( this ).toggleClass( 'is-toggled' );

		if ( app.$c.primaryMenu.hasClass( 'is-hidden' ) ) {
			app.$c.primaryMenu.removeClass( 'is-hidden' );
			app.$c.primaryMenu.addClass( 'is-visible' );

			app.$c.primaryMenu.animate({
				height: app.$var.navHeight + 'px'
			}, 350 );
		} else {
			app.$c.primaryMenu.removeClass( 'is-visible' );
			app.$c.primaryMenu.addClass( 'is-hidden' );

			app.$c.primaryMenu.animate({
				height: 0
			}, 350 );
		}
	};

	app.loadMenu = function() {

		app.$var.navHeight = app.$c.mainNavigationMenu.outerHeight();

		console.log( app.$var.navHeight );

		app.$c.primaryMenu.addClass( 'is-hidden' );

		return app.$var.navHeight;
	}

	// Engage!
	$( app.init );

})( window, jQuery, window.alcatrazNavigation );