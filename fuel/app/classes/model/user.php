<?php

class Model_User extends \Orm\Model
{

	protected static $_properties = array(
		'id',
		'username',
		'password',
		'first_name',
		'last_name',
		'date_of_birth',
		'street',
		'street_number',
		'town',
		'country_id',
		'tel',
		'email',
		'role_id',
		'confirmation_code',
		'activated',
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


	protected static $_belongs_to = array( 'country', 'role' );


	public static function age_from_dob( $date_of_birth )
	{
		return floor( ( time() - strtotime( $date_of_birth ) ) / 31556925 );
	}


	public static function count_users()
	{
		$result = DB::select( DB::expr( 'COUNT(*) as count' ) )->from( 'users' )->execute()->current();
		return $result['count'];
	}

}
