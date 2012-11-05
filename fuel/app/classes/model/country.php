<?php

class Model_Country extends \Orm\Model
{

	protected static $_properties = array(
		'id',
		'name',
		'iso',
		'iso3'
	);


	public static function count_countries()
	{
		$result = DB::select( DB::expr( 'COUNT(*) as count' ) )->from( 'countries' )->execute()->current();
		return $result['count'];
	}

}