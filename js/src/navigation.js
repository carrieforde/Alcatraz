/**
 * Alcatraz Navigation JS object.
 *
 * This object contains several public methods related to the functionality of the menus.
 * The methods can be accessed anywhere on the front end using `Alcatraz.Nav.methodName()`.
 *
 * Alcatraz.Nav.initListToggle() is a utility function that can transform any nested <ul>
 * structure into a sliding accordion with toggle icons.
 *
 * Alcatraz.Nav.initSiteNavigation() is a method for initializing all site navigation.
 *
 * Alcatraz.Nav.initPrimaryNavigation() is a method for directly initializing the Primary nav.
 *
 * Alcatraz.Nav.initSubPageNavigation() is a method for directly initializing the Sub Page nav.
 *
 * Alcatraz.Nav.toggleMobileNav() is a direct method for opening and closing the mobile nav.
 *
 * @since  1.0.0
 */
var AlcatrazNavigation = ( function( $ ) {

	'use strict';

	var $body      = $( 'body' );
	var $window    = $( window );
	var toggleText = alcatraz_vars.menu_toggle || '';
	var closeText  = alcatraz_vars.menu_close  || '';

	/**
	 * Toggle the .focus class on nav items.
	 *
	 * @since  1.0.0
	 */
	var _togglePrimaryNavFocus = function() {
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
	};

	/**
	 * Do the sub level toggling on a list.
	 *
	 * @since  1.0.0
	 *
	 * @param  {object}  $item    The parent <li> jQuery object.
	 * @param  {object}  $list    The top level <ul> jQuery object.
	 * @param  {object}  options  The toggle options.
	 */
	var _listToggleSubLevel = function( $item, $list, options ) {
		var $toggle   = $item.find( '.sub-level-toggle' ).first();
		var $parent   = $toggle.parents( 'li' ).last();
		var $sub      = $item.find( 'ul' ).first();
		var autoClose = options.autoClose || false;
		var duration  = options.duration || 500;

		if ( autoClose ) {
			$list.find( 'ul' ).not( $parent.find( 'ul' ) ).slideUp( duration );
			$list.find( '.toggled' ).not( $parent.find( '.toggled' ) ).removeClass( 'toggled' );
		}

		$item.toggleClass( 'toggled' );
		$toggle.toggleClass( 'toggled' ).blur().next( 'ul' ).slideToggle( duration ).toggleClass( 'toggled' );

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
			}, duration );
		}
	};

	/**
	 * Initialize sub-level toggle functionality on a ul element.
	 *
	 * @since  1.0.0
	 *
	 * @param  {element|object}  el       The element or jQuery object to operate on.
	 * @param  {object}          options  The toggle options.
	 */
	var initListToggle = function( el, options ) {
		return $( el ).each( function() {
			var $list          = $( this );
			var $subList       = $list.find( 'li' ).has( 'ul' );
			var args           = options || {};
			var safeToggleText = Alcatraz.Utils.escapeHtml( toggleText );

			var toggle = '<a class="sub-level-toggle">' + safeToggleText +
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

				var $item = $( this ).parent( 'li' );

				_listToggleSubLevel( $item, $list, args );
			});
		});
	};

	/**
	 * Set up both the Primary and Sub Page navigation.
	 *
	 * @since  1.0.0
	 */
	var initSiteNavigation = function() {
		initPrimaryNavigation();
		initSubPageNavigation();
	};

	/**
	 * Set up the Primary Navigation expand/contract functionality.
	 *
	 * @since  1.0.0
	 */
	var initPrimaryNavigation = function() {
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

		var $links    = $menu.find( 'a' );
		var $subMenus = $menu.find( 'ul' );

		$menu.attr( 'aria-expanded', 'false' );

		if ( ! $menu.hasClass( 'nav-menu' ) ) {
			$menu.addClass( 'nav-menu' );
		}

		// Set up swipe-to-open support for the mobile nav.
		if ( $.mobile ) {
			if ( $body.hasClass( 'mobile-nav-style-slide-left' ) ||
				 $body.hasClass( 'mobile-nav-style-slide-right' ) ) {
				$.event.special.swipe.horizontalDistanceThreshold = 15;
				$( '#mobile-nav-left-swipe-zone, #mobile-nav-right-swipe-zone, .menu-overlay' ).on( 'swipeleft swiperight', function() {
					$window.trigger( 'aczToggleMobileNav' );
				});
			}
		}

		// Set up the top level menu toggle.
		$toggle.add( '.menu-overlay' ).on( 'click', function() {
			$window.trigger( 'aczToggleMobileNav' );
		});
		$window.on( 'aczToggleMobileNav', toggleMobileNav );

		var toggleOptions = {
			autoClose: true,
		};

		// Set up the sub menu dropdown toggles.
		initListToggle( $menu, toggleOptions );

		// Build the inner menu toggle.
		var $innerMenuToggle = $( '<div class="inner-menu-toggle"></div>' );

		// Use jQuery's $.text() method to escape HTML entities.
		$innerMenuToggle.text( closeText ).append(
			'<span class="inner-menu-toggle-span span-1"></span>' +
			'<span class="inner-menu-toggle-span span-2"></span>' +
			'<span class="inner-menu-toggle-span span-3"></span>'
		);

		// Inject the inner menu toggles.
		$menu.before( $innerMenuToggle );

		// Close the main nav when the inner menu toggle is clicked.
		$( '.inner-menu-toggle' ).on( 'click', function() {
			$window.trigger( 'aczToggleMobileNav' );
		});

		// Set menu items with submenus to aria-haspopup="true".
		$subMenus.each( function() {
			$( this ).parent().attr( 'aria-haspopup', 'true' );
		});

		// Each time a menu link is focused or blurred, toggle focus.
		$links.each( function() {
			$( this ).on( 'focus blur', _togglePrimaryNavFocus );
		});
	};

	/**
	 * Set up the Sub Page Navigation expand/contract functionality.
	 *
	 * @since  1.0.0
	 */
	var initSubPageNavigation = function() {
		var $subNav = $( '.alcatraz-sub-page-nav > ul' );

		if ( ! $subNav.length ) {
			return;
		}

		var toggleOptions = {
			autoClose: false,
		};

		initListToggle( $subNav, toggleOptions );
	};

	/**
	 * Do the primary nav top level mobile nav toggle.
	 *
	 * @since  1.0.0
	 */
	var toggleMobileNav = function() {
		var $container = $( '#site-navigation' );
		var $toggle    = $container.find( '.menu-toggle' );
		var $menu      = $container.find( '#primary-menu' );

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
	};

	/**
	 * Expose public methods.
	 */
	return {
		initListToggle        : initListToggle,
		initSiteNavigation    : initSiteNavigation,
		initPrimaryNavigation : initPrimaryNavigation,
		initSubPageNavigation : initSubPageNavigation,
		toggleMobileNav       : toggleMobileNav,
	};

})( jQuery );