( function( $ ) {

	$( 'input[id=image]' ).change( function() {
		$( '#image1' ).val( $( this ).val() );
	});

})( jQuery );