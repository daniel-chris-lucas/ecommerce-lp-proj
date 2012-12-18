<?php
/**
 * Cree les liens entre les produits, les commandes et les utilisateurs
 */
class Model_Order extends \Orm\Model
{

	/**
	 * Definition des propriétés de la modèle: utilisé par l'ORM
	 */
	protected static $_properties = array(
		'id',
		'user_id',
		'created_at',
		'updated_at',
		'total'
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
	 * Création d'un lien entre les commandes et les produits
	 */
	protected static $_has_many = array( 'orderproducts' );

	/**
	 * Création d'un lien entre utilisateurs et les commandes
	 */
	protected static $_belongs_to = array( 'user' );

}