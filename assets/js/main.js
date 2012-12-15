( function( $ ) {

	$( '.tab_content' ).hide();
	$( '.tab_content:first' ).show();

	
	$( 'ul.tabs li' ).on( 'click', function() {
		$( 'ul.tabs li' ).removeClass( 'active' );
		$( this ).addClass( 'active' );
		$( '.tab_content' ).hide();
		var activeTab = $( this ).attr( 'rel' );
		$( '#' + activeTab ).fadeIn();
	});

	
	$( 'button.comment_button' ).on( 'click', function() {
		$( '.tab_content' ).hide();
		var activeTab = $( this ).attr( 'rel' );
		$( '#' + activeTab ).fadeIn();
	});

	
	$( 'li.drop_menu' ).hover( function() {
		$( 'div.megamenu' ).stop().fadeIn();
	}, function() {
		$( 'div.megamenu' ).stop().fadeOut();
	});


	$( '.login_button' ).on( 'click', function( evt ) {
		evt.preventDefault();
		$( '.login_frame' ).fadeToggle( 300 );
	});


	$( '.fancybox' ).fancybox();

})( jQuery );