<?php
/**
 * Tous les pages en dehors de la partie admin lancent cette classe avant d'etre exécuté.
 * La classe sert a appeler la vue template qui contient toute la partie du vue qui ne change pas.
 * Elle sert aussi a chercher les catégories dans la base de données, voir si l'utilisateur est connecté, et voir si les
 * utilisateurs connectés sont des administrateurs ou des modérateurs du site.
 */
class Controller_Base extends Controller_Template
{

	public $template = 'layouts/template';

	public function before()
	{
		parent::before();

		// chercher les ID des administrateurs et des moderateurs dans la table ROLES
		$this->moderator_id = Model_Role::find( 'first', array(
			'where' => array(
				array( 'name', 'like', 'moderator' )
			)
		));
		$this->moderator_id = $this->moderator_id['id'];
		$this->admin_id = Model_Role::find( 'first', array(
			'where' => array(
				array( 'name', 'like', 'administrator' )
			)
		));
		$this->admin_id = $this->admin_id['id'];

		
		// Chercher toutes les categories dans le site
		$this->main_categories = Model_Category::generate_categories_subcategories();

		// Faire un array pour mettre les categories dans l'ordre alphbetique des parents puis des sous categories
		$this->newCategories = array();
		foreach( $this->main_categories as $main_category )
		{
		    $this->newCategories[ $main_category['parent_name']][] = array(
		        'child_name' => $main_category['child1_name'],
		        'child_slug' => $main_category['child1_slug'],
		        'parent_slug' => $main_category['parent_slug']
		    );
		}
		
		// Si username existe dans la session, cherche les informations sur l'utilisateur connecté.
		if( Session::get( 'username' ) )
		{
			$this->current_user = Model_User::find( 'first', array(
				'where' => array(
					array( 'username', 'like', Session::get( 'username' ) )
				)
			));
		}
		else
		{
			$this->current_user = null;
		}

		// Afficher le prix total des produits dans le panier
		if( Uri::segment( 1 ) != 'products' || Uri::segment( 2 ) != 'view' )
		{
			$cart_total = 0;
			if( Session::get( 'cart_products' ) )
			{
				foreach( Session::get( 'cart_products' ) as $cart_product )
				{
					$cart_total += ( $cart_product['price'] * $cart_product['quantity'] );
				}
			}
			View::set_global( 'cart_total', $cart_total );
		}

		
		// Envoyer les informations qui vont etre affiches au vue.
		View::set_global( 'current_user', $this->current_user );
		View::set_global( 'moderator_id', $this->moderator_id );
		View::set_global( 'admin_id', $this->admin_id );
		View::set_global( 'main_categories', $this->newCategories );
	}

}