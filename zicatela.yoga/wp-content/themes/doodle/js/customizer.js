/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( "| " + to );
		} );
	} );
	// Logo.
	wp.customize( 'doodle_logo', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-name' ).html ( '<a href="#"><img src="' + to + '"></a>' );
			}
			else {
				var siteTitle = wp.customize( 'blogname' )();
				$( '.site-name' ).html( "<h1 class='site-title'><a href='#'>" + siteTitle + "</a></h1>" );
				if ( wp.customize( 'doodle_display_tagline' )() ) {
					var siteDescription = wp.customize( 'blogdescription' )();
					$( '.site-name' ).append( "<h2 class='site-description'>| " + siteDescription + "</h2>" );
				}
			}
		} );
	} );
	wp.customize( 'doodle_color_scheme', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'blue blue-brown blue-paleyellow bluegray bluegreen brown brown-beige brown-blue cyan fuchsia-blue gold green green-grey lightbrown ochre orange pink purple purple-bluegray purple-green red red-green red-paleyellow yellow-green yellow-orange custom-color-scheme' );
			$( 'body' ).addClass( to );
		} );
	} );
	wp.customize( 'doodle_fixed_navbar', function( value ) {
		value.bind( function( to ) {
			if (to) {
				$( 'body' ).addClass( 'fixed-header' );
			} else {
				$( 'body' ).removeClass( 'fixed-header' );
			}
		} );
	} );
	wp.customize( 'doodle_display_tagline', function( value ) {
		value.bind( function( to ) {
			if (to) {
				$( 'h2.site-description' ).removeClass( 'hidden' );
			} else {
				$( 'h2.site-description' ).addClass( 'hidden' );
			}
		} );
	} );
} )( jQuery );
