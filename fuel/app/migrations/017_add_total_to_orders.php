<?php

namespace Fuel\Migrations;

class Add_total_to_orders
{
	public function up()
	{
		\DBUtil::add_fields('orders', array(
			'total' => array('type' => 'float'),

		));	
	}

	public function down()
	{
		\DBUtil::drop_fields('orders', array(
			'total'
    
		));
	}
}