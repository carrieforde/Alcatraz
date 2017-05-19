/*! alcatraz theme JS - This file is built with Grunt and should not be edited directly */

/*! jQuery Mobile v1.4.5 | Copyright 2010, 2014 jQuery Foundation, Inc. | jquery.org/license */

(function(e,t,n){typeof define=="function"&&define.amd?define(["jquery"],function(r){return n(r,e,t),r.mobile}):n(e.jQuery,e,t)})(this,document,function(e,t,n,r){(function(e,n){e.extend(e.support,{orientation:"orientation"in t&&"onorientationchange"in t})})(e),function(e){e.event.special.throttledresize={setup:function(){e(this).bind("resize",n)},teardown:function(){e(this).unbind("resize",n)}};var t=250,n=function(){s=(new Date).getTime(),o=s-r,o>=t?(r=s,e(this).trigger("throttledresize")):(i&&clearTimeout(i),i=setTimeout(n,t-o))},r=0,i,s,o}(e),function(e,t){function p(){var e=s();e!==o&&(o=e,r.trigger(i))}var r=e(t),i="orientationchange",s,o,u,a,f={0:!0,180:!0},l,c,h;if(e.support.orientation){l=t.innerWidth||r.width(),c=t.innerHeight||r.height(),h=50,u=l>c&&l-c>h,a=f[t.orientation];if(u&&a||!u&&!a)f={"-90":!0,90:!0}}e.event.special.orientationchange=e.extend({},e.event.special.orientationchange,{setup:function(){if(e.support.orientation&&!e.event.special.orientationchange.disabled)return!1;o=s(),r.bind("throttledresize",p)},teardown:function(){if(e.support.orientation&&!e.event.special.orientationchange.disabled)return!1;r.unbind("throttledresize",p)},add:function(e){var t=e.handler;e.handler=function(e){return e.orientation=s(),t.apply(this,arguments)}}}),e.event.special.orientationchange.orientation=s=function(){var r=!0,i=n.documentElement;return e.support.orientation?r=f[t.orientation]:r=i&&i.clientWidth/i.clientHeight<1.1,r?"portrait":"landscape"},e.fn[i]=function(e){return e?this.bind(i,e):this.trigger(i)},e.attrFn&&(e.attrFn[i]=!0)}(e,this),function(e,t,n,r){function T(e){while(e&&typeof e.originalEvent!="undefined")e=e.originalEvent;return e}function N(t,n){var i=t.type,s,o,a,l,c,h,p,d,v;t=e.Event(t),t.type=n,s=t.originalEvent,o=e.event.props,i.search(/^(mouse|click)/)>-1&&(o=f);if(s)for(p=o.length,l;p;)l=o[--p],t[l]=s[l];i.search(/mouse(down|up)|click/)>-1&&!t.which&&(t.which=1);if(i.search(/^touch/)!==-1){a=T(s),i=a.touches,c=a.changedTouches,h=i&&i.length?i[0]:c&&c.length?c[0]:r;if(h)for(d=0,v=u.length;d<v;d++)l=u[d],t[l]=h[l]}return t}function C(t){var n={},r,s;while(t){r=e.data(t,i);for(s in r)r[s]&&(n[s]=n.hasVirtualBinding=!0);t=t.parentNode}return n}function k(t,n){var r;while(t){r=e.data(t,i);if(r&&(!n||r[n]))return t;t=t.parentNode}return null}function L(){g=!1}function A(){g=!0}function O(){E=0,v.length=0,m=!1,A()}function M(){L()}function _(){D(),c=setTimeout(function(){c=0,O()},e.vmouse.resetTimerDuration)}function D(){c&&(clearTimeout(c),c=0)}function P(t,n,r){var i;if(r&&r[t]||!r&&k(n.target,t))i=N(n,t),e(n.target).trigger(i);return i}function H(t){var n=e.data(t.target,s),r;!m&&(!E||E!==n)&&(r=P("v"+t.type,t),r&&(r.isDefaultPrevented()&&t.preventDefault(),r.isPropagationStopped()&&t.stopPropagation(),r.isImmediatePropagationStopped()&&t.stopImmediatePropagation()))}function B(t){var n=T(t).touches,r,i,o;n&&n.length===1&&(r=t.target,i=C(r),i.hasVirtualBinding&&(E=w++,e.data(r,s,E),D(),M(),d=!1,o=T(t).touches[0],h=o.pageX,p=o.pageY,P("vmouseover",t,i),P("vmousedown",t,i)))}function j(e){if(g)return;d||P("vmousecancel",e,C(e.target)),d=!0,_()}function F(t){if(g)return;var n=T(t).touches[0],r=d,i=e.vmouse.moveDistanceThreshold,s=C(t.target);d=d||Math.abs(n.pageX-h)>i||Math.abs(n.pageY-p)>i,d&&!r&&P("vmousecancel",t,s),P("vmousemove",t,s),_()}function I(e){if(g)return;A();var t=C(e.target),n,r;P("vmouseup",e,t),d||(n=P("vclick",e,t),n&&n.isDefaultPrevented()&&(r=T(e).changedTouches[0],v.push({touchID:E,x:r.clientX,y:r.clientY}),m=!0)),P("vmouseout",e,t),d=!1,_()}function q(t){var n=e.data(t,i),r;if(n)for(r in n)if(n[r])return!0;return!1}function R(){}function U(t){var n=t.substr(1);return{setup:function(){q(this)||e.data(this,i,{});var r=e.data(this,i);r[t]=!0,l[t]=(l[t]||0)+1,l[t]===1&&b.bind(n,H),e(this).bind(n,R),y&&(l.touchstart=(l.touchstart||0)+1,l.touchstart===1&&b.bind("touchstart",B).bind("touchend",I).bind("touchmove",F).bind("scroll",j))},teardown:function(){--l[t],l[t]||b.unbind(n,H),y&&(--l.touchstart,l.touchstart||b.unbind("touchstart",B).unbind("touchmove",F).unbind("touchend",I).unbind("scroll",j));var r=e(this),s=e.data(this,i);s&&(s[t]=!1),r.unbind(n,R),q(this)||r.removeData(i)}}}var i="virtualMouseBindings",s="virtualTouchID",o="vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel".split(" "),u="clientX clientY pageX pageY screenX screenY".split(" "),a=e.event.mouseHooks?e.event.mouseHooks.props:[],f=e.event.props.concat(a),l={},c=0,h=0,p=0,d=!1,v=[],m=!1,g=!1,y="addEventListener"in n,b=e(n),w=1,E=0,S,x;e.vmouse={moveDistanceThreshold:10,clickDistanceThreshold:10,resetTimerDuration:1500};for(x=0;x<o.length;x++)e.event.special[o[x]]=U(o[x]);y&&n.addEventListener("click",function(t){var n=v.length,r=t.target,i,o,u,a,f,l;if(n){i=t.clientX,o=t.clientY,S=e.vmouse.clickDistanceThreshold,u=r;while(u){for(a=0;a<n;a++){f=v[a],l=0;if(u===r&&Math.abs(f.x-i)<S&&Math.abs(f.y-o)<S||e.data(u,s)===f.touchID){t.preventDefault(),t.stopPropagation();return}}u=u.parentNode}}},!0)}(e,t,n),function(e){e.mobile={}}(e),function(e,t){var r={touch:"ontouchend"in n};e.mobile.support=e.mobile.support||{},e.extend(e.support,r),e.extend(e.mobile.support,r)}(e),function(e,t,r){function l(t,n,i,s){var o=i.type;i.type=n,s?e.event.trigger(i,r,t):e.event.dispatch.call(t,i),i.type=o}var i=e(n),s=e.mobile.support.touch,o="touchmove scroll",u=s?"touchstart":"mousedown",a=s?"touchend":"mouseup",f=s?"touchmove":"mousemove";e.each("touchstart touchmove touchend tap taphold swipe swipeleft swiperight scrollstart scrollstop".split(" "),function(t,n){e.fn[n]=function(e){return e?this.bind(n,e):this.trigger(n)},e.attrFn&&(e.attrFn[n]=!0)}),e.event.special.scrollstart={enabled:!0,setup:function(){function s(e,n){r=n,l(t,r?"scrollstart":"scrollstop",e)}var t=this,n=e(t),r,i;n.bind(o,function(t){if(!e.event.special.scrollstart.enabled)return;r||s(t,!0),clearTimeout(i),i=setTimeout(function(){s(t,!1)},50)})},teardown:function(){e(this).unbind(o)}},e.event.special.tap={tapholdThreshold:750,emitTapOnTaphold:!0,setup:function(){var t=this,n=e(t),r=!1;n.bind("vmousedown",function(s){function a(){clearTimeout(u)}function f(){a(),n.unbind("vclick",c).unbind("vmouseup",a),i.unbind("vmousecancel",f)}function c(e){f(),!r&&o===e.target?l(t,"tap",e):r&&e.preventDefault()}r=!1;if(s.which&&s.which!==1)return!1;var o=s.target,u;n.bind("vmouseup",a).bind("vclick",c),i.bind("vmousecancel",f),u=setTimeout(function(){e.event.special.tap.emitTapOnTaphold||(r=!0),l(t,"taphold",e.Event("taphold",{target:o}))},e.event.special.tap.tapholdThreshold)})},teardown:function(){e(this).unbind("vmousedown").unbind("vclick").unbind("vmouseup"),i.unbind("vmousecancel")}},e.event.special.swipe={scrollSupressionThreshold:30,durationThreshold:1e3,horizontalDistanceThreshold:30,verticalDistanceThreshold:30,getLocation:function(e){var n=t.pageXOffset,r=t.pageYOffset,i=e.clientX,s=e.clientY;if(e.pageY===0&&Math.floor(s)>Math.floor(e.pageY)||e.pageX===0&&Math.floor(i)>Math.floor(e.pageX))i-=n,s-=r;else if(s<e.pageY-r||i<e.pageX-n)i=e.pageX-n,s=e.pageY-r;return{x:i,y:s}},start:function(t){var n=t.originalEvent.touches?t.originalEvent.touches[0]:t,r=e.event.special.swipe.getLocation(n);return{time:(new Date).getTime(),coords:[r.x,r.y],origin:e(t.target)}},stop:function(t){var n=t.originalEvent.touches?t.originalEvent.touches[0]:t,r=e.event.special.swipe.getLocation(n);return{time:(new Date).getTime(),coords:[r.x,r.y]}},handleSwipe:function(t,n,r,i){if(n.time-t.time<e.event.special.swipe.durationThreshold&&Math.abs(t.coords[0]-n.coords[0])>e.event.special.swipe.horizontalDistanceThreshold&&Math.abs(t.coords[1]-n.coords[1])<e.event.special.swipe.verticalDistanceThreshold){var s=t.coords[0]>n.coords[0]?"swipeleft":"swiperight";return l(r,"swipe",e.Event("swipe",{target:i,swipestart:t,swipestop:n}),!0),l(r,s,e.Event(s,{target:i,swipestart:t,swipestop:n}),!0),!0}return!1},eventInProgress:!1,setup:function(){var t,n=this,r=e(n),s={};t=e.data(this,"mobile-events"),t||(t={length:0},e.data(this,"mobile-events",t)),t.length++,t.swipe=s,s.start=function(t){if(e.event.special.swipe.eventInProgress)return;e.event.special.swipe.eventInProgress=!0;var r,o=e.event.special.swipe.start(t),u=t.target,l=!1;s.move=function(t){if(!o||t.isDefaultPrevented())return;r=e.event.special.swipe.stop(t),l||(l=e.event.special.swipe.handleSwipe(o,r,n,u),l&&(e.event.special.swipe.eventInProgress=!1)),Math.abs(o.coords[0]-r.coords[0])>e.event.special.swipe.scrollSupressionThreshold&&t.preventDefault()},s.stop=function(){l=!0,e.event.special.swipe.eventInProgress=!1,i.off(f,s.move),s.move=null},i.on(f,s.move).one(a,s.stop)},r.on(u,s.start)},teardown:function(){var t,n;t=e.data(this,"mobile-events"),t&&(n=t.swipe,delete t.swipe,t.length--,t.length===0&&e.removeData(this,"mobile-events")),n&&(n.start&&e(this).off(u,n.start),n.move&&i.off(f,n.move),n.stop&&i.off(a,n.stop))}},e.each({scrollstop:"scrollstart",taphold:"tap",swipeleft:"swipe.left",swiperight:"swipe.right"},function(t,n){e.event.special[t]={setup:function(){e(this).bind(n,e.noop)},teardown:function(){e(this).unbind(n)}}})}(e,this),function(e,t){var r={animation:{},transition:{}},i=n.createElement("a"),s=["","webkit-","moz-","o-"];e.each(["animation","transition"],function(n,o){var u=n===0?o+"-"+"name":o;e.each(s,function(n,s){if(i.style[e.camelCase(s+u)]!==t)return r[o].prefix=s,!1}),r[o].duration=e.camelCase(r[o].prefix+o+"-"+"duration"),r[o].event=e.camelCase(r[o].prefix+o+"-"+"end"),r[o].prefix===""&&(r[o].event=r[o].event.toLowerCase())}),e.support.cssTransitions=r.transition.prefix!==t,e.support.cssAnimations=r.animation.prefix!==t,e(i).remove(),e.fn.animationComplete=function(i,s,o){var u,a,f=this,l=function(){clearTimeout(u),i.apply(this,arguments)},c=!s||s==="animation"?"animation":"transition";if(e.support.cssTransitions&&c==="transition"||e.support.cssAnimations&&c==="animation"){if(o===t){e(this).context!==n&&(a=parseFloat(e(this).css(r[c].duration))*3e3);if(a===0||a===t||isNaN(a))a=e.fn.animationComplete.defaultDuration}return u=setTimeout(function(){e(f).off(r[c].event,l),i.apply(f)},a),e(this).one(r[c].event,l)}return setTimeout(e.proxy(i,this),0),e(this)},e.fn.animationComplete.defaultDuration=1e3}(e)});

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
	 * @since    1.0.0
	 *
	 * @param    {string}  string  The string to escape.
	 *
	 * @returns  {string}          The escaped string.
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

	var $body         = $( 'body' );
	var $window       = $( window );
	var toggleText    = alcatraz_vars.menu_toggle || '';
	var closeText     = alcatraz_vars.menu_close  || '';
	var slideDuration = alcatraz_vars.slide_duration || 300;

	/**
	 * Toggle a 'focus' class on list items when using keyboard navigation.
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
	 * Handle keyboard navigation support via tab and arrow keys across all site navigation.
	 *
	 * @since  1.0.0
	 *
	 * @param  {object}  event  The keyup event object.
	 */
	var _toggleNavItemWithKeyboard = function( event ) {
		var code = ( event.keyCode ) ? event.keyCode : event.which;
		var $el  = $( document.activeElement );

		// Bail if a modified key has been pressed.
		if ( event.altKey || event.ctrlKey ) {
			return true;
		}

		// Bail if we don't have focus on a nav.
		if ( ! $el.is( 'nav a:focus' ) ) {
			return true;
		}

		// Get the '<li>' element.
		var $item = $el.parent();
		var $list = $item.parent();
		var $target;

		// Build args for the toggleListItem event.
		var args  = {
			autoClose : true,
			duration  : slideDuration,
		};
		var closeArgs = {
			autoClose : false,
			duration  : slideDuration,
		};
		var data = {
			item : $item,
			args : args,
		};

		switch( code ) {
			case ( 9 ) : // Tab key.

				if ( 'keydown' === event.type ) {
					return true;
				}

				if ( $item.children( 'ul' ).length && $list.hasClass( 'top-level' ) ) {

					// The focused nav item has children and is on the top level, so toggle it.
					$window.trigger( 'toggleListItem.alcatraz', data );

				} else if ( $list.hasClass( 'top-level' ) ) {

					// The focused nav item doesn't have children and is on the top level, so
					// close any previously toggled top level list items.
					$list.children( 'li.toggled' ).each( function() {
						var closeData = {
							item : $( this ),
							args : closeArgs,
						};
						$window.trigger( 'toggleListItem.alcatraz', closeData );
					});
				}

				break;

			case ( 32 ) : // Spacebar.

				if ( 'keydown' === event.type ) {
					event.preventDefault();
					return true;
				}

				if ( $item.children( 'ul' ).length ) {
					$window.trigger( 'toggleListItem.alcatraz', data );
				}

				break;

			case ( 37 ) : // Left arrow key.

				// Prevent window scrolling.
				if ( 'keydown' === event.type ) {
					event.preventDefault();
					return true;
				}

				if ( $list.hasClass( 'top-level' ) && $item.prev( 'li' ).length ) {

					// The focused nav item is on the top level and has a sibling before it,
					// so move focus to the left one item.
					$target = $item.prev( 'li' );

					$window.trigger( 'toggleListItem.alcatraz', {
						item : $target,
						args : args,
					});

					$target.find( 'a' ).first().focus();

				} else if ( $list.parent( 'li' ).parent( 'ul' ).hasClass( 'top-level' ) ) {

					// The focused nav item is on a second level sub level, so move focus up
					// one level to the sibling to the left of the parent item.
					$target = $list.parent( 'li' ).prev( 'li' );

					$window.trigger( 'toggleListItem.alcatraz', {
						item : $target,
						args : args,
					});

					$target.find( 'a' ).first().focus();

				} else if ( ! $list.hasClass( 'top-level' ) ) {

					// The focused nav item is on a third level sub level or deeper, so move
					// focus up one level and toggle the parent item.
					$target = $list.parent( 'li' );

					$window.trigger( 'toggleListItem.alcatraz', {
						item : $target,
						args : args,
					});

					$target.find( 'a' ).first().focus();
				}

				break;

			case ( 38 ) : // Up arrow key.

				// Prevent window scrolling.
				if ( 'keydown' === event.type ) {
					event.preventDefault();
					return true;
				}

				if ( ! $list.hasClass( 'top-level' ) && ! $item.prev( 'li' ).length ) {

					// The focused nav item is on a sub level but lacks a sibling before it,
					// so move focus up one item.
					$list.parent( 'li' ).find( 'a' ).first().focus();

				} else if ( ! $list.hasClass( 'top-level' ) && $item.prev( 'li' ).length ) {

					// The focused nav item is on a sub level and has a sibling before it,
					// so move focus up one item.
					$item.prev( 'li' ).find( 'a' ).first().focus();
				}

				break;

			case ( 39 ) : // Right arrow key.

				// Prevent window scrolling.
				if ( 'keydown' === event.type ) {
					event.preventDefault();
					return true;
				}

				if ( $list.hasClass( 'top-level' ) && $item.next( 'li' ).length ) {

					// The focused hav item is on the top level and has a sibling after it,
					// so move focus to the right one item.
					$target = $item.next( 'li' );

					$window.trigger( 'toggleListItem.alcatraz', {
						item : $target,
						args : args,
					});

					$target.find( 'a' ).first().focus();

				} else if ( ! $list.hasClass( 'top-level' ) && $item.children( 'ul' ).length ) {

					// The focused nav item is on a sub level and has children, so toggle it if
					// it isn't toggled already.
					if ( ! $item.hasClass( 'toggled' ) ) {
						$window.trigger( 'toggleListItem.alcatraz', data );
					}

					$item.children( 'ul' ).first().find( 'a' ).first().focus();

				} else if ( $list.parent( 'li' ).parent( 'ul' ).hasClass( 'top-level' ) ) {

					// The focused nav item is on a second level sub level, so move focus up
					// one level to the sibling to the right of the parent item.
					$target = $list.parent( 'li' ).next( 'li' );

					$window.trigger( 'toggleListItem.alcatraz', {
						item : $target,
						args : args,
					});

					$target.find( 'a' ).first().focus();

				} else if ( ! $list.hasClass( 'top-level' ) ) {

					// The focused nav item is on a third level sub level or deeper, so move
					// focus up one level and toggle the parent item's next sibling.
					$target = $list.parent( 'li' );

					$window.trigger( 'toggleListItem.alcatraz', {
						item : $target,
						args : args,
					});

					$target.next( 'li' ).find( 'a' ).first().focus();
				}

				break;

			case ( 40 ) : // Down arrow key.

				// Prevent window scrolling.
				if ( 'keydown' === event.type ) {
					event.preventDefault();
					return true;
				}

				if ( $item.children( 'ul' ).length && $list.hasClass( 'top-level' ) ) {

					// The focused nav item has children and is on the top level,
					// so move focus down one level.
					$item.find( 'ul li' ).first().find( 'a' ).first().focus();

				} else if ( ! $list.hasClass( 'top-level' ) && $item.next( 'li' ).length ) {

					// The focused nav item is on a sub level and has a sibling after it,
					// so move focus down one item.
					$item.next( 'li' ).find( 'a' ).first().focus();
				}

				break;
		}

		return true;
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
		var args      = options || {};
		var autoClose = args.autoClose || false;
		var duration  = args.duration || 500;

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
			var $items         = $list.find( 'li' );
			var $subList       = $items.has( 'ul' );
			var safeToggleText = Alcatraz.Utils.escapeHtml( toggleText );

			var toggle = '<a class="sub-level-toggle">' + safeToggleText +
			                 '<span class="sub-level-toggle-span span-1"></span>' +
			                 '<span class="sub-level-toggle-span span-2"></span>' +
			                 '<span class="sub-level-toggle-span span-3"></span>' +
			             '</a>';

			// Add classes to indicate levels and items.
			$list.addClass( 'top-level' );
			$list.find( 'ul' ).addClass( 'sub-level' );
			$items.addClass( 'list-item' );

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
		var $subLinks = $subMenus.find( 'a' );

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
			duration: slideDuration,
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

		// Set menu item links inside sub menus to not be accessible via tabIndex.
		$subLinks.attr( 'tabIndex', '-1' );

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
			duration: slideDuration,
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

		// Nav item keyboard navigation.
		$window.off( 'keydown keyup', _toggleNavItemWithKeyboard );
		$window.on( 'keydown keyup', _toggleNavItemWithKeyboard );

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

/**
 * Alcatraz JS object.
 *
 * This file contains the main Alcatraz JS object, which serves as a wrapper and namespace under
 * which all of our other component objects can be accessed.
 *
 * Alcatraz.Utils is an object with utility methods that are useful.
 *
 * Alcatraz.Nav is an object with all methods related to the site navigation.
 *
 * @since  1.0.0
 */

var Alcatraz = ( function( $ ) {

	/**
	 * Save component objects as properties.
	 */
	var Utils = AlcatrazUtilities || false;
	var Nav = AlcatrazNavigation || false;

	/**
	 * Expose public methods.
	 */
	return {
		Utils : Utils,
		Nav : Nav,
	};

})( jQuery );

/**
 * Initialization JS.
 *
 * This file initializes all theme functionality including all things that need to fire when
 * the DOM is ready or when the page is fully loaded.
 *
 * @since  1.0.0
 */

( function( $ ) {

	// When the DOM is ready, initialize all the things.
	$( document ).ready( function() {
		Alcatraz.Nav.initSiteNavigation();
	});

	// Reset the primary nav when a Customizer partial refresh happens.
	$( document ).on( 'customize-preview-menu-refreshed', function() {
		Alcatraz.Nav.initPrimaryNavigation();
	});

})( jQuery );
