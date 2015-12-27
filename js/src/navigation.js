/**
 * Navigation JS.
 *
 * Handles toggling the primary navigation menu on small screens, toggling focus when
 * tabbing through sub menus, and handling the sub menu expand/contract functionality.
 */
( function( $ ) {

	var $body   = $( 'body' );
	var $window = $( window );

	/**
	 * Toggle the .focus class on nav items.
	 */
	function aczToggleNavFocus() {
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
	 * Do the primary nav top level mobile nav toggle.
	 */
	function aczToggleMobileNav() {
		$container = $( '#site-navigation' );
		$toggle    = $container.find( '.menu-toggle' );
		$menu      = $container.find( '#primary-menu' );

		if ( $container.hasClass( 'toggled' ) ) {
			$window.trigger( 'aczCloseMobileNav' );
			$container.removeClass( 'toggled' );
			$toggle.attr( 'aria-expanded', 'false' );
			$menu.attr( 'aria-expanded', 'false' );
		} else {
			$window.trigger( 'aczOpenMobileNav' );
			$container.addClass( 'toggled' );
			$toggle.attr( 'aria-expanded', 'true' );
			$menu.attr( 'aria-expanded', 'true' );
		}
	}

	/**
	 * Set up the Primary Navigation expand/contract functionality.
	 */
	function aczSetupPrimaryNavigation() {
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

		/**
		 * Set up swipe-to-open support for the mobile nav.
		 */
		if ( $.mobile ) {
			if ( $body.hasClass( 'mobile-nav-style-slide-left' ) ||
				 $body.hasClass( 'mobile-nav-style-slide-right' ) ) {
				$.event.special.swipe.horizontalDistanceThreshold = 15;
				$( '#mobile-nav-left-swipe-zone, #mobile-nav-right-swipe-zone, .menu-overlay' ).on( 'swipeleft swiperight', function() {
					$window.trigger( 'aczToggleMobileNav' );
				});
			}
		}

		/**
		 * Set up the top level menu toggle.
		 */
		$toggle.add( '.inner-menu-toggle, .menu-overlay' ).on( 'click', function() {
			$window.trigger( 'aczToggleMobileNav' );
		});
		$window.on( 'aczToggleMobileNav', aczToggleMobileNav );

		/**
		 * Set up the sub menu dropdown toggle.
		 */
		$menu.find( '.menu-item' ).hover( function() {
			$( this ).addClass( 'hovered' );

			// If the menu item has children, detect whether they may be overflowing
			// off the screen and add a class if they are.
			if ( $( this ).hasClass( 'menu-item-has-children' ) ) {
				var $sub        = $( this ).find( '.sub-menu' ).first();
				var rightEdge   = $sub.width() + $sub.offset().left;
				var screenWidth = $window.width();

				if ( rightEdge > screenWidth ) {
					$( this ).addClass( 'reverse-expand' );
				}
			}
		}, function() {
			$( this ).removeClass( 'hovered reverse-expand' );
		});

		/**
		 * Set up the mobile nav sub menu toggles.
		 */
		$menu.before( '<div class="inner-menu-toggle"></div>' );
		$menu.find( 'li.menu-item-has-children > a' ).after( '<a class="sub-menu-toggle" href="#">Toggle</a>' );

		// Toggle the expanded state of sub-menus when the toggles are clicked.
		$( '.sub-menu-toggle' ).on( 'click', function( e ) {
			e.preventDefault();

			var $this = $( this );

			$this.toggleClass( 'toggled' );
			$this.blur().next( '.sub-menu' ).slideToggle().toggleClass( 'toggled' );
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
			$( this ).on( 'focus blur', aczToggleNavFocus );
		});
	}

	function aczSidebarNav() {

		//Sidebar nav child page toggle.
		var $parent = $( '.sidebar-nav .page_item' );
		var $children = $( '.sidebar-nav .children' );
		var $pageChild = $( '.page_item_has_children' );

		$pageChild.append( '<a class="sub-menu-toggle" href="#"></a>' );

		$children.hide();

		$( '.current_page_item').parent().show();
		$( '.current_page_ancestor').parent().show();

		if ( $( '.current_page_item' ).is(':visible') ) {
			var $icon = $( '.sub-menu-toggle' );
			$( '.current_page_ancestor' ).find( $icon ).addClass( 'toggled' );
			$( '.current_page_item' ).find( $icon ).removeClass( 'toggled' );
		}

		$( '.sidebar-nav .sub-menu-toggle' ).on( 'click', function(e) {
			e.preventDefault();
			$( this ).parent().children( '.children' ).slideToggle();
			$( this ).toggleClass( 'toggled' );
		});

	}

	/**
	 * Start the party.
	 */
	$( document ).ready( function() {
		aczSetupPrimaryNavigation();
		aczSidebarNav();
	});

	/**
	 * Restart the party when a Customizer partial refresh happens.
	 */
	$( document ).on( 'customize-preview-menu-refreshed', function() {
		aczSetupPrimaryNavigation();
	});

})( jQuery );