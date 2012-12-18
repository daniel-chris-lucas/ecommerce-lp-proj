<?php
/**
 * Permet de compter le nombre de pays, et de compter le nombre de pays dans la BDD
 */
class Model_Country extends \Orm\Model
{

	/**
	 * Definition des propriétés de la modèle: utilisé par l'ORM
	 */
	protected static $_properties = array(
		'id',
		'name',
		'iso',
		'iso3'
	);


	/**
	 * La fonction compte le nombre de pays qui existent dans la BDD
	 * @return Integer Le nombre de pays dans la BDD
	 */
	public static function count_countries()
	{
		$result = DB::select( DB::expr( 'COUNT(*) as count' ) )->from( 'countries' )->execute()->current();
		return $result['count'];
	}

}