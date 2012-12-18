<?php
/**
 * Contient les pages de vue des produits, du panier, et de la recherche
 */
class Controller_Products extends Controller_Base
{

	/**
	 * Affiche la page de decription des produits
	 * @param  String $product_slug Le titre optimisé du produit
	 */
	public function action_view( $product_slug )
	{
		// Chercher le produit dans la base de données en fonction du titre passé en paramètre
		$product = Model_Product::find( 'first', array(
			'where' => array(
				array( 'slug', 'like', $product_slug )
			),
		));

		// Définir les règles de validation pour le formulaire de commentaires sur les produits
		$val = Validation::forge( 'comments_val' );
		$val->add_callable( 'myrules' );

		$val->add( 'review' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 10 )
			->add_rule( 'max_length', 1000 );
		$val->add( 'rating' )
			->add( 'required' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 5 );

		// Définir les règles de validation pour le nombre de produits à ajouter dans le panier
		$val_cart = Validation::forge( 'cart_val' );
		$val_cart->add( 'quantity' )
			->add_rule( 'required' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 10 );

		// Si le formulaire de commentaires a été correctement rempli
		if( Input::method() == 'POST' && $val->run() )
		{
			// Si l'utilisateur n'est pas connecté, il faut le rediriger vers la page de connexion
			if( $this->current_user == null )
			{
				Session::set_flash( 'flash_message_error', 'You must be logged in to leave comments' );
				Response::redirect( Uri::current() );
			}

			// Creer un objet commentaires, ajouter les données puis l'enregistrer dans la BDD
			$rating = Model_Rating::forge();
			$rating->user_id = $this->current_user->id;
			$rating->product_id = $product->id;
			$rating->note = $val->validated( 'rating' );
			$rating->description = $val->validated( 'review' );
			$rating->save();

			Session::set_flash( 'flash_message', 'Your message has been successfully created' );
			Response::redirect( Uri::current() );
		}

		// Si le nombre de produits a été correctement rempli
		if( Input::method() == 'POST' && $val_cart->run() )
		{
			// S'il y a deja des produits dans le panier, ajouter les nouveaux produits a la fin de l'array cart_products dans la session
			if( Session::get( 'cart_products' ) )
			{
				$products = Session::get( 'cart_products' );
				$products[] = array( 'product' => $product->id, 'quantity' => $val_cart->validated( 'quantity' ), 'price' => $product->price );
				Session::set( 'cart_products', $products );
			}
			// S'il n'y a pas de produits créer l'array cart_products et ajouter le nouveau produit
			else
			{
				Session::set( 'cart_products', array( array( 'product' => $product->id, 'quantity' => $val_cart->validated( 'quantity' ), 'price' => $product->price ) ) );
			}

			Session::set_flash( 'flash_message', $product->name . ' has been added to your cart' );
			Response::redirect( Uri::current() );
		}

		// Chercher dans la base de données s'il y a des commentaires sur le produit que l'utilisateur est en train de regarder
		$ratings = Model_Rating::find( 'all', array(
			'where' => array(
				array( 'product_id', '=', $product->id )
			),
			'order_by' => array( 'created_at' => 'desc' )
		));

		// initialiser le total dans le panier à 0€
		$cart_total = 0;
		// Pour chaque produit dans le panier, ajouter son prix au total
		if( Session::get( 'cart_products' ) )
		{
			foreach( Session::get( 'cart_products' ) as $cart_product )
			{
				$cart_total += ( $cart_product['price'] * $cart_product['quantity'] );
			}
		}
		// Comme le total du panier est afficher dans la partie global du template, il faut envoyer le total en tant que variable global
		View::set_global( 'cart_total', $cart_total );
			
		// Affichage de la page du produit
		$this->template->title = 'Product &raquo; ' . $product->name;
		$this->template->content = View::forge( 'products/view', array(
			'product' => $product,
			'val' => $val,
			'ratings' => $ratings
		));
	}


