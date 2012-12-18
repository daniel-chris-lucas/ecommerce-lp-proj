<?php
/**
 * Cree les liens entre les utilisateurs, les roles et les pays
 * Permet de calculer l'age à partir de la date de naissance et de compter le nombre d'utilisateurs dans la BDD
 */
class Model_User extends \Orm\Model
{
	/**
	 * Definition des propriétés de la modèle: utilisé par l'ORM
	 */
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

	
	/**
	 * Création d'un lien entre les pays et les utilisateurs
	 * Création d'un lien entre les roles et les utilisateurs
	 */
	protected static $_belongs_to = array( 'country', 'role' );


	/**
	 * La fonction calcule l'age de l'utilisateur à partir de sa date de naissance
	 * @param String $date_of_birth La date de naissance de l'utilisateur
	 * @return Integer L'age de l'utilisateur
	 */
	public static function age_from_dob( $date_of_birth )
	{
		// 31556925 est le nombre de secondes dans 365.25 jours
		return floor( ( time() - strtotime( $date_of_birth ) ) / 31556925 );
	}


	/**
	 * La fonction permet de compter le nombre d'utilisateurs dans la BDD
	 * @return Integer Le nombre d'utilisateurs dans la BDD
	 */
	public static function count_users()
	{
		$result = DB::select( DB::expr( 'COUNT(*) as count' ) )->from( 'users' )->execute()->current();
		return $result['count'];
	}

}
