jQuery( document ).ready( function( $ ) {	
	$( '.newsletter-form' ).submit(function(e) {
		e.preventDefault();
		
		var successMSG 		= "<p>"+ ajaxVars.success +"</p>";
		var invalidEmailMSG = "<p>"+ ajaxVars.email +"</p>";
		var errorMSG 		= "<p>"+ ajaxVars.error +"</p>";

		$( this ).ajaxSubmit({
			success	: function ( responseText ) {
				if ( responseText === 'added' ) {
					$( '.luminous_widget_newsletter p' ).replaceWith( successMSG ).fadeIn( 'slow' );
				} else if ( responseText === 'invalid email' ) {
					$( '.luminous_widget_newsletter p' ).replaceWith( invalidEmailMSG ).fadeIn( 'slow' );
				} else {
					$( '.luminous_widget_newsletter p' ).replaceWith( errorMSG ).fadeIn( 'slow' );
				}
			},
			url		: ajaxVars.ajaxurl,
			data	: { ajax_nonce : ajaxVars.ajax_nonce, action : 'add_to_mailchimp_list' },
			type	: 'POST',
			timeout	: 50000,
		});
	});
}(jQuery));