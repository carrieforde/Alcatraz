/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
throw new Error("Cannot find module \"./sass/style.scss\"");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__vendor_jquery_mobile_jquery_mobile_custom__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__vendor_jquery_mobile_jquery_mobile_custom___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__vendor_jquery_mobile_jquery_mobile_custom__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__utilities__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__utilities___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__utilities__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__skip_link_focus_fix__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__skip_link_focus_fix___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__skip_link_focus_fix__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__navigation__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__navigation___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__navigation__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__alcatraz__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__alcatraz___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5__alcatraz__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__init__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__init___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6__init__);
// Import styles for compilation.


// Import front end scripts.







/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*
* jQuery Mobile v1.4.5
* http://jquerymobile.com
*
* Copyright 2010, 2014 jQuery Foundation, Inc. and other contributors
* Released under the MIT license.
* http://jquery.org/license
*
*/

(function (root, doc, factory) {
	if (true) {
		// AMD. Register as an anonymous module.
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [!(function webpackMissingModule() { var e = new Error("Cannot find module \"jquery\""); e.code = 'MODULE_NOT_FOUND'; throw e; }())], __WEBPACK_AMD_DEFINE_RESULT__ = (function ($) {
			factory($, root, doc);
			return $.mobile;
		}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {
		// Browser globals
		factory(root.jQuery, root, doc);
	}
})(this, document, function (jQuery, window, document, undefined) {
	(function ($, undefined) {
		$.extend($.support, {
			orientation: "orientation" in window && "onorientationchange" in window
		});
	})(jQuery);

	// throttled resize event
	(function ($) {
		$.event.special.throttledresize = {
			setup: function setup() {
				$(this).bind("resize", handler);
			},
			teardown: function teardown() {
				$(this).unbind("resize", handler);
			}
		};

		var throttle = 250,
		    handler = function handler() {
			curr = new Date().getTime();
			diff = curr - lastCall;

			if (diff >= throttle) {

				lastCall = curr;
				$(this).trigger("throttledresize");
			} else {

				if (heldCall) {
					clearTimeout(heldCall);
				}

				// Promise a held call will still execute
				heldCall = setTimeout(handler, throttle - diff);
			}
		},
		    lastCall = 0,
		    heldCall,
		    curr,
		    diff;
	})(jQuery);

	(function ($, window) {
		var win = $(window),
		    event_name = "orientationchange",
		    get_orientation,
		    last_orientation,
		    initial_orientation_is_landscape,
		    initial_orientation_is_default,
		    portrait_map = { "0": true, "180": true },
		    ww,
		    wh,
		    landscape_threshold;

		// It seems that some device/browser vendors use window.orientation values 0 and 180 to
		// denote the "default" orientation. For iOS devices, and most other smart-phones tested,
		// the default orientation is always "portrait", but in some Android and RIM based tablets,
		// the default orientation is "landscape". The following code attempts to use the window
		// dimensions to figure out what the current orientation is, and then makes adjustments
		// to the to the portrait_map if necessary, so that we can properly decode the
		// window.orientation value whenever get_orientation() is called.
		//
		// Note that we used to use a media query to figure out what the orientation the browser
		// thinks it is in:
		//
		//     initial_orientation_is_landscape = $.mobile.media("all and (orientation: landscape)");
		//
		// but there was an iPhone/iPod Touch bug beginning with iOS 4.2, up through iOS 5.1,
		// where the browser *ALWAYS* applied the landscape media query. This bug does not
		// happen on iPad.

		if ($.support.orientation) {

			// Check the window width and height to figure out what the current orientation
			// of the device is at this moment. Note that we've initialized the portrait map
			// values to 0 and 180, *AND* we purposely check for landscape so that if we guess
			// wrong, , we default to the assumption that portrait is the default orientation.
			// We use a threshold check below because on some platforms like iOS, the iPhone
			// form-factor can report a larger width than height if the user turns on the
			// developer console. The actual threshold value is somewhat arbitrary, we just
			// need to make sure it is large enough to exclude the developer console case.

			ww = window.innerWidth || win.width();
			wh = window.innerHeight || win.height();
			landscape_threshold = 50;

			initial_orientation_is_landscape = ww > wh && ww - wh > landscape_threshold;

			// Now check to see if the current window.orientation is 0 or 180.
			initial_orientation_is_default = portrait_map[window.orientation];

			// If the initial orientation is landscape, but window.orientation reports 0 or 180, *OR*
			// if the initial orientation is portrait, but window.orientation reports 90 or -90, we
			// need to flip our portrait_map values because landscape is the default orientation for
			// this device/browser.
			if (initial_orientation_is_landscape && initial_orientation_is_default || !initial_orientation_is_landscape && !initial_orientation_is_default) {
				portrait_map = { "-90": true, "90": true };
			}
		}

		$.event.special.orientationchange = $.extend({}, $.event.special.orientationchange, {
			setup: function setup() {
				// If the event is supported natively, return false so that jQuery
				// will bind to the event using DOM methods.
				if ($.support.orientation && !$.event.special.orientationchange.disabled) {
					return false;
				}

				// Get the current orientation to avoid initial double-triggering.
				last_orientation = get_orientation();

				// Because the orientationchange event doesn't exist, simulate the
				// event by testing window dimensions on resize.
				win.bind("throttledresize", handler);
			},
			teardown: function teardown() {
				// If the event is not supported natively, return false so that
				// jQuery will unbind the event using DOM methods.
				if ($.support.orientation && !$.event.special.orientationchange.disabled) {
					return false;
				}

				// Because the orientationchange event doesn't exist, unbind the
				// resize event handler.
				win.unbind("throttledresize", handler);
			},
			add: function add(handleObj) {
				// Save a reference to the bound event handler.
				var old_handler = handleObj.handler;

				handleObj.handler = function (event) {
					// Modify event object, adding the .orientation property.
					event.orientation = get_orientation();

					// Call the originally-bound event handler and return its result.
					return old_handler.apply(this, arguments);
				};
			}
		});

		// If the event is not supported natively, this handler will be bound to
		// the window resize event to simulate the orientationchange event.
		function handler() {
			// Get the current orientation.
			var orientation = get_orientation();

			if (orientation !== last_orientation) {
				// The orientation has changed, so trigger the orientationchange event.
				last_orientation = orientation;
				win.trigger(event_name);
			}
		}

		// Get the current page orientation. This method is exposed publicly, should it
		// be needed, as jQuery.event.special.orientationchange.orientation()
		$.event.special.orientationchange.orientation = get_orientation = function get_orientation() {
			var isPortrait = true,
			    elem = document.documentElement;

			// prefer window orientation to the calculation based on screensize as
			// the actual screen resize takes place before or after the orientation change event
			// has been fired depending on implementation (eg android 2.3 is before, iphone after).
			// More testing is required to determine if a more reliable method of determining the new screensize
			// is possible when orientationchange is fired. (eg, use media queries + element + opacity)
			if ($.support.orientation) {
				// if the window orientation registers as 0 or 180 degrees report
				// portrait, otherwise landscape
				isPortrait = portrait_map[window.orientation];
			} else {
				isPortrait = elem && elem.clientWidth / elem.clientHeight < 1.1;
			}

			return isPortrait ? "portrait" : "landscape";
		};

		$.fn[event_name] = function (fn) {
			return fn ? this.bind(event_name, fn) : this.trigger(event_name);
		};

		// jQuery < 1.8
		if ($.attrFn) {
			$.attrFn[event_name] = true;
		}
	})(jQuery, this);

	// This plugin is an experiment for abstracting away the touch and mouse
	// events so that developers don't have to worry about which method of input
	// the device their document is loaded on supports.
	//
	// The idea here is to allow the developer to register listeners for the
	// basic mouse events, such as mousedown, mousemove, mouseup, and click,
	// and the plugin will take care of registering the correct listeners
	// behind the scenes to invoke the listener at the fastest possible time
	// for that device, while still retaining the order of event firing in
	// the traditional mouse environment, should multiple handlers be registered
	// on the same element for different events.
	//
	// The current version exposes the following virtual events to jQuery bind methods:
	// "vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel"

	(function ($, window, document, undefined) {

		var dataPropertyName = "virtualMouseBindings",
		    touchTargetPropertyName = "virtualTouchID",
		    virtualEventNames = "vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel".split(" "),
		    touchEventProps = "clientX clientY pageX pageY screenX screenY".split(" "),
		    mouseHookProps = $.event.mouseHooks ? $.event.mouseHooks.props : [],
		    mouseEventProps = $.event.props.concat(mouseHookProps),
		    activeDocHandlers = {},
		    resetTimerID = 0,
		    startX = 0,
		    startY = 0,
		    didScroll = false,
		    clickBlockList = [],
		    blockMouseTriggers = false,
		    blockTouchTriggers = false,
		    eventCaptureSupported = "addEventListener" in document,
		    $document = $(document),
		    nextTouchID = 1,
		    lastTouchID = 0,
		    threshold,
		    i;

		$.vmouse = {
			moveDistanceThreshold: 10,
			clickDistanceThreshold: 10,
			resetTimerDuration: 1500
		};

		function getNativeEvent(event) {

			while (event && typeof event.originalEvent !== "undefined") {
				event = event.originalEvent;
			}
			return event;
		}

		function createVirtualEvent(event, eventType) {

			var t = event.type,
			    oe,
			    props,
			    ne,
			    prop,
			    ct,
			    touch,
			    i,
			    j,
			    len;

			event = $.Event(event);
			event.type = eventType;

			oe = event.originalEvent;
			props = $.event.props;

			// addresses separation of $.event.props in to $.event.mouseHook.props and Issue 3280
			// https://github.com/jquery/jquery-mobile/issues/3280
			if (t.search(/^(mouse|click)/) > -1) {
				props = mouseEventProps;
			}

			// copy original event properties over to the new event
			// this would happen if we could call $.event.fix instead of $.Event
			// but we don't have a way to force an event to be fixed multiple times
			if (oe) {
				for (i = props.length, prop; i;) {
					prop = props[--i];
					event[prop] = oe[prop];
				}
			}

			// make sure that if the mouse and click virtual events are generated
			// without a .which one is defined
			if (t.search(/mouse(down|up)|click/) > -1 && !event.which) {
				event.which = 1;
			}

			if (t.search(/^touch/) !== -1) {
				ne = getNativeEvent(oe);
				t = ne.touches;
				ct = ne.changedTouches;
				touch = t && t.length ? t[0] : ct && ct.length ? ct[0] : undefined;

				if (touch) {
					for (j = 0, len = touchEventProps.length; j < len; j++) {
						prop = touchEventProps[j];
						event[prop] = touch[prop];
					}
				}
			}

			return event;
		}

		function getVirtualBindingFlags(element) {

			var flags = {},
			    b,
			    k;

			while (element) {

				b = $.data(element, dataPropertyName);

				for (k in b) {
					if (b[k]) {
						flags[k] = flags.hasVirtualBinding = true;
					}
				}
				element = element.parentNode;
			}
			return flags;
		}

		function getClosestElementWithVirtualBinding(element, eventType) {
			var b;
			while (element) {

				b = $.data(element, dataPropertyName);

				if (b && (!eventType || b[eventType])) {
					return element;
				}
				element = element.parentNode;
			}
			return null;
		}

		function enableTouchBindings() {
			blockTouchTriggers = false;
		}

		function disableTouchBindings() {
			blockTouchTriggers = true;
		}

		function enableMouseBindings() {
			lastTouchID = 0;
			clickBlockList.length = 0;
			blockMouseTriggers = false;

			// When mouse bindings are enabled, our
			// touch bindings are disabled.
			disableTouchBindings();
		}

		function disableMouseBindings() {
			// When mouse bindings are disabled, our
			// touch bindings are enabled.
			enableTouchBindings();
		}

		function startResetTimer() {
			clearResetTimer();
			resetTimerID = setTimeout(function () {
				resetTimerID = 0;
				enableMouseBindings();
			}, $.vmouse.resetTimerDuration);
		}

		function clearResetTimer() {
			if (resetTimerID) {
				clearTimeout(resetTimerID);
				resetTimerID = 0;
			}
		}

		function triggerVirtualEvent(eventType, event, flags) {
			var ve;

			if (flags && flags[eventType] || !flags && getClosestElementWithVirtualBinding(event.target, eventType)) {

				ve = createVirtualEvent(event, eventType);

				$(event.target).trigger(ve);
			}

			return ve;
		}

		function mouseEventCallback(event) {
			var touchID = $.data(event.target, touchTargetPropertyName),
			    ve;

			if (!blockMouseTriggers && (!lastTouchID || lastTouchID !== touchID)) {
				ve = triggerVirtualEvent("v" + event.type, event);
				if (ve) {
					if (ve.isDefaultPrevented()) {
						event.preventDefault();
					}
					if (ve.isPropagationStopped()) {
						event.stopPropagation();
					}
					if (ve.isImmediatePropagationStopped()) {
						event.stopImmediatePropagation();
					}
				}
			}
		}

		function handleTouchStart(event) {

			var touches = getNativeEvent(event).touches,
			    target,
			    flags,
			    t;

			if (touches && touches.length === 1) {

				target = event.target;
				flags = getVirtualBindingFlags(target);

				if (flags.hasVirtualBinding) {

					lastTouchID = nextTouchID++;
					$.data(target, touchTargetPropertyName, lastTouchID);

					clearResetTimer();

					disableMouseBindings();
					didScroll = false;

					t = getNativeEvent(event).touches[0];
					startX = t.pageX;
					startY = t.pageY;

					triggerVirtualEvent("vmouseover", event, flags);
					triggerVirtualEvent("vmousedown", event, flags);
				}
			}
		}

		function handleScroll(event) {
			if (blockTouchTriggers) {
				return;
			}

			if (!didScroll) {
				triggerVirtualEvent("vmousecancel", event, getVirtualBindingFlags(event.target));
			}

			didScroll = true;
			startResetTimer();
		}

		function handleTouchMove(event) {
			if (blockTouchTriggers) {
				return;
			}

			var t = getNativeEvent(event).touches[0],
			    didCancel = didScroll,
			    moveThreshold = $.vmouse.moveDistanceThreshold,
			    flags = getVirtualBindingFlags(event.target);

			didScroll = didScroll || Math.abs(t.pageX - startX) > moveThreshold || Math.abs(t.pageY - startY) > moveThreshold;

			if (didScroll && !didCancel) {
				triggerVirtualEvent("vmousecancel", event, flags);
			}

			triggerVirtualEvent("vmousemove", event, flags);
			startResetTimer();
		}

		function handleTouchEnd(event) {
			if (blockTouchTriggers) {
				return;
			}

			disableTouchBindings();

			var flags = getVirtualBindingFlags(event.target),
			    ve,
			    t;
			triggerVirtualEvent("vmouseup", event, flags);

			if (!didScroll) {
				ve = triggerVirtualEvent("vclick", event, flags);
				if (ve && ve.isDefaultPrevented()) {
					// The target of the mouse events that follow the touchend
					// event don't necessarily match the target used during the
					// touch. This means we need to rely on coordinates for blocking
					// any click that is generated.
					t = getNativeEvent(event).changedTouches[0];
					clickBlockList.push({
						touchID: lastTouchID,
						x: t.clientX,
						y: t.clientY
					});

					// Prevent any mouse events that follow from triggering
					// virtual event notifications.
					blockMouseTriggers = true;
				}
			}
			triggerVirtualEvent("vmouseout", event, flags);
			didScroll = false;

			startResetTimer();
		}

		function hasVirtualBindings(ele) {
			var bindings = $.data(ele, dataPropertyName),
			    k;

			if (bindings) {
				for (k in bindings) {
					if (bindings[k]) {
						return true;
					}
				}
			}
			return false;
		}

		function dummyMouseHandler() {}

		function getSpecialEventObject(eventType) {
			var realType = eventType.substr(1);

			return {
				setup: function setup() /* data, namespace */{
					// If this is the first virtual mouse binding for this element,
					// add a bindings object to its data.

					if (!hasVirtualBindings(this)) {
						$.data(this, dataPropertyName, {});
					}

					// If setup is called, we know it is the first binding for this
					// eventType, so initialize the count for the eventType to zero.
					var bindings = $.data(this, dataPropertyName);
					bindings[eventType] = true;

					// If this is the first virtual mouse event for this type,
					// register a global handler on the document.

					activeDocHandlers[eventType] = (activeDocHandlers[eventType] || 0) + 1;

					if (activeDocHandlers[eventType] === 1) {
						$document.bind(realType, mouseEventCallback);
					}

					// Some browsers, like Opera Mini, won't dispatch mouse/click events
					// for elements unless they actually have handlers registered on them.
					// To get around this, we register dummy handlers on the elements.

					$(this).bind(realType, dummyMouseHandler);

					// For now, if event capture is not supported, we rely on mouse handlers.
					if (eventCaptureSupported) {
						// If this is the first virtual mouse binding for the document,
						// register our touchstart handler on the document.

						activeDocHandlers["touchstart"] = (activeDocHandlers["touchstart"] || 0) + 1;

						if (activeDocHandlers["touchstart"] === 1) {
							$document.bind("touchstart", handleTouchStart).bind("touchend", handleTouchEnd)

							// On touch platforms, touching the screen and then dragging your finger
							// causes the window content to scroll after some distance threshold is
							// exceeded. On these platforms, a scroll prevents a click event from being
							// dispatched, and on some platforms, even the touchend is suppressed. To
							// mimic the suppression of the click event, we need to watch for a scroll
							// event. Unfortunately, some platforms like iOS don't dispatch scroll
							// events until *AFTER* the user lifts their finger (touchend). This means
							// we need to watch both scroll and touchmove events to figure out whether
							// or not a scroll happenens before the touchend event is fired.

							.bind("touchmove", handleTouchMove).bind("scroll", handleScroll);
						}
					}
				},

				teardown: function teardown() /* data, namespace */{
					// If this is the last virtual binding for this eventType,
					// remove its global handler from the document.

					--activeDocHandlers[eventType];

					if (!activeDocHandlers[eventType]) {
						$document.unbind(realType, mouseEventCallback);
					}

					if (eventCaptureSupported) {
						// If this is the last virtual mouse binding in existence,
						// remove our document touchstart listener.

						--activeDocHandlers["touchstart"];

						if (!activeDocHandlers["touchstart"]) {
							$document.unbind("touchstart", handleTouchStart).unbind("touchmove", handleTouchMove).unbind("touchend", handleTouchEnd).unbind("scroll", handleScroll);
						}
					}

					var $this = $(this),
					    bindings = $.data(this, dataPropertyName);

					// teardown may be called when an element was
					// removed from the DOM. If this is the case,
					// jQuery core may have already stripped the element
					// of any data bindings so we need to check it before
					// using it.
					if (bindings) {
						bindings[eventType] = false;
					}

					// Unregister the dummy event handler.

					$this.unbind(realType, dummyMouseHandler);

					// If this is the last virtual mouse binding on the
					// element, remove the binding data from the element.

					if (!hasVirtualBindings(this)) {
						$this.removeData(dataPropertyName);
					}
				}
			};
		}

		// Expose our custom events to the jQuery bind/unbind mechanism.

		for (i = 0; i < virtualEventNames.length; i++) {
			$.event.special[virtualEventNames[i]] = getSpecialEventObject(virtualEventNames[i]);
		}

		// Add a capture click handler to block clicks.
		// Note that we require event capture support for this so if the device
		// doesn't support it, we punt for now and rely solely on mouse events.
		if (eventCaptureSupported) {
			document.addEventListener("click", function (e) {
				var cnt = clickBlockList.length,
				    target = e.target,
				    x,
				    y,
				    ele,
				    i,
				    o,
				    touchID;

				if (cnt) {
					x = e.clientX;
					y = e.clientY;
					threshold = $.vmouse.clickDistanceThreshold;

					// The idea here is to run through the clickBlockList to see if
					// the current click event is in the proximity of one of our
					// vclick events that had preventDefault() called on it. If we find
					// one, then we block the click.
					//
					// Why do we have to rely on proximity?
					//
					// Because the target of the touch event that triggered the vclick
					// can be different from the target of the click event synthesized
					// by the browser. The target of a mouse/click event that is synthesized
					// from a touch event seems to be implementation specific. For example,
					// some browsers will fire mouse/click events for a link that is near
					// a touch event, even though the target of the touchstart/touchend event
					// says the user touched outside the link. Also, it seems that with most
					// browsers, the target of the mouse/click event is not calculated until the
					// time it is dispatched, so if you replace an element that you touched
					// with another element, the target of the mouse/click will be the new
					// element underneath that point.
					//
					// Aside from proximity, we also check to see if the target and any
					// of its ancestors were the ones that blocked a click. This is necessary
					// because of the strange mouse/click target calculation done in the
					// Android 2.1 browser, where if you click on an element, and there is a
					// mouse/click handler on one of its ancestors, the target will be the
					// innermost child of the touched element, even if that child is no where
					// near the point of touch.

					ele = target;

					while (ele) {
						for (i = 0; i < cnt; i++) {
							o = clickBlockList[i];
							touchID = 0;

							if (ele === target && Math.abs(o.x - x) < threshold && Math.abs(o.y - y) < threshold || $.data(ele, touchTargetPropertyName) === o.touchID) {
								// XXX: We may want to consider removing matches from the block list
								//      instead of waiting for the reset timer to fire.
								e.preventDefault();
								e.stopPropagation();
								return;
							}
						}
						ele = ele.parentNode;
					}
				}
			}, true);
		}
	})(jQuery, window, document);

	(function ($) {
		$.mobile = {};
	})(jQuery);

	(function ($, undefined) {
		var support = {
			touch: "ontouchend" in document
		};

		$.mobile.support = $.mobile.support || {};
		$.extend($.support, support);
		$.extend($.mobile.support, support);
	})(jQuery);

	(function ($, window, undefined) {
		var $document = $(document),
		    supportTouch = $.mobile.support.touch,
		    scrollEvent = "touchmove scroll",
		    touchStartEvent = supportTouch ? "touchstart" : "mousedown",
		    touchStopEvent = supportTouch ? "touchend" : "mouseup",
		    touchMoveEvent = supportTouch ? "touchmove" : "mousemove";

		// setup new event shortcuts
		$.each(("touchstart touchmove touchend " + "tap taphold " + "swipe swipeleft swiperight " + "scrollstart scrollstop").split(" "), function (i, name) {

			$.fn[name] = function (fn) {
				return fn ? this.bind(name, fn) : this.trigger(name);
			};

			// jQuery < 1.8
			if ($.attrFn) {
				$.attrFn[name] = true;
			}
		});

		function triggerCustomEvent(obj, eventType, event, bubble) {
			var originalType = event.type;
			event.type = eventType;
			if (bubble) {
				$.event.trigger(event, undefined, obj);
			} else {
				$.event.dispatch.call(obj, event);
			}
			event.type = originalType;
		}

		// also handles scrollstop
		$.event.special.scrollstart = {

			enabled: true,
			setup: function setup() {

				var thisObject = this,
				    $this = $(thisObject),
				    scrolling,
				    timer;

				function trigger(event, state) {
					scrolling = state;
					triggerCustomEvent(thisObject, scrolling ? "scrollstart" : "scrollstop", event);
				}

				// iPhone triggers scroll after a small delay; use touchmove instead
				$this.bind(scrollEvent, function (event) {

					if (!$.event.special.scrollstart.enabled) {
						return;
					}

					if (!scrolling) {
						trigger(event, true);
					}

					clearTimeout(timer);
					timer = setTimeout(function () {
						trigger(event, false);
					}, 50);
				});
			},
			teardown: function teardown() {
				$(this).unbind(scrollEvent);
			}
		};

		// also handles taphold
		$.event.special.tap = {
			tapholdThreshold: 750,
			emitTapOnTaphold: true,
			setup: function setup() {
				var thisObject = this,
				    $this = $(thisObject),
				    isTaphold = false;

				$this.bind("vmousedown", function (event) {
					isTaphold = false;
					if (event.which && event.which !== 1) {
						return false;
					}

					var origTarget = event.target,
					    timer;

					function clearTapTimer() {
						clearTimeout(timer);
					}

					function clearTapHandlers() {
						clearTapTimer();

						$this.unbind("vclick", clickHandler).unbind("vmouseup", clearTapTimer);
						$document.unbind("vmousecancel", clearTapHandlers);
					}

					function clickHandler(event) {
						clearTapHandlers();

						// ONLY trigger a 'tap' event if the start target is
						// the same as the stop target.
						if (!isTaphold && origTarget === event.target) {
							triggerCustomEvent(thisObject, "tap", event);
						} else if (isTaphold) {
							event.preventDefault();
						}
					}

					$this.bind("vmouseup", clearTapTimer).bind("vclick", clickHandler);
					$document.bind("vmousecancel", clearTapHandlers);

					timer = setTimeout(function () {
						if (!$.event.special.tap.emitTapOnTaphold) {
							isTaphold = true;
						}
						triggerCustomEvent(thisObject, "taphold", $.Event("taphold", { target: origTarget }));
					}, $.event.special.tap.tapholdThreshold);
				});
			},
			teardown: function teardown() {
				$(this).unbind("vmousedown").unbind("vclick").unbind("vmouseup");
				$document.unbind("vmousecancel");
			}
		};

		// Also handles swipeleft, swiperight
		$.event.special.swipe = {

			// More than this horizontal displacement, and we will suppress scrolling.
			scrollSupressionThreshold: 30,

			// More time than this, and it isn't a swipe.
			durationThreshold: 1000,

			// Swipe horizontal displacement must be more than this.
			horizontalDistanceThreshold: 30,

			// Swipe vertical displacement must be less than this.
			verticalDistanceThreshold: 30,

			getLocation: function getLocation(event) {
				var winPageX = window.pageXOffset,
				    winPageY = window.pageYOffset,
				    x = event.clientX,
				    y = event.clientY;

				if (event.pageY === 0 && Math.floor(y) > Math.floor(event.pageY) || event.pageX === 0 && Math.floor(x) > Math.floor(event.pageX)) {

					// iOS4 clientX/clientY have the value that should have been
					// in pageX/pageY. While pageX/page/ have the value 0
					x = x - winPageX;
					y = y - winPageY;
				} else if (y < event.pageY - winPageY || x < event.pageX - winPageX) {

					// Some Android browsers have totally bogus values for clientX/Y
					// when scrolling/zooming a page. Detectable since clientX/clientY
					// should never be smaller than pageX/pageY minus page scroll
					x = event.pageX - winPageX;
					y = event.pageY - winPageY;
				}

				return {
					x: x,
					y: y
				};
			},

			start: function start(event) {
				var data = event.originalEvent.touches ? event.originalEvent.touches[0] : event,
				    location = $.event.special.swipe.getLocation(data);
				return {
					time: new Date().getTime(),
					coords: [location.x, location.y],
					origin: $(event.target)
				};
			},

			stop: function stop(event) {
				var data = event.originalEvent.touches ? event.originalEvent.touches[0] : event,
				    location = $.event.special.swipe.getLocation(data);
				return {
					time: new Date().getTime(),
					coords: [location.x, location.y]
				};
			},

			handleSwipe: function handleSwipe(start, stop, thisObject, origTarget) {
				if (stop.time - start.time < $.event.special.swipe.durationThreshold && Math.abs(start.coords[0] - stop.coords[0]) > $.event.special.swipe.horizontalDistanceThreshold && Math.abs(start.coords[1] - stop.coords[1]) < $.event.special.swipe.verticalDistanceThreshold) {
					var direction = start.coords[0] > stop.coords[0] ? "swipeleft" : "swiperight";

					triggerCustomEvent(thisObject, "swipe", $.Event("swipe", { target: origTarget, swipestart: start, swipestop: stop }), true);
					triggerCustomEvent(thisObject, direction, $.Event(direction, { target: origTarget, swipestart: start, swipestop: stop }), true);
					return true;
				}
				return false;
			},

			// This serves as a flag to ensure that at most one swipe event event is
			// in work at any given time
			eventInProgress: false,

			setup: function setup() {
				var events,
				    thisObject = this,
				    $this = $(thisObject),
				    context = {};

				// Retrieve the events data for this element and add the swipe context
				events = $.data(this, "mobile-events");
				if (!events) {
					events = { length: 0 };
					$.data(this, "mobile-events", events);
				}
				events.length++;
				events.swipe = context;

				context.start = function (event) {

					// Bail if we're already working on a swipe event
					if ($.event.special.swipe.eventInProgress) {
						return;
					}
					$.event.special.swipe.eventInProgress = true;

					var stop,
					    start = $.event.special.swipe.start(event),
					    origTarget = event.target,
					    emitted = false;

					context.move = function (event) {
						if (!start || event.isDefaultPrevented()) {
							return;
						}

						stop = $.event.special.swipe.stop(event);
						if (!emitted) {
							emitted = $.event.special.swipe.handleSwipe(start, stop, thisObject, origTarget);
							if (emitted) {

								// Reset the context to make way for the next swipe event
								$.event.special.swipe.eventInProgress = false;
							}
						}
						// prevent scrolling
						if (Math.abs(start.coords[0] - stop.coords[0]) > $.event.special.swipe.scrollSupressionThreshold) {
							event.preventDefault();
						}
					};

					context.stop = function () {
						emitted = true;

						// Reset the context to make way for the next swipe event
						$.event.special.swipe.eventInProgress = false;
						$document.off(touchMoveEvent, context.move);
						context.move = null;
					};

					$document.on(touchMoveEvent, context.move).one(touchStopEvent, context.stop);
				};
				$this.on(touchStartEvent, context.start);
			},

			teardown: function teardown() {
				var events, context;

				events = $.data(this, "mobile-events");
				if (events) {
					context = events.swipe;
					delete events.swipe;
					events.length--;
					if (events.length === 0) {
						$.removeData(this, "mobile-events");
					}
				}

				if (context) {
					if (context.start) {
						$(this).off(touchStartEvent, context.start);
					}
					if (context.move) {
						$document.off(touchMoveEvent, context.move);
					}
					if (context.stop) {
						$document.off(touchStopEvent, context.stop);
					}
				}
			}
		};
		$.each({
			scrollstop: "scrollstart",
			taphold: "tap",
			swipeleft: "swipe.left",
			swiperight: "swipe.right"
		}, function (event, sourceEvent) {

			$.event.special[event] = {
				setup: function setup() {
					$(this).bind(sourceEvent, $.noop);
				},
				teardown: function teardown() {
					$(this).unbind(sourceEvent);
				}
			};
		});
	})(jQuery, this);

	(function ($, undefined) {
		var props = {
			"animation": {},
			"transition": {}
		},
		    testElement = document.createElement("a"),
		    vendorPrefixes = ["", "webkit-", "moz-", "o-"];

		$.each(["animation", "transition"], function (i, test) {

			// Get correct name for test
			var testName = i === 0 ? test + "-" + "name" : test;

			$.each(vendorPrefixes, function (j, prefix) {
				if (testElement.style[$.camelCase(prefix + testName)] !== undefined) {
					props[test]["prefix"] = prefix;
					return false;
				}
			});

			// Set event and duration names for later use
			props[test]["duration"] = $.camelCase(props[test]["prefix"] + test + "-" + "duration");
			props[test]["event"] = $.camelCase(props[test]["prefix"] + test + "-" + "end");

			// All lower case if not a vendor prop
			if (props[test]["prefix"] === "") {
				props[test]["event"] = props[test]["event"].toLowerCase();
			}
		});

		// If a valid prefix was found then the it is supported by the browser
		$.support.cssTransitions = props["transition"]["prefix"] !== undefined;
		$.support.cssAnimations = props["animation"]["prefix"] !== undefined;

		// Remove the testElement
		$(testElement).remove();

		// Animation complete callback
		$.fn.animationComplete = function (callback, type, fallbackTime) {
			var timer,
			    duration,
			    that = this,
			    eventBinding = function eventBinding() {

				// Clear the timer so we don't call callback twice
				clearTimeout(timer);
				callback.apply(this, arguments);
			},
			    animationType = !type || type === "animation" ? "animation" : "transition";

			// Make sure selected type is supported by browser
			if ($.support.cssTransitions && animationType === "transition" || $.support.cssAnimations && animationType === "animation") {

				// If a fallback time was not passed set one
				if (fallbackTime === undefined) {

					// Make sure the was not bound to document before checking .css
					if ($(this).context !== document) {

						// Parse the durration since its in second multiple by 1000 for milliseconds
						// Multiply by 3 to make sure we give the animation plenty of time.
						duration = parseFloat($(this).css(props[animationType].duration)) * 3000;
					}

					// If we could not read a duration use the default
					if (duration === 0 || duration === undefined || isNaN(duration)) {
						duration = $.fn.animationComplete.defaultDuration;
					}
				}

				// Sets up the fallback if event never comes
				timer = setTimeout(function () {
					$(that).off(props[animationType].event, eventBinding);
					callback.apply(that);
				}, duration);

				// Bind the event
				return $(this).one(props[animationType].event, eventBinding);
			} else {

				// CSS animation / transitions not supported
				// Defer execution for consistency between webkit/non webkit
				setTimeout($.proxy(callback, this), 0);
				return $(this);
			}
		};

		// Allow default callback to be configured on mobileInit
		$.fn.animationComplete.defaultDuration = 1000;
	})(jQuery);
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

/**
 * AlcatrazUtilities JS object.
 *
 * This object contains a number of useful public methods. The methods can be accessed anywhere
 * on the front end using `Alcatraz.Utilities.methodName()`.
 *
 * @since  1.0.0
 */

var AlcatrazUtilities = function ($) {
  var htmlEntityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;'
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
  function escapeHtml(string) {
    return String(string).replace(/[&<>"'\/]/g, function (s) {
      return htmlEntityMap[s];
    });
  }

  /**
   * Expose public methods.
   */
  return {
    escapeHtml: escapeHtml
  };
}(jQuery);

/***/ }),
/* 3 */
/***/ (function(module, exports) {

/* eslint-disable camelcase */
/**
 * skip-link-focus-fix.js
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
  var is_webkit = -1 < navigator.userAgent.toLowerCase().indexOf('webkit'),
      is_opera = -1 < navigator.userAgent.toLowerCase().indexOf('opera'),
      is_ie = -1 < navigator.userAgent.toLowerCase().indexOf('msie');

  if ((is_webkit || is_opera || is_ie) && document.getElementById && window.addEventListener) {
    window.addEventListener('hashchange', function () {
      var id = location.hash.substring(1),
          element;

      if (!/^[A-z0-9_-]+$/.test(id)) {
        return;
      }

      element = document.getElementById(id);

      if (element) {
        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
          element.tabIndex = -1;
        }

        element.focus();
      }
    }, false);
  }
})();

/***/ }),
/* 4 */
/***/ (function(module, exports) {

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
var AlcatrazNavigation = function ($) {
  'use strict';

  var $body = $('body'),
      $window = $(window),
      toggleText = alcatraz_vars.menu_toggle || '',
      // eslint-disable-line camelcase
  closeText = alcatraz_vars.menu_close || '',
      // eslint-disable-line camelcase
  slideDuration = alcatraz_vars.slide_duration || 300; // eslint-disable-line camelcase

  /**
   * Toggle a 'focus' class on list items when using keyboard navigation.
   *
   * @since  1.0.0
   *
   * @param  {object}  event  The focus or blur event.
   */
  var _toggleListFocus = function _toggleListFocus(event) {
    var $this = $(this),
        $item = $this.parent('li');

    if ('focus' === event.type) {
      $item.addClass('focus');
    }

    if ('blur' === event.type) {
      $item.removeClass('focus');
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
  var _toggleListItem = function _toggleListItem(event, data) {
    var item = data.item || {},
        args = data.args || {};

    toggleListItem(item, args);
  };

  /**
   * Handle keyboard navigation support via tab and arrow keys across all site navigation.
   *
   * @since  1.0.0
   *
   * @param  {object}  event  The keyup event object.
   */
  var _toggleNavItemWithKeyboard = function _toggleNavItemWithKeyboard(event) {
    var code = event.keyCode ? event.keyCode : event.which,
        $el = $(document.activeElement);

    // Bail if a modified key has been pressed.
    if (event.altKey || event.ctrlKey) {
      return true;
    }

    // Bail if we don't have focus on a nav.
    if (!$el.is('nav a:focus')) {
      return true;
    }

    // Get the '<li>' element.
    var $item = $el.parent(),
        $list = $item.parent(),
        $target = void 0;

    // Build args for the toggleListItem event.
    var args = { autoClose: true, duration: slideDuration },
        closeArgs = { autoClose: false, duration: slideDuration },
        data = { item: $item, args: args };

    switch (code) {
      case 9:
        // Tab key.
        if ('keydown' === event.type) {
          return true;
        }

        if ($item.children('ul').length && $list.hasClass('top-level')) {
          // The focused nav item has children and is on the top level, so toggle it.
          $window.trigger('toggleListItem.alcatraz', data);
        } else if ($list.hasClass('top-level')) {
          // The focused nav item doesn't have children and is on the top level, so
          // close any previously toggled top level list items.
          $list.children('li.toggled').each(function () {
            var closeData = {
              item: $(this),
              args: closeArgs
            };
            $window.trigger('toggleListItem.alcatraz', closeData);
          });
        }

        break;

      case 32:
        // Spacebar.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if ($item.children('ul').length) {
          $window.trigger('toggleListItem.alcatraz', data);
        }

        break;

      case 37:
        // Left arrow key.
        // Prevent window scrolling.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if ($list.hasClass('top-level') && $item.prev('li').length) {
          // The focused nav item is on the top level and has a sibling before it,
          // so move focus to the left one item.
          $target = $item.prev('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target.find('a').first().focus();
        } else if ($list.parent('li').parent('ul').hasClass('top-level')) {
          // The focused nav item is on a second level sub level, so move focus up
          // one level to the sibling to the left of the parent item.
          $target = $list.parent('li').prev('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target.find('a').first().focus();
        } else if (!$list.hasClass('top-level')) {
          // The focused nav item is on a third level sub level or deeper, so move
          // focus up one level and toggle the parent item.
          $target = $list.parent('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target.find('a').first().focus();
        }

        break;

      case 38:
        // Up arrow key.
        // Prevent window scrolling.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if (!$list.hasClass('top-level') && !$item.prev('li').length) {
          // The focused nav item is on a sub level but lacks a sibling before it,
          // so move focus up one item.
          $list.parent('li').find('a').first().focus();
        } else if (!$list.hasClass('top-level') && $item.prev('li').length) {
          // The focused nav item is on a sub level and has a sibling before it,
          // so move focus up one item.
          $item.prev('li').find('a').first().focus();
        }

        break;

      case 39:
        // Right arrow key.
        // Prevent window scrolling.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if ($list.hasClass('top-level') && $item.next('li').length) {
          // The focused hav item is on the top level and has a sibling after it,
          // so move focus to the right one item.
          $target = $item.next('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target.find('a').first().focus();
        } else if (!$list.hasClass('top-level') && $item.children('ul').length) {
          // The focused nav item is on a sub level and has children, so toggle it if
          // it isn't toggled already.
          if (!$item.hasClass('toggled')) {
            $window.trigger('toggleListItem.alcatraz', data);
          }

          $item.children('ul').first().find('a').first().focus();
        } else if ($list.parent('li').parent('ul').hasClass('top-level')) {
          // The focused nav item is on a second level sub level, so move focus up
          // one level to the sibling to the right of the parent item.
          $target = $list.parent('li').next('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target.find('a').first().focus();
        } else if (!$list.hasClass('top-level')) {
          // The focused nav item is on a third level sub level or deeper, so move
          // focus up one level and toggle the parent item's next sibling.
          $target = $list.parent('li');

          $window.trigger('toggleListItem.alcatraz', {
            item: $target,
            args: args
          });

          $target.next('li').find('a').first().focus();
        }

        break;

      case 40:
        // Down arrow key.
        // Prevent window scrolling.
        if ('keydown' === event.type) {
          event.preventDefault();
          return true;
        }

        if ($item.children('ul').length && $list.hasClass('top-level')) {
          // The focused nav item has children and is on the top level,
          // so move focus down one level.
          $item.find('ul li').first().find('a').first().focus();
        } else if (!$list.hasClass('top-level') && $item.next('li').length) {
          // The focused nav item is on a sub level and has a sibling after it,
          // so move focus down one item.
          $item.next('li').find('a').first().focus();
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
  var toggleMobileNav = function toggleMobileNav() {
    var $container = $('#site-navigation'),
        $menu = $container.find('#primary-menu');

    if ($container.hasClass('toggled')) {
      $body.removeClass('menu-open');
      $container.removeClass('toggled');
      $menu.attr('aria-expanded', 'false');
    } else {
      $body.addClass('menu-open');
      $container.addClass('toggled');
      $menu.attr('aria-expanded', 'true');
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
  var toggleListItem = function toggleListItem($item, options) {
    var $list = $item.parents('ul').last(),
        $toggle = $item.find('.sub-level-toggle').first(),
        $parent = $toggle.parents('li').last(),
        $sub = $item.find('ul').first(),
        args = options || {},
        autoClose = args.autoClose || false,
        duration = args.duration || 500;

    if (autoClose) {
      $list.find('ul').not($parent.find('ul')).slideUp(duration);
    }

    $item.toggleClass('toggled');
    $toggle.toggleClass('toggled').blur().next('ul').slideToggle(duration).toggleClass('toggled');

    // If we're toggling a menu item on the primary nav and the menu item has children,
    // detect whether they may be overflowing off the screen and add a class if they are.
    if ($list.is('#primary-menu') && $item.hasClass('menu-item-has-children') && $item.hasClass('toggled')) {
      var rightEdge = $sub.width() + $sub.offset().left,
          screenWidth = $window.width();

      if (rightEdge > screenWidth) {
        $item.addClass('reverse-expand');
      }
    } else {
      // Delay removing the class so the slideup animation can finish.
      setTimeout(function () {
        $item.removeClass('reverse-expand');
      }, duration);
    }

    // Remove the 'toggled' class from lists and list items not in the current hierarchy.
    $list.find('.toggled').not($parent).not($parent.find('.toggled')).removeClass('toggled');

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
  var initListToggle = function initListToggle(el, options) {
    var args = options || {};

    return $(el).each(function () {
      var $list = $(this),
          $items = $list.find('li'),
          $subList = $items.has('ul'),
          safeToggleText = Alcatraz.Utils.escapeHtml(toggleText);

      var toggle = '\n        <button type="button" class="sub-level-toggle">\n          <span class="screen-reader-text">' + safeToggleText + '</span>\n          <span class="sub-level-toggle-span span-1"></span>\n          <span class="sub-level-toggle-span span-2"></span>\n        </button>';

      // Add classes to indicate levels and items.
      $list.addClass('top-level');
      $list.find('ul').addClass('sub-level');
      $items.addClass('list-item');

      // Loop over each item that has a sub level and inject the toggle.
      $subList.each(function () {
        $(this).find('a').first().after(toggle);
      });

      // Toggle the expanded state of sub levels when the toggles are clicked.
      $list.find('.sub-level-toggle').on('click', function (e) {
        e.preventDefault();

        var $item = $(this).parent('li'),
            data = {
          item: $item,
          args: args
        };

        $window.trigger('toggleListItem.alcatraz', data);
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
  var initSiteNavigation = function initSiteNavigation() {
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
  var initPrimaryNavigation = function initPrimaryNavigation() {
    var $container = $('#site-navigation');

    if (!$container) {
      return false;
    }

    var $toggle = $container.prev('.mobile-menu-toggle');

    if ('undefined' === typeof $toggle) {
      return false;
    }

    var $menu = $container.find('#primary-menu');

    if ('undefined' === typeof $menu) {
      $toggle.css('display', 'none');
      return false;
    }

    var $links = $menu.find('a'),
        $subMenus = $menu.find('ul'),
        $subLinks = $subMenus.find('a');

    $menu.attr('aria-expanded', 'false');

    if (!$menu.hasClass('nav-menu')) {
      $menu.addClass('nav-menu');
    }

    // Set up swipe-to-open support for the mobile nav.
    if ($.mobile) {
      if ($body.hasClass('mobile-nav-style-slide-left') || $body.hasClass('mobile-nav-style-slide-right')) {
        $.event.special.swipe.horizontalDistanceThreshold = 15;
        $('#mobile-nav-swipe-zone, #mobile-navr-swipe-zone, .main-navigation .menu-overlay').on('swipeleft swiperight', function () {
          $window.trigger('toggleMobileNav.alcatraz');
        });
      }
    }

    // Set up the mobile nav toggle.
    $toggle.on('click', function () {
      $window.trigger('toggleMobileNav.alcatraz');
    });

    var $screen = $('.menu-screen');

    if ('undefined' !== typeof $screen) {
      // Allow a click on the screen to close the menu.
      $screen.on('click', function () {
        $window.trigger('toggleMobileNav.alcatraz');
      });
    }

    // Set up the sub menu dropdown toggles.
    var toggleOptions = { autoClose: true, duration: slideDuration };
    initListToggle($menu, toggleOptions);

    // Set menu items with sub menus to aria-haspopup="true".
    $subMenus.each(function () {
      $(this).parent().attr('aria-haspopup', 'true');
    });

    // Set menu item links inside sub menus to not be accessible via tabIndex.
    $subLinks.attr('tabIndex', '-1');

    // Each time a menu link is focused or blurred, toggle focus.
    $links.each(function () {
      $(this).on('focus blur', _toggleListFocus);
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
  var initSubPageNavigation = function initSubPageNavigation() {
    var $subNav = $('.alcatraz-sub-page-nav > ul');

    if (!$subNav.length) {
      return false;
    }

    var toggleOptions = { autoClose: false, duration: slideDuration };

    initListToggle($subNav, toggleOptions);

    // Each time a link is focused or blurred, toggle our 'focus' class.
    $subNav.find('a').each(function () {
      $(this).on('focus blur', _toggleListFocus);
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
  var resetNavEventListeners = function resetNavEventListeners() {
    // Mobile nav toggle.
    $window.off('toggleMobileNav.alcatraz', toggleMobileNav);
    $window.on('toggleMobileNav.alcatraz', toggleMobileNav);

    // List item toggle.
    $window.off('toggleListItem.alcatraz', _toggleListItem);
    $window.on('toggleListItem.alcatraz', _toggleListItem);

    // Nav item keyboard navigation.
    $window.off('keydown keyup', _toggleNavItemWithKeyboard);
    $window.on('keydown keyup', _toggleNavItemWithKeyboard);

    return this;
  };

  /**
   * Expose public methods.
   */
  return {
    toggleMobileNav: toggleMobileNav,
    toggleListItem: toggleListItem,
    initListToggle: initListToggle,
    initSiteNavigation: initSiteNavigation,
    initPrimaryNavigation: initPrimaryNavigation,
    initSubPageNavigation: initSubPageNavigation,
    resetNavEventListeners: resetNavEventListeners
  };
}(jQuery);

/***/ }),
/* 5 */
/***/ (function(module, exports) {

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

var Alcatraz = function ($) {
  /**
   * Save component objects as properties.
   */
  var Utils = AlcatrazUtilities || false;
  var Nav = AlcatrazNavigation || false;

  /**
   * Expose public methods.
   */
  return {
    Utils: Utils,
    Nav: Nav
  };
}(jQuery);

/***/ }),
/* 6 */
/***/ (function(module, exports) {

/**
 * Initialization JS.
 *
 * This file initializes all theme functionality including all things that need to fire when
 * the DOM is ready or when the page is fully loaded.
 *
 * @since  1.0.0
 */

(function ($) {
  // When the DOM is ready, initialize all the things.
  $(document).ready(function () {
    Alcatraz.Nav.initSiteNavigation();
  });

  // Reset the primary nav when a Customizer partial refresh happens.
  $(document).on('customize-preview-menu-refreshed', function () {
    Alcatraz.Nav.initPrimaryNavigation();
  });
})(jQuery);

/***/ })
/******/ ]);
//# sourceMappingURL=frontend-bundle.js.map