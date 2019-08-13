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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/getmdl-select.js":
/*!***************************************!*\
  !*** ./resources/js/getmdl-select.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

{
  'use strict';

  (function () {
    function whenLoaded() {
      getmdlSelect.init('.getmdl-select');
    }

    ;
    window.addEventListener ? window.addEventListener("load", whenLoaded, false) : window.attachEvent && window.attachEvent("onload", whenLoaded);
  })();

  var getmdlSelect = {
    _addEventListeners: function _addEventListeners(dropdown) {
      var input = dropdown.querySelector('input');
      var hiddenInput = dropdown.querySelector('input[type="hidden"]');
      var list = dropdown.querySelectorAll('li');
      var menu = dropdown.querySelector('.mdl-js-menu');
      var arrow = dropdown.querySelector('.mdl-icon-toggle__label');
      var label = '';
      var previousValue = '';
      var previousDataVal = '';
      var opened = false;

      var setSelectedItem = function setSelectedItem(li) {
        var value = li.textContent.trim();
        input.value = value;
        list.forEach(function (li) {
          li.classList.remove('selected');
        });
        li.classList.add('selected');
        dropdown.MaterialTextfield.change(value); // handles css class changes

        setTimeout(function () {
          dropdown.MaterialTextfield.updateClasses_(); //update css class
        }, 250); // update input with the "id" value

        hiddenInput.value = li.dataset.val || '';
        previousValue = input.value;
        previousDataVal = hiddenInput.value;

        if ("createEvent" in document) {
          var evt = document.createEvent("HTMLEvents");
          evt.initEvent("change", false, true);
          menu['MaterialMenu'].hide();
          input.dispatchEvent(evt);
        } else {
          input.fireEvent("onchange");
        }
      };

      var hideAllMenus = function hideAllMenus() {
        opened = false;
        input.value = previousValue;
        hiddenInput.value = previousDataVal;

        if (!dropdown.querySelector('.mdl-menu__container').classList.contains('is-visible')) {
          dropdown.classList.remove('is-focused');
        }

        var menus = document.querySelectorAll('.getmdl-select .mdl-js-menu');
        [].forEach.call(menus, function (menu) {
          menu['MaterialMenu'].hide();
        });
        var event = new Event('closeSelect');
        menu.dispatchEvent(event);
      };

      document.body.addEventListener('click', hideAllMenus, false); //hide previous select after press TAB

      dropdown.onkeydown = function (event) {
        if (event.keyCode == 9) {
          input.value = previousValue;
          hiddenInput.value = previousDataVal;
          menu['MaterialMenu'].hide();
          dropdown.classList.remove('is-focused');
        }
      }; //show select if it have focus


      input.onfocus = function (e) {
        menu['MaterialMenu'].show();
        menu.focus();
        opened = true;
      };

      input.onblur = function (e) {
        e.stopPropagation();
      }; //hide all old opened selects and opening just clicked select


      input.onclick = function (e) {
        e.stopPropagation();

        if (!menu.classList.contains('is-visible')) {
          menu['MaterialMenu'].show();
          hideAllMenus();
          dropdown.classList.add('is-focused');
          opened = true;
        } else {
          menu['MaterialMenu'].hide();
          opened = false;
        }
      };

      input.onkeydown = function (event) {
        if (event.keyCode == 27) {
          input.value = previousValue;
          hiddenInput.value = previousDataVal;
          menu['MaterialMenu'].hide();
          dropdown.MaterialTextfield.onBlur_();

          if (label !== '') {
            dropdown.querySelector('.mdl-textfield__label').textContent = label;
            label = '';
          }
        }
      };

      menu.addEventListener('closeSelect', function (e) {
        input.value = previousValue;
        hiddenInput.value = previousDataVal;
        dropdown.classList.remove('is-focused');

        if (label !== '') {
          dropdown.querySelector('.mdl-textfield__label').textContent = label;
          label = '';
        }
      }); //set previous value and data-val if ESC was pressed

      menu.onkeydown = function (event) {
        if (event.keyCode == 27) {
          input.value = previousValue;
          hiddenInput.value = previousDataVal;
          dropdown.classList.remove('is-focused');

          if (label !== '') {
            dropdown.querySelector('.mdl-textfield__label').textContent = label;
            label = '';
          }
        }
      };

      if (arrow) {
        arrow.onclick = function (e) {
          e.stopPropagation();

          if (opened) {
            menu['MaterialMenu'].hide();
            opened = false;
            dropdown.classList.remove('is-focused');
            dropdown.MaterialTextfield.onBlur_();
            input.value = previousValue;
            hiddenInput.value = previousDataVal;
          } else {
            hideAllMenus();
            dropdown.MaterialTextfield.onFocus_();
            input.focus();
            menu['MaterialMenu'].show();
            opened = true;
          }
        };
      }

      [].forEach.call(list, function (li) {
        li.onfocus = function () {
          dropdown.classList.add('is-focused');
          var value = li.textContent.trim();
          input.value = value;

          if (!dropdown.classList.contains('mdl-textfield--floating-label') && label == '') {
            label = dropdown.querySelector('.mdl-textfield__label').textContent.trim();
            dropdown.querySelector('.mdl-textfield__label').textContent = '';
          }
        };

        li.onclick = function () {
          setSelectedItem(li);
        };

        if (li.dataset.selected) {
          setSelectedItem(li);
        }
      });
    },
    init: function init(selector) {
      var dropdowns = document.querySelectorAll(selector);
      [].forEach.call(dropdowns, function (dropdown) {
        getmdlSelect._addEventListeners(dropdown);

        componentHandler.upgradeElement(dropdown);
        componentHandler.upgradeElement(dropdown.querySelector('ul'));
      });
    }
  };
}

/***/ }),

/***/ 1:
/*!*********************************************!*\
  !*** multi ./resources/js/getmdl-select.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/andrejsergeev/projects/lottery/resources/js/getmdl-select.js */"./resources/js/getmdl-select.js");


/***/ })

/******/ });