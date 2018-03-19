(function( $ ) {

	/*
	 * Shows a live preview of changing the site title.
	 */
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			if ( ! $( '#site-title img' ).length ) 
				$( '#site-title a' ).html( to );
		} ); // value.bind
	} ); // wp.customize

	/*
	 * Shows a live preview of changing the site description.
	 */
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).html( to );
		} ); // value.bind

	} ); // wp.customize	

}( jQuery ));