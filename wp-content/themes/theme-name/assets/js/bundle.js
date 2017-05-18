(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

var _example = require("./modules/example.js");

var objects = {
	name: "Jack Mean",
	description: "Jack is a lone wolf, from cold high mountain."
};

var example = new _example.Example(objects);

console.log(example.getName());

},{"./modules/example.js":2}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Example = exports.Example = function () {
	function Example(parameters) {
		_classCallCheck(this, Example);

		this.name = parameters.name;
		this.description = parameters.description;
	}

	_createClass(Example, [{
		key: "getName",
		value: function getName() {
			return this.name;
		}
	}]);

	return Example;
}();

},{}]},{},[1])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJkZXZlbG9wbWVudFxcanNcXGFwcC5qcyIsImRldmVsb3BtZW50XFxqc1xcbW9kdWxlc1xcZXhhbXBsZS5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7O0FDQUE7O0FBRUEsSUFBSSxVQUFVO0FBQ2IsT0FBTyxXQUFQO0FBQ0EsY0FBYywrQ0FBZDtDQUZHOztBQUtKLElBQUksVUFBVSxxQkFBWSxPQUFaLENBQVY7O0FBRUosUUFBUSxHQUFSLENBQVksUUFBUSxPQUFSLEVBQVo7Ozs7Ozs7Ozs7Ozs7SUNUYTtBQUNaLFVBRFksT0FDWixDQUFZLFVBQVosRUFBd0I7d0JBRFosU0FDWTs7QUFDdkIsT0FBSyxJQUFMLEdBQVksV0FBVyxJQUFYLENBRFc7QUFFdkIsT0FBSyxXQUFMLEdBQW1CLFdBQVcsV0FBWCxDQUZJO0VBQXhCOztjQURZOzs0QkFNRjtBQUNULFVBQU8sS0FBSyxJQUFMLENBREU7Ozs7UUFORSIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uIGUodCxuLHIpe2Z1bmN0aW9uIHMobyx1KXtpZighbltvXSl7aWYoIXRbb10pe3ZhciBhPXR5cGVvZiByZXF1aXJlPT1cImZ1bmN0aW9uXCImJnJlcXVpcmU7aWYoIXUmJmEpcmV0dXJuIGEobywhMCk7aWYoaSlyZXR1cm4gaShvLCEwKTt2YXIgZj1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK28rXCInXCIpO3Rocm93IGYuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixmfXZhciBsPW5bb109e2V4cG9ydHM6e319O3Rbb11bMF0uY2FsbChsLmV4cG9ydHMsZnVuY3Rpb24oZSl7dmFyIG49dFtvXVsxXVtlXTtyZXR1cm4gcyhuP246ZSl9LGwsbC5leHBvcnRzLGUsdCxuLHIpfXJldHVybiBuW29dLmV4cG9ydHN9dmFyIGk9dHlwZW9mIHJlcXVpcmU9PVwiZnVuY3Rpb25cIiYmcmVxdWlyZTtmb3IodmFyIG89MDtvPHIubGVuZ3RoO28rKylzKHJbb10pO3JldHVybiBzfSkiLCJpbXBvcnQge0V4YW1wbGV9IGZyb20gJy4vbW9kdWxlcy9leGFtcGxlLmpzJztcclxuXHJcbnZhciBvYmplY3RzID0ge1xyXG5cdG5hbWUgOiBcIkphY2sgTWVhblwiLFxyXG5cdGRlc2NyaXB0aW9uIDogXCJKYWNrIGlzIGEgbG9uZSB3b2xmLCBmcm9tIGNvbGQgaGlnaCBtb3VudGFpbi5cIlxyXG59O1xyXG5cclxudmFyIGV4YW1wbGUgPSBuZXcgRXhhbXBsZShvYmplY3RzKTtcclxuXHJcbmNvbnNvbGUubG9nKGV4YW1wbGUuZ2V0TmFtZSgpKTtcclxuIiwiZXhwb3J0IGNsYXNzIEV4YW1wbGUge1xyXG5cdGNvbnN0cnVjdG9yKHBhcmFtZXRlcnMpIHtcclxuXHRcdHRoaXMubmFtZSA9IHBhcmFtZXRlcnMubmFtZTtcclxuXHRcdHRoaXMuZGVzY3JpcHRpb24gPSBwYXJhbWV0ZXJzLmRlc2NyaXB0aW9uO1xyXG5cdH1cclxuXHJcblx0Z2V0TmFtZSgpIHtcclxuXHRcdHJldHVybiB0aGlzLm5hbWU7XHJcblx0fVxyXG59XHJcbiJdfQ==
