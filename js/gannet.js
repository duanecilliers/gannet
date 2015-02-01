(function ($) {

	/* global console */

	var initApp = function () {
		console.log('gannet.js initiated');
		animateLinks();
	};

	var animateLinks = function () {
		// var linkTop = $('.line-top'),
		// 	linkRight = $('.line-right'),
		// 	linkBottom = $('.line-bottom'),
		// 	linkLeft = $('.line-left');

		var selectors = ['.btn', '.nav-links a'],
			markup = '<div class="line-top">&nbsp;</div>' +
						'<div class="line-right">&nbsp;</div>' +
						'<div class="line-bottom">&nbsp;</div>' +
						'<div class="line-left">&nbsp;</div>';

		$.each(selectors, function (i, v) {
			$(v).append(markup);
		});

	};

	initApp();

})(jQuery);
