/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function( $ ) {
	var $container, $button, $menu, $links, $subMenus;

	$container = $( '#site-navigation' );
	if ( ! $container ) {
		return;
	}

	$button = $container.find( '.menu-toggle' );
	if ( 'undefined' === typeof $button ) {
		return;
	}

	$menu = $container.find( 'ul' ).first();

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof $menu ) {
		$button.style.display = 'none';
		return;
	}

	$menu.attr( 'aria-expanded', 'false' );
	if ( ! $menu.hasClass( 'nav-menu' ) ) {
		$menu.addClass( 'nav-menu' );
	}

	$button.on( 'click', function() {
		if ( $container.hasClass( 'toggled' ) ) {
			$container.removeClass( 'toggled' );
			$button.attr( 'aria-expanded', 'false' );
			$menu.attr( 'aria-expanded', 'false' );
		} else {
			$container.addClass( 'toggled' );
			$button.attr( 'aria-expanded', 'true' );
			$menu.attr( 'aria-expanded', 'true' );
		}
	});

	// Get all the link elements within the menu.
	$links    = $menu.find( 'a' );
	$subMenus = $menu.find( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	$subMenus.each( function() {
		$( this ).parent().attr( 'aria-haspopup', 'true' );
	});

	// Each time a menu link is focused or blurred, toggle focus.
	$links.each( function() {
		$( this ).on( 'focus blur', toggleFocus );
	});

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )( jQuery );
