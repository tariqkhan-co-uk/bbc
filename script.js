(function($, window, document, undefined) {
	"use strict";
	$.tkTop = function(options) {
		// Configuration
		var defaults = {
				animSpeed:		600,			// Animation speed (ms)
				footer:			'#footer',		// Element containg site footer
				scroll:			'#scrollup',	// Scroller element
				pageTop:		'#top',			// Anchor for top most element
				scrollTitle:	'Scroll to the top of the page', // Title text for scroller
				topDistance:	false,			// Distance from top before showing scroll
				scrollContent:	false,			// Content placed in scroller anchor else false
				removeLink:		'.toplink'		// Remove static back to top link if exists else false
			},
			o = $.extend({}, defaults, options);
		// Hash change listener (activation of an in-page link) to set focus to and highlight the target element as webkit does not set focus as it should
		$(window).bind('hashchange', function() {
			var hash = '#'+window.location.hash.replace(/^#/,'');
			if(hash != '#') {
				var $target = $(hash).length && $(hash) || $('[name='+hash.slice(1)+']');
				if($target.length) {
					$('html, body').animate({scrollTop:$target.offset().top}, 900, function() {
						$(hash).attr('tabindex', -1).on('blur focusout', function() {
							$(this).removeAttr('tabindex').removeClass('anchored');
						}).focus().addClass('anchored');
					});
				}
			} else { // If hash is empty (user hit the back button after activating an in-page link) focus is set to body
				var $target = $('#top');
				if($target.length) $('html, body').animate({scrollTop:$target.offset().top}, 900, function() {
					$target.attr('tabindex', -1).on('blur focusout', function() {
						$(this).removeAttr('tabindex');
					}).focus();
				});
			}
		});
		// Scroll to top
		function scrollUp() {
			if(o.removeLink) {
				$(o.removeLink).remove();
			}
			var $scroller = $('<a>',{id:o.scroll.replace('#',''),href:o.pageTop,title:o.scrollTitle}).html('<span>').prependTo(o.footer).hide();
			if(o.scrollContent) {
				$scroller.html(o.scrollContent);
			}
			if($(window).scrollTop() > o.topDistance) {
				$scroller.show();
			}
			$(window).scroll(function() {
				$( ($(window).scrollTop() > o.topDistance) ? $scroller.slideDown(o.animSpeed) : $scroller.slideUp(o.animSpeed) );
			});
			$scroller.click(function(e) {
				$('html, body').animate({scrollTop:0}, o.animSpeed);
				e.preventDefault();
			});
			// Avoid footer
			var pos = $scroller.css('bottom');
			function checkOffset() {
				if($scroller.offset().top + $scroller.height() >= $(o.footer).offset().top) {
					$scroller.css('bottom', $(o.footer).outerHeight());
				}
				if($(document).scrollTop() + window.innerHeight < $(o.footer).offset().top) {
					$scroller.css('bottom', pos); // restore when you scroll up
				}
			}
			$(document).scroll(function() {
				checkOffset();
			});
		}
		// Intitiate functions
		scrollUp();
	};
})(jQuery, window, document);
$(document).ready(function() {
	$.tkTop();
});
