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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

//require('./bootstrap');
__webpack_require__(/*! ./script */ "./resources/js/script.js");

/***/ }),

/***/ "./resources/js/script.js":
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var auto = true;
  var intervalTime = 5000;
  var slideInterval;
  $("#next").click(function () {
    nextSlide();
    clearInterval(slideInterval); //Run next slide at interval

    slideInterval = setInterval(nextSlide, intervalTime);
  });
  $("#prev").click(function () {
    prevSlide();
    clearInterval(slideInterval); //Run next slide at interval

    slideInterval = setInterval(nextSlide, intervalTime);
  });

  var nextSlide = function nextSlide() {
    var current = $(".active-slide");
    current.removeClass("active-slide");

    if (current.next().length != 0) {
      current.next().addClass("active-slide");
    } else {
      $(".slide:first-child").addClass("active-slide");
    }

    setTimeout(function () {
      return current.removeClass("active-slide");
    });
  };

  var prevSlide = function prevSlide() {
    var current = $(".active-slide"); //Remove current class

    current.removeClass("active-slide"); //Check for previous slide

    if (current.prev().length != 0) {
      //Add active-slide to previous slide
      current.prev().addClass("active-slide");
    } else {
      //Add current to last slide
      $(".slide:last-child").addClass("active-slide");
    }

    setTimeout(function () {
      return current.removeClass("active-slide");
    });
  }; //Auto slide


  if (auto) {
    //Run next slide at interval
    slideInterval = setInterval(nextSlide, intervalTime);
  }

  $(".btn-add-to-cart").click(function () {
    $("#slide-cart").addClass("show-cart");
  });
  $("#cart-close").click(function () {
    $("#slide-cart").removeClass("show-cart");
  });
  $("#show-cat").click(function () {
    $(".nav-sub-menu").toggleClass("show-cat");
  });
  $("#myBtn").click(function () {
    $("#myModal").css("display", "block");
  });
  $("#closeModal").click(function () {
    $("#myModal").css("display", "none");
  });
  $(window).click(function (e) {
    if ($(e.target).is("#myModal")) {
      $("#myModal").css("display", "none");
    }
  });
  $(".all-imgs img").click(function () {
    var imgSrc = $(this).attr("src");
    $(this).addClass("active-img").siblings().removeClass("active-img");
    $("#main-img").css("background-image", "url('".concat(imgSrc, "')"));
  });
  $("#main-img").mousemove(function (e) {
    var width = $(this).width();
    var height = $(this).height();
    var mouseX = e.offsetX;
    var mouseY = e.offsetY;
    var posX = mouseX / width * 100;
    var posY = mouseY / height * 100;
    $(this).css("background-position", "".concat(posX, "% ").concat(posY, "%"));
  });
  $("#main-img").mouseout(function (e) {
    $(this).css("background-position", "center"); //console.log(e);
  }); // const animatethis = (targetElement, speed) => {
  //   const scrollWidth = $(targetElement).get(0).scrollWidth;
  //   const clientWidth = $(targetElement).get(0).clientWidth;
  //   $(targetElement).animate(
  //     { scrollLeft: scrollWidth - clientWidth },
  //     {
  //       duration: speed,
  //       complete: () => {
  //         targetElement.animate(
  //           { scrollLeft: 0 },
  //           {
  //             duration: speed,
  //             complete: () => {
  //               animatethis(targetElement, speed);
  //             },
  //           }
  //         );
  //       },
  //     }
  //   );
  // };
  // animatethis($(".more-items"), 10000);
  // work in progress - needs some refactoring and will drop JQuery i promise :)

  var instance = $(".hs__wrapper");
  $.each(instance, function (key, value) {
    var _this = this;

    var arrows = $(instance[key]).find(".arrow"),
        prevArrow = arrows.filter(".arrow-prev"),
        nextArrow = arrows.filter(".arrow-next"),
        box = $(instance[key]).find(".hs"),
        x = 0,
        mx = 0,
        maxScrollWidth = box[0].scrollWidth - box[0].clientWidth / 2 - box.width() / 2;
    $(arrows).on("click", function () {
      if ($(this).hasClass("arrow-next")) {
        x = box.width() / 2 + box.scrollLeft() - 10;
        box.animate({
          scrollLeft: x
        });
      } else {
        x = box.width() / 2 - box.scrollLeft() - 10;
        box.animate({
          scrollLeft: -x
        });
      }
    });
    $(box).on({
      mousemove: function mousemove(e) {
        var mx2 = e.pageX - _this.offsetLeft;
        if (mx) _this.scrollLeft = _this.sx + mx - mx2;
      },
      mousedown: function mousedown(e) {
        _this.sx = _this.scrollLeft;
        mx = e.pageX - _this.offsetLeft;
      },
      scroll: function scroll() {
        toggleArrows();
      }
    });
    $(document).on("mouseup", function () {
      mx = 0;
    });

    var toggleArrows = function toggleArrows() {
      if (box.scrollLeft() > maxScrollWidth - 10) {
        // disable next button when right end has reached
        nextArrow.addClass("disabled");
      } else if (box.scrollLeft() < 10) {
        // disable prev button when left end has reached
        prevArrow.addClass("disabled");
      } else {
        // both are enabled
        nextArrow.removeClass("disabled");
        prevArrow.removeClass("disabled");
      }
    };
  });
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /var/www/html/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /var/www/html/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });