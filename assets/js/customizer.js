(function( $ ) {
    'use strict';

    // Site Title
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            $( '.site-title a' ).html( newval );
        } );
    } );

    // Site Description
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( newval ) {
            $( '.site-description' ).html( newval );
        } );
    } );

    // Header Text Color
    wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( newval ) {
            $( '.site-title a, .site-description' ).css( 'color', newval );
        } );
    } );

    // Primary Color
    wp.customize( 'primary_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--primary-color', newval);
        } );
    } );

    // Secondary Color
    wp.customize( 'secondary_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--secondary-color', newval);
        } );
    } );

    // Text Color
    wp.customize( 'text_color', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty('--text-color', newval);
            $( 'body' ).css( 'color', newval );
        } );
    } );

    // Hero Title
    wp.customize( 'hero_title', function( value ) {
        value.bind( function( newval ) {
            $( '.hero-title' ).html( newval );
        } );
    } );

    // Hero Description
    wp.customize( 'hero_description', function( value ) {
        value.bind( function( newval ) {
            $( '.hero-description' ).html( newval );
        } );
    } );

    // Hero Button Text
    wp.customize( 'hero_button_text', function( value ) {
        value.bind( function( newval ) {
            $( '.hero-button' ).html( newval );
        } );
    } );

    // Hero Button URL
    wp.customize( 'hero_button_url', function( value ) {
        value.bind( function( newval ) {
            $( '.hero-button' ).attr( 'href', newval );
        } );
    } );

    // Featured Section Title
    wp.customize( 'featured_section_title', function( value ) {
        value.bind( function( newval ) {
            $( '.featured-section .section-title' ).html( newval );
        } );
    } );

    // Featured Section Link Text
    wp.customize( 'featured_section_link_text', function( value ) {
        value.bind( function( newval ) {
            $( '.featured-section .section-link' ).html( newval );
        } );
    } );

    // Featured Section Link URL
    wp.customize( 'featured_section_link_url', function( value ) {
        value.bind( function( newval ) {
            $( '.featured-section .section-link' ).attr( 'href', newval );
        } );
    } );

    // Newsletter Title
    wp.customize( 'newsletter_title', function( value ) {
        value.bind( function( newval ) {
            $( '.newsletter-section .newsletter-title' ).html( newval );
        } );
    } );

    // Newsletter Description
    wp.customize( 'newsletter_description', function( value ) {
        value.bind( function( newval ) {
            $( '.newsletter-section .newsletter-description' ).html( newval );
        } );
    } );

    // Newsletter Placeholder
    wp.customize( 'newsletter_placeholder', function( value ) {
        value.bind( function( newval ) {
            $( '.newsletter-form input[type="email"]' ).attr( 'placeholder', newval );
        } );
    } );

    // Newsletter Button Text
    wp.customize( 'newsletter_button_text', function( value ) {
        value.bind( function( newval ) {
            $( '.newsletter-form button' ).html( newval );
        } );
    } );

    // Footer Copyright
    wp.customize( 'footer_copyright', function( value ) {
        value.bind( function( newval ) {
            $( '.site-info' ).html( newval ); // Target .site-info as per instruction, can be refined later.
        } );
    } );

})( jQuery );
