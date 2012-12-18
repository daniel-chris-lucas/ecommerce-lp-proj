<?php
/**
 * Définit les propriétés des caractéristiques d'un produit
 */
class Model_Characteristic extends \Orm\Model
{
	/**
	 * Definition des propriétés de la modèle: utilisé par l'ORM
	 */
	protected static $_properties = array(
		'id',
		'name',
		'value',
		'product_id'
	);
}
