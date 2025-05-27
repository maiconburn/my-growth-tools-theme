(function( $ ) {
	'use strict';

	// Site-wide JavaScript functionality
	$(document).ready(function() {
		// Initialize any carousels or sliders
		if ($.fn.slick) {
			$('.testimonial-slider').slick({
				dots: true,
				arrows: false,
				infinite: true,
				speed: 500,
				slidesToShow: 1,
				adaptiveHeight: true
			});
		}

		// Handle newsletter form submission
		$('.newsletter-form').on('submit', function(e) {
			e.preventDefault();
			var $form = $(this);
			var $emailInput = $form.find('input[type="email"]');
			var email = $emailInput.val();
			var $messages = $form.siblings('.newsletter-messages'); // Check for existing messages div

			// If no dedicated messages div, create one after the form
			if (!$messages.length) {
				$form.after('<div class="newsletter-messages"></div>');
				$messages = $form.siblings('.newsletter-messages');
			}
			
			$messages.text( 'Processing...' ).removeClass('error success'); // i18n: text to be translated if needed

			// Basic client-side validation
			if ( !email || email.indexOf('@') === -1 ) {
				$messages.text( 'Invalid email address.' ).addClass('error'); // i18n
				return;
			}

			$.ajax({
				type: 'POST',
				url: myGrowthToolsTheme.ajax_url,
				data: {
					action: 'my_growth_tools_subscribe_newsletter',
					nonce: myGrowthToolsTheme.nonce,
					email: email
				},
				success: function(response) {
					if (response.success) {
						$messages.text(response.data.message).addClass('success');
						$emailInput.val('');
					} else {
						$messages.text(response.data.message || 'An error occurred.').addClass('error'); // i18n
					}
				},
				error: function() {
					$messages.text('An error occurred. Please try again.').addClass('error'); // i18n
				}
			});
		});

		// Add smooth fade-in effect for page elements
		$('.fade-in').each(function() {
			$(this).addClass('visible');
		});

		// Add active class to current menu item
		$('.main-navigation a[href="' + window.location.href + '"]').addClass('active');
		
		// Initialize tooltips if available
		if ($.fn.tooltip) {
			$('[data-toggle="tooltip"]').tooltip();
		}

		// Handle back to top button
		var backToTop = $('.back-to-top');
		
		if (backToTop.length) {
			$(window).scroll(function() {
				if ($(this).scrollTop() > 300) {
					backToTop.addClass('show');
				} else {
					backToTop.removeClass('show');
				}
			});

			backToTop.on('click', function(e) {
				e.preventDefault();
				$('html, body').animate({scrollTop: 0}, 800);
			});
		}
	});

})( jQuery );
