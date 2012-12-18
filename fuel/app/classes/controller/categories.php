<?php
/**
 * Les pages qui affichent les categories
 */
class Controller_Categories extends Controller_Base
{

	/**
	 * Cette fonction sert a afficher la liste de toutes les categories quand l'utilisateur clique sur Categories dans le menu
	 * principal.
	 * La fonction ne sert que si l'utilisateur a désactivé le javaScript, sinon les categories sont affichés tout de suite quand le
	 * souris survol le menu.
	 */
	public function action_index()
	{
		$categories = Model_Category::find( 'all', array(
			'where' => array(
				array( 'parent_id', null )
			),
			'order_by' => array( 'name' => 'asc' )
		));
		$this->template->title = 'Categories &raquo; Listing';
		$this->template->content = View::forge('categories/index', array( 'categories' => $categories ) );
	}


	/**
	 * Affiche tous les produits dans la catégorie.
	 * @param String $category_slug le titre optimisé du categorie
	 */
	public function action_view( $category_slug )
	{
		$category = Model_Category::find( 'first', array(
			'where' => array(
				array( 'slug', 'like', $category_slug )
			),
		));

		$this->template->title = 'Category &raquo; ' . $category->name;
		$this->template->content = View::forge( 'categories/view', array( 'category' => $category ) );
	}

}
