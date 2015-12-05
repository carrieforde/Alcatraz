/**
 * Navigation JS.
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

	$toggle = $container.find( '.menu-toggle' );
	if ( 'undefined' === typeof $toggle ) {
		return;
	}

	$menu = $container.find( '#primary-menu' );
	if ( 'undefined' === typeof $menu ) {
		$toggle.css( 'display', 'none' );
		return;
	}

	$menu.attr( 'aria-expanded', 'false' );
	if ( ! $menu.hasClass( 'nav-menu' ) ) {
		$menu.addClass( 'nav-menu' );
	}

	$toggle.on( 'click', function() {
		if ( $container.hasClass( 'toggled' ) ) {
			$container.removeClass( 'toggled' );
			$toggle.attr( 'aria-expanded', 'false' );
			$menu.attr( 'aria-expanded', 'false' );
		} else {
			$container.addClass( 'toggled' );
			$toggle.attr( 'aria-expanded', 'true' );
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

	/**
	 * Set up the mobile nav sub menu toggles.
	 */
	var closedIcon = '+';
	var openIcon = '-';

	// Insert the toggles into the nav where appropriate.
	$menu.find( '.menu-item-has-children.current-menu-parent > a' ).after( '<a class="sub-menu-toggle" href="#">' + closedIcon + '</a>' );
	$menu.find( '.menu-item-has-children:not( .current-menu-parent ) > a' ).after( '<a class="sub-menu-toggle" href="#">' + openIcon + '</a>' );

	// Toggle the expanded state of sub-menus when the toggles are clicked.
	$( '.sub-menu-toggle' ).on( 'click', function( e ) {

		e.preventDefault();

		var $this = $( this );

		$this.blur().next( '.sub-menu' ).slideToggle().toggleClass( 'toggled' );

		// Change the icon to indicate open/closed.
		if ( $this.text().indexOf( closedIcon ) !== -1 ) {
			$this.text( openIcon );
		} else if ( $this.text().indexOf( openIcon ) !== -1 ) {
			$this.text( closedIcon );
		}
	});
} )( jQuery );