	/**
	 * Affiche la page de modification du panier
	 */
	public function action_shopping_cart()
	{
		// Creer la Validation et la variable $i qui sert à compter le nombre de produits différents dans le panier pour pouvoir valider
		// chaque produit dans le panier
		$i = 0;
		$val = Validation::forge();

		// La page sera rechargé avec la méthode POST si l'utilisateur modifie le nombre de produits dans le panier
		if( Input::method() == 'POST' )
		{
			// Pour chaque produit différent dans le panier, créer les règles de validation
			for( $i = 0; $i < count(Input::post())- 1; $i++ )
			{
				$val->add( "quantity_{$i}" )
					->add_rule( 'required' )
					->add_rule( 'numeric_min', 1 )
					->add_rule( 'numeric_max', 10 );
			}

			// Si tous les nombres de produits ont été correctement remplis
			if( $val->run() )
			{
				switch( Input::post( 'submit' ) )
				{
					// Si l'utilisateur a cliqué sur le bouton pour mettre à jour le panier
					case 'update' :
						echo 'update';
						exit();
						break;
					// Si l'utilisateur a cliqué sur le bouton pour voir le résumé de sa commande
					case 'checkout' :
						$this->current_user != null ? Response::redirect( 'shopping-cart/confirmation' ) : Response::redirect( "users/connect?red=shopping-cart/confirmation");
						break;
				}
			}
		}

		$products = null;
		// Creer l'array products. Chaque case de l'array sera rempli avec les informations sur chaque produit dans le panier
		if( Session::get( 'cart_products' ) )
		{
			foreach( Session::get( 'cart_products' ) as $product )
			{
				$prod = Model_Product::find( 'first', array(
					'where' => array(
						array( 'id', '=', $product['product'] )
					)
				));

				$temp['name'] = $prod->name;
				$temp['item_no'] = $prod->id;
				$temp['quantity'] = $product['quantity'];
				$temp['unit_price'] = $prod->price;
				$temp['image'] = Model_Image::get_thumbnail( reset( $prod->images )->name );
				$temp['img_location'] = '/assets/uploads/' . reset( $prod->images )->folder;
				$products[] = $temp;
			}
		}

		// Creer le variable pour le total qui sera calculé dans la partie vue.
		$sub_total = 0;

		// Afficher la page d'édition du panier
		$this->template->title = 'Shopping &raquo; Shopping Cart';
		$this->template->content = View::forge( 'products/shopping_cart', array(
			'products' => $products,
			'sub_total' => $sub_total
		));
	}


	/**
	 * Affiche la page de résumé de la commande
	 */
	public function action_order_confirmation()
	{
		// Vérifier si l'utilisateur a essayé d'accéder à la page directement à travers l'URL sans être connecté
		if( empty( $this->current_user ) ) Response::redirect( Uri::base() );

		// Generer l'array products contenant les informations sur les produits que l'utilisateur souhaite acheter
		$products = null;
		if( Session::get( 'cart_products' ) )
		{
			foreach( Session::get( 'cart_products' ) as $product )
			{
				$prod = Model_Product::find( 'first', array(
					'where' => array(
						array( 'id', '=', $product['product'] )
					)
				));

				$temp['name'] = $prod->name;
				$temp['item_no'] = $prod->id;
				$temp['quantity'] = $product['quantity'];
				$temp['unit_price'] = $prod->price;
				$temp['image'] = Model_Image::get_thumbnail( reset( $prod->images )->name );
				$temp['img_location'] = '/assets/uploads/' . reset( $prod->images )->folder;
				$products[] = $temp;
			}
		}

		// Creation de la variable total qui sera calculé dans la vue
		$sub_total = 0;

		// Affichage du résumé de la commande
		$this->template->title = 'Shopping &raquo; Order Confirmation';
		$this->template->content = View::forge( 'products/order_confirmation', array(
			'products' => $products,
			'sub_total' => $sub_total
		));
	}


