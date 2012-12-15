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


	$(".slider_prev").click(function(){
	var udaljeno = $("#slider ul").css("left");
	if(udaljeno!='0px'){
	$('#slider ul').animate({left: '+=1170'});
	var palica = $(".handle").css("left");
	if(palica == '195px'){
	$(".handle").animate({left:'0'});
	}
	if(palica == '380px'){
	$(".handle").animate({left:'195'});
	}
	if(palica == '570px'){
	$(".handle").animate({left:'380'});
	}
	if(palica == '760px'){
	$(".handle").animate({left:'570'});
	}
	}
	});
	//desna
	$(".slider_next").click(function(){
	var udaljeno = $("#slider ul").css("left");
	if(udaljeno!='-5850px'){
	$('#slider ul').animate({left: '-=1170'});
	var palica = $(".handle").css("left");
	if(palica == '0px'){
	$(".handle").animate({left:'1170'});
	}
	if(palica == '1170x'){
	$(".handle").animate({left:'2340'});
	}
	if(palica == '2340px'){
	$(".handle").animate({left:'3510'});
	}
	if(palica == '3510px'){
	$(".handle").animate({left:'4680'});
	}
	}
	});

})( jQuery );