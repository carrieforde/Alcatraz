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

	app.$config = {
		navWidth: 400
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
			body: $( 'body' ),
			siteNavigation: $( '#site-navigation' ),
			mobileMenuToggle: $( '.mobile-menu-toggle' ),
			menuScreen: $( '.menu-screen' ),
			hasSubMenu: $( '.menu-item-has-children' )
		};
	};

	// Combine all events.
	app.bindEvents = function() {
	
		app.$c.mobileMenuToggle.on( 'click', app.openMenu );
		app.$c.menuScreen.on( 'click', app.openMenu );

		app.$c.window.on( 'load', app.addSubMenuToggle );

		// When clicking the mobile nav toggle or nav toggle, fire a nav toggle function.
		$( document.body ).on( 'click', '.sub-menu-toggle', app.toggleSubMenu );
	};

	// Do we meet the requirements?
	app.meetsRequirements = function() {
		return app.$c.siteNavigation.length;
	};

	/**
	 * Open and close the main navigation menu on mobile devices.
	 */
	app.openMenu = function() {

		if ( ! app.$c.body.hasClass( 'mobile-menu-is-visible' ) ) {
			app.$c.body.addClass( 'mobile-menu-is-visible' );

			app.$c.siteNavigation.animate({
				width: app.$config.navWidth + 'px'
			}, 350 );
		} else {
			app.$c.body.removeClass( 'mobile-menu-is-visible' );

			app.$c.siteNavigation.animate({
				width: 0
			}, 350 );
		}
	};

	/**
	 * Inject sub-menu toggles into the DOM.
	 */
	app.addSubMenuToggle = function() {

		var $toggle = '<button class="button sub-menu-toggle" type="button"><span class="bar bar-1"></span><span class="bar bar-2"></span><span class="screen-reader-text">Open</span></button>';

		app.$c.hasSubMenu.append( $toggle );
	};

	/**
	 * Use the sub-menu toggles to open and close the sub-menus.
	 */
	app.toggleSubMenu = function() {

		$( this ).siblings( '.sub-menu' ).slideToggle();
		$( this ).parent( '.menu-item-has-children' ).toggleClass( 'is-toggled' );
	}

	// Engage!
	$( app.init );

})( window, jQuery, window.alcatrazNavigation );