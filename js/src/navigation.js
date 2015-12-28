/**
 * Navigation JS.
 *
 * Handles toggling the primary navigation menu on small screens, toggling focus when
 * tabbing through sub menus, and handling the sub menu expand/contract functionality.
 */
( function( $ ) {

	var $body      = $( 'body' );
	var $window    = $( window );
	var toggleText = alcatraz_vars.menu_toggle || '';
	var closeText  = alcatraz_vars.menu_close  || '';

	/**
	 * Initialize sub-level toggle functionality on a ul element.
	 *
	 * @since  1.0.0
	 *
	 * @param  {object}  options  The toggle options.
	 */
	$.fn.aczSetupListToggle = function( options ) {
		var $list     = $( this );
		var $subList  = $list.find( 'li' ).has( 'ul' );
		var args      = options || {};
		var hoverOpen = args.hoverOpen || false;

		var toggle = '<a class="sub-level-toggle">' + toggleText +
		                 '<span class="sub-level-toggle-span span-1"></span>' +
		                 '<span class="sub-level-toggle-span span-2"></span>' +
		                 '<span class="sub-level-toggle-span span-3"></span>' +
		             '</a>';

		// Loop over each item that has a sub level and inject the toggle.
		$subList.each( function() {
			$( this ).find( 'a' ).first().after( toggle );
		});

		// Toggle the expanded state of sub levels when the toggles are clicked.
		$list.find( '.sub-level-toggle' ).on( 'click', function( e ) {
			e.preventDefault();

			$( this ).parent( 'li' ).aczListSubLevelToggle( $list, args );
		});
	};

	/**
	 * Do the sub level toggling.
	 *
	 * @since  1.0.0
	 *
	 * @param  {jQuery obj}  $list    The ul element.
	 * @param  {object}      options  The toggle options.
	 */
	$.fn.aczListSubLevelToggle = function( $list, options ) {
		var $item     = $( this );
		var $toggle   = $item.find( '.sub-level-toggle' ).first();
		var $parent   = $toggle.parents( 'li' ).last();
		var $sub      = $item.find( 'ul' ).first();
		var autoClose = options.autoClose || false;

		if ( autoClose ) {
			$list.find( 'ul' ).not( $parent.find( 'ul' ) ).slideUp();
			$list.find( '.toggled' ).not( $parent.find( '.toggled' ) ).removeClass( 'toggled' );
		}

		$item.toggleClass( 'toggled' );
		$toggle.toggleClass( 'toggled' ).blur().next( 'ul' ).slideToggle().toggleClass( 'toggled' );

		// If we're setting up the primary nav and the menu item has children,
		// detect whether they may be overflowing off the screen and add a class if they are.
		if ( $list.is( '#primary-menu' ) && $item.hasClass( 'menu-item-has-children' ) && $item.hasClass( 'toggled' ) ) {
			var rightEdge   = $sub.width() + $sub.offset().left;
			var screenWidth = $window.width();

			if ( rightEdge > screenWidth ) {
				$item.addClass( 'reverse-expand' );
			}
		} else {

			// Delay removing the class just a bit so the slideup animation can finish.
			setTimeout( function() {
				$item.removeClass( 'reverse-expand' );
			}, 500 );
		}
	};

	/**
	 * Toggle the .focus class on nav items.
	 *
	 * @since  1.0.0
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
	 *
	 * @since  1.0.0
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
	 *
	 * @since  1.0.0
	 */
	function aczSetupPrimaryNavigation() {

		var $container = $( '#site-navigation' );
		if ( ! $container ) {
			return;
		}

		var $toggle = $container.find( '.menu-toggle' );
		if ( 'undefined' === typeof $toggle ) {
			return;
		}

		var $menu = $container.find( '#primary-menu' );
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
		$toggle.add( '.menu-overlay' ).on( 'click', function() {
			$window.trigger( 'aczToggleMobileNav' );
		});
		$window.on( 'aczToggleMobileNav', aczToggleMobileNav );

		/**
		 * Set up the sub menu dropdown toggles.
		 */
		var toggleOptions = {
			autoClose: true,
			hoverOpen: true,
		};
		$menu.aczSetupListToggle( toggleOptions );

		var innerMenuToggle = '<div class="inner-menu-toggle">' + closeText +
		                          '<span class="inner-menu-toggle-span span-1"></span>' +
		                          '<span class="inner-menu-toggle-span span-2"></span>' +
		                          '<span class="inner-menu-toggle-span span-3"></span>' +
		                      '</div>';

		$menu.before( innerMenuToggle );

		$( '.inner-menu-toggle' ).on( 'click', function() {
			$window.trigger( 'aczToggleMobileNav' );
		});

		// Get all the link elements within the menu.
		var $links    = $menu.find( 'a' );
		var $subMenus = $menu.find( 'ul' );

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