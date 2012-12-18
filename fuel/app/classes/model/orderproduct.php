<?php
/**
 * Définit les propriétés des caractéristiques d'un produit commandé
 */
class Model_Orderproduct extends \Orm\Model
{
	/**
	 * Definition des propriétés de la modèle: utilisé par l'ORM
	 */
	protected static $_properties = array(
		'id',
		'name',
		'price',
		'order_id',
		'created_at',
		'updated_at',
		'quantity'
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
}
