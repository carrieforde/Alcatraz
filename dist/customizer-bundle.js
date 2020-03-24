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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/customizer.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/customizer.js":
/*!***************************!*\
  !*** ./src/customizer.js ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * Alcatraz Customizer JS.\n */\n(function () {\n  // Handle live previewing for the site title.\n  wp.customize('blogname', function (value) {\n    value.bind(function (to) {\n      return document.querySelector('.site-title a').textContent = to;\n    });\n  }); // Hides / unhides site title if logo exists.\n\n  wp.customize('custom_logo', function (setting) {\n    setting.bind(function (logo) {\n      var siteTitle = document.querySelector('.site-title');\n\n      if (logo) {\n        siteTitle.classList.add('screen-reader-text');\n      }\n\n      if (!logo && siteTitle.classList.contains('screen-reader-text')) {\n        siteTitle.classList.remove('screen-reader-text');\n      }\n    });\n  }); // Handle live previewing for the site description.\n\n  wp.customize('blogdescription', function (value) {\n    value.bind(function (to) {\n      return document.querySelector('.site-description').textContent = to;\n    });\n  }); // Hides / unhides site tagline.\n\n  wp.customize('hide_tagline', function (setting) {\n    setting.bind(function (hide) {\n      var siteTagline = document.querySelector('.site-description');\n\n      if (hide) {\n        siteTagline.classList.add('screen-reader-text');\n      }\n\n      if (!hide && siteTagline.classList.contains('screen-reader-text')) {\n        siteTagline.classList.remove('screen-reader-text');\n      }\n    });\n  });\n})();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvY3VzdG9taXplci5qcy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy9jdXN0b21pemVyLmpzPzA2ZTUiXSwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBBbGNhdHJheiBDdXN0b21pemVyIEpTLlxuICovXG4oZnVuY3Rpb24gKCkge1xuICAvLyBIYW5kbGUgbGl2ZSBwcmV2aWV3aW5nIGZvciB0aGUgc2l0ZSB0aXRsZS5cbiAgd3AuY3VzdG9taXplKCdibG9nbmFtZScsIGZ1bmN0aW9uICh2YWx1ZSkge1xuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKHRvKSB7XG4gICAgICByZXR1cm4gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnNpdGUtdGl0bGUgYScpLnRleHRDb250ZW50ID0gdG87XG4gICAgfSk7XG4gIH0pOyAvLyBIaWRlcyAvIHVuaGlkZXMgc2l0ZSB0aXRsZSBpZiBsb2dvIGV4aXN0cy5cblxuICB3cC5jdXN0b21pemUoJ2N1c3RvbV9sb2dvJywgZnVuY3Rpb24gKHNldHRpbmcpIHtcbiAgICBzZXR0aW5nLmJpbmQoZnVuY3Rpb24gKGxvZ28pIHtcbiAgICAgIHZhciBzaXRlVGl0bGUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuc2l0ZS10aXRsZScpO1xuXG4gICAgICBpZiAobG9nbykge1xuICAgICAgICBzaXRlVGl0bGUuY2xhc3NMaXN0LmFkZCgnc2NyZWVuLXJlYWRlci10ZXh0Jyk7XG4gICAgICB9XG5cbiAgICAgIGlmICghbG9nbyAmJiBzaXRlVGl0bGUuY2xhc3NMaXN0LmNvbnRhaW5zKCdzY3JlZW4tcmVhZGVyLXRleHQnKSkge1xuICAgICAgICBzaXRlVGl0bGUuY2xhc3NMaXN0LnJlbW92ZSgnc2NyZWVuLXJlYWRlci10ZXh0Jyk7XG4gICAgICB9XG4gICAgfSk7XG4gIH0pOyAvLyBIYW5kbGUgbGl2ZSBwcmV2aWV3aW5nIGZvciB0aGUgc2l0ZSBkZXNjcmlwdGlvbi5cblxuICB3cC5jdXN0b21pemUoJ2Jsb2dkZXNjcmlwdGlvbicsIGZ1bmN0aW9uICh2YWx1ZSkge1xuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKHRvKSB7XG4gICAgICByZXR1cm4gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnNpdGUtZGVzY3JpcHRpb24nKS50ZXh0Q29udGVudCA9IHRvO1xuICAgIH0pO1xuICB9KTsgLy8gSGlkZXMgLyB1bmhpZGVzIHNpdGUgdGFnbGluZS5cblxuICB3cC5jdXN0b21pemUoJ2hpZGVfdGFnbGluZScsIGZ1bmN0aW9uIChzZXR0aW5nKSB7XG4gICAgc2V0dGluZy5iaW5kKGZ1bmN0aW9uIChoaWRlKSB7XG4gICAgICB2YXIgc2l0ZVRhZ2xpbmUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuc2l0ZS1kZXNjcmlwdGlvbicpO1xuXG4gICAgICBpZiAoaGlkZSkge1xuICAgICAgICBzaXRlVGFnbGluZS5jbGFzc0xpc3QuYWRkKCdzY3JlZW4tcmVhZGVyLXRleHQnKTtcbiAgICAgIH1cblxuICAgICAgaWYgKCFoaWRlICYmIHNpdGVUYWdsaW5lLmNsYXNzTGlzdC5jb250YWlucygnc2NyZWVuLXJlYWRlci10ZXh0JykpIHtcbiAgICAgICAgc2l0ZVRhZ2xpbmUuY2xhc3NMaXN0LnJlbW92ZSgnc2NyZWVuLXJlYWRlci10ZXh0Jyk7XG4gICAgICB9XG4gICAgfSk7XG4gIH0pO1xufSkoKTsiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/customizer.js\n");

/***/ })

/******/ });