	/**
	 * Fonction pour annuler une commande
	 */
	public function action_order_cancel()
	{
		// Vérifier si l'utilisateur a essayé d'accéder à la page directement à travers l'URL sans être connecté
		if( empty( $this->current_user ) ) Response::redirect( Uri::base() );

		// Supprimer l'array cart_products dans la session puis rediriger l'utilisateur vers la page d'accueil
		Session::delete( 'cart_products' );
		Session::set_flash( 'flash_message', 'Your order has been cancelled' );
		Response::redirect( Uri::base() );
	}


	// Affiche la page de confirmation d'achat pour terminer la commande + envoie d'un email avec le résumé de la commande
	public function action_order_buy()
	{
		// Vérifier si l'utilisateur a essayé d'accéder à la page directement à travers l'URL sans être connecté
		if( empty( $this->current_user ) ) Response::redirect( Uri::base() );

		// Calcul du total des produits dans la commande
		$sub_total = 0;
		foreach( Session::get( 'cart_products' ) as $prod )
		{
			$sub_total += ( $prod['price'] * $prod['quantity'] );
		}

		// Enregistrer le total et l'id de l'utilisateur dans la table ORDERS de la BDD
		$order = Model_Order::forge();
		$order->user_id = $this->current_user->id;
		$order->total = $sub_total;
		$order->save();

		// Enregistrer le nom des produits, le nombre de produits achetés, le prix unitaire des produits,
		// l'id de la commande dans la table ORDER_PRODUCTS de la BDD
		$products = null;
		if( Session::get( 'cart_products' ) )
		{
			foreach( Session::get( 'cart_products' ) as $product )
			{
				$prod = Model_Product::find( 'first', array(
					'where' => array(
						array( 'id', '=', $product['product'] )
					)
				));

				$temp['name'] = $prod->name;
				$temp['item_no'] = $prod->id;
				$temp['quantity'] = $product['quantity'];
				$temp['unit_price'] = $prod->price;
				$temp['image'] = Model_Image::get_thumbnail( reset( $prod->images )->name );
				$temp['img_location'] = '/assets/uploads/' . reset( $prod->images )->folder;
				$products[] = $temp;

				$order_product = Model_Orderproduct::forge();
				$order_product->name = $prod->name;
				$order_product->price = $prod->price;
				$order_product->quantity = $product['quantity'];
				$order_product->order_id = $order->id;
				$order_product->save();
			}
		}

		// Envoyer l'email de résumé de la commande à l'utilisateur
		$email = Email::forge();
		$email->from( 'daniel.chris.lucas@gmail.com', 'Shopping' );
		$email->to( $this->current_user->email, $this->current_user->first_name . ' ' . $this->current_user->last_name );
		$email->subject( 'Shopping - Invoice, Order #123456' );
		$email->html_body( View::forge( 'layouts/emails/invoice', array(
			'products' => $products,
			'order_id' => $order->id,
			'sub_total' => $sub_total
		)));
		try
		{
			$email->send();
		}
		catch( \EmailSendingFailedException $e )
		{
			Session::set_flash( 'flash_message_error', 'Invoice sending failed. Please contact the store for help.' );
		}

		// Supprimer l'array cart_products de la session
		Session::delete( 'cart_products' );
		
		// Affichage de la page de confirmation d'achat
		$this->template->title = 'Shopping &raquo; Checkout';
		$this->template->content = View::forge( 'products/order_buy', array(
		));
	}


	/**
	 * Affiche la page de recherche de produits
	 * @param  String $query Les mots clés pour les produits a chercher
	 */
	public function action_search( $query = null )
	{
		$val = Validation::forge();
		$query = null;
		$products = null;

		$val->add( 'search' );

		// Si l'utilisateur a bien rempli le dialogue de recherche
		if( Input::method() == 'POST' && $val->run() )
		{
			$query = $val->validated( 'search' );
			$products = Model_Product::find( 'all', array(
				'where' => array(
					array( "name", "like", "%{$query}%")
				)
			));
		}

		// Affichage de la page de recherche avec les produits qui correspondent à la recherche de l'utilisateur
		$this->template->title = "Shopping &raquo; Search";
		$this->template->content = View::forge( 'products/search', array(
			'query' => $query,
			'products' => $products
		));
	}

}
