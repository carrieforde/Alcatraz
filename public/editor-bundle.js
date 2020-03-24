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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/editor.js":
/*!***********************!*\
  !*** ./src/editor.js ***!
  \***********************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * Alcatraz Editor JS.\n *///# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvZWRpdG9yLmpzLmpzIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vc3JjL2VkaXRvci5qcz8zMmZjIl0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogQWxjYXRyYXogRWRpdG9yIEpTLlxuICovIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/editor.js\n");

/***/ }),

/***/ "./src/sass/editor.scss":
/*!******************************!*\
  !*** ./src/sass/editor.scss ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("throw new Error(\"Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\\nModuleBuildError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\\nSassError: Undefined variable: \\\"$link\\\".\\n        on line 86 of /Users/carrie/Desktop/WordPress/alcatraz/app/public/wp-content/themes/alcatraz/src/sass/editor.scss\\n>> \\t\\t\\tcolor: $link;\\n\\n   ----------^\\n\\n    at /Users/carrie/Desktop/WordPress/alcatraz/app/public/wp-content/themes/alcatraz/node_modules/webpack/lib/NormalModule.js:316:20\\n    at /Users/carrie/Desktop/WordPress/alcatraz/app/public/wp-content/themes/alcatraz/node_modules/loader-runner/lib/LoaderRunner.js:367:11\\n    at /Users/carrie/Desktop/WordPress/alcatraz/app/public/wp-content/themes/alcatraz/node_modules/loader-runner/lib/LoaderRunner.js:233:18\\n    at context.callback (/Users/carrie/Desktop/WordPress/alcatraz/app/public/wp-content/themes/alcatraz/node_modules/loader-runner/lib/LoaderRunner.js:111:13)\\n    at Object.callback (/Users/carrie/Desktop/WordPress/alcatraz/app/public/wp-content/themes/alcatraz/node_modules/sass-loader/dist/index.js:73:7)\\n    at Object.done [as callback] (/Users/carrie/Desktop/WordPress/alcatraz/app/public/wp-content/themes/alcatraz/node_modules/neo-async/async.js:8067:18)\\n    at options.error (/Users/carrie/Desktop/WordPress/alcatraz/app/public/wp-content/themes/alcatraz/node_modules/node-sass/lib/index.js:294:32)\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvc2Fzcy9lZGl0b3Iuc2Nzcy5qcyIsInNvdXJjZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/sass/editor.scss\n");

/***/ }),

/***/ 1:
/*!****************************************************!*\
  !*** multi ./src/editor.js ./src/sass/editor.scss ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./src/editor.js */"./src/editor.js");
module.exports = __webpack_require__(/*! ./src/sass/editor.scss */"./src/sass/editor.scss");


/***/ })

/******/ });