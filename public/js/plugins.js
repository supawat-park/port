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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/plugins.js":
/*!*********************************!*\
  !*** ./resources/js/plugins.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Allows you to add data-method="METHOD to links to automatically inject a form
 * with the method on click
 *
 * Example: <a href="{{route('customers.destroy', $customer->id)}}"
 * data-method="delete" name="delete_item">Delete</a>
 *
 * Injects a form with that's fired on click of the link with a DELETE request.
 * Good because you don't have to dirty your HTML with delete forms everywhere.
 */
function addDeleteForms() {
  $('[data-method]').append(function () {
    if (!$(this).find('form').length > 0) return "\n" + "<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" + "   <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" + "   <input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" + "</form>\n";else return "";
  }).removeAttr('href').attr('style', 'cursor:pointer;').attr('onclick', '$(this).find("form").submit();');
}
/**
 * Place any jQuery/helper plugins in here.
 */


$(function () {
  /**
   * Place the CSRF token as a header on all pages for access in AJAX requests
   */
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  /**
   * Add the data-method="delete" forms to all delete links
   */

  addDeleteForms();
  /**
   * This is for delete buttons that are loaded via AJAX in datatables, they will not work right
   * without this block of code
   */

  $(document).ajaxComplete(function () {
    addDeleteForms();
  });
  /**
   * Generic confirm form delete using Sweet Alert
   */

  $('body').on('submit', 'form[name=delete_item]', function (e) {
    e.preventDefault();
    var form = this;
    var link = $('a[data-method="delete"]');
    var cancel = link.attr('data-trans-button-cancel') ? link.attr('data-trans-button-cancel') : "Cancel";
    var confirm = link.attr('data-trans-button-confirm') ? link.attr('data-trans-button-confirm') : "Yes, delete";
    var title = link.attr('data-trans-title') ? link.attr('data-trans-title') : "Warning";
    var text = link.attr('data-trans-text') ? link.attr('data-trans-text') : "Are you sure you want to delete this item?";
    swal({
      title: title,
      type: "warning",
      showCancelButton: true,
      cancelButtonText: cancel,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: confirm,
      closeOnConfirm: true
    }, function (confirmed) {
      if (confirmed) form.submit();
    });
  });
  /**
   * Generic 'are you sure' confirm box
   */

  $('body').on('click', 'a[name=confirm_item]', function (e) {
    e.preventDefault();
    var link = $(this);
    var title = link.attr('data-trans-title') ? link.attr('data-trans-title') : "Are you sure you want to do this?";
    var cancel = link.attr('data-trans-button-cancel') ? link.attr('data-trans-button-cancel') : "Cancel";
    var confirm = link.attr('data-trans-button-confirm') ? link.attr('data-trans-button-confirm') : "Continue";
    swal({
      title: title,
      type: "info",
      showCancelButton: true,
      cancelButtonText: cancel,
      confirmButtonColor: "#3C8DBC",
      confirmButtonText: confirm,
      closeOnConfirm: true
    }, function (confirmed) {
      if (confirmed) window.location = link.attr('href');
    });
  });
  /**
   * Bind all bootstrap tooltips
   */

  $("[data-toggle=\"tooltip\"]").tooltip();
  /**
   * Bind all bootstrap popovers
   */

  $("[data-toggle=\"popover\"]").popover();
  /**
   * This closes the popover when its clicked away from
   */

  $('body').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
      if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
        $(this).popover('hide');
      }
    });
  });
});

/***/ }),

/***/ 2:
/*!***************************************!*\
  !*** multi ./resources/js/plugins.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\home_portal\resources\js\plugins.js */"./resources/js/plugins.js");


/***/ })

/******/ });