<?php
/**
 * Définit les propriétés des roles des utilisateurs
 */
class Model_Role extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name'
	);
}
