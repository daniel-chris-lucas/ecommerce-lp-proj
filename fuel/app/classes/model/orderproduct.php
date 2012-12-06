<?php

class Model_Orderproduct extends \Orm\Model
{
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
