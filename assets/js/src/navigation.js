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