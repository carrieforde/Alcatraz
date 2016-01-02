/**
 * Alcatraz Navigation JS object.
 *
 * This object contains several public methods related to the functionality of the menus.
 * The methods can be accessed anywhere on the front end using `Alcatraz.Nav.methodName()`.
 *
 * Alcatraz.Nav.toggleMobileNav() is a direct method for opening and closing the mobile nav.
 *
 * Alcatraz.Nav.toggleListItem() is a direct method for opening or closing an <li> element in
 * a list toggle.
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
 * Alcatraz.Nav.resetNavEventListeners() is a method for setting and resetting the navigation
 * event listeners.
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
	 * Toggle list item focus when using keyboard navigation.
	 *
	 * @since  1.0.0
	 *
	 * @param  {object}  event  The focus or blur event.
	 */
	var _toggleListFocus = function( event ) {
		var $this = $( this );
		var $item = $this.parent( 'li' );

		if ( 'focus' === event.type ) {
			$item.addClass( 'focus' );

			if ( ! $item.hasClass( 'toggled' ) ) {
				var args  = {
					autoClose : false,
					duration  : 300,
				};
				var data = {
					item : $item,
					args : args,
				};

				$( window ).trigger( 'toggleListItem.alcatraz', data );
			}
		}

		if ( 'blur' === event.type ) {
			$item.removeClass( 'focus' );
		}
	};

	/**
	 * Trigger the toggleListItem function when the toggleListItem event fires.
	 *
	 * @since  1.0.0
	 *
	 * @param  {object}  event  The toggleListItem event.
	 * @param  {object}  data   The event data.
	 */
	var _toggleListItem = function( event, data ) {
		var item = data.item || {};
		var args = data.args || {};

		toggleListItem( item, args );
	};


	/**
	 * Toggle the mobile Primary Navigation.
	 *
	 * @since    1.0.0
	 *
	 * @returns  {object}  The original this.
	 */
	var toggleMobileNav = function() {
		var $container = $( '#site-navigation' );
		var $menu      = $container.find( '#primary-menu' );

		if ( $container.hasClass( 'toggled' ) ) {
			$window.trigger( 'closeMobileNav.alcatraz' );
			$container.removeClass( 'toggled' );
			$menu.attr( 'aria-expanded', 'false' );
		} else {
			$window.trigger( 'openMobileNav.alcatraz' );
			$container.addClass( 'toggled' );
			$menu.attr( 'aria-expanded', 'true' );
		}

		return this;
	};

	/**
	 * Toggle a list item.
	 *
	 * @since    1.0.0
	 *
	 * @param    {object}  $item    The list item jQuery object.
	 * @param    {object}  options  The toggle options.
	 *
	 * @returns  {object}           The original this.
	 */
	var toggleListItem = function( $item, options ) {
		var $list     = $item.parents( 'ul' ).last();
		var $toggle   = $item.find( '.sub-level-toggle' ).first();
		var $parent   = $toggle.parents( 'li' ).last();
		var $sub      = $item.find( 'ul' ).first();
		var autoClose = options.autoClose || false;
		var duration  = options.duration || 500;

		if ( autoClose ) {
			$list.find( 'ul' ).not( $parent.find( 'ul' ) ).slideUp( duration );
		}

		$item.toggleClass( 'toggled' );
		$toggle.toggleClass( 'toggled' ).blur().next( 'ul' ).slideToggle( duration ).toggleClass( 'toggled' );

		// If we're toggling a menu item on the primary nav and the menu item has children,
		// detect whether they may be overflowing off the screen and add a class if they are.
		if ( $list.is( '#primary-menu' ) && $item.hasClass( 'menu-item-has-children' ) && $item.hasClass( 'toggled' ) ) {
			var rightEdge   = $sub.width() + $sub.offset().left;
			var screenWidth = $window.width();

			if ( rightEdge > screenWidth ) {
				$item.addClass( 'reverse-expand' );
			}
		} else {

			// Delay removing the class so the slideup animation can finish.
			setTimeout( function() {
				$item.removeClass( 'reverse-expand' );
			}, duration );
		}

		// Remove the 'toggled' class from lists and list items not in the current hierarchy.
		$list.find( '.toggled' ).not( $parent ).not( $parent.find( '.toggled' ) ).removeClass( 'toggled' );

		return this;
	};

	/**
	 * Set up list toggle functionality on a <ul> element with child <ul> elements.
	 *
	 * @since    1.0.0
	 *
	 * @param    {object}  el       A jQuery object containing the ul elements.
	 * @param    {object}  options  The toggle options.
	 *
	 * @returns  {object}           A jQuery object containing the ul elements.
	 */
	var initListToggle = function( el, options ) {
		var args = options || {};

		return $( el ).each( function() {
			var $list          = $( this );
			var $subList       = $list.find( 'li' ).has( 'ul' );
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
				var data  = {
					item: $item,
					args: args,
				};

				$window.trigger( 'toggleListItem.alcatraz', data );
			});
		});
	};

	/**
	 * Set up both the Primary and Sub Page navigation.
	 *
	 * @since    1.0.0
	 *
	 * @returns  {object}  The original this.
	 */
	var initSiteNavigation = function() {
		initPrimaryNavigation();
		initSubPageNavigation();
		resetNavEventListeners();

		return this;
	};

	/**
	 * Set up the Primary Navigation expand/contract functionality.
	 *
	 * @since    1.0.0
	 *
 	 * @returns  {object}  The original this.
	 */
	var initPrimaryNavigation = function() {
		var $container = $( '#site-navigation' );

		if ( ! $container ) {
			return false;
		}

		var $toggle = $container.find( '.menu-toggle' );

		if ( 'undefined' === typeof $toggle ) {
			return false;
		}

		var $menu = $container.find( '#primary-menu' );

		if ( 'undefined' === typeof $menu ) {
			$toggle.css( 'display', 'none' );
			return false;
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
				$( '#mobile-nav-left-swipe-zone, #mobile-nav-right-swipe-zone, .main-navigation .menu-overlay' ).on( 'swipeleft swiperight', function() {
					$window.trigger( 'toggleMobileNav.alcatraz' );
				});
			}
		}

		// Set up the mobile nav toggle.
		$toggle.add( '.main-navigation .menu-overlay' ).on( 'click', function() {
			$window.trigger( 'toggleMobileNav.alcatraz' );
		});

		// Set up the sub menu dropdown toggles.
		var toggleOptions = {
			autoClose: true,
			duration: 300,
		};
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
			$window.trigger( 'toggleMobileNav.alcatraz' );
		});

		// Set menu items with sub menus to aria-haspopup="true".
		$subMenus.each( function() {
			$( this ).parent().attr( 'aria-haspopup', 'true' );
		});

		// Each time a menu link is focused or blurred, toggle focus.
		$links.each( function() {
			$( this ).on( 'focus blur', _toggleListFocus );
		});

		return this;
	};

	/**
	 * Set up the Sub Page Navigation expand/contract functionality.
	 *
	 * @since    1.0.0
	 *
	 * @returns  {object}  The original this.
	 */
	var initSubPageNavigation = function() {
		var $subNav = $( '.alcatraz-sub-page-nav > ul' );

		if ( ! $subNav.length ) {
			return false;
		}

		var toggleOptions = {
			autoClose: false,
			duration: 300,
		};

		initListToggle( $subNav, toggleOptions );

		// Each time a link is focused or blurred, toggle our 'focus' class.
		$subNav.find( 'a' ).each( function() {
			$( this ).on( 'focus blur', _toggleListFocus );
		});

		return this;
	};

	/**
	 * Set up the navigation event listeners.
	 *
	 * @since    1.0.0
	 *
	 * @returns  {object}  The original this.
	 */
	var resetNavEventListeners = function() {

		// Mobile nav toggle.
		$window.off( 'toggleMobileNav.alcatraz', toggleMobileNav );
		$window.on( 'toggleMobileNav.alcatraz', toggleMobileNav );

		// List item toggle.
		$window.off( 'toggleListItem.alcatraz', _toggleListItem );
		$window.on( 'toggleListItem.alcatraz', _toggleListItem );

		return this;
	};

	/**
	 * Expose public methods.
	 */
	return {
		toggleMobileNav        : toggleMobileNav,
		toggleListItem         : toggleListItem,
		initListToggle         : initListToggle,
		initSiteNavigation     : initSiteNavigation,
		initPrimaryNavigation  : initPrimaryNavigation,
		initSubPageNavigation  : initSubPageNavigation,
		resetNavEventListeners : resetNavEventListeners,
	};

})( jQuery );