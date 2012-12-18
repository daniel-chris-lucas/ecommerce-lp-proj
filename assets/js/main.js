( function( $ ) {

	// cache tout le contenu dans le panel de description / commentaires sur la page des produits.
	// ensuite affiche que le contenu dans l'onglet description
	$( '.tab_content' ).hide();
	$( '.tab_content:first' ).show();
	
	// quand on clique sur un onglet du panel il faut cacher le contenu de l'onglet active puis afficher le contenu de l'onglet
	// souhaité
	$( 'ul.tabs li' ).on( 'click', function() {
		$( 'ul.tabs li' ).removeClass( 'active' );
		$( this ).addClass( 'active' );
		$( '.tab_content' ).hide();
		var activeTab = $( this ).attr( 'rel' );
		$( '#' + activeTab ).fadeIn();
	});
	
	// quand on clique sur le bouton d'ajout de commentaires il faut cahcer les commentaires et afficher le formulaire d'ajout
	// de commetaires.
	$( 'button.comment_button' ).on( 'click', function() {
		$( '.tab_content' ).hide();
		var activeTab = $( this ).attr( 'rel' );
		$( '#' + activeTab ).fadeIn();
	});
	

	// Quand l'utilisateur survol Categories avec le souris il faut afficher la liste des categories dans un div
	$( 'li.drop_menu' ).hover( function() {
		$( 'div.megamenu' ).stop().fadeIn();
	}, function() {
		$( 'div.megamenu' ).stop().fadeOut();
	});


	// Quand l'utilisateur clique sur Login/Register il faut afficher le focmulaire de connexion dans un div avec un lien pour s'enregistrer
	// sur le site
	$( '.login_button' ).on( 'click', function( evt ) {
		evt.preventDefault();
		$( '.login_frame' ).fadeToggle( 300 );
	});


	// Quand l'utilisateur clique sur le bouton de recherche il faut afficher une barre de recherche dans un div
	$( '.search' ).on( 'click', function( evt ) {
		evt.preventDefault();
		$( '.search_panel' ).fadeToggle( 300 );
	});


	// Initialisation de fancybox pour permettre d'agrandir les images des produits
	$( '.fancybox' ).fancybox();


	// Initialisation du slider principal pour afficher les gros images sur la page d'accueil
	$('.flexslider').flexslider({
		animation: 'slide',
		slideshow: true,
		slideshowSpeed: 5000,
		pauseOnHover: true
	});


	// Permet d'afficher les messages d'infomation (erreur / confirmation ) pendant 5 secondes avant des les faire disparaitre.
	$( '.flash_message' ).show().delay( 5000 ).fadeOut( 300 );


	// Initialisation de scrollable pour permettre de faire defiller les produits dans la partie "Featured products" de la page d'accueil
	$(".scrollable").scrollable({
		circular: true
	}).autoscroll({
		autoplay: true,
		interval: 5000
	});

})( jQuery );