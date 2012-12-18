<?php
/**
 * Cree les liens entre les produits, les images et les catégories
 * Permet de creer des titres optimisés avec les titres entrés à la création du produit
 */
class Model_Product extends \Orm\Model
{
	/**
	 * Definition des propriétés de la modèle: utilisé par l'ORM
	 */
	protected static $_properties = array(
		'id',
		'name',
		'description',
		'slug',
		'category_id',
		'price',
		'created_at',
		'updated_at'
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	/**
	 * Création d'un lien entre les catégories et les produits
	 */
	protected static $_belongs_to = array(
	    'category' => array(
	        'key_from' => 'category_id',
	        'model_to' => 'Model_Category',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);

	/**
	 * Création d'un lien entre les produits et les images
	 */
	protected static $_has_many = array( 'images' );


	/**
	 * Crée un titre optimisé pour les moteurs de recherche en enlevant les espaces et en mettant des tirets
	 * @param String $string Le nom du produit
	 * @return String Le titre optimisé
	 */
	public function create_slug( $string ){
	   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	   return Str::lower( $slug );
	}
}
