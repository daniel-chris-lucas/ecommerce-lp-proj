<?php
/**
 * Définit les propriétés des options du site
 */
class Model_Option extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'value'
	);

}
