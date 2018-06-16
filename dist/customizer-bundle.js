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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ 7:
/***/ (function(module, exports) {

/**
 * Alcatraz Customizer JS.
 */

(function ($) {
  var $body = $('body');

  // Handle live previewing for the site title.
  wp.customize('blogname', function (value) {
    value.bind(function (to) {
      $('.site-title a').text(to);
    });
  });

  // Handle live previewing for the site description.
  wp.customize('blogdescription', function (value) {
    value.bind(function (to) {
      $('.site-description').text(to);
    });
  });

  // Handle live previewing for the site layout.
  wp.customize('alcatraz_options[site_layout]', function (value) {
    value.bind(function (to) {
      $body.removeClass('full-width boxed boxed-content');
      $body.addClass(to);
    });
  });

  // Handle live previewing for the header style.
  wp.customize('alcatraz_options[header_style]', function (value) {
    value.bind(function (to) {
      $body.removeClass('header-style-default header-style-short header-style-side');
      $body.addClass('header-style-' + to);
    });
  });

  // Handle live previewing for the mobile nav toggle style.
  wp.customize('alcatraz_options[mobile_nav_toggle_style]', function (value) {
    value.bind(function (to) {
      $body.removeClass('mobile-nav-toggle-style-hamburger mobile-nav-toggle-style-button');
      $body.addClass('mobile-nav-toggle-style-' + to);
    });
  });

  // Handle live previewing for the mobile nav style.
  wp.customize('alcatraz_options[mobile_nav_style]', function (value) {
    value.bind(function (to) {
      $body.removeClass('mobile-nav-style-default mobile-nav-style-slide-left mobile-nav-style-slide-right mobile-nav-style-full-screen');
      $body.addClass('mobile-nav-style-' + to);
    });
  });

  // Handle live previewing for the mobile nav sub menu toggle style.
  wp.customize('alcatraz_options[sub_menu_toggle_style]', function (value) {
    value.bind(function (to) {
      $body.removeClass('sub-menu-toggle-style-chevron sub-menu-toggle-style-plus-minus');
      $body.addClass('sub-menu-toggle-style-' + to);
    });
  });
})(jQuery);

/***/ })

/******/ });
//# sourceMappingURL=customizer-bundle.js.map