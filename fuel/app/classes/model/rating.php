<?php

class Model_Rating extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'product_id',
		'note',
		'description',
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

	protected static $_belongs_to = array( 'user' );
}
