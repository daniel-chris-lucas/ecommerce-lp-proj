<?php
/**
 * Contient les pages permettant de voir tous les pays, de créer des pays, de modifier des pays, et de supprimer
 * des pays
 */
class Controller_Admin_Countries extends Controller_Admin_Base
{
	/**
	 * Affiche la page qui permet de voir tous les pays qui existent sur le site
	 */
	public function action_index()
	{
		// Il faut compter le nombre de pays pour que la pagination puisse faire les calculs
		$num_countries = Model_Country::count_countries();

		// La configuration pour la pagination
		$config = array(
			'pagination_url' => Uri::create( 'admin/countries/index' ),
			'total_items' => $num_countries,
			'per_page' => 8,
			'uri_segment' => 4,
			'template' => array(
				'wrapper_start' => '<div class="pagination pagination-right"><ul>',
				'wrapper_end' => '</ul></div>',
				'page_start' => '',
				'page_end' => '',
				'regular_start' => '<li>',
				'regular_end' => '</li>',
				'active_start' => '<li class="active">',
				'active_end' => '</li>',
				'previous_start' => '<li>',
				'previous_end' => '</li>',
				'next_start' => '<li>',
				'next_end' => '</li>',
				'previous_inactive_start' => '<li class="disabled">',
				'previous_inactive_end' => '</li>',
				'next_inactive_start' => '<li class="disabled">',
				'next_inactive_end' => '</li>'
			),
		);

		// Pour éviter d'avoir trop de catégories sur la page on utilise la pagination
		Pagination::set_config( $config );
		$countries = Model_Country::find()
						->limit( Pagination::$per_page )
						->offset( Pagination::$offset )
						->order_by( 'name', 'asc' )
						->get();

		// Creation du sous menu Add New Country
		$submenus = array(
			array( 'name' =>'Add New', 'link' => 'admin/countries/create', 'class' => 'menu_icons')
		);
		// Comme submenus est dans la partie template il faut la declarer en tant que variable globale
		View::set_global( 'submenus', $submenus );

		// Affichage de la page
		$this->template->title = 'Admin &raquo; Countries';
		$this->template->content = View::forge( 'admin/countries/index', array(
			'countries' => $countries
		));
	}


	/**
	 * Affiche la page permettant de créer de nouveaux pays
	 */
	public function action_create()
	{
		// Définition des règles de validation pour le formulaire de création
		$val = Validation::forge();
		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 );
		$val->add( 'iso', 'ISO' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 2 );
		$val->add( 'iso3', 'ISO3' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 3 );

		// Si tous le champs sont correctement remplis on peut créer le pays
		if( Input::method() == 'POST' && $val->run() )
		{
			$country = Model_Country::forge();
			$country->name = $val->validated( 'name' );
			$country->iso = $val->validated( 'iso' );
			$country->iso3 = $val->validated( 'iso3' );
			$country->save();

			Session::set_flash( 'flash_message', 'New country has been successfully created' );
			Response::redirect( 'admin/categories' );
		}

		// Affichage de la page de création
		$this->template->title = 'Admin &raquo; Countries &raquo; Create';
		$this->template->content = View::forge( 'admin/countries/create', array(
			'val' => $val
		));
	}


	/**
	 * Affiche la page de modification de pays
	 * @param Integer $country_id L'ID du pays à modifier
	 */
	public function action_edit( $country_id )
	{
		// Chercher les informations sur le pays dans la BDD
		$country = Model_Country::find( $country_id );

		// Définition des règles de validation
		$val = Validation::forge();
		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 );
		$val->add( 'iso', 'ISO' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 2 )
			->add_rule( 'max_length', 2 );
		$val->add( 'iso3', 'ISO3' )
			->add_rule( 'required' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 3 );

		// Si tous les champs sont correctement remplis on peut modifier les informations du pays
		if( Input::method() == 'POST' && $val->run() )
		{
			$country->name = $val->validated( 'name' );
			$country->iso = $val->validated( 'iso' );
			$country->iso3 = $val->validated( 'iso3' );
			$country->save();

			Session::set_flash( 'flash_message', 'Country has been successfully updated' );
			Response::redirect( 'admin/countries' );
		}

		// Affichage de la page de modification
		$this->template->title = 'Admin &raquo; Countries &raquo; Edit';
		$this->template->content = View::forge( 'admin/countries/edit', array(
			'country' => $country,
			'val' => $val
		));
	}


	/**
	 * La fonction permet de supprimer un pays
	 * @param Integer $country_id L'ID du pays à supprimer
	 */
	public function action_delete( $country_id )
	{
		// Chercher le pays à supprimer dans la BDD
		$country = Model_Country::find( $country_id );

		$country->delete();
		Session::set_flash( 'flash_message', 'Country has been deleted' );

		// Rediriger l'utilisateur vers la liste des pays
		Response::redirect( 'admin/countries' );
	}

}