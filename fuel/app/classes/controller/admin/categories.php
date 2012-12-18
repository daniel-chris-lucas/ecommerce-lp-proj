<?php
/**
 * Contient les pages permettant de voir toutes les categories, de créer des catégories, de modifier des catégories, et de supprimer
 * des catégories
 */
class Controller_Admin_Categories extends Controller_Admin_Base
{
	/**
	 * Affiche la page qui permet de voir toutes les catégories qui existent sur le site
	 */
	public function action_index()
	{
		// Il faut compter le nombre de catégories pour que la pagination puisse faire les calculs
		$num_categories = Model_Category::count_categories();

		// La configuration pour la pagination
		$config = array(
			'pagination_url' => Uri::create( 'admin/categories/index' ),
			'total_items' => $num_categories,
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
		$categories = Model_Category::find()
						->limit( Pagination::$per_page )
						->offset( Pagination::$offset )
						->order_by( 'name', 'asc' )
						->get();

		// Creation du sous menu Add New Category
		$submenus = array(
			array( 'name' =>'Add New', 'link' => 'admin/categories/create', 'class' => 'menu_icons')
		);
		// Comme submenus est dans la partie template il faut la declarer en tant que variable globale
		View::set_global( 'submenus', $submenus );

		// Affichage de la page
		$this->template->title = 'Admin &raquo; Categories';
		$this->template->content = View::forge( 'admin/categories/index', array(
			'categories' => $categories
		));
	}


	/**
	 * Affiche la page permettant de créer de nouvelles catégories
	 */
	public function action_create()
	{
		// Définition des règles de validation pour le formulaire de création
		$val = Validation::forge();
		$val->add_callable( 'myrules' );

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'unique', 'categories.name' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 25 );
		$val->add( 'slug', 'Slug' )
			->add_rule( 'required' )
			->add_rule( 'unique', 'categories.slug' )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 30 );
		$val->add( 'parent', 'Parent Category' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 1000 );

		// Si tous le champs sont correctement remplis on peut créer la catégorie
		if( Input::method() == 'POST' && $val->run() )
		{
			$category = Model_Category::forge();
			$category->name = $val->validated('name');
			$category->parent_id = $val->validated( 'parent' ) ? $val->validated( 'parent' ) : null;
			$category->slug = $val->validated( 'slug' );
			$category->save();

			Session::set_flash( 'flash_message', 'New category has been successfully created' );
			Response::redirect( 'admin/categories' );
		}

		// Chercher les catégories existantes pour le champ des catégories parents
		$categories = Model_Category::find( 'all' );

		// Affichage de la page de création
		$this->template->title = 'Admin &raquo; Categories &raquo; Create';
		$this->template->content = View::forge( 'admin/categories/create', array(
			'categories' => $categories,
			'val' => $val
		));
	}


	/**
	 * Affiche la page de modification de catégories
	 * @param Integer $category_id L'ID de la catégorie à modifier
	 */
	public function action_edit( $category_id )
	{
		// Chercher les informations sur la catégorie dans la BDD
		$category = Model_Category::find( $category_id );

		// Définition des règles de validation
		$val = Validation::forge();
		$val->add_callable( 'myrules' );

		$val->add( 'name', 'Name' )
			->add_rule( 'required' )
			->add_rule( 'unique', 'categories.name', $category->name )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 25 );
		$val->add( 'slug', 'Slug' )
			->add_rule( 'required' )
			->add_rule( 'unique', 'categories.slug', $category->slug )
			->add_rule( 'min_length', 3 )
			->add_rule( 'max_length', 30 );
		$val->add( 'parent', 'Parent Category' )
			->add_rule( 'numeric_min', 1 )
			->add_rule( 'numeric_max', 1000 );

		// Si tous les champs sont correctement remplis on peut modifier les informations de la catégorie
		if( Input::method() == 'POST' && $val->run() )
		{
			$category->name = $val->validated('name');
			$category->parent_id = $val->validated( 'parent' ) ? $val->validated( 'parent' ) : null;
			$category->save();

			Session::set_flash( 'flash_message', 'Category has been successfully updated' );
			Response::redirect( 'admin/categories' );
		}

		// Chercher les catégories existantes pour le champ des catégories parents
		$categories = Model_Category::find( 'all' );

		// Affichage de la page de modification
		$this->template->title = 'Admin &raquo; Categories &raquo; Edit';
		$this->template->content = View::forge( 'admin/categories/edit', array(
			'category' => $category,
			'categories' => $categories,
			'val' => $val
		));
	}


	/**
	 * La fonction permet de supprimer une catégorie
	 * @param Integer $category_id L'ID de la catégorie à supprimer
	 */
	public function action_delete( $category_id )
	{
		// Chercher la catégorie à supprimer dans la BDD
		$category = Model_Category::find( $category_id );

		// Compter le nombre de sous catégories liées à cette catégorie
		$children_categories = Model_Category::find_children( $category_id );

		// Si la catégorie n'a pas de sous catégories on peut la supprimer
		if( count( $children_categories ) == 0 )
		{
			$category->delete();
			Session::set_flash( 'flash_message', 'Category has been deleted' );
		}
		else
			Session::set_flash( 'flash_message_error', 'Category has children. It can not be deleted.' );

		// Rediriger l'utilisateur vers la liste des catégories
		Response::redirect( 'admin/categories' );
	}

}