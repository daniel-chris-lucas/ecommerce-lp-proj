<?php
/**
 * Cree les liens entre les categories, les sous categories et les produits.
 * Permet de compter le nombre de categories, de trouver les sous categories des categories et de générer les menus
 * en order alphabétique par catégorie puis sous catégorie
 */
class Model_Category extends \Orm\Model
{

	/**
	 * Definition des propriétés de la modèle: utilisé par l'ORM
	 */
	protected static $_properties = array(
		'id',
		'name',
		'parent_id',
		'slug'
	);


	/**
	 * Création d'un lien entre les sous catégories et les catégories
	 */
	protected static $_belongs_to = array(
	    'parent' => array(
	        'key_from' => 'parent_id',
	        'model_to' => 'Model_Category',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);

	/**
	 * Création d'un lien entre les catégories et les produits
	 */
	protected static $_has_many = array( 'products' );


	/**
	 * La fonction compte le nombre de catégories qui existent dans la BDD
	 * @return Integer Le nombre de catégories dans la BDD
	 */
	public static function count_categories()
	{
		$result = DB::select( DB::expr( 'COUNT(*) as count' ) )->from( 'categories' )->execute()->current();
		return $result['count'];
	}


	/**
	 * La fonction trouve les sous catégories d'une catégorie
	 * @param  Integer L'ID de la catégorie principale
	 * @return Array Les sous catégories de la catégorie
	 */
	public static function find_children( $parent_id )
	{
		$children = DB::select( 'id' )
						->from( 'categories' )
						->where( 'parent_id', '=', $parent_id )
						->execute()
						->as_array();

		foreach( $children as $child )
		{
			$children_arr[] = $child;
		}

		return $children;
	}


	/**
	 * La foction cherche les Catégories principales puis les sous catégories
	 * @return Array Les catégories puis sous catégories par ordre alphabétique
	 */
	public static function generate_categories_subcategories()
	{
		$result = DB::query('
					  SELECT parent.name AS parent_name, parent.slug AS parent_slug, child1.name AS child1_name, child1.slug AS child1_slug
					  FROM categories AS parent
					  LEFT OUTER JOIN categories AS child1 ON child1.parent_id = parent.id
					  WHERE parent.parent_id IS NULL
					  ORDER BY parent_name, child1_name 
				  ')->execute()
					->as_array();

		return $result;
	}

}
