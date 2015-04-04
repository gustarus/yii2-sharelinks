/**
 * Created by:  Pavel Kondratenko.
 * Created at:  04.04.15 17:21
 * Email:       gustarus@gmail.com
 * Web:         http://webulla.ru
 */

(function ($) {
	var name = 'sharelinks';

	var defaults = {
		height: 450, // sets the height in pixels of the window.
		width: 600, // sets the width in pixels of the window.
		toolbar: 0, // determines whether a toolbar (includes the forward and back buttons) is displayed {1 (YES) or 0 (NO)}.
		scrollbars: 0, // determines whether scrollbars appear on the window {1 (YES) or 0 (NO)}.
		status: 0, // whether a status line appears at the bottom of the window {1 (YES) or 0 (NO)}.
		resizable: 1, // whether the window can be resized {1 (YES) or 0 (NO)}. Can also be overloaded using resizable.
		left: 0, // left position when the window appears.
		top: 0, // top position when the window appears.
		center: 1, // should we center the window? {1 (YES) or 0 (NO)}. overrides top and left
		location: 0, // determines whether the address bar is displayed {1 (YES) or 0 (NO)}.
		menubar: 0 // determines whether the menu bar is displayed {1 (YES) or 0 (NO)}.
	};

	var methods = {
		init: function (settings) {
			settings = $.extend({}, defaults, settings);

			// центрирование окна
			if (settings.center == 1) {
				settings.top = (screen.height - (settings.height + 110)) / 2;
				settings.left = (screen.width - settings.width) / 2;
			}

			// сборка параметров окна
			settings.parameters = 'location=' + settings.location +
				',menubar=' + settings.menubar +
				',height=' + settings.height +
				',width=' + settings.width +
				',toolbar=' + settings.toolbar +
				',scrollbars=' + settings.scrollbars +
				',status=' + settings.status +
				',resizable=' + settings.resizable +
				',left=' + settings.left +
				',screenX=' + settings.left +
				',top=' + settings.top +
				',screenY=' + settings.top;

			this.each(function () {
				var $link = $(this);
				if (!$link.data('sharelinks')) {
					$link.data('sharelinks', settings);
					$link.click(function (e) {
						e.preventDefault();
						methods.exec.call($link);
					});
				}
			});

			return this;
		},

		set: function (key, value) {
			var settings = this.data(name);
			if (typeof key == 'object') {
				settings = $.extend(this.data(name), key);
			} else {
				settings.key = value;
			}

			this.data(name, settings);
		},

		get: function (key) {
			var settings = this.data(name);
			if (typeof key == 'undefined') {
				return settings;
			}

			return settings.key;
		},

		exec: function () {
			var settings = this.data(name);
			var popup = window.open(this[0].href, 'sharelinks-window', settings.parameters);
			popup.focus();
			return this;
		}
	};

	$.fn.sharelinks = function (method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			console.error('$.sharelinks() Method ' + method + ' was not found.');
		}
	};
})(jQuery);