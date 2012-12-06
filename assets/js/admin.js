( function( $ ) {

	$( 'input[id=image1]' ).change( function() {
		$( '#imagereplace1' ).val( $( this ).val() );
	});
	$( 'input[id=image2]' ).change( function() {
		$( '#imagereplace2' ).val( $( this ).val() );
	});
	$( 'input[id=image3]' ).change( function() {
		$( '#imagereplace3' ).val( $( this ).val() );
	});
	$( 'input[id=image4]' ).change( function() {
		$( '#imagereplace4' ).val( $( this ).val() );
	});
	$( 'input[id=image5]' ).change( function() {
		$( '#imagereplace5' ).val( $( this ).val() );
	});

	/* for( var i = 1; i <= 5; i++ ) {
		$( 'input[id=image' + i + ']' ).change( function() {
			console.log( 'replace #imagereplace' + i);
			// $( '#imagereplace' + i ).val( $( this ).val() );
		});

		console.log( 'input: input[id=image' + i + ']' );
		console.log( '#imagereplace' + i );
	} */

	console.log( 'jquery is working' );

})( jQuery );