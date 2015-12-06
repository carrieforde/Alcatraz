/**
 * Alcatraz Customizer JS.
 */

( function( $ ) {

	var $body = $( 'body' );

	// Handle live previewing for the site title.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});

	// Handle live previewing for the site description.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Handle live previewing for the site layout.
	wp.customize( 'alcatraz_options[site_layout]', function( value ) {
		value.bind( function( to ) {
			$body.removeClass( 'full-width boxed boxed-content' );
			$body.addClass( to );
		});
	});

	// Handle live previewing for the header style.
	wp.customize( 'alcatraz_options[header_style]', function( value ) {
		value.bind( function( to ) {
			$body.removeClass( 'header-style-default header-style-short header-style-side' );
			$body.addClass( 'header-style-' + to );
		});
	});

	// Handle live previewing for the mobile nav toggle style.
	wp.customize( 'alcatraz_options[mobile_nav_toggle_style]', function( value ) {
		value.bind( function( to ) {
			$body.removeClass( 'mobile-nav-toggle-style-hamburger mobile-nav-toggle-style-button' );
			$body.addClass( 'mobile-nav-toggle-style-' + to );
		});
	});

	// Handle live previewing for the mobile nav style.
	wp.customize( 'alcatraz_options[mobile_nav_style]', function( value ) {
		value.bind( function( to ) {
			$body.removeClass( 'mobile-nav-style-default mobile-nav-style-slide-left mobile-nav-style-slide-right mobile-nav-style-full-screen' );
			$body.addClass( 'mobile-nav-style-' + to );
		});
	});

})( jQuery );
