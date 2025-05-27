(function( $ ) {
	'use strict';

	// Navigation toggle
	$(document).ready(function() {
		$('.menu-toggle').on('click', function() {
			$(this).toggleClass('active');
			$('.main-navigation ul').toggleClass('active');
		});

		// Add dropdown toggle to menu items with children
		$('.menu-item-has-children > a').after('<button class="dropdown-toggle" aria-expanded="false"><span class="screen-reader-text">Expand child menu</span></button>');

		// Toggle dropdown on click
		$('.dropdown-toggle').on('click', function(e) {
			e.preventDefault();
			$(this).toggleClass('active');
			$(this).next('.sub-menu').toggleClass('active');
			$(this).attr('aria-expanded', $(this).attr('aria-expanded') === 'false' ? 'true' : 'false');
		});

		// Fixed header on scroll
		var header = $('.site-header');
		var headerHeight = header.outerHeight();
		var scrollPosition = $(window).scrollTop();

		function updateHeaderClass() {
			scrollPosition = $(window).scrollTop();
			
			if (scrollPosition > 50) {
				header.addClass('scrolled');
			} else {
				header.removeClass('scrolled');
			}
		}

		updateHeaderClass();
		
		$(window).on('scroll', function() {
			updateHeaderClass();
		});

		// Smooth scroll to anchors
		$('a[href*="#"]:not([href="#"])').on('click', function() {
			if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top - headerHeight
					}, 1000);
					return false;
				}
			}
		});

		// Accessible keyboard navigation for dropdown menus
		$('.menu-item-has-children > a').on('keydown', function(e) {
			if (e.keyCode === 13 || e.keyCode === 32) {
				e.preventDefault();
				$(this).siblings('.dropdown-toggle').trigger('click');
			}
		});
	});

})( jQuery );
